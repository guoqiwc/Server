<?php
require '/message/ByteTools.php';
/**
 * 接收协议Message:CSRequestBroadCastMessage请求获取广播信息
 * 
 * @author 雷羽佳 2014-3-21 14:48:11
 */
class CSRequestBroadCastMessage {
	/**
	 * 消息协议号
	 */
	private $_messageId = 6000;
	
	/**
	 * 当前的广播记录内容
	 */
	public $_csBroadCastList = array ();
	
	/**
	 * 当前拥有的新闻的guid列表
	 */
	public $_csCurrentHas = array ();
	
	/**
	 * 1为是，0为否。1的时候把未生效的也发给我，0只发送已经生效的
	 */
	private $_isDebug;
	public function __construct($bin) {
		settype ( $this->_isDebug, 'integer' );
		$bt = new ByteTools ( $bin );
		$bt->setPosition ( 20 );
		$count = $bt->readShort ();
		for($i = 0; $i < $count; ++ $i) {
			$pb = new BroadCastTimeStampNetVO ();
			$pb->setIteration ( $bt->readInt () );
			$pb->setLangName ( $bt->readLongString () );
			array_push ( $this->_csBroadCastList, $pb );
		}
		$count = $bt->readShort ();
		for($i = 0; $i < $count; ++ $i) {
			$pb = new CSCurrentHasBroadNetVO ();
			$pb->setGuid ( $bt->readInt () );
			array_push ( $this->_csCurrentHas, $pb );
		}
		$this->_isDebug = $bt->readByte ();
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
	
	/**
	 * 当前拥有的新闻的guid列表
	 * 
	 * @return the $_csCurrentHas
	 *        
	 */
	public function getCsCurrentHas() {
		return $this->_csCurrentHas;
	}
	
	/**
	 * 1为是，0为否。1的时候把未生效的也发给我，0只发送已经生效的
	 * 
	 * @return the $_isDebug
	 *        
	 */
	public function getIsDebug() {
		return $this->_isDebug;
	}
}

/**
 * 发送协议Message:SCResponeBroadCastMessage服务器返回广播信息
 * 
 * @author 雷羽佳 2014-3-21 14:48:11
 */
class SCResponeBroadCastMessage {
	/**
	 * 消息协议号
	 */
	private $_messageId = 6001;
	
	/**
	 * 服务器返回的广播标签
	 */
	public $_scTimeStampList = array ();
	
	/**
	 * 服务器返回的广播内容
	 */
	public $_scBroadCastList = array ();
	
	/**
	 * 需要删除的新闻的guid列表
	 */
	public $_needDeleteList = array ();
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
			$bt->writeInt ( $this->_scTimeStampList [$i]->getIteration () );
			$bt->writeLongString ( $this->_scTimeStampList [$i]->getLangName () );
		}
		$count = count ( $this->_scBroadCastList );
		$bt->writeShort ( $count );
		for($i = 0; $i < $count; ++ $i) {
			$bt->writeInt ( $this->_scBroadCastList [$i]->getGuid () );
			$bt->writeLongString ( $this->_scBroadCastList [$i]->getLangName () );
			$bt->writeByte ( $this->_scBroadCastList [$i]->getIteration () );
			$bt->writeLongString ( $this->_scBroadCastList [$i]->getTitle () );
			$bt->writeLongString ( $this->_scBroadCastList [$i]->getDate () );
			$bt->writeLongString ( $this->_scBroadCastList [$i]->getImageUrl () );
			$bt->writeShort ( $this->_scBroadCastList [$i]->getImageWidth () );
			$bt->writeShort ( $this->_scBroadCastList [$i]->getImageHeight () );
			$bt->writeLongString ( $this->_scBroadCastList [$i]->getContext () );
			$bt->writeLongString ( $this->_scBroadCastList [$i]->getLink () );
		}
		$count = count ( $this->_needDeleteList );
		$bt->writeShort ( $count );
		for($i = 0; $i < $count; ++ $i) {
			$bt->writeInt ( $this->_needDeleteList [$i]->getGuid () );
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
	
	/**
	 * 需要删除的新闻的guid列表
	 * 
	 * @return the $_needDeleteList
	 *        
	 */
	public function setNeedDeleteList($_needDeleteList) {
		$this->_needDeleteList = $_needDeleteList;
	}
}

/**
 * 接收协议Message:CSErrorRequestMessage软件报错的错误信息
 * 
 * @author 雷羽佳 2014-3-21 14:48:11
 */
class CSErrorRequestMessage {
	/**
	 * 消息协议号
	 */
	private $_messageId = 2000;
	
	/**
	 * 当前本地时间
	 */
	private $_timeStamp;
	
	/**
	 * 用户mac地址
	 */
	private $_macId;
	
	/**
	 * 用户操作系统
	 */
	private $_OSName;
	
	/**
	 * 当前软件版本号
	 */
	private $_version;
	
	/**
	 * 错误信息内容
	 */
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
 * @author 雷羽佳 2014-3-21 14:48:11
 */
class CSRequestLoadingPageMessage {
	/**
	 * 消息协议号
	 */
	private $_messageId = 4000;
	
