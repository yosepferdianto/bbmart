(function($) {
    "use strict";

    $.fn.charCountdown = function(options) {
        var settings = $.extend({
                max: null,
                toolongClassName: 'too-long',
                className: 'char-counter',
                addTagClass: true,
                counterPattern: null, // `#` is replaced with number,
                showNegative: false
            }, options);

        $(this).each(function() {
            var el = $(this),
                counter = $('<div/>', {'class': settings.className}).insertBefore(el),
                max = settings.max || el.attr('maxlength') || el.data('maxlength');

            if(el.attr('id')) {
                counter.attr('data-for', el.attr('id'));
            }

            if(settings.addTagClass) {
                counter.addClass(settings.className + '-' + el.prop('tagName').toLowerCase());
            }

            if(!max) {
                $.error('charCountdown: Could not determine max length!');
            }

            el.data('charCountdown', {
                counter: counter,
                max: max
            });

            el.on('propertychange input textInput blur', function() {
                var el = $(this),
                    data = el.data('charCountdown'),
                    charsRemaining = data.max - el.val().length,
                    text = charsRemaining;

                if(charsRemaining < 0) {
                    if(!settings.showNegative) {
                        charsRemaining = 0;
                    }
                    
                    data.counter.addClass(settings.toolongClassName);
                } else {
                    data.counter.removeClass(settings.toolongClassName);
                }

                if(settings.counterPattern) {
                    text = settings.counterPattern.replace('#', charsRemaining);
                }

                data.counter.html(text);
            });            

            el.trigger('input');
        });

        return this;
    };
})(jQuery);