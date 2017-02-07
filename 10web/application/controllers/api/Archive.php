<?php

//return model


class Archive extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('Archives_model');
        $this->load->helper('url_helper');
        $this->load->library('session');
    }

    public function index()
    {
       echo "api/archive";
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
     * use to add archive
     */
    public function add(){
      $error_code = $this->Archives_model->addArchive();
      if ($error_code) {
        $info = $this->getInfo(100,"add success","");
      } else {
        $info = $this->getInfo(-101,"fail","");
      }
      echo json_encode($info) ;
    }

    /**
     * use to delete archive
     */
    public function del(){
      $error_code = $this->Archives_model->delArchive();
      if ($error_code) {
        $info = $this->getInfo(100,"delete success","");
      } else {
        $info = $this->getInfo(-101,"fail","");
      }
      echo json_encode($info) ;
    }

    /**
     * use to update archive
     */
    public function edit(){
      $error_code = $this->Archives_model->editArchive();
      if ($error_code) {
        $info = $this->getInfo(100,"update success","");
      } else {
        $info = $this->getInfo(-101,"fail","");
      }
      echo json_encode($info) ;
    }

    /**
     * use to find archive
     */
    public function find(){
      $row = $this->Archives_model->findArchive();
      if ($row) {
        $info = $this->getInfo(100,json_encode($row),"");
      } else {
        $info = $this->getInfo(-101,"fail","");
      }
      echo json_encode($info) ;
    }
	
    // /**
//      * use to find user's archive
//      */
//     public function findUserArc($Type = 1){
//       $row = $this->Archives_model->findUserArchive($Type);
//       if ($row) {
//         $info = $this->getInfo(100,json_encode($row),"");
//       } else {
//         $info = $this->getInfo(-101,"fail","");
//       }
//       echo json_encode($info) ;
//     }
//	Please use User.php -> GetUserArchives() .

}

?>
