<?php

//代替原生的 basename 函数
function get_basename($filename)
{
    return preg_replace('/^.+[\\\\\\/]/', '', $filename);
}

function IEVersion()
{
    $version = 0;
    preg_match('/MSIE (.*?);/', $_SERVER['HTTP_USER_AGENT'], $matches);
    if(count($matches)<2){
        preg_match('/Trident\/\d{1,2}.\d{1,2}; rv:([0-9]*)/', $_SERVER['HTTP_USER_AGENT'], $matches);
    }
    if(count($matches)>1){
        $version = (int)$matches[1];
    }
    return $version;
}

//json_decode转出来的stdclass object 转换成数组
function object_array($array){
  if(is_object($array)){
    $array = (array)$array;
  }
  if(is_array($array)){
    foreach($array as $key=>$value){
      $array[$key] = object_array($value);
    }
  }
  return $array;
} 
/**
 * 删除目录或者文件
 * @param  string  $path
 * @param  boolean $is_del_dir
 * @return fixed
 */
function del_dir_or_file($path, $is_del_dir = FALSE) {
    $handle = opendir($path);
    if ($handle) {
        // $path为目录路径
        while (false !== ($item = readdir($handle))) {
            // 除去..目录和.目录
            if ($item != '.' && $item != '..') {
                if (is_dir("$path/$item")) {
                    // 递归删除目录
                    del_dir_or_file("$path/$item", $is_del_dir);
                } else {
                    // 删除文件
                    unlink("$path/$item");
                }
            }
        }
        closedir($handle);
        if ($is_del_dir) {
            // 删除目录
            return rmdir($path);
        }
    }else {
        if (file_exists($path)) {
            return unlink($path);
        } else {
            return false;
        }
    }
}
/**
 *
 *去除二维数组中索引为0， 得到一维数组
 *
 *
**/
function remove_array_zero_index($info)
{
	return $info[0];
}
/**
 * 把文件打包成为zip
 * @param  array $files       需要打包在同一个zip中的文件的路径
 * @param  string $out_dir    zip的文件的输出目录
 * @param  [type] $des_name   zip文件的名称m
 * @return boolean            打包是否成功
 */
function zip($files, $file_path, $out_dir, $des_name) {
    $zip = new ZipArchive;
    // 创建文件夹
    mkdir($out_dir);
    // 打包操作
    $result = $zip->open($out_dir . '/' . $des_name, ZipArchive::CREATE);
    if (true !== $result) {
        return false;
    }

    foreach ($files as $file) {
        // 添加文件到zip包中
        $zip->addFile($file_path . '/' . $file,
                      str_replace('/', '', $file));
    }
    $zip->close();
    return true;
}

/**
 * 解压zip文件
 * @param  string $zip_file 需要解压的zip文件
 * @param  string $out_dir  解压文件的输出目录
 * @return boolean          解压是否成功
 */
function unzip($zip_file, $out_dir) {
    $zip = new ZipArchive();
    if (true !== $zip->open($zip_file)) {
        return false;
    }
    $zip->extractTo($out_dir);
    $zip->close();
    return true;
}


//截取干净字符串
function getSubStrEllipsis($str, $len=62, $suffix=' ...')
{
    $str = trim(strip_tags($str));
    $str = str_replace(array("\r\n", "\r", "\n"), '', $str);
    $str = preg_replace('/\s(?=\s)/', '', $str);
    if(strlen($str) <= $len){ return $str; }
    $str = substr($str, 0, $len);
    return $str.$suffix;
}

//把字符串变换成seo格式
function the_seo_filter($string, $limit=1)
{
    $retval = $string;
    $pattern = '/[\p{P}\p{S}]/u';
    $pattern_letter = '/[!"#$%&\'()*+,.\/:;<=>?@[\\\]^_`{|}~]/';
    $retval = preg_replace($pattern, '', strtolower($retval));
    $retval = preg_replace($pattern_letter, '', $retval);
    $retval = preg_replace('/\s/', '-', $retval);
    $foo = explode('-', $retval);
    foreach($foo as $value){
        switch (true){
            case ( strlen($value) <= $limit ):
                continue;
            default:
                $container[] = $value;
                break;
        }
    }
    $container = ( sizeof($container) > 0 ? implode('-', $container) : $string );
    return $container;
}

//得到一个网址的主域名
function getUrlDomain($url='')
{
    $url = trim($url); if($url == ''){ return false; }
    $pieces = parse_url($url);
    $domain = isset($pieces['host']) ? $pieces['host'] : '';
    if (preg_match('/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i', $domain, $regs)) {
        return $regs['domain'];
    }
    return false;
}

//自定义加密函数
function xr_encode($str)
{
    return md5($str.'_xr');
}


//加密函数
function passport_encrypt($txt, $key) {
	srand((double)microtime() * 1000000);
	$encrypt_key = md5(rand(0, 32000));
	$ctr = 0;
	$tmp = '';
	for($i = 0;$i < strlen($txt); $i++) {
	   $ctr = $ctr == strlen($encrypt_key) ? 0 : $ctr;
	   $tmp .= $encrypt_key[$ctr].($txt[$i] ^ $encrypt_key[$ctr++]);
	}
	return base64_encode(passport_key($tmp, $key));
}
//解密函数
function passport_decrypt($txt, $key) {
	$txt = passport_key(base64_decode($txt), $key);
	$tmp = '';
	for($i = 0;$i < strlen($txt); $i++) {
	   $md5 = $txt[$i];
	   $tmp .= $txt[++$i] ^ $md5;
	}
	return $tmp;
}

function passport_key($txt, $encrypt_key) {
	$encrypt_key = md5($encrypt_key);
	$ctr = 0;
	$tmp = '';
	for($i = 0; $i < strlen($txt); $i++) {
	   $ctr = $ctr == strlen($encrypt_key) ? 0 : $ctr;
	   $tmp .= $txt[$i] ^ $encrypt_key[$ctr++];
	}
	return $tmp;
	}

//获取文件夹中的文件列表
function getDirFile($dir, $pre='')
{
    $dir = $_SERVER['DOCUMENT_ROOT'].$dir;
    $fileArray = array();
    if(is_dir($dir)){

        if (false != ($handle = opendir($dir)))
        {
            $i=0;
            while ( false !== ($file = readdir($handle)) )
            {
                //去掉"“.”、“..”以及带“.xxx”后缀的文件
                if ($file!="." && $file!=".." && strpos($file,"."))
                {
                    $fileArray[$i] = $pre.$file;
                    $i++;
                }
            }
            //关闭句柄
            closedir( $handle );
        }
    }
    return $fileArray;
}

//把xml文件解析成数组
function _xmlToArray($file, $type=false, $returnArray=true)
{
    $file = trim($file);
    if($type){
        if(!is_file($file)){return null;}
        $str = simplexml_load_file($file);
    }else{
        if($file == ''){return null;}
        $str = simplexml_load_string($file);
    }
    return json_decode(json_encode($str), $returnArray);
}

/**
 * 对查询结果集进行排序
 * @param array $list 查询结果
 * @param string $field 排序的字段名
 * @param string $sortby 排序类型 asc正向排序 desc逆向排序 nat自然排序
 * @return array
 */
function list_sort_by($list, $field, $sortby='asc')
{
    if(is_array($list)){
        $refer = $resultSet = array();
        foreach ($list as $i => $data)
            $refer[$i] = &$data[$field];
        switch ($sortby) {
            case 'asc': // 正向排序
                asort($refer);
                break;
            case 'desc':// 逆向排序
                arsort($refer);
                break;
            case 'nat': // 自然排序
                natcasesort($refer);
                break;
        }
        foreach ( $refer as $key=> $val)
            $resultSet[] = &$list[$key];
        return $resultSet;
    }
    return false;
}

/**
 * 把返回的数据集转换成Tree
 * @param array $list 要转换的数据集
 * @param string $pk
 * @param string $pid parent标记字段
 * @param string $child 子数组标记
 * @param int $root
 * @return array
 */
function list_to_tree($list, $pk='id', $pid = 'pid', $child = '_child', $root = 0)
{
    // 创建Tree
    $tree = array();
    if(is_array($list)) {
        // 创建基于主键的数组引用
        $refer = array();
        foreach ($list as $key => $data) {
            $refer[$data[$pk]] =& $list[$key];
        }
        foreach ($list as $key => $data) {
            // 判断是否存在parent
            $parentId =  $data[$pid];
            if ($root == $parentId) {
                $tree[] =& $list[$key];
            }else{
                if (isset($refer[$parentId])) {
                    $parent =& $refer[$parentId];
                    $parent[$child][] =& $list[$key];
                }
            }
        }
    }
    return $tree;
}

/**
 * 将list_to_tree的树还原成列表
 * @param  array $tree  原来的树
 * @param  string $child 孩子节点的键
 * @param  string $order 排序显示的键，一般是主键 升序排列
 * @param  array  $list  过渡用的中间数组，
 * @return array        返回排过序的列表数组
 */
