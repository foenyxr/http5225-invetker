<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>INVETKER</title>
  <link rel="stylesheet" href="../public/js/lib/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="../public/css/app.css">
  <link rel="stylesheet" href="../public/css/dashboard.css">
</head>

<body class="<?php echo isset($_COOKIE['slider-collapsed']) && $_COOKIE['slider-collapsed'] == 1 ? 'closed' : '' ?>">
  <?php include_once ('resources/views/shared/modal/transaction.php') ?>
  <?php include_once ('resources/views/shared/modal/transaction.edit.php') ?>
  <header class="fixed-top d-flex">
    <a class="brand" href="index.php"></a>
    <div class="d-flex flex-grow-1 justify-content-between">
      <button type="button" id="sidebar-toggle" class="btn btn-transparent rounded-0">
        <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path
            d="M0.515491 12.8571H11.0559C11.1236 12.8572 11.1907 12.8439 11.2533 12.818C11.3158 12.7921 11.3727 12.7542 11.4206 12.7063C11.4684 12.6584 11.5064 12.6016 11.5323 12.539C11.5582 12.4764 11.5715 12.4094 11.5714 12.3417V10.8012C11.5715 10.7335 11.5582 10.6664 11.5323 10.6039C11.5064 10.5413 11.4684 10.4845 11.4206 10.4366C11.3727 10.3887 11.3158 10.3507 11.2533 10.3248C11.1907 10.299 11.1236 10.2857 11.0559 10.2857H0.515491C0.447781 10.2857 0.380725 10.299 0.318159 10.3248C0.255593 10.3507 0.198744 10.3887 0.150866 10.4366C0.102988 10.4845 0.0650191 10.5413 0.039132 10.6039C0.0132448 10.6664 -5.26798e-05 10.7335 1.56839e-07 10.8012V12.3417C-5.26798e-05 12.4094 0.0132448 12.4764 0.039132 12.539C0.0650191 12.6016 0.102988 12.6584 0.150866 12.7063C0.198744 12.7542 0.255593 12.7921 0.318159 12.818C0.380725 12.8439 0.447781 12.8572 0.515491 12.8571ZM0.515491 2.57143H11.0559C11.1236 2.57148 11.1907 2.55818 11.2533 2.5323C11.3158 2.50641 11.3727 2.46844 11.4206 2.42056C11.4684 2.37268 11.5064 2.31584 11.5323 2.25327C11.5582 2.1907 11.5715 2.12365 11.5714 2.05594V0.515491C11.5715 0.447781 11.5582 0.380725 11.5323 0.318159C11.5064 0.255593 11.4684 0.198744 11.4206 0.150866C11.3727 0.102988 11.3158 0.065019 11.2533 0.0391319C11.1907 0.0132448 11.1236 -5.26798e-05 11.0559 1.5684e-07H0.515491C0.447781 -5.26798e-05 0.380725 0.0132448 0.318159 0.0391319C0.255593 0.065019 0.198744 0.102988 0.150866 0.150866C0.102988 0.198744 0.0650191 0.255593 0.039132 0.318159C0.0132448 0.380725 -5.26798e-05 0.447781 1.56839e-07 0.515491V2.05594C-5.26798e-05 2.12365 0.0132448 2.1907 0.039132 2.25327C0.0650191 2.31584 0.102988 2.37268 0.150866 2.42056C0.198744 2.46844 0.255593 2.50641 0.318159 2.5323C0.380725 2.55818 0.447781 2.57148 0.515491 2.57143ZM17.3571 5.14286H0.642857C0.472361 5.14286 0.308848 5.21059 0.188289 5.33115C0.0677296 5.4517 1.56839e-07 5.61522 1.56839e-07 5.78571V7.07143C1.56839e-07 7.24192 0.0677296 7.40544 0.188289 7.526C0.308848 7.64656 0.472361 7.71429 0.642857 7.71429H17.3571C17.5276 7.71429 17.6912 7.64656 17.8117 7.526C17.9323 7.40544 18 7.24192 18 7.07143V5.78571C18 5.61522 17.9323 5.4517 17.8117 5.33115C17.6912 5.21059 17.5276 5.14286 17.3571 5.14286ZM17.3571 15.4286H0.642857C0.472361 15.4286 0.308848 15.4963 0.188289 15.6169C0.0677296 15.7374 1.56839e-07 15.9009 1.56839e-07 16.0714V17.3571C1.56839e-07 17.5276 0.0677296 17.6912 0.188289 17.8117C0.308848 17.9323 0.472361 18 0.642857 18H17.3571C17.5276 18 17.6912 17.9323 17.8117 17.8117C17.9323 17.6912 18 17.5276 18 17.3571V16.0714C18 15.9009 17.9323 15.7374 17.8117 15.6169C17.6912 15.4963 17.5276 15.4286 17.3571 15.4286Z"
            fill="#474747" />
        </svg>
      </button>
      <div class="d-flex align-items-center gap-3">
        <a title="Add Transaction" class="btn btn-outline-secondary d-none d-md-inline-flex align-items-center"
          href="transactions.php#add">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
            <path fill="currentColor" d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6z" />
          </svg>
          <span>Add Transactions</span>
        </a>
        <div class="dropdown h-100">
          <button class="btn btn-transparent h-100 px-3 rounded-0 d-flex gap-3 text-decoration-none align-items-center"
            type="button" data-bs-toggle="dropdown" data-bs-auto-close="true" aria-expanded="false">
            <span id="account" class="text-end d-none d-md-flex flex-column lh-sm">
              <span id="name" class="font-extrabold">Alexander, Johnson</span>
              <span id="role">Investor</span>
            </span>
            <img alt="Alexander, Johnson" class="rounded-circle"
              src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80">
          </button>
          <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item" title="Logout" href="user/logout">Logout</a></li>
          </ul>
        </div>
      </div>
    </div>
  </header>
  <aside class="fixed-top">
    <ul class="nav flex-column nav-pills">
      <li class="nav-item">
        <a class="nav-link d-flex align-items-center justify-content-center active" href="index.php">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 32 32">
            <path fill="currentColor"
              d="M16.612 2.214a1.01 1.01 0 0 0-1.242 0L1 13.419l1.243 1.572L4 13.621V26a2.004 2.004 0 0 0 2 2h20a2.004 2.004 0 0 0 2-2V13.63L29.757 15L31 13.428ZM18 26h-4v-8h4Zm2 0v-8a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v8H6V12.062l10-7.79l10 7.8V26Z" />
          </svg>
          <span>Home</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link d-flex align-items-center justify-content-center" href="transactions.php">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 20 20">
            <path fill="currentColor"
              d="M12.146 3.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L14.293 7H4.5a.5.5 0 0 1 0-1h9.793l-2.147-2.146a.5.5 0 0 1 0-.708m-4.292 7a.5.5 0 0 1 0 .708L5.707 13H15.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 0 1 .708 0" />
          </svg>
          <span>Transcations</span>
        </a>
      </li>
    </ul>
  </aside>
  <main>

    <!-- Content start -->
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
                  <!-- <span class="text-danger">-2%</span> -->
                </td>
                <td>3,442.8</td>
                <td>3,642.8</td>
                <td>172.14</td>
                <td>
                  <span class="text-success">+20.00</span>
                  <!-- <span class="text-danger">-20.00</span> -->
                </td>
                <td>
                  <span class="text-success">+20.00</span>
                  <!-- <span class="text-danger">-20.00</span> -->
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
          <?php for ($i = 1; $i < 10; $i++): ?>
            <div class="ranking d-flex align-items-end">
              <div class="no d-flex flex-column align-self-baseline">
                Top <span><?php echo $i ?></span>
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
                  2021 by Revenue Tesla Inc (Tesla) is an automotive and energy company. It designs, develops,
                  manufactures,
                  sells, and leases electric vehicles, energy generation, and storage systems. It produces and sells the
                  Model Y, Model 3, Model X, Model S, Cybertruck, Tesla Semi, and Tesla Roadster vehicles. Tesla also
                  installs and maintains energy systems, sells solar electricity; and offers end-to-end clean energy
                  products, including generation, storage, and consumption. It markets and sells vehicles to consumers
                  through company-owned stores and galleries. The company has manufacturing facilities in the US, Germany,
                  and China and has operations across the Asia Pacific and Europe. Tesla is headquartered in Austin,
                  Texas,
                  the US.</span>
                <span>POSITION: 20</span>
                <span>PRICE: 171.99</span>
                <span>
                  DAILY P&L:
                  <span class="text-success">+350.00</span>
                  <!-- <span class="text-danger">-350.00</span> -->
                </span>
                <span>
                  UNREALIZED P&L:
                  <span class="text-success">+3,500.00</span>
                  <!-- <span class="text-danger">-350.00</span> -->
                </span>
              </div>
            </div>
          <?php endfor; ?>
        </div>
      </div>
      <!-- End Top Portfolio -->

      <!-- Content end -->
  </main>
  <script src="../public/js/lib/jquery/dist/jquery.min.js"></script>
  <script src="../public/js/lib/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script type="module" src="../public/js/portal.js"></script>
  <script src="../public/js/dashboard.js"></script>
</body>

</html>