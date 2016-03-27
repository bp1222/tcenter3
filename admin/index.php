
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>

<head>

<title>ITS Resnet</title>
<? include( "test/ITS-head.html" ); ?>
<link rel="stylesheet" type="text/css" href="new/tcenter.css">

</head>

<body>

<? include( "new/ITS-topbar.php" ); ?>
<? include( "inc/connection.inc" ); ?>

<div class=frame>

<!-- Check for notes -->
<?
var_dump($_SERVER['PHP_AUTH_USER']);
  $query = "SELECT * FROM tickets WHERE flag ='".$PHP_AUTH_USER."'";
  $result = pg_query($query);
  if (pg_num_rows($result) > 0) {
// We have notes, print this table, and make it so the next table looks OK too
?>
  <table class=Box style='width: 50%; position: relative; left: 25%;'>

    <tr class=ticket>
      <th class=ticket> <h3>Ticket Alert</h3>
    </tr>

    <tr class=ticket> <td class=ticket>
<?
      $tickets = array();
      while ($row = pg_fetch_assoc($result))
      {
        echo "Ticket ".$row['tcnumber']." requires your attention";
        array_push($tickets, $row['tcnumber']);
      }

      foreach ($tickets as $ticket)
      {
        $query = "UPDATE tickets SET flag = '' where tcnumber = '".$ticket."'";
        pg_query($query);
      }
?>
    </tr></td>
  </table>

  <table class=Box style='width: 50%; position: relative; left: 25%; margin-top: 20px;'>
<?
} else {
// If we don't write notes to screen, make sure this table looks right
?>
  <table class=Box style='width: 50%; position: relative; left: 25%;'>
<?
}
?>

	<tr class=ticket>
		<th class=ticket> <h3>TCenter</h3> </td>
	</tr>

	<tr class=ticket> <td class=ticket>
    <a class=ticketnumber href="../admin/new/tickets.php">View Tickets</a>
	</td> </tr>

	<tr class=ticket> <td class=ticket>
      Quick Search
      <form enctype="multipart/form-data" method=get action="/admin/new/tickets.php">
        <input type=text name=search>
        <input type=submit value='Find Tickets'>
      </form>
      <form enctype="multipart/form-data" method=get action="/admin/new/user.php">
        <input type=text name=search>
        <input type=submit value='Find Users'>
      </form>
	</td> </tr>

</table>

<table class=Box style='width: 50%; position: relative; left: 25%; margin-top: 20px;'>

	<tr class=ticket>
		<th class=ticket> <h3>Office</h3> </td>
	</tr>

	<tr class=ticket> <td class=ticket>
		<a class=ticketnumber href="queryticket.php">Search Tickets</a>
	</td> </tr>

	<tr class=ticket> <td class=ticket>
    <a class=ticketnumber href="generate.php">Generate a Ticket</a>
	</td> </tr>

	<tr class=ticket> <td class=ticket>
    <a class=ticketnumber href="../barcode/">Generate a Barcode</a>
  </td> </tr>

	<tr class=ticket> <td class=ticket>
    <a class=ticketnumber href="pending.php">View Pending Customers</a>
	</td> </tr>

	<tr class=ticket> <td class=ticket>
    <a class=ticketnumber href="experience.php">View Experience Chart</a>
	</td> </tr>

</table>

<table class=Box style='width: 50%; position: relative; left: 25%; margin-top: 20px;'>

  <tr class=ticket>
    <th class=ticket> <h3>Administrators</h3> </th>
  </tr>

	<tr class=ticket> <td class=ticket>
    <a class=ticketnumber href="report/index.php">Submit Shift Supervisor Report</a>
	</td> </tr>

	<tr class=ticket> <td class=ticket>
    <a class=ticketnumber href="changewait.php">Edit Resnet Wait Time</a>
	</td> </tr>

	<tr class=ticket> <td class=ticket>
    <a class=ticketnumber href="dbmod/updates.php">View Resnet Daily Workflow</a>
	</td> </tr>

	<tr class=ticket> <td class=ticket>
    <a class=ticketnumber href="stats/chart.php">View Statistics</a>
	</td> </tr>

	<tr class=ticket> <td class=ticket>
    <a class=ticketnumber href="dbmod/moddatabase.php">Add/Modify Common Tasks, Stats, and Queues</a>
	</td> </tr>

	<tr class=ticket> <td class=ticket>
    <a class=ticketnumber href="dbmod/deleteticket.php">Delete a Ticket</a>
	</td> </tr>

</table>

</div>

</body>

</html>

