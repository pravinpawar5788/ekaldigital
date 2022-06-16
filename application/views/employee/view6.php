


<section class="panel">
    


	<div class="tabs-custom">
	
		<div class="tab-content">
			<div class="tab-pane box active">
			  
				<div class="export_title"><?php echo translate('employee') . " " . translate('list'); ?></div>
				<table class="table table-bordered table-hover table-condensed table-export" cellspacing="0" width="100%">
					<thead>
						<tr>
								<!--<th><?php echo translate('sl'); ?></th>
						<th><?php echo translate('photo'); ?></th> -->							  
							<th><?php echo translate('Responsibility'); ?></th>
							<th><?php echo translate('name'); ?></th>							
							<th>Username</th>
							<th><?php echo translate('mobile_no'); ?></th>
							<th>Assembly</th>						 
							<th><?php echo translate('action'); ?></th>
						</tr>
					</thead>
					<tbody>
						<?php $i = 1; foreach ($stafflist as $row): ?>
						<tr>
								<!--<td><?php echo $i++; ?></td>
						      <td class="center">
						  		<img class="rounded" src="<?php echo get_image_url('staff', $row->photo); ?>" width="40" height="40" />
							</td> -->
							 
							<td><?php echo $row->qualification; ?></td>
							<td><?php echo $row->name; ?></td>
							
							<td> <?php echo $row->email; ?></td>
							<td><?php echo $row->mobileno; ?></td>
							<td><?php echo $row->assembly; ?></td>
						 
							<td class="min-w-c">
							<?php if (get_permission('employee', 'is_edit')): ?>
								<a href="<?php echo base_url('employee/profile/'.$row->id); ?>" class="btn btn-circle btn-default icon" data-toggle="tooltip" 
								data-original-title="<?=translate('profile')?>">
									<i class="far fa-arrow-alt-circle-right"></i>
								</a>
							<?php endif; if (get_permission('employee', 'is_delete')): ?>
								<?php echo btn_delete('employee/delete/' . $row->id); ?>
							<?php endif; ?>
							</td>
						</tr>
						<?php endforeach; ?>
						
						  
					</tbody>
				</table>
				 <div class="pagination"><?php echo $links; ?></div>
			</div>
		</div>
	</div>
</section>
<style>
.pagination {
  display: inline-block;
}

.pagination a {
  color: black;
  float: none;
  padding: 8px 16px;
  text-decoration: none;
  color: #ffbd2e;
}
</style>