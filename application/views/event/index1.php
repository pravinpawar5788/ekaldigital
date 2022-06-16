<section class="panel">
	<div class="tabs-custom">
		<ul class="nav nav-tabs">
			<li class="active">
                <a href="#list" data-toggle="tab">
                    <i class="fas fa-list-ul"></i> <?=translate('event_list')?>
                </a>
			</li>
<?php if (get_permission('event', 'is_add')): ?>
			<li>
                <a href="#add" data-toggle="tab">
                   <i class="far fa-edit"></i> <?=translate('create_event')?>
                </a>
			</li>
<?php endif; ?>
		</ul>
		<div class="tab-content">
			<div class="tab-pane box active mb-md" id="list">
				<table class="table table-bordered table-hover mb-none tbr-top table-export">
					<thead>
						<tr>
							<th>#</th>
					
							<th><?=translate('title')?></th>
							<th>Meeting Start</th>
							
							<th>Date</th>
							<th>Time</th>
							 <th>Show Meeting</th>
							 <th>Join Meeting</th>
							<th><?=translate('action')?></th>
								<th>History</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$count = 1;
						if (!is_superadmin_loggedin()) {
							$this->db->where('branch_id', get_loggedin_branch_id());
						}
						$this->db->order_by('id', 'desc');
						$events = $this->db->get('video_training')->result();
						foreach ($events as $event):
						?>
						<tr>
							<td><?php echo $count++; ?></td>							 
							<td><?php echo $event->name; ?></td>
							 <td><a href="https://stage.simplifiedvc.com/app/login?username=admin&password=admin123&mid=<?php echo $event->meetingname; ?>" target="_blank">Start</a></td>
							<td><?php echo _d($event->plandate);?></td>
							 <td><?php echo  ($event->plantime);?></td>
							
							<td>
							<?php if (get_permission('event', 'is_edit')) { ?>
								<div class="material-switch ml-xs">
									<input class="event-switch" id="switch_<?=$event->id?>" data-id="<?=$event->id?>" name="evt_switch<?=$event->id?>" 
									type="checkbox" <?php echo ($event->active == 1 ? 'checked' : ''); ?> />
									<label for="switch_<?=$event->id?>" class="label-primary"></label>
								</div>
								
								
							<?php } ?>
							</td>
							
								<td>
							<?php if (get_permission('event', 'is_edit')) { ?>
								<div class="material-switch ml-xs">
									<input class="event-switch1" id="switch1_<?=$event->id?>" data-id="<?=$event->id?>" name="evt_switch1<?=$event->id?>" 
									type="checkbox" <?php echo ($event->joinstatus == 1 ? 'checked' : ''); ?> />
									<label for="switch1_<?=$event->id?>" class="label-primary"></label>
								</div>
								
								
							<?php } ?>
							</td>
							
							
							<td>
							<a href="<?php echo base_url(); ?>event1/editevent/<?=$event->id?>" class="btn btn-circle btn-default icon"  >
									<i class="far fa-edit"></i>
						    </a>	
							<a href="<?php echo base_url(); ?>event1/assignuserassembly/<?=$event->id?>" class="btn btn-circle btn-default icon"  >
									<i class="far fa-calendar-check"></i>
						    </a>
							<a href="<?php echo base_url(); ?>event1/assignuser1/<?=$event->id?>" class="btn btn-circle btn-default icon"  >
									<i class="far fa-user"></i>
						    </a>
							<a target="_blank" href="<?php echo base_url(); ?>webservices/getuserjoinmeeting/<?=$event->id?>" class="btn btn-circle btn-default icon"  >
									<i class="far fa-right"></i>
						    </a>
							<!--	<?php if (get_permission('event', 'is_delete')) { ?>
								
								<?php echo btn_delete('event/delete/'.$event->id);?>
							<?php } ?> -->
							</td>
							<td><a href="<?php echo base_url(); ?>event1/privioushistory/<?=$event->id?>" class="btn btn-circle btn-default icon"  >
									<i class="fa fa-share"></i>
						    </a> </td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
