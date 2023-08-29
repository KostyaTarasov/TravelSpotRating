<?php

namespace MyProject\Controllers;

use MyProject\Models\Articles\Article;
use MyProject\Models\Users\User;

class TravelerController extends AbstractController
{
    public function traveler()
    {
        $this->view->renderHtml('catalogs/travelers.php', [
            'traveler' => User::getAllNickname(),
        ]);
    }

    public function page()
    {
        $travelerName = Article::getTableName();
        if (!$travelerName) {
            throw new \MyProject\Exceptions\NotFoundException();
        }

        $extraVars = $this->view->getExtraVars();
        $users = $extraVars['users'];
        $catalogs = $extraVars['cpuCatalogs'];
        $user = new User;
        $idTraveler = $user->getUserIdByNickname($travelerName, $users);
        $article = new Article;
        $this->view->renderHtml('catalogs/traveler.php', [
            'travelerName' => $travelerName,
            'visitedCity' => $article->getCitybyNickname($catalogs, $idTraveler)
        ]);
    }
}
