$(function () {
  const start = moment().subtract(7, "days");
  const end = moment();

  $('input[name="daterange"]').daterangepicker(
    {
      opens: "right",
      startDate: start,
      endDate: end,
      maxDate: moment(),
      drops: "auto",
      timePicker: false,
      autoApply: true,
    },
  );

  $(".date").daterangepicker({
    timePicker: true,
    singleDatePicker: true,
    startDate: moment(),
    maxDate: moment(),
    timePicker24Hour: false,
    applyButtonClasses: "btn-warning text-light",
    drops: "auto",
    locale: {
      format: "YYYY/MM/DD HH:mm:ss",
    },
  });

  const transactionAddModalElement = document.getElementById(
    "transaction-add-modal"
  );

  const transactionAddModal = new bootstrap.Modal(transactionAddModalElement);

  transactionAddModalElement.addEventListener("hidden.bs.modal", function () {
    history.replaceState(null, null, " ");
    $(this).find("form").trigger("reset");
  });

  window.onhashchange = function () {
    if (window.location.hash === "#add") {
      transactionAddModal.show();
    }
  };

  if (window.location.hash === "#add") {
    transactionAddModal.show();
  }

  document.querySelector("form[name='add']").onsubmit = function (e) {
    e.preventDefault();
    this.classList.add("was-validated");

    if (this.checkValidity()) {
      $.ajax({
        method: "POST",
        url: "/api/transaction", //todo
        data: Object.fromEntries(new FormData(e.target)),
      }).done(function () {
        transactionAddModal.hide();
        setTimeout(() => location.reload(), 666);
      });
    }
  };

  const transactionEditModalElement = document.getElementById('transaction-edit-modal')
  const transactionEditModal = new bootstrap.Modal(transactionEditModalElement);

  $(".transaction-delete").click(function () {
    if (window.confirm("Are you sure you want to delete the transaction ?")) {
      const id = $(this).attr("data-id");
      $.ajax({
        method: "DELETE",
        url: `/api/transaction/${id}`, //todo
      }).done(function () {
        location.reload();
      });
    }
  })

  $(".transaction-edit").click(function () {
    // $("form[name='edit'] input[name='ticker']").val(res.Ticker);
    // $("form[name='edit'] input[name='quantity']").val(res.Quantity);
    // $("form[name='edit'] select[name='action']").val(res.Action);
    // $("form[name='edit'] input[name='price']").val(res.Price);
    // $("form[name='edit'] input[name='fee']").val(res.Fee);
    // $("form[name='edit'] input[name='datetime']").val(res.Datetime);
    // $("form[name='edit']").attr("action", `/api/transaction/${id}`);
    transactionEditModal.show();
    // const id = $(this).attr("data-id");
    // $.ajax({
    //   method: "GET",
    //   url: `/api/transaction/${id}`,
    // }).done(function (res) {
    //   $("form[name='edit'] input[name='ticker']").val(res.Ticker);
    //   $("form[name='edit'] input[name='quantity']").val(res.Quantity);
    //   $("form[name='edit'] select[name='action']").val(res.Action);
    //   $("form[name='edit'] input[name='price']").val(res.Price);
    //   $("form[name='edit'] input[name='fee']").val(res.Fee);
    //   $("form[name='edit'] input[name='datetime']").val(res.Datetime);
    //   $("form[name='edit']").attr("action", `/api/transaction/${id}`);
    //   transactionEditModal.show();
    // });
  })

  document.querySelector("form[name='edit']").onsubmit = function (e) {
    e.preventDefault();
    this.classList.add('was-validated');

    if (this.checkValidity()) {
      $.ajax({
        method: "PUT",
        url: $(this).attr("action"),
        data: Object.fromEntries(new FormData(e.target))
      }).done(function () {
        transactionEditModal.hide();
        location.reload();
      });
    }
  }

  $.ajax({
    url: "/json/tickers.json",
    type: "GET",
    dataType: "json",
    success: function (res) {
      $(".ticker").selectize({
        plugins: ["restore_on_backspace", "clear_button"],
        delimiter: " - ",
        persist: false,
        maxItems: 1,
        maxItems: null,
        valueField: "ticker",
        labelField: "ticker",
        searchField: ["ticker", "name", "exchange"],
        options: res,
      });
    },
  });
});
