<?php 
    //  SETTING CONNECTION WITH DATABASE
    include('connection.php');
?>

<html lang="en">
<head>
    <title>Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
    
<body>
    <!-- NavBar -->
    <nav class="navbar navbar-expand-md bg-primary navbar-dark" >
        <div class="container ">
          <p class="m-0 font-weight-bold navbar-brand" >Sigma Smart Strip</p>
          <div class=" text-right justify-content-end" id="navbar2SupportedContent">
            <a class="btn navbar-btn btn-primary ml-2 text-white" href="http://ranajoy0.000webhostapp.com/logout.php">
              <i class="fa d-inline fa-lg fa-user-circle-o"></i> Sign Out</a>
          </div>
        </div>
    </nav>
    <div class="container"> 
    <!-- THIS BLOCK WILL APPEAR IF NO DEVICE IS REGISTERED WITH THE ACCOUNT -->
    <?php   
        // CHECKING FOR PRESENCE OF DEVICE IN SESSION VARIABLE
        if($_SESSION['have_device']===0 or $_SESSION['have_device']==="0"){
    ?>
  
    <!-- Button trigger modal -->
    <div class="text-center m-3">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
          Add New Device
        </button>
    </div>
    <?php
     }
     
    else
    {
    //<!-- Table of Sockets -->
     echo '
    <div class = "alert mt-4 alert-success">
     <h3 class="text-center alert-heading"> Device :- ' .$_SESSION['have_device']. '</h3>
     </div>
    <table class="table table-dark">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Socket number</th>
          <th scope="col">Current Status</th>
          <th scope="col">Toggle State</th>
          <th scope="col">Timer</th>

        </tr>
      </thead>
      <tbody>';
    
    //  SQL QUERY FOR FETCHING STATUSES OF SOCKETS
    $sql = "select * from ".$_SESSION['have_device'];
    
    //  EXECUTING SQL QUERY
    $result = $conn->query($sql);
    while($row = $result->fetch_assoc()) 
    {
        echo "<tr>";  
        $id = $row['sno'];
        echo "<td>" . $id . "</td>";
        echo "<td>" . $row['socket_name'] . "</td>";
        echo "<td>" . $row['socket_status'] . "</td>";
        if ($row['socket_status']==0)
        {
            echo "<td> <form action='http://ranajoy0.000webhostapp.com//toggle_switch.php' method='post'> 
                <input type='text' name='id' value='" .$id. "' hidden>
                <input type='text' name='sts' value='1' hidden>
                <input type='submit' class='btn btn-danger' id='stat' value='OFF'></form>
            </td>";
        }
        else
        {
            echo "<td> <form action='http://ranajoy0.000webhostapp.com/toggle_switch.php' method='post'> 
                <input type='text' name='id' value='" .$id. "' hidden>
                <input type='text' name='sts' value='0' hidden>
                <input type='submit' class='btn btn-success' id='stat' value='ON'></form>
                </td>";
        }
        
        echo "<td>" . $row['timer'] . "</td>";
        echo "</tr>";
    }
    echo '
        </tbody>
        </table><div class="text-center"><a class="btn  navbar-btn btn-primary text-white" data-toggle="modal" data-target="#changename">
                Change Socket Name</a>
                <a class="btn  navbar-btn btn-primary text-white" data-toggle="modal" data-target="#timer">
                Set Timer</a></div>
        </div>';
    }
?>

<!-- NEW DEVICE Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New Device</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <form action="http://ranajoy0.000webhostapp.com/add_device.php" method="post">
      <div class="modal-body">
             <div class="form-group row">
                <label for="serialNo" class="col-sm-4 col-form-label">Serial Number : </label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" name="serialNo" placeholder="Device Serial Number" tabindex="1">
                </div>
              </div>
            <div class="form-group row">
                <label for="serialNo" class="col-sm-4 col-form-label">Sockets : </label>
                <div class="col-sm-8">
                  <input type="number" name="socket" class="form-control" placeholder="Number of sockets" tabindex="2">
                </div>
              </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" tabindex="3">Update</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal" tabindex="4">Close</button>
      </div></form>
    </div>
  </div>
</div>


<!-- Change name modal -->
<div class="modal fade" id="changename" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header ">
          <h5 class="modal-title" id="loginModalLabel">Change Socket Name</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" tabindex="5">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form action="http://ranajoy0.000webhostapp.com/change_name.php" method="post">
          <div class="modal-body">
            <div class="form-group row">
              <label for="socketnum" class="col-sm-4 col-form-label" >Socket Number : </label>
              <div class="col-sm-8">
                <input type="number" name="socketnum" class="form-control" tabindex=1 placeholder="Socket Number"> </div>
            </div>
            <div class="form-group row">
              <label for="newname" class="col-sm-4 col-form-label">New Name : </label>
              <div class="col-sm-8">
                <input type="text" class="form-control" name="newname" placeholder="New Name" tabindex="2"> </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary" tabindex="3">Update</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal" tabindex="4">Close</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  
<!-- Set Timer -->
<div class="modal fade" id="timer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header ">
          <h5 class="modal-title" id="loginModalLabel">Set Timer</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" tabindex="6">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form action="http://ranajoy0.000webhostapp.com/timer.php" method="post">
          <div class="modal-body">
            <div class="form-group row">
              <label for="socketnum" class="col-sm-4 col-form-label" >Socket Number : </label>
              <div class="col-sm-8">
                    <?php
                    echo '<input type="number" name="socketnum" class="form-control" tabindex=1 min=1 max= ' . $id . ' placeholder="Socket Number"> </div>'
                    ?>
                </div>
            <div class="form-group row">
              <label for="example-datetime-local-input" class="col-sm-4 col-form-label">Start time : </label>
              <div class="col-sm-8">
                <input class="form-control" type="datetime-local" tabindex=2 placeholder="2011-08-19T13:45:00" name='start' id="example-datetime-local-input">
              </div>
            </div>
          <div class="form-group row">
              <label for="example-datetime-local-input" class="col-sm-4 col-form-label">end time : </label>
              <div class="col-sm-8">
                <input class="form-control" type="datetime-local" tabindex=3 placeholder="2011-08-19T13:45:00" name='end' id="example-datetime-local-input">
              </div>
            </div>
            </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary" tabindex="4">Set</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal" tabindex="5">Close</button>
          </div>
        </form>
      </div>
    </div>
    </div>

    <div style="text-align:'right'">
    <footer class="navbar fixed-bottom navbar-light bg-faded">
       <?php
            echo $_SESSION['user_name'];
            echo "-->".$_SESSION['have_device'];
        ?>
    </footer>
    </div>
</body>
</html>
