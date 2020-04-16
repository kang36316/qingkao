<?php


namespace app\api\controller;
require __DIR__ . '/vendor/autoload.php';
use vendor\AlibabaCloud\Client\AlibabaCloud;
use vendor\AlibabaCloud\Client\Exception\ClientException;
use vendor\AlibabaCloud\Client\Exception\ServerException;
use vendor\AlibabaCloud\Vod\Vod;

class Aliyuncloud
{
    function initVodClient($accessKeyId, $accessKeySecret) {
        $regionId = 'cn-shanghai';
        AlibabaCloud::accessKeyClient($accessKeyId, $accessKeySecret)
            ->regionId($regionId)
            ->connectTimeout(1)
            ->timeout(3)
            ->name(VOD_CLIENT_NAME);
    }

    /**
     * 获取视频上传地址和凭证
     * @param client 发送请求客户端
     * @return CreateUploadVideoResponse 获取视频上传地址和凭证响应数据
     */
    function createUploadVideo($client) {
        $request = new vod\CreateUploadVideoRequest();
        $request->setTitle("Sample Title");
        $request->setFileName("videoFile.mov");
        $request->setDescription("Video Description");
        $request->setCoverURL("http://img.alicdn.com/tps/TB1qnJ1PVXXXXXCXXXXXXXXXXXX-700-700.png");
        $request->setTags("tag1,tag2");
        $request->setAcceptFormat('JSON');
        return $client->getAcsResponse($request);
    }

    /**
     * 刷新视频上传凭证
     * @param client 发送请求客户端
     * @return RefreshUploadVideoResponse 刷新视频上传凭证响应数据
     */
    function refreshUploadVideo($client, $videoId) {
        $request = new vod\RefreshUploadVideoRequest();
        $request->setVideoId($videoId);
        $request->setAcceptFormat('JSON');
        return $client->getAcsResponse($request);
    }

    /**
     * 获取图片上传地址和凭证
     * @param client 发送请求客户端
     * @return CreateUploadImageResponse 获取图片上传地址和凭证响应数据
     */
    function createUploadImage($client, $imageType, $imageExt) {
        $request = new vod\CreateUploadImageRequest();
        $request->setImageType($imageType);
        $request->setImageExt($imageExt);
        $request->setAcceptFormat('JSON');
        return $client->getAcsResponse($request);
    }

    /**
     * 获取辅助媒资(水印、字幕等)上传地址和凭证
     * @param client 发送请求客户端
     * @return CreateUploadAttachedMediaResponse 获取辅助媒资上传地址和凭证响应数据
     */
    function createUploadAttachedMedia($client) {
        $request = new vod\CreateUploadAttachedMediaRequest();
        $request->setBusinessType("watermark");
        $request->setMediaExt("gif");
        $request->setTitle("this is a sample");
        return $client->getAcsResponse($request);
    }

    /**
     * URL批量拉取上传
     * @param client 发送请求客户端
     * @return UploadMediaByURLResponse URL批量拉取上传响应数据
     */
    function uploadMediaByURL($client) {
        $request = new vod\UploadMediaByURLRequest();
        $url = "http://test.xxx.com/xxxx.mp4";
        $request->setUploadURLs($url);
        $uploadMetadataList = array();
        $uploadMetadata = array();
        $uploadMetadata["SourceUrl"] = $url;
        $uploadMetadata["Title"] = "upload by url sample";
        $uploadMetadataList[] = $uploadMetadata;
        $request->setUploadMetadatas(json_encode($uploadMetadataList));
        return $client->getAcsResponse($request);
    }

    /**
     * 注册媒资信息
     * @param client 发送请求客户端
     * @return RegisterMediaResponse 注册媒资信息响应数据
     */
    function registerMedia($client) {
        $request = new vod\RegisterMediaRequest();
        $metaDataArray= array();
        $metaData= array();
        $metaData["Title"] = "registerMedia by url sample";
        $metaData["FileURL"] = "https://xxxxxx.oss-cn-shanghai.aliyuncs.com/vod_sample.mp4";
        $metaDataArray[] = $metaData;
        $request->setRegisterMetadatas(json_encode($metaDataArray));
        return $client->getAcsResponse($request);
    }

