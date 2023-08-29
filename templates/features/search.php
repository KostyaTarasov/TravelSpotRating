<form style="margin: 10px" action="/search" method="post">
    <div class="input-group">
        <input type="text" class="form-control" name="search" placeholder="Поиск по сайту" value="<?= $_SESSION['postSearch']['search'] ?? '' ?>">
        <button class="btn btn-warning" type="submit">
            <img class="iconSearch2" src="/images/svg/search.svg">
        </button>
    </div>
</form>