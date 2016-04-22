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

    public function pencarian()
    {
        $this->load->view('tamu/Pencarian', $this->data);
    }

    public function akomodasi()
    {
        $result = $this->koneksi->FetchAll("SELECT * FROM `akomodasi` WHERE idakomodasi = 2");
        $size = $this->koneksi->FetchAll("SELECT * FROM `fotoakomodasi` WHERE idakomodasi = 2");

        $this->data['Size'] = $size;
        $this->data['Akomodasi'] = $result[0];
        $this->load->view('tamu/Akomodasi', $this->data);
    }

    public function makanan()
    {
        $this->load->view('tamu/Makanan', $this->data);
    }

    public function peralatan()
    {
        $this->load->view('tamu/Peralatan', $this->data);
    }

    public function kegiatan()
    {
        $this->load->view('tamu/Kegiatan', $this->data);
    }

    public function cari()
    {
        $dateSearch = $this->input->post('search');
        $begin = new DateTime(date("Y-m-d", strtotime($dateSearch)));

        $this->data['SisaMakanan'] = $this->koneksi->FetchAll("SELECT (1000 - sum(IFNULL(porsi,0))) as sisa FROM `pesananmakanan`
        WHERE tanggalpemesanan = STR_TO_DATE('" . $begin->format("d-m-Y") . "','%d-%m-%Y') GROUP BY tanggalpemesanan;");
        if (sizeof($this->data['SisaMakanan']) == 0)
            $this->data['SisaMakanan'] = 1000;
        else
            $this->data['SisaMakanan'] = $this->data['SisaMakanan'][0]['sisa'];

        $this->data['SisaAkomodasi'] = $this->koneksi->FetchAll("SELECT * FROM `pesananakomodasi`
        WHERE tanggal = STR_TO_DATE('" . $begin->format("d-m-Y") . "','%d-%m-%Y');");
        $this->data['TotalAkomodasi'] = $this->koneksi->FetchAll("SELECT * FROM `akomodasi`");


        foreach ($this->data['TotalAkomodasi'] as $key => $val) {
            foreach ($this->data['SisaAkomodasi'] as $k => $v) {
                if (strcmp($val['idakomodasi'], $v['idakomodasi']) == 0) {
                    $this->data['TotalAkomodasi'][$key]['BookAvailable'] = false;
                    break;
                } else {
                    $this->data['TotalAkomodasi'][$key]['BookAvailable'] = true;
                }
            }
        }

        $this->data['SisaPeralatan'] = $this->koneksi->FetchAll("SELECT p.*, (p.jumlah - pn.jumlah) AS sisajumlah
                FROM peralatan p LEFT JOIN pesananperalatan pn USING (idperalatan)
                WHERE pn.tanggal = STR_TO_DATE('" . $begin->format("d-m-Y") . "','%d-%m-%Y')
                GROUP BY pn.tanggal;");
        $this->data['TotalPeralatan'] = $this->koneksi->FetchAll("SELECT * FROM `peralatan`");

        foreach ($this->data['TotalPeralatan'] as $key => $val) {
            foreach ($this->data['SisaPeralatan'] as $k => $v) {
                if (strcmp($val['idperalatan'], $v['idperalatan']) == 0) {
                    $this->data['TotalPeralatan'][$key]['BookAvailable'] = (int)$v['sisajumlah'];
                    break;
                }
            }
        }

        $this->data['SisaKegiatan'] = $this->koneksi->FetchAll("SELECT k.*, count(pk.tanggal) as jumlah from kegiatan k
                LEFT JOIN pesanankegiatan pk USING(idkegiatan)
                WHERE pk.tanggal = STR_TO_DATE('" . $begin->format("d-m-Y") . "','%d-%m-%Y')
                GROUP BY pk.tanggal, idkegiatan;");

        $train = $this->koneksi->FetchAll("SELECT ifnull(count(*),0) as pelatih FROM petugas WHERE status = 'Trainer'");
        $trainer = $train[0]['pelatih'];

        $this->data['TotalKegiatan'] = $this->koneksi->FetchAll("SELECT * FROM `kegiatan`");

        foreach ($this->data['TotalKegiatan'] as $key => $val) {
            foreach ($this->data['SisaKegiatan'] as $k => $v) {
                if (strcmp($val['idkegiatan'], $v['idkegiatan']) == 0) {
                    var_dump((int)$trainer, (int)$v['jumlah']);
                    $this->data['TotalKegiatan'][$key]['BookAvailable'] = (int)$trainer - (int)$v['jumlah'];
                    break;
                }
            }
        }

        $this->load->view('tamu/Pencarian', $this->data);
    }
}
