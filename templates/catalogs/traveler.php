<?php $title = "$travelerName";
$h1 = "$travelerName";
include __DIR__ . '/../header.php';
?>
<div class="main">
    <h1><?= $h1 ?></h1>
    <h4>Города, которые посетил путешественник <?= $travelerName ?></h4>
    <ul class="products-list">
        <?php foreach ($visitedCity as $item) : ?>
            <li class="products-item a-edit">
                <h2 class="font-text-head products-title text-big">
                    <?= $item ?>
                </h2>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
<?php include __DIR__ . '/../footer.php'; ?>