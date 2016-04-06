<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Administrator extends CI_Controller
{

    public function index()
    {
        $this->load->view('AdminBeranda');
    }

    public function buatpesananfasilitas()
    {
        $this->load->view('BuatPesananFasilitas');
    }

    public function buatpesananfinish()
    {
        $this->load->view('BuatPesananFinish');
    }

    public function buatpesanankegiatan()
    {
        $this->load->view('BuatPesananKegiatan');
    }

    public function adminlihatakun()
    {
        $data['Akun'] = $this->akomodasi->FetchAll("SELECT * FROM `petugas`");
        $this->load->view('AdminLihatAkun', $data);
    }

    public function adminbuatakun()
    {
        $submit = $this->input->post('_submit');
        if ($submit) {
            $nama = $this->input->post('nama');
            $tanggallahir = $this->input->post('tanggallahir');
            $jeniskelamin = $this->input->post('jeniskelamin');
            $alamat = $this->input->post('alamat');
            $email = $this->input->post('email');
            $notelp = $this->input->post('notelp');
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            $queryakun = InsertBuilder('tamu', array(
                'nama' => $nama,
                'tanggallahir' => $tanggallahir,
                'jeniskelamin' => $jeniskelamin,
                'alamat' => $alamat,
                'email' => $email,
                'notelp' => $notelp,
                'username' => $username,
                'password' => $password
            ));

            $idtamu = $this->akomodasi->Save($queryakun, array($nama, $tanggallahir,
                $jeniskelamin, $alamat, $email, $notelp, $username, $password));

            if ($idtamu) {
                echo 'success';
            } else {
                echo 'failed';
            }

        }
        $this->load->view('AdminBuatAkun');
    }

    public function admintambahpesanan()
    {
        $this->load->view('AdminTambahPesanan');
    }

    public function adminlihatpesanan()
    {
        $this->load->view('AdminListPesanan');
    }

    public function adminkonfirmasipesanan()
    {
        $this->load->view('AdminKonfirmasiPesanan');
    }

    public function adminkonfirmasipembayaran()
    {
        $this->load->view('AdminKonfirmasiPembayaran');
    }

    public function admintambahmakanan()
    {
        $data['TipeMakanan'] = $this->akomodasi->FetchAll("SELECT * FROM TIPEMAKANAN");

        $submit = $this->input->post('_submit');
        if ($submit) {
            $tipe = $this->input->post('tipe');
            $keterangan = $this->input->post('keterangan');

            $querymenumakan = InsertBuilder('menumakanan', array(
                'idtipemakanan' => $tipe,
                'keterangan' => $keterangan,
            ));

            $idmenumakanan = $this->akomodasi->Save($querymenumakan, array($tipe, $keterangan));

            if ($idmenumakanan) {
                echo 'success';
            } else {
                echo 'failed';
            }
        }
        $this->load->view('AdminTambahMakanan', $data);
    }

    public function adminlihatmakanan()
    {
        $this->load->view('AdminLihatMakanan');
    }

    public function adminlihatpegawai()
    {
        $data['Akun'] = $this->akomodasi->FetchAll("SELECT * FROM `petugas`");
        $this->load->view('AdminLihatPegawai', $data);
    }

    public function admintambahpegawai()
    {
        $submit = $this->input->post('_submit');
        if ($submit) {

        }
        $this->load->view('AdminTambahPegawai');
    }

    public function adminlihatkegiatan()
    {
        $data['Kegiatan'] = $this->akomodasi->FetchAll("SELECT * FROM `kegiatan`");
        $this->load->view('AdminLihatKegiatan',$data);
    }

    public function detailprofilpegawai()
    {
        $this->load->view('AdminProfilPegawai');
    }

    public function admintambahkegiatan()
    {
        if (isset($submit)) {
            $nama = $this->input->post('nama');
            $lamakegiatan = $this->input->post('lamakegiatan');
            $pesertamin = $this->input->post('pesertamin');
            $pesertamax = $this->input->post('pesertamax');
            $harga = $this->input->post('harga');
            $keterangan = $this->input->post('keterangan');


            $query = InsertBuilder('Peralatan', array(
                'nama' => $nama,
                'lamakegiatan' => $lamakegiatan,
                'pesertamin' => $pesertamin,
                'pesertamax' => $pesertamax,
                'harga' => $harga,
                'keterangan' => $keterangan
            ));
            $result = $this->akomodasi->Save($query, array($nama, $lamakegiatan, $pesertamin, $pesertamax, $harga, $keterangan));

            if ($result) {
                echo 'sukses';
            } else {
                echo 'gagal';
            }

        }
        $this->load->view('AdminTambahKegiatan');
    }

    public function adminlihatlaporan()
    {
        $this->load->view('AdminLihatLaporan');
    }

    public function adminpemesanandetail()
    {
        $this->load->view('AdminPemesananDetail');
    }

    public function approvepembayaran()
    {
        $this->load->view('ApprovePembayaran');
    }

    public function adminakomodasi()
    {
        $this->load->view('AdminAkomodasi');
    }

    public function detailakomodasi()
    {
        $this->load->view('AdminAkomodasiDetail');
    }

    public function adminmakanan()
    {
        $this->load->view('AdminMakanan');
    }

    public function admintambahtipemakanan()
    {
        $this->load->view('AdminTambahTipeMakanan');
    }

    public function adminperalatan()
    {
        $this->load->view('AdminPeralatan');
    }

    public function adminkegiatan()
    {
        $this->load->view('AdminKegiatan');
    }

    public function admintambahakomodasi()
    {
        $submit = $this->input->post('_submit');

        if (isset($submit)) {
            $nama = $this->input->post('nama');
            $keterangan = $this->input->post('keterangan');
            $kapasitas = $this->input->post('kapasitas');
            $status = $this->input->post('status');
            $harga = $this->input->post('harga');

            $namafile = $_FILES['fotoakomodasi']['name'];
            $ekstensifile = $_FILES['fotoakomodasi']['type'];
            $filedata = $_FILES['fotoakomodasi']['tmp_name'];
            $error = $_FILES['fotoakomodasi']['error'];
            $size = $_FILES['fotoakomodasi']['size'];

            if ($error == 0) {
                $queryfoto = InsertBuilder('fotoakomodasi', array(
                    'namafile' => $namafile,
                    'ekstensifile' => pathinfo($namafile, PATHINFO_EXTENSION),
                    'filedata' => $filedata
                ));

                $idfoto = $this->akomodasi->Save($queryfoto, array($namafile, pathinfo($namafile, PATHINFO_EXTENSION),
                    file_get_contents($filedata)));

                if ($idfoto) {
                    $query = InsertBuilder('Akomodasi', array(
                        'nama' => $nama,
                        'keterangan' => $keterangan,
                        'kapasitas' => $kapasitas,
                        'status' => $status,
                        'harga' => $harga,
                        'fotoakomodasi' => $idfoto
                    ));
                    $result = $this->akomodasi->Save($query, array($nama, $keterangan, $kapasitas, $status, $harga, $idfoto));

                    if ($result) {
                        echo 'sukses';
                    } else {
                        echo 'gagal';
                    }
                }
            }
        }

        $this->load->view('AdminTambahAkomodasi');
    }

    public function adminlihatakomodasi()
    {
        $data['Akomodasi'] = $this->akomodasi->FetchAll("SELECT * FROM `AKOMODASI`");
        $this->load->view('AdminLihatAkomodasi', $data);
    }

    public function adminlihatperalatan()
    {
        $data['Peralatan'] = $this->akomodasi->FetchAll("SELECT * FROM `PERALATAN`");
        $this->load->view('AdminLihatPeralatan',$data);
    }

    public function admintambahperalatan()
    {
        $submit = $this->input->post('_submit');

        if (isset($submit)) {
            $nama = $this->input->post('nama');
            $hargasewa = $this->input->post('hargasewa');
            $keterangan = $this->input->post('keterangan');
            $jumlah = $this->input->post('jumlah');




                    $query = InsertBuilder('Peralatan', array(
                        'nama' => $nama,
                        'hargasewa' => $hargasewa,
                        'keterangan' => $keterangan,
                        'jumlah' => $jumlah
                    ));
                    $result = $this->akomodasi->Save($query, array($nama, $hargasewa, $keterangan, $jumlah));

                    if ($result) {
                        echo 'sukses';
                    } else {
                        echo 'gagal';
                    }

            }

        $this->load->view('AdminTambahPeralatan');
    }

}
