<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 23.06.18
 * Time: 12:25
 */

namespace App\Controllers;

use App\Models\Task;

/**
 * Class TaskListController
 *
 * @package App\Controllers
 */
class TaskListController
{
    /**
     * controller entry point
     */
    public function index()
    {
        $task             = new Task();
        $page             = $_GET['page'] ? (int)$_GET['page'] : 1;
        $orderBy          = $_GET['order'] ?: 'created_at';
        $orderByDirection = $_GET['orderType'] ?: 'ASC';
        $tasks            = $task->getTasks($page, $orderBy, $orderByDirection);
        
        return view('list', 'Список задач', [
            'tasks'       => $tasks,
            'currentPage' => $page,
            'lastPage'    => (int)ceil($task->totalCount / 3),
            'total'       => (int)$task->totalCount,
        ]);
    }
}