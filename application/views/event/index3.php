<section class="panel">
	<div class="tabs-custom">
		<ul class="nav nav-tabs">
			<li class="active">
                <a href="#list" data-toggle="tab">
                    <i class="fas fa-list-ul"></i> Nominee List
                </a>
			</li>
<?php if (get_permission('event', 'is_add')): ?>
			<li>
                <a href="#add" data-toggle="tab">
                   <i class="far fa-edit"></i> Add Nominee 
                </a>
			</li>
<?php endif; ?>
		</ul>
		<div class="tab-content">
			<div class="tab-pane box active mb-md" id="list">
				<table class="table table-bordered table-hover mb-none tbr-top table-export">
					<thead>
						<tr>
						<th>Sl</th>
							<th>Photo</th>
					<th>Contesting For</th>
							<th>Nominee Name</th>
							<th>District</th>
							
							<th>Lok shabha</th>
							 <th>Assembly</th>
							<th><?=translate('action')?></th>
						</tr>
					</thead>
					<tbody>
						<?php
						$count = 1;
						 
						$this->db->order_by('id', 'desc');
						$events = $this->db->get('nominee')->result();
						foreach ($events as $event):
						?>
						<tr>
						<td><?php echo $count++; ?></td>
							<td class="center"><img class="rounded" src="<?php echo $event->photo; ?>" width="40" height="40" /></td>	
<td><?php echo $event->cfor; ?></td>							
							<td><?php echo $event->fullname; ?></td>
							 <td><?php echo $event->district; ?></td>
							<td> <?php echo $event->loksabha; ?></td>	 
							
							<td>
							<?php echo $event->assembly; ?>
							</td>
							<td>
							 <a href="<?php echo base_url(); ?>event2/editevent/<?=$event->id?>" class="btn btn-circle btn-default icon"  >
									<i class="far fa-edit"></i>
						    </a>  	
							 
							 	<?php if (get_permission('event', 'is_delete')) { ?>
								
								<?php echo btn_delete('event2/delete/'.$event->id);?>
							<?php } ?>  
							</td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
<?php if (get_permission('event', 'is_add')): ?>
			<div class="tab-pane" id="add">
					<?php echo form_open_multipart($this->uri->uri_string(), array('class' => 'form-bordered form-horizontal '));?>
					 
					 <div class="form-group">
						<label class="col-md-3 control-label">  </label>
						Contesting For: <input type="radio" name="cfor" value="Lok Sabha election"> Lok Sabha election  <input type="radio" name="cfor" value="Legislative Assembly"> Legislative Assembly  <input type="radio" name="cfor" value="State Legislative Council(MLC)"> State Legislative Council(MLC) 
						<input type="radio" name="cfor" value="Corporation Election"> Corporation Election <input type="radio" name="cfor" value="Gram Panchayat Election"> Gram Panchayat Election
					</div>
					 <div class="form-group">
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
						<!--<select><option>Corporation Ward/ Village </option></select >  -->
					</div> 
					 
					<div class="form-group">
						<label class="col-md-3 control-label">Candidate's Full Name<span class="required">*</span></label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="fullname" value="" />
							<span class="error"></span>
						</div>
					</div>
					 
					 <div class="form-group">
						<label class="col-md-3 control-label">Age <span class="required">*</span></label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="age" value="" />
							<span class="error"></span>
						</div>
					</div>
					 <div class="form-group">
						<label class="col-md-3 control-label">Gender <span class="required">*</span></label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="gender" value="" />
							<span class="error"></span>
						</div>
					</div>
					 
					  <div class="form-group">
						<label class="col-md-3 control-label">Caste/tribe <span class="required">*</span></label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="caste" value="" />
							<span class="error"></span>
						</div>
					</div>
					 
					<div class="form-group">
						<label class="col-md-3 control-label">Political Career</label>
						<div class="col-md-6">
							<textarea name="PoliticalCareer" class="summernote"></textarea>
						</div>
					</div>
				     <div class="form-group">
						<label class="col-md-3 control-label">Early Life and Childhood </label>
						<div class="col-md-6">
							<textarea name="LifeandChildhood" class="summernote"></textarea>
						</div>
					</div>
					 
					 <div class="form-group">
						<label class="col-md-3 control-label">Any Criminal Records <span class="required">*</span></label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="CriminalRecords" value="" />
							<span class="error"></span>
						</div>
					</div> 
					 
					  
							<div class="form-group">
								<label class="col-md-3 control-label">Election Date <span class="required">*</span></label>
								<div class="col-md-6">
									 
									<input type="text" class="form-control" name="date" data-plugin-datepicker data-plugin-options='{ "todayHighlight" : true }'
									autocomplete="off" value="<?=set_value('date')?>" />
								</div>
								 
							</div>
						 
					 
					 
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
<?php endif; ?>
		</div>
	</div>
</section>
<div class="zoom-anim-dialog modal-block modal-block-primary mfp-hide" id="modal">
	<section class="panel">
		<header class="panel-heading">
			<div class="panel-btn">
				<button onclick="fn_printElem('printResult')" class="btn btn-default btn-circle icon" ><i class="fas fa-print"></i></button>
			</div>
			<h4 class="panel-title"><i class="fas fa-info-circle"></i> <?=translate('event_details')?></h4>
		</header>
		<div class="panel-body">
			<div id="printResult" class="pt-sm pb-sm">
				<div class="table-responsive">						
					<table class="table table-bordered table-condensed text-dark tbr-top" id="ev_table"></table>
				</div>
			</div>
		</div>
		<footer class="panel-footer">
			<div class="row">
				<div class="col-md-12 text-right">
					<button class="btn btn-default modal-dismiss">
						<?=translate('close')?>
					</button>
				</div>
			</div>
		</footer>
	</section>
</div>

<script type="text/javascript">
	$(document).ready(function () {
		$('#daterange').daterangepicker({
			opens: 'left',
		    locale: {format: 'YYYY/MM/DD'}
		});

		$('#branch_id').on('change', function() {
			var branchID = $(this).val();
			$.ajax({
				url: "<?=base_url('ajax/getDataByBranch')?>",
				type: 'POST',
				data: {
					branch_id: branchID,
					table : 'event_types'
				},
				success: function (data) {
					$('#type_id').html(data);
				}
			});
			$("#selected_audience").empty();
		});
		
		$('#audition').on('change', function() {
			var audition = $(this).val();
			var branchID = ($('#branch_id').length ? $('#branch_id').val() : "");
			if(audition == "1" || audition == null)
			{
				$("#selected_user").hide("slow");
			}
			if(audition == "2") {
			    $.ajax({
			        url: base_url + 'ajax/getClassByBranch',
			        type: 'POST',
			        data:{ branch_id: branchID },
			        success: function (data){
			            $('#selected_audience').html(data);
			        }
			    });
				$("#selected_user").show('slow');
				$("#selected_label").html("<?=translate('class')?> <span class='required'>*</span>");
			}
			if(audition == "3"){
				$.ajax({
					url: "<?=base_url('event/getSectionByBranch')?>",
					type: 'POST',
					data: {branch_id: branchID},
					success: function (data) {
						$('#selected_audience').html(data);
					}
				});
				$("#selected_user").show('slow');
				$("#selected_label").html("<?=translate('section')?> <span class='required'>*</span>");
			}
		});
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
        var div_data = '<option value="">Select</option>';
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