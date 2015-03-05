<?php
/**
 * @version 1.0
 * Last modified by __NAME__ on __TIME__
 * 
 */
class SharApp
{
	public $name = SHARIT_NAME;

	/**
	 * Construct an SharApp
	 */
	function __construct()
	{
	}

	/**
	 * Generate Url
	 * @param  mixed $url  input url, relative path (for SHARIT_URL_APP)
	 * @param  array $para 	get parameters in a array. 
	 * @return string       absolut path
	 */
	public function createUrl($url,$para=null){
		if (substr($url, -strlen("/")) !== "/"&&$url!="") {
			if (substr($url, -strlen(".php")) !== ".php") {
				$url.=".php";
			}
		}
		$url = SHARIT_URL_APP.$url;
		if($para!=null&&is_array($para)){
			$url.='?';
			$numberOfPara = count($para);
			foreach ($para as $key => $value) {
				$url.= $key."=".$value;
				$numberOfPara--;
				if($numberOfPara!=0){
					$url.="&";
				}
			}
		}
		return $url;
	}

	

	/**
	 * Get FlashMessages instance
	 * @return FlashMessages instance of FlashMessages 
	 */
	public function flashMsg(){
		SharIt::request();
		return new FlashMessages();
	}

	/**
	 * Redirect to speicific url
	 * @param  mixed $url  input url, relative path (for SHARIT_URL_APP)
	 * @param  array $para get parameters used in the URL
	 * @param  integer $time time to wait(in second)
	 * @return void
	 */
	public function redirect($url="", $para=null, $time = 0) {
		$url = $this->createUrl($url, $para);
		echo "AAAA";

		if (headers_sent()) {
			$str = "<meta http-equiv='Refresh' content='{$time};URL={$url}'>";
			if ($time != 0) {
				$str .= $msg;
			}
			exit($str);
		} else {
			if (0 === $time) {
				header("Location: " . $url);
			} else {
				header("Content-type: text/html; charset=utf-8");
				header("refresh:{$time};url={$url}");
			}
			exit();
		}
	}

	/**
	 * Layout the HTML with given Layout elements and layout template(including 
	 * a exit(), so this method should be regarded as last one in program flow)
	 * @param  array  $para _LAYOUT array
	 * @param  integer $lid  
	 *         layout ID, corresponding to the layoutx.php in the template path
	 * @return void
	 */
	public function layout($para=null,$lid=1){
		$this->render(SHARIT_PATH_TEMPLATE."/layout".$lid.".php",array('_LAYOUT'=>$para));
		exit();
	}

	/**
	 * render the given view with some parameters
	 * @param  $mixed $view view file, relative path (for SHARIT_URL_APP)
	 * @param  array $para parameters to be passed into the $view
	 * @return void
	 */
	public function render($view,$para=null){
		echo $this->loadView($view,$para);
	}

	/**
	 * load the given view with some parameters
	 * @param  $mixed $view view file, relative path (for SHARIT_URL_APP)
	 * @param  array $para parameters to be passed into the $view
	 * @return string       the view content after apply parameters
	 */
	public function loadView($view,$para=null){
		if($para!=NULL&&is_array($para)){
			foreach ($para as $key => $value) {
				$$key = $value;
			}
		}
		ob_start();
        include( SHARIT_PATH_APP .'/'. $view);
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
	}

}