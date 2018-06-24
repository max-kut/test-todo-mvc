<?php
/**
 * Сортировщик задач
 */

?>
<div class="row">
    <div class="col">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <button class="navbar-toggler"
                    type="button"
                    data-toggle="collapse"
                    data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent"
                    aria-expanded="false"
                    aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle"
                           href="#"
                           id="navbarDropdown"
                           role="button"
                           data-toggle="dropdown"
                           aria-haspopup="true"
                           aria-expanded="false">
                            Сортировать по:
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item"
                               href="<?=getQueryString([
                                   'order' => 'name',
                                   'orderType' => 'ASC'
                               ]);?>">
                                имени пользователя (a-z)
                            </a>
                            <a class="dropdown-item"
                               href="<?=getQueryString([
                                   'order' => 'name',
                                   'orderType' => 'DESC'
                               ]);?>">
                                имени пользователя (z-a)
                            </a>
                            <a class="dropdown-item"
                               href="<?=getQueryString([
                                   'order' => 'email',
                                   'orderType' => 'ASC'
                               ]);?>">
                                емейлу пользователя (a-z)
                            </a>
                            <a class="dropdown-item"
                               href="<?=getQueryString([
                                   'order' => 'email',
                                   'orderType' => 'DESC'
                               ]);?>">
                                емейлу пользователя (z-a)
                            </a>
                            <a class="dropdown-item"
                               href="<?=getQueryString([
                                   'order' => 'is_closed',
                                   'orderType' => 'ASC'
                               ]);?>">
                                статусу (сначала открытые)
                            </a>
                            <a class="dropdown-item"
                               href="<?=getQueryString([
                                   'order' => 'is_closed',
                                   'orderType' => 'DESC'
                               ]);?>">
                                статусу (сначала закрытые)
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
            <a type="button" class="btn btn-success" href="/add">Создать задачу</a>
        </nav>
    </div>
</div>