/**
 * Stop empty searches
 *
 * @author Thomas Scholz http://toscho.de
 * @param  $ jQuery object
 * @return bool|object
 */
(function( $ ) {
   $.fn.preventEmptySubmit = function( options ) {
       var settings = {
           inputselector: "#s",
           msg          : "Don’t waste your time with an empty search!"
       };

       if ( options ) {
           $.extend( settings, options );
       };

       this.submit( function() {
           var s = $( this ).find( settings.inputselector );
           if ( ! s.val() ) {
               alert( settings.msg );
               s.focus();
               return false;
           }
           return true;
       });
       return this;
   };
})( jQuery );