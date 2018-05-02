
( function( $ ) {
/*************** 1. MAIN FUNCTION ***************/
	$( document ).ready( function() {
		init();
		onChanges();
		onClicks();
		onMouseUps();
	} );
/*****---------- 1.1 INIT ----------*****/
	function init() {
		// init Isotope =GALLERY
			initIsotope();
		// init SLICKS
			slickSingle();
			slickThumbnail();
			slickMultiple();
			slickCenter();
			slickMisc();
		// SET POSITION SLICK SAMPLE
			// $('.our-team-slider__slickmaster').slick("setPosition", 0);
		// init Date Pickers
			// initDatePickers();
	}
/*****---------- 1.2 onChanges ----------*****/
	function onChanges() {

	}
/*****---------- 1.3 onClicks ----------*****/
	function onClicks() {
		$( document ).on( 'click', '.portal--link', function( e ) {
			e.preventDefault();
			var modal_id = $( this ).data( 'modal' );
			var $box_modal = $( document ).find( modal_id );
			if ( $box_modal.length ) {
				$box_modal.fadeIn( 'fast' );
			}
		} );

		$( document ).on( "click", ".portal--modal-close", function( e ) {
			e.preventDefault();
			$( this ).closest( ".portal--modal" ).fadeOut();
		} );
	}
/*****---------- 1.4 OnMouseUp ----------*****/
	function onMouseUps() {
		$( document ).mouseup( function( e ) {
			var container = $( ".portal--modal-content" );
			if ( container.is( ':visible' ) ) {
				if ( !container.is( e.target ) && container.has( e.target ).length === 0 ) {
					if ( !$( e.target ).closest( '.ui-datepicker' ).length ) {
						$( document ).find( '.portal--modal-details' ).each( function() {
							if ( $( this ).is( ':visible' ) ) {
								if ( !$( document ).find( $( this ) ).hasClass( 'locklightbox' ) ) {
									$( '.portal--modal' ).fadeOut();
								}
							}
						} );
					}
				}
			}
		} );
	}

/*************** 2. FUNCTIONS ***************/
/*****---------- 2.1 REUSABLE FUNCTIONS ----------*****/
/**------------- 2.1.1 Simple Tabbing -------------**/
	/** SIMPLE TABBING DESCRIPTION
	 * ::PATTERN::
	 * <div class="masterParent_classname">
	 *	  <div class="link-parent">
	 *			  <a href="#" class="tabLinks__single_classname active___classname"> link 1</a>
	 *			  <a href="#" class="tabLinks__single_classname"> link 2</a>
	 *	  </div>
	 *	  
	 *	  <div class="content-parent">
	 *		  <div class="tabContents__single_classname"></div>
	 *		  <div class="tabContents__single_classname"></div>
	 *	  </div>
	 * </div>
	 * 
	 * This will dynamically include "data-tabs" attribute to links and tab content class name number.
	 * 
	 * @param	  {string}  masterParent_classname		 Insert main container class for uniqueness
	 * @param	  {string}  tabLinks__single_classname	 The tab links single classname
	 * @param	  {string}  tabContents__single_classname  The tab contents single classname
	 * @param	  {<type>}  active___classname			 The active classname
	 */
	window.simple_tabbing = function( masterParent_classname, tabLinks__single_classname, tabContents__single_classname, active___classname, select__dropdown ) {
		// GET CLASS NAMES
		var mp = '.' + masterParent_classname;
		var tl = '.' + tabLinks__single_classname;
		var tc = '.' + tabContents__single_classname;
		var sd = '.' + select__dropdown;
		var tlp = $( tl ).parent().attr( 'class' );
		var tcp = $( tc ).parent().attr( 'class' );
		tlp = '.' + tlp;
		tcp = '.' + tcp;
		// SET "DATA-TAB" ATTRIBUTE TO LINKS
		$( mp + ' ' + tlp + ' > ' + tl ).each( function( i ) {
			$( this ).attr( 'data-tab', i + 1 );
		} );
		if ( sd ) {
			// SET "DATA-TAB" ATTRIBUTE TO OPTIONS
			$( mp + ' ' + sd + ' option' ).each( function( c ) {
				$( this ).attr( 'data-tab', c + 1 );
			} );
		}
		// SET "classname--z++" ATTRIBUTE TO CONTENT TABS
		$( mp + ' ' + tcp + ' > ' + tc ).each( function( z ) {
			var content_classname = $( this ).attr( 'class' ).split( ' ' )[ 0 ];
			$( this ).addClass( content_classname + '--' + ( z + 1 ) );
		} );
		$( mp + ' ' + tl ).first().addClass( active___classname );
		// ONCLICK FUNCTION THAT CHECK THE NUMBER "DATA-TAB" ATTRIBUTE AND SHOW TO THE CORRESPONDING "class--z++"
		$( mp + ' ' + tl ).on( 'click', function( e ) {
			e.preventDefault();
			$( mp + ' ' + tl ).removeClass( active___classname );
			$( this ).addClass( active___classname );
			var __tab = $( this ).attr( 'data-tab' );
			$( mp + ' ' + tc ).hide();
			$( mp + ' ' + tc + '--' + __tab ).fadeIn();
		} );
		$( mp + ' ' + sd ).change( function() {
			var __tab = $( this ).find( 'option:selected' ).attr( 'data-tab' );
			$( mp + ' ' + tc ).hide();
			$( mp + ' ' + tc + '--' + __tab ).fadeIn();
		} );
	};
/**------------- 2.1.2 Equalize Height -------------**/
	/** EQUALIZE HEIGHT OF AN ELEMENTS
	 *
	 * @param	  {<type>}  elem	The element
	 */
	window.equalizeHeight = function( elem ) {
		var arr = [];
		var a = 0;
		$( elem ).each( function() {
			arr[ a++ ] = $( this ).outerHeight();
		} );
		var largest = Math.max.apply( Math, arr );
		$( elem ).each( function() {
			$( this ).css( {
				'min-height': largest
			} );
		} );
	};
/**------------- 2.1.3 Contact Form Modal -------------**/
	/** CONTACT FORM MODAL
	 */
	// window.contactFormModal = function(){
	//	 $.featherlight($('#contactFormModal'), {
	//		 closeOnClick: '.close-featherlight'
	//	 });
	// }
/**------------- 2.1.4 Random Class Name -------------**/
	window.randomClass = function( length ) {
		var text = "";
		var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
		for ( var i = 0; i < length; i++ ) text += possible.charAt( Math.floor( Math.random() * possible.length ) );
		return text;
	};
/**------------- 2.1.5 Media Base Scripts -------------**/
	window.viewportBasedScripts = function() {
		var rtime;
		var timeout = false;
		var delta = 200;
		mediabaseFunctions( $( window ).width() );
		$( window ).resize( function() {
			rtime = new Date();
			if ( timeout === false ) {
				timeout = true;
				setTimeout( mediaBaseResizer, delta );
			}
		} );

		function mediaBaseResizer() {
			if ( new Date() - rtime < delta ) {
				setTimeout( mediaBaseResizer, delta );
			} else {
				timeout = false;
				var width = $( window ).width();
				mediabaseFunctions( width );
			}
		}

		function mediabaseFunctions( width ) {
			// READ MORE COLLAPSABLE FUNCTION just add '.r__collapse' to an element
			if ( width < 768 ) {
				$( '.r__collapse' ).each( function() {
					$( this ).addClass( 'r__collapse-on' ).slideUp();
					if ( !$( this ).next( '.r__collapse-readmore' ).length ) {
						$( '<span class="r__collapse-readmore"><a href="#"><u>read more</u></a></span>' ).insertAfter( this );
					}
				} );
			} else {
				$( '.r__collapse' ).each( function() {
					$( this ).removeClass( 'r__collapse-on' ).slideDown();
					$( this ).next( '.r__collapse-readmore' ).remove();
				} );
			}
			$.fn.extend( {
				toggleText: function( a, b ) {
					return this.text( this.text() == b ? a : b );
				}
			} );
			$( '.r__collapse-readmore' ).find( 'a' ).on( 'click', function( e ) {
				e.preventDefault();
				$( this ).parent().prev( '.r__collapse' ).slideToggle();
				$( this ).find( 'u' ).toggleText( 'read less', 'read more' );
			} );
		}
	};
/**------------- 2.1.6 Equalize by Group -------------**/
	window.equalizeByGroup = function( container, length ) {
		length = parseInt( length );
		$( document ).find( container ).children().each( function( k, v ) {
			if ( k % length == 0 ) {
				var items = $();
				items = items.add( $( container ).children().eq( k ) );
				for ( var i = 1;
					( k + i ) % length != 0; i++ ) {
					items = items.add( $( container ).children().eq( k + i ) );
				}
        window.equalizeHeight( items );
			}
		} );
	};
/**------------- 2.1.7 Field accepts number only -------------**/
	window.fieldNumberOnly = function( field_element ) {
		
		$(document).on('keydown', field_element, function(e){
	        if( (e.keyCode >= 48 && e.keyCode <= 57) || (e.keyCode >= 96 && e.keyCode <= 105) ){
	            if(e.shiftKey){
	                return false;
	            }
	            return true;
	        } else if( e.keyCode == 173 || e.keyCode == 189 || e.keyCode == 109 ||           //dashes
	                (e.shiftKey && e.keyCode == 61) || e.keyCode ==  107 || e.keyCode == 187 //plus signs
	        ){
	            return true;
	        }
	        else if( ( e.keyCode <= 46 && e.keyCode != 32) || (e.keyCode >= 112 && e.keyCode <= 123)
	            || (e.keyCode >= 144 && e.keyCode <= 145)  ){
	            return true;
	        } 
	        else if(e.ctrlKey || (e.ctrlKey && e.shiftKey) || (e.shiftKey && e.altKey)){
	            return true;
	        }else {
	            return false;
	        }
	    });

	};
/*****---------- 2.2 ADDITIONAL FUNCTIONS   ----------*****/
/**------------- 2.2.1 SLICKS -------------**/
	window.slickSingle = function() {
		$( '.slick-master-single-view > .ss__images' ).each( function() {
			var imgHeight = $( this ).attr( 'data-img-height' );
			var sliderAutoplay = $( this ).attr( 'data-autoplay' );
			$( this ).find( 'a' ).css( 'height', imgHeight + 'px' );
			$( this ).slick( {
				dots: true,
				arrows: false,
				infinite: true,
				speed: 300,
				swipe: false,
				slidesToShow: 1,
				slidesToScroll: 1,
				autoplay: ( ( sliderAutoplay == "Yes" ) ? true : false ),
				autoplaySpeed: 5000,
				responsive: [
					{
						breakpoint: 1024,
						settings: {
							slidesToShow: 3,
							slidesToScroll: 1,
							infinite: true,
							arrows: false,
							dots: false
						}
					},
					{
						breakpoint: 992,
						settings: {
							slidesToShow: 1,
							slidesToScroll: 1,
							infinite: true,
							arrows: false,
							dots: false
						}
					},
					{
						breakpoint: 641,
						settings: {
							slidesToShow: 2,
							slidesToScroll: 1,
							arrows: false,
							swipe: true,
							dots: false,
						}
					},
					{
						breakpoint: 541,
						settings: {
							slidesToShow: 1,
							slidesToScroll: 1,
							arrows: false,
							dots: false,
							swipe: true
						}
					}
				]
			} );
			$( this ).next( '.slick-master__arrows' ).find( '.fa-angle-right' ).click( function() {
				$( this ).parent().prev( '.ss__images' ).slick( 'slickNext' );
			} );
			$( this ).next( '.slick-master__arrows' ).find( '.fa-angle-left' ).click( function() {
				$( this ).parent().prev( '.ss__images' ).slick( 'slickPrev' );
			} );
		} );
	};

	window.slickThumbnail = function() {
		$( '.slick-master-single-thumbnails-view > .ss__images' ).each( function() {
			var imgHeight = $( this ).attr( 'data-img-height' );
			var sliderAutoplay = $( this ).attr( 'data-autoplay' );
			var toShow = $( this ).parent().find( '.ss__nav' ).attr( 'data-show' );
			$( this ).find( 'a' ).css( 'height', imgHeight + 'px' );
			$( this ).parent().find( '.slick-master__arrows' ).css( 'height', imgHeight + 'px' );
			$( this ).slick( {
				asNavFor: $( this ).parent().find( '.ss__nav' ),
				dots: false,
				arrows: false,
				infinite: true,
				speed: 300,
				swipe: false,
				slidesToShow: 1,
				slidesToScroll: 1,
				autoplay: ( ( sliderAutoplay == "Yes" ) ? true : false ),
				autoplaySpeed: 5000,
				responsive: [
					{
						breakpoint: 1024,
						settings: {
							slidesToShow: 1,
							slidesToScroll: 1,
							infinite: true,
							arrows: false,
							dots: false
						}
					},
					{
						breakpoint: 992,
						settings: {
							slidesToShow: 1,
							slidesToScroll: 1,
							swipe: true,
							infinite: true,
							arrows: false,
							dots: false
						}
					},
					{
						breakpoint: 641,
						settings: {
							slidesToShow: 1,
							slidesToScroll: 1,
							arrows: false,
							dots: false
						}
					},
					{
						breakpoint: 541,
						settings: {
							slidesToShow: 1,
							slidesToScroll: 1,
							arrows: false,
							dots: false
						}
					}
				]
			} );
			$( '.ss__nav' ).on( 'click', function( e ) {
				e.preventDefault();
			} );
			$( this ).parent().find( '.ss__nav' ).slick( {
				asNavFor: $( this ),
				focusOnSelect: true,
				centerMode: true,
				dots: false,
				arrows: false,
				infinite: true,
				speed: 300,
				swipe: false,
				slidesToShow: ( toShow ? toShow : 3 ),
				slidesToScroll: 1,
				autoplay: ( ( sliderAutoplay == "Yes" ) ? true : false ),
				autoplaySpeed: 5000,
				responsive: [
					{
						breakpoint: 1024,
						settings: {
							slidesToShow: 3,
							slidesToScroll: 1,
							infinite: true,
							arrows: false,
							dots: false
						}
					},
					{
						breakpoint: 992,
						settings: {
							slidesToShow: 3,
							slidesToScroll: 1,
							swipe: true,
							infinite: true,
							arrows: false,
							dots: false
						}
					},
					{
						breakpoint: 641,
						settings: {
							slidesToShow: 3,
							slidesToScroll: 1,
							arrows: false,
							dots: false,
							swipe: true
						}
					},
					{
						breakpoint: 541,
						settings: {
							slidesToShow: 3,
							slidesToScroll: 1,
							arrows: false,
							dots: false,
							swipe: true
						}
					}
				]
			} );
			$( this ).next( '.slick-master__arrows' ).find( '.fa-angle-right' ).click( function() {
				$( this ).parent().prev( '.ss__images' ).slick( 'slickNext' );
			} );
			$( this ).next( '.slick-master__arrows' ).find( '.fa-angle-left' ).click( function() {
				$( this ).parent().prev( '.ss__images' ).slick( 'slickPrev' );
			} );
		} );
	};

	window.slickMultiple = function() {
		$( '.slick-master-multiple-view > .ss__images' ).each( function() {
			var toShow = $( this ).attr( 'data-show' );
			var imgHeight = $( this ).attr( 'data-img-height' );
			var sliderAutoplay = $( this ).attr( 'data-autoplay' );
			$( this ).find( 'a' ).css( 'height', imgHeight + 'px' );
			$( this ).slick( {
				dots: false,
				arrows: false,
				infinite: true,
				speed: 300,
				swipe: false,
				slidesToShow: ( toShow ? toShow : 6 ),
				slidesToScroll: 1,
				autoplay: ( ( sliderAutoplay == "Yes" ) ? true : false ),
				autoplaySpeed: 5000,
				centerMode: true,
				responsive: [
					{
						breakpoint: 1024,
						settings: {
							slidesToShow: 3,
							slidesToScroll: 1,
							infinite: true,
							arrows: false,
							dots: false
						}
					},
					{
						breakpoint: 992,
						settings: {
							slidesToShow: 2,
							slidesToScroll: 1,
							swipe: true,
							infinite: true,
							arrows: false,
							dots: false
						}
					},
					{
						breakpoint: 641,
						settings: {
							slidesToShow: 2,
							slidesToScroll: 1,
							arrows: false,
							dots: false,
							swipe: true
						}
					},
					{
						breakpoint: 541,
						settings: {
							slidesToShow: 1,
							slidesToScroll: 1,
							arrows: false,
							dots: false,
							swipe: true
						}
					}
				]
			} );
			$( this ).next( '.slick-master__arrows' ).find( '.fa-angle-right' ).click( function() {
				$( this ).parent().prev( '.ss__images' ).slick( 'slickNext' );
			} );
			$( this ).next( '.slick-master__arrows' ).find( '.fa-angle-left' ).click( function() {
				$( this ).parent().prev( '.ss__images' ).slick( 'slickPrev' );
			} );
		} );
	};

	window.slickCenter = function() {
		$( '.slick-master-centered' ).each( function() {
			$( this ).slick( {
				centerMode: true,
				slidesToShow: 3,
				focusOnSelect: true,
				centerPadding: '60px',
			} );
		} );
	};

	window.slickMisc = function() {
		$( '.side-services__slickmaster' ).slick( {
			slidesToShow: 1,
			slidesToScroll: 1,
			fade: true,
			prevArrow: "<button type='button' class='slick-prev custom-slick-arrow-1 pull-left'><i class='fa fa-arrow-left' aria-hidden='true'></i></button>",
			nextArrow: "<button type='button' class='slick-next custom-slick-arrow-1 pull-right'><i class='fa fa-arrow-right' aria-hidden='true'></i></button>"
		} );
		$( '.home-blog-slider__outer-main' ).slick( {
			slidesToShow: 1,
			slidesToScroll: 1,
			fade: true,
			prevArrow: "<button type='button' class='slick-prev custom-slick-arrow-1 pull-left'><i class='fa fa-arrow-left' aria-hidden='true'></i></button>",
			nextArrow: "<button type='button' class='slick-next custom-slick-arrow-1 pull-right'><i class='fa fa-arrow-right' aria-hidden='true'></i></button>"
		} );
		$( '.our-team-slider__slickmaster' ).slick( {
			dots: false,
			arrows: true,
			infinite: true,
			speed: 300,
			swipe: true,
			slidesToShow: 6,
			slidesToScroll: 1,
			autoplay: false,
			autoplaySpeed: 5000,
			prevArrow: "<button type='button' class='slick-prev custom-slick-arrow-1 pull-left'><i class='fa fa-caret-left' aria-hidden='true'></i></button>",
			nextArrow: "<button type='button' class='slick-next custom-slick-arrow-1 pull-right'><i class='fa fa-caret-right' aria-hidden='true'></i></button>",
			responsive: [
				{
					breakpoint: 1025,
					settings: {
						slidesToShow: 3,
						slidesToScroll: 1,
						infinite: true,
					}
				},
				{
					breakpoint: 992,
					settings: {
						slidesToShow: 2,
						slidesToScroll: 1,
						swipe: true,
						infinite: true,
					}
				},
				{
					breakpoint: 541,
					settings: {
						slidesToShow: 1,
						slidesToScroll: 1,
						swipe: true
					}
				}
			]
		} );
	};

	window.slickGallery = function( preview, nav ) {
		$( preview ).slick( {
			slidesToShow: 1,
			slidesToScroll: 1,
			fade: true,
			asNavFor: nav,
			prevArrow: "<button type='button' class='slick-prev custom-slick-arrow-1 pull-left'><i class='fa fa-chevron-left' aria-hidden='true'></i></button>",
			nextArrow: "<button type='button' class='slick-next custom-slick-arrow-1 pull-right'><i class='fa fa-chevron-right' aria-hidden='true'></i></button>"
		} );
		$( nav ).slick( {
			slidesToShow: 3,
			slidesToScroll: 1,
			asNavFor: preview,
			dots: false,
			centerMode: true,
			focusOnSelect: true,
			arrows: false
		} );
	};
/**------------- 2.2.2 Isotope -------------**/
	window.initIsotope = function() {
		// init Isotope =GALLERY
		$( '.gallery-isotopes-master > .gallery-isotopes__images' ).each( function() {
			var imgSpace = $( this ).attr( 'data-img-space' );
			var imgCount = $( this ).attr( 'data-img-count' );
			var imgHeight = $( this ).attr( 'data-img-height' );
			var $filterLinks = $( this ).find( 'a' );
			if ( imgSpace == "Yes" ) {
				$filterLinks.css( 'border', '5px solid #fff' );
			}
			if ( imgCount ) {
				$filterLinks.css( 'width', 100 / imgCount + '%' );
			}
			if ( imgHeight ) {
				$filterLinks.css( 'height', imgHeight + 'px' );
			}
			var $grid = $( this ).isotope( {
				itemSelector: '.gallery-isotope-pic',
				layoutMode: 'fitRows'
			} );
			// bind filter button click
			$( this ).parent().find( '.gallery-isotopes__filters' ).on( 'click', 'button', function() {
				var filterValue = $( this ).attr( 'data-filter' );
				$grid.isotope( {
					filter: filterValue
				} );
			} );
			$( '.gallery-isotopes__filters--select' ).on( 'change', function() {
				// get filter value from option value
				var filterValue = this.value;
				$grid.isotope( {
					filter: filterValue
				} );
			} );
			// change is-checked class on buttons
			$( this ).parent().find( '.gallery-isotopes__filters' ).each( function( i, buttonGroup ) {
				var $buttonGroup = $( buttonGroup );
				$buttonGroup.on( 'click', 'button', function() {
					$buttonGroup.find( '.is-checked' ).removeClass( 'is-checked' );
					$( this ).addClass( 'is-checked' );
				} );
			} );
		} );
	};
/**------------- 2.2.3 Init Datepickers -------------**/
	// window.initDatePickers = function(){
	//	 $("input.car-booking-day").datepicker(
	//		 {
	//			 dateFormat: 'dd-mm-yy',
	//			 minDate: new Date('') + 2,
	//			 changeMonth: true,
	//			 beforeShowDay: $.datepicker.noWeekends 
	//		 }
	//	 );
	// }
/**------------- 2.2.4 GET URL PARAMETER SAMPLE -------------**/
	// initialize this script using .load() e.g.:
	// $( window ).load(function() {
	// 		var program_cat_param = getURLParameter('pc_param');
	// 		$(".programTabsMaster__links-parent").find('.'+ program_cat_param).trigger('click');
	// });
	
	window.getURLParameter = function(name) {
		return decodeURIComponent((new RegExp('[?|&]' + name + '=' + '([^&;]+?)(&|#|;|$)').exec(location.search) || [null, ''])[1].replace(/\+/g, '%20')) || null;
   	};
/**------------- 2.2.5 Focus / Scroll to an Element -------------**/
	window.scrollToanElement = function(element) {
		$('html, body').animate({ scrollTop: $(element).offset().top }, 'slow');
	};
} )( jQuery );