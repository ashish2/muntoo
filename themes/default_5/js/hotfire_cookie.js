// 9 Dec 2013
// 00.29 A.M

// Hot Fire Cookie Plugin. v0.1
// Hot Fire Single Cookie Object
// HotFox

// Requires 
// jquery.js and jquery.cookie.js

(function ($) {
	
	// Defining HotFire Plugin
	// Options is a dict which will be used as settings/config for the plugin
	$.fn.hotfire = function(options) {
		// I'll do my awesome stuff here
		"use strict";
		
		// Settings
		var settings = {
			"cookieName": "LOCALHOST",
		};
		
		// add the 2 dicts into the first one
		if(options) {
			//~$.extend(this.settings, options);
			settings = $.extend({}, settings, options);
		}
		
		console.log(settings);
		
		
		function json_s(obj){
			return JSON.stringify(obj);
		}
		
		function json_p(str){
			return JSON.parse(str);
		}
		
		// Initialization function for the plugin
		this.hotfire = function() {
			//~settings.cookie = this.checkCookie();
		};
		
		// Store cookie as string type 
		// add/delete cookie as dict type
		// Add cookie
		this.add = function(key, value) {
			
			// Check for our cookie whether its present or not.
			var cookie = this.checkCookie();
			
			// if its present, 
			// read the cookie 
			// Undo the SHA1
			// & add into it, 
			// redo the SHA1
			// set/send the cookie
			// cookie should be a string
			if(cookie)
			{
				// parse the cookie which has come in string type
				cookie = JSON.parse(cookie);
				
				// Setting new values
				//~cookie.key = value;
				cookie[key] = value;
				
		//~console.log(1);
		//~// Y this IS working? Actually this shud not work, THIS also works
		//~console.log(cookie[key]);
		//~
		//~console.log(2);
		//~// Y this is NOT working? Actually this shud work, SEE why this not working?
		//~console.log(cookie.key);
		
		
				// setting the cookie again, in string format
				cookie = JSON.stringify(cookie);
				
				$.cookie(settings.cookieName, cookie);
				
			}
			// else create cookie and add into it.
			else
			{
				// Create dict of cookie
				cookie = {};
				
				//~cookie.key = value;
				cookie[key] = value;
				
				// Stringify 
				cookie = JSON.stringify(cookie);
				
				// set stringified cookie
				$.cookie(settings.cookieName, cookie);
			}
			
			return this;
		};
		
		// If cookie is set
		this.checkCookie = function () {
			
			if (settings.cookieName)
			{
				var hf_cookie = settings.cookieName;
				
				//~if( $.cookie(hf_cookie) )
					// this cookie will return undefined if cookie not present or cookie content if present
					return $.cookie(hf_cookie);
				//~else
					//~return null;
			}
			
		};
		
		// Delete Cookie
		this.del = function(key) {
			// Check for our cookie whether its present or not.
			var cookie = this.checkCookie();
			
			// parse the string type cookie
			if(cookie)
			{
				cookie = JSON.parse(cookie);
				
				//~if(cookie.key)
				if(cookie[key])
				{
					// delete
					//~delete cookie.key;
					delete cookie[key];
					
					// Stringify it
					cookie = JSON.stringify(cookie);
					
					// & write the cookie again
					$.cookie(settings.cookieName, cookie);
				}
				
			}
			
			return this;
			
		};
		
		// Return all the required objects in the plugin
		//~return {
			//~"add": this.add,
			//~"del": this.del,
		//~};
		return this;
		
	};
	
	//end-
	
	// Running the Plugin Functions
	
	
})(jQuery);

//~options = {"a": 1, "b": 2, "cookieName": "NEW"}
options = {};
$().hotfire(options);

//~$.fn.hotfire();
//~$("html").hotfire().del();



