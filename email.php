<?php
    class Email{
	private $con, $res, $sql;

        public function validate_email($my_email, $terms){
	    $my_email = trim($my_email);
	    $my_email = stripslashes($my_email);
	    $my_email = htmlspecialchars($my_email);
            if ($my_email == 0 or $my_email == NULL){
                return "Email address is required";
            }
            elseif (substr($my_email, -3) == ".co"){
                return "We are not accepting subscriptions from Colombia emails<style>#submit{opacity = 0.3;</style>";
            }
            else if ($terms == false){
                return "You must accept the terms and conditions<style>#submit{opacity = 0.3;</style>";
            }
            else if (preg_match('/^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i', $my_email)){
		$this->res = $this->add_email($my_email);
		return $this->res;

            }
            else {
                return "Please provide a valid e-mail address<style>#submit{opacity = 0.3;</style>";
            }
        }
        private function add_email($my_emaill){
            $this->con = new mysqli("localhost", "root", "test12345", "user_emails");
            if ($this->con->connect_error){
                die("connection failed: " . $this->con->connect_error);
            }
            $this->sql = "INSERT INTO email_table (email) VALUES ('$my_emaill');";
            if ($this->con->query($this->sql) === TRUE){
                return "<style>.content{display: none;} #valid_email{display: block;}</style>";
            }
            return "You got an unexpected server error!";
        }
    }
?>
