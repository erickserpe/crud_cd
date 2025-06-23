<?php
require '../src/config.php';
require '../src/Database.php';
require '../src/Cd.php';

use App\Cd;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cdManager = new Cd();
    
    $dadosCd = [
        'artista' => $_POST['artista'] ?? '',
        'titulo' => $_POST['titulo'] ?? '',
        'descricao' => $_POST['descricao'] ?? '',
        'preco' => $_POST['preco'] ? (float)$_POST['preco'] : null,
        'ano' => $_POST['ano'] ?? '',
        'estilo' => $_POST['estilo'] ?? '',
        'gravadora' => $_POST['gravadora'] ?? ''
    ];

    $musicas = $_POST['musicas'] ?? [];

    if (isset($_POST['id']) && !empty($_POST['id'])) {
        $id = $_POST['id'];
        $sucesso = $cdManager->atualizar($id, $dadosCd, $musicas);
    } else {
        $sucesso = $cdManager->criar($dadosCd, $musicas);
    }

    if ($sucesso) {
        header("Location: index.php");
    } else {
        echo "Ocorreu um erro ao salvar o CD.";
    }
} else {
    header("Location: index.php");
}