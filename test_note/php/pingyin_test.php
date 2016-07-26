<?php
  $date=date('Ymd',time());
  echo $date;
  $list['cc']="sjhafdh";
  $list['cc']=intval($list['cc']);
  var_dump($list['cc']);
  echo intval('').'<br>';
  echo intval(' ').'<br>';
  echo intval('adfa ').'<br>';
  echo intval('45jafljl').'<br>';
  echo intval(' 45jafljl').'<br>';
  echo intval(' 45.33').'<br>';
  is_numeric( '123.22.444' ) or die('提供的参数不是数字');
  //is_numeric( ' abcd123' ) or die('提供的参数不是数字');
  //is_numeric( '12abcd123' ) or die('提供的参数不是数字');