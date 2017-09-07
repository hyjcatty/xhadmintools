<?php
header("Content-type:text/html;charset=utf-8");
function _encode($arr)
{
  $na = array();
  foreach ( $arr as $k => $value ) {
    $na[_urlencode($k)] = _urlencode ($value);
  }
  return addcslashes(urldecode(json_encode($na)),"\r\n");
}

function _urlencode($elem)
{
  if(is_array($elem)&&(!(empty($elem)))){
    foreach($elem as $k=>$v){
      $na[_urlencode($k)] = _urlencode($v);
    }
    return $na;
  }
  if(is_array($elem)&&empty($elem)){
	  return $elem;
  }
  return urlencode($elem);
}
function getpackagefiles(){
    $path="./packages";
    $ret = array();
    if(!file_exists($path)) return $ret;
    foreach(glob($path."/*") as $afile){
        if(is_dir($afile))
        {
        } else {
            $fileinfo=array(
                'name'=>basename($afile),
                'URL'=>'./packages/'.basename($afile)
            );
            array_push($ret,$fileinfo);
        }
    }
    return $ret;
}

$key=$_GET["action"];

switch ($key){
    case "GetZipFileList":
        /*
        REQUEST:
            var map={
                action:"GetZipFileList",
                type:"query",
                user:usr.id
            };
        RESPONSE:
            $retarray = getpackagefiles();
            $retval=array(
                'status'=>'true',
                'auth'=>'true',
                'ret'=>$retarray,
                'msg'=>''
            );

        */
        $retarray = getpackagefiles();
        $retval=array(
            'status'=>'true',
            'auth'=>'true',
            'ret'=>$retarray,
            'msg'=>''
        );

        $jsonencode = _encode($retval);
        echo $jsonencode; break;
    case "NewQRCodeZip":
        /*
        REQUEST:
            var body={
            	'FACCode':"FAC#123";  //工厂代码
            	'PDCode':"G201";    //产品代码
            	'PJCode':"AQYC";    //项目代码
            	'UserCode':"SH";  //用户代码
            	'ProductType':"HCU";  //产品类型
            	'FormalFlag':"Y";   //是否正式标签
            	'ApplyNbr':"20";     //申请数量，比如20，最小1，最大99

            }
            var map={
                action:"NewQRCodeZip",
                body:body,
                type:"query",
                user:usr.id
            };
        RESPONSE:
            $retarray = getpackagefiles();
            $retval=array(
                'status'=>'true',
                'auth'=>'true',
                'ret'=>$retarray,
                'msg'=>''
            );

        */
    	$body= $_GET['body'];
    	$retval=array(
    		'status'=>'true',
    		'msg'=>'success',
    		'auth'=>'true'
    	);
        $jsonencode = _encode($retval);
    	echo $jsonencode; break;
    case "SoftwareLoadDel":

        $body= $_GET['body'];
        $retval=array(
            'status'=>'true',
            'msg'=>'success',
            'auth'=>'true'
        );
        $jsonencode = _encode($retval);
        echo $jsonencode; break;
    default:
    break;
}



?>