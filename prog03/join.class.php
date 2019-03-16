<?php
class Joinee { 
    public $id;
    public $name;
    public $email;
    public $mobile;
	public $password;
	public $password_hashed;
    private $noerrors = true;
    private $nameError = null;
    private $emailError = null;
    private $mobileError = null;
	private $passwordError = null;
    private $title = "Joinee";
    private $tableName = "customers";
    
    function create_record() { // display "create" form
        $this->generate_html_top (1);
        $this->generate_form_group("name", $this->nameError, $this->name, "autofocus");
        $this->generate_form_group("email", $this->emailError, $this->email);
        $this->generate_form_group("mobile", $this->mobileError, $this->mobile);
		$this->generate_form_group("password", $this->passwordError, $this->password);
        $this->generate_html_bottom (1);
    } // end function create_record()
    
    /*
     * This method inserts one record into the table, 
     * and redirects user to List, IF user input is valid, 
     * OTHERWISE it redirects user back to Create form, with errors
     * - Input: user data from Create form
     * - Processing: INSERT (SQL)
     * - Output: None (This method does not generate HTML code,
     *   it only changes the content of the database)
     * - Precondition: Public variables set (name, email, mobile)
     *   and database connection variables are set in datase.php.
     *   Note that $id will NOT be set because the record 
     *   will be a new record so the SQL database will "auto-number"
     * - Postcondition: New record is added to the database table, 
     *   and user is redirected to the List screen (if no errors), 
     *   or Create form (if errors)
     */
    function insert_db_record () {
        if ($this->fieldsAllValid ()) { // validate user input
            // if valid data, insert record into table
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$this->password_hashed = MD5($this->password);
            $sql = "INSERT INTO $this->tableName (name,email,mobile,password_hash) values(?, ?, ?, ?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($this->name,$this->email,$this->mobile, $this->password_hashed));
            Database::disconnect();
			ob_start();
			header("Location: logout.php");
        }
        else {
            // if not valid data, go back to "create" form, with errors
            // Note: error fields are set in fieldsAllValid ()method
            $this->create_record();
        }
    } // end function insert_db_record

    private function generate_html_top ($fun, $id=null) {
        switch ($fun) {
            case 1: // create
                $funWord = "Create"; $funNext = "insert_db_record"; 
                break;
            default: 
                echo "Error: Invalid function: generate_html_top()"; 
                exit();
                break;
        }
        echo "<!DOCTYPE html>
        <html>
            <head>
                <title>$funWord a $this->title</title>
                    ";
        echo "
                <meta charset='UTF-8'>
                <link href='https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css' rel='stylesheet'>
                <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js'></script>
                <style>label {width: 5em;}</style>
                    "; 
        echo "
            </head>";
        echo "
            <body>
                <div class='container'>
                    <div class='span10 offset1'>
                        <p class='row'>
                            <h3>$funWord a $this->title</h3>
                        </p>
                        <form class='form-horizontal' action='$this->tableName.php?fun=$funNext' method='post'>                        
                    ";
    } // end function generate_html_top()
    
    private function generate_html_bottom ($fun) {
        switch ($fun) {
            case 1: // create
                $funButton = "<button type='submit' class='btn btn-success'>Create</button>"; 
                break;
            default: 
                echo "Error: Invalid function: generate_html_bottom()"; 
                exit();
                break;
        }
        echo " 
                            <div class='form-actions'>
                                $funButton
                                <a class='btn btn-secondary' href='logout.php'>Back</a>
                            </div>
                        </form>
                    </div>

                </div> <!-- /container -->
            </body>
        </html>
                    ";
    } // end function generate_html_bottom()
    
    private function generate_form_group ($label, $labelError, $val, $modifier="") {
        echo "<div class='form-group'";
        echo !empty($labelError) ? ' alert alert-danger ' : '';
        echo "'>";
        echo "<label class='control-label'>$label &nbsp;</label>";
        //echo "<div class='controls'>";
        echo "<input "
            . "name='$label' "
            . "type='text' "
            . "$modifier "
            . "placeholder='$label' "
            . "value='";
        echo !empty($val) ? $val : '';
        echo "'>";
        if (!empty($labelError)) {
            echo "<span class='help-inline'>";
            echo "&nbsp;&nbsp;" . $labelError;
            echo "</span>";
        }
        //echo "</div>"; // end div: class='controls'
        echo "</div>"; // end div: class='form-group'
    } // end function generate_form_group()
    
    private function fieldsAllValid () {
        $valid = true;
        if (empty($this->name)) {
            $this->nameError = 'Please enter Name';
            $valid = false;
        }
        if (empty($this->email)) {
            $this->emailError = 'Please enter Email Address';
            $valid = false;
        } 
        else if ( !filter_var($this->email,FILTER_VALIDATE_EMAIL) ) {
            $this->emailError = 'Please enter a valid email address: me@mydomain.com';
            $valid = false;
        }
		
        if (empty($this->mobile)) {
            $this->mobileError = 'Please enter Mobile phone number';
            $valid = false;
        }
		
		if (empty($this->password)) {
            $this->passwordError = 'Please enter valid password';
            $valid = false;
        }
        return $valid;
    } // end function fieldsAllValid() 
    

    
} // end class Joinee

?>