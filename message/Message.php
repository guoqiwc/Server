<?php
require './util.php';
/**
 * 接收协议Message:CSRequestBroadCastMessage请求获取广播信息
 *
 * @author 雷羽佳 2014-2-24 22:19:29
 */
class CSRequestBroadCastMessage {
	// 消息协议号
	private $_messageId = 60000;
	
	// 当前的广播记录内容
	public $_csBroadCastList = array ();
	public function __construct($bin) {
		$bt = new ByteTools ( $bin );
		$bt->setPosition ( 20 );
		$count = $bt->readShort ();
		for($i = 0; $i < $count; ++ $i) {
			$pb = new BroadCastTimeStampNetVO ();
			array_push ( $this->_csBroadCastList, $pb );
		}
	}
	
	/**
	 * 消息协议号
	 *
	 * @return the $_messageId
	 *        
	 */
	public function getMessageId() {
		return $this->_messageId;
	}
	
	/**
	 * 当前的广播记录内容
	 *
	 * @return the $_csBroadCastList
	 *        
	 */
	public function getCsBroadCastList() {
		return $this->_csBroadCastList;
	}
}

/**
 * 发送协议Message:SCResponeBroadCastMessage服务器返回广播信息
 *
 * @author 雷羽佳 2014-2-24 22:19:29
 */
class SCResponeBroadCastMessage {
	// 消息协议号
	private $_messageId = 60001;
	
	// 服务器返回的广播标签
	public $_scTimeStampList = array ();
	
	// 服务器返回的广播内容
	public $_scBroadCastList = array ();
	public function __construct() {
	}
	public function build() {
		$bt = new ByteTools ();
		$bt->setPosition ( 6 );
		$bt->writeShort ( $this->_messageId );
		$bt->setPosition ( 20 );
		$count = count ( $this->_scTimeStampList );
		$bt->writeShort ( $count );
		for($i = 0; $i < $count; ++ $i) {
		}
		$count = count ( $this->_scBroadCastList );
		$bt->writeShort ( $count );
		for($i = 0; $i < $count; ++ $i) {
			$bt->writeLongString ( $this->_scBroadCastList [$i]->getLangName () );
			$bt->writeByte ( $this->_scBroadCastList [$i]->getIndex () );
			$bt->writeLongString ( $this->_scBroadCastList [$i]->getTitle () );
			$bt->writeLongString ( $this->_scBroadCastList [$i]->getImageUrl () );
			$bt->writeShort ( $this->_scBroadCastList [$i]->getImageWidth () );
			$bt->writeShort ( $this->_scBroadCastList [$i]->getImageHeight () );
			$bt->writeLongString ( $this->_scBroadCastList [$i]->getContext () );
			$bt->writeLongString ( $this->_scBroadCastList [$i]->getLink () );
		}
		$length = strlen ( $bt->getByteArray () ) - 20;
		$bt->setPosition ( 18 );
		$bt->writeShort ( $length );
		return $bt;
	}
	
	/**
	 * 服务器返回的广播标签
	 *
	 * @return the $_scTimeStampList
	 *        
	 */
	public function setScTimeStampList($_scTimeStampList) {
		$this->_scTimeStampList = $_scTimeStampList;
	}
	
	/**
	 * 服务器返回的广播内容
	 *
	 * @return the $_scBroadCastList
	 *        
	 */
	public function setScBroadCastList($_scBroadCastList) {
		$this->_scBroadCastList = $_scBroadCastList;
	}
}

/**
 * 接收协议Message:CSUserBehaviorRequestMessage总体界面和状态功能性行为采集
 *
 * @author 雷羽佳 2014-2-24 22:19:30
 */
class CSUserBehaviorRequestMessage {
	// 消息协议号
	private $_messageId = 50000;
	
	/*
	 * 类型 0:打开关闭主界面 1:打开关闭悬浮穿 2:打开关闭设置面板 3:打开关闭网页截图任务窗 4:打开关闭关于窗口 5:打开关闭帮助窗口 6:打开关闭屏幕取色 7:打开关闭网页截图色彩分析 8:打开关闭url监听
	 */
	private $_type;
	
	// 0:关闭，1:打开
	private $_state;
	
	// 当前本地时间
	private $_timeStamp;
	
	// 用户mac地址
	private $_macId;
	public function __construct($bin) {
		settype ( $this->_type, 'integer' );
		settype ( $this->_state, 'integer' );
		settype ( $this->_timeStamp, 'string' );
		settype ( $this->_macId, 'string' );
		$bt = new ByteTools ( $bin );
		$bt->setPosition ( 20 );
		$this->_type = $bt->readShort ();
		$this->_state = $bt->readByte ();
		$this->_timeStamp = $bt->readLongString ();
		$this->_macId = $bt->readLongString ();
	}
	
	/**
	 * 消息协议号
	 *
	 * @return the $_messageId
	 *        
	 */
	public function getMessageId() {
		return $this->_messageId;
	}
	
