<?php
require_once(__DIR__ . '/../view/Database.php');
require __DIR__ . './../vendor/autoload.php';
// ประกาศใช้คลาส AltoRouter ในชื่อ Router
use AltoRouter as AltoRouter;
use Symfony\Component\Dotenv\Dotenv as Dotenv;

use eftec\bladeone\BladeOne;

$views = __DIR__ . '/views';
$cache = __DIR__ . '/cache';
$blade = new BladeOne($views, $cache, BladeOne::MODE_DEBUG); // MODE_DEBUG allows to pinpoint troubles.
echo $blade->run("hello", array("variable1" => "value1")); // it calls /views/hello.blade.php

$dotenv = new Dotenv;
$dotenv->load(__DIR__ . '/../.env');


$router = new AltoRouter();

// กำหนด route ในเว็บ
$router->map("GET", "/", function () {
});

$router->map("GET", "/new-note", function () {
  require('../view/Pages/new-note');
});

$router->map("POST", "/new-note", function () {
  require __DIR__ . "/../view/Pages/save-note.php";
});

$router->map("GET", "./note/[i:id]", function ($id) {
  // ไฟล์ view-note.php จะเรียกใช้ $id ได้ทันที  เพราะอยู่ใน scope เดียวกัน
  require __DIR__ . "./../view/Pages/view-note.php";
});

// ประมวลผล route
$match = $router->match();

if (is_array($match) && is_callable($match['target'])) {
  // เรียก callback เพื่อดึงหน้าที่ต้องการมาแสดง
  call_user_func_array($match['target'], $match['params']);
} else {
  // แสดงหน้า 404
  require __DIR__ . "/../view/Pages/404.php";
}
