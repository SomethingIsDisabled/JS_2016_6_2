<?php
  $data=$_POST['text'];
  echo "data?:".$data."<br>";
  $file=$_FILES['file'];
  var_dump($_FILES);
  echo "<br>";
  echo "file?:";print_r($_FILES['file']);
  echo "<br>";
  var_dump(is_dir('js'));
  var_dump(is_writable('commit_file.html.bak'));
  echo "<br>";
  print_r($_POST['file']);
  echo "<br>";
  if($_FILES["file"]["error"]>0){
   echo "Error:".$_FILES["file"]["error"]."<br>";
  }else{
    echo "Upload:".$_FILES["file"]["name"]."<br>";
    echo "Type:".$_FILES["file"]["type"]."<br>";
    echo "Size:".($_FILES["file"]["size"]/1024)."KB<br>";
    echo "Stored in:".$_FILES["file"]["tmp_name"]."<br>";
  }
  function getImage($url,$filename='',$type=0){
    if($url==''){return false;}
	//if($filesname==''){$}
  }