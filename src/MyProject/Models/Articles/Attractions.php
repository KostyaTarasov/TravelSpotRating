<?php

namespace MyProject\Models\Articles;

use MyProject\Models\ActiveRecordEntity;
use MyProject\Services\Db;

class Attractions extends ActiveRecordEntity
{
    /** @var string */
    protected $name;

    /** @var string */
    protected $distance;

    /** @var int */
    protected $averageRating;

    protected static function getTableName(): string
    {
        return 'attractions';
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return htmlentities($this->id);
    }

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
    public function getDistance(): string
    {
        return htmlentities($this->distance);
    }

    /**
     * @return int
     */
    public function getAverageRating(): int
    {
        return htmlentities($this->averageRating);
    }

    /**
     * @param int $averageRating
     */
    public function setAverageRating(int $averageRating): void
    {
        $this->averageRating = $averageRating;
    }

    /**
     * @param array $articles
     * @return array
     */
    public function getNameAttractions(array $articles): ?array
    {
        $attractionsName = self::getAllNameAttractions();
        foreach ($articles as $article) {
            $articleAttractionId = (int) $article->getIdAttraction();

            foreach ($attractionsName as $attraction) {
                if ($attraction->getId() === $articleAttractionId) {
                    $nameAttraction = $attraction->getName();
                    $article->setNameAttraction($nameAttraction);
                    break;
                }
            }
        }
        return $articles;
    }

    /**
     * @return array
     */
    public static function getAllNameAttractions(): ?array
    {
        $db = Db::getInstance();
        return $db->query(
            'SELECT `id`, `name` FROM `' . static::getTableName() . '`;',
            [],
            static::class
        );
    }

    public function getAttraction(string $nameTableCatalog, array $articles): array
    {
        $idCatalog = $this->getIdCatalog($nameTableCatalog);
        $attractions = $this->getAttractionsById($idCatalog);
        return $this->addAverageRating($articles, $attractions);
    }

    /**
     * @param string $nameTableCatalog
     * @return int
     */
    public function getIdCatalog(string $nameTableCatalog): int
    {
        $nameTableCatalog = self::replaceuUderline($nameTableCatalog);
        $db = Db::getInstance();
        return (int) $db->query(
            'SELECT id FROM catalog WHERE cpu_name_catalog = :cpu_name_catalog;',
            [':cpu_name_catalog' => $nameTableCatalog],
            static::class
        )[0]->id;
    }

    /**
     * @param int $id
     * @return array
     */
    public static function getAttractionsById(int $id): ?array
    {
        $db = Db::getInstance();
        $entities = $db->query(
            'SELECT * FROM `' . static::getTableName() . '` WHERE id_catalog=:id;',
            [':id' => $id],
            static::class
        );
        return $entities ? $entities : null;
    }

    public static function addAverageRating(array $articles, array $attractions): ?array
    {
        foreach ($attractions as $attraction) {
            $totalRatings = 0;
            $count = 0;

            foreach ($articles as $article) {
                if ($article->getIdAttraction() === $attraction->getId()) {
                    $totalRatings += $article->getRatings();
                    $count++;
                }
            }

            if ($count > 0) {
                $averageRating = $totalRatings / $count;
                $attraction->setAverageRating($averageRating);
            } else {
                $attraction->setAverageRating(0);
            }
        }
        return $attractions;
    }
}
