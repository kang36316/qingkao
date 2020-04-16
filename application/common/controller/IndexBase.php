<?php
namespace app\common\controller;
use wechat\Jssdk;
class IndexBase extends Base
{
    protected $noLogin = []; // 不用权限认证和登录的方法
    protected function _initialize()
    {
        parent::_initialize();
        !config('website_status') && die(config('colse_explain'));
        $config = cache('db_config_data');
        if (!$config) {
            $config = [];
            foreach (model('config')->select() as $v) {
                $config[$v['group']][$v['name']] = $v['value'];
            }
            cache('db_config_data', $config);
        }
        config($config);
        $nav=cache('nav');
        if(!$nav){
            $nav=model('nav')->order('sort_order asc')->where('pid',0)->select();
            foreach ($nav as $key => $value) {
                $nav[$key]['url']=(strstr($nav[$key]['url'],'http') || strstr($nav[$key]['url'],'javascript'))?$nav[$key]['url']:url($nav[$key]['url']);
                //$nav[$key]['childNav']= model('nav')->order('sort_order asc')->where('pid',$nav[$key]['id'])->select();
                $childNav=model('nav')->order('sort_order asc')->where('pid',$nav[$key]['id'])->select();
                foreach($childNav as $i => $value){
                    $childNav[$i]['url']=(strstr($childNav[$i]['url'],'http') || strstr($childNav[$i]['url'],'javascript'))?$childNav[$i]['url']:url($childNav[$i]['url']);
                }
                $nav[$key]['childNav']=$childNav;
            }
            cache('nav', $nav);
        }
        $this->assign('empty', '<tr><td colspan="20">~~暂无数据</td></tr>');
        $this->assign('islogin',is_user_login());
        $this->assign('addtime',date('Y-m-d h:i:s', time()));
        $this->assign('nav',$nav);
    }
    /**
     * 检查是否登录
     */
    public function checkLogin()
    {
        if (!is_user_login() && !in_array($this->request->action(), $this->noLogin)) {
            return false;
        }
        return true;
    }
    /**
     * 上传图片
     */
    public function uploadImage()
    {
        try {
            $file = $this->request->file('file');
            $info = $file->move(ROOT_PATH . 'public' . DS . 'upload' . DS . 'image');
            if ($info) {
                $upload_image = unserialize(config('upload_image'));
                if ($upload_image['is_thumb'] == 1 || $upload_image['is_water'] == 1 || $upload_image['is_text'] == 1) {
                    $object_image = \think\Image::open($info->getPathName());
                    // 图片压缩
                    if ($upload_image['is_thumb'] == 1) {
                        $object_image->thumb($upload_image['max_width'], $upload_image['max_height']);
                    }
                    // 图片水印
                    if ($upload_image['is_water'] == 1) {
                        $object_image->water(ROOT_PATH . str_replace('/', '\\', trim($upload_image['water_source'], '/')), $upload_image['water_locate'], $upload_image['water_alpha']);
                    }
                    // 文本水印
                    if ($upload_image['is_text'] == 1) {
                        $font = !empty($upload_image['text_font']) ? str_replace('/', '\\', trim($upload_image['text_font'], '/')) : 'vendor\topthink\think-captcha\assets\zhttfs\1.ttf';
                        $object_image->text($upload_image['text'], ROOT_PATH . $font, $upload_image['text_size'], $upload_image['text_color'], $upload_image['text_locate'], $upload_image['text_offset'], $upload_image['text_angle']);
                    }
                    $object_image->save($info->getPathName());
                }
                return ['code' => 1, 'url' => '/upload/image/' . str_replace('\\', '/', $info->getSaveName())];
            } else {
                return ['code' => 0, 'msg' => $file->getError()];
            }
        } catch (\Exception $e) {
            return ['code' => 0, 'msg' => $e->getMessage()];
        }
    }
    /**
     * 支付宝配置
     */
    public function alipayConfig(){
        $config = [
            'app_id' => config('alipay_app_id'),
            'rsa_private_key' =>config('alipay_rsa_private_key'),
            'alipay_public_key' => config('alipay_public_key')
        ];
        return $config;
    }
    /**
     * 支付宝H5配置
     */
    public function alipayH5Config(){
        $config = [
            'app_id' => config('h5_alipay_app_id'),
            'rsa_private_key' =>config('h5_alipay_rsa_private_key'),
            'alipay_public_key' => config('h5_alipay_rsa_private_key')
        ];
        return $config;
    }
    /**
     * 微信配置
     */
    public function wechatConfig(){
        $config = [
            'appid' => config('weixin_appid'),
            'mch_id' =>config('weixin_mch_id'),
            'key' =>config('weixin_key'),
            'sslcert_path' => '',
            'sslkey_path' => ''
        ];
        return $config;
     }
    /**
     * 微信H5配置
     */
    public function wechatH5Config(){
        $config = [
            'appid' => config('h5_weixin_appid'),
            'mch_id' =>config('h5_weixin_mch_id'),
            'key' =>config('h5_weixin_key'),
            'AppSecret' =>config('h5_weixin_AppSecret'),
            'jsapi_appid'=>config('h5_weixin_appid'),
            'jsapi_secret'=>config('h5_weixin_AppSecret'),
            'sslcert_path' => '',
            'sslkey_path' => ''
        ];
        return $config;
    }
    /**
     * 微信APP配置
     */
    public function wechatAPPConfig(){
        $config = [
            'appid' => config('app_weixin_appid'),
            'mch_id' =>config('app_weixin_mch_id'),
            'key' =>config('app_weixin_key'),
            'appsecret' =>config('app_weixin_AppSecret'),
            'sslcert_path' => '',
            'sslkey_path' => ''
        ];
        return $config;
    }
    /**
     * 微信登录配置
     */
    function getWeixinLoginConfig(){
        $data = model('system')->where('name', 'Weixin_Login')->find();
        return unserialize($data['value']);
    }
    /**
     * QQ登录配置
     */
    function getQqLoginConfig(){
        $data = model('system')->where('name', 'QQ_Login')->find();
        return unserialize($data['value']);
    }
    /**
     * 根据课程ID，课程类型获取课程信息
     */
     public function getCouseInfo($cid,$type){
         switch ($type)
         {
             case 1:
                 $courseinfo = model('videoCourse')->where(['id'=>$cid])->find();
                 break;
             case 2:
                 $courseinfo = model('liveCourse')->where(['id'=>$cid])->find();
                 break;
         }
         return $courseinfo;
     }
    function get_site_info(){
        $info['domain']=get_domain();
        $info['authorcode']=config('author_code');
        $info['partner_id']=config('partner_id');
        $info['partner_key']=config('partner_key');
        $info['private_domain']=config('private_domain');
        $info['server']=config('author_web');
        return $info;
    }
    /**
     * 获取课程优惠券信息
     */
    function coupon($name,$uId){
        $coupon=model('marketing')->where(['name'=>$name,'type'=>'coupon'])->find();
        $details=json_decode($coupon['details'],true);
        $count=model('userCourse')->where(['uid'=>is_user_login()])->count();
        if(($details['status']==1 && $name=='reg')|| ($details['status']==1 && $name=='buy' && $count<=1)){
            $where=['rate'=>$details['rate'],'status'=>0,'buystatus'=>0,'usestatus'=>0,'userId'=>0];
            $couponList=  model('coupon')->where($where)->limit($details['numbs'])->select();
            foreach ($couponList as $key => $value) {
                $data=['id'=>$couponList[$key]['id'],'buystatus'=>1,'userId'=>$uId];
                model('coupon')->update($data);
            }
        }

    }
    public function share(){
        $appid='wxb037094bf331b465';
        $appsercet='63fa1da0f6b2632b623c3abc708f016e';
        $jssdkOBJ=new Jssdk($appid,$appsercet);
        $res=$jssdkOBJ->getSignPackage();
        return (['appId'=>$res['appId'],'timestamp'=>$res['timestamp'],'nonceStr'=>$res['nonceStr'],'signature'=>$res["signature"]]);
    }
}