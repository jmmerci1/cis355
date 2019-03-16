<?php
class Database 
{
	// For CSIS server
	private static $dbName = 'jmmerci1355wi19' ; 
	private static $dbHost = '10.8.30.49' ;
	private static $dbUsername = 'jmmerci1355wi19';
	private static $dbUserPassword = 'Ludwigs1337!';
	
	private static $cont  = null;
	
	public function __construct() {
		exit('Init function is not allowed');
	}
	
	public static function connect()
	{
		
	       if ( null == self::$cont )
	       {      
		try 
		{
		  self::$cont =  new PDO( "mysql:host=".self::$dbHost.";"."dbname=".self::$dbName, self::$dbUsername, self::$dbUserPassword);  
		}
		catch(PDOException $e) 
		{
		  die($e->getMessage());  
		}
	       } 
	       return self::$cont;
		}
	
	public static function disconnect()
	{
		self::$cont = null;
	}
}
?>
