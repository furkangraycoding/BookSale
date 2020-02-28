<?php
  $title = "Contact";
  require_once "./template/header.php";
?>
<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">1</th>
      <th scope="col">Booktitle</th>
      <th scope="col">Book Author</th>
      <th scope="col">Image</th>
      <th scope="col">Description</th>
    </tr>
  </thead>
  <tbody>
  	<?php
  	 mysqli_connect("localhost", "root", "") or die("Error connecting to database: ".mysqli_error());
     
    mysqli_select_db("www.project") or die(mysql_error());
      $query = mysqli_query("SELECT * FROM books
            WHERE (`search` LIKE '%".$book_title."%') OR (`search` LIKE '%".$book_title."%')") or die(mysqli_error());
      if(mysqli_num_rows($raw_results) > 0){ // if one or more rows are returned do following
             
            while($results = mysqli_fetch_array($raw_results)){
            
             
                print "<tr><td scope="col">1</td>
      <td scope="col">$book_title</td>
      <td scope="col">$book_author</td>
      <td scope="col">book_image</td>
      <td scope="col">book_descr</td> </tr> </table>";
                
            }
             
        }
  ?>
    