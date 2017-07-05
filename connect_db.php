<?php

/**
 * Created by PhpStorm.
 * User: thang
 * Date: 05/07/2017
 * Time: 13:29
 */
class connect_db
{
    private $db_user = 'default'; //User đăng nhập MYSQL
    private $db_pass = 'secret'; // Pass đăng nhập MySQL
    private $db_host = '192.168.1.51'; //IP, Domain kết nối
    private $db_name = 'default';//Tên CSDL

    function connect()
    {
        //Tạo biến kết nối với CSDL
        $conn = new PDO("mysql:host=$this->db_host;dbname=$this->db_name", $this->db_user, $this->db_pass);
        return $conn;
    }
}