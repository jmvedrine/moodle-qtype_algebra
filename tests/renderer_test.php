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
 * Tests for the algebra question renderer.
 *
 * @package    qtype_algebra
 * @copyright  2026 ISB Bayern
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @covers     \qtype_algebra_renderer
 */
final class renderer_test extends \advanced_testcase {
    /**
     * Render the correct response of a simple algebra question.
     *
     * @param string $variable the variable name of the question
     * @param string $answer the correct answer
     * @return string the rendered correct response
     */
    private function render_correct_response(string $variable, string $answer): string {
        global $PAGE;
        $template = \test_question_maker::make_question('algebra', 'simplemath');
        // Skip the numerical answer matching, which cannot evaluate a crafted variable name.
        $question = new class extends \qtype_algebra_question {
            /**
             * Return the only answer.
             *
             * @param array $response
             * @return \question_answer
             */
            public function get_matching_answer(array $response) {
                return reset($this->answers);
            }
        };
        foreach (get_object_vars($template) as $name => $value) {
            $question->$name = $value;
        }
        $question->variables = [7 => new \qtype_algebra_variable(7, $variable, -5, 5)];
        $question->answers[13]->answer = $answer;
        return $PAGE->get_renderer('qtype_algebra')->correct_response(new \question_attempt($question, 0));
    }

    #[\PHPUnit\Framework\Attributes\Group('baseline')]
    /**
     * Markup smuggled into the formula is cleaned before output.
     */
    public function test_correct_response_cleans_markup(): void {
        $this->resetAfterTest();
        // The MathJax filter escapes the equation, without it only HTML cleaning protects the output.
        filter_set_global_state('mathjaxloader', TEXTFILTER_DISABLED);
        $html = $this->render_correct_response('(.*)', 'a<img src=x onerror=alert(1)>');
        $this->assertDoesNotMatchRegularExpression('/<img[^>]*onerror/i', $html);
    }

    #[\PHPUnit\Framework\Attributes\Group('baseline')]
    /**
     * A regular formula is still rendered.
     */
    public function test_correct_response_renders_formula(): void {
        $this->resetAfterTest();
        $html = $this->render_correct_response('x', '7*x');
        $this->assertStringContainsString('$$7', $html);
    }
}
