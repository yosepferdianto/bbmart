$.charCountdown
===============

*jQuery plugin for displaying remaining characters in a form field*

The only requirement is __jQuery__.

Usage
-----

A div holding the counter with class `className` is inserted just before the 
target element.

If the target element has id then the attribute `data-for="element-id"` is added
to the counter.

Basic usage is:
```javascript
$('your-input-selector').charCounter({
    counterPattern: "# remaining" /* Not mandatory */
});
```

Parameters
----------

### max

__Default__: `null`

Max. number of chars allowed.

Can be also specified using either `maxlength` or `data-maxlength` attr.

*Remember that it's usually nice to allow user to go over the limit, so he can 
shorten his text later but validate server-side (kind of soft limit).*


### className

__Default__: `'char-counter'`

Name of the class added to the counter holding div.


### toolongClassName

__Default__: `'too-long'`

Name of the class added to counter when user goes over the limit.


### addTagClass

__Default__: `true`

If true then a special class is added to the counter allowing you to identify 
tag name of the element the counter is added too.

The class name is constructed like this: `className + '-' + lowerCasedTagName`.

Ex. if you add the counter to textarea then the counter will receive 
`char-counter-textarea` class.


### counterPattern

__Default__: `null`

By default counter displays only numbers. If you set this option then the `#` 
symbol is replaced by the number of chars.


### showNegative

__Default__: `false`

If true then a negative number is shown when user goes over the limit, otherwise
0 is shown.
 