<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="initial-scale=1, minimum-scale=1, width=device-width" name="viewport">
    <title>Admin page</title>
</head>
<body>
    <form method="post" action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>">
        <input type="radio" name="sort" value="email">Sort by email</input>
        <input type="radio" name="sort" value="date" checked>Sort by date</input>
        <input type="Submit" name="submit" value="USE FILTERS"></input>
	<br></br>
	<label for="search">Search for email</label>
	<input type="text" id="search"  name="search"></input>
	<br></br>
	<label for="delete">Delete record by id</label>
	<input type="number" id="delete" name="delete"></input>
	<input type="Submit" name="submit" value="Delete"></input>
	<br></br>
<?php
    class See_saved_data{
		private $res, $con, $data, $row, $pieces;

		function __construct(){
			$this->con = new mysqli("localhost", "root", "test12345", "user_emails");
			if ($this->con->connect_error){
				die("connection failed: " . $this->con->connect_error);
			}
		}
        public function get_table_by_date($provaider, $search_data){
	    if ($search_data != NULL){
	        $this->res = $this->con->query("SELECT * FROM email_table WHERE email LIKE '%".$provaider."' and email LIKE '%".$search_data."%' ORDER BY reg_date;");
	    }
	    elseif ($provaider != NULL){
	        $this->res = $this->con->query("SELECT * FROM email_table WHERE email LIKE '%".$provaider."' ORDER BY reg_date;");
	    }
	    else {
			$this->res = $this->con->query("SELECT * FROM email_table ORDER BY reg_date");
	    }
	    return $this->res;
        }

	public function get_table_by_email($provaider, $search_data){
	    if ($search_data != NULL){
	        $this->res = $this->con->query("SELECT * FROM email_table WHERE email LIKE '%".$provaider."' and email LIKE '%".$search_data."%' ORDER BY email;");
	    }
	    elseif ($provaider != NULL){
	        $this->res = $this->con->query("SELECT * FROM email_table WHERE email LIKE '%".$provaider."' ORDER BY email;");
	    }
	    else {
			$this->res = $this->con->query("SELECT * FROM email_table ORDER BY email;");
	    }
            return $this->res;
    	}

	public function get_email_ends(){
	    $this->res = $this->con->query("SELECT email FROM email_table ORDER BY email");
	    $this->data = array();
		while ($this->row = $this->res->fetch_assoc()){
			$this->pieces = explode("@", $this->row["email"]);
			array_push($this->data, $this->pieces[1]);
			$this->data  = array_unique($this->data);
	    }
	    return $this->data;
	}

	public function delete_email($my_id){
	    try{
			$my_id = intval($my_id);
			$this->con->query("DELETE FROM email_table WHERE id=".$my_id);
	    	return "<b>Record with id ".$my_id." deleted!</b>";}
	    catch(Exception $e){
	    	return "<b>Error (record not deleted)</b>";}
		}
    }

    $first_table = new See_saved_data();
    $prov_data = $first_table->get_email_ends();

    foreach($prov_data as $value){
	echo "<input type='radio' name='email_ends' value='{$value}'>{$value}</input>";
    }
    $result = $first_table->get_table_by_date($_POST["email_ends"], $_POST["search"]);
    if ($_POST["sort"] == 'email'){
       $result = $first_table->get_table_by_email($_POST["email_ends"], $_POST["search"]);
    }
    else if($_POST["sort"] == 'date'){
        $result = $first_table->get_table_by_date($_POST["email_ends"], $_POST["search"]);
    }
    if ($_POST["delete"]>0){
	echo $first_table->delete_email($_POST["delete"]);
    }

    echo "<table border=1px><tr><th>ID</th><th>Email</th><th>Date</th></tr>";
    while ($row=$result->fetch_array()){
        echo "<tr><td>".$row["id"]."</td><td>".$row["email"]."</td><td>".$row["reg_date"]."</td></tr>";
    }
    echo "</table>";

?>
</form>
</body>
</html>
