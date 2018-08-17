
// Nav bar Select Lang when call specific api script
// $(function() {
//   $("#pageSelect").on("change", function() {
//   //  $("#debug").text($("#aioConceptName").val());
//     console.log("selected page is",$("#pageSelect").val());
//     var lang = $("#pageSelect").val();
//     if(lang=="/hi")
//     {
//       console.log("APP is hi");
//       app_hindi_list(lang);
//     }
//     else{
//       console.log("APP is en");
//       //app_english_list(lang);
//     }
//   }).trigger("change");
// });
// //---end*/

//selected lang page
$("#pageSelect").click(function() {

var open = $(this).data("isopen");
if(open) {
  window.location.href = $(this).val()
}
$(this).data("isopen", !open);
});
//---end*/


// Upload model app image preview
$('#file').change( function(event) {
$("#profile-img-tag").fadeIn("fast").attr('src',URL.createObjectURL(event.target.files[0]));
});

function showPreview(objFileInput) {
if (objFileInput.files[0]) {
  var fileReader = new FileReader();
  fileReader.onload = function (e) {
$(".upload-preview").attr('src', e.target.result);
  }
fileReader.readAsDataURL(objFileInput.files[0]);
}
}
//---end*/
