$(document).ready(function() {
  $("img").click(function() {
    $src = $(this).attr("src");
    if (!$("#light-box").length > 0) {
      $("body").append("<div id='light-box'><span class='material-icons'>close</span><img src=''></div>");
      $("#light-box").show();
      $("#light-box img").attr("src", $src);
    } else {
      $("#light-box").show();
      $("#light-box img").attr("src", $src);
    }
  });
  $("body").on("click", "#light-box span", function() {
    $("#light-box").hide();
  });
});