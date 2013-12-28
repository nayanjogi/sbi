<?php
function addVjMessage($message,$type='updated')
{
	$_SESSION['sess_MessageStack'][] =  array($type,$message);		
}
function showVjMessage()
{
	$str = '';
	if(count($_SESSION['sess_MessageStack']) > 0)
	{
		for($i=0;$i<count($_SESSION['sess_MessageStack']);$i++)
		{
			$str.="<div id='message' class='".$_SESSION['sess_MessageStack'][$i][0]."'>".$_SESSION['sess_MessageStack'][$i][1]."</div>";
		}
		unset($_SESSION['sess_MessageStack']);
		echo $str;
	}	
}

function checkLogin()
{
	if(!($_SESSION['sess_userId']>0))
	{
		addVjMessage("Please login first!",'error');
		wp_redirect(get_permalink(666)); 
		exit;
	}
}
function getVariableFromUrl($url,$var)
{
	$arrUrl = parse_url($url);
	$query = $arrUrl['query'];	
	parse_str($query,$queryVar);
	return $queryVar[$var];
}
function getRandomString($length=5) 
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
    $string = '';   
    for($i = 0; $i < $length; $i++) 
	{
    	$string .= $characters[mt_rand(0, strlen($characters))];
    }
    return strtoupper($string);
}
function createDbArr($tbl)
{
	$result = mysql_query("select * from $tbl") or die( '<br /><strong>Select Field Query: </strong>'.$sql.'<br /><br /><strong>Error: </strong>'.mysql_error());
	$arr = array();
	for($i=0;$i<mysql_num_fields($result);$i++)
	{
		$obj = mysql_fetch_field($result);
		if(isset($_REQUEST[$obj->name]))
		{
			$arr[$obj->name] = filterIn($_REQUEST[$obj->name]);
		}
	}
	return $arr;
}
function select($sql)
{
	$rs=mysql_query($sql) or die( '<br /><strong>Select Query: </strong>'.$sql.'<br /><br /><strong>Error: </strong>'.mysql_error());
	$res = array();
	if(mysql_num_rows($rs) > 0)
	{
		while($sar = mysql_fetch_array($rs))
		{
			//$sar = array_map('htmlentities',$sar);
			$res[]=$sar;
		}		
	}
	return $res;	
}
function selectAll($tbl,$where='',$order='')
{
	$sql = "SELECT * FROM $tbl";
	if($where != "")
		$sql.= " WHERE $where ";
	if($order != "")
		$sql.= " ORDER BY $order ";

	$res = select($sql);
	return $res;
}
function selectCount($tbl,$where='',$order='')
{
	$sql = "SELECT * FROM $tbl";
	if($where != "")
		$sql.= " WHERE $where ";
	if($order != "")
		$sql.= " ORDER BY $order ";
	$res = select($sql);
	//echo '<br />'.$sql;
	return count($res);
}
function isRecordExist($tbl,$where='')
{
	$sql = "SELECT * FROM $tbl";
	if($where != "")
		$sql.= " WHERE $where ";		

	$res = select($sql);	
	if(count($res)>0)
		return true;
	else
		return false;
}
function isFieldExist($tbl,$fld,$fldValue,$where='')
{
	$sql = "SELECT $fld FROM $tbl WHERE $fld = '$fldValue' ";
	if($where != "")
		$sql.= " AND $where ";
	$res = select($sql);
	
	if(count($res)>0)
		return true;
	else
		return false;
}
function selectRow($tbl,$where='',$order='')
{	
	$sql = "SELECT * FROM $tbl";
	if($where != "")
		$sql.= " WHERE $where ";
	if($order != "")
		$sql.= " ORDER BY $order ";
	//die($sql);
	$res = select($sql);
	return $res[0];
}
function selectOne($tbl,$fld,$where='',$order='')
{
	$sql = "SELECT $fld FROM $tbl";
	if($where != "")
		$sql.= " WHERE $where ";
	if($order != "")
		$sql.= " ORDER BY $order ";	
	$res = select($sql);
	return $res[0][$fld];
}
function sendEmail($to, $templateId, $message)
{
	$rowTemplate = selectRow('ecomm_email_template',"emailTemplateId=$templateId");		
	$subject = $rowTemplate['emailTemplateSubject'];
	$body = $rowTemplate['emailTemplateContent'];
	
	// To send HTML mail, the Content-type header must be set
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	
	// Additional headers
	$headers .= 'From: '.$rowTemplate['emailTemplateFromName']." <".$rowTemplate['emailTemplateFromEmail']."> " . "\r\n";
	
	foreach($message as $key=>$val)
	{
		$body = str_replace('##'.$key.'##',$val,$body);
	}
	//echo 'to:'.$to.'<br />subject:'.$subject.'<br />body:'.$body.'<br />headers:'.$headers; //exit;
	mail($to, $subject, $body, $headers);
  
}
function selectedField($tbl,$fld,$where='',$order='')
{
	$sql = "SELECT $fld FROM $tbl";
	if($where != "")
		$sql.= " WHERE $where ";
	if($order != "")
		$sql.= " ORDER BY $order ";	
	//echo $sql;	
	$res = select($sql);
	return $res;
}
function insert($tbl,$arr)
{
	$sql = " INSERT into $tbl set ";
	foreach($arr as $key=>$val)
	{
		$sql.=" `$key` = '$val' ,";
	}
	$sql = substr($sql, 0, -1); 
	mysql_query($sql) or die( '<br /><strong>Insert Query: </strong>'.$sql.'<br /><br /><strong>Error: </strong>'.mysql_error());
	return mysql_insert_id();	
}
function update($tbl,$arr,$where='')
{
	$sql = " UPDATE $tbl set ";
	foreach($arr as $key=>$val)
	{
		$sql.=" `$key` = '$val' ,";
	}
	$sql = substr($sql, 0, -1); 
	
	if($where != '')
		$sql.= ' WHERE '.$where;
	echo $sql;
	$res = mysql_query($sql) or die( '<br /><strong>Update Query: </strong>'.$sql.'<br /><br /><strong>Error: </strong>'.mysql_error());
	return $res ;
}
function isUpdated()
{
	if(mysql_affected_rows())
		return true;
	else
		return false;
}
function delete($tbl,$where)
{
	$sql = " DELETE FROM $tbl WHERE ".$where;
	$res = mysql_query($sql) or die( '<br /><strong>Delete Query</strong>:'.$sql.'<br />'.mysql_error());
	return $res;
}
function showPrice($price,$currency='usd')
{	
	if($price=='')
		return '';
	if($currency=='usd')
		$c = '$';
	else
		$c = '€';
	$p = number_format($price,2);
	if(substr($p,-2)=='00')
		return $c.$price;
	else
		return $c.$p;
}
function filterIn($str)
{	
    if(get_magic_quotes_gpc())
    {        
        $str = stripslashes($str);
    }
    return mysql_escape_string(trim($str));
}
function filterOut($str,$len=0)
{
	$str = stripslashes($str);
	if( $len > 0 )
	{
		if(strlen($str)>$len)
			$str = substr($str,0,$len).'...';
	}
	return htmlentities($str);
}
function createDbCombo($tbl,$key_field,$value_field,$name,$select_text="",$selected="",$extra="",$order="",$where="")
{
	$str= "<select name=\"$name\" $extra >";
	if($select_text != "")
		$str.= "<option value=\"\">$select_text</option>";
	
	if($order=="")
		$order = "$value_field asc";
	$arr = selectAll($tbl,$where,$order);
	for($i=0;$i<count($arr);$i++)
	{
		$temp="";
		if(strtolower(trim($arr[$i][$key_field]))==strtolower(trim($selected)))
			$temp = 'selected="selected"';
		$str.="<option $temp value=\"".$arr[$i][$key_field]."\">".$arr[$i][$value_field]."</option>";
	}	
	$str.="</select>";
	return $str;
}
function createRadio($arr,$name,$selected="",$extra="",$verticle=false)
{
	if(count($arr)>0)
	{
		foreach($arr as $key=>$val)
		{
			$temp="";				
			if($selected!="" && $key==$selected)
				$temp.= 'checked';
			  $str.="<label><input $temp $extra name=\"$name\" type=\"radio\" value=\"$key\" />".$val."</label>";	
			 if($verticle)		
			 	$str.="<br />";
		}
	}
	$str.="</select>";
	return $str;
}
function getIp()
{
	return $_SERVER['REMOTE_ADDR'];
}
function now()
{
	return date('Y-m-d H:i:s');
}
?>