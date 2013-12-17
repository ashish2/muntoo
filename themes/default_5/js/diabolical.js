// 16 Dec 2013
// 00.22 A.M

// Diabolical.js v0.1

// Requires 
// jquery.js

// NEXt TO DO:


(function ($) {
	
	$.fn.diabolical = function(options) {
		// I'll do my awesome stuff here
		"use strict";
		
		// Settings
		var settings = {
		};
		
		// add the 2 dicts into the first one
		if(options) {
			settings = $.extend({}, settings, options);
		}
		
		// Not used ATM
		this.json_s = function(obj){
			return JSON.stringify(obj);
		}
		
		// Not used ATM
		this.json_p = function(str){
			return JSON.parse(str);
		}
		
		// Some Initialization function for the plugin
		this.diabolical = function() {
		};
		
		
		
		//~$(".nav").find("tbody").find("tr").find("td").on("mouseenter", function() { t = $(this); console.log(t); console.log(t.position()); console.log(t.position().top); console.log(t.position().left); console.log(t.height()); console.log(t.width());  } );
		
		//~$(".nav").find("tbody").find("tr").find("td").on("mouseenter", function() { t = $(this); console.log(t); console.log(t.position()); console.log(t.position().top-5); console.log(t.position().left-5); console.log(t.height()); console.log(t.width());  } );
		
		//~$(".nav").find("tbody").find("tr").find("td").on("mouseenter", function() { t = $(this); console.log(t); obj={}; obj.pos = t.position(); obj.top = pos.top-5; obj.left = t.position().left-5; obj.height = t.height(); obj.width = t.width(); console.log(obj); } );
		
		
		
	};
	
	//end-
	

// Running the Plugin Functions
//~options = {"a": 1, "b": 2, "cookieName": "NEW"}
options = {};
//~$.diabolical = $().diabolical(options);

})(jQuery);

