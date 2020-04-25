<?php
namespace app\admin\controller;
use app\common\controller\AdminBase;
use think\Controller;
use think\Request;
use think\Db;
use think\Log;
use vod\Request\V20170321\CreateUploadVideoRequest;
use vod\Request\V20170321\RefreshUploadVideoRequest;
use vod\Request\V20170321\GetPlayInfoRequest;
use vod\Request\V20170321\GetVideoPlayAuthRequest;

include EXTEND_PATH."aliyun-php-sdk/aliyun-php-sdk-core/Config.php";

class Quan extends Controller{
    private $accessKeyId = 'LTAIcnQuDKBFNsNU';   //阿里云 accessKeyId
    private $accessKeySecret = 'dRWGflyAfXJob4wtrc8fgIO5879GwV'; //阿里云 accessKeySecret
    private  $regionId = 'cn-shanghai';   //表示中国区域 不用修改
    private  $TemplateGroupId = 'VOD_NO_TRANSCODE';  //阿里云控制台视频点播>全局设置->转码设置  转码组id



    public function initVodClient() {
        include EXTEND_PATH."aliyun-php-sdk/aliyun-php-sdk-core/Profile/DefaultProfile.php";
        include EXTEND_PATH."aliyun-php-sdk/aliyun-php-sdk-core/DefaultAcsClient.php";

        $profile = \DefaultProfile::getProfile($this->regionId,$this->accessKeyId,$this->accessKeySecret);
        return new \DefaultAcsClient($profile);
    }
    public function createUploadVideo() {

        try {
            include EXTEND_PATH."aliyun-php-sdk/aliyun-php-sdk-vod/vod/Request/V20170321/CreateUploadVideoRequest.php";

            $client = $this->initVodClient();


            $request = new CreateUploadVideoRequest();
            $request->setTitle("Sample Title");
            $request->setFileName($_POST['name']);
            $request->setDescription("Video Description");
            $request->setCoverURL("http://img.alicdn.com/tps/TB1qnJ1PVXXXXXCXXXXXXXXXXXX-700-700.png");
            $request->setTags("tag1,tag2");
            $request->setTemplateGroupId($this->TemplateGroupId);
            $request->setAcceptFormat('JSON');

            $aa = $client->getAcsResponse($request);
            $auth['UploadAddress'] = $aa->UploadAddress;
            $auth['RequestId'] = $aa->RequestId;
            $auth['VideoId'] = $aa->VideoId;
            $auth['UploadAuth'] = $aa->UploadAuth;
            echo json_encode($auth);die;
            //$this->ajaxReturn(array('status'=>'0','data'=>$auth));

        } catch (Exception $e) {
            print $e->getMessage()."\n";
        }

    }

    //刷新视频上传凭证
    public function refreshUploadVideo() {
        try {
            $client = $this->initVodClient();
            $request = new RefreshUploadVideoRequest();
            $request->setVideoId('47324be263014946b4846704444cc0fc');
            $request->setAcceptFormat('JSON');
            dump($client->getAcsResponse($request));

        } catch (Exception $e) {
            print $e->getMessage()."\n";
        }

    }


    //获取播放地址
    public function getPlayInfo($videoId) {
        try {
            $client = $this->initVodClient();
            $request = new GetPlayInfoRequest();

            $request->setVideoId($videoId);
            $request->setAuthTimeout(3600*24);
            $request->setAcceptFormat('JSON');
            $playInfo = $client->getAcsResponse($request);


            //dump($playInfo->PlayInfoList->PlayInfo);
            return $playInfo;
        } catch (Exception $e) {
            print $e->getMessage()."\n";
        }

    }

    //获取播放凭证
    public function getPlayAuth() {
        try{
            $client = $this->initVodClient();
            $request = new GetVideoPlayAuthRequest();
            $request->setVideoId('47324be263014946b4846704444cc0fc');
            $request->setAuthInfoTimeout(3600);
            $request->setAcceptFormat('JSON');
            $playInfo = $client->getAcsResponse($request);



            // print($playInfo->PlayAuth."\n");
            // print_r($playInfo->VideoMeta);
            return $playInfo->VideoMeta;
        } catch (Exception $e) {
            print $e->getMessage()."\n";
        }



    }


