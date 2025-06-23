<?php
// Cookie: Recupera o último artista salvo
$ultimo_artista = isset($_COOKIE['ultimo_artista']) ? htmlspecialchars($_COOKIE['ultimo_artista']) : '';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Adicionar CD</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h1>Adicionar Novo CD</h1>
    <form action="salvar.php" method="post">
        <div class="form-group">
            <label for="artista">Artista</label>
            <input type="text" name="artista" id="artista" class="form-control" value="<?= $ultimo_artista ?>" required>
        </div>
        <div class="form-group">
            <label for="titulo">Título</label>
            <input type="text" name="titulo" id="titulo" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="descricao">Descrição</label>
            <textarea name="descricao" id="descricao" class="form-control"></textarea>
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="preco">Preço</label>
                <input type="number" step="0.01" name="preco" id="preco" class="form-control">
            </div>
            <div class="form-group col-md-2">
                <label for="ano">Ano</label>
                <input type="text" name="ano" id="ano" class="form-control" maxlength="4">
            </div>
             <div class="form-group col-md-3">
                <label for="estilo">Estilo</label>
                <input type="text" name="estilo" id="estilo" class="form-control">
            </div>
            <div class="form-group col-md-3">
                <label for="gravadora">Gravadora</label>
                <input type="text" name="gravadora" id="gravadora" class="form-control">
            </div>
        </div>

        <hr>
        <h4>Músicas</h4>
        <div id="musicas-container">
            <div class="form-group">
                <input type="text" name="musicas[]" class="form-control" placeholder="Nome da música">
            </div>
        </div>
        <button type="button" id="add-musica" class="btn btn-secondary btn-sm mb-3">Adicionar Música</button>
        
        <hr>
        <button type="submit" class="btn btn-success">Salvar CD</button>
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