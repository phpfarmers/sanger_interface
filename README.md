# sanger_interface
## Mongo连接统一说明:

### 一、公共修改部分(已修改)
1. `App\Common\Conf\config.php`
    > 增加参数:  `'OFF_ON_LINE' => 'offline'`, //指定线上[online]，线下[offline]；配置当前环境

2. `App\Common\Custom\Db\Mongo.class.php`
    > 增加 getGridFS 方法;全部替换后可以去掉`App\Common\conf\config.php` 的mongo数据库映射关系，同时去掉`App\Report\Model\BaseModel.class.php`中的映射处理，见代码备注；

3. `App\Common\Common\function.php`
    > 增加函数: 将mongo数组转为mongo字符串连接地址的函数`mongoarray2str`

4. `App\Report\Model\BaseModel.class.php`
    > 增加页面: report下面model的基类,用户调试读取配置，连接数据库

5. `App\Common\Custom\Config\Report\ConfigFactory.class.php`
    > 增加方法：`getDbConfig` 用于调试不同模块下的mongo配置文件

6. `App\Common\Custom\Db\Driver\Mongo.class.php`
    > 增加方法:`remove`用于删除

### 二、各产品线修改（示例：wgsv2、metag）

1. 对应产品model层的baseModel.class.php
    > 继承`App\Report\Model\BaseModel.class.php`基类。并指定`controller_name`值为当前产品模块名，如：`array('controller_name' => 'Metag')`

2. 各model文件读取内容修改
    > 选择数据表用`selectTable`、查询的条件(limit、sort、skip等)要放到查询(find)的后面。`去掉``$cursor->timeout(-1)`；封装的find方法中已有。

<table>
<tr><td>功能点</td><td>原</td><td>现</td></tr>
<tr>
    <td>选择数据表</td>
    <td>
        $this->_sanger_db->anno_card;
    </td>
    <td>
        $this->_sanger_db->selectTable('anno_card');
    </td>
</tr>
<tr>
    <td>Find放到最后执行</td>
    <td>
        $cursor = $this->_db->find($_condition)->sort(array('created_ts' => -1))->limit(1);
    </td>
    <td>
        $cursor = $this->_db->sort(array('created_ts' => -1))->limit(1)->find($_condition);
    </td>
</tr>
<tr>
    <td>其它库连接：如参考库</td>
    <td>
        $pres = explode('.',C('HTTP_SERVER'));
        $server_name = $pres[1];
        if(in_array($server_name, array('sanger','i-sanger','majorbio'))){
            // $this->_sanger_biodb = \Common\Custom\Mongo::getInstance(array('db' => 'sanger_bio_db', 'host' => '10.100.200.17:27017'));
            $this->_sanger_biodb = \Common\Custom\Mongo::getInstance(array('db' => 'sanger_bio_db', 'host' => 'mongodb://meta:v6m4t7w9y6x5@10.100.1.10/sanger_biodb?authMechanism=SCRAM-SHA-1'));
        }else if(in_array($server_name, array('tsg','tsanger','nsanger'))){
            $this->_sanger_biodb = \Common\Custom\Mongo::getInstance(array('db' => 'tsg_biodb', 'host' => 'mongodb://meta:v6m4t7w9y6x5@10.100.1.10/sanger?authMechanism=SCRAM-SHA-1'));
            //$this->_sanger_biodb = \Common\Custom\Mongo::getInstance(array('db' => 'tsg_biodb', 'host' => '192.168.10.16:27017'));
        }else{
            $this->_sanger_biodb = \Common\Custom\Mongo::getInstance(array('db' => 'sanger_biodb', 'host' => '192.168.10.189:27017'));
        }
        $this->_egg_nog4 = $this->_sanger_biodb->eggNOG4;
    </td>
    <td>
        $db_config_params   = array('module_name' => MODULE_NAME, 'controller_name' => 'Bio','off_on_line' => C('OFF_ON_LINE'));
        $db_config          = \Common\Custom\Config\Report\ConfigFactory::getDbConfig($db_config_params);
        $host               = mongoarray2str($db_config);
        if (empty($host)) {
            echo '转化mongo数据库连接出错';
            exit;
        }
        $db_name = $this->getMongoDbNameByDbName($db_config['db_name']); //取mongodb库名
        $this->_sanger_biodb = \Common\Custom\Db\Mongo::getInstance(array('db' => $db_name, 'host' => $host));
        $this->_egg_nog4 = $this->_sanger_biodb->selectTable('eggNOG4');
    </td>
</tr>
</table>
3. 维护各产品线数据连接配置
    > （如report模块）`App\Common\Custom\Config\Report\对应产品\Config.class.php`
