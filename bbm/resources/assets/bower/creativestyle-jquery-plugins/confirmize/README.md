$.confirmize
============

*jQuery plugin that displays confirmation box for an action link or when 
submitting a form*

Requires __jQuery__ and __bootbox__. Works best with __bootstrap__.


Usage
-----

Basic usage is:

```javascript
$('.your-class').confirmize({
    title: 'Title',
    message: 'Proceed?'
});
```

The settings object and all params are optional.


Parameters
----------

All parameters can be specified by using (in this order):

* data attribute - ex. `data-title="your title"`
* jquery data() - ex. `$(element).data('title', 'your title')`
* by specifing it in the object passed to plugin initializer


### title

__Default:__ `'<i class="fa fa-exclamation-triangle text-danger"></i> Confirm Action'`

Can be also specified in the title attribute on the element.


### message

__Default:__ `'Are you sure?'`


### href

This parameter must be specified unless you're using a form.
Can be also specified in the href attribute on the element.                