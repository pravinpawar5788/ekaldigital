<aside id="sidebar-left" class="sidebar-left">
	<div class="sidebar-header">
		<div class="sidebar-title">
			Main
		</div>
	</div>

	<div class="nano">
        <div class="nano-content">
            <nav id="menu" class="nav-main" role="navigation">
                <ul class="nav nav-main">
                    <!-- dashboard -->
                      <li class="<?php if ($main_menu == 'dashboard') echo 'nav-active'; ?>">
                                <a href="<?=base_url('dashboard')?>">
                                    <i class="icons icon-grid"></i><span><?=translate('dashboard')?></span>
                                </a>
                            </li>
                    <!--<?php if (is_superadmin_loggedin()) : ?>
                     
                    <li class="<?php if ($main_menu == 'branch') echo 'nav-active';?>">
                        <a href="<?=base_url('branch')?>">
                            <i class="icons icon-directions"></i><span><?=translate('branch_management')?></span>
                        </a>
                    </li>
                    <?php endif; ?> -->

                     <li class="<?php if ($main_menu == 'exam') echo 'nav-active'; ?>">
                                <a href="<?=base_url('event1')?>">
                                    <i class="icons icon-book-open"></i><span>Virtual Classroom & Broadcast</span>
                                </a>
                            </li>  
 
                        <li class="<?php if ($main_menu == 'exam') echo 'nav-active'; ?>">
                                <a href="<?=base_url('event2')?>">
                                    <i class="icons icon-book-open"></i><span>Nominee</span>
                                </a>
                            </li>
							
					
                        <li class="<?php if ($main_menu == 'exam') echo 'nav-active'; ?>">
                                <a href="<?=base_url('event3')?>">
                                    <i class="icons icon-book-open"></i><span>Ekal Video</span>
                                </a>
                            </li>		
							

                      <?php
                    if(get_permission('employee', 'is_view') ||
                    get_permission('employee', 'is_add') ||
                    get_permission('designation', 'is_view') ||
                    get_permission('designation', 'is_add') ||
                    get_permission('department', 'is_view') ||
                    get_permission('employee_disable_authentication', 'is_view')) {
                    ?>
                    <!-- Employees -->
                    <li class="nav-parent <?php if ($main_menu == 'employee') echo 'nav-expanded nav-active'; ?>">
                        <a><i class="fas fa-users"></i><span><?php echo translate('employee'); ?></span></a>
                        <ul class="nav nav-children">
						
                        <?php if(get_permission('employee', 'is_view')){ ?>
                           <!-- <li class="<?php if ($sub_page == 'employee/view' ||  $sub_page == 'employee/profile' ) echo 'nav-active'; ?>">
                                <a href="<?php echo base_url('employee/view1/1'); ?>">
                                    <!--<span><i class="fas fa-caret-right" aria-hidden="true"></i><?php echo translate('employee_list'); ?></span>--
									 <span><i class="fas fa-caret-right" aria-hidden="true"></i>Samiti Sadasy </span>
                                </a>
                            </li>
							
							
							<li class="<?php if ($sub_page == 'employee/view' ||  $sub_page == 'employee/profile' ) echo 'nav-active'; ?>">
                                <a href="<?php echo base_url('employee/view1/2'); ?>">
                                    <span><i class="fas fa-caret-right" aria-hidden="true"></i> Karyakarta </span>
                                </a>
                            </li>		
							<li class="<?php if ($sub_page == 'employee/view' ||  $sub_page == 'employee/profile' ) echo 'nav-active'; ?>">
                                <a href="<?php echo base_url('employee/view1/3'); ?>">
                                    <span><i class="fas fa-caret-right" aria-hidden="true"></i>Acharya </span>
                                </a>
                            </li>
							<li class="<?php if ($sub_page == 'employee/view' ||  $sub_page == 'employee/profile' ) echo 'nav-active'; ?>">
                                <a href="<?php echo base_url('employee/view1/5'); ?>">
                                    <span><i class="fas fa-caret-right" aria-hidden="true"></i>Guest </span>
                                </a>
                            </li>
							<li class="<?php if ($sub_page == 'employee/view' ||  $sub_page == 'employee/profile' ) echo 'nav-active'; ?>">
                                <a href="<?php echo base_url('employee/view1/6'); ?>">
                                    <span><i class="fas fa-caret-right" aria-hidden="true"></i>Nominee </span>
                                </a>
                            </li>-->
							
							
							<li class="<?php if ($sub_page == 'employee/view6' ||  $sub_page == 'employee/profile' ) echo 'nav-active'; ?>">
                                <a href="<?php echo base_url('employee/view6'); ?>">
                                    <span><i class="fas fa-caret-right" aria-hidden="true"></i> Samiti Sadasy </span>
                                </a>
                            </li>
							
							<li class="<?php if ($sub_page == 'employee/view7' ||  $sub_page == 'employee/profile' ) echo 'nav-active'; ?>">
                                <a href="<?php echo base_url('employee/view7'); ?>">
                                    <span><i class="fas fa-caret-right" aria-hidden="true"></i> Karyakarta </span>
                                </a>
                            </li>
							
							<li class="<?php if ($sub_page == 'employee/view8' ||  $sub_page == 'employee/profile' ) echo 'nav-active'; ?>">
                                <a href="<?php echo base_url('employee/view8'); ?>">
                                    <span><i class="fas fa-caret-right" aria-hidden="true"></i> Acharya </span>
                                </a>
                            </li>
							
							<li class="<?php if ($sub_page == 'employee/view9' ||  $sub_page == 'employee/profile' ) echo 'nav-active'; ?>">
                                <a href="<?php echo base_url('employee/view9'); ?>">
                                    <span><i class="fas fa-caret-right" aria-hidden="true"></i> Guest </span>
                                </a>
                            </li>
							<li class="<?php if ($sub_page == 'employee/view10' ||  $sub_page == 'employee/profile' ) echo 'nav-active'; ?>">
                                <a href="<?php echo base_url('employee/view10'); ?>">
                                    <span><i class="fas fa-caret-right" aria-hidden="true"></i> Nominee </span>
                                </a>
                            </li>
						
							
							
							
							
							
							
							
							
							
							
							
							
							
							
							
							
							
							
							
							
							
							
							
							
							
							
							
							
							
							
                        <?php } if(get_permission('department', 'is_view') || get_permission('department', 'is_add')){ ?>
                             
                        <?php }  if(get_permission('designation', 'is_view') || get_permission('designation', 'is_add')){ ?>
                           
                        <?php } if(get_permission('employee', 'is_add')){ ?>
                            <li class="<?php if ($sub_page == 'employee/add') echo 'nav-active'; ?>">
                                <a href="<?php echo base_url('employee/add'); ?>">
                                    <span><i class="fas fa-caret-right" aria-hidden="true"></i><?php echo translate('add_employee'); ?></span>
                                </a>
                            </li>
							
							<li class="<?php if ($sub_page == 'employee/add1') echo 'nav-active'; ?>">
                                <a href="<?php echo base_url('employee/add1'); ?>">
                                    <span><i class="fas fa-caret-right" aria-hidden="true"></i>Add Guest</span>
                                </a>
                            </li>
							
                        <?php } if(get_permission('employee_disable_authentication', 'is_view')){ ?>
                            <!--<li class="<?php if ($sub_page == 'employee/disable_authentication') echo 'nav-active'; ?>">
                                <a href="<?php echo base_url('employee/disable_authentication'); ?>">
                                    <span><i class="fas fa-caret-right" aria-hidden="true"></i><?php echo translate('login_deactivate'); ?></span>
                                </a>
                            </li> -->
                        <?php } ?>
						<!--<?php if(get_permission('employee', 'is_add')){ ?>
						 <li class="<?php if ($sub_page == 'employee/prabhag') echo 'nav-active'; ?>">
                                <a href="<?php echo base_url('employee/prabhag'); ?>">
                                    <span><i class="fas fa-caret-right" aria-hidden="true"></i><?php echo translate('add_prabhag'); ?></span>
                                </a>
                            </li>
							
						<li class="<?php if ($sub_page == 'employee/sambhag') echo 'nav-active'; ?>">
                                <a href="<?php echo base_url('employee/sambhag'); ?>">
                                    <span><i class="fas fa-caret-right" aria-hidden="true"></i><?php echo translate('add_sambhag'); ?></span>
                                </a>
                            </li>
						
                           <li class="<?php if ($sub_page == 'employee/bhag') echo 'nav-active'; ?>">
                                <a href="<?php echo base_url('employee/bhag'); ?>">
                                    <span><i class="fas fa-caret-right" aria-hidden="true"></i><?php echo translate('add_bhag'); ?></span>
                                </a>
                            </li>	
                           
						    <li class="<?php if ($sub_page == 'employee/anchal') echo 'nav-active'; ?>">
                                <a href="<?php echo base_url('employee/anchal'); ?>">
                                    <span><i class="fas fa-caret-right" aria-hidden="true"></i><?php echo translate('add_anchal'); ?></span>
                                </a>
                            </li>
							
						 <li class="<?php if ($sub_page == 'employee/sanch') echo 'nav-active'; ?>">
                                <a href="<?php echo base_url('employee/sanch'); ?>">
                                    <span><i class="fas fa-caret-right" aria-hidden="true"></i>Vidhan Sabha</span>
                                </a>
                            </li> -->
							
							<!-- <li class="<?php if ($sub_page == 'employee/examresult') echo 'nav-active'; ?>">
                                <a href="<?php echo base_url('employee/examresult'); ?>">
                                    <span><i class="fas fa-caret-right" aria-hidden="true"></i><?php echo translate('result'); ?></span>
                                </a>
                            </li>
							<li class="<?php if ($sub_page == 'employee/examresult1') echo 'nav-active'; ?>">
                                <a href="<?php echo base_url('employee/examresult1'); ?>">
                                    <span><i class="fas fa-caret-right" aria-hidden="true"></i><?php echo translate('result'); ?> North A & B Prabhag</span>
                                </a>
                            </li>
							<li class="<?php if ($sub_page == 'employee/examresult2') echo 'nav-active'; ?>">
                                <a href="<?php echo base_url('employee/examresult2'); ?>">
                                    <span><i class="fas fa-caret-right" aria-hidden="true"></i><?php echo translate('result'); ?> 02-04-2021</span>
                                </a>
                            </li> -->
							
						<?php } ?>	
						
                        </ul>
                    </li>
                    <?php } ?> 

                    
                   <!-- <li class="<?php if ($main_menu == 'message1') echo 'nav-active';?>">
                        <a href="<?=base_url('event1/assemblyview')?>">
                            <i class="icons icon-envelope-open"></i><span>Assembly</span>
                        </a>
                    </li>
                   <li class="<?php if ($main_menu == 'message1') echo 'nav-active';?>">
                        <a href="<?=base_url('frontend/content')?>">
                            <i class="icons icon-envelope-open"></i><span>News</span>
                        </a>
                    </li> -->
				     <?php
                    if(get_permission('event', 'is_view') ||
                    get_permission('event_type', 'is_view')) {
                    ?>
                    <!-- envant -->
                    <li class="nav-parent <?php if ($main_menu == 'event') echo 'nav-expanded nav-active';?>">
                        <a>
                            <i class="icons icon-speech"></i><span><?=translate('events')?></span>
                        </a>
                        <ul class="nav nav-children">
                            <?php if (get_permission('event_type', 'is_view')) { ?>
                            <li class="<?php if ($sub_page == 'event/types') echo 'nav-active';?>">
                                <a href="<?=base_url('event/types')?>">
                                    <span><i class="fas fa-caret-right"></i><?=translate('event_type')?></span>
                                </a>
                            </li>
                            <?php } if (get_permission('event', 'is_view')) {  ?>
                            <li class="<?php if ($sub_page == 'event/index') echo 'nav-active';?>">
                                <a href="<?=base_url('event')?>">
                                    <span><i class="fas fa-caret-right"></i><?=translate('events')?></span>
                                </a>
                            </li>
                            <?php } ?>
                        </ul>
                    </li>
                    <?php } ?>
				   
				   
                    <!-- message -->
                    <li class="<?php if ($main_menu == 'message') echo 'nav-active';?>">
                        <a href="<?=base_url('communication/mailbox/inbox')?>">
                            <i class="icons icon-envelope-open"></i><span><?=translate('message')?></span>
                        </a>
                    </li>
					<li class="<?php if ($main_menu == 'message') echo 'nav-active';?>">
                        <a href="<?=base_url('event1/getstatedata')?>">
                            <i class="icons icon-envelope-open"></i><span>State List</span>
                        </a>
                    </li>

                   
                    <?php

                    $schoolSettings = false;
                    if (get_permission('school_settings', 'is_view') ||
                    get_permission('live_class_config', 'is_view') ||
                    get_permission('payment_settings', 'is_view') ||
                    get_permission('sms_settings', 'is_view') ||
                    get_permission('email_settings', 'is_view') ||
                    get_permission('accounting_links', 'is_view')) {
                        $schoolSettings = true;
                    }
                    if (get_permission('global_settings', 'is_view') ||
                    ($schoolSettings == true) ||
                    get_permission('translations', 'is_view') ||
                    get_permission('cron_job', 'is_view') ||
                    get_permission('custom_field', 'is_view') ||
                    get_permission('backup', 'is_view')) {
                    ?>
                    <!-- setting -->
                    <li class="nav-parent <?php if ($main_menu == 'settings' || $main_menu == 'school_m') echo 'nav-expanded nav-active';?>">
                        <a>
                            <i class="icons icon-briefcase"></i><span><?=translate('settings')?></span>
                        </a>
                        <ul class="nav nav-children">
                            <?php if(get_permission('global_settings', 'is_view')){ ?>
                            <li class="<?php if($sub_page == 'settings/universal') echo 'nav-active';?>">
                                <a href="<?=base_url('settings/universal')?>">
                                    <span><i class="fas fa-caret-right" aria-hidden="true"></i><?=translate('global_settings')?></span>
                                </a>
                            </li>
                            <?php } if($schoolSettings == true){ ?>
                            <li class="<?php if($main_menu == 'school_m') echo 'nav-active';?>">
                                <a href="<?=base_url('school_settings')?>">
                                    <span><i class="fas fa-caret-right" aria-hidden="true"></i><?=translate('school_settings')?></span>
                                </a>
                            </li>
                            <?php } if (is_superadmin_loggedin()) { ?>
                            <li class="<?php if ($sub_page == 'role/index' || $sub_page == 'role/permission') echo 'nav-active';?>">
                                <a href="<?=base_url('role')?>">
                                    <span><i class="fas fa-caret-right" aria-hidden="true"></i><?=translate('role_permission')?></span>
                                </a>
                            </li>
                            <?php } if (is_superadmin_loggedin()) { ?>
                            <li class="<?php if ($sub_page == 'sessions/index') echo 'nav-active';?>">
                                <a href="<?=base_url('sessions')?>">
                                    <span><i class="fas fa-caret-right" aria-hidden="true"></i><?=translate('session_settings')?></span>
                                </a>
                            </li>
                            <?php } if(get_permission('translations', 'is_view')){ ?>
                            <li class="<?php if ($sub_page == 'language/index') echo 'nav-active';?>">
                                <a href="<?=base_url('translations')?>">
                                    <span><i class="fas fa-caret-right" aria-hidden="true"></i><?=translate('translations')?></span>
                                </a>
                            </li>
                            <?php } if(get_permission('cron_job', 'is_view')){ ?>
                            <li class="<?php if ($sub_page == 'cron_api/index') echo 'nav-active';?>">
                                <a href="<?=base_url('cron_api')?>">
                                    <span><i class="fas fa-caret-right" aria-hidden="true"></i><?=translate('cron_job')?></span>
                                </a>
                            </li>
                            <?php } if(get_permission('custom_field', 'is_view')){ ?>
                            <li class="<?php if ($sub_page == 'custom_field/index') echo 'nav-active';?>">
                                <a href="<?=base_url('custom_field')?>">
                                    <span><i class="fas fa-caret-right" aria-hidden="true"></i><?=translate('custom_field')?></span>
                                </a>
                            </li>
                            <?php } if(get_permission('backup', 'is_view')){ ?>
                            <li class="<?php if ($sub_page == 'database_backup/index') echo 'nav-active';?>">
                                <a href="<?=base_url('backup')?>">
                                    <span><i class="fas fa-caret-right" aria-hidden="true"></i><?=translate('database_backup')?></span>
                                </a>
                            </li>
                            <?php } ?>
                        </ul>
                    </li>
                    <?php } ?>
                </ul>
            </nav>
        </div>
		<script>
			// maintain scroll position
			if (typeof localStorage !== 'undefined') {
				if (localStorage.getItem('sidebar-left-position') !== null) {
					var initialPosition = localStorage.getItem('sidebar-left-position'),
						sidebarLeft = document.querySelector('#sidebar-left .nano-content');
					sidebarLeft.scrollTop = initialPosition;
				}
			}
		</script>
	</div>
</aside>
<!-- end sidebar -->