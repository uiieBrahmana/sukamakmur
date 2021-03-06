<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Administrator extends CI_Controller
{

    private $data;

    public function __construct()
    {
        parent::__construct();
        $this->data['auth'] = $this->session->userdata('ID');
        $this->data['role'] = $this->session->userdata('role');

        if (!isset($this->data['auth'])) {
            redirect('/login/');
        }

        if (strcasecmp($this->data['role'], 'Tamu') == 0) {
            redirect('/pengunjung/');
        }

    }

    public function index()
    {

        $this->data['SisaMakanan'] = $this->koneksi->FetchAll("SELECT (1000 - sum(IFNULL(porsi,0))) as sisa FROM `pesananmakanan`
        WHERE tanggalpemesanan = now() GROUP BY tanggalpemesanan;");
        if (sizeof($this->data['SisaMakanan']) == 0)
            $this->data['SisaMakanan'] = 1000;
        else
            $this->data['SisaMakanan'] = $this->data['SisaMakanan'][0]['sisa'];

        $this->data['SisaAkomodasi'] = $this->koneksi->FetchAll("SELECT * FROM `pesananakomodasi`
        WHERE tanggal = now();");
        $this->data['TotalAkomodasi'] = $this->koneksi->FetchAll("SELECT * FROM `akomodasi`");

        $i = 0;
        foreach ($this->data['TotalAkomodasi'] as $key => $val) {
            foreach ($this->data['SisaAkomodasi'] as $k => $v) {
                if (strcmp($val['idakomodasi'], $v['idakomodasi']) == 0) {
                    $this->data['TotalAkomodasi'][$key]['BookAvailable'] = false;
                    $i = $i - 1;
                    break;
                } else {
                    $this->data['TotalAkomodasi'][$key]['BookAvailable'] = true;
                }
            }
            $i = $i + 1;
        }
        $this->data['CountAkomodasi'] = $i;

        $this->data['SisaPeralatan'] = $this->koneksi->FetchAll("SELECT p.*, (p.jumlah - pn.jumlah) AS sisajumlah
                FROM peralatan p LEFT JOIN pesananperalatan pn USING (idperalatan)
                WHERE pn.tanggal = now() GROUP BY pn.tanggal;");
        $this->data['TotalPeralatan'] = $this->koneksi->FetchAll("SELECT * FROM `peralatan`");

        $j = 0;
        foreach ($this->data['TotalPeralatan'] as $key => $val) {
            foreach ($this->data['SisaPeralatan'] as $k => $v) {
                if (strcmp($val['idperalatan'], $v['idperalatan']) == 0) {
                    $this->data['TotalPeralatan'][$key]['BookAvailable'] = (int)$v['sisajumlah'];
                    $j = $j - 1;
                    break;
                }
            }
            $j = $j + $val['jumlah'];
        }
        $this->data['CountPeralatan'] = $j;

        $this->data['SisaKegiatan'] = $this->koneksi->FetchAll("SELECT k.*, count(pk.tanggal) as jumlah from kegiatan k
                LEFT JOIN pesanankegiatan pk USING(idkegiatan)
                WHERE pk.tanggal = now()
                GROUP BY pk.tanggal, idkegiatan;");

        $train = $this->koneksi->FetchAll("SELECT ifnull(count(*),0) as pelatih FROM petugas WHERE status = 'Trainer'");
        $trainer = $train[0]['pelatih'];

        $this->data['TotalKegiatan'] = $this->koneksi->FetchAll("SELECT * FROM `kegiatan`");

        $k = 0;
        foreach ($this->data['TotalKegiatan'] as $key => $val) {
            foreach ($this->data['SisaKegiatan'] as $k => $v) {
                if (strcmp($val['idkegiatan'], $v['idkegiatan']) == 0) {
                    $this->data['TotalKegiatan'][$key]['BookAvailable'] = (int)$trainer - (int)$v['jumlah'];
                    $k = $k - 1;
                    break;
                }
            }
            $k = $k + $trainer;
        }
        $this->data['CountKegiatan'] = $k;

        $sql = "SELECT count(*) jumlah, YEAR(tanggalpesan) tahun,
            MONTH(tanggalpesan) bulan FROM `pemesanan` WHERE YEAR(tanggalpesan) = YEAR(NOW())
            GROUP BY YEAR(tanggalpesan), MONTH(tanggalpesan);";
        $stats = $this->koneksi->FetchAll($sql);
        $this->data['Stats'] = $stats;

        $this->load->view('admin/AdminBeranda', $this->data);
    }

    public function adminlihatakun()
    {
        $this->data['Akun'] = $this->koneksi->FetchAll("SELECT * FROM `tamu`");
        $this->load->view('admin/tamu/AdminLihatAkun', $this->data);
    }

    public function adminbuatakun()
    {
        $submit = $this->input->post('submit');
        if ($submit) {
            $nama = $this->input->post('nama');
            $tanggallahir = $this->input->post('tanggallahir');
            $tanggallahir = date("Y-m-d", strtotime($tanggallahir));
            $jeniskelamin = $this->input->post('jeniskelamin');
            $alamat = $this->input->post('alamat');
            $email = $this->input->post('email');
            $notelp = $this->input->post('notelp');
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            $queryakun = InsertBuilder('tamu', array(
                'nama' => $nama,
                'tanggallahir' => $tanggallahir,
                'jeniskelamin' => $jeniskelamin,
                'alamat' => $alamat,
                'email' => $email,
                'notelp' => $notelp,
                'username' => $username,
                'password' => $password
            ));

            $idtamu = $this->koneksi->Save($queryakun, array(
                $nama,
                $tanggallahir,
                $jeniskelamin,
                $alamat,
                $email,
                $notelp,
                $username,
                $password
            ));

            if ($idtamu) {
                redirect('/administrator/adminlihatakun/success');
            } else {
                echo 'failed';
            }

        }
        $this->load->view('admin/tamu/AdminBuatAkun', $this->data);
    }

    public function detailmakanan($domain, $id)
    {
        switch ($domain) {
            case 'delete':
                $menumakanan = DeleteBuilder('menumakanan', array('idmenumakanan' => $id));
                $id = $this->koneksi->Save($menumakanan, array($id));
                redirect('/administrator/adminlihatmakanan/success');
                break;
            case 'update':
                $result = $this->koneksi->FetchAll("SELECT * FROM `menumakanan` WHERE idmenumakanan = " . $id);
                $this->data['TipeMakanan'] = $this->koneksi->FetchAll("SELECT * FROM tipemakanan");
                $this->data['Menumakanan'] = $result[0];
                $this->load->view('admin/makanan/AdminUpdateMakanan', $this->data);
                break;
            case 'view':
                $result = $this->koneksi->FetchAll("SELECT * FROM `menumakanan` WHERE idmenumakanan = " . $id);
                $this->data['Menumakanan'] = $result[0];
                $this->load->view('admin/makanan/AdminMakananDetail', $this->data);
                break;
        }
    }

    public function adminupdatemakanan()
    {
        $submit = $this->input->post('submit');

        if (isset($submit)) {
            $idmenumakanan = $this->input->post('idmenumakanan');
            $idtipemakanan = $this->input->post('idtipemakanan');
            $keterangan = $this->input->post('keterangan');

            $querymakanan = UpdateBuilder('menumakanan',
                array(
                    'idmenumakanan' => $idmenumakanan,
                ),
                array(
                    'idtipemakanan' => $idtipemakanan,
                    'keterangan' => $keterangan,
                )
            );

            $id = $this->koneksi->Save($querymakanan, array(
                $idmenumakanan,
                $idtipemakanan,
                $keterangan,
            ));

            if ($id == 0) {
                redirect('/administrator/adminlihatmakanan/success');
            } else {
                echo 'failed';
            }
        }
    }

    public function admintambahmakanan()
    {
        $this->data['TipeMakanan'] = $this->koneksi->FetchAll("SELECT * FROM tipemakanan");

        $submit = $this->input->post('submit');
        if ($submit) {
            $idtipemakanan = $this->input->post('idtipemakanan');
            $keterangan = $this->input->post('keterangan');

            $querymenumakan = InsertBuilder('menumakanan', array(
                'idtipemakanan' => $idtipemakanan,
                'keterangan' => $keterangan,
            ));

            $idmenumakanan = $this->koneksi->Save($querymenumakan, array($idtipemakanan, $keterangan));
            redirect('/administrator/adminlihatmakanan/success');

        }
        $this->load->view('admin/makanan/AdminTambahMakanan', $this->data);
    }

    public function adminlihatmakanan()
    {
        $this->data['MenuMakanan'] = $this->koneksi->FetchAll("SELECT * FROM `menumakanan`");
        $this->load->view('admin/makanan/AdminLihatMakanan', $this->data);
    }

    public function adminLihatTipeMakanan()
    {

        $this->data['TipeMakanan'] = $this->koneksi->FetchAll("SELECT * FROM `tipemakanan`");
        $this->load->view('admin/makanan/AdminLihatTipeMakanan', $this->data);
    }

    public function detailTipeMakanan($domain, $id)
    {
        switch ($domain) {
            case 'delete':
                $kueritipemakanan = DeleteBuilder('tipemakanan', array('idtipemakanan' => $id));
                $idtipemakanan = $this->koneksi->Save($kueritipemakanan, array($id));
                redirect('/administrator/adminlihattipemakanan/success');
                break;
            case 'update':
                $result = $this->koneksi->FetchAll("SELECT * FROM `tipemakanan` WHERE idtipemakanan = '$id'");
                $this->data['TipeMakanan'] = $result[0];
                $this->load->view('admin/makanan/AdminUpdateTipeMakanan', $this->data);
                break;
            case 'view':
                $result = $this->koneksi->FetchAll("SELECT * FROM `tipemakanan` WHERE idtipemakanan = '$id'");
                $this->data['TipeMakanan'] = $result[0];
                $this->load->view('admin/makanan/AdminTipeMakananDetail', $this->data);
                break;
        }
    }

    public function adminupdatetipemakanan()
    {

        $submit = $this->input->post('submit');
        if (isset($submit)) {
            $idtipemakanan = $this->input->post('idtipemakanan');
            $keterangan = $this->input->post('keterangan');
            $harga = $this->input->post('harga');

            $builder = UpdateBuilder('tipemakanan',
                array('idtipemakanan' => $idtipemakanan),
                array(
                    'keterangan' => $keterangan,
                    'harga' => $harga,
                )
            );

            $idupdate = $this->koneksi->Save($builder, array($idtipemakanan, $keterangan, $harga));
            if ($idupdate == 0)
                redirect('/administrator/adminlihattipemakanan/success');
            else
                echo 'update gagal';
        }
    }

    public function adminlihatpegawai()
    {
        $this->data['Akun'] = $this->koneksi->FetchAll("SELECT * FROM `petugas`");
        $this->load->view('admin/pegawai/AdminLihatPegawai', $this->data);
    }

    public function admintambahpegawai()
    {
        $submit = $this->input->post('submit');
        if (isset($submit)) {
            $nama = $this->input->post('nama');
            $alamat = $this->input->post('alamat');
            $tglLahir = $this->input->post('tglLahir');
            $tglLahir = date("Y-m-d", strtotime($tglLahir));
            $jenisKelamin = $this->input->post('jenisKelamin');
            $notelp = $this->input->post('notelp');
            $email = $this->input->post('email');
            $status = $this->input->post('status');
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            $kueri = InsertBuilder('petugas', array(
                'nama' => $nama,
                'alamat' => $alamat,
                'tglLahir' => $tglLahir,
                'jenisKelamin' => $jenisKelamin,
                'notelp' => $notelp,
                'email' => $email,
                'status' => $status,
                'username' => $username,
                'password' => $password
            ));
            $result = $this->koneksi->Save($kueri, array(
                $nama, $alamat, $tglLahir, $jenisKelamin, $notelp, $email, $status, $username, $password
            ));
            if ($result) {
                redirect('/administrator/adminlihatpegawai/success');
            } else {
                echo 'gagal';
            }
        }
        $this->load->view('admin/pegawai/AdminTambahPegawai', $this->data);
    }

    public function adminKegiatan()
    {
        $this->data['SisaKegiatan'] = $this->koneksi->FetchAll("SELECT k.*, count(pk.tanggal) as jumlah from kegiatan k
                LEFT JOIN pesanankegiatan pk USING(idkegiatan)
                WHERE pk.tanggal = now()
                GROUP BY pk.tanggal, idkegiatan;");

        $train = $this->koneksi->FetchAll("SELECT ifnull(count(*),0) as pelatih FROM petugas WHERE status = 'Trainer'");
        $trainer = $train[0]['pelatih'];

        $this->data['TotalKegiatan'] = $this->koneksi->FetchAll("SELECT * FROM `kegiatan`");

        $k = 0;
        foreach ($this->data['TotalKegiatan'] as $key => $val) {
            foreach ($this->data['SisaKegiatan'] as $k => $v) {
                if (strcmp($val['idkegiatan'], $v['idkegiatan']) == 0) {
                    $this->data['TotalKegiatan'][$key]['BookAvailable'] = (int)$trainer - (int)$v['jumlah'];
                    $k = $k - 1;
                    break;
                }
            }
            $k = $k + $trainer;
        }
        $this->data['CountKegiatan'] = $k;
        $this->load->view('admin/kegiatan/AdminKegiatan', $this->data);
    }

    public function adminlihatkegiatan()
    {
        $this->data['Kegiatan'] = $this->koneksi->FetchAll("SELECT * FROM `kegiatan`");
        $this->load->view('admin/kegiatan/AdminLihatKegiatan', $this->data);
    }

    public function detailprofilpegawai($domain, $id)
    {
        switch ($domain) {
            case 'delete':
                $kueripegawai = DeleteBuilder('petugas', array('idpetugas' => $id));
                $idpetugas = $this->koneksi->Save($kueripegawai, array($id));
                redirect('/administrator/adminlihatpegawai/success');
                break;
            case 'update':
                $result = $this->koneksi->FetchAll("SELECT * FROM `petugas` WHERE idpetugas = " . $id);
                $this->data['Pegawai'] = $result[0];
                $this->load->view('admin/pegawai/AdminUpdatePegawai', $this->data);
                break;
            case 'view':
                $result = $this->koneksi->FetchAll("SELECT * FROM `petugas` WHERE idpetugas = " . $id);
                $this->data['Pegawai'] = $result[0];
                $this->load->view('admin/pegawai/AdminProfilPegawai', $this->data);
                break;
        }
    }

    public function adminUpdatePegawai()
    {

        $submit = $this->input->post('submit');

        if (isset($submit)) {
            $id = $this->input->post('idpetugas');
            $nama = $this->input->post('nama');
            $alamat = $this->input->post('alamat');
            $tglLahir = $this->input->post('tglLahir');
            $tglLahir = date("Y-m-d", strtotime($tglLahir));
            $jenisKelamin = $this->input->post('jenisKelamin');
            $notelp = $this->input->post('notelp');
            $email = $this->input->post('email');
            $status = $this->input->post('status');
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            $queryakun = UpdateBuilder('petugas',
                array(
                    'idpetugas' => $id,
                ),
                array(
                    'idpetugas' => $id,
                    'nama' => $nama,
                    'alamat' => $alamat,
                    'tglLahir' => $tglLahir,
                    'jenisKelamin' => $jenisKelamin,
                    'notelp' => $notelp,
                    'email' => $email,
                    'status' => $status,
                    'username' => $username,
                    'password' => $password
                )
            );

            $idpetugas = $this->koneksi->Save($queryakun, array(
                $id, $nama, $alamat, $tglLahir, $jenisKelamin, $notelp, $email, $status, $username, $password
            ));

            if ($idpetugas == 0) {
                redirect('/administrator/adminlihatpegawai/success');
            } else {
                echo 'failed';
            }
        }
    }

    public function detailprofilmember($domain, $id)
    {
        switch ($domain) {
            case 'delete':
                $queryakun = DeleteBuilder('tamu', array('idtamu' => $id));
                $idtamu = $this->koneksi->Save($queryakun, array($id));
                redirect('/administrator/adminlihatakun/success');
                break;
            case 'update':
                $result = $this->koneksi->FetchAll("SELECT * FROM `tamu` WHERE idtamu = " . $id);
                $this->data['Member'] = $result[0];
                $this->load->view('admin/tamu/AdminUpdateAkun', $this->data);
                break;
            case 'view':
                $result = $this->koneksi->FetchAll("SELECT * FROM `tamu` WHERE idtamu = " . $id);
                $this->data['Member'] = $result[0];
                $this->load->view('admin/tamu/DetailProfilMember', $this->data);
                break;
        }
    }

    public function adminUpdateAkun()
    {

        $submit = $this->input->post('submit');

        if (isset($submit)) {
            $id = $this->input->post('idtamu');
            $nama = $this->input->post('nama');
            $tglLahir = $this->input->post('tanggallahir');
            $tglLahir = date("Y-m-d", strtotime($tglLahir));
            $jeniskelamin = $this->input->post('jeniskelamin');
            $alamat = $this->input->post('alamat');
            $email = $this->input->post('email');
            $notelp = $this->input->post('notelp');
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            $queryakun = UpdateBuilder('tamu',
                array(
                    'idtamu' => $id,
                ),
                array(
                    'nama' => $nama,
                    'tanggallahir' => $tglLahir,
                    'jeniskelamin' => $jeniskelamin,
                    'alamat' => $alamat,
                    'email' => $email,
                    'notelp' => $notelp,
                    'username' => $username,
                    'password' => $password
                )
            );

            $idtamu = $this->koneksi->Save($queryakun, array(
                $id,
                $nama,
                $tglLahir,
                $jeniskelamin,
                $alamat,
                $email,
                $notelp,
                $username,
                $password
            ));

            if ($idtamu == 0) {
                redirect('/administrator/adminlihatakun/success');
            } else {
                echo 'failed';
            }
        }
    }

    public function adminTambahKegiatan()
    {
        $submit = $this->input->post('submit');
        if (isset($submit)) {
            $nama = $this->input->post('nama');
            $pesertamin = $this->input->post('pesertamin');
            $pesertamax = $this->input->post('pesertamax');
            $harga = $this->input->post('harga');
            $keterangan = $this->input->post('keterangan');

            $query = InsertBuilder('kegiatan', array(
                'nama' => $nama,
                'pesertamin' => $pesertamin,
                'pesertamax' => $pesertamax,
                'harga' => $harga,
                'keterangan' => $keterangan
            ));
            $result = $this->koneksi->Save($query,
                array($nama, $pesertamin, $pesertamax, $harga, $keterangan));

            redirect('/administrator/adminlihatkegiatan/success');


        }
        $this->load->view('admin/kegiatan/AdminTambahKegiatan', $this->data);
    }

    public function detailkegiatan($domain, $id)
    {
        switch ($domain) {
            case 'delete':
                $kuerikegiatan = DeleteBuilder('kegiatan', array('idkegiatan' => $id));
                $idkegiatan = $this->koneksi->Save($kuerikegiatan, array($id));
                redirect('/administrator/adminlihatkegiatan/success');
                break;
            case 'update':
                $result = $this->koneksi->FetchAll("SELECT * FROM `kegiatan` WHERE idkegiatan = " . $id);
                $this->data['Kegiatan'] = $result[0];
                $this->load->view('admin/kegiatan/AdminUpdateKegiatan', $this->data);
                break;
            case 'view':
                $result = $this->koneksi->FetchAll("SELECT * FROM `kegiatan` WHERE idkegiatan = " . $id);
                $this->data['Kegiatan'] = $result[0];
                $this->load->view('admin/kegiatan/AdminKegiatanDetail', $this->data);
                break;
        }
    }

    public function adminupdatekegiatan()
    {
        $submit = $this->input->post('submit');

        if (isset($submit)) {
            $id = $this->input->post('idkegiatan');
            $nama = $this->input->post('nama');
            $pesertamin = $this->input->post('pesertamin');
            $pesertamax = $this->input->post('pesertamax');
            $keterangan = $this->input->post('keterangan');
            $harga = $this->input->post('harga');

            $queryakun = UpdateBuilder('kegiatan',
                array(
                    'idkegiatan' => $id,
                ),
                array(
                    'idkegiatan' => $id,
                    'nama' => $nama,
                    'pesertamin' => $pesertamin,
                    'pesertamax' => $pesertamax,
                    'keterangan' => $keterangan,
                    'harga' => $harga,
                )
            );

            $idtamu = $this->koneksi->Save($queryakun, array(
                $id,
                $nama,
                $pesertamin,
                $pesertamax,
                $keterangan,
                $harga,
            ));

            if ($idtamu == 0) {
                redirect('/administrator/adminlihatkegiatan/success');
            } else {
                echo 'failed';
            }
        }
    }


    public function adminakomodasi()
    {

        $this->data['SisaAkomodasi'] = $this->koneksi->FetchAll("SELECT * FROM `pesananakomodasi`
        WHERE tanggal = now();");
        $this->data['TotalAkomodasi'] = $this->koneksi->FetchAll("SELECT * FROM `akomodasi`");

        $i = 0;
        foreach ($this->data['TotalAkomodasi'] as $key => $val) {
            foreach ($this->data['SisaAkomodasi'] as $k => $v) {
                if (strcmp($val['idakomodasi'], $v['idakomodasi']) == 0) {
                    $this->data['TotalAkomodasi'][$key]['BookAvailable'] = false;
                    $i = $i - 1;
                    break;
                } else {
                    $this->data['TotalAkomodasi'][$key]['BookAvailable'] = true;
                }
            }
            $i = $i + 1;
        }
        $this->data['CountAkomodasi'] = $i;

        $this->load->view('admin/akomodasi/AdminAkomodasi', $this->data);
    }

    public function detailakomodasi($domain, $id)
    {
        $submit = $this->input->post('submit');

        if (isset($submit)) {
            $namafile = $_FILES['fotoakomodasi']['name'];
            $ekstensifile = $_FILES['fotoakomodasi']['type'];
            $filedata = $_FILES['fotoakomodasi']['tmp_name'];
            $error = $_FILES['fotoakomodasi']['error'];
            $size = $_FILES['fotoakomodasi']['size'];

            if ($error == 0) {
                $queryfoto = InsertBuilder('fotoakomodasi', array(
                    'idakomodasi' => $id,
                    'namafile' => $namafile,
                    'ekstensifile' => $ekstensifile,
                    'filedata' => $filedata
                ));
                $this->koneksi->Save($queryfoto, array(
                    $id,
                    $namafile,
                    $ekstensifile,
                    file_get_contents($filedata)
                ));

            }
        }

        switch ($domain) {
            case 'delete':
                $kueriakomodasi = DeleteBuilder('akomodasi', array('idakomodasi' => $id));
                $idakomodasi = $this->koneksi->Save($kueriakomodasi, array($id));
                redirect('/administrator/adminlihatakomodasi/success');
                break;
            case 'update':
                $result = $this->koneksi->FetchAll("SELECT * FROM `akomodasi` WHERE idakomodasi = " . $id);
                $this->data['Akomodasi'] = $result[0];
                $this->load->view('admin/akomodasi/AdminUpdateAkomodasi', $this->data);
                break;
            case 'view':
                $result = $this->koneksi->FetchAll("SELECT * FROM `akomodasi` WHERE idakomodasi = " . $id);
                $size = $this->koneksi->FetchAll("select namafile from fotoakomodasi where idakomodasi = $id");
                $this->data['Size'] = $size;
                $this->data['Akomodasi'] = $result[0];
                $this->load->view('admin/akomodasi/AdminAkomodasiDetail', $this->data);
                break;
        }
    }

    public function adminupdateakomodasi()
    {
        $submit = $this->input->post('submit');
        if (isset($submit)) {
            $idakomodasi = $this->input->post('idakomodasi');
            $nama = $this->input->post('nama');
            $keterangan = $this->input->post('keterangan');
            $kapasitas = $this->input->post('kapasitas');
            $status = $this->input->post('status');
            $harga = $this->input->post('harga');

            $builder = UpdateBuilder('akomodasi',
                array('idakomodasi' => $idakomodasi),
                array(
                    'idakomodasi' => $idakomodasi,
                    'nama' => $nama,
                    'keterangan' => $keterangan,
                    'kapasitas' => $kapasitas,
                    'status' => $status,
                    'harga' => $harga
                )
            );

            $idupdate = $this->koneksi->Save($builder, array($idakomodasi, $nama, $keterangan, $kapasitas, $status, $harga));
            if ($idupdate == 0)
                redirect('/administrator/adminlihatakomodasi/success');
            else
                echo 'update gagal';
        }
    }

    public function adminlihatakomodasi()
    {
        $this->data['Akomodasi'] = $this->koneksi->FetchAll("SELECT * FROM `akomodasi`");
        $this->load->view('admin/akomodasi/AdminLihatAkomodasi', $this->data);
    }

    public function admintambahakomodasi()
    {
        $submit = $this->input->post('submit');

        if (isset($submit)) {
            $nama = $this->input->post('nama');
            $keterangan = $this->input->post('keterangan');
            $kapasitas = $this->input->post('kapasitas');
            $status = $this->input->post('status');
            $harga = $this->input->post('harga');

            /*
            $namafile = $_FILES['fotoakomodasi']['name'];
            $ekstensifile = $_FILES['fotoakomodasi']['type'];
            $filedata = $_FILES['fotoakomodasi']['tmp_name'];
            $error = $_FILES['fotoakomodasi']['error'];
            $size = $_FILES['fotoakomodasi']['size'];
            */

            $query = InsertBuilder('akomodasi', array(
                'nama' => $nama,
                'keterangan' => $keterangan,
                'kapasitas' => $kapasitas,
                'status' => $status,
                'harga' => $harga,
            ));

            $result = $this->koneksi->Save($query,
                array($nama, $keterangan, $kapasitas, $status, $harga));

            redirect('/administrator/adminlihatakomodasi/success');
        }
        $this->load->view('admin/akomodasi/AdminTambahAkomodasi', $this->data);
    }

    public function adminmakanan()
    {
        $this->data['SisaMakanan'] = $this->koneksi->FetchAll("SELECT (1000 - sum(IFNULL(porsi,0))) as sisa FROM `pesananmakanan`
        WHERE tanggalpemesanan = now() GROUP BY tanggalpemesanan;");
        if (sizeof($this->data['SisaMakanan']) == 0)
            $this->data['SisaMakanan'] = 1000;
        else
            $this->data['SisaMakanan'] = $this->data['SisaMakanan'][0]['sisa'];

        $this->load->view('admin/makanan/AdminMakanan', $this->data);
    }

    public function admintambahtipemakanan()
    {
        $submit = $this->input->post('submit');
        if (isset($submit)) {
            $idtipemakanan = $this->input->post('idtipemakanan');
            $idtipemakanan = strtoupper($idtipemakanan);
            $keterangan = $this->input->post('keterangan');
            $harga = $this->input->post('harga');

            $query = InsertBuilder('tipemakanan', array(
                'idtipemakanan' => $idtipemakanan,
                'keterangan' => $keterangan,
                'harga' => $harga
            ));
            $result = $this->koneksi->Save($query, array($idtipemakanan, $keterangan, $harga));

            redirect('/administrator/adminlihattipemakanan/success');

        }

        $this->load->view('admin/makanan/AdminTambahTipeMakanan', $this->data);
    }

    public function adminPeralatan()
    {
        $this->data['SisaPeralatan'] = $this->koneksi->FetchAll("SELECT p.*, (p.jumlah - pn.jumlah) AS sisajumlah
                FROM peralatan p LEFT JOIN pesananperalatan pn USING (idperalatan)
                WHERE pn.tanggal = now() GROUP BY pn.tanggal;");
        $this->data['TotalPeralatan'] = $this->koneksi->FetchAll("SELECT * FROM `peralatan`");

        $j = 0;
        foreach ($this->data['TotalPeralatan'] as $key => $val) {
            foreach ($this->data['SisaPeralatan'] as $k => $v) {
                if (strcmp($val['idperalatan'], $v['idperalatan']) == 0) {
                    $this->data['TotalPeralatan'][$key]['BookAvailable'] = (int)$v['sisajumlah'];
                    $j = $j - 1;
                    break;
                }
            }
            $j = $j + $val['jumlah'];
        }
        $this->data['CountPeralatan'] = $j;

        $this->load->view('admin/peralatan/AdminPeralatan', $this->data);
    }

    public function adminLihatPeralatan()
    {
        $this->data['Peralatan'] = $this->koneksi->FetchAll("SELECT * FROM `peralatan`");
        $this->load->view('admin/peralatan/AdminLihatPeralatan', $this->data);
    }

    public function adminTambahPeralatan()
    {
        $submit = $this->input->post('submit');

        if (isset($submit)) {
            $nama = $this->input->post('nama');
            $hargasewa = $this->input->post('hargasewa');
            $keterangan = $this->input->post('keterangan');
            $jumlah = $this->input->post('jumlah');

            $query = InsertBuilder('peralatan', array(
                'nama' => $nama,
                'hargasewa' => $hargasewa,
                'keterangan' => $keterangan,
                'jumlah' => $jumlah
            ));
            $result = $this->koneksi->Save($query, array($nama, $hargasewa, $keterangan, $jumlah));

            if ($result) {
                redirect('/administrator/adminlihatperalatan/success');
            } else {
                // pesan gagal
            }

        }

        $this->load->view('admin/peralatan/AdminTambahPeralatan', $this->data);
    }

    public function detailPeralatan($domain, $id)
    {
        switch ($domain) {
            case 'delete':
                $kueriakomodasi = DeleteBuilder('peralatan', array('idperalatan' => $id));
                $idakomodasi = $this->koneksi->Save($kueriakomodasi, array($id));
                redirect('/administrator/adminlihatperalatan/success');
                break;
            case 'update':
                $result = $this->koneksi->FetchAll("SELECT * FROM `peralatan` WHERE idperalatan = " . $id);
                $this->data['Peralatan'] = $result[0];
                $this->load->view('admin/peralatan/AdminUpdatePeralatan', $this->data);
                break;
            case 'view':
                $result = $this->koneksi->FetchAll("SELECT * FROM `peralatan` WHERE idperalatan = " . $id);
                $this->data['Peralatan'] = $result[0];
                $this->load->view('admin/peralatan/AdminPeralatanDetail', $this->data);
                break;
        }
    }

    public function adminUpdatePeralatan()
    {
        $submit = $this->input->post('submit');

        if (isset($submit)) {

            $idperalatan = $this->input->post('idperalatan');
            $nama = $this->input->post('nama');
            $hargasewa = $this->input->post('hargasewa');
            $keterangan = $this->input->post('keterangan');
            $jumlah = $this->input->post('jumlah');

            $builder = UpdateBuilder('peralatan',
                array('idperalatan' => $idperalatan),
                array(
                    'idperalatan' => $idperalatan,
                    'nama' => $nama,
                    'hargasewa' => $hargasewa,
                    'keterangan' => $keterangan,
                    'jumlah' => $jumlah,
                )
            );

            $this->koneksi->Save($builder, array($idperalatan, $nama, $hargasewa, $keterangan, $jumlah));

            redirect('/administrator/adminlihatperalatan/success');
        }
    }

    #region pemesanan
    public function adminlihatpesanan()
    {
        $this->data['Pesanan'] = $this->koneksi->FetchAll("SELECT psn.*, t.nama as namatamu FROM pemesanan psn
        LEFT JOIN tamu t USING (idtamu) ORDER BY tanggalpesan ASC;");

        $this->load->view('admin/pesanan/AdminListPesanan', $this->data);
    }

    public function adminkonfirmasipembayaran()
    {
        $this->data['Pesanan'] = $this->koneksi->FetchAll("SELECT psn.*, t.nama as namatamu FROM pemesanan psn
        LEFT JOIN tamu t USING (idtamu) WHERE psn.status IN ('DP') ORDER BY tanggalpesan ASC;");

        $this->load->view('admin/pesanan/AdminKonfirmasiPembayaran', $this->data);
    }

    public function adminkonfirmasipesanan()
    {

        $this->data['Pesanan'] = $this->koneksi->FetchAll(
            "SELECT psn.*, t.nama as namatamu FROM pemesanan psn
            LEFT JOIN pembayaran p using (idpemesanan)
            LEFT JOIN tamu t USING (idtamu)
            WHERE psn.status IN ('CHECKOUT')
            AND p.idpembayaran IS NOT NULL AND p.ekstensifile <> ''
            GROUP BY psn.idpemesanan
            ORDER BY tanggalpesan ASC;"
        );

        $this->load->view('admin/pesanan/AdminKonfirmasiPesanan', $this->data);
    }
    #end region pemesanan

    #region detail
    public function adminPemesananDetail($idpesanan = 0)
    {

        if (!isset($idpesanan)) {
            redirect('administrator/adminlihatpesanan');
        }

        $this->data['id'] = $idpesanan;
        $this->data['Akomodasi'] = $this->koneksi->FetchAll('SELECT p.idpesananakomodasi as did, a.*, p.tanggal, p.jumlahtamu, p.keterangan as ket
        FROM pesananakomodasi p
        LEFT JOIN akomodasi a USING (idakomodasi) WHERE p.idpemesanan = ' . $idpesanan);
        $this->data['Makanan'] = $this->koneksi->FetchAll('SELECT pm.idpesananmakanan as did, t.harga, t.idtipemakanan, t.keterangan as kettipe,
        m.keterangan as ketmenu, pm.* FROM pesananmakanan pm
        LEFT JOIN menumakanan m USING (idmenumakanan)
        LEFT JOIN tipemakanan t ON (m.idtipemakanan = t.idtipemakanan)
        WHERE pm.idpemesanan = ' . $idpesanan);
        $this->data['Peralatan'] = $this->koneksi->FetchAll('SELECT pn.idpesananperalatan as did, p.*, pn.jumlah as jumlahdisewa, pn.keterangan as ket,
        pn.tanggal FROM pesananperalatan pn LEFT JOIN peralatan p using (idperalatan)
        WHERE pn.idpemesanan = ' . $idpesanan);
        $this->data['Kegiatan'] = $this->koneksi->FetchAll('SELECT k.*, pn.idpesanankegiatan as did, pn.idpetugas, pn.jumlahpeserta,
        pn.tanggal, pn.keterangan as ket
        FROM pesanankegiatan pn LEFT JOIN kegiatan k USING (idkegiatan)
        WHERE idpemesanan = ' . $idpesanan);

        $tamu = $this->koneksi->FetchAll('SELECT t.* FROM pemesanan p
        LEFT JOIN tamu t USING (idtamu)
        WHERE p.idpemesanan = ' . $idpesanan);
        $this->data['Tamu'] = $tamu[0];

        $pesan = $this->koneksi->FetchAll('SELECT * FROM pemesanan WHERE idpemesanan = ' . $idpesanan);
        $this->data['Pesanan'] = $pesan[0];

        $bayar = $this->koneksi->FetchAll("SELECT * FROM pembayaran WHERE idpemesanan = $idpesanan
        AND bukti IS NOT NULL and ekstensifile <> ''
        UNION SELECT * FROM pembayaran WHERE idpemesanan = $idpesanan AND metodepembayaran IN ('ADMINCASH', 'DOKU WALLET')");
        $this->data['Pembayaran'] = $bayar;

        $this->load->view('admin/pesanan/AdminPemesananDetail', $this->data);
    }

    public function adminKonfirmasiPesananDetail($idpesanan = 0)
    {

        if (!isset($idpesanan)) {
            redirect('administrator/adminkonfirmasipesanan');
        }

        $this->data['id'] = $idpesanan;
        $this->data['Akomodasi'] = $this->koneksi->FetchAll('SELECT p.idpesananakomodasi as did, a.*, p.tanggal, p.jumlahtamu, p.keterangan as ket
        FROM pesananakomodasi p
        LEFT JOIN akomodasi a USING (idakomodasi) WHERE p.idpemesanan = ' . $idpesanan);
        $this->data['Makanan'] = $this->koneksi->FetchAll('SELECT pm.idpesananmakanan as did, t.harga, t.idtipemakanan, t.keterangan as kettipe,
        m.keterangan as ketmenu, pm.* FROM pesananmakanan pm
        LEFT JOIN menumakanan m USING (idmenumakanan)
        LEFT JOIN tipemakanan t ON (m.idtipemakanan = t.idtipemakanan)
        WHERE pm.idpemesanan = ' . $idpesanan);
        $this->data['Peralatan'] = $this->koneksi->FetchAll('SELECT pn.idpesananperalatan as did, p.*, pn.jumlah as jumlahdisewa, pn.keterangan as ket,
        pn.tanggal FROM pesananperalatan pn LEFT JOIN peralatan p using (idperalatan)
        WHERE pn.idpemesanan = ' . $idpesanan);
        $this->data['Kegiatan'] = $this->koneksi->FetchAll('SELECT k.*, pn.idpesanankegiatan as did, pn.idpetugas, pn.jumlahpeserta,
        pn.tanggal, pn.keterangan as ket
        FROM pesanankegiatan pn LEFT JOIN kegiatan k USING (idkegiatan)
        WHERE idpemesanan = ' . $idpesanan);

        $tamu = $this->koneksi->FetchAll('SELECT t.* FROM pemesanan p
        LEFT JOIN tamu t USING (idtamu)
        WHERE p.idpemesanan = ' . $idpesanan);
        $this->data['Tamu'] = $tamu[0];

        $pesan = $this->koneksi->FetchAll('SELECT * FROM pemesanan WHERE idpemesanan = ' . $idpesanan);
        $this->data['Pesanan'] = $pesan[0];

        $this->data['Pembayaran'] = $this->koneksi->FetchAll("SELECT * FROM pembayaran WHERE idpemesanan = $idpesanan
        AND bukti IS NOT NULL and ekstensifile <> ''
        UNION SELECT * FROM pembayaran WHERE idpemesanan = $idpesanan AND metodepembayaran IN ('ADMINCASH', 'DOKU WALLET')");

        $this->load->view('admin/pesanan/AdminKonfirmasiDetail', $this->data);
    }

    // todo kerjakan hari ini
    public function adminKonfirmasiPembayaranDetail($idpesanan = 0) {

        if (!isset($idpesanan)) {
            redirect('administrator/adminkonfirmasipesanan');
        }

        $this->data['id'] = $idpesanan;
        $this->data['Akomodasi'] = $this->koneksi->FetchAll('SELECT p.idpesananakomodasi as did, a.*, p.tanggal, p.jumlahtamu, p.keterangan as ket
        FROM pesananakomodasi p
        LEFT JOIN akomodasi a USING (idakomodasi) WHERE p.idpemesanan = ' . $idpesanan);
        $this->data['Makanan'] = $this->koneksi->FetchAll('SELECT pm.idpesananmakanan as did, t.harga, t.idtipemakanan, t.keterangan as kettipe,
        m.keterangan as ketmenu, pm.* FROM pesananmakanan pm
        LEFT JOIN menumakanan m USING (idmenumakanan)
        LEFT JOIN tipemakanan t ON (m.idtipemakanan = t.idtipemakanan)
        WHERE pm.idpemesanan = ' . $idpesanan);
        $this->data['Peralatan'] = $this->koneksi->FetchAll('SELECT pn.idpesananperalatan as did, p.*, pn.jumlah as jumlahdisewa, pn.keterangan as ket,
        pn.tanggal FROM pesananperalatan pn LEFT JOIN peralatan p using (idperalatan)
        WHERE pn.idpemesanan = ' . $idpesanan);
        $this->data['Kegiatan'] = $this->koneksi->FetchAll('SELECT k.*, pn.idpesanankegiatan as did, pn.idpetugas, pn.jumlahpeserta,
        pn.tanggal, pn.keterangan as ket
        FROM pesanankegiatan pn LEFT JOIN kegiatan k USING (idkegiatan)
        WHERE idpemesanan = ' . $idpesanan);

        $tamu = $this->koneksi->FetchAll('SELECT t.* FROM pemesanan p
        LEFT JOIN tamu t USING (idtamu)
        WHERE p.idpemesanan = ' . $idpesanan);
        $this->data['Tamu'] = $tamu[0];

        $pesan = $this->koneksi->FetchAll('SELECT * FROM pemesanan WHERE idpemesanan = ' . $idpesanan);
        $this->data['Pesanan'] = $pesan[0];

        $this->data['Pembayaran'] = $this->koneksi->FetchAll("SELECT * FROM pembayaran WHERE idpemesanan = $idpesanan
        AND bukti IS NOT NULL and ekstensifile <> ''
        UNION SELECT * FROM pembayaran WHERE idpemesanan = $idpesanan AND metodepembayaran IN ('ADMINCASH', 'DOKU WALLET')");

        $this->load->view('admin/pesanan/AdminPembayaranDetail', $this->data);
    }

    public function accPesanan($idpemesanan)
    {
        $pesan = $this->koneksi->FetchAll("SELECT a.*, IFNULL(SUM(b.nominal),0) terbayar, b.idpembayaran FROM pemesanan a
                LEFT JOIN pembayaran b ON (a.idpemesanan = b.idpemesanan)
                WHERE a.idpemesanan = $idpemesanan
                GROUP BY a.idpemesanan, b.idpemesanan;");
        $this->data['Pesanan'] = $pesan[0];

        $sqlupdate = UpdateBuilder('pemesanan',
            array(
                'idpemesanan' => $idpemesanan,
            ),
            array(
                'idpemesanan' => $idpemesanan,
                'status' => 'DP',
            )
        );

        $hasil = $this->koneksi->Save($sqlupdate, array(
            $idpemesanan,
            'DP'
        ));

        $sqlupdate = UpdateBuilder('pembayaran',
            array(
                'idpembayaran' => $pesan[0]['idpembayaran'],
                'idpemesanan' => $idpemesanan,
            ),
            array(
                'idpembayaran' => $pesan[0]['idpembayaran'],
                'idpemesanan' => $idpemesanan,
                'idpetugas' => $this->data['auth'],
            )
        );

        $hasil = $this->koneksi->Save($sqlupdate, array(
            'idpembayaran' => $pesan[0]['idpembayaran'],
            'idpemesanan' => $idpemesanan,
            'idpetugas' => $this->data['auth'],
        ));

        $datapemesan = $this->koneksi->FetchAll("SELECT * FROM pemesanan p
            LEFT JOIN tamu USING (idtamu)
            WHERE p.idpemesanan = $idpemesanan");
        $datapemesan = $datapemesan[0];
        $this->data['Pesanan'] = $datapemesan;

        include_once(APPPATH . 'third_party/phpmailer/PHPMailerAutoload.php');
        $this->load->library('mail');
        $data = array(
            "NAME" => $datapemesan['nama'],
            "EMAIL" => $datapemesan['email'],
            "DATE" => date('d F Y (H:i:s)'),
            "ID" => $idpemesanan,
        );

        $template_html = 'email_pembayaran1.html';

        // todo : activate on production
        $mail = new Mail();
        $mail->setMailBody($data, $template_html);
        $mail->sendMail('Pembayaran 1 berhasil diprosess', $datapemesan['email']);

        $tamu = $this->koneksi->FetchAll('SELECT t.* FROM pemesanan p
        LEFT JOIN tamu t USING (idtamu)
        WHERE p.idpemesanan = ' . $idpemesanan);
        $this->data['Tamu'] = $tamu[0];

        $pesan = $this->koneksi->FetchAll('SELECT * FROM pemesanan WHERE idpemesanan = ' . $idpemesanan);
        $this->data['Pesanan'] = $pesan[0];

        $this->load->view('admin/pesanan/AdminApprovePesanan', $this->data);
    }

    public function cancelPembayaran($idpemesanan) {
        $pesan = $this->koneksi->FetchAll("SELECT a.*, IFNULL(SUM(b.nominal),0) terbayar, b.idpembayaran FROM pemesanan a
                LEFT JOIN pembayaran b ON (a.idpemesanan = b.idpemesanan)
                WHERE a.idpemesanan = $idpemesanan
                GROUP BY a.idpemesanan, b.idpemesanan;");
        $this->data['Pesanan'] = $pesan[0];

        $sqldelete = UpdateBuilder('pembayaran',
            array(
                'idpembayaran' => $pesan[0]['idpembayaran'],
                'idpemesanan' => $idpemesanan,
            ),
            array(
                'idpembayaran' => $pesan[0]['idpembayaran'],
                'idpemesanan' => $idpemesanan,
                'bukti' => '',
                'ekstensifile' => '',
            )
        );

        $hasil = $this->koneksi->Save($sqldelete,
            array(
                'idpembayaran' => $pesan[0]['idpembayaran'],
                'idpemesanan' => $idpemesanan,
                'bukti' => '',
                'ekstensifile' => '',
            ));

        $datapemesan = $this->koneksi->FetchAll("SELECT * FROM pemesanan p
            LEFT JOIN tamu USING (idtamu)
            WHERE p.idpemesanan = $idpemesanan");
        $datapemesan = $datapemesan[0];

        $this->data['Pesanan'] = $datapemesan[0];

        //todo : sendmail rekonfirmasi
        include_once(APPPATH . 'third_party/phpmailer/PHPMailerAutoload.php');
        $this->load->library('mail');
        $data = array(
            "NAME" => $datapemesan['nama'],
            "EMAIL" => $datapemesan['email'],
            "DATE" => date('d F Y (H:i:s)'),
            "ID" => $idpemesanan,
        );

        $template_html = 'email_rekonfirmasi.html';

        // todo : activate on production
        $mail = new Mail();
        $mail->setMailBody($data, $template_html);
        $mail->sendMail('Pesanan ' . $idpemesanan . ' gagal diprosess', $datapemesan['email']);

        redirect('administrator/adminkonfirmasipesanan');
    }

    public function pembayaranPesanan() {
        $idpesanan = null;
        $submit = $this->input->post('submit');
        if (isset($submit)) {
            $idpesanan = $this->input->post('idpesanan');
            $sisapembayaran = $this->input->post('sisapembayaran');

            $pesan = $this->koneksi->FetchAll("SELECT a.*, IFNULL(SUM(b.nominal),0) terbayar, b.idpembayaran FROM pemesanan a
                LEFT JOIN pembayaran b ON (a.idpemesanan = b.idpemesanan)
                WHERE a.idpemesanan = $idpesanan
                GROUP BY a.idpemesanan, b.idpemesanan;");
            $this->data['Pesanan'] = $pesan[0];

            if($sisapembayaran > 0) {
                $sqlinsert = InsertBuilder('pembayaran',
                    array(
                        'idpemesanan' => $idpesanan,
                        'idpetugas' => $this->data['auth'],
                        'nominal' => $sisapembayaran,
                        'metodepembayaran' => 'ADMINCASH'
                    )
                );

                $hasil = $this->koneksi->Save($sqlinsert, array(
                    'idpemesanan' => $idpesanan,
                    'idpetugas' => $this->data['auth'],
                    'nominal' => $sisapembayaran,
                    'metodepembayaran' => 'ADMINCASH'
                ));
            } else {
                $sqlupdate = UpdateBuilder('pembayaran',
                    array(
                        'idpembayaran' => $pesan[0]['idpembayaran'],
                        'idpemesanan' => $idpesanan,
                    ),
                    array(
                        'idpembayaran' => $pesan[0]['idpembayaran'],
                        'idpemesanan' => $idpesanan,
                        'idpetugas' => $this->data['auth'],
                    )
                );

                $hasil = $this->koneksi->Save($sqlupdate, array(
                    'idpembayaran' => $pesan[0]['idpembayaran'],
                    'idpemesanan' => $idpesanan,
                    'idpetugas' => $this->data['auth'],
                ));
            }

            $sqlupdate = UpdateBuilder('pemesanan',
                array(
                    'idpemesanan' => $idpesanan,
                ),
                array(
                    'idpemesanan' => $idpesanan,
                    'status' => 'LUNAS',
                )
            );

            $hasil = $this->koneksi->Save($sqlupdate, array(
                $idpesanan,
                'LUNAS'
            ));
        }

        redirect('administrator/adminkonfirmasipembayarandetail/' . $idpesanan);

    }

    public function invoice($idp)
    {
        if (!isset($idp)) {
            $idpesanan = $this->session->userdata('pesanan');
        } else {
            $idpesanan = $idp;
        }

        if (!isset($idpesanan)) {
            redirect('/pesan/');
        }

        if (!is_numeric($idpesanan))
            redirect('/pesan/');

        $this->data['id'] = $idpesanan;

        $tamu = $this->koneksi->FetchAll("SELECT * FROM pemesanan p
        LEFT JOIN tamu t USING (idtamu)
        WHERE p.idpemesanan = $idpesanan");
        $this->data['Tamu'] = $tamu[0];

        $status = (strcasecmp($tamu[0]['status'], 'LUNAS') == 0);
        $status2 = (strcasecmp($tamu[0]['status'], 'DP') == 0);
        if (!$status && !$status2) {
            redirect('/pesan/');
        }

        $this->data['Akomodasi'] = $this->koneksi->FetchAll('SELECT p.idpesananakomodasi as did, a.*, p.tanggal, p.jumlahtamu, p.keterangan as ket
        FROM pesananakomodasi p
        LEFT JOIN akomodasi a USING (idakomodasi) WHERE p.idpemesanan = ' . $idpesanan);
        $this->data['Makanan'] = $this->koneksi->FetchAll('SELECT pm.idpesananmakanan as did, t.harga, t.idtipemakanan, t.keterangan as kettipe,
        m.keterangan as ketmenu, pm.* FROM pesananmakanan pm
        LEFT JOIN menumakanan m USING (idmenumakanan)
        LEFT JOIN tipemakanan t ON (m.idtipemakanan = t.idtipemakanan)
        WHERE pm.idpemesanan = ' . $idpesanan);
        $this->data['Peralatan'] = $this->koneksi->FetchAll('SELECT pn.idpesananperalatan as did, p.*, pn.jumlah as jumlahdisewa, pn.keterangan as ket,
        pn.tanggal FROM pesananperalatan pn LEFT JOIN peralatan p using (idperalatan)
        WHERE pn.idpemesanan = ' . $idpesanan);
        $this->data['Kegiatan'] = $this->koneksi->FetchAll('SELECT k.*, pn.idpesanankegiatan as did, pn.idpetugas, pn.jumlahpeserta,
        pn.tanggal, pn.keterangan as ket
        FROM pesanankegiatan pn LEFT JOIN kegiatan k USING (idkegiatan)
        WHERE idpemesanan = ' . $idpesanan);

        $totalHarga = 0;
        foreach ($this->data['Akomodasi'] as $value) {
            $totalHarga += $value['harga'];
        }
        foreach ($this->data['Makanan'] as $value) {
            $totalHarga += ($value['harga'] * $value['porsi']);
        }
        foreach ($this->data['Peralatan'] as $value) {
            $totalHarga += ($value['hargasewa'] * $value['jumlahdisewa']);
        }
        foreach ($this->data['Kegiatan'] as $value) {
            $totalHarga += ($value['harga'] * $value['jumlahpeserta']);
        }
        $this->data['Total'] = $totalHarga;

        $pesan = $this->koneksi->FetchAll('SELECT * FROM pemesanan WHERE idpemesanan = ' . $idpesanan);
        $this->data['Pesanan'] = $pesan[0];

        $this->data['Pembayaran'] = $this->koneksi->FetchAll("SELECT * FROM pembayaran WHERE idpemesanan = $idpesanan
        AND bukti IS NOT NULL and ekstensifile <> ''
        UNION SELECT * FROM pembayaran WHERE idpemesanan = $idpesanan AND metodepembayaran IN ('ADMINCASH','DOKU WALLET')");

        $this->load->view('admin/pesanan/AdminInvoicePesanan', $this->data);
    }
    #end region detail

    public function laporan(){
        $this->data['open'] = true;
        $this->load->view('admin/laporan/Laporan', $this->data);
    }
}