$(document).ready(function(e) {
	var desktop = false, ipad = false, mobile = false;
	if($("#desktop").css("display")=="block"){
		desktop = true;
	}
	if($("#ipad").css("display")=="block"){
		ipad = true;
	}
	if($("#mobile").css("display")=="block"){
		mobile = true;
	}
	if($("#home_about").length > 0){
		$("#main_menu > ul > li > a").first().addClass('scroll_to_about');
	}
	$("#homepage-down, .scroll_to_about").click(function(){
		if($("#home_about").length > 0){
			$("html, body").animate({
	            scrollTop: $("#home_about").offset().top - 62
	        },400);
	        $("#mobile_menu").fadeOut(0);
			return false;
		}
	});
	$(window).load(function(){
		setTimeout(function(){
			$("#cloader").fadeOut(1500);
		},3000);
	})
	$("#menu_btn,#close_menu").click(function(){
		$("#mobile_menu").fadeToggle();
	});
	if(mobile){
		$("#home_services h3").click(function(){
			var block =  $(this).parents(".service_block");
			if(block.hasClass('active')){
				block.find("i").removeClass("fa-minus");
				block.find("p").slideUp(500,function(){
					block.removeClass("active");
				});
				
			}
			else
			{
				block.find("i").addClass("fa-minus");
				block.find("p").slideDown(500,function(){
					block.addClass("active");
				});
			}
			return false;
		});
	}

	if($('.grid').length > 0){
        var $grid = $('.grid').isotope({
            itemSelector: '.grid-item',
            layoutMode: 'packery',
        });
    }


	$("#main_menu > ul").append('<div id="blip"></div>');
	if($("#slider").length>0){
		$('#slider').slick({
			speed: 2000,
			slidesToShow: 1,
			slidesToScroll: 1,
			prevArrow: '<button type="button" class="slick-prev fa fa-angle-left"></button>',
			nextArrow: '<button type="button" class="slick-next fa fa-angle-right"></button>',
			autoplay: true,
			autoplaySpeed: 5000,
	        dots: true,
	        arrows:false,
	        onInit: function(){
	        	$(".slide_bar3").fadeIn(1000,function(){
	        		$(".slide_bar2 img").fadeIn(1000,function(){
	        			$(".slide_bar1 img").fadeIn(1000,function(){
        					$(".slide_content").fadeIn();
        				})
	        		});
	        	});
	        },
		});
	}

	if($("#news_drawer_posts_slider").length>0){
		$('#news_drawer_posts_slider').slick({
			speed: 2000,
			slidesToShow: 1,
			slidesToScroll: 1,
			autoplay: true,
			autoplaySpeed: 2500,
	        dots: false,
	        arrows:false,
		});
	}

	setTimeout(function(){
		if($("#news_drawer_insta_slider").length>0){
			$('#news_drawer_insta_slider').slick({
				speed: 2000,
				slidesToShow: 1,
				slidesToScroll: 1,
				autoplay: true,
				autoplaySpeed: 3500,
		        dots: false,
		        arrows:false,
			});
		}
	},5000);

	$(window).load(function(){
		$(".news_drawer_wrapper").css("opacity","1");
	});

	setTimeout(function(){
		$("body").find(".sbi_item").each(function(i){
			var item = $(this);
			var img = item.find(".sbi_photo").css("background-image");
			var l = item.find("a").attr("href");
			var c = item.find(".sbi_caption").text();
			$(".n_d_i_slide").eq(i).css("background-image",img);		
			$(".n_d_i_slide").eq(i).find(".n_d_i_full_link").attr("href",l);		
			$(".n_d_i_slide").eq(i).find(".caption").html(c+"...");
		});
	},1000);
	setTimeout(function(){
		$("body").find(".sbi_item").each(function(i){
			var item = $(this);
			var img = item.find(".sbi_photo").css("background-image");
			var l = item.find("a").attr("href");
			var c = item.find(".sbi_caption").text();
			$(".n_d_i_slide").eq(i).css("background-image",img);		
			$(".n_d_i_slide").eq(i).find(".n_d_i_full_link").attr("href",l);		
			$(".n_d_i_slide").eq(i).find(".caption").html(c+"...");
		});
	},2000);
	setTimeout(function(){
		$("body").find(".sbi_item").each(function(i){
			var item = $(this);
			var img = item.find(".sbi_photo").css("background-image");
			var l = item.find("a").attr("href");
			var c = item.find(".sbi_caption").text();
			$(".n_d_i_slide").eq(i).css("background-image",img);		
			$(".n_d_i_slide").eq(i).find(".n_d_i_full_link").attr("href",l);		
			$(".n_d_i_slide").eq(i).find(".caption").html(c+"...");
		});
	},4000);
	setTimeout(function(){
		$("body").find(".sbi_item").each(function(i){
			var item = $(this);
			var img = item.find(".sbi_photo").css("background-image");
			var l = item.find("a").attr("href");
			var c = item.find(".sbi_caption").text();
			$(".n_d_i_slide").eq(i).css("background-image",img);		
			$(".n_d_i_slide").eq(i).find(".n_d_i_full_link").attr("href",l);		
			$(".n_d_i_slide").eq(i).find(".caption").html(c+"...");
		});
	},5000);

	$("#news_drawer_btn").click(function(){
		$("#news_drawer_content").slideToggle();
		$(this).find("i").toggleClass("fa-angle-up").toggleClass("fa-angle-down");
	});

	if($("#project_img_slider").length>0){
		$('#project_img_slider').slick({
			speed: 2000,
			slidesToShow: 1,
			slidesToScroll: 1,
			prevArrow: '<button type="button" class="slick-prev fa fa-angle-left"></button>',
			nextArrow: '<button type="button" class="slick-next fa fa-angle-right"></button>',
			autoplay: true,
			autoplaySpeed: 3500,
	        dots:true,
			arrows: false,
		});
	}

	if($("#team_slider").length>0){
		$('#team_slider').slick({
			speed: 2000,
			slidesToShow: 1,
			slidesToScroll: 1,
			prevArrow: '<button type="button" class="slick-prev fa fa-angle-left"></button>',
			nextArrow: '<button type="button" class="slick-next fa fa-angle-right"></button>',
			autoplay: true,
			autoplaySpeed: 3500,
	        dots:true,
			arrows: false,
			onInit: function(){
	        	$(".slide_bar2 img, .slide_bar1 img").fadeIn(1000,function(){
        			$(".team_content").fadeIn();
        		});
	        },
	        onBeforeChange: function(){
	        	$(".slide_bar2 img, .slide_bar1 img").fadeOut(500);
	        },
	        onAfterChange: function(){
	        	$(".slide_bar2 img, .slide_bar1 img").fadeIn(1000);
	        	// var h = $(".slick-active .mobile_img").outerHeight() + $(".slick-active .team_content").outerHeight();
	        	// $("#team_slider").find(".slick-track").height(h+"px");
	        }
		});
	}



	if($("#work_sectors").length>0){
		$("#work_sectors .sector").each(function(){
			var h = $(this).find("h3.wst");
			var t = h.text();
			t = t.split("–");
			var tspan;
			if(t[1]!=undefined){
				tspan= " - <span>"+t[1]+"</span>";
			}
			else
			{
				tspan = "";
			}
			
			var title = t[0]+tspan;
			h.html(title);
		})
	}

	if($("#our_values_section").length>0){
		$("#our_values_section .block").each(function(){
			var h = $(this).find("h3.ovt");
			var t = h.text();
			t = t.split("–");
			var tspan;
			if(t[1]!=undefined){
				tspan= " - <span>"+t[1]+"</span>";
			}
			else
			{
				tspan = "";
			}
			
			var title = t[0]+tspan;
			h.html(title);
		})
	}
	

	var $blip = $('#blip');
		
	$('#main_menu li').on('mouseover', function(){
		var ml = $(this).find("a").css("margin-left");

		if($(this).find("a").hasClass("active")){}else{
		var w = $(this).find("a").width();
		  $blip.css({
			width:w, background:"#fff",
			left: $(this).offset().left
			- $(this).parent().offset().left,
			marginLeft:ml
		  });
		}
	});
	
	$('#main_menu').on('mouseout', function(){
	  $('#blip').css({background:"none"});
	});

	$("#proj_btn").click(function(){
		var btn = $(this);
		if(btn.hasClass("active")){
			btn.removeClass("active");
			btn.find("span").html("Project");
			$(".project_detail").removeClass("active");
			$("#header").addClass("green");
		}
		else
		{
			btn.addClass("active");
			btn.find("span").html("Hide");
			$(".project_detail").addClass("active");
			$("#header").removeClass("green");
		}
		return false;
	});
	
	if($("#portfolio").length>0){
		$('#portfolio').mixItUp();
	}
	$(".proj_block").click(function(){
		if(!$(this).hasClass("disable_click")){
			window.location.href=  $(this).data("url");
		}
		
		return false;
	});
	if($("#clients_slider").length>0){
		$("#clients_slider").slick({
			  speed: 5000,
			  dots:false,
			  arrows: false,
			  slidesToShow: 5,
			  slidesToScroll: 1,
			  autoplay: true,
			  autoplaySpeed: 0,
        	  cssEase:'linear',
			  infinite: true,
			  onAfterChange: function() {
				  //$("#slider").find(".slick-track").height($(".slick-active img").outerHeight());
			  },
			  responsive: [
				{
				  breakpoint: 1024,
				  settings: {
					slidesToShow: 5,
					slidesToScroll: 1
				  }
				},
				{
				  breakpoint: 768,
				  settings: {
					slidesToShow: 4,
					slidesToScroll: 1
				  }
				},
				{
				  breakpoint: 480,
				  settings: {
					slidesToShow: 2,
					slidesToScroll: 1
				  }
				}
			  ]
		  });
	}
	
	var h = Math.max(document.documentElement.clientHeight, window.innerHeight || 0);
	var w = Math.max(document.documentElement.clientWidth, window.innerWidth || 0);
	h = h/2;
	$(window).scroll(function(){

        if($(this).scrollTop() > 10){
            $("#header").addClass("sticky");
            $("body").addClass("scrolled");
        }
        else
        {
            $("#header").removeClass("sticky");
            $("body").removeClass("scrolled");
        }
        if(w>200){
	        if($("#home_about").length > 0 && $(this).scrollTop() > $("#home_about").offset().top-h){

	        	$(".about_bar1 img").fadeIn(1000,function(){
	        		$(".about_bar2 img").fadeIn(1000);
	        	});
	        } else{}
	        if($("#home_services").length > 0 && $(this).scrollTop() > $("#home_services").offset().top-h){
	        	$(".service_bar1 img").fadeIn(1000,function(){
	        		$(".service_bar2 img").fadeIn(1000);
	        	});
	        } else{}
	        if($("#home_projects").length > 0 && $(this).scrollTop() > $("#home_projects").offset().top-h){
	        	$(".project_bar1 img").fadeIn(1000,function(){
	        		$(".project_bar2 img").fadeIn(1000,function(){
	        			$(".client_help_bar1 img").fadeIn();
	        		});
	        	});
	        } else{}
	        if($("#work_sectors").length > 0 && $(this).scrollTop() > $("#work_sectors").offset().top-h){
	        	$(".ws_bar1 img").fadeIn(1000,function(){
	        		$(".ws_bar2 img").fadeIn(1000,function(){
	        			
	        		});
	        	});
	        } else{}
	        if($("#aoh_sections").length > 0 && $(this).scrollTop() > $("#aoh_sections").offset().top-h){
	        	$(".aoh_bar_1 img").fadeIn(1000,function(){
	        		$(".aoh_bar_2 img").fadeIn(1000,function(){
	        			
	        		});
	        	});
	        } else{}

	       
	    }
    });

    // $("#search_activator").click(function(){
    // 	$("#filter_all").trigger("click");
    // 	if($("#search_bar").css("display")=="block"){
    // 		$("#search_bar").slideUp();
    // 	}
    // 	else{
    // 		$("#search_bar").slideDown();
    // 	}
    // 	return false;
    // });
    $(".filters li a.filter").click(function(){
    	if($("#search_input").val()!=""){
    		$("#search_input").val("");
    	}
    	
    });

    $("#search_input").focusout(function(event) {
    	$("#filter_all").trigger("click");
    });
    
    $(window).load(function() {
    	setTimeout(function(){
    		if($("#search_input").hasClass("trigger_search")){
    			var value = $("#search_input").val();
				value = value.toLowerCase();
				var current_url = $("#current_url").val();
    			window.history.pushState("object or string", "Title", current_url+"?search="+value);
				var area;
				area = $("#portfolio");
				area.find("a").attr("style", '');
				area.find("a").each(function(index, element) {
					var box = $(this);
					var data = $(this).find(".proj_text").data("search").toLowerCase();
					//var data2 = $(this).find(".proj_text p").text().toLowerCase();
				
					if (data.search(value) != -1) {
						box.attr("style", 'display:inline-block');
					}
				});
				return false;
    		}
    	},500);
    });
    $("#search_input").keyup(function() {
		var value = $(this).val();
		value = value.toLowerCase();
    	var current_url = $("#current_url").val();
    	window.history.pushState("object or string", "Title", current_url+"?search="+value);
		var area;
		area = $("#portfolio");
		area.find("a").attr("style", '');
		area.find("a").each(function(index, element) {
			var box = $(this);
			var data = $(this).find(".proj_text").data("search").toLowerCase();
			//var data2 = $(this).find(".proj_text p").text().toLowerCase();
		
			if (data.search(value) != -1) {
				box.attr("style", 'display:inline-block');
			}
		});
		return false;
	});

  

});