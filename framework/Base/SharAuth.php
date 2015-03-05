<?php
/**
 * @version 1.0
 * Last modified by __NAME__ on __TIME__
 * 
 */
class SharAuth
{
	public $_error;

	function __construct()
	{
		$authSession = SharIt::request()->session('auth');
		$authCookie = SharIt::request()->cookie('auth');
		if($authSession==null&&!empty($authCookie)){
			SharIt::request()->setSession('auth', SharIt::request()->cookie('auth'));
		}
	}

	public function auth($username,$password){

		$username = htmlspecialchars($username);
		$password = MD5($password);	// MD5 Encryption.
		$user = SharQueryAuth::getUserForUsername($username);
		if($user==null){
			$this->_error = "No Found User";
			return;
		}else{
			$array=SharQueryAuth::getPasswordForUsername($username);
			if($array){
				$salt=$array['salt'];
				$passwordcheck=$array['password'];
				$password.=$salt;
				$password=MD5($password);
		
				if($password!=$passwordcheck){
					$this->_error = "Password Error";
					return $user;
				}else{
					return $user;
				}
			}else{
				$this->_error = "User has not been activated";
			}
		}
	}

	public function login($username,$password,$cookie){
		$this->_error = null;
		$user = $this->auth($username,$password);
		if(isset($this->_error)){
			return false;
		}else{
			$auth = array('uid' => $user[id], 'gid' =>$user[gid], 'username'=>$user[email], 'displayname'=>$user[display_name]);
			SharIt::request()->setSession('auth',$auth);
			if($cookie)
				SharIt::request()->setCookie('auth',$auth, time()+30*24*60*60);
			return true;
		}
	}

	public function getError(){
		return $this->_error;
	}


	public function getAuth(){
		if ($this->isLogin()) {
			return SharIt::request()->session('auth');
		}
		return null;
	}

	public function __get($name) 
    {
    	if ($this->isLogin()) {
    		if (array_key_exists($name, $this->getAuth())) {
    			$auth = $this->getAuth();
            	return $auth[$name];
        	}
    	}
        return null;
    }

	public function logout(){
		SharIt::request()->unsetSession('auth');
		SharIt::request()->unsetCookie('auth');
	}

	public function isLogin(){
		return SharIt::request()->session('auth')!=null;
	}

	public function validateGroup($groups,$callbackOnTrue=null,$callbackOnFalse=null){
		if(!is_array($groups)){
			$tmp = $groups;
			$groups = array();
			array_push($groups,$tmp);
		}
		if(!is_null($this->gid)&&in_array($this->gid, $groups)){
			if($callbackOnTrue!=null)
				$callbackOnTrue();
			return true;
		}else{
			if($callbackOnFalse!=null)
				$callbackOnFalse();
			return false;
		}
	}

	public static function activation($uid){
		$user = SharQueryAccount::getUser($uid);
		return md5(md5($user[id].$user[password]).$user[salt]);
	}

}