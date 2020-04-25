-- phpMyAdmin SQL Dump
-- version 4.0.10.20
-- https://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2020-02-09 17:05:39
-- 服务器版本: 5.5.58-log
-- PHP 版本: 5.6.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `demo_newlogo_cn`
--

-- --------------------------------------------------------

--
-- 表的结构 `edu_ad`
--

CREATE TABLE IF NOT EXISTS `edu_ad` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `category` varchar(32) NOT NULL DEFAULT '0' COMMENT '分类',
  `name` varchar(255) NOT NULL DEFAULT '' COMMENT '分类名称',
  `description` varchar(255) DEFAULT '' COMMENT '描述',
  `url` varchar(255) DEFAULT '' COMMENT '链接',
  `target` varchar(10) DEFAULT '' COMMENT '打开方式',
  `image` varchar(255) DEFAULT '' COMMENT '图片',
  `background` varchar(20) NOT NULL,
  `sort_order` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='广告' AUTO_INCREMENT=7 ;

--
-- 转存表中的数据 `edu_ad`
--

INSERT INTO `edu_ad` (`id`, `category`, `name`, `description`, `url`, `target`, `image`, `background`, `sort_order`, `status`) VALUES
(1, 'index', '首页', '', '', '_self', '/upload/image/20191007/7eb4abdeb66cc211d72bec755af87192.PNG', '#3DC768', 0, 1),
(3, 'article', '文章首页', '', 'https://demo.newlogo.cn/', '_blank', '/upload/image/20190319/381814a015a99735b2ac91e014cb3042.png', '', 0, 1),
(4, 'article', 'wenz', '', 'https://demo.newlogo.cn', '_blank', '/upload/image/20190319/cfb1f22e6eacf24eb15d736f7ac5c758.png', '', 0, 1),
(6, 'article', '英语', '', 'https://demo.newlogo.cn', '_self', '/upload/image/20190815/22a2d9ae606c634636c1eacdf3b1f3fb.jpg', '', 0, 1);

-- --------------------------------------------------------

--
-- 表的结构 `edu_admin`
--

CREATE TABLE IF NOT EXISTS `edu_admin` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `cooperateid` int(5) NOT NULL,
  `uid` int(5) NOT NULL,
  `mobile` varchar(20) NOT NULL DEFAULT '0',
  `sex` varchar(5) NOT NULL,
  `category_id` varchar(20) NOT NULL,
  `username` varchar(32) NOT NULL DEFAULT '' COMMENT '管理员用户名',
  `password` varchar(32) NOT NULL DEFAULT '' COMMENT '管理员密码',
  `email` varchar(20) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0禁用/1启动',
  `last_login_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '上次登录时间',
  `last_login_ip` varchar(16) NOT NULL DEFAULT '' COMMENT '上次登录IP',
  `login_count` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '登录次数',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='管理员' AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `edu_admin`
--

-- --------------------------------------------------------

--
-- 表的结构 `edu_admin_log`
--

CREATE TABLE IF NOT EXISTS `edu_admin_log` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `admin_id` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '管理员id',
  `username` varchar(32) NOT NULL DEFAULT '' COMMENT '管理员用户名',
  `useragent` varchar(255) NOT NULL DEFAULT '' COMMENT 'User-Agent',
  `ip` varchar(16) NOT NULL DEFAULT '' COMMENT 'ip地址',
  `url` varchar(255) NOT NULL DEFAULT '' COMMENT '请求链接',
  `method` varchar(32) NOT NULL DEFAULT '' COMMENT '请求类型',
  `type` varchar(32) NOT NULL DEFAULT '' COMMENT '资源类型',
  `param` text NOT NULL COMMENT '请求参数',
  `remark` varchar(255) NOT NULL DEFAULT '' COMMENT '日志备注',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='管理员日志' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `edu_article`
--

CREATE TABLE IF NOT EXISTS `edu_article` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `cid` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '分类ID',
  `uid` int(5) NOT NULL,
  `title` varchar(255) NOT NULL DEFAULT '' COMMENT '标题',
  `image` varchar(255) DEFAULT '' COMMENT '图片',
  `author` varchar(255) DEFAULT '' COMMENT '作者',
  `summary` text COMMENT '简介',
  `photo` text COMMENT '相册',
  `content` longtext COMMENT '内容',
  `view` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '点击量',
  `is_top` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否置顶',
  `is_hot` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否推荐',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态',
  `sort_order` int(11) NOT NULL DEFAULT '100' COMMENT '排序',
  `keywords` varchar(255) DEFAULT '' COMMENT '关键字',
  `description` varchar(255) DEFAULT '' COMMENT '描述',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='文章' AUTO_INCREMENT=1 ;


-- --------------------------------------------------------

--
-- 表的结构 `edu_auth_group`
--

CREATE TABLE IF NOT EXISTS `edu_auth_group` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL DEFAULT '',
  `description` varchar(255) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `rules` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='权限组' AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `edu_auth_group`
--

INSERT INTO `edu_auth_group` (`id`, `name`, `description`, `status`, `rules`) VALUES
(1, '超级管理员', '超级管理员拥有超级权限', 1, '4,12,14,19,20,21,13,45,55,56,59,60,6,44,43,1,8,34,35,36,7,2,9,28,29,30,10,54,3,11,25,26,27,46,58,78,5,16,17,15,18'),
(2, '教师组', '教师组', 1, '6,127,128,129,139,44,56,59,66,67,68,69,103,104,105,106,107,108,109,110,111,112,113,114,115,153,154,60,74,75,76,77,155,156,157,158,159,160,161,162,136,137,138,151,152,163,176,177,181,182,185,183,184,82,83,142,143,144,86,87,88,85,89,148,149,84,91,93,145,146,147,1,8,34,35,36,58,79,81,116,117,118,119,120,121,122,131,132,133,134,135');

-- --------------------------------------------------------

--
-- 表的结构 `edu_auth_group_access`
--

CREATE TABLE IF NOT EXISTS `edu_auth_group_access` (
  `uid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `group_id` smallint(5) unsigned NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='权限授权';

--
-- 转存表中的数据 `edu_auth_group_access`
--

INSERT INTO `edu_auth_group_access` (`uid`, `group_id`) VALUES
(1, 1),
(2, 2),
(3, 2),
(4, 2),
(5, 2),
(6, 2);

-- --------------------------------------------------------

--
-- 表的结构 `edu_auth_rule`
--

CREATE TABLE IF NOT EXISTS `edu_auth_rule` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(11) unsigned NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL DEFAULT '',
  `url` varchar(255) NOT NULL DEFAULT '',
  `icon` varchar(64) NOT NULL DEFAULT '',
  `sort_order` int(11) NOT NULL DEFAULT '0' COMMENT '排序',
  `type` char(4) NOT NULL DEFAULT '' COMMENT 'nav,auth',
  `index` tinyint(1) NOT NULL DEFAULT '0' COMMENT '快捷导航',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='权限规则' AUTO_INCREMENT=210 ;

--
-- 转存表中的数据 `edu_auth_rule`
--

