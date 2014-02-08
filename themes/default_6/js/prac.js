// Start(using Backbone)
// Start(using Backbone)-


// Start(using jQuery)


//function DocumentReady()
{
	//$("#nav").text("Hello, World!");
	
}
//$(document).ready(DocumentReady);

function col()
{
	//$("#nav").css("background-color", "blue");
	//$("a").css("text-decoration", "none");
	
	/*
	//$("[title]").css("text-decoration","underline");
	
	//$("a[target!='blank']").append(" [new window]");
	//$("a[href^='http']").append(" [ new]");
	
	//$("td > ul > li").css("font-weight", "bold");
	
	//$("td > ul > li").text( function (index, oldText){
		//return "Existing text: "+oldText + ". New text: A dynamically set text at index: (#"+ index + ")";
	//});
	//var $at = $("td > ul > li");
	//$($at).addClass("bolder bluer");
	//$(".reps").prepend($("<li></li>").text("prepend() item"));
	//$("<li></li>").text("prependTo() item").prependTo($(".reps"));
	//$(".reps").append($("<li></li>").text("append() item"));
	
	// First one better and easier
	//$(".reps").before($("<li></li>").text("before item"));
	// Second one not
	//$("<li></li>").text("insertbef() item").insertBefore($(".reps"));
	
	//$(".reps").empty();
	//$(".reps").remove();
	
	$('#divTestArea2 b.more').remove();
	
	msg = "Helo";
	//$(".reps > li > a").bind("mouseover", function() {alert("hi"); } );
	$(".reps > li > a").bind("mouseover", {m:msg}, function(event) {
			msg = "Changed msg";
			//alert(event.data.m);
	});
	//alert(msg);
	
	$(".reps").bind("mousemove", function(event){
		$(this).text(event.pageX + ", " + event.pageY );
	});
	
	$(".reps > li > a").unbind("click");
	
	var div = $("<div></div>").addClass("test").text("Another box this is").css("background-color", "blue");
	$(".test").append(div);
	
	//$(".dth-wp_post > a").bind("mousemove", function(){
	$(".test").bind("mouseover", function(){
		var div2 = $(this).css("background-color", "pink");
		//alert(div);
		$(".test").append(div2);
	}).bind("mouseout", function(){
		var div3 = $(this).css("background-color", "white");
		//alert(div);
		$(".test").append(div3);
	});
	
	*/
	
}




// OOP in JS
//var ob = new Object();
function f()
{
	alert('this is : ' +this.f);
	return 'H';
}

function g()
{
	alert('this is: '+ this.g);
}

function ob()
{
	this.o = 'o';
	this.f = 'f'
	this.g = 'g';
	
	this.fa = f;
	this.ga = g;
}

//alert(ob.fa());
//obb = new ob();
//alert(obb.fa());

// OOP in JS-

/*
function a()
{
	//var mylist = ["Apple","Orange","Banana"];
	//var mylist = [ "20","3","100","50"];
	var mylist = [ 20,3,100,5000];
	mylist = mylist.sort();
	$("#form").html(mylist.join(""));
}
*/



/*
 * Difference between an Object and a Lambda function
 * the parentheses () in the end results in Object, and without the parentheses its a Lambda

var feature =(function() {
var privateThing = 'secret',
publicThing = 'not secret',
changePrivateThing = function() {
privateThing = 'super secret';
},
sayPrivateThing = function() {
console.log(privateThing);
changePrivateThing();
};
return {
publicThing : publicThing,
sayPrivateThing : sayPrivateThing
}
})();

alert(typeof feature);

feature.publicThing; // 'not secret'
feature.sayPrivateThing();

*/

/*
// jQ plugin

(function($){
	$.fn.hoverClass = function(c) {
		return this.hover(
			function() { $(this).toggleClass(c); }
		);
	};
})(jQuery);

//$('li').hoverClass('hover');
$('input').hoverClass('mun-button-default');

// jQ plugin-
*/

/*

var feature = (function() {
	var privateThing = 'secret',
	publicThing = 'not secret',
	
	changePrivateThing = function() {
		privateThing = 'super secret';
	},
	
	sayPrivateThing = function() {
		console.log(privateThing);
		changePrivateThing();
	};
	
	return {
		publicThing : publicThing,
		sayPrivateThing : sayPrivateThing
	}
})();

alert(typeof feature);

//alert(feature.publicThing); // 'not secret'
//feature.sayPrivateThing();

*/



// Document Ready
$( function() {
	
	//col();
	//a();
	
	var f = Function;
	//~console.log(f);
	//~console.log(this);
	
	
	
	
	
	
	
});



// Start(using jQuery)-


// Using Pure JS

// 1]
// Both below are Same
// Note: The First Set of Brackets in the Second One, before function, Like,  ( function(){var i=0; .... )
//~var f= function(){var i=0; return function(){return ++i}}();
//~var f= ( function(){var i=0; return function(){return ++i}} )();
//~
//~console.log( f );
//~console.log( f() );




// Using Pure JS-

















