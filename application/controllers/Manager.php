<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manager extends CI_Controller
{
    public function index()
    {
        $this->load->view('AdminBeranda');
    }

    public function adminlihatakun()
    {
        $this->load->view('AdminLihatAkun');
    }

    public function adminlihatfasilitas()
    {
        $this->load->view('AdminLihatFasilitas');
    }

    public function adminlihatkegiatan()
    {
        $this->load->view('AdminLihatKegiatan');
    }

    public function adminlihatlaporan()
    {
        $this->load->view('AdminLihatLaporan');
    }

    public function adminlihatmakanan()
    {
        $this->load->view('AdminLihatMakanan');
    }

    public function adminlihatpemesanan()
    {
        $this->load->view('AdminLihatPemesanan');
    }

    public function adminlihatpetugas()
    {
        $this->load->view('AdminLihatPetugas');
    }

    public function adminpemesanandetail()
    {
        $this->load->view('AdminPemesananDetail');
    }

    public function approvepembayaran()
    {
        $this->load->view('ApprovePembayaran');
    }

    public function buatAkun()
    {
        $this->load->view('BuatAkun');
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

    public function buatpesananmakanan()
    {
        $this->load->view('BuatPesananMakanan');
    }
}
