(function($)
{
	'use strict';
	var $window;
	var $width;
	var	$height;
	var $overlaySingle;
	var $bigpicSingle;
	var $titleSingle;
	var $widget;
	var $widgetFirst;
	var $widgetLast;
	var $backToTopButton;
	var opacityCoeff;
	var scrollTop;

	/*----------------------------------------------
	INITIALIZE ANONYM FUNCTION
	-----------------------------------------------*/
	$window = $(window); 
	$overlaySingle = $(".overlay-single");
	$bigpicSingle = $(".bigpic-single");
	$titleSingle = $(".title-single");
	$widget = $(".widget-area aside");
	$widgetFirst = $(".widget-area aside").first();
	$widgetLast = $(".widget-area aside").last();
	$backToTopButton = $(".back-to-top-button");
	scrollTop = 0;

	$window.resize(function()
	{
		var ratio = 2.5;

		$width = $window.width();
		$height = $window.height();
		$bigpicSingle.css("height", $height);
		$overlaySingle.css("height", $height);
		if ($width < 480)
		{
			ratio = 1.8;
		}
		$titleSingle.css("top", -$height / ratio);
		widgetHandler();
		backToTop();
	});
	$window.scroll(function()
	{
		scrollTop = window.pageYOffset || document.documentElement.scrollTop;
		backToTop();
		if ( scrollTop < 0 || scrollTop > $height )
		{
			return;
		}
		opacityCoeff = Math.max(scrollTop / $height, 0);
		$bigpicSingle.css({				
					'transform':'translate3d(0px, '+ scrollTop / 5 +'px, 0px)',
					"-webkit-transform":"translate3d(0px, " + scrollTop / 5 + "px, 0px)",
					"-moz-transform":"translate3d(0px, " + scrollTop / 5 + "px, 0px)",
				});
		$overlaySingle.css('opacity', opacityCoeff);
	});
	$window.trigger('scroll');
	$window.trigger('resize');
	$bigpicSingle.css('background-image', 'url(' + phpData.featuredImage + ')');
	$backToTopButton.click(function()
	{
		$titleSingle.velocity( "scroll", { duration:600, offset:-150, easing:"easeInSine" } );
	});
	
	/*----------------------------------------------
	WIDGET-AREA RESPONSIVE BEHAVIOUR
	-----------------------------------------------*/
	function widgetHandler()
	{
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
	}

	/*----------------------------------------------
	BACK TO TOP BUTTON
	-----------------------------------------------*/
	function backToTop()
	{
		if (scrollTop > $height )
		{
			$backToTopButton.fadeIn();
		}
		else
		{
			$backToTopButton.fadeOut();
		}
	}

	$(document).ready(function()
	{
		var $body;
		var $subtitleSingle;
		var $shareButton;
		var $sharingServices;
		var $commentButton;
		var $comments;
		var $ajaxContent;
		var $ajaxNav;
		var $footer;
		var sharingUrl;
		var title;
		
		/*----------------------------------------------
		INITIALIZE DOCUMENT READY
		-----------------------------------------------*/
		$body = $("body");		
		$subtitleSingle = $(".subtitle-single");
		$shareButton = $("#share-button");
		$sharingServices = $(".sharing");
		$commentButton = $("#comment-button");
		$comments = $(".comments-custom-template");
		$ajaxContent = $(".ajax-content");
		$ajaxNav = $(".ajax-nav");
		$footer = $(".footer");
		sharingUrl = $(location).attr("href");
		title = $titleSingle.text();

		$shareButton.click(function(event)
		{
			event.preventDefault();
			$sharingServices.toggle(200);
		});

		$body.on("click", ".post-pages a", function(event)
		{
			event.preventDefault();
			var requestedUrl = $(this).attr('href');

			$titleSingle.velocity( "scroll", { duration:700, offset:-150, easing:"easeInSine" } );
			$ajaxContent.velocity( { opacity:0 } );
			$ajaxContent.load(requestedUrl + " article", function() { $(this).velocity( { opacity:1 } ); });
			$ajaxNav.load(requestedUrl + " .post-pages");
		});

		$commentButton.click(function(event)
		{
			event.preventDefault();
			$comments.toggle(300, function()
				{
					$commentButton.velocity( "scroll", { duration:300, easing:"linear", offset:-20 } );
				});
		});

		if ( phpData.titleColor )
		{
			$subtitleSingle.css("color", phpData.titleColor);
			$titleSingle.css("color", phpData.titleColor);
		}

		/*----------------------------------------------
		SHARING SERVICE INITIZIALIZER
		-----------------------------------------------*/
		$("#twitter").attr("href", "https://twitter.com/intent/tweet?text=" + title + "&url=" + sharingUrl + "&via=" + phpData.twitter );
		$("#facebook").attr("href", "https://www.facebook.com/sharer/sharer.php?u=" + encodeURIComponent(sharingUrl) );
		$("#googleplus").attr("href", "https://plus.google.com/share?url=" + sharingUrl );
		$("#email").attr("href", "mailto:?body=" + "%0D%0A" + title + "%0D%0A%0D%0A" + phpData.excerpt + "%0D%0A%0D%0A" + sharingUrl );
		
		/*----------------------------------------------
		SWIPEBOX INITIALIZE
		-----------------------------------------------*/
		if ($(".gallery a").length > 0)
		{
			var $attachment = $(".gallery a");
			$attachment.addClass("swipebox");
			$attachment.attr("title", $(this).find("img").attr("alt"));
			$( ".swipebox" ).swipebox();
		}
	});
})(jQuery);