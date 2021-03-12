<?php

/**
 *
 * class-manager.php
 * 
 * The manager class handles all inserts and exports from the user. 
 *
 */

// prevent direct access
if(count(get_included_files()) ==1){
    http_response_code(403);
    exit("ERROR 403: Direct access not permitted.");
}

class manager{

    private $sql;

    function __construct(){ // RETURN VOID
        
        // create the SQL object. 
        $this->sql = new sqlControl();
        error_log("loaded class manager");

    }

    function insertLine(){ // RETURN BOOL
        
    }

    function addPlatform($name, $apilink, $recyclelimit, $charlimit){ // RETURN BOOL
        if($name == ''){
            // there is nothing to use 
            return false;
        }
        
        return $this->sql->sqlCommand("INSERT INTO Platforms (PlatformName, APILink, RecycleLimit, CharacterLimit) VALUES (:name, :api, :recyc, :char)", 
            array(
                ':name' => $name,
                ':api' => $apilink,
                ':recyc' => $recyclelimit,
                ':char' => $charlimit,
            ), true); 

        return false; // if somehow we don't return. This should never fire. 


    }

    function addCategory($name){ // RETURN BOOL
        if($name == ''){
            // there is nothing to use 
            return false;
        }

        // add this line to the DB. 
        return $this->sql->sqlCommand("INSERT INTO Category ( CategoryName ) VALUES (:cat)", array(':cat' => $name), true); 

        return false; // if somehow we don't return. This should never fire. 
    }

    function getPlatforms(){ // RETURN ARRAY(K->V) OR FALSE
        // return the list of platforms as an array
        
        if($this->sql->sqlCommand("SELECT ID, PlatformName FROM Platforms", array(), true) ){

            $res = $this->sql->returnAllResults();

            $retval = array();

            foreach ($res as $r){
                $retval[$r['ID']] = $r['PlatformName'];
            }

            if(count($retval) > 0){
                return $retval;
            }
        }

        // this failed, for some reason.
        return false;
    }

    function getCategories(){ // RETURN ARRAY(K-V)
        // return the list of categories as an array
        
        if($this->sql->sqlCommand("SELECT ID, CategoryName FROM Category", array(), true) ){

            $res = $this->sql->returnAllResults();

            $retval = array();

            foreach ($res as $r){
                $retval[$r['ID']] = $r['CategoryName'];
            }

            if(count($retval) > 0){
                return $retval;
            }
        }

        // this failed, for some reason.
        return false;
    }

    function exportCSV($plaftorm, $dateStart = false, $dateEnd = false){ // RETURN CSV CONTENT as JSON


    }

    
}