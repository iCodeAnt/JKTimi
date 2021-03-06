<?php
/**
 * Created by PhpStorm.
 * User: sun
 * Date: 16/6/6
 * Time: 下午8:48
 */

if (!isset($_SERVER['HTTP_USER_AGENT'])) {
    die('请设置User-Agent');
}

if (empty($_POST['id'])) {
    die('id is empty');
}

if (empty($_POST['category'])) {
    die('category is empty');
}

if (empty($_POST['money'])) {
    die('money is empty');
}

if (empty($_POST['modifiedtime'])) {
    die('modifiedtime is empty');
}

$id = intval($_POST['id']);
$category = strval($_POST['category']);
$money = floatval($_POST['money']);
$modifiedtime = $_POST['modifiedtime'];

//链接数据库
require_once 'functions.php';

$mysqli = connectDb();
$mysqli->query("UPDATE account SET category = '$category' , money = '$money' , modifiedtime = '$modifiedtime'  WHERE id=$id");

//读取HTTP_USER_AGENT
$devicetype = $_SERVER['HTTP_USER_AGENT'];

if (strnatcmp('iOS', $devicetype) == 0) {
    if($mysqli->errno) {
        echo '服务器端账目修改失败 错误原因: '.$mysqli->error;
    } else {
        echo '服务器端账目修改成功 Success';
    }
} else {
    if($mysqli->errno) {
        echo "<script>alert('Operation Failed With Error: '.$mysqli->error);location='http://2.jktimiserver.applinzi.com/editaccount.php';</script>";
    } else {
        echo "<script>alert('Operation Success');location='http://2.jktimiserver.applinzi.com/accountBook.php';</script>";
    }
}