function tree_to_list($tree, $child = '_child', $order='id', &$list = array())
{
    if(is_array($tree)) {
        $refer = array();
        foreach ($tree as $key => $value) {
            $reffer = $value;
            if(isset($reffer[$child])){
                unset($reffer[$child]);
                tree_to_list($value[$child], $child, $order, $list);
            }
            $list[] = $reffer;
        }
        $list = list_sort_by($list, $order, $sortby='asc');
    }
    return $list;
}

/**
 * 把多维数组转化成一维数组
 *
 * @param array $arr 需要转换的数组，必须有相同的子节点
 * @param string $sub 子节点名称
 * @param array &$rs 返回的引用数组
 *
 * @return array
 */
function floatArray($arr=array(), $sub='_sub', &$rs)
{
    if(empty($arr)){ return false; }
    foreach($arr as $v){
        $tmp2 = $v;
        if(isset($tmp2[$sub])){
            unset($tmp2[$sub]);
            $rs[] = $tmp2;
            floatArray($v[$sub], $sub, $rs);
        }else{
            $rs[] = $v;
        }
    }
}

/**
 * 格式化字节大小
 * @param  number $size      字节数
 * @param  string $delimiter 数字和单位分隔符
 * @return string            格式化后的带单位的大小
 */
function format_bytes($size, $delimiter = '') {
    $units = array('B', 'KB', 'MB', 'GB', 'TB', 'PB');
    for ($i = 0; $size >= 1024 && $i < 5; $i++) $size /= 1024;
    return round($size, 2) . $delimiter . $units[$i];
}

/**
 * 格式化字节大小
 * @param  string $path      文件路径
 * @return string            文件大小
 */
function get_filesize($path)
{
    if(empty($path)) {
        return 0;
    }

    $info = get_headers($path, true);
    return $info['Content-Length'];
}

/**
 * 从一个单位转到另一个单位
 *
 * @param    int
 *
 * @return   float
 */
function convertSizeToSize($size, $params)
{
    isset($params['from']) && $params['from'] = strtoupper($params['from']);
    isset($params['to'])   && $params['to'] = strtoupper($params['to']);
    $units = array('B', 'KB', 'MB', 'GB', 'TB', 'PB');
        
    if (!empty($params['from']) && !empty($params['to'])) {
        $start_index = array_search($params['from'], $units);
        $end_index   = array_search($params['to'], $units);
        if ($start_index > $end_index) {
            for ($i =  $start_index; $i > $end_index; $i --) {
                $size *= 1024;
            }
        } else if ($start_index < $end_index) {
            for ($i =  $start_index; $i < $end_index; $i ++) {
                $size /= 1024;
            }
        }
        $index = $end_index;

        return $size;

    } else if (!empty($params['from']) && !isset($params['to'])) {
        $index = -1;
        for ($i = 0; $i < count($units); $i++) {
            $index ==  -1 && $index = array_search($params['from'], $units);
            if ($size < 1) {
                $index --;
                $size *= 1024;
            } else if ($size >= 1024) {
                $index ++;
                $size /= 1024;
            } else {
                break;
            }
            
        }
    }
    
    if (!empty($params['round'])) {
        $size = round($size, $params['round']);
    }

    return $size . $units[$index];
}

/*调试输出，打印结果，用法ddd($datas, 1)*/
function ddd($var, $exit=false, $printr=false){
    if($printr){
        echo '<pre>';print_r($var);echo '</pre>';
    }else{
        ob_start();
        var_dump($var);
        $output = ob_get_clean();
        if(!extension_loaded('xdebug')){
            $output = preg_replace("/\]\=\>\n(\s+)/m", "] => ", $output);
            $output = '<pre>'. htmlspecialchars($output, ENT_QUOTES).'</pre>';
        }
        echo $output;
    }
    if ($exit){exit;}
    else{return;}
}

function d3($var, $exit=false, $printr=false){
    echo "<pre>";print_r($var);exit;
}

//_mkDir
function _mkDir($dir, $mode=0777){
    if (!is_dir($dir)) {
        _mkDir(dirname($dir), $mode);
        $old = umask(0);
        @mkdir($dir, $mode);
        umask($old);
        return true;
    }
    return true;
}

//判断是否为email
function isEmail($str)
{
    return (filter_var($str, FILTER_VALIDATE_EMAIL) === false) ? false : true;
}

//手机
function isMobile($string){
    return preg_match('/^1[345678]+\d{9}$/', $string);
}
//电话
function isPhone($string) {
    return preg_match('/\d{8,18}$/', $string);
}
//随机字符
function _randStr($len=6, $type=3, $addChars=null){
    $str = '';
    switch($type) {
        case 1:
            $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'.$addChars;
            break;
        case 2:
            $chars = str_repeat('0123456789',3);
            break;
        case 3:
            $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ'.$addChars;
            break;
        case 4:
            $chars = 'abcdefghijklmnopqrstuvwxyz'.$addChars;
            break;
        default :
            $chars = 'ABCDEFGHIJKMNPQRSTUVWXYZabcdefghijkmnpqrstuvwxyz23456789'.$addChars;
            break;
    }
    if($len>10){$len = 10;}
    $charLen = strlen($chars) - 1;
    for($i=0; $i<$len; $i++){
        $str .= $chars[mt_rand(0, $charLen)];
    }
    return $str;
}

//过滤输出数据库数据
function Out($data, $filters='stripslashes')
{
    $filters = explode(',', $filters);
    foreach($filters as $filter){
        if(function_exists($filter)) {
            $data = is_array($data) ? arrayMapRecursive($filter, $data) : $filter($data);
        }
    }
    return $data;
}

//过滤输出数据库数据
function In($data, $filters='addslashes')
{
    $filters = explode(',', $filters);
    foreach($filters as $filter){
        if(function_exists($filter)) {
            $data = is_array($data) ? arrayMapRecursive($filter, $data) : $filter($data);
        }
    }
    return $data;
}

// 递归 array_map
function arrayMapRecursive($filter, $data)
{
    $result = array();
    foreach($data as $key => $val){
        $result[$key] = is_array($val) ? array_map_recursive($filter, $val) : call_user_func($filter, $val);
    }
    return $result;
}

//多个<br>化成一个
function merge_brs($string)
{
    $string = str_replace(array("\r\n", "\r", "\n"), '', $string);
    return preg_replace("/(<br\s?\/?>\s?)+/i", "<br/>", $string);
}

//把 n 换成 <br>
function nl_to_br($string)
{
    $string = str_replace(array("\r\n", "\r", "\n"), '<br/>', $string);
    return preg_replace("/(<br\s?\/?>\s?)+/i", "<br/>", $string);
}

//文件后缀名
function fileExt($filename, $len=10)
{
    return strtolower(trim(substr(strrchr($filename, '.'), 1, $len)));
}

//保留两位小数。如18.0000会得到string(18.00)；而round会得到float(18)
function _round($float, $n=2)
{
    return number_format($float, $n);
}

/**
 * 过滤
 * 
 * @param    array
 * @param    string
 *
 * @return   array
 */
function deep_filter($array, $method)
{
    if (empty($array)) {
        return $array;
    }
    if (is_string($array)) {
        return $method($array);
    } else if (is_array($array)){
        foreach ($array as $key => $val) {
            $array[$key] = deep_filter($val, $method);
        }
    }
    return $array;
}
/**
 * 获取ip
 * 
 * @param    string
 *
 * @return   string
 */
function GetIp(){  
    $realip = '';  
    $unknown = 'unknown';  
    if (isset($_SERVER)){  
        if(isset($_SERVER['HTTP_X_FORWARDED_FOR']) && !empty($_SERVER['HTTP_X_FORWARDED_FOR']) && strcasecmp($_SERVER['HTTP_X_FORWARDED_FOR'], $unknown)){  
            $arr = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);  
            foreach($arr as $ip){  
                $ip = trim($ip);  
                if ($ip != 'unknown'){  
                    $realip = $ip;  
                    break;  
                }  
            }  
        }else if(isset($_SERVER['HTTP_CLIENT_IP']) && !empty($_SERVER['HTTP_CLIENT_IP']) && strcasecmp($_SERVER['HTTP_CLIENT_IP'], $unknown)){  
            $realip = $_SERVER['HTTP_CLIENT_IP'];  
        }else if(isset($_SERVER['REMOTE_ADDR']) && !empty($_SERVER['REMOTE_ADDR']) && strcasecmp($_SERVER['REMOTE_ADDR'], $unknown)){  
            $realip = $_SERVER['REMOTE_ADDR'];  
        }else{  
            $realip = $unknown;  
        }  
    }else{  
        if(getenv('HTTP_X_FORWARDED_FOR') && strcasecmp(getenv('HTTP_X_FORWARDED_FOR'), $unknown)){  
            $realip = getenv("HTTP_X_FORWARDED_FOR");  
        }else if(getenv('HTTP_CLIENT_IP') && strcasecmp(getenv('HTTP_CLIENT_IP'), $unknown)){  
            $realip = getenv("HTTP_CLIENT_IP");  
        }else if(getenv('REMOTE_ADDR') && strcasecmp(getenv('REMOTE_ADDR'), $unknown)){  
            $realip = getenv("REMOTE_ADDR");  
        }else{  
            $realip = $unknown;  
        }  
    }  
    $realip = preg_match("/[\d\.]{7,15}/", $realip, $matches) ? $matches[0] : $unknown;  
    return $realip;  
}

