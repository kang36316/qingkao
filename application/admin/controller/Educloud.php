<?php
namespace app\admin\controller;
use app\common\controller\AdminBase;
vendor ('aliyuncs.oss-sdk-php.autoload');
use OSS\OssClient;
use OSS\Core\OssException;
/**
 * Class Account 阿里云控制器类
 * www.yxtcmf.com
 */

class Educloud extends AdminBase{
    /**
     * 账户信息页面
     */
    public function liveIndex(){
        $info=$this->get_site_info();
        $liveurl=$info['server']."/educloud/educloud/getLiveCountInfo";
        $liverestemp=post_curl($liveurl,$info);
        $liveresult=json_decode($liverestemp,true);
        if($liveresult['code']==0){
            $liveresult['data']['remain']=floor((strtotime($liveresult['data']['expire_time'])-strtotime(date('Y-m-d h:i:s', time())))/86400);
            $this->assign("liveoinfo",$liveresult['data']);
            $DayPeakUserurl=$info['server']."/educloud/educloud/getDayPeakUser";
            $DayPeakUser=json_decode(post_curl($DayPeakUserurl,$info),true);
            $TodyPeakUser=$DayPeakUser['data']['peak_user'][date('Y-m-d', time())];
            $time=array();
            $num=array();
            foreach($DayPeakUser['data']['peak_user'] as $key=>$v)
            {
                $time[]=$key;$num[]=$v;
            }
            $str_num= json_encode($num);
            $str_time = json_encode($time);
            $this->assign("liveinfo",$liveresult);
            $this->assign('str_num', $str_num);
            $this->assign('str_time', $str_time);
            $this->assign('TodyPeakUser', $TodyPeakUser);
        }else{
            $this->assign("liveinfo",$liveresult);
        }
        return $this->fetch('index');
    }
    public function testconnect(){
	$config = config('aliyun_oss');
	$bucket = $config['bucket'];
//	var_dump($config);
     $ossClient = new OssClient($config['accessKeyId'], $config['accessKeySecret'], $config['endpoint']);
     $nextMarker = '';

		while (true) {
		    try {
		        $options = array(
		            'delimiter' => '/',
		            // 'prefix' => 'dir/',
		            'marker' => $nextMarker,
		        );
		        $listObjectInfo = $ossClient->listObjects($bucket, $options);
		    } catch (OssException $e) {
		        printf(__FUNCTION__ . ": FAILED\n");
		        printf($e->getMessage() . "\n");
		        return;
		    }
		    // 得到nextMarker，从上一次listObjects读到的最后一个文件的下一个文件开始继续获取文件列表。
		    $nextMarker = $listObjectInfo->getNextMarker();
		    $listObject = $listObjectInfo->getObjectList();
		    $listPrefix = $listObjectInfo->getPrefixList();
			// var_dump($listObject);
		//	var_dump($listPrefix);
			//die;
		    if (!empty($listObject)) {
		        print("objectList:\n");
		        foreach ($listObject as $objectInfo) {
		            print($objectInfo->getKey() . "\n");
		        }
		    }
		    if (!empty($listPrefix)) {
		        print("prefixList: \n");
		        foreach ($listPrefix as $prefixInfo) {
		            print($prefixInfo->getPrefix() . "\n");
		        }
		    }
		    if ($listObjectInfo->getIsTruncated() !== "true") {
		       break;
		    }
		}
     return $this->fetch('testconnect');
    }
    
    // 测试oss视频文件上传
	public function uploadVideo()
		{
		     //上传视频到阿里云OSS
		     $file = $_FILES['file'];
		     $name = $file['name'];
		     $format = strrchr($name, '.');
		     $fileName = uniqid() . $format;
		     //获取配置
		     $config = config('aliyun_oss');
		     $OssClient = new OssClient($config['accessKeyId'], $config['accessKeySecret'], $config['endpoint']);
		     $uploadToAliyunOss = $OssClient->uploadFile($config['bucket'], $fileName, $file['tmp_name']);
		
		     if ($uploadToAliyunOss) {
		     	 // 上传成功返回路径
		     	 var_dump($uploadToAliyunOss['info']['url']);
		         return json(['videoUrl'=> $config['cdn'].strrchr($uploadToAliyunOss['info']['url'], '/')]);
		     } else {
		     	// 上传失败，打印错误信息
		     	halt($uploadToAliyunOss);
		     }
		      return $this->fetch('testconnect');
		}
    /**
     * 绑定阿里云直播账户
     */
    public function liveBind(){
        if ($this->request->isPost()) {
            $data = [];
            foreach ($this->request->param() as $k => $v) {
                $data[] = ['name' => $k, 'value' => $v];
            }
            if ($this->saveAll('system', $data) === true) {
                clear_cache();
                insert_admin_log('绑定阿里云直播账户');
                $this->success('保存成功',url('admin/educloud/liveBind'));
            } else {
                $this->error($this->errorMsg);
            }
        }
        $data = [];
        foreach (model('system')->select() as $v) {
            $data[$v['name']] = $v['value'];
        }
        return $this->fetch('liveBind', ['data' => $data]);
    }

