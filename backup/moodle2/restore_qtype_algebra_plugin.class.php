<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * @package    qtype_algebra
 * @copyright  Roger Moore <rwmoore@ualberta.ca>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Restore plugin class that provides the necessary information
 * needed to restore one algebra qtype plugin
 */
class restore_qtype_algebra_plugin extends restore_qtype_plugin {

    /**
     * Returns the paths to be handled by the plugin at question level
     */
    protected function define_question_plugin_structure() {

        $paths = array();

        // This qtype uses question_answers, add them.
        $this->add_question_question_answers($paths);

        // Add own qtype stuff.
        $elename = 'algebravariable';
        $elepath = $this->get_pathfor('/algebra_variables/algebra_variable'); // We used get_recommended_name() so this works.
        $paths[] = new restore_path_element($elename, $elepath);
        $elename = 'algebra';
        $elepath = $this->get_pathfor('/algebra'); // We used get_recommended_name() so this works.
        $paths[] = new restore_path_element($elename, $elepath);

        return $paths; // And we return the interesting paths.
    }

    /**
     * Convert the backup structure of this question type into a structure matching its question data
     *
     * This should take the hierarchical array of tags from the question's backup structure, and return a structure that matches
     * that returned when calling {@see get_question_options()} for this question type.
     * See https://docs.moodle.org/dev/Question_data_structures#Representation_1:_%24questiondata for an explanation of this
     * structure.
     *
     * This data will then be used to produce an identity hash for comparison with questions in the database.
     *
     * This base implementation deals with all common backup elements created by the add_question_*_options() methods in this class,
     * plus elements added by ::define_question_plugin_structure() named for the qtype. The question type will need to extend
     * this function if ::define_question_plugin_structure() adds any other elements to the backup.
     *
     * @param array $backupdata The hierarchical array of tags from the backup.
     * @return \stdClass The questiondata object.
     */
    public static function convert_backup_to_questiondata(array $backupdata): \stdClass {
        global $DB;

        $questiondata = parent::convert_backup_to_questiondata($backupdata);

        // Change structure to match get_question_options().
        $questiondata->options->variables = $DB->get_records('qtype_algebra_variables', array('questionid' => $questiondata->id));

        // Check to see if there are any allowed functions.
        if ($questiondata->options->allowedfuncs != '') {
            // Extract the allowed functions as an array.
            $questiondata->options->allowedfuncs = explode(',', $questiondata->options->allowedfuncs);
        } else {
            // Otherwise just create an empty array.
            $questiondata->options->allowedfuncs = array();
        }

        return $questiondata;
    }

    /**
     * Return a list of paths to fields to be removed from questiondata before creating an identity hash.
     *
     * Fields that should be excluded from common elements such as answers or numerical units that are used by the plugin will
     * be excluded automatically. This method just needs to define any specific to this plugin, such as foreign keys used in the
     * plugin's tables.
     *
     * The returned array should be a list of slash-delimited paths to locate the fields to be removed from the questiondata object.
     * For example, if you want to remove the field `$questiondata->options->questionid`, the path would be '/options/questionid'.
     * If a field in the path is an array, the rest of the path will be applied to each object in the array. So if you have
     * `$questiondata->options->answers[]`, the path '/options/answers/id' will remove the 'id' field from each element of the
     * 'answers' array.
     *
     * @return array
     */
    protected function define_excluded_identity_hash_fields(): array {
        return [
                '/options/variables/id',
                '/options/variables/questionid',
            ];
    }

    /**
     * Process the qtype/algebra element
     */
    public function process_algebra($data) {
        global $DB;

        $data = (object)$data;
        $oldid = $data->id;
        // Detect if the question is created or mapped.
        $oldquestionid   = $this->get_old_parentid('question');
        $newquestionid   = $this->get_new_parentid('question');
        $questioncreated = $this->get_mappingid('question_created', $oldquestionid) ? true : false;

        // If the question has been created by restore, we need to create its qtype_algebra_options too.
        if ($questioncreated) {
            // Adjust some columns.
            $data->questionid = $newquestionid;
            // Insert record.
            $newitemid = $DB->insert_record('qtype_algebra_options', $data);
            // Create mapping (needed for decoding links).
            $this->set_mapping('qtype_algebra_options', $oldid, $newitemid);
        }
        // Nothing to remap if the question already existed.
    }

    /**
     * Process the qtype/algebravariable element
     */
    public function process_algebravariable($data) {
        global $DB;

        $data = (object)$data;
        $oldid = $data->id;

        // Detect if the question is created or mapped.
        $oldquestionid   = $this->get_old_parentid('question');
        $newquestionid   = $this->get_new_parentid('question');
        $questioncreated = $this->get_mappingid('question_created', $oldquestionid) ? true : false;

        // If the question has been created by restore, we need to create its qtype_algebra_variables too.
        if ($questioncreated) {
            // Adjust some columns.
            $data->questionid = $newquestionid;
            // Insert record.
            $newitemid = $DB->insert_record('qtype_algebra_variables', $data);
            // Create mapping.
            $this->set_mapping('qtype_algebra_variable', $oldid, $newitemid);
        }
        // Nothing to remap if the question already existed.
    }
}
