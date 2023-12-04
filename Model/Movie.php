<?php

include __DIR__ . "/Genre.php";
class Movie
{
    private $id;
    private $title;
    private $overview;
    private $vote_average;
    private $poster_path;
    private $original_language;

    public $generi;
    private $lang;

    function __construct($id, $title, $overview, $vote_average, $poster_path, $original_language, $generi, $lang)
    {
        $this->id = $id;
        $this->title = $title;
        $this->overview = $overview;
        $this->vote_average = $vote_average;
        $this->poster_path = $poster_path;
        $this->original_language = $original_language;
        $this->generi = $generi;
        if ($lang == "en") {
            $this->lang = "uk";
        } elseif ($lang == "de") {
            $this->lang = 'gm';
        } else {
            $this->lang = $lang;
        }
    }

    private function flagPath()
    {
        return "https://www.worldometers.info/img/flags/$this->lang-flag.gif";

    }

    private function getVote()
    {
        $vote = ceil($this->vote_average / 2);
        $template = '<p>';
        for ($n = 1; $n <= 5; $n++) {
            if ($n <= $vote) {
                $template .= '<i class="fa-solid fa-star"></i>';
            } else {
                $template .= '<i class="fa-regular fa-star"></i>';
            }
        }
        $template .= '</p>';
        return $template;
    }

    public function printCard()
    {
        $image = $this->poster_path;
        $title = $this->title;
        $content = substr($this->overview, 0, 100) . "...";
        $custom = $this->getVote();
        $generi = $this->generi;
        $lang = $this->flagPath();
        $langName = $this->lang;
        include __DIR__ . "/../Views/card.php";
    }
}

$movieString = file_get_contents(__DIR__ . "/movie_db.json");
$movieArray = json_decode($movieString, true);
$movies = [];



foreach ($movieArray as $movie) {
    $setGenres = [];
    $numOfGenres = rand(1, 3);
    for ($i = 0; $i < $numOfGenres; $i++) {
        $currGen = $genres[rand(0, count($genres) - 1)];
        if (!in_array($currGen, $setGenres)) {
            $setGenres[] = $currGen;
        }
    }
    $movies[] = new Movie($movie['id'], $movie['title'], $movie['overview'], $movie['vote_average'], $movie['poster_path'], $movie['original_language'], $setGenres, $movie['original_language']);
}
?>