/**
 * 按照key组合数组
 *
 * @param    array
 * @param    string
 *
 * @return   array
 **/
function singleGroup($array, $key)
{
	if (empty($array)) {
		return array();
	}

	$array1 = array();

	foreach ($array as $val) {
		$array1[$val[$key]] = $val;
	}

	return $array1;
}

/**
 * 按照key组合数组
 *
 * @param    array
 * @param    string
 * @param    string
 *
 * @return   array
 **/
function arrayGroup($array, $key, $chosen_value='')
{
	if (empty($array)) {
		return array();
	}

	$array1 = array();

	if ($chosen_value){
        foreach ($array as $val) {
            $array1[$val[$key]][] = $val[$chosen_value];
        }
    }else{
        foreach ($array as $val) {
            $array1[$val[$key]][] = $val;
        }
    }


	return $array1;
}


/**
 * 普通数组转为指定键值的关联数组
 *
 * @param    array
 * @param    string  转换后指定的键
 * @param    string  转换后指定的值
 *
 * @return   array
 **/
function singleKeyGroup($array, $key, $value=null)
{
    if (empty($array)) {
        return array();
    }

    $array1 = array();
    
    if($value) {
        foreach ($array as $val) {
            $array1[$val[$key]] = $val[$value];
        }
    } else {
        foreach ($array as $val) {
            $array1[] = $val[$key];
        }
    }

    return $array1;
}


function specialArrayGroup($array, $key, $grade = 0, $i = 0)
{
    if ($grade == $i) {
        return arrayGroup($array, $key);
    } else {
        foreach ($array as $ke => $val) {
            $i ++;
            if ($i <= $grade) {
                echo 'ke:'.$ke, '<br>';
                $array[$ke] =  specialArrayGroup($val, $key, $grade, $i);
            }
        }
    }
    return $array;
}

function special_array_group($array, $key) {
    foreach ($array as $ke => $val) {
        if (isset($val[0])) {
            $array[$ke] = arrayGroup($val, $key);
            $array[$ke] = array_merge(array('count' => count($array[$ke])),$array[$ke]);
        } else {
            
            $array[$ke] = special_array_Group($val, $key);
        }
    }

    return $array;
}

/**
 * 获取指定的键值
 * 
 * @param    array
 * @param    string
 *
 * @return   array
 */
function getSingleKey($array, $key)
{
    $infos = array();
    foreach ($array as $val) {
        isset($val[$key]) && $infos[] = $val[$key];
    }

    return $infos;
}

//二维数组排序
function array_sort($arr,$keys,$type='asc'){
    $keysvalue = $new_array = array();
    foreach ($arr as $k=>$v){
        $keysvalue[$k] = $v[$keys];
    }
    if($type == 'asc'){
        asort($keysvalue);
    }else{
        arsort($keysvalue);
    }
    reset($keysvalue);
    foreach ($keysvalue as $k=>$v){
        $new_array[$k] = $arr[$k];
    }
    return $new_array;
}
/**
 * 数组转换为字符串，主要用于把分隔符调整到第二个参数
 * @param  array  $arr 要连接的数组
 * @param  string $glue 分割符
 * @return string
 */
function arr2str($arr, $glue = ',')
{
    return implode($glue, $arr);
}

/**
 * 字符串截取，支持中文和其他编码
 * @static
 * @access public
 * @param string $str 需要转换的字符串
 * @param string $start 开始位置
 * @param string $length 截取长度
 * @param string $charset 编码格式
 * @param string $suffix 截断显示字符
 * @return string
 */
function msubstr($str, $start = 0, $length, $charset = "utf-8", $suffix = true)
{
    if (function_exists("mb_substr"))
        $slice = mb_substr($str, $start, $length, $charset);
    elseif (function_exists('iconv_substr')) {
        $slice = iconv_substr($str, $start, $length, $charset);
        if (false === $slice) {
            $slice = '';
        }
    } else {
        $re['utf-8'] = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
        $re['gb2312'] = "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
        $re['gbk'] = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
        $re['big5'] = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";
        preg_match_all($re[$charset], $str, $match);
        $slice = join("", array_slice($match[0], $start, $length));
    }
    return $suffix ? $slice . '...' : $slice;
}

/**
 * 转换存储单位
 *
 * @param    int
 * @param    string
 *
 * @return   string
 **/
function change_storage_unit($file_size, $unit = 'Byte')
{
    $arr = array('Byte', 'Kb', 'Mb', 'Gb');
    $unit = strtolower($unit);
    $unit = ucfirst($unit);
    $key = array_search($unit, $arr);
    if (false === $key) {
        return $file_size.$unit;
    }

    while($file_size >= '1024') {
        $file_size = $file_size / 1024;
        $key ++;
    }

    return sprintf("%.2f", $file_size) . $arr[$key];
}

function var_print($obj)
{
    echo '<pre>';
    print_r($obj);
    echo '</pre>';
}

/**
 * 判断是否都为空
 *
 * @param    array
 *
 * @return   boolean
 **/
function isAllEmpty($array)
{
    $array = recurise_null($array);

    if (empty($array)) {
        return true;
    }

    return false;
}

/**
 * 判断是否为互斥的条件
 *
 * @param    array
 *
 * @return   boolean
 **/
function isReject($array)
{
    $array = recurise_null($array);
    if (empty($array)) {
        return false;
    }

    if (count($array) == 1) {
        return false;
    }

    return true;
}

/**
 * 递归过滤空值
 *
 * @param    array
 *
 * @return   boolean
 **/
function recurise_null($arr)
{
    foreach ($arr as $key => $val) {
        if (is_array($val)) {
            $value = array_filter(recurise_null($val));
            if (count($value) < 1) {
                unset($arr[$key]);
            } else {
                $arr[$key] = $value;
            }
        } else {
           if ($val === '0') {
                $arr[$key] = $val.'_';
           } else if ($val === '' || $val === null) {
                unset($arr[$key]);
            }
        }
    }

    return $arr;
}

/**
 * 获取文件扩展名
 *
 * @param    string
 *
 * @return   string
 **/
function getFileExtension($file)
{
    return '.'.pathinfo($file, PATHINFO_EXTENSION);
}

function numToStr($num){
    if (stripos($num,'e')===false) return $num;
    $num = trim(preg_replace('/[=\'"]/','',$num,1),'"');//出现科学计数法，还原成字符串
    if ($num < 0) {
        $operator = '-';
    }
    $location = substr($num, strpos($num, 'e')+1);
    $prefix_str = str_replace('.','',substr($num, 0, strpos($num, 'e')));
    if ($location < 0) {
        $num = '0.'.str_pad($prefix_str, strlen($prefix_str)+abs($location)-1, '0', STR_PAD_LEFT);
    }
    if ($operator == '-') {
        $num = '-'.str_replace('-', '',$num);
    }
    return $num;
}

/**
 * pdf转化成png
 *
 * @param    string
 *
 * @return   string
 **/
function pdf2png($pdf,$params)
{
    if (!extension_loaded('imagick')) {
        exit('没有安装imageick扩展!');
    }
    if (!file_exists($pdf)) { 
        exit('没有找到pdf');
    }

    $scale = !empty($params['scale']) ? $params['scale'] : 100;
    empty($params['page']) && $params['page'] = 0;
    $im = new Imagick();
    $im->setResolution(120,120);  //设置图像分辨率
    $im->setCompressionQuality($scale); //压缩比
    $im->readImage($pdf."[0]"); //设置读取pdf的第一页
    //$im->thumbnailImage(200, 100, true); // 改变图像的大小
    
    if (!empty($params['width']) && $params['height']) {
        $im->scaleImage($params['width'],$params['height'],true); //缩放大小图像
    }
    $params['file_path'] = "test.jpg";
    $file_name = $params['file_path'];
    if (empty($params['file_path'])) {
        exit('保存的路径需要填写');
    }
    if ($im->writeImage($file_name) == true) {
        return $file_name;
    }

    return '';
} 


function getMemcache()
{
	$cache = S(
				array(
					'type'   => 'memcache',
					'host'   => '192.168.10.51',
					'port'   => '11211',
					'prefix' => 'mem_user',
					'expire' => 1800)
			);
	return $cache;		
}

/**
 * 
 * 验证用户是否登录
 */