    /**
     * 绑定阿里云点播账户
     */
    public function videoBind()
    {
        if ($this->request->isPost()) {
            $data = [];
            foreach ($this->request->param() as $k => $v) {
                $data[] = ['name' => $k, 'value' => $v];
            }
            if ($this->saveAll('system', $data) === true) {
                clear_cache();
                insert_admin_log('绑定阿里云点播账户');
                $this->success('保存成功',url('admin/educloud/videoList'));
            } else {
                $this->error($this->errorMsg);
            }
        }
        $data = [];
        foreach (model('system')->select() as $v) {
            $data[$v['name']] = $v['value'];
        }
        return $this->fetch('videoBind', ['data' => $data]);
    }
    
    /**
     * 阿里云点播视频列表
     */
    public function videoList()
    {
        $info=$this->get_site_info();
        $param = $this->request->param();
        $category_id=model('admin')->where(['id'=>is_admin_login()])->value('category_id');
        if(empty($category_id)){
            $categoryId=$this->addCategory('admin');
            if(!empty($categoryId)){
                db('admin')->where(['id'=>is_admin_login()])->update(['category_id' => $categoryId]);
            }
        }
        if(!empty($param['CateId'])){
            $category_id=$param['CateId'];
        }
        $url = $info['server'] . "/educloud/alivideo/getvideolist";
        $postdata = ['private_domain'=>$info['private_domain'],'domain'=>$info['domain'],'authorcode'=>$info['authorcode'],'KeyID' => config('KeyID'), 'keySecret' => config('KeySecret'), 'PageSize' => config('PageSize'),'PageNo'=>$param['page'],'aliyuncategory'=>$category_id];
        $restemp = json_to_array(post_curl($url, $postdata));
        $videocategory=$this->getVideoCategory(1,100);
        return $this->fetch('videoList', ['list' => $restemp['VideoList']['Video'],'curr'=>$param['page'],'count'=>$restemp['Total'],'PageSize'=>config('PageSize'),'videocategory'=>$videocategory['SubCategories']['Category']]);
    }

    /**
     * 删除阿里云视频
     */
    public function videodel()
    {
        $info=$this->get_site_info();
        $url=$info['server']."/educloud/alivideo/delvideo";
        $flg=1;
        if ($this->request->isPost()) {
            $data = $this->request->param();
        }
        foreach($data['id'] as $key=>$value){
            $postdata=['private_domain'=>$info['private_domain'],'domain'=>$info['domain'],'authorcode'=>$info['authorcode'],'KeyID'=>config('KeyID'),'keySecret'=>config('KeySecret'),'id'=>$value];
            $res=json_to_array(post_curl($url,$postdata));
            if(empty($res['Code'])){
                $flg=1;
            }else{
                $flg=0;
            }
        }
        if($flg==1){
            $this->success('删除成功',url('admin/educloud/videoList'));
        }else{
            $this->error($res['Code'],url('admin/educloud/videoList'));
        }
    }

