<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends CI_Controller
{

    public function index()
    {
        $this->session->unset_userdata('ID');
        $this->session->unset_userdata('nama');
        $this->session->unset_userdata('username');
        redirect('/login/');

    }

}