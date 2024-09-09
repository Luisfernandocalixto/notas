<?php

// Maneja las vistas según el parámetro 'view'
if (isset($_GET['view'])) {
    $view = $_GET['view'];
    require 'src/App/Views/' . $view . '.php';
} else {
    require 'src/App/Views/home.php';
}

