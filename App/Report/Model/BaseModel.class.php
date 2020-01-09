<?php
namespace Report\Model;
/**
 * 
 *
 *
 * @return void
 */
class BaseModel
{
    protected $_sanger_db;
    protected $_error;
    public function __construct()
    {
        $db_config_params   = array('module_name' => MODULE_NAME, 'controller_name' => CONTROLLER_NAME,'off_on_line' => C('OFF_ON_LINE'));
        $db_config          = \Common\Custom\Config\Report\ConfigFactory::getDbConfig($db_config_params);
        $host               = mongoarray2str($db_config);
        if (empty($host)) {
            echo '转化mongo数据库连接出错';
            exit;
        }
        // $host = 'mongodb://wgs_v2:O1Aj21H1eskKVkui@10.100.1.10/sanger_dna_wgs_v2?authMechanism=SCRAM-SHA-1';
        // $db_name = strtolower(CONTROLLER_NAME);
        $db_name = $db_config['db_name']; //配置的

        // 暂时取config 数据库映射，统一修改后再直接指定数据 去掉 开始
        $report_db_array  = C('MONGO_DB');
        $report_db_array = array_flip($report_db_array);
        if (!isset($report_db_array[$db_name])) {
            echo 'common\conf\config.php MONGO_DB未配置值为'.$db_name;
            exit;
        }
        $db_name = $report_db_array[$db_name];
        // 暂时取config 数据库映射，统一修改后再直接指定数据 去掉 结束


        $this->_sanger_db           = \Common\Custom\Db\Mongo::getInstance(array('db' => $db_name, 'host' => $host));
        
        $this->report_img_db        = M('Report_image');
        $this->report_category_db   = M('Report_category_new');
        $this->report_table_db      = M('Report_result_table');
	}

    /**
    * 根据category url获取category 信息
    *
    * @param    string
    *
    * @return    array
    **/
    public function getReportCategoryInfoByCategoryUrl($category_url, $params)
    {
        if(empty($category_url)) {
            $this->_error = 'category url不存在';
            return false;
        }
        $_condition                    = array();
        $_condition['category_url']    = $category_url;
        if(!empty($params['cmd_id'])) {
            $_condition['pipeline_id'] = $params['cmd_id'];
        }
 
        $infos                         = $this->report_category_db->where($_condition)->select();
        $temp_infos                    = array();
        $tree_paths                    = array();
        $info = array();
        for($i=0,$ii=count($infos); $i<$ii; $i++) {
            $tree_paths                = explode(',', $infos[$i]['tree_path']);
            $temp_infos[count($tree_paths)] = $infos[$i];
        }
        krsort($temp_infos);
        $info = array_shift($temp_infos);
        return $info;
    }

    /**
    * 根据category id获取表的信息
    *
    * @param    string
    *
    * @return    array
    **/
    public function getReportTableInfosByCategoryId($category_id)
    {
        if(empty($category_id)) {
            $this->_error = 'category id不存在';
            return false;
        }
        return $this->report_table_db->where("category_id = '{$category_id}'")->select();
    }

    /**
    * 根据category id获取图的信息
    *
    * @param    string
    *
    * @return    array
    **/
    public function getReportImgInfosByCategoryId($category_id)
    {
        if(empty($category_id)) {
            $this->_error = 'category id不存在';
            return false;
        }
        return $this->report_img_db->where("category_id = '{$category_id}'")->select();
    }

    /**
     * 返回错误
     *
     * @return    string
     **/
    public function getError()
    {
        return $this->_error;
    }

}