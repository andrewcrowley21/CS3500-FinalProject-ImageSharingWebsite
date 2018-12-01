function checkPassord(){

	var pass1 = $("#pass1").val();
	var pass2 = $("#pass2").val();


	if( pass1 != pass2){
		$("#button1").html('<div style="color:red">Passwords do not match</div>');
	}

	else{
		$("#button1").html('<button type="submit" name="sign" value="sign"  class="btn btn-default">Sign Up!</button>');
	}

}

$(document).ready(function(){
	$("#pass2").keyup(checkPassord);

});

		// $("#passwordCheck").html('<button type="submit" name="sign" value="sign"  class="btn btn-default">Sign Up!</button>');
