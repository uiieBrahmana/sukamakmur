<?php

class Pesan extends CI_Controller
{

    private $userId;
    private $role;

    private $data;

    public function __construct()
    {
        parent::__construct();

        $this->userId = $this->session->userdata('ID');
        $this->role = $this->session->userdata('role');

        $this->data['ID'] = $this->session->userdata('ID');
        $this->data['Role'] = $this->session->userdata('role');

        if (!isset($this->userId)) {
            redirect('/login/');
        }
    }

    public function index()
    {
        // todo : update total harga semua pesannannya.
        $sql = "SELECT idpemesanan, tanggalpesan, totalharga, status FROM pemesanan WHERE idtamu = $this->userId";
        $this->data['Pesanan'] = $this->koneksi->FetchAll($sql);

        foreach ($this->data['Pesanan'] as $key => $item) {
            $this->pesanankosong($item['idpemesanan']);
        }

        $sql = "SELECT idpemesanan, tanggalpesan, totalharga, status FROM pemesanan WHERE idtamu = $this->userId";
        $this->data['Pesanan'] = $this->koneksi->FetchAll($sql);


        $this->load->view('pesanan/start', $this->data);
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
                $this->data['IdPesanan'] = $idpesanan;
                break;
            default:
                $this->session->set_userdata('pesanan', $jenis);
                break;
        }

        $idpesanan = $this->session->userdata('pesanan');
        if (!isset($idpesanan)) {
            redirect('/pesan/');
        }

        $this->data['id'] = $idpesanan;
        $this->data['Akomodasi'] = $this->koneksi->FetchAll('SELECT p.idpesananakomodasi as did, a.*, p.tanggal, p.jumlahtamu, p.keterangan as ket
        FROM PESANANAKOMODASI p
        LEFT JOIN AKOMODASI a USING (IDAKOMODASI) WHERE p.IDPEMESANAN = ' . $idpesanan);
        $this->data['Makanan'] = $this->koneksi->FetchAll('SELECT pm.idpesananmakanan as did, t.harga, t.idtipemakanan, t.keterangan as kettipe,
        m.keterangan as ketmenu, pm.* FROM PESANANMAKANAN pm
        LEFT JOIN MENUMAKANAN m USING (IDMENUMAKANAN)
        LEFT JOIN tipemakanan t ON (m.idtipemakanan = t.idtipemakanan)
        WHERE pm.IDPEMESANAN = ' . $idpesanan);
        $this->data['Peralatan'] = $this->koneksi->FetchAll('SELECT pn.idpesananperalatan as did, p.*, pn.jumlah as jumlahdisewa, pn.keterangan as ket,
        pn.tanggal FROM PESANANPERALATAN pn LEFT JOIN peralatan p using (idperalatan)
        WHERE pn.IDPEMESANAN = ' . $idpesanan);
        $this->data['Kegiatan'] = $this->koneksi->FetchAll('SELECT k.*, pn.idpesanankegiatan as did, pn.idpetugas, pn.jumlahpeserta,
        pn.tanggal, pn.keterangan as ket
        FROM PESANANKEGIATAN pn LEFT JOIN kegiatan k USING (idkegiatan)
        WHERE IDPEMESANAN = ' . $idpesanan);

        $totalHarga = 0;
        foreach ($this->data['Akomodasi'] as $value) {
            $totalHarga += $value['harga'];
        }
        foreach ($this->data['Makanan'] as $value) {
            $totalHarga += ($value['harga'] * $value['porsi']);
        }
        foreach ($this->data['Peralatan'] as $value) {
            $totalHarga += ($value['hargasewa'] * $value['jumlahdisewa']);
        }
        foreach ($this->data['Kegiatan'] as $value) {
            $totalHarga += ($value['harga'] * $value['jumlahpeserta']);
        }
        $this->data['Total'] = $totalHarga;
        $this->load->view('pesanan/overview', $this->data);
    }

    public function summary()
    {
        $idpesanan = $this->session->userdata('pesanan');
        if (!isset($idpesanan)) {
            redirect('/pesan/');
        }
        $this->load->view('pesanan/summary', $this->data);
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

            redirect('/pesan/overview/' . $idpesanan);
        }

        $this->data['Akomodasi'] = $this->koneksi->FetchAll('SELECT * FROM AKOMODASI');
        $this->load->view('pesanan/akomodasi', $this->data);
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

            redirect('/pesan/overview/' . $idpesanan);
        }

        $this->data['MenuMakanan'] = $this->koneksi->FetchAll('SELECT * FROM MENUMAKANAN');
        $this->load->view('pesanan/makanan', $this->data);
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

            redirect('/pesan/overview/' . $idpesanan);
        }

        $this->data['Peralatan'] = $this->koneksi->FetchAll('SELECT * FROM PERALATAN');
        $this->load->view('pesanan/peralatan', $this->data);
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

            redirect('/pesan/overview/' . $idpesanan);

        }

        $this->data['Kegiatan'] = $this->koneksi->FetchAll('SELECT * FROM KEGIATAN');
        $this->load->view('pesanan/aktivitas', $this->data);
    }

    public function batalkan($jenis, $iditem)
    {
        switch ($jenis) {
            case 'akomodasi':
                $sql = DeleteBuilder('pesananakomodasi', array('idpesananakomodasi' => $iditem));
                $result = $this->koneksi->Save($sql, array($iditem));
                break;
            case 'makanan':
                $sql = DeleteBuilder('pesananmakanan', array('idpesananmakanan' => $iditem));
                $result = $this->koneksi->Save($sql, array($iditem));
                break;
            case 'peralatan':
                $sql = DeleteBuilder('pesananperalatan', array('idpesananperalatan' => $iditem));
                $result = $this->koneksi->Save($sql, array($iditem));
                break;
            case 'kegiatan':
                $sql = DeleteBuilder('pesanankegiatan', array('idpesanankegiatan' => $iditem));
                $result = $this->koneksi->Save($sql, array($iditem));
                break;
            default:
                redirect('/pesan/');
        }

        $idpesanan = $this->session->userdata('pesanan');
        redirect('pesan/overview/' . $idpesanan);

    }

    public function batalkansemua($idpemesanan = null)
    {
        if ($idpemesanan == null)
            $idpemesanan = $this->session->userdata('pesanan');

        $sql = DeleteBuilder('pemesanan', array('idpemesanan' => $idpemesanan));
        $result = $this->koneksi->Save($sql, array($idpemesanan));

        redirect('/pesan/');
    }

    private function pesanankosong($idpesanan)
    {

        $sql = "SELECT count(*) as jumlah
                FROM pesananakomodasi a
                LEFT JOIN pesananmakanan b USING (idpemesanan)
                LEFT JOIN pesananperalatan c USING (idpemesanan)
                LEFT JOIN pesanankegiatan d USING (idpemesanan)
                WHERE idpemesanan = $idpesanan GROUP BY idpemesanan";
        $hasil = $this->koneksi->FetchAll($sql);

        if ($hasil == null) {

            $sql = DeleteBuilder('pemesanan', array('idpemesanan' => $idpesanan));
            $result = $this->koneksi->Save($sql, array($idpesanan));

            $this->data['PesananKosong'] = true;
            return true;

        } else {
            $this->data['PesananKosong'] = false;
            return false;
        }
    }
}