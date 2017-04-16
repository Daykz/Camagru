  (function()
  {
  var streaming = false,
      video        = document.querySelector('#video'),
      cover        = document.querySelector('#cover'),
      canvas       = document.querySelector('#canvas'),
      photo        = document.querySelector('#photo'),
      startbutton  = document.querySelector('#startbutton'),
      // uploadbutton  = document.querySelector('#uploadfile'),
      // width = (document.body.clientWidth) / 3,
      width = 480;
      height = 0;



  navigator.getMedia = ( navigator.getUserMedia ||
                         navigator.webkitGetUserMedia ||
                         navigator.mozGetUserMedia ||
                         navigator.msGetUserMedia);

  navigator.getMedia
  (
    {
      video: true,
      audio: false
    },



    function(stream) {
      if (navigator.mozGetUserMedia) {
        video.mozSrcObject = stream;
      } else {
        var vendorURL = window.URL || window.webkitURL;
        video.src = vendorURL.createObjectURL(stream);
      }
      video.play();
    },
    function(err)
    {
      console.log("An error occured! " + err);
    }
  );


  video.addEventListener('canplay', function(ev)
  {
    if (!streaming)
    {
      height = video.videoHeight / (video.videoWidth/width);
      video.setAttribute('width', width);
      video.setAttribute('height', height);
      streaming = true;
    }
  }, false);

  function takepicture()
  {
    var canvas = document.getElementById('canvas');
    var dataURL = canvas.toDataURL();
    canvas.width = width;
    canvas.height = height;
    canvas.getContext('2d').drawImage(video, 0, 0, width, height);
    var data = canvas.toDataURL('image/png');
    var currentSticker = startbutton.dataset.currentSticker;
    // console.log(currentSticker);
    // var phot = photo.setAttribute('src', data);
    if (currentSticker && currentSticker > 0)
    {
      var ajaxifier = new XMLHttpRequest();
      ajaxifier.open("POST", "upload.php", true);
      ajaxifier.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      ajaxifier.send("photo=" + data + "&sticker=" + currentSticker + "&titre=photo");
      window.location.href = '#openModal';
      location.reload();
    }
    else
    {
      alert("Impossible de prendre une photo sans cliquer sur une image...");
    }
    /*
    fetch("upload.php", {
      method:"post",
      headers: {"Content-Type", "application/x-www-form-urlencoded"},
      body:"photo=" + data + "&sticker=" + sticker + "&titre=photo"
    });
    */

  }


  startbutton.addEventListener('click', function(ev) {
    // console.log(startbutton.dataset);
    takepicture();
    ev.preventDefault();
  }, false);

})();

 
 // uploadfile.addEventListener('click', function(ev) {
 //    uploadFile();
 //    ev.preventDefault();
 //  }, false);  


document.addEventListener("DOMContentLoaded", function(event) { 
  var stickers = document.getElementsByClassName("sticker");
  var startbutton  = document.querySelector('#startbutton');


  for (var index = 0; index < stickers.length; index++)
  {
    var sticker = stickers[index];
    sticker.addEventListener("click", function () {
      startbutton.setAttribute("data-current-sticker", this.dataset.stickerId);
    });
  }
});
