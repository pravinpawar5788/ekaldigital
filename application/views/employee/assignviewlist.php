


<section class="panel">

		   <div class="panel-body">
    <div class="col-md-12">
		   <div class="row">
		   
		   
	  	<table class="table table-bordered table-hover table-condensed table-export" cellspacing="0" width="100%">
					<thead>
						<tr>
							 
							<th><?php echo translate('photo'); ?></th>
							<!--<th><?php echo translate('Prabhag'); ?></th>
							<th><?php echo translate('Sambhag'); ?></th>
							<th><?php echo translate('Bhag'); ?></th>
							<th><?php echo translate('anchal (district)'); ?></th>						
							 -->
							<th>Assembly</th>
							<th><?php echo translate('name'); ?></th>
							
							<th><?php echo translate('kid'); ?></th>
							<th><?php echo translate('mobile_no'); ?></th>
						 
						</tr>
					</thead>
					<tbody>
					<?php foreach($stafflist as $row) { ?>
					<tr>
					 
							<td class="center">
								<img class="rounded" src="<?php echo get_image_url('staff', $row['photo']); ?>" width="40" height="40" />
							</td>
							<!--<td><?php echo $row['p_name']; ?></td>
							<td><?php echo $row['s_name']; ?></td>
							<td><?php echo $row['b_name']; ?></td>
							<td><?php echo $row['a_name']; ?></td>
							 -->
							<td><?php echo $row['assembly']; ?></td>
							<td><?php echo $row['name'];  ?></td>
							
							<td> <?php echo $row['email']; ?></td>
							<td><?php echo $row['mobileno']; ?></td>
					</tr>
					<?php } ?>
	                 </tbody>
				</table>
	  </div>
  </div>

	 </section>