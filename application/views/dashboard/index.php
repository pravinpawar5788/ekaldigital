<?php
$div = 0;
if (get_permission('employee_count_widget', 'is_view')) {
	$div++;	
}
if (get_permission('student_count_widget', 'is_view')) {
	$div++;	
}
if (get_permission('parent_count_widget', 'is_view')) {
	$div++;	
}
if (get_permission('teacher_count_widget', 'is_view')) {
	$div++;	
}
if ($div == 0) {
	$widget1 = 0;
}else{
	$widget1 = 12 / $div;
}

$div2 = 0;
if (get_permission('admission_count_widget', 'is_view')) {
	$div2++;	
}
if (get_permission('voucher_count_widget', 'is_view')) {
	$div2++;	
}
if (get_permission('transport_count_widget', 'is_view')) {
	$div2++;	
}
if (get_permission('hostel_count_widget', 'is_view')) {
	$div2++;	
}
if ($div2 == 0) {
	$widget2 = 0;
}else{
	$widget2 = 12 / $div2;
}
?>
<!--<div class="alert-danger mb-md p-sm" style="color: #ffffff; background-color: #ff5e5e; border-radius: 3px;">
	<i class="fas fa-edit"></i>  <a href="#">
    <span style="font-weight: bold;display: inline-block;color: #000;"> 6 April, 2021 </span>       
    <span style="font-weight: bold;display: inline-block;color: #fff;">    Start for Annual Examination of Teacher Chhattisgarh   </span>   </a>
	</div> -->
<div class="dashboard-page">
	
