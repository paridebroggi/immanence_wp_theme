(function($)
{
	'use strict';
	var $window;
	var $menuButton;
	var $navmenu;
	var $navlink;
	var $searchInput;
	var $searchButton;
	var isMobile;
	var globalTimer;
	var lastScrollTop;
	var delta;	
	var lock;
	var nowScrollTop;

	$(document).ready(function()
	{
		/*----------------------------------------------
		INITIALIZE
		-----------------------------------------------*/
		$window = $(window);
		$menuButton = $(".menu-button");
		$navmenu = $(".navmenu");
		$navlink = $(".navmenu a");
		$searchInput = $(".search-input");
		$searchButton = $(".search-button");
		isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
		lastScrollTop = 0;
		delta = 100;	
		lock = 0;

		/*----------------------------------------------
		LET'S GO!
		-----------------------------------------------*/
		$searchInput.val("");
		$searchButton.click(function(event)
		{
			if (!$searchInput.val())
			{
				event.preventDefault();
			}
			if ($searchInput.width() == 0)
			{
				$searchInput.stop().animate( { width:170 }, function() { $(this).focus(); });
			}
			else
			{
				$searchInput.stop().animate( { width:0 });
			}
		});
		$("iframe[src*='www.youtube.com']").wrap('<div class="videoWrapper" />');
		$("iframe[src*='vimeo.com']").wrap('<div class="videoWrapper" />');
		
		$menuButton.click(function()
		{
			var method = $navmenu.css("display") == "none" ? "transition.slideDownIn" : "transition.slideUpOut";
			$navmenu.stop().velocity(method, 300);
			$(this).toggleClass("switcher");
		});

		navmenuHandler($window.width());

		function scrollHandler()
		{
			nowScrollTop = $window.scrollTop();
			if ( Math.abs(lastScrollTop - nowScrollTop) > delta )
			{
				if ( nowScrollTop > lastScrollTop )
				{
				 	if ( lock == 0 )
					{
						$navmenu.stop().velocity("transition.slideUpOut", 300);
						lock = 1;
					}
				} 
				else
				{
				 	if ( $navmenu.css("display") == "none" )
					{
						$navmenu.stop().velocity("transition.slideDownIn", 300);
						lock = 0;
					}
				}
				lastScrollTop = nowScrollTop;
			}
		}

		function navmenuHandler(width)
		{
			if (width > 900)
			{
				$menuButton.stop().velocity("transition.slideUpOut", 300);
				$navmenu.stop().velocity("transition.slideDownIn", 300);
				$window.scroll(scrollHandler);
			}
			else
			{
				$navmenu.stop().velocity("transition.slideUpOut", 300);
				$menuButton.stop().velocity("transition.slideUpIn", 300);
			}
		}

		$window.resize(function()
		{
			if (!isMobile)
			{
				clearTimeout(globalTimer);
				globalTimer = setTimeout(function()
					{
						$window.off("scroll", scrollHandler );
						lock = 0;
						navmenuHandler($window.width());
					}, 500);
			}
		});
	});
})(jQuery);