###!
masonry
###

events  = document.querySelector '.js-masonry-events'

if events
  masonry = new Masonry events,
    itemSelctor:     '.event'
    columnWidth:     '.event'
    gutter:          '.calendar__gutter'
    percentPosition: true
