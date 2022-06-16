


<section class="panel">

		   <div class="panel-body">
    <div class="col-md-12">
		   <div class="row">
		   
		   
	  	<table class="table table-bordered table-hover table-condensed table-export" cellspacing="0" width="100%">
					<thead>
						<tr>
							 <th><?php echo translate('sl'); ?></th>
							<th>Assembly</th>
							 
							 <th>Samiti Sadasy</th>
							 <th>Sevavrati Karyakarta</th>
							 <th>Acharya</th>
							 <th>Friends Of Ekal </th>
							 <th>Total Added Karyakarta</th>
							 
						 
						</tr>
					</thead>
					<tbody>
					<?php $i = 1;  foreach($stafflist as $row) { ?>
					<tr>
					 
							 <td><?php echo $i++; ?></td>
							<td><?php echo $row['assembly']; ?></td>
							
							<td> <?php echo $row['category1']; ?></td>
							<td> <?php echo $row['category2']; ?></td>
							<td> <?php echo $row['category3']; ?></td>
							<td> <?php echo $row['category4']; ?></td>
							<td> <?php echo $row['cnt']; ?></td>
							
							
					</tr>
					<?php } ?>
	                 </tbody>
				</table>
	  </div>
  </div>

	 </section>