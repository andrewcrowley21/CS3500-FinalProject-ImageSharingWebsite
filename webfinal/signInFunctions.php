<?php
	
	function signUpInfo(){
		echo '<main class="container">

		<div class="row">
		<div class="col-lg-1"></div>


			<div class="col-lg-10">

 				<form class="form-horizontal" action="signup.php" method="post">
 						
 						<div class="form-group">

 							<label class="control-label col-lg-3" for="user">User Name:</label>
 							<div class="col-lg-9">
 								<input type="text" name="user" class="from-control" placeholder="Enter a User Name" required>
 							</div>
 							
 						</div>

 						<div class="form-group">
 							<label class="control-label col-lg-3" for="first">First Name:</label>
 							<div class="col-lg-9">
 								<input type="text" name="first" class="from-control" placeholder="Enter your first name" >
 							</div>
 							
 						</div>

 						<div class="form-group">
 							<label class="control-label col-lg-3" for="last">Last Name:</label>
 							<div class="col-lg-9">
 								<input type="text" name="last" class="from-control" placeholder="Enter your last name">
 							</div>
 						</div>

 						<div class="form-group">
 							<label class="control-label col-lg-3" for="email">Email:</label>
 							<div class="col-lg-9">
 								<input type="email" name="email" class="from-control" placeholder="name@email.com" required>
 							</div>
 							
 						</div>

 						<div class="form-group">
 							<label class="control-label col-lg-3" for="pass1">Password:</label>
 							<div class="col-lg-9">
 								<input type="password" name="pass1" class="from-control"  id="pass1" placeholder="Enter Password" required>
 							</div>
 							
 						</div>

 						<div class="form-group">
 							<label class="control-label col-lg-3" for="pass2">Password:</label>
 							<div class="col-lg-9">
 								<input type="password" name="pass2" class="from-control" id="pass2" onChange = "checkPassord();" placeholder="Re-Enter Password" required>
 							</div>
 						</div>

 						<div class="form-group">
 							<div class="col-lg-offset-5 col-lg-12" id="button1">
 								
 							</div>
 							
 						</div>


 				</form>

 			</div>

 			<div class="col-lg-1"></div>

 		</div>



		
	</main>';
	}


	function signInUserAndEmail(){


		echo '<main class="container">

		<div class="row">
		<div class="col-lg-1"></div>


			<div class="col-lg-10">

 				<form class="form-horizontal" action="signup.php" method="post">
 						
 						<div class="form-group">

 							<div class="alert alert-danger" >
 								<p>Sorry that UserName and Email are already in use!<br>Please enter new ones.</p>
 								
 							</div>

 							<label class="control-label col-lg-3" for="user">User Name:</label>
 							<div class="col-lg-9">
 								<input type="text" name="user" class="from-control" placeholder="Enter a User Name" >
 							</div>
 							
 						</div>

 						<div class="form-group">
 							<label class="control-label col-lg-3" for="first">First Name:</label>
 							<div class="col-lg-9">
 								<input type="text" name="first" class="from-control" placeholder="Enter your first name">
 							</div>
 							
 						</div>

 						<div class="form-group">
 							<label class="control-label col-lg-3" for="last">Last Name:</label>
 							<div class="col-lg-9">
 								<input type="text" name="last" class="from-control" placeholder="Enter your last name">
 							</div>
 						</div>

 						<div class="form-group">
 							<label class="control-label col-lg-3" for="email">Email:</label>
 							<div class="col-lg-9">
 								<input type="email" name="email" class="from-control" placeholder="name@email.com">
 							</div>
 							
 						</div>

 						<div class="form-group">
 							<label class="control-label col-lg-3" for="pass1">Password:</label>
 							<div class="col-lg-9">
 								<input type="password" name="pass1" class="from-control"  id="pass1" placeholder="Enter Password" >
 							</div>
 							
 						</div>

 						<div class="form-group">
 							<label class="control-label col-lg-3" for="pass2">Password:</label>
 							<div class="col-lg-9">
 								<input type="password" name="pass2" class="from-control" id="pass2" onChange = "checkPassord();" placeholder="Re-Enter Password">
 							</div>
 						</div>

 						<div class="form-group">
 							<div class="col-lg-offset-5 col-lg-12" id="button1">
 								
 							</div>
 							
 						</div>


 				</form>

 			</div>

 			<div class="col-lg-1"></div>

 		</div>



		
	</main>';

	}

	function signInEmail(){
		echo '<main class="container">

		<div class="row">
		<div class="col-lg-1"></div>


			<div class="col-lg-10">

 				<form class="form-horizontal" action="signup.php" method="post">
 						
 						<div class="form-group">

 							<div class="alert alert-danger" >
 								<p>Sorry that Email is already in use!<br>Please enter a new one.</p>
 								
 							</div>

 							<label class="control-label col-lg-3" for="user">User Name:</label>
 							<div class="col-lg-9">
 								<input type="text" name="user" class="from-control" placeholder="Enter a User Name" >
 							</div>
 							
 						</div>

 						<div class="form-group">
 							<label class="control-label col-lg-3" for="first">First Name:</label>
 							<div class="col-lg-9">
 								<input type="text" name="first" class="from-control" placeholder="Enter your first name">
 							</div>
 							
 						</div>

 						<div class="form-group">
 							<label class="control-label col-lg-3" for="last">Last Name:</label>
 							<div class="col-lg-9">
 								<input type="text" name="last" class="from-control" placeholder="Enter your last name">
 							</div>
 						</div>

 						<div class="form-group">
 							<label class="control-label col-lg-3" for="email">Email:</label>
 							<div class="col-lg-9">
 								<input type="email" name="email" class="from-control" placeholder="name@email.com">
 							</div>
 							
 						</div>

 						<div class="form-group">
 							<label class="control-label col-lg-3" for="pass1">Password:</label>
 							<div class="col-lg-9">
 								<input type="password" name="pass1" class="from-control"  id="pass1" placeholder="Enter Password" >
 							</div>
 							
 						</div>

 						<div class="form-group">
 							<label class="control-label col-lg-3" for="pass2">Password:</label>
 							<div class="col-lg-9">
 								<input type="password" name="pass2" class="from-control" id="pass2" onChange = "checkPassord();" placeholder="Re-Enter Password">
 							</div>
 						</div>

 						<div class="form-group">
 							<div class="col-lg-offset-5 col-lg-12" id="button1">
 								
 							</div>
 							
 						</div>


 				</form>

 			</div>

 			<div class="col-lg-1"></div>

 		</div>



		
	</main>';
	}


	function signInUser(){

		echo '<main class="container">

		<div class="row">
		<div class="col-lg-1"></div>


			<div class="col-lg-10">

 				<form class="form-horizontal" action="signup.php" method="post">
 						
 						<div class="form-group">

 							<div class="alert alert-danger" >
 								<p>Sorry that UserName is already in use!<br>Please enter a new one.</p>
 								
 							</div>

 							<label class="control-label col-lg-3" for="user">User Name:</label>
 							<div class="col-lg-9">
 								<input type="text" name="user" class="from-control" placeholder="Enter a User Name" >
 							</div>
 							
 						</div>

 						<div class="form-group">
 							<label class="control-label col-lg-3" for="first">First Name:</label>
 							<div class="col-lg-9">
 								<input type="text" name="first" class="from-control" placeholder="Enter your first name">
 							</div>
 							
 						</div>

 						<div class="form-group">
 							<label class="control-label col-lg-3" for="last">Last Name:</label>
 							<div class="col-lg-9">
 								<input type="text" name="last" class="from-control" placeholder="Enter your last name">
 							</div>
 						</div>

 						<div class="form-group">
 							<label class="control-label col-lg-3" for="email">Email:</label>
 							<div class="col-lg-9">
 								<input type="email" name="email" class="from-control" placeholder="name@email.com">
 							</div>
 							
 						</div>

 						<div class="form-group">
 							<label class="control-label col-lg-3" for="pass1">Password:</label>
 							<div class="col-lg-9">
 								<input type="password" name="pass1" class="from-control"  id="pass1" placeholder="Enter Password" >
 							</div>
 							
 						</div>

 						<div class="form-group">
 							<label class="control-label col-lg-3" for="pass2">Password:</label>
 							<div class="col-lg-9">
 								<input type="password" name="pass2" class="from-control" id="pass2" onChange = "checkPassord();" placeholder="Re-Enter Password">
 							</div>
 						</div>

 						<div class="form-group">
 							<div class="col-lg-offset-5 col-lg-12" id="button1">
 								
 							</div>
 							
 						</div>


 				</form>

 			</div>

 			<div class="col-lg-1"></div>

 		</div>



		
	</main>';

	}
?>