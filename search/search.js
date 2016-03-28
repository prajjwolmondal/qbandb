$(document).ready(function(){


	$('#fullKitchen').prop("indeterminate", true);
	$('#laundry').prop("indeterminate", true);
	$('#pool').prop("indeterminate", true);
	$('#gym').prop("indeterminate", true);
	$('#sharedRm').prop("indeterminate", true);
	$('#privateRm').prop("indeterminate", true);
	$('#closeToTransit').prop("indeterminate", true);

    $('.btn').click(function(){
        var clickBtnValue = $(this).val();

        // features
        var featureIDs = ['#fullKitchen',
        				'#laundry',
        				'#pool',
        				'#gym',
        				'#sharedRm',
        				'#privateRm',
        				'#closeToTransit'
        				];

        var features = 	{
        					'full_kitchen' : -1,
        					'laundry' : -1,
        					'pool' : -1,
        					'gym' : -1,
        					'shared_room' : -1,
        					'private_room' : -1,
        					'close_to_transit' : -1
        				};
        
        var count = 0; // used to increment through featureIDs
        for (var key in features) { // go through features, check if purposely checked on or off
        	
	        val = 2;

	        if (!$(featureIDs[count]).is(":indeterminate")) { // indeterminate; show both true results and false results
	        	if ($(featureIDs[count]).is(':checked')) // show true results
	        		val = 1;
	        	else // show false results
	        		val = 0;
	        }

	        features[key] = val;
	        count++;
        }

        var ajaxurl = 'search.php',
        data =  {	'action': clickBtnValue, 'features' : features

        		};

        $.post(ajaxurl, data, function (response) {

            $('.searchResults').html(response);
            //alert(response);
        });
    });

});