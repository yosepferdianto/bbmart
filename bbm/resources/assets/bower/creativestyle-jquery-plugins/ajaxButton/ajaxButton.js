(function($) {
    "use strict";

    $.fn.ajaxButton = function(options) {
        var settings = $.extend({
            iconSelector: 'i.glyphicon',
            iconOkClass: null, //'glyphicon glyphicon-ok',
            okClass: null,
            okHtml: null,
            actionUrl: null,
            data: null,
            method: 'GET',
            callback: null,
            optimistic: false
        }, options);

        this.each(function() {
            var $this = $(this);

            $(this).data('ajaxButtonDefaultHtml', $this.html())
                   .data('ajaxButtonDefaultClass', $this.attr('class'))
                   .data('ajaxButtonActive', true)
                   .click(function(e) {

                e.preventDefault();

                var $this = $(this),
                    actionUrl = settings.actionUrl || $this.attr('href') || $this.data('href'),
                    data = settings.data || $this.data('ajax-data');

                if(!$this.data('ajaxButtonActive')) {
                    return;
                }

                if($.isFunction(data)) {
                    data = data();
                }

                $this.on('ajaxButton:reset', function() {
                    $this.html($this.data('ajaxButtonDefaultHtml'));
                    $this.attr('class', $this.data('ajaxButtonDefaultClass'));
                    $this.data('ajaxButtonActive', true);
                });

                var success = function(response) {
                        if(settings.okHtml) {
                            $this.html(settings.okHtml);
                        } else if(settings.iconOkClass) {
                            var icon = $this.find(settings.iconSelector);    

                            if(icon.length) {
                                icon.attr('class', settings.iconOkClass);
                            } else {
                                $this.html(
                                    $this.data('ajaxButtonDefaultHtml') +
                                    ' <i class="' + settings.iconOkClass + '"></i>'
                                );
                            }
                        }

                        if(settings.okClass) {
                            $this.attr('class', settings.okClass);
                        }                        

                        if(settings.callback) {
                            settings.callback.call($this, response);
                        }
                    },
                    ajaxOpts = {
                        method: settings.method,
                        data: data
                    };

                if(settings.optimistic) {
                    success();
                } else {
                    ajaxOpts.success = success;
                }

                $this.data('ajaxButtonActive', false);

                $.ajax(actionUrl, ajaxOpts);
            });
        });

        return this;
    };
})(jQuery);