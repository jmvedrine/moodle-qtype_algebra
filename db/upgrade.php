<?php  // $Id: upgrade.php,v 1.1 2008/07/24 01:48:12 arborrow Exp $

// This file keeps track of upgrades to 
// the algebra qtype plugin
//
// Sometimes, changes between versions involve
// alterations to database structures and other
// major things that may break installations.
//
// The upgrade function in this file will attempt
// to perform all the necessary actions to upgrade
// your older installtion to the current version.
//
// If there's something it cannot do itself, it
// will tell you what you need to do.
//
// The commands in here will all be database-neutral,
// using the functions defined in lib/ddllib.php

function xmldb_qtype_algebra_upgrade($oldversion=0) {

    global $CFG, $THEME, $DB;
	
	$dbman = $DB->get_manager();

/// And upgrade begins here. For each one, you'll need one 
/// block of code similar to the next one. Please, delete 
/// this comment lines once this file start handling proper
/// upgrade code.

    // Add the field to store the string which is placed in front of the answer
    // box when the question is displayed
    if ($oldversion < 2008061500) {
        $table = new xmldb_table('question_algebra');
        $field = new xmldb_field('answerprefix', XMLDB_TYPE_TEXT, 'small', null, XMLDB_NOTNULL, null, '', 'allowedfuncs');
		if (!$dbman->field_exists($table, $field)) {
			$dbman->add_field($table, $field);
		}
		upgrade_plugin_savepoint(true, 2008061500, 'qtype', 'algebra');
    }

    // Drop the answers and variables fields wich are totaly redundants	
	if ($oldversion < 2011072800) {
	    $table = new xmldb_table('question_algebra');
        $field = new xmldb_field('answers');

        if ($dbman->field_exists($table, $field)) {
            $dbman->drop_field($table, $field);
        }
		$field = new xmldb_field('variables');

        if ($dbman->field_exists($table, $field)) {
            $dbman->drop_field($table, $field);
        }
		upgrade_plugin_savepoint(true, 2011072800, 'qtype', 'algebra');
	}
    return true;
}

