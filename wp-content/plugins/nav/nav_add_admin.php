<?php

	if($_POST['act'] == 'Add')
	{  		$list['date'] = date('Y-m-d',$_POST['date']);
			$list = createDbArr('wp_nav');
			insert('wp_nav',$list);
			addVjMessage('Successfully Added.');
			wp_redirect('admin.php?page=nav_list');
			exit;

	}else if($_POST['act'] == 'Edit'){
		$list['date'] = date('Y-m-d',$_POST['date']);
		$list = createDbArr('wp_nav');
		$id = $_POST["id"];
		if($id > 0)
		{
			update('wp_nav',$list,"id=$id");
			addVjMessage('Successfully Updated.');
		}

		wp_redirect('admin.php?page=nav_list');
		exit;
	}
	$act ="Add";
    if(isset($_GET["view"]) && isset($_GET["id"])  && $_GET["view"]=="modify"){
		$act ="edit";
		$id = $_GET["id"];
		$result = selectRow('wp_nav',"id=$id");
		extract($result);
	}
	if(isset($_GET["id"]) && $_GET["view"]=="delete" )
	{
		$id = $_GET["id"];
		delete("wp_nav","id=$id");
		addVjMessage('Successfully Deleted.');
		wp_redirect('admin.php?page=nav_list');
		exit;
	}
?>
    <div class="wrap">

<style></style>
<script language="javascript">

</script>

