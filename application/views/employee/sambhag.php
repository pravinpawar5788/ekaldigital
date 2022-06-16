<div class="row">
<?php if (get_permission('department', 'is_add')): ?>
	<div class="col-md-5">
		<section class="panel">
			<header class="panel-heading">
				<h4 class="panel-title"><i class="far fa-edit"></i> <?php echo translate('add') . " " . translate('sambhag'); ?></h4>
			</header>
			<?php echo form_open($this->uri->uri_string()); ?>
				<div class="panel-body">
				<?php if (is_superadmin_loggedin()): ?>
					<!--<div class="form-group">
						<label class="control-label"><?=translate('state')?> <span class="required">*</span></label>-->
						<?php
						//$arrayBranch = $this->app_lib->getStateList('ekal_state'); 
						
						//echo form_dropdown("state", $arrayBranch, set_value('state'), "class='form-control' onchange='getPrabhagByState(this.value)' data-plugin-selectTwo data-width='100%' data-minimum-results-for-search='Infinity'");
					?>
					<!--</div>-->
					
					<div class="form-group">
						<label class="control-label"><?=translate('select prabhag')?> <span class="required">*</span></label>
						<?php
						$arrayPrabhag = $this->app_lib->getPrabhagList('ekal_prabhag');
						//$arrayPrabhag = $this->app_lib->getClass($branch_id);
						echo form_dropdown("p_name", $arrayPrabhag, set_value('p_name'), "class='form-control' id='p_name'
						data-plugin-selectTwo data-width='100%' data-minimum-results-for-search='Infinity'");
					?>
					</div>
					
				<?php endif; ?>
					<div class="form-group mb-md">
						<label class="control-label"><?=translate('Sambhag name')?><span class="required">*</span></label>
						<input type="text" class="form-control" name="sambhag_name" value="<?php echo set_value('sambhag_name'); ?>" />
						<span class="error"><?=form_error('sambhag_name')?></span>
					</div>
				</div>
				<div class="panel-footer">
					<div class="row">
						<div class="col-md-12">
							<button class="btn btn-default pull-right" type="submit"><i class="fas fa-plus-circle"></i> <?php echo translate('save'); ?></button>
						</div>	
					</div>
				</div>
			<?php echo form_close(); ?>
		</section>
	</div>
<?php endif; ?>
<?php if (get_permission('department', 'is_view')): ?>
	<div class="col-md-<?php if (get_permission('department', 'is_add')){ echo "7"; }else{echo "12";} ?>">
		<section class="panel">
			<header class="panel-heading">
				<h4 class="panel-title"><i class="fas fa-list-ul"></i> <?php echo translate('prabhag') . " " . translate('list'); ?></h4>
			</header>
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-bordered table-hover table-condensed mb-none">
						<thead>
							<tr>
								<th><?php echo translate('sl'); ?></th>
								
								<th><?php echo translate('prabhag'); ?></th>
								<th><?php echo translate('sambhag'); ?></th>
								<th>Status</th>
								<th><?php echo translate('action'); ?></th>
							</tr>
						</thead>
						<tbody>
						<?php
						$count = 1;
						if (count($sambhag)) {
							foreach ($sambhag as $row):
						?>
							<tr>
								<td><?php echo $count++; ?></td>
								
								<td><?php echo $row['p_name']; ?></td>
								<td><?php echo $row['s_name']; ?></td>
								 <td class="mailbox-name"> 
											<label class="switch">
											  <input type="checkbox" <?php  if($row['status'] == '1') { echo "checked";}  ?>  onchange="getstatus(this.value, <?php echo $row['id'] ?>)">
											  <span class="slider round"></span>
											</label>
																						 </td>
								<td class="min-w-xs">
								<?php if (get_permission('department', 'is_edit')): ?>
									<a class="btn btn-default btn-circle icon" href="javascript:void(0);" onclick="getSambhagDetails('<?=$row['id']?>')">
										<i class="fas fa-pen-nib"></i>
									</a>
								<?php  endif; if (get_permission('department', 'is_delete')): ?>
									<?php echo btn_delete('employee/sambhag_delete/' . $row['id']); ?>
								<?php endif; ?>
								</td>
							</tr>
						<?php
							endforeach;
						}else{
								echo '<tr><td colspan="4"><h5 class="text-danger text-center">' . translate('no_information_available') . '</td></tr>';
						}
						?>
						</tbody>
					</table>
				</div>
			</div>
		</section>
	</div>
</div>
<?php endif; ?>
<?php if (get_permission('department', 'is_edit')): ?>
<div class="zoom-anim-dialog modal-block modal-block-primary mfp-hide" id="modal">
	<section class="panel">
		<header class="panel-heading">
			<h4 class="panel-title"><i class="far fa-edit"></i> <?php echo translate('edit') . " " . translate('sambhag'); ?></h4>
		</header>
		<?php echo form_open('employee/sambhag_edit', array('class' => 'frm-submit')); ?>
			<div class="panel-body">
				<input type="hidden" name="department_id" id="edepartment_id" value="" />
			<?php if (is_superadmin_loggedin()): ?>
				
			
			
			       <div class="form-group mb-md">
						<label class="control-label"><?=translate('select prabhag')?> <span class="required">*</span></label>
						<?php
						$arrayPrabhag = $this->app_lib->getPrabhagList('ekal_prabhag');
						//$arrayPrabhag = $this->app_lib->getClass($branch_id);
						echo form_dropdown("p_name", $arrayPrabhag, set_value('p_name'), "class='form-control' id='ebranch_id'
						data-plugin-selectTwo data-width='100%' data-minimum-results-for-search='Infinity'");
					?>
					</div>
			
				<div class="form-group mb-md">
					<label class="control-label"><?php echo translate('sambhag name'); ?> <span class="required">*</span></label>
					<input type="text" class="form-control" value="" name="sambhag_name" id="cdepartment_name" />
					<span class="error"></span>
				</div>
				<?php endif; ?>
			</div>
			<footer class="panel-footer">
				<div class="row">
					<div class="col-md-12 text-right">
						<button type="submit" class="btn btn-default" data-loading-text="<i class='fas fa-spinner fa-spin'></i> Processing">
							<i class="fas fa-plus-circle"></i> <?php echo translate('update'); ?>
						</button>
						<button class="btn btn-default modal-dismiss"><?php echo translate('cancel'); ?></button>
					</div>
				</div>
			</footer>
		<?php echo form_close(); ?>
	</section>
</div>
<?php endif; ?>

<script>
	 
	 function getstatus(cid, id) {
        
      
        var base_url = '<?php echo base_url() ?>';       
        $.ajax({
            type: "POST",
            url: base_url + "employee/exampublishstatus",
            data: {'id': id},
            dataType: "json",
            success: function (data) {
   
                // alert(data);
            }
        });
    }
    ;
	</script>
	
	
	<style>
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>
 