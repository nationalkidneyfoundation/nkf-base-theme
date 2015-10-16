(function ($, Drupal) {
  var donationProcessed = false;
  Drupal.behaviors.nkf_base_donate_form = {
    attach: function(context, settings) {

      // set up some sensible input masks
      $('.field-type-telephone input').inputmask("mask", {"mask": "(999) 999-9999"});
      $('[class*="email"] input').inputmask("email");

      // disable the submit button after first click
      $('form', context).once('hideSubmitButton', function () {
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
        setActiveButton();
      }

      // helper to set the active button
      function setActiveButton() {
        var v = $(".form-item-donation input").val();
        $('.amount-options .button').removeClass('active');
        if (v > 0) {
          var b = $("[data-amount='" + v + "']");
          if (b.length > 0) {
            b.addClass('active');
          }
          else {
            $("[data-amount='0']").addClass('active');
          }
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
      $(".form-item-donation input").once().on('input', setDonationAmount);

      // build donation sections and misc donation stuff
      if(!donationProcessed && !ie8) {
        var textDonation = $('.form-item-donation.form-type-textfield');
        if(textDonation.length > 0) {

          //$('input', textDonation).attr('placeholder', 'Enter a dollar amount');
          // add buttons for textfield style donations
          // TODO make this configurable through the UI
          var amountOptions = $('<div class="amount-options text-align--center"></div>').insertBefore(textDonation);
          $.each([[50,'$50'],[100,'$100'], [250,'$250'], [500, '$500'], [1000, '$1,000'], [0, 'Other']], function(i, v) {
            var buttonOuter = $('<div class="grid-cell width--33 padding--xxs"></div>').appendTo($(amountOptions));
            var button = $('<a class="button button--gray-1 color--black width--100 padding-y--md padding-x--none" data-amount="' + v[0] + '">' + v[1] + '</a>')
              .appendTo(buttonOuter);
            button.click(function(e) {
                //$('.amount-options .button').removeClass('active');
                //$(this).addClass('active');
                if($(this).data('amount') == 0) {
                  $('input', textDonation).val('').focus().trigger('input');
                } else {
                  $('input', textDonation).val($(this).data('amount')).trigger('input');
                }
                e.preventDefault();
              });
          });
          // let's try to set the active button once on load
          // as the value might be prefilled
          setActiveButton();
        }
        var steps = $('<div class="steps sm--show"></div>').prependTo($('form > div'));
        var donationSteps = $('.donation-step');
        $('.donation-step').each(function(i, v) {
          steps.append('<div class="step"><div class="step-' + i + '">'+ (i + 1) +'</div>');
          var previousNext = $('<div class="previous-next clearfix grid"></div>').appendTo($(v));
          if(i == 0) {
            $(v).addClass('active');
          }
          if(i != 0 ) {
            $(v).addClass('sm--hide');
            $('<a href="#" class="previous"><i class="icon-arrow-left"></i></a>')
              .appendTo(previousNext).click(function(e) {
                $(this).closest('.donation-step').addClass('sm--hide').removeClass('active')
                  .prevAll('.donation-step:first').removeClass('sm--hide').addClass('active');
                $('.step.active').toggleClass('active').prev('.step').toggleClass('active');
                e.preventDefault();
              });
          }
          if(i != donationSteps.length - 1) {
            var nextHeader = $('legend:first', $(v).next()).text();//$(v).next().first('legend').text();
            $('<a href="#" class="next grid-cell width--100 ">'+nextHeader+' <i class="icon-arrow-right padding-right--lg "></i></a>')
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
        /*
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
        */

      }
      donationProcessed = true;
    }
  };

})(jQuery, Drupal);
