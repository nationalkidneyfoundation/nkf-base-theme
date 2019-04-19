var nkf_base_init = function($) {
  // utility function to toggle classes on click
  // useful for toggling visibility
  $('[data-toggle=class]').once().click(function (e) {
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
  $('.js--print-link').once().on('click', function(){
    window.print();
    return false;
  });

  $('.js--share-link').once().on('click', function(e){
    e.preventDefault();
    popup(this.href);
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
    $(context).find('input.required, select.required, textarea.required, .form-radios.required').each(function(i, d) {
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
      }
    });
    return t === 0 ? true: false;
  }
  var $steps = $('form .step:not(.processed)');
  var l = $steps.length;
  var $submit = $('.form-submit');

  $steps.each(function(i,v) {
    var $v = $(v);
    $v.addClass('processed');
    //$v.prepend('<a name="step--'+i+'"></a>');
    var prevNext = $('<div class="prev-next clearfix padding-x--xxl padding-y--md margin-x--xxl- margin-top--md bg--gray-2 sm--show"></div>').appendTo($v);
    if (i !== 0) {
      $v.addClass('sm--hide');
      $('<a href="#" class="button--white float--left caps">Previous</a>')
        .appendTo(prevNext)
          .click(function(e){
            //if(checkRequiredFields(v)) {
              $(this).closest('.step').addClass('sm--hide')
                .prevAll('.step').first().removeClass('sm--hide');
            //}
            e.preventDefault();
          });
    }
    if (i !== l-1) {
      //var nextTitle = $('h1,h2,h3,h4,legend', $steps[i+1]).first().text();
      $('<a href="#" class="button--orange float--right caps">Next</a>')
        .appendTo(prevNext)
          .click(function(e){
            if(checkRequiredFields(v)) {
              $(this).closest('.step').addClass('sm--hide')
                .nextAll('.step').first().removeClass('sm--hide');
            }
            e.preventDefault();
          });
    }
    if (i === l-1 && $submit.length) {
      $submit.clone().appendTo(prevNext)
        .addClass('float--right').removeClass('sm--hide').addClass('width--auto');
      $submit.addClass('sm--hide');
    }
  });

}


jQuery('document').ready(nkf_base_init(jQuery));
