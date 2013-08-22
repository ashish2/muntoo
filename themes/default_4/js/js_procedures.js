// Start(using jQuery)







// Document Ready
$( function() {
	
	col();
	
	
});



// Start(using jQuery)-


// Just JavaScript


function say667() {
	// Local variable that ends up within closure
	var num = 666;
	// Wrong
	// If we put num in outside function, it will not increment
	// as we are returning the code for inside function, 
	// and in the inner function it is not incremented.
	///num++;
	
	var sayAlert = function() { 
		// Correct
		// So, instead of incrementing in the outside function,
		// we will have to increment num in the inside function,
		// as the code for this function is going to return,
		// as a result returning the pointer to the num variable and incrementing (var num) it.
		num++;
		alert(num); 
	}
	return sayAlert;
}

s1 = say667();

///s667();
///s668();




// Just JavaScript-

















