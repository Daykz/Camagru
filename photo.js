(function()
	{
		var deleteButtons = document.querySelectorAll(".deleteButton");

		deleteButtons.forEach(function (elem, index)
		{
			elem.addEventListener("click", function (event) {
				deletePicture(this);
			})
		})

		function  deletePicture(photo)
  		{
  			window.location.href = "deletePhoto.php?photoId=" + photo.dataset.photoId;
  		}
	}
)();