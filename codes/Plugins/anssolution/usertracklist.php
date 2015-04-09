<style>
.active {
    background: -moz-linear-gradient(center top , #999999, #777777 5%, #AFAFAF) repeat scroll 0 0 transparent !important;
    }
</style>
<div id="wpbody">
	<div class="wrap"><h2>Anssolution User Tracking</h2>
	<br/>
<div class="tablenav">	

<table class='wp-list-table widefat fixed'>
	<thead>
	<tr><th>TrackerId</th><th>User Name</th><th> Date/Time</th><th>Case Number</th><th></tr></thead>
	<?php foreach ($result as $row ){?>
	<tr>
	    <td><?php echo $row->usertracker_id; ?></td>
		<td><?php echo $row->name; ?></td>
		<td>
		<?php echo date('m/d/Y ,g:i a', strtotime($row->date_time));?>
		</td>
		<td><?php echo $row->case_id; ?></td>			
	</tr>	
	<?php } ?>
 </table>
 <div class="tablenav">
 <div class="tablenav-pages"> 
 	<?php 
		if ( $page_links ) {
			echo '<div class="tablenav"><div class="tablenav-pages" style="margin: 1em 0">' . $page_links . '</div></div>';
		}
     ?>
 </div>
 </div>
</div>
</div>
</div>