    /**
     * 上传阿里云视频
     */
    public function videoup()
    {
        $videocategory=$this->getVideoCategory(1,100);
        return $this->fetch('quan',['videocategory'=>$videocategory['SubCategories']['Category'],'aliUid'=>config('AliUserId')]);
    }
    /**
     * 阿里云视频分类列表
     */
    public function videocategory(){
        $param = $this->request->param();
        if(empty($param['page'])){
            $param['page']=1;
        }
        $PageSize=5;
        $videocategory=$this->getVideoCategory($param['page'],$PageSize);
        return $this->fetch('videocategory',['list'=>$videocategory['SubCategories']['Category'],'SubTotal'=>$videocategory['SubTotal'],'curr'=>$param['page'],'PageSize'=>$PageSize]);
    }
    public function getvideoCategory($curr,$PageSize){
        $url = config('author_web') . "/educloud/alivideo/getCategory";
        $category_id = model('admin')->where(['id' => is_admin_login()])->value('category_id');
        $postdata = ['KeyID' => config('KeyID'), 'keySecret' => config('KeySecret'),'CateId'=>$category_id,'PageNo'=>$curr,'PageSize'=>$PageSize];
        $restemp = json_to_array(post_curl($url, $postdata));
        return $restemp;
    }
    /**
     * 删除阿里云视频分类
     */
    public function delvideocategory(){
        $param=$this->request->param();
        $url = config('author_web') . "/educloud/alivideo/delCategory";
        $postdata = ['KeyID' => config('KeyID'), 'keySecret' => config('KeySecret'),'CateId'=>$param['id']];
        json_to_array(post_curl($url, $postdata));
        $this->success('删除成功');
    }
    /**
     * 添加阿里云视频分类
     */
    public function addvideocategory(){
      if ($this->request->isPost()) {
          $param = $this->request->param();
          $category_id = model('admin')->where(['id' => is_admin_login()])->value('category_id');
          $res = $this->addCategoryPhpSDK($param['name'], $category_id);
          if ($res['code']==0) {
              $this->success('创建成功');
          }else{
              $this->error($res['msg']);
          }
      }
        return $this->fetch('addvideocategory');
    }
    /**
     * 远程添加阿里云视频子分类
     */
    public function addCategory($name,$ParentId=''){
        $url = config('author_web') . "/educloud/alivideo/AddCategory";
        $postdata = ['KeyID' => config('KeyID'), 'keySecret' => config('KeySecret'),'CateName'=>$name,'ParentId'=>$ParentId];
        $restemp = json_to_array(post_curl($url, $postdata));
        return $restemp['Category']['CateId'];
    }
    /**
     * 远程添加阿里云视频子分类
     */
    public function addCategoryPhpSDK($name,$ParentId){
        $info=$this->get_site_info();
        $url = config('author_web') . "/educloud/alivideo/AddCategoryPhpSDK";
        $postdata = ['domain'=>$info['domain'],'authorcode'=>$info['authorcode'],'KeyID' => config('KeyID'), 'keySecret' => config('KeySecret'),'CateName'=>$name,'ParentId'=>$ParentId];
        $restemp = json_to_array(post_curl($url, $postdata));
        return $restemp;
    }
    /**
     * 阿里云Oss上传类
     */
    function new_oss(){
        $oss=new OssClient(config('KeyID'),config('KeySecret'),config('EndPoint'));
        return $oss;
    }

    /**
     * 阿里云Oss上传实例
     */
    public function ossupload()
    {
        try {
            $file = request()->file('file');
            $info = $file->move(ROOT_PATH . 'public' . DS . 'upload' . DS . 'file');
            if ($info) {
                $ossClient =$this->new_oss();
                $filepath =  '../public/upload/file/'.str_replace('\\', '/', $info->getSaveName());
                $ossClient->uploadFile(config('Bucket'), 'files'.is_admin_login().'/'.$info->getFilename(),$filepath);
                $url=config('Bucket').'.'.config('EndPoint').'/'.'files'.is_admin_login().'/'.$info->getFilename();
                if($this->insert('Material', ['uid'=>is_admin_login(),'original_name'=>$file->getInfo('name'),'oss_name'=>'files'.is_admin_login().'/'.$info->getFilename(),'oss_url'=>$url,'addtime'=>date('Y-m-d H:i:s', time())])===true){
                    insert_admin_log('上传了资料到阿里云OSS');
                    unlink($filepath);
                    return ['code' => 1, 'url' => $url];
                }else{
                    return ['code' => 0, 'msg' => $this->errorMsg];
                }
            } else {
                return ['code' => 0, 'msg' => $file->getError()];
            }
        } catch (\Exception $e) {
            return ['code' => 0, 'msg' => $e->getMessage()];
        }
    }
    /**
     * 删除OSS上的文件
     */
    public function ossdel()
    {
        if ($this->request->isPost()) {
            $data=model('Material')->where(['id'=>input('id')])->field('oss_name')->find();
            $ossClient =$this->new_oss();
            $ossClient->deleteObject(config('Bucket'), $data['oss_name']);
            if ($this->delete('Material', $this->request->param()) === true) {
                insert_admin_log('删除资料');
                $this->success('删除成功');
            } else {
                $this->error($this->errorMsg);
            }
        }
    }
    /**
     * 获取上传阿里云视频凭证
     */
    public function getaliuptoken()
    {
        $info=$this->get_site_info();
        $param = $this->request->param();
        if(empty($param['categoryId'])){
            $category_id=model('admin')->where(['id'=>is_admin_login()])->value('category_id');
        }else{
            $category_id=$param['categoryId'];
        }
        $url=config('author_web')."/educloud/alivideo/getaliuptoken";
        $postdata = ['private_domain'=>$info['private_domain'],'domain'=>$info['domain'],'authorcode'=>$info['authorcode'],'KeyID' => config('KeyID'), 'keySecret' => config('KeySecret'), 'filename' =>input('post.title'),'CateId'=>$category_id];
        echo post_curl($url, $postdata);
    }

