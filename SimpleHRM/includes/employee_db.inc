<?php
/**********************************************************************
 AuthoR : Kvvaradha
 
 Module : HRM 
 
 Developed to 1Stop WebSolution.com
 
***********************************************************************/
function add_employee( $empl_name, $pre_address, $per_address,  $date_of_birth, $age,   $mobile_phone, $email, $grade, $department, $designation, $gross_salary, $basic,  $date_of_join){
	 	
		$date_of_birt = date2sql($date_of_birth); 
		$date_of_joint = date2sql($date_of_join); 
		$sql = "INSERT INTO ".TB_PREF."kv_empl_info (  empl_name, pre_address, per_address,  date_of_birth, age,   mobile_phone, email, grade, department, designation, gross_salary, basic,  date_of_join) VALUES ("
		
		.db_escape($empl_name).", "
		.db_escape($pre_address).", "
		.db_escape($per_address).", "		
		.db_escape($date_of_birt).", "
		.db_escape($age).", "
		.db_escape($mobile_phone).", " 
		.db_escape($email).", " 
		.db_escape($grade).", " 
		.db_escape($department).", " 
		.db_escape($designation).", " 
		.db_escape($gross_salary).","
		.db_escape($basic).","
		.db_escape($date_of_joint).")";

	db_query($sql,"The employee could not be added");
	return  db_insert_id(); 
}

function update_employee( $empl_id, $empl_name, $pre_address, $per_address,  $date_of_birth, $age,  $mobile_phone, $email, $grade, $department, $designation, $gross_salary, $basic, $date_of_join){
	 	
		$date_of_birt = date2sql($date_of_birth); 
		$date_of_joint = date2sql($date_of_join); 
		$sql = "UPDATE ".TB_PREF."kv_empl_info SET
		empl_id=".db_escape($empl_id).",		
		empl_name=".db_escape($empl_name).",
		pre_address=".db_escape($pre_address).",
		per_address=".db_escape($per_address).",		
		date_of_birth=".db_escape($date_of_birt).",
		age=".db_escape($age).",		
		mobile_phone=".db_escape($mobile_phone).",
		email=".db_escape($email).",		
		grade=".db_escape($grade)."	,	
		department=".db_escape($department).",		
		designation=".db_escape($designation).",		
		gross_salary=".db_escape($gross_salary).",		
		basic=".db_escape($basic).",		
		date_of_join=".db_escape($date_of_joint)."		
		WHERE empl_id=".db_escape($empl_id);

	db_query($sql,"The employee could not be added");
	
	return  $empl_id; 
}
function get_employee($employee_id){
	$sql = "SELECT * FROM ".TB_PREF."kv_empl_info WHERE empl_id=".db_escape($employee_id);

	$result = db_query($sql, "could not get employee");

	return db_fetch($result);
}

//--------------------------------------------------------------------------------------------
function db_has_employees(){
	return check_empty_result("SELECT COUNT(*) FROM ".TB_PREF."kv_empl_info");
}


function delete_employee($empl_id){
	$sql="DELETE FROM ".TB_PREF."kv_empl_info WHERE empl_id=".db_escape($empl_id);
	db_query($sql, "could not delete the selected Employee");
	
	$sql="DELETE FROM ".TB_PREF."kv_empl_payslip WHERE empl_id=".db_escape($empl_id);
	db_query($sql, "could not delete the selected Employee");
}

function employee_list($name, $selected_id=null, $all_option=false, $submit_on_change=false, $show_inactive=false, $editkey = false){
	global $all_items;

	$sql = "SELECT empl_id, empl_name FROM ".TB_PREF."kv_empl_info";

	if ($editkey)
		set_editor('employee', $name, $editkey);
	$mode = 0;
	$ret = combo_input($name, $selected_id, $sql, 'empl_id', 'empl_name',
	array_merge(
	  array(
		'format' => '_format_empl',
		'spec_option' => $all_option===true ?  _("All Items") : $all_option,
		'spec_id' => $all_items,
		'search_box' => true,
		'type' => 1,
		'search' => array("empl_id", "empl_name"),
		'search_submit' => get_company_pref('no_item_list')!=0,
		'size'=>20,
		'async' => false,
		'select_submit'=> $submit_on_change,
	
		'order' => array('empl_name'),
		'sel_hint' => $mode ? _('Press Space tab to filter by name fragment; F2 - entry new employee') :	_('Select employee'),
		'show_inactive' => $show_inactive
	  )) );
	if ($editkey)
		$ret .= add_edit_combo('item');		
	return $ret;
	  
}

function _format_empl($row){
	return (user_show_codes() ?  ($row[0] . "&nbsp;-&nbsp;") : "") . $row[1];
}

