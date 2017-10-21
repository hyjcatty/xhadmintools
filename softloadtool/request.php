<?php
header("Content-type:text/html;charset=utf-8");
#require '/php/req.php';
$install_path="_INSTALL_PATH_";
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

#$basedir="/dist";
$key=$_GET["action"];
//echo $key;
switch ($key){
case "login":
/*
REQUEST:
var map={
    action:"login",
    name:$("#Username_Input").val(),
    password:$("#Password_Input").val()
};
RESPONSE:
    $body = array(
	'key'=> '1234567',
	'admin'=> 'true'
    );
    $usrinfo=array(
	'status'=>'true',
	'auth'=>'true',
	'ret'=>$body,
	'msg'=>'login successfully'
    );
*/
	$usr = $_GET["name"];
	$usrinfo;
	$body;
	if($usr == "admin"){
		$body = array(
			'key'=> '1234567',
			'admin'=> 'true'
		);
		$usrinfo=array(
        'status'=>'true',
		'auth'=>'true',
        'ret'=>$body,
        'msg'=>'login successfully'
		);
    }else if($usr=="user"){
		$body = array(
			'key'=> '7654321',
			'admin'=> 'false'
		);
        $usrinfo=array(
        'status'=>'true',
		'auth'=>'true',
        'ret'=>$body,
        'msg'=>'login successfully'
        
		);
    }else if($usr=="黄"){
		$body = array(
			'key'=> '1111111',
            'admin'=> 'false'
		);
             $usrinfo=array(
             'status'=>'true',
			 'auth'=>'true',
			 'ret'=>$body,
             'msg'=>'login successfully',
             
     		);
    }
    else{
		$body = array(
			'key'=> '',
			'admin'=> ''
		);
        $usrinfo=array(
        'status'=>'false',
		'auth'=>'true',
	    'ret'=>$body,
        'msg'=>'no this user or password faile',
        
		);
    }
    $jsonencode = json_encode($usrinfo);
	echo $jsonencode; break;

		
case "UserInfo":
/*
REQUEST:
var body = {
	session: session
};
var map={
	action:"UserInfo",
	type:"query",
	body: body
	user:"null"
};

RESPONSE:
$user = array(
	'id'=>'7654321',
	'name'=>'黄',
	'admin'=>'false',
	'city'=>("上海")
);
$retval=array(
	'status'=>$retstatus,
	'auth'=>'true',
	'msg'=>'',
	'ret'=>($user)
);
*/
	$body= $_GET['body'];
	$session = $body['session'];
    $user=null;
	$userauth=null;
	$webauth=null;
    if($session == "1234567"){
		$webauth=array(
			'UserManage' => 'true',
			'ParaManage' => 'true',
			'InstControl' => 'true',
			'PGManage' => 'true',
			'ProjManage' => 'true',
			'MPManage' => 'true',
			'DevManage' => 'true',
			'KeyManage' => 'true',
			'KeyAuth' => 'true',
			'KeyHistory' => 'true',
			'MPMonitor' => 'true',
			'MPStaticMonitorTable' => 'true',
			'WarningCheck' => 'true',
			'WarningHandle' => 'true',
			'InstConf' => 'true',
			'InstRead' => 'true'
		);
		$userauth=array(
			'query' => 'true',
			'mod' => 'true',
			'webauth' => $webauth

		);
        $user = array(
			'id'=> '1234567',
			'name'=> 'admin',
            'level'=> '0',
            'city'=> ("上海"),
			'userauth'=>$userauth
		);
    }
    if($session == "7654321"){
		$webauth=array(
			'UserManage' => 'true',
			'ParaManage' => 'true',
			'InstControl' => 'false',
			'PGManage' => 'true',
			'ProjManage' => 'true',
			'MPManage' => 'true',
			'DevManage' => 'true',
			'KeyManage' => 'true',
			'KeyAuth' => 'true',
			'KeyHistory' => 'true',
			'MPMonitor' => 'true',
			'MPStaticMonitorTable' => 'true',
			'WarningCheck' => 'true',
			'WarningHandle' => 'true',
			'InstConf' => 'false',
			'InstRead' => 'false'
		);
		$userauth=array(
			'query' => 'true',
			'mod' => 'false',
			'webauth' => $webauth
		);
        $user = array(
            'id'=>'7654321',
            'name'=>'user',
            'level'=>'3',
            'city'=>("上海"),
			'userauth'=>$userauth
        );
    }
    if($session == "1111111"){
		$webauth=array(
			'UserManage' => 'true',
			'ParaManage' => 'true',
			'InstControl' => 'true',
			'PGManage' => 'true',
			'ProjManage' => 'true',
			'MPManage' => 'true',
			'DevManage' => 'true',
			'KeyManage' => 'true',
			'KeyAuth' => 'true',
			'KeyHistory' => 'true',
			'MPMonitor' => 'true',
			'MPStaticMonitorTable' => 'true',
			'WarningCheck' => 'true',
			'WarningHandle' => 'true',
			'InstConf' => 'true',
			'InstRead' => 'true'
		);
		$userauth=array(
			'query' => 'true',
			'mod' => 'true',
			'webauth' => $webauth

		);
		$user = array(
			'id'=>'7654321',
			'name'=>'黄',
			'level'=>'0',
			'city'=>("上海"),
			'userauth'=>$userauth
		);
	}
    $retstatus = 'true';
    if($user==null) $retstatus = 'false';
    $retval=array(
		'status'=>$retstatus,
		'auth'=>'true',
		'msg'=>'',
		'ret'=>($user)
	);
    $jsonencode = (_encode($retval));
	echo $jsonencode; 
	break;


	default:
	break;
}


?>