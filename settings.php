<?php
defined('MOODLE_INTERNAL') || die;

if ($ADMIN->fulltree) {
    // Default evaluation method.
    $settings->add(new admin_setting_configselect('qtype_algebra_method', new lang_string('defaultmethod', 'qtype_algebra'), new lang_string('compareby', 'qtype_algebra'), 'eval',
                                                  array('sage'        => new lang_string('comparesage', 'qtype_algebra'),
                                                        'eval' => new lang_string('compareeval', 'qtype_algebra'),
                                                        'equiv'    => new lang_string('compareequiv', 'qtype_algebra'))));
    // SAGE server connection host.
    $settings->add(new admin_setting_configtext('qtype_algebra_host', get_string('host', 'qtype_algebra'), '', 'localhost', PARAM_TEXT));
    // SAGE server connection port.
    $settings->add(new admin_setting_configtext('qtype_algebra_port', get_string('port', 'qtype_algebra'), '', 7777, PARAM_INT));
     // SAGE server connection uri.
    $settings->add(new admin_setting_configtext('qtype_algebra_uri', get_string('uri', 'qtype_algebra'), '', '', PARAM_TEXT));
}
