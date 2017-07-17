<?php

/**
 * Created by PhpStorm.
 * User: thang
 * Date: 05/07/2017
 * Time: 13:29
 */
class Model
{
    private $db_user = 'default';
    private $db_pass = 'secret';
    private $db_host = '192.168.1.34';
    private $db_name = 'default';

    function get_staff_list()
    {
        $stmt = $this->connect()->prepare("SELECT * FROM nhan_vien");
        $stmt->execute();

        $staffs_info = array();
        while ($data = $stmt->fetchAll(PDO::FETCH_ASSOC)) {
            $staffs_info[] = $data;
        }
        return $staffs_info;
    }

    function connect()
    {
        $conn = new PDO("mysql:host=$this->db_host;dbname=$this->db_name", $this->db_user, $this->db_pass);
        return $conn;
    }

    function get_staff_by_id($id)
    {
        $stmt = $this->connect()->prepare("SELECT * FROM nhan_vien WHERE id=$id");
        $stmt->execute();

        $staff_info = array();
        while ($data = $stmt->fetchAll(PDO::FETCH_ASSOC)) {
            $staff_info[] = $data;
        }
        return $staff_info;
    }

    function update_staff($id)
    {
        parse_str(file_get_contents("php://input"),$post_vars);
        $name = $post_vars["name"];
        $email = $post_vars["email"];
        $phone = $post_vars["phone"];

        $stmt = $this->connect()
            ->prepare("UPDATE nhan_vien SET name='$name', email='$email', phone='$phone' WHERE id=$id");
        return $stmt->execute();
    }

    function delete_staff($id)
    {
        $stmt = $this->connect()->prepare("DELETE FROM nhan_vien WHERE id=$id");
        return $stmt->execute();
    }

    function insert_staff()
    {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];

        $stmt = $this->connect()
            ->prepare("INSERT INTO nhan_vien (name, email, phone) VALUES ('$name', '$email', '$phone')");
        return $stmt->execute();
    }
}