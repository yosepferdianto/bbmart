(function($) {
    'use strict';

    $.fn.dropdownSelect = function() {
        return $(this).each(function() {
            var $button = $(this),
                $parent = $button.parent(),
                items = $parent.find('[role=menu] li:not(.divider) a'),
                handleClick = function(e) {
                    var $item = $(this),
                        value = $item.data('value'),
                        label = $item.html();

                    e.preventDefault();

                    if($button.data('value') === value) {
                        return;
                    }

                    $button.find('.dropdown-label').html(label);
                    $button.data('value', value);
                    $button.trigger('change', [value, label]);
                };

            items.on('click', handleClick);
        });
    }
})(jQuery);