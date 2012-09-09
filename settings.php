<?php
defined('MOODLE_INTERNAL') || die;

if ($ADMIN->fulltree) {
    //host
    $settings->add(new admin_setting_configtext('qtype_algebra_host', get_string('host', 'qtype_algebra'), '', 'localhost', PARAM_TEXT));
    //port
    $settings->add(new admin_setting_configtext('qtype_algebra_port', get_string('port', 'qtype_algebra'), '', 7777, PARAM_INT));
	 //host
    $settings->add(new admin_setting_configtext('qtype_algebra_uri', get_string('uri', 'qtype_algebra'), '', '', PARAM_TEXT));
}	
