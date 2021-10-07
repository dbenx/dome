-- phpMyAdmin SQL Dump
-- version 4.0.8
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2016-03-23 11:46:25
-- 服务器版本: 5.0.45-community-nt
-- PHP 版本: 5.2.5

SET
SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET
time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `webreport`
--

-- --------------------------------------------------------

--
-- 表的结构 `yumdam_classitem`
--

CREATE TABLE IF NOT EXISTS `yumdam_classitem`
(
    `Id` int
(
    10
) unsigned NOT NULL auto_increment COMMENT 'Id',
    `TId` int
(
    11
) NOT NULL COMMENT '上级ID',
    `iname` varchar
(
    60
) NOT NULL COMMENT '项目名称',
    `ism` int
(
    1
) NOT NULL default '1' COMMENT '是否显示在手机报表',
    `wd` int
(
    1
) NOT NULL default '1' COMMENT '是否为网电项目',
    `isshow` int
(
    1
) NOT NULL default '1' COMMENT '是否显示',
    PRIMARY KEY
(
    `Id`
),
    UNIQUE KEY `Id`
(
    `Id`
)
    ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='表类型' AUTO_INCREMENT=35;

-- --------------------------------------------------------

--
-- 表的结构 `yumdam_cstcont`
--

CREATE TABLE IF NOT EXISTS `yumdam_cstcont`
(
    `Id` int
(
    10
) unsigned NOT NULL auto_increment COMMENT 'Id',
    `uid` int
(
    11
) NOT NULL COMMENT '用户ID',
    `fdate` int
(
    11
) NOT NULL COMMENT '添加选定日期',
    `itemid` int
(
    11
) NOT NULL COMMENT '项目ID',
    `itemtk` int
(
    11
) NOT NULL COMMENT '咨询总量',
    `itemytk` int
(
    11
) NOT NULL COMMENT '有效咨询量',
    `itemsys` int
(
    11
) NOT NULL COMMENT '下单量',
    `itemfr` int
(
    11
) NOT NULL COMMENT '来院量',
    `itemok` int
(
    11
) NOT NULL COMMENT '成交量',
    `itemokm` varchar
(
    40
) NOT NULL,
    `indate` int
(
    11
) NOT NULL COMMENT '添加日期',
    `uip` varchar
(
    20
) NOT NULL COMMENT '用户IP',
    PRIMARY KEY
(
    `Id`
),
    UNIQUE KEY `Id`
(
    `Id`
)
    ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='表类型' AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- 表的结构 `yumdam_cstdata`
--

CREATE TABLE IF NOT EXISTS `yumdam_cstdata`
(
    `Id` int
(
    10
) unsigned NOT NULL auto_increment COMMENT 'Id',
    `uid` int
(
    11
) NOT NULL COMMENT '用户ID',
    `selecttime` int
(
    11
) NOT NULL COMMENT '添加选定日期',
    `itemdata` text NOT NULL COMMENT '数据',
    `indate` int
(
    11
) NOT NULL COMMENT '添加日期',
    `lastdate` int
(
    11
) NOT NULL COMMENT '最后更新时间',
    `indatatime` int
(
    11
) NOT NULL COMMENT '导入时间',
    `uip` varchar
(
    20
) NOT NULL COMMENT '用户IP',
    PRIMARY KEY
(
    `Id`
),
    UNIQUE KEY `Id`
(
    `Id`
)
    ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='表类型' AUTO_INCREMENT=778;

-- --------------------------------------------------------

--
-- 表的结构 `yumdam_cstdata2`
--

CREATE TABLE IF NOT EXISTS `yumdam_cstdata2`
(
    `Id` int
(
    10
) unsigned NOT NULL auto_increment COMMENT 'Id',
    `fdate` int
(
    11
) NOT NULL COMMENT '指定日期',
    `monthmoney` varchar
(
    200
) NOT NULL default '0' COMMENT '月业绩',
    `monthdata` varchar
(
    500
) NOT NULL COMMENT '月合并情况',
    `indate` int
(
    11
) NOT NULL COMMENT '添加日期',
    `lastdate` int
(
    11
) NOT NULL COMMENT '更新日期',
    `inip` varchar
(
    20
) NOT NULL COMMENT '添加IP',
    PRIMARY KEY
(
    `Id`
),
    UNIQUE KEY `Id`
(
    `Id`
)
    ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='表类型' AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- 表的结构 `yumdam_cstdate`
--

CREATE TABLE IF NOT EXISTS `yumdam_cstdate`
(
    `Id` int
(
    10
) unsigned NOT NULL auto_increment COMMENT 'Id',
    `uid` int
(
    11
) NOT NULL default '0' COMMENT '用户ID',
    `selecttime` int
(
    11
) NOT NULL COMMENT '添加选定日期',
    `indate` int
(
    11
) NOT NULL COMMENT '添加日期',
    `lastdate` int
(
    11
) NOT NULL COMMENT '最后更新时间',
    `uip` varchar
(
    20
) NOT NULL COMMENT '用户IP',
    PRIMARY KEY
(
    `Id`
),
    UNIQUE KEY `Id`
(
    `Id`
)
    ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='表类型' AUTO_INCREMENT=103;

-- --------------------------------------------------------

--
-- 表的结构 `yumdam_csttempdata`
--

CREATE TABLE IF NOT EXISTS `yumdam_csttempdata`
(
    `Id` int
(
    10
) unsigned NOT NULL auto_increment COMMENT 'Id',
    `uid` int
(
    11
) NOT NULL COMMENT '用户id',
    `selecttime` int
(
    11
) NOT NULL COMMENT '数据日期',
    `izw` varchar
(
    500
) NOT NULL COMMENT '整外数据',
    `iwc` varchar
(
    500
) NOT NULL COMMENT '无创数据',
    `isk` varchar
(
    500
) NOT NULL COMMENT '皮肤数据',
    `itk` varchar
(
    500
) NOT NULL COMMENT '口腔数据',
    `notnl` varchar
(
    500
) NOT NULL COMMENT '非正常数据',
    `indate` int
(
    11
) NOT NULL COMMENT '添加日期',
    `lastdate` int
(
    11
) NOT NULL COMMENT '更新日期',
    `uip` varchar
(
    20
) NOT NULL COMMENT '用户IP',
    PRIMARY KEY
(
    `Id`
),
    UNIQUE KEY `Id`
(
    `Id`
)
    ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='表类型' AUTO_INCREMENT=780;

-- --------------------------------------------------------

--
-- 表的结构 `yumdam_dataclass`
--

CREATE TABLE IF NOT EXISTS `yumdam_dataclass`
(
    `Id` int
(
    10
) unsigned NOT NULL auto_increment COMMENT 'Id',
    `selecttime` int
(
    11
) NOT NULL COMMENT '指定日期',
    `t1` varchar
(
    600
) NOT NULL COMMENT '表的数组',
    `indate` int
(
    11
) NOT NULL COMMENT '添加日期',
    `tupdate` int
(
    11
) NOT NULL COMMENT '更新日期',
    `inip` varchar
(
    20
) NOT NULL COMMENT '添加IP',
    `ismail` int
(
    1
) NOT NULL default '1' COMMENT '1未发送，2发送',
    PRIMARY KEY
(
    `Id`
),
    UNIQUE KEY `Id`
(
    `Id`
)
    ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='表类型' AUTO_INCREMENT=266;

-- --------------------------------------------------------

--
-- 表的结构 `yumdam_datalist`
--

CREATE TABLE IF NOT EXISTS `yumdam_datalist`
(
    `Id` int
(
    11
) unsigned NOT NULL auto_increment COMMENT 'Id',
    `fdate` int
(
    11
) NOT NULL COMMENT '报表日期',
    `mId` int
(
    11
) default NULL COMMENT '消费报表者',
    `mdate` int
(
    11
) default NULL COMMENT '消费日期',
    `sendid` int
(
    11
) default NULL COMMENT '发送人',
    `sendtime` int
(
    11
) default NULL COMMENT '发送时间',
    PRIMARY KEY
(
    `Id`
),
    UNIQUE KEY `Id`
(
    `Id`
)
    ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='表类型' AUTO_INCREMENT=194;

-- --------------------------------------------------------

--
-- 表的结构 `yumdam_datalogs`
--

CREATE TABLE IF NOT EXISTS `yumdam_datalogs`
(
    `Id` int
(
    10
) unsigned NOT NULL auto_increment COMMENT 'Id',
    `showpass` varchar
(
    200
) NOT NULL COMMENT '输入的密码',
    `userinfo` text NOT NULL COMMENT '设备信息',
    `showtime` int
(
    11
) NOT NULL COMMENT '查看日期',
    `showip` varchar
(
    20
) NOT NULL COMMENT '查看IP',
    PRIMARY KEY
(
    `Id`
),
    UNIQUE KEY `Id`
(
    `Id`
)
    ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='表类型' AUTO_INCREMENT=6;

-- --------------------------------------------------------

--
-- 表的结构 `yumdam_fw`
--

CREATE TABLE IF NOT EXISTS `yumdam_fw`
(
    `Id` int
(
    11
) unsigned NOT NULL auto_increment COMMENT 'Id',
    `fdate` int
(
    11
) NOT NULL COMMENT '表索引',
    `bdjj` int
(
    11
) NOT NULL COMMENT '百度竞价',
    `bdjk` int
(
    11
) NOT NULL COMMENT '百度健康',
    `bdwm` int
(
    11
) NOT NULL COMMENT '百度网盟',
    `hsjj` int
(
    11
) NOT NULL COMMENT '360搜索',
    `sgjj` int
(
    11
) NOT NULL COMMENT 'Sogou搜索',
    `wx` int
(
    11
) NOT NULL COMMENT '微信',
    `mh` int
(
    11
) NOT NULL COMMENT '门户',
    `nf` int
(
    11
) NOT NULL COMMENT '未知来源',
    `myor` varchar
(
    400
) NOT NULL default '0' COMMENT '其它来源备注',
    `InDate` int
(
    11
) NOT NULL COMMENT '添加日期',
    `uip` varchar
(
    30
) NOT NULL COMMENT '添加IP',
    `inuser` int
(
    11
) NOT NULL COMMENT '添加者',
    PRIMARY KEY
(
    `Id`
),
    UNIQUE KEY `Id`
(
    `Id`
)
    ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='表类型' AUTO_INCREMENT=176;

-- --------------------------------------------------------

--
-- 表的结构 `yumdam_himlist`
--

CREATE TABLE IF NOT EXISTS `yumdam_himlist`
(
    `Id` int
(
    11
) unsigned NOT NULL auto_increment COMMENT 'Id',
    `title` varchar
(
    200
) NOT NULL COMMENT '标题',
    `fname` varchar
(
    200
) NOT NULL COMMENT '文件名',
    `fcont` text NOT NULL COMMENT '文件描述',
    `InDate` int
(
    11
) NOT NULL COMMENT '添加时间',
    `uip` varchar
(
    30
) NOT NULL COMMENT '添加IP',
    `inid` int
(
    11
) NOT NULL COMMENT '添加者',
    PRIMARY KEY
(
    `Id`
),
    UNIQUE KEY `Id`
(
    `Id`
)
    ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='表类型' AUTO_INCREMENT=38;

-- --------------------------------------------------------

--
-- 表的结构 `yumdam_inclass`
--

CREATE TABLE IF NOT EXISTS `yumdam_inclass`
(
    `Id` int
(
    11
) unsigned NOT NULL auto_increment COMMENT 'Id',
    `isson` int
(
    1
) NOT NULL COMMENT '是否大分类1是大类，2为子类',
    `iname` varchar
(
    40
) NOT NULL COMMENT '显示名称',
    `isdata` int
(
    1
) NOT NULL COMMENT '1为有数据，2为仅来源',
    `isshow` int
(
    1
) NOT NULL COMMENT '是否显示1为显示，2为不显示，3为删除',
    PRIMARY KEY
(
    `Id`
),
    UNIQUE KEY `Id`
(
    `Id`
)
    ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='表类型' AUTO_INCREMENT=22;

-- --------------------------------------------------------

--
-- 表的结构 `yumdam_indata`
--

CREATE TABLE IF NOT EXISTS `yumdam_indata`
(
    `Id` int
(
    11
) unsigned NOT NULL auto_increment COMMENT 'Id',
    `fdate` int
(
    11
) NOT NULL COMMENT '表索引',
    `talkall` int
(
    11
) NOT NULL COMMENT '商务通对话',
    `yestalk` int
(
    11
) NOT NULL default '0' COMMENT '网咨有效',
    `talkwap` int
(
    11
) NOT NULL COMMENT '商务通手机对话',
    `retalk1` int
(
    11
) NOT NULL COMMENT '到院重复',
    `retalk2` int
(
    11
) NOT NULL COMMENT '未到院重复',
    `notalk` int
(
    11
) NOT NULL COMMENT '无效对话',
    `issys` int
(
    11
) NOT NULL COMMENT '下单人数',
    `isfrom` int
(
    11
) NOT NULL COMMENT '到院人数',
    `isok` int
(
    11
) NOT NULL COMMENT '成交人数',
    `webip` int
(
    11
) NOT NULL COMMENT '网站访问量',
    `bqq` int
(
    11
) NOT NULL COMMENT '企业QQ对话',
    `indate` int
(
    11
) NOT NULL COMMENT '添加日期',
    `uip` varchar
(
    30
) NOT NULL COMMENT '添加IP',
    `inuser` int
(
    11
) NOT NULL COMMENT '添加者',
    PRIMARY KEY
(
    `Id`
),
    UNIQUE KEY `Id`
(
    `Id`
)
    ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='表类型' AUTO_INCREMENT=450;

-- --------------------------------------------------------

--
-- 表的结构 `yumdam_indata2`
--

CREATE TABLE IF NOT EXISTS `yumdam_indata2`
(
    `Id` int
(
    11
) unsigned NOT NULL auto_increment COMMENT 'Id',
    `fdate` int
(
    20
) NOT NULL COMMENT '日期20141222',
    `fclass` varchar
(
    5
) NOT NULL COMMENT '表类型',
    `fmoney` varchar
(
    40
) NOT NULL default '0' COMMENT '投入资金',
    `wapmoney` varchar
(
    40
) NOT NULL default '0' COMMENT '手机投入',
    `fclick` varchar
(
    40
) NOT NULL default '0' COMMENT '点击次数',
    `fshow` varchar
(
    40
) NOT NULL default '0' COMMENT '展现量',
    `selftalk` int
(
    11
) NOT NULL default '0' COMMENT '账户对话量',
    `talkwap` int
(
    11
) NOT NULL default '0' COMMENT '手机对话量',
    `hmoney` varchar
(
    40
) NOT NULL default '0' COMMENT '行业词消费',
    `bmoney` varchar
(
    40
) NOT NULL default '0' COMMENT '品牌词消费',
    `indate` int
(
    11
) NOT NULL COMMENT '添加日期',
    `uip` varchar
(
    30
) NOT NULL COMMENT '用户IP',
    `inuser` int
(
    11
) NOT NULL COMMENT '添加者',
    PRIMARY KEY
(
    `Id`
),
    UNIQUE KEY `Id`
(
    `Id`
)
    ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='表类型' AUTO_INCREMENT=2204;

-- --------------------------------------------------------

--
-- 表的结构 `yumdam_itemclass`
--

CREATE TABLE IF NOT EXISTS `yumdam_itemclass`
(
    `Id` int
(
    10
) unsigned NOT NULL auto_increment COMMENT 'Id',
    `TId` int
(
    11
) NOT NULL COMMENT '上级ID',
    `iname` varchar
(
    60
) NOT NULL COMMENT '项目名称',
    `isshow` int
(
    1
) NOT NULL default '1' COMMENT '是否显示',
    PRIMARY KEY
(
    `Id`
),
    UNIQUE KEY `Id`
(
    `Id`
)
    ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='表类型' AUTO_INCREMENT=28;

-- --------------------------------------------------------

--
-- 表的结构 `yumdam_itemcont`
--

CREATE TABLE IF NOT EXISTS `yumdam_itemcont`
(
    `Id` int
(
    10
) unsigned NOT NULL auto_increment COMMENT 'Id',
    `fdate` int
(
    11
) NOT NULL COMMENT '日期',
    `IId` int
(
    11
) NOT NULL COMMENT '项目ID',
    `ITk` int
(
    11
) NOT NULL COMMENT '对话量',
    `IIs` int
(
    11
) NOT NULL COMMENT '下单量',
    `IIf` int
(
    11
) NOT NULL COMMENT '到诊量',
    `IIo` int
(
    11
) NOT NULL COMMENT '成交量',
    `IIm` varchar
(
    40
) NOT NULL COMMENT '消费金额',
    `InDate` int
(
    11
) NOT NULL COMMENT '添加日期',
    `uip` varchar
(
    40
) NOT NULL COMMENT '添加IP',
    `inuser` int
(
    11
) NOT NULL COMMENT '添加者ID',
    PRIMARY KEY
(
    `Id`
),
    UNIQUE KEY `Id`
(
    `Id`
)
    ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='表类型' AUTO_INCREMENT=3517;

-- --------------------------------------------------------

--
-- 表的结构 `yumdam_mobilelogin`
--

CREATE TABLE IF NOT EXISTS `yumdam_mobilelogin`
(
    `Id` int
(
    11
) NOT NULL auto_increment,
    `username` varchar
(
    20
) NOT NULL,
    `ucname` varchar
(
    200
) NOT NULL COMMENT '姓名',
    `userpass` char
(
    32
) NOT NULL,
    `usergroup` int
(
    1
) NOT NULL default '2' COMMENT '角色1为超级2为普通3为管理',
    `LoginDate` int
(
    11
) default NULL COMMENT '写入时间',
    `LoginIP` varchar
(
    16
) default NULL,
    `InDate` int
(
    11
) NOT NULL COMMENT '添加时期',
    `InId` int
(
    11
) NOT NULL COMMENT '添加人ID',
    `InIP` varchar
(
    20
) NOT NULL COMMENT '添加者IP',
    `wxid` varchar
(
    200
) default NULL COMMENT '微信OPENID',
    `wxname` varchar
(
    200
) default NULL COMMENT '微信昵称',
    `IsDisplay` int
(
    1
) NOT NULL default '1' COMMENT '1为显示，2为隐藏，3为删除',
    PRIMARY KEY
(
    `Id`
)
    ) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=41;

-- --------------------------------------------------------

--
-- 表的结构 `yumdam_mobilelogs`
--

CREATE TABLE IF NOT EXISTS `yumdam_mobilelogs`
(
    `Id` int
(
    11
) NOT NULL auto_increment,
    `UId` int
(
    100
) NOT NULL COMMENT '用户ID',
    `ucont` varchar
(
    400
) NOT NULL COMMENT '动作',
    `InDate` int
(
    11
) NOT NULL COMMENT '上传时间',
    `InIp` varchar
(
    40
) NOT NULL COMMENT '上传者IP',
    `IsShow` int
(
    1
) NOT NULL default '1' COMMENT '1为显示，2为删除',
    PRIMARY KEY
(
    `Id`
)
    ) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=33;

-- --------------------------------------------------------

--
-- 表的结构 `yumdam_mobilenumber`
--

CREATE TABLE IF NOT EXISTS `yumdam_mobilenumber`
(
    `Id` int
(
    10
) unsigned NOT NULL auto_increment COMMENT 'Id',
    `mytelcode` varchar
(
    20
) NOT NULL COMMENT '手机号码',
    `nowurl` varchar
(
    800
) NOT NULL COMMENT '访问页面地址',
    `seachkey` varchar
(
    400
) NOT NULL COMMENT '搜索关键词',
    `fromsource` varchar
(
    500
) NOT NULL COMMENT '搜索引擎',
    `hardm` varchar
(
    500
) NOT NULL COMMENT '设备型号',
    `mybigcity` varchar
(
    100
) NOT NULL COMMENT '省份',
    `mycity` varchar
(
    100
) NOT NULL COMMENT '城市',
    `myinip` varchar
(
    20
) NOT NULL COMMENT '访问IP',
    `myvdate` int
(
    11
) NOT NULL COMMENT '访问日期',
    `indatadate` int
(
    11
) NOT NULL COMMENT '导入时间',
    `inuser` int
(
    11
) NOT NULL COMMENT '导入者Id',
    `ismyid` int
(
    11
) NOT NULL default '0' COMMENT '分为我的顾客',
    `ismydate` int
(
    11
) NOT NULL default '0' COMMENT '抢占时间',
    `mdate` int
(
    11
) NOT NULL default '0' COMMENT '操作日期',
    `msgdate` int
(
    11
) NOT NULL default '0' COMMENT '发送短信时间',
    `msgcont` varchar
(
    400
) NOT NULL default '0' COMMENT '发送短信内容',
    `isstate` int
(
    11
) NOT NULL default '0' COMMENT '状态1联系成功2停机3关机4空号5无法接通',
    PRIMARY KEY
(
    `Id`
),
    UNIQUE KEY `Id`
(
    `Id`
)
    ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='表类型' AUTO_INCREMENT=35146;

-- --------------------------------------------------------

--
-- 表的结构 `yumdam_mobilewd`
--

CREATE TABLE IF NOT EXISTS `yumdam_mobilewd`
(
    `Id` int
(
    10
) unsigned NOT NULL auto_increment COMMENT 'Id',
    `WeiXin` varchar
(
    20
) NOT NULL COMMENT '是否添加微信',
    `IsMine` int
(
    11
) NOT NULL COMMENT '是谁处理的',
    `InDate` int
(
    11
) NOT NULL COMMENT '处理时间',
    `St` int
(
    1
) NOT NULL COMMENT '1为添加微信',
    PRIMARY KEY
(
    `Id`
),
    UNIQUE KEY `Id`
(
    `Id`
)
    ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='表类型' AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- 表的结构 `yumdam_mybooks`
--

CREATE TABLE IF NOT EXISTS `yumdam_mybooks`
(
    `Id` int
(
    10
) unsigned NOT NULL auto_increment COMMENT 'Id',
    `fdate` int
(
    11
) NOT NULL COMMENT '日期',
    `mycont` varchar
(
    600
) NOT NULL COMMENT '留言内容',
    `indate` int
(
    11
) NOT NULL COMMENT '写入日期',
    `uip` varchar
(
    20
) NOT NULL COMMENT '用户IP',
    PRIMARY KEY
(
    `Id`
),
    UNIQUE KEY `Id`
(
    `Id`
)
    ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='表类型' AUTO_INCREMENT=2;

-- --------------------------------------------------------

--
-- 表的结构 `yumdam_mytask`
--

CREATE TABLE IF NOT EXISTS `yumdam_mytask`
(
    `Id` int
(
    11
) unsigned NOT NULL auto_increment COMMENT 'Id',
    `TaskDate` int
(
    11
) NOT NULL COMMENT '任务时间',
    `Title` varchar
(
    200
) NOT NULL COMMENT '事项内容',
    `MyCont` varchar
(
    600
) NOT NULL COMMENT '备注',
    `TaskType` int
(
    11
) NOT NULL COMMENT '提醒类型1每天,2每周3每月',
    `InDate` int
(
    11
) NOT NULL COMMENT '添加时间',
    `uip` varchar
(
    30
) NOT NULL COMMENT '添加IP',
    `inid` int
(
    11
) NOT NULL COMMENT '添加者',
    `IsDisplay` int
(
    1
) NOT NULL default '1' COMMENT '1显示2处理3删除',
    PRIMARY KEY
(
    `Id`
),
    UNIQUE KEY `Id`
(
    `Id`
)
    ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='表类型' AUTO_INCREMENT=24;

-- --------------------------------------------------------

--
-- 表的结构 `yumdam_retimecategory`
--

CREATE TABLE IF NOT EXISTS `yumdam_retimecategory`
(
    `Id` int
(
    11
) unsigned NOT NULL auto_increment COMMENT 'Id',
    `name` varchar
(
    20
) NOT NULL,
    `pid` int
(
    11
) unsigned NOT NULL,
    `px` tinyint
(
    1
) NOT NULL,
    `ppid` tinyint
(
    1
) NOT NULL,
    PRIMARY KEY
(
    `Id`
)
    ) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=27;

-- --------------------------------------------------------

--
-- 表的结构 `yumdam_retimedata`
--

CREATE TABLE IF NOT EXISTS `yumdam_retimedata`
(
    `Id` int
(
    11
) unsigned NOT NULL auto_increment,
    `datetime` int
(
    11
) unsigned default '0' COMMENT '日期',
    `xiaofei` float
(
    11,
    2
) default '0.00' COMMENT '消费',
    `duihua` int
(
    11
) default '0' COMMENT '对话',
    `zhanxian` int
(
    11
) default '0' COMMENT '展现',
    `dianji` int
(
    11
) default '0' COMMENT '点击',
    `typeid` int
(
    11
) unsigned NOT NULL COMMENT '项目ID',
    `indate` int
(
    11
) NOT NULL COMMENT '添加时间',
    `uip` varchar
(
    40
) NOT NULL,
    `inuser` int
(
    11
) NOT NULL COMMENT '填入人ID',
    PRIMARY KEY
(
    `Id`
)
    ) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=256;

-- --------------------------------------------------------

--
-- 表的结构 `yumdam_sendlogs`
--

CREATE TABLE IF NOT EXISTS `yumdam_sendlogs`
(
    `Id` int
(
    11
) NOT NULL auto_increment,
    `UId` int
(
    100
) NOT NULL COMMENT '用户ID',
    `ulist` text NOT NULL COMMENT '发送的号码',
    `ucont` text NOT NULL COMMENT '发送的内容',
    `InDate` int
(
    11
) NOT NULL COMMENT '上传时间',
    `InIp` varchar
(
    40
) NOT NULL COMMENT '上传者IP',
    PRIMARY KEY
(
    `Id`
)
    ) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=12;

-- --------------------------------------------------------

--
-- 表的结构 `yumdam_task`
--

CREATE TABLE IF NOT EXISTS `yumdam_task`
(
    `Id` int
(
    10
) unsigned NOT NULL auto_increment COMMENT 'Id',
    `ymonth` int
(
    11
) NOT NULL COMMENT '日期',
    `outm` varchar
(
    200
) NOT NULL COMMENT '产出',
    `inputm` varchar
(
    200
) NOT NULL COMMENT '投入',
    `firstcome` int
(
    11
) NOT NULL COMMENT '初诊',
    `talkm` int
(
    11
) NOT NULL COMMENT '咨询',
    `indate` int
(
    11
) NOT NULL COMMENT '添加日期',
    `tupdate` int
(
    11
) NOT NULL COMMENT '更新日期',
    `inip` varchar
(
    20
) NOT NULL COMMENT '添加IP',
    PRIMARY KEY
(
    `Id`
),
    UNIQUE KEY `Id`
(
    `Id`
),
    UNIQUE KEY `month`
(
    `ymonth`
)
    ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='表类型' AUTO_INCREMENT=13;

-- --------------------------------------------------------

--
-- 表的结构 `yumdam_tempmobilenumber`
--

CREATE TABLE IF NOT EXISTS `yumdam_tempmobilenumber`
(
    `Id` int
(
    10
) unsigned NOT NULL auto_increment COMMENT 'Id',
    `mytelcode` varchar
(
    20
) NOT NULL COMMENT '手机号码',
    `nowurl` varchar
(
    800
) NOT NULL COMMENT '访问页面地址',
    `seachkey` varchar
(
    400
) NOT NULL COMMENT '搜索关键词',
    `fromsource` varchar
(
    500
) NOT NULL COMMENT '搜索引擎',
    `hardm` varchar
(
    500
) NOT NULL COMMENT '设备型号',
    `mybigcity` varchar
(
    100
) NOT NULL COMMENT '省份',
    `mycity` varchar
(
    100
) NOT NULL COMMENT '城市',
    `myinip` varchar
(
    20
) NOT NULL COMMENT '访问IP',
    `myvdate` int
(
    11
) NOT NULL COMMENT '访问日期',
    `indatadate` int
(
    11
) NOT NULL COMMENT '导入时间',
    `inuser` int
(
    11
) NOT NULL COMMENT '导入者Id',
    PRIMARY KEY
(
    `Id`
),
    UNIQUE KEY `Id`
(
    `Id`
)
    ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='表类型' AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- 表的结构 `yumdam_wxlogin`
--

CREATE TABLE IF NOT EXISTS `yumdam_wxlogin`
(
    `Id` int
(
    11
) NOT NULL auto_increment,
    `ucname` varchar
(
    200
) NOT NULL COMMENT '姓名',
    `wxid` varchar
(
    200
) NOT NULL COMMENT '微信OPENID',
    `wxname` varchar
(
    200
) NOT NULL COMMENT '微信昵称',
    `MyGroup` int
(
    11
) NOT NULL default '1' COMMENT '1为广告，2为数据，3为数据和广告',
    `lastdate` int
(
    11
) NOT NULL default '0' COMMENT '最后查看时间',
    `lastlc` varchar
(
    40
) NOT NULL default '0' COMMENT '最后查看IP',
    `allow` int
(
    1
) NOT NULL default '1' COMMENT '1为显示，2为隐藏，3为删除',
    PRIMARY KEY
(
    `Id`
)
    ) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=10;

-- --------------------------------------------------------

--
-- 表的结构 `yum_dataclass`
--

CREATE TABLE IF NOT EXISTS `yum_dataclass`
(
    `Id` int
(
    10
) unsigned NOT NULL auto_increment COMMENT 'Id',
    `tId` int
(
    11
) NOT NULL COMMENT '上级',
    `cname` varchar
(
    40
) NOT NULL COMMENT '类型名',
    `isshow` int
(
    1
) NOT NULL default '1' COMMENT '是否生效',
    PRIMARY KEY
(
    `Id`
),
    UNIQUE KEY `Id`
(
    `Id`
)
    ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='表类型' AUTO_INCREMENT=15;

-- --------------------------------------------------------

--
-- 表的结构 `yum_indata`
--

CREATE TABLE IF NOT EXISTS `yum_indata`
(
    `Id` int
(
    11
) unsigned NOT NULL auto_increment COMMENT 'Id',
    `fdate` int
(
    11
) NOT NULL COMMENT '表索引',
    `talkall` int
(
    11
) NOT NULL COMMENT '商务通对话',
    `yestalk` int
(
    11
) NOT NULL default '0' COMMENT '网咨有效',
    `talkwap` int
(
    11
) NOT NULL COMMENT '商务通手机对话',
    `retalk1` int
(
    11
) NOT NULL COMMENT '到院重复',
    `retalk2` int
(
    11
) NOT NULL COMMENT '未到院重复',
    `notalk` int
(
    11
) NOT NULL COMMENT '无效对话',
    `issys` int
(
    11
) NOT NULL COMMENT '下单人数',
    `isfrom` int
(
    11
) NOT NULL COMMENT '到院人数',
    `isok` int
(
    11
) NOT NULL COMMENT '成交人数',
    `webip` int
(
    11
) NOT NULL COMMENT '网站访问量',
    `bqq` int
(
    11
) NOT NULL COMMENT '企业QQ对话',
    `indate` int
(
    11
) NOT NULL COMMENT '添加日期',
    `uip` varchar
(
    30
) NOT NULL COMMENT '添加IP',
    `inuser` int
(
    11
) NOT NULL COMMENT '添加者',
    PRIMARY KEY
(
    `Id`
),
    UNIQUE KEY `Id`
(
    `Id`
)
    ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='表类型' AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- 表的结构 `yum_indata2`
--

CREATE TABLE IF NOT EXISTS `yum_indata2`
(
    `Id` int
(
    11
) unsigned NOT NULL auto_increment COMMENT 'Id',
    `fdate` int
(
    11
) NOT NULL COMMENT '日期20141222',
    `fclass` varchar
(
    5
) NOT NULL COMMENT '表类型',
    `fmoney` varchar
(
    40
) NOT NULL default '0' COMMENT '投入资金',
    `wapmoney` varchar
(
    40
) NOT NULL default '0' COMMENT '手机投入',
    `fshow` varchar
(
    40
) NOT NULL default '0',
    `wapshow` varchar
(
    40
) NOT NULL,
    `fclick` varchar
(
    40
) NOT NULL default '0' COMMENT '点击次数',
    `wapclick` varchar
(
    40
) NOT NULL,
    `ftalk` int
(
    11
) NOT NULL default '0' COMMENT '账户对话量',
    `waptalk` int
(
    11
) NOT NULL default '0' COMMENT '手机对话量',
    `hmoney` varchar
(
    40
) NOT NULL COMMENT '行业消费',
    `bmoney` varchar
(
    40
) NOT NULL COMMENT '品牌消费',
    `indate` int
(
    11
) NOT NULL COMMENT '添加日期',
    `uip` varchar
(
    30
) NOT NULL COMMENT '用户IP',
    `inuser` int
(
    11
) NOT NULL COMMENT '添加者',
    PRIMARY KEY
(
    `Id`
),
    UNIQUE KEY `Id`
(
    `Id`
)
    ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='表类型' AUTO_INCREMENT=3;

-- --------------------------------------------------------

--
-- 表的结构 `yum_itemclass`
--

CREATE TABLE IF NOT EXISTS `yum_itemclass`
(
    `Id` int
(
    10
) unsigned NOT NULL auto_increment COMMENT 'Id',
    `TId` int
(
    11
) NOT NULL COMMENT '上级ID',
    `iname` varchar
(
    60
) NOT NULL COMMENT '项目名称',
    `re` int
(
    1
) NOT NULL default '1' COMMENT '是否生成报表',
    `isshow` int
(
    1
) NOT NULL default '1' COMMENT '是否显示',
    PRIMARY KEY
(
    `Id`
),
    UNIQUE KEY `Id`
(
    `Id`
)
    ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='表类型' AUTO_INCREMENT=35;

-- --------------------------------------------------------

--
-- 表的结构 `yum_itemcont`
--

CREATE TABLE IF NOT EXISTS `yum_itemcont`
(
    `Id` int
(
    10
) unsigned NOT NULL auto_increment COMMENT 'Id',
    `fdate` int
(
    11
) NOT NULL COMMENT '日期',
    `fclass` int
(
    5
) NOT NULL COMMENT '来源渠道',
    `IId` int
(
    11
) NOT NULL COMMENT '项目ID',
    `IIm` varchar
(
    40
) NOT NULL default '' COMMENT '资金投入',
    `IIsw` int
(
    11
) NOT NULL COMMENT '展现量',
    `IIc` int
(
    11
) NOT NULL COMMENT '点击量',
    `ITk` int
(
    11
) NOT NULL COMMENT '对话量',
    `IIs` int
(
    11
) NOT NULL COMMENT '下单量',
    `IIf` int
(
    11
) NOT NULL COMMENT '到诊量',
    `IIo` int
(
    11
) NOT NULL COMMENT '成交量',
    `IIin` int
(
    11
) NOT NULL COMMENT '成交额',
    `InDate` int
(
    11
) NOT NULL COMMENT '添加日期',
    `uip` varchar
(
    40
) NOT NULL COMMENT '添加IP',
    `inuser` int
(
    11
) NOT NULL COMMENT '添加者ID',
    PRIMARY KEY
(
    `Id`
),
    UNIQUE KEY `Id`
(
    `Id`
)
    ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='表类型' AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- 表的结构 `yum_logs`
--

CREATE TABLE IF NOT EXISTS `yum_logs`
(
    `Id` int
(
    11
) NOT NULL auto_increment,
    `UId` int
(
    100
) NOT NULL COMMENT '用户ID',
    `ucont` varchar
(
    400
) NOT NULL COMMENT '动作',
    `InDate` int
(
    11
) NOT NULL COMMENT '上传时间',
    `InIp` varchar
(
    40
) NOT NULL COMMENT '上传者IP',
    `IsShow` int
(
    1
) NOT NULL default '1' COMMENT '1为显示，2为删除',
    PRIMARY KEY
(
    `Id`
)
    ) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=33;

-- --------------------------------------------------------

--
-- 表的结构 `yum_tasks`
--

CREATE TABLE IF NOT EXISTS `yum_tasks`
(
    `Id` int
(
    10
) unsigned NOT NULL auto_increment COMMENT 'Id',
    `ymonth` int
(
    11
) NOT NULL COMMENT '日期',
    `outm` varchar
(
    200
) NOT NULL COMMENT '产出',
    `inputm` varchar
(
    200
) NOT NULL COMMENT '投入',
    `firstcome` int
(
    11
) NOT NULL COMMENT '初诊',
    `talkm` int
(
    11
) NOT NULL COMMENT '咨询',
    `indate` int
(
    11
) NOT NULL COMMENT '添加日期',
    `tupdate` int
(
    11
) NOT NULL COMMENT '更新日期',
    `inip` varchar
(
    20
) NOT NULL COMMENT '添加IP',
    PRIMARY KEY
(
    `Id`
),
    UNIQUE KEY `Id`
(
    `Id`
),
    UNIQUE KEY `month`
(
    `ymonth`
)
    ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='表类型' AUTO_INCREMENT=13;

-- --------------------------------------------------------

--
-- 表的结构 `yum_users`
--

CREATE TABLE IF NOT EXISTS `yum_users`
(
    `Id` int
(
    11
) NOT NULL auto_increment,
    `username` varchar
(
    20
) NOT NULL,
    `ucname` varchar
(
    200
) NOT NULL COMMENT '姓名',
    `upass` char
(
    32
) NOT NULL,
    `uGroup` int
(
    1
) NOT NULL default '2' COMMENT '角色1为超级2为普通3为管理',
    `inDate` int
(
    11
) default NULL COMMENT '写入时间',
    `InId` int
(
    11
) NOT NULL COMMENT '添加人ID',
    `InIP` varchar
(
    20
) NOT NULL COMMENT '添加者IP',
    `IsDisplay` int
(
    1
) NOT NULL default '1' COMMENT '1为显示，2为隐藏，3为删除',
    PRIMARY KEY
(
    `Id`
)
    ) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=35;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
