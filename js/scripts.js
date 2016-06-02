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
      // general print utility
      $('.discount__apply').once().click(function(){
        //$(this).prop('value', '')
        $(this).html('<i class="icon-smile display--inline-block animate--spin"></i>');
        $('.discount__apply-alt').trigger('change');
        return false;
      });
      // general print utility
      $('.discount__reset').once().click(function(){
        $('.field-name-field-membership-discount-code input').attr('value', '');
        $('.discount__apply-alt').trigger('change');
        return false;
      });
    }

  };

})(jQuery, Drupal);
