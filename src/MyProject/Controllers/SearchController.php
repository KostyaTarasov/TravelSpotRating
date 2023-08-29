<?php

namespace MyProject\Controllers;

use MyProject\Models\Articles\SearchModel;
use MyProject\Exceptions\InvalidArgumentException;

session_start();
class SearchController extends AbstractController
{
    public function searchFunction()
    {
        if ($_POST['search'] != "") {
            try {
                $_SESSION['postSearch'] = $_POST;
                $_SESSION['countArticle'] = SearchModel::countArticles($_POST);
            } catch (InvalidArgumentException $e) {
                $this->view->renderHtml('features/searchPage.php', [
                    'error' => $e->getMessage()
                ]);
                return;
            }
        } else {
            header('Location: /');
            return;
        }
        $this->page(1);
    }

    public function page(int $pageNum) // Экшн страниц с найденными отзывами
    {
        $pagesCount = SearchModel::getPagesCount(5, $_SESSION['countArticle']);
        $this->view->renderHtml('features/searchPage.php', [
            'articles' => SearchModel::getPage($pageNum, 5, $_SESSION['postSearch']), // Для вывода по 5 записей на n странице
            'pagesCount' => $pagesCount,
            'currentPageNum' => $pageNum, // передаём номер текущей страницы в шаблон
            'previousPageLink' => $pageNum > 1
                ? '/search/' . ($pageNum - 1)
                : null,
            'nextPageLink' => $pageNum < $pagesCount
                ? '/search/' . ($pageNum + 1)
                : null
        ]);
    }
}
