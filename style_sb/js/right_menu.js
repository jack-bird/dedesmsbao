$(function(){
	/*Img Max-width*/
	$(".edittext img").each(function(){  
		if($(this).width() > $(this).parent().width()) {  
			$(this).width("100%");  
		}
	});
	
	$('.navbar-nav .secnav').each(function(){
		$(this).parents('li').hover(function(){
			$(this).addClass('cur');
			$(this).find('.secnav').stop(true,true).slideDown('fast');
		}, function(){
			$(this).removeClass('cur');
			$(this).find('.secnav').slideUp('fast');
		}).find('> a').click(function(){ return false;});
	});
	
	

	//var maxheight=$('.sidelist').height();
	//alert(maxheight);
	//if(maxheight > 100){
		//$('.sidelistbox').height(100);
		$('.suof a').click(function(){
			$(this).parent().parent('.sidelistcon').slideUp();
			$('.slideico').fadeIn();
			return false;

		})
	//}

	$('.sidebar').click(function(){
		$('.sidebar').find('.sidelistcon').stop().slideDown(100);
		$('.slideico').fadeOut();
		
	});
	$('.sidebar').each(function(){
		$(this).attr('data-defaultH',$(this).height());
	});
	//$('.sidelistbox').height((($(window).height() - 50) > $('.sidebar').attr('data-defaultH') ? $('.sidebar').attr('data-defaultH') /*: ($(window).height() - 50)) - 35-50 */);
		if(($(window).height() - 50) > $('.sidebar').attr('data-defaultH')){
	  $('.sidebar').attr('data-defaultH');
	}

	var sidenavapi = $('.sidelistbox').jScrollPane({
		autoReinitialise: true,
		animateScroll: true,
		mouseWheelSpeed: 30,
		horizontalGutter: 30
		//showArrows:true
	}).data('jsp');
	
	$(window).resize(function(event) {
		//$('.sidelistbox').height((($(window).height() - 50) > $('.sidebar').attr('data-defaultH') ? $('.sidebar').attr('data-defaultH')/* : ($(window).height() - 50)) - 35 -50*/);
                if(($(window).height() - 50) > $('.sidebar').attr('data-defaultH')){
	  $('.sidebar').attr('data-defaultH');
	}
	})
	
	$(window).scroll(function(event) {
		
		if($('body,html').scrollTop() > 265 | window.pageYOffset > 265){
			$('.sitecon').css({'position':'fixed', 'top':'0'});
		}else{
			$('.sitecon').css({'position':'absolute','top':'265px'});
		};



		if (($('body,html').scrollTop() > 150 | window.pageYOffset > 150) & $(window).width()>767) {
			$('.sidebarbox').css({'position':'fixed', 'top':'0'});
		}
		else {
			$('.sidebarbox').css({'position':'absolute', 'top':'150px'});
		};


		/*$('.sidebar').mouseenter(function(){
			if ($('body,html').scrollTop() > 206) {
				//$('.sidelistcon').height($('.sidelistbox').height($('.sidelist').height()) + 50);
				$('.sidebar').find('.sidelistcon').slideDown(100);
				
			}
		}).mouseleave(function(){
			if ($('body,html').scrollTop() > 206) {
				$('.sidebar').find('.sidelistcon').slideUp(); 
				$('.slideico').fadeIn();
			}
		});*/




		//$('#test').html($('body,html').scrollTop() + '/ ' + window.pageYOffset)
	});
		//$("body").append('<div id="test">');
	
	// site scroll
	
	
	

	
	$('.readerlist li a').hover(function(){
		$(this).parent('li').addClass('cur');
	}, function(){
		$(this).parent('li').removeClass('cur');
	});
		

	$('.suof a, .slidebox_3 a, .floor a, .newslisttop a, .newslist a').focus(function(){this.blur();});	


	


})

