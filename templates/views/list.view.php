<?php
/**
 * Tasks list
 *
 * @var array $viewData - данные шаблона
 */
?>
<style>
    .card-wrap{
        display: flex;
        justify-content: center;
    }
    .card__badge{
        display: none;
    }
    .card--closed .card__badge{
        display: inline-block;
    }
</style>
<h1>Список задач</h1>
<?php getTemplateSortTasks();?>
<br>
<div class="row justify-content-center">
    <?php foreach ($viewData['tasks'] as $task) :?>
    <div class="col card-wrap">
        <div class="card js-card <?=$task['is_closed']?'card--closed':'';?>"
             style="width: 320px;"
             data-id="<?=$task['id'];?>">
            <?php if($task['image_path']):?>
                <img class="card-img-top" src="<?=$task['image_path'];?>">
            <?php endif;?>
            <div class="card-body">
                <h5 class="card-title ">
                    <span><?=$task['name'];?></span>
                    <span class="card__badge badge badge-secondary">ЗАКРЫТА</span>
                </h5>
                <h6 class="card-subtitle mb-2 text-muted"><?=$task['email'];?></h6>
                <p class="card-text js-card-text"><?=$task['text'];?></p>
                <a class="js-edit-text-task"
                    <?= ($_SESSION['auth_user'] && $_SESSION['auth_user']['is_admin'])?'':'hidden'?>
                   href="#">Редактировать</a>
                <?php if(!$task['is_closed']):?>
                <button <?= ($_SESSION['auth_user'] && $_SESSION['auth_user']['is_admin'])?'':'hidden'?>
                        class="btn btn-sm btn-success js-close-task">Закрыть</button>
                <?php endif;?>
            </div>
        </div>
    </div>
    <?php endforeach;?>
</div>

<?php getTemplatePagination($viewData['currentPage'], $viewData['lastPage']);?>



