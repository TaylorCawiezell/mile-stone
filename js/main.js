$(document).foundation();

$(document).ready(function(){
    $('.cta').css('background-position','center ' + '1px');
    $('.color').css('background-position','center ' + '1px');
    
    
    $('input').keyup(function(){
        $(this).addClass('validate');
    });
    
    $( ".error2" ).delay('800').slideDown().delay('3000').slideUp();
    
    
    var form = document.getElementById('form'); // form has to have ID: <form id="formID">
form.noValidate = true;
form.addEventListener('submit', function(event) { // listen for form submitting
        if (!event.target.checkValidity()) {
            event.preventDefault(); // dismiss the default functionality
            $( ".error" ).slideDown().delay('3000').slideUp();
            $('input').addClass('validate');
        }
    }, false);

    
    
    $('.login-btn').click(function(){
        $('.lightbox').fadeIn();
    });
    
    $('.exit').click(function(){
        $('.lightbox').fadeOut();
    });
    
    $('body').fadeIn(1500);
    
    $('.add-person').click(function(){
       $('.pop-up').fadeIn(); 
    });
    
     $('.person-added').click(function(){
      
       var html = $(this).html(); 
        $('.person-place').append(html);
          var val = $('.person-place').find('input').attr('value');
           $('.person-place').find('input').attr('name','invite[]');
         $(this).hide();
          $('.pop-up').fadeOut(); 
    });
    
    $('.side-nav').hide();
    $('.menu').click(function(){
        //$('.side-nav').slideToggle(direction: "left");
        $('.side-nav').slideToggle();
    });
    
    $('.light-box2').click(function(){
        
    });
    
    $('.person-hover').click(function(){
        var time = $(this).parent().find('.time').val();
        var phone = $(this).parent().find('.phone').val();
        var email = $(this).parent().find('.email').val();
        var name = $(this).parent().find('.name').val();
        var image = $(this).parent().find('.image').val();
        var color = $(this).parent().find('.color').val();
        console.log(image);
        $('.lightbox2 .name').html(name);
        $('.lightbox2 .phone').html(phone);
        $('.lightbox2 .email').html(email); 
        $('.lightbox2 .time').html(time);
        $('.lightbox2 .image').css('background-image', 'url(' + image + ')'); 
         $('.lightbox2 .image').css('border-color', color); 
        $('.lightbox2').fadeToggle();
        
    });
    
    $('.exit').click(function(){
        $('.lightbox2').fadeOut();
    });
    
});


$(window).scroll(function(e){
  parallax();
  
});

function parallax(){
  var scrolled = $(window).scrollTop();
  $('.cta').css('background-position','center ' + -(scrolled*0.50)+'px');
    
    var scrolled = $(window).scrollTop();
  $('.color').css('background-position','center ' + -(scrolled*0.80)+'px');
  
   
    
}