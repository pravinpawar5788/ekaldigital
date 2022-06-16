  <style>
@font-face {
    font-family: 'Kruti';
    src: url('<?php echo base_url(); ?>uploads/Kruti/k010.eot');
    src: local("Hindi"), url("<?php echo base_url(); ?>uploads/Kruti/k010.ttf") format("truetype");
    font-weight: normal;
    font-style: normal;
    }
</style>
        
        <script type="text/javascript" src="<?php echo base_url(); ?>uploads/exam_files/jquery.min.js.download"></script>
        
        <link href="<?php echo base_url(); ?>uploads/exam_files/bootstrap.min.css" rel="stylesheet">
       
        <link id="headStyleCSSLink" href="<?php echo base_url(); ?>uploads/exam_files/style.css" rel="stylesheet">       

        <link rel="stylesheet" href="<?php echo base_url(); ?>uploads/exam_files/combined.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>uploads/exam_files/checkbox.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>uploads/exam_files/fuelux.min.css">
 <link rel="stylesheet" href="<?php echo base_url(); ?>backend/dist/css/font-awesome.min.css">      
 
   <!--<link rel="stylesheet" href="http://vidyabharatilms.com/backend/dist/css/ionicons.min.css">   -->

        <script type="text/javascript">
          $(window).load(function() {
            $(".se-pre-con").fadeOut("slow");;
          });
        </script>
    </head>
    <body    class="skin-blue fuelux    pace-done" style="min-height: 996px;"><div class="pace  pace-inactive"><div class="pace-progress" data-progress-text="100%" data-progress="99" style="width: 100%;">
  <div class="pace-progress-inner"></div>
</div>
<div class="pace-activity"></div></div>
        <div class="se-pre-con" style="display: none;"></div>
        <!-- header logo: style can be found in header.less -->
         <div class="wrapper row-offcanvas row-offcanvas-left" style="min-height: 599px;">
   
        <aside >
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <style type="text/css">
    .fuelux .wizard .step-content {
        border: 0px;
    }
</style>
<div class="col-sm-12 do-not-refresh">
    <div class="callout callout-danger">
        <h4 style="font-size: 20px;">Warning</h4>
        <p style="font-size: 18px;">Do Not Press Back/refresh Button</p>
		<p> <?php if($instruction) { ?><?php echo $instruction; ?> <?php } ?></p>
    </div>
</div>

