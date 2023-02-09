$(document).ready(function () {
  $(".delete").on("click", function () {
    return confirm("Bạn có chắc chắn muốn xóa nhân viên này không?");
  });

  $("#pwd").on("click", function () {
    $(this).toggleClass("fa-eye fa-eye-slash");
    var input = $("#pwdinput");
    if (input.attr("type") === "password") {
      input.attr("type", "text");
    } else {
      input.attr("type", "password");
    }
    input.focus();
  });

  $("#pimg").on("click", function () {
    $("#pimgi").click();
  });
  $(".pimgedit").on("click", function () {
    $("#pimgi").click();
  });
});