INSERT INTO `edu_auth_rule` (`id`, `pid`, `name`, `url`, `icon`, `sort_order`, `type`, `index`, `status`) VALUES
(1, 0, '文章', '', 'fa fa-book', 5, 'nav', 0, 1),
(2, 0, '学员', '', 'fa fa-users', 3, 'nav', 0, 1),
(3, 0, '扩展', '', 'fa fa-puzzle-piece', 9, 'nav', 0, 1),
(4, 0, '设置', '', 'fa fa-gear', 0, 'nav', 0, 1),
(5, 0, '权限', '', 'fa fa-lock', 8, 'nav', 0, 1),
(6, 0, '控制台', 'admin/index/index', '', 1, 'auth', 0, 1),
(7, 1, '分类管理', 'admin/category/index', 'fa fa-navicon', 2, 'nav', 1, 1),
(8, 1, '文章管理', 'admin/article/index', 'fa fa-book', 1, 'nav', 1, 1),
(9, 2, '学员管理', 'admin/user/index', 'fa fa-users', 0, 'nav', 1, 1),
(10, 2, '学员日志', 'admin/user/log', 'fa fa-clock-o', 0, 'nav', 0, 1),
(11, 3, '广告管理', 'admin/ad/index', 'fa fa-image', 1, 'nav', 1, 1),
(12, 4, '基本设置', 'admin/config/setting', 'fa fa-cog', 1, 'nav', 1, 1),
(13, 4, '系统设置', 'admin/config/system', 'fa fa-wrench', 3, 'nav', 0, 1),
(14, 4, '设置管理', 'admin/config/index', 'fa fa-bars', 2, 'nav', 0, 1),
(15, 5, '权限规则', 'admin/auth/rule', 'fa fa-th-list', 3, 'nav', 0, 1),
(16, 5, '管理员', 'admin/admin/index', 'fa fa-user', 0, 'nav', 0, 1),
(17, 5, '权限组', 'admin/auth/group', 'fa fa-users', 1, 'nav', 0, 1),
(18, 5, '管理员日志', 'admin/admin/log', 'fa fa-clock-o', 5, 'nav', 0, 1),
(19, 14, '添加', 'admin/config/add', '', 0, 'auth', 0, 1),
(20, 14, '编辑', 'admin/config/edit', '', 0, 'auth', 0, 1),
(21, 14, '删除', 'admin/config/del', '', 0, 'auth', 0, 1),
(22, 15, '添加', 'admin/auth/addRule', '', 0, 'auth', 0, 1),
(23, 15, '编辑', 'admin/auth/editRule', '', 0, 'auth', 0, 1),
(24, 15, '删除', 'admin/auth/delRule', '', 0, 'auth', 0, 1),
(25, 11, '添加', 'admin/ad/add', '', 0, 'auth', 0, 1),
(26, 11, '编辑', 'admin/ad/edit', '', 0, 'auth', 0, 1),
(27, 11, '删除', 'admin/ad/del', '', 0, 'auth', 0, 1),
(28, 9, '添加', 'admin/user/add', '', 0, 'auth', 0, 1),
(29, 9, '编辑', 'admin/user/edit', '', 0, 'auth', 0, 1),
(30, 9, '删除', 'admin/user/del', '', 0, 'auth', 0, 1),
(31, 7, '添加', 'admin/category/add', '', 0, 'auth', 0, 1),
(32, 7, '编辑', 'admin/category/edit', '', 0, 'auth', 0, 1),
(33, 7, '删除', 'admin/category/del', '', 0, 'auth', 0, 1),
(34, 8, '添加', 'admin/article/add', '', 0, 'auth', 0, 1),
(35, 8, '编辑', 'admin/article/edit', '', 0, 'auth', 0, 1),
(36, 8, '删除', 'admin/article/del', '', 0, 'auth', 0, 1),
(37, 16, '添加', 'admin/admin/add', '', 0, 'auth', 0, 1),
(38, 16, '编辑', 'admin/admin/edit', '', 0, 'auth', 0, 1),
(39, 16, '删除', 'admin/admin/del', '', 0, 'auth', 0, 1),
(40, 17, '添加', 'admin/auth/addGroup', '', 0, 'auth', 0, 1),
(41, 17, '编辑', 'admin/auth/editGroup', '', 0, 'auth', 0, 1),
(42, 17, '删除', 'admin/auth/delGroup', '', 0, 'auth', 0, 1),
(43, 6, '修改密码', 'admin/index/editPassword', '', 2, 'auth', 0, 1),
(44, 6, '清除缓存', 'admin/index/clear', '', 1, 'auth', 0, 1),
(45, 4, '上传设置', 'admin/config/upload', 'fa fa-upload', 4, 'nav', 0, 1),
(46, 3, '数据管理', 'admin/database/index', 'fa fa-database', 4, 'nav', 1, 1),
(47, 46, '还原', 'admin/database/import', '', 0, 'auth', 0, 1),
(48, 46, '备份', 'admin/database/backup', '', 0, 'auth', 0, 1),
(49, 46, '优化', 'admin/database/optimize', '', 0, 'auth', 0, 1),
(50, 46, '修复', 'admin/database/repair', '', 0, 'auth', 0, 1),
(51, 46, '下载', 'admin/database/download', '', 0, 'auth', 0, 1),
(52, 46, '删除', 'admin/database/del', '', 0, 'auth', 0, 1),
(53, 18, '一键清空', 'admin/admin/truncate', '', 0, 'auth', 0, 1),
(54, 10, '一键清空', 'admin/user/truncate', '', 0, 'auth', 0, 1),
(56, 0, '课程', 'admin/course/videoindex', 'fa fa-video-camera', 1, 'nav', 0, 1),
(58, 0, '教育云', 'admin/educloud/videoList', 'fa fa-cloud', 6, 'nav', 1, 1),
(59, 56, '点播课程', 'admin/course/videoindex', 'fa fa-film', 0, 'nav', 1, 1),
(60, 56, '直播课程', 'admin/course/liveindex', 'fa fa-video-camera', 0, 'nav', 1, 1),
(62, 56, '课程分类', 'admin/course/coursecategory', 'fa fa-th-list', 0, 'nav', 0, 1),
(63, 62, '添加', 'admin/course/categoryadd', '', 0, 'auth', 0, 1),
(64, 62, '编辑', 'admin/course/categoryedit', '', 0, 'auth', 0, 1),
(65, 62, '删除', 'admin/course/categorydel', '', 0, 'auth', 0, 1),
(66, 59, '添加', 'admin/course/videoadd', '', 0, 'auth', 0, 1),
(67, 59, '编辑', 'admin/course/videoedit', '', 0, 'auth', 0, 1),
(68, 59, '删除', 'admin/course/videodel', '', 0, 'auth', 0, 1),
(69, 59, '管理', 'admin/course/videoadmin', '', 0, 'auth', 0, 1),
(70, 58, '云直播', 'admin/educloud/index', 'fa fa-address-card', 1, 'nav', 0, 1),
(72, 70, '账号绑定', 'admin/educloud/liveBind', 'fa fa-plus-square', 1, 'nav', 0, 1),
(74, 60, '添加', 'admin/course/liveAdd', '', 0, 'auth', 0, 1),
(75, 60, '编辑', 'admin/course/liveEdit', '', 0, 'auth', 0, 1),
(76, 60, '删除', 'admin/course/liveDel', '', 0, 'auth', 0, 1),
(77, 60, '管理', 'admin/course/liveAdmin', '', 0, 'auth', 0, 1),
(78, 0, '问答', 'admin/forum/plate', 'fa fa-coffee', 4, 'nav', 0, 1),
(79, 58, '云点播', '', 'fa fa-video-camera', 0, 'nav', 0, 1),
(80, 79, '账号绑定', 'admin/educloud/videoBind', 'fa fa-plus-circle', 1, 'nav', 0, 1),
(81, 79, '视频管理', 'admin/educloud/videoList', 'fa fa-bars', 0, 'nav', 1, 1),
(82, 0, '题库', 'admin/exam/questionsList', 'fa fa-sticky-note-o', 2, 'nav', 0, 1),
(83, 82, '试题管理', 'admin/exam/index', 'fa fa-bars', 0, 'nav', 0, 1),
(84, 82, '试卷管理', 'admin/exam/typelist', 'fa fa-sitemap', 0, 'nav', 0, 1),
(85, 83, '题型管理', 'admin/exam/typeList', 'fa fa-pencil-square-o', 2, 'nav', 0, 1),
(86, 83, '试题列表', 'admin/exam/questionsList', 'fa fa-navicon', 1, 'nav', 1, 1),
(87, 86, '单题添加', 'admin/exam/questionsSingleAdd', '', 0, 'auth', 0, 1),
(88, 86, 'CSV导入', 'admin/exam/questionsCSVleAdd', '', 0, 'nav', 0, 1),
(89, 85, '添加类型', 'admin/exam/typeAdd', '', 0, 'nav', 0, 1),
(91, 84, '试卷列表', 'admin/exam/examList', 'fa fa-navicon', 0, 'nav', 1, 1),
(93, 84, '手动组卷', 'admin/exam/selfpage', '', 0, 'nav', 0, 1),
(94, 78, '板块管理', 'admin/forum/plate', 'fa fa-cube', 0, 'nav', 1, 1),
(96, 94, '添加板块', 'admin/forum/addplate', '', 0, 'auth', 0, 1),
(97, 70, '直播间管理', 'admin/educloud/getliveroomlist', 'fa fa-institution', 2, 'nav', 1, 1),
(98, 97, '删除直播间', 'admin/educloud/delLiveroom', '', 0, 'auth', 0, 1),
(99, 70, '回放管理', 'admin/educloud/getplaybacklist', 'fa fa-window-restore', 3, 'nav', 1, 1),
(100, 99, '删除回放', 'admin/educloud/delPlayback', '', 0, 'auth', 0, 1),
(101, 2, '教师管理', 'admin/user/teacher', 'fa fa-street-view', 0, 'nav', 0, 1),
(103, 69, '添加章', 'admin/course/videoAddZhang', '', 0, 'auth', 0, 1),
(104, 69, '编辑章', 'admin/course/videoEditZhang', '', 0, 'auth', 0, 1),
(105, 69, '添加视频课时', 'admin/course/videoAddSection', '', 0, 'auth', 0, 1),
(106, 69, '编辑视频课时', 'admin/course/videoEditSection', '', 0, 'auth', 0, 1),
(107, 69, '删除视频课时', 'admin/course/videoDelSection', '', 0, 'auth', 0, 1),
(108, 69, '视频列表', 'admin/course/videoList', '', 0, 'auth', 0, 1),
(109, 69, '添加文本课程', 'admin/course/videoAddDoc', '', 0, 'auth', 0, 1),
(110, 69, '编辑文本课程', 'admin/course/videoEditDoc', '', 0, 'auth', 0, 1),
(111, 69, '学员列表', 'admin/course/xueyuanList', '', 0, 'auth', 0, 1),
(112, 69, '资料列表', 'admin/course/materialList', '', 0, 'auth', 0, 1),
(113, 69, '添加资料', 'admin/course/MaterialAdd', '', 0, 'auth', 0, 1),
(114, 69, '删除资料关联', 'admin/course/videoMaterialDel', '', 0, 'auth', 0, 1),
(115, 69, '向课程中添加资料', 'admin/course/MaterialInsert', '', 0, 'auth', 0, 1),
(116, 81, '视频列表', 'admin/educloud/videoList', '', 0, 'auth', 0, 1),
(117, 81, '上传视频', 'admin/educloud/quan', '', 0, 'auth', 0, 1),
(118, 81, '删除云视频', 'admin/educloud/videodel', '', 0, 'auth', 0, 1),
(119, 81, 'Oss上传类', 'admin/educloud/new_oss', '', 0, 'auth', 0, 1),
(120, 81, 'Oss上传实例', 'admin/educloud/ossupload', '', 0, 'auth', 0, 1),
(121, 81, '删除OSS文件', 'admin/educloud/ossdel', '', 0, 'auth', 0, 1),
(122, 81, '获取上传凭证', 'admin/educloud/getaliuptoken', '', 0, 'auth', 0, 1),
(123, 101, '教师列表', 'admin/user/teacherList', '', 0, 'nav', 0, 1),
(124, 101, '申请条例', 'admin/user/ordinance', '', 1, 'nav', 0, 1),
(125, 101, '教师审核', 'admin/user/verifyList', '', 0, 'nav', 0, 1),
(127, 6, '修改教师信息', 'admin/index/teacherInfoSave', '', 0, 'auth', 0, 1),
(128, 6, '上传图片', 'admin/index/uploadImage', '', 0, 'auth', 0, 1),
(129, 6, '上传文件', 'admin/index/uploadFile', '', 0, 'auth', 0, 1),
(130, 4, '支付设置', 'admin/config/pay', 'fa fa-shopping-cart', 1, 'nav', 0, 1),
(131, 81, '视频分类列表', 'admin/educloud/videocategory', '', 0, 'auth', 0, 1),
(132, 81, '添加视频分类', 'admin/educloud/addvideocategory', '', 0, 'auth', 0, 1),
(133, 81, '获取视频分类列表', 'admin/educloud/videocategory', '', 0, 'auth', 0, 1),
(134, 81, '添加提交', 'admin/educloud/addCategoryPhpSDK', '', 0, 'auth', 0, 1),
(135, 81, '删除视频分类', 'admin/educloud/delvideocategory', '', 0, 'nav', 0, 1),
(136, 56, '课程订单', 'admin/course/courseOrder', 'fa fa-building-o', 0, 'nav', 1, 1),
(137, 136, '订单列表', 'admin/course/courseOrder', '', 0, 'auth', 0, 1),
(138, 136, '删除订单', 'admin/course/delCourseOrder', '', 0, 'auth', 0, 1),
(139, 6, '提现', 'admin/user/tixian', '', 0, 'nav', 0, 1),
(142, 83, '删除试题', 'admin/exam/questionsDel', '', 0, 'auth', 0, 1),
(143, 83, '编辑试题', 'admin/exam/questionsEdit', '', 0, 'auth', 0, 1),
(144, 83, '试题预览', 'admin/exam/questionsPreview', '', 0, 'auth', 0, 1),
(145, 84, '试卷预览', 'admin/exam/examPreview', '', 0, 'auth', 0, 1),
(146, 84, '删除试卷', 'admin/exam/examDel', '', 0, 'auth', 0, 1),
(147, 84, '选择试题', 'admin/exam/questionsSelect', '', 0, 'auth', 0, 1),
(148, 85, '编辑题型', 'admin/exam/typeEdit', '', 0, 'auth', 0, 1),
(149, 85, '删除题型', 'admin/exam/typeDel', '', 0, 'auth', 0, 1),
(150, 101, '提现管理', 'admin/user/tixianAdmin', 'fa fa-diamond', 0, 'nav', 0, 1),
(151, 56, '批改作业', 'admin/exam/paperList', 'fa fa-window-restore', 0, 'nav', 0, 1),
(152, 151, '作业列表', 'admin/exam/paperlist', '', 0, 'auth', 0, 1),
(153, 69, '添加试卷', 'admin/course/videoaddExam', '', 0, 'auth', 0, 1),
(154, 69, '试卷列表', 'admin/course/paperlist', '', 0, 'nav', 0, 1),
(155, 77, '添加章', 'admin/course/liveAddZhang', '', 0, 'auth', 0, 1),
(156, 77, '编辑章', 'admin/course/liveEditZhang', '', 0, 'auth', 0, 1),
(157, 77, '创建直播间', 'admin/course/liveAddSection', '', 0, 'auth', 0, 1),
(158, 77, '编辑直播间', 'admin/course/liveEditSection', '', 0, 'auth', 0, 1),
(159, 77, '删除直播间课时', 'admin/course/liveDelSection', '', 0, 'auth', 0, 1),
(160, 77, '添加文本课时', 'admin/course/liveAddDoc', '', 0, 'auth', 0, 1),
(161, 77, '编辑文本课时', 'admin/course/liveEditDoc', '', 0, 'auth', 0, 1),
(162, 77, '添加考试', 'admin/course/liveaddExam', '', 0, 'auth', 0, 1),
(163, 151, '批改作业', 'admin/exam/mark', '', 0, 'auth', 0, 1),
(164, 4, '登录设置', 'admin/config/thirdLogin', 'fa fa-sign-in', 1, 'nav', 0, 1),
(165, 58, '云短信', 'admin/educloud/cloudSMS', 'fa fa-recycle', 2, 'nav', 0, 1),
(166, 165, '签名配置', 'admin/educloud/signName', '', 0, 'nav', 0, 1),
(167, 165, '模板配置', 'admin/educloud/templates', '', 0, 'nav', 0, 1),
(169, 3, '移动终端', 'admin/Mobileterminal/index', 'fa fa-fax', 0, 'nav', 0, 1),
(172, 0, '营销', '', 'fa fa-line-chart', 7, 'nav', 0, 1),
(173, 172, '充值卡', 'admin/card/index', 'fa fa-map-o', 0, 'nav', 0, 1),
(174, 172, '优惠券', 'admin/coupon/index', 'fa fa-square-o', 0, 'nav', 0, 1),
(175, 172, '限时抢购', 'admin/flashsale/index', 'fa fa-bolt', 0, 'nav', 0, 1),
(176, 56, '班级管理', 'admin/classroom/index', 'fa fa-database', 0, 'nav', 0, 1),
(177, 176, '添加班级', 'admin/classroom/add', '', 0, 'auth', 0, 1),
(178, 130, '微信支付', 'admin/config/pay/type/1', '', 0, 'nav', 0, 1),
(179, 130, '支付宝支付', 'admin/config/pay/type/2', '', 0, 'nav', 0, 1),
(180, 130, '教师分成比例', 'admin/config/pay/type/3', '', 0, 'nav', 0, 1),
(181, 176, '班级列表', 'admin/classroom/index', '', 0, 'auth', 0, 1),
(182, 176, '编辑班级', 'admin/classroom/edit', '', 0, 'auth', 0, 1),
(183, 176, '删除班级', 'admin/classroom/del', '', 0, 'auth', 0, 1),
(184, 176, '班级课程', 'admin/classroom/courseList', '', 0, 'auth', 0, 1),
(185, 182, '提交编辑', 'admin/classroom/editPost', '', 0, 'auth', 0, 1),
(186, 173, '列表', 'admin/card/index', '', 0, 'auth', 0, 1),
(187, 173, '添加', 'admin/card/add', '', 0, 'auth', 0, 1),
(188, 173, '编辑', 'admin/card/edit', '', 0, 'auth', 0, 1),
(189, 173, '删除', 'admin/card/del', '', 0, 'auth', 0, 1),
(190, 173, '导出', 'admin/card/export', '', 0, 'auth', 0, 1),
(191, 174, '列表', 'admin/coupon/index', '', 0, 'auth', 0, 1),
(192, 174, '添加', 'admin/coupon/add', '', 0, 'auth', 0, 1),
(193, 174, '编辑', 'admin/coupon/edit', '', 0, 'auth', 0, 1),
(194, 174, '删除', 'admin/coupon/del', '', 0, 'auth', 0, 1),
(195, 174, '发放', 'admin/coupon/fafang', '', 0, 'auth', 0, 1),
(196, 175, '列表', 'admin/flashsale/index', '', 0, 'auth', 0, 1),
(197, 175, '添加', 'admin/flashsale/create', '', 0, 'auth', 0, 1),
(198, 175, '编辑', 'admin/flashsale/edit', '', 0, 'auth', 0, 1),
(199, 197, '提交', 'admin/flashsale/createPost', '', 0, 'auth', 0, 1),
(200, 198, '提交', 'admin/flashsale/editPost', '', 0, 'auth', 0, 1),
(201, 175, '删除', 'admin/flashsale/del', '', 0, 'auth', 0, 1),
(202, 9, '给钱', 'admin/user/addmoney', '', 0, 'auth', 0, 1),
(203, 3, '网站模板', 'admin/mobileterminal/template', 'fa fa-object-ungroup', 0, 'nav', 0, 1),
(204, 203, '手机模板', 'admin/mobileterminal/mobile', '', 0, 'nav', 0, 1),
(205, 4, '前台菜单', 'admin/config/nav', 'fa fa-sitemap', 2, 'nav', 0, 1),
(206, 205, '添加菜单', 'admin/config/navadd', '', 0, 'auth', 0, 1),
(207, 205, '编辑菜单', 'admin/config/navedit', '', 0, 'auth', 0, 1),
(208, 205, '添加菜单', 'admin/config/navadd', '', 0, 'auth', 0, 1),
(209, 205, '删除菜单', 'admin/config/navdel', '', 0, 'auth', 0, 1);

