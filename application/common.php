<?php
use alisms\SendSms;
!\think\Config::get('app_debug') && error_reporting(E_ERROR | E_PARSE);

// 应用公共文件

/**
 * 发送短信
 * @param string $mobile 手机号码
 * @param string $template 模板ID
 * @param json $content 发送参数flashsale
 */
function sendSMS($mobile,$templateParam,$templateCode,$config){
    $sms = new SendSms();
    return $sms->send($mobile,$templateParam,$templateCode,$config);
}

/**
 * 发送邮件
 * @param $email
 * @param $title
 * @param $content
 * @param null $config
 * @return bool
 */
function send_email($email, $title, $content, $config = null)
{
    $config = empty($config) ? unserialize(config('email_server')) : $config;
    $mail   = new \PHPMailer\PHPMailer\PHPMailer(true); // Passing `true` enables exceptions
    try {
        //Server settings
        $mail->SMTPDebug = 0;                           // Enable verbose debug output
        $mail->isSMTP();                                // Set mailer to use SMTP
        $mail->Host       = $config['host'];            // Specify main and backup SMTP servers
        $mail->SMTPAuth   = true;                       // Enable SMTP authentication
        $mail->Username   = $config['username'];        // SMTP username
        $mail->Password   = $config['password'];        // SMTP password
        $mail->SMTPSecure = $config['secure'];          // Enable TLS encryption, `ssl` also accepted
        $mail->Port       = $config['port'];            // TCP port to connect to
        //Recipients
        $mail->setFrom($config['username'], $config['fromname']);
        $mail->addAddress($email);                      // Name is optional
        //Content
        $mail->isHTML(true);                            // Set email format to HTML
        $mail->Subject = $title;
        $mail->Body    = $content;
        if ($mail->send()) {
            return true;
        } else {
            return false;
        }
    } catch (Exception $e) {
        return false;
    }
}

/**
 * 数组转xls格式的excel文件
 * @param $data
 * @param $title
 * 示例数据
 * $data = [
 *     [NULL, 2010, 2011, 2012],
 *     ['Q1', 12, 15, 21],
 *     ['Q2', 56, 73, 86],
 *     ['Q3', 52, 61, 69],
 *     ['Q4', 30, 32, 10],
 * ];
 * @throws PHPExcel_Exception
 * @throws PHPExcel_Reader_Exception
 * @throws PHPExcel_Writer_Exception
 */
function export_excel($data, $title)
{
    // 最长执行时间,php默认为30秒,这里设置为0秒的意思是保持等待直到程序执行完成
    ini_set('max_execution_time', '0');
    $phpexcel = new PHPExcel();

    // Set properties 设置文件属性
    $properties = $phpexcel->getProperties();
    $properties->setCreator("Boge");//作者是谁 可以不设置
    $properties->setLastModifiedBy("Boge");//最后一次修改的作者
    $properties->setTitle($title);//设置标题
    $properties->setSubject('测试');//设置主题
    $properties->setDescription("备注");//设置备注
    $properties->setKeywords("关键词");//设置关键词
    $properties->setCategory("类别");//设置类别

    $sheet = $phpexcel->getActiveSheet();
    $sheet->fromArray($data);
    $sheet->setTitle('Sheet1'); // 设置sheet名称
    $phpexcel->setActiveSheetIndex(0);
    header('Content-Type: application/vnd.ms-excel');
    header("Content-Disposition: attachment;filename=" . $title . ".xls");
    header('Cache-Control: max-age=0');
    header('Cache-Control: max-age=1');
    header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
    header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
    header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
    header('Pragma: public'); // HTTP/1.0
    $objwriter = PHPExcel_IOFactory::createWriter($phpexcel, 'Excel5');
    $objwriter->save('php://output');
    exit;
}

/**
 * http请求
 * @param string $url 请求的地址
 * @param array $data 发送的参数
 */
