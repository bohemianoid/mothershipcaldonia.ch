body     = document.body
btnOpen  = document.getElementById 'js-open-overlay'
overlay  = document.getElementById 'js-overlay'
btnClose = document.getElementById 'js-close-overlay'

transEndEventNames =
  'WebkitTransition': 'webkitTransitionEnd',
  'MozTransition': 'transitionend',
  'msTransition': 'MSTransitionEnd',
  'OTransition': 'oTransitionEnd',
  'transition': 'transitionend'
transEndEventName  = transEndEventNames[Modernizr.prefixed 'transition']
support            =
  transitions: Modernizr.csstransitions

toggleOverlay = () ->
  if classie.has overlay, 'is-opened'
    classie.remove overlay, 'is-opened'
    classie.remove body, 'is-locked'
    classie.add overlay, 'is-closed'

    onEndTransitionFn = (ev) ->
      if support.transitions
        if ev.propertyName isnt 'visibility'
          return
        this.removeEventListener transEndEventName, onEndTransitionFn
      classie.remove overlay, 'is-closed'
      classie.remove body, 'is-locked'

    if support.transitions
      overlay.addEventListener transEndEventName, onEndTransitionFn
    else
      onEndTransitionFn()

  else if not classie.has overlay, 'is-closed'
    classie.add overlay, 'is-opened'
    classie.add body, 'is-locked'

btnOpen.addEventListener 'click', toggleOverlay
btnClose.addEventListener 'click', toggleOverlay
