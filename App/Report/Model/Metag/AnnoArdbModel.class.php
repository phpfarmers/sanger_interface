<?php
namespace Report\Model\Metag;
/**
 * 
 *
 *
 * @return void
 */
class AnnoArdbModel extends \Report\Model\Metag\BaseModel
{
	public function __construct()
    {
        parent::__construct();

        $this->_db        = $this->_sanger_db->selectTable('anno_ardb');
        $this->_ardb_arg_db = $this->_sanger_db->selectTable('anno_ardb_arg');
        $this->_ardb_class_db = $this->_sanger_db->selectTable('anno_ardb_class');
        $this->_ardb_type_db = $this->_sanger_db->selectTable('anno_ardb_type');
       
        // 取参考库
        $db_config_params   = array('module_name' => MODULE_NAME, 'controller_name' => 'Bio','off_on_line' => C('OFF_ON_LINE'));
        $db_config          = \Common\Custom\Config\Report\ConfigFactory::getDbConfig($db_config_params);
        $host               = mongoarray2str($db_config);
        if (empty($host)) {
            echo '转化mongo数据库连接出错';
            exit;
        }
        $db_name = $this->getMongoDbNameByDbName($db_config['db_name']); //取mongodb库名

        $this->_sanger_biodb = \Common\Custom\Db\Mongo::getInstance(array('db' => $db_name, 'host' => $host));
        $this->_ardb_db = $this->_sanger_biodb->selectTable('ardb');
	}
    
    /**
    * 根据初始化信息
    *
    * @param    string
    *
    * @return    array
    **/
    public function getOriginAnnoardbInfoByTaskId($task_id)
    {
        if(empty($task_id)) {
            $this->_error = '任务ID不正确';
            return false;
        }

        $_condition = array();
        $_condition['task_id'] = $task_id;
        $_condition['status'] = 'end';
        //$_condition['params'] = array('$ne' => '');
        $cursor = $this->_db->sort(array('created_ts' => -1))->limit(1)->find($_condition);
        $info = array();
        foreach($cursor as $key=>$val) {
            $info['ardb_id'] = strval($val['_id']);
            $info['_id'] = strval($val['_id']);
        }

        return $info;
    }


    /**
     * 获取annoardb下拉列表数据
     *
     * @param    string
     * @param    array
     *
     * @return    array
     */
    public function getAnnoardbInfosByTaskId($task_id)
    {
        if(empty($task_id)) {
            $this->_error = '任务ID不正确';
            return false;
        }
        $_condition = array(); 
        $_condition['task_id'] = $task_id;
        $_condition['status'] = 'end';
        $_condition['params'] = array('$ne' => '');

        $cursor = $this->_db->sort(array('created_ts' => -1))->find($_condition);
        if (empty($cursor)) {
            return array();
        }
        foreach ($cursor as $val) {
            $infos[] = array(
                'id'    => strval($val['_id']),
                'name'  => $val['name'],
                'geneset_id'  => strval($val['geneset_id']),
            );
        }
        return $infos;
    }

    /**
     * 获取annoardb表数据
     *
     * @param    string
     *
     * @return    array
     */
    public function getAnnoardbInfoByArdbId($ardb_id)
    {
        if (empty($ardb_id)) {
            $this->_error = 'ardb_id不正确';
            return false;
        }

        $_condition = array(); 
        $_condition['_id'] = new \MongoId($ardb_id);

        $info =  $this->_db->findOne($_condition);
        if (empty($info)) {
            return array();
        }

        $info['stat_id'] = strval($info['_id']);
        $info['specimen']  =explode(',', $info['specimen']);
        $info['ardb_params']  = json_decode($info['params'],true);
        return $info;
    }

    /**
     * 根据ardb_id获取arg信息
     *
     * @param    string
     *
     * @return    array
     */
    public function getAnnoardbArgTableByArdbId($ardb_id, $params)
    {
        if(empty($ardb_id)) {
            $this->_error = 'ardb_id不正确';
            return false;
        }

        $_condition = array(); 
        $_condition['ardb_id'] = new \MongoId($ardb_id);
        $cursor =  $this->_ardb_arg_db;
        $params['sort_order'] == '1' && $sort[$params['sort']] = 1;
        $params['sort_order'] == '2' && $sort[$params['sort']] = -1;
        if(!empty($sort)) {
            $cursor = $cursor->sort($sort);
        }
        if ($params['page']) {
            $cursor = $cursor->skip(($params['page'] - 1)*$params['rows'])->limit($params['rows']);
        }

       
        $cursor =  $cursor->find($_condition);
        $infos = array();
        foreach ($cursor as $val) {
            $infos[] = $val;
        }

        return $infos;
    }

