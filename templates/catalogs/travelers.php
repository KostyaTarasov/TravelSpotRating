<?php $title = "Путешественники";
$h1 = $title;
include __DIR__ . '/../header.php';
?>
<div class="main a-edit">
    <?php if (!empty($traveler)) : ?>
        <h5 style="padding-left:35px; font-size: 21px;">Путешественники:</h5>
        <ul style="margin: 5px;">
            <?php
            foreach ($traveler as $user) { ?>
                <li><a class="refSidebarCatalog" href="/traveler/<?= $user->getNickname() ?>"><?= $user->getNickname() ?> </a></li>
            <?php } ?>
        </ul>
    <?php endif; ?>
</div>

<?php include __DIR__ . '/../footer.php'; ?>