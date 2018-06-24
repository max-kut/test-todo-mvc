<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 23.06.18
 * Time: 13:07
 */

namespace App\Models;


use App\BaseModel;

/**
 * Class Task
 *
 * @package App\Models
 *
 * @property int $id
 * @property int $user_id
 * @property string $text
 * @property boolean $is_closed
 * @property string $image_path
 * @property string $created_at
 * @property string $updated_at
 */
class Task extends BaseModel
{
    /** @var string $table */
    protected $table = 'tasks';
    
    /**
     * Получает отсортированные задачи
     *
     * @param int $page
     * @param string $orderBy
     * @param string $orderByDirection
     *
     * @return array
     */
    public function getTasks($page = 1, $orderBy, $orderByDirection = 'ASC')
    {
        $this->pageLimit = 3;
        
        $this->join('users as u', "u.id={$this->table}.user_id");
        
        $this->orderBy($orderBy, $orderByDirection);
        
        return $this->arrayBuilder()->paginate($this->table, $page, [
            "u.login",
            "u.email",
            "u.name",
            "{$this->table}.*",
        ]);
    }
    
    /**
     * @return \App\BaseModel
     */
    public function save()
    {
        // в данной модели есть поле даты обновления
        // его заполняем при обновлении данных
        if (!empty($this->_attributes) && !empty($this->_attributes['id'])) {
            $this->_attributes['updated_at'] = $this->now();
        }
        
        return parent::save();
    }
}