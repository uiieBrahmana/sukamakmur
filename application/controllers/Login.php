<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller
{

    private $data;

    /**
     * Login constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->data['Reason'] = '';
        $auth = $this->session->userdata('ID');
        if (isset($auth))
            redirect('/administrator/');

        $this->data['login'] = 'open';
    }

    public function index()
    {
        $submit = $this->input->post('_submit');
        if (isset($submit)) {
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            $this->Auth($username, $password);
            $auth = $this->session->userdata('role');
            if (isset($auth)) {
                switch ($auth) {
                    case 'Tamu':
                        redirect('/pesan/');
                        break;
                    case 'Manager':
                        redirect('/administrator/');
                        break;
                    case 'Administrator':
                        redirect('/administrator/');
                        break;
                    default:
                        redirect('/login/');
                        break;
                }
            } else {
                $this->data['Reason'] = 'Invalid Username or Password.';
                $this->load->view('auth/Login', $this->data);
            }

        } else {
            // untuk mengubah file view yang dituju
            $this->load->view('auth/Login', $this->data);
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
