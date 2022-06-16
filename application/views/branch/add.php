<section class="panel">
	<div class="tabs-custom">
		<ul class="nav nav-tabs">
			<li class="<?=(empty($validation_error) ? 'active' : '') ?>">
				<a href="#list" data-toggle="tab"><i class="fas fa-list-ul"></i> <?=translate('branch_list')?></a>
			</li>
			<li class="<?=(!empty($validation_error) ? 'active' : '') ?>">
				<a href="#create" data-toggle="tab"><i class="far fa-edit"></i> <?=translate('create_branch')?></a>
			</li>
		</ul>
		<div class="tab-content">
			<div id="list" class="tab-pane <?=(empty($validation_error) ? 'active' : '')?>">
				<div class="mb-md">
					<table class="table table-bordered table-hover table-condensed mb-none table-export">
						<thead>
							<tr>							
								<th width="50"><?=translate('sl')?> </th>
								<th><?=translate('state')?></th>
								<th><?=translate('Prabhag')?></th>
								<th><?=translate('Sambhag')?></th>
								<th><?=translate('Bhag')?></th>
								<th><?=translate('Anchal (district)')?></th>								
								<th><?=translate('branch_name')?></th>
								<th><?=translate('KID')?></th>
								<th><?=translate('school_name')?></th>								 
								<th><?=translate('mobile_no')?></th>	
								<th><?=translate('address')?></th>
								<th><?=translate('action')?></th>
							</tr>
						</thead>
						<tbody>
							<?php 
								$count = 1;
								$branchs = $this->db->get('branch')->result();
								foreach($branchs as $row):
							?>
							<tr>
								<td><?php echo $count++; ?></td>
								<td><?php echo $row->state;?></td>
								<td><?php echo $row->p_id;?></td>
								<td><?php echo $row->s_id;?></td>
								<td><?php echo $row->b_id;?></td>
								<td><?php echo $row->a_id;?></td>								
								<td><?php echo $row->name;?></td>
								<td><?php echo $row->kid;?></td>
								<td><?php echo $row->school_name;?></td>								 
								<td><?php echo $row->mobileno;?></td>
								<td><?php echo $row->address;?></td>
								<td class="min-w-c">
									<!--update link-->
									<a href="<?=base_url('branch/edit/'.$row->id)?>" class="btn btn-default btn-circle icon">
										<i class="fas fa-pen-nib"></i>
									</a>
									<!-- delete link -->
									<?php echo btn_delete('branch/delete_data/' . $row->id);?>
								</td>
							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
			<div class="tab-pane <?=(!empty($validation_error) ? 'active' : '')?>" id="create">
				<?php echo form_open($this->uri->uri_string(), array('class' => 'form-horizontal form-bordered validate')); ?>
				
			<!--	<div class="form-group">
						<label class="col-md-3 control-label"><?=translate('state')?> <span class="required">*</span></label>
						<div class="col-md-6">
							<select name="state" id="state" class="form-control">
							<option value="">Select State</option>
							<option value="Andhra Pradesh">Andhra Pradesh</option>
							<option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
							<option value="Arunachal Pradesh">Arunachal Pradesh</option>
							<option value="Assam">Assam</option>
							<option value="Bihar">Bihar</option>
							<option value="Chandigarh">Chandigarh</option>
							<option value="Chhattisgarh">Chhattisgarh</option>
							<option value="Dadar and Nagar Haveli">Dadar and Nagar Haveli</option>
							<option value="Daman and Diu">Daman and Diu</option>
							<option value="Delhi">Delhi</option>
							<option value="Lakshadweep">Lakshadweep</option>
							<option value="Puducherry">Puducherry</option>
							<option value="Goa">Goa</option>
							<option value="Gujarat">Gujarat</option>
							<option value="Haryana">Haryana</option>
							<option value="Himachal Pradesh">Himachal Pradesh</option>
							<option value="Jammu and Kashmir">Jammu and Kashmir</option>
							<option value="Jharkhand">Jharkhand</option>
							<option value="Karnataka">Karnataka</option>
							<option value="Kerala">Kerala</option>
							<option value="Madhya Pradesh">Madhya Pradesh</option>
							<option value="Maharashtra">Maharashtra</option>
							<option value="Manipur">Manipur</option>
							<option value="Meghalaya">Meghalaya</option>
							<option value="Mizoram">Mizoram</option>
							<option value="Nagaland">Nagaland</option>
							<option value="Odisha">Odisha</option>
							<option value="Punjab">Punjab</option>
							<option value="Rajasthan">Rajasthan</option>
							<option value="Sikkim">Sikkim</option>
							<option value="Tamil Nadu">Tamil Nadu</option>
							<option value="Telangana">Telangana</option>
							<option value="Tripura">Tripura</option>
							<option value="Uttar Pradesh">Uttar Pradesh</option>
							<option value="Uttarakhand">Uttarakhand</option>
							<option value="West Bengal">West Bengal</option>
							</select>
						</div>
					</div> -->
				
				   <div class="form-group">
						<label  class="col-md-3 control-label"><?=translate('Prabhag')?> <span class="required">*</span></label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="prabhag" value="<?=set_value('prabhag')?>" />
							<span class="error"><?=form_error('prabhag') ?></span>
						</div>
					</div>
					
					<div class="form-group">
						<label  class="col-md-3 control-label"><?=translate('Sambhag')?> <span class="required">*</span></label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="sambhag" value="<?=set_value('sambhag')?>" />
							<span class="error"><?=form_error('sambhag') ?></span>
						</div>
					</div>
					
					
					<div class="form-group">
						<label  class="col-md-3 control-label"><?=translate('Bhag')?> <span class="required">*</span></label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="bhag" value="<?=set_value('bhag')?>" />
							<span class="error"><?=form_error('bhag') ?></span>
						</div>
					</div>
					
					<div class="form-group">
						<label  class="col-md-3 control-label"> <?=translate('Anchal_district')?> <span class="required">*</span></label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="anchal_district" value="<?=set_value('anchal_district')?>" />
							<span class="error"><?=form_error('anchal_district') ?></span>
						</div>
					</div>
				
					<div class="form-group mt-md">
						<label class="col-md-3 control-label"><?=translate('branch_name')?> <span class="required">*</span></label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="branch_name" value="<?=set_value('branch_name')?>" />
							<span class="error"><?=form_error('branch_name') ?></span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label"><?=translate('school_name')?> <span class="required">*</span></label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="school_name" value="<?=set_value('school_name')?>" />
							<span class="error"><?=form_error('school_name') ?></span>
						</div>
					</div>
					
					<div class="form-group">
						<label  class="col-md-3 control-label"> <?=translate('KID')?>  <span class="required">*</span></label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="kid" value="<?=set_value('kid')?>" />
							<span class="error"><?=form_error('kid') ?></span>
						</div>
					</div>
					
					<!--<div class="form-group">
						<label class="col-md-3 control-label"><?=translate('email')?> <span class="required">*</span></label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="email" value="<?=set_value('email')?>" />
							<span class="error"><?=form_error('email') ?></span>
						</div>
					</div> -->
					<div class="form-group">
						<label class="col-md-3 control-label"><?=translate('mobile_no')?> <span class="required">*</span></label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="mobileno" value="<?=set_value('mobileno')?>">
							<span class="error"><?=form_error('mobileno') ?></span>
						</div>
					</div>
					<!--<div class="form-group">
						<label  class="col-md-3 control-label"><?=translate('currency')?> <span class="required">*</span></label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="currency" value="<?=set_value('currency')?>" />
							<span class="error"><?=form_error('currency') ?></span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label"><?=translate('currency_symbol')?> <span class="required">*</span></label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="currency_symbol" value="<?=set_value('currency_symbol')?>" />
							<span class="error"><?=form_error('currency_symbol'); ?></span>
						</div>
					</div> 
					<div class="form-group">
						<label class="col-md-3 control-label"><?=translate('city')?></label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="city" value="<?=set_value('city')?>">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label"><?=translate('state')?></label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="state" value="<?=set_value('state')?>">
						</div>
					</div>-->
					<div class="form-group">
						<label  class="col-md-3 control-label"><?=translate('address')?></label>
						<div class="col-md-6 mb-md">
							<textarea type="text" rows="3" class="form-control" name="address" ><?=set_value('address')?></textarea>
						</div>
					</div>
					<footer class="panel-footer mt-lg">
						<div class="row">
							<div class="col-md-2 col-md-offset-3">
								<button type="submit" class="btn btn-default btn-block" name="submit" value="save">
									<i class="fas fa-plus-circle"></i> <?=translate('save')?>
								</button>
							</div>
						</div>	
					</footer>
				<?php echo form_close();?>
			</div>
		</div>
	</div>
</section>