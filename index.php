<?php
require 'src/config.php';
require 'src/Database.php';
require 'src/Cd.php';
use App\Cd;

$cdManager = new Cd();
$cds = $cdManager->lerTodos();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de CDs</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h1>CDs Cadastrados</h1>
    <a href="/public/adicionar.php" class="btn btn-primary mb-3">Adicionar Novo CD</a>
    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>Artista</th>
                <th>Título</th>
                <th>Ano</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($cds) > 0): ?>
                <?php foreach ($cds as $cd): ?>
                <tr>
                    <td><?= htmlspecialchars($cd['artista']) ?></td>
                    <td><?= htmlspecialchars($cd['titulo']) ?></td>
                    <td><?= htmlspecialchars($cd['ano']) ?></td>
                    <td>
                        <a href="/public/editar.php $cd['id'] ?>" class="btn btn-sm btn-warning">Editar</a>
                        <a href="/public/excluir.php $cd['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir este CD?');">Excluir</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4" class="text-center">Nenhum CD cadastrado.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
</body>
</html>