    /**
     * 获取URL上传信息
     * @param client 发送请求客户端
     * @return GetURLUploadInfosResponse 获取URL上传信息响应数据
     */
    function getURLUploadInfos($client) {
        $request = new vod\GetURLUploadInfosRequest();
        // URL列表
        $urls = array();
        $urls[] = "http://xxx.cn-shanghai.aliyuncs.com/sample1.mp4";
        $urls[] = "http://xxx.cn-shanghai.aliyuncs.com/sample2.mp4";
        // 对URL进行编码
        $uploadURLs = array();
        foreach ($urls as $url) {
            $uploadURLs[] = urlencode($url);
        }
        // 设置上传的URL列表，用逗号分隔
        $request->setUploadURLs(implode(",", $uploadURLs));
        // 也可以传入jobId查询
        //$request->setJobIds("jobId1xxxxxx,jobId2xxxxxx")
        return $client->getAcsResponse($request);
    }

    /**
     * 获取播放地址
     * @param $client
     * @param $videoId
     * @return mixed
     */
    function getPlayInfo($client, $videoId) {
        $request = new vod\GetPlayInfoRequest();
        $request->setVideoId($videoId);
        $request->setAuthTimeout(3600*24);
        $request->setAcceptFormat('JSON');
        return $client->getAcsResponse($request);
    }

    /**
     * 获取播放凭证
     * @param $client
     * @param $videoId
     * @return mixed
     */
    function getPlayAuth($client, $videoId) {
        $request = new vod\GetVideoPlayAuthRequest();
        $request->setVideoId($videoId);
        $request->setAuthInfoTimeout(3000);
        $request->setAcceptFormat('JSON');
        $response = $client->getAcsResponse($request);
        return $response;
    }

    /**
    * 搜索媒资信息
    * @param client 发送请求客户端
    * @return SearchMediaResponse 搜索媒资信息响应数据
    */
    function searchMedia($client) {
        $request = new vod\SearchMediaRequest();
        $request->setFields("Title,CoverURL,Status");
        $request->setMatch("Status in ('Normal','Checking') and CreationTime = ('2018-07-01T08:00:00Z','2018-08-01T08:00:00Z')");
        $request->setPageNo(1);
        $request->setPageSize(10);
        $request->setSearchType("video");
        $request->setSortBy("CreationTime:Desc");
        return $client->getAcsResponse($request);
    }

    /**
     * 获取视频信息
     * @param client 发送请求客户端
     * @return GetVideoInfoResponse 获取视频信息响应数据
     */
    function getVideoInfo($client, $videoId) {
        $request = new vod\GetVideoInfoRequest();
        $request->setVideoId($videoId);
        $request->setAcceptFormat('JSON');
        return $client->getAcsResponse($request);
    }

    /**
     * 批量获取视频信息函数
     * @param client 发送请求客户端
     * @return GetVideoInfosResponse 获取视频信息响应数据
     */
    function getVideoInfos($client) {
        $request = new vod\GetVideoInfosRequest();
        $request->setVideoIds("e67e761ec04342cd9ca5149c74xxxxxx,b19439abb9a94374b7f4d45f69xxxxxx");
        return $client->getAcsResponse($request);
    }

    /**
     * 修改视频信息
     * @param client 发送请求客户端
     * @return UpdateVideoInfoResponse 修改视频信息响应数据
     */
    function updateVideoInfo($client, $videoId) {
        $request = new vod\UpdateVideoInfoRequest();
        $request->setVideoId($videoId);
        $request->setTitle('New Title');   // 更改视频标题
        $request->setDescription('New Description');    // 更改视频描述
        $request->setCoverURL('http://img.alicdn.com/tps/TB1qnJ1PVXXXXXCXXXXXXXXXXXX-700-700.png');  // 更改视频封面
        $request->setTags('tag1,tag2');    // 更改视频标签，多个用逗号分隔
        $request->setCateId(0);       // 更改视频分类(可在点播控制台·全局设置·分类管理里查看分类ID：https://vod.console.aliyun.com/#/vod/settings/category)
        $request->setAcceptFormat('JSON');
        return $client->getAcsResponse($request);
    }