<?php if (get_permission('event', 'is_add')): ?>
			<div class="tab-pane" id="add">
					<?php echo form_open($this->uri->uri_string(), array('class' => 'form-bordered form-horizontal frm-submit'));?>
					 
					<div class="form-group">
						<label class="col-md-3 control-label"><?=translate('title')?> <span class="required">*</span></label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="title" required  value="" />
							<span class="error"></span>
						</div>
					</div>				 
					 
					 
							<div class="form-group">
								<label class="col-md-3 control-label">Meeting Date <span class="required">*</span></label>
								<div class="col-md-4">
								<div class="input-group">
									<span class="input-group-addon"><i class="far fa-calendar-alt"></i></span>
									<input type="text" required class="form-control" name="joining_date" data-plugin-datepicker data-plugin-options='{ "todayHighlight" : true }'
									autocomplete="off" value="<?=set_value('joining_date')?>" />
								</div>
								<span class="error"><?php echo form_error('joining_date'); ?></span>
							</div>
							
							<div class="col-md-2">
									<div class="input-group">
										<span class="input-group-addon"><i class="far fa-clock"></i></span>
										<input type="text" data-plugin-timepicker class="form-control" name="time_start" value="<?php echo set_value('time_start'); ?>" />
									</div>
									<span class="error"></span>
								</div>
							
							
							</div>
						 
						 <input type="hidden" name="state[]" value="">
						 <!--<div class="form-group">
						<label class="control-label col-md-3">Select Assembly <span class="required">*</span></label>
<div class="col-md-9">						
						<select required   name='state[]'  class='form-control mb-sm' id='section_id' data-plugin-selectTwo data-width='100%' multiple data-plugin-options='{" . '"placeholder" : "' . translate('select_branch_first') . '" ' ."}' >
						<option>All Assembly</option>
						<?php   foreach($statelist as $state) { ?>
						<option value="<?php echo $state['assembly']; ?>" ><?php echo $state['assembly']; ?></option>
						<?php } ?>
						</select  >
					</div> 
					</div>  -->
						 
						 
						 
						
					<div class="form-group">
						<label class="col-md-3 control-label"><?=translate('description')?></label>
						<div class="col-md-6">
							<textarea name="remarks" class="summernote"></textarea>
						</div>
					</div>
					
					
					 <div class="form-group">
						<label class="control-label col-md-3">Type  <span class="required">*</span></label>
<div class="col-md-9">						
						<select required   name='videotype'  class='form-control mb-sm'  >
						<option>Select Type</option>
						 <option value="Live Stream">Live Stream</option>
						 <option value="Health Fitness">Health Fitness</option>
						 <option value="Prawachan">Prawachan</option>
						</select  >
					</div> 
					</div> 
				
					<footer class="panel-footer">
						<div class="row">
							<div class="col-md-offset-3 col-md-2">
								<button type="submit" class="btn btn-default btn-block" data-loading-text="<i class='fas fa-spinner fa-spin'></i> Processing">
									<i class="fas fa-plus-circle"></i> <?=translate('save')?>
								</button>
							</div>
						</div>
					</footer>
				<?php echo form_close(); ?>
			</div>
<?php endif; ?>
		</div>
	</div>
</section>
<div class="zoom-anim-dialog modal-block modal-block-primary mfp-hide" id="modal">
	<section class="panel">
		<header class="panel-heading">
			<div class="panel-btn">
				<button onclick="fn_printElem('printResult')" class="btn btn-default btn-circle icon" ><i class="fas fa-print"></i></button>
			</div>
			<h4 class="panel-title"><i class="fas fa-info-circle"></i> <?=translate('event_details')?></h4>
		</header>
		<div class="panel-body">
			<div id="printResult" class="pt-sm pb-sm">
				<div class="table-responsive">						
					<table class="table table-bordered table-condensed text-dark tbr-top" id="ev_table"></table>
				</div>
			</div>
		</div>
		<footer class="panel-footer">
			<div class="row">
				<div class="col-md-12 text-right">
					<button class="btn btn-default modal-dismiss">
						<?=translate('close')?>
					</button>
				</div>
			</div>
		</footer>
	</section>
</div>

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