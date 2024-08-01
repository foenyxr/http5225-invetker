<?php
require_once(__DIR__ . '/../shared/isLoggedin.php');
require_once(__DIR__ . '/../database/index.php');
require_once(__DIR__ . '/../vendor/autoload.php');

use Scheb\YahooFinanceApi\ApiClientFactory;

$client = ApiClientFactory::createApiClient();

$POLYGON = 'https://api.polygon.io/';
$API_KEY = 'wnoNdymQNypqwkKazeJLbnZRUMS27Fzp';

// TRANSACTIONS
$sql = "SELECT * FROM transactions WHERE userId = ? LIMIT 20";
$stmt = mysqli_prepare($connect, $sql);

mysqli_stmt_bind_param($stmt, "s", $_SESSION['user']['id']);
mysqli_stmt_execute($stmt);

$transactions = mysqli_fetch_all(
  mysqli_stmt_get_result($stmt),
  MYSQLI_ASSOC
);

// HOLDINGS
$sql = "SELECT SUM(price * quantity + fee) AS amount, ticker, action, SUM(quantity) AS quantity FROM transactions WHERE userId = ? GROUP BY ticker, action";
$stmt = mysqli_prepare($connect, $sql);

mysqli_stmt_bind_param($stmt, "s", $_SESSION['user']['id']);
mysqli_stmt_execute($stmt);

$_transactions = mysqli_fetch_all(
  mysqli_stmt_get_result($stmt),
  MYSQLI_ASSOC
);

$allTickers = [];
$holdings = [];
$quotes = [];

foreach ($_transactions as $transaction) {
  $ticker = $transaction['ticker'];
  $quantity = $transaction['quantity'];
  $amount = $transaction['amount'];
  $action = $transaction['action'];

  if (!isset($holdings[$ticker])) {
    $holdings[$ticker] = [
      "ticker" => $ticker,
      "quantity" => 0,
      "cost" => 0,
      "price" => 0,
      "change" => 0,
      "changePercent" => 0,
      "dailypl" => 0,
      "unrealizedpl" => 0,
      "logo" => '../public/images/brand.svg',
      "description" => 'Too Many Requests, the free plan only allows 5 requests per minute.'
    ];
    $allTickers[] = $ticker;
  }

  // Update holdings based on the action
  if ($action === 'Bought') {
    $holdings[$ticker]['quantity'] += $quantity;
    $holdings[$ticker]['cost'] += $amount;
  } elseif ($action === 'Sold') {
    $holdings[$ticker]['quantity'] -= $quantity;
    $holdings[$ticker]['cost'] -= $amount;
  }
}

// Fetch quotes
if (!empty($allTickers)) {
  $client = ApiClientFactory::createApiClient();
  $quotes = $client->getQuotes($allTickers);
}

$quotesAssoc = [];
foreach ($quotes as $quote) {
  $quotesAssoc[$quote->getSymbol()] = $quote;
}

// Update data for holdings
foreach ($holdings as $ticker => $holding) {
  $quantity = floatval($holding['quantity']);

  if ($quantity <= 0) {
    unset($holdings[$ticker]);
  } else {
    if (isset($quotesAssoc[$ticker])) {
      $quote = $quotesAssoc[$ticker];
      $price = $quote->getAsk();
      $marketChange = $quote->getRegularMarketChange();

      $holdings[$ticker]['price'] = $price;
      $holdings[$ticker]['change'] = $marketChange;
      $holdings[$ticker]['changePercent'] = $quote->getRegularMarketChangePercent();
      $holdings[$ticker]['dailypl'] = $marketChange * $quantity;
      $holdings[$ticker]['unrealizedpl'] = $price * $quantity - $holding['cost'];

      // Fetch additional data
      $data = @file_get_contents($POLYGON . 'v3/reference/tickers/' . $ticker . '?apiKey=' . $API_KEY);
      if ($data) {
        $decodedData = json_decode($data, true);
        if ($decodedData['status'] === 'OK' && isset($decodedData['results'])) {
          $holdings[$ticker]['logo'] = $decodedData['results']['branding']['logo_url'];
          $holdings[$ticker]['description'] = $decodedData['results']['description'];
        }
      }
    }
  }
}

