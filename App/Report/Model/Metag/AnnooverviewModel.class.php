<?php
namespace Report\Model\Metag;
/**
 * 
 *
 *
 * @return void
 */
class AnnooverviewModel extends \Report\Model\Metag\BaseModel
{
	public function __construct()
    {
        parent::__construct();

        $this->_db        = $this->_sanger_db->selectTable('anno_overview');
        $this->_detail_db        = $this->_sanger_db->selectTable('anno_overview_detail');
	}

    /**
    * 根据初始化信息
    *
    * @param    string
    *
    * @return    array
    **/
    public function getOriginAnnooverviewInfoByTaskId($task_id)
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
            $info['anno_overview_id'] = strval($val['main_id']);
            $info['_id'] = strval($val['main_id']);
        }

        return $info;
    }


    /**
     * 获取annooverview下拉列表数据
     *
     * @param    string
     * @param    array
     *
     * @return    array
     */
    public function getAnnooverviewInfosByTaskId($task_id)
    {
        if(empty($task_id)) {
            $this->_error = '任务ID不正确';
            return false;
        }
        $_condition = array(); 
        $_condition['task_id'] = $task_id;
        $_condition['status'] = 'end';
        //$_condition['params'] = array('$ne' => '');
        $cursor = $this->_db->sort(array('created_ts' => -1))->find($_condition);
        if (empty($cursor)) {
            return array();
        }
        foreach ($cursor as $val) {
            $infos[] = array(
                'id'    => strval($val['main_id']),
                'name'  => $val['name'],
                'geneset_id'  => strval($val['geneset_id']),
            );
        }
        return $infos;
    }

    /**
     * 获取anno_overview表数据
     *
     * @param    string
     *
     * @return    array
     */
    public function getAnnooverviewInfoByAnnooverviewId($anno_overview_id)
    {
        if (empty($anno_overview_id)) {
            $this->_error = 'vfdb_id不正确';
            return false;
        }

        $_condition = array(); 
        $_condition['main_id'] = new \MongoId($anno_overview_id);

        $info =  $this->_db->findOne($_condition);
        if (empty($info)) {
            return array();
        }

        $info['anno_overview_id'] = strval($info['main_id']);
        return $info;
    }

    /**
     * 根据anno_overview_id获取detail信息
     *
     * @param    string
     *
     * @return    array
     */
    public function getAnnooverviewDetailTableByAnnooverviewId($anno_overview_id, $params)
    {
        if(empty($anno_overview_id)) {
            $this->_error = 'anno_overview_id不正确';
            return false;
        }

        $_condition = array();
        $nr_like = array('query','cog_9'=>'like','cog_10'=>'like','cog_11'=>'like','kegg_12'=>'like','kegg_13'=>'like','kegg_14'=>'like',
                        'kegg_15'=>'like','kegg_16'=>'like','kegg_17'=>'like','cazy_18'=>'like','cazy_19'=>'like','ardb_20'=>'like',
                        'ardb_21'=>'like','ardb_22'=>'like','ardb_23'=>'like','card_24'=>'like','card_25'=>'like','vfdb_26'=>'like',
                        'vfdb_27'=>'like','vfdb_28'=>'like');
        $_condition = select_input_value_to_mongodb_condition($params, $nr_like); 
        if(!empty($_condition) && count($_condition['$and'])==1 &&!empty($_condition['$and'][1])){
            $con = $_condition['$and'][1];
            $_condition = array();
            $_condition['$and'][0] =$con;
        }
        $_condition['anno_overview_id'] = new \MongoId($anno_overview_id);
       /* if(!empty($params['key'])){
            foreach ($params['key'] as $key => $val) {
                $_condition[$val] =$params['key_value'][$key];
            }
        }*/
        if(!empty($params['key'])){
            foreach ($params['key'] as $key => $val) {
                $_condition['$and'][] =array($val=>$params['key_value'][$key]);
            }
        }
       // var_print($_condition);exit;
        !empty($params['length'])         && $_condition['length'] = array('$gte'=>floatval($params['length']));
        $cursor =  $this->_detail_db->sort(array('_id'=>1));
        //$cursor->timeout(-1);
        if ($params['limit']) {
            $cursor = $cursor->skip($params['skip'])->limit($params['limit']);
        }

        $cursor =  $cursor->find($_condition);
       
        $infos = array();
        foreach ($cursor as $val) {
            $infos[] = $val;
        }

        return $infos;
    }
    /**
     * 根据anno_overview_id获取detail count信息
     *
     * @param    string
     *
     * @return    array
     */
    public function getAnnooverviewDetailTableCountByAnnooverviewId($anno_overview_id, $params)
    {
        if(empty($anno_overview_id)) {
            $this->_error = 'anno_overview_id不正确';
            return false;
        }
        $nr_like = array('query','cog_9'=>'like','cog_10'=>'like','cog_11'=>'like','kegg_12'=>'like','kegg_13'=>'like','kegg_14'=>'like',
                        'kegg_15'=>'like','kegg_16'=>'like','kegg_17'=>'like','cazy_18'=>'like','cazy_19'=>'like','ardb_20'=>'like',
                        'ardb_21'=>'like','ardb_22'=>'like','ardb_23'=>'like','card_24'=>'like','card_25'=>'like','vfdb_26'=>'like',
                        'vfdb_27'=>'like','vfdb_28'=>'like');
        $_condition = select_input_value_to_mongodb_condition($params, $nr_like); 

        if(!empty($_condition) && count($_condition['$and'])==1 &&!empty($_condition['$and'][1])){
            $con = $_condition['$and'][1];
            $_condition = array();
            $_condition['$and'][0] =$con;
        }

        $_condition['anno_overview_id'] = new \MongoId($anno_overview_id);
        if(!empty($params['key'])){
            foreach ($params['key'] as $key => $val) {
                $_condition[$val] =$params['key_value'][$key];
            }
        }
        !empty($params['length'])         && $_condition['length'] = array('$gte'=>floatval($params['length']));
        return $this->getAnnooverviewDetailCount($_condition);
    }

   /**
     * 根据anno_overview_id获取detail count信息
     *
     * @param    string
     *
     * @return    array
     */
    public function getAnnooverviewDetailCount($params)
    {
        \MongoCursor::$timeout = 200000;
        /*$cursor = $this->_sanger_db;
        $cursor->estimatedDocumentCount(array());
        var_dump($cursor);exit;*/
        // $start_time = time();
        /*// aggregateCursor
        $cursor = $this->_detail_db->aggregateCursor(array(array('$match' => $params),array('$count' => "count")));
        foreach ($cursor as $value) {
            $count = $value['count'];
        }*/

        // aggregate
        /*$result = $this->_detail_db->aggregate(array(array('$match' => $params),array('$count' => "count")),array('maxTimeMS'=>200000));
        $count = isset($result['result'][0]['count'])?$result['result'][0]['count']:0;*/
        // aggregate count
        /*$result = $this->_detail_db->aggregate(array(array('$match' => $params),array('$group' => array('_id'=>1, 'count'=>array('$sum'=>1)))),array('maxTimeMS'=>200000));
       
        $count = isset($result['result'][0]['count'])?$result['result'][0]['count']:0;*/

        $count = $this->_detail_db->count($params);
        
        /*$end_time = time();
        $time = $end_time-$start_time;
        echo $time;exit;*/
        return $count;
    }

    /**
     * 根据args获取ardb信息
     *
     * @param    string
     *
     * @return    array
     */
    public function getAnnooverviewDetaliInfosByTaskId($task_id,$params)
    {
        if(count($params['pathway_id'])<1) {
            $this->_error = 'pathway_id不正确';
            return false;
        }

        $_condition = array(); 
        $anno_overview_info = $this->getOriginAnnooverviewInfoByTaskId($task_id);
        $_condition['anno_overview_id'] = new \MongoId($anno_overview_info['anno_overview_id']);
        $_condition['kegg_14'] = array('$in' => $params['pathway_id']);

        $cursor = $this->_detail_db->find($_condition);

        $infos = array();
        foreach ($cursor as $val) {
            $infos[$val['kegg_14']][] = array('kegg_14'=>$val['kegg_14']);
        }
        return $infos;
    }
    /**
     * 根据main_id获取信息
     *
     * @param    string
     *
     * @return    array
     */
    public function getAnnooverviewInfoByMainId($main_id,$params)
    {
        if (empty($main_id)) {
            $this->_error = 'main_id不正确';
            return false;
        }

        $_condition = array(); 
        $_condition['main_id'] = new \MongoId($main_id);
        $_condition['task_id'] = $params['task_id'];

        $info =  $this->_db->findOne($_condition);
        if (empty($info)) {
            return array();
        }

        $info['anno_overview_id'] = strval($info['_id']);
        return $info;
    }

    /**
     * 根据args获取ardb信息
     *
     * @param    string
     *
     * @return    array
     */
    public function getAnnooverviewDetailInfosByMainId($main_id,$params)
    {
        if(empty($main_id)) {
            $this->_error = 'main_id不正确';
            return false;
        }

        $_condition = array(); 
        $_condition['anno_overview_id'] = new \MongoId($main_id);
        $cursor = $this->_detail_db->find($_condition);
        $infos = array();
        foreach ($cursor as $val) {
            $infos[$val['query']] = $val;
        }
        return $infos;
    }
}
