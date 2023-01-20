$(document).ready(function() {

            var canvas = document.getElementById('signature-pad');

            // Adjust canvas coordinate space taking into account pixel ratio,
            // to make it look crisp on mobile devices.
            // This also causes canvas to be cleared.
            function resizeCanvas() {
                // When zoomed out to less than 100%, for some very strange reason,
                // some browsers report devicePixelRatio as less than 1
                // and only part of the canvas is cleared then.
                var ratio =  Math.max(window.devicePixelRatio || 1, 1);
                canvas.width = canvas.offsetWidth * ratio;
                canvas.height = canvas.offsetHeight * ratio;
                canvas.getContext("2d").scale(ratio, ratio);
            }

            window.onresize = resizeCanvas;
            resizeCanvas();

            var signaturePad = new SignaturePad(canvas, {
              backgroundColor: 'rgb(255, 255, 255)'
                            // necessary for saving image as JPEG; can be removed is only saving as PNG or SVG
            });

document.getElementById('signbutton').addEventListener('click', function () {
  if (signaturePad.isEmpty()) {
    return alert("Please provide a signature first.");
  }
  
  //var signdata = signaturePad.toDataURL('image/png');
  //signdata =signaturePad.toDataURL("image/jpeg", 0.5);
  signdata =signaturePad.toDataURL("image/svg+xml");
 //alert(signdata);

  var pickdelid =$("#pickdelid").val();
//ajax to store the image

$.get('/forms/del_pick/upload_sign', {signdata: signdata, pickdelid: pickdelid}, function (filepath, textStatus, jqXHR) {


  //console.log(dealers_loc.dealers_loc_return);
 //alert(JSON.stringify(filepath));
//alert(signdata);
$("#hidewhensigned").hide();
$("#hideunhide").show();
//$("#hideunhide").attr("src", pickdelid + ".png"+d.getTime());
//document.getElementById("hideunhide").src=pickdelid + ".jpg";
document.getElementById("hideunhide").src=signdata;
$("#signaturesvg").val(signdata);
}
);










});




document.getElementById('clearbutton').addEventListener('click', function () {
  signaturePad.clear();
});








});