(function ($, Drupal) {
  var donationProcessed = false;
  Drupal.behaviors.nkf_base = {
    attach: function(context, settings) {

      // flip password strength indicator
      $('.password-field').after($('.password-strength'));
      $('input.password-confirm').after($('div.password-confirm'));

      // utility function to toggle classes on click
      // useful for toggling visibility
      $('[data-toggle=class]').once().click(function (e) {
        $($(this).attr('data-target'))
          .toggleClass($(this).attr('data-class'));
        e.preventDefault();
      });

      // utility for general modal selection
      $('.modal-trigger').magnificPopup({
        type:'inline',
        midClick: true
      });

      // general print utility
      $('.js--print-link').once().click(function(){
        window.print();
        return false;
      });

      // general animation/transition event listener

      function PrefixedEvent(element, type, callback) {
        var pfx = ["webkit", "moz", "MS", "o", ""];
        console.log(type);
        for (var p = 0; p < pfx.length; p++) {
          if (!pfx[p]) type = type.toLowerCase();
          console.log(pfx[p]+type);
          //console.log(element);
          element.addEventListener(pfx[p]+type, callback, false);
        }
      };
      $.fn.animationEnd = function(callback) {
        console.log('test');
        this.on("animationend webkitAnimationEnd mozAnimationEnd MSAnimationEnd oAnimationEnd", function() {
          callback.call(this);
        });
        return this
      }
      $.fn.animationClass = function(animationClass) {
        this.on("animationend webkitAnimationEnd mozAnimationEnd MSAnimationEnd oAnimationEnd", function(){
          $(this).removeClass(animationClass);
        });
        this.addClass(animationClass);
        return this
      }
    }

  };

})(jQuery, Drupal);
