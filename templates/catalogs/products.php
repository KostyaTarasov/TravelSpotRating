<?php $title = "$nameCatalog";
$h1 = "$nameCatalog";
include __DIR__ . '/../header.php';
?>

<div class="main">
    <h1><?= $h1 ?></h1>
    <br>
    <?php if (!empty($attractions)) : ?>
        <h4>Достопримечательности города <?= $nameCatalog ?></h4>
    <?php endif; ?>
    <ul class="products-list">
        <?php foreach ($attractions as $item) : ?>
            <li class="products-item a-edit">
                <h2 class="font-text-head products-title text-big">
                    <?= $item->getName() ?>
                </h2>
                <p class="margin-null">Удаленность от центра: <?= $item->getDistance() ?> км</p>
                <br>
                <p class="margin-null">Cредняя оценка: <?= $item->getAverageRating() ?></p>
            </li>
        <?php endforeach; ?>
    </ul>
    <br>
    <h4>Путешественники побывавшие в городе</h4>
    <ul class="products-list">
        <?php foreach ($travelers as $item) : ?>
            <li class="products-item a-edit" onclick="location.href='/traveler/<?= $item ?>'">
                <h2 class="font-text-head products-title text-big">
                    <?= $item ?>
                </h2>
            </li>
        <?php endforeach; ?>
    </ul>
    <br>
    <h4>Отзывы</h4>
    <ul class="products-list">
        <?php foreach ($articles as $item) : ?>
            <li class="products-item a-edit">
                <h2 class="font-text-head products-title text-big">
                    <?= $item->getNameAttraction() ?>
                </h2>
                <h6 class="margin-null">
                    <?= $item->getName() ?>
                </h6>
                <p class="margin-null"><?= $item->getParsedText() ?></p>
                <hr class="margin-null" />
                <p class="margin-null">Автор: <?= $item->getAuthor()->getNickname() ?></p>
                <p class="margin-null">Оценка: <?= $item->getRatings() ?></p>
            </li>
        <?php endforeach; ?>
    </ul>

    <nav aria-label="Пацинация страниц">
        <ul class="pagination justify-content-center">
            <?php if ($previousPageLink != null) : ?>
                <li class="page-item">
                    <a class="page-link" href="/catalog/<?= $nameTableCatalog ?>/page/<?= $previousPageLink ?>"><img class="vertical-bottom" src="/images/svg/arrow-left-circle.svg"></a>
                </li>
            <?php else : ?>
                <li class="page-item disabled">
                    <a class="page-link"><img class="vertical-bottom" src="/images/svg/arrow-left-circle-inactive.svg"></a>
                </li>
            <?php endif; ?>
            <?php for ($pageNum = 1; $pageNum <= $pagesCount; $pageNum++) : ?>
                <?php if ($currentPageNum === $pageNum) : ?>
                    <li class="page-item active" aria-current="page">
                        <a class="page-link my-pagination-active"><?= $pageNum ?></a>
                    </li>
                <?php else : ?>
                    <li class="page-item"><a class="page-link my-pagination" href="/catalog/<?= $nameTableCatalog ?>/page/<?= $pageNum ?>"><?= $pageNum ?></a></li>
                <?php endif; ?>
            <?php endfor; ?>
            <?php if ($nextPageLink !== null) : ?>
                <li class="page-item">
                    <a class="page-link" href="/catalog/<?= $nameTableCatalog ?>/page/<?= $nextPageLink ?>"><img class="vertical-bottom" src="/images/svg/arrow-right-circle.svg"></a>
                </li>
            <?php else : ?>
                <li class="page-item disabled">
                    <a class="page-link"><img class="vertical-bottom" src="/images/svg/arrow-right-circle-inactive.svg"></a>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
</div>
<?php include __DIR__ . '/../footer.php'; ?>