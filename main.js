$(document).ready(function() {
	$( window ).scroll(function() {
		if($(window).scrollTop()>300){
			$(".navbar").addClass("fixed-top");
			$(".navbar").addClass("container");
		}else{
			$(".navbar").removeClass("fixed-top");
			$(".navbar").removeClass("container");
		}
	});
	$(".card").mouseover(function() {
		//$(this).find(".btn").css("color","black");
		$(this).find(".btn").css('background','url("./img/cart-icon-28356.png") no-repeat left center / 20px,20px,red');
		$(this).find(".btn").css('color','black');
	});
	$(".card").mouseout(function() {
		$(this).find(".btn").css("background","red");
		$(this).find(".btn").css('color','white');
	});
	$("#upbtn").click(function(){
		$('html, body').animate({scrollTop:0}, 500, 'swing');
	});
});