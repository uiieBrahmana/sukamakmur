<?php
use Dompdf\Dompdf;

defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller
{

    private $data;

    public function __construct()
    {
        parent::__construct();
        $this->data['auth'] = $this->session->userdata('ID');
        $this->data['role'] = $this->session->userdata('role');

        if (!isset($this->data['auth'])) {
            redirect('/login/');
        }

        if (strcasecmp($this->data['role'], 'Tamu') == 0) {
            redirect('/pengunjung/');
        }

        header("Cache-Control: no-cache");
        header("Pragma: no-cache");
        header("Author: Sukamakmur PDF API v1");
        header('Content-Type: application/pdf');
    }

    public function pdf()
    {
        require_once (APPPATH . 'third_party/dompdf/autoload.inc.php');

        $sql = "SELECT *, YEAR(tanggalpesan) tahun,
            MONTH(tanggalpesan) bulan FROM `pemesanan` WHERE YEAR(tanggalpesan) = YEAR(NOW())
            GROUP BY YEAR(tanggalpesan), MONTH(tanggalpesan);";
        $stats = $this->koneksi->FetchAll($sql);
        $this->data['Stats'] = $stats;

        $view = $this->load->view('templates/report/example', $this->data, true);

        $dompdf = new Dompdf();
        $dompdf->loadHtml($view);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream('RCSukamakmur_report');
    }
}
