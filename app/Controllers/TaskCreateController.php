<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 23.06.18
 * Time: 13:43
 */

namespace App\Controllers;

use App\Models\Task;
use App\Models\User;


/**
 * Class CreateTaskController
 *
 * @package App\Controllers
 */
class TaskCreateController
{
    
    /**
     * @return mixed
     */
    public function index()
    {
        return view('create_task', 'Создать новую задачу');
    }
    
    /**
     * Обработчик запроса на создание задачи
     */
    public function create()
    {
        $user = $this->getUser();
        
        $task = new Task([
            'user_id'    => $user->id,
            'text'       => $_POST['text'],
            'image_path' => $_POST['image_path'],
        ]);
        
        $task->save();
        
        // В сессии может быть ссылка на изображение
        // надо удалить
        unset($_SESSION['task_image']);
        
        echo json_encode("ok");
    }
    
    /**
     * Получает из базы или создает нового пользователя и возвращает его
     *
     * @return \App\Models\User|mixed
     */
    private function getUser()
    {
        $user = User::searchByLoginOrEmail($_POST['email']);
        if (is_null($user)) {
            $user = new User([
                'name'     => $_POST['name'],
                'email'    => $_POST['email'],
                'password' => password_hash('123', PASSWORD_DEFAULT),
            ]);
            
            $user->save();
        }
        
        return $user;
    }
}