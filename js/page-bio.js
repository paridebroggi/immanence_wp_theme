
(function($)
{
	'use strict';
	var $body;
	var $window;
	var $width;
	var	$height;
	var $overlay;
	var $bigpicSingle;
	var $titleSingle;
	var $subtitleSingle;
	var $shareButton;
	var $sharingServices;
	var $commentButton;
	var $comments;
	var $ajaxContent;
	var $ajaxNav;
	var $footer;
	var $avatar;
	var opacityCoeff;
	var scrollTop;

	/*----------------------------------------------
	INITIALIZE
	-----------------------------------------------*/
	$body = $("body");		
	$window = $(window); 
	$overlay = $(".overlay");
	$bigpicSingle = $(".bigpic-single");
	$titleSingle = $(".title-single");
	$subtitleSingle = $(".subtitle-single");
	$shareButton = $("#share-button");
	$sharingServices = $(".sharing");
	$commentButton = $("#comment-button");
	$comments = $(".comments-custom-template");
	$ajaxContent = $(".ajax-content");
	$ajaxNav = $(".ajax-nav");
	$footer = $(".footer");
	$avatar = $(".avatar");

	$bigpicSingle.css('background-image', 'url(' + phpData.featuredImage + ')');
	$window.resize(function()
	{
		$width = $window.width();
		$height = $window.height();
		$bigpicSingle.css("height", $height);
		$overlay.css("height", $height);
		$titleSingle.css("top", -$height / 2);
		$avatar.css( { left: $width / 2 - 65 } );
		avatar_handler();
	});
	$window.scroll(function()
	{
		avatar_handler();
	});
	$window.trigger('resize');
	$shareButton.click(function(event)
	{
		event.preventDefault();
		$sharingServices.toggle(200);
	});
	$sharingServices.click(function()
	{
 		sharingHandler($(this).attr("id"))
	});
	$commentButton.click(function(event)
	{
		event.preventDefault();
		$comments.toggle(300);
		$footer.velocity( "scroll", { duration:800, easing:"linear" } );
	});
	if ( phpData.titleColor )
	{
		$subtitleSingle.css("color", phpData.titleColor);
		$titleSingle.css("color", phpData.titleColor);
	}

	function sharingHandler(service)
	{
		var title = $(".title-single").text();
		var url = $(location).attr("href");
		if (service == "twitter") window.open("https://twitter.com/intent/tweet?text=" + title + "&url=" + url + "&via=" + phpData.twitter);
		else if (service == "facebook") window.open("https://www.facebook.com/sharer/sharer.php?s=100&u=" + encodeURIComponent(url) + "&[images][0]=" + encodeURIComponent(phpData.featuredImage));
		else if (service == "googleplus") window.open("https://plus.google.com/share?url=" + url);
		else window.location = "mailto:?body=" + "%0D%0A" + title + "%0D%0A%0D%0A" + phpData.excerpt + "%0D%0A%0D%0A" + url;
	}

	function avatar_handler()
	{
		scrollTop = $(window).scrollTop();
		if (scrollTop < 0 )
		{
			return ;
		}
		if (scrollTop == 0)
		{
			$avatar.css( { top: $height - 150 } );
		}
		else if (scrollTop > 0 && scrollTop < 86)
		{
			$avatar.css( { top: $height - 150 + scrollTop } );
		}
		else
		{
			$avatar.css( { top: $height - 65 } );
		}
	}
	$(document).ready(function()
	{
		$avatar.fadeIn(1000);
	});
})(jQuery);