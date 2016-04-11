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
        // todo : update total harga semua pesannannya.

        $sql = "SELECT idpemesanan, tanggalpesan, totalharga, status FROM pemesanan WHERE idtamu = $this->userId";
        $data['Pesanan'] = $this->koneksi->FetchAll($sql);
        $this->load->view('pesanan/start', $data);
    }

    public function overview($jenis = '')
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
                $data['IdPesanan'] = $idpesanan;
                break;
            default:
                $this->session->set_userdata('pesanan', $jenis);
                break;
        }

        $idpesanan = $this->session->userdata('pesanan');
        if (!isset($idpesanan)) {
            redirect('/pesan/');
        }
        $this->load->view('pesanan/overview');
    }

    public function summary()
    {
        $idpesanan = $this->session->userdata('pesanan');
        if (!isset($idpesanan)) {
            redirect('/pesan/');
        }
        $this->load->view('pesanan/summary');
    }

    public function akomodasi()
    {
        $idpesanan = $this->session->userdata('pesanan');
        if (!isset($idpesanan)) {
            redirect('/pesan/');
        }
        $submit = $this->input->post('submit');
        if (isset($submit)) {

            $idakomodasi = $this->input->post('idakomodasi');
            $checkakomodasi = $this->input->post('checkakomodasi');
            $jumlah = $this->input->post('jumlah');
            $keterangan = $this->input->post('keterangan');

            foreach ($checkakomodasi as $key => $val) {
                $insert = InsertBuilder('pesananakomodasi', array(
                        'idpemesanan' => $idpesanan,
                        'idakomodasi' => $idakomodasi,
                        'jumlahtamu' => $jumlah,
                        'tanggal' => $val,
                        'keterangan' => $keterangan)
                );
                $this->koneksi->Save($insert, array($idpesanan, $idakomodasi, $jumlah, $val, $keterangan));
            }

            redirect('/pesan/overview/');
        }

        $data['Akomodasi'] = $this->koneksi->FetchAll('SELECT * FROM AKOMODASI');
        $this->load->view('pesanan/akomodasi', $data);
    }

    public function makanan()
    {
        $idpesanan = $this->session->userdata('pesanan');
        if (!isset($idpesanan)) {
            redirect('/pesan/');
        }

        $submit = $this->input->post('submit');
        if (isset($submit)) {
            $idmenu = $this->input->post('idmenu');
            $tanggalmakan = $this->input->post('tanggalmakan');
            $waktumakan = $this->input->post('waktumakan');
            $jumlahporsi = $this->input->post('jumlahporsi');
            $keterangan = $this->input->post('keteranganmakanan');
            $tanggalmakan = date("Y-m-d", strtotime($tanggalmakan));

            $insert = InsertBuilder('pesananmakanan', array(
                    'idpemesanan' => $idpesanan,
                    'idmenumakanan' => $idmenu,
                    'tanggalpemesanan' => $tanggalmakan,
                    'porsi' => $jumlahporsi,
                    'waktupemesanan' => $waktumakan,
                    'keterangan' => $keterangan)
            );
            $this->koneksi->Save($insert, array($idpesanan, $idmenu, $tanggalmakan, $jumlahporsi, $waktumakan, $keterangan));

            redirect('/pesan/overview/');
        }

        $data['MenuMakanan'] = $this->koneksi->FetchAll('SELECT * FROM MENUMAKANAN');
        $this->load->view('pesanan/makanan', $data);
    }

    public function peralatan()
    {
        $idpesanan = $this->session->userdata('pesanan');
        if (!isset($idpesanan)) {
            redirect('/pesan/');
        }

        $submit = $this->input->post('submit');
        if (isset($submit)) {
            $idperalatan = $this->input->post('idperalatan');
            $tanggalsewa = $this->input->post('tanggalsewa');
            $jumlahalat = $this->input->post('jumlahalat');
            $keterangan = $this->input->post('keteranganalat');
            $tanggalsewa = date("Y-m-d", strtotime($tanggalsewa));

            $insert = InsertBuilder('pesananperalatan', array(
                    'idpemesanan' => $idpesanan,
                    'idperalatan' => $idperalatan,
                    'jumlah' => $jumlahalat,
                    'tanggal' => $tanggalsewa,
                    'keterangan' => $keterangan)
            );
            $this->koneksi->Save($insert, array($idpesanan, $idperalatan, $jumlahalat, $tanggalsewa, $keterangan));

            redirect('/pesan/overview/');
        }

        $data['Peralatan'] = $this->koneksi->FetchAll('SELECT * FROM PERALATAN');
        $this->load->view('pesanan/peralatan', $data);
    }

    public function aktivitas()
    {
        $idpesanan = $this->session->userdata('pesanan');
        if (!isset($idpesanan)) {
            redirect('/pesan/');
        }

        $submit = $this->input->post('submit');
        if (isset($submit)) {

            $idkegiatan = $this->input->post('idkegiatan');
            $tanggal = $this->input->post('tanggal');
            $jumlah = $this->input->post('jumlah');
            $keterangan = $this->input->post('keterangan');
            $tanggal = date("Y-m-d", strtotime($tanggal));

            $insert = InsertBuilder('pesanankegiatan', array(
                    'idpemesanan' => $idpesanan,
                    'idkegiatan' => $idkegiatan,
                    'jumlahpeserta' => $jumlah,
                    'tanggal' => $tanggal,
                    'keterangan' => $keterangan)
            );
            $this->koneksi->Save($insert, array($idpesanan, $idkegiatan, $jumlah, $tanggal, $keterangan));

            redirect('/pesan/overview/');

        }

        $data['Kegiatan'] = $this->koneksi->FetchAll('SELECT * FROM KEGIATAN');
        $this->load->view('pesanan/aktivitas', $data);
    }
}