function https_request($url, $data = null)
{
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    if (!empty($data)) {
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    }
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($curl);
    curl_close($curl);
    return $output;
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
 * 返回视频状态
 * @param  string  代码
 * @return string 状态
 */
function video_status($code){
    $status=array('Uploading'=>'上传中', 'UploadSucc'=>'上传完成', 'Transcoding'=>'转码中', 'TranscodeFail'=>'转码失败', 'Checking'=>'审核中', 'Blocked'=>'屏蔽', 'Normal'=>'正常',);
    return $status[$code];
}

/**
 * 毫秒转化为分钟
 * @param string $time
 * @return string 分钟
 */

function sec_to_minute($sec){
    $hour = sprintf("%02d", floor($sec/3600));
    $minute =sprintf("%02d", floor(($sec-3600*$hour)/60));
    $second =sprintf("%02d", floor((($sec-3600*$hour)-60*$minute)%60));
    echo $hour.':'.$minute.':'.$second;
}
/**
 * 把json字符串转数组
 * @param json $p
 * @return array
 */

function json_to_array($p)
{
    if (mb_detect_encoding($p, array('ASCII', 'UTF-8', 'GB2312', 'GBK')) != 'UTF-8') {
        $p = iconv('GBK', 'UTF-8', $p);
    }
    return json_decode($p, true);
}
/**
 * 计算json长度
 * @param json $p
 * @return array
 */
function json_count($json)
{
    $arr=json_to_array($json);
    return count($arr);
}

// 生成唯一订单号
function build_order_no()
{
    return date('Ymd') . substr(implode(null, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);
}

/**
 * 获取随机位数字符串
 * @param  integer $len 长度
 * @return string
 */
function rand_code($len =10)
{
    return substr(str_shuffle(str_repeat('ABCDEFGHGKMNPQSTUVWY1234567890', 10)), 0, $len);
}
/**
 * 获取随机位数数字
 * @param  integer $len 长度
 * @return string
 */
function rand_number($len = 6)
{
    return substr(str_shuffle(str_repeat('0123456789', 10)), 0, $len);
}

/**
 * 验证手机号是否正确
 */
function check_mobile($mobile)
{
    if (!is_numeric($mobile)) {
        return false;
    }
    return preg_match('#^13[\d]{9}$|^14[5,7]{1}\d{8}$|^15[^4]{1}\d{8}$|^17[0,6,7,8]{1}\d{8}$|^18[\d]{9}$|^19[\d]{9}$#', $mobile) ? true : false;
}
/**
 *判断是否是手机端
 */
function isMobile()
{
    if (isset ($_SERVER['HTTP_X_WAP_PROFILE']))
    {
        return true;
    }
    if (isset ($_SERVER['HTTP_VIA']))
    {
        return stristr($_SERVER['HTTP_VIA'], "wap") ? true : false;
    }
    if (isset ($_SERVER['HTTP_USER_AGENT']))
    {
        $clientkeywords = array ('nokia',
            'sony',
            'ericsson',
            'mot',
            'samsung',
            'htc',
            'sgh',
            'lg',
            'sharp',
            'sie-',
            'philips',
            'panasonic',
            'alcatel',
            'lenovo',
            'iphone',
            'ipod',
            'blackberry',
            'meizu',
            'android',
            'netfront',
            'symbian',
            'ucweb',
            'windowsce',
            'palm',
            'operamini',
            'operamobi',
            'openwave',
            'nexusone',
            'cldc',
            'midp',
            'wap',
            'mobile'
        );
        if (preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT'])))
        {
            return true;
        }
    }
    if (isset ($_SERVER['HTTP_ACCEPT']))
    {
        if ((strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') !== false) && (strpos($_SERVER['HTTP_ACCEPT'], 'text/html') === false || (strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') < strpos($_SERVER['HTTP_ACCEPT'], 'text/html'))))
        {
            return true;
        }
    }
    return false;
}
/**
 * 验证固定电话格式
 * @param string $tel 固定电话
 * @return boolean
 */
function check_tel($tel) {
    $chars = "/^([0-9]{3,4}-)?[0-9]{7,8}$/";
    if (preg_match($chars, $tel)) {
        return true;
    } else {
        return false;
    }
}

/**
 * 验证邮箱格式
 * @param string $email 邮箱
 * @return boolean
 */
function check_email($email)
{
    $chars = "/^[0-9a-zA-Z]+(?:[\_\.\-][a-z0-9\-]+)*@[a-zA-Z0-9]+(?:[-.][a-zA-Z0-9]+)*\.[a-zA-Z]+$/i";
    if (preg_match($chars, $email)) {
        return true;
    } else {
        return false;
    }
}

/**
 * 验证QQ号码是否正确
 * @param number $mobile
 */
function check_qq($qq)
{
    if (!is_numeric($qq)) {
        return false;
    }
    return true;
}

/**
 * 验证密码长度
 * @param string $password 需要验证的密码
 * @param int $min 最小长度
 * @param int $max 最大长度
 */
function check_password($password, $min, $max)
{
    if (strlen($password) < $min || strlen($password) > $max) {
        return false;
    }
    return true;
}

/**
 * 是否在微信中
 */
function in_wechat()
{
    return strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false;
}

/**
 * 配置值解析成数组
 * @param string $value 配置值
 * @return array|string
 */
function parse_attr($value)
{
    if (is_array($value)) {
        return $value;
    }
    $array = preg_split('/[,;\r\n]+/', trim($value, ",;\r\n"));
    if (strpos($value, ':')) {
        $value = array();
        foreach ($array as $val) {
            list($k, $v) = explode(':', $val);
            $value[$k] = $v;
        }
    } else {
        $value = $array;
    }
    return $value;
}

/**
 * 数组层级缩进转换
 * @param array $array 源数组
 * @param int $pid
 * @param int $level
 * @return array
 */
function list_to_level($array, $pid = 0, $level = 1)
{
    static $list = [];
    foreach ($array as $k => $v) {
        if ($v['pid'] == $pid) {
            $v['level'] = $level;
            $list[]     = $v;
            unset($array[$k]);
            list_to_level($array, $v['id'], $level + 1);
        }
    }
    return $list;
}

/**
 * 把返回的数据集转换成Tree
 * @param array $list 要转换的数据集
 * @param string $pid parent标记字段
 * @param string $level level标记字段
 * @return array
 * @author 麦当苗儿 <zuojiazi@vip.qq.com>
 */
function list_to_tree($list, $pk = 'id', $pid = 'pid', $child = 'children', $root = 0)
{
    // 创建Tree
    $tree = array();
    if (is_array($list)) {
        // 创建基于主键的数组引用
        $refer = array();
        foreach ($list as $key => $data) {
            $refer[$data[$pk]] = &$list[$key];
        }
        foreach ($list as $key => $data) {
            // 判断是否存在parent
            $parentId = $data[$pid];
            if ($root == $parentId) {
                $tree[] = &$list[$key];
            } else {
                if (isset($refer[$parentId])) {
                    $parent           = &$refer[$parentId];
                    $parent[$child][] = &$list[$key];
                }
            }
        }
    }
    return $tree;
}

/**
 * 将list_to_tree的树还原成列表
 * @param  array $tree 原来的树
 * @param  string $child 孩子节点的键
 * @param  string $order 排序显示的键，一般是主键 升序排列
 * @param  array $list 过渡用的中间数组，
 * @return array        返回排过序的列表数组
 * @author yangweijie <yangweijiester@gmail.com>
 */
function tree_to_list($tree, $child = 'children', $order = 'id', &$list = array())
{
    if (is_array($tree)) {
        $refer = array();
        foreach ($tree as $key => $value) {
            $reffer = $value;
            if (isset($reffer[$child])) {
                unset($reffer[$child]);
                tree_to_list($value[$child], $child, $order, $list);
            }
            $list[] = $reffer;
        }
        $list = list_sort_by($list, $order, $sortby = 'asc');
    }
    return $list;
}

/**
 * 对查询结果集进行排序
 * @access public
 * @param array $list 查询结果
 * @param string $field 排序的字段名
 * @param array $sortby 排序类型
 * asc正向排序 desc逆向排序 nat自然排序
 * @return array
 */
function list_sort_by($list, $field, $sortby = 'asc')
{
    if (is_array($list)) {
        $refer = $resultSet = array();
        foreach ($list as $i => $data) {
            $refer[$i] = &$data[$field];
        }

        switch ($sortby) {
            case 'asc': // 正向排序
                asort($refer);
                break;
            case 'desc': // 逆向排序
                arsort($refer);
                break;
            case 'nat': // 自然排序
                natcasesort($refer);
                break;
        }
        foreach ($refer as $key => $val) {
            $resultSet[] = &$list[$key];
        }

        return $resultSet;
    }
    return false;
}

// 驼峰命名法转下划线风格
function to_under_score($str)
{
    $array = array();
    for ($i = 0; $i < strlen($str); $i++) {
        if ($str[$i] == strtolower($str[$i])) {
            $array[] = $str[$i];
        } else {
            if ($i > 0) {
                $array[] = '_';
            }
            $array[] = strtolower($str[$i]);
        }
    }
    $result = implode('', $array);
    return $result;
}

/**
 * 自动生成新尺寸的图片
 * @param string $filename 文件名
 * @param int $width 新图片宽度
 * @param int $height 新图片高度(如果没有填写高度，把高度等比例缩小)
 * @param int $type 缩略图裁剪类型
 *                    1 => 等比例缩放类型
 *                    2 => 缩放后填充类型
 *                    3 => 居中裁剪类型
 *                    4 => 左上角裁剪类型
 *                    5 => 右下角裁剪类型
 *                    6 => 固定尺寸缩放类型
 * @return string     生成缩略图的路径
 */
function resize($filename, $width, $height = null, $type = 1)
{
    if (!is_file(ROOT_PATH . $filename)) {
        return;
    }
    // 如果没有填写高度，把高度等比例缩小
    if ($height == null) {
        $info = getimagesize(ROOT_PATH . $filename);
        if ($width > $info[0]) {
            // 如果缩小后宽度尺寸大于原图尺寸，使用原图尺寸
            $width  = $info[0];
            $height = $info[1];
        } elseif ($width < $info[0]) {
            $height = floor($info[1] * ($width / $info[0]));
        } elseif ($width == $info[0]) {
            return $filename;
        }
    }
    $extension = pathinfo($filename, PATHINFO_EXTENSION);
    $old_image = $filename;
    $new_image = mb_substr($filename, 0, mb_strrpos($filename, '.')) . '_' . $width . 'x' . $height . '.' . $extension;
    $new_image = str_replace('image', 'cache', $new_image); // 缩略图存放于cache文件夹
    if (!is_file(ROOT_PATH . $new_image) || filectime(ROOT_PATH . $old_image) > filectime(ROOT_PATH . $new_image)) {
        $path        = '';
        $directories = explode('/', dirname(str_replace('../', '', $new_image)));
        foreach ($directories as $directory) {
            $path = $path . '/' . $directory;
            if (!is_dir(ROOT_PATH . $path)) {
                @mkdir(ROOT_PATH . $path, 0777);
            }
        }
        list($width_orig, $height_orig) = getimagesize(ROOT_PATH . $old_image);
        if ($width_orig != $width || $height_orig != $height) {
            $image = \think\Image::open(ROOT_PATH . $old_image);
            switch ($type) {
                case 1:
                    $image->thumb($width, $height, \think\Image::THUMB_SCALING);
                    break;

                case 2:
                    $image->thumb($width, $height, \think\Image::THUMB_FILLED);
                    break;

                case 3:
                    $image->thumb($width, $height, \think\Image::THUMB_CENTER);
                    break;

                case 4:
                    $image->thumb($width, $height, \think\Image::THUMB_NORTHWEST);
                    break;

                case 5:
                    $image->thumb($width, $height, \think\Image::THUMB_SOUTHEAST);
                    break;

                case 5:
                    $image->thumb($width, $height, \think\Image::THUMB_FIXED);
                    break;

                default:
                    $image->thumb($width, $height, \think\Image::THUMB_SCALING);
                    break;
            }
            $image->save(ROOT_PATH . $new_image);
        } else {
            copy(ROOT_PATH . $old_image, ROOT_PATH . $new_image);
        }
    }
    return $new_image;
}

/**
 * hashids加密函数
 * @param $id
 * @param string $salt
 * @param int $min_hash_length
 * @return bool|string
 * @throws Exception
 */
function hashids_encode($id, $salt = '', $min_hash_length = 3)
{
    return (new Hashids\Hashids($salt, $min_hash_length))->encode($id);
}

/**
 * hashids解密函数
 * @param $id
 * @param string $salt
 * @param int $min_hash_length
 * @return null
 * @throws Exception
 */
function hashids_decode($id, $salt = '', $min_hash_length = 3)
{
    $id = (new Hashids\Hashids($salt, $min_hash_length))->decode($id);
    if (empty($id)) {
        return null;
    }
    return $id['0'];
}

/**
 * 保存后台用户行为
 * @param string $remark 日志备注
 */
function insert_admin_log($remark)
{
    if (session('?admin_auth')) {
        db('adminLog')->insert([
            'admin_id'    => session('admin_auth.admin_id'),
            'username'    => session('admin_auth.username'),
            'useragent'   => request()->server('HTTP_USER_AGENT'),
            'ip'          => request()->ip(),
            'url'         => request()->url(true),
            'method'      => request()->method(),
            'type'        => request()->type(),
            'param'       => json_encode(request()->param()),
            'remark'      => $remark,
            'create_time' => time(),
        ]);
    }
}

/**
 * 保存前台用户行为
 * @param string $remark 日志备注
 */
function insert_user_log($remark)
{
    if (session('?user_auth')) {
        db('userLog')->insert([
            'user_id'     => session('user_auth.user_id'),
            'username'    => session('user_auth.username'),
            'useragent'   => request()->server('HTTP_USER_AGENT'),
            'ip'          => request()->ip(),
            'url'         => request()->url(true),
            'method'      => request()->method(),
            'type'        => request()->type(),
            'param'       => json_encode(request()->param()),
            'remark'      => $remark,
            'create_time' => time(),
        ]);
    }
}

/**
 * 检测管理员是否登录
 * @return integer 0/管理员ID
 */
function is_admin_login()
{
    $admin = session('admin_auth');
    if (empty($admin)) {
        return 0;
    } else {
        return session('admin_auth_sign') == data_auth_sign($admin) ? $admin['admin_id'] : 0;
    }
}

/**
 * 检测会员是否登录
 * @return integer 0/用户ID
 */
function is_user_login()
{
    $user = session('user_auth');
    if (empty($user)) {
        return 0;
    } else {
        return session('user_auth_sign') == data_auth_sign($user) ? $user['user_id'] : 0;
    }
}
/**
 * 根据用户ID获取用户名
 * @return varchar 用户名
 */
function getUserName($id){
    return model('user')->where(['id'=>$id])->value('username')?:'游客';
}
/**
 * 根据教师ID获取教师名
 * @return varchar 用户名
 */
function getTeacherName($id){
    if($id==-1){
        return "网校自营";
    }else{
        return model('cooperate')->where(['id'=>$id])->value('username');
    }
}
function getTeacherBrief($id){
    if($id==-1){
        return "网站创始人";
    }else{
        return model('cooperate')->where(['id'=>$id])->value('brief');
    }
}
/**
 * 获取教师的上传目录ID
 * @param int
 * @return array
 */
function getCategoryId($id)
{
    return model('admin')->where(['cooperateid'=>$id])->value('category_id');
}
/**
 *根据前台用户ID获取申请的教师用户ID
 */
function getTeacherIdByUid($id){
    if(empty($id) or model('user')->where(['id'=>$id])->value('is_teacher')==0){
        return -2;
    }else{
        return model('cooperate')->where('uid',$id)->value('id');
    }
}
function getTeacherIdByAdminId($id){
    if(getAdminAuthId(is_admin_login())==1){
        return -1;
    }else{
        $uid=model('admin')->where(['id'=>$id])->value('uid');
        return model('cooperate')->where('uid',$uid)->value('id');
    }
}
/**
 *根据课程ID和类型获取教师ID
 */
function getTeachetId($cid,$type){
    if($type==1){
        return model('videoCourse')->where(['id'=>$cid])->value('teacher_id');
    }
    if($type==2){
        return model('liveCourse')->where(['id'=>$cid])->value('teacher_id');
    }
}
/**
 *根据前台用户ID获取申请的教师用户名
 */
function getTeacherNameByUid($id){
    return model('cooperate')->where('uid',$id)->value('username');
}
/**
 *根据后台ID获取管理组ID
 */
function getAdminAuthId($id){
    return model('authGroupAccess')->where('uid',$id)->value('group_id');
}
/**
 * 数据签名认证
 * @param  array $data 被认证的数据
 * @return string       签名
 */
function data_auth_sign($data)
{
    // 数据类型检测
    if (!is_array($data)) {
        $data = (array)$data;
    }
    ksort($data); // 排序
    $code = http_build_query($data); // url编码并生成query字符串
    $sign = sha1($code); // 生成签名
    return $sign;
}

/**
 * 清除系统缓存
 */
function clear_cache($directory = null)
{
    $directory = empty($directory) ? ROOT_PATH . 'runtime/cache/' : $directory;
    if (is_dir($directory) == false) {
        return false;
    }
    $handle = opendir($directory);
    while (($file = readdir($handle)) !== false) {
        if ($file != "." && $file != "..") {
            is_dir($directory . '/' . $file) ? clear_cache($directory . '/' . $file) : unlink($directory . '/' . $file);
        }
    }
    if (readdir($handle) == false) {
        closedir($handle);
        rmdir($directory);
    }
}

/**
 * 执行远程POST提交
 */
function post_curl($url,$data,$headers = '',$cookie = '')
{
    if(!$url) return false;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_UNRESTRICTED_AUTH, 1);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible, MSIE 11, Windows NT 6.3; Trident/7.0; rv:11.0) like Gecko');
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    if($headers) curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_COOKIE, $cookie);
    $output = curl_exec($ch);
    curl_close($ch);
    return $output;
}
/**
 * 执行远程GET提交
 */
