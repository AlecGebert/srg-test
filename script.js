$("#contactForm").submit(function (event) {
  event.preventDefault();
  $("#submit").addClass("disabled");
  var name = $("#name").val();
  var email = $("#email").val();
  var message = $("#message").val();
  var phone = $("#phone").val();
  var data =
    "name=" +
    name +
    "&phone=" +
    phone +
    "&email=" +
    email +
    "&message=" +
    message;
  $.ajax({
    type: "POST",
    url: "./php/process.php",
    data: data,
    success: function (response) {
      switch (response) {
        case "Sent":
          alert("Ваше сообщение отправлено!");
          break;
        case "Failed":
          alert("Упс, что-то пошло не так");
          $("#submit").removeClass("disabled");
          break;
      }
    },
  });
});
