<?php

return [
    '~^$~' => [\MyProject\Controllers\MainController::class, 'main'],  // Роут главной страницы 

    '~^catalog$~' => [\MyProject\Controllers\CatalogController::class, 'catalog'], // Роут страницы городов

    '~^catalog/(.+)/page/(\d+)$~' => [\MyProject\Controllers\CatalogController::class, 'page'], // Роут страницы определённого города
    '~^catalog/(.+)$~' => [\MyProject\Controllers\CatalogController::class, 'firstPage'], // Роут первой страницы определённого города

    '~^search/(\d+)$~' => [\MyProject\Controllers\SearchController::class, 'page'], // Роут для поиска
    '~^search(.*)$~' => [\MyProject\Controllers\SearchController::class, 'searchFunction'], // Роут для поиска http://learnphp/search

    '~^contact$~' => [\MyProject\Controllers\СontactController::class, 'contact'], // Роут страницы контактной информации

    '~^traveler$~' => [\MyProject\Controllers\TravelerController::class, 'traveler'], // Роут страницы общего списка путешественников
    '~^traveler/(.+)$~' => [\MyProject\Controllers\TravelerController::class, 'page'], // Роут страницы путешественника
];
