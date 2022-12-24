<?php

// ประกาศใช้คลาส AltoRouter ในชื่อ Router
use AltoRouter as AltoRouter;
use eftec\bladeone\BladeOne;
use Symfony\Component\Dotenv\Dotenv as Dotenv;

require_once(__DIR__ . '/../views/Database.php');
require __DIR__ . './../vendor/autoload.php';

// MODE_DEBUG allows to pinpoint troubles.



$dotenv = new Dotenv;
$dotenv->load(__DIR__ . '/../.env');


$router = new AltoRouter();

// กำหนด route ในเว็บ
$router->map("GET", "/", function () {

  $views = __DIR__ . '/../views';
  $cache = __DIR__ . '/../cache';
  $blade = new BladeOne($views, $cache);
  $blade->setBaseUrl($_ENV['BASE_URL']); 
  echo $blade->run("pages.home", array("variable1" => "value1x"));
});

$router->map("GET", "/new-note", function () {
  // require('../views/Pages/new-note');
  $views = __DIR__ . '/../views';
  $cache = __DIR__ . '/../cache';
  $blade = new BladeOne($views, $cache);
  echo $blade->run("pages.new-note", array("variable1" => "value1x"));
});

$router->map("POST", "/new-note", function () {
  // require __DIR__ . "/../views/Pages/save-note.php";
  $views = __DIR__ . '/../views';
  $cache = __DIR__ . '/../cache';
  $blade = new BladeOne($views, $cache);
  echo $blade->run("pages.save-note", array("variable1" => "value1x"));
});

$router->map("GET", "./note/[i:id]", function ($id) {
  // ไฟล์ views-note.php จะเรียกใช้ $id ได้ทันที  เพราะอยู่ใน scope เดียวกัน
  // require __DIR__ . "./../views/Pages/views-note.php";
  $views = __DIR__ . '/../views';
  $cache = __DIR__ . '/../cache';
  $blade = new BladeOne($views, $cache);
  echo $blade->run("pages.views-note", array("variable1" => "value1x"));
});

// ประมวลผล route
$match = $router->match();

if (is_array($match) && is_callable($match['target'])) {
  // เรียก callback เพื่อดึงหน้าที่ต้องการมาแสดง
  call_user_func_array($match['target'], $match['params']);
} else {
  // แสดงหน้า 404
  // require __DIR__ . "/../views/Pages/404.php";
  $views = __DIR__ . '/../views';
  $cache = __DIR__ . '/../cache';
  $blade = new BladeOne($views, $cache);
  echo $blade->run("pages.404", array("variable1" => "value1x"));
}
