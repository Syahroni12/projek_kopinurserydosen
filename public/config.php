<?php

date_default_timezone_set('Asia/Jakarta');

$database = (object) [
    'host' => 'dbserver.local',
    'user' => 'is4ac_nursery',
    'password' => 'is4ac123',
    'db' => 'is4ac_nursery',
    'port' => 3306,
];

$conn = new mysqli(
    $database->host,
    $database->user,
    $database->password,
    $database->db,
    $database->port
);

if ($conn->connect_error)
    die("Connection failed" . $conn->connect_error);
