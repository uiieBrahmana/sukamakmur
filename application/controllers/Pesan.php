<?php

class Pesan extends CI_Controller
{

    private $userId;
    private $role;

    public function __construct()
    {
        parent::__construct();

        $this->userId = $this->session->userdata('ID');
        $this->role = $this->session->userdata('role');

        if (!isset($this->userId)) {
            redirect('/login/');
        }

    }

    public function index()
    {
        $this->load->view('pesanan/start');
    }

    public function overview($jenis = 'view')
    {

        switch ($jenis) {
            case 'new':
                $insert = InsertBuilder('pemesanan', array(
                    'idtamu' => '',
                    'tanggalpesan' => '',
                    'status' => '')
                );
                $idpesanan = $this->koneksi->Save($insert, array($this->userId, date("Y-m-d H:i:s"), 'DRAFT'));
                $this->session->set_userdata('pesanan', $idpesanan);
                break;
            case 'view':



                break;
        }
        $this->load->view('pesanan/overview');
    }

    public function summary()
    {
        $this->load->view('pesanan/summary');
    }

    public function akomodasi()
    {
        $submit = $this->input->post('submit');
        if(isset($submit)){
            var_dump($_POST);
        }

        $data['Akomodasi'] = $this->koneksi->FetchAll('SELECT * FROM AKOMODASI');
        $this->load->view('pesanan/akomodasi', $data);
    }

    public function peralatan()
    {
        $data['Peralatan'] = $this->koneksi->FetchAll('SELECT * FROM PERALATAN');
        $this->load->view('pesanan/peralatan', $data);
    }

    public function aktivitas()
    {
        $data['Kegiatan'] = $this->koneksi->FetchAll('SELECT * FROM KEGIATAN');
        $this->load->view('pesanan/aktivitas', $data);
    }

    public function makanan()
    {
        $data['MenuMakanan'] = $this->koneksi->FetchAll('SELECT * FROM MENUMAKANAN');
        $this->load->view('pesanan/makanan', $data);
    }
}