function get_curl($url){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL            , $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER , true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER , false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST , false);
    curl_setopt($ch, CURLOPT_ENCODING       , 'gzip,deflate');
    curl_setopt($ch, CURLOPT_TIMEOUT        , 60);
    $result =  curl_exec($ch);
    return $result;
}

/**
 * 获取本站域名
 */
function get_domain()
{
    $host=$_SERVER["HTTP_HOST"];
    return $host;
}

/**
 * 返回课程类型
 * @param  string  代码
 * @return string 状态
 */
function section_type($code){
    $type=array('1'=>'视频课程', '2'=>'音频课程', '3'=>'文本课程', '4'=>'考试题');
    return $type[$code];
}

/**
 * 返回题型类型
 */
function get_pre_type($code)
{
    $type=array('0'=>'请选择类型','1'=>'客观题', '2'=>'主观题');
    return $type[$code];
}

/**
 * 根据题型ID获取题型mark
 */
function get_question_mark($id)
{
    $mark=model('QuestionType')->where('id',$id)->find();
    return $mark['mark'];
}

/**
 * 根据题型ID获取分类名称
 */
function get_category_name($id)
{
    $name=model('CourseCategory')->where('id',$id)->find();
    return $name['category_name'];
}
/**
 * 根据题型ID获取题型ID
 */
