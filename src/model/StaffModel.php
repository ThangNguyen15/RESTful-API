<?php

/**
 * Created by PhpStorm.
 * User: thang
 * Date: 05/07/2017
 * Time: 13:29
 */

namespace Src\Model;

class StaffModel
{
    private $db_user = 'default';
    private $db_pass = 'secret';
    private $db_host = '192.168.1.34';
    private $db_name = 'default';

    function getStaffList()
    {
        $stmt = $this->connect()->prepare("SELECT * FROM nhan_vien");
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    function connect()
    {
        $conn = new \PDO("mysql:host=$this->db_host;dbname=$this->db_name", $this->db_user, $this->db_pass);
        return $conn;
    }

    function getStaffById($id)
    {
        $stmt = $this->connect()->prepare("SELECT * FROM nhan_vien WHERE id=$id");
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC)[0];
    }

    function updateStaff($id)
    {
        parse_str(file_get_contents("php://input"),$post_vars);
        $name = $post_vars["name"];
        $email = $post_vars["email"];
        $phone = $post_vars["phone"];

        $stmt = $this->connect()
            ->prepare("UPDATE nhan_vien SET name='$name', email='$email', phone='$phone' WHERE id=$id");
        $stmt->execute();
        return $this->getStaffById($id);
    }

    function deleteStaff($id)
    {
        $stmt = $this->connect()->prepare("DELETE FROM nhan_vien WHERE id=$id");
        return $stmt->execute();
    }

    function insertStaff()
    {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $pdo = $this->connect();
        $stmt = $pdo->prepare("INSERT INTO nhan_vien (name, email, phone) VALUES ('$name', '$email', '$phone')");
        $stmt->execute();
        return $this->getStaffById(intval($pdo->lastInsertId()));
    }
}