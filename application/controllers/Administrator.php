<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Administrator extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $auth = $this->session->userdata('ID');
        $role = $this->session->userdata('role');
        if (!isset($auth)) {
            redirect('/login/');
        }
        if (strcasecmp($role, 'Administrator') != 0) {
            redirect('/pengunjung/');
        }

    }

    public function index()
    {
        $this->load->view('admin/AdminBeranda');
    }

    public function admintambahpesanan()
    {

        $submit = $this->input->post('submit');

        if (isset($submit)) {
            var_dump($_POST);
        }

        $data['Tamu'] = $this->koneksi->FetchAll('SELECT * FROM TAMU');
        $data['Akomodasi'] = $this->koneksi->FetchAll('SELECT * FROM AKOMODASI');
        $data['MenuMakanan'] = $this->koneksi->FetchAll('SELECT * FROM MENUMAKANAN');
        $data['Peralatan'] = $this->koneksi->FetchAll('SELECT * FROM PERALATAN');
        $data['Kegiatan'] = $this->koneksi->FetchAll('SELECT * FROM KEGIATAN');
        $this->load->view('admin/pesanan/AdminTambahPesanan', $data);
    }

    public function adminlihatpesanan()
    {
        $data['Pesanan'] = $this->koneksi->FetchAll("SELECT psn.*, t.nama as namatamu FROM pemesanan psn
        LEFT JOIN tamu t USING (idtamu) ORDER BY tanggalpesan ASC;");

        $this->load->view('admin/pesanan/AdminListPesanan', $data);
    }

    public function adminpemesanandetail($idpesanan = 0)
    {

        if (!isset($idpesanan)) {
            redirect('administrator/adminlihatpesanan');
        }

        $data['id'] = $idpesanan;
        $data['Akomodasi'] = $this->koneksi->FetchAll('SELECT p.idpesananakomodasi as did, a.*, p.tanggal, p.jumlahtamu, p.keterangan as ket
        FROM PESANANAKOMODASI p
        LEFT JOIN AKOMODASI a USING (IDAKOMODASI) WHERE p.IDPEMESANAN = ' . $idpesanan);
        $data['Makanan'] = $this->koneksi->FetchAll('SELECT pm.idpesananmakanan as did, t.harga, t.idtipemakanan, t.keterangan as kettipe,
        m.keterangan as ketmenu, pm.* FROM PESANANMAKANAN pm
        LEFT JOIN MENUMAKANAN m USING (IDMENUMAKANAN)
        LEFT JOIN tipemakanan t ON (m.idtipemakanan = t.idtipemakanan)
        WHERE pm.IDPEMESANAN = ' . $idpesanan);
        $data['Peralatan'] = $this->koneksi->FetchAll('SELECT pn.idpesananperalatan as did, p.*, pn.jumlah as jumlahdisewa, pn.keterangan as ket,
        pn.tanggal FROM PESANANPERALATAN pn LEFT JOIN peralatan p using (idperalatan)
        WHERE pn.IDPEMESANAN = ' . $idpesanan);
        $data['Kegiatan'] = $this->koneksi->FetchAll('SELECT k.*, pn.idpesanankegiatan as did, pn.idpetugas, pn.jumlahpeserta,
        pn.tanggal, pn.keterangan as ket
        FROM PESANANKEGIATAN pn LEFT JOIN kegiatan k USING (idkegiatan)
        WHERE IDPEMESANAN = ' . $idpesanan);

        $tamu = $this->koneksi->FetchAll('SELECT t.* FROM pemesanan p
        LEFT JOIN tamu t USING (idtamu)
        WHERE p.idpemesanan = ' . $idpesanan);
        $data['Tamu'] = $tamu[0];

        $pesan = $this->koneksi->FetchAll('SELECT * FROM pemesanan WHERE idpemesanan = ' . $idpesanan);
        $data['Pesanan'] = $pesan[0];

        /*
        $totalHarga = 0;
        foreach ($data['Akomodasi'] as $value) {
            $totalHarga += $value['harga'];
        }
        foreach ($data['Makanan'] as $value) {
            $totalHarga += ($value['harga'] * $value['porsi']);
        }
        foreach ($data['Peralatan'] as $value) {
            $totalHarga += ($value['hargasewa'] * $value['jumlahdisewa']);
        }
        foreach ($data['Kegiatan'] as $value) {
            $totalHarga += ($value['harga'] * $value['jumlahpeserta']);
        }
        $data['Total'] = $totalHarga;
        */

        $this->load->view('admin/pesanan/AdminPemesananDetail', $data);
    }

    public function adminkonfirmasipembayaran()
    {
        $this->load->view('admin/pesanan/AdminKonfirmasiPembayaran');
    }

    public function adminkonfirmasipesanan()
    {
        $this->load->view('admin/pesanan/AdminKonfirmasiPesanan');
    }

    public function adminlihatlaporan()
    {
        $this->load->view('AdminLihatLaporan');
    }

    public function approvepembayaran()
    {
        $this->load->view('ApprovePembayaran');
    }

    public function adminlihatakun()
    {
        $data['Akun'] = $this->koneksi->FetchAll("SELECT * FROM `TAMU`");
        $this->load->view('admin/tamu/AdminLihatAkun', $data);
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
        $this->load->view('admin/tamu/AdminBuatAkun');
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
                // todo : join table
                $result = $this->koneksi->FetchAll("SELECT * FROM `menumakanan` WHERE idmenumakanan = " . $id);
                $data['TipeMakanan'] = $this->koneksi->FetchAll("SELECT * FROM TIPEMAKANAN");
                $data['Menumakanan'] = $result[0];
                $this->load->view('admin/makanan/AdminUpdateMakanan', $data);
                break;
            case 'view':
                // todo : join table
                $result = $this->koneksi->FetchAll("SELECT * FROM `menumakanan` WHERE idmenumakanan = " . $id);
                $data['Menumakanan'] = $result[0];
                $this->load->view('admin/makanan/AdminMakananDetail', $data);
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
        $data['TipeMakanan'] = $this->koneksi->FetchAll("SELECT * FROM TIPEMAKANAN");

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
        $this->load->view('admin/makanan/AdminTambahMakanan', $data);
    }

    public function adminlihatmakanan()
    {
        $data['MenuMakanan'] = $this->koneksi->FetchAll("SELECT * FROM `MenuMakanan`");
        $this->load->view('admin/makanan/AdminLihatMakanan', $data);
    }

    public function adminLihatTipeMakanan()
    {

        $data['TipeMakanan'] = $this->koneksi->FetchAll("SELECT * FROM `TIPEMAKANAN`");
        $this->load->view('admin/makanan/AdminLihatTipeMakanan', $data);
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
                $data['TipeMakanan'] = $result[0];
                $this->load->view('admin/makanan/AdminUpdateTipeMakanan', $data);
                break;
            case 'view':
                $result = $this->koneksi->FetchAll("SELECT * FROM `tipemakanan` WHERE idtipemakanan = '$id'");
                $data['TipeMakanan'] = $result[0];
                $this->load->view('admin/makanan/AdminTipeMakananDetail', $data);
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
        $data['Akun'] = $this->koneksi->FetchAll("SELECT * FROM `petugas`");
        $this->load->view('admin/pegawai/AdminLihatPegawai', $data);
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
        $this->load->view('admin/pegawai/AdminTambahPegawai');
    }

    public function adminKegiatan()
    {
        $this->load->view('admin/kegiatan/AdminKegiatan');
    }

    public function adminlihatkegiatan()
    {
        $data['Kegiatan'] = $this->koneksi->FetchAll("SELECT * FROM `kegiatan`");
        $this->load->view('admin/kegiatan/AdminLihatKegiatan', $data);
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
                $data['Pegawai'] = $result[0];
                $this->load->view('admin/pegawai/AdminUpdatePegawai', $data);
                break;
            case 'view':
                $result = $this->koneksi->FetchAll("SELECT * FROM `petugas` WHERE idpetugas = " . $id);
                $data['Pegawai'] = $result[0];
                $this->load->view('admin/pegawai/AdminProfilPegawai', $data);
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
                $data['Member'] = $result[0];
                $this->load->view('admin/tamu/AdminUpdateAkun', $data);
                break;
            case 'view':
                $result = $this->koneksi->FetchAll("SELECT * FROM `tamu` WHERE idtamu = " . $id);
                $data['Member'] = $result[0];
                $this->load->view('admin/tamu/DetailProfilMember', $data);
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
                $tanggallahir,
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

            $query = InsertBuilder('Kegiatan', array(
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
        $this->load->view('admin/kegiatan/AdminTambahKegiatan');
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
                $data['Kegiatan'] = $result[0];
                $this->load->view('admin/kegiatan/AdminUpdateKegiatan', $data);
                break;
            case 'view':
                $result = $this->koneksi->FetchAll("SELECT * FROM `kegiatan` WHERE idkegiatan = " . $id);
                $data['Kegiatan'] = $result[0];
                $this->load->view('admin/kegiatan/AdminKegiatanDetail', $data);
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
        $this->load->view('admin/akomodasi/AdminAkomodasi');
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
                $data['Akomodasi'] = $result[0];
                $this->load->view('admin/akomodasi/AdminUpdateAkomodasi', $data);
                break;
            case 'view':
                $result = $this->koneksi->FetchAll("SELECT * FROM `akomodasi` WHERE idakomodasi = " . $id);
                $size = $this->koneksi->FetchAll("select namafile from fotoakomodasi where idakomodasi = $id");
                $data['Size'] = $size;
                $data['Akomodasi'] = $result[0];
                $this->load->view('admin/akomodasi/AdminAkomodasiDetail', $data);
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
        $data['Akomodasi'] = $this->koneksi->FetchAll("SELECT * FROM `AKOMODASI`");
        $this->load->view('admin/akomodasi/AdminLihatAkomodasi', $data);
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

            $query = InsertBuilder('Akomodasi', array(
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
        $this->load->view('admin/akomodasi/AdminTambahAkomodasi');
    }

    public function adminmakanan()
    {
        $this->load->view('admin/makanan/AdminMakanan');
    }

    public function admintambahtipemakanan()
    {
        $submit = $this->input->post('submit');
        if (isset($submit)) {
            $idtipemakanan = $this->input->post('idtipemakanan');
            $keterangan = $this->input->post('keterangan');
            $harga = $this->input->post('harga');

            $query = InsertBuilder('TipeMakanan', array(
                'idtipemakanan' => $idtipemakanan,
                'keterangan' => $keterangan,
                'harga' => $harga
            ));
            $result = $this->koneksi->Save($query, array($idtipemakanan, $keterangan, $harga));

            redirect('/administrator/adminlihattipemakanan/success');

        }

        $this->load->view('admin/makanan/AdminTambahTipeMakanan');
    }

    public function adminPeralatan()
    {
        $this->load->view('admin/peralatan/AdminPeralatan');
    }

    public function adminLihatPeralatan()
    {
        $data['Peralatan'] = $this->koneksi->FetchAll("SELECT * FROM `PERALATAN`");
        $this->load->view('admin/peralatan/AdminLihatPeralatan', $data);
    }

    public function adminTambahPeralatan()
    {
        $submit = $this->input->post('submit');

        if (isset($submit)) {
            $nama = $this->input->post('nama');
            $hargasewa = $this->input->post('hargasewa');
            $keterangan = $this->input->post('keterangan');
            $jumlah = $this->input->post('jumlah');

            $query = InsertBuilder('Peralatan', array(
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

        $this->load->view('admin/peralatan/AdminTambahPeralatan');
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
                $data['Peralatan'] = $result[0];
                $this->load->view('admin/peralatan/AdminUpdatePeralatan', $data);
                break;
            case 'view':
                $result = $this->koneksi->FetchAll("SELECT * FROM `peralatan` WHERE idperalatan = " . $id);
                $data['Peralatan'] = $result[0];
                $this->load->view('admin/peralatan/AdminPeralatanDetail', $data);
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

}