    /**
     * 根据ardb_id获取detail总数
     *
     * @param    string
     *
     * @return    int
     */
    public function getAnnoardbArgTableCountByArdbId($ardb_id,$params)
    {
        if(empty($ardb_id)) {
            $this->_error = 'ardb_id不正确';
            return false;
        }

        $_condition = array(); 
        $_condition['ardb_id'] = new \MongoId($ardb_id);
        return $this->_ardb_arg_db->count($_condition); 
    }

/**
     * 根据args获取ardb信息
     *
     * @param    string
     *
     * @return    array
     */
    public function getArdbInfosByargs($args)
    {
        if(count($args)<1) {
            $this->_error = 'familys不正确';
            return false;
        }

        $_condition = array(); 

        $_condition['arg'] = array('$in' => $args);
        $cursor = $this->_ardb_db;
        if (!empty($params['limit'])){
            $cursor = $cursor->skip($params['skip'])->limit($params['limit']);
        }
        $cursor = $cursor->find($_condition);
        $infos = array();
        foreach ($cursor as $val) {
            $infos[$val['arg']] = array(
                'type'           => $val['type'],
                'resistance'     => $val['resistance'],
                'class'          => $val['class'],
                'class_des'      => $val['class_des'],
                );
        }

        return $infos;
    }

/**
     * 根据ardb_id获取ardb_class信息
     *
     * @param    string
     *
     * @return    array
     */
    public function getAnnoardbClassInfosByArdbId($ardb_id, $params)
    {
        if(empty($ardb_id)) {
            $this->_error = 'ardb_id不正确';
            return false;
        }

        $_condition = array(); 
        $_condition['ardb_id'] = new \MongoId($ardb_id);
        $cursor =  $this->_ardb_class_db;
        $params['sort_order'] == '1' && $sort[$params['sort']] = 1;
        $params['sort_order'] == '2' && $sort[$params['sort']] = -1;
        if(!empty($sort)) {
            $cursor = $cursor->sort($sort);
        }
        if ($params['page']) {
            $cursor = $cursor->skip(($params['page'] - 1)*$params['rows'])->limit($params['rows']);
        }

        $cursor =  $cursor->find($_condition);
       
        $infos = array();
        foreach ($cursor as $val) {
            $infos[] = $val;
        }

        return $infos;
    }

    /**
     * 根据ardb_id获取detail总数
     *
     * @param    string
     *
     * @return    int
     */
    public function getAnnoardbClassInfoscountByArdbId($ardb_id,$params)
    {
        if(empty($ardb_id)) {
            $this->_error = 'ardb_id不正确';
            return false;
        }

        $_condition = array(); 
        $_condition['ardb_id'] = new \MongoId($ardb_id);
        return $this->_ardb_class_db->count($_condition); 
    }
   /**
     * 根据ardb_id获取ardb_type信息
     *
     * @param    string
     *
     * @return    array
     */
    public function getAnnoardbTypeTableByArdbId($ardb_id, $params)
    {
        if(empty($ardb_id)) {
            $this->_error = 'ardb_id不正确';
            return false;
        }

        $_condition = array(); 
        $_condition['ardb_id'] = new \MongoId($ardb_id);
        $cursor =  $this->_ardb_type_db;
        $params['sort_order'] == '1' && $sort[$params['sort']] = 1;
        $params['sort_order'] == '2' && $sort[$params['sort']] = -1;
        if(!empty($sort)) {
            $cursor = $cursor->sort($sort);
        }
        if ($params['page']) {
            $cursor = $cursor->skip(($params['page'] - 1)*$params['rows'])->limit($params['rows']);
        }

       
        $cursor =  $cursor->find($_condition);
        $infos = array();
        foreach ($cursor as $val) {
            $infos[] = $val;
        }

        return $infos;
    }

    /**
     * 根据ardb_id获取ardb_type总数
     *
     * @param    string
     *
     * @return    int
     */
    public function getAnnoardbTypeTableCountByArdbId($ardb_id,$params)
    {
        if(empty($ardb_id)) {
            $this->_error = 'ardb_id不正确';
            return false;
        }

        $_condition = array(); 
        $_condition['ardb_id'] = new \MongoId($ardb_id);
        return $this->_ardb_type_db->count($_condition); 
    }

 /**
    * 通过任务id获取cazy信息
    *
    * @param    string
    * @param    array
    *
    * @return    array 
    **/
    public function getAnnoardbInfoByTaskId($task_id, $params)
    {
        if(empty($task_id)) {
            $this->_error = '任务ID不正确';
            return false;
        }
        $_condition = array();
        $_condition['task_id'] = $task_id;
        if (!empty($params['params'])) {
            $_condition['params'] = $params['params'];
        } else {
            $_condition['params'] = array('$ne' => '');
        }
        $_condition['status'] = array('$in' => array('start', 'end'));
        $info = $this->_db->findOne($_condition);
        if (empty($info)) {
            return array();
        }
        $info['cazy_id'] = strval($info['_id']);
        
        return $info;
    }

}
