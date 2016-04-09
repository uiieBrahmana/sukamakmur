<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller
{


    /**
     * Login constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $auth = $this->session->userdata('ID');
        if (isset($auth))
            redirect('/administrator/');
    }

    public function index()
    {
        $submit = $this->input->post('_submit');
        if (isset($submit)) {
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            $this->Auth($username, $password);
            $auth = $this->session->userdata('role');
            if (isset($auth))
                switch($auth) {
                    case 'Tamu':
                        redirect('/pengunjung/');
                        break;
                    case 'Manager':
                        redirect('/manager/');
                        break;
                    case 'Administrator':
                        redirect('/administrator/');
                        break;
                    default:
                        break;
                }
            else
                $this->load->view('auth/GagalLogin');

        } else {
            // untuk mengubah file view yang dituju
            $this->load->view('auth/Login');
        }

    }

    function Auth($username, $password)
    {
        $hasilLogin = $this->koneksi->fetchAll(
            "SELECT idpetugas as ID, nama, notelp, username, `password`, `status` FROM `petugas`
            WHERE username = '$username' AND `password` = '$password'
            UNION SELECT idtamu, nama, notelp, username, `password`, 'Tamu' as `status` FROM `tamu`
            WHERE username = '$username' AND `password` = '$password'"
        );

        if (isset($hasilLogin[0])) {
            $this->session->set_userdata('ID', $hasilLogin[0]['ID']);
            $this->session->set_userdata('nama', $hasilLogin[0]['nama']);
            $this->session->set_userdata('username', $hasilLogin[0]['username']);
            $this->session->set_userdata('role', $hasilLogin[0]['status']);
        }
    }

    function logout()
    {
        $this->session->unset_userdata('ID');
        $this->session->unset_userdata('nama');
        $this->session->unset_userdata('username');
        redirect('/login/');
    }
}
