<?php
require 'src/config.php';
require 'src/Database.php';
require 'src/Cd.php';
use App\Cd;

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = $_GET['id'];
$cdManager = new Cd();
$cd = $cdManager->lerPorId($id);

if (!$cd) {
    echo "CD não encontrado!";
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar CD</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h1>Editar CD</h1>
    <form action="salvar.php" method="post">
        <input type="hidden" name="id" value="<?= $cd['id'] ?>">
        
        <div class="form-group">
            <label for="artista">Artista</label>
            <input type="text" name="artista" id="artista" class="form-control" value="<?= htmlspecialchars($cd['artista']) ?>" required>
        </div>
         <div class="form-group">
            <label for="titulo">Título</label>
            <input type="text" name="titulo" id="titulo" class="form-control" value="<?= htmlspecialchars($cd['titulo']) ?>" required>
        </div>
        <div class="form-group">
            <label for="descricao">Descrição</label>
            <textarea name="descricao" id="descricao" class="form-control"><?= htmlspecialchars($cd['descricao']) ?></textarea>
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="preco">Preço</label>
                <input type="number" step="0.01" name="preco" id="preco" class="form-control" value="<?= htmlspecialchars($cd['preco']) ?>">
            </div>
            <div class="form-group col-md-2">
                <label for="ano">Ano</label>
                <input type="text" name="ano" id="ano" class="form-control" maxlength="4" value="<?= htmlspecialchars($cd['ano']) ?>">
            </div>
             <div class="form-group col-md-3">
                <label for="estilo">Estilo</label>
                <input type="text" name="estilo" id="estilo" class="form-control" value="<?= htmlspecialchars($cd['estilo']) ?>">
            </div>
            <div class="form-group col-md-3">
                <label for="gravadora">Gravadora</label>
                <input type="text" name="gravadora" id="gravadora" class="form-control" value="<?= htmlspecialchars($cd['gravadora']) ?>">
            </div>
        </div>

        <hr>
        <h4>Músicas</h4>
        <div id="musicas-container">
            <?php foreach ($cd['musicas'] as $musica): ?>
            <div class="form-group">
                <input type="text" name="musicas[]" class="form-control" value="<?= htmlspecialchars($musica['nome']) ?>">
            </div>
            <?php endforeach; ?>
            <?php if (empty($cd['musicas'])): ?>
             <div class="form-group">
                <input type="text" name="musicas[]" class="form-control" placeholder="Nome da música">
            </div>
            <?php endif; ?>
        </div>
        <button type="button" id="add-musica" class="btn btn-secondary btn-sm mb-3">Adicionar Música</button>
        
        <hr>
        <button type="submit" class="btn btn-success">Atualizar CD</button>
        <a href="index.php" class="btn btn-light">Cancelar</a>
    </form>
</div>

<script>
document.getElementById('add-musica').addEventListener('click', function() {
    const container = document.getElementById('musicas-container');
    const newField = document.createElement('div');
    newField.className = 'form-group';
    newField.innerHTML = '<input type="text" name="musicas[]" class="form-control" placeholder="Nome da música">';
    container.appendChild(newField);
});
</script>
</body>
</html>