function is_user_login()
{
    $user_id = session('user_id');
    if(empty($user_id))
    {
    	$token = cookie('sg');
    	if(!empty($token))
    	{
	    	$data = decode($token);
	    	$data_arr = explode(',', $data);
	    	$user_db = new \Home\Model\UserModel;
	    	$info = $user_db->getUser(array('user_id'=>$data_arr[0], 'user_name'=>$data_arr[1]));
	    	$user_id = $info['user_id'];
	    	if(!empty($info))
	    	{
		    	session('user_id', $data_arr[0]);
				session('user_name', $data_arr[1]);
				session('member_id', $data_arr[2]);
				if($data_arr[3] != 'N'){
					session('nick_name', $data_arr[3]);
				}
	    	}
    	}
    }
    return empty($user_id) ? 0 : $user_id;
}

/**
 * 
 * 获取页面显示的用户名
 */
function get_show_name()
{
	if(session('nick_name')){
		$show_name = session('nick_name');
	}else
	{
		$user_id = get_user_id();
		$user_db = new \Home\Model\UserModel;
		$user = $user_db->get($user_id);
		if(!empty($user))
		{
			if($user['nick_name'])
			{
				$show_name = $user['nick_name'];
				
			}else{
			
                $show_name = session('user_name');
				
			}
			session('nick_name', $show_name);
		}
	}	
	return $show_name;
}

/**
 * 
 * 获取用户名
 */
function get_user_name()
{
	$user_name = session('user_name');
	return $user_name? $user_name : '';
}

/**
 * 
 * 获取用户昵称
 */
function get_nick_name()
{
	$nick_name = session('nick_name');
	return $nick_name? $nick_name:'';
}

/**
 * 
 * 获取用户id
 */
function get_user_id()
{
	$user_id = session('user_id');
	return $user_id? $user_id : 0;
}

/**
 * 
 * 获取member_id
 */
function get_member_id()
{
	return session('member_id');
}


/**
 * 
 * 获取会员类型
 */
function get_member_type()
{
	return session('member_type');
}

/**
 * 
 * 获取未读消息总数(站内信\站内留言\组织邀请)
 */
function get_sum_count()
{
	return get_msg_count()+get_feedback_count()+get_project_share_count();
}

/**
 * 
 * 获取未读消息总数
 */
function get_msg_count()
{
	$msg_db = new \Home\Model\MsgModel;
	return $msg_db->getMsgCount(get_member_id());
}

function get_feedback_count()
{
	$member_id = get_member_id();
	return M('Feedback')->where("member_id = '{$member_id}' and status = '2'")->count('feedback_id');
}

/**
 * 
 * 获取未读项目信息总数
 */
function get_project_share_count()
{
    $member_id = get_member_id();
    return M('Project_share')->where("to_member_id = '{$member_id}' and status='0' ")->count('project_share_id');
}
/**
 * 
 * 获取用户头像
 */
function get_member_photo()
{
	if(session('portrait'))
		$portrait = session('portrait');
	else
	{
		$member_db = new \Home\Model\MemberModel;
		$member = $member_db->get(get_member_id());
		session('portrait', $member['portrait']);
		$portrait = $member['portrait'];
	}
	return $portrait;
}

/**
 * 获取邮件模板
 * 
 * @param    string
 *
 * @return   array
 */
function get_email_template($name, $lang = '')
{
    $db = M('Email_template');
    if ($lang == 'en') {
        $db = alterM('Email_template');
    }
	$info = $db->where("template_name = '{$name}' and  status = '1'")->find();
	return $info;
}

/**
 * 
 * 解析邮件模板
 * @param $content
 * @param $values
 */
function parseTemplate($content, $values)
{
	is_array($values) && extract($values);
	$content = preg_replace('/\{\{\s*\$([^}]*)\s*\}\}/', '${' . "\${1}" . '}', $content);
	$content = preg_replace('/"/', '\"', $content);
	eval("\$content = \"$content\";");
	return $content;
}

/**
 * 简单对称加密算法之加密
 * @param String $string 需要加密的字串
 * @param String $skey 加密EKY
 * @return String
 */
function encode($string = '', $skey = 'sanger_2014') 
{
    $strArr = str_split(base64_encode($string));
    $strCount = count($strArr);
    foreach (str_split($skey) as $key => $value) 
    {
        $key < $strCount && $strArr[$key].=$value;
    }
    return str_replace(array('=', '+', '/'), array('O0O0O', 'o000o', 'oo00o'), join('', $strArr));
}

/**
 * 简单对称加密算法之解密
 * @param String $string 需要解密的字串
 * @param String $skey 解密KEY
 * @return String
 */
function decode($string = '', $skey = 'sanger_2014') 
{
    $strArr = str_split(str_replace(array('O0O0O', 'o000o', 'oo00o'), array('=', '+', '/'), $string), 2);
    $strCount = count($strArr);
    foreach (str_split($skey) as $key => $value) 
    {
        if ($key <= $strCount && $strArr[$key][1] === $value) 
        {
            $strArr[$key] = $strArr[$key][0];
        }
    }
    return base64_decode(join('', $strArr));
}

/** 
 * 上传图像
 * 
 *@param    string
 *
 * @return   array
 **/
  function upload_img($fieldname,$path=''){
		$upload = new \Think\Upload();// 实例化上传类
		$upload->maxSize   =     3145728 ;// 设置附件上传大小
		$upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
		$upload->rootPath  =      'data/img/upload/'.$path.'/'; // 设置附件上传根目录
		// 上传单个文件 
		$info   =   $upload->uploadOne($_FILES[$fieldname]);
		$data['success']=true;
		if(!$info) {// 上传错误提示错误信息
						$data['success']=false;
						$data['msg']=$upload->getError();
		}else{// 上传成功 获取上传文件信息
			$data['url']="/".$upload->rootPath.$info['savepath'].$info['savename'];
			$data['msg']="上传成功";
		}
		return $data;
  }
  
/**
 * 
 * 上传文件
 * @param $fieldname
 * @param $path
 * @param $maxsize
 * @param $exts
 */
function upload_file($fieldname, $path='', $maxsize=5242880,$exts=array('xls','xlsx'), $subName=''){
    $upload = new \Think\Upload();// 实例化上传类
    $upload->maxSize   =     $maxsize;// 设置附件上传大小，单位字节(微信图片限制1M
    $upload->exts      =     $exts;// 设置附件上传类型
    $upload->rootPath  = 'file/upload/'.$path; // 设置附件上传根目录
    $upload->subName   = $subName;
    
    // 上传文件
    $info   =   $upload->uploadOne($_FILES[$fieldname]);

    if(!$info) {// 上传错误提示错误信息
        return array(status=>0,msg=>$upload->getError());
    }else{// 上传成功
        return array(status=>1,msg=>'上传成功',filepath=>$upload->rootPath.$info['savename']);
    }
}
  
function randomkeys($length, $num=false)
{
//	$pattern = '1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLOMNOPQRSTUVWXYZ';
	
	$pattern = '1234567890ABCDEFGHIJKLOMNOPQRSTUVWXYZ';
	$r = 35;
	if($num)
	{
		$pattern = '1234567890';
		$r = 9;
	}
  	for($i=0; $i<$length; $i++)
	{
   		$data .= $pattern{mt_rand(0, $r)};    //生成php随机数
 	}
 	return $data;
}

function email_domain()
{
	return array(
			'gmail.com'			 =>  'http://mail.google.com',
			'163.com'			 =>  'http://mail.163.com',
			'vip.163.com'        =>  'http://vip.163.com',
			'vip.sina.com'       =>  'http://vip.sina.com',
			'sina.com.cn'        =>  'http://mail.sina.com.cn',
			'sina.com'           =>  'http://mail.sina.com.cn',
			'yahoo.com.cn'       =>  'http://mail.cn.yahoo.com',
			'yahoo.cn'           =>  'http://mail.cn.yahoo.com',
			'tom.com'            =>  'http://mail.tom.com',
			'yeah.net'           =>  'http://www.yeah.net',
			'188.com'            =>  'http://www.188.com',
			'139.com'            =>  'http://mail.10086.cn',
			'189.com'            =>  'http://webmail15.189.cn/webmail',
			'wo.com.cn'          =>  'http://mail.wo.com.cn/smsmail',
			'188.com'            =>  'http://www.188.com',
			'21cn.com'           =>  'http://mail.21cn.com',
			'hotmail.com'        =>  'http://www.hotmail.com',
			'sogou.com'          =>  'http://mail.sogou.com',
			'sohu.com'           =>  'http://mail.sohu.com',
			'qq.com'             =>  'http://mail.qq.com',
			'vip.qq.com'         =>  'http://mail.qq.com',
			'foxmail.com'        =>  'http://mail.qq.com',
			'126.com'            =>  'http://mail.126.com',
			'yahoo.com'          =>  'http://mail.yahoo.com',
			'majorbio.com'       =>  'http://mail.majorbio.com/',
	);
}

function curl_api($url) {
    $ch = curl_init();     
    curl_setopt ($ch, CURLOPT_URL, $url);     
    curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
    $file_contents = curl_exec($ch);     
    curl_close($ch);
    return $file_contents;
}

