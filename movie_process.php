<?php

require_once("globals.php");
require_once("db.php");
require_once("models/Movie.php");
require_once("models/Message.php");
require_once("dao/MovieDao.php");
require_once("dao/UserDao.php");

$message = new Message($BASE_URL);
$userDao = new UserDAO($conn, $BASE_URL);
$movieDao = new MovieDao($conn, $BASE_URL);

// Resgata o tipo do form
$type = filter_input(INPUT_POST, "type");

// Resgata dados do usuário
$userData = $userDao->verifyToken();

if ($type === "create") {
    // Receber os dados dos inputs

    $title = filter_input(INPUT_POST, "title");
    $description = filter_input(INPUT_POST, "description");
    $trailer = filter_input(INPUT_POST, "trailer");
    $category = filter_input(INPUT_POST, "category");
    $length = filter_input(INPUT_POST, "length");

    $movie = new Movie();

    // Validação mínima de dados
    if (!empty($title) && !empty($description) && !empty($category)) {
        $movie->title = $title;
        $movie->description = $description;
        $movie->trailer = $trailer;
        $movie->category = $category;
        $movie->length = $length;
        $movie->users_id = $userData->id;

        // Upload de imagem do filme
        if (isset($_FILES["image"]) && !empty($_FILES["image"]["tmp_name"])) {
            $image = $_FILES["image"];

            if (in_array($image["type"], ["image/jpeg", "image/jpg", "image/png"])) {

                // Checa se é jpg
                if (in_array($image["type"], ["image/jpeg", "image/jpg"])) {
                    $imageFile = imagecreatefromjpeg($image["tmp_name"]);
                } else {
                    $imageFile = imagecreatefrompng($image["tmp_name"]);
                }

                // Gerando o nome da imagem
                $imageName = $movie->imageGenerateName();

                imagejpeg($imageFile, "./img/movies/" . $imageName, 100);

                $movie->image = $imageName;
            } else {
                $message->setMessage("Tipo inválido de imagem, envie jpg ou png!", "error", "editprofile.php");
            }
        }

        $movieDao->create($movie);
    } else {
        $message->setMessage("Você precisa adicionar pelo menos: <strong>título, descrição e categoria</strong>", "error", "back");
    }
} else if ($type === "delete") {

    // Receber os dados do form
    $id = filter_input(INPUT_POST, "id");

    $movie = $movieDao->findById($id);

    if ($movie) {
        // Verificar se o filme é do user
        if ($movie->users_id === $userData->id) {
            $movieDao->destroy($movie->id);
        }
    } else {
        $message->setMessage("Informações inválidas!", "error", "index.php");
    }
} else if ($type === "update") {
    $title = filter_input(INPUT_POST, "title");
    $description = filter_input(INPUT_POST, "description");
    $trailer = filter_input(INPUT_POST, "trailer");
    $category = filter_input(INPUT_POST, "category");
    $length = filter_input(INPUT_POST, "length");
    $id = filter_input(INPUT_POST, "id");

    $movie = $movieDao->findById($id);

    // Verifica se encontro filme
    if ($movie) {
        // Verificar se o filme é do user
        if ($movie->users_id === $userData->id) {
            // Validação mínima de dados
            if (!empty($title) && !empty($description) && !empty($category)) {
                // Edição do filme
                $movie->title = $title;
                $movie->description = $description;
                $movie->trailer = $trailer;
                $movie->category = $category;
                $movie->length = $length;

                if (isset($_FILES["image"]) && !empty($_FILES["image"]["tmp_name"])) {
                    $image = $_FILES["image"];

                    if (in_array($image["type"], ["image/jpeg", "image/jpg", "image/png"])) {

                        // Checa se é jpg
                        if (in_array($image["type"], ["image/jpeg", "image/jpg"])) {
                            $imageFile = imagecreatefromjpeg($image["tmp_name"]);
                        } else {
                            $imageFile = imagecreatefrompng($image["tmp_name"]);
                        }

                        // Gerando o nome da imagem
                        $imageName = $movie->imageGenerateName();

                        imagejpeg($imageFile, "./img/movies/" . $imageName, 100);

                        $movie->image = $imageName;
                    } else {
                        $message->setMessage("Tipo inválido de imagem, envie jpg ou png!", "error", "editprofile.php");
                    }
                }

                $movieDao->update($movie);
            } else {
                $message->setMessage("Você precisa adicionar pelo menos: <strong>título, descrição e categoria</strong>", "error", "back");
            }
        }
    } else {
        $message->setMessage("Informações inválidas!", "error", "index.php");
    }
} else {
    $message->setMessage("Informações inválidas!", "error", "index.php");
}