	/**
	 *
	 *
	 *
	 *
	 * 类型
	 * 0:打开关闭主界面
	 * 1:打开关闭悬浮穿
	 * 2:打开关闭设置面板
	 * 3:打开关闭网页截图任务窗
	 * 4:打开关闭关于窗口
	 * 5:打开关闭帮助窗口
	 * 6:打开关闭屏幕取色
	 * 7:打开关闭网页截图色彩分析
	 * 8:打开关闭url监听
	 *
	 * @return the $_type
	 *        
	 */
	public function getType() {
		return $this->_type;
	}
	
	/**
	 * 0:关闭，1:打开
	 *
	 * @return the $_state
	 *        
	 */
	public function getState() {
		return $this->_state;
	}
	
	/**
	 * 当前本地时间
	 *
	 * @return the $_timeStamp
	 *        
	 */
	public function getTimeStamp() {
		return $this->_timeStamp;
	}
	
	/**
	 * 用户mac地址
	 *
	 * @return the $_macId
	 *        
	 */
	public function getMacId() {
		return $this->_macId;
	}
}

/**
 * 接收协议Message:CSUserBehaviorMainWindowRequestMessage主界面用户行为采集
 *
 * @author 雷羽佳 2014-2-24 22:19:30
 */
class CSUserBehaviorMainWindowRequestMessage {
	// 消息协议号
	private $_messageId = 50002;
	
	/*
	 * 类型 0:点击打开文件~ 1:保存项目文件(无图)~ 2:保存项目文件(分析中)~ 3:保存项目文件(有图)~ 4:保存项目文件(保存成功)~ 5:保存图片快照(无图)~ 6:保存图片快照(分析中)~ 7:保存图片快照(有图)~ 8:保存图片快照(保存成功)~ 9:屏幕截图~ 10:开启屏幕取色~ 11:关闭屏幕取色~ 12:开启网页截图分析~ 13:关闭网页截图分析~ 14:开启url监听~ 15:关闭url监听~ 16:打开图片~ 17:打开项目~ 18:点击放大 19:点击缩小 20:点击分析(无图)~ 21:点击分析(有图)~ 22:点击删除 23:点击添加颜色 24:点击编辑颜色 25:点击导出aco色板(无色板)~ 26:点击导出aco色板(有色板)~ 27:点击导出aco色板(导出完成)~ 28:点击导出ase色板(无色板)~ 29:点击导出ase色板(有色板)~ 30:点击导出ase色板(导出完成)~
	 */
	private $_type;
	
	// 当前本地时间
	private $_timeStamp;
	
	// 用户mac地址
	private $_macId;
	public function __construct($bin) {
		settype ( $this->_type, 'integer' );
		settype ( $this->_timeStamp, 'string' );
		settype ( $this->_macId, 'string' );
		$bt = new ByteTools ( $bin );
		$bt->setPosition ( 20 );
		$this->_type = $bt->readShort ();
		$this->_timeStamp = $bt->readLongString ();
		$this->_macId = $bt->readLongString ();
	}
	
	/**
	 * 消息协议号
	 *
	 * @return the $_messageId
	 *        
	 */
	public function getMessageId() {
		return $this->_messageId;
	}
	
	/**
	 *
	 *
	 *
	 *
	 * 类型
	 * 0:点击打开文件~
	 * 1:保存项目文件(无图)~
	 * 2:保存项目文件(分析中)~
	 * 3:保存项目文件(有图)~
	 * 4:保存项目文件(保存成功)~
	 * 5:保存图片快照(无图)~
	 * 6:保存图片快照(分析中)~
	 * 7:保存图片快照(有图)~
	 * 8:保存图片快照(保存成功)~
	 * 9:屏幕截图~
	 * 10:开启屏幕取色~
	 * 11:关闭屏幕取色~
	 * 12:开启网页截图分析~
	 * 13:关闭网页截图分析~
	 * 14:开启url监听~
	 * 15:关闭url监听~
	 * 16:打开图片~
	 * 17:打开项目~
	 * 18:点击放大
	 * 19:点击缩小
	 * 20:点击分析(无图)~
	 * 21:点击分析(有图)~
	 * 22:点击删除
	 * 23:点击添加颜色
	 * 24:点击编辑颜色
	 * 25:点击导出aco色板(无色板)~
	 * 26:点击导出aco色板(有色板)~
	 * 27:点击导出aco色板(导出完成)~
	 * 28:点击导出ase色板(无色板)~
	 * 29:点击导出ase色板(有色板)~
	 * 30:点击导出ase色板(导出完成)~
	 *
	 * @return the $_type
	 *        
	 */
	public function getType() {
		return $this->_type;
	}
	
	/**
	 * 当前本地时间
	 *
	 * @return the $_timeStamp
	 *        
	 */
	public function getTimeStamp() {
		return $this->_timeStamp;
	}
	
	/**
	 * 用户mac地址
	 *
	 * @return the $_macId
	 *        
	 */
	public function getMacId() {
		return $this->_macId;
	}
}

/**
 * 接收协议Message:CSUserBehaviorSuspensionWindowRequestMessage悬浮窗用户行为采集
 *
 * @author 雷羽佳 2014-2-24 22:19:30
 */