$top = $holdings;
usort($top, function ($a, $b) {
  return $b['unrealizedpl'] <=> $a['unrealizedpl'];
});

?>
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
  <?php include_once(__DIR__ . '/../resources/views/shared/modal/transaction.php') ?>
  <?php include_once(__DIR__ . '/../resources/views/shared/modal/transaction.edit.php') ?>
  <header class="fixed-top d-flex">
    <a title="INVETKER" class="brand" href="index.php"></a>
    <div class="d-flex flex-grow-1 justify-content-between">
      <button type="button" id="sidebar-toggle" class="btn btn-transparent rounded-0">
        <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M0.515491 12.8571H11.0559C11.1236 12.8572 11.1907 12.8439 11.2533 12.818C11.3158 12.7921 11.3727 12.7542 11.4206 12.7063C11.4684 12.6584 11.5064 12.6016 11.5323 12.539C11.5582 12.4764 11.5715 12.4094 11.5714 12.3417V10.8012C11.5715 10.7335 11.5582 10.6664 11.5323 10.6039C11.5064 10.5413 11.4684 10.4845 11.4206 10.4366C11.3727 10.3887 11.3158 10.3507 11.2533 10.3248C11.1907 10.299 11.1236 10.2857 11.0559 10.2857H0.515491C0.447781 10.2857 0.380725 10.299 0.318159 10.3248C0.255593 10.3507 0.198744 10.3887 0.150866 10.4366C0.102988 10.4845 0.0650191 10.5413 0.039132 10.6039C0.0132448 10.6664 -5.26798e-05 10.7335 1.56839e-07 10.8012V12.3417C-5.26798e-05 12.4094 0.0132448 12.4764 0.039132 12.539C0.0650191 12.6016 0.102988 12.6584 0.150866 12.7063C0.198744 12.7542 0.255593 12.7921 0.318159 12.818C0.380725 12.8439 0.447781 12.8572 0.515491 12.8571ZM0.515491 2.57143H11.0559C11.1236 2.57148 11.1907 2.55818 11.2533 2.5323C11.3158 2.50641 11.3727 2.46844 11.4206 2.42056C11.4684 2.37268 11.5064 2.31584 11.5323 2.25327C11.5582 2.1907 11.5715 2.12365 11.5714 2.05594V0.515491C11.5715 0.447781 11.5582 0.380725 11.5323 0.318159C11.5064 0.255593 11.4684 0.198744 11.4206 0.150866C11.3727 0.102988 11.3158 0.065019 11.2533 0.0391319C11.1907 0.0132448 11.1236 -5.26798e-05 11.0559 1.5684e-07H0.515491C0.447781 -5.26798e-05 0.380725 0.0132448 0.318159 0.0391319C0.255593 0.065019 0.198744 0.102988 0.150866 0.150866C0.102988 0.198744 0.0650191 0.255593 0.039132 0.318159C0.0132448 0.380725 -5.26798e-05 0.447781 1.56839e-07 0.515491V2.05594C-5.26798e-05 2.12365 0.0132448 2.1907 0.039132 2.25327C0.0650191 2.31584 0.102988 2.37268 0.150866 2.42056C0.198744 2.46844 0.255593 2.50641 0.318159 2.5323C0.380725 2.55818 0.447781 2.57148 0.515491 2.57143ZM17.3571 5.14286H0.642857C0.472361 5.14286 0.308848 5.21059 0.188289 5.33115C0.0677296 5.4517 1.56839e-07 5.61522 1.56839e-07 5.78571V7.07143C1.56839e-07 7.24192 0.0677296 7.40544 0.188289 7.526C0.308848 7.64656 0.472361 7.71429 0.642857 7.71429H17.3571C17.5276 7.71429 17.6912 7.64656 17.8117 7.526C17.9323 7.40544 18 7.24192 18 7.07143V5.78571C18 5.61522 17.9323 5.4517 17.8117 5.33115C17.6912 5.21059 17.5276 5.14286 17.3571 5.14286ZM17.3571 15.4286H0.642857C0.472361 15.4286 0.308848 15.4963 0.188289 15.6169C0.0677296 15.7374 1.56839e-07 15.9009 1.56839e-07 16.0714V17.3571C1.56839e-07 17.5276 0.0677296 17.6912 0.188289 17.8117C0.308848 17.9323 0.472361 18 0.642857 18H17.3571C17.5276 18 17.6912 17.9323 17.8117 17.8117C17.9323 17.6912 18 17.5276 18 17.3571V16.0714C18 15.9009 17.9323 15.7374 17.8117 15.6169C17.6912 15.4963 17.5276 15.4286 17.3571 15.4286Z" fill="#474747" />
        </svg>
      </button>
      <div class="d-flex align-items-center gap-3">
        <a title="Add Transaction" class="btn btn-outline-secondary d-none d-md-inline-flex align-items-center" href="transactions.php#add">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
            <path fill="currentColor" d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6z" />
          </svg>
          <span>Add Transactions</span>
        </a>
        <div class="dropdown h-100">
          <button class="btn btn-transparent h-100 px-3 rounded-0 d-flex gap-3 text-decoration-none align-items-center" type="button" data-bs-toggle="dropdown" data-bs-auto-close="true" aria-expanded="false">
            <span id="account" class="text-end d-none d-md-flex flex-column lh-sm">
              <span id="name" class="font-extrabold">
                <?php echo $_SESSION['user']['name'] ?>
              </span>
              <span id="role">
                <?php echo $_SESSION['user']['role'] ?>
              </span>
            </span>
            <?php
            $email = $_SESSION['user']['email'];
            $default = "https://upload.wikimedia.org/wikipedia/commons/thumb/4/45/Person_icon_%28the_Noun_Project_2817719%29.svg/32px-Person_icon_%28the_Noun_Project_2817719%29.svg.png";
            $size = 40;
            $grav_url = "https://www.gravatar.com/avatar/" . hash("sha256", strtolower(trim($email))) . "?d=" . urlencode($default) . "&s=" . $size;
            ?>
            <img alt="<?php echo $_SESSION['user']['name'] ?>" class="rounded-circle" src="<?php echo $grav_url ?>">
          </button>
          <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item" title="Logout" href="../api/user/logout.php">Logout</a></li>
          </ul>
        </div>
      </div>
    </div>
  </header>
  <aside class="fixed-top">
    <ul class="nav flex-column nav-pills">
      <li class="nav-item">
        <a title="Home" class="nav-link d-flex align-items-center justify-content-center active" href="index.php">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 32 32">
            <path fill="currentColor" d="M16.612 2.214a1.01 1.01 0 0 0-1.242 0L1 13.419l1.243 1.572L4 13.621V26a2.004 2.004 0 0 0 2 2h20a2.004 2.004 0 0 0 2-2V13.63L29.757 15L31 13.428ZM18 26h-4v-8h4Zm2 0v-8a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v8H6V12.062l10-7.79l10 7.8V26Z" />
          </svg>
          <span>Home</span>
        </a>
      </li>
      <li class="nav-item">
        <a title="Transcations" class="nav-link d-flex align-items-center justify-content-center" href="transactions.php">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 20 20">
            <path fill="currentColor" d="M12.146 3.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L14.293 7H4.5a.5.5 0 0 1 0-1h9.793l-2.147-2.146a.5.5 0 0 1 0-.708m-4.292 7a.5.5 0 0 1 0 .708L5.707 13H15.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 0 1 .708 0" />
          </svg>
          <span>Transcations</span>
        </a>
      </li>
      <?php if ($_SESSION['user']['role'] === 'Admin') : ?>
        <li class="nav-item">
          <a title="About" class="nav-link d-flex align-items-center justify-content-center" href="about.php">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
              <path fill="currentColor" d="M11 9h2V7h-2m1 13c-4.41 0-8-3.59-8-8s3.59-8 8-8s8 3.59 8 8s-3.59 8-8 8m0-18A10 10 0 0 0 2 12a10 10 0 0 0 10 10a10 10 0 0 0 10-10A10 10 0 0 0 12 2m-1 15h2v-6h-2z" />
            </svg>
            <span>About</span>
          </a>
        </li>
      <?php endif; ?>
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
              <?php foreach ($holdings as $holding) : ?>
                <tr>
                  <td><?php echo $holding['ticker'] ?></td>
                  <td><?php echo number_format($holding['quantity'], 2, '.', ',') ?></td>
                  <td><?php echo number_format($holding['price'], 2, '.', ',') ?></td>
                  <td>
                    <span class="<?php echo $holding['changePercent'] >= 0 ? 'text-success' : 'text-danger' ?>">
                      <?php echo $holding['changePercent'] >= 0 ? '+' : '';
                      echo number_format($holding['changePercent'], 2, '.', ',') ?>%
                    </span>
                  </td>
                  <td><?php echo number_format($holding['cost'], 2, '.', ',') ?></td>
                  <td><?php echo number_format($holding['price'] * $holding['quantity'], 2, '.', ',') ?></td>
                  <td><?php echo number_format($holding['cost'] / $holding['quantity'], 2, '.', ',') ?></td>
                  <td>
                    <span class="<?php echo $holding['dailypl'] >= 0 ? 'text-success' : 'text-danger' ?>">
                      <?php echo $holding['dailypl'] >= 0 ? '+' : '';
                      echo number_format($holding['dailypl'], 2, '.', ',') ?>
                    </span>
                  </td>
                  <td>
                    <span class="<?php echo $holding['unrealizedpl'] >= 0 ? 'text-success' : 'text-danger' ?>">
                      <?php echo $holding['unrealizedpl'] >= 0 ? '+' : '';
                      echo number_format($holding['unrealizedpl'], 2, '.', ',') ?>
                    </span>
                  </td>
                </tr>
              <?php endforeach; ?>
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
              <?php foreach ($transactions as $i) : ?>
                <tr class="align-middle">
                  <td><?php echo $i['ticker'] ?></td>
                  <td><?php echo $i['action'] ?></td>
                  <td><?php echo number_format($i['quantity'], 2, '.', ',') ?></td>
                  <td><?php echo number_format($i['price'], 2, '.', ',') ?></td>
                  <td><?php echo number_format($i['fee'], 2, '.', ',') ?></td>
                  <td><?php echo number_format(($i['price'] * $i['quantity']) + $i['fee'], 2, '.', ',') ?></td>
                  <td><?php echo $i['datetime'] ?></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
      <!-- End Transactions -->

      <!-- Top Portfolio -->
      <div id="top-portfolio" class="card d-flex flex-column">
        <div class="title">Top Portfolio Positions</div>
        <div class="content flex-grow-1 d-flex overflow-auto">
          <?php $i = 1;
          foreach ($top as $t) : ?>
            <div class="ranking d-flex align-items-end">
              <div class="no d-flex flex-column align-self-baseline">
                Top <span><?php echo $i ?></span>
              </div>
              <img class="company-logo" alt="TLSA" aria-label="TSLA" src="<?php echo $t['logo'] . '?apiKey=' . $API_KEY ?>">
              <div class="company-detail d-flex flex-column">
                <span class="name"><?php echo $t['ticker'] ?></span>
                <span class="description"><?php echo $t['description'] ?></span>
                <span>POSITION: <?php echo number_format($t['quantity'], 2, '.', ',') ?></span>
                <span>PRICE: <?php echo number_format($t['price'], 2, '.', ',') ?></span>
                <span>
                  DAILY P&L:
                  <span class="<?php echo $t['dailypl'] >= 0 ? 'text-success' : 'text-danger' ?>">
                    <?php echo $t['dailypl'] >= 0 ? '+' : '';
                    echo number_format($t['dailypl'], 2, '.', ',') ?>
                  </span>
                </span>
                <span>
                  UNREALIZED P&L:
                  <span class="<?php echo $t['unrealizedpl'] >= 0 ? 'text-success' : 'text-danger' ?>">
                    <?php echo $t['unrealizedpl'] >= 0 ? '+' : '';
                    echo number_format($t['unrealizedpl'], 2, '.', ',') ?>
                  </span>
                </span>
              </div>
            </div>
          <?php $i++;
          endforeach; ?>
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