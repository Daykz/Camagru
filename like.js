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


(function()
	{
		var likePhotos = document.querySelectorAll(".dislikePhoto");

		likePhotos.forEach(function (elem, index)
		{
			elem.addEventListener("click", function (event) {
				dislike_photo(this);
			})
		})

		function  dislike_photo(photo)
  		{
  			window.location.href = "dislike_photo.php?likeId=" + photo.dataset.likeId;
  		}
	}
)();
