<?php
echo "read and write cookies <br>";
setcookie("mycookie","value");
//函数原型：int setcookie(string name,string,value,int expire,string path,string domain,int secure)
//@echo($mycookie);
//@echo($HTTP_COOKIE_VARS['mycookie']);
echo $_COOKIE['mycookie'];