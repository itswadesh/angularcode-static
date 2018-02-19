$(document).ready( function() {
  // We dynamically add some nav buttons
  var prevNext = '<div id="album-nav"><button class="prev">&laquo; Previous</button>' +
                 ' <button class="next">Next &raquo;</button></div>';
  $(prevNext).insertAfter('.album:last');
  // Add cycling between albums
  $('.album').wrapAll('<div id="photo-albums"></div>');
  $('#photo-albums').cycle({ 
    fx:     'turnDown', 
    speed:  500, 
    timeout: 0, 
    next:   '.next', 
    prev:   '.prev' 
  });
  $('.prev,.next').click(function () {
    $('#intro:visible').slideToggle();
  });
  // Add lightbox to images
  $('.album a').lightBox();
}); 
