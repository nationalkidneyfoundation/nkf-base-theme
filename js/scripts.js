var nkf_base_init = function($) {
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

}

jQuery('document').ready(nkf_base_init($));