<?php if ($widget2 > 0) { ?>
	<div class="row">
		<div class="col-md-12 col-lg-12 col-sm-12">
			<div class="panel">
				<div class="row widget-row-in">
				<?php if (get_permission('admission_count_widget', 'is_view')) { ?>
					<div class="col-lg-<?php echo $widget2; ?> col-sm-6 ">
						<div class="panel-body">
							<div class="widget-col-in row">
								<div class="col-md-6 col-sm-6 col-xs-6"> <i class="fas fa-home"></i>
									<h5 class="text-muted">Karyakarta</h5>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-6">
									<h3 class="counter text-right mt-md text-primary"><?=$total_prabhag;?></h3>
								</div>
								<div class="col-md-12 col-sm-12 col-xs-12">
									<div class="box-top-line line-color-primary">
										<span class="text-muted text-uppercase">Total Number Karyakarta</span>
									</div>
								</div>
							</div>
						</div>
					</div>
				<?php } ?>
				<?php if (get_permission('voucher_count_widget', 'is_view')) { ?>
					<div class="col-lg-<?php echo $widget2; ?> col-sm-6">
						<div class="panel-body">
							<div class="widget-col-in row">
								<div class="col-md-6 col-sm-6 col-xs-6"> <i class="far fa-address-card"></i>
									<h5 class="text-muted">Join Voter</h5> </div>
								<div class="col-md-6 col-sm-6 col-xs-6">
									<h3 class="counter text-right mt-md text-primary"><?=$total_joinuser;?></h3>
								</div>
								<div class="col-md-12 col-sm-12 col-xs-12">
									<div class="box-top-line line-color-primary">
											<span class="text-muted text-uppercase">Join Voter</span>
									</div>
								</div>
							</div>
						</div>
					</div>
				<?php } ?>
				<?php if (get_permission('transport_count_widget', 'is_view')) { ?>
					<div class="col-lg-<?php echo $widget2; ?> col-sm-6 ">
						<div class="panel-body">
							<div class="widget-col-in row">
								<div class="col-md-6 col-sm-6 col-xs-6"> <i class="fas fa-road" ></i>
									<h5 class="text-muted">State</h5></div>
								<div class="col-md-6 col-sm-6 col-xs-6">
									<h3 class="counter text-right mt-md text-primary">28</h3>
								</div>
								<div class="col-md-12 col-sm-12 col-xs-12">
									<div class="box-top-line line-color-primary">
										<span class="text-muted text-uppercase">28 states and 8 Union territories</span>
									</div>
								</div>
							</div>
						</div>
					</div>
				<?php } ?>
				<?php if (get_permission('hostel_count_widget', 'is_view')) { ?>
					<div class="col-lg-<?php echo $widget2; ?> col-sm-6 ">
						<div class="panel-body">
							<div class="widget-col-in row">
								<div class="col-md-6 col-sm-6 col-xs-6"> <i class="fas fa-warehouse" ></i>
									<h5 class="text-muted">Lok Sabha</h5></div>
								<div class="col-md-6 col-sm-6 col-xs-6">
									<h3 class="counter text-right mt-md text-primary">543</h3>
								</div>
								<div class="col-md-12 col-sm-12 col-xs-12">
									<div class="box-top-line line-color-primary">
										<span class="text-muted text-uppercase">Lok Sabha</span>
									</div>
								</div>
							</div>
						</div>
					</div>
				<?php } ?>
				</div>
			</div>
		</div>
	</div>
<?php } ?>
	
		<?php if ($widget1 > 0) { ?>
	<div class="row">
		<div class="col-md-12 col-lg-12 col-sm-12">
			<div class="panel">
				<div class="row widget-row-in">
				
				<?php if (get_permission('parent_count_widget', 'is_view')) { ?>
					<div class="col-lg-<?php echo $widget1; ?> col-sm-6 ">
						<div class="panel-body">
							<div class="widget-col-in row">
								<div class="col-md-6 col-sm-6 col-xs-6"> <i class="fas fa-user-tie" ></i>
									<h5 class="text-muted">Samiti Sadasy</h5></div>
								<div class="col-md-6 col-sm-6 col-xs-6">
									<h3 class="counter text-right mt-md text-primary"><?=$total_sanch1;?></h3>
								</div>
								<div class="col-md-12 col-sm-12 col-xs-12">
									<div class="box-top-line line-color-primary">
										<span class="text-muted text-uppercase">Samiti Sadasy</span>
									</div>
								</div>
							</div>
						</div>
					</div>
				<?php } ?>
				
				<?php if (get_permission('employee_count_widget', 'is_view')) { ?>
					<div class="col-lg-<?php echo $widget1; ?> col-sm-6 ">
						<div class="panel-body">
							<div class="widget-col-in row">
								<div class="col-md-6 col-sm-6 col-xs-6"> <i class="fas fa-users"></i>
									<h5 class="text-muted">Friends Of Ekal</h5>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-6">
									<h3 class="counter text-right mt-md text-primary"><?php
									echo $total_sanch;
									
									?></h3>
								</div>
								<div class="col-md-12 col-sm-12 col-xs-12">
									<div class="box-top-line line-color-primary">
										<span class="text-muted text-uppercase">Friends Of Ekal</span>
									</div>
								</div>
							</div>
						</div>
					</div>
				<?php } ?>
				
				<?php if (get_permission('teacher_count_widget', 'is_view')) { ?>
					<div class="col-lg-<?php echo $widget1; ?> col-sm-6 ">
						<div class="panel-body">
							<div class="widget-col-in row">
								<div class="col-md-6 col-sm-6 col-xs-6"> <i class="fas fa-chalkboard-teacher" ></i>
									<h5 class="text-muted">Acharya</h5></div>
								<div class="col-md-6 col-sm-6 col-xs-6">
									<h3 class="counter text-right mt-md text-primary"><?php
									echo $this->dashboard_model->get_total_empteacher();
									?></h3>
								</div>
								<div class="col-md-12 col-sm-12 col-xs-12">
									<div class="box-top-line line-color-primary">
										<span class="text-muted text-uppercase">Acharya</span>
									</div>
								</div>
							</div>
						</div>
					</div>
				<?php } ?>
				
				<?php if (get_permission('student_count_widget', 'is_view')) { ?>
					<div class="col-lg-<?php echo $widget1; ?> col-sm-6">
						<div class="panel-body">
							<div class="widget-col-in row">
								<div class="col-md-6 col-sm-6 col-xs-6"> <i class="fas fa-user-graduate"></i>
									<h5 class="text-muted">Sevavrati Karyakarta</h5> </div>
								<div class="col-md-6 col-sm-6 col-xs-6">
									<h3 class="counter text-right mt-md text-primary"><?php echo $this->dashboard_model->get_total_empkarya(); ?></h3>
								</div>
								<div class="col-md-12 col-sm-12 col-xs-12">
									<div class="box-top-line line-color-primary">
											<span class="text-muted text-uppercase">Sevavrati Karyakarta</span>
									</div>
								</div>
							</div>
						</div>
					</div>
				<?php } ?>
				
				
				</div>
			</div>
		</div>
	</div>
<?php } ?>