class CSUserBehaviorSuspensionWindowRequestMessage {
	// 消息协议号
	private $_messageId = 50004;
	
	/*
	 * 类型 0:屏幕截图 1:开启屏幕取色 2:关闭屏幕取色 3:开启网页截图分析 4:关闭网页截图分析 5:开启url监听 6:关闭url监听
	 */
	private $_type;
	
	// 当前本地时间
	private $_timeStamp;
	
	// 用户mac地址
	private $_macId;
	public function __construct($bin) {
		settype ( $this->_type, 'integer' );
		settype ( $this->_timeStamp, 'string' );
		settype ( $this->_macId, 'string' );
		$bt = new ByteTools ( $bin );
		$bt->setPosition ( 20 );
		$this->_type = $bt->readShort ();
		$this->_timeStamp = $bt->readLongString ();
		$this->_macId = $bt->readLongString ();
	}
	
	/**
	 * 消息协议号
	 *
	 * @return the $_messageId
	 *        
	 */
	public function getMessageId() {
		return $this->_messageId;
	}
	
	/**
	 *
	 *
	 *
	 *
	 * 类型
	 * 0:屏幕截图
	 * 1:开启屏幕取色
	 * 2:关闭屏幕取色
	 * 3:开启网页截图分析
	 * 4:关闭网页截图分析
	 * 5:开启url监听
	 * 6:关闭url监听
	 *
	 * @return the $_type
	 *        
	 */
	public function getType() {
		return $this->_type;
	}
	
	/**
	 * 当前本地时间
	 *
	 * @return the $_timeStamp
	 *        
	 */
	public function getTimeStamp() {
		return $this->_timeStamp;
	}
	
	/**
	 * 用户mac地址
	 *
	 * @return the $_macId
	 *        
	 */
	public function getMacId() {
		return $this->_macId;
	}
}

/**
 * 接收协议Message:CSUserBehaviorSettingWindowRequestMessage设置面板用户行为采集
 *
 * @author 雷羽佳 2014-2-24 22:19:30
 */
class CSUserBehaviorSettingWindowRequestMessage {
	// 消息协议号
	private $_messageId = 50006;
	
	// 开机启动，0关闭，1开启
	private $_launchAfterBoot;
	
	// 默认保存路径
	private $_defaultPath;
	
	// 取色类型，0:hex,1:#+hex,2:rgb
	private $_colorType;
	
	// 语言
	private $_language;
	
	// 加载超时时间
	private $_loadOverTime;
	
	// 加载刷新时间
	private $_loadRefreshTime;
	
	// 蜂巢级别
	private $_colorBeeLevel;
	
	// 蜂巢尺寸
	private $_colorBeeSize;
	
	// 色板色相级别
	private $_paletteHueLevel;
	
	// 色板饱和度级别
	private $_paletteSaturationLevel;
	
	// 色板明度级别
	private $_paletteBrightnessLevel;
	
	// 当前本地时间
	private $_timeStamp;
	
	// 用户mac地址
	private $_macId;
	public function __construct($bin) {
		settype ( $this->_launchAfterBoot, 'integer' );
		settype ( $this->_defaultPath, 'string' );
		settype ( $this->_colorType, 'integer' );
		settype ( $this->_language, 'string' );
		settype ( $this->_loadOverTime, 'integer' );
		settype ( $this->_loadRefreshTime, 'integer' );
		settype ( $this->_colorBeeLevel, 'integer' );
		settype ( $this->_colorBeeSize, 'integer' );
		settype ( $this->_paletteHueLevel, 'integer' );
		settype ( $this->_paletteSaturationLevel, 'integer' );
		settype ( $this->_paletteBrightnessLevel, 'integer' );
		settype ( $this->_timeStamp, 'string' );
		settype ( $this->_macId, 'string' );
		$bt = new ByteTools ( $bin );
		$bt->setPosition ( 20 );
		$this->_launchAfterBoot = $bt->readByte ();
		$this->_defaultPath = $bt->readLongString ();
		$this->_colorType = $bt->readByte ();
		$this->_language = $bt->readLongString ();
		$this->_loadOverTime = $bt->readInt ();
		$this->_loadRefreshTime = $bt->readInt ();
		$this->_colorBeeLevel = $bt->readShort ();
		$this->_colorBeeSize = $bt->readShort ();
		$this->_paletteHueLevel = $bt->readShort ();
		$this->_paletteSaturationLevel = $bt->readShort ();
		$this->_paletteBrightnessLevel = $bt->readShort ();
		$this->_timeStamp = $bt->readLongString ();
		$this->_macId = $bt->readLongString ();
	}
	
	/**
	 * 消息协议号
	 *
	 * @return the $_messageId
	 *        
	 */
	public function getMessageId() {
		return $this->_messageId;
	}
	
	/**
	 * 开机启动，0关闭，1开启
	 *
	 * @return the $_launchAfterBoot
	 *        
	 */
	public function getLaunchAfterBoot() {
		return $this->_launchAfterBoot;
	}
	