<div class="row">
    <div class="col-sm-12 fu-example section">
        <div class="box outheBoxShadow wizard" data-initialize="wizard" id="questionWizard" style="background-color: #fff;">
            <div class="col-sm-12 counterDiv">
                <div class="box outheBoxShadow">
                    <div class="box-body outheMargAndBox">
                        <div class="box outheBoxShadow">
                            <div class="box-header bg-white">
                                <h3 class="box-title fontColor" style="color: #fff;"> <?php //echo $this->customlib->getStudentSessionUserName(); ?> </h3>
								<h3 class=" pull-right box-title fontColor" style="color: #fff;"> Total Time: <?php echo date('H:i', mktime(0,$timerdb)); ?> </h3>
                            </div>
                            <div class="box-body">
                                <div id="timerdiv" class="timer"><?php echo $timer; ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="steps-container">
                <ul class="steps hidden" style="margin-left: 0">
                                <?php foreach($list as  $key=>$quizlist) {  ?>				                                               
											   <li data-step="<?php echo $key+1; ?>" class="active"></li>
                                                
								<?php  } ?>				
                                    </ul>
            </div>
   
           

         <?php
      
		 echo form_open('exam/quiztestact', 'id="answerForm"'); ?>
                <div class="box-body step-content">
                    <input   type="hidden" name="categoryid" value="<?php echo $categoryid; ?>">
                                            
							<?php foreach($list as  $key=>$quizlist) {  ?>				
											<div class="clearfix step-pane sample-pane active" data-questionid="<?php echo $quizlist['id']; ?>" data-step="<?php echo $key+1; ?>">
                                <div class="question-body">
                                    <label class="lb-title">Question <?php echo $key+1; ?> of <?php echo sizeof($list); ?></label>
									   <label class="lb-content"> <strong style="font-size: 25px;"><?php echo $quizlist['quename']; ?></strong></label>
                                   <!-- <label class="lb-content"> Student Name </label> -->
                                    <label class="lb-mark">   </label>
                                                                             
                                                                    </div>

                                <div class="question-answer" id="step<?php echo $key+1; ?>">                                   
									
									<?php if($quizlist['fillblank'] == 1) {  ?>
										<input id="option<?php echo $quizlist['que1_hindi']; ?><?php echo $quizlist['id']; ?>" value="" name="answer[<?php echo $quizlist['id']; ?>][]" type="text">
									<?php } else { ?>		
									<table class="table"  width="100%">
                                        <tbody><tr>
                                                 <td  width="50%">
                                                    <input id="option<?php echo $quizlist['que1_hindi']; ?><?php echo $quizlist['id']; ?>" value="A" name="answer[<?php echo $quizlist['id']; ?>][]" type="radio">
                                                    <label for="option<?php echo $quizlist['que1_hindi']; ?><?php echo $quizlist['id']; ?>">
                                                        <span class="fa-stack radio-button">
                                                            <i class="active fa fa-check">
                                                            </i>
                                                        </span> 
                                                         <span style="font-size: 20px;color:#000;!important"><b><?php 
														 
														 echo   $quizlist['que1']; ?></b></span>
                                                                                                                    <div>
                                                               
                                                            </div>
                                                                                                             </label>
                                                </td>
                                            
                                                </tr>
												<tr>
												<td  width="50%">
                                                    <input id="option<?php echo $quizlist['que2_hindi']; ?><?php echo $quizlist['id']; ?>" value="B" name="answer[<?php echo $quizlist['id']; ?>][]" type="radio">
                                                    <label for="option<?php echo $quizlist['que2_hindi']; ?><?php echo $quizlist['id']; ?>">
                                                        <span class="fa-stack radio-button">
                                                            <i class="active fa fa-check">
                                                            </i>
                                                        </span> 
                                                         <span style="font-size: 20px;color:#000;!important"><b><?php echo $quizlist['que2']; ?></b></span>
                                                                                                                    <div>
                                                               
                                                            </div>
                                                                                                             </label>
                                                </td>
												</tr>
												<?php if($quizlist['que3']) { ?>
												<tr>     
												<td  width="50%">
                                                    <input id="option<?php echo $quizlist['que3_hindi']; ?><?php echo $quizlist['id']; ?>" value="C" name="answer[<?php echo $quizlist['id']; ?>][]" type="radio">
                                                    <label for="option<?php echo $quizlist['que3_hindi']; ?><?php echo $quizlist['id']; ?>">
                                                        <span class="fa-stack radio-button">
                                                            <i class="active fa fa-check">
                                                            </i>
                                                        </span> 
                                                         <span style="font-size: 20px;color:#000;!important"><b><?php echo $quizlist['que3']; ?></b></span>
                                                                                                                    <div>
                                                               
                                                            </div>
                                                                                                             </label>
                                                </td>
												<?php } ?>
												</tr>
												<tr>
											<?php if($quizlist['que4']) { ?>	
                                            <td  width="50%">
                                                    <input id="option<?php echo $quizlist['que4_hindi']; ?><?php echo $quizlist['id']; ?>" value="D" name="answer[<?php echo $quizlist['id']; ?>][]" type="radio">
                                                    <label for="option<?php echo $quizlist['que4_hindi']; ?><?php echo $quizlist['id']; ?>">
                                                        <span class="fa-stack radio-button">
                                                            <i class="active fa fa-check">
                                                            </i>
                                                        </span> 
                                                         <span style="font-size: 20px;color:#000;!important"><b><?php echo $quizlist['que4']; ?></b></span>
                                                                                                                    <div>
                                                               
                                                            </div>
                                                                                                             </label>
                                                </td>
                                                </tr>
												<?php } ?>
												<tr>                                        </tr>
                                    </tbody></table>
									
									<?php } ?>
									
                                </div>
                            </div>
							
							<?php } ?>
							
                                           <div class="question-answer-button">
										   <table width="100%"><tr>  <!--<button class="btn oe-btn-answered btn-prev" type="button" name="" id="prevbutton" disabled="disabled">
                        <i class="fa fa-angle-left"></i> Previous                    </button> --> 
						
						<td align="left" > <button class="btn oe-btn-notanswered" type="button" name="" id="finishedbutton" onclick="finished()">
                        Finish                    </button></td>
						<td align="right"> <button class="btn oe-btn-answered btn-next" type="button" name="" id="nextbutton" data-last="Finish ">Next<i class="fa fa-angle-right"></i></button></td>
						</tr></table>
                   

                    <!--<button class="btn oe-btn-notvisited" type="button" name="" id="reviewbutton">
                        Mark For Review &amp; Next                    </button>-->

                 

                   <!--   <button class="btn oe-btn-notvisited" type="button" name="" id="clearbutton">
                        Clear Answer                    </button>-->

                    

                </div>
            </div>
          <?php echo form_close(); ?>
        </div>
    </div>
 
    
