<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengunjung extends CI_Controller
{
    public function index()
    {
        $this->load->view('Beranda');
    }

    public function fasilitas()
    {
        $this->load->view('Fasilitas');
    }

    public function login()
    {
        $this->load->view('Login');
    }

    public function buatAkun()
    {
        $this->load->view('BuatAkun');
    }

    public function pencarian()
    {
        $this->load->view('Pencarian');
    }

    public function kegiatan()
    {
        $this->load->view('Kegiatan');
    }

    public function penginapan()
    {
        $this->load->view('Penginapan');
    }

    public function peralatan()
    {
        $this->load->view('Peralatan');
    }
}
