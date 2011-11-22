var CartItemCount = "...";
var MiniCart;

$("#mainpage").live('pageshow', function(){

	$(".ui-li").removeClass("prodclick");

	$('.productform').submit(function(evt) {
		
		evt.preventDefault();
		
		if(MiniCart)
		{
			$("#cartpanel").children().remove();
			MiniCart = false;
		}
	
		$.mobile.showPageLoadingMsg();
		$.ajax({
			url : "index.php?action=add_product&",
			dataType : "json",
			type: "POST",
			data : $(this).serialize(),
			success : function(result) {
				var currentquantity = parseInt(CartItemCount, 10);
				if(!currentquantity)
					currentquantity = 0;
			},				
			complete : function() {
				$.mobile.hidePageLoadingMsg();				

				$.ajax({
					type: "GET",
					url: "../minicart.php",
					data : { "type" : "html" },
					dataType : "html",
					cache : true,
					success:function(data){

						$("#addtocartmsg .minicartdetails").html(data);
						$("#addtocartmsg").css("top", ($(document).scrollTop() + 120) + "px");
						$("#addtocartmsg").addClass("pop in").show();
						$(document).one("click", function() { $("#addtocartmsg").hide(); } );
						
						var itemcount = $(".itemcount").html();
						$(".MiniCartQty").html(itemcount);
						if(itemcount > 0)
						$(".MiniCartQty").show();
						
						CartItemCount = itemcount;
					}
				});			


		}
		});
		evt.preventDefault();
		evt.stopPropagation();
		return false;
	});			
	
});

$("[data-role=page]").live("pagebeforehide", function() {

	$("#cat, #searchpanel, #cartpanel").hide();
	$(document).unbind(".panels");
});


$(document).ready(function() {
var CurrentIndex = 0;

if(!/addme/.test(document.cookie))
{
	//$("#bookmarkpointer").show();
}

$("#bookmarkpointer").click(function(evt) {
	$(this).remove();

	var Future = new Date();
	Future.setTime(Future.getTime()+(365*24*60*60*1000));

	document.cookie = "addme=false; domain=" + document.location.hostname + "; path=/; expires=" + Future.toGMTString() + ";";
	
	evt.preventDefault();
	evt.stopPropagation();
	
	return false;
});

$("#hero").live("swipeleft", function() {

	var swipeatall = $(".gallery-icon-list LI").size();


	CurrentIndex++;
	if(CurrentIndex >= $(".gallery-icon-list LI").length)
		CurrentIndex = 0;

	if(swipeatall) {
	loadCurrent(false);
	}

});

$("#hero").live("swiperight", function() {

	var swipeatall = $(".gallery-icon-list LI").size();

	CurrentIndex--;
	if(CurrentIndex < 0)
		CurrentIndex = Math.max($(".gallery-icon-list LI").length - 1, 0);

	if(swipeatall) {
	loadCurrent(true);
	}
	
});

function loadCurrent(reverse)
{
	var doTransition = arguments.length > 0;

	var hero = $("#hero");
	var imgToSlideOut;
	
	if(doTransition)
	{	
		imgToSlideOut = hero.clone();
		imgToSlideOut.removeAttr("id");
	
		hero.hide();
		hero.css("position", "absolute");
		hero.css("top", "0px");
		hero.attr("src", $("#galleryimg" + CurrentIndex).attr("src"));
	
		if(!hero[0].complete)
			$.mobile.showPageLoadingMsg();

		hero[0].onload = function() {
			
			hero.css("-webkit-transform", "translateX(" + (reverse ? "-" : "") + "100%)");
			hero.show();
			hero.animationComplete(function() { hero.css("-webkit-transform", ""); hero.removeClass("slide in out reverse"); });		
			hero.addClass("slide in " + (reverse ? "reverse" : ""));
			
				$.mobile.hidePageLoadingMsg();
		
		}
	
		imgToSlideOut.prependTo("#gallery");
		imgToSlideOut.css("position", "absolute");
		imgToSlideOut.css("top", "0px");
		imgToSlideOut.css("margin", "5px");
		imgToSlideOut.css("margin-left", "7px");
		imgToSlideOut.css("margin-right", "7px");
				
		imgToSlideOut.animationComplete(function() { imgToSlideOut.remove(); });	
		imgToSlideOut.addClass("slide out " + (reverse ? "reverse" : ""));
	}
	else
	{		
		hero.attr("src", $("#galleryimg" + CurrentIndex).attr("src"));	
		if(!hero[0].complete)
			$.mobile.showPageLoadingMsg();

		hero[0].onload = function() {
						
			$.mobile.hidePageLoadingMsg();
		
		}
		
	}
}


$(".gallery-icon-list A").live("click", function(evt) { 

	CurrentIndex = $(this).closest("LI").prev("LI").length;
	
	loadCurrent();

	evt.preventDefault();

});



});

