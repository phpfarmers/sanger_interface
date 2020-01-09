<?php
namespace Common\Custom\Db\Driver;

/**
 * mongo
 *
 * @return   void
 **/
class Mongo
{
    private static $_db_array = array();
    private $_params          = array('skip' => null, 'limit' => null);
    
    private function __construct($table_name, $db)
    {
        $this->_table_name = $table_name;
        $this->_db         = $db;
    }

    /**
     * 获取实例
     *
     * @param    string
     * @param    array
     *
     * @return   object
     **/
    static function getInstance($table_name, $db, $db_name)
    {
        $link_id = md5($table_name.'_'.$db_name);
        if (empty(self::$_db_array[$link_id])) {
            self::$_db_array[$link_id] = new self($table_name, $db);
        }

        return self::$_db_array[$link_id];
    }

    /**
     * 排序
     *
     * @param    string
     *
     * @return   object
     **/
    public function sort($params)
    {
        $this->_params['sort'] = $params;
        return $this;
    }

    /**
     * 分页
     *
     * @param    string
     *
     * @return   object
     **/
    public function limit($limit)
    {
        $this->_params['limit'] = $limit;
        return $this;
    }

    /**
     * 分页
     *
     * @param    string
     *
     * @return   object
     **/
    public function skip($skip)
    {
        $this->_params['skip'] = $skip;
        return $this;
    }

    /**
     * 获取字段
     *
     * @param    string
     *
     * @return   object
     **/
    public function field($field)
    {
        $this->_params['field'] = $field;

        return $this;
    }

    /**
     * 查询
     *
     * @param    array
     *
     * @return   array
     **/
    public function find($_condition)
    {
       ini_set('mongo.long_as_object', 1);
        $table_name = $this->_table_name;
        $table      = $this->_db->$table_name;
        if (empty($_condition)) {
            $this->cursor = $table->find();
        } else {
            $this->cursor = $table->find($_condition);
        }
        $this->cursor->timeout(-1);
        
        if ($this->_params['sort']) {
            $this->cursor->sort($this->_params['sort']);
        }

        if ($this->_params['limit'] !== null) {
            $this->cursor->limit($this->_params['limit']);
        }

        if ($this->_params['skip']) {
            $this->cursor->skip($this->_params['skip']);
        }

        if (!$this->cursor->count()) {
            return array();
        }

        $infos = array();
        $i = 0;
        foreach ($this->cursor as $val) {
            if ($this->_params['field']) {
                foreach ($this->_params['field'] as $key => $field) {
                    if (is_string($key)) {
                        $infos[$i][$key] = is_object($val[$field]) ? strval($val[$field]) : $val[$field];
                        continue;
                    }
                    $infos[$i][$field] = is_object($val[$field]) ? strval($val[$field]) : $val[$field];
                }
            } else {
                $infos[$i] = $val;
            }

            $i ++;
        }

        $this->_params = array('skip' => null, 'limit' => null);
        unset($this->cursor);
        
        return $infos;
    }

    /**
     * 查找数据
     *
     * @param    array
     *
     * @return   array
     **/
    public function findOne($params)
    {
        ini_set('mongo.long_as_object', 1);    
        $table_name = $this->_table_name;
        $table      = $this->_db->$table_name;
        $info = $table->findOne($params);
        if (empty($this->_params['field'])) {
            return $info;
        }
        $result_info = array();
        foreach ($this->_params['field'] as $key => $field) {
            if (is_string($key)) {
                $result_info[$key] = is_object($info[$field]) ? strval($info[$field]) : $info[$field];
                continue;
            }
            $result_info[$field] = is_object($info[$field]) ? strval($info[$field]) : $info[$field];
        }

        unset($info);

        return $result_info;
    }

    /**
     * 统计数量
     *
     * @param    array
     *
     * @return   int
     **/
    public function count($params)
    {
        ini_set('mongo.long_as_object', 1);
        $table_name = $this->_table_name;
        $table      = $this->_db->$table_name;
        return $table->count($params);
    }

