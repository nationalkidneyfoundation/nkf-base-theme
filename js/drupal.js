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

      $('[data-track="event"]').once('googleEvent').click(function(){

        var obj = {
          hitType: 'event',
          eventCategory: $(this).data('category') ? $(this).data('category') : '',
          eventAction: $(this).data('action') ? $(this).data('action') : '',
          eventLabel: $(this).data('label') ? $(this).data('label') : '',
          eventValue: $(this).data('value') ? $(this).data('value') : '',
          transport: 'beacon'
        };
        var hasSent = $(this).is('[data-sent]');
        var wasSent = $(this).data('sent');
        if (hasSent) {
          if (wasSent === "" || wasSent == null) {
            $(this).data('sent', true);
            gaTrack(obj);
          }
        } else {
          gaTrack(obj);
        }
      });

      $('[data-track="social"]').once('googleSocial').click(function(){
        var obj = {
          hitType: 'social',
          socialNetwork: $(this).data('network') ? $(this).data('network') : '',
          socialAction: $(this).data('action') ? $(this).data('action') : '',
          socialTarget: $(this).data('target') ? $(this).data('target') : '',
          transport: 'beacon'
        };
        gaTrack(obj);
      });


      var gaTrack = function(obj) {
        try {
          //console.log('trying');
          //console.log(obj);
          ga('send', obj);
        } catch (e) {
          //console.log('catching');
          //console.log(e);
        }
      }
    }

  };

})(jQuery, Drupal);
