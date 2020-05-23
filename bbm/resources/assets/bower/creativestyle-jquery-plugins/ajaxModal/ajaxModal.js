var AjaxModal;

(function($) {
    "use strict";

    var modalTemplate = function(id) {
        return '<div id="' + id + '" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="' + id + '-label" aria-hidden="true">' +
                '<div class="modal-dialog">' +
                    '<div class="modal-content">' +
                        '<div class="modal-header">' +
                            '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>' +
                            '<h4 class="modal-title" id="' + id + '-label">Popup</h4>' +
                        '</div>' +
                        '<div class="modal-container"></div>' +
                    '</div>' +
                '</div>' +
            '</div>'
        ;
    };

    AjaxModal = function(options) {
        this.settings = $.extend({
            params: [],
            spinner: null,
            onViewFetched: null,
            onError: null,
            template: modalTemplate
        }, options);

        this.modal = null;

        if($.isPlainObject(this.settings.params)) {
            this.settings.params = this.objectToParamArray(this.settings.params);
        }
    };

    AjaxModal.prototype = {
        objectToParamArray: function(object) {
            var array = [];

            for(var prop in object) {
                if(!object.hasOwnProperty(prop)) {
                    continue;
                }

                array.push({
                    name: prop,
                    value: object[prop]
                });
            }

            return array;
        },
        init: function() {
            if(this.modal !== null) { 
                return;
            }

            this.id = 'ajaxmodal-' + (new Date()).getTime();
            this.modal = $(this.settings.template(this.id)).appendTo($('body')).hide();
            this.container = this.modal.find('.modal-container');
            this.title = this.modal.find('.modal-header > h4');
            this.modal.on('click', '.modal-submit', $.proxy(this.onSubmitClick, this));
            this.modal.on('click', '.modal-follow', $.proxy(this.onFollowClick, this));
            this.modal.on('click', '.modal-close', $.proxy(this.onCloseClick, this));    
            this.url = null;
        },
        onSubmitClick: function(e) {
            e.preventDefault();

            var el = $(e.target),
                form = el.closest('form'),
                data = form.serializeArray(),
                url = form.attr('action');

            if(!url) {
                url = this.url;
            }

            this.loadUrl(url, data);
        },
        onFollowClick: function(e) {
            e.preventDefault();

            var el = $(e.target),
                url = el.attr('href') || el.data('href');

            this.loadUrl(url);
        },
        close: function() {
            $(window).off('ajaxmodal:close');
            $(window).off('ajaxmodal:follow');

            this.modal.modal('hide');
        },
        onCloseClick: function(e) {
            e.preventDefault();
            this.close();
        },
        setContent: function(content) {
            this.container.html(content);
        },
        showSpinner: function() {
            if(this.settings.spinner) {
                this.setContent(this.settings.spinner);
            }
        },
        loadUrl: function(url, postData) {
            this.showSpinner();
            this.url = url;

            var data = this.settings.params.slice(0), // clone the array
                errorHandler = null;

            if($.isFunction(this.settings.onError)) {
                errorHandler = $.proxy(this.settings.onError, this);
            }

            if($.isPlainObject(postData)) {
                postData = this.objectToParamArray(postData);
            }

            if(postData) {
                $.merge(data, postData);
            }

            $.ajax(url, {
                type: postData ? 'POST' : 'GET',
                success: $.proxy(this.onDataFetched, this),
                data: data,
                dataType: 'html',
                error: errorHandler
            });
        },
        onDataFetched: function(data) {
            this.setContent(data);

            if($.isFunction(this.settings.onViewFetched)) {
                this.settings.onViewFetched(this.container);
            }
        },
        onFollow: function(e, url) {
            this.loadUrl(url);
        },
        show: function(url, title) {
            this.init();
            this.modal.modal('show');
            this.loadUrl(url);

            if(title) {
                this.title.html(title);
            } else {
                this.modal.find('.modal-header').remove();
            }

            $(window).on('ajaxmodal:close', $.proxy(this.close, this));
            $(window).on('ajaxmodal:follow', $.proxy(this.onFollow, this));
        }
    };

    $.fn.ajaxModal = function(options) {
        var ajaxModal = new AjaxModal(options);

        this.each(function() {
            $(this).data('ajaxmodal', ajaxModal);
            $(this).on('click', function(e) {
                e.preventDefault();

                var $this = $(this),
                    url = $this.attr('href') || $this.data('href'),
                    title = $this.attr('title') || $this.data('title'),
                    modal = $this.data('ajaxmodal');
                    modal.show(url, title);
            });
        });

        return this;
    };    

    $(document).ready(function() {
        $('.ajax-modal').ajaxModal();
    });    
})(jQuery);

