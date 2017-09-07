<?php
	$id= $_REQUEST["id"];
	$upload_path="_UPLOAD_PATH_";
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
      if(is_array($elem)){
        foreach($elem as $k=>$v){
          $na[_urlencode($k)] = _urlencode($v);
        }
        return $na;
      }
      return urlencode($elem);
    }
	$num=count($_FILES['file-zh']['name']);
	for($i=0;$i<1;$i++)
	{
		  
		   		if($_FILES['file-zh']['name'][$i]!=''&&is_uploaded_file($_FILES['file-zh']['tmp_name'][$i]))
		   		{
				  $fname=$upload_path.$_FILES['file-zh']['name'][$i];
				  #echo $_FILES['file-zh']['tmp_name'][$i].":to:".$fname;
				  move_uploaded_file($_FILES['file-zh']['tmp_name'][$i],$fname);
				  $retval=array(
                  		'status'=>"true",
                  		'msg'=>$_FILES['file-zh']['name'][$i].' Upload success!'
                  );
                  $jsonencode = (_encode($retval));
                  echo $jsonencode;
				}else{
				  $retval=array(
						'status'=>"false",
						'msg'=>$_FILES['file-zh']['name'][$i].' Upload fail!'
				  );
				  $jsonencode = (_encode($retval));
				  echo $jsonencode;
				}
		   
	}
?>