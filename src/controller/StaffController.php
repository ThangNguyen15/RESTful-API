<?php
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

namespace Src\Controller;

use Src\Model\StaffModel;
use Src\View\StaffView;

class StaffController
{
    public $conn;
    public $model;
    public $view;

    public function __construct()
    {
        $this->model = new StaffModel();
        $this->view = new StaffView();
        $this->conn = $this->model->connect();
    }

    function getId()
    {
        $id = intval(end(explode("/", $_SERVER['REQUEST_URI'])));
        return $id;
    }

    function getResponseType() {
        return $_SERVER['HTTP_ACCEPT'];
    }

    function responseRequest($array)
    {
        if ($this->getResponseType() == 'application/json') {
            $this->view->displayResultOfRequestInJson($array);
        }
        else if($this->getResponseType() == 'application/xml') {
            $this->view->displayResultOfRequestInXml($array);
        }
        $this->conn = null;
    }

    function responseGetAllRequest($array)
    {
        if ($this->getResponseType() == 'application/json') {
            $this->view->displayResultOfRequestInJson($array);
        }
        else if($this->getResponseType() == 'application/xml') {
            $this->view->displayResultOfGetAllRequestInXml($array);
        }
        $this->conn = null;
    }

    function responseDeleteRequest()
    {
        if ($this->model->deleteStaff($this->getId())) {
            $response = array(
                'status' => 1,
                'status message' => 'Delete successful'
            );
        } else {
            $response = array(
                'status' => 0,
                'message' => 'Delete failed'
            );
        }
        $this->responseRequest($response);
    }
}