/*
*样本分组排序
*/
function arrayKeySort(&$params, $type = 'string')
{ 
  
    if ($type == 'string') {
        ksort($params, SORT_STRING);
    } else {
        sort($params);
    }
    if (is_array($params)) {
        foreach ($params  as $key => $val) {
            if (is_array($val)) {
                $type = 'string';
                if (!empty($val[0])) {
                    $type = 'int';
                }
                arrayKeySort($params[$key],$type);
            }
        }
    }
}
/*
*随机数 
*/
function GetRandStr($len) 
{ 
    $chars = array( 
        "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k",  
        "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v",  
        "w", "x", "y", "z", "A", "B", "C", "D", "E", "F", "G",  
        "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R",  
        "S", "T", "U", "V", "W", "X", "Y", "Z", "0", "1", "2",  
        "3", "4", "5", "6", "7", "8", "9" 
    ); 
    $charsLen = count($chars) - 1; 
    shuffle($chars);   
    $output = ""; 
    for ($i=0; $i<$len; $i++) 
    { 
        $output .= $chars[mt_rand(0, $charsLen)]; 
    }  
    return $output;  
} 

/**
 * 用curl发送post请求,有文本格式和键值对模式两种
 * 键值对模式即表单模式,PHP会自动产生键值对
 * 文本格式通常用于传递json编码的数据
 * @param string $url
 * @param array $data
 * @param string $mod   传送post模式或json模式
 */
function curl_post($url, $data, $mod = 'post')
{
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    if($mod == 'json') {
        //设置请求头为纯文本格式,一般用于与其他语言的通讯中直接传递json,不会创建post数组
        $headers[] = 'Content-Type: text/xml;charset=utf-8';
        $data = json_encode($data);
    }else{
        //post模式.更适合与PHP通讯,可用$_POST接收
        $headers[] = 'Content-Type: application/x-www-form-urlencoded;charset=utf-8';
        $data = http_build_query($data);
    }
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_NOBODY, true);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    $return_str = curl_exec($curl);
    curl_close($curl);
    echo $return_str;
}

function set_keys($array,$key)
{
    foreach($array as $value){
        $infos[$value[$key]] = $value;
    }
    return $infos;
}
/**
 * 获取超过2G的文件的尺寸大小
 * @param type $file
 * @return number
 */
function get_size($file) {
    $size = filesize($file);
    if ($size < 0)
        if (!(strtoupper(substr(PHP_OS, 0, 3)) == 'WIN'))
            $size = trim('stat -c%s'. $file);
        else {
           $fsobj = new COM("Scripting.FileSystemObject");
           $f = $fsobj->GetFile($file);
           $size = $f->Size;var_print($size);exit;
        }
    return $size;
}

/**
 * php版本兼容函数 仅用于一维、二维数组
 *
 * @param    array
 * @param    mixed
 * @param    mixed
 *
 * @return   array
 */
if (!function_exists('array_column')) {
    function array_column($input = array(), $column_key = '', $index_key = '')
    {
        $return_array = array();
        if(!empty($input) && is_array($input) && $column_key){
            if(array_key_exists($column_key,$input)){
                    if(!empty($index_key) && array_key_exists($index_key,$input)){
                        $return_array[$input[$index_key]] = $input[$column_key];
                    }else{
                        $return_array[] = $input[$column_key];
                    }
            }else{
                foreach ($input as $key=>$value) {
                    if(array_key_exists($column_key,$value)){
                        if(!empty($index_key) && array_key_exists($index_key,$value)){
                            $return_array[$value[$index_key]] = $value[$column_key];
                        }else{
                            $return_array[$key] = $value[$column_key];
                        }
                    }
                }
            }
        }
        return $return_array;
    }
}

/**
 * 根据路径生成文件parent_hash
 *
 * @param    string
 * @param    string
 *
 * @return   array
 **/
if (!function_exists('generateParentHashByFileDirPath')) {
	function generateParentHashByFileDirPath($file_dir_path, $salt){
		return  md5($file_dir_path.$salt.'/1');
	}
}


/**
 * 创建磁盘文件夹
 *
 * @param    string
 * @param    string
 *
 * @return   array
 **/
function makeDir($path, $mode = 0777) {
    $old_mask = umask(0);
    $result = mkdir($path,$mode,true);
    umask($old_mask);

    return $result;
}

/** 
 * POST请求数据
 *
 * @param    string
 *
 * @return   string
 **/
function getCityInfoByIp($ip = ''){
    if(empty($ip)){
        $ip = GetIp();
    }
    $res = @file_get_contents('http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=js&ip=' . $ip);
    if(empty($res)){
        return false;
    }
    $jsonMatches = array();
    preg_match('#\{.+?\}#', $res, $jsonMatches);
    if(!isset($jsonMatches[0])){ return false; }
    $json = json_decode($jsonMatches[0], true);
    if(isset($json['ret']) && $json['ret'] == 1){
        $json['ip'] = $ip;
        unset($json['ret']);
    }else{
        return false;
    }
    return $json;
}


/**
 * 判断是否是内网,true为内网
 * @param    string
 * 
 * @return   boolean
 */
function isLan($ip){
    $ip_arr = explode(':', $ip); //Ip是否带端口
    if(isset($ip_arr[1]) && $ip_arr[1]){
        $ip = $ip_arr[0];
    }
    $iplong = bindec(decbin(ip2long($ip)));
    $lan_range = array( //私有网络地址段
            'A'=>array('10.0.0.0','10.255.255.255'),
            'B' =>array('172.16.0.0','172.31.255.255'),
            'C'=>array('192.168.0.0','192.168.255.255'),
    );
    $islan = false;
    foreach($lan_range as $k=>$v){
        $st = bindec(decbin(ip2long($v[0])));
        $ed = bindec(decbin(ip2long($v[1])));
        if($iplong >= $st && $iplong<=$ed){
            $islan = true;
            break;
        }
    }
    return $islan;
}
/** 
 * 转化为 log 10
 *
 * @param    number
 *
 * @return   number
 **/
function convertLog10Add1($number)
{
    return log10($number+1);
}

/**
* 参数json格式带中括号转php数组
*
* @param    array
*
* @return array
**/
function jsonBracketPhp($params)
{
    $params_keys = array_keys($params);
    foreach($params_keys as $key=>$val) {
        if(strpos($val, '[') !== false && substr_count($val, '[') == 1) {
            $temp_vals = explode('[', rtrim($val, ']'));
            $params[$temp_vals[0]][intval($temp_vals[1])] = $params[$val];
            unset($params[$val]);
        }else if(strpos($val, '[') !== false && substr_count($val, '[') == 2) {
            $temp_vals = explode('[', rtrim($val, ']'));
            $params[$temp_vals[0]][rtrim($temp_vals[1], ']')][intval($temp_vals[2])] = $params[$val];
            unset($params[$val]);
        }else if(strpos($val, '[') !== false && substr_count($val, '[') == 3) {
            $temp_vals = explode('[', rtrim($val, ']'));
            $params[$temp_vals[0]][rtrim($temp_vals[1], ']')][rtrim($temp_vals[2], ']')][intval($temp_vals[3])] = $params[$val];
            unset($params[$val]);
        }
    }
    return $params;
}

/*
 * 合并css
 * @param $file  string 要合并的文件
 * @return string
 */
function combine_css($file)
{
    header ("content-type:text/css; charset: utf-8");
    $rootdir = $_SERVER['DOCUMENT_ROOT'];
    $newdirpath = $rootdir."/combine/style/".MODULE_NAME."/".CONTROLLER_NAME."/";
    $returnpath = "/combine/style/".MODULE_NAME."/".CONTROLLER_NAME."/";
    if(isset($file) && !empty($file)) {
        $newfilename = md5($file."_".C('FILE_VERSION')).".css";
        $newfile = $newdirpath.$newfilename;
        if(file_exists($newfile)){
            echo $returnpath.$newfilename;
        }else{
            ob_start();
            $files = explode(",",$file);
            foreach ($files as $key => $val){
                $file_path = $val;
                if (substr($file_path, 0, 1) != '/') {
                    $file_path = '/'.STYLE_DIRNAME.'/'.$file_path;
                }   
                $oldfile = $rootdir.$file_path.".css";
                if(file_exists($oldfile)){
                    echo file_get_contents($oldfile);
                }                
            }
            if(!file_exists($newdirpath)){
                _mkDir($newdirpath);
            }
            file_put_contents($newfile,ob_get_clean());
            if(file_exists($newfile)){
                echo $returnpath.$newfilename;
            }
        }
    }else{
        return false;
    }
}

/*
 * 改变table名字
 *
 * return    string
 */
function joinChangeTable($table_name)
{
    $en_dbs = \Common\Custom\Db\Dbname::getDbnames();

    $en_dbs = array_flip($en_dbs);

    $replace_table_name = str_replace(C('DB_PREFIX'),'',strtolower($table_name));

    if (isset($en_dbs[$replace_table_name]) && LANG == 'en') {
        return C('DB_PREFIX').LANG.'_'.$replace_table_name;
    }

    return $table_name;
}

