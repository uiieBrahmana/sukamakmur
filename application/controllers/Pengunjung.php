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
}
