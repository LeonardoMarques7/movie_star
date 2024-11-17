<?php
require_once("templates/header.php");

// Verifica se user está autenticado
require_once("models/User.php");
require_once("dao/UserDao.php");

$user = new User();
$userDao = new UserDAO($conn, $BASE_URL);

$userData = $userDao->verifyToken(true);
?>

<div id="main-container" class="container-fluid">
    <div class="offset-md-4 col-md-4 new-movie-container">
        <h1 class="page-title">Adicionar Filme</h1>
        <p class="page-description">Adicione sua critíca e compartilhe com o mundo!</p>
        <form action="<?= $BASE_URL ?>movie_process.php" method="post" id="add-movie-form" enctype="multipart/form-data">
            <input type="hidden" name="type" value="create">
            <div class="form-group">
                <label for="title">Título:</label>
                <input type="text" name="title" id="title" class="form-control" placeholder="Digite o título do seu filme">
            </div>
            <div class="form-group">
                <label for="image">Imagem:</label>
                <input type="file" name="image" class="form-control-file" id="image">
            </div>
            <div class="form-group">
                <label for="length">Duração:</label>
                <input type="text" name="length" id="length" class="form-control" placeholder="Digite a duração do filme">
            </div>
            <div class="form-group">
                <label for="category">Categoria:</label>
                <select name="category" id="category" class="form-control">
                    <option value="">Selecione</option>
                    <option value="Ação">Ação</option>
                    <option value="Aventura">Aventura</option>
                    <option value="Comédia">Comédia</option>
                    <option value="drama">Drama</option>
                    <option value="Ficção">Ficção</option>
                    <option value="Terror">Terror</option>
                    <option value="Romance">Romance</option>
                    <option value="Animação">Animação</option>
                </select>
            </div>
            <div class="form-group">
                <label for="trailer">Trailer:</label>
                <input type="text" name="trailer" id="trailer" class="form-control" placeholder="Insira o link do trailer">
            </div>
            <div class="form-group">
                <label for="description">Descrição:</label>
                <textarea name="description" class="form-control" id="description" rows="5" placeholder="Descreva o filme..."></textarea>
            </div>
            <input type="submit" class="btn card-btn" value="Adicionar filme">
        </form>
    </div>
</div>

<?php
require_once("templates/footer.php");
?>