/*
 * 合并js
 * @param $file  string 要合并的文件
 * @return string
 */

function combine_js($file)
{
    header ("Content-type:application/x-javascript; Charset: utf-8"); 
    $rootdir = $_SERVER['DOCUMENT_ROOT'];
    $newdirpath = $rootdir."/combine/javascript/".MODULE_NAME."/".CONTROLLER_NAME."/";
    $returnpath = "/combine/javascript/".MODULE_NAME."/".CONTROLLER_NAME."/";   
    if(isset($file) && !empty($file)) {
        $newfilename = md5($file."_".C('FILE_VERSION')).".js";
        $newfile = $newdirpath.$newfilename;
        if(file_exists($newfile)){
            echo $returnpath.$newfilename;
        }else{
            ob_start();
            $files = explode(",",$file);
            foreach ($files as $key => $val){
                $file_path = $val;
                if (substr($file_path, 0, 1) != '/') {
                    $file_path = '/'.JAVASCRIPT_DIRNAME.'/'.$file_path;
                }   
                $oldfile = $rootdir.$file_path.".js";
                if(file_exists($oldfile)){
                    echo file_get_contents($oldfile);
                }                
            }
            if(!file_exists($newdirpath)){
                _mkDir($newdirpath);
            }
            file_put_contents($newfile,ob_get_clean());
            if(file_exists($newfile)){
                echo $returnpath.$newfilename;
            }
        }
    }else{
        return false;
    }
}


/**
 * 填充全角空格
 *
 * @param    string
 *
 * @return   string
 **/
function FillBackspace($str, $len = 5)
{
    if (strlen($str) >= $len) {
        return $str;
    }

    $space = '';
    for ($i = 0; $i < $len - strlen($str); $i ++) {
        $space .='　';
    }

    return $str.$space;
}


/*
* split str by delimiter 
*
* @param    string
* @param    array
* 
* @return   array
*/
function splitStringArrayByDelimiter($delimiter, $array, $index=0)
{
    if(empty($delimiter) || empty($array)) {
        return array();
    }

    return array_map(function($ele) use ($delimiter, $index) {
            $tmp = explode($delimiter, $ele);
            return $tmp[$index];
        }, $array);
}


/**
* 获取运行报错信息
*
*
*/
function getAnalysisError($lang, $params = array())
{
    if($lang == 'ch') {
        $share_config = array(
            'SUB_TASK_WRONG' => '提交任务失败',
            'REQUESST_TIMEOUT' =>'请求超时',
            'CHECK_NOT_FILE' =>'没有文件需要检测',
            'REQUESST_FAILED' =>'请求失败',
		);
        
    }else if($lang == 'en'){
        $share_config = array(
            'SUB_TASK_WRONG' => 'Submitting task failed',
            'REQUESST_TIMEOUT' =>'Request timed out',
            'CHECK_NOT_FILE' =>'No files need to be detected',
            'REQUESST_FAILED' =>'The request failed',
        );
    }
    $cmd_api          = new \Home\Logic\CmdLogic();
    $cmd_error_params = array();
    !empty($params['cmd_type']) && $cmd_error_params['cmd_type'] = $params['cmd_type'];
    $cmd_error_infos = $cmd_api->getCmdErrorInfos($lang, $cmd_error_params);
    $share_config = array_merge($share_config,$cmd_error_infos);
    return $share_config;
}

/**
 * 交互分析的code转化为内容
 *
 * @param    array
 * @param    int
 * 
 * @param    array
 */
function convertDeliveryCodeToContent($params, $type = 110)
{

    //获取code的配置数据
    $_lang = getAnalysisError(LANG, array('cmd_type' => $type));

    empty($params['info']) && $params['info'] = 'no info';
    if (empty($params['error']['code']) && empty($params['code']) && empty($params['info'])) {
        $result =  array('success' => $params['success'], 'info' => $params['info']);
        isset($params['ids']) && $result['ids'] = $params['ids'];

        return $result;
    }

    $info = '';
    $code = '';
    $variables = array();

    if (!empty($params['error']['code'])) {
        $code = $params['error']['code'];
        $variables = $params['error']['variables'];
    } else if (!empty($params['code'])) {
        $code = $params['code'];
        $variables = $params['variables'];
    } else {
        $info = $params['info'];
    }

    if (!empty($code)) {
        $info = $_lang[$code]['desc'];

        if (empty($info)) {
            $info = 'not match code';
            $variables = array();
        }
        foreach ($variables as $val) {
            $info = preg_replace("/\%s/", $val, $info, 1);
        }
    }

    $result = array('success' => $params['success'], 'info' => $info);
    isset($params['ids']) && $result['ids'] = $params['ids'];

    return $result;
}

/**
 * 对象存储 区 替换 单
 * 配置 \Common\Custom\Config\Front\File
 * ps: s3: => s3://
 */
function file_object_region_replace($file_url = '', $params = array()){
    if (empty($file_url)) {
        return '';
    }
    if (isset($params['type'])) {
        if ('1' == $params['type'] && !empty($params['salt'])) {
            $path = explode('/', $file_url, 3);
            if (!empty($params['region_bucket'])) {
                $path[0] = $params['region_bucket'];
            }
            $path[2] = 'm_'.$params['salt'].'/'.$path[2];
            $file_url = implode('/', $path);
            $file_url = $file_url.'/';
        }
    }

    if (false !== strpos($file_url, '://')) {
        return $file_url;
    }
    $search_replace = \Common\Custom\Config\Front\File\Config::getConfig();
    if (empty($search_replace['file_config']['file_object_replace'])) {
        $this->error('未配置file_object_replace');
    }

    return str_replace(array_keys($search_replace['file_config']['file_object_replace']), array_values($search_replace['file_config']['file_object_replace']), $file_url);
}

/**
 * 对象存储 区 替换 多
 */
function file_object_region_replaces ($file_urls = array()){

    $file_list = array();

    if (empty($file_urls)) {
        return $file_list;
    }

    foreach ((array)$file_urls as $key => $value) {
        $file_list[$key] = file_object_region_replace($value);
    }

    return $file_list;
}

/**
 * 访问 对象存储 区 url
 * ps: 
 * s3:metabolome/files/m_188/188_5bac3d1a4eef6/tsg_32337/a.txt => metabolome.s3.i-sanger.com/files/m_188/188_5bac3d1a4eef6/tsg_32337/a.txt
 * s3://metabolome/files/m_188/188_5bac3d1a4eef6/tsg_32337/a.txt => metabolome.s3.i-sanger.com/files/m_188/188_5bac3d1a4eef6/tsg_32337/a.txt
 */
function file_object_region_url($file_url = '', $params = array()){
    if (empty($file_url)) {
        return '';
    }
    if (false !== strpos($file_url, 'https://') || false !== strpos($file_url, 'http://')) {
        return $file_url;
    }
    $file_urls = explode(':', $file_url);
    $http_type = !empty($params['http_type'])?$params['http_type']:HTTP_TYPE;
    if (count($file_urls) > 1) {
        if (isset($params['bucket_type']) && 'public' == $params['bucket_type']) {//不用密钥
            $file_url = $http_type.$file_urls[0].'.'.C('REGION_INFOS')[$file_urls[0]]['AMZ_DOMAIN'].'/'.$file_urls[1];
        }else{
            $file_urls[1]   = ltrim($file_urls[1],'/');
            $temp_file_urls = explode('/', $file_urls[1]);

            $amz_api = \Common\Custom\Org\Sync\OssClient::getInstance(array('region' => $file_urls[0], 'http_type'=>$http_type));
            $amz_api->setBucket($temp_file_urls[0]);
            unset($temp_file_urls[0]);
            $file_url = $amz_api->getFileUrl(implode('/', $temp_file_urls),$params);
            if(empty($file_url)){
                return '';
            }
            $file_url           = str_replace($http_type,'',$file_url);
            $file_url_arr       = explode('/', $file_url, 2);
            $file_url_arr[0]    = explode('.', $file_url_arr[0],2);
            $file_url_arr[0]    = array_reverse($file_url_arr[0]);
            $file_url_arr[0]    = $http_type.implode('/', $file_url_arr[0]);
            $file_url           = implode('/', $file_url_arr);
        }
    } else {
        if (!empty($params['video_bucket'])) {
            $file_url = explode('/', $file_url);
            $file_url = array_pop($file_url);
            // $file_url_video = HTTP_TYPE.C('REGION_INFOS')[C('REGION')]['VIDEO_BUCKET'].'.'.C('REGION').'.'.C('REGION_INFOS')[C('REGION')]['AMZ_DOMAIN'];
            //处理https
            // if ('https://' == HTTP_TYPE) {
                $file_url_video = $http_type.C('REGION').'.'.C('REGION_INFOS')[C('REGION')]['AMZ_DOMAIN'].'/'.C('REGION_INFOS')[C('REGION')]['VIDEO_BUCKET'];
            // }
            switch ($params['video_bucket']) {
                case 'img':
                    $file_url = $file_url_video.'/video_images/'.$file_url;
                    break;
                case 'banner_img':
                    $file_url = $file_url_video.'/banner/images/'.$file_url;
                    break;
                case 'banner_video':
                    $file_url = $file_url_video.'/banner/video/'.$file_url;
                    break;                
                default:
                    $file_url = $file_url_video.'/video/'.$file_url;
                    break;
            }

        }else{
            $data = (0 === strpos($file_url, '/data/'))?'/':'/data/';
            $file_url = ltrim($file_url, '/');
            $file_url  = $data.$file_url;
            if (in_array(DOMAIN, array('i-sanger.com', 'sanger.com', 'majorbio.com'))) {
                $file_url = '/predata/'.substr($file_url, 6);
            }
            //远程访问
            $remote_data_dir = C('REMOTE_DATA_DIR');
            if (!empty($remote_data_dir)) {
                $file_url = $remote_data_dir.$file_url;
            }

        }
    }

    return $file_url;
}

