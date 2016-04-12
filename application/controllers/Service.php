<?php

class Service extends CI_Controller
{


    /**
     * Service constructor.
     */
    public function __construct()
    {
        parent::__construct();
        header("Cache-Control: no-cache");
        header("Pragma: no-cache");
        header("Author: Sukamakmur JSON API v1");
        header('Content-Type: application/json');
    }

    public function KapasitasAkomodasi()
    {
        $idakomodasi = $this->input->post('idakomodasi');
        $kapasitas = $this->koneksi->FetchAll("SELECT kapasitas FROM `akomodasi` where idakomodasi = $idakomodasi;");
        echo json_encode($kapasitas[0]);
    }

    public function AvailableAkomodasi()
    {
        $idakomodasi = $this->input->post('idakomodasi');
        $mulai = $this->input->post('start');
        $lama = $this->input->post('end');

        $begin = new DateTime(date("Y-m-d", strtotime($mulai)));
        $end = new DateTime(date("Y-m-d", strtotime($mulai)));
        $end->modify('+' . $lama . ' day');

        $interval = DateInterval::createFromDateString('1 day');
        $period = new DatePeriod($begin, $interval, $end);

        $data = array();
        foreach ($period as $k => $dt) {
            $temp = $this->koneksi->FetchAll(
                "SELECT * FROM `pesananakomodasi` where idakomodasi = $idakomodasi
                and tanggal = STR_TO_DATE('" . $dt->format("d-m-Y") . "','%d-%m-%Y');");
            $data['Akomodasi'][$k]['Tanggal'] = $dt->format("d F Y");
            $data['Akomodasi'][$k]['IDTanggal'] = $dt->format("Y-m-d");
            $data['Akomodasi'][$k]['Result'] = (sizeof($temp) > 0 && isset($temp)) ? false : true;
        }
        echo json_encode($data);
    }

    public function AvailableMakanan()
    {
        $mulai = $this->input->post('tanggalmakan');
        $begin = new DateTime(date("Y-m-d", strtotime($mulai)));

        $sisa = $this->koneksi->FetchAll("SELECT (1000 - sum(IFNULL(porsi,0))) as sisa FROM `pesananmakanan`
                where tanggalpemesanan = STR_TO_DATE('" . $begin->format("d-m-Y") . "','%d-%m-%Y') GROUP BY tanggalpemesanan;");

        $data['sisa'] = (isset($sisa[0]['sisa'])) ? $sisa[0]['sisa'] : 1000;
        echo json_encode($data);
    }

    public function AvailablePeralatan()
    {

        $idperalatan = $this->input->post('idperalatan');
        $mulai = $this->input->post('tanggalsewa');
        $begin = new DateTime(date("Y-m-d", strtotime($mulai)));

        $sql = "SELECT p.*, (p.jumlah - pn.jumlah) AS sisajumlah
                FROM peralatan p LEFT JOIN pesananperalatan pn USING (idperalatan)
                WHERE p.idperalatan = $idperalatan
                AND pn.tanggal = STR_TO_DATE('" . $begin->format("d-m-Y") . "','%d-%m-%Y')
                GROUP BY pn.tanggal;";
        $original = "SELECT * FROM peralatan WHERE idperalatan = " . $idperalatan;

        $sisa = $this->koneksi->FetchAll($sql);
        $ori = $this->koneksi->FetchAll($original);

        $data['sisa'] = isset($sisa[0]['sisajumlah']) ? $sisa[0]['sisajumlah'] : $ori[0]['jumlah'];

        echo json_encode($data);

    }

    public function KapasitasAktivitas()
    {
        $idkegiatan = $this->input->post('idkegiatan');
        $mulai = $this->input->post('tanggal');

        $begin = new DateTime(date("Y-m-d", strtotime($mulai)));

        $sql = "SELECT k.*, count(pk.tanggal) as jumlah from kegiatan k
                LEFT JOIN pesanankegiatan pk USING(idkegiatan) WHERE k.idkegiatan = $idkegiatan
                AND pk.tanggal = STR_TO_DATE('" . $begin->format("d-m-Y") . "','%d-%m-%Y')
                GROUP BY pk.tanggal, idkegiatan;";
        $original = "SELECT * FROM kegiatan WHERE idkegiatan = " . $idkegiatan;
        $trainer = "SELECT ifnull(count(*),0) as pelatih FROM petugas WHERE status = 'Trainer'";

        $sisa = $this->koneksi->FetchAll($sql);
        $ori = $this->koneksi->FetchAll($original);
        $train = $this->koneksi->FetchAll($trainer);

        $data['trainer'] = $train[0]['pelatih'];
        $data['terpesan'] = isset($sisa[0]['jumlah']) ? $sisa[0]['jumlah'] : 0;
        $data['pesertamin'] = $ori[0]['pesertamin'];
        $data['pesertamax'] = $ori[0]['pesertamax'];

        echo json_encode($data);
    }

    public function test()
    {
        $this->load->view('test');
    }

    public function images($id)
    {
        $result = $this->koneksi->FetchAll("select * from fotoakomodasi where idakomodasi = $id");
        if (!is_array($result))
            die('not available');

        header('Content-Type: '.$result[0]['ekstensifile']);
        echo $result[0]['filedata'];
    }
}