<script src="<?php echo $url = plugins_url(); ?>/nav/js/jquery.js" type="text/javascript" ></script>
<script src="<?php echo $url = plugins_url(); ?>/nav/js/valid.js" type="text/javascript" ></script>
 <link rel="stylesheet" href="<?php echo $url = plugins_url(); ?>/nav/css/jquery-ui.css" />
  <script src="<?php echo $url = plugins_url(); ?>/nav/js/jquery-1.9.1.js"></script>
  <script src="<?php echo $url = plugins_url(); ?>/nav/js/jquery-ui.js"></script>
  <script>
  $(function() {
    $( "#nav_date").datepicker({formatDate:'dd-mm-yyyy'});
  });
  </script>
  <div id="wrap" >

				<div  style="width:140px;margin-top:16px;">
				<div style="float:left;" ><img src="<?php echo $url = plugins_url(); ?>/nav/images/1363650477_stock_form-navigator.png" border="0" class="iconimg"/></div>
				<div style="float:right;margin-top:-12px;" ><h2 id="add-new-user"> <?php  echo $act; ?> NAV</h2></div>
			</div>
			 <form enctype="multipart/form-data" name="nav_add" method="post" action="" onsubmit="return validateFormNew(this);"   >
			 <input type="hidden" name="act" id="act" value="<?php echo $act;?>" >
			 <?php if($act == 'Edit') { ?>
			 <input type="hidden" name="id" id="id" value="<?php echo $id;?>" >
			 <?php } ?>
               <table colspan="2" cellpadding="2" width="100%" class="form-table" >
					<tr>
						<th width="20%" scope="row"><label for="user_login">Central Govt. Scheme<span class="description">&nbsp;(required)</span></label></th>
						<td width="80%" ><input type="text" class="errMsgId~PRICE~Central Govt. Scheme" maxlength="10" name="centralGovtScheme" id="centralGovtScheme" value="<?php echo $centralGovtScheme;?>" >
						<span id="errMsgId" style="color:red;" style="color:red;" ></span></td>
					</tr>
					<tr>
						<th width="20%" scope="row"><label for="user_login">State Govt. Scheme <span class="description">&nbsp;(required)</span></label></th>
						<td><input type="text" name="stateGovtScheme"  class="errMsgId2~PRICE~Central Govt. Scheme" maxlength="10" id="stateGovtScheme" value="<?php echo $stateGovtScheme;?>" >
						<span id="errMsgId2" style="color:red;" ></span>
						</td>
					</tr>
					<tr>
						<th width="20%" scope="row"><label for="user_login">Scheme E<span class="description">&nbsp;(required)</span></label></th>
						<td><input type="text" name="scheme_E" id="scheme_E" maxlength="10" class="errMsgId3~PRICE~Scheme E" value="<?php echo $scheme_E;?>" >
						<span id="errMsgId3" style="color:red;" ></span></td>
					</tr>
					<tr>
						<th width="20%" scope="row"><label for="user_login">Scheme C<span class="description">&nbsp;(required)</span></label></th>
						<td><input type="text" name="scheme_C" id="scheme_C" maxlength="10" class="errMsgId4~PRICE~Scheme C" value="<?php echo $scheme_C;?>" >
						<span id="errMsgId4" style="color:red;" ></span></td>
					</tr>
					<tr>
						<th width="20%" scope="row"><label for="user_login">Scheme G<span class="description">&nbsp;(required)</span></label></th>
						<td><input type="text" name="scheme_G" id="scheme_G" maxlength="10" class="errMsgId5~PRICE~Scheme G" value="<?php echo $scheme_G;?>" >
						<span id="errMsgId5" style="color:red;" ></span></td>
					</tr>
					<tr>
						<th width="20%" scope="row"><label for="user_login">Scheme T II E<span class="description">&nbsp;(required)</span></label></th>
						<td><input type="text" name="scheme_T2E" id="scheme_T2E" maxlength="10" class="errMsgId6~PRICE~Scheme T2E" value="<?php echo $scheme_T2E;?>" >
						<span id="errMsgId6" style="color:red;" ></span>
						</td>
					</tr>
					<tr>
						<th width="20%" scope="row"><label for="user_login">Scheme T II C<span class="description">&nbsp;(required)</span></label></th>
						<td><input type="text" name="scheme_T2C" id="scheme_T2C" maxlength="10"  class="errMsgId7~PRICE~Scheme T2C" value="<?php echo $scheme_T2C;?>" >
						<span id="errMsgId7" style="color:red;" ></span></td>
					</tr>
					<tr>
						<th width="20%" scope="row"><label for="user_login">Scheme T II G<span class="description">&nbsp;(required)</span></label></th>
						<td><input type="text" name="scheme_T2G" id="scheme_T2G" maxlength="10" class="errMsgId8~PRICE~Scheme T2G" value="<?php echo $scheme_T2G;?>" >
						<span id="errMsgId8" style="color:red;" ></span></td>
					</tr>
					<tr>
						<th width="20%" scope="row"><label for="user_login">NPS Lite<span class="description">&nbsp;(required)</span></label></th>
						<td><input type="text" name="nps_lite" id="nps_lite" maxlength="10" class="errMsgId9~PRICE~NPS Lite" value="<?php echo $nps_lite;?>" >
						<span id="errMsgId9" style="color:red;" ></span></td>
					</tr>
					<tr>
						<th width="20%" scope="row"><label for="user_login">Corporate CG<span class="description">&nbsp;(required)</span></label></th>
						<td><input type="text" name="corporate_cg" maxlength="10" class="errMsgId10~PRICE~Cprporate CG" id="corporate_cg" value="<?php echo $corporate_cg;?>" >
						<span id="errMsgId10" style="color:red;" ></span></td>
					</tr>
				    <tr>
						<th width="20%" scope="row"><label for="user_login">NAV Date<span class="description">&nbsp;(required)</span></label></th>
						<td><input type="text" name="date" maxlength="12" class="errMsgId11~NOBLANK~Select Date of Nav" id="nav_date" value="<?php echo $date = isset($date)?date('Y-m-d',$date):"";?>" >
						<span id="errMsgId11" style="color:red;" ></span></td>
					</tr>
					<tr>
						<td>&nbsp;</td><td>

						<input type="submit" class="button" name="Submit" value="Submit" /><a href="admin.php?page=nav_list" ><input type="button" class="button" value="Back" /></a></td>
					</tr>
				</table>
        </form>
            </div>