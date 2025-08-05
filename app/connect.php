<?php


// This file handles function closely related to the database i.e acts
// like a migration file but does extra such as query functions
// Note that our DB parameters/variables are coming from the config file

/*
//////////////////// NON PDO ////////////////////

// NON PDO CONNECTION
try {
    $conn = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
} catch (mysqli_sql_exception) {
    echo "Database Connection Error: " . mysqli_connect_error() . "<br>";
};

// GENERAL QUERY FUNCTION
function query(string $sql_query){
    global $conn;
    try {
        $result = mysqli_query($conn, $sql_query);
    } catch (Exception $e) {
        echo "Oops.. Could not fetch data!";
    };

    if (!empty($result)) {
        return $result;
    }
    return false;
}

// FUNCTION TO QUERY ALL ITEMS FROM A TABLE
function query_select_all(string $table){
    global $conn;
    try {
        $sql_query = "SELECT * FROM $table";
        $result = mysqli_query($conn, $sql_query);
    } catch (Exception $e) {
        echo "Oops.. Could not fetch data!";
    };

    if (!empty($result)) {
        return $result;
    }
    return false;
}
*/



//////////////////// PDO ////////////////////

// FUNCTION TO DROP TABLES
function drop_table(string $table) {
    // Making a connection using PDO
    $string = "mysql:hostname=".DBHOST.";"."dbname=".DBNAME.";";
    $con = new PDO($string, DBUSER, DBPASS);

    $query = "drop table if exists $table";
    $statement = $con->prepare($query);
    $statement->execute();
}

// GENERAL QUERY FUNCTION FOR PDO
function query_db(string $query, array $data = []) {
    /*
    Remember that the passed in query string must have postponed parameters
    or values which is to be provided later using $data array passed into the
    function as well i.e

    $query = "insert into users (username, password) values (:username, :password)";

    or

    $query = "update users set username = :username, email = :email where id = 1 limit 1";

    :username and :password indicates to be provided later or during query execution

    $data == [] by default which won't cause errors when not inserting values which means
    we can also use this function to fetch and delete from DB
    */


    // Making a connection using PDO
    $string = "mysql:hostname=".DBHOST.";"."dbname=".DBNAME.";";
    $con = new PDO($string, DBUSER, DBPASS);

    $statement = $con->prepare($query);
    $statement->execute($data);

    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    if (is_array($result) && !empty($result)) {
        return $result;
    }
    return [];
}

// QUERY FUNCTION TO FETCH WITH PDO
function query_fetch(string $query) {
    // Making a connection using PDO
    $string = "mysql:hostname=".DBHOST.";"."dbname=".DBNAME.";";
    $con = new PDO($string, DBUSER, DBPASS);

    $result = $con->query($query);
    $result = $result->fetchAll(PDO::FETCH_ASSOC);

    if (is_array($result) && !empty($result)) {
        return $result;
    }
    return [];
}

// QUERY FUNCTION TO USE TRANSACTIONS WITH PDO
function query_transaction(callable $callback) {
    $string = "mysql:hostname=".DBHOST.";"."dbname=".DBNAME.";";
    $con = new PDO($string, DBUSER, DBPASS);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    try {
        $con->beginTransaction();
        $callback($con); // Run all DB logic passed in
        $con->commit();
    } catch (Exception $e) {
        $con->rollBack();
        throw $e;
    }
}

// QUERY FUNCTION TO INSERT AND RETURN ID OF INSERTED ITEM
function query_return_id(string $query, array $data = []) {
    // Making a connection using PDO
    $string = "mysql:hostname=".DBHOST.";"."dbname=".DBNAME.";";
    $con = new PDO($string, DBUSER, DBPASS);

    try {
        // Prepare and execute the insert query
        $statement = $con->prepare($query);
        $statement->execute($data);
        // Retrieve the ID of the inserted row
        $last_insert_id = $con->lastInsertId();
        return $last_insert_id;
    } catch(Exception) {
        return null;
    }
}