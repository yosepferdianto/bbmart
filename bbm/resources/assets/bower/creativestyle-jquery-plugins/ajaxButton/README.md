$.ajaxButton
============

*jQuery plugin that allows a button to perform an asynchronous action and then 
change state (label, icon)*

Requires only __jQuery__, works best with __bootstrap__.


Usage
-----

Basic usage is:

```javascript
$('.your-btn-class').ajaxButton({
    iconOkClass: 'glyphicon glyphicon-ok',
    actionUrl: 'http://mysite.com/do-sth-useful'
});
```
You should at least specify: `iconOkClass` or `okClass`.

If you specify `okHtml` then `iconOkClass` will be ignored.

If want this to do sth useful then you should set `actionUrl` too. ;)

The action can be performed only once - after that the button is locked. If you 
need to reset it trigger ajaxButton:reset on the element.


Parameters
----------

### iconSelector

__Default__: `'i.glyphicon'`

If you already have an icon on the button and want to change it to sth else 
(`iconOkClass`) on action then this is will be used to find the existing icon.


### iconOkClass

__Default__: `null`

If set then this is the class that will be given to the icon on action. If there
is no icon then an `<i>` element with this class will be appended.
        

### okClass

__Default__: `null`

The button's class attribute is replaced with this on action.


### okHtml

__Default__: `null`

If set then this is the contents of the button element will be replaced with 
this on action. Also `iconOkClass` will be ignored.
                

### actionUrl

__Default__: `null`


Url of the ajax request to be performed. Can be also set using href and 
data-href attributes.
                   

### data

__Default__: `null`


Additional data to be sent along with the request. It is directly passed to 
`$.ajax`'s data option.
                   

### method

__Default__: `'GET'`

Request method. It is directly passed to `$.ajax`'s method option.
           

### callback

__Default__: `null`


If set then this is called on action with the clicked with button's element as 
this and response as the only argument. Response won't be available if 
optimistic is set to true.
        

### optimistic

__Default__: `false`

If set to true then the button will be changed as if the action succeeded 
immediately and the request will run in background.

By default the button changes state only after the request returns successfully.
         