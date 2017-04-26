(function()
	{
		var likePhotos = document.querySelectorAll(".likePhoto");

		likePhotos.forEach(function (elem, index)
		{
			elem.addEventListener("click", function (event) {
				like_photo(this);
			})
		})

		function  like_photo(photo)
  		{
  			window.location.href = "like_photo.php?likeId=" + photo.dataset.likeId;
  		}
	}
)();