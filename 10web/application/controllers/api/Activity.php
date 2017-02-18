<?php

//return model


class Activity extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('Activities_model');
        $this->load->helper('url_helper');
        $this->load->library('session');
    }

    public function index()
    {
       echo "api/activity";
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
     * use to add activity
     */
    public function add(){
      $error_code = $this->Activities_model->addActivity();
      if ($error_code) {
        $info = $this->getInfo(100,"add activity success","");
      } else {
        $info = $this->getInfo(-101,"fail","");
      }
      echo json_encode($info) ;
    }

    /**
     * use to delete activity
     */
    public function del(){
      $error_code = $this->Activities_model->delActivity();
      if ($error_code) {
        $info = $this->getInfo(100,"delete activity success","");
      } else {
        $info = $this->getInfo(-101,"fail","");
      }
      echo json_encode($info) ;
    }

    /**
     * use to update activity
     */
    public function edit(){
      $error_code = $this->Activities_model->editActivity();
      if ($error_code) {
        $info = $this->getInfo(100,"update activity success","");
      } else {
        $info = $this->getInfo(-101,"fail","");
      }
      echo json_encode($info) ;
    }

    /**
     * use to find activity
     */
    public function find(){
      $row = $this->Activities_model->findActivity();
      if ($row) {
        $info = $this->getInfo(100,json_encode($row),"");
      } else {
        $info = $this->getInfo(-101,"fail","");
      }
      echo json_encode($info) ;
    }

}

?>