/**
 * 访问 对象存储 区 url 多
 */
function file_object_region_urls($file_urls = array()){
    $file_list = array();

    if (empty($file_urls)) {
        return $file_list;
    }

    foreach ((array)$file_urls as $key => $value) {
        $file_list[$key] = file_object_region_url($value);
    }
    
    return $file_list;
}

/**
* 
*
**/
function showPathwayImageByPathwayInfos($pathway_infos)
{
    /**
    array(
        array(
            'pathway_id'    => 'map00195',
            'coords'        => '487,123,4',（圆圈对应坐标和半径）
            'fg_colors'     => '#0000CD',
            'bg_colors'     => '#00CD00',
            'fg_type'       => 1,
            'bg_type'       => 1,
            'shape'         => 'circle',（圆圈）
            'href'          => 'https://www.genome.jp/dbget-bin/www_bget?C00005',
            'title'         => 'C00005 (NADPH)',
        ),
        array(
            'pathway_id'    => 'map00195',
            'coords'        => '839,624,885,641',（矩形对应左上角坐标和右下角坐标）
            'fg_colors'     => '#0000CD',
            'bg_colors'     => '#00CD00',
            'fg_type'       => 1,边框平均分割数
            'bg_type'       => 1,颜色平均分割数
            'shape'         => 'rect',（矩形）
            'href'          => 'https://www.genome.jp/dbget-bin/www_bget?K02109+3.6.3.14',
            'title'         => 'K02109 (ATPF0B):accession<br /> 3.6.3.14:',
        )
    )
    
    **/
    
    $infos = array();
    foreach($pathway_infos as $key=>$val) {
        if($val['shape'] == 'circle') {
            $locations = explode(',', $val['coords']);
            $infos[] = array(
                'location_x'    => $locations[0] - $locations[2],
                'location_y'    => $locations[1] - $locations[2],
                'diameter'      => 2 * $locations[2],
                'shape'         => $val['shape'],
                'query'         => $val['query'],
                'href'          => strval($val['href']),
                'title'         => strval($val['title']),
            );
        }else if($val['shape'] == 'rect') {
            if($val['bg_type'] > 0) {//背景颜色数据
                $infos          = array_merge($infos, getBackgroundInfosByParams($val));
            }
            if($val['fg_type'] > 0) {//边框数据
                $infos          = array_merge($infos, getFramInfosByParams($val));
            }

            if($val['bg_type'] == 0 && $val['fg_type'] == 0) {
                $locations = explode(',', $val['coords']);
                $infos[] = array(
                    'location_x'    => intval($locations[0]),
                    'location_y'    => intval($locations[1]),
                    'shape'         => $val['shape'],
                    'query'         => $val['query'],
                    'href'          => strval($val['href']),
                    'title'         => strval($val['title']),
                );
            }
            
        }
    }

    return $infos;
}

/**
* 根据参数获取背景颜色数据
*
* @param    array
*
* @return    array
**/
function getBackgroundInfosByParams($params)
{
    if(count($params) < 1) {
        return false;
    }
    $infos = array();
    $locations  = explode(',', $params['coords']);
    $width      = intval($locations[2]) - intval($locations[0]) - 1;
    $height     = intval($locations[3]) - intval($locations[1]) - 1;
    $part_width = $width/$params['bg_type'];
    $bg_colors  = explode(',', $params['bg_colors']);
    for($i=0; $i<$params['bg_type']; $i++) {
        $location_x = $locations[0] + $i * $part_width + 1;
        $location_y = intval($locations[1]) + 1;
        $infos[] = array(
            'shape'         => $params['shape'],
            'query'         => $params['query'],
            'location_x'    => $location_x,
            'location_y'    => $location_y,
            'width'         => $part_width,
            'height'        => $height,
            'bg_color'      => $bg_colors[$i],
            'href'          => ($params['fg_type'] == 0) ? $params['href'] : '',
            'title'         => ($params['fg_type'] == 0) ? $params['title'] : '',
            'rect_type'     => 'bg'
        );
    }
    return $infos;
}

/**
* 根据参数获取边框数据
*
* @param    array
*
* @return    array
**/
function getFramInfosByParams($params)
{
    if(count($params) < 1) {
        
        return false;
    }
    $infos = array();
    $locations  = explode(',', $params['coords']);
    $width      = intval($locations[2]) - intval($locations[0]) + 2;
    $height     = intval($locations[3]) - intval($locations[1]) + 2;
    $part_width = $width/$params['fg_type'];
    $fg_colors  = explode(',', $params['fg_colors']);
    $border_left = '';
    $border_right = '';
    $border_width = '2';
    for($i=0; $i<$params['fg_type']; $i++) {
        $location_x = $locations[0] + $i * $part_width - 1;
        $location_y = $locations[1] - 1;
        if($i == 0 && $params['fg_type'] == 1) {//判断是否要左右边框
            $border_left = 'solid';
            $border_right = 'solid';
        }else if($i == 0) {
            $border_left = 'solid';
            $border_right = 'none';
        }else if($i == ($params['fg_type'] - 1)) {
            $border_left = 'none';
            $border_right = 'solid';
        }else {
            $border_left = 'none';
            $border_right = 'none';
        }
        $infos[] = array(
            'shape'         => $params['shape'],
            'location_x'    => $location_x,
            'location_y'    => $location_y,
            'width'         => $part_width,
            'height'        => $height,
            'border'        => !empty($params['border']) ? $params['border'] : 'solid',
            'border_left'   => $border_left,
            'border_right'  => $border_right, 
            'border_width'  => $border_width,
            'fg_color'      => $fg_colors[$i],
            'href'          => $params['href'],
            'title'         => $params['title'],
            'query'         => $params['query'],
            'rect_type'     => 'fg',
            'pic_id'        => strval($params['pic_id']),//2018/12/26后面增加点击有边框的ko出现表格需要用到
        );
    }
    return $infos;
}

/*
 * 组合
 * $a  样本数组
 * $m  组合数
 */
function combination($a, $m) {
    $r = array();

    $n = count($a);
    if ($m <= 0 || $m > $n) {
        return $r;
    }

    for ($i=0; $i<$n; $i++) {
        $t = array($a[$i]);
        if ($m == 1) {
            $r[] = $t;
        } else {
            $b = array_slice($a, $i+1);
            $c = combination($b, $m-1);
            foreach ($c as $v) {
                $r[] = array_merge($t, $v);
            }
        }
    }

    return $r;
}

/**
 * 将内容中的http://和https:// 统一改为 HTTP_TYPE
 * 
 * @param     string
 *
 * @return    string
 */
function replace_editor_img($content = '')
{
    $str = '';
    if (empty($content)) {
        return $str;
    }
    $str = str_replace(array('https://', 'http://'), array(HTTP_TYPE,HTTP_TYPE), $content);

    return $str;
}

/**

 * 根据用户名[邮箱]判断 1为公司内部，2为客户
 * 
 * @param    user_name
 * 
 * @return   int 
 */
function judge_member_type($user_name = '')
{
    $member_type = 0;
    if (empty($user_name)) {
        return $member_type;
    }
    $user_names = array('@major');
    $member_type = 2;
    foreach ($user_names as $value) {
        if (false !== strpos($user_name,$value)) {
            $member_type = 1;
            break;
        }
    }

    return $member_type;
}

/**
 * 读取excel成二维数组
 *
 * @param string $xls_path 表格路径
 * @param array $sheets 需要读取哪几个sheet,默认第一个0
 * @param string $type 驱动 (Excel5读取xls   |   Excel2007读取xlsx)
 *
 * @return mixed
 */
function readExcelToArray($xls_path = '', $sheets = array(0), $type = 'Excel5')
{
    $xls_path = trim($xls_path);
    if (!is_file($xls_path)) {
        return false;
    }
    if (empty($sheets)) {
        return false;
    }
    //打开表格
    $reader = \Vendor\PHPExcel\IOFactory::createReader($type);
    $obj    = $reader->load($xls_path);

    foreach ($sheets as $s) {
        $datas['sheet_' . $s] = $obj->getSheet($s)->toArray();
    }
    return $datas;
}

