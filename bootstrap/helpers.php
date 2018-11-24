<?php


/*
* 设置数据库配置信息
*/
function get_db_config(){
  if(getenv('IS_IN_HEROKU')){
    $url = parse_url(getenv("database_url"));
    return $db_config = [
      'connection' => 'pgsql',
      'host'=>$url['host'],
      'database' => subsrc($url['path'],1),
      'username' => $url['user'],
      'password' => $url['pass']
    ];
  }else{
    return $db_config = [
      'connection' => env('DB_CONNECTION','mysql'),
      'host' => env('DB_HOST','localhost'),
      'database' => env('DB_DATABASE','sample'),
      'username' => env('DB_USERNAME','homestead'),
      'paswword' => env('DB_PASSWORD','secret')
    ];
  }
}
?>
