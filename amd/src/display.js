define(['jquery', 'core/config', 'core/notification'], function($, config, notification) {
    return {
        init: function() {
            $(".algebra_answer").on('input paste keyup', null, null, function() {
                // Convert answer id to valid javascript name.
                var id = $(this).attr('id');
                var display = id.replace(':', '_');
                var varnames = $('#' + display + '_vars').html();
                var currentanswer = $(this).val();
                var params = {
                    vars: varnames,
                    expr: currentanswer,
                    sesskey: config.sesskey,
                };
                $.post(config.wwwroot + '/question/type/algebra/ajax.php', params, null, 'json')
                    .done(function(data) {
                        // Replace TeX form in page.
                        $('#' + display + '_display').html("<span class=\"filter_mathjaxloader_equation\">" + data +"</span>");
                        // MathJax update.
                        MathJax.Hub.Queue(["Typeset", MathJax.Hub]);
                    })
                    .fail(function(jqXHR, status, error) {
                        notification.exception(error);
                    });
            });
        }
    };
});