function get_question_type_id($id)
{
    return model('questions')->where('id',$id)->value('questiontype');
}
/**
 * 根据题型ID获取题型名称
 */
function get_question_type($id)
{
    $mark=model('QuestionType')->where('id',$id)->find();
    return $mark['type_name'];
}

/**
 * 根据题型ID获取试题
 */
function get_question_info($id,$field)
{
    $question=model('Questions')->where('id',$id)->find();
    return $question[$field];
}
/**
 * 检测提交的试题答案是否正确
 */
function check_answer($id,$answer){
    $questionanswer=model('Questions')->where('id',$id)->value('questionanswer');
    if($questionanswer==$answer){
        return true;
    }else{
        return false;
    }
}
/**
 * 获取试题答案
 */
function get_answer($id){
    return (model('Questions')->where('id',$id)->value('questionanswer'));
}
/**
 * 获取试题答案解析
 */
function get_analysis($id){
    return (model('Questions')->where('id',$id)->value('questiondescribe'));
}
/**
 * 获取多项选择题的选项个数
 */
function get_multiSelect($id){
    $num=model('Questions')->where('id',$id)->value('questionselectnumber');
    if($num==3){
        return '<input type="checkbox" name="answer['.$id.'][]" value="A" title="A">
                  <input type="checkbox" name="answer['.$id.'][]" value="B" title="B">
                  <input type="checkbox" name="answer['.$id.'][]" value="C" title="C">';
    }
    if($num==4){
        return '<input type="checkbox" name="answer['.$id.'][]" value="A" title="A">
                  <input type="checkbox" name="answer['.$id.'][]" value="B" title="B">
                  <input type="checkbox" name="answer['.$id.'][]" value="C" title="C">
                  <input type="checkbox" name="answer['.$id.'][]" value="D" title="D">';
    }
    if($num==5){
        return '<input type="checkbox" name="answer['.$id.'][]" value="A" title="A">
                  <input type="checkbox" name="answer['.$id.'][]" value="B" title="B">
                  <input type="checkbox" name="answer['.$id.'][]" value="C" title="C">
                  <input type="checkbox" name="answer['.$id.'][]" value="D" title="D">
                  <input type="checkbox" name="answer['.$id.'][]" value="E" title="E">';
    }
    if($num==6){
        return '<input type="checkbox" name="answer['.$id.'][]" value="A" title="A">
                  <input type="checkbox" name="answer['.$id.'][]" value="B" title="B">
                  <input type="checkbox" name="answer['.$id.'][]" value="C" title="C">
                  <input type="checkbox" name="answer['.$id.'][]" value="D" title="D">
                  <input type="checkbox" name="answer['.$id.'][]" value="E" title="E">
                  <input type="checkbox" name="answer['.$id.'][]" value="F" title="F">';
    }
    if($num==7){
        return '<input type="checkbox" name="answer['.$id.'][]" value="A" title="A">
                  <input type="checkbox" name="answer['.$id.'][]" value="B" title="B">
                  <input type="checkbox" name="answer['.$id.'][]" value="C" title="C">
                  <input type="checkbox" name="answer['.$id.'][]" value="D" title="D">
                  <input type="checkbox" name="answer['.$id.'][]" value="E" title="E">
                  <input type="checkbox" name="answer['.$id.'][]" value="F" title="F">
                  <input type="checkbox" name="answer['.$id.'][]" value="G" title="G">';
    }

}
/**
 * 获取考试标题
 */
