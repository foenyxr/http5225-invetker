@extends('/shared/layout/dashboard')

@section('scripts')
  <script src="/js/dashboard.js"></script>
@endsection

@section('content')
  <div class="d-inline-flex breadcrumb-wrapper align-items-center justify-content-between mb-4">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb mb-0">
        <li class="breadcrumb-item active" aria-current="page">Home</li>
      </ol>
    </nav>
  </div>

  <div class="container-fluid d-flex flex-grow-1 flex-column gap-4">
    <!-- Holdings -->
    <div id="holdings" class="card d-flex flex-column">
      <div class="title">Your Holdings</div>
      <div class="content table-thead-fixed flex-grow-1">
        <table class="table table-striped table-hover table-borderless table-thead-uppercase">
          <thead>
            <tr>
              <th scope="col">Ticker</th>
              <th scope="col">Position</th>
              <th scope="col">Price</th>
              <th scope="col">Change %</th>
              <th scope="col">Cost Basis</th>
              <th scope="col">MKTVAL</th>
              <th scope="col">AVG Price</th>
              <th scope="col">Daily P&L</th>
              <th scope="col">Unrealized P&L</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>TSLA</td>
              <td>20</td>
              <td>182.14</td>
              <td>
                <span class="text-success">+2%</span>
                {{-- <span class="text-danger">-2%</span> --}}
              </td>
              <td>3,442.8</td>
              <td>3,642.8</td>
              <td>172.14</td>
              <td>
                <span class="text-success">+20.00</span>
                {{-- <span class="text-danger">-20.00</span> --}}
              </td>
              <td>
                <span class="text-success">+20.00</span>
                {{-- <span class="text-danger">-20.00</span> --}}
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <!-- End Holdings -->

    <!-- Transactions -->
    <div id="transactions" class="card d-flex flex-column">
      <div class="title">Recent Transactions</div>
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
              <td>2024-05-13 11:20:22</td>
            </tr>
            <tr class="align-middle">
              <td>TSLA</td>
              <td>Bought</td>
              <td>10</td>
              <td>Filed</td>
              <td>172</td>
              <td>1.72</td>
              <td>2024-05-13 11:20:22</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <!-- End Transactions -->

    <!-- Top Portfolio -->
    <div id="top-portfolio" class="card d-flex flex-column">
      <div class="title">Top Portfolio Positions</div>
      <div class="content flex-grow-1 d-flex overflow-auto">
        @for ($i = 1; $i < 9; $i++)
          <div class="ranking d-flex align-items-end">
            <div class="no d-flex flex-column align-self-baseline">
              Top <span>{{ $i }}</span>
            </div>
            <img class="company-logo" alt="TLSA" aria-label="TSLA"
              src="https://upload.wikimedia.org/wikipedia/commons/thumb/e/e8/Tesla_logo.png/1200px-Tesla_logo.png">
            <div class="company-detail d-flex flex-column">
              <span class="name">TSLA</span>
              <span class="description">Overview Segment Analysis Financials Executives SWOT Analysis Locations
                Competitors Deals Filing Analytics Patents Theme Exposure Media Premium Data Product Life Cycle Factory
                Finder IT Services Contracts ICT Spend & Tech Priorities Related keylists View more Top 10 Original
                Equipment Manufacturers in the World by Market Capitalization Electric Vehicles: Leading Technology
                Companies Top 10 Automotive OEM Companies in the World in 2021 by P/E Top 9 Automotive OEMs in the US in
                2021 by Revenue Tesla Inc (Tesla) is an automotive and energy company. It designs, develops, manufactures,
                sells, and leases electric vehicles, energy generation, and storage systems. It produces and sells the
                Model Y, Model 3, Model X, Model S, Cybertruck, Tesla Semi, and Tesla Roadster vehicles. Tesla also
                installs and maintains energy systems, sells solar electricity; and offers end-to-end clean energy
                products, including generation, storage, and consumption. It markets and sells vehicles to consumers
                through company-owned stores and galleries. The company has manufacturing facilities in the US, Germany,
                and China and has operations across the Asia Pacific and Europe. Tesla is headquartered in Austin, Texas,
                the US.</span>
              <span>POSITION: 20</span>
              <span>PRICE: 171.99</span>
              <span>
                DAILY P&L:
                <span class="text-success">+350.00</span>
                {{-- <span class="text-danger">-350.00</span> --}}
              </span>
              <span>
                UNREALIZED P&L:
                <span class="text-success">+3,500.00</span>
                {{-- <span class="text-danger">-350.00</span> --}}
              </span>
            </div>
          </div>
        @endfor
      </div>
    </div>
    <!-- End Top Portfolio -->

  </div>
@endsection
