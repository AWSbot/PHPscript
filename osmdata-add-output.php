<?php
$servername = "localhost";
$username = "xxx";
$password = "xxx";
$dbname = "AWI";
$textexport1 = "<?xml version='1.0' encoding='UTF-8'?>";
$textexport1 .= "<osm version='0.6' upload='true' generator='PHPscript'>";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT date, data, postnr FROM osmadd";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {

$output .= iconv("ISO-8859-1","UTF-8",str_replace("#","'",$row["data"]));

//$output = str_replace("#","",$row["data"]);
//$output = str_replace("#","'","$output");

        echo "data: " . $output . "<br>";
    }
} else {
    echo "0 results";
}
$conn->close();
$textexport3 .=("</osm> ");
$textexport = $textexport1 . $output . $textexport3;
 
?>

  <script src="https://code.jquery.com/jquery-1.7.1.min.js"></script>
  <script type="text/javascript">
var textexport;
 var textexport = <?php echo json_encode($textexport); ?>;
 var postnr = <?php echo json_encode($postnummer); ?>;


        var uri = 'data:text/csv;charset=utf-8,' + textexport;
var downloadLink = document.createElement("a");
downloadLink.href = uri;
var currentdate = new Date();
var dato = 	currentdate.getDate() + "-"
                + (currentdate.getMonth()+1)  + "-" 
                + currentdate.getFullYear() + "_"  
                + currentdate.getHours() + "-"  
                + currentdate.getMinutes();


downloadLink.download = "add" + dato + ".osm";

document.body.appendChild(downloadLink);
downloadLink.click();
document.body.removeChild(downloadLink);

</script>
<?php


?>