function get_exam_title($id){
    return (model('Exams')->where('id',$id)->value('exam'));
}
/**
 * 判断题返回信息
 */
function get_yesOrNo($code)
{
    $type=array('0'=>'错','1'=>'对');
    return $type[$code];
}
function markstatus($code)
{
    $type=array('0'=>'<font color="#2F4056">待批阅</font>','1'=>'<font color="#009688">已批阅</font>');
    return $type[$code];
}
/**
 * 根据管理员ID获取管理员名称
 */
function get_admin_name($id)
{
    $admin=model('Admin')->where('id',$id)->find();
    return $admin['username'];
}

/**
 * 获取试题难度
 */
function get_question_level($code)
{
    $type=array('1'=>'易','2'=>'中', '3'=>'难');
    return $type[$code];
}
/**
 * 给定时间戳获取剩余天数
 */
function getLastTime($unixEndTime=0)
{
    if ($unixEndTime <= time()) {
        return '<font color="red">到期</font>';
    }
    $time = $unixEndTime - time();
    $days = 0;
    if ($time >= 86400) { // 如果大于1天
        $days = (int)($time / 86400);
        $time = $time % 86400; // 计算天后剩余的毫秒数
    }
    $xiaoshi = 0;
    if ($time >= 3600) { // 如果大于1小时
        $xiaoshi = (int)($time / 3600);
        $time = $time % 3600; // 计算小时后剩余的毫秒数
    }
    $fen = (int)($time / 60); // 剩下的毫秒数都算作分
    return $days . '天' . $xiaoshi . '时' . $fen . '分';
}
/**
 * 发布时间显示
 */
function get_last_time($time)
{
    $time=strtotime($time);
    $todayLast = strtotime(date('Y-m-d 23:59:59'));
    $agoTimeTrue = time() - $time;
    $agoTime = $todayLast - $time;
    $agoDay = floor($agoTime / 86400);

    if ($agoTimeTrue < 60) {
        $result = '刚刚';
    } elseif ($agoTimeTrue < 3600) {
        $result = (ceil($agoTimeTrue / 60)) . '分钟前';
    } elseif ($agoTimeTrue < 3600 * 12) {
        $result = (ceil($agoTimeTrue / 3600)) . '小时前';
    } elseif ($agoDay == 1) {
        $result = '昨天 ';
    } elseif ($agoDay == 2) {
        $result = '前天 ';
    } else {
        $format = date('Y') != date('Y', $time) ? "Y-m-d" : "m-d";
        $result = date($format, $time);
    }
    return $result;
}

/**
 * 回复数量查询
 */
function replaycount($id){
    return model('forumReply')->where(['tid'=>$id])->count();
}

