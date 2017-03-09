var postId = 0;

var postContentElement = null;

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
	urlEdit += postId;
	console.log(token);
	 console.log(urlEdit);

	 $.ajax({
	  	method: 'POST',
	  	async: true,
	  	url: urlEdit,
	  	data: { content: $('#post-content').val() , postId: postId, _token: token, _method: 'PUT'}
	  })
	 	.done(function(msg) {
			console.log(msg['message']);
	 	});

	

});