-- --------------------------------------------------------

--
-- 表的结构 `edu_card`
--

CREATE TABLE IF NOT EXISTS `edu_card` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `number` varchar(20) NOT NULL,
  `money` int(8) NOT NULL,
  `uid` int(8) NOT NULL DEFAULT '0',
  `usestatus` int(2) NOT NULL DEFAULT '0',
  `buystatus` int(2) NOT NULL DEFAULT '0',
  `status` int(2) NOT NULL DEFAULT '0',
  `addtime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


-- --------------------------------------------------------

--
-- 表的结构 `edu_category`
--

CREATE TABLE IF NOT EXISTS `edu_category` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `pid` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '上级分类ID',
  `category_name` varchar(255) NOT NULL DEFAULT '' COMMENT '标题',
  `sort_order` int(11) NOT NULL DEFAULT '100' COMMENT '排序',
  `keywords` varchar(255) DEFAULT '' COMMENT '关键字',
  `description` varchar(255) DEFAULT '' COMMENT '描述',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='分类' AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `edu_category`
--

INSERT INTO `edu_category` (`id`, `pid`, `category_name`, `sort_order`, `keywords`, `description`) VALUES
(1, 0, '行业资讯', 0, '', ''),
(2, 0, '本站动态', 100, '', '');

-- --------------------------------------------------------

--
-- 表的结构 `edu_classroom`
--

CREATE TABLE IF NOT EXISTS `edu_classroom` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) DEFAULT '0',
  `type` int(2) NOT NULL DEFAULT '0',
  `headteacher` int(5) NOT NULL DEFAULT '0',
  `cids` varchar(200) DEFAULT '0',
  `views` int(8) NOT NULL,
  `status` int(2) DEFAULT '0',
  `is_top` int(2) DEFAULT '0',
  `price` float(7,2) DEFAULT '0.00',
  `picture` varchar(200) DEFAULT '0',
  `xuni` int(7) DEFAULT '0',
  `brief` text,
  `youxiaoqi` int(5) NOT NULL DEFAULT '0',
  `sort_order` int(4) NOT NULL DEFAULT '0',
  `addtime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


-- --------------------------------------------------------

--
-- 表的结构 `edu_comment`
--

CREATE TABLE IF NOT EXISTS `edu_comment` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `cid` int(6) NOT NULL,
  `sid` int(6) NOT NULL,
  `uid` int(6) NOT NULL,
  `cstype` int(2) NOT NULL,
  `contents` text NOT NULL,
  `addtime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


-- --------------------------------------------------------

--
-- 表的结构 `edu_config`
--

CREATE TABLE IF NOT EXISTS `edu_config` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `group` varchar(32) NOT NULL DEFAULT '' COMMENT '配置分组',
  `title` varchar(255) NOT NULL DEFAULT '' COMMENT '配置标题',
  `name` varchar(255) NOT NULL DEFAULT '' COMMENT '配置标识',
  `type` varchar(32) NOT NULL DEFAULT '' COMMENT '配置类型',
  `value` text NOT NULL COMMENT '默认值',
  `options` text COMMENT '选项值',
  `sort_order` int(11) NOT NULL DEFAULT '100' COMMENT '排序',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='配置' AUTO_INCREMENT=26 ;

--
-- 转存表中的数据 `edu_config`
--

INSERT INTO `edu_config` (`id`, `group`, `title`, `name`, `type`, `value`, `options`, `sort_order`, `status`) VALUES
(1, 'website', '网站logo', 'logo', 'image', '/upload/image/20190615/237c148a479fa156f0ad53a06c47ca48.png', '', 97, 1),
(2, 'website', '网站名称', 'site_name', 'input', '清考在线教育平台', '', 100, 1),
(3, 'website', '网站标题', 'site_title', 'input', '清考在线教育平台，最具性价比的网校系统', '', 100, 1),
(4, 'website', '网站关键字', 'site_keywords', 'input', '清考在线教育平台，网校系统，在线教学，网校，翻转课堂，企业培训', '', 100, 1),
(5, 'website', '网站描述', 'site_description', 'textarea', '清考在线教育平台是专业安全的网校系统，一站式在线学习辅导解决方案，按需购买，自由扩容。e-learning系统，网校开发，网校建设，网校搭建就选易校通。\r\n', '', 100, 1),
(6, 'website', '版权信息', 'site_copyright', 'input', '清考在线教育软件', '', 100, 1),
(7, 'website', 'ICP备案号', 'site_icp', 'input', ' 沪ICP备17039843号-3', '', 100, 1),
(8, 'website', '统计代码', 'site_code', 'textarea', '<script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? "https://" : "http://");document.write(unescape("%3Cspan id=''cnzz_stat_icon_1277630122''%3E%3C/span%3E%3Cscript src=''" + cnzz_protocol + "s5.cnzz.com/stat.php%3Fid%3D1277630122%26show%3Dpic'' type=''text/javascript''%3E%3C/script%3E"));</script>', '', 100, 1),
(9, 'contact', '公司名称', 'company', 'input', '新起点教育软件', '', 100, 1),
(10, 'contact', '公司地址', 'address', 'input', '上海市金山区山阳镇卫清东路2312号2幢G199室', '', 100, 1),
(11, 'contact', '联系电话', 'tel', 'input', '15853789278', '', 100, 1),
(12, 'contact', '联系邮箱', 'email', 'input', 'newlog@163.com', '', 100, 1),
(15, 'website', '登录页关注的二维码', 'weixin', 'image', '/upload/image/20191030/2e84a5cae8010adcf3ba1d192b67c47d.jpg', '', 99, 1),
(24, 'website', '关于我们', 'about', 'textarea', '奀司（上海）信息科技有限公司成立于2016年，公司主要从事计算机信息、计算机网络、计算机、计算机软硬件、多媒体科技领域内技术开发、技术咨询、技术服务，网页设计制作，计算机网络工程，网站建设，计算机软硬件开发，计算机软件开发及维护，计算机维修，计算机信息系统集成服务，计算机信息技术咨询服务，企业管理咨询，自有设备租赁，广告设计、制作、代理、发布，摄影摄像服务，电信工程，通讯器材，通信设备及相关产品，电子产品，计算机、软件及辅助设备销售，电子商务。newlogo为期旗下一款开源在线教育网站平台，主要用于在线点播、在线直播、题库等功能，非常适合于个人和小型机构创建自己的的在线教育网站。', '', 100, 1),
(25, 'website', '网站icon', 'icon', 'image', '/upload/file/20191212/2e07bde2b1783c74f12a461ae575bf96.ico', '', 98, 1);

-- --------------------------------------------------------

--
-- 表的结构 `edu_cooperate`
--

CREATE TABLE IF NOT EXISTS `edu_cooperate` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `sex` varchar(6) NOT NULL,
  `birth_y` varchar(10) NOT NULL,
  `birth_m` varchar(10) NOT NULL,
  `birth_d` varchar(10) NOT NULL,
  `provid` varchar(10) NOT NULL,
  `cityid` varchar(20) NOT NULL,
  `areaid` varchar(20) NOT NULL,
  `identity` varchar(25) NOT NULL,
  `identity_z` varchar(100) NOT NULL,
  `identity_f` varchar(100) NOT NULL,
  `brief` varchar(400) NOT NULL,
  `sign` varchar(150) NOT NULL,
  `status` int(11) NOT NULL,
  `addtime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `edu_coupon`
