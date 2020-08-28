<?php
header("Content-type: text/html; charset=utf-8"); 
$servername = "localhost";
$username = "";
$password = "";
$dbname = "";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$conn -> set_charset("utf8");

$sql = "select id_video from you_resultadoVideoReconhecimentoTexto group by id_video";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    $id_video = $row["id_video"];
 //   echo "<a href='https://youtu.be/" . $row["id_video"]. "?t=$minuto'>" . $row["texto"]. "</a><br><br>";


 $sql = "select id_video,json from you_videoJsonDataResultado where id_video like '%$id_video%'";
 $result = $conn->query($sql);
 
 if ($result->num_rows > 0) {
   // output data of each row
   while($row = $result->fetch_assoc()) {
     $id_video = $row["id_video"];
     $json = $row["json"];

     
     $obj = json_decode($json);
     print $obj->('items')->{'snippet'}->{'title'};


   //  $sql = "INSERT INTO wp_posts (post_title,post_content,post_name,post_date,post_date_gmt,post_modified,post_modified_gmt,post_author,post_status) 
   //  VALUES ('title','text','post_name',now(),now(),now(),now(),1,'publish')";
     
    // $sql = "INSERT INTO wp_term_relationships (object_id,term_taxonomy_id) VALUES ([the_id_of_above_post],1)";


   }
}

  }
} else {
  echo "0 results";
}
$conn->close();
?>
