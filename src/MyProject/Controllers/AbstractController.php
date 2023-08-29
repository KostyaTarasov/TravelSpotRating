<?php

namespace MyProject\Controllers;

use MyProject\Models\Users\User;
use MyProject\View\View;
use MyProject\Models\Articles\Catalog;

abstract class AbstractController
{
    /** @var View */
    protected $view;

    /** @var User|null */
    protected $users;

    public function __construct()
    {
        $this->view = new View(__DIR__ . '/../../../templates');
        $this->view->setVar('cpuCatalogs', Catalog::getCPU());
        $this->view->setVar('users', User::getAllNickname());
    }
}
