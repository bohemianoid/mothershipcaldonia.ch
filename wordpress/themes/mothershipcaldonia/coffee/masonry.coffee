###!
masonry
###

events  = document.querySelectorAll '.js-masonry-events'

if events
  for masonry in events
    do (masonry) ->
      new Masonry masonry,
        itemSelctor:        '.event'
        columnWidth:        '.event'
        gutter:             '.calendar__gutter'
        percentPosition:    true
        transitionDuration: 0
