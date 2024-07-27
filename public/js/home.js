$(window).ready(async() => {

  var el = document.getElementById('user-modal');
  var modal = new bootstrap.Modal(el);

  el.addEventListener('hidden.bs.modal', function () {
    $(this).find('form').trigger('reset');
  });

  $("#signinup,#start-now").click(function() {
    modal.show();
  });

  document.querySelector("form[name='login']").onsubmit = function (e) {
    e.preventDefault();
    this.classList.add('was-validated');

    if (this.checkValidity()) {
      $.ajax({
        method: "POST",
        url: "user/login",
        data: Object.fromEntries(new FormData(e.target))
      }).done(function() {
        modal.hide();
        location.href = 'portal';
      }).fail(function(error) {
        console.error(JSON.stringify(error));
      });
    }
  }

  document.querySelector("form[name='register']").onsubmit = function (e) {
    e.preventDefault();
    this.classList.add('was-validated');

    var password = document.getElementById("password");
    var confirmPassword = document.getElementById("confirm-password");
    var confirmPasswordInvalid = document.querySelector("#confirm-password+.custom-invalid-feedback")

    if (password.value.trim() !== confirmPassword.value.trim()) {
      confirmPassword.setCustomValidity('no match');
      confirmPasswordInvalid.style.display = 'block';
    } else {
      confirmPassword.setCustomValidity('');
      confirmPasswordInvalid.style.display = 'none';
    }

    if (this.checkValidity()) {
      $.ajax({
        method: "POST",
        url: "api/user/register",
        data: Object.fromEntries(new FormData(e.target))
      }).done(function() {
        alert('Account registered successfully!');
        modal.hide();
      }).fail(console.log);
    }
  }
})