	/**
	 * 默认保存路径
	 *
	 * @return the $_defaultPath
	 *        
	 */
	public function getDefaultPath() {
		return $this->_defaultPath;
	}
	
	/**
	 * 取色类型，0:hex,1:#+hex,2:rgb
	 *
	 * @return the $_colorType
	 *        
	 */
	public function getColorType() {
		return $this->_colorType;
	}
	
	/**
	 * 语言
	 *
	 * @return the $_language
	 *        
	 */
	public function getLanguage() {
		return $this->_language;
	}
	
	/**
	 * 加载超时时间
	 *
	 * @return the $_loadOverTime
	 *        
	 */
	public function getLoadOverTime() {
		return $this->_loadOverTime;
	}
	
	/**
	 * 加载刷新时间
	 *
	 * @return the $_loadRefreshTime
	 *        
	 */
	public function getLoadRefreshTime() {
		return $this->_loadRefreshTime;
	}
	
	/**
	 * 蜂巢级别
	 *
	 * @return the $_colorBeeLevel
	 *        
	 */
	public function getColorBeeLevel() {
		return $this->_colorBeeLevel;
	}
	
	/**
	 * 蜂巢尺寸
	 *
	 * @return the $_colorBeeSize
	 *        
	 */
	public function getColorBeeSize() {
		return $this->_colorBeeSize;
	}
	
	/**
	 * 色板色相级别
	 *
	 * @return the $_paletteHueLevel
	 *        
	 */
	public function getPaletteHueLevel() {
		return $this->_paletteHueLevel;
	}
	
	/**
	 * 色板饱和度级别
	 *
	 * @return the $_paletteSaturationLevel
	 *        
	 */
	public function getPaletteSaturationLevel() {
		return $this->_paletteSaturationLevel;
	}
	
	/**
	 * 色板明度级别
	 *
	 * @return the $_paletteBrightnessLevel
	 *        
	 */
	public function getPaletteBrightnessLevel() {
		return $this->_paletteBrightnessLevel;
	}
	
	/**
	 * 当前本地时间
	 *
	 * @return the $_timeStamp
	 *        
	 */
	public function getTimeStamp() {
		return $this->_timeStamp;
	}
	
	/**
	 * 用户mac地址
	 *
	 * @return the $_macId
	 *        
	 */
	public function getMacId() {
		return $this->_macId;
	}
}

/**
 * 接收协议Message:CSUserBehaviorAboutWindowRequestMessage关于窗口用户行为采集
 *
 * @author 雷羽佳 2014-2-24 22:19:30
 */
class CSUserBehaviorAboutWindowRequestMessage {
	// 消息协议号
	private $_messageId = 50008;
	
	/*
	 * 类型 0:点击第1个人 1:点击第2个人 2:点击第3个人 3:点击第4个人
	 */
	private $_type;
	
	// 0:点击头像，1:点击微博链接
	private $_state;
	
	// 当前本地时间
	private $_timeStamp;
	
	// 用户mac地址
	private $_macId;
	public function __construct($bin) {
		settype ( $this->_type, 'integer' );
		settype ( $this->_state, 'integer' );
		settype ( $this->_timeStamp, 'string' );
		settype ( $this->_macId, 'string' );
		$bt = new ByteTools ( $bin );
		$bt->setPosition ( 20 );
		$this->_type = $bt->readShort ();
		$this->_state = $bt->readByte ();
		$this->_timeStamp = $bt->readLongString ();
		$this->_macId = $bt->readLongString ();
	}
	
	/**
	 * 消息协议号
	 *
	 * @return the $_messageId
	 *        
	 */
	public function getMessageId() {
		return $this->_messageId;
	}
	
	/**
	 *
	 *
	 *
	 * 类型
	 * 0:点击第1个人
	 * 1:点击第2个人
	 * 2:点击第3个人
	 * 3:点击第4个人
	 *
	 * @return the $_type
	 *        
	 */
	public function getType() {
		return $this->_type;
	}
	
	/**
	 * 0:点击头像，1:点击微博链接
	 *
	 * @return the $_state
	 *        
	 */
	public function getState() {
		return $this->_state;
	}
	
	/**
	 * 当前本地时间
	 *
	 * @return the $_timeStamp
	 *        
	 */
	public function getTimeStamp() {
		return $this->_timeStamp;
	}
	
	/**
	 * 用户mac地址
	 *
	 * @return the $_macId
	 *        
	 */
	public function getMacId() {
		return $this->_macId;
	}
}

/**
 * 接收协议Message:CSUserBehaviorHelpWindowRequestMessage帮助窗口用户行为采集
 *
 * @author 雷羽佳 2014-2-24 22:19:30
 */
class CSUserBehaviorHelpWindowRequestMessage {
	// 消息协议号
	private $_messageId = 50010;
	
	// 停留时间数据包
	public $_holdTimeList = array ();
	
	// 是否开软件的时候启动帮助窗口,1:开启,0:不开启
	private $_checkLaunch;
	
