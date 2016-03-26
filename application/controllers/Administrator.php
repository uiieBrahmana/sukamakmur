<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Administrator extends CI_Controller
{
    public function index()
    {
        $this->load->view('AdminBeranda');
    }

    public function buatpesananfasilitas()
    {
        $this->load->view('BuatPesananFasilitas');
    }

    public function buatpesananfinish()
    {
        $this->load->view('BuatPesananFinish');
    }

    public function buatpesanankegiatan()
    {
        $this->load->view('BuatPesananKegiatan');
    }
    public function adminlihatakun()
    {
        $this->load->view('AdminLihatAkun');
    }

    public function adminbuatakun()
    {
        $this->load->view('AdminBuatAkun');
    }
    public function admintambahpesanan()
    {
        $this->load->view('AdminTambahPesanan');
    }
    public function adminlihatpesanan()
    {
        $this->load->view('AdminListPesanan');
    }
    public function adminkonfirmasipesanan()
    {
        $this->load->view('AdminKonfirmasiPesanan');
    }
    public function adminkonfirmasipembayaran()
    {
        $this->load->view('AdminKonfirmasiPembayaran');
    }
    public function admintambahmakanan()
    {
        $this->load->view('AdminTambahMakanan');
    }

    public function adminlihatmakanan()
    {
        $this->load->view('AdminLihatMakanan');
    }
    public function adminlihatpegawai()
    {
        $this->load->view('AdminLihatPegawai');
    }
    public function admintambahpegawai()
    {
        $this->load->view('AdminTambahPegawai');
    }

    public function adminlihatkegiatan()
    {
        $this->load->view('AdminLihatKegiatan');
    }
    public function admintambahkegiatan()
    {
        $this->load->view('AdminTambahKegiatan');
    }
    public function adminlihatlaporan()
    {
        $this->load->view('AdminLihatLaporan');
    }

    public function adminlihatpemesanan()
    {
        $this->load->view('AdminLihatPemesanan');
    }

    public function adminpemesanandetail()
    {
        $this->load->view('AdminPemesananDetail');
    }

    public function approvepembayaran()
    {
        $this->load->view('ApprovePembayaran');
    }
    public function adminakomodasi()
    {
        $this->load->view('AdminAkomodasi');
    }
    public function adminmakanan()
    {
        $this->load->view('AdminMakanan');
    }
    public function admintambahtipemakanan()
    {
        $this->load->view('AdminTambahTipeMakanan');
    }
    public function adminperalatan()
    {
        $this->load->view('AdminPeralatan');
    }
    public function adminkegiatan()
    {
        $this->load->view('AdminKegiatan');
    }
    public function admintambahakomodasi()
    {
        $this->load->view('AdminTambahAkomodasi');
    }
    public function adminlihatakomodasi()
    {
        $this->load->view('AdminLihatAkomodasi');
    }
    public function adminlihatperalatan()
    {
        $this->load->view('AdminLihatPeralatan');
    }
    public function admintambahperalatan()
    {
        $this->load->view('AdminTambahPeralatan');
    }

}
