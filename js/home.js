(function($)
{
	'use strict';
	var $window;
	var $width;
	var $overlayHome;
	var $bigpicHome;
	var $bigpicHomeHeight;
	var $menuButton;
	var opacityCoeff;
	var scrollTop;

	/*----------------------------------------------
	INITIALIZE
	-----------------------------------------------*/
	$window = $(window); 
	$overlayHome = $(".overlay-home");
	$bigpicHome = $(".bigpic-home");
	$menuButton = $(".menu-button");
	opacityCoeff = 1;
	scrollTop = 0;

	$bigpicHome.css('background-image', 'url(' + phpData.headerImage + ')');
	$("p").css("margin", 0);
	$(".sticky p ").css("padding", 10);
	$window.resize(function()
	{
		$width = $window.width();
		$bigpicHomeHeight = $bigpicHome.height()
	});

	$window.scroll(function()
	{
		scrollTop = window.pageYOffset || document.documentElement.scrollTop;
		if ( scrollTop < 0 || scrollTop > $bigpicHomeHeight )
		{
			return;
		}
		opacityCoeff = Math.max(scrollTop / $bigpicHomeHeight, 0);
		$overlayHome.css('opacity', opacityCoeff);
		$bigpicHome.css('transform', 'translate3d(0px, '+ -scrollTop / 3 +'px, 0px)')
	});
	$window.trigger('scroll');
	$window.trigger('resize');
})(jQuery);