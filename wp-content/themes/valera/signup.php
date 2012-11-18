    <?php  
    /* 
    Template Name: Custom WordPress Login 
    */  
    global $user_ID;  
      
    if (!$user_ID) {  
      
    if($_POST){  
    //We shall SQL escape all inputs  
    $username = $wpdb->escape($_REQUEST['username']);  
    $password = $wpdb->escape($_REQUEST['password']);  
    $remember = $wpdb->escape($_REQUEST['rememberme']);  
      
    if($remember) $remember = "true";  
    else $remember = "false";  
    $login_data = array();  
    $login_data['user_login'] = $username;  
    $login_data['user_password'] = $password;  
    $login_data['remember'] = $remember;  
    $user_verify = wp_signon( $login_data, true );   
          
    if ( is_wp_error($user_verify) )   
    {  
       echo "<span class='error'>Invalid username or password. Please try again!</span>";  
       exit();  
     } else   
     {    
       echo "<script type='text/javascript'>window.location='". get_bloginfo('url') ."'</script>";  
       exit();  
     }  
    } else {   
      
    get_header();  
      
    ?>  
    <div id="container">  
    <div id="content">  
      
    <!--?php the_title(); ?-->  
      
    <div id="result"></div> <!-- To hold validation results -->  
    <form id="wp_login_form" action="" method="post">  
      
    <label>Username</label><br>  
    <input name="username" class="text" value="" type="text"><br>  
    <label>Password</label><br>  
    <input name="password" class="text" value="" type="password"> <br>  
    <label>  
    <input name="rememberme" value="forever" type="checkbox">Remember me</label>  
    <br><br>  
    <input id="submitbtn" name="submit" value="Login" type="submit">  
      
    </form>  
      
    <script type="text/javascript">                           
    $("#submitbtn").click(function() {  
      
    $('#result').html('<img src="<?php bloginfo('template_url'); ?>/images/loader.gif" class="loader" />').fadeIn();  
    var input_data = $('#wp_login_form').serialize();  
    $.ajax({  
    type: "POST",  
    url:  "<?php echo "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>",  
    data: input_data,  
    success: function(msg){  
    $('.loader').remove();  
    $('<div>').html(msg).appendTo('div#result').hide().fadeIn('slow');  
    }  
    });  
    return false;  
      
    });  
    </script>  
      
    </div>  
    </div>  
    <?php  
      
    get_footer();  
        }  
    }  
    else {  
        echo "<script type='text/javascript'-->window.location='". get_bloginfo('url') ."'";  
    }  
    ?>  




<?php
/*
Template Name: ALTERNATIVE USER REG
*/
	// FUNCTION TO PREVENT DATABASE ATTACK - BEGIN
		function check_input($value){

			// Stripslashes
			if (get_magic_quotes_gpc()){
				$value = stripslashes($value);
			}

			// Quote if not a number
			if (!is_numeric($value)){
				$value = mysql_real_escape_string($value);
			}
			return $value;
		}
	// FUNCTION TO PREVENT DATABASE ATTACK - END

	// CHECK TO SEE IF FORM HAS BEEN SUBMITTED
	if($_POST['SubmitCheck']==1){

		// CHECK TO ENSURE THAT USERNAME & PASSWORD FIELDS HAVE BEEN FILLED IN
		if((trim($_POST['UserName'])=="") || (trim($_POST['Email'])=="")){
			echo "Please enter a valid Username/Password";
		}
		else{

			//GET VALUES SUBMITTED VIA FORM
			$user_name = check_input($_POST['UserName']);
			$user_email = check_input($_POST['Email']);

			// GET REQUIRED WORDPRESS LIBRARIES
			require_once(ABSPATH . WPINC . '/registration.php');
			require_once(ABSPATH . WPINC . '/pluggable.php');

			// CHECK WHETHER USERNAME EXISTS
			if(username_exists($user_name)){
				echo "This username already exists. Please enter another.";
			}
			else{

				// CHECK WHETHER EMAIL ALREADY EXISTS
				if(email_exists($user_email)){
					echo "This email already exists. Please enter another.";
				}
				else{

					// GENERATE A RANDOM PASSWORD
					$random_password = wp_generate_password( 12, false );				

					//CREATE THE WORDPRESS USER
					$user_id = wp_create_user( $user_name, $random_password, $user_email );				

					// SEND USER AND DATABASE ADMIN THE NOTIFICATION EMAIL
					wp_new_user_notification( $user_id, $plaintext_pass );

					// THANK YOU MESSAGE
					echo "Thank you for registering. Please check your email.";			

				}
			}
		}
	}
	else{

		// IF THE FORM HASN'T BEEN SUBMITTED, OUTPUT THE REGISTRATION FORM

		echo	'<form name="input" action="'.get_permalink().'" method="post">';

		echo		'<p>Username:<br /><input type="text" name="UserName" /></p>';
		echo		'<p>Email:<br /><input type="text" name="Email" /></p>';
		echo		'<input type="hidden" name="SubmitCheck" value="1" />';
		echo		'<p><input type="submit" value="Submit" /></p>';

		echo	'</form>';

	}

// By James Alex Hall at http://www.jamesalexhall.co.uk

?>