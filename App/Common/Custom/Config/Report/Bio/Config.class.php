<?php
namespace Common\Custom\Config\Report\Bio;
class Config extends \Common\Custom\Config\Report\BaseConfig
{

    /**
     * 获取配置数据
     *
     * @return   array
     **/
    static public function config()
    {
        $config = parent::getConfig();
        $config = array_merge($config, self::getConfig());

        return array_merge($config, self::getControllerConfig());
    }

    /**
     * 获取当前配置数据
     *
     * @return   array
     **/
    static public function getConfig()
    {
        return array();
    }

    /**
     * 控制器配置
     *
     * @return   array
     **/
    static private function getControllerConfig()
    {
        return array(
            'controller_config' => array(),
        );
    }

    /**
     * 获取当前模块mongo配置数据
     *
     * @return   array
     **/
    static public function getDbConfig()
    {
        return array(
            'online'    => array(
                'host'          => '1.1.1.1',
                'user_name'     => 'meta',
                'user_password' => 'aaaaa',
                'db_name'       => 'bbbbbb',
                'authMechanism' => 'SCRAM-SHA-1',
            ),
            'offline'   => array(
                'host'          => '1.1.1.1',
                'user_name'     => 'meta',
                'user_password' => 'aaaaaa',
                'db_name'       => 'bbbbbb',
                'authMechanism' => 'SCRAM-SHA-1',
            ),
        );
    }
}

