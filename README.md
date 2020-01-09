# sanger_interface
Mongo连接统一说明:

一、公共修改部分(已修改)

1、App\Common\Conf\config.php 【增加参数:  'OFF_ON_LINE' => 'offline', //指定线上[online]，线下[offline]；配置当前环境】

2、App\Common\Custom\Db\Mongo.class.php【增加 getGridFS 方法;全部替换后可以去掉App\Common\conf\config.php 的mongo数据库映射关系，同时去掉App\Report\Model\BaseModel.class.php中的映射处理，见代码备注；】

3、App\Common\Common\function.php【增加函数: 将mongo数组转为mongo字符串连接地址的函数mongoarray2str】

4、App\Report\Model\BaseModel.class.php【增加页面: report下面model的基类,用户调试读取配置，连接数据库】

5、App\Common\Custom\Config\Report\ConfigFactory.class.php【增加方法：getDbConfig 用于调试不同模块下的mongo配置文件】

6、App\Common\Custom\Db\Driver\Mongo.class.php【增加方法:remove用于删除】

二、各产品线修改（示例：wgsv2）

1、对应产品model层的baseModel.class.php继承App\Report\Model\BaseModel.class.php基类。并指定controller_name值为当前产品模块名，如：array('controller_name' => 'Metag')

2、各model文件读取内容修改：选择数据表用selectTable、查询的条件(limit、sort、skip等)要放到查询(find)的后面。

3、去掉$cursor->timeout(-1)；封装的find方法中已有。

4、维护各产品线数据连接配置（如report模块）App\Common\Custom\Config\Report\对应产品\Config.class.php