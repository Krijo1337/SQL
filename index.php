<html>
<head>
<title>
Userverwaltung
</title>

</head>
<body>
<?php
$dbhost = '127.0.0.1';
$dbuser = 'root';
$dbpass = 'codeception';

$conn = mysql_connect($dbhost, $dbuser, $dbpass);

$sql = "SELECT * FROM test.page WHERE ID NOT IN (24,25)";

$query = mysql_query( $sql, $conn );		

//main content START 
ECHO'<div id="content" class="centered">
		<table>
		<tr>
			<td>PageID</td>
			<td>ParentPageID</td>
			<td>Description</td>
			<td>First Parent</td>
		</tr>';
while($row = mysql_fetch_array($query)) {

		
		$id = $row['ID'];
		$parentid = $row['parentID'];
		$name = $row['name'];
		$firstparentid = $id;
		$firstparentname = $name;

		ECHO'<tr>
				<td>' . $id . '</td>
				<td>' . $parentid . '</td>
				<td>' . $name . '</td>';
				
				
				while($parentid != 0){
						
					$sql = "SELECT * FROM test.page WHERE id = '$parentid'";
					$query2 = mysql_query( $sql, $conn );	
					$current = mysql_fetch_array($query2);
					
					$parentid = $current['parentID'];
					$firstparentid = $current['ID'];
					$firstparentname = $current['name'];	
				}
				
			ECHO'<td>' . $firstparentid . ' - ' . $firstparentname . '</td>
			</tr>';	
			
		}
		
ECHO'</table>
</div>';		
//main content END
mysql_close($conn);
?>
</body>
</html>