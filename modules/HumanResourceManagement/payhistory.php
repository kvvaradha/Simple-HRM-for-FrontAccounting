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

page(_($help_context = "Pay History"), false, false);

	if (isset($_GET['month'])){
		$_POST['month'] = $_GET['month'];
	}
	if (isset($_GET['year'])){
		$_POST['year'] = $_GET['year'];
	}

	$month = get_post('month','');
	$year = get_post('year','');
	if (list_updated('month')) {
		$month = get_post('month');   
		$Ajax->activate('details');
	}

	start_form();

	if(db_has_payslip()) {
		start_table(TABLESTYLE_NOBORDER);
		start_row();
		hrm_year_list( _("Year:"), 'year', null);
		hrm_months_list( _("Month:"), 'month', null, true);
		
		end_row();
		end_table();

		if (get_post('_show_inactive_update')) {
			$Ajax->activate('month');
			$Ajax->activate('details');
			set_focus('month');
		}
		
		div_start('details');
			$sal_list = array();
			$sal_list = get_current_month_payslip($_POST['year'], $_POST['month']);

			start_table(TABLESTYLE, "width=90%");
				$th = array(_("Month"), _("Employee Name"), _("Gross Pay"),_("Basic"),_("D A"),_("HRA"),_("Conveyance Allowance"),_("Edu & Other Allowance"),_("LOP Amount"),_("PF "),// _("Staff Loan"),// _("Adv. Salary"),_("TDS"),
				_("Total Deduction"),_("Net Salary"),);

				table_header($th);
				global $hrm_months_list;
				foreach($sal_list as $single_sal) { 			
					start_row();
					label_cell($hrm_months_list[$single_sal['month']]);
					label_cell(kv_get_empl_name($single_sal['empl_id']));
					label_cell(kv_get_empl_grosspay($single_sal['empl_id']));
					label_cell($single_sal['basic']);
					label_cell($single_sal['da']);
					label_cell($single_sal['hra']);
					label_cell($single_sal['convey_allow']);
					label_cell($single_sal['edu_other_allow']);
					label_cell($single_sal['lop_amount']);
					label_cell($single_sal['pf']);
					label_cell($single_sal['total_ded']);
					//label_cell($single_sal['adv_sal']);
					label_cell($single_sal['total_net']);				
					end_row(); 
				}
				unset($sal_list);	
			end_table(1);
		div_end();
	}else { 
		display_warning(_(" Sorry, no Pay data's in your system."));
	}
	end_form();
	
end_page(); ?>