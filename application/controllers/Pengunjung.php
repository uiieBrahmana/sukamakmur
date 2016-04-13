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

    public function pencarian()
    {
        $this->load->view('tamu/Pencarian');
    }

    public function akomodasi()
    {
        $this->load->view('tamu/Akomodasi');
    }

    public function makanan()
    {
        $this->load->view('tamu/Makanan');
    }

    public function peralatan()
    {
        $this->load->view('tamu/Peralatan');
    }

    public function kegiatan()
    {
        $this->load->view('tamu/Kegiatan');
    }
}
