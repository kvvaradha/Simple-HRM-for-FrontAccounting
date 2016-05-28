<?php

/* List of installed additional extensions. If extensions are added to the list manually
	make sure they have unique and so far never used extension_ids as a keys,
	and $next_extension_id is also updated. More about format of this file yo will find in 
	FA extension system documentation.
*/

$next_extension_id = 5; // unique id for next installed extension

$installed_extensions = array (
  1 => 
  array (
    'name' => 'zen_import',
    'package' => 'zen_import',
    'version' => '2.4.0-1',
    'type' => 'extension',
    'active' => false,
    'path' => 'modules/zen_import',
  ),
  3 => 
  array (
    'package' => 'HumanResourceManagement',
    'name' => 'HumanResourceManagement',
    'version' => '2.4.0-1',
    'available' => '',
    'type' => 'extension',
    'path' => 'modules/HumanResourceManagement',
    'active' => false,
  ),
);
