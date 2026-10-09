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

namespace qtype_algebra;

defined('MOODLE_INTERNAL') || die();

global $CFG;
require_once($CFG->dirroot . '/question/type/algebra/parser.php');

/**
 * Tests for the variable names passed to the algebra parser.
 *
 * @package    qtype_algebra
 * @copyright  2026 ISB Bayern
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @covers     \qtype_algebra_parser::parse
 */
final class parser_variables_test extends \advanced_testcase {
    #[\PHPUnit\Framework\Attributes\Group('baseline')]
    /**
     * A variable name containing pattern syntax is matched literally.
     */
    public function test_variable_name_is_not_a_pattern(): void {
        $p = new \qtype_algebra_parser();
        $this->expectException(\parser_exception::class);
        $p->parse('aaaa', ['(a+)+b|a']);
    }

    #[\PHPUnit\Framework\Attributes\Group('baseline')]
    /**
     * Regular and subscripted variable names are still recognised.
     */
    public function test_regular_variable_names_are_recognised(): void {
        $p = new \qtype_algebra_parser();
        $expr = $p->parse('2a_1 + y', ['a_1', 'y']);
        $this->assertEquals(['a1', 'y'], $expr->get_variables());
    }
}
