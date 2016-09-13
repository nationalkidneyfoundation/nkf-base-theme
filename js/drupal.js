(function ($, Drupal) {
  var donationProcessed = false;
  Drupal.behaviors.nkf_base = {
    attach: function(context, settings) {
      nkf_base_init($);
      // flip password strength indicator
      $('.password-field').after($('.password-strength'));
      $('input.password-confirm').after($('div.password-confirm'));

      $('.discount__apply').once().click(function(){
        //$(this).prop('value', '')
        $(this).html('<i class="icon-smile display--inline-block animate--spin"></i>');
        $('.discount__apply-alt').trigger('change');
        return false;
      });
      //
      $('.discount__reset').once().click(function(){
        $('.field-name-field-membership-discount-code input').attr('value', '');
        $('.discount__apply-alt').trigger('change');
        return false;
      });
    }

  };

})(jQuery, Drupal);
