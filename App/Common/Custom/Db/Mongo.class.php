<?php
namespace Common\Custom\Db;

/**
 * mongo
 *
 * @return   void
 **/
class Mongo
{
    
    static $db = null;
    private function __construct($params)
    {
        if (!class_exists('Mongo')) {
            exit('请安装mongo插件');
        }

        try {
            $this->_getMongoClient($params);
        } catch(\Exception $e) {
			echo $e->getMessage();
            exit('连接mongo失败');
        }
    }

    /**
     * 获取实例
     *
     * @param    array
     *
     * @return   object
     **/
    static public function getInstance($params = array())
    {
        if (empty(self::$db[$params['db']])) {
            self::$db[$params['db']] = new self($params);
            self::$db['db_name']     = $params['db'];
        }

        return self::$db[$params['db']];
    }

    /**
     * 连接mongo
     *
     * @param    array
     *
     * @return   object
     **/
    private function _getMongoClient($params,$retry = 3)
    {
        try {
            if(isset($params['host'])){
                $this->_mongo_db = new \Mongo($params['host'], array("timeout" => -1));
            }else{
                $this->_mongo_db = new \Mongo(C('MONGO_HOST').':'.C('MONGO_PORT'), array("timeout" => -1));
            }
            $report_db_array  = C('MONGO_DB');
            $this->_sanger_db = $this->_mongo_db->$report_db_array[$params['db']];
            $this->_db_name   = $report_db_array[$params['db']];
            // 统一修改后再直接指定数据
            /*$this->_sanger_db = $this->_mongo_db->$params['db'];
            $this->_db_name   = $params['db'];*/
            return;
        } catch(\Exception $e) {
			throw new \Exception($e->getMessage());
        }

        if ($retry > 0) {
            return $this->_getMongoClient($params, --$retry);
        }

        throw new \Exception('尝试3次连接失败');
    }

    /**
     * 选择表格
     *
     * @param    array
     *
     * @return   object
     **/
    public function selectTable($table_name)
    {
        return \Common\Custom\Db\Driver\Mongo::getInstance($table_name, $this->_sanger_db, $this->_db_name);
    }

    /**
     * 取mongo存储的图片数据
     *
     * @param    array
     *
     * @return   object
     **/
    public function getGridFS()
    {
        return $this->_sanger_db->getGridFS();
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

/*
 $sanger_db = \Common\Custom\MongoTest::getInstance(array('db' => 'project_db'));

 //选择对应的表
 $log_operate_db  = $sanger_db->selectTable('sg_log_operate');
    
 单条数据:
 $info = $log_operate_db->field(array('log_id' => '_id', 'from_id', 'time'))->findOne(array('_id' => new \MongoId('58ec93d5dde3eed81100002b')));
 多条数据查询：
 $infos = $log_operate_db->field($field)->sort(array('time' => -1))->limit($params['limit'])->skip($params['skip'])->find($_condition);

 插入数据
$result = $log_operate_db->insert($params);
 */