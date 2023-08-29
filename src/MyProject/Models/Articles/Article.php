<?php

namespace MyProject\Models\Articles;

use MyProject\Models\ActiveRecordEntity;
use MyProject\Models\Users\User;
use MyProject\Services\Db;

class Article extends ActiveRecordEntity
{
    /** @var string */
    protected $name;

    /** @var string */
    protected  $text;

    /** @var int */
    protected  $score;

    /** @var string */
    protected  $authorId;

    /** @var string */
    protected  $createdAt;

    protected  $content;

    /** @var int */
    protected $idAttraction;

    /** @var string */
    protected $nameAttraction;

    /**
     * @return string
     */
    public function getName(): string
    {
        return htmlentities($this->name);
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return htmlentities($this->text); // htmlentities() чтобы обезопастить от XSS-атаки (например от комментах в виде <script>...)
    }

    /**
     * @return int
     */
    public function getRatings(): int
    {
        return htmlentities($this->score);
    }

    public static function getTableName(): string
    {
        if ($_SERVER['REQUEST_URI'] == "/" || preg_replace('/[0-9]/', '', $_SERVER['REQUEST_URI']) == "/") {
            return 'moscow';
        }

        $pregRetult = preg_replace("/[0-9]/", '', str_replace(array('catalog', 'traveler', 'product', 'page', '/', 'add', 'edit', 'del', 'bye'), '', $_GET['route']));
        $pregRetult = ActiveRecordEntity::replaceDash($pregRetult);
        return $pregRetult;
    }

    /**
     * @return int
     */
    public function getAuthor(): User
    {
        $this->authorId;
        return User::getById($this->authorId);
    }

    public function getIdAttraction(): int
    {
        return $this->idAttraction;
    }

    public function getNameAttraction(): string
    {
        return $this->nameAttraction;
    }

    public function setNameAttraction($nameAttraction): string
    {
        return $this->nameAttraction = $nameAttraction;
    }

    public function setName($name1): string
    {
        return $this->name = $name1;
    }

    public function setText($text1): string
    {
        return $this->text = $text1;
    }

    public function setRating($score): string
    {
        return $this->score = $score;
    }

    public function setAuthorId($authorId1): string
    {
        return $this->authorId = $authorId1;
    }

    /**
     * @param User $author
     */
    public function setAuthor(User $author): void
    {
        $this->authorId = $author->getId();
    }

    //* Markdown-разметка. Будет прогонять текст статьи через парсер, прежде чем его вернуть
    public function getParsedText(): string
    {
        $parser = new \Parsedown();
        return $parser->text($this->getText());
    }

    public static function getUniqueTravelers(array $articles): array
    {
        $uniqueTravelers = [];

        foreach ($articles as $item) {
            $authorNickname = $item->getAuthor()->getNickname();
            if (!in_array($authorNickname, $uniqueTravelers)) {
                $uniqueTravelers[] = $authorNickname;
            }
        }

        return $uniqueTravelers;
    }

    public function getCitybyNickname(array $catalogs, int $idTraveler): array
    {
        $visitedCityName = [];

        foreach ($catalogs as $item) {
            $tableName = ActiveRecordEntity::replaceDash($item->getNameTable());

            if ($this->checkVisitedCity($tableName, $idTraveler)) {
                $visitedCityName[] = $item->getName();
            }
        }

        return $visitedCityName;
    }

    public static function checkVisitedCity(string $tableName, int $idTraveler): bool
    {
        $db = Db::getInstance();
        return (bool) $db->query(
            sprintf(
                'SELECT 1 FROM `%s` WHERE author_id=%d',
                $tableName,
                $idTraveler
            ),
            [],
            static::class
        );
    }
}
