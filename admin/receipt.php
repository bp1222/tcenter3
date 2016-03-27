<? 
	include("../inc/connection.inc"); 
  include("../inc/header2.php");	
?>

<?
	# extract the post data
	@extract($_POST);

	# get the ticket number to query by
	if ($tcnumber != "") {
		$queryresult = "Receipt For Ticket #: $tcnumber"; 
	}
	# error because no ticket # was provided
	else {
		echo "No ticket number was passed.";
	}
	$query = "SELECT * from tickets WHERE tcnumber = '$tcnumber';";
	$result = pg_query($query);
	# if no results were found, provide an error
	if ( pg_num_rows($result) == 0 ) {
		echo "There are no results for your query.";
	}
	# data was found, show it
	else { 
	?>
		<h3><? echo $queryresult; ?></h3><hr width="35%"><br>
		<table width="70%" valign="top">
	<?
	while ($row = pg_fetch_assoc($result)) {

	$tid = trim($row['tid']);
	$username = trim($row['username']);
	$tcnumber = trim($row['tcnumber']);
	$tnumber = trim($row['tnumber']);
	$date = trim($row['date']);
	$accepteddate = trim($row['accepteddate']);
	$acceptedby = trim($row['acceptedby']);
	$description = trim($row['description']);
	$summary = trim($row['summary']);
	$queue = trim($row['queue']);
	$status = trim($row['status']);
	$progress = stripslashes(trim($row['progress']));
	$lastupdatedby = trim($row['lastupdatedby']);
	$lastupdateddate = trim($row['lastupdateddtate']);
	$hdbackuplocation = trim($row['hdbackuplocation']);
	
	?>
			<!--<tr>
				<td>Ticket ID#: </td><td><? #echo $tid; ?></td>
			</tr>-->
			<tr>
				<td valign="top"><h3>New Login Password:</h3></td><td valign="top"><h3><? echo $tcnumber; ?></h3></td>
			</tr> 
			<tr>
				<td valign="top">Username: </td><td valign="top"><? echo $username; ?></td>
			</tr>
			<tr>
				<td valign="top">Ticket #: </td><td valign="top"><? echo $tcnumber; ?></td>
			</tr>
			<tr>
				<td valign="top">RIT Ticket #: </td><td valign="top"><? echo $tnumber; ?></td>
			</tr>
			<tr>
				<td valign="top">Date Of Creation: </td><td valign="top"><? echo $date; ?></td>
			</tr>
			<tr>
				<td valign="top">Date Accepted: </td><td valign="top"><? echo $accepteddate; ?></td>
			</tr>
			<tr>
				<td valign="top">Accepted By: </td><td valign="top"><? echo $acceptedby; ?></td>
			</tr>
			<tr>
				<td valign="top">Description:</td><td valign="top"><? echo $description; ?></td>
			</tr>
			<tr>
				<td valign="top">Summary: </td><td valign="top"><? echo $summary; ?></td>
			</tr>
			<tr>
				<td valign="top">Inventory: </td><td valign="top"><? echo $inventory; ?>			</tr>
			<tr>
				<td valign="top">Progress: </td><td valign="top"><? echo $progress; ?></td>
			</tr>
			<tr>
				<td valign="top">Last Updated By: </td><td valign="top"><? echo $lastupdatedby; ?></td>
			</tr>
			<tr>
				<td valign="top">Date Last Updated: </td><td valign="top"><? echo $lastupdateddate; ?></td>
			</tr>
			<tr>
				<td valign="top" colspan="2">
				<hr width="80%">
				<br>
				<b><u>Common Tasks:</u></b><br><br>
					"<font color="#ff0000">*</font>" = Required<br><br>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<table width="100%">
				<?
					# crazy query that looks for all completed tasks on the current ticket
					# to do this, we had to join two tables together based on 3 values
					$query = "SELECT tasks.name AS name, tasks.required AS required, link.task AS task, link.date AS date FROM tasks, link WHERE tasks.enabled = 'TRUE' AND link.ticket = '$tcnumber' AND tasks.taskid = link.task ORDER BY link.task ASC;";
					$result = pg_query($query);
					while ($row = pg_fetch_assoc($result)) {

						$taskname = trim($row['name']);
						$taskrequired = trim($row['required']);
						$taskid = trim($row['task']);
						$datecompleted = trim($row['date']);

						?>
						<tr>
							<td valign="top" width="200px">
						<?
						if ($taskrequired == "t") {?>
							<font color="#ff0000">*</font>
						<? } 
							echo $taskname;
						?>
							</td>
							<td align="right" width="100px">Date Completed:&nbsp;<? echo $datecompleted; ?><br>
							</td>
						</tr>
					<?
					}
					?></table><?
	 		} 
		}	
	?>
	<tr>
		<td colspan="2" align="right">
		<hr width="80%"><br>
		</td>
		</tr>
		<tr>
			<td align="center" colspan="2">If you have any questions, please feel free to contact Resnet @ 475-2600 or email <a href="mailto:resnet@rit.edu">resnet@rit.edu</a>
			</td>
		</tr>
	</table>

<? 
# close the database connection
pg_close($db_connect) ?>
