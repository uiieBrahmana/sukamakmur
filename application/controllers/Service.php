<?php

class Service extends CI_Controller
{

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
        $kapasitas = $this->koneksi->FetchAll("SELECT kapasitas FROM `akomodasi` where status = 'Tersedia' AND idakomodasi = $idakomodasi;");
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
                "SELECT * FROM `pesananakomodasi` WHERE idakomodasi = $idakomodasi
                AND tanggal = STR_TO_DATE('" . $dt->format("d-m-Y") . "','%d-%m-%Y');");
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

    public function hitungtotalharga()
    {
        $idpemesanan = $this->input->post('idpemesanan');
        $totalharga = $this->input->post('totalharga');

        $sqlupdate = UpdateBuilder('pemesanan',
            array(
                'idpemesanan' => $idpemesanan,
            ),
            array(
                'idpemesanan' => $idpemesanan,
                'totalharga' => $totalharga,
            )
        );

        $hasil = $this->koneksi->Save($sqlupdate, array(
            $idpemesanan,
            $totalharga
        ));

        if ($hasil) {
            json_encode(1);
        } else {
            json_encode(0);
        }
    }

    public function images($idakomodasi, $posisi = 0)
    {
        $result = $this->koneksi->FetchAll("select * from fotoakomodasi where idakomodasi = $idakomodasi");
        if (!is_array($result))
            die('not available');

        header('Content-Type: ' . $result[$posisi]['ekstensifile']);
        echo $result[$posisi]['filedata'];
    }

    public function hapusimages($idakomodasi, $namafoto)
    {
        $namafoto = str_replace('%20', ' ', $namafoto);
        $sqldelete = DeleteBuilder('fotoakomodasi',
            array(
                'idakomodasi' => $idakomodasi,
                'namafile' => $namafoto,
            ),
            array(
                'idakomodasi' => $idakomodasi,
                'namafile' => $namafoto,
            )
        );

        $this->koneksi->Save($sqldelete, array(
            'idakomodasi' => $idakomodasi,
            'namafile' => $namafoto,
        ));

        redirect('administrator/detailakomodasi/view/' . $idakomodasi);
    }