/**
 * 根据键值删除数组中的元素
 */
function array_remove_by_key($arr, $key){
    if(!array_key_exists($key, $arr)){
        return $arr;
    }
    $keys = array_keys($arr);
    $index = array_search($key, $keys);
    if($index !== FALSE){
        array_splice($arr, $index, 1);
    }
    return $arr;
}
/**
 * api 接口正确输出
 * @param string $data 返回数据
 * @param string $message 提示信息
 */
function json_success($data = '', $message = 'success')
{
    header('Content-Type:application/json; charset=utf-8');
    $result['status'] = 1;
    $result['message'] = $message;
    $result['data'] = empty($data) ? [] : $data;

    exit(json_encode($result));
}

/**
 * api 接口错误输出
 * @param int $status 状态码： -1参数错误（开发提示） -2用户提示（用户输入错误、商品不存在等） -9token过期
 * @param string $message 提示信息
 */
function json_error($message = 'error', $status = -1)
{
    header('Content-Type:application/json; charset=utf-8');
    $result['status'] = $status;
    $result['message'] = $message;

    exit(json_encode($result));
}

/**
 * 获取客户端IP地址
 * @param int $type 返回类型 0 返回IP地址 1 返回IPV4地址数字
 * @return mixed
 */
function get_client_ip($type = 0)
{
    $type = $type ? 1 : 0;
    static $ip = null;
    if ($ip !== null) return $ip[$type];

    if (isset($_SERVER['HTTP_X_REAL_IP'])) {
        //nginx 代理模式下，获取客户端真实IP
        $ip = $_SERVER['HTTP_X_REAL_IP'];
    } elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
        //客户端的ip
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        //浏览当前页面的用户计算机的网关
        $arr = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
        $pos = array_search('unknown', $arr);
        if (false !== $pos) unset($arr[$pos]);
        $ip = trim($arr[0]);
    } else {
        //浏览当前页面的用户计算机的ip地址
        $ip = $_SERVER['REMOTE_ADDR'];
    }

    //IP地址合法验证
    $long = sprintf("%u", ip2long($ip));
    $ip = $long ? [$ip, $long] : ['0.0.0.0', 0];

    return $ip[$type];
}

/**
 * 字符转码
 * @param $data
 * @return array|string
 */
function gbk2utf8($data)
{
    if (is_array($data)) {
        return array_map('gbk2utf8', $data);
    }

    return iconv('gbk', 'utf-8//IGNORE', $data); //IGNORE 会忽略掉不能转化的字符，而默认效果是从第一个非法字符截断。
}
/**
 * 生成二维码
 * @param $data
 * @return array|string
 */
function qrcode($url)
{
    vendor("phpqrcode.phpqrcode");
    $level = 'L';
    $size = 4;
    QRcode::png($url, false, $level, $size);
}
/**
 * 返回订单状态
 * @param $cid,$
 * @return array|string
 */
function getOrderSatatus($code){
    if($code==0){
        return "<font color='red'>未支付</font>";
    }
    if($code==1){
        return "支付成功";
    }
}
/**
 * 返回支付方式
 * @param $cid,$
 * @return array|string
 */
function getPayMethod($code){
    if($code=='wxpay'){
        return "微信支付";
    }
    if($code=='alipay'){
        return "支付宝支付";
    }
    if($code=='yuepay'){
        return "账户余额";
    }
    if($code=='free'){
        return "免费添加";
    }
}
/**
 * 获取课程名称
 * @param $cid,$
 * @return array|string
 */
function getCourseName($id,$type){
    if($type==1){
        return model('videoCourse')->where('id',$id)->value('title');
    }
    if($type==2){
        return model('liveCourse')->where('id',$id)->value('title');
    }
    if($type==3){
        return model('classroom')->where('id',$id)->value('title');
    }

}
/**
 * 获取课程封面
 * @param $cid,$
 * @return array|string
 */
function getCoursePic($id,$type){
    if($type==1){
        return model('videoCourse')->where('id',$id)->value('picture');
    }
    if($type==2){
        return model('liveCourse')->where('id',$id)->value('picture');
    }
    if($type==3){
        return model('classroom')->where('id',$id)->value('picture');
    }

}
/**
 * 获取课程章节数量
 * @param $cid,$type
 * @return int
 */
function getCourseNum($cid,$type)
{
    if($type==1){
        $unm= model('videoSection')->where(['csid'=>$cid,'ischapter'=>0])->count();
    }
    if($type==2){
        $unm= model('liveSection')->where(['csid'=>$cid,'ischapter'=>0])->count();
    }
    return $unm==0?1:$unm;

}
/**
 * 获取课程购买人数
 * @param $cid,$type
 * @return int
 */
function getUserNum($cid,$type){
    $num=model('userCourse')->where(['cid'=>$cid,'type'=>$type])->count();
    if($type==1){
        $xuNun=model('videoCourse')->where(['id'=>$cid])->value('xuni_num');
    }
    if($type==2){
        $xuNun=model('liveCourse')->where(['id'=>$cid])->value('xuni_num');
    }
    if($type==3){
        $xuNun=model('classroom')->where(['id'=>$cid])->value('xuni');
    }
    return $num+$xuNun;
}
/**
 * 获取课程购买真实人数
 * @param $cid,$type,$true
 * @return int
 */
function getTrueUserNum($cid,$type){
    $num=model('userCourse')->where(['cid'=>$cid,'type'=>$type])->count();
    return $num;
}
/**
 * 获取已学章节数量
 * @param $cid,$type
 * @return int
 */

function getStuduedNum($cid,$type,$uid=null){
    $uid=$uid?:is_user_login();
    $studiedId=model('userCourse')->where(['cid'=>$cid,'type'=>$type,'uid'=>$uid])->value('studied');
    return json_count($studiedId);
}
/**
 * 获取上次的学习记录
 * @param $cid,$type
 * @return array
 */
