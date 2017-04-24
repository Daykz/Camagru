(function ()
	{
		var deleteComment = document.querySelectorAll(".deleteComment");

		deleteComment.forEach(function(elem, index)
		{
			elem.addEventListener("click", function (event)
			{
				event.preventDefault();
				deleteCommentaire(this);
			})
		})

		function deleteCommentaire(comment)
		{
			console.log(comment.dataset);
			//window.location.href = "deleteComment.php?commentId=" + comment.dataset.commentId;
		}
	}
)();