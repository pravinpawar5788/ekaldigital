<section class="panel">
	<div class="tabs-custom">
		<ul class="nav nav-tabs">
			<li class="active">
				<a href="#list" data-toggle="tab"><i class="fas fa-list-ul"></i> <?=translate('exam_list')?></a>
			</li>
 
		</ul>
		<div class="tab-content">
			<div id="list" class="tab-pane active">
				<table class="table table-bordered table-hover mb-none table-export">
					<thead>
						<tr>
							<!--<th width="50"><?=translate('sl')?></th> -->
						 
							<th><?=translate('exam_name')?> </th>
							 <th><?=translate('total_quiz')?></th>
							 <th><?=translate('correct')?></th>
							 <th><?=translate('wrong')?></th>
							<th><?=translate('Result')?></th>
						</tr>
					</thead>
					<tbody>
					<?php     //$sambhagwise = $this->db->get_where('ekal_sambhag',array('status'=>1))->row_array();										   ?>
						<?php $count = 1; foreach($examlist as $row): ?>
						<?php 
						
						//if($sambhagwise['id'] == $_SESSION['s_id']) { ?>
						<tr>
							<!--<td><?php echo $count++; ?></td> -->
						  <?php   
											 
										  $db2 = $this->load->database('serverdb', TRUE); 
$live_tv_categoriesmcq1 = $db2->get_where('quiz_result',array('category_id'=>$row['id'], 'studid'=>get_loggedin_user_id()))->num_rows();										  
                                             $live_tv_categoriesmcq = $db2->get_where('quiz_result',array('category_id'=>$row['id'],'score'=>1, 'studid'=>get_loggedin_user_id()))->num_rows();
											  ?>
											  
							<td><?php echo $row['categoryname']; ?></td>
							 	<td><?php echo $row['exammarks']; ?></td>
									<td><?php if($live_tv_categoriesmcq1 > 0) { echo $live_tv_categoriesmcq; } ?></td>
										<td><?php if($live_tv_categoriesmcq1 > 0) { echo ($row['exammarks'] - (int)$live_tv_categoriesmcq); } ?></td>
							<td class="min-w-xs">
						     
								<!-- updatr link -->
								 <?php  if($live_tv_categoriesmcq1 > 0) { ?>
								  <?php if($live_tv_categoriesmcq > 14 && $live_tv_categoriesmcq <= 20)  { echo "अति उत्तम"; }?>
								  <?php if($live_tv_categoriesmcq > 9 && $live_tv_categoriesmcq <= 14)  { echo "उत्तम"; }?>
								  <?php if($live_tv_categoriesmcq > 4 && $live_tv_categoriesmcq <= 9)  { echo "सामान्य"; }?>
								  <?php if($live_tv_categoriesmcq >= 0 && $live_tv_categoriesmcq <= 4)  { echo "चिंताजनक"; }?>
								  
								  
								  
								  
								 <?php } else { ?>
								<a href="<?php echo base_url('exam/quiztest1/' . $row['id']);?>" class="btn btn-default btn-circle icon">
									<i class="fas fa-play-circle"> Start Exam </i>
								</a>
								 <?php } ?>
								 
							 
							</td>
						</tr>
						<?php // } ?>
						<?php endforeach;?>
					</tbody>
				</table>
			</div>
 
		</div>
	</div>
</section>

<script type="text/javascript">
	$(document).ready(function () {
		$(document).on('change', '#branch_id', function() {
			var branchID = $(this).val();
			$.ajax({
				url: "<?=base_url('ajax/getDataByBranch')?>",
				type: 'POST',
				data: {
					branch_id: branchID,
					table: 'exam_term'
				},
				success: function (data) {
					$('#term_id').html(data);
				}
			});

			$.ajax({
				url: "<?=base_url('exam/getDistributionByBranch')?>",
				type: 'POST',
				data: {
					branch_id: branchID,
				},
				success: function (data) {
					$('#mark_distribution').html(data);
				}
			});
		});
	});
</script>