function getLastStudy($cid,$type){
    $lastStudyId=model('userCourse')->where(['cid'=>$cid,'type'=>$type,'uid'=>is_user_login()])->value('nowstudy');
    if($type==1){
        $lastStudyTitle=model('videoSection')->where(['id'=>$lastStudyId])->value('title');
    }
    if($type==2){
        $lastStudyTitle=model('liveSection')->where(['id'=>$lastStudyId])->value('title');
    }
    return (['id'=>$lastStudyId,'title'=>$lastStudyTitle]);
}
/**
 * 课程若是免费，输出"免费"
 * @param int
 * @return array
 */
function isFree($pirce){
    if($pirce==0){
        return "<font color='#15c288'><i class='layui-icon layui-icon-rmb mr10' style='color:#15c288'></i><i style='color:#15c288'>免费</i></font>";
    }else{
        return "<i class='layui-icon layui-icon-rmb mr10'></i>$pirce";
    }
}
/**
 * 课程有效期，为0时，输出"不限"
 * @param int
 * @return array
 */
function youxiaoqi($youxiaoqi){
    if($youxiaoqi==0){
        return '不限';
    }else{
        return '从购买之日起'.$youxiaoqi.'天';
    }
}
function youxiaoqi2($youxiaoqi){
    if($youxiaoqi==0){
        return '不限';
    }else{
        return $youxiaoqi.'天';
    }
}
/**
 * 获取直播类型
 * @param int
 * @return array
 */
function getLIveType ($code){
    if($code==1){
        return "一对一课";
    }
    if($code==2){
        return "普通大班课";
    }
    if($code==3){
        return "小班课普通版";
    }
    if($code==4){
        return "小班课专业版";
    }
}
/**
 * 回放视频状态
 * @param int
 * @return array
 */
function getVideoStatus ($code)
{
    if($code==10){
        return "生成中...";
    }
    if($code==20){
        return "转码中..";
    }
    if($code==30){
        return "<font color='red'>转码失败</font>";
    }
    if($code==100){
        return "<font color='green'>转码成功</font>";
    }
}
/**
 * 提现状态
 */
function get_tixian_status($code){
    if($code==0){
        return "<font color='#009688'>待处理</font>";
    }
    if($code==1){
        return "<font color='green'>已完结</font>";
    }
}
/**
 * 时间戳转时间
 */
function stampTodata($stamp){
    return date("Y-m-d H:i:s",$stamp);
}

/**
 *上传视频在没生成缩略图前默认显示的图像
 */
function defaultVideoPic($pic){
    if(empty($pic)){
        return "/static/img/no_image_100x100.jpg";
    }else{
        return $pic;
    }
}
/**
 *会员没设置头像时默认的显示
 */
function defaultAvatar($avatar){
    if(empty($avatar)){
        return "/static/img/nan.jpg";
    }else{
        return $avatar;
    }
}

/**
 *根据会员ID获取会员头像
 */
function getAvatar($uid){
    return model('user')->where('id',$uid)->value('avatar');
}
/**
 *根据帖子ID获取板块名称
 */
function getPlateName($id){
    return model('forumPlate')->where('id',$id)->value('name');
}

/**
 * 递归无限级分类【先序遍历算】，获取任意节点下所有子孩子
 */
function getMenuTree($arrCat, $parent_id = 0, $level = 0)
{
    static  $arrTree = array(); //使用static代替global
    if( empty($arrCat)) return FALSE;
    $level++;
    foreach($arrCat as $key => $value)
    {
        if($value['pid' ] == $parent_id)
        {
            $value[ 'level'] = $level;
            $arrTree[] = $value['id'];
            unset($arrCat[$key]); //注销当前节点数据，减少已无用的遍历
            getMenuTree($arrCat, $value[ 'id'], $level);
        }
    }
    return $arrTree;
}
/**
 * 根据课程是否已经学习返回不同的图标
 * @param $cid,$sid，$type
 * @return array
 */
function isStudyBySid($cid,$sid,$type){
    $myCourse=model('userCourse')->where(['cid'=>$cid,'type'=>$type,'uid'=>is_user_login()])->value('studied');
    if(in_array($sid,json_to_array($myCourse))){
        return '<i class="layui-icon layui-icon-ok-circle mr10 c-studied"></i>';
    }else{
        return '<i class="layui-icon layui-icon-radio mr10"></i>';
    }
}
function isStudyBySidApp($cid,$sid,$type,$uid){
    $myCourse=model('userCourse')->where(['cid'=>$cid,'type'=>$type,'uid'=>$uid])->value('studied');
    if(in_array($sid,json_to_array($myCourse))){
        return true;
    }else{
        return false;
    }
}
/**
 * 根据课时的不同类型返回不同的图标
 * @param $cid,$sid，$type
 * @return array
 */
function getSecIcon($type){
    if($type==1){
        return '<i class="layui-icon layui-icon-video mr10"></i>';
    }
    if($type==2){
        return '<i class="layui-icon layui-icon-headset mr10"></i>';
    }
    if($type==3){
        return '<i class="layui-icon layui-icon-picture-fine mr10"></i>';
    }
    if($type==4){
        return '<i class="layui-icon layui-icon-survey mr10"></i>';
    }

}
/**
 * 获取直播状态
 * @param $starttime,$duration
 * @return array
 */
function getLiveStatus($starttime,$duration){
    $now=time();
    $start=strtotime($starttime);
    $end=strtotime('+'.$duration.' minutes',$start);
    if($start>$now){
        return $starttime;
    }
    if($start<$now and $now<$end){
        return '<font color="#FF5722">正在直播中...</font>';
    }
    if($now>$end){
        return '直播已结束，查看回放';
    }
}
/**
 * 直播是否结束
 * @param $starttime,$duration
 * @return array
 */
function isLiveOver($starttime,$duration){
    $now=time();
    $start=strtotime($starttime);
    $end=strtotime('+'.$duration.' minutes',$start);
    if($start<$now and $now<$end){
        return false;
    }
    if($now>$end){
        return true;
    }
}
/**
 *功能：对字符串进行加密处理
 *参数一：需要加密的内容
 *参数二：密钥
 */
