<?php


namespace app\core;


class Request
{
  public function getPath(){
    $path = $_SERVER['REQUEST_URI'] ?? '/';
  
    $position  = strpos($path,'?');
    // Hàm strpos() sẽ tìm kiếm vị trí đầu tiên của kí tự hoặc chuỗi con xuất hiện trong chuỗi nguồn. Hàm trả về số nguyên là vị trí đầu tiên xuất hiện của kí tự hoặc chuỗi con trong chuỗi nguồn, lưu ý là chuỗi sẽ bắt đầu từ vị trí 0, không phải 1.
    // http://localhost/codeCam/MVC/?id=1   sẽ trả về 13 ==  codeCam/MVC/?
    // http://localhost/codeCam/MVC/        sẽ trả về false
    

    if($position === false){
      return $path;
    }
    return substr($path , 0 , $position); // /codeCam/MVC/
  } 
  public function getMethod(){
      return strtolower($_SERVER['REQUEST_METHOD']);
  }
}