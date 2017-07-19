<?php

/**
 * Created by PhpStorm.
 * User: thang
 * Date: 12/07/2017
 * Time: 09:14
 */

namespace Src\View;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


class StaffView
{
    public function displayResultOfRequestInJson($response)
    {
        header('Content-type: application/json; charset=utf-8');
        echo json_encode($response);
    }

    public function displayResultOfRequestInXml($response)
    {
        header('Content type: application/xml');
        echo "<staff>";
        foreach ($response as $tag => $val) {
            echo "<$tag>" . "$val" . "</$tag>";
        }
        echo "</staff>";
    }

    public function displayResultOfGetAllRequestInXml($response)
    {
        header('Content type: application/xml');

        foreach ($response as $key => $value) {
            echo "<staff>";
            foreach ($value as $tag => $val) {
                echo "<$tag>" . "$val" . "</$tag>";
            }
            echo "</staff>";
        }
    }
}