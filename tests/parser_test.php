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
 * Unit tests for the short answer question definition class.
 *
 * @package    qtype_algebra
 * @copyright  2017 Jean-Michel Vedrine
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


defined('MOODLE_INTERNAL') || die();

global $CFG;
require_once($CFG->dirroot . '/question/type/algebra/parser.php');


/**
 * Unit tests for the algebra question parser.
 *
 * @copyright  2017 Jean-Michel Vedrine
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

class qtype_algebra_parser_test extends advanced_testcase {

    public function test_parser_vars_functions() {
        $p = new qtype_algebra_parser;

        $expr = $p->parse('sin(2x) + cos(3y)');
        $this->assertEquals(array('x', 'y'), $expr->get_variables())
        $this->assertEquals(array('cos', 'sin'),  $expr->get_functions())
        $this->assertEquals('\sin(2 x_{}) + \cos(3 y_{}', $exp->tex());
    }
}