    /**
     * 获取直播间列表
     */
    function getliveroomlist(){
        $info=$this->get_site_info();
        $param = $this->request->param();
        $info['limit']=config('PageSize');
        $info['page']=$param['page'];
        $url=$info['server']."/educloud/educloud/getLiveroomList";
        $LiveroomList=json_decode(post_curl($url,$info),true);
        return $this->fetch('getliveroomlist', ['list' => $LiveroomList['data']['list'],'code'=>$LiveroomList['code'],'curr'=>$param['page'],'count'=>$LiveroomList['data']['total'],'PageSize'=>config('PageSize')]);
    }
    /**
     * 删除直播间
     */
    function delLiveroom(){
        $info=$this->get_site_info();
        $postdata=$info;
        $postdata['room_id']=input('id');
        $url=$info['server']."/educloud/educloud/delLiveroom";
        $res=json_decode(post_curl($url,$postdata),true);
        if($res['code']==0){
            $this->success("房间删除成功！");
        }else{
            $this->error($res['msg']);
        }
    }
    /**
     * 获取回放列表
     */
    function  getplaybacklist(){
        $info=$this->get_site_info();
        $param = $this->request->param();
        $info['limit']=config('PageSize');
        $info['page']=$param['page'];
        $url=$info['server']."/educloud/educloud/getPlaybackList";
        $PlaybackList=json_decode(post_curl($url,$info),true);
        return $this->fetch('playbackList', ['list' => $PlaybackList['data']['list'],'code'=>$PlaybackList['code'],'curr'=>$param['page'],'count'=>$PlaybackList['data']['total'],'PageSize'=>config('PageSize')]);
    }
    /**
     * 删除回放
     */
    function delPlayback(){
        $info=$this->get_site_info();
        $postdata=$info;
        $postdata['room_id']=input('id');
        $url=$info['server']."/educloud/educloud/delPlayback";
        $res=json_decode(post_curl($url,$postdata),true);
        if($res['code']==0){
            $this->success("回放删除成功！");
        }else{
            $this->error($res['msg']);
        }
    }
    /**
     * 阿里云短信
     */
    function cloudSMS(){

    }
    /**
     * 阿里云短信签名
     */
    function signName(){
        if ($this->request->isPost()) {
            $param=$this->request->param();
            model('system')->save(['value' =>$param['SmsSign']], ['name' => 'SmsSign']);
            clear_cache();
            insert_admin_log('配置云短信签名');
            $this->success('保存成功');
        }
        $data = model('system')->where('name', 'SmsSign')->find();
        return $this->fetch('signName', ['data' => $data]);
    }
    /**
     * 阿里云短信模板
     */
    function templates(){

        if ($this->request->isPost()) {
            $param=$this->request->param();
            $data=model('system')->where('name', $param['type'])->find();
            $val=unserialize($data['value']);
            if(empty($param['TemplatesId'])){
                $param['TemplatesId']=$val['TemplatesId'];
            }
            if($param['status']===null){
                $param['status']=$val['status'];
            }
            model('system')->save(['value' => serialize($param)], ['name' => $param['type']]);
            clear_cache();
            $this->success('设置成功');
        }
        $MC= model('system')->where('name', 'SmsTemplates_MC')->find();
        $SK= model('system')->where('name', 'SmsTemplates_SK')->find();
        return $this->fetch('templates', ['MC' => unserialize($MC['value']),'SK'=>unserialize($SK['value'])]);
    }

}