    /**
     * 批量修改视频信息
     * @param client 发送请求客户端
     * @return UpdateVideoInfosResponse 批量修改视频信息响应数据
     */
    function updateVideoInfos($client) {
        $request = new vod\UpdateVideoInfosRequest();
        $updateContentArray = array();
        $updateContent1 = array();
        $updateContent1["VideoId"] = "e67e761ec04342cd9ca5149c74xxxxxx";
        $updateContent1["Title"] = "new Title1";
        $updateContentArray[] = $updateContent1;
        $updateContent2 = array();
        $updateContent2["VideoId"] = "b19439abb9a94374b7f4d45f69xxxxxx";
        $updateContent2["Title"] = "new Title2";
        $updateContentArray[] = $updateContent2;
        $request->setUpdateContent(json_encode($updateContentArray));
        return $client->getAcsResponse($request);
    }

    /**
     * 删除视频
     * @param client 发送请求客户端
     * @return DeleteVideoResponse 删除视频响应数据
     */
    function deleteVideos($client, $videoIds) {
        $request = new vod\DeleteVideoRequest();
        $request->setVideoIds($videoIds);   // 支持批量删除视频；videoIds为传入的视频ID列表，多个用逗号分隔
        $request->setAcceptFormat('JSON');
        return $client->getAcsResponse($request);
    }

    /**
     * 获取源文件信息
     * @param client 发送请求客户端
     * @return GetMezzanineInfoResponse 获取源文件信息响应数据
     */
    function getMezzanineInfo($client, $videoId) {
        $request = new vod\GetMezzanineInfoRequest();
        $request->setVideoId($videoId);
        $request->setAuthTimeout(3600*5);   // 原片下载地址过期时间，单位：秒，默认为3600秒
        $request->setAcceptFormat('JSON');
        return $client->getAcsResponse($request);
    }

    /**
     * 获取视频列表
     * @param client 发送请求客户端
     * @return GetVideoListResponse 获取视频列表响应数据
     */
    function getVideoList($client) {
        $request = new vod\GetVideoListRequest();
        // 示例：分别取一个月前、当前时间的UTC时间作为筛选视频列表的起止时间
        $localTimeZone = date_default_timezone_get();
        date_default_timezone_set('UTC');
        $utcNow = gmdate('Y-m-d\TH:i:s\Z');
        $utcMonthAgo = gmdate('Y-m-d\TH:i:s\Z', time() - 30*86400);
        date_default_timezone_set($localTimeZone);
        $request->setStartTime($utcMonthAgo);   // 视频创建的起始时间，为UTC格式
        $request->setEndTime($utcNow);          // 视频创建的结束时间，为UTC格式
        #$request->setStatus('Uploading,Normal,Transcoding');  // 视频状态，默认获取所有状态的视频，多个用逗号分隔
        #$request->setCateId(0);               // 按分类进行筛选
        $request->setPageNo(1);
        $request->setPageSize(20);
        $request->setAcceptFormat('JSON');
        return $client->getAcsResponse($request);
    }

    /**
     * 删除媒体流函数
     * @param client 发送请求客户端
     * @return DeleteMezzaninesResponse 删除媒体流响应数据
     */
    function deleteStream($client, $videoId, $jobIds) {
        $request = new vod\DeleteStreamRequest();
        $request->setVideoId($videoId);
        $request->setJobIds($jobIds);   // 媒体流转码的作业ID列表，多个用逗号分隔；JobId可通过获取播放地址接口(GetPlayInfo)获取到。
        $request->setAcceptFormat('JSON');
        return $client->getAcsResponse($request);
    }

