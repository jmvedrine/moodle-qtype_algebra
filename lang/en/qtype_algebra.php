<?php
include('qtype_algebra_parser.php');

$string['answermustbegiven'] = 'You must enter an answer if there is a grade or feedback.';
$string['answerno'] = 'Answer {$a}';
$string['addmoreanswerblanks'] = 'Blanks for {no} More Answers';
$string['addmorevariableblanks'] = 'Blanks for {no} More Variables';
$string['allfunctions'] = 'All Functions';
$string['allowedfuncs'] = 'Allowed Functions';
$string['allowedfuncs_help'] = '**NOT YET IMPLEMENTED**

These controls can be used to restrict the functions which the students
can use in their responses. If the "All" button is checked then
there are no restrictions on functions which the students may use in
their answers. This is the default case. To restrict the allowed functions
uncheck the "All" box and select the functions you wish to allow.';
$string['allowedfunctions'] = 'Allowed Functions';
$string['answer'] = 'Answer: {$a}';
$string['answerboxprefix'] = 'String with which to prefix the answer box when displaying the question';
$string['answerprefix_help'] = 'The text entered here will be placed in front of the input box where
students enter their answers. For example if a question is asking the form
of a function, f(x), then the string "f(x) = " could be entered in this
field.';
$string['answerno'] = 'Answer {$a}';
$string['answerprefix'] = 'Answer box prefix';
$string['checktolerance'] = 'Check Tolerance';
$string['compalgorithm'] = 'Comparison Algorithm';
$string['compareby_help'] = 'This selects the method by which the students\' responses are compared
to all the questions answers. The different possibilities are:

SAGE: uses the Open Source <a href="http://www.sagemath.org/">SAGE</a>
mathematics software to perform a full symbolic algebraic comparison. 

Evaluation: This method generates random numbers for
the question variables and then evaluates both the student response and the
question\'s answer for that set of values.

Equivalence: 
This is the simplest of all the methods. It will only perform the most basic of
comparisons between expressions.';
$string['compareby'] = 'Comparison Algorithm';
$string['comparesage'] = 'SAGE';
$string['compareeval'] = 'Evaluation';
$string['compareequiv'] = 'Equivalence';
$string['correctanswers'] = 'Correct answers';
$string['correctansweris'] = 'The correct answer is: {$a} giving ';
$string['disallow'] = 'Disallowed Answer';
$string['disallow_help'] = 'contains an expression which will be disallowed as an answer.
Students entering an answers which matches this will be prevented from
receiving any grade for the question even if the response would match
a given answer for the question.';
$string['disallowans'] = 'Disallowed Answer';
$string['disallowanswer'] = 'Disallowed Answer';
$string['editingalgebra'] = 'Editing an Algebra question';
$string['evalchecks'] = 'Evaluation Checks';
$string['filloutoneanswer'] = 'You must provide at least one possible answer. Answers left blank will not be used. \'*\' can be used as a wildcard to match any characters. The first matching answer will be used to determine the score and feedback. Only variables defined above are allowed';
$string['filloutonevariable'] = 'You must provide at least one variable. All variables used by answers must be entered here. Minimum and a maximum values are only needed if the Evaluation comparison algorithm is used.';
$string['illegalvarname'] = 'Illegal variable name \'{$a}\': same name as a parser function or special constant';
$string['nchecks'] = 'Number of Evaluation Checks';
$string['nchecks_help'] = 'Number of Evaluation Checks used in Evaluation Comparison Algorithm';
$string['notanumber'] = 'Invalid value: a number is required';
$string['notenoughvars'] = 'At least one variable is required for all algebra questions';
$string['novarmax'] = 'No maximum bound specified for variable';
$string['novarmin'] = 'No minimum bound specified for variable';
$string['parseerror'] = 'Error parsing function: \'{$a}\'';
$string['restoreqdbfailed'] = 'Restoring algebra question failed: database write error';
$string['restorevardbfailed'] = 'Restoring algebra question variable failed: database write error';
$string['tolerance'] = 'Tolerance for Evaluation Checks';
$string['tolerance_help'] = 'Determines the maximum difference between numerical
evaluations of the student response and question answers which will be
allowed to count as matching.';
$string['toleranceltzero'] = 'Tolerance must be greater than or equal to zero';
$string['undefinedvar'] = 'Undefined variable(s) {$a} used in one or more answers';
$string['unusedvar'] = 'This variable is not used by any answer';
$string['variable'] = 'Variable Name';
$string['variablename'] = 'Variable Name';
$string['variableno'] = 'Variable {$a}';
$string['variables'] = 'Variables';
$string['varmin'] = 'Minimum Value';
$string['varmingtmax'] = 'The minimum value must be less than the maximum value';
$string['varmax'] = 'Maximum Value';

$string['pluginnameadding'] = 'Adding an algebra question';
$string['pluginnameediting'] = 'Editing an algebra question';
$string['pluginname_link'] = 'question/type/algebra';
$string['pluginname_help'] = 'Student enter a formula as response that include one or more variables. Correctness is evaluted using one of 3 differents methods';
$string['pluginname'] = 'algebra';
$string['pluginnamesummary'] = 'Student enter a formula that can include one or more variables. Correctness is evaluted using one of 3 differents methods.';
$string['host'] = 'Host url of SAGE server';
$string['port'] = 'Port of SAGE server';
$string['uri'] = 'uri of SAGE server';
