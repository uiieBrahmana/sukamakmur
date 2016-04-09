<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengunjung extends CI_Controller
{
    public function index()
    {
        $this->load->view('tamu/Beranda');
    }

    public function buatAkun()
    {
        $this->load->view('tamu/BuatAkun');
    }

    public function fasilitas()
    {
        $this->load->view('tamu/Fasilitas');
    }

    public function kegiatan()
    {
        $this->load->view('tamu/Kegiatan');
    }

    public function pencarian()
    {
        $this->load->view('tamu/Pencarian');
    }

    public function penginapan()
    {
        $this->load->view('tamu/Penginapan');
    }

    public function peralatan()
    {
        $this->load->view('tamu/Peralatan');
    }
}
