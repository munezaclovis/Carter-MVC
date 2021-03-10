$(document).ready(function(){
	$image_crop = $('#image_crop').croppie({
	    enableExif: true,
	    viewport: {
	        width:200,
	        height:200,
	        type:'square'
	    },
	    boundary:{
	        width:300,
	        height:300
	    }
	});

	$('#upload_image').on('change', function(){
	    var reader = new FileReader();
	    if (this.files[0].type.split('/')[0].toString() == 'image') {
	    	reader.onload = function (event) {
				$image_crop.croppie('bind', {
		            url: event.target.result
		        });
			}
			reader.readAsDataURL(this.files[0]);
	    	$('#uploadimageModal').modal('show');
	    }else{
	    	$("#ProfileError").addClass("error");
	    	$(".profile").addClass("border border-danger");
	    	$("#ProfileError").text("File is not an Image! Choose another");
	    }
	});

	$('.crop_image').click(function(event){
	    $image_crop.croppie('result', {type:'blob', format:'jpeg'}).then(function(response){
	    	formdata = new FormData();
	    	formdata.append('profile', response);
	        $.ajax({
	            url:$('.crop_image').val(),
	            type: "POST",
	            data:formdata,
	            processData: false,
    			contentType: false
    		}).done(function(data){
    			$('#uploadimageModal').modal('hide');
	            $('#debug').html(data);
	        });
	    })
	});

	$(".upload_button").on('click', function() {
       $("#upload_image").click();
    });
});

