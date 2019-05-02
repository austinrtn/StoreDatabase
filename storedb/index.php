<!DOCTYPE HTML>
<?php require 'data.php';
  if (isset($_POST["amount"]) && ($_POST["amount"] != 0) && isset($_POST["itemsList"]) && ($_POST["itemsList"]) != "") {
    editDb();}
  $item = loadItems("true");
?>

<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
    <script type="text/javascript">
      function sub(){
        document.forms["mainForm"].submit();
      }
    </script>

    <title>CIS 210</title>

  </head>

  <body>
    <h1>CIS 210 STORE OF GOODS</h1>

    <form id="mainForm" action="index.php" method="post">
      <select name="catList" onchange="sub()" >
        <?php if(isset($_POST['catList'])){
              $selCat = $_POST['catList'];
              echo "<option value='Category'>".$selCat."</option>";
      }
        ?>
        <option value="Category">Category</option>

        <?php
            $cat = load();

              foreach($cat as $c){
                echo "<option id=".$c['id'].">".$c['cat_name']."</option>";
              }
              ?>
      </select>

      <select name="itemsList" id="itemsList">
          <?php listItems(); ?>
      </select>

   <br><br>
   <input type="radio" name="operator" id="operator" value="add" checked="checked">Add
   <input type="radio" name="operator" id="operator" value="remove">Remove
   <br><br>

   Quantity <br>
    <input type="number" name="amount" id="amount">
    <input type="submit" name="submitForm" value="Submit">

   </form>
   <br>

  <div style="overflow-y:auto;">
    <table>
        <tr>
          <th>Name</th>
          <th>Inventory</th>
          <th>Price</th>
          <th>Category</th>
        </tr>
        <?php foreach($item as $i){
          echo "<tr>";
          echo "<td>".$i['name']."</td>";
          echo "<td align='center'>".$i['inventory']."</td>";
          echo "<td align='center'>$".$i['cost']."</td>";
          echo "<td>".$i['category']."</td>";
          echo "</tr>";
        } ?>
    </table>
  </div>
  <br><br>
  <form class="" action="info.html" method="post">
    <input type="submit" name="info" value="Info">
  </form>
  </body>
</html>