--

CREATE TABLE IF NOT EXISTS `edu_coupon` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `code` varchar(20) NOT NULL,
  `rate` int(11) NOT NULL,
  `status` int(2) NOT NULL DEFAULT '0',
  `buystatus` int(2) NOT NULL DEFAULT '0',
  `usestatus` int(2) NOT NULL DEFAULT '0',
  `userId` int(6) NOT NULL DEFAULT '0',
  `addtime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


-- --------------------------------------------------------

--
-- 表的结构 `edu_course_category`
--

CREATE TABLE IF NOT EXISTS `edu_course_category` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `pid` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '上级分类ID',
  `category_name` varchar(255) NOT NULL DEFAULT '' COMMENT '标题',
  `sort_order` int(11) NOT NULL DEFAULT '100' COMMENT '排序',
  `keywords` varchar(255) DEFAULT '' COMMENT '关键字',
  `description` varchar(255) DEFAULT '' COMMENT '描述',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='分类' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `edu_exams`
--

CREATE TABLE IF NOT EXISTS `edu_exams` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tid` int(5) NOT NULL,
  `examsubject` tinyint(4) NOT NULL DEFAULT '0',
  `exam` varchar(120) NOT NULL DEFAULT '',
  `examsetting` text NOT NULL,
  `examquestions` text NOT NULL,
  `examscore` text NOT NULL,
  `examstatus` int(1) NOT NULL DEFAULT '0',
  `examauthorid` int(11) NOT NULL DEFAULT '0',
  `examtime` int(11) NOT NULL DEFAULT '0',
  `addtime` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `examstatus` (`examstatus`),
  KEY `examtype` (`examauthorid`),
  KEY `examtime` (`examtime`),
  KEY `examsubject` (`examsubject`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `edu_favourite`
--

CREATE TABLE IF NOT EXISTS `edu_favourite` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `uid` int(5) NOT NULL,
  `cid` int(5) NOT NULL,
  `type` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


-- --------------------------------------------------------

--
-- 表的结构 `edu_forum_plate`
--

CREATE TABLE IF NOT EXISTS `edu_forum_plate` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` varchar(200) NOT NULL,
  `sort_order` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `edu_forum_reply`
--

CREATE TABLE IF NOT EXISTS `edu_forum_reply` (
  `id` int(6) NOT NULL AUTO_INCREMENT COMMENT '主题回复id',
  `tid` int(6) NOT NULL COMMENT '主题id',
  `uid` int(5) NOT NULL COMMENT '回复用户id',
  `content` longtext NOT NULL COMMENT '回复内容',
  `accept` int(2) NOT NULL,
  `zan` int(4) NOT NULL,
  `addtime` datetime NOT NULL COMMENT '回复时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `edu_forum_topic`
--

CREATE TABLE IF NOT EXISTS `edu_forum_topic` (
  `id` int(8) NOT NULL AUTO_INCREMENT COMMENT '论坛主题ID',
  `uid` int(5) NOT NULL COMMENT '作者ID',
  `pid` int(2) NOT NULL COMMENT '板块ID',
  `name` varchar(50) NOT NULL COMMENT '主题标题',
  `content` longtext NOT NULL COMMENT '主题内容',
  `istop` int(2) NOT NULL,
  `isessence` int(2) NOT NULL,
  `hits` int(8) NOT NULL,
  `replays` int(6) NOT NULL,
  `knot` int(11) NOT NULL,
  `addtime` datetime NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `edu_knowledge`
--

CREATE TABLE IF NOT EXISTS `edu_knowledge` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `sectionid` int(5) NOT NULL,
  `title` text NOT NULL,
  `sort_order` int(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `edu_live_course`
--

CREATE TABLE IF NOT EXISTS `edu_live_course` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(250) NOT NULL,
  `cid` int(10) NOT NULL,
  `teacher_id` int(10) NOT NULL,
  `material_id` varchar(100) NOT NULL,
  `status` int(2) NOT NULL,
  `limit` int(6) NOT NULL,
  `is_top` int(2) NOT NULL,
  `is_hot` int(2) NOT NULL,
  `price` float(8,2) NOT NULL,
  `youxiaoqi` int(1) NOT NULL DEFAULT '0',
  `picture` varchar(250) NOT NULL,
  `xuni_num` int(10) NOT NULL,
  `brief` text NOT NULL,
  `type` int(2) NOT NULL,
  `is_over` int(2) NOT NULL,
  `sort_order` int(10) NOT NULL,
  `views` int(10) NOT NULL,
  `addtime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `edu_live_section`
--

CREATE TABLE IF NOT EXISTS `edu_live_section` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `csid` int(6) DEFAULT NULL,
  `title` varchar(50) NOT NULL,
  `isfree` int(2) NOT NULL DEFAULT '0',
  `playtimes` int(2) DEFAULT NULL,
  `addtime` datetime DEFAULT NULL,
  `max_users` int(5) NOT NULL,
  `ischapter` int(10) DEFAULT NULL,
  `chapterid` int(2) NOT NULL DEFAULT '0',
  `type` int(2) DEFAULT NULL,
  `document` text NOT NULL,
  `paperid` int(15) NOT NULL,
  `starttime` datetime DEFAULT NULL,
  `live_type` int(2) NOT NULL,
  `sectype` int(2) NOT NULL,
  `coursetype` int(2) NOT NULL,
  `room_id` varchar(20) NOT NULL,
  `admin_code` varchar(10) NOT NULL,
  `teacher_code` varchar(10) NOT NULL,
  `student_code` varchar(10) NOT NULL,
  `duration` int(4) NOT NULL,
  `sort_order` int(10) NOT NULL,
  `status` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


-- --------------------------------------------------------

--
-- 表的结构 `edu_marketing`
--

CREATE TABLE IF NOT EXISTS `edu_marketing` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL DEFAULT '0',
  `type` varchar(10) NOT NULL,
  `c_type` int(2) NOT NULL DEFAULT '0',
  `title` varchar(20) NOT NULL,
  `details` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `edu_material`
--

CREATE TABLE IF NOT EXISTS `edu_material` (
  `id` int(5) NOT NULL AUTO_INCREMENT COMMENT '资料ID',
  `uid` int(10) NOT NULL,
  `original_name` varchar(100) NOT NULL COMMENT '原始名称',
  `oss_name` varchar(100) NOT NULL,
  `oss_url` varchar(200) NOT NULL COMMENT 'oss文件路径',
  `addtime` datetime NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;


-- --------------------------------------------------------

--
-- 表的结构 `edu_myexam`
--

CREATE TABLE IF NOT EXISTS `edu_myexam` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `eid` int(6) NOT NULL COMMENT '试卷ID',
  `uid` int(6) NOT NULL COMMENT '用户ID',
  `cid` int(6) NOT NULL,
  `tid` int(2) NOT NULL,
  `ctype` int(2) NOT NULL,
  `myanswer` text NOT NULL COMMENT '我的答案',
  `myscore` text NOT NULL,
  `zgscores` int(3) NOT NULL COMMENT '主观题得分',
  `kgscores` int(3) NOT NULL COMMENT '客观题得分',
  `totalscores` int(3) NOT NULL COMMENT '总分',
  `status` int(2) NOT NULL,
  `addtime` datetime NOT NULL COMMENT '考试时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `edu_nav`
--

CREATE TABLE IF NOT EXISTS `edu_nav` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `pid` int(3) NOT NULL,
  `name` varchar(20) NOT NULL DEFAULT '0',
  `sort_order` int(3) NOT NULL,
  `url` varchar(100) NOT NULL DEFAULT '0',
  `target` varchar(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- 转存表中的数据 `edu_nav`
--

INSERT INTO `edu_nav` (`id`, `pid`, `name`, `sort_order`, `url`, `target`) VALUES
(5, 0, '发现', 10, 'javascript:void(0);', '_self'),
(6, 5, '直播', 10, 'index/course/liveindex', '_self'),
(7, 5, '点播', 10, 'index/course/videoindex', '_self'),
(8, 5, '班级', 10, 'index/classroom/index', '_self'),
(9, 0, '问答', 10, 'index/forum/index', '_self'),
(10, 0, '资讯', 10, 'index/article/index', '_self'),
(11, 0, '名师', 10, 'index/teacher/index', '_self'),
(15, 0, '直播客户端', 10, 'index/index/LiveClient', '_blank');

-- --------------------------------------------------------

--
-- 表的结构 `edu_notes`
--

CREATE TABLE IF NOT EXISTS `edu_notes` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `uid` int(6) NOT NULL,
  `cid` int(6) NOT NULL,
  `sid` int(6) NOT NULL,
  `cstype` int(2) NOT NULL,
  `contents` text NOT NULL,
  `addtime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `edu_order`
--

CREATE TABLE IF NOT EXISTS `edu_order` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `uid` int(8) DEFAULT NULL COMMENT '客户ID',
  `cid` int(8) DEFAULT NULL COMMENT '课程ID',
  `tid` int(4) NOT NULL,
  `ctype` int(2) NOT NULL,
  `orderid` varchar(20) DEFAULT NULL COMMENT '本地订单ID',
  `paytype` varchar(10) NOT NULL COMMENT '支付方式',
  `state` int(2) DEFAULT NULL COMMENT '订单状态',
  `addtime` datetime DEFAULT NULL COMMENT '创建时间',
  `total` float(8,2) DEFAULT NULL COMMENT '订单总价',
  `payorder` varchar(40) DEFAULT NULL COMMENT '第三方订单 ID',
  `profit` int(8) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


-- --------------------------------------------------------

--
-- 表的结构 `edu_other`
--

CREATE TABLE IF NOT EXISTS `edu_other` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `type` varchar(20) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `edu_other`
--

INSERT INTO `edu_other` (`id`, `type`, `value`) VALUES
(1, 'ordinance', '<p style="text-align: center;"><span style="font-size: 20px;"><strong>教师申请条例</strong></span></p><p>一、课程要求 　 　　</p><p>&nbsp;&nbsp;&nbsp;&nbsp;1、您的课程必须由您自己原创录制的，不得发布他人的课程，或抄袭，翻版其他人的课程。 　 　　</p><p>&nbsp;&nbsp; &nbsp;2、您应自行负责您课程的开发、创建、上课、管理等工作，本平台会在一定程度上提供助理服务，帮助您更好的开展教学。&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;3、您不得在课程内宣传与本课程无关的任何其他信息，包括但不限于广告、其他的课程产品信息等，也不得在课程内添加指向非本平台拥有或控制或本平台书面同意的网站链接。 　 　　</p><p>二、&nbsp;课程运营 　 　　</p><p>&nbsp;&nbsp;&nbsp;&nbsp;2.1&nbsp;&nbsp;您保证： 　 　　</p><p>&nbsp;&nbsp;&nbsp;&nbsp;（1）您的课程、提供给用户的相关服务及发布的相关信息、内容等，不违反相关法律、法规、政策等的规定及本协议或相关协议、规则等，也不会侵犯任何人的合法权益； 　　</p><p>&nbsp; &nbsp; （2）课程上课过程中应尊重用户知情权、选择权，应当坚持诚信原则，不误导、欺诈、混淆用户，尊重用户的隐私，不骚扰用户，不制造垃圾信息。 　</p><p>&nbsp; &nbsp; 2.2 您不得从事包括但不限于以下行为，也不得为以下行为提供便利： 　 　　</p><p>&nbsp;&nbsp;&nbsp;&nbsp;（1）以任何方式干扰或企图干扰本平台任何产品、任何部分或功能的正常运行，或者制作、发布、传播上述工具、方法等；&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;（2）在未经过用户同意的情况下，向任何其他用户及他方显示或以其他任何方式提供该用户的任何信息； 　　</p><p>&nbsp;&nbsp;&nbsp;&nbsp;（3）请求、收集、索取或以其他方式获取用户手机号，本平台服务的登录帐号、密码或其他任何身份验证凭据； 　　 　　</p><p>&nbsp;&nbsp;&nbsp;&nbsp;（4）设置或发布任何违反相关法规、公序良俗、社会公德等的玩法、内容等； 　　</p><p>&nbsp;&nbsp;&nbsp;&nbsp;（5）其他认为不应该、不适当的行为、内容。 　 　　</p>');

-- --------------------------------------------------------

--
-- 表的结构 `edu_profit`
--

CREATE TABLE IF NOT EXISTS `edu_profit` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `tid` int(5) NOT NULL,
  `profit` int(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


-- --------------------------------------------------------

--
-- 表的结构 `edu_questions`
--

CREATE TABLE IF NOT EXISTS `edu_questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `questionchapterid` int(5) NOT NULL,
  `questionknowsid` text NOT NULL,
  `questionuserid` int(11) NOT NULL DEFAULT '0',
  `questiontype` int(2) NOT NULL DEFAULT '0',
  `question` text NOT NULL,
  `questionselect` text NOT NULL,
  `questionanswer` text NOT NULL,
  `questiondescribe` text NOT NULL,
  `questionlastmodifyuser` varchar(120) NOT NULL DEFAULT '',
  `questionselectnumber` tinyint(11) NOT NULL DEFAULT '0',
  `questioncreatetime` datetime NOT NULL,
  `questionstatus` int(1) NOT NULL DEFAULT '1',
  `questionhtml` text NOT NULL,
  `questionparent` int(11) NOT NULL DEFAULT '0',
  `questionsequence` int(3) NOT NULL DEFAULT '0',
  `questionlevel` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `questioncreatetime` (`questioncreatetime`),
  KEY `questiontype` (`questiontype`),
  KEY `questionstatus` (`questionstatus`),
  KEY `questionuserid` (`questionuserid`),
  KEY `questionparent` (`questionparent`,`questionsequence`),
  KEY `questionlevel` (`questionlevel`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `edu_question_type`
--

CREATE TABLE IF NOT EXISTS `edu_question_type` (
  `id` int(2) NOT NULL AUTO_INCREMENT COMMENT '题型ID',
  `type_name` varchar(20) NOT NULL COMMENT '题型名称',
  `p_type` int(2) NOT NULL COMMENT '展现形式',
  `mark` varchar(20) NOT NULL,
  `sort_order` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- 转存表中的数据 `edu_question_type`
--

INSERT INTO `edu_question_type` (`id`, `type_name`, `p_type`, `mark`, `sort_order`) VALUES
(1, '多选题', 1, 'MultiSelect', 2),
(2, '填空题', 2, 'FillInBlanks', 3),
(3, '简答题', 2, 'ShortAnswer', 5),
(4, '单选题', 1, 'SingleSelect', 1),
(5, '判断题', 1, 'TrueOrfalse', 4),
(6, '论述题', 1, 'TiMao', 6),
(7, '听力题', 1, 'TiMao', 0),
(8, '阅读理解', 1, 'TiMao', 7);

-- --------------------------------------------------------

--
-- 表的结构 `edu_questype`
--

CREATE TABLE IF NOT EXISTS `edu_questype` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `questype` varchar(60) NOT NULL DEFAULT '',
  `questsort` int(1) NOT NULL DEFAULT '0',
  `questchoice` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `questchoice` (`questchoice`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `edu_system`
--

CREATE TABLE IF NOT EXISTS `edu_system` (
  `name` varchar(255) NOT NULL DEFAULT '',
  `value` text NOT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='系统配置';

--
-- 转存表中的数据 `edu_system`
--

INSERT INTO `edu_system` (`name`, `value`) VALUES
('alipay_app_id', ''),
('alipay_public_key', ''),
('alipay_rsa_private_key', ''),
('AliUserId', '1401522572709919'),
('app_alipay_app_id', ''),
('app_alipay_public_key', ''),
('app_alipay_rsa_private_key', ''),
('app_weixin_appid', ''),
('app_weixin_AppSecret', ''),
('app_weixin_key', ''),
('app_weixin_mch_id', ''),
('author_code', 'BFmguPkkAs'),
('author_web', 'https://www.newlogo.cn/'),
('bili', '0.7'),
('Bucket', 'yxtcmf'),
('colse_explain', '网站升级中'),
('email_server', 'a:7:{s:4:\"host\";s:0:\"\";s:6:\"secure\";s:3:\"tls\";s:4:\"port\";s:0:\"\";s:8:\"username\";s:0:\"\";s:8:\"password\";s:0:\"\";s:8:\"fromname\";s:0:\"\";s:5:\"email\";s:0:\"\";}'),
('EndPoint', 'oss-cn-beijing.aliyuncs.com'),
('h5version', '2.1.0'),
('h5_alipay_app_id', ''),
('h5_alipay_public_key', ''),
('h5_alipay_rsa_private_key', ''),
('h5_weixin_appid', ''),
('h5_weixin_AppSecret', ''),
('h5_weixin_key', ''),
('h5_weixin_mch_id', ''),
('is_develop', '0'),
('KeyID', 'vhnu44cn6ueypjda4u3rwgd0'),
('KeySecret', '49Ba6F/Qo53c8nwrMwvFT66BZYI='),
('PageSize', '12'),
('page_number', '12'),
('Partner_ID', '45500688'),
('Partner_Key', 'j2MXTLPU9rssJpL200MrSyDFYO8qbRhfB9++XSLjfkMJVHNblLOL07LP8cotBRjYqC7kHy4238KL1u2fA4M6eeNAio127oPaNTMbPOmh8CU4qv7LI0UZ+famI76evNzG'),
('private_domain', 'b45500688.at.baijiayun.com'),
('QQ_Login', ''),
('Secret_Key', '742edbc1f6581228f099dbbd80862d7a'),
('SmsSign', '奀司科技'),
('SmsTemplates_MC', 'a:4:{s:11:\"TemplatesId\";s:13:\"SMS_173140160\";s:7:\"_verify\";s:1:\"0\";s:4:\"type\";s:15:\"SmsTemplates_MC\";s:6:\"status\";s:1:\"0\";}'),
('SmsTemplates_SK', 'a:4:{s:11:\"TemplatesId\";s:12:\"SMS_95095012\";s:7:\"_verify\";s:1:\"0\";s:4:\"type\";s:15:\"SmsTemplates_SK\";s:6:\"status\";s:1:\"0\";}'),
('upload_image', 'a:15:{s:8:\"is_thumb\";s:1:\"1\";s:9:\"max_width\";s:4:\"1200\";s:10:\"max_height\";s:4:\"3600\";s:8:\"is_water\";s:1:\"0\";s:12:\"water_source\";s:0:\"\";s:12:\"water_locate\";s:1:\"1\";s:11:\"water_alpha\";s:2:\"80\";s:7:\"is_text\";s:1:\"0\";s:4:\"text\";s:9:\"易校通\";s:9:\"text_font\";s:0:\"\";s:11:\"text_locate\";s:1:\"7\";s:9:\"text_size\";s:2:\"20\";s:10:\"text_color\";s:7:\"#000000\";s:11:\"text_offset\";s:2:\"10\";s:10:\"text_angle\";s:2:\"50\";}'),
('version', '1.5.6'),
('website_status', '1'),
('weixin_appid', ''),
('weixin_AppSecret', ''),
('weixin_key', ''),
('Weixin_Login', ''),
('weixin_mch_id', '');

-- --------------------------------------------------------

--
-- 表的结构 `edu_tixian`
--

CREATE TABLE IF NOT EXISTS `edu_tixian` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `tid` int(6) NOT NULL,
  `money` int(5) NOT NULL,
  `status` int(2) NOT NULL,
  `type` varchar(10) NOT NULL,
  `account` varchar(30) NOT NULL,
  `name` varchar(20) NOT NULL,
  `addtime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `edu_user`
--

CREATE TABLE IF NOT EXISTS `edu_user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `openid` varchar(40) NOT NULL DEFAULT '0',
  `admin_id` int(5) NOT NULL,
  `is_teacher` int(2) NOT NULL,
  `category_id` varchar(20) NOT NULL,
  `username` varchar(255) DEFAULT NULL COMMENT '用户名',
  `sex` int(2) NOT NULL,
  `avatar` varchar(200) NOT NULL DEFAULT '0',
  `mobile` char(20) DEFAULT '' COMMENT '手机',
  `password` varchar(32) NOT NULL DEFAULT '' COMMENT '密码',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0禁用/1启动',
  `last_login_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '上次登录时间',
  `last_login_ip` varchar(16) NOT NULL DEFAULT '' COMMENT '上次登录IP',
  `login_count` int(11) NOT NULL DEFAULT '0' COMMENT '登录次数',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `safewords` varchar(20) NOT NULL,
  `yue` float(8,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='会员' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `edu_user_classroom`
--

CREATE TABLE IF NOT EXISTS `edu_user_classroom` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `classroomid` int(6) NOT NULL DEFAULT '0',
  `studied` varchar(500) NOT NULL DEFAULT '0',
  `uid` int(6) NOT NULL DEFAULT '0',
  `addtime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `edu_user_course`
--

CREATE TABLE IF NOT EXISTS `edu_user_course` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `uid` int(8) DEFAULT NULL,
  `cid` int(8) DEFAULT NULL,
  `type` int(2) NOT NULL,
  `state` int(2) DEFAULT NULL,
  `studied` varchar(1000) DEFAULT NULL,
  `isclassroom` int(2) NOT NULL DEFAULT '0',
  `nowstudy` int(8) NOT NULL,
  `nowstutime` datetime DEFAULT NULL,
  `addtime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


-- --------------------------------------------------------

--
-- 表的结构 `edu_user_log`
--

CREATE TABLE IF NOT EXISTS `edu_user_log` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '管理员id',
  `username` varchar(32) NOT NULL DEFAULT '' COMMENT '管理员用户名',
  `useragent` varchar(255) NOT NULL DEFAULT '' COMMENT 'User-Agent',
  `ip` varchar(16) NOT NULL DEFAULT '' COMMENT 'ip地址',
  `url` varchar(255) NOT NULL DEFAULT '' COMMENT '请求链接',
  `method` varchar(32) NOT NULL DEFAULT '' COMMENT '请求类型',
  `type` varchar(32) NOT NULL DEFAULT '' COMMENT '资源类型',
  `param` text NOT NULL COMMENT '请求参数',
  `remark` varchar(255) NOT NULL DEFAULT '' COMMENT '日志备注',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='会员日志' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `edu_video_course`
--

CREATE TABLE IF NOT EXISTS `edu_video_course` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(250) NOT NULL,
  `cid` int(10) NOT NULL,
  `teacher_id` int(10) NOT NULL,
  `material_id` varchar(100) NOT NULL,
  `status` int(2) NOT NULL,
  `is_top` int(2) NOT NULL,
  `is_hot` int(2) NOT NULL,
  `price` float(8,2) NOT NULL,
  `picture` varchar(250) NOT NULL,
  `xuni_num` int(10) NOT NULL,
  `brief` text NOT NULL,
  `is_over` int(2) NOT NULL,
  `youxiaoqi` int(5) NOT NULL,
  `sort_order` int(10) NOT NULL,
  `views` int(10) NOT NULL,
  `type` int(2) NOT NULL,
  `addtime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


-- --------------------------------------------------------

--
-- 表的结构 `edu_video_section`
--

CREATE TABLE IF NOT EXISTS `edu_video_section` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `csid` int(6) NOT NULL,
  `title` varchar(50) NOT NULL,
  `isfree` int(2) DEFAULT '0',
  `playtimes` int(2) DEFAULT NULL,
  `videoid` varchar(40) DEFAULT NULL,
  `duration` varchar(8) NOT NULL,
  `document` longtext COMMENT '文本课程',
  `ischapter` int(10) DEFAULT NULL,
  `sectype` int(2) DEFAULT NULL COMMENT '1视频课程，2语音课程，3文本课程，4练习题',
  `coursetype` int(2) NOT NULL,
  `chapterid` int(2) DEFAULT '0',
  `paperid` int(15) DEFAULT NULL,
  `sort_order` int(10) DEFAULT NULL,
  `status` int(2) DEFAULT NULL,
  `addtime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
