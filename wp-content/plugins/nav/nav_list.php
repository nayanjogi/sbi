
    <div class="wrap">

     <?php

	$result = selectAll('wp_nav'," 1 order by id desc");

	?>
	<script src="<?php echo $url = plugins_url(); ?>/nav/js/jquery.js" type="text/javascript" ></script>
	<script src="<?php echo $url = plugins_url(); ?>/nav/js/nav.js" type="text/javascript" ></script>
	<script src="<?php echo $url = plugins_url(); ?>/nan/js/FixedHeader.js" type="text/javascript" ></script>
	<script src="<?php echo  $url = plugins_url(); ?>/nav/js/dataTables.js" type="text/javascript" ></script>
	<script>

	var oTable;

	$(document).ready(function() {
		oTable = $('#data').dataTable({    "sPaginationType": "full_numbers",
											  "aoColumnDefs": [
								{ "bSortable": true, "aTargets": [ 0 ] },
								{ "bSortable": true, "aTargets": [ 1 ] },
								{ "bSortable": true, "aTargets": [ 2 ] },
								{ "bSortable": true, "aTargets": [ 3 ] },
								{ "bSortable": true, "aTargets": [ 4 ] },
								{ "bSortable": true, "aTargets": [ 5 ] },
								{ "bSortable": true, "aTargets": [ 6 ] },
								{ "bSortable": true, "aTargets": [ 7 ] },
								{ "bSortable": true, "aTargets": [ 8 ] },
								{ "bSortable": true, "aTargets": [ 9 ] },
								{ "bSortable": true, "aTargets": [ 10 ] },
								{ "bSortable": false, "aTargets": [ 11 ] },
								{ "bSortable": false, "aTargets": [ 12 ] },
							]
			});

		/* Sort immediately with columns 0 and 1 */
		oTable.fnSort( [ [0,'desc'] ] );
	} );
	</script>
	<link href="<?php echo $url = plugins_url(); ?>/nav/css/demo_page.css" rel="stylesheet" type="text/css" media="all" />
	<link href="<?php echo $url = plugins_url(); ?>/nav/css/demo_table.css" rel="stylesheet" type="text/css" media="all" />
	<div id="wrap" >
			<div  style="width:140px;margin-top:5px;">
				<div style="float:left;" ><img src="<?php echo $url = plugins_url(); ?>/nav/images/1363650477_stock_form-navigator.png" border="0" class="iconimg"/></div>
				<div style="float:right;margin-top:-12px;" ><h2 id="add-new-user"> <?php  echo $act; ?> NAV List</h2></div>
			</div>
	<form action="processbank.php?action=addbank" method="post"  name="frmListProduct" id="frmListProduct">
	<p>&nbsp;</p>
	<p align="right"><a href="admin.php?page=nav_add" ><input type="button" id="btnAddCMS" value="Add NAV" class="button"></a></p>
	<p>&nbsp;</p>
	 <table id="data" width="100%" style="border-radius: 3px;border-width: 1px;border-style: solid;" align="center"  cellpadding="2" cellspacing="1" class="text Tborder">
	 <thead>
	  <tr align="center" id="listTableHeader">
	  <th align="center" width="8%" >Date</th>
	   <th align="center" width="9%">Central Govt. Scheme</th>
	   <th align="center" width="9%">State Govt. Scheme</th>
		<th align="center" width="8%">Scheme E</th>
		<th align="center" width="8%">Scheme C</th>
		<th align="center" width="8%">Scheme G</th>
		<th align="center" width="9%">Scheme T II E</th>
		<th align="center" width="9%">Scheme T II C</th>
		<th align="center" width="10%">Scheme T II G</th>
		<th align="center" width="7%">NPS Lite</th>
		<th align="center" width="10%">Corporate CG</th>
		<th align="center" width="6%">Edit</th>
		<th align="center" width="4%">Delete</th>
	  </tr>
	 </thead>
	  <?php
	$i = 0;
	if (sizeof($result) > 0) {

		foreach($result as $row) {
			extract($row);
			$class ='';

			if ($i%2) {
				$class = 'row1';
			} else {
				$class = 'row2';
			}

			$i += 1;
	?>
	  <tr class="<?php echo $class; ?>">
	     <td style="text-align:center;" ><?php echo $date; ?></td>
		  <td style="text-align:right;" ><?php echo $centralGovtScheme; ?></td>
		  <td style="text-align:right;" ><?php echo $stateGovtScheme; ?></td>
		  <td style="text-align:right;" ><?php echo $scheme_E; ?></td>
		  <td style="text-align:right;" ><?php echo $scheme_C; ?></td>
		  <td style="text-align:right;" ><?php echo $scheme_G; ?></td>
		  <td style="text-align:right;" ><?php echo $scheme_T2E; ?></td>
		  <td style="text-align:right;" ><?php echo $scheme_T2C; ?></td>
		  <td style="text-align:right;" ><?php echo $scheme_T2G; ?></td>
		  <td style="text-align:right;" ><?php echo $nps_lite; ?></td>
		   <td style="text-align:right;" ><?php echo $corporate_cg; ?></td>
		  <td style="text-align:center;" ><a href="admin.php?page=nav_add&view=modify&id=<?php echo $id; ?>"  ><img src="<?php echo $url = plugins_url(); ?>/nav/images/editicon.png" border="0" class="iconimg"/></a></td>
		  <td style="text-align:center;" ><a href="admin.php?page=nav_add&view=delete&id=<?php echo $id; ?>"  ><img src="<?php echo $url = plugins_url(); ?>/nav/images/delete.png" border="0" class="iconimg"/></a></td>
		</tr>
	  <?php
	  } // end while
	?>

	<?php
	}
	?>


	 </table>
	</form>
</div>