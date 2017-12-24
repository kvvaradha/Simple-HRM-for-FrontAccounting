![Simple HRM](http://www.kvcodes.com/wp-content/uploads/2014/10/simple-HRM-188x300.png)

# Simple HRM Frontaccounting

I have few HRM Versions. Check it <a href="http://www.kvcodes.com/module/simple-hrm-frontaccounting/" > Here.</a> 

Introduction:
---------

Simple HRM is a simple module for the users, who needs a simple one to maintain their employee details and their pay details. 

you can get the informations about this module  <a href="http://www.kvcodes.com/2014/10/frontaccounting-simple-hrm/" target="_blank"> Here.  </a> And <a href="http://www.kvcodes.com/module/simple-hrm-frontaccounting/" > Here </a>.

you can feedback your comments below the article or here in issues page. 

[![IMAGE ALT TEXT HERE](https://img.youtube.com/vi/IKBMxKyT6qA/0.jpg)](https://www.youtube.com/watch?v=IKBMxKyT6qA)

if you want to integrate this module with your current FA. You can integrate this extension inside your FrontAccounting(FA)  by doing the following steps

1. copy those HumanResourceManagement to root of your FA.  and open the hooks.php  copy the following code and open the Root of FA/includes/ access_level.inc"  and add it there. 

 $security_sections[SS_HRM] =  _("HRM");

        $security_areas['SA_HRMSETUP'] = array(SS_HRM|1, _("HRM Setup"));
        $security_areas['SA_EMPLOYEE'] = array(SS_HRM|2, _("Employee"));

2. now, open the frontaccounting.php which is there in the root of FA/frontaccounting.php

here find this code. 
    include_once($path_to_root . '/applications/setup.php');
and add the follwoing line below of it. 
    include_once($path_to_root . '/HumanResourceManagement/HumanResourceManagement.php');

3. Now, open the FA/HumanResourceManagement/includes/SimpleHRM.sql.  just import this table inside your FA.  You have to check the table prefix before importing it.   its like "0_"  . so check whether your database table prefix matches with it or not. and than import it. 

4. Now, login into your front accounting. you can see a new menu in it. and move to Setup->access Setup -> here select your user role, than check all the hrm checkboxes which is there in the bottom of the user roles table. 

now, logout and login again, you can get access. 

Update 2.4.1:
---------
Read it from my blog <a href="http://www.kvcodes.com/module/simple-hrm-frontaccounting/" > Simple HRM for FA - Kvcodes </a>

Update 2.4.1:
---------

Please take a look at my blog for more.