	// 当前本地时间
	private $_timeStamp;
	
	// 用户mac地址
	private $_macId;
	public function __construct($bin) {
		settype ( $this->_checkLaunch, 'integer' );
		settype ( $this->_timeStamp, 'string' );
		settype ( $this->_macId, 'string' );
		$bt = new ByteTools ( $bin );
		$bt->setPosition ( 20 );
		$count = $bt->readShort ();
		for($i = 0; $i < $count; ++ $i) {
			$pb = new HoldTimeVO ();
			$pb->setHoldTime ( $bt->readInt () );
			array_push ( $this->_holdTimeList, $pb );
		}
		$this->_checkLaunch = $bt->readByte ();
		$this->_timeStamp = $bt->readLongString ();
		$this->_macId = $bt->readLongString ();
	}
	
	/**
	 * 消息协议号
	 *
	 * @return the $_messageId
	 *        
	 */
	public function getMessageId() {
		return $this->_messageId;
	}
	
	/**
	 * 停留时间数据包
	 *
	 * @return the $_holdTimeList
	 *        
	 */
	public function getHoldTimeList() {
		return $this->_holdTimeList;
	}
	
	/**
	 * 是否开软件的时候启动帮助窗口,1:开启,0:不开启
	 *
	 * @return the $_checkLaunch
	 *        
	 */
	public function getCheckLaunch() {
		return $this->_checkLaunch;
	}
	
	/**
	 * 当前本地时间
	 *
	 * @return the $_timeStamp
	 *        
	 */
	public function getTimeStamp() {
		return $this->_timeStamp;
	}
	
	/**
	 * 用户mac地址
	 *
	 * @return the $_macId
	 *        
	 */
	public function getMacId() {
		return $this->_macId;
	}
}

/**
 * 接收协议Message:CSErrorRequestMessage软件报错的错误信息
 *
 * @author 雷羽佳 2014-2-24 22:19:30
 */
class CSErrorRequestMessage {
	// 消息协议号
	private $_messageId = 20000;
	
	// 当前本地时间
	private $_timeStamp;
	
	// 用户mac地址
	private $_macId;
	
	// 用户操作系统
	private $_OSName;
	
	// 当前软件版本号
	private $_version;
	
	// 错误信息内容
	private $_errorMessage;
	public function __construct($bin) {
		settype ( $this->_timeStamp, 'string' );
		settype ( $this->_macId, 'string' );
		settype ( $this->_OSName, 'string' );
		settype ( $this->_version, 'string' );
		settype ( $this->_errorMessage, 'string' );
		$bt = new ByteTools ( $bin );
		$bt->setPosition ( 20 );
		$this->_timeStamp = $bt->readLongString ();
		$this->_macId = $bt->readLongString ();
		$this->_OSName = $bt->readLongString ();
		$this->_version = $bt->readLongString ();
		$this->_errorMessage = $bt->readLongString ();
	}
	
	/**
	 * 消息协议号
	 *
	 * @return the $_messageId
	 *        
	 */
	public function getMessageId() {
		return $this->_messageId;
	}
	
	/**
	 * 当前本地时间
	 *
	 * @return the $_timeStamp
	 *        
	 */
	public function getTimeStamp() {
		return $this->_timeStamp;
	}
	
	/**
	 * 用户mac地址
	 *
	 * @return the $_macId
	 *        
	 */
	public function getMacId() {
		return $this->_macId;
	}
	
	/**
	 * 用户操作系统
	 *
	 * @return the $_OSName
	 *        
	 */
	public function getOSName() {
		return $this->_OSName;
	}
	
	/**
	 * 当前软件版本号
	 *
	 * @return the $_version
	 *        
	 */
	public function getVersion() {
		return $this->_version;
	}
	
	/**
	 * 错误信息内容
	 *
	 * @return the $_errorMessage
	 *        
	 */
	public function getErrorMessage() {
		return $this->_errorMessage;
	}
}

/**
 * 接收协议Message:CSRequestLoadingPageMessage客户端请求获得加载页面的每日一句语言库
 *
 * @author 雷羽佳 2014-2-24 22:19:30
 */
class CSRequestLoadingPageMessage {
	// 消息协议号
	private $_messageId = 40000;
	
	// 当前拥有的语言库
	public $_csLangList = array ();
	public function __construct($bin) {
		$bt = new ByteTools ( $bin );
		$bt->setPosition ( 20 );
		$count = $bt->readShort ();
		for($i = 0; $i < $count; ++ $i) {
			$pb = new LangNameNetVO ();
			array_push ( $this->_csLangList, $pb );
		}
	}
	
	/**
	 * 消息协议号
	 *
	 * @return the $_messageId
	 *        
	 */
	public function getMessageId() {
		return $this->_messageId;
	}
	
	/**
	 * 当前拥有的语言库
	 *
	 * @return the $_csLangList
	 *        
	 */
	public function getCsLangList() {
		return $this->_csLangList;
	}
}

