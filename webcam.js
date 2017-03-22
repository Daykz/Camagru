  

  document.getElementById("video").style.width = (document.body.clientWidth / 2)+"px";
  // document.getElementById("div_video").style.width = (document.body.clientWidth / 2)+"px";
  document.getElementById("video").removeAttribute("height");  

  var sticker;

  (function()
  {
  var streaming = false,
      video        = document.querySelector('#video'),
      cover        = document.querySelector('#cover'),
      canvas       = document.querySelector('#canvas'),
      photo        = document.querySelector('#photo'),
      startbutton  = document.querySelector('#startbutton'),
      // width = (document.body.clientWidth) / 3,
      width = 320;
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
      canvas.setAttribute('width', width);
      canvas.setAttribute('height', height);
      streaming = true;
    }
  }, false);

  function takepicture()
  {
    var canvas = document.getElementById('canvas');
    canvas.width = width;
    canvas.height = height;
    canvas.getContext('2d').drawImage(video, 0, 0, width, height);
    var data = canvas.toDataURL('image/png');
    //photo.setAttribute('src', data);
    var ajaxifier = new XMLHttpRequest();
    ajaxifier.open("POST", "upload.php", true);
    ajaxifier.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    ajaxifier.send("photo=" + data + "&sticker=" + sticker + "&titre=photo");

  }

  startbutton.addEventListener('click', function(ev)
                                        {
                                          takepicture();
                                          ev.preventDefault();
                                        }, false);



})();
