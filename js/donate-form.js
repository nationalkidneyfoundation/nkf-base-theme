(function ($, Drupal) {
  var donationProcessed = false;
  Drupal.behaviors.nkf_base_donate_form = {
    attach: function(context, settings) {

      // set up some sensible input masks
      //$('.field-type-telephone input').inputmask("mask", {"mask": "(999) 999-9999"});
      //$('.form-item-payment-details-credit-card-number input').inputmask({ mask: "9999 9999 9999 9999"});
      $('.form-item-payment-details-credit-card-number input').payment('formatCardNumber');
      $('.form-item-payment-details-credit-card-code input').payment('formatCardCVC');

      restrictFloat = function(e) {
        if (e.metaKey || e.ctrlKey) {
          return true;
        }
        if (e.which === 32) {
          return false;
        }
        if (e.which === 0) {
          return true;
        }
        if (e.which < 33) {
          return true;
        }
        return !isNaN(this.value+""+String.fromCharCode(e.charCode));
      };
      $.payment.fn.restrictFloat = function() {
        this.on('keypress', restrictFloat);
        return this;
      };
      $('.form-item-donation input').payment('restrictFloat');


      // disable the submit button after first click
      $('form', context).once('hideSubmitButton', function () {
        var $form = $(this);
        $form.find('.form-submit').click(function (e) {
          var el = $(this);
          el.after('<input type="hidden" name="' + el.attr('name') + '" value="' + el.attr('value') + '" />');
          return true;
        });
        $form.submit(function (e) {
          if (checkRequiredFields($form)) {
            var cc = $('.form-item-payment-details-credit-card-number input');
            if (cc.length !==0) {
              cc.closest('.form-item').find('.cc-error').remove();
              if(!$.payment.validateCardNumber(cc.val())) {
                cc.addClass('error');
                cc.closest('.form-item').append('<div class="cc-error error">Oops, double check your credit card number.</div>');
                return false;
              } else {
                cc.removeClass('error');
                cc.val(cc.val().replace(/ /g,''));
              }
            }
            //return false;
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

      // move to next section
      function moveToNextSection() {
        if($('.donation-step.active').find('.previous-next').is(':visible')) {
          $('.donation-step.active').find('.next').click();
          return false;
        }
        return true;
      }
      // basic currency formatter
      function currencyFormat(v) {
        v = parseFloat(v).toFixed(2);
        if(v % 1 === 0) {
          v = parseFloat(v).toFixed(0);
        }
        if (isNaN(v)) {
          return false;
        }
        return "$" + v.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
      }

      // helper function to get the donation amount
      function setDonationAmount() {
        var v = $(".form-item-donation input").val();
        var c = '';
        if(v != 'select_or_other') {
          var r = $("input:radio[name ='product']:checked").val();
          if (r == 'MONTHLY_DONATION' || $('#edit-field-monthly-recurring-und').is(':checked')) {
            c = ' / mo';
          }
          if (currencyFormat(v)) {
            $('#edit-submit').val('Donate ' + currencyFormat(v) + c);
          }

        }
        setActiveButton();
      }

      // helper to set the active button
      function setActiveButton() {
        var v = $(".form-item-donation input").val();
        $('.amount-options .button').removeClass('active');
        if (v > 0) {
          if (v % 1 === 0) {
            v = parseInt(v);
          }
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
        var t = 0;
        // handle required fields per section
        $(context).find('input.required, select.required, textarea.required').each(function(i, d) {
          var r = false;
          if ($(d).attr('type') === 'radio') {
            r = !$("input[name='" + $(d).attr('name') + "']:checked").val();
          }
          if($(d).val().trim() === '' || r) {
            // set focus on first required field without value
            if(t === 0) {
              $(d).focus();
            }
            t += 1;
            $(d).addClass('error')
              .closest('.form-item').addClass('animate').addClass('animation-duration--2').animationClass('animate--giggle');
          }
        });
        return t === 0 ? true: false;
      }

      function requiredFieldInputHandler() {
        if ($(this).attr('type') === 'radio') {
          if ($("input[name='" + $(this).attr('name') + "']:checked").val()) {
            $("input[name='" + $(this).attr('name') + "']").removeClass('error');
          }
        }
        if($(this).val().trim() !== '') {
          $(this).removeClass('error');
        }
      }


      // listen for changes to required fields to unset error
      $('input.form-text, textarea').once().on('input', requiredFieldInputHandler);
      $('input.form-radio, select').once().on('change', requiredFieldInputHandler);

      // update the submit button with current donation amount
      $(".form-item-donation input").once('donation-value').on('input', setDonationAmount);

      // listen for state visibility change and add effect
      $(document).bind('state:visible', function(e) {
        if(e.trigger) {
          $(e.target).addClass('animate').animationClass('animate--fade-in');
        }
      });

      // hack to add class for states-based required fields
      // the core states.js is inadequate
      $(document).bind('state:required', function(e) {
        if (e.trigger) {
          if (e.value) {
            $(e.target).find('input, textarea, select').addClass('required');
          }
          else {
            $('.required', e.target).removeClass('required');
          }
        }
      });

      // listen for gift type update to set honoree label
      $("input[name='field_gift_type[und]']").change(function(){
        var v = $(this).val();
        if (v === 'honor') {
          $('.field-name-field-honoree-full-name label').text("Person you're honoring");
        }
        if (v === 'memorial') {
          $('.field-name-field-honoree-full-name label').text("Person you're memorializing");
        }
      });

      // listen to recurring gift field
      $('#edit-field-monthly-recurring-und').once().on('change', function () {
        $('.form-item-donation').toggleClass('recurring');
        setDonationAmount();
      });
      // listen to recurring gift field
      $("input:radio[name ='product']").once(function() {
        $(this).on('change', function () {
          var r = $("input:radio[name ='product']:checked").val();
          if (r == 'MONTHLY_DONATION') {
            $('.form-item-donation').addClass('recurring');
          } else {
            $('.form-item-donation').removeClass('recurring');
          }
          setDonationAmount();
        });
      });

      var textDonation = $('.form-item-donation.form-type-textfield');
      if(textDonation.length > 0) {

        //$('input', textDonation).attr('placeholder', 'Enter a dollar amount');
        // add buttons for textfield style donations
        // TODO make this configurable through the UI
        // remove all amount buttons first.
        $('.amount-options').remove();
        var amountOptions = $('<div class="amount-options text-align--center"></div>').insertBefore(textDonation);
        var amountOptionsArray = [[50,'$50'],[100,'$100'], [250,'$250'], [500, '$500'], [1000, '$1,000'], [0, 'Other']];
        if(window.location.href.toLowerCase().indexOf("localboardchallenge") != -1) {
           amountOptionsArray = [[250,'$250'],[500,'$500'], [1000,'$1,000'], [2500, '$2,500'], [5000, '$5,000'], [0, 'Other']];
        }
        $.each(amountOptionsArray, function(i, v) {
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
        setDonationAmount();
      }
      // build donation sections and misc donation stuff
      if(!donationProcessed && !ie8) {

        // ziptastic
        /*
        $('.postal-code')
          .ziptastic()
          .on('zipChange', function(event, country, state, state_short, city, zip) {
            var _a = $(event.target).closest('.field-type-addressfield');
            $('.state', _a).val(state_short);
            $('.locality', _a).val(city);
          });
        */

        var steps = $('<div class="steps grid text-align--center sm--show bg--white"></div>').prependTo($('form > div'));
        var donationSteps = $('.donation-step');
        $('.donation-step').each(function(i, v) {
          steps.append('<div class="step grid-cell width--xs height--xs bg--gray-2 circle margin-y--sm margin-x--xxs"><div class="step-' + i + '"></div>');
          var previousNext = $('<div class="previous-next clearfix grid text-align--center"></div>').appendTo($(v));
          if(i === 0) {
            $(v).addClass('active');
          }
          if(i != donationSteps.length - 1) {
            var nextHeader = $('legend:first', $(v).next()).text();//$(v).next().first('legend').text();
            $('<a href="#" class="next grid-cell button--blue padding-y--md">'+nextHeader+' <i class="icon-arrow-right"></i></a>')
              .appendTo(previousNext).click(function(e) {
                if(checkRequiredFields(v)) {
                  $(this).closest('.donation-step').addClass('sm--hide').removeClass('active')
                    .nextAll('.donation-step:first').removeClass('sm--hide').addClass('active')
                    .find('input,select').first().focus();//.addClass('animate').animationClass('animate--subtle-focus');
                  $('.step.active').toggleClass('active').next('.step').toggleClass('active');
                }
                e.preventDefault();
              });
          }
          if(i !== 0 ) {
            $(v).addClass('sm--hide');
            $('<a href="#" class="previous grid-cell"><i class="icon-arrow-left"></i></a>')
              .appendTo(previousNext).click(function(e) {
                $(this).closest('.donation-step').addClass('sm--hide').removeClass('active')
                  .prevAll('.donation-step:first').removeClass('sm--hide').addClass('active');
                $('.step.active').toggleClass('active').prev('.step').toggleClass('active');
                e.preventDefault();
              });
          }
        });
        $('.step:first-child').addClass('active');

      }
      donationProcessed = true;
    }
  };

})(jQuery, Drupal);
