<?php
/*
 *
 * template for participants list shortcode output
 *
 * this is the default template which formats the list of records as a table
 * using shortcut functions to display the componenets
 *
 * If you need more control over the display, look at the detailed template
 * (pdb-list-detailed.php) for an example of how this can be done
 *
 * Please note that if you have more than one list on a page, searching, sorting
 * and pagination will not work correctly.
 *
*/
?>
<div class="wrap <?php echo $this->wrap_class ?>" align="center">
<a name="<?php echo $this->list_anchor ?>" id="<?php echo $this->list_anchor ?>"></a>
<?php
  /*
   * SEARCH/SORT FORM
   *
   * the search/sort form is only presented when enabled in the shortcode.
   *
   */
  $this->show_search_sort_form();

  /* LIST DISPLAY */
?>
  <?php /*
   * IMPORTANT: the list container must have an id="pdb-list" in order for the
	 * AJAX-enabled search to work.
   */ ?>
    <?php // print the count if enabled in the shortcode
		if ( $display_count ) : ?>
    <caption>
      Total Records Found: <?php echo $record_count ?>, showing <?php echo $records_per_page ?> per page
    </caption>
    <?php endif ?>

<style>
.sorting_disabled
{
	border-color: rgb(238, 238, 238) rgb(153, 153, 153) rgb(119, 119, 119) rgb(187, 187, 187); border-style: solid; border-width: 1px; background-color: rgb(204, 204, 204); font-size: 11px; padding: 10px; text-align: center; font-family: Arial; text-decoration: none;
}
	.dataTables_empty {
	text-align: center;
}
table {
    border-collapse: collapse;
    border-spacing: 0;
    text-align: left;
}

tr.odd td{
    border-color: #EEEEEE #AAAAAA #999999 #CCCCCC;
    border-style: solid;
    border-width: 1px;
    font-size: 12px;
    padding: 8px;
}
	</style>

	 <table id="data" width="50%" style="border-radius: 3px;border-width: 1px;border-style: solid;" align="center"  cellpadding="10" cellspacing="10" class="text Tborder">

    <?php if ( $record_count > 0 ) : // print only if there are records to show ?>

      <thead>
        <tr id="listTableHeader" align="center">
          <?php /*
           * this function prints headers for all the fields
           * replacement codes:
           * %2$s is the form element type identifier
           * %1$s is the title of the field
           */

          $this->print_header_row( '<th align="center" class="sorting_disabled" rowspan="1" colspan="1" >%1$s</th>' );
          ?>
        </tr>
      </thead>

      <tbody>
      <?php while ( $this->have_records() ) : $this->the_record(); // each record is one row ?>
        <tr class="odd" >
          <?php while( $this->have_fields() ) : $this->the_field(); // each field is one cell ?>

            <td class="<?php echo $this->field->name ?>-field" align="center">
              <?php $this->field->print_value() ?>
            </td>

        <?php endwhile; // each field ?>
        </tr>
      <?php endwhile; // each record ?>
      </tbody>

    <?php else : // if there are no records ?>

      <tbody>
        <tr>
          <td>No Records Found</td>
        </tr>
      </tbody>

    <?php endif; // $record_count > 0 ?>

	</table>
  <?php
  /*
   * this shortcut function presents a pagination control with default layout
   */
  $this->show_pagination_control();
  ?>
</div>