	/**
	 * 当前拥有的语言库
	 */
	public $_csLangList = array ();
	public function __construct($bin) {
		$bt = new ByteTools ( $bin );
		$bt->setPosition ( 20 );
		$count = $bt->readShort ();
		for($i = 0; $i < $count; ++ $i) {
			$pb = new LangNameNetVO ();
			$pb->setLangName ( $bt->readLongString () );
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
 * @author 雷羽佳 2014-3-21 14:48:11
 */
class SCResponeLoadingPageMessage {
	/**
	 * 消息协议号
	 */
	private $_messageId = 4001;
	
	/**
	 * 当前拥有的语言库
	 */
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
			$bt->writeLongString ( $this->_scLangList [$i]->getLangContent () );
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
 * @author 雷羽佳 2014-3-21 14:48:11
 */
class CSLoginRequestMessage {
	/**
	 * 消息协议号
	 */
	private $_messageId = 1000;
	
	/**
	 * 用户操作系统
	 */
	private $_OSName;
	
	/**
	 * 当前软件版本号
	 */
	private $_version;
	
	/**
	 * 当前本地时间
	 */
	private $_timeStamp;
	
	/**
	 * 用户mac地址
	 */
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
 * 接收协议Message:CSRequestMainTitleMessage客户端请求获得主窗体标题的每日一句语言库
 * 
 * @author 雷羽佳 2014-3-21 14:48:11
 */
class CSRequestMainTitleMessage {
	/**
	 * 消息协议号
	 */
	private $_messageId = 3000;
	
	/**
	 * 当前拥有的语言库
	 */
	public $_csLangList = array ();
	public function __construct($bin) {
		$bt = new ByteTools ( $bin );
		$bt->setPosition ( 20 );
		$count = $bt->readShort ();
		for($i = 0; $i < $count; ++ $i) {
			$pb = new LangNameNetVO ();
			$pb->setLangName ( $bt->readLongString () );
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
 * 发送协议Message:SCResponeMainTitleMessage服务器发送给客户端主窗体标题的每日一句语言库
 * 
 * @author 雷羽佳 2014-3-21 14:48:11
 */
class SCResponeMainTitleMessage {
	/**
	 * 消息协议号
	 */
	private $_messageId = 3001;
	
	/**
	 * 当前拥有的语言库
	 */
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
			$bt->writeLongString ( $this->_scLangList [$i]->getLangContent () );
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
 * 接收协议Message:CSUserBehaviorRequestMessage全部用户行为的采集发送
 * 
 * @author 雷羽佳 2014-3-21 14:48:11
 */
class CSUserBehaviorRequestMessage {
	/**
	 * 消息协议号
	 */
	private $_messageId = 5000;
	
	/**
	 * 总体界面和状态功能性行为采集
	 */
	public $_durationList = array ();
	
	/**
	 * 主界面用户行为采集
	 */
	public $_mainWindowList = array ();
	
	/**
	 * 悬浮窗用户行为采集
	 */
	public $_suspensionWindowList = array ();
	
	/**
	 * 设置面板用户行为采集
	 */
	public $_settingWindowList = array ();
	
	/**
	 * 关于面板用户行为采集
	 */
	public $_aboutWindowList = array ();
	
	/**
	 * 帮助页面用户行为采集
	 */
	public $_helpWindowList = array ();
	
	/**
	 * 网页截图窗体用户行为采集
	 */
	public $_webshotWindowList = array ();
	
	/**
	 * 网页截图用户行为采集
	 */
	public $_webshotList = array ();
	
	/**
	 * 新闻广播窗口用户行为采集,打开了哪个guid新闻对应的网页了
	 */
	public $_broadCastList = array ();
	
	/**
	 * 用户mac地址
	 */
	private $_macId;
	
	/**
	 * 本次关闭的本地时间
	 */
	private $_logOffTimeStamp;
	
	/**
	 * 是否是上次退出的，0为不是上次退出（即本次退出），1为是上次退出的结果
	 */
	private $_isPrevious;
	public function __construct($bin) {
		settype ( $this->_macId, 'string' );
		settype ( $this->_logOffTimeStamp, 'string' );
		settype ( $this->_isPrevious, 'integer' );
		$bt = new ByteTools ( $bin );
		$bt->setPosition ( 20 );
		$count = $bt->readShort ();
		for($i = 0; $i < $count; ++ $i) {
			$pb = new DurationNetVO ();
			$pb->setType ( $bt->readShort () );
			$pb->setDuration ( $bt->readInt () );
			$pb->setTimeStamp ( $bt->readLongString () );
			array_push ( $this->_durationList, $pb );
		}
		$count = $bt->readShort ();
		for($i = 0; $i < $count; ++ $i) {
			$pb = new MainWindowNetVO ();
			$pb->setType ( $bt->readShort () );
			$pb->setTimeStamp ( $bt->readLongString () );
			array_push ( $this->_mainWindowList, $pb );
		}
		$count = $bt->readShort ();
		for($i = 0; $i < $count; ++ $i) {
			$pb = new SuspensionWindowNetVO ();
			$pb->setType ( $bt->readShort () );
			$pb->setTimeStamp ( $bt->readLongString () );
			array_push ( $this->_suspensionWindowList, $pb );
		}
		$count = $bt->readShort ();
		for($i = 0; $i < $count; ++ $i) {
			$pb = new SettingWindowNetVO ();
			$pb->setLaunchAfterBoot ( $bt->readByte () );
			$pb->setDefaultPath ( $bt->readLongString () );
			$pb->setColorType ( $bt->readByte () );
			$pb->setLanguage ( $bt->readLongString () );
			$pb->setLoadOverTime ( $bt->readInt () );
			$pb->setLoadRefreshTime ( $bt->readInt () );
			$pb->setColorBeeLevel ( $bt->readShort () );
			$pb->setColorBeeSize ( $bt->readShort () );
			$pb->setPaletteHueLevel ( $bt->readShort () );
			$pb->setPaletteSaturationLevel ( $bt->readShort () );
			$pb->setPaletteBrightnessLevel ( $bt->readShort () );
			$pb->setTimeStamp ( $bt->readLongString () );
			$pb->setIsChangedDefaultPath ( $bt->readByte () );
			array_push ( $this->_settingWindowList, $pb );
		}
		$count = $bt->readShort ();
		for($i = 0; $i < $count; ++ $i) {
			$pb = new AboutWindowNetVO ();
			$pb->setType ( $bt->readShort () );
			$pb->setState ( $bt->readByte () );
			$pb->setTimeStamp ( $bt->readLongString () );
			array_push ( $this->_aboutWindowList, $pb );
		}
		$count = $bt->readShort ();
		for($i = 0; $i < $count; ++ $i) {
			$pb = new HelpWindowNetVO ();
			$pb->setHoldTime ( $bt->readLongString () );
			$pb->setCheckLaunch ( $bt->readByte () );
			$pb->setTimeStamp ( $bt->readLongString () );
			array_push ( $this->_helpWindowList, $pb );
		}
		$count = $bt->readShort ();
		for($i = 0; $i < $count; ++ $i) {
			$pb = new WebshotWindowNetVO ();
			$pb->setType ( $bt->readShort () );
			$pb->setTimeStamp ( $bt->readLongString () );
			array_push ( $this->_webshotWindowList, $pb );
		}
		$count = $bt->readShort ();
		for($i = 0; $i < $count; ++ $i) {
			$pb = new WebshotNetVO ();
			$pb->setMaxTaskNum ( $bt->readShort () );
			$pb->setTimeStamp ( $bt->readLongString () );
			array_push ( $this->_webshotList, $pb );
		}
		$count = $bt->readShort ();
		for($i = 0; $i < $count; ++ $i) {
			$pb = new BroadCastNetVO ();
			$pb->setBoradCastGuid ( $bt->readInt () );
			$pb->setTimeStamp ( $bt->readLongString () );
			array_push ( $this->_broadCastList, $pb );
		}
		$this->_macId = $bt->readLongString ();
		$this->_logOffTimeStamp = $bt->readLongString ();
		$this->_isPrevious = $bt->readByte ();
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
	 * 总体界面和状态功能性行为采集
	 * 
	 * @return the $_durationList
	 *        
	 */
	public function getDurationList() {
		return $this->_durationList;
	}
	
	/**
	 * 主界面用户行为采集
	 * 
	 * @return the $_mainWindowList
	 *        
	 */
	public function getMainWindowList() {
		return $this->_mainWindowList;
	}
	
	/**
	 * 悬浮窗用户行为采集
	 * 
	 * @return the $_suspensionWindowList
	 *        
	 */
	public function getSuspensionWindowList() {
		return $this->_suspensionWindowList;
	}
	
	/**
	 * 设置面板用户行为采集
	 * 
	 * @return the $_settingWindowList
	 *        
	 */
	public function getSettingWindowList() {
		return $this->_settingWindowList;
	}
	
	/**
	 * 关于面板用户行为采集
	 * 
	 * @return the $_aboutWindowList
	 *        
	 */
	public function getAboutWindowList() {
		return $this->_aboutWindowList;
	}
	
	/**
	 * 帮助页面用户行为采集
	 * 
	 * @return the $_helpWindowList
	 *        
	 */
	public function getHelpWindowList() {
		return $this->_helpWindowList;
	}
	
	/**
	 * 网页截图窗体用户行为采集
	 * 
	 * @return the $_webshotWindowList
	 *        
	 */
	public function getWebshotWindowList() {
		return $this->_webshotWindowList;
	}
	
	/**
	 * 网页截图用户行为采集
	 * 
	 * @return the $_webshotList
	 *        
	 */
	public function getWebshotList() {
		return $this->_webshotList;
	}
	
	/**
	 * 新闻广播窗口用户行为采集,打开了哪个guid新闻对应的网页了
	 * 
	 * @return the $_broadCastList
	 *        
	 */
	public function getBroadCastList() {
		return $this->_broadCastList;
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
	 * 本次关闭的本地时间
	 * 
	 * @return the $_logOffTimeStamp
	 *        
	 */
	public function getLogOffTimeStamp() {
		return $this->_logOffTimeStamp;
	}
	
	/**
	 * 是否是上次退出的，0为不是上次退出（即本次退出），1为是上次退出的结果
	 * 
	 * @return the $_isPrevious
	 *        
	 */
	public function getIsPrevious() {
		return $this->_isPrevious;
	}
}

/**
 * 发送协议Message:SCUserBehaviorRequestMessage全部用户行为的采集返回
 * 
 * @author 雷羽佳 2014-3-21 14:48:11
 */
class SCUserBehaviorRequestMessage {
	/**
	 * 消息协议号
	 */
	private $_messageId = 5001;
	
	/**
	 * 1:成功，其他为失败
	 */
	private $_isSuccess;
	public function __construct() {
		settype ( $this->_isSuccess, 'integer' );
	}
	public function build() {
		$bt = new ByteTools ();
		$bt->setPosition ( 6 );
		$bt->writeShort ( $this->_messageId );
		$bt->setPosition ( 20 );
		$bt->writeByte ( $this->_isSuccess );
		$length = strlen ( $bt->getByteArray () ) - 20;
		$bt->setPosition ( 18 );
		$bt->writeShort ( $length );
		return $bt;
	}
	
	/**
	 * 1:成功，其他为失败
	 * 
	 * @return the $_isSuccess
	 *        
	 */
	public function setIsSuccess($_isSuccess) {
		$this->_isSuccess = $_isSuccess;
	}
}

/**
 * net数据包:WebshotWindowNetVO网页截图窗体用户行为采集
 * 
 * @author 雷羽佳 2014-3-21 14:48:11
 */
class WebshotWindowNetVO {
	/**
	 * 类型
	 * 0:点击正在下载tab
	 * 1:点击已完成tab
	 * 2:点击失败tab
	 * 3:点击开始
	 * 4:点击暂停
	 * 5:删除正在下载
	 * 6:删除已完成
	 * 7:删除失败
	 * 8:刷新正在下载
	 * 9:刷新已完成
	 * 10:刷新失败
	 */
	private $_type;
	/**
	 * 当前本地时间
	 */
	private $_timeStamp;
	public function __construct() {
		settype ( $this->_type, 'integer' );
		settype ( $this->_timeStamp, 'string' );
	}
	
	/**
	 *
	 *
	 * 类型
	 * 0:点击正在下载tab
	 * 1:点击已完成tab
	 * 2:点击失败tab
	 * 3:点击开始
	 * 4:点击暂停
	 * 5:删除正在下载
	 * 6:删除已完成
	 * 7:删除失败
	 * 8:刷新正在下载
	 * 9:刷新已完成
	 * 10:刷新失败
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
	 *
	 *
	 * 类型
	 * 0:点击正在下载tab
	 * 1:点击已完成tab
	 * 2:点击失败tab
	 * 3:点击开始
	 * 4:点击暂停
	 * 5:删除正在下载
	 * 6:删除已完成
	 * 7:删除失败
	 * 8:刷新正在下载
	 * 9:刷新已完成
	 * 10:刷新失败
	 *
	 * @return the $_type
	 *        
	 */
	public function setType($_type) {
		$this->_type = $_type;
	}
	
	/**
	 * 当前本地时间
	 * 
	 * @return the $_timeStamp
	 *        
	 */
	public function setTimeStamp($_timeStamp) {
		$this->_timeStamp = $_timeStamp;
	}
}

/**
 * net数据包:AboutWindowNetVO关于面板用户行为采集
 * 
 * @author 雷羽佳 2014-3-21 14:48:11
 */
class AboutWindowNetVO {
	/**
	 * 类型
	 * 0:点击第1个人
	 * 1:点击第2个人
	 * 2:点击第3个人
	 * 3:点击第4个人
	 */
	private $_type;
	/**
	 * 0:点击头像，1:点击微博链接
	 */
	private $_state;
	/**
	 * 当前本地时间
	 */
	private $_timeStamp;
	public function __construct() {
		settype ( $this->_type, 'integer' );
		settype ( $this->_state, 'integer' );
		settype ( $this->_timeStamp, 'string' );
	}
	
	/**
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
	public function setType($_type) {
		$this->_type = $_type;
	}
	
	/**
	 * 0:点击头像，1:点击微博链接
	 * 
	 * @return the $_state
	 *        
	 */
	public function setState($_state) {
		$this->_state = $_state;
	}
	
	/**
	 * 当前本地时间
	 * 
	 * @return the $_timeStamp
	 *        
	 */
	public function setTimeStamp($_timeStamp) {
		$this->_timeStamp = $_timeStamp;
	}
}

/**
 * net数据包:CSCurrentHasBroadNetVO当前拥有的新闻的guid列表
 * 
 * @author 雷羽佳 2014-3-21 14:48:11
 */
class CSCurrentHasBroadNetVO {
	/**
	 * 用来标识词条数据唯一性的
	 */
	private $_guid;
	public function __construct() {
		settype ( $this->_guid, 'integer' );
	}
	
	/**
	 * 用来标识词条数据唯一性的
	 * 
	 * @return the $_guid
	 *        
	 */
	public function getGuid() {
		return $this->_guid;
	}
	
	/**
	 * 用来标识词条数据唯一性的
	 * 
	 * @return the $_guid
	 *        
	 */
	public function setGuid($_guid) {
		$this->_guid = $_guid;
	}
}

/**
 * net数据包:BroadCastNetVO新闻广播窗口用户行为采集,打开了哪个guid新闻对应的网页了
 * 
 * @author 雷羽佳 2014-3-21 14:48:11
 */
class BroadCastNetVO {
	/**
	 * 新闻对应的guid
	 */
	private $_boradCastGuid;
	/**
	 * 当前本地时间
	 */
	private $_timeStamp;
	public function __construct() {
		settype ( $this->_boradCastGuid, 'integer' );
		settype ( $this->_timeStamp, 'string' );
	}
	
	/**
	 * 新闻对应的guid
	 * 
	 * @return the $_boradCastGuid
	 *        
	 */
	public function getBoradCastGuid() {
		return $this->_boradCastGuid;
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
	 * 新闻对应的guid
	 * 
	 * @return the $_boradCastGuid
	 *        
	 */
	public function setBoradCastGuid($_boradCastGuid) {
		$this->_boradCastGuid = $_boradCastGuid;
	}
	
	/**
	 * 当前本地时间
	 * 
	 * @return the $_timeStamp
	 *        
	 */
	public function setTimeStamp($_timeStamp) {
		$this->_timeStamp = $_timeStamp;
	}
}

/**
 * net数据包:LangNameNetVO当前拥有的语言库
 * 
 * @author 雷羽佳 2014-3-21 14:48:11
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
 * net数据包:HelpWindowNetVO帮助页面用户行为采集
 * 
 * @author 雷羽佳 2014-3-21 14:48:11
 */
class HelpWindowNetVO {
	/**
	 * 帮助页面每页的停留时间数据包，下划线分离每次的数值
	 */
	private $_holdTime;
	/**
	 * 是否开软件的时候启动帮助窗口,1:开启,0:不开启
	 */
	private $_checkLaunch;
	/**
	 * 当前本地时间
	 */
	private $_timeStamp;
	public function __construct() {
		settype ( $this->_holdTime, 'string' );
		settype ( $this->_checkLaunch, 'integer' );
		settype ( $this->_timeStamp, 'string' );
	}
	
	/**
	 * 帮助页面每页的停留时间数据包，下划线分离每次的数值
	 * 
	 * @return the $_holdTime
	 *        
	 */
	public function getHoldTime() {
		return $this->_holdTime;
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
	 * 帮助页面每页的停留时间数据包，下划线分离每次的数值
	 * 
	 * @return the $_holdTime
	 *        
	 */
	public function setHoldTime($_holdTime) {
		$this->_holdTime = $_holdTime;
	}
	
	/**
	 * 是否开软件的时候启动帮助窗口,1:开启,0:不开启
	 * 
	 * @return the $_checkLaunch
	 *        
	 */
	public function setCheckLaunch($_checkLaunch) {
		$this->_checkLaunch = $_checkLaunch;
	}
	
	/**
	 * 当前本地时间
	 * 
	 * @return the $_timeStamp
	 *        
	 */
	public function setTimeStamp($_timeStamp) {
		$this->_timeStamp = $_timeStamp;
	}
}

/**
 * net数据包:SettingWindowNetVO设置面板用户行为采集
 * 
 * @author 雷羽佳 2014-3-21 14:48:11
 */
class SettingWindowNetVO {
	/**
	 * 开机启动，0关闭，1开启
	 */
	private $_launchAfterBoot;
	/**
	 * 默认保存路径
	 */
	private $_defaultPath;
	/**
	 * 取色类型，0:hex,1:#+hex,2:rgb
	 */
	private $_colorType;
	/**
	 * 语言
	 */
	private $_language;
	/**
	 * 加载超时时间
	 */
	private $_loadOverTime;
	/**
	 * 加载刷新时间
	 */
	private $_loadRefreshTime;
	/**
	 * 蜂巢级别
	 */
	private $_colorBeeLevel;
	/**
	 * 蜂巢尺寸
	 */
	private $_colorBeeSize;
	/**
	 * 色板色相级别
	 */
	private $_paletteHueLevel;
	/**
	 * 色板饱和度级别
	 */
	private $_paletteSaturationLevel;
	/**
	 * 色板明度级别
	 */
	private $_paletteBrightnessLevel;
	/**
	 * 当前本地时间
	 */
	private $_timeStamp;
	/**
	 * 是否改变了默认路径，0为否，1为是
	 */
	private $_isChangedDefaultPath;
	public function __construct() {
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
		settype ( $this->_isChangedDefaultPath, 'integer' );
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
	 * 是否改变了默认路径，0为否，1为是
	 * 
	 * @return the $_isChangedDefaultPath
	 *        
	 */
	public function getIsChangedDefaultPath() {
		return $this->_isChangedDefaultPath;
	}
	
	/**
	 * 开机启动，0关闭，1开启
	 * 
	 * @return the $_launchAfterBoot
	 *        
	 */
	public function setLaunchAfterBoot($_launchAfterBoot) {
		$this->_launchAfterBoot = $_launchAfterBoot;
	}
	
	/**
	 * 默认保存路径
	 * 
	 * @return the $_defaultPath
	 *        
	 */
	public function setDefaultPath($_defaultPath) {
		$this->_defaultPath = $_defaultPath;
	}
	
	/**
	 * 取色类型，0:hex,1:#+hex,2:rgb
	 * 
	 * @return the $_colorType
	 *        
	 */
	public function setColorType($_colorType) {
		$this->_colorType = $_colorType;
	}
	
	/**
	 * 语言
	 * 
	 * @return the $_language
	 *        
	 */
	public function setLanguage($_language) {
		$this->_language = $_language;
	}
	
	/**
	 * 加载超时时间
	 * 
	 * @return the $_loadOverTime
	 *        
	 */
	public function setLoadOverTime($_loadOverTime) {
		$this->_loadOverTime = $_loadOverTime;
	}
	
	/**
	 * 加载刷新时间
	 * 
	 * @return the $_loadRefreshTime
	 *        
	 */
	public function setLoadRefreshTime($_loadRefreshTime) {
		$this->_loadRefreshTime = $_loadRefreshTime;
	}
	
	/**
	 * 蜂巢级别
	 * 
	 * @return the $_colorBeeLevel
	 *        
	 */
	public function setColorBeeLevel($_colorBeeLevel) {
		$this->_colorBeeLevel = $_colorBeeLevel;
	}
	
	/**
	 * 蜂巢尺寸
	 * 
	 * @return the $_colorBeeSize
	 *        
	 */
	public function setColorBeeSize($_colorBeeSize) {
		$this->_colorBeeSize = $_colorBeeSize;
	}
	
	/**
	 * 色板色相级别
	 * 
	 * @return the $_paletteHueLevel
	 *        
	 */
	public function setPaletteHueLevel($_paletteHueLevel) {
		$this->_paletteHueLevel = $_paletteHueLevel;
	}
	
	/**
	 * 色板饱和度级别
	 * 
	 * @return the $_paletteSaturationLevel
	 *        
	 */
	public function setPaletteSaturationLevel($_paletteSaturationLevel) {
		$this->_paletteSaturationLevel = $_paletteSaturationLevel;
	}
	
	/**
	 * 色板明度级别
	 * 
	 * @return the $_paletteBrightnessLevel
	 *        
	 */
	public function setPaletteBrightnessLevel($_paletteBrightnessLevel) {
		$this->_paletteBrightnessLevel = $_paletteBrightnessLevel;
	}
	
	/**
	 * 当前本地时间
	 * 
	 * @return the $_timeStamp
	 *        
	 */
	public function setTimeStamp($_timeStamp) {
		$this->_timeStamp = $_timeStamp;
	}
	
	/**
	 * 是否改变了默认路径，0为否，1为是
	 * 
	 * @return the $_isChangedDefaultPath
	 *        
	 */
	public function setIsChangedDefaultPath($_isChangedDefaultPath) {
		$this->_isChangedDefaultPath = $_isChangedDefaultPath;
	}
}

/**
 * net数据包:BroadCastTimeStampNetVO当前的广播记录内容
 * 
 * @author 雷羽佳 2014-3-21 14:48:11
 */
class BroadCastTimeStampNetVO {
	/**
	 * 上次更新的迭代号儿
	 */
	private $_iteration;
	/**
	 * 语言名
	 */
	private $_langName;
	public function __construct() {
		settype ( $this->_iteration, 'integer' );
		settype ( $this->_langName, 'string' );
	}
	
	/**
	 * 上次更新的迭代号儿
	 * 
	 * @return the $_iteration
	 *        
	 */
	public function getIteration() {
		return $this->_iteration;
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
	 * 上次更新的迭代号儿
	 * 
	 * @return the $_iteration
	 *        
	 */
	public function setIteration($_iteration) {
		$this->_iteration = $_iteration;
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
 * @author 雷羽佳 2014-3-21 14:48:11
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
	private $_langContent;
	public function __construct() {
		settype ( $this->_langName, 'string' );
		settype ( $this->_index, 'integer' );
		settype ( $this->_langContent, 'string' );
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
	 * @return the $_langContent
	 *        
	 */
	public function getLangContent() {
		return $this->_langContent;
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
	 * @return the $_langContent
	 *        
	 */
	public function setLangContent($_langContent) {
		$this->_langContent = $_langContent;
	}
}

/**
 * net数据包:SCBroadCastContextNetVO服务器返回的广播内容
 * 
 * @author 雷羽佳 2014-3-21 14:48:11
 */
class SCBroadCastContextNetVO {
	/**
	 * 用来标识词条数据唯一性的
	 */
	private $_guid;
	/**
	 * 语言名，通过这个来分组
	 */
	private $_langName;
	/**
	 * 当前内容在所在语言里的迭代号，从1开始。同时按照时间顺序递增。
	 */
	private $_iteration;
	/**
	 * 广播标题
	 */
	private $_title;
	/**
	 * 新闻日期
	 */
	private $_date;
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
		settype ( $this->_guid, 'integer' );
		settype ( $this->_langName, 'string' );
		settype ( $this->_iteration, 'integer' );
		settype ( $this->_title, 'string' );
		settype ( $this->_date, 'string' );
		settype ( $this->_imageUrl, 'string' );
		settype ( $this->_imageWidth, 'integer' );
		settype ( $this->_imageHeight, 'integer' );
		settype ( $this->_context, 'string' );
		settype ( $this->_link, 'string' );
	}
	
	/**
	 * 用来标识词条数据唯一性的
	 * 
	 * @return the $_guid
	 *        
	 */
	public function getGuid() {
		return $this->_guid;
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
	 * 当前内容在所在语言里的迭代号，从1开始。同时按照时间顺序递增。
	 * 
	 * @return the $_iteration
	 *        
	 */
	public function getIteration() {
		return $this->_iteration;
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
	 * 新闻日期
	 * 
	 * @return the $_date
	 *        
	 */
	public function getDate() {
		return $this->_date;
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
	 * 用来标识词条数据唯一性的
	 * 
	 * @return the $_guid
	 *        
	 */
	public function setGuid($_guid) {
		$this->_guid = $_guid;
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
	 * 当前内容在所在语言里的迭代号，从1开始。同时按照时间顺序递增。
	 * 
	 * @return the $_iteration
	 *        
	 */
	public function setIteration($_iteration) {
		$this->_iteration = $_iteration;
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
	 * 新闻日期
	 * 
	 * @return the $_date
	 *        
	 */
	public function setDate($_date) {
		$this->_date = $_date;
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
 * net数据包:DurationNetVO总体界面和状态功能性行为采集
 * 
 * @author 雷羽佳 2014-3-21 14:48:11
 */
class DurationNetVO {
	/**
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
	 * 9:打开关闭新闻广播窗口
	 * 10:打开关闭软件本身
	 */
	private $_type;
	/**
	 * 开启的持续时间
	 */
	private $_duration;
	/**
	 * 打开本功能的当前本地时间
	 */
	private $_timeStamp;
	public function __construct() {
		settype ( $this->_type, 'integer' );
		settype ( $this->_duration, 'integer' );
		settype ( $this->_timeStamp, 'string' );
	}
	
	/**
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
	 * 9:打开关闭新闻广播窗口
	 * 10:打开关闭软件本身
	 *
	 * @return the $_type
	 *        
	 */
	public function getType() {
		return $this->_type;
	}
	
	/**
	 * 开启的持续时间
	 * 
	 * @return the $_duration
	 *        
	 */
	public function getDuration() {
		return $this->_duration;
	}
	
	/**
	 * 打开本功能的当前本地时间
	 * 
	 * @return the $_timeStamp
	 *        
	 */
	public function getTimeStamp() {
		return $this->_timeStamp;
	}
	
	/**
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
	 * 9:打开关闭新闻广播窗口
	 * 10:打开关闭软件本身
	 *
	 * @return the $_type
	 *        
	 */
	public function setType($_type) {
		$this->_type = $_type;
	}
	
	/**
	 * 开启的持续时间
	 * 
	 * @return the $_duration
	 *        
	 */
	public function setDuration($_duration) {
		$this->_duration = $_duration;
	}
	
	/**
	 * 打开本功能的当前本地时间
	 * 
	 * @return the $_timeStamp
	 *        
	 */
	public function setTimeStamp($_timeStamp) {
		$this->_timeStamp = $_timeStamp;
	}
}

/**
 * net数据包:SCNeedDeleteBroadNetVO需要删除的新闻的guid列表
 * 
 * @author 雷羽佳 2014-3-21 14:48:11
 */
class SCNeedDeleteBroadNetVO {
	/**
	 * 用来标识词条数据唯一性的
	 */
	private $_guid;
	public function __construct() {
		settype ( $this->_guid, 'integer' );
	}
	
	/**
	 * 用来标识词条数据唯一性的
	 * 
	 * @return the $_guid
	 *        
	 */
	public function getGuid() {
		return $this->_guid;
	}
	
	/**
	 * 用来标识词条数据唯一性的
	 * 
	 * @return the $_guid
	 *        
	 */
	public function setGuid($_guid) {
		$this->_guid = $_guid;
	}
}

/**
 * net数据包:WebshotNetVO网页截图用户行为采集
 * 
 * @author 雷羽佳 2014-3-21 14:48:11
 */
class WebshotNetVO {
	/**
	 * 最大网页截图任务数量
	 */
	private $_maxTaskNum;
	/**
	 * 当前本地时间
	 */
	private $_timeStamp;
	public function __construct() {
		settype ( $this->_maxTaskNum, 'integer' );
		settype ( $this->_timeStamp, 'string' );
	}
	
	/**
	 * 最大网页截图任务数量
	 * 
	 * @return the $_maxTaskNum
	 *        
	 */
	public function getMaxTaskNum() {
		return $this->_maxTaskNum;
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
	 * 最大网页截图任务数量
	 * 
	 * @return the $_maxTaskNum
	 *        
	 */
	public function setMaxTaskNum($_maxTaskNum) {
		$this->_maxTaskNum = $_maxTaskNum;
	}
	
	/**
	 * 当前本地时间
	 * 
	 * @return the $_timeStamp
	 *        
	 */
	public function setTimeStamp($_timeStamp) {
		$this->_timeStamp = $_timeStamp;
	}
}

/**
 * net数据包:SuspensionWindowNetVO悬浮窗用户行为采集
 * 
 * @author 雷羽佳 2014-3-21 14:48:11
 */
class SuspensionWindowNetVO {
	/**
	 * 类型
	 * 0:点击开始加载
	 * 1:点击暂停加载
	 * 2:点击截图
	 * 3:点击取色开
	 * 4:点击取色关
	 * 5:点击web色彩分析开
	 * 6:点击web色彩分析关
	 * 7:点击url监听开
	 * 8:点击url监听关
	 */
	private $_type;
	/**
	 * 当前本地时间
	 */
	private $_timeStamp;
	public function __construct() {
		settype ( $this->_type, 'integer' );
		settype ( $this->_timeStamp, 'string' );
	}
	
	/**
	 *
	 *
	 * 类型
	 * 0:点击开始加载
	 * 1:点击暂停加载
	 * 2:点击截图
	 * 3:点击取色开
	 * 4:点击取色关
	 * 5:点击web色彩分析开
	 * 6:点击web色彩分析关
	 * 7:点击url监听开
	 * 8:点击url监听关
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
	 *
	 *
	 * 类型
	 * 0:点击开始加载
	 * 1:点击暂停加载
	 * 2:点击截图
	 * 3:点击取色开
	 * 4:点击取色关
	 * 5:点击web色彩分析开
	 * 6:点击web色彩分析关
	 * 7:点击url监听开
	 * 8:点击url监听关
	 *
	 * @return the $_type
	 *        
	 */
	public function setType($_type) {
		$this->_type = $_type;
	}
	
	/**
	 * 当前本地时间
	 * 
	 * @return the $_timeStamp
	 *        
	 */
	public function setTimeStamp($_timeStamp) {
		$this->_timeStamp = $_timeStamp;
	}
}

/**
 * net数据包:MainWindowNetVO主界面用户行为采集
 * 
 * @author 雷羽佳 2014-3-21 14:48:11
 */
class MainWindowNetVO {
	/**
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
	 * 18:点击放大~
	 * 19:点击缩小~
	 * 20:点击分析(无图)~
	 * 21:点击分析(有图)~
	 * 22:点击删除~
	 * 23:点击添加颜色~
	 * 24:点击编辑颜色~
	 * 25:点击导出aco色板(无色板)~
	 * 26:点击导出aco色板(有色板)~
	 * 27:点击导出aco色板(导出完成)~
	 * 28:点击导出ase色板(无色板)~
	 * 29:点击导出ase色板(有色板)~
	 * 30:点击导出ase色板(导出完成)~
	 * 31:点击了新闻广播
	 * 32:点击了啤酒图标
	 * 33:点击了捐款大按钮
	 * 34:在分析过程中载入了图片
	 * 35:在分析过程中载入了CCB
	 */
	private $_type;
	/**
	 * 当前本地时间
	 */
	private $_timeStamp;
	public function __construct() {
		settype ( $this->_type, 'integer' );
		settype ( $this->_timeStamp, 'string' );
	}
	
	/**
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
	 * 18:点击放大~
	 * 19:点击缩小~
	 * 20:点击分析(无图)~
	 * 21:点击分析(有图)~
	 * 22:点击删除~
	 * 23:点击添加颜色~
	 * 24:点击编辑颜色~
	 * 25:点击导出aco色板(无色板)~
	 * 26:点击导出aco色板(有色板)~
	 * 27:点击导出aco色板(导出完成)~
	 * 28:点击导出ase色板(无色板)~
	 * 29:点击导出ase色板(有色板)~
	 * 30:点击导出ase色板(导出完成)~
	 * 31:点击了新闻广播
	 * 32:点击了啤酒图标
	 * 33:点击了捐款大按钮
	 * 34:在分析过程中载入了图片
	 * 35:在分析过程中载入了CCB
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
	 * 18:点击放大~
	 * 19:点击缩小~
	 * 20:点击分析(无图)~
	 * 21:点击分析(有图)~
	 * 22:点击删除~
	 * 23:点击添加颜色~
	 * 24:点击编辑颜色~
	 * 25:点击导出aco色板(无色板)~
	 * 26:点击导出aco色板(有色板)~
	 * 27:点击导出aco色板(导出完成)~
	 * 28:点击导出ase色板(无色板)~
	 * 29:点击导出ase色板(有色板)~
	 * 30:点击导出ase色板(导出完成)~
	 * 31:点击了新闻广播
	 * 32:点击了啤酒图标
	 * 33:点击了捐款大按钮
	 * 34:在分析过程中载入了图片
	 * 35:在分析过程中载入了CCB
	 *
	 * @return the $_type
	 *        
	 */
	public function setType($_type) {
		$this->_type = $_type;
	}
	
	/**
	 * 当前本地时间
	 * 
	 * @return the $_timeStamp
	 *        
	 */
	public function setTimeStamp($_timeStamp) {
		$this->_timeStamp = $_timeStamp;
	}
}

?>