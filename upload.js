function uploadFile(event)
{
  var input = event.target,
  currentSticker = startbutton.dataset.currentSticker,
  filer = new FileReader();
  filer.onload = function()
  {
    var data = filer.result,
    ajaxifier = new XMLHttpRequest();
    if (currentSticker && currentSticker > 0)
      {
       
        ajaxifier.open("POST", "upload.php", true);
        ajaxifier.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        ajaxifier.send("photo=" + data + "&sticker=" + currentSticker + "&titre=photo");
        window.location.href = '#openModal';
        window.location.reload(true);
      }
      else
      {
        alert("Impossible de faire un montage sans cliquer sur une image...");
      }
  };
    filer.readAsDataURL(input.files[0]);
};
