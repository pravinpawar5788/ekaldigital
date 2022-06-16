
	  	   <div class="col-md-12">
		   <div class="row">
		   
		   
	  	<table class="table table-bordered table-hover table-condensed table-export" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th>Select</th>
							<th>Assembly</th>
							<th><?php echo translate('name'); ?></th>
							<th>Username</th>
							<th><?php echo translate('mobile_no'); ?></th>
						 
						</tr>
					</thead>
					<tbody>
					<?php foreach($stafflist as $staff) { ?>
					<tr>
					<td><input type="checkbox"   onchange='getstaffuser(<?php echo $staff['id'];  ?>, <?php echo $sid; ?>)' ></td>
					 
					<td> <?php echo $staff['assembly'];  ?> </td>
					<td> <?php echo $staff['name'];  ?>  </td>
					<td><?php echo $staff['mobileno'];  ?> </td>
					<td> <?php echo $staff['mobileno'];  ?> </td>
					
					</tr>
					<?php } ?>
	                 </tbody>
				</table>
	  </div>
	  </div>
	  
	  
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