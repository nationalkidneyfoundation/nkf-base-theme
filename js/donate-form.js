(function ($, Drupal) {
  var donationProcessed = false;
  Drupal.behaviors.nkf_base_donate_form = {
    attach: function(context, settings) {

      // disable the submit button after first click
      $('.field-type-redhen-donation', context).once('hideSubmitButton', function () {
        var $form = $(this);
        $form.find('.form-submit').click(function (e) {
          var el = $(this);
          el.after('<input type="hidden" name="' + el.attr('name') + '" value="' + el.attr('value') + '" />');
          return true;
        });
        $form.submit(function (e) {
          if(checkRequiredFields($form)) {
            if (!e.isPropagationStopped()) {
              $('input.form-submit', $(this))
                .attr('disabled', 'disabled')
                .val('processing');
              return true;
            }
          }
          return false;
        });
      });

      // basic currency formatter
      function currencyFormat(v) {
        v = parseFloat(v).toFixed(2);
        if(v % 1 == 0) {
          v = parseFloat(v).toFixed(0);
        }
        return "$" + v.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
      }

      // helper function to get the donation amount
      function setDonationAmount() {
        var v = $(this).val();
        if(v != 'select_or_other') {
          $('#edit-submit').val('Donate ' + currencyFormat(v));
        }
      }

      function checkRequiredFields(context) {
        //return true;
        var t = 0;
        // handle required fields per section
        $(context).find('input.required, select.required').each(function(i, d) {
          if($(d).val().trim() === '') {
            // set focus on first required field without value
            if(t === 0) {
              $(d).focus();
            }
            t += 1;
            $(d).addClass('error').change(function() {
              if($(this).val().trim() !== '') {
                $(this).removeClass('error');
              }
            });
          }
        });
        return t === 0 ? true: false;
      }

      // update the submit button with current donation amount
      $(".form-item-donation input").once().change(setDonationAmount);

      // build donation sections and misc donation stuff
      if(!donationProcessed && !ie8) {
        var textDonation = $('.form-item-donation.form-type-textfield');
        if(textDonation.length > 0) {
          //$('input', textDonation).attr('placeholder', 'Enter a dollar amount');

          // add buttons for textfield style donations
          // TODO make this configurable through the UI
          var amountOptions = $('<div class="amount-options text-align--center"></div>').insertBefore(textDonation);
          $.each([[50,'$50'],[100,'$100'], [250,'$250'], [500, '$500'], [1000, '$1,000'], [0, 'Other']], function(i, v) {
            var buttonOuter = $('<div class="grid-cell width--33 padding--xs"></div>').appendTo($(amountOptions));
            var button = $('<div class="button button--outline--blue width--100 padding-y--md padding-x--none" data-amount="' + v[0] + '">' + v[1] + '</div>')
              .appendTo(buttonOuter);
            button.click(function(e) {
                $('.amount-options .button').removeClass('active');
                $(this).addClass('active');
                if($(this).data('amount') == 0) {
                  $('input', textDonation).val('').focus().change();
                } else {
                  $('input', textDonation).val($(this).data('amount')).change();
                }
                e.preventDefault();
              });
          });

        }
        var steps = $('<div class="steps sm--show"></div>').prependTo($('.field-type-redhen-donation > form > div'));
        var donationSteps = $('.donation-step');
        $('.donation-step').each(function(i, v) {
          steps.append('<div class="step"><div class="step-' + i + '">'+ (i + 1) +'</div>');
          var previousNext = $('<div class="previous-next clearfix"></div>').appendTo($(v));
          if(i == 0) {
            $(v).addClass('active');
          }
          if(i != 0 ) {
            $(v).addClass('sm--hide');
            $('<a href="#" class="previous">previous</a>')
              .appendTo(previousNext).click(function(e) {
                $(this).closest('.donation-step').addClass('sm--hide').removeClass('active')
                  .prevAll('.donation-step:first').removeClass('sm--hide').addClass('active');
                $('.step.active').toggleClass('active').prev('.step').toggleClass('active');
                e.preventDefault();
              });
          }
          if(i != donationSteps.length - 1) {
            $('<a href="#" class="next">next</a>')
              .appendTo(previousNext).click(function(e) {
                if(checkRequiredFields(v)) {
                  $(this).closest('.donation-step').addClass('sm--hide').removeClass('active')
                    .nextAll('.donation-step:first').removeClass('sm--hide').addClass('active')
                    .find('input,select').first().focus();
                  $('.step.active').toggleClass('active').next('.step').toggleClass('active');
                }
                e.preventDefault();
              });
          }
        });
        $('.step:first-child').addClass('active');
        $(document).keydown(function(e) {
          switch(e.which) {
            case 37: // left
              if($('.donation-step.active').find('.previous-next').is(':visible')) {
                $('.donation-step.active').find('.previous').click();
              }
            break;

            case 39: // right
              if($('.donation-step.active').find('.previous-next').is(':visible')) {
                $('.donation-step.active').find('.next').click();
              }
            break;

            default: return; // exit this handler for other keys
          }
          e.preventDefault(); // prevent the default action (scroll / move caret)
        });

      }
      donationProcessed = true;
    }
  };

})(jQuery, Drupal);
