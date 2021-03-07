<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kp extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('session');
    }

    public function index()
    {
        $this->template->load('layouts', 'kp/aju_kp');
    }

    public function aju_sidang()
    {
        $this->template->load('layouts', 'kp/aju_sidang');
    }

    public function bimbingan()
    {
        $this->template->load('layouts', 'kp/bimbingan');
    }

    public function sidang()
    {
        $this->template->load('layouts', 'kp/sidang');
    }
}
