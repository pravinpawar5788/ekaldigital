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
						<i class="far fa-user-circle"></i> <?=translate('add_employee')?>
					</h4>
				</div>
			<?php echo form_open_multipart($this->uri->uri_string()); ?>
				<div class="panel-body">
					<!-- academic details-->
					<!--<div class="headers-line mt-md">
						<i class="fas fa-school"></i> <?=translate('academic_details')?>
					</div>-->
	<!--				<div class="row">
<?php if (is_superadmin_loggedin()) { ?>
<div class="col-md-4 mb-sm">
 <div class="form-group">
						<label class="control-label"><?=translate('select prabhag')?> </label>
						<?php
						$arrayPrabhag = $this->app_lib->getPrabhagList('ekal_prabhag');
						//$arrayPrabhag = $this->app_lib->getClass($branch_id);
						echo form_dropdown("p_name", $arrayPrabhag, set_value('p_name'), "class='form-control' id='p_name' onchange='getSambhagByPrabhag(this.value)'
						data-plugin-selectTwo data-width='100%' data-minimum-results-for-search='Infinity'");
					?>
					</div>
</div>
<div class="col-md-4 mb-sm">
<div class="form-group">
						<label class="control-label"><?=translate('select sambhag')?> </label>
						<?php
						$arrayPrabhag = $this->app_lib->getPrabhagSamList(set_value('p_name'));
						//$arrayPrabhag = $this->app_lib->getClass($branch_id);
						echo form_dropdown("s_name", $arrayPrabhag, set_value('s_name'), "class='form-control' id='s_name' onchange='getBhagBySambhag(this.value)'
						data-plugin-selectTwo data-width='100%' data-minimum-results-for-search='Infinity'");
					?>
					</div> 
</div>
<div class="col-md-4 mb-sm">
<div class="form-group">
						<label class="control-label"><?=translate('select bhag')?> </label>
						<?php
						$arrayPrabhag = $this->app_lib->getSambhagBhagList(set_value('s_name'));
						//$arrayPrabhag = $this->app_lib->getClass($branch_id);
						echo form_dropdown("b_name", $arrayPrabhag, set_value('b_name'), "class='form-control' id='b_name' onchange='getAnchalByBhag(this.value)'
						data-plugin-selectTwo data-width='100%' data-minimum-results-for-search='Infinity'");
					?>
					</div> 
</div>
<div class="col-md-4 mb-sm">
<div class="form-group">
						<label class="control-label"><?=translate('select anchal')?> </label>
						<?php
						$arrayPrabhag = $this->app_lib->getBhagAnchalList(set_value('b_name')); 
						//$arrayPrabhag = $this->app_lib->getClass($branch_id);
						echo form_dropdown("a_name", $arrayPrabhag, set_value('a_name'), "class='form-control' id='a_name'  onchange='getSanchByAnchal(this.value)'
						data-plugin-selectTwo data-width='100%' data-minimum-results-for-search='Infinity'");
					?>
					</div> 
</div>
<div class="col-md-4 mb-sm">
<div class="form-group">
								<label class="control-label"><?=translate('branch')?> </label>
								<?php
									$arrayBranch = $this->app_lib->getSanchList(set_value('a_name'));
									echo form_dropdown("branch_id", $arrayBranch, set_value('branch_id'), "class='form-control' id='branch_id'
									data-plugin-selectTwo data-width='100%' data-minimum-results-for-search='Infinity'");
								?>
								<span class="error"><?php echo form_error('branch_id'); ?></span>
							</div>
</div>
						 
<?php } ?> -->
						 <!--<div class="col-md-<?=$widget?> mb-sm">
							<div class="form-group">
								<label class="control-label"><?=translate('role')?> <span class="required">*</span></label>
								<?php
									 $role_list = $this->app_lib->getRoles();
									echo form_dropdown("user_role", $role_list, set_value('user_role'), "class='form-control'
									data-plugin-selectTwo data-width='100%' data-minimum-results-for-search='Infinity' "); 
								?>
								
								<span class="error"><?php echo form_error('user_role'); ?></span>
							</div>
						</div> -->
						 
						<!--<div class="col-md-<?=$widget?> mb-sm">
							<div class="form-group">
								<label class="control-label"><?=translate('joining_date')?> <span class="required">*</span></label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fas fa-birthday-cake"></i></span>
									<input type="text" class="form-control" name="joining_date" data-plugin-datepicker data-plugin-options='{ "todayHighlight" : true }'
									autocomplete="off" value="<?=set_value('joining_date')?>" />
								</div>
								<span class="error"><?php echo form_error('joining_date'); ?></span>
							</div>
						</div>
					</div>-->

						<!--<div class="row mb-lg">
					<div class="col-md-4 mb-sm">
							<div class="form-group">
								<label class="control-label"><?=translate('designation')?> <span class="required">*</span></label>
								<?php
									$department_list = $this->app_lib->getDesignation($branch_id);
									echo form_dropdown("designation_id", $department_list, set_value('designation_id'), "class='form-control' id='designation_id'
									data-plugin-selectTwo data-width='100%' data-minimum-results-for-search='Infinity'");
								?>
								<span class="error"><?php echo form_error('designation_id'); ?></span>
							</div>
						</div>
						<div class="col-md-4 mb-sm">
							<div class="form-group">
								<label class="control-label"><?=translate('department')?> <span class="required">*</span></label>
								<?php
									$department_list = $this->app_lib->getDepartment($branch_id);
									echo form_dropdown("department_id", $department_list, set_value('department_id'), "class='form-control' id='department_id'
									data-plugin-selectTwo data-width='100%' data-minimum-results-for-search='Infinity'");
								?>
								<span class="error"><?php echo form_error('department_id'); ?></span>
							</div>
						</div> -->
						<!--<div class="col-md-4 mb-sm">
							<div class="form-group">
								<label class="control-label"><?=translate('Responsibility')?> <span class="required">*</span></label>
								<input type="text" class="form-control" name="qualification" value="<?=set_value('qualification')?>">
								<span class="error"><?php echo form_error('qualification'); ?></span>
							</div>
						</div>
					</div>-->


















					<!-- employee details -->
					<div class="headers-line mt-md">
						<i class="fas fa-user-check"></i> <?=translate('employee_details')?>
					</div>
					<div class="row">		
					<div class="col-md-6 mb-sm">
							<div class="form-group">
								<label class="control-label"><?=translate('role')?><span class="required">*</span></label>
								<?php
									 $role_list = $this->app_lib->getRoles();
									echo form_dropdown("user_role", $role_list, set_value('user_role'), "class='form-control'
									data-plugin-selectTwo data-width='100%' data-minimum-results-for-search='Infinity' "); 
								?>
								
								<span class="error"><?php echo form_error('user_role'); ?></span>
							</div>
						</div> 
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
								<label class="control-label"><?=translate('religion')?></label>
								<!--<input type="text" class="form-control" name="religion" value="<?=set_value('religion')?>">-->
								<?php
									$array = array(
										"" => translate('select'),
										"Hindu" => translate('Hindu'),
										"Christian" => translate('Christian'),
										"Sikh" => translate('Sikh'),
										"Buddhist" => translate('Buddhist'),
										"Jain" => translate('Jain'),
										"Muslim" => translate('Muslim'),
										"Other" => translate('Other')
									);
									echo form_dropdown("religion", $array, set_value('religion'), "class='form-control' data-plugin-selectTwo data-width='100%'
									data-minimum-results-for-search='Infinity'");
								?>
							</div>
						</div>
						<div class="col-md-4 mb-sm">
							<div class="form-group">
								<label class="control-label">Cast</label>
								<?php
									$array = array(
										"" => translate('select'),
										"GC" => translate('GC'),
										"OBC" => translate('OBC'),
										"ST" => translate('ST'),
										"SC" => translate('SC'),
										"SBC" => translate('SBC'),
										"SEBC" => translate('SEBC'),
										"VJ" => translate('VJ'),
										"NT-B" => translate('NT-B'),
										"NT-C" => translate('NT-C'),
										"NT-D" => translate('NT-D'),
										"Other" => translate('Other')
									);
									echo form_dropdown("cast", $array, set_value('cast'), "class='form-control' data-plugin-selectTwo data-width='100%'
									data-minimum-results-for-search='Infinity'");
								?>
							</div>
						</div>
						<div class="col-md-4 mb-sm">
							<div class="form-group">
								<label class="control-label">Employeed</label>
								<?php
									$array = array(
										"" => translate('select'),
										"Unemployeed" => translate('Unemployeed'),
										"Selfemployeed" => translate('Selfemployeed'),
										"Salaried" => translate('Salaried'),
										"Business" => translate('Business'),
										"Professional" => translate('Professional')
									);
									echo form_dropdown("emptype", $array, set_value('emptype'), "class='form-control' data-plugin-selectTwo data-width='100%'
									data-minimum-results-for-search='Infinity'");
								?>
							</div>
						</div>

						<div class="col-md-4 mb-sm">
							<div class="form-group">
								<label class="control-label"><?=translate('birthday')?> </label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fas fa-birthday-cake"></i></span>
									<input class="form-control" name="birthday" autocomplete="off" value="<?=set_value('birthday')?>" data-plugin-datepicker
									data-plugin-options='{ "startView": 2 }' type="text">
								</div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-12 mb-sm">
							<div class="form-group">
								<label class="control-label"><?=translate('mobile_no')?> <span class="required">*</span></label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fas fa-phone-volume"></i></span>
									<input class="form-control" name="mobile_no" type="text" value="<?=set_value('mobile_no')?>" autocomplete="off" />
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

					<!--custom fields details-->
					<div class="row" id="customFields">
						<?php echo render_custom_Fields('employee'); ?>
					</div>
					
					<div class="row mb-md">
						<div class="col-md-12">
							<div class="form-group">
								<label for="input-file-now"><?=translate('profile_picture')?></label>
								<input type="file" name="user_photo" class="dropify" />
								<span class="error"><?php echo form_error('user_photo'); ?></span>
							</div>
						</div>
					</div>
					
					<div class="headers-line">
						<i class="fas fa-user-lock"></i> Personal Details
					</div>
					<div class="row">
						<div class="col-md-6 mb-sm">
							<div class="form-group">
								<label class="control-label">Voter ID<span class="required">*</span></label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-id-card-o"></i></span>
									<input class="form-control" name="vooter_id" type="text" autocomplete="off" />
								</div>

							</div>
						</div>
					</div>	
					<div class="row">		
					<div class="col-md-6 mb-sm">
					<div class="form-group">
						<label class="control-label">Select State</label>       
						<select id="searchclassid1" required name="state"  class="form-control" onchange="getSubject(this.value, 'subid5')">
						<option>Select State</option>
						<?php foreach($statelist as $state) { ?>
						<option value="<?php echo $state['state']; ?>" ><?php echo $state['state']; ?></option>
						<?php } ?>
						</select>
					</div>
					</div>
					<div class="col-md-6 mb-sm">
					<div class="form-group">
						<label class="control-label">Select District</label>       	
						<select id="subid5" name="subject_id" required   class="form-control" onchange="getChapter('searchclassid1', this.value, 'chaid1')">
						<option>District</option>
						</select > 
					</div>
					</div>
					
                     </div>
				<div class="row">
					<div class="col-md-6 mb-sm">
					<div class="form-group">
						<label class="control-label">Select Lok Sabha Constituency</label>       	
						<select  id="chaid1" name="chapterid" required   class="form-control" onchange="getTopicodia('searchclassid1', this.value, 'subid1')" >
						<option>Lok Sabha Constituency </option>
						</select > 
					</div>
					</div>
					<div class="col-md-6 mb-sm">
					<div class="form-group">
						<label class="control-label">Select Assembly Constituency</label>       						 
				       	<select id="subid1" name="assembly"  required class="form-control">
						<option>Assembly Constituency </option>
						</select > 
					</div>
					</div>
					
                 </div>
				<!-- <div class="row">
					<div class="col-md-6 mb-sm">
					<div class="form-group">
						<label class="control-label">Select Lok Sabha Constituency</label>       	
						<select  name="chapterid" required   class="form-control" >
						<option value="goa">Goa </option>
						</select > 
					</div>
					</div>
					<div class="col-md-6 mb-sm">
					<div class="form-group">
						<label class="control-label">Select Assembly Constituency</label>       						 
				       	<select  name="assembly"  required class="form-control">
						<option value="goa">Goa </option>
						</select > 
					</div>
					</div>
					
                 </div>-->
				 
					<div class="row">	
						<div class="col-md-6 mb-sm">
							<div class="form-group">
								<label class="control-label">Select Grampanchayat/Muncipal Corporation <span class="required">*</span></label>
								<?php
									$array = array(
										"" => translate('select'),
										"Grampanchayat" => translate('Grampanchayat'),
										"MuncipalCorporation" => translate('MuncipalCorporation')
									);
									echo form_dropdown("selectgram", $array, set_value('selectgram'), "class='form-control' data-plugin-selectTwo data-width='100%'
									data-minimum-results-for-search='Infinity'");
								?>
							</div>
						</div>
						
						<div class="col-md-6 mb-sm">
							<div class="form-group">
								<label class="control-label">Booth No<span class="required">*</span></label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-id-card-o"></i></span>
									<input class="form-control" name="booth_no" type="text" autocomplete="off" />  
								</div>

							</div>
						</div>
				
					</div>
					
					<div class="row">	
						<div class="col-md-4 mb-sm">
							<div class="form-group">
								<label class="control-label">Select Block</label>
								<select  id="blkid" name="gramblock" required   class="form-control" onchange="getvillage('blkid', this.value, 'vilgid')">
								<option>select</option>	
								</select>
								
								<!--<?php
									$array = array(
										"" => translate('select'),
										"Grampanchayat" => translate('Grampanchayat')
									);
									echo form_dropdown("gramblock", $array, set_value('gramblock'), "class='form-control' data-plugin-selectTwo data-width='100%'
									data-minimum-results-for-search='Infinity'");
								?>-->
							</div>
						</div>
						<div class="col-md-4 mb-sm">
							<div class="form-group">
								<label class="control-label">Select Village</label>
								<select  id="vilgid" name="gramvillage" required   class="form-control" onchange="getgrampanchayat('vilgid', this.value, 'gramid')">
								<option>select</option>	
								</select >
								
							</div>
						</div>
						<div class="col-md-4 mb-sm">
							<div class="form-group">
								<label class="control-label">Select Grampanchayat</label>
								<select  id="gramid" name="grampanchayat" required   class="form-control">
								<option>select</option>	
								</select >
			
							</div>
						</div>
					</div>
					<!--<div class="row MuncipalCorporation box">	
						<div class="col-md-4 mb-sm">
							<div class="form-group">
								<label class="control-label">Select Block</label>
								<?php
									$array = array(
										"" => translate('select'),
										"MuncipalCorporation" => translate('Muncipal Corporation')
									);
									echo form_dropdown("muncipalblock", $array, set_value('muncipalblock'), "class='form-control' data-plugin-selectTwo data-width='100%'
									data-minimum-results-for-search='Infinity'");
								?>
							</div>
						</div>
						<div class="col-md-4 mb-sm">
							<div class="form-group">
								<label class="control-label">Select Village</label>
								<?php
									$array = array(
										"" => translate('select'),
										"MuncipalCorporation" => translate('Muncipal Corporation')
									);
									echo form_dropdown("muncipalvillage", $array, set_value('muncipalvillage'), "class='form-control' data-plugin-selectTwo data-width='100%'
									data-minimum-results-for-search='Infinity'");
								?>
							</div>
						</div>
						<div class="col-md-4 mb-sm">
							<div class="form-group">
								<label class="control-label">Select Muncipal Corporation</label>
								<?php
									$array = array(
										"" => translate('select'),
										"MuncipalCorporation" => translate('Muncipal Corporation')
									);
									echo form_dropdown("muncipalcorp", $array, set_value('muncipalcorp`'), "class='form-control' data-plugin-selectTwo data-width='100%'
									data-minimum-results-for-search='Infinity'");
								?>
							</div>
						</div>
					</div>-->
					
					<div class="row">
						<div class="col-md-4 mb-sm">
							<div class="form-group">
								<label class="control-label">Number of Family Members</label>
                                 <!--<button type="button" id="add">Add Other Members</button>-->
								<input type="number" class="form-control" name="familymember" autocomplete="off">														
							</div>
						</div>					            
					</div>
                  <!-- <div class="row">
				    <div id="dynamic_field"></div>
                    <!--<button type="button" class="btn_remove hidden">Remove last</button>--
                   </div>	-->
					




					<!-- login details -->
					<div class="headers-line">
						<i class="fas fa-user-lock"></i> <?=translate('login_details')?>
					</div>

					<div class="row mb-lg">
						<div class="col-md-6 mb-sm">
							<div class="form-group">
								<label class="control-label"><?=translate('kid')?> <span class="required">*</span></label>
								<div class="input-group">
									<span class="input-group-addon"><i class="far fa-envelope-open"></i></span>
									<input type="text" class="form-control" name="email" id="email" value="<?=set_value('email')?>" autocomplete="off" />
								</div>
								<span class="error"><?php echo form_error('email'); ?></span>
							</div>
						</div>
						<div class="col-md-3 mb-sm">
							<div class="form-group">
								<label class="control-label"><?=translate('password')?> <span class="required">*</span></label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fas fa-unlock-alt"></i></span>
									<input type="password" class="form-control" name="password" value="<?=set_value('password')?>" />
								</div>
								<span class="error"><?php echo form_error('password'); ?></span>
							</div>
						</div>
						<div class="col-md-3 mb-sm">
							<div class="form-group">
								<label class="control-label"><?=translate('retype_password')?> <span class="required">*</span></label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fas fa-unlock-alt"></i></span>
									<input type="password" class="form-control" name="retype_password" value="<?=set_value('retype_password')?>" />
								</div>
								<span class="error"><?php echo form_error('retype_password'); ?></span>
							</div>
						</div>
					</div>

                <!--
					<!-- social links --
					<div class="headers-line">
						<i class="fas fa-globe"></i> <?=translate('social_links')?>
					</div>

					<div class="row mb-lg">
						<div class="col-md-4 mb-sm">
							<div class="form-group">
								<label class="control-label">Facebook</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fab fa-facebook-f"></i></span>
									<input type="text" class="form-control" name="facebook" value="<?=set_value('facebook')?>" placeholder="eg: https://www.facebook.com/username" />
								</div>
								<span class="error"><?php echo form_error('facebook'); ?></span>
							</div>
						</div>
						<div class="col-md-4 mb-sm">
							<div class="form-group">
								<label class="control-label">Twitter</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fab fa-twitter"></i></span>
									<input type="text" class="form-control" name="twitter" value="<?=set_value('twitter')?>" placeholder="eg: https://www.twitter.com/username" />
								</div>
								<span class="error"><?php echo form_error('twitter'); ?></span>
							</div>
						</div>
						<div class="col-md-4 mb-sm">
							<div class="form-group">
								<label class="control-label">Linkedin</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fab fa-linkedin-in"></i></span>
									<input type="text" class="form-control" name="linkedin" value="<?=set_value('linkedin')?>" placeholder="eg: https://www.linkedin.com/username" />
								</div>
								<span class="error"><?php echo form_error('linkedin'); ?></span>
							</div>
						</div>
					</div>

					<!-- bank details --
					<div class="headers-line">
						<i class="fas fa-university"></i> <?=translate('bank_details')?>
					</div>
					<div class="mb-sm checkbox-replace">
						<label class="i-checks"><input type="checkbox" name="chkskipped" id="chk_bank_skipped" value="true" <?=set_checkbox('chkskipped', 'true')?> >
							<i></i> <?=translate('skipped_bank_details')?>
						</label>
					</div>
					<div id="bank_details_form" <?php if(!empty(set_value('chkskipped'))) { ?> style="display: none" <?php } ?>>
						<div class="row">
							<div class="col-md-4 mb-sm">
								<div class="form-group">
									<label class="control-label"><?=translate('bank_name')?> <span class="required">*</span></label>
									<input type="text" class="form-control" name="bank_name" value="<?=set_value('bank_name')?>" />
								</div>
								<span class="error"><?php echo form_error('bank_name'); ?></span>
							</div>
							<div class="col-md-4 mb-sm">
								<div class="form-group">
									<label class="control-label"><?=translate('account_name')?> <span class="required">*</span></label>
									<input type="text" class="form-control" name="account_name" value="<?=set_value('account_name')?>" />
									<span class="error"><?php echo form_error('account_name'); ?></span>
								</div>
							</div>
							<div class="col-md-4 mb-sm">
								<div class="form-group">
									<label class="control-label"><?=translate('bank') . ' ' . translate('branch')?> <span class="required">*</span></label>
									<input type="text" class="form-control" name="bank_branch" value="<?=set_value('bank_branch')?>" />
									<span class="error"><?php echo form_error('bank_branch'); ?></span>
								</div>
							</div>
						</div>

						<div class="row mb-lg">
							<div class="col-md-4 mb-sm">
								<div class="form-group">
									<label class="control-label"><?=translate('bank_address')?></label>
									<input type="text" class="form-control" name="bank_address" value="<?=set_value('bank_address')?>" />
								</div>
							</div>
							<div class="col-md-4 mb-sm">
								<div class="form-group">
									<label class="control-label"><?=translate('ifsc_code')?></label>
									<input type="text" class="form-control" name="ifsc_code" value="<?=set_value('ifsc_code')?>" />
								</div>
							</div>
							<div class="col-md-4 mb-sm">
								<div class="form-group">
									<label class="control-label"><?=translate('account_no')?> <span class="required">*</span></label>
									<input type="text" class="form-control" name="account_no" value="<?=set_value('account_no')?>" />
									<span class="error"><?php echo form_error('account_no'); ?></span>
								</div>
							</div>
						</div>
					</div>-->
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
<style>
.hidden {
  display: none;
}
</style>
<script>
$(document).ready(function() {
  var i = 1;
  $('#add').click(function() {
    if (i <= 3) {
      $('#dynamic_field').append('<div id="row"><div class="col-md-4 mb-sm"><div class="form-group"><label" for="fmname" class="control-label">Name </label><input type="text" class="form-control" name="fmname[]"></div></div><div class="col-md-4 mb-sm"><div class="form-group"><label" for="fmemail" class="control-label">Email </label><input type="text" class="form-control" name="fmemail[]"></div></div><div class="col-md-4 mb-sm"><div class="form-group"><label" for="fmphone" class="control-label">Phone</label><input type="text" class="form-control" name="fmphone[]"></div></div></div>')
      i++;
      $('.btn_remove').removeClass('hidden');
    }
  });
  $(document).on('click', '.btn_remove', function() {
    var button_id = $(this).attr("id");
    i--;
    $('#row' + $('#dynamic_field div').length).remove();
    if (i<=1) {
      $('.btn_remove').addClass('hidden');
    }
  });
});
</script>


					
					
<script>
$(document).ready(function(){
    $("select").change(function(){
        $(this).find("option:selected").each(function(){
            var optionValue = $(this).attr("value");
            if(optionValue){
                $(".box").not("." + optionValue).hide();
                $("." + optionValue).show();
            } else{
                $(".box").hide();
            }
        });
    }).change();
});
</script>
<script type="text/javascript">
    function getSubject(classid, htmlid) {
        $('#' + htmlid).html("");

        var base_url = '<?php echo base_url(); ?>';
        var div_data = '<option value="">Select</option>';
        $.ajax({
            type: "POST",
            url: base_url + "event2/getdistrict",
            data: {'class_id': classid},
            dataType: "json",
            success: function (data) {
   
                $.each(data, function (i, obj)
                {


                     div_data += "<option value='" + obj.district + "'>" + obj.district + "</option>";
                });

                $('#' + htmlid).append(div_data);
            }
        });
    }
    ;
	
	function getChapter(classid, subjectid, htmlid) {
        $('#' + htmlid).html("");
      
         var class_id = $('#' + classid).val();
         
        var base_url = '<?php echo base_url(); ?>';
        var div_data = '<option>Select</option>';
        $.ajax({
            type: "POST",
            url: base_url + "event2/getloksabha",
            data: {'class_id': class_id, 'subjectid': subjectid},
            dataType: "json",
            success: function (data) {
              
                $.each(data, function (i, obj)
                {


                    div_data += "<option value='" + obj.lokshabha + "'>" + obj.lokshabha + "</option>";
                });
//alert(subjectid);
                $('#' + htmlid).append(div_data);
				
			$.ajax({
            type: "POST",
            url: base_url + "event2/getblock",
            data: {'class_id': class_id, 'subjectid': subjectid},
            dataType: "json",
            success: function (data) {
              
                $.each(data, function (i, obj)
                {


                    div_data += "<option value='" + obj.block + "'>" + obj.block + "</option>";
                });
//alert(blockid);
                $('#blkid').html(div_data);
				
				
				
				
				
				
				
				
            }
        });
				
				
				
				
				
				
				
            }
        });
		
    }
    ;
	
	function getvillage(classid, vlgid, htmlid) {
        $('#' + htmlid).html("");
      
         var class_id = $('#' + classid).val();
         
        var base_url = '<?php echo base_url(); ?>';
        var div_data = '<option value="">Select</option>';
        $.ajax({
            type: "POST",
            url: base_url + "event2/getvillage",
            data: {'class_id': class_id, 'vlgid': vlgid},
            dataType: "json",
            success: function (data) {
              
                $.each(data, function (i, obj)
                {


                    div_data += "<option value='" + obj.village + "'>" + obj.village + "</option>";
                });
                $('#' + htmlid).append(div_data);
						
				
            }
        });
		
    }
    ;
	
	function getgrampanchayat(classid, grmpid, htmlid) {
        $('#' + htmlid).html("");
      
         var class_id = $('#' + classid).val();
         
        var base_url = '<?php echo base_url(); ?>';
        var div_data = '<option value="">Select</option>';
        $.ajax({
            type: "POST",
            url: base_url + "event2/getgrampanchayat",
            data: {'class_id': class_id, 'grmpid': grmpid},
            dataType: "json",
            success: function (data) {
              
                $.each(data, function (i, obj)
                {


                    div_data += "<option value='" + obj.grampanchayat + "'>" + obj.grampanchayat + "</option>";
                });
//alert(grmpid);
                $('#' + htmlid).append(div_data);
						
				
            }
        });
		
    }
    ;

    function getTopicodia(classid, bookid, htmlid) {
        $('#' + htmlid).html("");
      
         var class_id = $('#' + classid).val();
         
        var base_url = '<?php echo base_url(); ?>';
        var div_data = '<option value="">Select</option>';
        $.ajax({
            type: "POST",
            url: base_url + "event2/getassembly",
            data: {'class_id': class_id, 'bookid': bookid},
            dataType: "json",
            success: function (data) {
              
                $.each(data, function (i, obj)
                {


                    div_data += "<option value='" + obj.assembly + "'>" + obj.assembly + "</option>";
                });

                $('#' + htmlid).append(div_data);
            }
        });
    }
    ;


	 
	
	
</script>