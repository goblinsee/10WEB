<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Message extends CI_Controller {

    public function __construct(){
      parent::__construct();
    }

    public function index()
    {
       $this->load->view('message/message');
    }

    public function detail($uid = null){
      $this->load->view('message/message_detail');
    }
}

?>
