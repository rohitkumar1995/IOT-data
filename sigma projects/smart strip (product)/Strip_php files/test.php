<?php
    include('connection.php');
       echo '<h4 class="text-center mt-4">You Have A registered device.</h1>
        <table class="table table-dark">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Socket number</th>
              <th scope="col">status</th>
              <th scope="col">button</th>
            </tr>
          </thead>
          <tbody>
            ';
            //$result = mysqli_query($conn,"select * from '".$_SESSION['have_device']."'");
            $sql = "select * from ".$_SESSION['have_device'];
        //    $result = $conn->query($sql);
echo "select * from ".$_SESSION['have_device'];            
$result = $conn->query($sql) or die($conn->error);
            echo "select * from ".$_SESSION['have_device'];
            //if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
            //while($row = mysqli_fetch_array($result))
            //{
                echo "<tr>";  
                $id = $row['sno'];
                echo "<td>" . $id . "</td>";
                echo "<td>" . $row['socket_name'] . "</td>";
                echo "<td>" . $row['socket_status'] . "</td>";
                if ($row['socket_status']==0){
                echo "<td> <form action='/smartstrip/toggle_switch.php' method='post'> 
                        <input type='text' name='id' value='" .$id. "' hidden>
                        <input type='text' name='sts' value='1' hidden>
                        <input type='submit' class='btn btn-danger' id='stat' value='OFF'></form>
                    </td>";}
                else{
                echo "<td> <form action='#togglestatus' method='post'> 
                        <input type='text' name='id' value='" .$id. "' hidden>
                        <input type='text' name='sts' value='0' hidden>
                        <input type='submit' class='btn btn-success' id='stat' value='ON'></form>
                    </td>";}
                echo "</tr>";
            }
            
            
            echo '
          </tbody>
        </table>
    </div>';
?>