<div class="row">
		<div class="col-md-12 col-lg-12 col-sm-12">
			<div class="panel">
				<div class="row widget-row-in">
				<div class="panel-body">
	<table class="table table-bordered table-hover   " cellspacing="0" width="100%">
					<thead>
						<tr>
							<th>State</th>
							<th>LOK SABHA</th>
							<th>District</th>
							  
							  <th>Assembly</th>
							   <th>Block</th>
							   <th>KARYAKARTA</th>
							   <th>Join User</th>
						</tr>
					</thead>
					<tbody>
						<?php //$i = 1; foreach ($stafflist as $row): ?>
						<tr>
							<td>Uttar Pradesh</td>
							<td>
								80 
							</td>
							<td>75</td>
							 
							<td>403</td>
							<td>302</td>
							<td><?=$total_prabhag;?></td>
							<td><?=$total_joinuser;?></td>
							 
						</tr>
						<?php //endforeach; ?>
					</tbody>
				</table>
		</div>
				</div>
			</div>
		</div>
	</div>
	
	<!-- student quantity chart -->
	<!--<div class="row">
<?php if (get_permission('student_quantity_pie_chart', 'is_view')) { ?>
		<div class="<?php echo get_permission('weekend_attendance_inspection_chart', 'is_view') ? 'col-md-12 col-lg-4 col-xl-3' : 'col-md-12'; ?>">
			<section class="panel pg-fw">
				<div class="panel-body">
					<h4 class="chart-title mb-xs"><?=translate('student_quantity')?></h4>
					<div id="student_strength"></div>
					<div class="round-overlap"><i class="fas fa-school"></i></div>
				</div>
			</section>
		</div>
<?php } ?>
<?php if (get_permission('weekend_attendance_inspection_chart', 'is_view')) { ?>
		<div class="<?php echo get_permission('student_quantity_pie_chart', 'is_view') ? 'col-md-12 col-lg-8 col-xl-9' : 'col-md-12'; ?>">
			<section class="panel">
				<div class="panel-body">
					<h4 class="chart-title mb-md"><?=translate('weekend_attendance_inspection')?></h4>
					<div class="pg-fw">
						<canvas id="weekend_attendance" style="height: 340px;"></canvas>
					</div>
				</div>
			</section>
		</div>
<?php } ?>
	</div> -->
	
	

	
	
	
