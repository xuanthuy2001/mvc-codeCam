<?php


namespace app\core;


class Request
{
  public function getPath(){
    // mục đích phương thức này là lấy ra đường dẫn khởi nguyên  http://localhost/codeCam/MVC/?id=1 =>  /codeCam/MVC/
    // b1: lấy tên đường dẫn truyền vào
    // b2: lấy ra độ dài đường dẫn nguyên vẹn  dùng hàm strpos("URL",'KÍ TỰ CUỐI') => độ dài
    // b3: lấy ra chuỗi đường dẫn nguyên vẹn  dùng hàm substr("URL",vị trí bắt đầu cắt, vị trí cuối ) => /codeCam/MVC/
    
    $path = $_SERVER['REQUEST_URI'] ?? '/'; // b1
  
    $position  = strpos($path,'?'); // b2
    // lấy ra độ dài của 
    // Hàm strpos() sẽ tìm kiếm vị trí đầu tiên của kí tự hoặc chuỗi con xuất hiện trong chuỗi nguồn. Hàm trả về số nguyên là vị trí đầu tiên xuất hiện của kí tự hoặc chuỗi con trong chuỗi nguồn, lưu ý là chuỗi sẽ bắt đầu từ vị trí 0, không phải 1.
    // http://localhost/codeCam/MVC/?id=1   sẽ trả về 13 ==  codeCam/MVC/?
    // http://localhost/codeCam/MVC/        sẽ trả về false
    if($position === false){
      return $path;
    }
    
    return substr($path , 0 , $position); //b3
  } 
  public function getMethod(){
      return strtolower($_SERVER['REQUEST_METHOD']);
  }
  public function getBody(){
    $body=[];
    if($this -> getMethod() === 'get'){
      foreach($_GET as $key => $value){
        $body[$key] = filter_input(INPUT_GET, $key , FILTER_SANITIZE_SPECIAL_CHARS);
        // filter_input (): Nhận một biến bên ngoài và lọc nó 
        // filter_input($type, $var_name, $filter, $options)
        // Trong đó: $type là nơi lấy giá trị dữ liệu để kiểm tra / biến đổi, bạn thiết lập nó bằng một trong các giá trị INPUT_GET, INPUT_POST, INPUT_COOKIE, INPUT_SERVER, INPUT_ENV. Tương ứng giá trị kiểm tra sẽ lấy từ mảng biến toàn cục $_GET,$_POST,$_COOKIE, $_SERVER, $_ENV.
        // $var_name tên biến, tên phần tử lấy để kiểm tra.
        // FILTER_SANITIZE_SPECIAL_CHARS: Xóa các ký tự đặc biệt để bảo mật 
      }
    }
    if($this -> getMethod() === 'post'){
      foreach($_POST as $key => $value){
        $body[$key] = filter_input(INPUT_POST, $key , FILTER_SANITIZE_SPECIAL_CHARS);
       }
    }
    return  $body;
  }
}