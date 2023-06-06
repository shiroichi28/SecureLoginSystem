$(document).ready(function () {
    const passwordInput = $('input[name="password"]');
    const cpasswordInput = $('input[name="confirmPassword"]');
    const emailInput = $("#email");
    const mobileInput = $("#mobile");
    const emailAlert = $("#emailAlert");
    const mobileAlert = $("#mobileAlert");
    const submitButton = $("#submitButton");
  
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
  
      const passwordsMatch = password === confirmPassword;
      const passwordAlert = $("#passwordAlert");
  
      passwordAlert.html(passwordsMatch ? "Passwords match" : "Passwords do not match");
      passwordAlert.css("color", passwordsMatch ? "green" : "red");
    });
  
    // Validate email on blur
    emailInput.on("blur", function () {
      validateFieldInDatabase("email", emailInput, emailAlert);
    });
  
    // Validate mobile on blur
    mobileInput.on("blur", function () {
      validateFieldInDatabase("mobile", mobileInput, mobileAlert);
    });
  
    // Disable submit button if there are alerts
    $("#confirmPassword, #email, #mobile").on("blur", function () {
      const hasEmailAlert = emailAlert.hasClass("alert");
      const hasMobileAlert = mobileAlert.hasClass("alert");
  
      submitButton.prop("disabled", hasEmailAlert || hasMobileAlert);
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
  
    // Disable submit button initially
    submitButton.prop("disabled", true);
  });
  