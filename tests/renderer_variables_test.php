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
require_once($CFG->dirroot . '/question/engine/tests/helpers.php');
require_once($CFG->dirroot . '/question/type/algebra/tests/helper.php');

/**
 * Tests for the variable names emitted by the algebra question renderer.
 *
 * @package    qtype_algebra
 * @copyright  2026 ISB Bayern
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @covers     \qtype_algebra_renderer
 */
final class renderer_variables_test extends \advanced_testcase {
    /**
     * Render the question controls of a simple algebra question in both display modes.
     *
     * @param string $variable the variable name of the question
     * @return string the rendered iframe and dynamic output
     */
    private function render_controls(string $variable): string {
        global $PAGE;
        $question = \test_question_maker::make_question('algebra', 'simplemath');
        $question->variables = [7 => new \qtype_algebra_variable(7, $variable, -5, 5)];
        $qa = new \question_attempt($question, 0);
        $qa->start('deferredfeedback', 1);
        $options = new \question_display_options();
        $options->correctness = \question_display_options::HIDDEN;
        $renderer = $PAGE->get_renderer('qtype_algebra');
        set_config('formuladisplay', 'iframe', 'qtype_algebra');
        $html = $renderer->formulation_and_controls($qa, $options);
        set_config('formuladisplay', 'dynamic', 'qtype_algebra');
        return $html . $renderer->formulation_and_controls($qa, $options);
    }

    #[\PHPUnit\Framework\Attributes\Group('baseline')]
    /**
     * Crafted variable names neither break out of the script string nor inject markup.
     */
    public function test_variable_names_are_escaped(): void {
        $this->resetAfterTest();
        $html = $this->render_controls('";alert(1);//<img src=x onerror=alert(2)>');
        $this->assertStringNotContainsString('vars=";alert(1)', $html);
        $this->assertDoesNotMatchRegularExpression('/<img[^>]*onerror/i', $html);
    }

    #[\PHPUnit\Framework\Attributes\Group('baseline')]
    /**
     * Regular variable names are still passed to both display modes.
     */
    public function test_regular_variable_names_are_kept(): void {
        $this->resetAfterTest();
        $html = $this->render_controls('x');
        $this->assertMatchesRegularExpression('/var text="vars=("\+")?x("\+")?&expr="/', $html);
        $this->assertMatchesRegularExpression('/<div[^>]*_vars"[^>]*>x<\/div>/', $html);
    }
}
