<?php
// ประกาศใช้คลาส AltoRouter ในชื่อ Router
use AltoRouter as AltoRouter;

require __DIR__.'/../vendor/autoload.php';

$router = new AltoRouter();

// กำหนด route ในเว็บ
$router->map( "GET", "/", function() {
  echo "5555";
  // require __DIR__ . "./../src/Pages/home.php";
} );

// ประมวลผล route
$match = $router->match();

if( is_array( $match ) && is_callable( $match['target'] ) ) {
  // เรียก callback เพื่อดึงหน้าที่ต้องการมาแสดง
  call_user_func_array( $match['target'], $match['params'] );
} else {
  // แสดงหน้า 404
  require __DIR__ . "/../src/Pages/404.php";
}
