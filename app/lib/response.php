<?php

class Response{
	
	private static $app;
	
	public static function setApp($injectedApp){

		self::$app = $injectedApp;

	}
	
	private static function printObject($obj){
		
		switch(gettype($obj))
		{
		
			case "string":
				$obj = ["message"=>$obj];
				break;
		}
		
		return json_encode($obj,JSON_PRETTY_PRINT);
	
	}
	public static function Ok($obj){
		
		self::$app->halt(200, self::printObject($obj));
	}
	
	public static function NotFound($obj){
		
		self::$app->halt(404, self::printObject($obj));
		
	}
	
	public static function BadRequest($obj){
		
		self::$app->halt(400, self::printObject($obj));
		
	}
	
	public static function InternalServerError($obj){
		
		self::$app->halt(500, self::printObject($obj));
		
	}
	
	public static function Created($obj){
		
		//self::$app->halt(201, self::printObject($obj));
		self::$app->halt(201, json_encode(["url"=>$obj], JSON_PRETTY_PRINT));
		
	}
	
	public static function NotModified($obj){

		self::$app->halt(304, self::printObject($obj));

	}
	
	public static function Unauthorized($obj){
		
		self::$app->halt(401, self::printObject($obj));
		
	}
	
	public static function Forbidden($obj){
		
		self::$app->halt(403, self::printObject($obj));
	}
	
	
	
}