    public function bukti($idpembayaran)
    {
        $result = $this->koneksi->FetchAll("select * from pembayaran where idpembayaran = $idpembayaran
        AND bukti IS NOT NULL");
        if (!is_array($result))
            die('not available');
        else {
            header('Content-Type: ' . $result[0]['ekstensifile']);
            echo $result[0]['bukti'];
        }
    }

    public function imageLength($idakomodasi)
    {
        $result = $this->koneksi->FetchAll("select count(*) as jumlah from fotoakomodasi where idakomodasi = $idakomodasi");
        echo json_encode($result[0]);
    }

    public function usernameSimilarity()
    {
        $username = $this->input->post('username');
        $result = $this->koneksi->FetchAll("select username from tamu where username = '$username'
        UNION select username from petugas where username = '$username'");
        echo json_encode($result[0]['username']);
    }

    public function tipemakananSimilarity(){
        $tipe = $this->input->post('tipe');
        $tipe = strtoupper($tipe);
        $result = $this->koneksi->FetchAll("select idtipemakanan from tipemakanan where idtipemakanan = '$tipe'");
        echo json_encode($result[0]['idtipemakanan']);
    }

    #region payment
    public function verify()
    {
        $transidmerchant = $this->input->post("TRANSIDMERCHANT");
        $totalamount = $this->input->post("AMOUNT");
        $storeid = $this->input->post("STOREID");

        $this->session->set_userdata('AMMOUNT', $totalamount);

        $sql = "SELECT * FROM pemesanan WHERE idpemesanan = $transidmerchant";
        $data = $this->koneksi->FetchAll($sql);

        if ($data === null) {
            echo 'Stop';
            return;
        } else {
            /*
            $sqlupdate = UpdateBuilder('pemesanan',
                array(
                    'idpemesanan' => $transidmerchant,
                ),
                array(
                    'idpemesanan' => $transidmerchant,
                    'status' => 'CHECKOUT',
                )
            );

            $this->koneksi->Save($sqlupdate, array(
                $transidmerchant,
                'CHECKOUT'
            ));
            */
            echo 'Continue';
            return;
        }

    }

    public function notify()
    {
        $transidmerchant = $this->input->post("TRANSIDMERCHANT");
        $totalamount = $this->input->post("AMOUNT");

        $this->session->set_userdata('AMMOUNT', $totalamount);
        //Result can be (Success or Fail)
        $result = strtoupper($this->input->post("RESULT"));

        if (strcasecmp($result, 'SUCCESS') == 0) {
            $sqlbayar = InsertBuilder('pembayaran',
                array(
                    'idpemesanan' => $transidmerchant,
                    'nominal' => (int)$totalamount,
                    'metodepembayaran' => 'DOKU WALLET',
                )
            );

            $this->koneksi->Save($sqlbayar, array(
                'idpemesanan' => $transidmerchant,
                'nominal' => (int)$totalamount,
                'metodepembayaran' => 'DOKU WALLET',
            ));

            $sqlupdate = UpdateBuilder('pemesanan',
                array(
                    'idpemesanan' => $transidmerchant,
                ),
                array(
                    'idpemesanan' => $transidmerchant,
                    'status' => 'DP',
                )
            );

            $this->koneksi->Save($sqlupdate, array(
                $transidmerchant,
                'DP'
            ));

            echo 'Continue';
            return;
        } else {
            echo 'Stop';
            return;
        }
    }

    public function cancel($idpemesanan = null)
    {
        if ($idpemesanan == null)
            $idpemesanan = $this->session->userdata('pesanan');

        $sql = DeleteBuilder('pemesanan', array('idpemesanan' => $idpemesanan));
        $result = $this->koneksi->Save($sql, array($idpemesanan));

        redirect('/pesan/');
    }

    public function redirect()
    {
        $sucess = $this->input->post('RESULT');
        $transidmerchant = $this->input->post('TRANSIDMERCHANT');

        if (strcasecmp(strtoupper($sucess), 'SUCCESS') == 0) {
            if ($transidmerchant == null)
                $transidmerchant = $this->session->userdata('pesanan');
        }
        redirect('/pesan/summary/' . $transidmerchant);
    }
    #end region payment
<<<<<<< HEAD

    public function pdf()
    {
        $picker1 = $this->input->post('picker1');
        $picker2 = $this->input->post('picker2');
        $tipe = $this->input->post('tipe');

        $view = null;

        $begin = new DateTime(date("Y-m-d", strtotime($picker1)));
        $end = new DateTime(date("Y-m-d", strtotime($picker2)));

        if(isset($picker1)) {
            $date1 = explode(' ', $picker1);
            $date2 = explode(' ', $picker2);
            switch ($tipe) {
                case '1':
                    $sql = "select * from (
                        select q.*, p.jumlahtamu, a.nama, a.harga, t.nama namatamu, 'orang' unit,
                        'no' multiply
                        from pemesanan q
                        left join pesananakomodasi p using (idpemesanan)
                        left join akomodasi a using (idakomodasi)
                        left join tamu t using (idtamu)
                        where q.`status` = 'LUNAS'
                        union
                        select q.*, p.porsi, a.idtipemakanan, b.harga, t.nama namatamu, 'porsi' unit,
                        'yes' multiply
                        from pemesanan q
                        left join pesananmakanan p using (idpemesanan)
                        left join menumakanan a using (idmenumakanan)
                        left join tipemakanan b using (idtipemakanan)
                        left join tamu t using (idtamu)
                        where q.`status` = 'LUNAS'
                        union
                        select q.*, p.jumlah, a.nama, a.hargasewa, t.nama namatamu, 'unit' unit,
                        'yes' multiply
                        from pemesanan q
                        left join pesananperalatan p using (idpemesanan)
                        left join peralatan a using (idperalatan)
                        left join tamu t using (idtamu)
                        where q.`status` = 'LUNAS'
                        union
                        select q.*, p.jumlahpeserta, a.nama, a.harga, t.nama namatamu, 'orang' unit,
                        'yes' multiply
                        from pemesanan q
                        left join pesanankegiatan p using (idpemesanan)
                        left join kegiatan a using (idkegiatan)
                        left join tamu t using (idtamu)
                        where q.`status` = 'LUNAS'
                    ) report where jumlahtamu is not null
                    AND ((tanggalpesan) BETWEEN STR_TO_DATE('" . $begin->format("d-m-Y") . "','%d-%m-%Y') AND STR_TO_DATE('" . $end->format("d-m-Y") . "','%d-%m-%Y'))
                    order by tanggalpesan asc";
                    $stats = $this->koneksi->FetchAll($sql);
                    break;
                case '2': //pegawai
                    $sql = "select nama, alamat, notelp, jeniskelamin, status from petugas";
                    $stats = $this->koneksi->FetchAll($sql);
                    break;
                case '3': // akomodasi
                    $sql = "select nama, kapasitas, harga, COUNT(pesananakomodasi.tanggal) jumlahpesanan
                    from akomodasi LEFT JOIN pesananakomodasi USING (idakomodasi)
                    WHERE ((pesananakomodasi.tanggal) BETWEEN STR_TO_DATE('" . $begin->format("d-m-Y") . "','%d-%m-%Y') AND STR_TO_DATE('" . $end->format("d-m-Y") . "','%d-%m-%Y'))
                    GROUP BY idakomodasi asc";
                    $stats = $this->koneksi->FetchAll($sql);
                    break;
                case '4': //menu makanan
                    $sql = "select menumakanan.*, tipemakanan.harga, SUM(pesananmakanan.porsi) jumlahpesanan
                    from menumakanan LEFT JOIN pesananmakanan USING (idmenumakanan)
                    left join tipemakanan using (idtipemakanan)
                    WHERE ((pesananmakanan.tanggalpemesanan) BETWEEN STR_TO_DATE('" . $begin->format("d-m-Y") . "','%d-%m-%Y') AND STR_TO_DATE('" . $end->format("d-m-Y") . "','%d-%m-%Y'))
                    GROUP BY idmenumakanan asc";
                    $stats = $this->koneksi->FetchAll($sql);
                    break;
                case '5': //peralatan
                    $sql = "select * from peralatan";
                    $stats = $this->koneksi->FetchAll($sql);
                    break;
                case '6': //kegiatan
                    $sql = "select kegiatan.nama, kegiatan.pesertamin, kegiatan.pesertamax, kegiatan.harga, pesanankegiatan.jumlahpeserta, COUNT(pesanankegiatan.tanggal) jumlahpesanan
                    from kegiatan LEFT JOIN pesanankegiatan USING (idkegiatan)
                    WHERE ((pesanankegiatan.tanggal) BETWEEN STR_TO_DATE('" . $begin->format("d-m-Y") . "','%d-%m-%Y') AND STR_TO_DATE('" . $end->format("d-m-Y") . "','%d-%m-%Y'))
                    GROUP BY idkegiatan asc";
                    $stats = $this->koneksi->FetchAll($sql);
                    break;
            }

            echo json_encode(sizeof($stats));
        }
    }
=======
>>>>>>> c4e0f3ce92028d19d01a656d7674dcd7e1355bfc
}