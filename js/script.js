$(document).ready(function(){
	$('[data-toggle="tooltip"]').tooltip();
});

function goBack(){
	history.back();
}


function LoadImagesToGallery(input) {
	var files = [];
    if (input.files && input.files[0]) {
    	$('.newimg').remove();
    	for(var i = 0; i < input.files.length; i++){
    		var reader = new FileReader();
	        reader.onload = function (e) {
	            $('#gallery-preview').append('<img src="' + e.target.result + '" class="rounded-50 gallery-img newimg">');
	        }
	        reader.readAsDataURL(input.files[i]);
    	}
    }
}