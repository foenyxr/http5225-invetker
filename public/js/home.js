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
    $(e.target).find('.alert-danger').addClass('d-none');

    if (this.checkValidity()) {
      $.ajax({
        method: "POST",
        url: "api/user/login.php",
        data: Object.fromEntries(new FormData(e.target))
      }).done(function() {
        modal.hide();
        location.href = 'dashboard';
      }).fail(function(err) {
        $(e.target).find('.alert-danger').html(err?.responseJSON?.errors[0]).removeClass('d-none')
      });
    }
  }

  document.getElementById("confirm-password").addEventListener("input", function () {
    const password = document.getElementById("password").value.trim();
    const confirmPassword = this.value.trim();

    if (password === confirmPassword) {
      this.setCustomValidity('');
      document.querySelector("#confirm-password+.custom-invalid-feedback").style.display = 'none';
    } else {
      this.setCustomValidity('Passwords do not match');
      document.querySelector("#confirm-password+.custom-invalid-feedback").style.display = 'block';
    }
  });

  document.querySelector("form[name='register']").onsubmit = function (e) {
    e.preventDefault();
    this.classList.add('was-validated');
    $(e.target).find('.alert-danger').addClass('d-none');

    const password = document.getElementById("password");
    const confirmPassword = document.getElementById("confirm-password");
    const confirmPasswordInvalid = document.querySelector("#confirm-password+.custom-invalid-feedback");

    if (password.value.trim() !== confirmPassword.value.trim()) {
      confirmPassword.setCustomValidity('Passwords do not match');
      confirmPasswordInvalid.style.display = 'block';
    } else {
      confirmPassword.setCustomValidity('');
      confirmPasswordInvalid.style.display = 'none';
    }

    if (this.checkValidity()) {
      $.ajax({
        method: "POST",
        url: "api/user/register.php",
        data: Object.fromEntries(new FormData(e.target))
      }).done(function() {
        alert('Account registered successfully!');
        modal.hide();
      }).fail(function(err) {
        $(e.target).find('.alert-danger').html(err?.responseJSON?.errors[0]).removeClass('d-none')
      });
    }
  }
})
