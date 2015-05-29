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
    
    $('body').click(function(){
       
       $('.lightbox2').hide();
        $('.side-nav').hide();
        $('.settings-box').hide();
   });
    
    $('.lightbox2').click(function(){
         event.stopPropagation();
    });
    
     $('.side-nav').click(function(){
         event.stopPropagation();
    });
    
     $('.menu').click(function(){
         event.stopPropagation();
         $('.lightbox2').hide();
          $('.settings-box').fadeOut();
    });

    $('.person-hover').click(function(){
         event.stopPropagation();
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
         $('.side-nav').hide();
        $('.lightbox2').fadeToggle();
        
        
    });
    
    $('.exit').click(function(){
        $('.lightbox2').fadeOut();
    });
    
    $('.signup-2').hide();
    $('.signup-3').hide();
    $('.signup-4').hide();
    $('.signup-5').hide();
    $('.pos').addClass('pulse');
    $('.next').click(function(){
        $('.signup-1').fadeOut();
        $('.signup-2').fadeIn({ duration: 800, queue: false }).css('display', 'none').slideDown(800)
        $('.insert').html($('#fname').val());
        $('.pos2').css('background','#00FF18');
        $('.pos2').addClass('pulse');
        $('.pos').removeClass('pulse');
        //$('.lname').val($('#lname').val());
       // $('.fname').val($('#fname').val());
        
    });
    
    $('.next2').click(function(){
        $('.signup-2').fadeOut();
        $('.signup-3').fadeIn({ duration: 800, queue: false }).css('display', 'none').slideDown(800)
        $('.pos3').css('background','#00FF18');
        $('.pos3').addClass('pulse');
        $('.pos2').removeClass('pulse');
    });
    
     $('.next3').click(function(){
        $('.signup-3').fadeOut();
        $('.signup-4').fadeIn({ duration: 800, queue: false }).css('display', 'none').slideDown(800)
        $('.pos4').css('background','#00FF18');
        $('.pos4').addClass('pulse');
        $('.pos3').removeClass('pulse');
        //$('.time2').val($('#time2').val());
        //$('.time1').val($('#time1').val());
        //$('.time1').val($('#time1').val());
       // $('.week').val($('#week').val());
    });
    
    $('.next4').click(function(){
        $('.signup-4').fadeOut();
        $('.signup-5').fadeIn({ duration: 800, queue: false }).css('display', 'none').slideDown(800)
        $('.pos5').css('background','#00FF18');
        $('.pos5').addClass('pulse');
        $('.pos4').removeClass('pulse');
       // $('.email').val($('#email').val());
       // $('.phone').val($('#phone').val());
       // $('.pass').val($('#pass').val());
        //$('.week').val($('#week').val());
       // $('.gid').val($('#gid').val());
       // $('.gname').val($('#gname').val());
    });
    
    $('.back').click(function(){
        $('.signup-2').fadeOut();
        $('.signup-1').fadeIn({ duration: 800, queue: false }).css('display', 'none').slideDown(800);
        $('.pos2').css('background','#FFFFFF');
        $('.pos').addClass('pulse');
        $('.pos2').removeClass('pulse');
    });
    
    $('.back2').click(function(){
        $('.signup-3').fadeOut();
        $('.signup-2').fadeIn({ duration: 800, queue: false }).css('display', 'none').slideDown(800);
        $('.pos3').css('background','#FFFFFF');
        $('.pos2').addClass('pulse');
        $('.pos3').removeClass('pulse');
    });
    
    $('.back3').click(function(){
        $('.signup-4').fadeOut();
        $('.signup-3').fadeIn({ duration: 800, queue: false }).css('display', 'none').slideDown(800);
        $('.pos4').css('background','#FFFFFF');
        $('.pos3').addClass('pulse');
        $('.pos4').removeClass('pulse');
    });
    
    $('.back4').click(function(){
        $('.signup-5').fadeOut();
        $('.signup-4').fadeIn({ duration: 800, queue: false }).css('display', 'none').slideDown(800);
        $('.pos5').css('background','#FFFFFF');
        $('.pos4').addClass('pulse');
        $('.pos5').removeClass('pulse');
    });
    
    $('.next').attr('disabled','true');
    $('.next2').attr('disabled','true');
    $('.next3').attr('disabled','true');
    $('.next4').attr('disabled','true');
    
    $('.signup-1 input').keyup(function(){
         if ($("#fname").is(':valid') && $("#lname").is(':valid')) {
        $('.next').prop("disabled", false);
    }else{
         $('.next').attr('disabled','true');
    }
    });
    
    $('input[name="color"]').click(function(){
         if ($("#fname").is(':valid') && $("#lname").is(':valid')) {
        $('.next2').prop("disabled", false);
    }else{
         $('.next2').attr('disabled','true');
    }
    });
    
    $('.signup-3 input').keyup(function(){
         if ($(".to").is(':valid') && $(".from").is(':valid')) {
        $('.next3').prop("disabled", false);
    }else{
         $('.next3').attr('disabled','true');
    }
    });
    
    $('.signup-4 input').keyup(function(){
         if (
             $("#gid").is(':valid') &&
             $("#gname").is(':valid') && 
             $("#email").is(':valid') &&
             $("#phone").is(':valid') &&
             $("#pass").is(':valid')
             )
         {
        $('.next4').prop("disabled", false);
    }else{
         $('.next4').attr('disabled','true');
    }
    });
    
    $('.blue-choice').hide();
    $('.green-choice').hide();
    $('.red-choice').hide();
    $('.gold-choice').hide();
    $('.red').click(function(){
        $('.red-choice').fadeIn({ duration: 800, queue: false }).css('display', 'none').slideDown(800);
        $('.blue-choice').fadeOut();
        $('.green-choice').fadeOut();
        $('.gold-choice').fadeOut();
    });
    
    $('.blue').click(function(){
        $('.blue-choice').fadeIn({ duration: 800, queue: false }).css('display', 'none').slideDown(800);
        $('.red-choice').fadeOut();
        $('.green-choice').fadeOut();
        $('.gold-choice').fadeOut();
    });
    
     $('.green').click(function(){
        $('.green-choice').fadeIn({ duration: 800, queue: false }).css('display', 'none').slideDown(800);
        $('.red-choice').fadeOut();
        $('.blue-choice').fadeOut();
        $('.gold-choice').fadeOut();
    });
    
    $('.yellow').click(function(){
        $('.gold-choice').fadeIn({ duration: 800, queue: false }).css('display', 'none').slideDown(800);
        $('.red-choice').fadeOut();
        $('.blue-choice').fadeOut();
        $('.green-choice').fadeOut();
    });
    
    $('.pro-pic').css('border-color', $('input[name=color]:checked', '#form').val() )
    
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('.pro-pic').css({
                    'background' : 'url("' + e.target.result + '") no-repeat center',
                    'background-size' : '100% 100%'
                });
        
                console.log('profile pic try')
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    $("#picture").change(function(){
        readURL(this);
    });
    
   
    $(".comments").prop({ scrollTop: $(".comments").prop("scrollHeight") });
    
    $('.settings-box').hide();
    
    $('.settings').click(function(){
        $('.settings-box').fadeToggle();
         $('.side-nav').fadeOut();
        event.stopPropagation();
    });
    
     $('.ex').click(function(){
         $('.settings-box').fadeOut();
     });
        
    $('.settings-box').click(function(){
        $('.side-nav').fadeOut();
        event.stopPropagation();
        
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