<?php

session_start();


unset($_SESSION['iduser']);
unset($_SESSION['profile']);
unset($_SESSION['name']);

header("location: /");