    /**
     * 批量删除源文件函数
     * @param client 发送请求客户端
     * @return DeleteMezzaninesResponse 批量删除源文件响应数据
     */
    function deleteMezzanines($client) {
        $request = new vod\DeleteMezzaninesRequest();
        $request->setVideoIds("b19439abb9a94374b7f4d45f6xxxxxx");
        $request->setForce(false);
        return $client->getAcsResponse($request);
    }

    /**
     * 批量更新图片信息函数
     * @param client 发送请求客户端
     * @return UpdateImageInfosResponse 批量更新图片信息响应数据
     */
    function updateImageInfos($client) {
        $request = new vod\UpdateImageInfosRequest();
        $updateContentArray = array();
        $updateContent1 = array();
        $updateContent1["ImageId"] = "7e66f99e1cb34199822753981xxxxxx";
        $updateContent1["Title"] = "new Title1";
        $updateContentArray[] = $updateContent1;
        $updateContent2 = array();
        $updateContent2["ImageId"] = "d2171a5656454c49a4f11a544cxxxxx";
        $updateContent2["Title"] = "new Title2";
        $updateContentArray[] = $updateContent2;
        $request->setUpdateContent(json_encode($updateContentArray));
        return $client->getAcsResponse($request);
    }

    /**
     * 获取图片信息函数
     * @param client 发送请求客户端
     * @return GetImageInfoResponse 获取图片信息响应数据
     */
    function getImageInfo($client) {
        $request = new vod\GetImageInfoRequest();
        $request->setImageId("7e66f99e1cb341998227539812b4f502");
        return $client->getAcsResponse($request);
    }

    /**
     * 删除图片函数
     * @param client 发送请求客户端
     * @return DeleteImageResponse 删除图片响应数据
     */
    function deleteImage($client) {
        $request = new vod\DeleteImageRequest();
        //根据ImageURL删除图片文件
        $request->setDeleteImageType("ImageURL");
        $request->setImageURLs("http://sample.aliyun.com/cover.jpg");
        //根据ImageId删除图片文件
        //$request->setDeleteImageType("ImageId");
        //$request->setImageIds("ImageId1,ImageId2");
        //根据VideoId删除指定ImageType的图片文件
        //$request->setDeleteImageType("VideoId");
        //$request->setVideoId("VideoId");
        return $client->getAcsResponse($request);
    }

    /**
     * 创建视频分类
     * @param $client
     * @param $cateName
     * @param int $parentId
     * @return mixed
     */
    function addCategory($client, $cateName, $parentId=-1) {
        $request = new vod\AddCategoryRequest();
        $request->setCateName($cateName);
        $request->setParentId($parentId);
        $request->setAcceptFormat('JSON');
        return $client->getAcsResponse($request);
    }

    /**
     * 修改视频分类
     * @param $client
     * @param $cateId
     * @param $cateName
     * @return mixed
     */
    function updateCategory($client, $cateId, $cateName) {
        $request = new vod\UpdateCategoryRequest();
        $request->setCateId($cateId);
        $request->setCateName($cateName);   // 分类名称
        $request->setAcceptFormat('JSON');
        return $client->getAcsResponse($request);
    }

    /**
     * 删除视频分类，同时会删除其下级分类（包括二级分类和三级分类），请慎重操作
     * @param $client
     * @param $cateId
     * @return mixed
     */
    function deleteCategory($client, $cateId) {
        $request = new vod\DeleteCategoryRequest();
        $request->setCateId($cateId);
        $request->setAcceptFormat('JSON');
        return $client->getAcsResponse($request);
    }

    /**
     * 获取指定的分类信息，及其子分类（即下一级分类）的列表
     * @param $client
     * @param int $cateId
     * @param int $pageNo
     * @param int $pageSize
     * @return mixed
     */
    function getCategories($client, $cateId=-1, $pageNo=1, $pageSize=10) {
        $request = new vod\GetCategoriesRequest();
        $request->setCateId($cateId);   // 分类ID，默认为根节点分类ID即-1
        $request->setPageNo($pageNo);
        $request->setPageSize($pageSize);
        $request->setAcceptFormat('JSON');
        return $client->getAcsResponse($request);
    }

