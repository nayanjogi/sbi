<div class="wrap welcome-block">
     <?php
	//include("nav-function.php");


	?>
<link href="<?php echo  get_bloginfo("template_directory"); ?>/css/demo_page.css" rel="stylesheet" type="text/css" media="all" />
	<link href="<?php echo  get_bloginfo("template_directory"); ?>/css/demo_table.css" rel="stylesheet" type="text/css" media="all" />
	<form action="processbank.php?action=addbank" method="post"  name="frmListProduct" id="frmListProduct">

		<h2>Latest</h2>
			<p>&nbsp;

			</p>

	<script src="<?php echo $url = plugins_url(); ?>/nav/js/jquery.js" type="text/javascript" ></script>
	<script src="<?php echo $url = plugins_url(); ?>/nav/js/nav.js" type="text/javascript" ></script>
	<script src="<?php echo $url = plugins_url(); ?>/nan/js/FixedHeader.js" type="text/javascript" ></script>
	<script src="<?php echo  $url = plugins_url(); ?>/nav/js/dataTables.js" type="text/javascript" ></script>
	<script>

	var oTable;

	$(document).ready(function() {

				oTable = $('#data').dataTable( {
						"bProcessing": false,
						/*"sPaginationType": "full_numbers",*/
						"bRetrieve": true,
						"bServerSide": false,
						/*"sAjaxSource": url,*/
						"fnServerData": function ( sSource, aoData, fnCallback ) {

						    $.ajax( {
							"dataType": 'json',
							"type": "POST",
							"url": sSource,
							"data": aoData,
							"success": function (msg) {
							fnCallback(msg);
							}

						    } );
						},
						"aoColumnDefs": [
							{ "bSortable": false, "aTargets": [ 0 ] },
								{ "bSortable": false, "aTargets": [ 1 ] },
								{ "bSortable": false, "aTargets": [ 2 ] },
								{ "bSortable": false, "aTargets": [ 3 ] },
								{ "bSortable": false, "aTargets": [ 4 ] },
								{ "bSortable": false, "aTargets": [ 5 ] },
								{ "bSortable": false, "aTargets": [ 6 ] },
								{ "bSortable": false, "aTargets": [ 7 ] },
								{ "bSortable": false, "aTargets": [ 8 ] },
								{ "bSortable": false, "aTargets": [ 9 ] },
								{ "bSortable": false, "aTargets": [ 10 ] }

						],
						"fnInitComplete": function(oSettings, json) {
							       }

					    } );
					oTable.fnSort( [ [0,'asc'] ] );
		/* Sort immediately with columns 0 and 1 */
		//oTable.fnSort( [ [0,'desc'] ] );
	} );


	</script>
<style>
.sorting_disabled
{
	border-color: rgb(238, 238, 238) rgb(153, 153, 153) rgb(119, 119, 119) rgb(187, 187, 187); border-style: solid; border-width: 1px; background-color: rgb(204, 204, 204); font-size: 11px; padding: 4px; text-align: center; font-family: Arial; text-decoration: none;
}
	.dataTables_empty {
	text-align: center;
}
	</style>
	 <table id="data" width="100%" style="border-radius: 3px;border-width: 1px;border-style: solid;" align="center"  cellpadding="2" cellspacing="1" class="text Tborder">
	 <thead>
	  <tr align="center" id="listTableHeader">
	   <th align="center" width="9%">Date</th>
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
	  </tr>
	 </thead>
	<tbody>
    	<?php
		$result = selectAll('wp_nav'," 1 order by id desc LIMIT 0,1");
		foreach($result as $row)
		{

		?>
        <tr class="odd_gradeA even">
			<td class="  sorting_1"><?php echo $row["date"];?></td>
			<td class=" "><?php echo $row["centralGovtScheme"];?></td>
			<td class=" "><?php echo $row["stateGovtScheme"];?></td>
			<td class="center "><?php echo $row["scheme_E"];?></td>
			<td class="center "><?php echo $row["scheme_C"];?></td>
            <td class=" "><?php echo $row["scheme_G"];?></td>
			<td class=" "><?php echo $row["scheme_T2E"];?></td>
			<td class="center "><?php echo $row["scheme_T2C"];?></td>
			<td class="center "><?php echo $row["scheme_T2G"];?></td>
	    	<td class="center "><?php echo $row["nps_lite"];?></td>
			<td class="center "><?php echo $row["corporate_cg"];?></td>
		</tr>
        <?php } ?>
    </tbody>

	 </table>

	 </form>
</div>
<style>
#data_length{ display:none;}
#data_info{ display:none;}
</style>