$(".ui-input-clear").click(function(){
	var Link = $("#search");
	var Panel = $("#searchpanel");
	$(document.activeElement).blur();			
	Panel.one('webkitAnimationEnd', function() { Panel.hide(); });
	Panel.addClass("slidedownfrommenu in reverse");
	$(document).unbind(".panels");
	Link.removeClass("ui-btn-active");							
});

$(".url, .ui-link, .photo").live("click", function(){
	$(this).closest("li").addClass("prodclick");
});

$("#search, #categories, .carticon").live("click", function(evt) {

	evt.preventDefault();
	evt.stopPropagation();

	var Link = $(this);	
	var Panel = $("#" + {"search" : "searchpanel", "categories" : "cat", "cartlink" : "cartpanel"}[this.id]);	

	if(!Panel.is(":visible"))
	{
		var Content = $("[data-role=page] [data-role=content]");
		var ContentHeight = Content.innerHeight();

		var OtherPanels = $("#cat, #searchpanel, #cartpanel".replace("#" + Panel.attr("id"), "").replace(/^\s+|\s+$/g, "")).filter(":visible");		
		if(OtherPanels.length > 0)
		{
			OtherPanels.hide();
			$(document).unbind(".panels");
						
			Panel.removeClass("slidedownfrommenu in reverse");
			Panel.css("top", "0px");
			Panel.show();
			Panel.find("INPUT:visible:first").focus();						
		}
		else
		{
			Panel.css("top", "0px");			
			Panel.removeClass("slidedownfrommenu in reverse");
			
			if(this.id != "search")			
				Panel.addClass("slidedownfrommenu in");
	
			Panel.show();
			Panel.find("INPUT:visible:first").focus();				
		}

		if(Link.attr("id") == "cartlink")
		{
			if(!MiniCart)
			{
				$.mobile.showPageLoadingMsg();
				
				$.ajax({
					type: "GET",
					url: "../minicartview.php",
					data : { "type" : "html" },
					dataType : "html",
					cache : false,
					success:function(cart){
						Panel.children().remove();						
						Panel.html(cart);
						MiniCart = true;
						Panel.css("height", "auto");
						Panel.css("display", "block");
					},
					complete : function() {
						$.mobile.hidePageLoadingMsg();
					}
				});
			}            
		}
		
		$(document).bind("click.panels", function(evt) {
				
			if($(this).is(Link))
				return;

			if(Panel.is(evt.target) || Panel.find(evt.target).length > 0)
				return;

			if(Panel.is(":visible"))
			{
				$(document.activeElement).blur();
				Panel.one('webkitAnimationEnd', function() { Panel.hide(); });
				Panel.addClass("slidedownfrommenu in reverse");
				$(document).unbind(".panels");
				Link.removeClass("ui-btn-active");
			}
		});
			
		Panel.bind("click.panels", function(evt) {
		
			if(evt.target == Panel[0])
			{	
				$(document.activeElement).blur();			
				Panel.one('webkitAnimationEnd', function() { Panel.hide(); });
				Panel.addClass("slidedownfrommenu in reverse");
				$(document).unbind(".panels");
				Link.removeClass("ui-btn-active");	
			}
					
		});		
		
		setTimeout(function() { Link.addClass("ui-btn-active"); }, 500);
	}
	
	return false;

});
