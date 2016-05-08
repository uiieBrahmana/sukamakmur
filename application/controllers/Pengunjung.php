<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengunjung extends CI_Controller
{

    private $data;

    public function __construct()
    {
        parent::__construct();

        $this->data['ID'] = $this->session->userdata('ID');
        $this->data['Role'] = $this->session->userdata('role');

        if (strcmp($this->data['Role'], 'Administrator') == 0) {
            redirect('Administrator/');
        }

        if (strcmp($this->data['Role'], 'Manager') == 0) {
            redirect('Administrator/');
        }

        $this->data['DateSearch'] = $this->session->userdata('DateSearch');
        if ($this->data['DateSearch'] == null) {
            $datenow = $begin = new DateTime('+1 day');
            $this->data['DateSearch'] = $datenow->format('d F Y');
        }
    }

    public function index()
    {
        $result = $this->koneksi->FetchAll("SELECT * FROM `akomodasi` WHERE idakomodasi = 2");
        $size = $this->koneksi->FetchAll("SELECT * FROM `fotoakomodasi` WHERE idakomodasi = 2");

        $this->data['Size'] = $size;
        $this->data['Akomodasi'] = $result[0];
        $this->load->view('tamu/Beranda', $this->data);
    }

    public function buatakun()
    {
        $this->data['reg'] = 'open';
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

            $this->koneksi->Save($queryakun, array(
                $nama,
                $tanggallahir,
                $jeniskelamin,
                $alamat,
                $email,
                $notelp,
                $username,
                $password
            ));
            $this->load->view('tamu/BerhasilBuatAkun', $this->data);
        } else {
            $this->load->view('tamu/BuatAkun', $this->data);
        }
    }

    public function akomodasi()
    {
        $dateSearch = $this->session->userdata('DateSearch');

        if (isset($dateSearch)) {
            $begin = new DateTime(date("Y-m-d", strtotime($dateSearch)));
        } else {
            $begin = new DateTime('+1 day');
        }

        $this->data['SisaAkomodasi'] = $this->koneksi->FetchAll("SELECT * FROM `pesananakomodasi`
        WHERE tanggal = STR_TO_DATE('" . $begin->format("d-m-Y") . "','%d-%m-%Y');");
        $this->data['TotalAkomodasi'] = $this->koneksi->FetchAll("SELECT * FROM `akomodasi`");

        $i = 0;
        foreach ($this->data['TotalAkomodasi'] as $key => $val) {
            $this->data['TotalAkomodasi'][$key]['BookAvailable'] = true;
            foreach ($this->data['SisaAkomodasi'] as $k => $v) {
                if (strcmp($val['idakomodasi'], $v['idakomodasi']) == 0) {
                    $this->data['TotalAkomodasi'][$key]['BookAvailable'] = false;
                    $i = $i - 1;
                    break;
                }
            }
            $i = $i + 1;
        }
        $this->data['CountAkomodasi'] = $i;

        $this->load->view('tamu/Akomodasi', $this->data);
    }

    public function makanan()
    {
        $dateSearch = $this->session->userdata('DateSearch');

        if (isset($dateSearch)) {
            $begin = new DateTime(date("Y-m-d", strtotime($dateSearch)));
        } else {
            $begin = new DateTime('+1 day');
        }

        $this->data['SisaMakanan'] = $this->koneksi->FetchAll("SELECT (1000 - sum(IFNULL(porsi,0))) as sisa FROM `pesananmakanan`
        WHERE tanggalpemesanan = STR_TO_DATE('" . $begin->format("d-m-Y") . "','%d-%m-%Y') GROUP BY tanggalpemesanan;");
        if (sizeof($this->data['SisaMakanan']) == 0)
            $this->data['SisaMakanan'] = 1000;
        else
            $this->data['SisaMakanan'] = $this->data['SisaMakanan'][0]['sisa'];

        $this->data['TipeMakanan'] = $this->koneksi->FetchAll("SELECT * FROM tipemakanan");
        foreach ($this->data['TipeMakanan'] as $key => $val) {
            $this->data['TipeMakanan'][$key]['MenuMakanan'] =
                $this->koneksi->FetchAll("SELECT * FROM menumakanan where idtipemakanan = '" . $val['idtipemakanan'] . "'");
        }

        $this->load->view('tamu/Makanan', $this->data);
    }

    public function peralatan()
    {
        $dateSearch = $this->session->userdata('DateSearch');

        if (isset($dateSearch)) {
            $begin = new DateTime(date("Y-m-d", strtotime($dateSearch)));
        } else {
            $begin = new DateTime('+1 day');
        }

        $this->data['SisaPeralatan'] = $this->koneksi->FetchAll("SELECT p.*, (p.jumlah - pn.jumlah) AS sisajumlah
                FROM peralatan p LEFT JOIN pesananperalatan pn USING (idperalatan)
                WHERE pn.tanggal = STR_TO_DATE('" . $begin->format("d-m-Y") . "','%d-%m-%Y')
                GROUP BY pn.tanggal;");
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

        $this->load->view('tamu/Peralatan', $this->data);
    }

    public function kegiatan()
    {

        $dateSearch = $this->session->userdata('DateSearch');

        if (isset($dateSearch)) {
            $begin = new DateTime(date("Y-m-d", strtotime($dateSearch)));
        } else {
            $begin = new DateTime('+1 day');
        }

        $this->data['SisaKegiatan'] = $this->koneksi->FetchAll("SELECT k.*, count(pk.tanggal) as jumlah from kegiatan k
                LEFT JOIN pesanankegiatan pk USING(idkegiatan)
                WHERE pk.tanggal = STR_TO_DATE('" . $begin->format("d-m-Y") . "','%d-%m-%Y')
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

        $this->load->view('tamu/Kegiatan', $this->data);
    }

    public function cari()
    {
        $dateSearch = $this->input->post('search');
        $begin = new DateTime(date("Y-m-d", strtotime($dateSearch)));
        $this->session->set_userdata('DateSearch', $dateSearch);
        $this->data['DateSearch'] = $dateSearch;

        $this->data['SisaMakanan'] = $this->koneksi->FetchAll("SELECT (1000 - sum(IFNULL(porsi,0))) as sisa FROM `pesananmakanan`
        WHERE tanggalpemesanan = STR_TO_DATE('" . $begin->format("d-m-Y") . "','%d-%m-%Y') GROUP BY tanggalpemesanan;");
        if (sizeof($this->data['SisaMakanan']) == 0)
            $this->data['SisaMakanan'] = 1000;
        else
            $this->data['SisaMakanan'] = $this->data['SisaMakanan'][0]['sisa'];

        $this->data['SisaAkomodasi'] = $this->koneksi->FetchAll("SELECT * FROM `pesananakomodasi`
        WHERE tanggal = STR_TO_DATE('" . $begin->format("d-m-Y") . "','%d-%m-%Y');");
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
                WHERE pn.tanggal = STR_TO_DATE('" . $begin->format("d-m-Y") . "','%d-%m-%Y')
                GROUP BY pn.tanggal;");
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
                WHERE pk.tanggal = STR_TO_DATE('" . $begin->format("d-m-Y") . "','%d-%m-%Y')
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

        $this->load->view('tamu/Pencarian', $this->data);
    }

    public function viewakomodasi($id = null)
    {
        if($id == null){
            redirect('pengunjung/');
        }

        $result = $this->koneksi->FetchAll("SELECT * FROM `akomodasi` WHERE idakomodasi = " . $id);
        $size = $this->koneksi->FetchAll("select namafile from fotoakomodasi where idakomodasi = $id");
        $this->data['Size'] = $size;
        $this->data['Akomodasi'] = $result[0];
        $this->load->view('tamu/ViewAkomodasi', $this->data);
    }

    public function ubahakun($idtamu)
    {
        if($idtamu == null) {
            redirect('pengunjung');
        }

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

            $queryakun = UpdateBuilder('tamu',
                array(
                    'idtamu' => $idtamu,
                ),
                array(
                    'idtamu' => $idtamu,
                    'nama' => $nama,
                    'tanggallahir' => $tanggallahir,
                    'jeniskelamin' => $jeniskelamin,
                    'alamat' => $alamat,
                    'email' => $email,
                    'notelp' => $notelp,
                    'username' => $username,
                    'password' => $password
            ));

            $this->koneksi->Save($queryakun, array(
                $idtamu,
                $nama,
                $tanggallahir,
                $jeniskelamin,
                $alamat,
                $email,
                $notelp,
                $username,
                $password
            ));

            $tamu = $this->koneksi->FetchAll("SELECT * FROM `tamu` WHERE idtamu = " . $idtamu);
            $this->data['Member'] = $tamu[0];
            redirect('pengunjung/ubahakun/' . $idtamu . '/success');
        } else {
            $tamu = $this->koneksi->FetchAll("SELECT * FROM `tamu` WHERE idtamu = " . $idtamu);
            $this->data['Member'] = $tamu[0];
            $this->load->view('tamu/UbahAkun', $this->data);
        }
    }
}
