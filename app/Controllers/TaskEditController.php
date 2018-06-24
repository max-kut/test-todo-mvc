<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 24.06.18
 * Time: 10:41
 */

namespace App\Controllers;


use App\Models\Task;

/**
 * Class TaskEditController
 *
 * @package App\Controllers
 */
class TaskEditController
{
    /**
     * TaskEditController constructor.
     */
    public function __construct()
    {
        if (!$this->hasPermission()) {
            $this->sendErrorResponse("No permission");
        }
    }
    
    /**
     * Обработчик закрытия задачи
     */
    public function closeTask()
    {
        $task            = new Task();
        $task->id        = (int)$_POST['id'];
        $task->is_closed = true;
        
        $task->save();
        echo json_encode("ok");
    }
    
    /**
     * Обработчик редактирования задачи
     */
    public function editTask()
    {
        $task       = new Task();
        $task->id   = (int)$_POST['id'];
        $task->text = $_POST['text'];;
        
        $task->save();
        echo json_encode("ok");
    }
    
    /**
     * Проверяет, может ли пользователь редактировать задачи
     *
     * @return bool
     */
    private function hasPermission()
    {
        if (!empty($_SESSION['auth_user']) && $_SESSION['auth_user']['is_admin']) {
            return true;
        }
        
        return false;
    }
    
    /**
     * Для простоты не стал выкидывать Exception;
     * В реале надо выбрасывать
     *
     * @param $message
     */
    private function sendErrorResponse($message)
    {
        header($_SERVER['SERVER_PROTOCOL'] . ' 403 Forbidden');
        exit(json_encode([
            'message' => $message,
        ]));
    }
}