<?php 
// ----------------------------------------------------------------
// Creator: Mizan & Kvvaradha
// email:   admin@kvcodes.com
// Title:   Tutorial Hook For HRM
// ----------------------------------------------------------------
$page_security = 'SA_OPEN';
$path_to_root="../..";
include_once($path_to_root . "/includes/session.inc");
include_once($path_to_root . "/includes/ui.inc");
include_once($path_to_root . "/modules/HumanResourceManagement/includes/employee_db.inc");


    $js = get_js_date_picker();
page(_($help_context = "Employee"), false, false, "", $js);

	if(isset($_GET['Updated'])) {	
		display_notification(" The Selected Employee Informations Update."); 
	} elseif(isset($_GET['Added'])) {	
		display_notification(" New Employee Added ."); 
	}
	if (isset($_GET['selected_id'])){
		$_POST['selected_id'] = $_GET['selected_id'];
	}

	$selected_id = get_post('selected_id');
	if (list_updated('selected_id')) {
		$_POST['empl_id'] = $selected_id = get_post('selected_id');
		clear_data();
		$Ajax->activate('details');
	}
	if (get_post('cancel')) {
		$_POST['empl_id'] = $selected_id = $_POST['selected_id'] = '';
		clear_data();
		set_focus('selected_id');
		$Ajax->activate('_page_body');
	}

	function clear_data(){
		unset($_POST['empl_id']);	
		unset($_POST['empl_name']); 
		unset($_POST['pre_address']); 
		unset($_POST['per_address']); 	 
		unset($_POST['date_of_birth']); 
		unset($_POST['age']);  	
		unset($_POST['mobile_phone']);  
		unset($_POST['email']);  
		unset($_POST['grade']);  
		unset($_POST['department']);
		unset($_POST['designation']); 
		unset($_POST['gross_salary']); 
		unset($_POST['date_of_join']); 
	}
	if (isset($_POST['submit'])) {
		if (strlen(trim($_POST['empl_name'])) == 0) {
			display_error(_("The employee name cannot be empty."));
			set_focus('empl_name');
			return false;
		} 
		if (strlen(trim($_POST['gross_salary'])) == 0 ) {
			display_error(_("The employee gross cannot be empty."));
			set_focus('gross_salary');
			return false;
		} 
		if (!input_num('gross_salary')){
			display_error(_("The Entered Gross Pay is incorrect, It should be number."));
			set_focus('gross_salary');
			return false;
		} 
		if (strlen(trim($_POST['basic_salary'])) == 0 ) {
			display_error(_("The employee Basic Pay cannot be empty."));
			set_focus('basic_salary');
			return false;
		} 
		if (!input_num('basic_salary')){
			display_error(_("The Entered Basic Pay is incorrect, It should be number."));
			set_focus('basic_salary');
			return false;
		} 
		if (strlen(trim($_POST['mobile_phone'])) == 0 ) {
			display_error(_("Mobile cannot be empty."));
			set_focus('mobile_phone');
			return false;
		} 
		if (!input_num('mobile_phone')){
			display_error(_("Mobile number should be number and correct."));
			set_focus('mobile_phone');
			return false;
		} 
		if (strlen(trim($_POST['email'])) == 0 ) {
			display_error(_("Email cannot be empty."));
			set_focus('email');
			return false;
		} 
		
		if(isset($_POST['empl_id'])) {
			$empl_id = update_employee($_POST['empl_id'], $_POST['empl_name'] ,  $_POST['pre_address']  ,  $_POST['per_address']  ,  $_POST['date_of_birth'],   $_POST['age'],    $_POST['mobile_phone'],   $_POST['email'], $_POST['grade'], $_POST['department'], $_POST['designation'], $_POST['gross_salary'], $_POST['basic_salary'], $_POST['date_of_join'] );
			meta_forward($_SERVER['PHP_SELF'], "Updated=yes&selected_id=$empl_id");
		} else { 
			$empl_id =add_employee($_POST['empl_name'] ,  $_POST['pre_address']  ,  $_POST['per_address']  ,  $_POST['date_of_birth'],   $_POST['age'],  $_POST['mobile_phone'],   $_POST['email'], $_POST['grade'], $_POST['department'], $_POST['designation'], $_POST['gross_salary'],$_POST['basic_salary'], $_POST['date_of_join'] );	
			meta_forward($_SERVER['PHP_SELF'], "Added=yes&selected_id=$empl_id");
		}
	} 

	if (isset($_POST['delete']) && strlen($_POST['delete']) > 1) {
			$selected_id = $_POST['empl_id'];
			delete_employee($selected_id);
			
			display_notification(_("Selected Employee has been deleted."));
			$_POST['selected_id'] = '';
			clear_data();		
			$Ajax->activate('_page_body');	
	}
	if (isset($selected_id) && $selected_id != '') { // first item display

		$_POST['empl_id'] = $_POST['selected_id'];
		$myrow = get_employee($_POST['empl_id']);
		$_POST['empl_id'] = $myrow["empl_id"];			
		$_POST['empl_name'] = $myrow["empl_name"];
		$_POST['pre_address']  = $myrow["pre_address"];
		$_POST['per_address']  = $myrow["per_address"];		
		$_POST['date_of_birth']  = sql2date($myrow["date_of_birth"]);
		$_POST['age']  = $myrow["age"];		
		$_POST['mobile_phone']  = $myrow["mobile_phone"];
		$_POST['email']  = $myrow["email"];
		$_POST['grade']  = $myrow["grade"];
		$_POST['department']  = $myrow["department"];
		$_POST['designation']  = $myrow["designation"];
		$_POST['gross_salary']  = $myrow["gross_salary"];
		$_POST['basic_salary']  = $myrow["basic"];
		$_POST['date_of_join']  = sql2date($myrow["date_of_join"]);
	}
	start_form();
	if (db_has_employees()) {
		start_table(TABLESTYLE_NOBORDER);
		start_row();
		//stock_items_list_cells(_("Select an item:"), 'selected_id', null, _('New item'), true, check_value('show_inactive'));
		employee_list_cells(_("Select an Employee: "), 'selected_id', null,	_('New Employee'), true, check_value('show_inactive'));
		$new_item = get_post('selected_id')=='';
		//check_cells(_("Show inactive:"), 'show_inactive', null, true);
		end_row();
		end_table();

		if (get_post('_show_inactive_update')) {
			$Ajax->activate('selected_id');
			set_focus('selected_id');
		}
	} else{
		hidden('selected_id', get_post('selected_id'));
	}

		div_start('details');

		start_outer_table(TABLESTYLE2);

			table_section(1);

			table_section_title(_("Employee Informations"));
			if (isset($selected_id) && $selected_id != '' ) { 
				label_row(_("Employee ID:"), $_POST['empl_id']);	
				hidden('empl_id', $_POST['empl_id']);
			}
			text_row(_("Employee Name *:"), 'empl_name', null, 28, 80);	
			textarea_row(_("Present Address:"), 'pre_address', null, 25, 2);
			textarea_row(_("Permanent Address:"), 'per_address', null, 25, 2);
			
			date_row(_("Date of Birth") . ":", 'date_of_birth');
			text_row(_("Age:"), 'age', null, 3, 10);		
			text_row(_("Mobile Phone *:"), 'mobile_phone', null, 28, 40);
			text_row(_("Email *:"), 'email', null, 28, 40);	
			table_section(2);

			table_section_title(_("Employee Job Info"));
			text_row(_("Grade:"), 'grade', null, 28, 10);	
			text_row(_("Department:"), 'department', null, 28, 40);
			text_row(_("Designation:"), 'designation', null, 28, 40);
			text_row(_("Gross Salary Per Month *:"), 'gross_salary', null, 28, 40);
			text_row(_("Basic Salary Per Month *:"), 'basic_salary', null, 28, 40);
			date_row(_("Date of Join") . ":", 'date_of_join');
		end_outer_table(1);

		if (isset($selected_id) && $selected_id != '' ) { 
			submit_center_first('submit', _("Update Employee"), '', @$_REQUEST['popup'] ? true : 'default');
			submit('delete', _("Delete employee"), true, '', true);
			submit_center_last('cancel', _("Cancel"), _("Cancel Edition"), 'cancel');
		}else { 
			submit_center('submit', _("Add New Employee"), true, '', 'default');
		}
		div_end(); 
	end_form();

end_page();
?>