$.dropdownSelect
================

*turns a bootstrap's dropdown into a select for javascript use*

It is not meant for forms but rather asynchronous js features.

Requires __jQuery__ and __bootstrap__.

Usage
-----

Create a bootstrap [dropdown](http://getbootstrap.com/javascript/#dropdowns)
and extend it:

```javascript
$('.dropdown-select[data-toggle=dropdown]').dropdownSelect();
```

Each `li` element can have `data-value` attribute which indicates the selected
value.

Upon change a __jQuery__ `change` event is triggered with additional parameters
of `value` and `label`:

```javascript
$('#your-dropdown').on(change, function(event, value, label) {
    console.log('Item with label ' + label + ' and value ' + value + ' was selected!');
});
```