<div class="row">
	    <!-- event calendar -->
		<div class="col-md-12">
			<!--<section class="panel">
				<div class="panel-body">
					<div id="event_calendar"></div>
				</div>
			</section> -->
			
			
			<section class="panel">
				<div class="panel-body">
				
					 <section class="panel panel-custom">
							<header class="panel-heading panel-heading-custom">
								<h4 class="panel-title"><i class="fas fa-list-ul"></i> Live Broadcast </h4>
							</header>
							<div class="panel-body panel-body-custom">
							
							<?php if($classlist[0]['path']) {
						echo preg_replace(
								"/\s*[a-zA-Z\/\/:\.]*youtu(be.com\/watch\?v=|.be\/)([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i",
								"<iframe src=\"//www.youtube.com/embed/$2\" allowfullscreen height=\"350\" width=\"100%\"></iframe>",
								$classlist[0]['path']
							);	
						}							
						?>
							 
							
							
								<!-- <div class="table-responsive">
									<table class="table table-bordered table-hover table-condensed tbr-top mb-none">
										<thead>
											<tr>
												<th>#</th>
												<th><?=translate('title')?></th>												 
												<th><?=translate('action')?></th>
											</tr>
										</thead>
										<tbody>
											<?php
											$count = 1;
											if (count($classlist)){
												foreach($classlist as $row):
											?>
											<tr>
												<td><?php echo $count++;?></td>
												<td><?php echo $row['name'];?></td>
												 
												<td>
												 <a href="<?php echo base_url('dashboard/evideo/' . $row['id']);?>" class="btn btn-default btn-circle icon" data-toggle="tooltip" data-original-title="Details">
									<i class="far fa-arrow-alt-circle-right"></i>
								</a>
												</td>
											</tr>
										<?php
											endforeach;
										}else{
											echo '<tr><td colspan="6"><h5 class="text-danger text-center">' . translate('no_information_available') . '</td></tr>';
										}
										?>
										</tbody>
									</table>
								</div> -->
							</div>
						</section>
					
				</div>
			</section>
		 
			
			
			
		</div>
	</div>
</div>

<div class="zoom-anim-dialog modal-block modal-block-primary mfp-hide" id="modal">
	<section class="panel">
		<header class="panel-heading">
			<div class="panel-btn">
				<button onclick="fn_printElem('printResult')" class="btn btn-default btn-circle icon" ><i class="fas fa-print"></i></button>
			</div>
			<h4 class="panel-title"><i class="fas fa-info-circle"></i> <?=translate('event_details')?></h4>
		</header>
		<div class="panel-body">
			<div id="printResult" class=" pt-sm pb-sm">
				<div class="table-responsive">						
					<table class="table table-bordered table-condensed text-dark tbr-top" id="ev_table">
						
					</table>
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

