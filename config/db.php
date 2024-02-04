<?php
$host = 'localhost';
$dbname = 'hornbill-blog';
$dbuser = 'root';
$dbpass = '';
$connect = new PDO("mysql:host=$host;dbname=$dbname", $dbuser, $dbpass);
if (!$connect) {
  echo "connection failure";
}
