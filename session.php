<?php
if (empty($_SESSION['iduser']) || empty($_SESSION['profile'])) {
    header("location: /");
}
