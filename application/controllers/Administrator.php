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

    public function buatpesananmakanan()
    {
        $this->load->view('BuatPesananMakanan');
    }

    public function adminlihatkegiatan()
    {
        $this->load->view('AdminLihatKegiatan');
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
}
