<?php

if (!function_exists('add_action')) {
  require_once("../../../wp-config.php");
  //echo DB_USER."SDSD";exit;
}


$month = $_GET['month'];
$year = $_GET['year'];

$soryby ="";
if($_POST['sSortDir_0'] =="asc" && $_POST['iSortCol_0'] ==0)
{
		$soryby = " date asc";
}else if($_POST['sSortDir_0'] =="desc" && $_POST['iSortCol_0'] ==0)
{
		$soryby = " date desc";
}else if($_POST['sSortDir_0'] =="asc" && $_POST['iSortCol_0'] ==1)
{
		$soryby = " centralGovtScheme asc";
}else if($_POST['sSortDir_0'] =="desc" && $_POST['iSortCol_0'] ==1)
{
		$soryby = " centralGovtScheme desc";
}else if($_POST['sSortDir_0'] =="asc" && $_POST['iSortCol_0'] ==2)
{
		$soryby = " stateGovtScheme asc";
}else if($_POST['sSortDir_0'] =="desc" && $_POST['iSortCol_0'] ==2)
{
		$soryby = " stateGovtScheme desc";
}else if($_POST['sSortDir_0'] =="asc" && $_POST['iSortCol_0'] ==3)
{
		$soryby = " scheme_E asc";
}else if($_POST['sSortDir_0'] =="desc" && $_POST['iSortCol_0'] ==3)
{
		$soryby = " scheme_E desc";
}else if($_POST['sSortDir_0'] =="asc" && $_POST['iSortCol_0'] ==4)
{
		$soryby = " scheme_C asc";
}else if($_POST['sSortDir_0'] =="desc" && $_POST['iSortCol_0'] ==4)
{
		$soryby = " scheme_C desc";
}else if($_POST['sSortDir_0'] =="asc" && $_POST['iSortCol_0'] ==5)
{
		$soryby = " scheme_G asc";
}else if($_POST['sSortDir_0'] =="desc" && $_POST['iSortCol_0'] ==5)
{
		$soryby = " scheme_G desc";
}else if($_POST['sSortDir_0'] =="asc" && $_POST['iSortCol_0'] ==6)
{
		$soryby = " scheme_T2E asc";
}else if($_POST['sSortDir_0'] =="desc" && $_POST['iSortCol_0'] ==6)
{
		$soryby = " scheme_T2E desc";
}else if($_POST['sSortDir_0'] =="asc" && $_POST['iSortCol_0'] ==7)
{
		$soryby = " scheme_T2C asc";
}else if($_POST['sSortDir_0'] =="desc" && $_POST['iSortCol_0'] ==7)
{
		$soryby = " scheme_T2C desc";
}else if($_POST['sSortDir_0'] =="asc" && $_POST['iSortCol_0'] ==8)
{
		$soryby = " scheme_T2G asc";
}else if($_POST['sSortDir_0'] =="desc" && $_POST['iSortCol_0'] ==8)
{
		$soryby = " scheme_T2G desc";
}else if($_POST['sSortDir_0'] =="asc" && $_POST['iSortCol_0'] ==9)
{
		$soryby = " nps_lite asc";
}else if($_POST['sSortDir_0'] =="desc" && $_POST['iSortCol_0'] ==9)
{
		$soryby = " nps_lite desc";
}else if($_POST['sSortDir_0'] =="asc" && $_POST['iSortCol_0'] ==10)
{
		$soryby = " corporate_cg asc";
}else if($_POST['sSortDir_0'] =="desc" && $_POST['iSortCol_0'] ==10)
{
		$soryby = " corporate_cg desc";
}

$cond = "1 ";

if($month !="")
{
		$cond .= "and month(date) = ".$month;
}

if($year !="")
{
		$cond .= " and year(date) = ".$year;
}

//iSortCol_0
$result = selectAll('wp_nav'," $cond order by id desc");
$iTotal = count($result);

$sLimit = "";

if ( isset( $_REQUEST['iDisplayStart'] ) && $_REQUEST['iDisplayLength'] != '-1' )
{
	$sLimit = "LIMIT ".mysql_real_escape_string( $_REQUEST['iDisplayStart'] ).", ".
		mysql_real_escape_string($_REQUEST['iDisplayLength'] );
}

$result = selectAll('wp_nav'," $cond order by $soryby $sLimit");

$iFilteredTotal = count($result);
$iDisplayStart = $_POST["iDisplayStart"];

$output = array(
		"iTotalRecords" => $iTotal,
		"iTotalDisplayRecords" => $iFilteredTotal,
		"aaData" => array()
	);
	
 
 
	foreach($result as $row) 
	{ 
	  $NRow = array("0"=>$row["date"],"1"=>$row["centralGovtScheme"],"2"=>$row["stateGovtScheme"],"3"=>$row["scheme_E"],
	  "4"=>$row["scheme_C"],"5"=>$row["scheme_G"],"6"=>$row["scheme_T2E"],
	  "7"=>$row["scheme_T2C"],"8"=>$row["scheme_T2G"],"9"=>$row["nps_lite"],"10"=>$row["corporate_cg"]);
		//	echo "<pre>";print_r($row);exit;
		$output['aaData'][] = $NRow;
	} 
	echo json_encode($output);
exit;
?>