/**
 * 发送协议Message:SCResponeLoadingPageMessage服务器发送给客户端加载页面的每日一句语言库
 *
 * @author 雷羽佳 2014-2-24 22:19:30
 */
class SCResponeLoadingPageMessage {
	// 消息协议号
	private $_messageId = 40001;
	
	// 当前拥有的语言库
	public $_scLangList = array ();
	public function __construct() {
	}
	public function build() {
		$bt = new ByteTools ();
		$bt->setPosition ( 6 );
		$bt->writeShort ( $this->_messageId );
		$bt->setPosition ( 20 );
		$count = count ( $this->_scLangList );
		$bt->writeShort ( $count );
		for($i = 0; $i < $count; ++ $i) {
			$bt->writeLongString ( $this->_scLangList [$i]->getLangName () );
			$bt->writeByte ( $this->_scLangList [$i]->getIndex () );
			$bt->writeLongString ( $this->_scLangList [$i]->getLangContext () );
		}
		$length = strlen ( $bt->getByteArray () ) - 20;
		$bt->setPosition ( 18 );
		$bt->writeShort ( $length );
		return $bt;
	}
	
	/**
	 * 当前拥有的语言库
	 *
	 * @return the $_scLangList
	 *        
	 */
	public function setScLangList($_scLangList) {
		$this->_scLangList = $_scLangList;
	}
}

/**
 * 接收协议Message:CSLoginRequestMessage打开软件
 *
 * @author 雷羽佳 2014-2-24 22:19:30
 */
class CSLoginRequestMessage {
	// 消息协议号
	private $_messageId = 10000;
	
	// 用户操作系统
	private $_OSName;
	
	// 当前软件版本号
	private $_version;
	
	// 当前本地时间
	private $_timeStamp;
	
	// 用户mac地址
	private $_macId;
	public function __construct($bin) {
		settype ( $this->_OSName, 'string' );
		settype ( $this->_version, 'string' );
		settype ( $this->_timeStamp, 'string' );
		settype ( $this->_macId, 'string' );
		$bt = new ByteTools ( $bin );
		$bt->setPosition ( 20 );
		$this->_OSName = $bt->readLongString ();
		$this->_version = $bt->readLongString ();
		$this->_timeStamp = $bt->readLongString ();
		$this->_macId = $bt->readLongString ();
	}
	
	/**
	 * 消息协议号
	 *
	 * @return the $_messageId
	 *        
	 */
	public function getMessageId() {
		return $this->_messageId;
	}
	
	/**
	 * 用户操作系统
	 *
	 * @return the $_OSName
	 *        
	 */
	public function getOSName() {
		return $this->_OSName;
	}
	
	/**
	 * 当前软件版本号
	 *
	 * @return the $_version
	 *        
	 */
	public function getVersion() {
		return $this->_version;
	}
	
	/**
	 * 当前本地时间
	 *
	 * @return the $_timeStamp
	 *        
	 */
	public function getTimeStamp() {
		return $this->_timeStamp;
	}
	
	/**
	 * 用户mac地址
	 *
	 * @return the $_macId
	 *        
	 */
	public function getMacId() {
		return $this->_macId;
	}
}

/**
 * 接收协议Message:CSLogoffRequestMessage关闭软件
 *
 * @author 雷羽佳 2014-2-24 22:19:30
 */
class CSLogoffRequestMessage {
	// 消息协议号
	private $_messageId = 10002;
	
	// 当前本地时间
	private $_timeStamp;
	
	// 用户mac地址
	private $_macId;
	public function __construct($bin) {
		settype ( $this->_timeStamp, 'string' );
		settype ( $this->_macId, 'string' );
		$bt = new ByteTools ( $bin );
		$bt->setPosition ( 20 );
		$this->_timeStamp = $bt->readLongString ();
		$this->_macId = $bt->readLongString ();
	}
	
	/**
	 * 消息协议号
	 *
	 * @return the $_messageId
	 *        
	 */
	public function getMessageId() {
		return $this->_messageId;
	}
	
	/**
	 * 当前本地时间
	 *
	 * @return the $_timeStamp
	 *        
	 */
	public function getTimeStamp() {
		return $this->_timeStamp;
	}
	
	/**
	 * 用户mac地址
	 *
	 * @return the $_macId
	 *        
	 */
	public function getMacId() {
		return $this->_macId;
	}
}

/**
 * 接收协议Message:CSRequestMainTitleMessage客户端请求获得主窗体标题的每日一句语言库
 *
 * @author 雷羽佳 2014-2-24 22:19:30
 */
class CSRequestMainTitleMessage {
	// 消息协议号
	private $_messageId = 30000;
	
	// 当前拥有的语言库
	public $_scLangList = array ();
	public function __construct($bin) {
		$bt = new ByteTools ( $bin );
		$bt->setPosition ( 20 );
		$count = $bt->readShort ();
		for($i = 0; $i < $count; ++ $i) {
			$pb = new LangNameNetVO ();
			array_push ( $this->_scLangList, $pb );
		}
	}
	
