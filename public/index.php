<?php
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
/**
 * Created by PhpStorm.
 * User: thang
 * Date: 18/07/2017
 * Time: 10:33
 */

use Src\Model\StaffModel;
use Src\Controller\StaffController;

require '../vendor/autoload.php';

$request = end(explode("/", $_SERVER['REQUEST_URI']));
$method = $_SERVER['REQUEST_METHOD'];

$controller = new StaffController();
$model = new StaffModel();

switch ($method) {
    case 'GET':
        if ($request == 'member') {
            $controller->responseGetAllRequest($model->getStaffList());
        } else {
            $controller->responseRequest($model->getStaffById(getId()));
        }
        break;
    case 'POST':
        $controller->responseRequest($model->insertStaff());
        break;
    case 'DELETE':
        $controller->responseDeleteRequest();
        break;
    case 'PUT':
        $controller->responseRequest($model->updateStaff(getId()));
        break;
    default:
        break;

}

function getId()
{
    $id = intval(end(explode("/", $_SERVER['REQUEST_URI'])));
    return $id;
}





