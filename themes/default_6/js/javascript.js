// jQuery Needed
// Works on top of jQuery


// Algos

// Select all checkbox Algo
function sel_all_chk_box(sel_all_id, chkbox_coll_name, this_el_id = null)
{
	if(this_el_id != null)
	{
		// Case 1 DONE
		// if this_el_id is false, then, set select all false
		if($(this_el_id).is(':checked') == false)
		{
			$(sel_all_id).prop('checked', false);
			return false;
		}
		// Case 2
		// If this_el_id is true, then loop and, check for all chkbox_coll_name, to set select_all - true or false
		// in else condition, set tr_fa to false, then break, then assign, the last value of tr_fa to select_all checkbox
		var tru_fal = null;
		if($(this_el_id).is(':checked') )
		{
			$(':checkbox[name="'+chkbox_coll_name+'"]').each( function(){
				tru_fal = $(this).is(':checked');
				if(tru_fal == false)
				{
					$(sel_all_id).prop('checked', tru_fal);
					//break;
					return false;
				}
				$(sel_all_id).prop('checked', tru_fal);
			});
			// for the moment false - JLT
			return false;
		}
	}
	// Case 3
	// If select_all is true set all true, else, set all false, loop through & set, the value of select_all
	if($(sel_all_id).is(':checked') == true || $(sel_all_id).is(':checked') == false)
	{
		tru_fal = $(sel_all_id).is(':checked');
		// Loop now
		$(':checkbox[name="'+chkbox_coll_name+'"]').each(function(){
				$(this).prop('checked', tru_fal);
		});
	}
}



// ajax Call
// Type, GET, POST
// URL
// Parameters
//~$("body").on("click", function() {
	//~console.log(this);
//~});


var h;
var f;

// Passing html as string
function getAllScriptTagsFromStr( html)
{
	script = html.match(/<script[^>]*>[^<]*<\/script>/g);
	
	// evaling script now, after appending html.
	//~eval(script);
	
	return script;
}

function appendArrOfElemsIntoAnotherElem( arrOfElemsToAppend, appendInto)
{
	$.each( arrOfElemsToAppend, function(i, v){
		$(appendInto).append(v);
	});
}

function unbindEvents()
{
	// FTM
	// Unbinding click events before ajaxCall(),
	// instead of after ajaxCall()
	$(".nav_links" ).unbind("click");
	
	// Just unbinding popstate, since we are loading all javascripts
	// we have to unbind all events & then bind them again.
	// Maybe not the best approach to load javascripts all over again, as we have to unbind all events.
	$(window).unbind("popstate");
	
}

// Now, showing fb type wait/loading icon
// and, after posting successfully, a success message.
// In ajaxCall(),  take second Param as URL's and Not Href
function ajaxCall(method, url, params_to_add_on_url, postData)
{
	
	// Adding params
	if( params_to_add_on_url )
		url = url + params_to_add_on_url;
	
	// data = {};
	data = '';
	if( postData)
		data = postData;
	
	dict = {
		type: method,
		url: url,
		data: data,
		
		success: function(html, textStatus) {
			// Since return data is coming as a string, 
			// we are parsing the html & then adding it to current pages html
			// If i do a parseHTML, then this is avoiding to send multiple requests to load all javascripts
			// if i comment this below, multiple js files will load, it will send multiple request to load multiple js.
			
			/// script = getAllScriptTagsFromStr( html);
			
			// If u want to parse HTML and then add into the page,
			// then the scripts wont load, so uncomment above line, getAllScriptTagsFromStr()
			// and below line appendArrOfElemsIntoAnotherElem()
			//~html = $.parseHTML(html);
			
			// Appending scripts
			/// appendArrOfElemsIntoAnotherElem( script, ".load-js-div");
			
			
			
			// Working
			//~$(".sabse-main").html(html);
			
			// Working with animation
			$(".sabse-main").hide(700, function () {
				$(".sabse-main").html(html).show(700);
				//~$(".sabse-main").html(html).slideDown(1000);
			});
			
		},
		
		error: function(jqXHR, textStatus, errorThrown) {
			// alert("An error occured! " + ( errorThrown ? errorThrown : jqXHR.status) );
			console.log("An error occured! " + errorThrown);
			console.log("An error occured! " +  jqXHR.status);
			
			// return false;
		}
		
	};
	
	// Unbinding some events, then they get bound back automatically, when the Javascripts Loads & Runs.
	unbindEvents();
	
	$.ajax( dict );
	return false;
}

