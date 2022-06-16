<section class="panel">
 
		 
		 
			 
				<table class="table table-bordered table-hover mb-none tbr-top table-export">
					<thead>
						<tr>
							<th>#</th>
					
							<th>State</th>
							<th>Gram Panchayat</th>
							<th>User Join</th>
							
							
						</tr>
					</thead>
					<tbody>
						<?php
						$count = 1;
						 
						foreach ($statelist as $event):
						?>
						<tr>
							<td><?php echo $count++; ?></td>							 
							<td><?php echo $event['state']; ?></td>
							<td><?php echo $event['cnt']; ?></td>
							<td></td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
		 
 
		 
 
</section>
 

<script type="text/javascript">
	$(document).ready(function () {
		$('#daterange').daterangepicker({
			opens: 'left',
		    locale: {format: 'YYYY/MM/DD'}
		});

		$('#branch_id').on('change', function() {
			var branchID = $(this).val();
			$.ajax({
				url: "<?=base_url('ajax/getDataByBranch')?>",
				type: 'POST',
				data: {
					branch_id: branchID,
					table : 'event_types'
				},
				success: function (data) {
					$('#type_id').html(data);
				}
			});
			$("#selected_audience").empty();
		});
		
		$('#audition').on('change', function() {
			var audition = $(this).val();
			var branchID = ($('#branch_id').length ? $('#branch_id').val() : "");
			if(audition == "1" || audition == null)
			{
				$("#selected_user").hide("slow");
			}
			if(audition == "2") {
			    $.ajax({
			        url: base_url + 'ajax/getClassByBranch',
			        type: 'POST',
			        data:{ branch_id: branchID },
			        success: function (data){
			            $('#selected_audience').html(data);
			        }
			    });
				$("#selected_user").show('slow');
				$("#selected_label").html("<?=translate('class')?> <span class='required'>*</span>");
			}
			if(audition == "3"){
				$.ajax({
					url: "<?=base_url('event/getSectionByBranch')?>",
					type: 'POST',
					data: {branch_id: branchID},
					success: function (data) {
						$('#selected_audience').html(data);
					}
				});
				$("#selected_user").show('slow');
				$("#selected_label").html("<?=translate('section')?> <span class='required'>*</span>");
			}
		});
	});
</script>