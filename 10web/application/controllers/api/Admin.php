<?php
class Admin extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('usermessage_model');
        $this->load->helper('url_helper');
    }

    public function index()
    {
       echo "api/admin";
    }

    /**
     * use to make a info
     *
     * @param int $Flag - the flag
     * @param string $Content -the content
     * @param string $Extra -the extra info
     * @return array
     */
    private function getInfo($Flag = 101,$Content = "",$Extra = ""){
      return array("Flag" => $Flag,"Content" => $Content,"Extra" => $Extra);
    }

    

    /**
    *   给用户发消息,如果有用户id传入就给该用户发送消息，否则给所有用户发送消息
    */
   

    
}

?>
