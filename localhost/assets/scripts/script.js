

// popup reach window
$(document).ready(function(){
  $('#reach__btn').on('click', function(){
    $('#reach__popup').css('top', '0');
    $('#reach__popup__inner').css('bottom', '0');
  })

  $(window).on('click', function(event) {
    if ($(event.target).is('#reach__popup')) {
        $('#reach__popup').css('top', '-100%');
    }
});
  $(window).on('click', function(event) {
    if ($(event.target).is('#popup__reach__close')) {
        $('#reach__popup').css('top', '-100%');}
});



});
// popup hobby window
$(document).ready(function(){
  $('#hobby__btn').on('click', function(){
    $('#hobby__popup').css('top', '0');
    $('#reach__popup__inner').css('bottom', '0');
  })

  $(window).on('click', function(event) {
    if ($(event.target).is('#hobby__popup')) {
        $('#hobby__popup').css('top', '-100%');
    }
});
  $(window).on('click', function(event) {
    if ($(event.target).is('#popup__hobby__close')) {
        $('#hobby__popup').css('top', '-100%');
    }
});
$(document).on('keydown', function(event) {
  if (event.key == "Escape") {
   $('#hobby__popup').css('top', '-100%')
}
});
})

// popup ticket window
$(document).ready(function(){
  $('#side_menu').attr('src', '../assets/img/misc/menu.png');

  $('#ticket__add__btn').on('click', function(){
    $('#ticket__popup').css('top', '0');
    $('#ticket__popup__inner').css('bottom', '0');
  })


  $(window).on('click', function(event) {
    if ($(event.target).is('#ticket__popup__close')) {
        $('#ticket__popup').css('top', '-100%');
    }
    $(document).on('keydown', function(event) {
      if (event.key == "Escape") {
       $('#ticket__popup').css('top', '-100%')
    }
  });
});


// sidebar menu
// $("#toggle__sidebar").on("click", function() {
//   $('.inner__sect__header').css('left', '0');
//   $('#side_menu').attr('src', '../assets/img/misc/menu-back.png');
//   $('#side_menu').css('transition', '0.3s');
//   $('#side_menu').css('opacity', '0.5');
// })



  // $(window).on('click', function(event) {
  //   if ($(event.target).is('.inner__sect__header')) {
  //       $('.inner__sect__header').css('left', '-100%');
  //       $('#side_menu').attr('src', '../assets/img/misc/menu.png');
  //       $('#side_menu').css('transition', '0.3s');
  //       $('#side_menu').css('opacity', '1');
  //   }
  // });
  

$("#toggle__sidebar").on("click", function() {
  $('.inner__sect__header').addClass('inner__sect__header__show');  
  $('.sidebar__btn').addClass('sidebar__btn__active');
});
  
$(window).on('click', function(event) {
  if ($(event.target).is('.inner__sect__header')) {
    $('.inner__sect__header').removeClass('inner__sect__header__show');  
    $('.sidebar__btn').removeClass('sidebar__btn__active');}
  });

  $(document).on('keydown', function(event) {
    if (event.key == "Escape") {
    $('.inner__sect__header').removeClass('inner__sect__header__show');  
    $('.sidebar__btn').removeClass('sidebar__btn__active');}
});

});