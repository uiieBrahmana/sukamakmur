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
<<<<<<< HEAD
        $picker1 = $this->input->post('picker1');
        $picker2 = $this->input->post('picker2');
        $tipe = $this->input->post('tipe');

        $view = null;

        $begin = new DateTime(date("Y-m-d", strtotime($picker1)));
        $end = new DateTime(date("Y-m-d", strtotime($picker2)));

        if(isset($picker1)) {
            $date1 = explode(' ', $picker1);
            $date2 = explode(' ', $picker2);

            require_once (APPPATH . 'third_party/dompdf/autoload.inc.php');

            switch ($tipe) {
                case '1':
                    $sql = "select * from (
                        select q.*, p.jumlahtamu, a.nama, a.harga, t.nama namatamu, 'orang' unit,
                        'no' multiply
=======
        $picker = $this->input->post('picker');

        if(isset($picker)) {

            $date = explode(' ', $picker);

            require_once (APPPATH . 'third_party/dompdf/autoload.inc.php');

            $sql = "select * from (
                        select q.*, p.jumlahtamu, a.nama, a.harga, t.nama namatamu, 'orang' unit
>>>>>>> c4e0f3ce92028d19d01a656d7674dcd7e1355bfc
                        from pemesanan q
                        left join pesananakomodasi p using (idpemesanan)
                        left join akomodasi a using (idakomodasi)
                        left join tamu t using (idtamu)
                        where q.`status` = 'LUNAS'
                        union
<<<<<<< HEAD
                        select q.*, p.porsi, a.idtipemakanan, b.harga, t.nama namatamu, 'porsi' unit,
                        'yes' multiply
=======
                        select q.*, p.porsi, a.idtipemakanan, b.harga, t.nama namatamu, 'porsi' unit
>>>>>>> c4e0f3ce92028d19d01a656d7674dcd7e1355bfc
                        from pemesanan q
                        left join pesananmakanan p using (idpemesanan)
                        left join menumakanan a using (idmenumakanan)
                        left join tipemakanan b using (idtipemakanan)
                        left join tamu t using (idtamu)
                        where q.`status` = 'LUNAS'
                        union
<<<<<<< HEAD
                        select q.*, p.jumlah, a.nama, a.hargasewa, t.nama namatamu, 'unit' unit,
                        'yes' multiply
=======
                        select q.*, p.jumlah, a.nama, a.hargasewa, t.nama namatamu, 'unit' unit
>>>>>>> c4e0f3ce92028d19d01a656d7674dcd7e1355bfc
                        from pemesanan q
                        left join pesananperalatan p using (idpemesanan)
                        left join peralatan a using (idperalatan)
                        left join tamu t using (idtamu)
                        where q.`status` = 'LUNAS'
                        union
<<<<<<< HEAD
                        select q.*, p.jumlahpeserta, a.nama, a.harga, t.nama namatamu, 'orang' unit,
                        'yes' multiply
=======
                        select q.*, p.jumlahpeserta, a.nama, a.harga, t.nama namatamu, 'orang' unit
>>>>>>> c4e0f3ce92028d19d01a656d7674dcd7e1355bfc
                        from pemesanan q
                        left join pesanankegiatan p using (idpemesanan)
                        left join kegiatan a using (idkegiatan)
                        left join tamu t using (idtamu)
                        where q.`status` = 'LUNAS'
                    ) report where jumlahtamu is not null
<<<<<<< HEAD
                    AND ((tanggalpesan) BETWEEN STR_TO_DATE('" . $begin->format("d-m-Y") . "','%d-%m-%Y') AND STR_TO_DATE('" . $end->format("d-m-Y") . "','%d-%m-%Y'))
                    order by tanggalpesan asc";

                    $stats = $this->koneksi->FetchAll($sql);
                    $this->data['Stats'] = $stats;
                    $this->data['Period'] = $picker1 . ' - ' . $picker2;

                    $view = $this->load->view('templates/report/LaporanPemesanan', $this->data, true);
                    break;
                case '2': //pegawai
                    $sql = "select nama, alamat, notelp, jeniskelamin, status from petugas";
                    $stats = $this->koneksi->FetchAll($sql);
                    $this->data['Stats'] = $stats;
                    $this->data['Period'] = $picker1 . ' - ' . $picker2;

                    $view = $this->load->view('templates/report/LaporanPegawai', $this->data, true);

                    break;
                case '3': // akomodasi
                    $sql = "select nama, kapasitas, harga, COUNT(pesananakomodasi.tanggal) jumlahpesanan
                    from akomodasi LEFT JOIN pesananakomodasi USING (idakomodasi)
                    WHERE ((pesananakomodasi.tanggal) BETWEEN STR_TO_DATE('" . $begin->format("d-m-Y") . "','%d-%m-%Y') AND STR_TO_DATE('" . $end->format("d-m-Y") . "','%d-%m-%Y'))
                    GROUP BY idakomodasi asc";
                    $stats = $this->koneksi->FetchAll($sql);
                    $this->data['Stats'] = $stats;
                    $this->data['Period'] = $picker1 . ' - ' . $picker2;

                    $view = $this->load->view('templates/report/LaporanAkomodasi', $this->data, true);

                    break;
                case '4': //menu makanan
                    $sql = "select menumakanan.*, tipemakanan.harga, SUM(pesananmakanan.porsi) jumlahpesanan
                    from menumakanan LEFT JOIN pesananmakanan USING (idmenumakanan)
                    left join tipemakanan using (idtipemakanan)
                    WHERE ((pesananmakanan.tanggalpemesanan) BETWEEN STR_TO_DATE('" . $begin->format("d-m-Y") . "','%d-%m-%Y') AND STR_TO_DATE('" . $end->format("d-m-Y") . "','%d-%m-%Y'))
                    GROUP BY idmenumakanan asc";
                    $stats = $this->koneksi->FetchAll($sql);
                    $this->data['Stats'] = $stats;
                    $this->data['Period'] = $picker1 . ' - ' . $picker2;

                    $view = $this->load->view('templates/report/LaporanMenuMakanan', $this->data, true);

                    break;
                case '5': //peralatan
                    $sql = "select * from peralatan";
                    $stats = $this->koneksi->FetchAll($sql);
                    $this->data['Stats'] = $stats;
                    $this->data['Period'] = $picker1 . ' - ' . $picker2;

                    $view = $this->load->view('templates/report/LaporanPeralatan', $this->data, true);

                    break;
                case '6': //kegiatan
                    $sql = "select kegiatan.nama, kegiatan.pesertamin, kegiatan.pesertamax, kegiatan.harga, pesanankegiatan.jumlahpeserta, COUNT(pesanankegiatan.tanggal) jumlahpesanan
                    from kegiatan LEFT JOIN pesanankegiatan USING (idkegiatan)
                    WHERE ((pesanankegiatan.tanggal) BETWEEN STR_TO_DATE('" . $begin->format("d-m-Y") . "','%d-%m-%Y') AND STR_TO_DATE('" . $end->format("d-m-Y") . "','%d-%m-%Y'))
                    GROUP BY idkegiatan asc";
                    $stats = $this->koneksi->FetchAll($sql);
                    $this->data['Stats'] = $stats;
                    $this->data['Period'] = $picker1 . ' - ' . $picker2;

                    $view = $this->load->view('templates/report/LaporanKegiatan', $this->data, true);

                    break;
            }
=======
                    AND YEAR (tanggalpesan) = $date[1]
                    AND MONTHNAME (tanggalpesan) = '$date[0]'
                    order by tanggalpesan asc";

            $stats = $this->koneksi->FetchAll($sql);
            $this->data['Stats'] = $stats;
            $this->data['Period'] = $picker;

            $view = $this->load->view('templates/report/example', $this->data, true);
>>>>>>> c4e0f3ce92028d19d01a656d7674dcd7e1355bfc

            $dompdf = new Dompdf();
            $dompdf->loadHtml($view);
            $dompdf->setPaper('A4', 'portrait');
            $dompdf->render();
<<<<<<< HEAD
            $dompdf->stream(date('dMy').'_RCSukamakmur_Report_'.$date1[0].'_'.$date1[1]); //namafilelaporan
            die();
        }
=======
            $dompdf->stream(date('dMy').'_RCSukamakmur_Report_'.$date[0].'_'.$date[1]);
        }

>>>>>>> c4e0f3ce92028d19d01a656d7674dcd7e1355bfc
    }
}
