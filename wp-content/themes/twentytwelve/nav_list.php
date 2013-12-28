<div class="wrap welcome-block">
     <?php
	//include("nav-function.php");


	?>
<link href="<?php echo  get_bloginfo("template_directory"); ?>/css/demo_page.css" rel="stylesheet" type="text/css" media="all" />
	<link href="<?php echo  get_bloginfo("template_directory"); ?>/css/demo_table.css" rel="stylesheet" type="text/css" media="all" />
	<style>
	.dataTables_filter{display:none;}
	</style>
	<form action="processbank.php?action=addbank" method="post"  name="frmListProduct" id="frmListProduct">

		<h2>Historical</h2>
			<p>
				Please select a Month to view NAV.
			</p>
					<select class="searchtext required" id="year" name="year" onchange="addFilter('y');" >
							<option value="">Year</option>
							<option  value="2010">2010</option>
							<option value="2011">2011</option>
							<option value="2012">2012</option>
							<option value="2013">2013</option>
					</select>
					<select class="searchtext required" id="month" name="month" onchange="addFilter('m');" >
						<option value="">Month</option>
						<option value="01">Jan</option>
						<option value="02">Feb</option>
						<option value="03">Mar</option>
						<option value="04">Apr</option>
						<option value="05">May</option>
						<option value="06">Jun</option>
						<option value="07">Jul</option>
						<option value="08">Aug</option>
						<option value="09">Sep</option>
						<option value="10">Oct</option>
						<option value="11">Nov</option>
						<option value="12">Dec</option>
					</select>

	<p>&nbsp;</p>

	<script src="<?php echo $url = plugins_url(); ?>/nav/js/jquery.js" type="text/javascript" ></script>
	<script src="<?php echo $url = plugins_url(); ?>/nav/js/nav.js" type="text/javascript" ></script>
	<script src="<?php echo $url = plugins_url(); ?>/nan/js/FixedHeader.js" type="text/javascript" ></script>
	<script src="<?php echo  $url = plugins_url(); ?>/nav/js/dataTables.js" type="text/javascript" ></script>
	<script>

	var oTable;
			var month = $('#month').val();
			var year= $('#year').val();
	$(document).ready(function() {
		/*oTable = $('#data').dataTable({    "sPaginationType": "full_numbers",
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
								{ "bSortable": true, "aTargets": [ 10 ] }
							]
			});*/

			url = "<?php echo  get_bloginfo("template_directory"); ?>/nav.php?month="+month+"&year="+year;
				oTable = $('#data').dataTable( {
						"bProcessing": true,
						/*"sPaginationType": "full_numbers",*/
						"bRetrieve": true,
						"bServerSide": true,
						"sAjaxSource": url,
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
								{ "bSortable": true, "aTargets": [ 10 ] }

						],
						"fnInitComplete": function(oSettings, json) {
							       }

					    } );
				//	oTable.fnSort( [ [0,'asc'] ] );
		/* Sort immediately with columns 0 and 1 */
		//oTable.fnSort( [ [0,'desc'] ] );
	} );

function addFilter(p)
{
	var month = $('#month').val();
	var year= $('#year').val();
	if(p == 'm' && year == '')
	{
		alert("Please, select year first.");return false;
	}
	url = "<?php echo  get_bloginfo("template_directory"); ?>/nav.php?month="+month+"&year="+year;
	var oSettings = oTable.fnSettings();
	 oSettings.sAjaxSource = url;
	oTable.fnDraw(oSettings);
}
	</script>
	<style>
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
	<tbody></tbody>

	 </table>

	</form>
</div>