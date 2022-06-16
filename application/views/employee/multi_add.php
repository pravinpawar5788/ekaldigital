<div class="row">
	<div class="col-md-12">
		<section class="panel">
		<?php echo form_open_multipart('employee/csv_import1', array( 'class' => 'form-horizontal form-bordered validate'));?>	
			<header class="panel-heading">
				<h4 class="panel-title">
					<i class="fas fa-file-archive"></i> <?=translate('multiple_import')?>
				</h4>
			</header>
			<div class="panel-body">
			<?php if ($this->session->flashdata('csvimport')): ?>
				<div class="alert-danger p-sm"><?php echo $this->session->flashdata('csvimport'); ?></div>
			<?php endif; ?>
				<div class="form-group mt-md">
					<div class="col-md-12 mb-md">
						<a class="btn btn-default pull-right" href="<?=base_url('student/csv_Sampledownloader')?>">
							<i class='fas fa-file-download'></i> Download Sample Import File
						</a>
					</div>
					<div class="col-md-12">
						 
					</div>
				</div>
			<?php if (is_superadmin_loggedin()): ?>
				
			<?php endif; ?>
				
				<div class="form-group">
					<label class="control-label col-md-3">Select CSV File <span class="required">*</span></label>
					<div class="col-md-6 mb-lg">
						<input type="file" name="userfile" class="dropify" data-height="140" data-allowed-file-extensions="csv" />
						<?php echo form_error('userfile', '<label class="error">', '</label>'); ?>
					</div>
				</div>
			</div>
			<footer class="panel-footer">
				<div class="row">
					<div class="col-md-offset-3 col-md-2">
						<button type="submit" name="save" value="1" class="btn btn btn-default btn-block">
							<i class="fas fa-plus-circle"></i> <?=translate('import')?>
						</button>
					</div>
				</div>
			</footer>
			<?php echo form_close();?>
		</section>
	</div>
</div>