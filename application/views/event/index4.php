<div class="row">
<div class="col-md-12">
<section class="panel">
			<header class="panel-heading">
				<h4 class="panel-title"><i class="far fa-edit"></i> Edit</h4>
			</header>
<div class="panel-body">
 
 	<div class="tab-pane" id="add">
					<?php echo form_open_multipart($this->uri->uri_string(), array('class' => 'form-bordered form-horizontal '));?>
					 
					 
					<!-- <div class="form-group">
						<label class="col-md-3 control-label">  </label>
						Contesting From :
                      
						<select id="searchclassid1" required name="state" onchange="getSubject(this.value, 'subid5')" >
						<option>Select State</option>
						<?php foreach($statelist as $state) { ?>
						<option value="<?php echo $state['state']; ?>" ><?php echo $state['state']; ?></option>
						<?php } ?>
						</select  >
						<select id="subid5" name="subject_id" required   onchange="getChapter('searchclassid1', this.value, 'chaid1')"><option>District</option></select > 
						<select  id="chaid1" name="chapterid" required   onchange="getTopicodia('searchclassid1', this.value, 'subid1')" ><option>Lok Sabha Constituency </option></select > 
						<select id="subid1" name="assembly"  required ><option>Assembly Constituency </option></select > 
						 
					</div>  -->
					  <input type="hidden" name="ssid" value="<?php echo $stafflist['id']; ?>">
					<div class="form-group">
						<label class="col-md-3 control-label">Candidate's Full Name<span class="required">*</span></label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="fullname" value="<?php echo $stafflist['fullname']; ?>" />
							<span class="error"></span>
						</div>
					</div>
					 
					 <div class="form-group">
						<label class="col-md-3 control-label">Age <span class="required">*</span></label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="age" value="<?php echo $stafflist['age']; ?>" />
							<span class="error"></span>
						</div>
					</div>
					 <div class="form-group">
						<label class="col-md-3 control-label">Gender <span class="required">*</span></label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="gender" value="<?php echo $stafflist['gender']; ?>" />
							<span class="error"></span>
						</div>
					</div>
					 
					  <div class="form-group">
						<label class="col-md-3 control-label">Caste/tribe <span class="required">*</span></label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="caste" value="<?php echo $stafflist['caste']; ?>" />
							<span class="error"></span>
						</div>
					</div>
					 
					<div class="form-group">
						<label class="col-md-3 control-label">Political Career</label>
						<div class="col-md-6">
							<textarea name="PoliticalCareer" class="summernote"><?php echo $stafflist['PoliticalCareer']; ?></textarea>
						</div>
					</div>
				     <div class="form-group">
						<label class="col-md-3 control-label">Early Life and Childhood </label>
						<div class="col-md-6">
							<textarea name="LifeandChildhood" class="summernote"><?php echo $stafflist['LifeandChildhood']; ?></textarea>
						</div>
					</div>
					 
					 <div class="form-group">
						<label class="col-md-3 control-label">Any Criminal Records <span class="required">*</span></label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="CriminalRecords" value="<?php echo $stafflist['CriminalRecords']; ?>" />
							<span class="error"></span>
						</div>
					</div> 
					
					 <div class="form-group">
						<label class="col-md-3 control-label">Campaign video Path </label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="youtube1" value="<?php echo $stafflist['youtube1']; ?>" />
							<span class="error"></span>
						</div>
					</div> 
					 <div class="form-group">
						<label class="col-md-3 control-label">Campaign video Path </label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="youtube2" value="<?php echo $stafflist['youtube2']; ?>" />
							<span class="error"></span>
						</div>
					</div> 
					 <div class="form-group">
						<label class="col-md-3 control-label">Campaign video Path </label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="youtube3" value="<?php echo $stafflist['youtube3']; ?>" />
							<span class="error"></span>
						</div>
					</div> 
					 <div class="form-group">
						<label class="col-md-3 control-label">Campaign video Path </label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="youtube4" value="<?php echo $stafflist['youtube4']; ?>" />
							<span class="error"></span>
						</div>
					</div> 
					 <div class="form-group">
						<label class="col-md-3 control-label">Campaign video Path </label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="youtube5" value="<?php echo $stafflist['youtube5']; ?>" />
							<span class="error"></span>
						</div>
					</div> 
					
					 
					  
							<!--<div class="form-group">
								<label class="col-md-3 control-label">Election Date <span class="required">*</span></label>
								<div class="col-md-6">
									 
									<input type="text" class="form-control" name="date" data-plugin-datepicker data-plugin-options='{ "todayHighlight" : true }'
									autocomplete="off" value="<?=set_value('date')?>" />
								</div>
								 
							</div> -->
						 
					 
					 
					 <div class="form-group">
								<label class="col-md-3 control-label" for="input-file-now"><?=translate('profile_picture')?></label>
								<div class="col-md-6">
								<input type="file" name="user_photo" class="dropify" />
								<span class="error"><?php echo form_error('user_photo'); ?></span>
							</div> </div>
					 
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
		
			 
	</div>
</section>
</div></div>
  