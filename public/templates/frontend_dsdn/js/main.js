// top header slider
$('.flexslider').flexslider({
	animation: "slide",
	controlNav: false,
	prevText: "",
	nextText: ""
});
// member corousel
$('#uc_carousel_testimonials1').owlCarousel({
	items: 5,
	itemsDesktop : [1199,5],
	itemsDesktopSmall : [991,4],
	itemsTablet: [768,3],
	itemsTabletSmall: [640,2],
	itemsMobile : [380,1],
	navigation : false,
	pagination: true,
	autoPlay: true,
	autoPlaySpeed: 2000,
	autoPlayTimeout: 2000,
	autoPlayHoverPause: true
});
$('#uc_carousel_testimonials2').owlCarousel({
	items: 5,
	itemsDesktop : [1199,5],
	itemsDesktopSmall : [991,4],
	itemsTablet: [768,3],
	itemsTabletSmall: [640,2],
	itemsMobile : [380,1],
	navigation : false,
	pagination: true,
	autoPlay: true,
	autoPlaySpeed: 1000,
	autoPlayTimeout: 1000,
	autoPlayHoverPause: true
});
$('#uc_carousel_testimonials3').owlCarousel({
	items: 5,
	itemsDesktop : [1199,5],
	itemsDesktopSmall : [991,4],
	itemsTablet: [768,3],
	itemsTabletSmall: [640,2],
	itemsMobile : [380,1],
	navigation : false,
	pagination: true,
	autoPlay: true,
	autoPlaySpeed: 1500,
	autoPlayTimeout: 1500,
	autoPlayHoverPause: true
});
// main content js
$(function() {
	var icons = {
	header: "ui-icon-circle-arrow-e",
	activeHeader: "ui-icon-circle-arrow-s"
	};
	$( "#accordion" ).accordion({
		icons: icons,
		heightStyle:"content",
		active: false
	});
});
// js Logo carousel
$("#uc_customer_logo_carousel").owlCarousel({
	items: 5,
	itemsDesktop : [1199,5],
	itemsDesktopSmall : [991,4],
	itemsTablet: [768,3],
	itemsTabletSmall: [640,2],
	itemsMobile : [380,1],
	navigation : false,
	pagination: true,
	autoPlay: true,
	autoPlaySpeed: 500,
	autoPlayTimeout: 500,
	autoPlayHoverPause: true
});
//
$( "#accor-congvan" ).accordion({
      collapsible: true
});
// js news image
$('.image_group').each(function() {
    $(this).magnificPopup({
        delegate: '.child_group',
        type: 'image',
        gallery: {
          enabled:true
        }
    });
});
