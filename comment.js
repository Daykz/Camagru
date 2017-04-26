(function ()
	{

		var deleteComments = document.querySelectorAll(".deleteComment");

		deleteComments.forEach(function(elem, index)
		{
			elem.addEventListener("click", function (event)
			{
				deleteCommentaire(this);
			})
		})

		function deleteCommentaire(comment)
		{
			window.location.href = "deleteComment.php?commentId=" + comment.dataset.commentId;
		}
	}
)();