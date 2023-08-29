<?php

namespace MyProject\Controllers;

use MyProject\Models\Articles\Article;
use MyProject\Models\Articles\Catalog;
use MyProject\Models\Articles\Attractions;

class CatalogController extends AbstractController
{
    public function catalog()  // Экшн страницы "Города"
    {
        $this->view->renderHtml('catalogs/catalog.php', [
            'articles' => Catalog::getPage(1, 100),
        ]);
    }

    public function firstPage() // Экшн первой страницы определённого города
    {
        $this->page(1);
    }

    public function page(int $pageNum) // Экшн страницы определённого города
    {
        $nameTableCatalog = Article::getTableName();
        if (!$nameTableCatalog) {
            throw new \MyProject\Exceptions\NotFoundException();
        }

        $amount = 8;
        $pagesCount = Article::getPagesCount($amount);
        $articles = Article::getPage($pageNum, $amount);
        
        $attractionsClass = new Attractions;
        $articles = $attractionsClass->getNameAttractions($articles);
        $attractions = $attractionsClass->getAttraction($nameTableCatalog, $articles);
        $this->view->renderHtml('catalogs/products.php', [
            'nameCatalog' => Article::getNameCatalog($nameTableCatalog),
            'nameTableCatalog' => $nameTableCatalog,
            'articles' => $articles,
            'pagesCount' => Article::getPagesCount($amount),
            'currentPageNum' => $pageNum,
            'previousPageLink' => $pageNum > 1
                ? ($pageNum - 1)
                : null,
            'nextPageLink' => $pageNum < $pagesCount
                ? ($pageNum + 1)
                : null,
            "attractions" => $attractions,
            "travelers" => Article::getUniqueTravelers($articles),
        ]);
    }
}