<script type="application/javascript">
(function($) {
	$('#event_calendar').fullCalendar({
		header: {
		left: 'prev,next,today',
		center: 'title',
			right: 'month,agendaWeek,agendaDay,listWeek'
		},
		firstDay: 1,
		height: 720,
		droppable: false,
		editable: true,
		events: {
			url: "<?=base_url('event/get_events_list/'. $school_id)?>"
		},
		buttonText: {
			today:    'Today',
			month:    'Month',
			week:     'Week',
			day:      'Day',
			list:     'List'
		},
		eventRender: function(event, element) {
			$(element).on("click", function() {
				viewEvent(event.id);
			});
			if(event.icon){          
				element.find(".fc-title").prepend("<i class='fas fa-"+event.icon+"'></i> ");
			}
		}
	});

	// Annual Fee Summary JS
	var total_fees = <?php echo json_encode($fees_summary["total_fee"]);?>;
	var total_paid = <?php echo json_encode($fees_summary["total_paid"]);?>;
	var total_due = <?php echo json_encode($fees_summary["total_due"]);?>;
	var feesGraph = {
		type: 'line',
		data: {
			labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun','Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
			datasets: [{
				label: '<?php echo translate("total");?>',
				data: total_fees,
				backgroundColor: 'rgba(216, 27, 96, .6)',
				borderColor: '#F5F5F5',
				borderWidth: 1
			},{
				label: '<?php echo translate("collected");?>',
				data: total_paid,
				backgroundColor: 'rgba(0, 136, 204, .6)',
				borderColor: '#F5F5F5',
				borderWidth: 1
			},{
				label: '<?php echo translate("remaining");?>',
				data: total_due,
				backgroundColor: 'rgba(204, 102, 102, .6)',
				borderColor: '#F5F5F5',
				borderWidth: 1
			}]
		},
		options: {
			responsive: true,
			maintainAspectRatio: false,
			circumference: Math.PI,
			tooltips: {
				mode: 'index',
				bodySpacing: 4
			},
			legend: {
				position: 'bottom',
				labels: {
				boxWidth: 12
			}
			},
			scales: {
				xAxes: [{
					scaleLabel: {
					display: false
					}
				}],
				yAxes: [{
					stacked: true,
					scaleLabel: {
						display: false,
					}
				}]
			}
		}
	}

	var days = <?php echo json_encode($weekend_attendance["days"]);?>;
	var employees_att = <?php echo json_encode($weekend_attendance["employee_att"]);?>;
	var student_att = <?php echo json_encode($weekend_attendance["student_att"]);?>;
	var weekendAttendanceChart = {
		type: 'bar',
		data: {
			labels: days,
			datasets: [{
				label: '<?php echo translate("employee");?>',
				data: employees_att,
				backgroundColor: 'rgba(0, 136, 204, .6)',
				borderColor: '#F5F5F5',
				borderWidth: 1,
				fill: false,
			},{
				label: '<?php echo translate("student");?>',
				data: student_att,
				backgroundColor: 'rgba(204, 102, 102, .6)',
				borderColor: '#F5F5F5',
				borderWidth: 1,
				fill: false,
			}]
		},
		options: {
			responsive: true,
			maintainAspectRatio: false,
			circumference: Math.PI,
			tooltips: {
				mode: 'index',
				bodySpacing: 4
			},
			legend: {
				position: 'bottom',
				labels: {
				boxWidth: 12
			}
			},
			scales: {
				xAxes: [{
					scaleLabel: {
					display: false
					}
				}],
				yAxes: [{
					scaleLabel: {
						display: false,
					}
				}]
			}
		}
	};

 
<?php if (get_permission('weekend_attendance_inspection_chart', 'is_view')) { ?>
	var ctx2 = document.getElementById('weekend_attendance').getContext('2d');
	window.myLine =new Chart(ctx2, weekendAttendanceChart);
<?php } ?>
 
<?php if (get_permission('student_quantity_pie_chart', 'is_view')) { ?>
	// Student Strength Doughnut Chart
	var color = ['#546570', '#c4ccd3', '#c23531', '#2f4554', '#61a0a8', '#d48265', '#91c7ae', '#749f83',  '#ca8622', '#bda29a', '#6e7074'];
	var strength_data = <?php echo json_encode($student_by_class);?>;
	var student_strength = document.getElementById("student_strength");
	var studentchart = echarts.init(student_strength);
	studentchart.setOption( {
		tooltip: {
			trigger: 'item',
			formatter: "{a} <br/>{b} : {c} ({d}%)"
		}, 
		legend: {
			type: 'scroll',
			x: 'center',
			y: 'bottom',
			itemWidth: 14,
<?php if($theme_config["dark_skin"] == "true"): ?>
			inactiveColor: '#4b4b4b',
			textStyle: {
				color: '#6b6b6c'
			}
<?php endif; ?>
		},
		series: [{
			name: 'Strength',
			type: 'pie',
			color: color,
			radius: ['70%', '85%'],
			center: ['50%', '46%'],
			itemStyle: {
				normal: {
					label: {
						show: false
					},
					labelLine: {
						show: false
					}
				},
				emphasis: {
					label: {
						show: false
					}
				}
			},
			data: strength_data
		}]
	});
<?php } ?>
	// charts resize
	$(".sidebar-toggle").on("click",function(event){
		echartsresize();
	});

	$(window).on("resize", echartsresize);

	function echartsresize() {
		setTimeout(function () {
			if ($("#student_strength").length) {
				studentchart.resize();
			}
			if ($("#cash_book_transaction").length) {
				cashbookchart.resize();
			}
		}, 350);
	}
})(jQuery);
</script>