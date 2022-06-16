<?php $widget = (is_superadmin_loggedin() ? '4' : '6'); ?>
<div class="row">
	<div class="col-md-12">
		<section class="panel">
				<div class="panel-heading">
                    <div class="panel-btn">
						<a href="javascript:void(0);" onclick="mfp_modal('#multipleImport')" class="btn btn-circle btn-default mb-sm">
							<i class="fas fa-plus-circle"></i> <?=translate('multiple_import')?>
						</a>
                    </div>
					<h4 class="panel-title">
						<i class="far fa-user-circle"></i> Add Guest
					</h4>
				</div>
			<?php echo form_open_multipart($this->uri->uri_string()); ?>
				<div class="panel-body">
					<!-- academic details-->
					<div class="headers-line mt-md">
						<i class="fas fa-school"></i> <?=translate('academic_details')?>
					</div>
					 <div class="row">
						<div class="col-md-6 mb-sm">
							<div class="form-group">
								<label class="control-label"><?=translate('name')?> <span class="required">*</span></label>
								<div class="input-group">
									<span class="input-group-addon"><i class="far fa-user"></i></span>
									<input type="text" class="form-control" name="name" value="<?=set_value('name')?>" autocomplete="off" />
								</div>
								<span class="error"><?php echo form_error('name'); ?></span>
							</div>
						</div>
						<div class="col-md-6 mb-sm">
							<div class="form-group">
								<label class="control-label"><?=translate('gender')?></label>
								<?php
									$array = array(
										"" => translate('select'),
										"male" => translate('male'),
										"female" => translate('female')
									);
									echo form_dropdown("sex", $array, set_value('sex'), "class='form-control' data-plugin-selectTwo data-width='100%'
									data-minimum-results-for-search='Infinity'");
								?>
							</div>
						</div> 
					</div>

					<div class="row">
						<div class="col-md-4 mb-sm">
							 <div class="form-group">
						<label class="control-label">Assembly</label>
						 <select id="searchclassid1" required name="state"   >
						<option>Select Assembly</option>
						<?php foreach($statelist as $state) { ?>
						<option value="<?php echo $state['assembly']; ?>" ><?php echo $state['assembly']; ?></option>
						<?php } ?>
						</select  >
					</div>
						</div>
						
						
						<div class="col-md-4 mb-sm">
							 <div class="form-group">
						<label class="control-label">User</label>
						 <select id="searchclassid1" required name="roleuser"   >
						<option selected value="5">Guest</option>
						 <option value="6">Nominee</option>
						</select  >
					</div>
						</div>
						
						
						 
					</div>

					<div class="row">
						<div class="col-md-12 mb-sm">
							<div class="form-group">
								<label class="control-label"><?=translate('mobile_no')?> <span class="required">*</span></label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fas fa-phone-volume"></i></span>
									<input class="form-control" name="mobileno" type="text" value="<?=set_value('mobile_no')?>" autocomplete="off" />
								</div>
								<span class="error"><?php echo form_error('mobile_no'); ?></span>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6 mb-sm">
							<div class="form-group">
								<label class="control-label"><?=translate('present_address')?> <span class="required">*</span></label>
								<textarea class="form-control" rows="2" name="present_address" placeholder="<?=translate('present_address')?>" ><?=set_value('present_address')?></textarea>
							</div>
							<span class="error"><?php echo form_error('present_address'); ?></span>
						</div>
						<div class="col-md-6 mb-sm">
							<div class="form-group">
								<label class="control-label"><?=translate('permanent_address')?></label>
								<textarea class="form-control" rows="2" name="permanent_address" placeholder="<?=translate('permanent_address')?>" ><?=set_value('permanent_address')?></textarea>
							</div>
						</div>
					</div>

		 	 </div>
				<footer class="panel-footer">
					<div class="row">
						<div class="col-md-offset-10 col-md-2">
							<button type="submit" name="submit" value="save" class="btn btn btn-default btn-block"> <i class="fas fa-plus-circle"></i> <?=translate('save')?></button>
						</div>
					</div>
				</footer>
			<?php echo form_close();?>
		</section>
	</div>
</div>

<!-- multiple import modal -->
<div id="multipleImport" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
    <section class="panel">
        <div class="panel-heading">
            <h4 class="panel-title"><i class="fas fa-plus-circle"></i> <?php echo translate('multiple_import'); ?></h4>
        </div>
        <?php echo form_open_multipart('employee/csv_import', array('class' => 'form-horizontal', 'id' => 'importCSV')); ?>
            <div class="panel-body">
            	<div class="alert-danger" id="errorList" style="display: none; padding: 8px;">rthtrhtr</div>
				<div class="form-group mt-md">
					<div class="col-md-12 mb-md">
						<a class="btn btn-default pull-right" href="<?=base_url('employee/csv_Sampledownloader')?>">
							<i class='fas fa-file-download'></i> Download Sample Import File
						</a>
					</div>
					<div class="col-md-12">
						<div class="alert alert-subl">
							<strong>Instructions :</strong><br/>
							1. Download the first sample file.<br/>
							2. Open the downloaded "CSV" file and carefully fill in the employee details.<br/>
							3. The date you are trying to enter the "Date Of Birth" and "Joining Date" column make sure the date format is Y-m-d (<?=date('Y-m-d')?>).<br/>
						</div>
					</div>
				</div>
<?php if (is_superadmin_loggedin()) { ?>
				<div class="form-group">
					<label class="col-md-3 control-label"><?=translate('branch')?> <span class="required">*</span></label>
					<div class="col-md-9">
						<?php
							$arrayBranch = $this->app_lib->getSelectList('branch');
							echo form_dropdown("branch_id", $arrayBranch, set_value('branch_id'), "class='form-control' id='branchID_mod'
							data-plugin-selectTwo data-width='100%' data-minimum-results-for-search='Infinity'");
						?>
						<span class="error"></span>
					</div>
				</div>
<?php } ?>
				<div class="form-group">
					<label class="col-md-3 control-label"><?=translate('role')?> <span class="required">*</span></label>
					<div class="col-md-9">
						<?php
							$role_list = $this->app_lib->getRoles();
							echo form_dropdown("user_role", $role_list, set_value('user_role'), "class='form-control'
							data-plugin-selectTwo data-width='100%' data-minimum-results-for-search='Infinity' ");
						?>
						<span class="error"></span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label"><?=translate('designation')?> <span class="required">*</span></label>
					<div class="col-md-9">
						<?php
							$department_list = $this->app_lib->getDesignation($branch_id);
							echo form_dropdown("designation_id", $department_list, set_value('designation_id'), "class='form-control' id='designationID_mod'
							data-plugin-selectTwo data-width='100%' data-minimum-results-for-search='Infinity'");
						?>
						<span class="error"></span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label"><?=translate('department')?> <span class="required">*</span></label>
					<div class="col-md-9">
						<?php
							$department_list = $this->app_lib->getDepartment($branch_id);
							echo form_dropdown("department_id", $department_list, set_value('department_id'), "class='form-control' id='departmentID_mod'
							data-plugin-selectTwo data-width='100%' data-minimum-results-for-search='Infinity'");
						?>
						<span class="error"></span>
					</div>
				</div>
				<div class="form-group mb-xs">
					<label class="control-label col-md-3">Select CSV File <span class="required">*</span></label>
					<div class="col-md-9">
						<input type="file" name="userfile" class="dropify" data-height="70" data-allowed-file-extensions="csv" />
						<span class="error"></span>
					</div>
				</div>
            </div>
            <footer class="panel-footer">
                <div class="row">
                    <div class="col-md-12 text-right">
                        <button type="submit" class="btn btn-default mr-xs" id="bankaddbtn" data-loading-text="<i class='fas fa-spinner fa-spin'></i> Processing">
                            <i class="fas fa-plus-circle"></i> <?php echo translate('import'); ?>
                        </button>
                        <button class="btn btn-default modal-dismiss"><?php echo translate('close'); ?></button>
                    </div>
                </div>
            </footer>
        <?php echo form_close(); ?>
    </section>
</div>