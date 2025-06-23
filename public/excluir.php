<?php
require 'src/config.php';
require 'src/Database.php';
require 'src/Cd.php';
use App\Cd;

if (isset($_GET['id'])) {
    $cdManager = new Cd();
    $id = $_GET['id'];
    
    if ($cdManager->deletar($id)) {
        header("Location: index.php");
    } else {
        echo "Erro ao excluir o CD.";
    }
} else {
    header("Location: index.php");
}