	/**
	 * 消息协议号
	 *
	 * @return the $_messageId
	 *        
	 */
	public function getMessageId() {
		return $this->_messageId;
	}
	
	/**
	 * 当前拥有的语言库
	 *
	 * @return the $_scLangList
	 *        
	 */
	public function getScLangList() {
		return $this->_scLangList;
	}
}

/**
 * 发送协议Message:SCResponeMainTitleMessage服务器发送给客户端主窗体标题的每日一句语言库
 *
 * @author 雷羽佳 2014-2-24 22:19:30
 */
class SCResponeMainTitleMessage {
	// 消息协议号
	private $_messageId = 30001;
	
	// 当前拥有的语言库
	public $_scLangList = array ();
	public function __construct() {
	}
	public function build() {
		$bt = new ByteTools ();
		$bt->setPosition ( 6 );
		$bt->writeShort ( $this->_messageId );
		$bt->setPosition ( 20 );
		$count = count ( $this->_scLangList );
		$bt->writeShort ( $count );
		for($i = 0; $i < $count; ++ $i) {
			$bt->writeLongString ( $this->_scLangList [$i]->getLangName () );
			$bt->writeByte ( $this->_scLangList [$i]->getIndex () );
			$bt->writeLongString ( $this->_scLangList [$i]->getLangContext () );
		}
		$length = strlen ( $bt->getByteArray () ) - 20;
		$bt->setPosition ( 18 );
		$bt->writeShort ( $length );
		return $bt;
	}
	
	/**
	 * 当前拥有的语言库
	 *
	 * @return the $_scLangList
	 *        
	 */
	public function setScLangList($_scLangList) {
		$this->_scLangList = $_scLangList;
	}
}

/**
 * net数据包:SCBroadCastContextNetVO服务器返回的广播内容
 *
 * @author 雷羽佳 2014-2-24 22:19:29
 */
class SCBroadCastContextNetVO {
	/**
	 * 语言名，通过这个来分组
	 */
	private $_langName;
	/**
	 * 当前内容在所在语言里的索引,通过这个排序用的，以免出现顺序错误
	 */
	private $_index;
	/**
	 * 广播标题
	 */
	private $_title;
	/**
	 * 图标地址
	 */
	private $_imageUrl;
	/**
	 * 图片宽度
	 */
	private $_imageWidth;
	/**
	 * 图片高度
	 */
	private $_imageHeight;
	/**
	 * 广播内容
	 */
	private $_context;
	/**
	 * 当前的内容的超链接
	 */
	private $_link;
	public function __construct() {
		settype ( $this->_langName, 'string' );
		settype ( $this->_index, 'integer' );
		settype ( $this->_title, 'string' );
		settype ( $this->_imageUrl, 'string' );
		settype ( $this->_imageWidth, 'integer' );
		settype ( $this->_imageHeight, 'integer' );
		settype ( $this->_context, 'string' );
		settype ( $this->_link, 'string' );
	}
	
	/**
	 * 语言名，通过这个来分组
	 *
	 * @return the $_langName
	 *        
	 */
	public function getLangName() {
		return $this->_langName;
	}
	
	/**
	 * 当前内容在所在语言里的索引,通过这个排序用的，以免出现顺序错误
	 *
	 * @return the $_index
	 *        
	 */
	public function getIndex() {
		return $this->_index;
	}
	
	/**
	 * 广播标题
	 *
	 * @return the $_title
	 *        
	 */
	public function getTitle() {
		return $this->_title;
	}
	
	/**
	 * 图标地址
	 *
	 * @return the $_imageUrl
	 *        
	 */
	public function getImageUrl() {
		return $this->_imageUrl;
	}
	
	/**
	 * 图片宽度
	 *
	 * @return the $_imageWidth
	 *        
	 */
	public function getImageWidth() {
		return $this->_imageWidth;
	}
	
	/**
	 * 图片高度
	 *
	 * @return the $_imageHeight
	 *        
	 */
	public function getImageHeight() {
		return $this->_imageHeight;
	}
	
	/**
	 * 广播内容
	 *
	 * @return the $_context
	 *        
	 */
	public function getContext() {
		return $this->_context;
	}
	
	/**
	 * 当前的内容的超链接
	 *
	 * @return the $_link
	 *        
	 */
	public function getLink() {
		return $this->_link;
	}
	
	/**
	 * 语言名，通过这个来分组
	 *
	 * @return the $_langName
	 *        
	 */
	public function setLangName($_langName) {
		$this->_langName = $_langName;
	}
	
	/**
	 * 当前内容在所在语言里的索引,通过这个排序用的，以免出现顺序错误
	 *
	 * @return the $_index
	 *        
	 */
	public function setIndex($_index) {
		$this->_index = $_index;
	}
	
	/**
	 * 广播标题
	 *
	 * @return the $_title
	 *        
	 */
	public function setTitle($_title) {
		$this->_title = $_title;
	}
	
	/**
	 * 图标地址
	 *
	 * @return the $_imageUrl
	 *        
	 */
	public function setImageUrl($_imageUrl) {
		$this->_imageUrl = $_imageUrl;
	}
	
