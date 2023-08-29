<aside class="left-sidebar">
    <?php if (!empty($cpuCatalogs)) : ?>
        <h5 style="padding-left:35px; font-size: 21px;">Города:</h5>
        <ul style="margin: 5px;">
            <?php
            foreach ($cpuCatalogs as $value) { ?>
                <li class="gain-right a-edit"><a class="refSidebarCatalog" href="/catalog/<?= $value->getNameTable() ?>"><?= $value->getName() ?> </a></li>
            <?php } ?>
        </ul>
        <br>
    <?php endif; ?>
    <?php if (!empty($users)) : ?>
        <h5 style="padding-left:35px; font-size: 21px;">Путешественники:</h5>
        <ul style="margin: 5px;">
            <?php
            foreach ($users as $user) { ?>
                <li class="gain-right a-edit"><a class="refSidebarCatalog" href="/traveler/<?= $user->getNickname() ?>"><?= $user->getNickname() ?> </a></li>
            <?php } ?>
        </ul>
    <?php endif; ?>
</aside>