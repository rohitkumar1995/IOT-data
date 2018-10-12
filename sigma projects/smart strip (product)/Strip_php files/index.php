<html lang="en">
<head>
    <title>Sigma smart strip</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Ranajoy">
    <link href="http://www.gosigmaway.com/images/logocfavicon.png" rel="shortcut icon">
   
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <!--
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
-->
</head>

<body>
    <!-- NavBar -->
    <nav class="navbar navbar-expand-md bg-primary navbar-dark" >
        <div class="container ">
          <p class="m-0 font-weight-bold navbar-brand" >Smart strip</p>
          <div class=" text-right justify-content-end" id="navbar2SupportedContent">
            <a class="btn navbar-btn btn-primary ml-2 text-white" data-toggle="modal" data-target="#loginModal">
              <i class="fa d-inline fa-lg fa-user-circle-o"></i> Sign In</a>
              <a class="btn navbar-btn btn-primary ml-2 text-white" data-toggle="modal" data-target="#registerModal">
              <i class="fa d-inline fa-lg fa-user-circle-o"></i> Sign Up</a>
          </div>
        </div>
    </nav>

    <!-- Register Modal -->
    <div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="registerModalLabel">Register</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
            <form action="http://ranajoy0.000webhostapp.com/register_server.php" method="post">
          <div class="modal-body">
                 <div class="form-group row">
                    <label for="emailid" class="col-sm-4 col-form-label">Email Id : </label>
                    <div class="col-sm-8">
                      <input type="email" class="form-control" name="emailid" placeholder="Email ID">
                    </div>
                  </div>
                 
                <div class="form-group row">
                    <label for="password" class="col-sm-4 col-form-label">Password : </label>
                    <div class="col-sm-8">
                      <input id="password" required="required" type="password" name="pass" class="form-control" placeholder="Enter Your Password">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="repassword" class="col-sm-4 col-form-label">Confirm Password : </label>
                    <div class="col-sm-8">
                      <input id="confirm_password" required="required" type="password" name="repassword" class="form-control" placeholder="Re-Enter Your Password" onkeyup='check_password_match();'>
                    </div>
                </div>
              

          </div>
          
          
          <div class="modal-footer">
            <button type="submit" id="Button" class="btn btn-primary">Register</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div></form>
        </div>
      </div>
    </div>
    <script>
			  document.getElementById("Button").disabled = true;
				var check_password_match = function() {
  if (document.getElementById('password').value ==
    document.getElementById('confirm_password').value) {
	  document.getElementById('password').style.backgroundColor = "rgb(171, 235, 198)"; 
    document.getElementById('confirm_password').style.backgroundColor = "rgb(171, 235, 198)"; 
	  document.getElementById("Button").disabled = false;
   
  } else {
	  document.getElementById('password').style.backgroundColor = "rgb(245, 183, 177)"; 
    document.getElementById('confirm_password').style.backgroundColor = "rgb(245, 183, 177)"; 
   document.getElementById("Button").disabled = true;
  }
}
				</script>
    <!-- Login Modal -->
    <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="loginModalLabel">Login</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
            <form action="http://ranajoy0.000webhostapp.com/login_server.php" method="post"> 
          <div class="modal-body">
                 <div class="form-group row">
                    <label for="emailid" class="col-sm-4 col-form-label">email id : </label>
                    <div class="col-sm-8">
                      <input type="email" class="form-control" name="emailid" placeholder="Email ID">
                    </div>
                  </div>
                <div class="form-group row">
                    <label for="password" class="col-sm-4 col-form-label">Password : </label>
                    <div class="col-sm-8">
                      <input type="password" name="password" class="form-control" placeholder="Enter Your Password">
                    </div>
                </div>
                
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Login</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div></form>
        </div>
      </div>
    </div>


<div class="pt-5 text-white bg-primary bg-gradient filter-fade-in" style="z-index: 1">
    <div class="container">
      <div class="row">
        <div class="col-md-6 col-sm-6 text-md-left text-center align-self-center my-5">
          <h1 class="display-1">Smart Power Strip</h1>
          <p class="lead">Control your appliances from anywhere.</p>
          <div class="row mt-5">
            <div class="col-md-4 col-5">
              
            </div>
            <div class="col-md-5 col-6">
             
            </div>
          </div>
        </div>
        
      </div>
    </div>
  </div>
  <hr class="bg-secondary p-0 m-0 " >
    <div class="bg-dark text-white" style="z-index: 3">
    <div class="container">
      <div class="row">
        <div class="p-4 col-md-4">
          <h2 class="mb-1 text-warning">GoSigmaway LLC</h2>
          <p class="text-white mt-0 ml-4">Quality in every step</p>
        </div>
        <div class="p-4 col-md-4 col-6">
          <h2 class="mb-4 text-warning">Mapsite</h2>
          <ul class="list-unstyled">
            <a href="#" class="text-white">Home</a>
            <br>
            <a href="#" class="text-white">About us</a>
            <br>
            <a href="#" class="text-white">Products</a>
            

          </ul>
        </div>
        <div class="p-4 col-md-4 col-4 ">
          <h2 class="mb-4 text-warning">Contact</h2>
          <p>
            <a href="tel:+246 - 542 550 5462" class="text-white">
              <i class="fa d-inline mr-3 text-secondary fa-phone"></i>0</a>6565665</p>
          <p>
            <a href="https://goo.gl/maps/AUq7b9W7yYJ2" class="text-white" target="_blank">
              <i class="fa d-inline mr-3 fa-map-marker text-secondary"></i>a</a>ddress</p>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 mt-3">
          <p class="text-center text-white">© Copyright 2018 Sigmaway - All rights reserved. </p>
        </div>
      </div>
    </div>
  </div>
 
</body>
</html>