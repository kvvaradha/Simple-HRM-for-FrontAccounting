![Nova Framework](http://novaframework.com/app/templates/publicthemes/nova/images/nova.png)

# Nova Framework v3.0

[![Total Downloads](https://img.shields.io/packagist/dt/nova-framework/framework.svg)](https://packagist.org/packages/nova-framework/framework)
[![Dependency Status](https://www.versioneye.com/user/projects/554367f738331321e2000005/badge.svg)](https://www.versioneye.com/user/projects/554367f738331321e2000005)
[![GitHub license](https://img.shields.io/badge/license-MIT-blue.svg)](https://github.com/nova-framework/framework/blob/master/LICENSE.txt)
[![GitHub stars](https://img.shields.io/github/stars/nova-framework/framework.svg)](https://github.com/nova-framework/framework/stargazers)
[![GitHub forks](https://img.shields.io/github/forks/nova-framework/framework.svg)](https://github.com/nova-framework/framework/network)


Introduction:
---------

Simple HRM is a simple module for the users, who needs a simple one to maintain their employee details and their pay details. 

you can get the informations about this module  <a href="http://www.kvcodes.com/2014/10/frontaccounting-simple-hrm/" target="_blank"> Here.  </a>.

you can feedback your comments below the article or here in issues page. 

https://youtu.be/IKBMxKyT6qA

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
