<?php


namespace app\core\form;

use app\models\Model;


class Form
{
    public  static  function  begin($action , $method)
    {
        echo  printf('<form action="%s" method="%s">', $action, $method);
        return  new Form();
    }
    public static  function end()
    {
        echo "</form>";
    }
    public function field(Model $model,$attribuite)
    {
        return new Field($model,$attribuite);
    }
}