	/**
	 * 图片宽度
	 *
	 * @return the $_imageWidth
	 *        
	 */
	public function setImageWidth($_imageWidth) {
		$this->_imageWidth = $_imageWidth;
	}
	
	/**
	 * 图片高度
	 *
	 * @return the $_imageHeight
	 *        
	 */
	public function setImageHeight($_imageHeight) {
		$this->_imageHeight = $_imageHeight;
	}
	
	/**
	 * 广播内容
	 *
	 * @return the $_context
	 *        
	 */
	public function setContext($_context) {
		$this->_context = $_context;
	}
	
	/**
	 * 当前的内容的超链接
	 *
	 * @return the $_link
	 *        
	 */
	public function setLink($_link) {
		$this->_link = $_link;
	}
}

/**
 * net数据包:HoldTimeVO停留时间数据包
 *
 * @author 雷羽佳 2014-2-24 22:19:30
 */
class HoldTimeVO {
	/**
	 * 页面停留时间
	 */
	private $_holdTime;
	public function __construct() {
		settype ( $this->_holdTime, 'integer' );
	}
	
	/**
	 * 页面停留时间
	 *
	 * @return the $_holdTime
	 *        
	 */
	public function getHoldTime() {
		return $this->_holdTime;
	}
	
	/**
	 * 页面停留时间
	 *
	 * @return the $_holdTime
	 *        
	 */
	public function setHoldTime($_holdTime) {
		$this->_holdTime = $_holdTime;
	}
}

/**
 * net数据包:LangNameNetVO当前拥有的语言库
 *
 * @author 雷羽佳 2014-2-24 22:19:30
 */
class LangNameNetVO {
	/**
	 * 语言名
	 */
	private $_langName;
	public function __construct() {
		settype ( $this->_langName, 'string' );
	}
	
	/**
	 * 语言名
	 *
	 * @return the $_langName
	 *        
	 */
	public function getLangName() {
		return $this->_langName;
	}
	
	/**
	 * 语言名
	 *
	 * @return the $_langName
	 *        
	 */
	public function setLangName($_langName) {
		$this->_langName = $_langName;
	}
}

/**
 * net数据包:BroadCastTimeStampNetVO当前的广播记录内容
 *
 * @author 雷羽佳 2014-2-24 22:19:29
 */
class BroadCastTimeStampNetVO {
	/**
	 * 上次更新的时间戳
	 */
	private $_timeStamp;
	/**
	 * 语言名
	 */
	private $_langName;
	public function __construct() {
		settype ( $this->_timeStamp, 'integer' );
		settype ( $this->_langName, 'string' );
	}
	
	/**
	 * 上次更新的时间戳
	 *
	 * @return the $_timeStamp
	 *        
	 */
	public function getTimeStamp() {
		return $this->_timeStamp;
	}
	
	/**
	 * 语言名
	 *
	 * @return the $_langName
	 *        
	 */
	public function getLangName() {
		return $this->_langName;
	}
	
	/**
	 * 上次更新的时间戳
	 *
	 * @return the $_timeStamp
	 *        
	 */
	public function setTimeStamp($_timeStamp) {
		$this->_timeStamp = $_timeStamp;
	}
	
	/**
	 * 语言名
	 *
	 * @return the $_langName
	 *        
	 */
	public function setLangName($_langName) {
		$this->_langName = $_langName;
	}
}

/**
 * net数据包:LangContextNetVO当前拥有的语言库
 *
 * @author 雷羽佳 2014-2-24 22:19:30
 */
class LangContextNetVO {
	/**
	 * 语言名，通过这个来分组
	 */
	private $_langName;
	/**
	 * 当前内容在所在语言里的索引
	 */
	private $_index;
	/**
	 * 语言的内容
	 */
	private $_langContext;
	public function __construct() {
		settype ( $this->_langName, 'string' );
		settype ( $this->_index, 'integer' );
		settype ( $this->_langContext, 'string' );
	}
	
	/**
	 * 语言名，通过这个来分组
	 *
	 * @return the $_langName
	 *        
	 */
	public function getLangName() {
		return $this->_langName;
	}
	
	/**
	 * 当前内容在所在语言里的索引
	 *
	 * @return the $_index
	 *        
	 */
	public function getIndex() {
		return $this->_index;
	}
	
	/**
	 * 语言的内容
	 *
	 * @return the $_langContext
	 *        
	 */
	public function getLangContext() {
		return $this->_langContext;
	}
	
	/**
	 * 语言名，通过这个来分组
	 *
	 * @return the $_langName
	 *        
	 */
	public function setLangName($_langName) {
		$this->_langName = $_langName;
	}
	
	/**
	 * 当前内容在所在语言里的索引
	 *
	 * @return the $_index
	 *        
	 */
	public function setIndex($_index) {
		$this->_index = $_index;
	}
	
	/**
	 * 语言的内容
	 *
	 * @return the $_langContext
	 *        
	 */
	public function setLangContext($_langContext) {
		$this->_langContext = $_langContext;
	}
}

?>