    /**
     * 构建图片水印的配置数据，根据具体设置需求修改对应的参数值
     * @return
     */
    function buildImageWatermarkConfig() {
        $watermarkConfig = array();
        //水印的横向偏移距离
        $watermarkConfig["Dx"] = "8";
        //水印的纵向偏移距离
        $watermarkConfig["Dy"] = "8";
        //水印显示的宽
        $watermarkConfig["Width"] = "55";
        //水印显示的高
        $watermarkConfig["Height"] = "55";
        //水印显示的相对位置(左上、右上、左下、右下)
        $watermarkConfig["ReferPos"] = "BottomRight";
        //水印显示的时间线(开始显示和结束显示时间)
        $timeline = array();
        //水印开始显示时间
        $timeline["Start"] = "2";
        //水印结束显示时间
        $timeline["Duration"] = "ToEND";
        $watermarkConfig["Timeline"] = $timeline;
        return json_encode($watermarkConfig);
    }
    /**
     * 构建文字水印的配置数据，根据具体设置需求修改对应的参数值
     * @return
     */
    function buildTextWatermarkConfig() {
        $watermarkConfig = array();
        //文字水印显示的内容
        $watermarkConfig["Content"] = "testwatermark";
        //文字水印的字体名称
        $watermarkConfig["FontName"] = "SimSun";
        //文字水印的字体大小
        $watermarkConfig["FontSize"] = "25";
        //文字水印的颜色(也可为RGB颜色取值，例如:#000000)
        $watermarkConfig["FontColor"] = "Black";
        //文字水印的透明度
        $watermarkConfig["FontAlpha"] = "0.2";
        //文字水印的字体描边颜色(也可为RGB颜色取值，例如:#ffffff)
        $watermarkConfig["BorderColor"] = "White";
        //文字水印的描边宽度
        $watermarkConfig["BorderWidth"] = "1";
        //文字水印距离视频画面上边的偏移距离
        $watermarkConfig["Top"] = "20";
        //文字水印距离视频画面左边的偏移距离
        $watermarkConfig["Left"] = "15";
        return json_encode($watermarkConfig);
    }
    /**
     * 添加水印配置信息函数
     */
    function addWatermark($client) {
        $request = new vod\AddWatermarkRequest();
        //水印名称
        $request->setName("addwatermark");
        //水印文件在oss的URL
        //图片水印必传图片文件的oss文件地址，水印文件必须和视频在同一个区域，例如:华东2视频，水印文件必须存放在华东2
        $request->setFileUrl("http://test-bucket.oss-cn-shanghai.aliyuncs.com/watermark/test.png");
        //水印配置数据
        //图片水印的位置配置数据
        $request->setWatermarkConfig(buildImageWatermarkConfig());
        //文字水印的位置配置数据
        //$request->setWatermarkConfig(buildTextWatermarkConfig());
        //文字水印:Text; 图片水印:Image
        $request->setType("Image");
        return $client->getAcsResponse($request);
    }

    /**
     * 删除水印配置信息函数
     */
    function deleteWatermark($client) {
        $request = new vod\DeleteWatermarkRequest();
        //设置水印ID
        $request->setWatermarkId("e7d983370268092176588a2c4xxxxxx");
        return $client->getAcsResponse($request);
    }

    /**
     * 查询水印配置信息列表函数
     */
    function listWatermark($client) {
        $request = new vod\ListWatermarkRequest();
        return $client->getAcsResponse($request);
    }

    /**
     * 查询单个水印配置信息函数
     */
    function getWatermark($client) {
        $request = new vod\GetWatermarkRequest();
        //需要查询水印信息的水印ID
        $request->setWatermarkId("bfc084674fb64486b6e5bace30xxxxxx");
        return $client->getAcsResponse($request);
    }

