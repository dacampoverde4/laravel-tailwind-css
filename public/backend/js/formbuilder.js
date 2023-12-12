jQuery(document).ready(function () {

	var MaxInputs = 100; //Maximum Input Boxes Allowed
	var nameFieldCount = 0;
	var InputsWrapper = $("#InputsWrapper"); // Input Box Wrapper ID
	var x = InputsWrapper.length
	


$('select#select_btn').change(function() {
	alert('hii');
		    var sel_value = $(this).val();
	    	nameFieldCount++;
				$(InputsWrapper).append('<div>' + '<div class="name" id="InputsWrapper_0' + nameFieldCount + '">' + '<label>Answer:' + nameFieldCount + '</label>' +
					'<input type="text" name="mytext[]" id="field_' + nameFieldCount + '" placeholder="Name ' + nameFieldCount + '"/>' + '<button class="removeclass0">x</button>' +
					'<button class="addclass0">+</button>' + '<button type="button" class="addrow">+</button>'+'<br>' + '</div>' + '</div>');
				x++;
		       return false;
	});
	
	$("body").on("click", ".removeclass0", function () {
		$(this).parent('div').remove(); // To Remove Name Field
		x--;
		return false;
	});
	
	
	$("body").on("click", ".addclass0", function () {
		nameFieldCount++; // To Add More Name Fields
		$(this).parent('div').parent('div').append('<div class="name">' + '<label>Name:' + nameFieldCount + '</label>' + '<input type="text" name="mytext[]" id="field_' +
			nameFieldCount + '" placeholder="Answer ' + nameFieldCount + '"/>' + '<button class="removeclass0">x</button>' + '<button class="addclass0">+</button>' + '<br>' +
			'</div>');
		x++;
		return false;
	});
	
	$("body").on("click", ".addrow", function (e) {
		    
    	 $( "#Create" ).clone().appendTo( "#repeatfield" );
    	 
		
	});


});