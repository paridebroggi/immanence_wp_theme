
(function($)
{
	'use strict';
	var $window;
	var $width;
	var	$height;
	var $bigpic404;
	var $titleSingle;
	var $body;
	var $footer;

	/*----------------------------------------------
	INITIALIZE
	-----------------------------------------------*/	
	$window = $(window); 
	$bigpic404 = $(".bigpic-single");
	$titleSingle = $(".title-single");
	$body = $("body, html");

	$bigpic404.css('background-image', 'url(' + phpData.image404 + ')');
	$(".footer").css("display", "none");
	$window.resize(function()
	{
		$width = $window.width();
		$height = $window.height();
		$bigpic404.css("height", $height);
		$titleSingle.css("top", $height / 2);
	});
	$window.trigger('resize');
	$body.css("cursor", "pointer");
	$body.click(function()
	{
		document.location.href = phpData.urlHome;
	});
})(jQuery);