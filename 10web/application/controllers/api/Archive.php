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


//--------------------------->2017年2月15日增加
    /**
     * 根据用户ID获取用户发布的文章
     */
    public function findUserPubArc(){
      //参数检测
      if(!isset($_POST['UserID'])){
        $info = $this->getInfo(-1,"缺少参数","");
        echo json_encode($info);
        return ;
      }
      $user_id = $_POST['UserID'];
      $result = $this->Archives_model->findArcByUserID($user_id,1);
      $info = $this->getInfo(100,$result,"");
      echo json_encode($info);
    }

    /**
     * 根据session获取当前用户的所有文章(除了删除的)
     */
    public function findMyArc(){
        if(!isset($this->session->userdata['info'][0]['ID'])){
           $info = $this->getInfo(-8,"未登录","");
           echo json_encode($info);
           return ;
        }

        $user_id = $this->session->userdata['info'][0]['ID'];
        $result = $this->Archives_model->findAllArc($user_id);
        $info = $this->getInfo(100,$result[0],"");
        echo json_encode($info);
    }

    /**
     * 获取推荐的文章,以10篇为一组
     */
    public function getComArc($range = 0){
      $result = $this->Archives_model->getComArc($range);
      $info = $this->getInfo(100,$result,"");
      echo json_encode($info);
    }

    public function search(){
      echo "还未开放";
    }
}

?>
