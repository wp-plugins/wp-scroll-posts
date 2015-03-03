/*
* vertical news ticker
* Tadas Juozapaitis ( kasp3rito [eta] gmail (dot) com )
* http://www.jugbit.com/jquery-vticker-vertical-news-ticker/
* updated by ajay3085006
* ajayitprof(at)gmail(dot)com
*/
(function($){
$.fn.vTicker = function(options) {
	var defaults = {
		speed: 700,
		pause: 4000,
		showItems: 3,
		animation: '',
		mousePause: true,
		isPaused: false,
		direction: 'up',
		height: 0,
		scrollItems:1
	};

	var options = $.extend(defaults, options);

	moveUp = function(obj2, height, options){
		if(options.isPaused)
			return;
		var obj = obj2.children('ul');
    	var clone = obj.children('li:first').clone(true);
		clone.appendTo(obj);
		
		for (var i = 1, limit = options.scrollItems; i < limit; i++) {
			clone_inner = obj.children('li:nth-child('+i+')').next().clone(true);
			clone_inner.appendTo(obj);
		}
		
		if(options.height > 0)
		{
			height = obj.children('li:first').height();
		}		
		
    	//add new height option
    	obj.animate({top: '-=' + options.scrollItems*height + 'px'}, options.speed, function() {
        	
			
			$(this).children('li:first').remove();
			
			//added extra loop
			for (var i = 1, limit = options.scrollItems; i < limit; i++) {
        	
			$(this).children('li:first').remove();
			
			}
			
			
        	$(this).css('top', '0px');
        });
		
		if(options.animation == 'fade')
		{
			obj.children('li:first').fadeOut(options.speed);
			if(options.height == 0)
			{
			obj.children('li:eq(' + options.showItems + ')').hide().fadeIn(options.speed).show();
			}
		}

	};
	
	moveDown = function(obj2, height, options){
		if(options.isPaused)
			return;
		
		var obj = obj2.children('ul');
		//var clone_inner;
		//var clone;
		
    	//var clone = obj.children('li:last').clone(true);
		
		if(options.height > 0)
		{
			height = obj.children('li:first').height();
		}
		/*
		obj.css('top', '-' + height + 'px');
		obj.prepend(clone);
		*/
		
		for (var i = options.scrollItems, limit = 0; i > limit; i--) {
        console.log(i);
		clone = obj.children('li:last').clone(true);
		obj.css('top', '-' + height + 'px');
		
		obj.prepend(clone);
		
		obj.children('li:last').remove();
		
		
		 } ///end loop
		
		 
		
			
    	obj.animate({top: 0}, options.speed, function() {
		for (var i = options.scrollItems, limit = 0; i > limit; i--) {
        	//$(this).children('li:last').remove();
			}
        });
		
		
		
		
		if(options.animation == 'fade')
		{
			if(options.height == 0)
			{
				obj.children('li:eq(' + options.showItems + ')').fadeOut(options.speed);
			}
		  obj.children('li:first').hide().fadeIn(options.speed).show();
		  
		  for (var i = options.scrollItems, limit = 0; i > limit; i--) {
        	//$(this).children('li:last').remove();
			 //obj.children('li:first').hide().fadeIn(options.speed).show();
			 obj.children('li:eq(' + options.showItems + ')').hide().fadeIn(options.speed).show();
			}
		}
	};
	
	return this.each(function() {
		var obj = $(this);
		var maxHeight = 0;

		obj.css({overflow: 'hidden', position: 'relative'})
			.children('ul').css({position: 'absolute', margin: 0, padding: 0})
			.children('li').css({margin: 0, padding: 0});

		if(options.height == 0)
		{
			obj.children('ul').children('li').each(function(){
				if($(this).height() > maxHeight)
				{
					maxHeight = $(this).height();
				}
			});

			obj.children('ul').children('li').each(function(){
				$(this).height(maxHeight);
			});

			obj.height(maxHeight * options.showItems);
		}
		else
		{
			obj.height(options.height);
		}
		
    	var interval = setInterval(function(){ 
			if(options.direction == 'up')
			{ 
				moveUp(obj, maxHeight, options); 
			}
			else
			{ 
				moveDown(obj, maxHeight, options); 
			} 
		}, options.pause);
		
		if(options.mousePause)
		{
			obj.bind("mouseenter",function(){
				options.isPaused = true;
			}).bind("mouseleave",function(){
				options.isPaused = false;
			});
		}
	});
};
})(jQuery);