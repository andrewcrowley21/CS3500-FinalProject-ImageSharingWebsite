<?php

function LogInfo(){
		echo '<main class="container">

 		<div class="row">
 			<div class="col-lg-3"></div>
 			<div class="col-lg-6">
 				
 				<form class="form-horizontal" action="login.php" method="post">
 					<h3>Log In or <a href="signup.php">Sign Up!</a></h3>
 					<div class="form-group">
 						<label class="control-label col-lg-3" for= "user">User Name:</label>
 						<div class="col-lg-9">
 							<input type="text" name="user" class="form-control" placeholder="Enter Username">
 						</div>
 					</div>

 					<div class="form-group">
 						<label class="control-label col-lg-3" for="password">Password:</label>
 						<div class="col-lg-9">
 							<input type="password" name="password" class="form-control" placeholder="Enter Password">
 						</div>
 					</div>

 					<div class="form-group">
 						<div class="col-lg-offset-10 col-lg-10">
 							<button type="submit" name="log" value="log" class="btn btn-default">Log In</button>
 						</div>
 						
 					</div>
 				</form>


 			</div>

 			<div class="col-lg-3"></div>
 		</div>

 		
 	</main>';
	}

	function passwordWrong(){

		echo '<main class="container">

 		<div class="row">
 			<div class="col-lg-3"></div>
 			<div class="col-lg-6">
 				
 				<form class="form-horizontal" action="login.php" method="post">
 					<h3>Log In or <a href="signup.php">Sign Up!</a></h3>
 					<div class="alert alert-danger" >
 						<p>Sorry that password in incorrect! Please try again.</p>
 					</div>
 					<div class="form-group">
 						<label class="control-label col-lg-3" for= "user">User Name:</label>
 						<div class="col-lg-9">
 							<input type="text" name="user" class="form-control" placeholder="Enter Username">
 						</div>
 					</div>

 					<div class="form-group">
 						<label class="control-label col-lg-3" for="password">Password:</label>
 						<div class="col-lg-9">
 							<input type="password" name="password" class="form-control" placeholder="Enter Password">
 						</div>
 					</div>

 					<div class="form-group">
 						<div class="col-lg-offset-10 col-lg-10">
 							<button type="submit" name="log" value="log" class="btn btn-default">Log In</button>
 						</div>
 						
 					</div>
 				</form>


 			</div>

 			<div class="col-lg-3"></div>
 		</div>

 		
 	</main>';

	}

	function usernameWrong(){

		echo '<main class="container">

 		<div class="row">
 			<div class="col-lg-3"></div>
 			<div class="col-lg-6">
 				
 				<form class="form-horizontal" action="login.php" method="post">
 					<h3>Log In or <a href="signup.php">Sign Up!</a></h3>
 					<div class="alert alert-danger" >
 						<p>Sorry that username is incorrect! Please try again or create a new account.</p>
 					</div>
 					<div class="form-group">
 						<label class="control-label col-lg-3" for= "user">User Name:</label>
 						<div class="col-lg-9">
 							<input type="text" name="user" class="form-control" placeholder="Enter Username">
 						</div>
 					</div>

 					<div class="form-group">
 						<label class="control-label col-lg-3" for="password">Password:</label>
 						<div class="col-lg-9">
 							<input type="password" name="password" class="form-control" placeholder="Enter Password">
 						</div>
 					</div>

 					<div class="form-group">
 						<div class="col-lg-offset-10 col-lg-10">
 							<button type="submit" name="log" value="log" class="btn btn-default">Log In</button>
 						</div>
 						
 					</div>
 				</form>


 			</div>

 			<div class="col-lg-3"></div>
 		</div>

 		
 	</main>';

	}

?>