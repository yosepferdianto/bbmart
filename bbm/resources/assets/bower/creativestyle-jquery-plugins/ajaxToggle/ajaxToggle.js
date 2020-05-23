(function($) {
    "use strict";

    $.fn.ajaxToggle = function(options) {
        var settings = $.extend(true, {
            states: {
                on: {
                    cls: 'toggle-on',
                    content: null,
                    action: null
                },
                off: {
                    cls: 'toggle-off',
                    content: null,
                    action: null
                },
                loading: {
                    cls: 'toggle-loading',
                    content: null
                }
            },
            initialState: 'off',
            optimistic: false
        }, options),
        methods = {
            init: function(element) {
                settings.initialState = element.data('state') || settings.initialState;

                if(!settings.states.on.action) {
                    settings.states.on.action = element.data('on');
                }

                if(!settings.states.off.action) {
                    settings.states.off.action = element.data('off');
                }                

                element.data('ajaxToggleState', settings.initialState);

                methods.switchState(element, settings.initialState);

                element.click(methods.onToggle);
                element.show();
            },
            switchState: function(element, newState) {
                var oldStateSettings = settings.states[element.data('ajaxToggleState')],
                    newStateSettings = settings.states[newState];

                element.data('ajaxToggleState', newState);

                element.removeClass(oldStateSettings.cls);
                element.addClass(newStateSettings.cls);

                if(newStateSettings.content) {
                    element.html(newStateSettings.content);
                }

                element.trigger('ajaxToggle:' + newState);
            },
            onToggle: function() {
                var element = $(this),
                    state = element.data('ajaxToggleState'),
                    newState = state === 'on' ? 'off' : 'on',
                    newStateSettings = settings.states[newState],
                    success = function() {
                        methods.switchState(element, newState);
                    },
                    ajaxOpts = {};

                if(state === 'loading') {
                    return;
                }

                if(settings.optimistic || !newStateSettings.action) {
                    success();
                } else {
                    methods.switchState(element, 'loading');
                    ajaxOpts.success = success;                    
                }

                if(newStateSettings.action) {
                    $.ajax(newStateSettings.action, ajaxOpts);
                }
            }
        };        

        this.each(function() {
            methods.init($(this));
        });

        return this;
    };
})(jQuery);