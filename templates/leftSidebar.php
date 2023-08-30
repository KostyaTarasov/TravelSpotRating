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
        <br>
    <?php endif; ?>

    <?php if (!empty($nameCatalog)) : ?>
        <h5 style="padding-left:35px; font-size: 21px;">Фильтрация по средней оценке:</h5>
        <form method="post" action="">
            <ul style="margin: 5px;">
                <div>
                    <input type="radio" id="rating-any" name="rating" value="0" <?php if (!isset($_POST['rating']) || $_POST['rating'] === '0') echo 'checked'; ?>>
                    <label for="rating-any" data-rating="">Любая оценка</label>
                </div>
                <div>
                    <input type="radio" id="rating-1" name="rating" value="1" <?php if (isset($_POST['rating']) && $_POST['rating'] === '1') echo 'checked'; ?>>
                    <label for="rating-1" data-rating="1">1</label>
                </div>
                <div>
                    <input type="radio" id="rating-2" name="rating" value="2" <?php if (isset($_POST['rating']) && $_POST['rating'] === '2') echo 'checked'; ?>>
                    <label for="rating-2" data-rating="2">2</label>
                </div>
                <div>
                    <input type="radio" id="rating-3" name="rating" value="3" <?php if (isset($_POST['rating']) && $_POST['rating'] === '3') echo 'checked'; ?>>
                    <label for="rating-3" data-rating="3">3</label>
                </div>
                <div>
                    <input type="radio" id="rating-4" name="rating" value="4" <?php if (isset($_POST['rating']) && $_POST['rating'] === '4') echo 'checked'; ?>>
                    <label for="rating-4" data-rating="4">4</label>
                </div>
                <div>
                    <input type="radio" id="rating-5" name="rating" value="5" <?php if (isset($_POST['rating']) && $_POST['rating'] === '5') echo 'checked'; ?>>
                    <label for="rating-5" data-rating="5">5</label>
                </div>
                <input type="submit" value="Показать">
            </ul>
        </form>
    <?php endif; ?>
</aside>