<?php include_once __DIR__ . '/template/head.php'; ?>
<main class="main">
    <?php
    $pics = array_values(array_diff(scandir(__DIR__. '/assets/img/books-cover/'), ['.','..']));
    foreach($pics as $i => $p) {
        $pic = substr($p, 0, strpos($p, '.'));
        ?>
        <section class="book-card">
            <header class="book-head">
                <a href="#"><h3><?= $pic; ?></h3></a>
            </header>
            <article class="book-body">
                <img src="/assets/img/books-cover/<?= $pic; ?>.png" alt="<?= $pic; ?>">
                <p>
                    Lorem architecto quis sunt blanditiis cum, delectus Dicta necessitatibus dolorum sit quos tempore laboriosam! Ullam ratione unde tenetur esse obcaecati. Minus officia ex commodi modi officiis. Ipsam possimus reprehenderit reiciendis!
                </p>
            </article>
            <footer class="book-foot"><a href="#">READ MORE</a></footer>
        </section>
        <?php if ($i % 5 === 4) { ?>
            <br style="clear: both:">
        <?php } ?>
    <?php } ?>
    <br style="clear: both;">
</main>
<?php include_once __DIR__ . '/template/foot.php'; ?>