</div>

<script type="text/javascript">
    $('#reviewbutton').on('click', function () {
        marked = 1;
        $('#questionWizard').wizard('next');
    });

    $('#clearbutton').on('click', function () {
        clearAnswer();
    });

    $('#questionWizard').on('actionclicked.fu.wizard', function (evt, data) {

        totalQuestions = parseInt(totalQuestions);
        var steps = 0;
        if(data.direction == "next") {
            steps = data.step+1;
        } else {
            steps = data.step-1;
        }

        if(steps == totalQuestions) {
            $('#nextbutton').removeClass('oe-btn-answered');
            $('#nextbutton').addClass('oe-btn-notanswered');
            $('#nextbutton i').remove();
            $('#finishedbutton').hide();
        } else if(steps == totalQuestions+1) {
            finished();
        } else {
            $('#nextbutton').removeClass('oe-btn-notanswered');
            $('#nextbutton').addClass('oe-btn-answered');
            $('#nextbutton i').remove();
            $('#nextbutton').append(' <i class="fa fa-angle-right"></i>');
            $('#finishedbutton').show();
        }
        NowStep = steps;

        changeColor(data.step);
        summaryUpdate();
    });

    function summaryUpdate() {
        var summaryNotVisited = $('.questionColor li .notvisited').length;
        var summaryAnswered = $('.questionColor li .answered').length;
        var summaryMarked = $('.questionColor li .marked').length;
        var summaryNotAnswered = $('.questionColor li .notanswered').length;
        $('#summaryNotVisited').html(summaryNotVisited);
        $('#summaryAnswered').html(summaryAnswered);
        $('#summaryMarked').html(summaryMarked);
        $('#summaryNotAnswered').html(summaryNotAnswered);
    }

    function changeColor(stepID) {
        list = $('#answerForm #step'+stepID+' input ');
        var have = 0;
        var result = $.each( list, function() {
            elementType = $(this).attr('type');
            if(elementType == 'radio' || elementType == 'checkbox') {
                if($(this).prop('checked')) {
                    have = 1;
                    return have;
                }
            } else if(elementType == 'text') {
                if($(this).val() != '') {
                    have = 1;
                    return have;
                }
            }
        });
        if(have) {
            $('#question'+stepID).removeClass('notvisited');
            $('#question'+stepID).removeClass('notanswered');
            $('#question'+stepID).removeClass('marked');
            $('#question'+stepID).addClass('answered');
        } else {
            $('#question'+stepID).removeClass('notvisited');
            $('#question'+stepID).removeClass('answered');
            if($('#question'+stepID).attr('class') != 'marked') {
                $('#question'+stepID).addClass('notanswered');
            }
        }

        if(marked) {
            marked = 0;
            if($('#question'+stepID).attr('class') != 'answered') {
                $('#question'+stepID).removeClass('notvisited');
                $('#question'+stepID).removeClass('notanswered');
                $('#question'+stepID).addClass('marked');
            }
        }
    }

    function jumpQuestion(questionNumber) {
        changeColor(NowStep);
        NowStep = questionNumber;
        $('#questionWizard').wizard('selectedItem', {
            step: questionNumber
        });
        changeColor(questionNumber);
        if(questionNumber == totalQuestions) {
            $('#nextbutton').removeClass('oe-btn-answered');
            $('#nextbutton').addClass('oe-btn-notanswered');
            $('#nextbutton i').remove();
            $('#finishedbutton').hide();
        } else {
            $('#nextbutton').removeClass('oe-btn-notanswered');
            $('#nextbutton').addClass('oe-btn-answered');
            $('#nextbutton i').remove();
            $('#nextbutton').append(' <i class="fa fa-angle-right"></i>');
            $('#finishedbutton').show();
        }
        summaryUpdate();
    }

    function clearAnswer() {
        list = $('#answerForm #step'+NowStep+' input ');
        $.each( list, function() {
            elementType = $(this).attr('type');
            switch(elementType) {
                case 'radio': $(this).prop('checked', false); break;
                case 'checkbox': $(this).attr('checked', false); break;
                case 'text': $(this).val(''); break;
            }
        });
        if($('#question'+NowStep).attr('class') == 'marked') {
            $('#question'+NowStep).removeClass('marked');
            $('#question'+NowStep).addClass('notanswered');
        }
    }

    function finished() {
		
		if (window.confirm("Are you sure you want to finish the Exam?")) { 
         $('#answerForm').submit();
        }
		
		
        
		
    }

    function counter() {
        setInterval(function() {
            durationUpdate();
            $('#timerdiv').html( ((hours < 10) ? '0' + hours : hours) + ':' + ((minutes < 10) ? '0' + minutes : minutes) + ':' + ((seconds < 10) ? '0' + seconds : seconds ));
            duration = (hours*60)+minutes;
        }, 1000);
    }

    function durationUpdate() {
        hours = 0;
        minutes = duration;
        if(minutes > 60) {
            hours = parseInt(duration/60, 10);
            minutes = duration % 60;
        }
        --seconds;
        minutes = (seconds < 0) ? --minutes : minutes;
        if(minutes < 0 && hours != 0) {
            --hours;
            minutes = 59;
        }

        if(hours < 0) {
            hours = 0;
        }

        seconds = (seconds < 0) ? 59 : seconds;
        if (minutes < 0 && hours == 0) {
            minutes = 0;
            seconds = 0;
            finished();
            clearInterval(interval);
        }
    }

    function timeString() {
        return ((hours < 10) ? '0' + hours : hours) + ':' + ((minutes < 10) ? '0' + minutes : minutes) + ':' + ((seconds < 10) ? '0' + seconds : seconds );
    }

    var duration = parseInt("<?php echo $timer; ?>");
    var totalQuestions = parseInt("<?php echo sizeof($list); ?>");
    var seconds = 1;
    var hours = 0;
    var minutes = -1;
    var NowStep = 1;
    var marked = 0;
    durationUpdate();
    $('.duration').html(timeString());
    if(duration != 0) {
        counter();
    } else {
        $('.counterDiv').hide();
    }
    summaryUpdate();

    $('.sidebar-menu li a').css('pointer-events', 'none');

    function disableF5(e) {
       /* if ( ( (e.which || e.keyCode) == 116 ) || ( e.keyCode == 82 && e.ctrlKey ) ) {
            e.preventDefault();
        } */
    } 

    $(document).bind("keydown", disableF5);

    function Disable(event) {
        if (event.button == 2)
        {
            window.oncontextmenu = function () {
                return false;
            }
        }
    }

    document.onmousedown = Disable;

    if(totalQuestions == 1) {
        $('#nextbutton').removeClass('oe-btn-answered');
        $('#nextbutton').addClass('oe-btn-notanswered');
        $('#nextbutton i').remove();
        $('#finishedbutton').hide();
    }