/*
 * 
(function ($) {
	$.fn.hotfire = function(options) {
		var settings = {
			"cookieName": "LOCALHOST",
		};
		function json_s(obj){
			return JSON.stringify(obj);
		}
		function json_p(str){
			return JSON.parse(str);
		}
		this.hotfire = function() {
			if(options) {
				settings = $.extend({}, settings, options);
			}
			
			
		};
		
			console.log('settings');
			console.log(settings);
		
		this.add = function(key, value) {
			var cookie = this.checkCookie();
			if(cookie)
			{
				cookie = JSON.parse(cookie);
				cookie[key] = value;
		console.log(1);
		console.log(cookie[key]);
		console.log(2);
		console.log(cookie.key);
				cookie = JSON.stringify(cookie);
				$.cookie(settings.cookieName, cookie);
				
			}
			else
			{
				cookie = {};
				cookie[key] = value;
				cookie = JSON.stringify(cookie);
				$.cookie(settings.cookieName, cookie);
			}
			return this;
		};
		this.checkCookie = function () {
			if (settings.cookieName)
			{
				var hf_cookie = settings.cookieName;
					return $.cookie(hf_cookie);
			}
		};
		this.del = function(key) {
			var cookie = this.checkCookie();
			if(cookie)
			{
				cookie = JSON.parse(cookie);
				if(cookie[key])
				{
					delete cookie[key];
					cookie = JSON.stringify(cookie);
					$.cookie(settings.cookieName, cookie);
				}
			}
			return this;			
		};
		
		return this;
	};
})(jQuery);

$().hotfire();

*/


/*

(function ($) {
	
	// Defining HotFire Plugin
	// Options is a dict which will be used as settings/config for the plugin
	$.hotfire = function(options) {
		// I'll do my awesome stuff here
		
		function json_s(obj){
			return JSON.stringify(obj);
		}
		
		function json_p(str){
			return JSON.parse(str);
		}
		
		// Initialization function for the plugin
		this.hotfire = function() {
			
			// Settings
			settings = {
				"cookieName": "localhost",
			};
			
			// add the 2 dicts into the first one
			if(options) {
				$.extend(this.settings, options);
			}
			
			this.settings.cookie = this.checkCookie();
			
		};
		
		// Return all the required objects in the plugin
		//~return {
			//~"add": this.add,
			//~"del": this.del,
		//~};
		
		return this;
		
	};
	
	// If cookie is set
	$.hotfireCheckCookie = function (){
		if (this.settings.cookieName)
		{
			var hf_cookie = this.settings.cookieName;
			
			if( $.cookie(hf_cookie) )
				return $.cookie(hf_cookie);
			else
				return null;
		}
		
	};
		
	// Store cookie as string type 
	// add/delete cookie as dict type
	// Add cookie
	$.hotfireAdd = function(key, value) {
		
		// Check for our cookie whether its present or not.
		var cookie = this.checkCookie();
		
		// if its present, 
		// read the cookie 
		// Undo the SHA1
		// & add into it, 
		// redo the SHA1
		// set/send the cookie
		// cookie should be a string
		if(cookie)
		{
			// parse the cookie which has come in string type
			cookie = JSON.parse(cookie);
			
			// Setting new values
			cookie.key = value;
			
			// setting the cookie again, in string format
			cookie = JSON.stringify(cookie);
			$.cookie(this.settings.cookieName, cookie);
			
		}
		// else create cookie and add into it.
		else
		{
			// Create dict of cookie
			cookie = {};
			cookie.key = value;
			
			// Stringify 
			cookie = JSON.stringify(cookie);
			
			// set stringified cookie
			$.cookie(this.settings.cookieName, cookie);
		}
		
		return this;
	};
		
	// Delete Cookie
	$.hotfireDel = function(key) {
		// Check for our cookie whether its present or not.
		var cookie = this.checkCookie();
		
		// parse the string type cookie
		if(cookie)
		{
			cookie = JSON.parse(cookie);
			
			if(cookie.key)
			{
				// delete
				delete cookie.key;
				
				// Stringify it
				cookie = JSON.stringify(cookie);
				
				// & write the cookie again
				$.cookie(this.settings.cookieName, cookie);
			}
			
		}
		
		return this;
	};
	
	//end-
	
	// Running the Plugin Functions
	
})(jQuery);

*/
