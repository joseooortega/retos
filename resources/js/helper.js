(function ( $ ) {

  $.fn.hasAttr = function(atribute) {
    var attr = $(this).attr(atribute);
    if (typeof attr !== typeof undefined && attr !== false) {
      return true;
    }else{
      return false;
    }
  };

}( jQuery ));
