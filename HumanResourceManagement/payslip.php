<?php 
// ----------------------------------------------------------------
// Creator: Mizan(& Kvvaradha
// email:   admin@kvcodes.com
// Title:   Tutorial Hook For HRM
// ----------------------------------------------------------------
$page_security = 'SA_OPEN';
$path_to_root="../..";
include_once($path_to_root . "/includes/session.inc");
include_once($path_to_root . "/includes/ui.inc");
include_once($path_to_root . "/gl/includes/db/gl_db_trans.inc");
include_once($path_to_root . "/modules/HumanResourceManagement/includes/employee_db.inc");

$js = '';
if ($use_date_picker)
    $js .= get_js_date_picker();
page(_($help_context = "PaySlip"), false, false, "", $js);

if (isset($_GET['selected_id']))
{
	$_POST['selected_id'] = $_GET['selected_id'];
}
if (isset($_GET['month'])){
	$_POST['month'] = $_GET['month'];
}
if (isset($_GET['year'])){
	$_POST['year'] = $_GET['year'];
}

$month = get_post('month','');
$year = get_post('year','');
$selected_id = get_post('selected_id');
if (list_updated('selected_id')) {
	$_POST['empl_id'] = $selected_id = get_post('selected_id');
    clear_data();
	$Ajax->activate('details');
}

function clear_data(){
	unset($_POST['empl_id']);	
	unset($_POST['empl_name']);	
	unset($_POST['gross_salary']);
}
if (isset($_POST['submit'])) {
	if (strlen(trim($_POST['empl_name'])) == 0) {
		display_error(_("The employee name cannot be empty."));
		set_focus('empl_name');
		return false;
	} 
	if(isset($_POST['empl_id'])) {
		$empl_id = update_employee($_POST['empl_id'], $_POST['empl_name'] ,  $_POST['pre_address']  ,  $_POST['per_address']  ,  $_POST['date_of_birth'],   $_POST['age'],    $_POST['mobile_phone'],   $_POST['email'], $_POST['grade'], $_POST['department'], $_POST['designation'], $_POST['gross_salary'], $_POST['date_of_join'] );
		meta_forward($_SERVER['PHP_SELF'], "Updated=yes&selected_id=$empl_id");
	} else { 
		$empl_id =add_employee($_POST['empl_name'] ,  $_POST['pre_address']  ,  $_POST['per_address']  ,  $_POST['date_of_birth'],   $_POST['age'],  $_POST['mobile_phone'],   $_POST['email'], $_POST['grade'], $_POST['department'], $_POST['designation'], $_POST['gross_salary'], $_POST['date_of_join'] );	
		meta_forward($_SERVER['PHP_SELF'], "Added=yes&selected_id=$empl_id");
	}
} 

start_form();
if (db_has_employees()) {
	start_table(TABLESTYLE_NOBORDER);
	start_row();
    hrm_year_list( _("Year:"), 'year', null);
	hrm_months_list( _("Month:"), 'month', null);
	employee_list_cells(_("Select an Employee: "), 'selected_id', null,	_('New Employee'), true, check_value('show_inactive'));
	$new_item = get_post('selected_id')=='';
	end_row();
	end_table();

	if (get_post('_show_inactive_update')) {
		$Ajax->activate('selected_id');
		set_focus('selected_id');
	}
}
else{
	hidden('selected_id', get_post('selected_id'));
}
//$_POST['leave_days'] = $_POST['monthly_loan'] = 0; 
div_start('details');
if (isset($selected_id) && $selected_id != '' ) { 
	$_POST['empl_id'] = $_POST['selected_id'];
	
	$myrow = get_employee($_POST['empl_id']);
	$_POST['empl_id'] = $myrow["empl_id"];			
	$_POST['empl_name'] = $myrow["empl_name"];
	$gross = $_POST['gross_salary']  = $myrow["gross_salary"];	
	
	start_table(TABLESTYLE2, "width=30%");
		
		table_section_title(_("Employee Informations"));			
		hidden('empl_id', $_POST['empl_id']);
		label_row(_("Employee Name:"), $_POST['empl_id'].'-'.$_POST['empl_name']);			
		date_row(_("Date of Pay") . ":", 'date_of_pay');
		label_row(_("Gross Pay:"), $_POST['gross_salary']);
	hidden('gross_pay', $_POST['gross_salary']);
	text_row(_("Number of Leave days :"), 'leave_days', null, 2, 40);
	text_row(_("Monthly loan Amount:"), 'monthly_loan', null, 2, 40);
	//submit_cells('RefreshInquiry', _("Show"),'',_('Show Results'), 'default');
	
	end_table();
	br();
	submit_center('RefreshInquiry', _("Calculate Pay"), true, '', 'default');
	
	br();
	br();
}
div_end(); 


