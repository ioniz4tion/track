$(document).ready(function() {
				var $height = $window.height();
				var bodyHeight = function() {
					$('body').css({
						'height' : $height + 'px'
					});
				};
				$(window).resize(function() {
					bodyHeight();
				});
				bodyHeight();
			});