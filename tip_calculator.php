<! DOCTYPE html>
<html>
  <title>Tip Calculator</title>

  <head>
  <style>
  body {
    background-color: #EAEDED;
    margin: 100px;
  }
  div.TIPC {
    color: blue;
    font-family: verdana;
    font-size: 250%;
  }
  form {
    font-size: 110%;
  }
  p.error {
    display: inline;
    color: red;
  }
  p.result{
    border: 2px solid blue;
    padding: 15px;
    margin-left: 200px;
    margin-right: 200px;
    background-color: powderblue;
  }
  </style>
  </head>

  <body>
    <?php
      $subtotal = "";
      $percent = "15";
      $subtError = "";

      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['submit'])) {
          $percent = $_POST["option"];
        }

        if (empty($_POST['subt'])) {
          $subtError = "Subtotal is empty.";
        }
        else if (!is_numeric($_POST['subt'])) {
          $subtError = "Non-numeric entry.";
        }
        else if (floatval($_POST['subt']) <= 0) {
          $subtError = "Subtotal must be greater than 0.";
        }
        else {
          $subtotal = $_POST['subt'];
        }
      }
    ?>

    <div class="TIPC" align="center">
      <h3>Tip Calculator</h3>
    </div>
    <hr>
    <br>

    <div class="form" align="center">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
      <?php
      if ($subtError != "")
        echo "<p class='error'><strong>Bill Subtotal: </strong></p>";
      else
        echo "<strong>Bill Subtotal: </strong>";
      ?>
      <input type="text" name="subt" value="<?php echo $subtotal ?>">
      <br>
      <br>
      <strong>Tip Percentage: </strong>

      <?php
        for ($val = 10; $val <= 20; $val+=5) {
      ?>
          <input type="radio" name="option"
          <?php
            if (isset($percent) && $percent==$val)
              echo "checked";
          ?>
          value="<?php echo $val ?>">
          <?php
            echo "$val" . "%";
        }
      ?>
      <br>
      <br>
      <input type="submit" name="submit" value="Submit">
      <br>
      <br>

    </form>
    </div>

  <div class="output" align="center">
    <p class="error"><?php echo $subtError ?></p>
    <?php
    if ($subtError == "" && isset($_POST['submit'])) {
    ?>
      <p class="result">Tip: $<?php
        $tip = intval($percent)/100*floatval($subtotal);
        echo number_format($tip,2);
        ?></p>
      <p class="result">Total: $<?php
        echo number_format($tip+floatval($subtotal),2);
      ?></p>
    <?php
    }
    ?>
  </div>
  </body>
</html>
