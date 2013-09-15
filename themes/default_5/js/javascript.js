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

