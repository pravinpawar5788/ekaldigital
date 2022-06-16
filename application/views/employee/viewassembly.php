


<section class="panel">
    

 
	     
		
		   <div class="panel-body">
		   <div class="col-md-12">
		   <div class="row">
		 <!--  <div class="col-md-3 mb-sm">
		   <div class="form-group">
						<label class="control-label">Select Assembly <span class="required">*</span></label>
						 <select id="searchclassid1" required name="state" onchange="getAnchalBylist(this.value, <?php echo $sid; ?>)" >
						<option>Select Assembly</option>
						<?php foreach($statelist as $state) { ?>
						<option value="<?php echo $state['assembly']; ?>" ><?php echo $state['assembly']; ?></option>
						<?php } ?>
						</select  >
					</div>
		</div> -->
<div id="searchclassid1" ></div>		

 
		   
		   
		   </div>
		 </div>
	</div>
	
		  
			 
	 
</section>

<section class="panel"  >
     
	   

      <div class="panel-body" id="valselect5" >
	  

<div class="tabs-custom">
		<ul class="nav nav-tabs">
			<li class="active">
                <a href="#list" data-toggle="tab">
                    <i class="fas fa-list-ul"></i> Guest
                </a>
			</li>
<?php if (get_permission('event', 'is_add')): ?>
			<li>
                <a href="#add" data-toggle="tab">
                   <i class="fas fa-list-ul"></i> Nominee
                </a>
			</li>
<?php endif; ?>
		</ul>
		<div class="tab-content">
			<div class="tab-pane box active mb-md" id="list">
			  
				<div class="export_title"><?php echo translate('employee') . " " . translate('list'); ?></div>
				<table class="table table-bordered table-hover table-condensed table-export" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th><?php echo translate('sl'); ?></th>
							<!--<th><?php echo translate('photo'); ?></th> -->							  
							<th><?php echo translate('Responsibility'); ?></th>
							<th><?php echo translate('name'); ?></th>							
							<th>Username</th>
							<th><?php echo translate('mobile_no'); ?></th>
							<th>Assembly</th>						 
							
						</tr>
					</thead>
					<tbody>
						<?php $i = 1; foreach ($stafflist1 as $row): ?>
						<tr>
							<td><input type="checkbox"   onchange='getstaffuser(<?php echo $row->id;  ?>, <?php echo $sid; ?>)' ></td>
							<!--<td class="center">
								<img class="rounded" src="<?php echo get_image_url('staff', $row->photo); ?>" width="40" height="40" />
							</td> -->
							 
							<td><?php echo $row->qualification; ?></td>
							<td><?php echo $row->name; ?></td>
							
							<td> <?php echo $row->email; ?></td>
							<td><?php echo $row->mobileno; ?></td>
							<td><?php echo $row->assembly; ?></td>
						 
							 
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			 
			 
			</div>
				<div class="tab-pane" id="add">
				 
				 
				 <div class="export_title"><?php echo translate('employee') . " " . translate('list'); ?></div>
				<table class="table table-bordered table-hover table-condensed table-export" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th><?php echo translate('sl'); ?></th>
							<!--<th><?php echo translate('photo'); ?></th> -->							  
							<th><?php echo translate('Responsibility'); ?></th>
							<th><?php echo translate('name'); ?></th>							
							<th>Username</th>
							<th><?php echo translate('mobile_no'); ?></th>
							<th>Assembly</th>						 
							
						</tr>
					</thead>
					<tbody>
						<?php $i = 1; foreach ($stafflist2 as $row1): ?>
						<tr>
							<td><input type="checkbox"   onchange='getstaffuser(<?php echo $row1->id;  ?>, <?php echo $sid; ?>)' ></td>
							<!--<td class="center">
								<img class="rounded" src="<?php echo get_image_url('staff', $row1->photo); ?>" width="40" height="40" />
							</td> -->
							 
							<td><?php echo $row1->qualification; ?></td>
							<td><?php echo $row1->name; ?></td>
							
							<td> <?php echo $row1->email; ?></td>
							<td><?php echo $row1->mobileno; ?></td>
							<td><?php echo $row1->assembly; ?></td>
						 
							 
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
				 
				 
				 
				 
				 
				 
				 
				</div>
		</div>
</div>		




	  
	
		
	  
	   </div>
</section>	  


<script>
 
 
  function getAnchalBylist(id, sid) {
       // $('#' + htmlid).html("");
      
         
         
        var base_url = '<?php echo base_url(); ?>';
        var div_data = '<option value="">Select</option>';
        $.ajax({
            type: "POST",
            url: base_url + "event1/getlistviewassembly",
            data: {'id': id, 'sid': sid},           
            success: function (data) {
              // alert(data);
			  
                $("#valselect5").html(data);
            }
        });
    }
    ;
</script>

<script>
 
 
  function getstaffuser(staffid, eventid) {
       
        var base_url = '<?php echo base_url(); ?>';
        var div_data = '<option value="">Select</option>';
        $.ajax({
            type: "POST",
            url: base_url + "event1/putstaffval",
            data: {'staffid': staffid, 'eventid': eventid},           
            success: function (data) {
              // alert(data);
			  
                
            }
        });
      
  }
	</script>