    /**
     * 插入数据
     *
     * @param    array
     *
     * @return   array
     **/
    public function insert($params)
    {
        $table_name = $this->_table_name;
        $table      = $this->_db->$table_name;
        $result = $table->insert($params);
        if ($result) {
            return strval($params['_id']);
        }

        return false;
    }
    
    
    /**
     * 插入32位数据
     *
     * @param    array
     *
     * @return   array
     **/
    public function insert32($params)
    {
        ini_set('mongo.native_long', 0);
        $table_name = $this->_table_name;
        $table      = $this->_db->$table_name;
        $result = $table->insert($params);
        if ($result) {
            return strval($params['_id']);
        }
    
        return false;
    }

    /**
     * 删除一条数据
     *
     * @param    array
     *
     * @return   array
     **/
    public function deleteOne($params)
    {
        $table_name = $this->_table_name;
        $table      = $this->_db->$table_name;

        return $table->remove($params,array("justOne" => true));
    }
    
    /**
     * 统计去重后的数量
     *
     * @param    array
     *
     * @return   int
     **/
    public function distinctCount($key, $params)
    {
        $table_name = $this->_table_name;
        $table      = $this->_db->$table_name;
        return count($table->distinct($key, $params));
    }

    /**
     * 去重后的列表
     *
     * @param    array
     *
     * @return   int
     **/
    public function distinct($key, $params)
    {
        $table_name = $this->_table_name;
        $table      = $this->_db->$table_name;
        return $table->distinct($key, $params);
    }

    /**
     * 统计数量
     *
     * @param    array
     *
     * @return   int
     **/
    public function group($keys, $initial, $reduce, $condition = null) {
        $table_name = $this->_table_name;
        $table      = $this->_db->$table_name;
        
        $g = $table->group($keys, $initial, $reduce, $condition);
        
        return $g['retval'];
    }
    
    /**
     * 更新
     * 
     * @param    array
     * @param    array
     * 
     */
    public function update($params, $update)
    {
        $table_name = $this->_table_name;
        $table      = $this->_db->$table_name;
        $info = $table->update($params, $update);
        return $info;
    }
    
    /**
     * 更新并增加一条记录
     *
     * @param    array
     * @param    array
     *
     */
    public function upsert($params, $update)
    {
        $table_name = $this->_table_name;
        $table      = $this->_db->$table_name;
        $info = $table->update($params, $update, array('upsert'=>true));
        return $info;
    }
    
    
    /**
     * 批量插入数据
     *
     * @param    array
     *
     * @return   array
     **/
    public function batchInsert($params)
    {
        if (empty($params)) {
            $this->_error = '参数为空';
            return false;
        }
        $table_name = $this->_table_name;
        $table      = $this->_db->$table_name;
        $result = $table->batchInsert($params);
    }
	
	/**
     * 批量插入数据
     *
     * @param    array
     *
     * @return   array
     **/
    public function batchInsert32($params)
    {
        ini_set('mongo.native_long', 0);
        if (empty($params)) {
            $this->_error = '参数为空';
            return false;
        }
        $table_name = $this->_table_name;
        $table      = $this->_db->$table_name;
        $result = $table->batchInsert($params);
    }

    /**
     * 删除表格
     *
     * @param    array
     *
     * @return   array
     **/
    public function dropTable()
    {
        $table_name = $this->_table_name;
        $table      = $this->_db->$table_name;

        return $table->drop();
    }

    /**
     * 删除数据
     *
     * @param    array
     *
     * @return   array
     **/
    public function remove($params)
    {
        $table_name = $this->_table_name;
        $table      = $this->_db->$table_name;

        return $table->remove($params);
    }

    /**
     * 返回错误
     *
     * @return   string
     **/
    public function getError()
    {
        return $this->_error;
    }
    
}