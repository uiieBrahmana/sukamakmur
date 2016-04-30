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

        $submit = $this->input->post('submit');
        if (isset($submit) && isset($id)) {
            $idpemesanan = $this->input->post('idpemesanan');
            $totalamount = $this->input->post('totalamount');

            $sql = "SELECT * FROM pemesanan WHERE idpemesanan = $idpemesanan";
            $data = $this->koneksi->FetchAll($sql);

            if ($data === null) {
                $this->load->view('pesanan/konfirmasigagal', $this->data);
                return;
            }

            $namafile = $_FILES['bukti']['name'];
            $ekstensifile = $_FILES['bukti']['type'];
            $filedata = $_FILES['bukti']['tmp_name'];
            $error = $_FILES['bukti']['error'];
            $size = $_FILES['bukti']['size'];

            if ($error == 0) {
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

                $this->load->view('pesanan/konfirmasiberhasil', $this->data);
            }
        } else {
            $this->load->view('pesanan/konfirmasi', $this->data);
        }
    }

}