    /**
     * 设置默认水印配置信息函数
     */
    function setDefaultWatermark($client) {
        $request = new vod\SetDefaultWatermarkRequest();
        //设置默认的水印ID
        $request->setWatermarkId("bfc084674fb64486b6e5bace30xxxxxx");
        return $client->getAcsResponse($request);
    }

    /**
     * 构建转码模板配置数据
     * @return
     */
    function buildTranscodeTemplateList() {
        $transcodeTemplateList = array();
        $transcodeTemplate = array();
        //视频流转码配置
        $video = array();
        $video["Width"] = 960;
        $video["Bitrate"] = 900;
        $video["Fps"] = 25;
        $video["Remove"] = false;
        $video["Codec"] = "H.264";
        $video["Gop"] = 250;
        $transcodeTemplate["Video"] = $video;
        //音频流转码配置
        $audio = array();
        $audio["Codec"] = "AAC";
        $audio["Bitrate"] = 96;
        $audio["Channels"] = 2;
        $audio["Samplerate"] = 32000;
        $transcodeTemplate["Audio"] = $audio;
        //封装容器
        $container = array();
        $container["Format"] = "mp4";
        $transcodeTemplate["Container"] = $container;
        //条件转码配置
        $transconfig = array();
        $transconfig["IsCheckReso"] = false;
        $transconfig["IsCheckResoFail"] = false;
        $transconfig["IsCheckVideoBitrate"] = false;
        $transconfig["IsCheckVideoBitrateFail"] = false;
        $transconfig["IsCheckAudioBitrate"] = false;
        $transconfig["IsCheckAudioBitrateFail"] = false;
        $transcodeTemplate["TransConfig"] = $transconfig;
        //加密配置(只支持m3u8)
        //$encryptSetting= array();
        //$encryptSetting["EncryptType"] = "Private";
        //$transcodeTemplate["EncryptSetting"] = $encryptSetting;
        //清晰度
        $transcodeTemplate["Definition"] = "SD";
        //模板名称
        $transcodeTemplate["TemplateName"] = "testtemplate";
        //模板ID
        $transcodeTemplate["TranscodeTemplateId"] = "214a67fab9fdf920f486faa77xxxxxx";
        //水印ID(多水印关联)
        $watermarkIdList= array();
        $watermarkIdList[] = "263261bdc1ff65782f8995c6ddxxxxxx";
        //USER_DEFAULT_WATERMARK 代表默认水印ID
        $watermarkIdList[] = "USER_DEFAULT_WATERMARK";
        $transcodeTemplate["WatermarkIds"] = $watermarkIdList;
        $transcodeTemplateList[] = $transcodeTemplate;
        return json_encode($transcodeTemplateList);
    }
    /**
     * 修改转码模板组配置
     */
    function updateTranscodeTemplateGroup($client) {
        $request = new vod\UpdateTranscodeTemplateGroupRequest();
        // 转码模板组名称
        $request->setName("grouptest1");
        // 转码模板组ID
        $request->setTranscodeTemplateGroupId("014a67fab9fdf920f486faa77xxxxxx");
        // 转码模板组信息
        $request->setTranscodeTemplateList(buildTranscodeTemplateList());
        return $client->getAcsResponse($request);
    }

    /**
     * 查询转码模板组列表
     */
    function listTranscodeTemplateGroup($client) {
        $request = new vod\ListTranscodeTemplateGroupRequest();
        return $client->getAcsResponse($request);
    }

    /**
     * 查询单个转码模板组
     */
    function getTranscodeTemplateGroup($client) {
        $request = new vod\GetTranscodeTemplateGroupRequest();
        // 转码模板组ID
        $request->setTranscodeTemplateGroupId("014a67fab9fdf920f486faa77xxxxxx");
        return $client->getAcsResponse($request);
    }