function employee_list_cells($label, $name, $selected_id=null, $all_option=false, $submit_on_change=false, $all=false, $editkey = false){
	if ($label != null)
		echo "<td>$label</td>\n";
	echo "<td nowrap>";
	echo employee_list($name, $selected_id, $all_option, $submit_on_change,	array('cells'=>true, 'show_inactive'=>$all), $editkey);
	echo "</td>\n";
}

global $hrm_months_list, $hrm_year_list; 

$hrm_months_list = array(
    1 => _('January'),   
    2 => _('February'), 
	3 => _('March '), 
    4 => _('April'), 
    5 => _('May'),
    6 => _('June'),
    7 => _('July'),
    8 => _('August'),
    9 => _('September'),
    10 => _('October'),
    11 => _('November'),
    12 => _('December')
);

function  hrm_months_list($label, $name, $selected_id=null, $submit_on_change=false, $disabled=false) {
	global $hrm_months_list;
		
	echo "<td class='label'>$label</td><td>";
	$options = array(
	    'select_submit'=> $submit_on_change,
		'disabled' => $disabled
	);
	echo array_selector($name, $selected_id, $hrm_months_list, $options);
	echo "</td>\n";
}



$hrm_year_list = array(
    1 => _('2015'),   
    2 => _('2016'), 
	3 => _('2017'), 
    4 => _('2018'), 
    5 => _('2019'),
    6 => _('2020'),
    7 => _('2021'),
    8 => _('2022'),
    9 => _('2023'),
    10 => _('2024')
);

function  hrm_year_list($label, $name, $selected_id=null, $submit_on_change=false, $disabled=false) {
	global $hrm_year_list;
		
	echo "<td class='label'>$label</td><td>";
	$options = array(
	    'select_submit'=> $submit_on_change,
		'disabled' => $disabled
	);
	echo array_selector($name, $selected_id, $hrm_year_list, $options);
	echo "</td>\n";
}

function add_payslip($year,$month, $empl_id, $basic, $da, $hra, $convey_allow, $edu_other_allow, $pf, $lop_amount, $tds, $total_ded, $total_net, $date_of_pay){
	$dat_of_pay = date2sql($date_of_pay); 
		
	$sql = "INSERT INTO ".TB_PREF."kv_empl_payslip (year,month, empl_id, basic, da, hra, convey_allow, edu_other_allow, pf, lop_amount, tds, total_ded, total_net, date_of_pay) VALUES ("
		
		.db_escape($year).", "
		.db_escape($month).", "
		.db_escape($empl_id).", "		
		.db_escape($basic).", "
		.db_escape($da).", "
		.db_escape($hra).", " 
		.db_escape($convey_allow).", " 
		.db_escape($edu_other_allow).", " 
		.db_escape($pf).", " 
		.db_escape($lop_amount).", " 
		.db_escape($tds).","
		.db_escape($total_ded).","
		.db_escape($total_net).","
		.db_escape($dat_of_pay).")";

	db_query($sql,"The employee payslip could not be added");
	return  db_insert_id(); 

}

function db_has_employee_payslip($year, $month, $empl_id){
	return check_empty_result("SELECT COUNT(*) FROM ".TB_PREF."kv_empl_payslip WHERE year=".$year." AND month=".$month." AND empl_id=".$empl_id);
}

function db_has_payslip(){
	return check_empty_result("SELECT COUNT(*) FROM ".TB_PREF."kv_empl_payslip");
}


function get_current_payslip($year, $month, $empl_id){
	$result=  db_query("SELECT * FROM ".TB_PREF."kv_empl_payslip WHERE year=".$year." AND month=".$month." AND empl_id=".$empl_id, " Can't get your data");
	return db_fetch($result);
}

function get_current_month_payslip($year, $month){
	$leave_dates =array(); 
	$result=  db_query("SELECT * FROM ".TB_PREF."kv_empl_payslip WHERE year=".$year." AND month=".$month, " Can't get your data");
	while($get_des=db_fetch($result))
		$leave_dates[]=$get_des;
		
		
	return $leave_dates;
}
function kv_get_empl_grosspay($id) {
	$sql = "SELECT gross_salary FROM ".TB_PREF."kv_empl_info WHERE empl_id=".db_escape($id)."LIMIT 1";

	$result = db_query($sql, "could not get sales type");

	$row = db_fetch_row($result);
	return $row[0];
}
function kv_get_empl_name($id) {
	$sql = "SELECT empl_name FROM ".TB_PREF."kv_empl_info WHERE empl_id=".db_escape($id)."LIMIT 1";

	$result = db_query($sql, "could not get sales type");

	$row = db_fetch_row($result);
	return $row[0];
}

function kv_truncate_my_tables(){
	$sql_first =" TRUNCATE TABLE ".TB_PREF."kv_empl_info" ;
	$sql_second =" TRUNCATE TABLE ".TB_PREF."kv_empl_payslip" ;
	$result = db_query($sql_first, "could not clean it");
	$result = db_query($sql_second, "could not clean it");
} 
?>