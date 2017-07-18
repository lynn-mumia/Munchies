
<?php
		if (isset($_POST['submit'])) {
		          function user_prompt($print_message){
					  echo "<span style='color:red;' 'font:30px'>.$print_message.</span>";
					}	
							$ok = true;
							//validating name
							if (!isset($_POST['name']) || $_POST['name'] === '') {
								$ok = false;
								user_prompt("Enter the name");						
							} else {
								$name = $_POST['name'];
							}
							//validating email
							if (!isset($_POST['email']) || $_POST['email'] === '') {
								$ok = false;
								if(!preg_match('/^\w+([\.-]?\w+)*@\w+([\.-]??\w+)*(\.\w{2,3})+$/', $_POST["email"])) {
								user_prompt ("<span style='color:red;' 'font:30px'>Enter the email address in correct format</span>");
							    }	
							} else {

								$email = $_POST['email'];
							}
							
							//validating quantity
							if (!isset($_POST['subject']) || $_POST['subject'] === '') {
								$ok = false;
								user_prompt("Enter the subject");
							} else {
								$subject = $_POST['subject'];
							}

							$message= $_POST['message'];

			   if($ok){
					/*Database details*/
					 //Valid constant names
				   define("DBHOST","localhost");
				   define("DBUSERNAME","root");
				   define("DBPASS","");
				   define("DBNAME","munchies");

				   //checking the database connection
				    $connection=mysqli_connect(DBHOST,DBUSERNAME,DBPASS,DBNAME);
				    //The sql
				    $sql="INSERT into CONTACT(name,email,subject,message) values
				    ('$name', '$email', '$subject', '$message')";

			        if($connection){
			        	echo "Connection established";
			            $query= mysqli_query($connection,$sql);
				}

           }
		 }

		if($_POST['submit']){
			$recipient="lynnmumia@gmail.com";
		    $subject="New Order placed from Website";
		    $sender=$_POST["name"];
		    $senderEmail=$_POST["email"];
		    $subject=$_POST["subject"];
		    $message=$_POST["message"];

		    echo $sender + $subject + $message;
		   
		    $mailBody="Name: $sender\nEmail: $senderEmail\n\nSubject: $subject\nMessage: $message";
		    
		    mail($recipient, $subject, $mailBody, "From: $sender <$senderEmail>");

		    $thankYou="<p>Thank you! Your message has been sent.</p>";
			}
	?>