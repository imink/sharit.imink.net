<?php
/**
 * @version 1.0
 * Last modified by __NAME__ on __TIME__
 * 
 */
class SharDB
{
	private static $_pdo_connect;

	private static $con;

	/**
	 * Database tabelname List
	 * @var array key is alias, value is the real table name in db;
	 */
	private static $tableNameList = array('product' => 'product', 'user'=>'user', 'bid'=>'bid', 'category'=>'category', 'order'=>'order', 
		                                  'picture'=>'picture', 'price'=>'price', 'qanda'=>'qanda', 'reply'=>'reply', 'request'=>'request', 
		                                  'meta'=>'usermeta', 'price_info'=>'view_price_info', 'product_info'=>'view_product_info', 
		                                  'user_info'=>'view_user_info', 'advertisement'=>'advertisement');
	
	const tablePrefix = SHARIT_DB_PREFIX;

	function __construct()
	{
		self::$_pdo_connect = new PDO('mysql:host='.SHARIT_DB_HOST.';dbname='.SHARIT_DB_NAME, SHARIT_DB_USERNAME, SHARIT_DB_PASSWORD);
	}

	public static function tableName($name){
		if(isset(SharDB::$tableNameList[$name])){
			return SharDB::tablePrefix.SharDB::$tableNameList[$name];
		}
		else{
			die("Not found Table named: " . $name);
		}
	}

	public static function connection(){
		if(self::$con===null){
			self::$con = mysqli_connect(SHARIT_DB_HOST,SHARIT_DB_USERNAME,SHARIT_DB_PASSWORD,SHARIT_DB_NAME);
			if (mysqli_connect_errno()){
	  			echo "Failed to connect to MySQL: " . mysqli_connect_error();
	  			die();
	  		}
		}
		return self::$con;
	}

	public static function close($con){
		mysqli_close(self::$con);
		self::$con=null;
	}

	public static function createCommand(){
		return new FluentPDO(self::$_pdo_connect);
	}

}