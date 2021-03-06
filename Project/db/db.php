<?php
// =======================================
// Execute Query
// =======================================
// function that returns an array of values from database
// see sample usage below
function executeQuery($query, $attribute) {
    try {
         // connect to database
        $connString = "mysql:host=localhost;dbname=knovak18";
        $user = "knovak18";
        $pass = "web2";

        $pdo = new PDO($connString,$user,$pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // create query
        $result = $pdo->query($query);

        // put query results into array
        $array = array();
        while ($row = $result->fetch()) {

            // selects the row based on the pased attribute
            $array[] = $row[$attribute];
        }
        $pdo = null;

        // return the results
        return $array;
    }
    catch (PDOException $e) {
        die( $e->getMessage() );
        return null;
    }
}

// // Execute Query - Sample Usage:
// $artists = executeQuery("select * from rruser where UserID = 1", "FirstName");
// foreach($artists as $value) {
//     // echos out "Kevin"
//     echo $value . '<br/>';
// }

// =======================================
// Create User
// =======================================
// creates a user in the database based on the passed parameters
// Sample Usage: createUser("knovak19", "web3", "knovak19@kent.edu", "Kevin", "Novak", "1993-11-29", "M");
function createUser($username, $password, $email, $firstname, $lastname, $dob, $gender, $state, $city) {
    try {
        // connect to database
        $connString = "mysql:host=localhost;dbname=knovak18";
        $user = "knovak18";
        $pass = "web2";

        $pdo = new PDO($connString,$user,$pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $statement = $pdo->prepare("INSERT INTO rruser(Username, Password, Email, FirstName, LastName, DOB, Gender, State, City)
            VALUES(:Username, :Password, :Email, :FirstName, :LastName, :DOB, :Gender, :State, :City)");
        $statement->execute(array(
            "Username" => $username,
            "Password" => $password,
            "Email" => $email,
            "FirstName" => $firstname,
            "LastName" => $lastname,
            "DOB" => $dob,
            "Gender" => $gender,
			"State" => $state,
			"City" => $city
        ));
    }
    catch (PDOException $e) {
        die( $e->getMessage() );
        return null;
    }
}

// =======================================
// Authenticate User
// =======================================
// Checks if a user with the provided password exists in the database
// returns true if yes
// Sample Usage: authUser("knovak18", "web2");
function authUser($username, $password) {
    try {
        $connString = "mysql:host=localhost;dbname=knovak18";
        $user = "knovak18";
        $pass = "web2";

        $pdo = new PDO($connString,$user,$pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "select * from rruser where Username=\"" . $username . "\"";
        $result = $pdo->query($sql);

        while ($row = $result->fetch()) {
            if($row['Password'] == $password) {
                return true;
            } else {
                return false;
            }
        }
        $pdo = null;
    }
    catch (PDOException $e) {
        die( $e->getMessage() );
    }
}

// =======================================
// Get User ID
// =======================================
// function that returns the UserID based on the passed Username
// Sample Usage: getUserID("knovak18");
// returns 1
// returns -1 if no user is found
function getUserID($username) {
	try {
         // connect to database
        $connString = "mysql:host=localhost;dbname=knovak18";
        $user = "knovak18";
        $pass = "web2";

        $pdo = new PDO($connString,$user,$pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // create query
		$sql = 'select * from rruser where Username="' . $username . '"';
        $result = $pdo->query($sql);

        // put query results into array
        $array = array();
        while ($row = $result->fetch()) {
			$id = $row['UserID'];
        }
        $pdo = null;

        // return the results
        if (!empty($id) && $id !== 0) {
            return $id;
        }
        else {
            return -1;
        }
    }
    catch (PDOException $e) {
        die( $e->getMessage() );
        return null;
    }
}


// =======================================
// checkEmail
// =======================================
// function that checks to see if the email is in the database
// Sample Usage: checkEmail("test@gmail.com")
// returns TRUE if the email is in the database
// returns FALSE if else
function checkEmail($email) {
    try {
         // connect to database
        $connString = "mysql:host=localhost;dbname=knovak18";
        $user = "knovak18";
        $pass = "web2";

        $pdo = new PDO($connString,$user,$pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // create query
        $sql = 'select * from rruser where Email="' . $email . '"';
        $result = $pdo->query($sql);

        // put query results into array
        $array = array();
        while ($row = $result->fetch()) {
            $email2 = $row['Email'];
        }
        $pdo = null;

        // return the results
        if (strcmp($email, $email2) === 0) {
            return TRUE;
        }
        else {
            return FALSE;
        }
    }
    catch (PDOException $e) {
        die( $e->getMessage() );
        return null;
    }
}

?>
