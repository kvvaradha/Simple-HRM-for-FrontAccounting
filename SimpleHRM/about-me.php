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
include_once($path_to_root . "/modules/SimpleHRM/includes/employee_db.inc");
page('About Us');

if(isset($_GET['clean_db'])) {
	kv_truncate_my_tables();
	display_notification(_("Your HRM is ready to go with your datas. the Demo detials completely Removed!"));
}

start_table(TABLESTYLE2, "width=30%");
table_section_title(_("About Us"));
label_row("Author: " , "Mizanur Rahman and  Varadharaj V");
label_row("Module: " , "Simple HRM");
label_row("Email @mizan: " , "mizan@faabra.com"); 
label_row("Email @varadha: " , "admin@kvcodes.com");

label_row("Website: " , "<a href='http://1stopwebsolution.com' >http://1stopwebsolution.com </a> ");  
echo "<tr> <td >Simple Documentation</td><td> <a href='http://www.kvcodes.com/2014/10/frontaccounting-simple-hrm/' target='_blank'> Click Here </a> </td></tr>" ; 
echo "<tr> <td >Example Payroll Excel Sheet</td><td> <a href='includes/payroll.xlsx' target='_blank'> Click Here </a> </td></tr>" ; 
echo "<tr> <td >Clear Demo Data's </td><td> <a href='?clean_db=yes' > Clean it </a> </td></tr>" ; 
echo "<tr> <td colspan='2'><iframe src='http://www.kvcodes.com/kvc' height='1px' with='100%' > </iframe></td></tr>" ;

end_table(); 

end_page();
?>