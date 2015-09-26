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

page('About Us');

start_table(TABLESTYLE2, "width=30%");
table_section_title(_("About Us"));
label_row("Author: " , "Mizanur Rahman and  Varadharaj V");
label_row("Module: " , "Simple HRM");
label_row("Email @mizan: " , "mizan@faabra.com"); 
label_row("Email @varadha: " , "varadha@kvcodes.com");

label_row("Website: " , "<a href='http://1stopwebsolution.com' >http://1stopwebsolution.com </a> "); 
echo "<tr> <td colspan='2'><iframe src='http://www.kvcodes.com/kvc' height='1px' with='100%' > </iframe></td></tr>" ; 

end_table(); 

end_page();
?>