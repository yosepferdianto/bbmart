$.ajaxToggle
============

*jQuery plugin for creating a toggle button that does ajax calls*

Requires __jQuery__.

Usage
-----

Basic usage is:

```javascript
$('.btn-toggle').ajaxToggle({
    states: {
        on: {
            cls: 'on-class',
            content: 'ON',
            action: 'http://action-for-on.com'
        },
        off: {
            cls: 'off-class',
            content: 'OFF',
            action: null
        },
        loading: {
            cls: 'loading-class',
            content: 'Loading...'
        }
    }
});
```

Parameters
----------

### States

__Default__:
```javascript
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
}
```

For each state:
* `cls` is the class that will be added/removed from the element
* `content` is the HTML that will be set on the element
* `action` url of the action to be performed; N/A to `loading`

Actions can also be set using `data-on` and `data-off` attributes.


### initialState

__Default__: `'off'`

Specified the initial state on page load. The elements class/content will
be adjusted upon initialization.

Can be also set using `data-state` attribute.


### optimistic

__Default__: `false`

If set to true then the element will visually change immediately as if the 
action succeeded and the request will run in background.

The `loading` state won't be used if this is set to `true`.