$( function() {
	
	// Will bind itself to jquery $.ajax(),
	// and will show img everytime $.ajax is starting & 
	// will hide image everytime $.ajax has stopped
	//~$("<img src='loading.gif'/>").bind({
		//~ajaxStart: function() { $(this).show(); },
		//~ajaxStop: function() { $(this).hide(); }
	//~});
	//<img src='loading.gif'/>
	//~$(".sabse-main").bind({
		//~ajaxStart: function() { $(this).html("HI"); },
		//~ajaxStop: function() { $(this).hide(""); }
	//~});
	
	// $globals and all that other config stuff should also be getting passed to JS files.
	// hard coding the img link FTM
	$( document ).ajaxStart(function() {
		$('.sabse-main').html("<img src='themes/default_5/images/loading.gif'/>");
	}).ajaxStop(function() {
		$('.sabse-main').html("");
	});
	
	
	function getCurrLocHref()
	{
		currentHref = location.href;
		currentHref = currentHref.replace(/^.+\/([^\/]*)$/,'$1');
		
		return currentHref;
	}
	
	function addToPushState(href, currentHref)
	{
		// Now changin the browser url & string it in the browser's history stack
		if( href != currentHref)
		{
			
			// ATTENTION: !!!===THIS===!!!! // Think This is OK. popstate below needs to be checked
			// CHECK in FIREBUG, Y, 
			//  pushState in function getData() & 
			// popstate below, are firing multiple huge number of http requests
			// 100, 170, 270 requests!!!
			
			// history.pushState( ) takes 3 arguments, (right now we are using just 1 argument FTM),
			// cant add just href, add fullUrl here
			// Args: state, title, url
			//~window.history.pushState(null, null, href);
			var loc = location.href;
			//~window.history.pushState(null, null, loc);
			window.history.pushState(null, null, href);
		}
		
		return false;
	}
		
	// getData, pushState()
	//~function getData(elem)
	function getData(url)
	{
		
		//~params = '';
		moreParams = '&nonav=1';
		params = '&noheader=1' + moreParams;
		
		//~// FTM
		//~// Unbinding click events before ajaxCall(),
		//~// instead of after ajaxCall()
		//~$(".nav_links" ).unbind("click");
		
		// making the ajax call
		// Pass fullURL of page, dont pass HREF's
		ajaxCall( "GET", url, params, '' );
		
		// Now probably i can load js's, since i m unbinding click events
		// yes can call js's again, as i m unbinding click events from this object
		//~$(".nav_links" ).unbind("click");
		
		return false;
	}
	
	function checkHref_and_getData(elem)
	{
		
		// Probably now, dont even need to stopPropagation
		//~ev.preventDefault();
		//~ev.stopPropagation();
		// href, is the newHref , the new URL to Load, the new HREF to go to
		href = $( elem ).attr("href");
		currentHref = getCurrLocHref();
		
		addToPushState(href, currentHref);
		
		getData(href);
		
		return false;
	}
	
	$(".nav_links" ).click( function(ev) {
		
		//~return getData($(this));
		return checkHref_and_getData($(this));
		
		// doing preventDefault() by returning false, hopefully, it is happening.
		//~return false;
	});
	
	
	//========== pop state ============
	
	// ATTENTION: !!!===THIS===!!!!
	// pushState above is working probably fine, still chk though, 
	// popstate needs to be done Better, popstate making multiple HTTP requests
	// CHECK in FIREBUG, Y, 
	//  pushState in function getData() & 
	// popstate below, are firing multiple huge number of http requests
	// 100, 170, 270 requests!!!
	$(window).bind('popstate', function(ev) {
		
		// FTM, ".nav_links" , this has to be made Generic
		// Dont think we need to pass any elem here
		//~elem = $(".nav_links");
		
		// Now probably i can load js's, since i m unbinding click events
		// yes can call js's again, as i m unbinding click events from this object
		// New js's are coming here, therefore, unbinding the click,
		// before making the ajaxCall()
		$(".nav_links" ).unbind("click");
		
		ev.preventDefault();
		
		href = location.href;
		//addToPushState(href, currentHref);
		
		// Try to Make an ajaxCall() and maybe just avoid getData()
		// making the ajax call
		// Pass fullURL of page, dont pass HREF's
		return getData(href);
		//~return ajaxCall('GET', location.href);
		
		// Now probably i can load js's, since i m unbinding click events
		// yes can call js's again, as i m unbinding click events from this object
		//~$(".nav_links" ).unbind("click");
		
		//~return false;
	});
	
	//==========
	
	/*
	 * Submitting form ajax
	 * 
	$("form").submit( function(){
		//~console.log($(f));
		//~console.log($(f).attr('action'));
		//~console.log($(f).attr('method'));
		
		subButName = $(this).find("input[type='submit']").attr('name');
		subButVal =  $(this).find("input[type='submit']").val();
		
		/// See JS/jQ Unserialize
		/// And Unserialize forms
		/// And post.
		//~p1= $(f).find ("#post1");
		//~console.log(p1);
		
		
		f = this;
		formVals = $(f).serialize();
		formVals = formVals + '&' + subButName + '=' + subButVal;
		
		//~formVals = {};
		//~formVals[f.elements[0].name] = f.elements[0].value;
		//~formVals[subButName] = subButVal ;
		
		href = $(f).attr('action');
		
		params = '';
		//~params = '&noheader=1&nonav=1';
		
		ajaxCall( "POST", href, params, formVals );
		
		return false;
	});
	
	*/
	
	
	$(".close-parent-div").click(function(){
		// $(this).parent().fadeOut("slow");
		$(this).parent().slideToggle(700);
	});
	
	
	
	
	
});

