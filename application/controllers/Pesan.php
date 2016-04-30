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

        $this->data['open'] = 'open';
    }

    public function index()
    {

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
        FROM pesananakomodasi p
        LEFT JOIN akomodasi a USING (idakomodasi) WHERE p.idpemesanan = ' . $idpesanan);
        $this->data['Makanan'] = $this->koneksi->FetchAll('SELECT pm.idpesananmakanan as did, t.harga, t.idtipemakanan, t.keterangan as kettipe,
        m.keterangan as ketmenu, pm.* FROM pesananmakanan pm
        LEFT JOIN menumakanan m USING (IDMENUMAKANAN)
        LEFT JOIN tipemakanan t ON (m.idtipemakanan = t.idtipemakanan)
        WHERE pm.idpemesanan = ' . $idpesanan);
        $this->data['Peralatan'] = $this->koneksi->FetchAll('SELECT pn.idpesananperalatan as did, p.*, pn.jumlah as jumlahdisewa, pn.keterangan as ket,
        pn.tanggal FROM pesananperalatan pn LEFT JOIN peralatan p using (idperalatan)
        WHERE pn.idpemesanan = ' . $idpesanan);
        $this->data['Kegiatan'] = $this->koneksi->FetchAll('SELECT k.*, pn.idpesanankegiatan as did, pn.idpetugas, pn.jumlahpeserta,
        pn.tanggal, pn.keterangan as ket
        FROM pesanankegiatan pn LEFT JOIN kegiatan k USING (idkegiatan)
        WHERE idpemesanan = ' . $idpesanan);

        $tamu = $this->koneksi->FetchAll('SELECT t.*, p.status FROM pemesanan p
        LEFT JOIN tamu t USING (idtamu)
        WHERE p.idpemesanan = ' . $idpesanan);
        $this->data['Tamu'] = $tamu[0];

        if (strcmp($tamu[0]['status'], 'FINISHED') == 0) {
            redirect('/pesan/');
        }

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

    public function summary($idp)
    {
        $idpesanan = $this->session->userdata('pesanan');
        if (!isset($idpesanan)) {
            $idpesanan = $idp;
        }

        if (!isset($idpesanan)) {
            redirect('/pesan/');
        }

        if (!is_numeric($idpesanan))
            redirect('/pesan/');

        $this->data['id'] = $idpesanan;

        $tamu = $this->koneksi->FetchAll('SELECT * FROM pemesanan p
        LEFT JOIN tamu t USING (idtamu)
        WHERE p.idpemesanan = ' . $idpesanan);
        $this->data['Tamu'] = $tamu[0];

        if (strcasecmp($tamu[0]['status'], 'FINISHED') != 0) {
            redirect('/pesan/');
        }

        $this->data['Akomodasi'] = $this->koneksi->FetchAll('SELECT p.idpesananakomodasi as did, a.*, p.tanggal, p.jumlahtamu, p.keterangan as ket
        FROM pesananakomodasi p
        LEFT JOIN akomodasi a USING (idakomodasi) WHERE p.idpemesanan = ' . $idpesanan);
        $this->data['Makanan'] = $this->koneksi->FetchAll('SELECT pm.idpesananmakanan as did, t.harga, t.idtipemakanan, t.keterangan as kettipe,
        m.keterangan as ketmenu, pm.* FROM pesananmakanan pm
        LEFT JOIN menumakanan m USING (idmenumakanan)
        LEFT JOIN tipemakanan t ON (m.idtipemakanan = t.idtipemakanan)
        WHERE pm.idpemesanan = ' . $idpesanan);
        $this->data['Peralatan'] = $this->koneksi->FetchAll('SELECT pn.idpesananperalatan as did, p.*, pn.jumlah as jumlahdisewa, pn.keterangan as ket,
        pn.tanggal FROM pesananperalatan pn LEFT JOIN peralatan p using (idperalatan)
        WHERE pn.idpemesanan = ' . $idpesanan);
        $this->data['Kegiatan'] = $this->koneksi->FetchAll('SELECT k.*, pn.idpesanankegiatan as did, pn.idpetugas, pn.jumlahpeserta,
        pn.tanggal, pn.keterangan as ket
        FROM pesanankegiatan pn LEFT JOIN kegiatan k USING (idkegiatan)
        WHERE idpemesanan = ' . $idpesanan);

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

        $this->data['Akomodasi'] = $this->koneksi->FetchAll('SELECT * FROM akomodasi');
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

        $this->data['MenuMakanan'] = $this->koneksi->FetchAll('SELECT * FROM menumakanan');
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

        $this->data['Peralatan'] = $this->koneksi->FetchAll('SELECT * FROM peralatan');
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

        $this->data['Kegiatan'] = $this->koneksi->FetchAll('SELECT * FROM kegiatan');
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

        $sql = DeleteBuilder('pemesanan', array(
                'idpemesanan' => $idpesanan,
                'totalharga' => 0,
                'status' => 'DRAFT'
            )
        );
        $this->koneksi->Save($sql, array($idpesanan));
    }

    public function checkout($idpemesanan)
    {
        if ($idpemesanan == null)
            $idpemesanan = $this->session->userdata('pesanan');

        $datapemesan = $this->koneksi->FetchAll("SELECT * FROM pemesanan p
                                    LEFT JOIN tamu USING (idtamu)
                                    WHERE p.idpemesanan = $idpemesanan");
        $datapemesan = $datapemesan[0];

        $submit = $this->input->post('submit');
        if (isset($submit)) {
            $terms = $this->input->post('dp');
            if (isset($terms))
                $datapemesan['totalharga'] = ($datapemesan['totalharga'] * 30 / 100);

            include_once(APPPATH . 'third_party/phpmailer/PHPMailerAutoload.php');
            $this->load->library('mail');
            $data = array(
                "NAME" => $datapemesan['nama'],
                "EMAIL" => $datapemesan['email'],
                "DATE" => date('d F Y (H:i:s)'),
                "ID" => $idpemesanan,
                "TOTAL" => number_format($datapemesan['totalharga']),
            );

            $template_html = 'email_pembayaran.html';

            // todo : activate on production
            //$mail = new Mail();
            //$mail->setMailBody($data, $template_html);
            //$mail->sendMail('Petunjuk Pembayaran Pesanan ' . $idpemesanan, $datapemesan['email']);

            $sqlupdate = UpdateBuilder('pemesanan',
                array(
                    'idpemesanan' => $idpemesanan,
                ),
                array(
                    'idpemesanan' => $idpemesanan,
                    'status' => 'CHECKOUT',
                )
            );

            $this->koneksi->Save($sqlupdate, array(
                $idpemesanan,
                'CHECKOUT'
            ));
        }

        $this->data['Pemesanan'] = $datapemesan;
        $this->load->view('pesanan/checkout', $this->data);
    }

    public function konfirmasi($id = null)
    {
        $this->load->view('pesanan/konfirmasi', $this->data);
    }
}