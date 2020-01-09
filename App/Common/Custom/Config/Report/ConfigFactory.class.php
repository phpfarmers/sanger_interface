<?php
namespace Common\Custom\Config\Report;
class ConfigFactory
{
    /**
     * 加载具体数据
     *
     * @param    string
     *
     * @return   array
     **/
    static public function getMethod($type)
    {
        switch($type) {
            case 'metag':
                return \Common\Custom\Config\Report\Metag\Config::config();
                break;
            case 'drna':
                return \Common\Custom\Config\Report\Drna\Config::config();
                break;
            case 'bsa':
                return \Common\Custom\Config\Report\Bsa\Config::config();
                break;
            case 'dwgs':
                return \Common\Custom\Config\Report\Dwgs\Config::config();
            case 'itraq':
                return \Common\Custom\Config\Report\Itraq\Config::config();
                break;
            case 'bacg':
                return \Common\Custom\Config\Report\Bacg\Config::config();
                break;
			case 'labelfree':
                return \Common\Custom\Config\Report\Labelfree\Config::config();
                break;
            case 'fungi':
                return \Common\Custom\Config\Report\Fungi\Config::config();
                break;
            case 'refrna':
                return \Common\Custom\Config\Report\Refrna\Config::config();
                break;
            case 'metab':
                return \Common\Custom\Config\Report\Metab\Config::config();
                break;
            case 'evolution':
                return \Common\Custom\Config\Report\Evolution\Config::config();
                break;
            case 'common':
                return \Common\Custom\Config\Report\Common\Config::config();
				break;
            case 'gmap':
                return \Common\Custom\Config\Report\Gmap\Config::config();
                break;
            case 'prokrna':
                return \Common\Custom\Config\Report\Prokrna\Config::config();
                break;
            case 'mirna':
                return \Common\Custom\Config\Report\Mirna\Config::config();
                break;
            case 'noref':
                return \Common\Custom\Config\Report\Noref\Config::config();
                break;
            case 'wgsv2':
                return \Common\Custom\Config\Report\Wgsv2\Config::config();
                break;
            case 'metagbin':
                return \Common\Custom\Config\Report\Metagbin\Config::config();
                break;
			case 'lncrna':
                return \Common\Custom\Config\Report\Lncrna\Config::config();
                break;
            case 'bassem':
                return \Common\Custom\Config\Report\Bassem\Config::config();
                break;
            case 'denovoassemble':
                return \Common\Custom\Config\Report\Denovoassemble\Config::config();
                break;
        }
    }

    /**
     * 获取配置
     *
     * @param    string
     *
     * @return   array
     **/
    static public function config($type)
    {
        return self::getMethod($type);
    }

    /**
     * 获取mongo配置数据
     *
     * @return   array
     **/
    static public function getDbConfig($params = array())
    {
        // $module_name         = MODULE_NAME;
        // $controller_name     = CONTROLLER_NAME;
        // $off_on_line         = C('OFF_ON_LINE');

        if (empty($params['module_name']) || empty($params['controller_name']) || empty($params['off_on_line'])) {
            echo '参数:module_name,controller_name,off_on_line为必传参数';
            exit;
        }
        
        $module_name        = $params['module_name'];
        $controller_name    = $params['controller_name'];

        $class_name = '\\Common\\Custom\\Config\\'.$module_name.'\\'.$controller_name.'\\Config';
        if (!class_exists($class_name)) {
            echo '类：['.$class_name.']不存在';
            exit;
        }
        if (!method_exists($class_name, 'getDbConfig')) {
            echo '类：['.$class_name.']中不存在方法名:getDbConfig';
            exit;
        }
        $config = $class_name::getDbConfig($params);
        if (!isset($config[$params['off_on_line']]) || empty($config[$params['off_on_line']])) {
            echo 'Common\Custom\Config\Report\\'.$controller_name.'\Config::getDbConfig未配置正确';
            exit;
        }
        $info   = $config[$params['off_on_line']];
        return $info;
    }
}

