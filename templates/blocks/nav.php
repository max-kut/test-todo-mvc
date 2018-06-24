<?php
/**
 * Navigation block
 *
 *
 */

/** @var string $_path текущий адрес без query string */
$_path = preg_replace("/^([^?]*)/i", "$1", $_SERVER['REQUEST_URI']);
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="/">TODO</a>

    <div class="collapse navbar-collapse">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item <?= $_path == '/' ? 'active' : '' ?>">
                <a class="nav-link" href="/">Список задач
                </a>
            </li>
            <li class="nav-item <?= $_path == '/add' ? 'active' : '' ?>">
                <a class="nav-link" href="/add">Cоздать</a>
            </li>

        </ul>
    </div>
    <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle"
                type="button"
                id="dropdownUserMenuButton"
                data-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false">
            <span class="js-login-true js-auth-user-name"
                <?= !empty($_SESSION['auth_user']) ? '' : 'hidden'; ?>>
                <?=$_SESSION['auth_user']['name'] ?: '';?>
            </span>
            <span class="js-login-false"
                <?= !empty($_SESSION['auth_user']) ? 'hidden' : ''; ?>>
                Войти
            </span>
        </button>
        <div class="dropdown-menu dropdown-menu-right"
             aria-labelledby="dropdownUserMenuButton"
             style="min-width: 250px; padding: 5px;">
            <a class="dropdown-item js-login-true js-logout"
                <?= !empty($_SESSION['auth_user']) ? '' : 'hidden'; ?>
               href="/logout">Выйти
            </a>
            <form class="js-login-form js-login-false" <?= !empty($_SESSION['auth_user']) ? 'hidden' : ''; ?>>
                <div class="form-group">
                    <input type="text"
                           name="login"
                           class="form-control"
                           required
                           placeholder="логин или email">
                </div>
                <div class="form-group">
                    <input type="password"
                           name="password"
                           class="form-control"
                           required
                           placeholder="password">
                </div>
                <button type="submit" class="btn btn-primary">Войти</button>
                <br>
                <div class="alert alert-danger"
                     style="display: none; margin-top: 3px;"
                     role="alert"></div>
            </form>
        </div>
    </div>
</nav>