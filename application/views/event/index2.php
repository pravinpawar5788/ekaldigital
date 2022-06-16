<div class="row">
<div class="col-md-12">
<section class="panel">
			<header class="panel-heading">
				<h4 class="panel-title"><i class="far fa-edit"></i> Edit</h4>
			</header>
<div class="panel-body">
 
 <div >
					<?php echo form_open_multipart($this->uri->uri_string(), array('class' => 'form-bordered form-horizontal'));?>
					 
					<div class="form-group">
						<label class="col-md-3 control-label"><?=translate('title')?> <span class="required">*</span></label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="title" value="<?php echo $stafflist['name']; ?>" />
							<span class="error"></span>
						</div>
					</div>
					 
					 <div class="form-group">
						<label class="col-md-3 control-label">Youtube Path <span class="required">*</span></label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="path" value="<?php echo $stafflist['path']; ?>" /> 
							
							<span class="error"></span>
						</div>
					</div>
					
					 <div class="form-group">
						<label class="col-md-3 control-label">Youtube Streaming Key <span class="required">*</span></label>
						<div class="col-md-6">
							
							<input type="text" class="form-control" name="streamid" placeholder="Youtube live stream id" value="<?php echo $stafflist['streamid']; ?>" />
							<span class="error"></span>
						</div>
					</div>
					
					  <div class="form-group">
						<label class="col-md-3 control-label">Meeting Name  <span class="required">*</span></label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="serverurl" readonly  value="<?php echo $stafflist['meetingname']; ?>" />
							<span class="error"></span>
						</div>
					</div>
					
					
					 
							<div class="form-group">
								<label for="input-file-now">Banner</label>
								<input type="file" name="user_photo" class="dropify" />
								<span class="error"><?php echo form_error('user_photo'); ?></span>
							</div>
						 
					
					
					<!--<input type="hidden" class="form-control" name="serverurl" value="<?php echo $stafflist['meetingname']; ?>" />-->
					 <input type="hidden" name="ssid" value="<?php echo $stafflist['id']; ?>">
					 
					<!-- <div class="form-group">
						<label class="col-md-3 control-label">Meeting <span class="required">*</span></label>
						<div class="col-md-6">
							<input type="radio" <?php if($stafflist['view_status'] == 0) { echo "checked"; } ?> name="view_status" value="0"> Brodcast <br>
                            <input type="radio" <?php if($stafflist['view_status'] == 1) { echo "checked"; } ?> name="view_status" value="1"> Personal<br>
							<span class="error"></span>
						</div>
					</div> -->
					 
				
					 
						<div class="row">
							<div class="col-md-offset-3 col-md-2">
								<button type="submit" class="btn btn-default btn-block" data-loading-text="<i class='fas fa-spinner fa-spin'></i> Processing">
									<i class="fas fa-plus-circle"></i> <?=translate('save')?>
								</button>
							</div>
						</div>
					 
				<?php echo form_close(); ?>
			</div>
			
			 
	</div>
</section>
</div></div>
  