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
        $picker = $this->input->post('picker');

        if(isset($picker)) {

            $date = explode(' ', $picker);

            require_once (APPPATH . 'third_party/dompdf/autoload.inc.php');

            $sql = "select * from (
                        select q.*, p.jumlahtamu, a.nama, a.harga, t.nama namatamu, 'orang' unit
                        from pemesanan q
                        left join pesananakomodasi p using (idpemesanan)
                        left join akomodasi a using (idakomodasi)
                        left join tamu t using (idtamu)
                        where q.`status` = 'LUNAS'
                        union
                        select q.*, p.porsi, a.idtipemakanan, b.harga, t.nama namatamu, 'porsi' unit
                        from pemesanan q
                        left join pesananmakanan p using (idpemesanan)
                        left join menumakanan a using (idmenumakanan)
                        left join tipemakanan b using (idtipemakanan)
                        left join tamu t using (idtamu)
                        where q.`status` = 'LUNAS'
                        union
                        select q.*, p.jumlah, a.nama, a.hargasewa, t.nama namatamu, 'unit' unit
                        from pemesanan q
                        left join pesananperalatan p using (idpemesanan)
                        left join peralatan a using (idperalatan)
                        left join tamu t using (idtamu)
                        where q.`status` = 'LUNAS'
                        union
                        select q.*, p.jumlahpeserta, a.nama, a.harga, t.nama namatamu, 'orang' unit
                        from pemesanan q
                        left join pesanankegiatan p using (idpemesanan)
                        left join kegiatan a using (idkegiatan)
                        left join tamu t using (idtamu)
                        where q.`status` = 'LUNAS'
                    ) report where jumlahtamu is not null
                    AND YEAR (tanggalpesan) = $date[1]
                    AND MONTHNAME (tanggalpesan) = '$date[0]'
                    order by tanggalpesan asc";

            $stats = $this->koneksi->FetchAll($sql);
            $this->data['Stats'] = $stats;
            $this->data['Period'] = $picker;

            $view = $this->load->view('templates/report/example', $this->data, true);

            $dompdf = new Dompdf();
            $dompdf->loadHtml($view);
            $dompdf->setPaper('A4', 'portrait');
            $dompdf->render();
            $dompdf->stream(date('dMy').'_RCSukamakmur_Report_'.$date[0].'_'.$date[1]);
        }

    }
}