    /**
     * 设置默认转码模板组
     */
    function setDefaultTranscodeTemplateGroup($client) {
        $request = new vod\SetDefaultTranscodeTemplateGroupRequest();
        // 转码模板组ID
        $request->setTranscodeTemplateGroupId("014a67fab9fdf920f486faa77xxxxxx");
        return $client->getAcsResponse($request);
    }

    /**
     * 删除转码模板组配置
     */
    function deleteTranscodeTemplateGroup($client) {
        $request = new vod\DeleteTranscodeTemplateGroupRequest();
        // 转码模板组ID
        $request->setTranscodeTemplateGroupId("014a67fab9fdf920f486faa773xxxxxx");
        return $client->getAcsResponse($request);
    }

    /**
     * 提交智能审核作业
     */
    function submitAIMediaAuditJob($client) {
        $request = new vod\SubmitAIMediaAuditJobRequest();
        // 设置视频ID
        $request->setMediaId("dc063078c1d845139e2a5bd8fxxxxxx");
        // 返回结果
        return $client->getAcsResponse($request);
    }

    /**
     * 查询智能审核作业
     */
    function getAIMediaAuditJob($client) {
        $request = new vod\GetAIMediaAuditJobRequest();
        // 设置作业ID
        $request->setJobId("f980db7d82e644478206a4a521xxxxxx");
        // 返回结果
        return $client->getAcsResponse($request);
    }

    /**
     * 获取智能审核结果摘要
     */
    function getMediaAuditResult($client) {
        $request = new vod\GetMediaAuditResultRequest();
        // 设置视频ID
        $request->setMediaId("dc063078c1d845139e2a5bd8ffxxxxxx");
        // 返回结果
        return $client->getAcsResponse($request);
    }

    /**
     * 获取智能审核结果详情
     */
    function getMediaAuditResultDetail($client) {
        $request = new vod\GetMediaAuditResultDetailRequest();
        // 设置视频ID
        $request->setMediaId("dc063078c1d845139e2a5bd8ffxxxxxx");
        // 设置翻页
        $request->setPageNo(1);
        // 返回结果
        return $client->getAcsResponse($request);
    }

    /**
     * 获取智能审核结果时间线
     */
    function getMediaAuditResultTimeline($client) {
        $request = new vod\GetMediaAuditResultTimelineRequest();
        // 设置视频ID
        $request->setMediaId("dc063078c1d845139e2a5bd8ffxxxxxx");
        // 返回结果
        return $client->getAcsResponse($request);
    }

    /**
     * 构建审核内容
     */
    function buildAuditContent() {
        $auditContent = array();
        $auditContent1 = array();
        $auditContent1["VideoId"] = "070bbc13d8294e35b36c3e7ab4xxxxxx"; // 视频ID
        $auditContent1["Status"] = "Blocked"; // 审核状态
        $auditContent1["Reason"] = "Reason"; // 若审核状态为屏蔽时，需给出屏蔽的理由，最长支持128字节
        $auditContent[] = $auditContent1;
        return json_encode($auditContent);
    }
    /**
     * 人工审核
     */
    function createAudit($client) {
        $request = new vod\CreateAuditRequest();
        // 设置审核内容
        $request->setAuditContent(buildAuditContent());
        return $client->getAcsResponse($request);
    }

    /**
     * 获取人工审核历史
     */
    function getAuditHistory($client) {
        $request = new vod\GetAuditHistoryRequest();
        // 视频ID
        $request->setVideoId("070bbc13d8294e35b36c3e7ab4xxxxxx");
        // 页号
        $request->setPageNo("1");
        // 每页数量
        $request->setPageSize("10");
        return $client->getAcsResponse($request);
    }

    /**
     * 直播转点播（测试）
     */
    function listLiveRecordVideo($client) {
        $request = new vod\ListLiveRecordVideoRequest();
        $request->setStartTime("2018-04-24T03:21:04Z");
        $request->setEndTime("2018-05-21T03:21:44Z");
        $request->setStreamName("testStreamName");
        $request->setDomainName("testdomain.aliyun.com");
        $request->setAppName("testAppName");
        return $client->getAcsResponse($request);
    }
}