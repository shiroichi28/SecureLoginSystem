/***************** Registration Page ****************/
$(document).ready(function () {
  const emailInput = $("#email");
  const mobileInput = $("#mobile");
  const passwordAlert = $("#passwordAlert");

  // Toggle password visibility
  $(".toggle-password, .ctoggle-password").click(function () {
    const input = $(this).prev('input[type="password"]');
    const icon = $(this).children("i");
    input.attr("type", input.attr("type") === "password" ? "text" : "password");
    icon.toggleClass("fa-eye fa-eye-slash");
  });

  // Verify password and confirm password match
  $("#confirmPassword").on("blur", function () {
    const password = $("#password").val();
    const confirmPassword = $("#confirmPassword").val();
    if (password != "") {
      const passwordsMatch = password === confirmPassword;

      passwordAlert.html(
        passwordsMatch ? "Passwords match" : "Passwords do not match"
      );
      passwordAlert.css("color", passwordsMatch ? "green" : "red");
    }
  });

  // Validate email on blur
  emailInput.on("blur", function () {
    validateFieldInDatabase("email", emailInput, passwordAlert);
  });

  // Validate mobile on blur
  mobileInput.on("blur", function () {
    validateFieldInDatabase("mobile", mobileInput, passwordAlert);
  });

  function validateFieldInDatabase(fieldName, input, alert) {
    $.post(
      "../action/ajax.php",
      {
        [fieldName]: input.val(),
      },
      function (result) {
        alert.toggleClass("alert", result !== "");
        alert.text(result);
      }
    );
  }
});
