$(function () {
  let tickerSelector;

  const url = new URL(window.location.href);
  const params = new URLSearchParams(url.search);

  const start = (
    params.get('start') && moment(params.get('start')) ?
      moment(params.get('start')) :
      moment().subtract(7, "days").startOf('day')
  );

  const end = (
    params.get('end') && moment(params.get('end')) ?
      moment(params.get('end')) :
      moment().endOf('day')
  );

  // transactions page
  $('input[name="start"]').val(start.format('YYYY-MM-DD'));
  $('input[name="end"]').val(end.format('YYYY-MM-DD'));
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
  ).on('apply.daterangepicker', function(ev, picker) {
    $('input[name="start"]').val(picker.startDate.format('YYYY-MM-DD'));
    $('input[name="end"]').val(picker.endDate.format('YYYY-MM-DD'));
  });

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
        url: "../api/transaction/create.php",
        data: Object.fromEntries(new FormData(e.target)),
      }).done(function () {
        transactionAddModal.hide();
        setTimeout(() => location.reload(), 888);
      });
    }
  };

  const transactionEditModalElement = document.getElementById('transaction-edit-modal')
  const transactionEditModal = new bootstrap.Modal(transactionEditModalElement);

  $(".transaction-delete").click(function () {
    if (window.confirm("Are you sure you want to delete the transaction ?")) {
      const id = $(this).attr("data-id");
      $.ajax({
        url: `../api/transaction/delete.php?id=${id}`,
      }).done(function () {
        location.reload();
      });
    }
  })

  $(".transaction-edit").click(function () {
    transactionEditModal.show();
    const id = $(this).attr("data-id");
    $.ajax({
      method: "GET",
      url: `../api/transaction/index.php?id=${id}`,
    }).done(function (res) {
      const { ticker, quantity, action, price, fee, datetime } = res.data;
      $("form[name='edit'] input[name='ticker']").val(ticker);
      $("form[name='edit'] input[name='quantity']").val(quantity);
      $("form[name='edit'] select[name='action']").val(action);
      $("form[name='edit'] input[name='price']").val(price);
      $("form[name='edit'] input[name='fee']").val(fee);
      $("form[name='edit'] input[name='datetime']").val(datetime);
      $("form[name='edit']").attr("action", `../api/transaction/update.php?id=${id}`);
      transactionEditModal.show();
    });
  })

  document.querySelector("form[name='edit']").onsubmit = function (e) {
    e.preventDefault();
    this.classList.add('was-validated');

    if (this.checkValidity()) {
      $.ajax({
        method: "POST",
        url: $(this).attr("action"),
        data: Object.fromEntries(new FormData(e.target))
      }).done(function () {
        transactionEditModal.hide();
        location.reload();
      });
    }
  }

  document.querySelector("form[name='search']").onsubmit = function (e) {
    e.preventDefault();
    const formData = Object.fromEntries(new FormData(e.target));
    location.href = `transactions.php?start=${formData.start}&end=${formData.end}&ticker=${formData.ticker}`;
  }

  $.ajax({
    url: "../public/json/tickers.json",
    type: "GET",
    dataType: "json",
    success: function (res) {
      tickerSelector = $(".ticker").selectize({
        plugins: ["autofill_disable"],
        persist: false,
        closeAfterSelect: true,
        emptyOptionLabel: "-",
        maxItems: 1,
        maxOptions: 99999,
        valueField: "ticker",
        labelField: "ticker",
        searchField: ["ticker", "name", "exchange"],
        options: res,
      });

      if (params.get('ticker')) {
        Array.from(tickerSelector).map((i, idx) => {
          if ($(i.parentElement.parentElement).attr("name") === 'search') {
            tickerSelector[idx].selectize.setValue(params.get('ticker'));
          }
        })
      }
    },
  });
});
