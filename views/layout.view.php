<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <title><?=$context['page_title']; ?></title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }
    body {
      font-family: Arial, sans-serif;
      line-height: 1.6;
      background: #f4f4f4;
      padding-top: 60px;
    }

    nav {
      position: fixed;
      top: 0;
      width: 100%;
      background: #222;
      color: #fff;
      padding: 10px 20px;
      z-index: 1000;
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
    }

    nav h1 {
      font-size: 1.2rem;
      margin-right: 20px;
    }

    nav ul {
      list-style: none;
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
    }

    nav ul li a {
      color: #fff;
      text-decoration: none;
      padding: 6px 10px;
      border-radius: 4px;
    }

    nav ul li a:hover {
      background: #444;
    }

    /* Main content */
    .container {
      max-width: 960px;
      margin: auto;
      margin-top: 3rem;
      padding: 20px;
      background: #fff;
    }

    section {
      margin-bottom: 40px;
    }

    section h2 {
      color: #333;
      margin-bottom: 10px;
    }

    pre {
      background: #eee;
      padding: 10px;
      overflow-x: auto;
      font-size: 0.95rem;
      border-left: 4px solid #888;
    }

    code {
      font-family: monospace;
    }

    @media (max-width: 600px) {
      nav {
        flex-direction: column;
        align-items: flex-start;
      }
      nav ul {
        flex-direction: column;
      }
    }
  </style>
</head>
<body>

  <nav>
    <h1>Interview Test</h1>
    <ul>
      <li><a href="<?=ROOT; ?>/polling-unit-result">Polling Unit Result</a></li>
      <li><a href="<?=ROOT; ?>/lga-total-result">LGA Total Result</a></li>
      <li><a href="<?=ROOT; ?>/add-polling-unit-result">Add Polling Unit Result</a></li>
    </ul>
  </nav>

    <div class="container">
        <!-- Content Goes Here -->
        <?php require("$name.view.php"); ?>
        <!-- End Content -->
    </div>

</body>

</html>