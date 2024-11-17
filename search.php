<?php
require_once("templates/header.php");


require_once("dao/MovieDao.php");

// Dao dos filmes 
$movieDao = new MovieDao($conn, $BASE_URL);

// Resgata a busca do usuário
$q = filter_input(INPUT_GET, "q");

$movies = $movieDao->findByTitle($q);

?>

<div id="main-container" class="container-fluid">
    <h2 class="section-title" id="search-title">Você está buscando por: <span id="search-result"><?= $q ?></span></h2>
    <p class="section-description">Resultados de busca retornados com base na sua pesquisa.</p>
    <div class="movies-container">
        <?php

        foreach ($movies as $movie) :
            require("templates/movie_card.php");
        endforeach;

        if (count($movies) === 0) :
            echo "<p class='empty-list' id='no-search-result'>Não há filmes para esta busca, <a href='" . $BASE_URL . "' class='back-link'>voltar</a>.";
        endif;
        ?>

    </div>
</div>

<?php
require_once("templates/footer.php");
?>