</script>                    </div>
                </div>
            </section>
        </aside>

        
        </div><!-- ./wrapper -->

        <script type="text/javascript" src="<?php echo base_url(); ?>uploads/exam_files/bootstrap.min.js.download"></script>
        <!-- Style js -->
        <script type="text/javascript" src="<?php echo base_url(); ?>uploads/exam_files/style.js.download"></script>

        <!-- Jquery datatable tools js -->
        <script type="text/javascript" src="<?php echo base_url(); ?>uploads/exam_files/jquery.dataTables.min.js.download"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>uploads/exam_files/dataTables.buttons.min.js.download"></script>
        
        <script type="text/javascript" src="<?php echo base_url(); ?>uploads/exam_files/buttons.html5.min.js.download"></script>
        <!-- dataTables Tools / -->
        <script type="text/javascript" src="<?php echo base_url(); ?>uploads/exam_files/dataTables.bootstrap.js.download"></script>

        <script type="text/javascript" src="<?php echo base_url(); ?>uploads/exam_files/inilabs.js.download"></script>

        <script>
            $(document).ready(function() {
                $('#example3, #example1, #example2').DataTable( {
                    dom: 'Bfrtip',
                    buttons: [
                        'copyHtml5',
                        'excelHtml5',
                        'csvHtml5',
                        'pdfHtml5'
                    ],
                    search: false
                });
            });
        </script>

        <script type="text/javascript">
            $(function() {
                $("#withoutBtn").dataTable();
            });
        </script>

                
        <script type="text/javascript" src="<?php echo base_url(); ?>uploads/exam_files/fuelux.min.js.download"></script>

        <script type="text/javascript">
            $("ul.sidebar-menu li").each(function(index, value) {
                if($(this).attr('class') == 'active') {
                    $(this).parents('li').addClass('active');
                }
            });

             
           
      </script>
	   
 