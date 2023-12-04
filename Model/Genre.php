<?php

class Genre
{
    public $name;

    public function __construct($name)
    {
        $this->name = $name;
    }
}

$genreString = file_get_contents(__DIR__ . "/genres_db.json");
$genreArray = json_decode($genreString, true);
$genres = [];
foreach ($genreArray as $genre) {
    $genres[] = new Genre($genre);
}

?>