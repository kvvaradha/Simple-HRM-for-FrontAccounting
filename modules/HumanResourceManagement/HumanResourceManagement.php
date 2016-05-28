<?php
// ----------------------------------------------------------------
// Creator: Mizan(& Kvvaradha
// email:   admin@kvcodes.com
// Title:   Tutorial Hook For HRM
// ----------------------------------------------------------------

class HumanResourceManagement_app extends application{
    var $apps;
	function HumanResourceManagement_app()	{
		$this->application("HRM", _($this->help_context = "&HRM"));
		$this->add_module(_("Transactions"));
		$this->add_lapp_function(0, _('Employee Profile'), 'modules/HumanResourceManagement/employee.php', 'SA_EMPLOYEE', MENU_TRANSACTION);
		$this->add_lapp_function(0, _('About Me'), 'modules/HumanResourceManagement/about-me.php', 'SA_EMPLOYEE', MENU_TRANSACTION);
        $this->add_rapp_function(0, _('PaySlip'), 'modules/HumanResourceManagement/payslip.php', 'SA_EMPLOYEE', MENU_TRANSACTION);
        $this->add_rapp_function(0, _('Pay History'), 'modules/HumanResourceManagement/payhistory.php', 'SA_EMPLOYEE', MENU_TRANSACTION);
        $this->add_extensions();
		
	}      
}

?>