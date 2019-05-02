<?php
  require 'conn.php';
  function load(){
    $db = new DbConnect;
    $conn = $db->connect();

    $stmt = $conn->prepare("select * from category ORDER BY cat_name;");
    $stmt->execute();
    $cat = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $cat;
  }

  function editDb(){
    $db = new DbConnect;
    $conn = $db->connect();

    $selected = $_POST['itemsList'];
    $operator = 1;
    if ($_POST['operator'] == "remove"){
      $operator = -1;
    }
    $qty = $_POST['amount'] * $operator;

    $query = ("UPDATE main_store SET inventory = inventory + '$qty' WHERE name = '$selected'; ");
    $stmt = $conn->prepare($query);
    $stmt->execute();
  }

  function listItems(){
    if(($_POST['catList']) != "" || !isset($_POST['catList'])){
      loadItems();
      populateList();
    } else{
      echo "<option>Items</option>";
    }
  }

  function loadItems(){
    $db = new DbConnect;
    $conn = $db->connect();

    $selected = "";
    if(isset($_POST['catList'])){
    $selected = $_POST['catList'];
  }

    $query = ("SELECT * from main_store");
    $query2 = ("WHERE category = '$selected'");
    $query3 = ("ORDER BY name;");
    if(isset($_POST['catList'])){
      if($selected != "Category"){
        $query = $query." ". $query2;
      }}

    $query = $query." ". $query3;

    $stmt = $conn->prepare($query);
    $stmt->execute();
    $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $items;
  }

  function populateList(){
    $items = loadItems("");
    foreach($items as $i){
      echo "<option id=".$i['id'].">".$i['name']."</option>";
    }
  }
 ?>
