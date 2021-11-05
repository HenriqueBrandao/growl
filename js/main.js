jQuery(document).ready(function($) {

    // clear input All if any other is selected
	$('input.filters').change(function(){
		if($(this).is(':checked')){
			$(this).parent().parent().find('.allFilters').prop("checked", false);
		}
	});

    // clear input others if All is selected
	$('input.allFilters').change(function(){
		if($(this).is(':checked')){
			$(this).parent().parent().find('.filters').prop("checked", false);
		}
	}); 


    $('.filterTop input, .filterTop select').change(function(){
        var filter = $('#filter');
        

        var data = filter.serializeArray(); 
        // Reset pagination to 1 when changing filter 
        data.push({name: "resetPagination", value: 1});

        $.ajax({
            url:filter.attr('action'),
            data: $.param(data),
            type:filter.attr('method'),
            success:function(data){
                window.scrollTo({ top: 0 });
                $('#gridPaginated').html(data);
            }
        });
        return false;
    });


    $('.paginationRadio').change(function(){
        var filter = $('#filter');
        $.ajax({
            url: filter.attr('action'),
            data: filter.serialize(), 
            type:filter.attr('method'), 

            success:function(data){
                window.scrollTo({ top: 0 });
                $('#gridPaginated').html(data); 
            }
        });
        return false;
    });



})