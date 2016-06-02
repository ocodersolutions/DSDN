// top header slider
$('.flexslider').flexslider({
	animation: "slide",
	controlNav: false,
	prevText: "",
	nextText: ""
});
// member corousel
$('#uc_carousel_testimonials').owlCarousel({
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
	loop: true,
	margin: 30,
	autoplay: true,
	autoplayTimeout: 2000,
	smartSpeed: 450,
	items: 5,
	itemsDesktop : [1199,5],
	itemsDesktopSmall : [991,4],
	itemsTablet: [768,3],
	itemsTabletSmall: [640,2],
	itemsMobile : [380,1],
});
//
$( "#accor-congvan" ).accordion({
      collapsible: true
});
// js news image
$('.parent_group_1').magnificPopup({
	delegate: ".child_group",
	type: "image",
	gallery: {
		enabled: true
	}
});
$('.parent_group_2').magnificPopup({
	delegate: ".child_group",
	type: "image",
	gallery: {
		enabled: true
	}
});
$('.parent_group_3').magnificPopup({
	delegate: ".child_group",
	type: "image",
	gallery: {
		enabled: true
	}
});
$('.parent_group_4').magnificPopup({
	delegate: ".child_group",
	type: "image",
	gallery: {
		enabled: true
	}
});
$('.parent_group_5').magnificPopup({
	delegate: ".child_group",
	type: "image",
	gallery: {
		enabled: true
	}
});
$('.parent_group_6').magnificPopup({
	delegate: ".child_group",
	type: "image",
	gallery: {
		enabled: true
	}
});
$('.parent_group_7').magnificPopup({
	delegate: ".child_group",
	type: "image",
	gallery: {
		enabled: true
	}
});
$('.parent_group_8').magnificPopup({
	delegate: ".child_group",
	type: "image",
	gallery: {
		enabled: true
	}
});