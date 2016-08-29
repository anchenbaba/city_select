<?php
header('Content-type:text/html; charset=UTF-8');
$pid = isset($_REQUEST['pid'])?intval($_REQUEST['pid']):0;
$conn=mysql_connect("localhost","root","");
mysql_select_db("anchen8");
mysql_query("set names utf8");
$sql="select * from region where parent_id={$pid}";
$query=mysql_query($sql);
$type=0;
while($row=mysql_fetch_array($query)){
    $data['data'][]=$row;
    $type = $row['region_type'];
}
switch ($type) {
    case 0:
        $data['name'] = 'guojia';
        break;
    case 1:
        $data['name'] = 'sheng';
        break;
    case 2:
        $data['name'] = 'shi';
        break;
    case 3:
        $data['name'] = 'qu';
        break;
    default:
        $data['name'] = '';
        break;
}

//var_dump($data);
die(json_encode($data));