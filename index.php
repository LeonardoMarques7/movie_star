<?php
require_once("templates/header.php");


require_once("dao/MovieDao.php");

// Dao dos filmes 
$movieDao = new MovieDao($conn, $BASE_URL);

$latestMovies = $movieDao->getLatestMovies();
$actionMovies = $movieDao->getMoviesByCategory("Ação");
$AventuraMovies = $movieDao->getMoviesByCategory("Aventura");
$comedyMovies = $movieDao->getMoviesByCategory("Comédia");
$dramaMovies = $movieDao->getMoviesByCategory("Drama");
$ficcaoMovies = $movieDao->getMoviesByCategory("Ficção");
$terrorMovies = $movieDao->getMoviesByCategory("Terror");
$romanceMovies = $movieDao->getMoviesByCategory("Romance");
$animacaoMovies = $movieDao->getMoviesByCategory("Animação");
?>

<div id="main-container" class="container-fluid">
    <h2 class="section-title">Filmes novos</h2>
    <p class="section-description">Veja as críticas dos últimos filmes adicionados no MovieStar</p>
    <div class="movies-container">
        <?php

        foreach ($latestMovies as $movie) :
            require("templates/movie_card.php");
        endforeach;

        if (count($latestMovies) === 0) :
            require("templates/no_movie.php");
        endif;
        ?>

    </div>
    <!--  -->
    <h2 class="section-title">Ação</h2>
    <p class="section-description">Veja os melhores filmes de ação</p>
    <div class="movies-container">
        <?php
        foreach ($actionMovies as $movie) :
            require("templates/movie_card.php");
        endforeach;

        if (count($actionMovies) === 0) :
            require("templates/no_movie.php");
        endif;
        ?>
    </div>
    <!--  -->
    <h2 class="section-title">Aventura</h2>
    <p class="section-description">Veja os melhores filmes de aventura</p>
    <div class="movies-container">
        <?php
        foreach ($AventuraMovies as $movie) :
            require("templates/movie_card.php");
        endforeach;

        if (count($AventuraMovies) === 0) :
            require("templates/no_movie.php");
        endif;
        ?>
    </div>
    <!--  -->
    <h2 class="section-title">Comédia</h2>
    <p class="section-description">Veja os melhores filmes de comédia</p>
    <div class="movies-container">
        <?php
        foreach ($comedyMovies as $movie) :
            require("templates/movie_card.php");
        endforeach;

        if (count($comedyMovies) === 0) :
            require("templates/no_movie.php");
        endif;
        ?>
    </div>
    <!--  -->
    <h2 class="section-title">Drama</h2>
    <p class="section-description">Veja os melhores filmes de drama</p>
    <div class="movies-container">
        <?php
        foreach ($dramaMovies as $movie) :
            require("templates/movie_card.php");
        endforeach;

        if (count($dramaMovies) === 0) :
            require("templates/no_movie.php");
        endif;
        ?>
    </div>
    <!--  -->
    <h2 class="section-title">Ficção</h2>
    <p class="section-description">Veja os melhores filmes de ficção</p>
    <div class="movies-container">
        <?php
        foreach ($ficcaoMovies as $movie) :
            require("templates/movie_card.php");
        endforeach;

        if (count($ficcaoMovies) === 0) :
            require("templates/no_movie.php");
        endif;
        ?>
    </div>
    <!--  -->
    <h2 class="section-title">Terror</h2>
    <p class="section-description">Veja os melhores filmes de terror</p>
    <div class="movies-container">
        <?php
        foreach ($terrorMovies as $movie) :
            require("templates/movie_card.php");
        endforeach;

        if (count($terrorMovies) === 0) :
            require("templates/no_movie.php");
        endif;
        ?>
    </div>
    <!--  -->
    <h2 class="section-title">Romance</h2>
    <p class="section-description">Veja os melhores filmes de romance</p>
    <div class="movies-container">
        <?php
        foreach ($romanceMovies as $movie) :
            require("templates/movie_card.php");
        endforeach;

        if (count($romanceMovies) === 0) :
            require("templates/no_movie.php");
        endif;
        ?>
    </div>
    <!--  -->
    <h2 class="section-title">Animação</h2>
    <p class="section-description">Veja os melhores filmes de animação</p>
    <div class="movies-container">
        <?php
        foreach ($animacaoMovies as $movie) :
            require("templates/movie_card.php");
        endforeach;

        if (count($animacaoMovies) === 0) :
            require("templates/no_movie.php");
        endif;
        ?>
    </div>
</div>

<?php
require_once("templates/footer.php");
?>