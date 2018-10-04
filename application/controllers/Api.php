<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Dell PC
 * Date: 03/10/2018
 * Time: 20:12
 */

class Api extends CI_Controller
{

    public function  __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->load->view('home/api_view');
    }

}