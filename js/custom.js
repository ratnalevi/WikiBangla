(function($) {
    $(window).scroll(function() {
        if ($(this).scrollTop() > 100) {
            $('#topmenu').fadeIn(500);
        } else {
            $('#topmenu').fadeOut(200);
        }
    });
    $('[data-toggle="tooltip"]').tooltip();

    function doAnimations(elems) {
        var animEndEv = 'webkitAnimationEnd animationend';
        elems.each(function() {
            var $this = $(this),
                $animationType = $this.data('animation');
            $this.addClass($animationType).one(animEndEv, function() {
                $this.removeClass($animationType);
            });
        });
    }
    var $myCarousel = $('#carousel-example-generic'),
        $firstAnimatingElems = $myCarousel.find('.item:first').find("[data-animation ^= 'animated']");
    $myCarousel.carousel();
    doAnimations($firstAnimatingElems);
    $myCarousel.carousel('pause');
    $myCarousel.on('slide.bs.carousel', function(e) {
        var $animatingElems = $(e.relatedTarget).find("[data-animation ^= 'animated']");
        doAnimations($animatingElems);
    });
    $('#carousel-example-generic').carousel({
        interval: 1000,
        pause: "false"
    });
	
	/*Fooer responsive*/
	$("#footer h3").click(function () {
			$screensize = $(window).width();
			if ($screensize < 768) {
				$(this).toggleClass("active");  
				$(this).parent().find("ul").slideToggle('medium');
			}
		});
	
})(jQuery);









$(window).scroll(function() {    
    var scroll = $(window).scrollTop();

     //>=, not <=
    if (scroll >= 500) {
        //clearHeader, not clearheader - caps H
        $(".followMeBar").addClass("fixed");
    }
	else {
        $(".followMeBar").removeClass("fixed");
    }
}); //missing );


//spyscroll

	$("div #myNavbar > ul > li > a").click(function(){
	$('html, body').animate({
	scrollTop: $( $(this).attr('href') ).offset().top
	}, 500);
	return false;
	});











$(function() {
    var Accordion = function(el, multiple) {
        this.el = el || {};
        this.multiple = multiple || false;
        var links = this.el.find('.link');
        links.on('click', {
            el: this.el,
            multiple: this.multiple
        }, this.dropdown)
    }
    Accordion.prototype.dropdown = function(e) {
        var $el = e.data.el;
        $this = $(this), $next = $this.next();
        $next.slideToggle();
        $this.parent().toggleClass('open');
        if (!e.data.multiple) {
            $el.find('.submenu').not($next).slideUp().parent().removeClass('open');
        };
    }
    var accordion = new Accordion($('#accordion'), false);
});




function loadSubCategory(id) {
    jQuery.ajax({
        url: base_url + 'ajax/loadSubCategory/' + id,
        type: 'GET',
        success: function(data) {
            $('#sub_category_id').empty();
            $('#sub_category_id').append(data);
        },
    });
}
$( function() {
	$("#query").autocomplete({
	    source: function (request, response) {
	    	var query = $("#query").val();
	        $.ajax({
	            dataType: "json",
	            type : 'Get',
	            url: base_url + 'ajax/LoadAutoWord?query='+ query,
	            success: function(data) {
	                //$('input.suggest-user').removeClass('ui-autocomplete-loading');  
	                // hide loading image

	                response(data);
	            }
	        });
	    },
	    minLength: 1
	});
});


(function($) {
  $('.js-twitter').click(function(e) {
    e.preventDefault();
    var href = $(this).attr('href');
    window.open(href, "Twitter", "height=285,width=550,resizable=1");
  });
  $('.js-facebook').click(function(e) {
    e.preventDefault();
    var href = $(this).attr('href');
    window.open(href, "Facebook", "height=269,width=550,resizable=1");
  });
  $('.js-plus-google').click(function(e) {
    e.preventDefault();
    var href = $(this).attr('href');
    window.open(href, "plus google", "height=269,width=550,resizable=1");
  });
})(jQuery);

$(document).ready(function () {
  $('.vid-item').each(function(index){
    $(this).on('click', function(){
      var current_index = index+1;
      $('.vid-item .thumb').removeClass('active');
      $('.vid-item:nth-child('+current_index+') .thumb').addClass('active');
    });
  });
});

function archiveUrl(url) {
	window.open(url,"_self");
}

var $body   = $(document.body);
var navHeight = $('.navbar').outerHeight(true) + 10;
$('#sidebar_affix').affix({
      offset: {
        top: 180,
        bottom: navHeight
      }
});
$body.scrollspy({
	target: '#leftCol',
	offset: navHeight
});
