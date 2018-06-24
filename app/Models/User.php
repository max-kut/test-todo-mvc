<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 23.06.18
 * Time: 13:06
 */

namespace App\Models;


use App\BaseModel;

/**
 * Class User
 *
 * @package App\Models
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $login
 * @property string $password
 * @property bool $is_admin
 */
class User extends BaseModel
{
    /** @var string $table */
    protected $table = 'users';
    
    /**
     * @param $login
     *
     * @return mixed
     */
    public static function searchByLoginOrEmail($login)
    {
        return (new static())->getUserByLogin($login);
    }
    
    /**
     * @param $login
     *
     * @return $this
     */
    public function getUserByLogin($login)
    {
        $fieldName = mb_stripos($login, '@') !== false ? 'email' : 'login';
        $userData  = $this->where($fieldName, $login)->getOne($this->table);
        
        if (is_null($userData)) return null;
        
        $this->_attributes = $userData;
        
        return $this;
    }
    
    /**
     * @return array
     */
    public function getPublicData()
    {
        return [
            'name'     => $this->name,
            'email'    => $this->email,
            'login'    => $this->login,
            'is_admin' => $this->is_admin,
        ];
    }
}