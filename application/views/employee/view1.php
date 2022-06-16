


<section class="panel">
    

 
	     
		
		   <div class="panel-body">
		   <div class="col-md-12">
		   <div class="row">
		   <div class="col-md-3 mb-sm">
		   <div class="form-group">
						<label class="control-label"><?=translate('select prabhag')?> <span class="required">*</span></label>
						<?php
						$arrayPrabhag = $this->app_lib->getPrabhagList('ekal_prabhag');
						//$arrayPrabhag = $this->app_lib->getClass($branch_id);
						echo form_dropdown("p_name", $arrayPrabhag, set_value('p_name'), "class='form-control' id='p_name' onchange='getSambhagByPrabhag(this.value)'
						data-plugin-selectTwo data-width='100%' data-minimum-results-for-search='Infinity'");
					?>
					</div>
		</div>		

<div class="col-md-3 mb-sm">		
					<div class="form-group">
						<label class="control-label"><?=translate('select sambhag')?> <span class="required">*</span></label>
						<?php
						$arrayPrabhag = $this->app_lib->getPrabhagSamList(set_value('p_name'));
						//$arrayPrabhag = $this->app_lib->getClass($branch_id);
						echo form_dropdown("s_name", $arrayPrabhag, set_value('s_name'), "class='form-control' id='s_name' onchange='getBhagBySambhag(this.value)'
						data-plugin-selectTwo data-width='100%' data-minimum-results-for-search='Infinity'");
					?>
					</div> 
					</div> 
					
					<div class="col-md-3 mb-sm">
					<div class="form-group">
						<label class="control-label"><?=translate('select bhag')?> <span class="required">*</span></label>
						<?php
						$arrayPrabhag = $this->app_lib->getSambhagBhagList(set_value('s_name'));
						//$arrayPrabhag = $this->app_lib->getClass($branch_id);
						echo form_dropdown("b_name", $arrayPrabhag, set_value('b_name'), "class='form-control' id='b_name' onchange='getAnchalByBhag(this.value)'
						data-plugin-selectTwo data-width='100%' data-minimum-results-for-search='Infinity'");
					?>
					</div> 
					</div> 
					
					<div class="col-md-3 mb-sm">
					<div class="form-group">
						<label class="control-label"><?=translate('select anchal')?> <span class="required">*</span></label>
						<?php
						$arrayPrabhag = $this->app_lib->getBhagAnchalList(set_value('b_name'));
						//$arrayPrabhag = $this->app_lib->getClass($branch_id);
						echo form_dropdown("a_name", $arrayPrabhag, set_value('a_name'), "class='form-control' id='a_name' onchange='getAnchalBylist(this.value, $sid)'
						data-plugin-selectTwo data-width='100%' data-minimum-results-for-search='Infinity'");
					?>
					</div> 
					</div> 
		   
		   
		   </div>
		 </div>
	</div>
	
		  
			 
	 
</section>

<section class="panel"  >
      <div class="panel-body" id="valselect5" >
	   </div>
</section>	  


<script>
 
 
  function getAnchalBylist(id, sid) {
       // $('#' + htmlid).html("");
      
         
         
        var base_url = '<?php echo base_url(); ?>';
        var div_data = '<option value="">Select</option>';
        $.ajax({
            type: "POST",
            url: base_url + "event1/getlistview",
            data: {'id': id, 'sid': sid},           
            success: function (data) {
              // alert(data);
			  
                $("#valselect5").html(data);
            }
        });
    }
    ;
</script>