function json_error_inspect()
{
    switch (json_last_error()) {
        case JSON_ERROR_NONE:
            return '';
            break;
        case JSON_ERROR_DEPTH:
            return ' - Maximum stack depth exceeded';
            break;
        case JSON_ERROR_STATE_MISMATCH:
            return ' - Underflow or the modes mismatch';
            break;
        case JSON_ERROR_CTRL_CHAR:
            return ' - Unexpected control character found';
            break;
        case JSON_ERROR_SYNTAX:
            return ' - Syntax error, malformed JSON';
            break;
        case JSON_ERROR_UTF8:
            return ' - Malformed UTF-8 characters, possibly incorrectly encoded';
            break;
        default:
            return ' - Unknown error';
            break;
    }
}

/**
 * 生成uuid
 * 
 * @return   string
 */
if (!function_exists('uuid')) {
    function uuid()
    {
        return md5(uniqid(mt_rand(), true));
    }
}

/**
 * 判断文件权限
 *
 * @param    array
 *
 * @return   boolean
 **/
if (!function_exists('checkFilePrivilege')) {
    
	function checkFilePrivilege($method, $params)
    {
        $config         = \Common\Custom\Config\Front\ConfigFactory::config('file');

        $privilege_config = $config['privilege_config'];

        $privilege = $privilege_config[$method];

        if (empty($privilege)) {
            exit('验证文件权限---没有相关权限方法');
        }


        $result = true;
        foreach ($privilege as $key => $value) {
            if (!isset($params[$key]) && $key != 'or_condition') {
                exit('参数：'. $key.' 不能为空');
            }
            if ($key == 'privilege' && !in_array($params[$key], $value)) {
                $result = false;
                break;
            } else if ($key == 'is_lock' && $value != $params[$key]) {
                $result = false;
                break;
            } else if ($key == 'member_type' && !in_array($params[$key], $value)) {
                $result = false;
                break;
            } else if ($key == 'or_condition') {
                $i = 0;
                foreach ($value as $ke => $va) {
                    if (!isset($params[$ke])) {
                        exit('参数：'. $ke.' 不能为空');
                    }

                    if ($ke == 'is_lock' && $params[$ke] == $va) {
                        $i ++;
                        break 2;
                    } else if ($ke == 'member_type' && in_array($params[$ke], $va)) {
                        $i ++;
                        break 2;
                    }
                }

                if ($i == 0) {
                    $result = false;
                    break;
                }
            }
        }

        return $result;
    }
}

/**
 * 分隔截取路径中指定位置
 * 
 * @param    string
 * @param    string
 * 
 * @return   string
 */
if (!function_exists('getFilePathByFilePath')) {
    function getFilePathByFilePath($file_path, $start = "3", $end = "", $separate = '/'){
        $result = '';
        if (strlen($file_path) < 1) {
            return $result;
        }
        $origin_file_path = $file_path;
        $file_path = str_replace('\\', '/', $file_path);
        if (empty($end)) {
            $file_path  = explode($separate, $file_path, $start);
            $result     = isset($file_path[$start-1])?$file_path[$start-1]:$origin_file_path;
        }else{
            $file_path = explode($separate, $file_path);

            foreach ($file_path as $key => $value) {
                if ($key <= $end and $key >= $start) {
                    $result[] = $value;
                }
            }
            $result = implode($separate, $result);
        }

        return $result;
    }
}
/*
 * 处理失败
 * @param string $msg
 * @param null $data
 */
if (!function_exists('handleError')) {
    function handleError($msgOrData = '', $statusCode = 302, $data = null)
    {
        if (is_array($msgOrData)) {
            $data = $msgOrData;
            $msgOrData = '';
        }
        return handleResult(false, $msgOrData, $data, $statusCode);
    }
}

/**
 * 处理成功
 * @param string $msg
 * @param null $data
 */
if (!function_exists('handleSuccess')) {
    function handleSuccess($msg = '', $data = null, $statusCode = 200)
    {
        return handleResult(true, $msg, $data, $statusCode);
    }
}
/**
 * 处理结果
 * @param $status
 * @param string $msg
 * @return array
 */
if (!function_exists('handleResult')) {
    function handleResult($status, $msg = null, $data = null, $statusCode = 200)
    {
        return [
            'status' => $status,
            'msg' => $msg,
            'data' => $data,
            'statusCode' => $statusCode
        ];
	}
}
/**
 * 
 * @param    string
 * @param    string
 * 
 * @return   string
 */
if (!function_exists('getFilePathByFilePath')) {
    function getFilePathByFilePath($file_path, $start = "3", $end = "", $separate = '/'){
        $result = '';
        if (strlen($file_path) < 1) {
            return $result;
        }
        $origin_file_path = $file_path;
        $file_path = str_replace('\\', '/', $file_path);
        if (empty($end)) {
            $file_path  = explode($separate, $file_path, $start);
            $result     = isset($file_path[$start-1])?$file_path[$start-1]:$origin_file_path;
        }else{
            $file_path = explode($separate, $file_path);

            foreach ($file_path as $key => $value) {
                if ($key <= $end and $key >= $start) {
                    $result[] = $value;
                }
            }
            $result = implode($separate, $result);
        }

        return $result;
    }
}
/**
 * 验证上传文件的内容
 *
 * @param    string
 * @param    array
 * $check_status = checkFileContent($trait_path, array(
array('check_column' => 'sample', 'check_content' => $pre_specimen_ids),
array('check_column' => '>0', 'check_content' => 'number'),
)
);
 */
function checkFileContent($file_path, $check) {
    $file_path = file_object_region_url($file_path);
    $content = file_get_contents($file_path);
    if($content !== mb_convert_encoding(mb_convert_encoding($content, "UTF-32", "UTF-8"), "UTF-8", "UTF-32")) {
		return array('status' => 0, 'msg' => LANG == 'en'? 'Please upload file type utf-8' :'请传递utf-8格式的文件', 'data' => array(), 'statusCode' => 300);
    }
    $handle = fopen($file_path, 'r');

    $infos = array();
    $i = 0;
    $table_header = array();
    while(!feof($handle)) {
        $file_info = explode("\t" ,rtrim(fgets($handle)));
        if ($i == 0) {
            $table_header = $file_info;
            $i ++;
            continue;
        }
        foreach($table_header as $key=>$val) {
            $infos[$val][] = $file_info[$key];
        }
        $i ++;
    }

    foreach ($check as $key=>$val) {
        if (!empty($infos[$val['check_column']]) && $val['check_column'] == 'sample') {//验证样本列样本是否一致
            $intersect_infos = array_intersect($infos[$val['check_column']], $val['check_content']);
            $diff_infos = array_diff($infos['sample'], $val['check_content']);
            if (count($diff_infos) > 0 && ($intersect_infos != $val['check_column'] || $intersect_infos != $infos['sample'])) {
                return array('status' => 0, 'msg' => '样本不一致', 'data' => array(), 'statusCode' => 300);
            }
        }else if (strpos($val['check_column'], '>') !== false){//验证后面的列是否全是数字
            $handle_array = array_slice(array_values($infos), 1 + substr($val['check_column'], 1));
            $handle_array = array_reduce($handle_array, 'array_merge', array());
            $is_number = $handle_array == array_filter($handle_array,function($v,$k){
                return is_numeric($v) && is_int($k) ;
            },ARRAY_FILTER_USE_BOTH);
            if ($is_number === true && $val['check_content'] == 'discrete') {
                return array('status' => 0, 'msg' => '选择非连续类型时，表型数据不应该是数字', 'statusCode' => 300);
            }
        }
    }
    return array('status' => 1, 'msg' => '验证通过', 'statusCode' => 200);
}

if (!function_exists('mongoarray2str')) {
    function mongoarray2str($params = array()){
        $port           = 27017;
        if (!empty($params['port'])) {
            $port = $params['port'];
        }

        $str            = '';
        $must_params    = array('host', 'user_name', 'user_password', 'db_name');
        $remove_params  = array_merge($must_params, array('port'));
        $flag           = true;
        $else_prarms    = array();
        foreach ($must_params as $value) {
            if (!isset($params[$value])) {
                $flag = false;
                break;
            }
        }
        if (false === $flag) {
            return $str;
        }

        foreach ($params as $key => $value) {
            if (in_array($key, $remove_params)) {
                continue;
            }
            $else_prarms[]= $key.'='.$value;
        }
        if (!empty($else_prarms)) {
            $else_prarms = implode('&', $else_prarms);
            $else_prarms = '?'.$else_prarms;
        }
        $str = 'mongodb://'.$params['user_name'].':'.$params['user_password'].'@'.$params['host'].':'.$port.'/'.$params['db_name'].$else_prarms;
        return $str;
    }
}
require_once(APP_PATH . '/Common/Common/vendors.php');