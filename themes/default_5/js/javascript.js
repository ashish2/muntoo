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
function getAllScriptTagsFromStr( html){
	script = html.match(/<script[^>]*>[^<]*<\/script>/g);
	
	// evaling script now, after appending html.
	//~eval(script);
	
	return script;
}

function appendArrOfElemsIntoAnotherElem( arrOfElemsToAppend, appendInto){
	$.each( arrOfElemsToAppend , function(i, v){
		$(appendInto).append(v);
	} );
}

// Now, showing fb type wait/loading icon
// and, after posting successfully, a success message.
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
	
	
	
	$(".nav_links" ).click( function(ev) {
		
		// Probably now, dont even need to stopPropagation
		//~ev.preventDefault();
		//~ev.stopPropagation();
		href = $( this ).attr("href");
		
		//~params = '';
		moreParams = '&nonav=1';
		params = '&noheader=1' + moreParams;
		
		// making the ajax call
		ajaxCall( "GET", href, params, '' );
		
		// Now probably i can load js's, since i m unbinding click events
		// yes can call js's again, as i m unbinding click events from this object
		$(".nav_links" ).unbind("click");
		
		// doing preventDefault() by returning false, hopefully, it is happening.
		return false;
		
	});
	
	
	
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
		$(this).parent().fadeOut("slow");
	});
	
	
	
});

