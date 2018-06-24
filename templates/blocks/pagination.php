<?php
/**
 * @var int $currentPage - текущая страница
 * @var int $lastPage - последняя страница
 */

$count_pages      = $lastPage;
$active           = $currentPage;
$count_show_pages = 3;

if ($count_pages < 1) return;

/**
 * Дальше идёт вычисление первой выводимой страницы и последней
 * (чтобы текущая страница была где-то посредине, если это возможно,
 * и чтобы общая сумма выводимых страниц была равна count_show_pages,
 * либо меньше, если количество страниц недостаточно)
 **/
$left  = $active - 1;
$right = $count_pages - $active;
if ($left < floor($count_show_pages / 2)) {
    $start = 1;
} else {
    $start = $active - floor($count_show_pages / 2);
}
$end = $start + $count_show_pages - 1;
if ($end > $count_pages) {
    $start -= ($end - $count_pages);
    $end   = $count_pages;
    if ($start < 1) $start = 1;
}
?>

<style>
    .row-pagination{
        margin-top: 30px;
    }
</style>
<div class="row justify-content-center row-pagination">
    <ul class="pagination">
        <li class="page-item <?= ($active == 1 ? 'disabled' : ''); ?>" title="Первая страница">
            <a class="page-link" href="<?= getQueryString(['page'=>1]) ?>">
                <span aria-hidden="true">&laquo;&laquo;</span>
            </a>
        </li>
        <li class="page-item <?= ($active == 1 ? 'disabled' : ''); ?>" title="Предыдущая страница">
            <a class="page-link" href="<?= getQueryString(['page'=>($active - 1)]) ?>">
                <span aria-hidden="true">&laquo;</span>
            </a>
        </li>
        
        <?php for ($i = $start; $i <= $end; $i++) : ?>
            <?php if ($i == $active) : ?>
                <li class="page-item active">
                    <span class="page-link"><?= $i ?></span>
                </li>
            <?php else: ?>
                <li class="page-item">
                    <a class="page-link" href="<?= getQueryString(['page'=>$i]); ?>"><?=$i;?></a>
                </li>
            <?php endif; ?>
        <?php endfor; ?>

        <li class="page-item <?= $active == $count_pages ? 'disabled' : ''; ?>" title="Следующая страница">
            <a class="page-link" href="<?= getQueryString(['page'=>($active + 1)]);?>">
                <span aria-hidden="true">&raquo;</span>
            </a>
        </li>
        <li class="page-item <?= $active == $count_pages ? 'disabled' : ''; ?>" title="Последняя страница">
            <a class="page-link" href="<?= getQueryString(['page'=>$count_pages]) . $count_pages ?>">
                <span aria-hidden="true">&raquo;&raquo;</span>
            </a>
        </li>
    </ul>
</div>