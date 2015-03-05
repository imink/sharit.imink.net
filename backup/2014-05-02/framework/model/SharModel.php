<?php
/**
 * @version 1.0
 * Last modified by __NAME__ on __TIME__
 * 
 */
abstract class SharModel {
	
	abstract public function attributeNames();
	abstract public validate();
	
	public function attributeLabels()
	{
		return array();
	}
	public function setAttributes($values)
	{
		if(!is_array($values))
			return;
		$attributes=array_flip($this->attributeNames());
		foreach($values as $name=>$value)
		{
			if(isset($attributes[$name]))
				$this->$name=$value;
			elseif($safeOnly)
				$this->onUnsafeAttribute($name,$value);
		}
	}
	
	public function getAttributes($names=null)
	{
		$values=array();
		foreach($this->attributeNames() as $name)
		$values[$name]=$this->$name;
		
		if(is_array($names))
		{
			$values2=array();
			foreach($names as $name)
			$values2[$name]=isset($values[$name]) ? $values[$name] : null;
			return $values2;
		}
		else
		return $values;
	}

	public function unsetAttributes($names=null)
	{
		if($names===null)
			$names=$this->attributeNames();
		foreach($names as $name)
			$this->$name=null;
	}
}