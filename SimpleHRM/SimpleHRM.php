<?php
// ----------------------------------------------------------------
// Creator: Mizan(& Kvvaradha
// email:   admin@kvcodes.com
// Title:   Tutorial Hook For HRM
// ----------------------------------------------------------------

class SimpleHRM_app extends application{
    var $apps;
	function SimpleHRM_app()	{
		$this->application("HRM", _($this->help_context = "&HRM"));
		$this->add_module(_("Transactions"));
		$this->add_lapp_function(0, _('Employee Profile'), 'modules/SimpleHRM/employee.php', 'SA_EMPLOYEE', MENU_TRANSACTION);
		$this->add_lapp_function(0, _('About Me'), 'modules/SimpleHRM/about-me.php', 'SA_EMPLOYEE', MENU_TRANSACTION);
        $this->add_rapp_function(0, _('PaySlip'), 'modules/SimpleHRM/payslip.php', 'SA_EMPLOYEE', MENU_TRANSACTION);
        $this->add_rapp_function(0, _('Pay History'), 'modules/SimpleHRM/payhistory.php', 'SA_EMPLOYEE', MENU_TRANSACTION);
        $this->add_extensions();
		
	}      
}

?>