function passport_encrypt($str,$key){ //加密函数
    srand((double)microtime() * 1000000);
    $encrypt_key=md5(rand(0, 32000));
    $ctr=0;
    $tmp='';
    for($i=0;$i<strlen($str);$i++){
        $ctr=$ctr==strlen($encrypt_key)?0:$ctr;
        $tmp.=$encrypt_key[$ctr].($str[$i] ^ $encrypt_key[$ctr++]);
    }
    return base64_encode(passport_key($tmp,$key));
}

/**
 *功能：对字符串进行解密处理
 *参数一：需要解密的密文
 *参数二：密钥
 */
function passport_decrypt($str,$key){ //解密函数
    $str=passport_key(base64_decode($str),$key);
    $tmp='';
    for($i=0;$i<strlen($str);$i++){
        $md5=$str[$i];
        $tmp.=$str[++$i] ^ $md5;
    }
    return $tmp;
}

/**
 *辅助函数
 */
function passport_key($str,$encrypt_key){
    $encrypt_key=md5($encrypt_key);
    $ctr=0;
    $tmp='';
    for($i=0;$i<strlen($str);$i++){
        $ctr=$ctr==strlen($encrypt_key)?0:$ctr;
        $tmp.=$str[$i] ^ $encrypt_key[$ctr++];
    }
    return $tmp;
}
/**
 *功能：判断是否开启ssl
 */
function is_https() {
    if ( !empty($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) !== 'off') {
        return 'https://';
    } elseif ( isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https' ) {
        return 'https://';
    } elseif ( !empty($_SERVER['HTTP_FRONT_END_HTTPS']) && strtolower($_SERVER['HTTP_FRONT_END_HTTPS']) !== 'off') {
        return 'https://';
    }
    return 'http://';
}
/**
 *功能：返回优惠券的使用状态
 */
function getCouponSatatus($code){
    if($code==0){
        return "正常";
    }
    if($code==1){
        return "<font color='red'>被禁用</font>";
    }
}
function getCouponUseSatatus($code){
    if($code==0){
        return "未使用";
    }
    if($code==1){
        return "已经使用";
    }
}
/**
 *功能：返回课程促销状态
 */
function getFlashsaleStatus($start,$end){
    $now=time();
    $start=strtotime($start);
    $end=strtotime($end);
    if($start>$now){
        return '活动未开始';
    }
    if($start<$now and $now<$end){
        return '<font color="#FF5722">活动进行中</font>';
    }
    if($now>$end){
        return '活动已结束';
    }
}
/**
 *功能：课程促销信息
 */
function flashsale($cid='',$type='',$yuanprice,$usetype=1){
    $data=model('marketing')->where(['type'=>'flashsale'])->select();
    $id=$type.'-'.$cid;
    $now=time();
    foreach ($data as $key => $value) {
        $details=json_decode($data[$key]['details'],true);
        $start=strtotime($details['starttime']);
        $end=strtotime($details['endtime']);
        $cuxiaoPrice=round($yuanprice*$details['rate']/10,1);
        foreach ($details['course'] as $key => $value) {
            if($id==$details['course'][$key]['value'] && ($start<$now and $now<$end)){
                $is=true;
            }
        }
    }
    if($usetype==1 && $is){
        return '促销：<i class=" layui-icon layui-icon-rmb mr10 cuxiao"></i><span class="price mr10"><i>'.$cuxiaoPrice.'</i> </span><span id="remain" class="cuxiao"></span><input id="nowTime" type="hidden" value="'.$now.'"><input id="endTime" type="hidden" value="'.$details["endtime"].'">';
    }
    if($usetype==2 && $is){
        return '<i class=" layui-icon layui-icon-rmb mr10 cuxiao"></i><span class="price mr10"><i>'.$cuxiaoPrice.'</i> </span>';
    }
    if($usetype==2 && !$is){
        return '<i class=" layui-icon layui-icon-rmb mr10 cuxiao"></i><span class="price mr10"><i>'.$yuanprice.'</i> </span>';
    }
    if($usetype==3 && $is){
        return $cuxiaoPrice;
    }
}
/**
 *功能：获取班级班主任姓名
 */
function getHeadteacherName(){
    return '班主任';
}
/**
 *功能：获取班级课程数
 */
function getClassroomCourseNum($id){
    $data=model('classroom')->where(['id'=>$id])->find();
    return json_count($data['cids']);
}
/**
 * 获取班级学员学习总进度
 */
function getAllProgress($classRoomId, $uid)
{
    $classroominfo = model('classroom')->where(['id' => $classRoomId])->find();
    $cids = json_to_array($classroominfo['cids']);
    foreach ($cids as $k => $v) {
        $ids = explode('-', $cids[$k], 2);
        $ids[0] == 1 ? $videoIds[] = $ids[1] : $liveIds[] = $ids[1];
        $ids[0] == 1 ? $videoStudied[$ids[1]] = getStuduedNum($ids[1], 1, $uid) : $liveStudied[$ids[1]] = getStuduedNum($ids[1], 2, $uid);
        $ids[0] == 1 ? $videoCourseNum[$ids[1]] = getCourseNum($ids[1], 1) : $liveCourseNum[$ids[1]] = getCourseNum($ids[1], 2);
        $ids[0] == 1 ? $videoProgress[$ids[1]] = round(100 * getStuduedNum($ids[1], 1, $uid) / getCourseNum($ids[1], 1)) : $liveProgress[$ids[1]] = round(100 * getStuduedNum($ids[1], 2, $uid) / getCourseNum($ids[1], 2));
    }
    $AllProgress = round(100 * (array_sum($videoStudied) + array_sum($liveStudied)) / (array_sum($videoCourseNum) + array_sum($liveCourseNum)), 2);
    return $AllProgress;
}
