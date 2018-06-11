<?php 

class AppConfig 
{ 
  const STORAGE_URL = 'gs://parvinuo.appspot.com';

  public static function getStorageUrl() 
  { 
    return self::STORAGE_URL; 
  } 
} 

?> 