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
        header("Author: Puko Framework v1");
        header('Content-Type: application/json');
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
            $data['Akomodasi'][$k]['Tanggal'] = $dt->format("d-m-Y");
            $data['Akomodasi'][$k]['Result'] = (sizeof($temp) > 0 && isset($temp)) ? false : true;
        }
        echo json_encode($data);
    }

    public function AvailableMakanan()
    {
        $mulai = $this->input->post('tanggalmakan');
        $begin = new DateTime(date("Y-m-d", strtotime($mulai)));

        $sisa = $this->koneksi->FetchAll("SELECT (1000 - sum(IFNULL(porsi,0))) as sisa FROM `pesananmakanan`
                where tanggalpemesanan = STR_TO_DATE('" . $begin->format("d-m-Y") . "','%d-%m-%Y');");

        echo json_encode($sisa[0]);
    }

    public function test()
    {
        $this->load->view('test');
    }
}