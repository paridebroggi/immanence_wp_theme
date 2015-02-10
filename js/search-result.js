(function($)
{
	'use strict';
	var $width;
	var $window = $(window); 
	var	$widget = $(".widget-area aside");
	var	$widgetFirst = $(".widget-area aside").first();
	var	$widgetLast = $(".widget-area aside").last();
	
	$(".search-result-separator").last().css("display", "none");
	$("html, body").css("background-color", "#fff");

	/*----------------------------------------------
	WIDGET-AREA RESPONSIVE BEHAVIOUR
	-----------------------------------------------*/
	$window.resize(function()
	{
		$width = $window.width();
		if ($width > 860)
		{
			$widget.css("margin", "0px 20px");
			$widget.css("display", "inline-block");
		}
		else if ($width > 660 && $width <= 860)
		{
			$widget.css("display", "inline-block");
			$widgetLast.css("display", "none");
			$widget.css("margin", "0px 20px");
			$widgetFirst.css("margin-right", "15px");		
		}
		else
		{
			$widget.css("margin", "0px 20px 40px 20px");		
			$widget.css("display", "block");
		}
	});
	$window.trigger('resize');
})(jQuery);