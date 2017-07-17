<?php

/**
 * Created by PhpStorm.
 * User: thang
 * Date: 12/07/2017
 * Time: 09:14
 */
class View
{
    public function display_result_of_request($response)
    {
        header('Content-type: application/json; charset=utf-8');
        echo json_encode($response);
    }
}