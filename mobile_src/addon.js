angular.module('mm.addons.qtype_algebra', ['mm.core'])
.config(["$mmQuestionDelegateProvider", function($mmQuestionDelegateProvider) {
    $mmQuestionDelegateProvider.registerHandler('mmaQtypeAlgebra', 'qtype_algebra', '$mmaQtypeAlgebraHandler');
}]);

angular.module('mm.addons.qtype_algebra')
.directive('mmaQtypeAlgebra', ["$log", "$mmQuestionHelper", function($log, $mmQuestionHelper) {
	$log = $log.getInstance('mmaQtypeAlgebra');
    return {
        restrict: 'A',
        priority: 100,
        templateUrl: 'addons/qtype/algebra/template.html',
        link: function(scope) {
        	$mmQuestionHelper.inputTextDirective(scope, $log);
        }
    };
}]);

angular.module('mm.addons.qtype_algebra')
.factory('$mmaQtypeAlgebraHandler', ["$mmUtil", function($mmUtil) {
    var self = {};
        self.isCompleteResponse = function(question, answers) {
        return answers['answer'] || answers['answer'] === 0;
    };
        self.isEnabled = function() {
        return true;
    };
        self.isGradableResponse = function(question, answers) {
        return self.isCompleteResponse(question, answers);
    };
        self.isSameResponse = function(question, prevAnswers, newAnswers) {
        return $mmUtil.sameAtKeyMissingIsBlank(prevAnswers, newAnswers, 'answer');
    };
        self.getDirectiveName = function(question) {
        return 'mma-qtype-multichoice-set';
    };
    return self;
}]);
