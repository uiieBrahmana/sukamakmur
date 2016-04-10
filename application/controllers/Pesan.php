<?php

class Pesan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->load->view('pesanan/start');
    }

    public function overview()
    {
        $this->load->view('pesanan/overview');
    }

    public function summary()
    {
        $this->load->view('pesanan/summary');
    }

    public function akomodasi()
    {
        $this->load->view('pesanan/akomodasi');
    }

    public function peralatan()
    {
        $this->load->view('pesanan/peralatan');
    }

    public function aktivitas()
    {
        $this->load->view('pesanan/aktivitas');
    }

    public function makanan()
    {
        $this->load->view('pesanan/makanan');
    }
}