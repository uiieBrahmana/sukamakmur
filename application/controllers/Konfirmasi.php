<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Konfirmasi extends CI_Controller
{

    private $data;

    function _remap($param)
    {
        $this->index($param);
    }

    public function __construct()
    {
        parent::__construct();

        $this->userId = $this->session->userdata('ID');
        $this->role = $this->session->userdata('role');

        $this->data['ID'] = $this->session->userdata('ID');
        $this->data['Role'] = $this->session->userdata('role');

        $this->data['conf'] = 'open';
    }

    public function index($id = null)
    {
        if ($id != null)
            $this->data['idpemesanan'] = is_numeric($id) ? $id : '';
        else
            $this->data['idpemesanan'] = '';

        $this->data['reason'] = "Konfirmasi Berhasil.";

        $submit = $this->input->post('submit');
        if (isset($submit) && isset($id)) {
            $idpemesanan = $this->input->post('idpemesanan');

            $sql = "SELECT a.*, IFNULL(SUM(b.nominal),0) terbayar, b.idpembayaran,
                b.ekstensifile FROM pemesanan a
                LEFT JOIN pembayaran b ON (a.idpemesanan = b.idpemesanan)
                WHERE a.idpemesanan = $idpemesanan
                GROUP BY a.idpemesanan, b.idpemesanan;";
            $data = $this->koneksi->FetchAll($sql);

            if ($data == null) {
                $this->data['reason'] = 'kode pemesanan tidak ditemukan';
                $this->load->view('pesanan/konfirmasigagal', $this->data);
                return;
            }

            if($data[0]['ekstensifile'] != null) {
                $this->data['reason'] = 'konfirmasi pembayaran sebelumnya telah diterima.';
                $this->load->view('pesanan/konfirmasiberhasil', $this->data);
                return;
            }

            $namafile = $_FILES['bukti']['name'];
            $ekstensifile = $_FILES['bukti']['type'];
            $filedata = $_FILES['bukti']['tmp_name'];
            $error = $_FILES['bukti']['error'];
            $size = $_FILES['bukti']['size'];

            if ($size > 10485760) {
                $this->data['reason'] = 'ukuran file terlalu besar';
                $this->load->view('pesanan/konfirmasigagal', $this->data);
                return;
            }

            if ($error == 0) {
                /*
                $sqlbayar = InsertBuilder('pembayaran',
                    array(
                        'idpemesanan' => $idpemesanan,
                        'nominal' => $totalamount,
                        'metodepembayaran' => 'TRANSFER',
                        'bukti' => '',
                        'ekstensifile' => $ekstensifile,
                    )
                );

                $this->koneksi->Save($sqlbayar, array(
                    'idpemesanan' => $idpemesanan,
                    'nominal' => $totalamount,
                    'metodepembayaran' => 'TRANSFER',
                    'bukti' => file_get_contents($filedata),
                    'ekstensifile' => $ekstensifile,
                ));
                */

                $sqlbayar = UpdateBuilder('pembayaran',
                    array(
                        'idpemesanan' => $idpemesanan,
                        'idpembayaran' => $data[0]['idpembayaran'],
                    ),
                    array(
                        'idpemesanan' => $idpemesanan,
                        'idpembayaran' => $data[0]['idpembayaran'],
                        'metodepembayaran' => 'TRANSFER',
                        'bukti' => '',
                        'ekstensifile' => $ekstensifile,
                    )
                );

                $this->koneksi->Save($sqlbayar, array(
                    'idpemesanan' => $idpemesanan,
                    'idpembayaran' => $data[0]['idpembayaran'],
                    'metodepembayaran' => 'TRANSFER',
                    'bukti' => file_get_contents($filedata),
                    'ekstensifile' => $ekstensifile,
                ));

                $this->load->view('pesanan/konfirmasiberhasil', $this->data);
            }
        } else {
            $this->load->view('pesanan/konfirmasi', $this->data);
        }
    }

}