if (isset($selected_id) && $selected_id != '' ) { 
	div_start('totals_tbl');
	$gross = $_POST['gross_salary'] ;	
	//display_notification( $_POST['leave_days'].$_POST['monthly_loan']); 
	$employee_leave_record = isset($_POST['leave_days'])? $_POST['leave_days']: 0 ;
	$staff_loan = isset($_POST['monthly_loan'])? $_POST['monthly_loan']: 0; 
	if(db_has_employee_payslip($_POST['year'],$_POST['month'], $_POST['empl_id'] )) {
		$existing_payslip = get_current_payslip($_POST['year'],$_POST['month'], $_POST['empl_id'] ); 
		
		$basic_pay = $existing_payslip['basic'];
		$da_pay = $existing_payslip['da'];
		$hra_pay = $existing_payslip['hra'];
		$convey_allow = $existing_payslip['convey_allow'];
		$edu_other_allow = $existing_payslip['edu_other_allow'];
		$pf =  $existing_payslip['pf'];
		$lop_amount = $existing_payslip['lop_amount']; 
		
		$adv_sal = $tds =0;
		$total_ded = $existing_payslip['total_ded'] ; 			
		$date_of_paid = sql2date($existing_payslip['date_of_pay'] ); 			
		$total_net = $existing_payslip['total_net'];
	}else { 
		$basic_pay = $gross*0.30;
		$da_pay = $gross*0.20;
		$hra_pay = $gross*0.20;
		$convey_allow = $gross*0.10;
		$edu_other_allow = $gross*0.20;
		$pf =  ($basic_pay+ $da_pay)*0.12;
		$lop_amount = $employee_leave_record*$gross/25; 
		
		$adv_sal = $tds =0;
		$total_ded = $pf + $staff_loan+ $adv_sal+ $tds+$lop_amount ; 
		$net_sal = $gross - $total_ded; 	
		$total_net = $net_sal;	
	
	}			
	//hidden('pay_array', implode(', ', array_map(function ($v, $k) { return $k . '=' . $v; }, $pay_array, array_keys($pay_array)))); 
	
	hidden('basic', $basic_pay);
	hidden('da', $da_pay);
	hidden('hra', $hra_pay);
	hidden('convey_allow', $convey_allow);
	hidden('edu_other_allow', $edu_other_allow);
	hidden('pf', $pf);
	hidden('lop_amount', $lop_amount);
	hidden('tds', $tds);
	hidden('total_ded', $total_ded);
	hidden('total_net', $total_net);
	
	start_outer_table(TABLESTYLE2);

	table_section(1);

	table_section_title(_("Earning Details"));
	if(db_has_employee_payslip($_POST['year'],$_POST['month'], $_POST['empl_id'] )) {
		label_row(_(" Date of Paid :"), $date_of_paid);
	}
	label_row(_(" Basic:"), $basic_pay, null, 30, 30);
	label_row(_(" DA:"), $da_pay, null, 30, 30);
	label_row(_(" HRA:"), $hra_pay, null, 30, 30);
	label_row(_(" Conveyance:"), $convey_allow, null, 30, 30);
	label_row(_(" Education/ Other Allowance:"), $edu_other_allow, null, 30, 30);
	table_section_title(_(""));
	label_row(_(" Gross Earning"), $gross, null, 30, 30);
	table_section(2);
	table_section_title(_("Deduction"));
	label_row(_(" Provident Fund:"), $pf, null, 30, 30);
	label_row(_(" LOP Amount:"), $lop_amount, null, 30, 30);		
	label_row(_(" Other Deduction:"), $tds, null, 30, 30);		
	label_row(_(" Total Deductions"), $total_ded, null, 30, 30);
	label_row(_(" "), '', null, 30, 30);
	label_row(_(" Net Salary Payable:"), $total_net, null, 30, 30);
	
	end_outer_table(1);
	if(!db_has_employee_payslip($_POST['year'],$_POST['month'], $_POST['empl_id'] )) {
		start_table(TABLESTYLE2); 
		echo '<tr>' ;
		submit_cells('pay_salary', _("Process Payout"),'',_('Show Results'), 'default');
		echo '</tr>'; 
		end_table(); 
	} else { 
		display_warning(" Paid Already!.");
	} 
	div_end();	
}
end_form();

 if(get_post('RefreshInquiry')){
	$Ajax->activate('gross_salary');
	$Ajax->activate('leave_days');
	$Ajax->activate('monthly_loan');
	$Ajax->activate('totals_tbl');
	
}
if(get_post('pay_salary')) {
	
	$pay_slip_id = add_payslip($_POST['year'],$_POST['month'], $_POST['empl_id'], $_POST['basic'], $_POST['da'], $_POST['hra'], $_POST['convey_allow'], $_POST['edu_other_allow'], $_POST['pf'], $_POST['lop_amount'], $_POST['tds'], $_POST['total_ded'], $_POST['total_net'], $_POST['date_of_pay']); 
	add_gl_trans(99, $pay_slip_id, $_POST['date_of_pay'], 5410, 0,0, 'employee Salary #'.$_POST['empl_id'], $_POST['total_net']);
	add_gl_trans(99, $pay_slip_id, $_POST['date_of_pay'], 1060, 0,0, 'employee Salary #'.$_POST['empl_id'], -$_POST['total_net']);
	display_notification(' The Employee Payslip is added #' .$pay_slip_id);
}

end_page();
?>