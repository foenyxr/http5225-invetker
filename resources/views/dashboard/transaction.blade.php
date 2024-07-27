@extends('/shared/layout/dashboard')

@section('styles')
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css">
  <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/css/selectize.bootstrap5.min.css">
  <link rel="stylesheet" href="/css/transactions.css">
@endsection

@section('scripts')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.30.1/moment.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/js/selectize.min.js"></script>
  <script src="/js/transactions.js"></script>
@endsection

@section('content')
  @include('/shared/modal/transaction')
  @include('/shared/modal/transaction-edit')
  <div class="d-inline-flex breadcrumb-wrapper align-items-center justify-content-between mb-4">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb mb-0">
        <li class="breadcrumb-item active" aria-current="page">Transactions</li>
      </ol>
    </nav>
    <a title="Add Transaction" class="btn btn-sm btn-outline-secondary d-flex d-md-none align-items-center"
      href="/dashboard/transactions#add">
      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
        <path fill="currentColor" d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6z" />
      </svg>
      <span>Add Transactions</span>
    </a>
  </div>
  <div class="container-fluid d-flex flex-grow-1 flex-column">
    <form name="search" class="row mb-4 gap-3 align-items-center">
      <div class="col-12 col-xl-3 d-flex gap-3">
        <label class="col-form-label" for="daterange">Date</label>
        <div class="input-group w-100" id="daterangepicker">
          <input type="text" class="form-control" id="daterange" name="daterange">
          <span class="input-group-text bg-light">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24">
              <path fill="#c3c3c3" d="M12 12h5v5h-5zm7-9h-1V1h-2v2H8V1H6v2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2m0 2v2H5V5zM5 19V9h14v10z" />
            </svg>
          </span>
        </div>
      </div>
      <div class="col-12 col-xl-3 d-flex gap-3">
        <label class="col-form-label">Ticker</label>
        <input name="ticker" class="ticker w-100">
      </div>
      <div class="col-auto">
        <button type="submit" class="btn btn-warning px-3 text-light">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
            <path fill="currentColor"
              d="m21 19l-5.154-5.154a7 7 0 1 0-2 2L19 21zM5 10c0-2.757 2.243-5 5-5s5 2.243 5 5s-2.243 5-5 5s-5-2.243-5-5" />
          </svg>
          <span class="ms-1">Search</span>
        </button>
      </div>
    </form>

    <div id="transactions" class="card flex-grow-1">
      <div class="title">Transactions</div>
      <div class="content table-thead-fixed flex-grow-1">
        <table class="table table-striped table-hover table-borderless table-thead-uppercase">
          <thead>
            <tr>
              <th scope="col">Ticker</th>
              <th scope="col">Action</th>
              <th scope="col">Quantity</th>
              <th scope="col">Price</th>
              <th scope="col">Fee</th>
              <th scope="col">Amount</th>
              <th scope="col">Date Time</th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody>
            <tr class="align-middle">
              <td>TSLA</td>
              <td>Bought</td>
              <td>10</td>
              <td>Filed</td>
              <td>172</td>
              <td>1.72</td>
              <td>2024-05-13 14:20:22</td>
              <td>
                <button data-id="22" type="button" class="btn btn-link btn-sm transaction-edit text-secondary">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <path fill="currentColor" d="m18.988 2.012l3 3L19.701 7.3l-3-3zM8 16h3l7.287-7.287l-3-3L8 13z" />
                    <path fill="currentColor"
                      d="M19 19H8.158c-.026 0-.053.01-.079.01c-.033 0-.066-.009-.1-.01H5V5h6.847l2-2H5c-1.103 0-2 .896-2 2v14c0 1.104.897 2 2 2h14a2 2 0 0 0 2-2v-8.668l-2 2z" />
                  </svg>
                </button>
                <button data-id="22" type="button" class="btn btn-link btn-sm transaction-delete text-secondary">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <path fill="currentColor"
                      d="M7 21q-.825 0-1.412-.587T5 19V6H4V4h5V3h6v1h5v2h-1v13q0 .825-.587 1.413T17 21zM17 6H7v13h10zM9 17h2V8H9zm4 0h2V8h-2zM7 6v13z" />
                  </svg>
                </button>
              </td>
            </tr>
            <tr class="align-middle">
              <td>TSLA</td>
              <td>Bought</td>
              <td>10</td>
              <td>Filed</td>
              <td>172</td>
              <td>1.72</td>
              <td>2024-05-13 11:20:22</td>
              <td>
                <button data-id="22" type="button" class="btn btn-link btn-sm transaction-edit text-secondary">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <path fill="currentColor" d="m18.988 2.012l3 3L19.701 7.3l-3-3zM8 16h3l7.287-7.287l-3-3L8 13z" />
                    <path fill="currentColor"
                      d="M19 19H8.158c-.026 0-.053.01-.079.01c-.033 0-.066-.009-.1-.01H5V5h6.847l2-2H5c-1.103 0-2 .896-2 2v14c0 1.104.897 2 2 2h14a2 2 0 0 0 2-2v-8.668l-2 2z" />
                  </svg>
                </button>
                <button data-id="22" type="button" class="btn btn-link btn-sm transaction-delete text-secondary">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <path fill="currentColor"
                      d="M7 21q-.825 0-1.412-.587T5 19V6H4V4h5V3h6v1h5v2h-1v13q0 .825-.587 1.413T17 21zM17 6H7v13h10zM9 17h2V8H9zm4 0h2V8h-2zM7 6v13z" />
                  </svg>
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection
