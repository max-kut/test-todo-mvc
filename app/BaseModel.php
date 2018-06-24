<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 23.06.18
 * Time: 13:01
 */

namespace App;


use App\Exceptions\ModelException;

/**
 * Class BaseModel
 *
 * @package App
 */
class BaseModel extends DB
{
    /** @var string $table */
    protected $table;
    
    /** @var array */
    protected $_attributes = [];
    
    /**
     * BaseModel constructor.
     *
     * @throws \App\Exceptions\ModelException
     */
    public function __construct(array $attributes = [])
    {
        if (empty($this->table)) {
            throw new ModelException('prop $table must not be empty', 510);
        }
        
        if (!empty($attributes)) {
            $this->_attributes = $attributes;
        }
        
        parent::__construct();
    }
    
    /**
     * @param $name
     *
     * @return null
     */
    public function __get($name)
    {
        return $this->_attributes[$name] ?: null;
    }
    
    /**
     * @param $name
     * @param $value
     */
    public function __set($name, $value)
    {
        $this->_attributes[$name] = $value;
    }
    
    /**
     * @param $name
     *
     * @return bool
     */
    public function __isset($name)
    {
        return isset($this->_attributes[$name]);
    }
    
    /**
     * @return \App\BaseModel
     */
    public function save()
    {
        if (!empty($this->_attributes) && empty($this->_attributes['id'])) {
            $this->_attributes['id'] = $this->insert($this->table, $this->_attributes);
        } else if (!empty($this->_attributes) && !empty($this->_attributes['id'])) {
            $this->where('id', (int)$this->_attributes['id']);
            if (!$this->update($this->table, $this->_attributes)) {
                unset($this->_attributes['id']);
                
                return $this->save();
            }
        }
        
        return $this;
    }
    
    /**
     * @return array
     */
    public function toArray()
    {
        return $this->_attributes;
    }
}