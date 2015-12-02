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

      $.fn.animationEnd = function(callback) {
        this.on("animationend webkitAnimationEnd mozAnimationEnd MSAnimationEnd oAnimationEnd", function() {
          callback.call(this);
        });
        return this;
      };
      $.fn.animationClass = function(animationClass, callback) {
        this.on("animationend webkitAnimationEnd mozAnimationEnd MSAnimationEnd oAnimationEnd", function(){
          $(this).removeClass(animationClass);
          if (callback) {
            callback.call(this);
          }
        });
        this.addClass(animationClass);
        return this;
      };
    }

  };

})(jQuery, Drupal);
