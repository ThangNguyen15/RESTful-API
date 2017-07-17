<?php
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
require('Model.php');
require('View.php');

class Controller
{
    public $_conn;
    public $_model;
    public $_view;

    public function __construct()
    {
        $this->_model = new Model();
        $this->_view = new View();
        $this->_conn = $this->_model->connect();
        $this->process();
    }

    function get_id()
    {
        $link = $_SERVER['REQUEST_URI'];
        $id = intval(end(explode("/", $link)));
        return $id;
    }

//    function handle_URL() {
//        $url = explode('/', $_GET['controller']);
//        if ($url[0] = "staff") {
//            return $url[1];
//        }
//    }

    function process()
    {
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET':
                if ((strval(end(explode("/", $_SERVER['REQUEST_URI'])))) === "member") {
                    $this->response_get_request($this->_model->get_staff_list());
                } else {
                    $this->response_get_request($this->_model->get_staff_by_id($this->get_id()));
                }
                break;
            case 'POST':
                $this->response_insert_request();
                break;
            case 'DELETE':
                $this->response_delete_request();
                break;
            case 'PUT':
                $this->response_update_request();
                break;
            default:
                break;
        }
    }

    function response_get_request($array)
    {
        $this->_view->display_result_of_request($array);

        $this->_conn = null;
    }

    function response_insert_request()
    {
        if ($this->_model->insert_staff()) {
            $response = array(
                'status' => 1,
                'status message' => 'Insert successful'
            );
        } else {
            $response = array(
                'status' => 0,
                'status message' => 'Insert failed'
            );
        }

        $this->_view->display_result_of_request($response);
        $this->_conn = null;
    }

    function response_delete_request()
    {
        if ($this->_model->delete_staff($this->get_id())) {
            $response = array(
                'status' => 1,
                'status message' => 'Delete successful'
            );
        } else {
            $response = array(
                'status' => 0,
                'status message' => 'Delete failed'
            );
        }

        $this->_view->display_result_of_request($response);
        $this->_conn = null;
    }

    function response_update_request()
    {
        if ($this->_model->update_staff($this->get_id())) {
            $response = array(
                'status' => 1,
                'status message' => 'Update successful'
            );
        } else {
            $response = array(
                'status' => 0,
                'status message' => 'Update failed'
            );
        }

        $this->_view->display_result_of_request($response);
        $this->_conn = null;
    }
}

$controller = new Controller();
