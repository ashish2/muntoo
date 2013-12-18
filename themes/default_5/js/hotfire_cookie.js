// 9 Dec 2013
// 00.29 A.M

// Hot Fire Cookie Plugin. v0.1
// Hot Fire Single Cookie Object
// HotFox

// Requires 
// jquery.js and jquery.cookie.js

// NEXt TO DO:
// 1]
// Next Add timestamp, create & delete timestamp
// In order to delete the already set key. -- DONE

// 2]
// Check cookie timestamp & new key timestamp & compare
// If there is a timestamp that is longer than the cookie expiry 
// extend the cookie expiry by that new timestamp.

// 3]
// Citation3 , start converting the dates into Unix Timestamp -- DONE

// 4]
// Now, loop through all cookies,
// and check their expire time,
// if it is more than Now(),
// then delete that [key] -- DONE

// Now
// 5]
// Encrypt-decrypt of the cookie.

// 6]
// See if the size of the cookie is not exceeding the max size of a cookie allowed on browser.


(function ($) {
	
	// Defining HotFire Plugin
	// Options is a dict which will be used as settings/config for the plugin
	$.fn.hotfire = function(options) {
		// I'll do my awesome stuff here
		
		"use strict";
		
		// Settings
		var settings = {
			"cookieName": "LOCALHOST",
			"default_Delete_Timestamp": 86500,
			"numberOfRunTimesBeforeKeyDeletes": 10, // Number of times add() function can run, before Key (cookie) deletes
			"numberOfRunTime": 0, // default numberOfRunTime to start with
			"cookieOptions": {
				expires: 180,            // cookie duration in seconds 
				domain: 'localhost.com',  // cookie domain
				path: '/',            // cookie path
				secure: false,           // cookie secure
			},
			
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
		this.hotfire = function() {
		};
		
		this.getExpiry = function(expire) {
				
				var list = [];
				var str, num, multiplier, exp;
				
				var now;
				now = this.getNow();
				
				list = expire.match(/([0-9])([a-zA-Z])/i);
				num = Number(list[1]);
				str = list[2];
				
				// multiplier by default is 1 day (86500 secs, which we are already using)
				multiplier = 1;
				
				// start regexp & get d,m,y & the integer with it, else default int = 1
				// if "d", eg. "2d"
				// then, 2 * 86500
				if( str == "d")
					multiplier = 1;
				else if(str == "m")
					// if "m" , eg. "2m"
					// then "m=30", so, 86500 * 30 * 2
					multiplier = 30;
				else if( str == "y")
					// if "y" in expire, eg. 2y
					// then, "y = 30*12" , so, 86500 * (30 * 12) * 2
					multiplier = 30 * 12;
				
				// if exp is null, set expire to default, 86500
				if(expire == null)
					exp = now + settings.default_Delete_Timestamp;
				else
				{
					// Citation3
					// Convert date here
					// assign, & start converting
					exp = now + ( num * multiplier * settings.default_Delete_Timestamp );
				}
			
			return exp;
		};
		
		this.getNow = function(){
			
			var date = new Date;
			var now = date.getTime();
			return now;
		};
		
		this.checkCookieExpiry = function(){
			
			settings.numberOfRunTime++;
			
			// It has reached 10, so start checking & delete if required, and set numberOfRunTime to 0 again
			if( settings.numberOfRunTime > settings.numberOfRunTimesBeforeKeyDeletes)
			{
				var cookie;
				cookie = JSON.parse(this.checkCookie() );
				if(cookie)
				{
					var now;
					now = this.getNow();
					
					$.each(cookie, function(k, v) { 
						if (v.expire < now) {
							delete cookie[k];
						}
					});
					
					// Stringify it
					cookie = JSON.stringify(cookie);
					// & write the cookie again
					$.cookie(settings.cookieName, cookie, { path: settings.cookieOptions.path });
					
				}
				
				settings.numberOfRunTime = 0;
			}
			
		};
		
		// Store cookie as string type 
		// add/delete cookie as dict type
		// Add cookie
		// @params: 
		// key: keyname to add
		// value: value to add
		// expire: expiry date, if null, default expiry will be used, expiry of -1 means never.
		this.add = function(key, value, expire=null) {
			
			// Check for our cookie whether its present or not.
			var cookie = this.checkCookie();
			
			// if its present,  // read the cookie 
			// Undo the SHA1 // & add into it,  // redo the SHA1
			// set/send the cookie // cookie should be a string
			if(cookie)
				// parse the cookie which has come in string type
				cookie = JSON.parse(cookie);
			else
				// else create cookie and add into it.
				// Create dict of cookie
				cookie = {};
				
				// get the time, at right Now 
				var now;
				now = this.getNow();
				
				// Get expiry date of cookie
				var exp;
				exp = this.getExpiry(expire);
				
				// Setting new values
				cookie[key] = {value: value, create: now, expire: exp};
				
				// Stringify 
				// setting the cookie again, in string format
				cookie = JSON.stringify(cookie);
				
				// set stringified cookie
				$.cookie(settings.cookieName, cookie, { path: settings.cookieOptions.path } );
				
				// Cookie Expiry Check & if required Deletion
				// checkCookieExpiry
				this.checkCookieExpiry();
				
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
		
		this.get = function(key){
			// Check for our cookie whether its present or not.
			var cookie = this.checkCookie();
			if(cookie)
			{
				cookie = JSON.parse(cookie);
				if(cookie[key])
				{
					return cookie[key];
				}
				return null;
			}
			
		}
		
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
					$.cookie(settings.cookieName, cookie, { path: settings.cookieOptions.path } );
				}
				
			}
			
			return this;
			
		};
		
		// Return all the required objects in the plugin
		return this;
		
	};
	
	//end-
	

// Running the Plugin Functions
//~options = {"a": 1, "b": 2, "cookieName": "NEW"}
options = {};
//~$.hotfire = $().hotfire(options);
$().hotfire(options);

})(jQuery);


//~$.fn.hotfire();
//~$("html").hotfire().del();





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
