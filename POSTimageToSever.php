<?php



$p=$_FILES["file"];
$name = preg_replace("/[^A-Z0-9._-]/i", "_", $p["name"]);
move_uploaded_file($p["tmp_name"], $name);

$data=Array("Reply"=>"Image saved at server");
echo json_encode($data);


/*
   $file_dir = '.';
$p=$_FILES["file"]
$tmp_name = $_FILES["pictures"]["tmp_name"];

move_uploaded_file($p['tmp_name'], $file_dir.'/'.$file_array['name'])

$data=Array("Reply"=>"Image saved at server");
echo json_encode($data);

/
$p=$_FILES["file"]
$tmp_name = $_FILES["pictures"]["tmp_name"];
move_uploaded_file($tmp_name, ".");
$data=Array("Reply"=>"Image saved at server");
echo json_encode($data);
*/
?>
