// <![CDATA[
$(function() {
	// Slider
	$('#coin-slider').coinslider({width:960,height:260,opacity:1});
	
	// radius Box
	$('.topnav ul li a.top_level, .topnav ul li ul, .topnav ul li ul li a, .graybox').css({"border-radius":"6px", "-moz-border-radius":"6px", "-webkit-border-radius":"6px"});
	
});

// Cufon
Cufon.replace('h1, h2', { hover: true });

// ]]>