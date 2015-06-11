$(function(){

	/* We initiate calendar for filter search */

	$('.forum-questions .message-item').on('click', function(){
		//var id = $(this).data('id');
		 $('.forum-questions').fadeOut("slow", function(){
		 	// window.location="/panel/question/" + id;
		 });
	});

	$('.forum-category li').on('click', function(){
		 $('.forum-answer').fadeOut("slow", function(){
		 	 window.location="forum.html"; 
		 });
	});

	if($('.forum-questions').length){
		$('.forum-questions').fadeIn("slow");
	}

	if($('.forum-answer').length){
		$('.forum-answer').fadeIn("slow");
	}
	
});