    //上传图片视频成功回调
    public function notify(){

        $str = file_get_contents('php://input');

        Log::record($str);
        $arr=json_decode($str, true);
        //var_dump(json_decode($str, true));
        if($arr){
            $info = $this->getPlayInfo($arr['VideoId']);
            Log::record($info);
            $playurl = $info->PlayInfoList->PlayInfo[1]->PlayURL;

            $datainfo = [
                'videoid'=>$arr['VideoId'],
                'url' =>$arr['FileUrl'],
                'addtime' => date('Y-m-d H:i:s',time())
            ];
            Db::name('aliyun_video')->insert($datainfo);

        }

    }


    //上传成功之后前端轮训获取视频url
    public function getVideoUrl(){
        $param = Request::instance()->param();
        if($param['videoid']){
            $where['video_id'] = $param['videoid'];

            $url = Db::name('aliyun_video')->where($where)->value('url');
            if(!empty($url)){
                $this->ajaxReturn(array('status'=>'0','data'=>$url));
            }else{
                $this->ajaxReturn(array('status'=>'1','data'=>'未查到相关数据'));
            }
        }else{
            $this->ajaxReturn(array('status'=>'1','data'=>'未查到相关数据'));
        }

    }


    public function getvideo(){
        $regionId = 'cn-shanghai';
        $profile = \DefaultProfile::getProfile($regionId, "LTAIcnQuDKBFNsNU", "dRWGflyAfXJob4wtrc8fgIO5879GwV");
        $client = new \DefaultAcsClient($profile);
        $request = new vod\CreateUploadVideoRequest();
        //视频源文件标题(必选)
        $request->setTitle($_POST['title']);
        //视频源文件名称，必须包含扩展名(必选)
        $request->setFileName($_POST['name']);
        //视频源文件字节数(可选)
        $request->setFileSize(0);
        //视频源文件描述(可选)
        $request->setDescription("视频描述");
        //自定义视频封面URL地址(可选)
        $request->setCoverURL("");
        //上传所在区域IP地址(可选)
        $request->setIP("127.0.0.1");
        //视频标签，多个用逗号分隔(可选)
        $request->setTags("");
        //视频分类ID(可选)
        $request->setCateId(0);
        $response = $client->getAcsResponse($request);
        $data['UploadAuth']=$response->UploadAuth;
        $data['UploadAddress']=$response->UploadAddress;
        $data['VideoId']=$response->VideoId;
        $data['RequestId']=$response->RequestId;
        $this->ajaxReturn($data);
    }


    public function hui(){
        $body = file_get_contents('php://input');
        $data=json_decode($body,true);
        $VideoId=$data['VideoId'];//视频id
        $status1=$data['StreamInfos'][0]['Status'];
        $status2=$data['StreamInfos'][1]['Status'];
        if($data['StreamInfos'][0]['Format']=="mp4"){
            $mp4=$data['StreamInfos'][0]['FileUrl'];//mp4格式播放地址
            $m3u8=$data['StreamInfos'][1]['FileUrl'];//m3u8格式播放地址
        }else{
            $mp4=$data['StreamInfos'][1]['FileUrl'];
            $m3u8=$data['StreamInfos'][0]['FileUrl'];
        }
        if(($status1=="success") && ($status2=="success")){
            $this->writelog(date("m-d-H-i-s"),"转码完成，视频id：".$VideoId."\r\n\r\n mp4格式播放地址：".$mp4."\r\n\r\n m3u8格式播放地址：".$m3u8);
        }else{
            $this->writelog(date("m-d-H-i-s"),"转码失败\r\n\r\n ErrorCode：".$data['StreamInfos'][0]['ErrorCode']." - ".$data['StreamInfos'][1]['ErrorCode']."\r\n\r\n ErrorMessage：".$data['StreamInfos'][0]['ErrorMessage']." - ".$data['StreamInfos'][1]['ErrorMessage']);
        }
    }

    public function writelog($filename,$content){
        $date = date('Y-m-d');
        $file = "./Public/paylog/".$date;
        if(!is_dir($file)){
            mkdir($file);
        }
        $file = $file."/".$filename.".txt";
        $content = "【收到信息".date("Y-m-d H:i:s",time())."】".$content."\r\n\r\n";
        $open=fopen($file,"a" );
        fwrite($open,$content);
        fclose($open);
    }

}