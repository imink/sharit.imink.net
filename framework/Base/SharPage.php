<?php
/**
 * @version 1.0
 * Last modified by __NAME__ on __TIME__
 * 
 */
class SharPage
{
	public $title = SHARIT_NAME;

	public $customCSSFiles = array();
	public $customCSS = array();

	public $customScriptFiles = array('POS_HEAD'=>array(),'POS_BEGIN'=>array(),'POS_END'=>array());
	public $customScript = array('POS_HEAD'=>array(),'POS_BEGIN'=>array(),'POS_END'=>array());

	function __construct(){
	}

	public function CustomCSSFiles(){
		if(empty($this->customCSSFiles))
			return;
		foreach($this->customCSSFiles as $file){
			echo "<link href=\"$file\" rel=\"stylesheet\">\n";
		}
	}

	public function CustomCSS(){
		if(empty($this->customCSS))
			return;
		echo "<style>\n";
		foreach($this->customCSS as $content){
			echo "$content\n";
		}
		echo "</style>\n";
	}

	public function CustomScriptFiles($position){
		if(!$this->customScriptFiles[$position]||empty($this->customScriptFiles[$position]))
			return;
		foreach($this->customScriptFiles[$position] as $file){
			echo "<script src=\"$file\"></script>\n";
		}
	}

	public function CustomScript($position){
		if(!$this->customScript[$position]||empty($this->customScript[$position]))
			return;
		echo "<script>\n";
		foreach($this->customScript[$position] as $content){
			echo "$content\n";
		}
		echo "</script>\n";
	}

	public function setTitle($title,$withSiteName=true){
		$this->title = $title;
		if($withSiteName){
			$this->title .=  " | " . SharIt::app()->name;
		}
	}

	public function registerCssFile($file,$inner=true){
		if($inner){
			$file = SHARIT_URL_APP.$file;
		}
		array_push($this->customCSSFiles,$file);
	}

	public function registerCss($content){
		array_push($this->customCSS,$content);
	}

	public function registerScriptFile($file,$inner=true,$position='POS_END'){
		if($inner){
			$file = SHARIT_URL_APP.$file;
		}
		if(key_exists($position,$this->customScriptFiles)){
			array_push($this->customScriptFiles[$position],$file);
		}
	}

	public function registerScript($content,$position='POS_END'){
		if(key_exists($position,$this->customScript)){
			array_push($this->customScript[$position],$content);
		}
	}

}