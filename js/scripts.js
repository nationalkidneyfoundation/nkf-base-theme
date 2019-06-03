var nkf_base_init = function($) {
  // utility function to toggle classes on click
  // useful for toggling visibility
  $('[data-toggle=class]').once('classToggle').click(function (e) {
    //$(this).addClass('processed');
    var targets = $(this).attr('data-target').split('|');
    var classes = $(this).attr('data-class').split('|');
    $(targets).each(function(i, v){
      $(v).toggleClass(classes[i]);
    })
    e.preventDefault();
  });

  //Accordion action
  $('body').once('accordion-hash', function(){
    var accordHash = window.location.hash.slice(1).split('|');
    $.each(accordHash, function( index, value ) {
      $('#' + index +' a').trigger('click');
    });
  });

  // utility for general slider selection
  if ($.fn.slick !== undefined){
    $('.slider, .slick').slick({
      infinite: true,
      speed: 300,
      slidesToShow: 1,
      variableWidth: true,
      swipeToSlide: true,
      touchThreshold: 8,
      prevArrow: '<a href="#" class="slider-button-left"><i class="icon-left-open"></i></a>',
      nextArrow: '<a href="#" class="slider-button-right"><i class="icon-right-open"></i></a>'
    });
    $('.tabbed-slider--container:not(.processed)').each(function() {
      $(this).addClass('processed');
      var slider = $('.tabbed-slider--slider', this);
      $('.tabbed-slider--nav > *', this).each(function(i){
        $(this).click(function(e){
          e.preventDefault();
          slider.slick('slickGoTo', i);
          return false;
        })
      });
      slider.slick({
        speed: 300,
        slidesToShow: 1,
        arrows: false,
        swipe: false,
        adaptiveHeight: true
      });
    });
  }

  // utility for general modal selection
  $('.modal-trigger').magnificPopup({
    type:'inline',
    midClick: true,
    focus: 'input'
  });
  // utility for general modal selection
  $('.modal-gallery').each(function() {
    $(this).magnificPopup({
      delegate: 'a',
      type: 'image',
      gallery: {
        enabled:true
      }
    });
  });

  function popup(href) {
    var width = 550;
    var height = 420
    var left = Math.round((screen.width / 2) - (width / 2));
    var top = 0;
    if (screen.height > height) {
      top = Math.round((width / 2) - (height / 2));
    }
    var str = 'scrollbars=yes,resizable=yes,toolbar=no,location=yes,width=' + width +',height=' + height + ',left='+ left + ',top=' + top;
    window.open(href, 'intent', str);
  }

  // general print utility
  $('.js--print-link').once('jsPrint').on('click', function(){
    window.print();
    return false;
  });

  $('.js--share-link').once('jsShare').on('click', function(e){
    e.preventDefault();
    popup(this.href);
  });

  // bookmark utility
$('.js--bookmark-link').once('jsBookmark').on('click', function(e) {
  var bookmarkURL = window.location.href;
  var bookmarkTitle = document.title;

  if ('addToHomescreen' in window && addToHomescreen.isCompatible) {
    // Mobile browsers
    addToHomescreen({ autostart: false, startDelay: 0 }).show(true);
  } else if (window.sidebar && window.sidebar.addPanel) {
    // Firefox <=22
    window.sidebar.addPanel(bookmarkTitle, bookmarkURL, '');
  } else if ((window.sidebar && /Firefox/i.test(navigator.userAgent)) || (window.opera && window.print)) {
    // Firefox 23+ and Opera <=14
    $(this).attr({
      href: bookmarkURL,
      title: bookmarkTitle,
      rel: 'sidebar'
    }).off(e);
    return true;
  } else if (window.external && ('AddFavorite' in window.external)) {
    // IE Favorites
    window.external.AddFavorite(bookmarkURL, bookmarkTitle);
  } else {
    // Other browsers (mainly WebKit & Blink - Safari, Chrome, Opera 15+)
    alert('Press ' + (/Mac/i.test(navigator.platform) ? 'Cmd' : 'Ctrl') + '+D to bookmark this page.');
  }
  return false;
});

  // Scrolling utility with three scroll by points.
  $(document).scroll(function(){
    var scrollTop = $(this).scrollTop();
    if (scrollTop > 400) {
      $('.js--scroll--400, .js--scroll--300, .js--scroll--200').not('.js--scrolled')
        .addClass('js--scrolled').toggleClass('hide');
    } else if (scrollTop > 300) {
      $('.js--scroll--300, .js--scroll--200').not('.js--scrolled')
        .addClass('js--scrolled').toggleClass('hide');
    } else if (scrollTop > 200) {
      $('.js--scroll--200').not('.js--scrolled')
        .addClass('js--scrolled').toggleClass('hide');
    } else {
      $('.js--scrolled')
        .removeClass('js--scrolled').toggleClass('hide');
    }
  });

  // animation utilities
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

  function checkRequiredFields(context) {
    var t = 0;
    // handle required fields per section
    $(context).find('input.required:not(.form-radio), select.required, textarea.required, .form-radios.required').each(function(i, d) {
      var r = false;
      if ($(d).attr('type') === 'checkbox') {
        r = !$("input[name='" + $(d).attr('name') + "']:checked").val();
      }
      if ($(d).hasClass('form-radios')) {
        var radios = true;
        r = $('input:checked', d).length === 0;
      }
      if((!radios && $(d).val().trim() === '') || r) {

        // set focus on first required field without value
        if(t === 0) {
          $(d).focus();
        }
        t += 1;
        $(d).addClass('error')
          .closest('.form-item').addClass('animate').addClass('animation-duration--2').animationClass('animate--giggle');
      } else {
        $(d).removeClass('error');
      }
    });
    return t === 0 ? true: false;
  }


  var $steps = $('form .step:not(.processed)');
  var l = $steps.length;
  var $submit = $('.form-submit');
  // Handle default submit handler for step forms.
  var $stepForm = $steps.closest('form');

  $stepForm.on('submit', (event)=>{
    event.preventDefault();
    event.stopPropagation();
    $stepForm.addClass('js--stopped');
    var s = false;
    // Find the next submit button.
    var $nextStep = $('.prev-next:visible');
    if ($nextStep.length) {
      if($('a.next', $nextStep).length) {
        $('a.next', $nextStep).click();
      }
      if($('.form-submit', $nextStep).length) {
        s = true;
      }
    } else {
      // No next section, probably mobile.
      s = true;
    }
    if(s && checkRequiredFields($stepForm)) {
      $stepForm.removeClass('js--stopped');
      event.currentTarget.submit();
    }

  });
  // disable the submit button after first click
  $('form').once('hideSubmitButton', function () {
    var $form = $(this);
    $form.find('.form-submit').click(function (e) {
      var el = $(this);
      el.after('<input type="hidden" name="' + el.attr('name') + '" value="' + el.attr('value') + '" />');
      return true;
    });
    $form.submit(function (e) {
      //if (checkRequiredFields($form)) {
        if (!e.isPropagationStopped() || !$(this).hasClass('js--stopped')) {
          $('input.form-submit', $(this))
            .attr('disabled', 'disabled')
            .val('processing');
          return true;
        }
      //}
      return false;
    });
  });
  $steps.each(function(i,v) {
    var $v = $(v);
    $v.addClass('processed');
    //$v.prepend('<a name="step--'+i+'"></a>');
    var prevNext = $('<div class="prev-next sm--display--flex display--none align-items--center padding-x--xxl padding-y--md margin-x--xxl- margin-top--md border-style--solid border-top-width--sm border-color--gray-4 border-width--none"></div>').appendTo($v);
    if (i !== 0) {
      $v.addClass('sm--hide');
      $('<a href="#" class="prev button--gray-1 caps margin-right--sm">Previous</a>')
        .appendTo(prevNext)
          .click(function(e){
            //if(checkRequiredFields(v)) {
              $(this).closest('.step').addClass('sm--hide')
                .prevAll('.step').first().removeClass('sm--hide');
            //}
            e.preventDefault();
          });
    }
    if (i === l-1 && $submit.length) {
      $submit.clone().appendTo(prevNext)
        .removeClass('sm--hide').addClass('width--auto');
      $submit.addClass('sm--hide');
    }
    if (i !== l-1) {
      //var nextTitle = $('h1,h2,h3,h4,legend', $steps[i+1]).first().text();
      $('<a href="#" class="next button--orange caps">Next</a>')
        .appendTo(prevNext)
          .click(function(e){
            if(checkRequiredFields(v)) {
              $(this).closest('.step').addClass('sm--hide')
                .nextAll('.step').first().removeClass('sm--hide');
            }
            e.preventDefault();
          });
    }
    $('<div class="bold" style="margin-left:auto"><span class="color--orange">'+(i+1)+'</span> of '+l+'</div>')
      .appendTo(prevNext)
  });

}


jQuery('document').ready(nkf_base_init(jQuery));
