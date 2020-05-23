$.ajaxModal
===========

*jQuery plugin for displaying partial views in popup using AJAX*

It (kind of) simulates an iframe allowing you to easily navigate using links and
submit forms.

Requires __jQuery__, __bootstrap__ and __bootstrap's modal script__.


Usage
-----

You can use it by calling the extension on the set of matched anchors:

```javascript
$('a.btn-modal').ajaxModal({ /* custom options */ });
```

In which case the initial url is taken from `href` or `data-href` attribute and 
the tile is taken from `title` or `data-title` url.


Alternative usage
-----------------

Alternatively you can create an instance of `AjaxModal` class and use it's 
methods.

```javascript
var modal = new AjaxModal({ /* custom options */ });

modal.show(url, title);
```

### AjaxModal::show(url, title)

The modal is initialized, shown and the `url` is loaded.

Parameter `title` is optional.


### AjaxModal::loadUrl(url, postData)

The modal has to be initialized and shown before you call this method.

It loads another url into the modal. If `postData` is set then the request
is made using __POST__. The `postData` can be a plain object or an array 
following [`$.serialize`](http://api.jquery.com/serializeArray/) convention.


### AjaxModal::close()

Closes the modal.


### AjaxModal::setContent(content)

Sets the content of the modal.


Options
-------

### params

__Default:__ `[]`

The parameters are optional. You can pass a plain object or array containing 
additional parameters to be passed with every AJAX call. The parameters will be 
passed using the same method that is used for the call. So they will be passed 
using __GET__ for normal requests and __POST__ for form submits.

If you use an array it has to follow the
[`$.serialize`](http://api.jquery.com/serializeArray/) convention.


### spinner 

__Default:__ `null`

HTML used for the spinner. It is inserted directly into 


### onViewFetched

__Default:__ `null`

You can provide a callback that will be executed immediately after the data
is fetched. 

The callback will be executed in `AjaxModal` object's context.

It's useful for executing other plugins like datepicker...

### onError

__Default:__ `null`

The callback which will be executed if ajax call returns with an error.

It will be attached to jQuery's [`$.ajax`](http://api.jquery.com/jquery.ajax/) 
error handler and executed in `AjaxModal` object's context.


Partial views
-------------

All urls for ajaxModal have to return partial (just the content without 
`<html>`, `<body>`, etc.) HTML.

Your partial views should contains at least a `.modal-body` element encompassing
your content and optionally `.modal-footer`.

For example:

```html
<form action="http://submit-form-here">
    <div class="modal-body">
        <input type="text" name="email" placeholder="E-mail" class="form-control"/>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger modal-close">Cancel</button>
        <button type="submit" class="btn btn-primary modal-submit">Submit</button>
    </div>
</form>
```

You can also include inline javascript in your views which will be executed as
soon as the view is loaded. It can easily interact with the rest of your site
in contrast to iframe.


Special classes in your partial HTML views
------------------------------------------

You can use special classes in your partial views.

### .modal-submit

When element of this class is clicked than the closest parent form is 
serialized and submitted to the form's `action` url or to the current url which
is displayed by the modal.

It's best if you always specify the `action` attribute on the form because the 
default behavior can cause problems in certain situations.

The *current url* tracked by modal instance isn't updated when redirects occur.


### .modal-follow

When element of this class is clicked then it's `href` url is followed by the 
modal.


### .modal-close

When clicked the modal is closed.


Events
------

You can trigger events on the `window` object which cause certain actions to be 
performed.

### ajaxmodal:close

When triggered the modal is closed, eg. `$(window).trigger('ajaxmodal:close');`.


### ajaxmodal:follow

When triggered modal shows the specified url, eg.
`$(window).trigger('ajaxmodal:follow', ['url-of-the-view-to-be-shown']);`


TODO
----

* Honor the form's `method` attribute.
