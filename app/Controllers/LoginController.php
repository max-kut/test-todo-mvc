<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 23.06.18
 * Time: 14:08
 */

namespace App\Controllers;

use App\Models\User;

/**
 * Class LoginController
 *
 * @package App\Controllers
 */
class LoginController
{
    /**
     * Обработчик формы
     */
    public function login()
    {
        /** @var User|null $user */
        $user = User::searchByLoginOrEmail($_POST['login']);
        
        if (is_null($user)) {
            echo $this->userNotFound();
            
            return;
        }
        
        if (!password_verify($_POST['password'], $user->password)) {
            echo $this->wrongPassword();
            
            return;
        }
        
        $_SESSION['auth_user'] = $user->getPublicData();
        
        echo json_encode($user->getPublicData());
    }
    
    /**
     * Пользователь не найден
     *
     * @return string
     */
    private function userNotFound()
    {
        header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
        
        return json_encode([
            'message' => 'Пользователь не существует',
        ]);
    }
    
    /**
     * пароль неверный
     *
     * @return string
     */
    private function wrongPassword()
    {
        header($_SERVER['SERVER_PROTOCOL'] . ' 403 Forbidden');
        
        return json_encode([
            'message' => 'Пароль неверный',
        ]);
    }
    
    /**
     * выход с сайта c перенаправлением на предыдущую страницу
     */
    public function logout()
    {
        $redirectUrl = "/";
        foreach (getallheaders() as $k => $v) {
            if (mb_strtolower($k) === 'referer') {
                $redirectUrl = $v;
                break;
            }
        }
        unset($_SESSION['auth_user']);
        header("Location: {$redirectUrl}");
        exit();
    }
    
}