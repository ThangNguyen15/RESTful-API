<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require ('Model.php');
class test
{
    public $_conn;

    /**
     * test constructor.
     */
    public function __construct()
    {
        $this->_conn = (new connect_db())->connect();
        $this->process();
    }



    function process()
    {
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET':
                if (!isset($_GET['id'])) {
                    $this->get_staff_list();
                } else {
                    $this->get_staff_by_id();
                }
                break;
            default:
                break;
        }
    }

    function get_staff_list()
    {
        //Truy vấn
        $stmt = $this->_conn->prepare("SELECT * FROM nhan_vien");
        $stmt->execute();
        //Tạo bảng lưu thông tin
        $staffs = array();
        while ($rs = $stmt->fetchAll(PDO::FETCH_ASSOC)) {
            $staffs[] = $rs;
        }

        $format = $this->get_request_type();
        //Trả về kiểu json
        if ($format == 'json') {
            header('Content-type: application/json; charset=utf-8');
            echo json_encode($staffs);
        }
        if ($format == 'xml') {
            header('Content-type: text/xml; charset=utf-8');
            echo '<users>';
            foreach ($staffs as $staff) {
                echo '<user>';
                if (is_array($staff)) {
                    foreach ($staff as $key => $value) {
                        echo '<', $key, '>', $value['id'], '</', $value['name'], '>';
                    }
                }
                echo '</user>';
            }
            echo '</users>';
        }
        $this->_conn = null;
    }

    function get_staff_by_id() {
        //Truy vấn
        $id = $_GET['id'];
        $stmt = $this->_conn->prepare("SELECT * FROM nhan_vien WHERE id = $id");
        $stmt->execute();
        //Tạo bảng lưu thông tin
        $students = array();
        while ($rs = $stmt->fetchAll(PDO::FETCH_ASSOC)) {
            $students[] = $rs;
        }

        $format = $this->get_request_type();
        //Trả về kiểu json
        if ($format == 'json') {
            header('Content-type: application/json; charset=utf-8');
            echo json_encode($students);
        }
        if ($format == 'xml') {
            header('Content-type: text/xml; charset=utf-8');
            echo '<users>';
            foreach ($students as $student) {
                echo '<user>';
                if (is_array($student)) {
                    foreach ($student as $key => $value) {
                        echo '<', $key, '>', $value['id'], '</', $value['name'], '>';
                    }
                }
                echo '</user>';
            }
            echo '</users>';
        }
        $this->_conn = null;

    }



    function get_request_type()
    {
        //Lấy kiểu định dạng muốn lấy của request
        $formatList = array('json', 'xml');
        if (isset($_GET['format'])) {
            $format = $_GET['format'];
        } else {
            $format = 'json';
        }
        if (!in_array($format, $formatList)) {
            $format = 'json';
        }
        return $format;
    }
}

$test = new test();
?>