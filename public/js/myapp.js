var postId = 0;

var postContentElement = null;

$(document).ready(function(){

   $('#message-alert').hide();

   if($('#add-message-alert').length) {
     $('#add-message-alert').delay(5000).fadeOut();
   }

});

$('.table').find('.edit').on('click', function(event) {
	 
	 event.preventDefault();

	 postContentElement = event.target.parentNode.parentNode.childNodes[1];



	 var postContent = postContentElement.textContent;

	 postId = event.target.parentNode.parentNode.dataset['postid'];

		 console.log(postId);
		 console.log(postContent);


	 $('#post-content').val(postContent);

	 $('#edit-modal').modal();
});

$('#modal-save').on('click', function() {
	var myUrlEdit =  urlEdit + postId;
	console.log(token);
	console.log(myUrlEdit);

	$.ajax({
	  	method: 'POST',
	  	async: true,
	  	url: myUrlEdit,
	  	data: { content: $('#post-content').val() , postId: postId, _token: token, _method: 'PUT'}
	})
	 	.done(function(msg) {
	 		// if (msg.hasOwnProperty('error')) {
				// $('#message-alert').text(msg.error]);			
				// $('#message-alert').show();
				// $('#edit-modal').modal('hide');			
				// msg = null;
				// return;
	 		// }
	 		

			console.log(msg['new_content']);

			$(postContentElement).text(msg['new_content']);
			$('#edit-modal').modal('hide');			

			$('#message-alert').text('Your Post has been updated successfully.');			
			$('#message-alert').show(0).delay(5000).fadeOut();

	});

	

});

$('.table').find('.delete').on('click', function(event) {
	postId = event.target.parentNode.parentNode.dataset['postid'];
	console.log('deleting ' + postId);
	var myUrlDelete =  urlDelete + postId;

	$.ajax({
	  	method: 'DELETE',
	  	async: true,
	  	url: myUrlDelete,
	  	data: { postId: postId, _token: token}
	})
	 	.done(function(msg) {
			//alert(msg['message']);
			$('#message-alert').text(msg['message']);			
			$('#message-alert').show(0).delay(5000).fadeOut();

			var tableRow = event.target.parentNode.parentNode.parentNode.parentNode;
			$(tableRow).remove();

	});


});