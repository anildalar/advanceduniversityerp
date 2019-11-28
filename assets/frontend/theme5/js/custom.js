

jQuery(document).ready(function($) {
var pxShow = 300;//height on which the button will show
		var fadeInTime = 400;//how slow/fast you want the button to show
		var fadeOutTime = 400;//how slow/fast you want the button to hide
		var scrollSpeed = 400;//how slow/fast you want the button to scroll to top. can be a value, 'slow', 'normal' or 'fast'

		jQuery(window).scroll(function(){
			if(jQuery(window).scrollTop() >= pxShow){
				jQuery("#backtotop").fadeIn(fadeInTime);
			}else{
				jQuery("#backtotop").fadeOut(fadeOutTime);
			}
		});
		 
		jQuery('#backtotop a').click(function(){
			jQuery('html, body').animate({scrollTop:0}, scrollSpeed); 
			return false; 
		}); 
})



jQuery(document).ready(function() {

	function uplightbox() {
	
	jQuery("a[rel^='prettyPhoto']").prettyPhoto({
	animationSpeed:'fast',
	slideshow:5000,
	theme:'light_rounded',
	show_title:false,
	overlay_gallery: false
	});
	
	}
	
	if(jQuery().prettyPhoto) {
	
	uplightbox(); 
	
	}
	
	function thumbhover() {
	
		$(".gallery_item").hover(function(){
		 $(this).children('span').animate({top:"38px"},{queue:false,duration:300});
	}, function() {
         $(this).children('span').animate({top:"-60px"},{queue:false,duration:300});
	});
		
	}
	
	thumbhover();
	

		
		
		
	if (jQuery().quicksand) {
	
		(function($) {
		
		$.fn.sorted = function(customOptions) {
		var options = {
			reversed: false,
			by: function(a) {
				return a.text();
			}
		};
		
		$.extend(options, customOptions);
		
		$data = jQuery(this);
		arr = $data.get();
		arr.sort(function(a, b) {
		
			var valA = options.by($(a));
			var valB = options.by($(b));
		
			if (options.reversed) {
				return (valA < valB) ? 1 : (valA > valB) ? -1 : 0;				
			} else {		
				return (valA < valB) ? -1 : (valA > valB) ? 1 : 0;	
			}
		
		});
		
		return $(arr);
		
		};
		
		})(jQuery);
		
		jQuery(function() {
		
		var read_button = function(class_names) {
		
		var r = {
			selected: false,
			type: 0
		};
		
		for (var i=0; i < class_names.length; i++) {
			
			if (class_names[i].indexOf('selected') == 0) {
				r.selected = true;
			}
		
			if (class_names[i].indexOf('segment') == 0) {
				r.segment = class_names[i].split('-')[1];
			}
		};
		
		return r;
		
		};
		
		var determine_sort = function($buttons) {
		var $selected = $buttons.parent().filter('[class*="selected"]');
		return $selected.find('a').attr('data-value');
		};
		
		var determine_kind = function($buttons) {
		var $selected = $buttons.parent().filter('[class*="selected"]');
		return $selected.find('a').attr('data-value');
		};
		
		var $preferences = {
		duration: 500,
		adjustHeight: 'auto'
		}
		
		var $list = jQuery('.portfolio_items');
		var $data = $list.clone();
		
		var $controls = jQuery('.filter_portfolio');
		
		$controls.each(function(i) {
		
		var $control = jQuery(this);
		var $buttons = $control.find('a');
		
		$buttons.bind('click', function(e) {
		
			var $button = jQuery(this);
			var $button_container = $button.parent();
			var button_properties = read_button($button_container.attr('class').split(' '));      
			var selected = button_properties.selected;
			var button_segment = button_properties.segment;
		
			if (!selected) {
		
				$buttons.parent().removeClass();
				$button_container.addClass('selected');
		
				var sorting_type = determine_sort($controls.eq(1).find('a'));
				var sorting_kind = determine_kind($controls.eq(0).find('a'));
		
				if (sorting_kind == 'all') {
					var $filtered_data = $data.find('li');
				} else {
					var $filtered_data = $data.find('li.' + sorting_kind);
				}
		
				var $sorted_data = $filtered_data.sorted({
					by: function(v) {
						return parseInt(jQuery(v).find('.count').text());
					}
				});
		
				$list.quicksand($sorted_data, $preferences, function () {
		
						uplightbox();
						thumbhover();
				});
		
			}
		
			e.preventDefault();
			
		});
		
		}); 
		
		});
	
	}

});

