<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title><?= $title ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/../www/styles/styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="shortcut icon" href="/images/personal/favicon.ico" type="image/x-icon">
</head>

<body>
    <div>
        <div class="site">
            <div class="header sticky-top">
                <header>
                    <div class="header-top">
                        <div class="header-mobile">
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                <nav class="navbar navbar-dark">
                                    <div class="container-fluid">
                                        <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarToggleMenu" aria-controls="navbarToggleMenu">
                                            <span class="navbar-toggler-icon"></span>
                                        </button>
                                    </div>
                                </nav>
                                <a href="/"><img class="logo" src="/images/personal/logo.png "></a>
                                <div class="icon-profile">
                                    <a href="/../users/login" data-bs-toggle="collapse" data-bs-target="#collapseProfile">
                                        <svg width="40" height="40" viewBox="0 0 15 15">
                                            <use xlink:href="/images/svg/person.svg#icon-profile-id"></use>
                                        </svg>
                                    </a>
                                </div>
                            </div>

                            <div class="collapse navigation-menu" id="navbarToggleMenu">
                                <nav class="navbar navbar-dark">
                                    <div class="container-fluid">
                                        <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarToggleMenu">
                                            <svg id="close-icon" class="close-icon" width="1.5em" height="1.5em" viewBox="0 0 1024 1024" fill="grey">
                                                <path d="M866.646 157.397c8.24 8.246 13.332 19.638 13.332 32.217s-5.095 23.972-13.332 32.219v0l-290.179 290.156 290.179 290.179c8.246 8.248 13.352 19.65 13.352 32.235 0 10.944-3.854 20.988-10.287 28.85l0.062-0.081-3.131 3.462c-8.25 8.258-19.654 13.365-32.251 13.365-10.954 0-21.004-3.862-28.864-10.296l0.081 0.062-3.439-3.131-290.179-290.179-290.123 290.179c-8.25 8.256-19.654 13.363-32.251 13.363-25.182 0-45.598-20.413-45.598-45.598 0-12.591 5.099-23.981 13.35-32.235l290.156-290.179-290.156-290.123c-8.258-8.25-13.365-19.654-13.365-32.251 0-10.954 3.862-21.004 10.296-28.864l-0.062 0.081 3.131-3.462c8.25-8.258 19.654-13.365 32.251-13.365 10.954 0 21.004 3.862 28.864 10.296l-0.081-0.062 3.462 3.131 290.123 290.156 290.179-290.156c8.246-8.24 19.638-13.332 32.217-13.332s23.972 5.095 32.219 13.332v0z"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </nav>
                                <?php include __DIR__ . '/features/search.php'; ?>
                                <ul class="navbar-nav navbar-list">
                                    <div class="dropend">
                                        <li><a class="dropdown-item navbar-text btn dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Города</a>
                                            <ul class="dropdown-menu navigation-menu-catalog">
                                                <div class="dropstart navigation-menu-catalog-back">
                                                    <a class="dropdown-item navbar-text dropdown-toggle">Назад</a>
                                                </div>
                                                <?php
                                                foreach ($cpuCatalogs as $value) { ?>
                                                    <li><a class="dropdown-item navbar-text" href="/catalog/<?= $value->getNameTable() ?>"><?= $value->getName() ?></a></li>
                                                <?php } ?>
                                            </ul>
                                        </li>
                                    </div>
                                    <li><a class="dropdown-item navbar-text" href="/../templates/pages/about.php">О себе</a></li>
                                    <li><a class="dropdown-item navbar-text" href="/contact">Контакты</a></li>
                                </ul>
                                <br>
                                <ul class="navbar-text" style="list-style-type: none; padding-left: 10px;">
                                    <li>г.Киров, ул.Ленина 1</li>
                                    <li>Пн. - Пт 08:00 - 18:00</li>
                                    <li>Сб. - Вс выходной</li>
                                    <br>
                                    <li><img class="iconSmall" src="/images/svg/phone1.svg"> 8-800-800-8888</li>
                                    <li>k.a.tarasov@yandex.ru</li>
                                </ul>
                            </div>
                        </div>

                        <div class="header-pc header-top">
                            <div style="display: flex; justify-content: center;">
                                <div class="header-pc-common text-header" style="display: flex; justify-content: space-between;">
                                    <div>
                                        <a style="font-weight:normal;">г.Киров, ул.Ленина 1
                                            <div class="overlay">
                                                <ul class="card card-body">
                                                    <li>г.Киров, ул.Ленина 1</li>
                                                    <li>Пн. - Пт 08:00 - 18:00</li>
                                                    <li>Сб. - Вс выходной</li>
                                                    <br>
                                                    <li>8-800-800-8888</li>
                                                    <li>k.a.tarasov@yandex.ru</li>
                                                </ul>
                                            </div>
                                        </a>
                                    </div>
                                    <div>
                                        <a href="/">Главная</a>
                                        <a href="/../templates/pages/about.php">О себе</a>
                                    </div>
                                    <div>
                                        <a><img class="iconSmall" src="/images/svg/phone1.svg"> 8-800-800-8888</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="header-pc header-bottom-common">
                        <div class="header-bottom header-pc-common">
                            <div class="header-bottom-pc">
                                <div class="col-auto">
                                    <div class="row">
                                        <div class="col-7">
                                            <a href="/"><img class="logo" src="/images/personal/logo.png"></a>
                                        </div>
                                        <div class="col-5">
                                            <a class="btn btn-warning" style="margin: 0.5em 0 0.5em 0" href="/catalog">
                                                <img class="iconSmall" src="/images/svg/menu.svg"> Города
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <?php include __DIR__ . '/features/search.php'; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </header>
            </div>

            <?php if (empty($_REQUEST['route']) || $_REQUEST['route'] != 'catalog') include __DIR__ . '/leftSidebar.php' ?>