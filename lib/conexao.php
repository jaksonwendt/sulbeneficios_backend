<?php
try {
    $conn = new PDO("mysql:host=localhost; dbname=perguntas", 'root', '');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    print_r($e->getMessage());
}
