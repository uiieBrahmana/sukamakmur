<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller
{



    public function index()
    {
        $submit = $this->input->post('_submit');
        if (isset($submit)) {
            $username = $this->input->post('username');
            $pasword = $this->input->post('password');

            $this->Auth($username, $pasword);


        } else {
            // untuk mengubah file view yang dituju
            $this->load->view('Login');

        }

    }

    function Auth($username, $password)
    {

    }

    function GetUser()
    {

    }

    /**
     * @return bool
     */
    function IsAuthenticated()
    {
        return false;
    }

    function GetRole()
    {
        $CI =& get_instance();
    }

    function RemovePresence()
    {
        @session_destroy();
    }
}
