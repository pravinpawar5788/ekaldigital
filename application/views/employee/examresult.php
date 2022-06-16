


<section class="panel">
    


	<div class="tabs-custom">
	
	     
		
		 
		 
	
	
		<ul class="nav nav-tabs">
			<li class="active">
				<a href="#">
					<i class="far fa-user-circle"></i> Karyakarta
				</a>
			</li>
		</ul>
		<div class="tab-content">
			<div class="tab-pane box active">
				<div class="export_title"><?php echo translate('employee') . " " . translate('list'); ?></div>
				<table class="table table-bordered table-hover table-condensed table-export" cellspacing="0" width="100%">
					<thead>
						<tr>
							 
							<th><?php echo translate('Prabhag'); ?></th>
							<th><?php echo translate('Sambhag'); ?></th>
							<th><?php echo translate('Bhag'); ?></th>
							<th><?php echo translate('anchal (district)'); ?></th>							
							<th><?php echo translate('branch'); ?></th>
							<th><?php echo translate('Responsibility'); ?></th>
							<th><?php echo translate('name'); ?></th>
							 
							<th>Total Quiz</th>
							<th>Correct</th>
							<!--<th>Wrong</th> -->
							<th>Result</th>
						
						</tr>
					</thead>
					
                     <?php
					 
							 
							//echo "<pre>"; print_r($stafflist); die;
								foreach ($stafflist as $fields) {
							?>
							<tr>
							<td><?=$fields['p_name']?></td>
							<td><?=$fields['s_name']?></td>
							<td><?=$fields['b_name']?></td>
							<td><?=$fields['a_name']?></td>
							<td><?=$fields['b_name']?></td>
							<td><?=$fields['qualification']?></td>
							<td><?=$fields['name']?></td>
							
							  <?php   
											 
										  $db2 = $this->load->database('serverdb', TRUE); 
$live_tv_categoriesmcq1 = $db2->get_where('quiz_result',array('category_id'=>9, 'studid'=>$fields['id']))->num_rows();										  
                                             $live_tv_categoriesmcq = $db2->get_where('quiz_result',array('category_id'=>9,'score'=>1, 'studid'=>$fields['id']))->num_rows();
											  ?>
							<td>20</td>
									<td><?php if($live_tv_categoriesmcq1 > 0) { echo $live_tv_categoriesmcq; } ?></td>
										<!--<td><?php if($live_tv_categoriesmcq1 > 0) { echo ($row['exammarks'] - (int)$live_tv_categoriesmcq); } ?></td> -->
							<td class="min-w-xs">
						     
								<!-- updatr link -->
								 <?php  if($live_tv_categoriesmcq1 > 0) { ?>
								  <?php if($live_tv_categoriesmcq > 14 && $live_tv_categoriesmcq <= 20)  { echo "अति उत्तम"; }?>
								  <?php if($live_tv_categoriesmcq > 9 && $live_tv_categoriesmcq <= 14)  { echo "उत्तम"; }?>
								  <?php if($live_tv_categoriesmcq > 4 && $live_tv_categoriesmcq <= 9)  { echo "सामान्य"; }?>
								  <?php if($live_tv_categoriesmcq >= 0 && $live_tv_categoriesmcq <= 4)  { echo "चिंताजनक"; }?>
								 <?php } ?>
								  </td>
							</tr>
						<?php }     ?>
				</table>
			</div>
		</div>
	</div>
</section>