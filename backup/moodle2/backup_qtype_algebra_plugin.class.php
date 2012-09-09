<?php

/**
 * Moodle algebra question type class.
 *
 * @copyright &copy; 2010 Hon Wai, Lau
 * @author Hon Wai, Lau <lau65536@gmail.com>
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License version 3
 * @package questionbank
 * @subpackage questiontypes
 * @copyright  2010 onwards Eloy Lafuente (stronk7) {@link http://stronk7.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
defined('MOODLE_INTERNAL') || die();

/**
 * Provides the information to backup algebra questions
 */
class backup_qtype_algebra_plugin extends backup_qtype_plugin {

    /**
     * Returns the qtype information to attach to question element
     */
    protected function define_question_plugin_structure() {

        // Define the virtual plugin element with the condition to fulfill
        $plugin = $this->get_plugin_element(null, '../../qtype', 'algebra');

        // Create one standard named plugin element (the visible container)
        $pluginwrapper = new backup_nested_element($this->get_recommended_name());

        // connect the visible container ASAP
        $plugin->add_child($pluginwrapper);
		
		// This qtype uses standard question_answers, add them here
        // to the tree before any other information that will use them
        $this->add_question_question_answers($pluginwrapper);

        // Now create the qtype own structures
		
		$algebravariables = new backup_nested_element('algebra_variables');
		
		$algebravariable = new backup_nested_element('algebra_variable', array('id'), array(
            'name', 'min', 'max'));
			
		$algebra = new backup_nested_element('algebra', array('id'), array(
            'compareby', 'nchecks', 'tolerance',
            'disallow', 'allowedfuncs', 'answerprefix'));

        // Now the own qtype tree
		$pluginwrapper->add_child($algebravariables);
        $algebravariables->add_child($algebravariable);
		$pluginwrapper->add_child($algebra);

        // set source to populate the data
        $algebra->set_source_table('question_algebra', array('questionid' => backup::VAR_PARENTID));
		$algebravariable->set_source_table('question_algebra_variables', array('question' => backup::VAR_PARENTID));

        // don't need to annotate ids nor files

        return $plugin;
    }
}
