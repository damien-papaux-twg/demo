<?php
/**
 * Created by PhpStorm.
 * User: Damien
 * Date: 18/05/2017
 * Time: 11:55
 * @param $individuals
 */
    function insertIndividuals($individuals) {
        // Code below for connection to remote database !!!!!!!! SSL Problem !!!!!!!!

        //include_once('configConnection.php');

        /*try {


            $mng = new MongoDB\Driver\Manager("mongodb://gpsbaxuser:42R33egB6nD4Blw@aws-eu-west-1-portal.6.dblayer.com:10027/gps-baxter?ssl=true");
            //("mongodb://".DB_USER.":".DB_PASS."@".DB_HOST."/".DB_NAME."?SSL=TRUE")
            $query = new MongoDB\Driver\Query([]);

            $row = $mng->executeQuery("gps-baxter.individuals", $query);

            foreach($row as $indi) {
                echo $indi->bio;
            }
            echo "Connected";

            //"mongodb://".DB_USER.":".DB_PASS."@".DB_HOST."/".DB_NAME."?SSL=TRUE"

            //$stats = new MongoDB\Driver\Command(["dbstats" => 1]);
            //$res = $mng->executeCommand("test", $stats);

            //$stats = current($res->toArray());

            //print_r($stats);


        }*/


        try {

            // Connection to the local MongoDB
            $mng = new MongoDB\Driver\Manager(/*No need to specify anything if it's local and default port*/);

            foreach($individuals as $indi) {

                $headline = $indi['headline'];
                $bio = $indi['bio'];

                // Query to check if this CV is already in the db
                $filter = ['headline' => $headline, 'bio' => $bio];
                $query = new MongoDB\Driver\Query($filter);
                $res = $mng->executeQuery('demo.individuals', $query);
                $indiExists = current($res->toArray());

                // If it is already in the db we get its Id
                if (!empty($indiExists)) {
                    $bsonId = $indiExists->_id;
                    $_id = (string)$bsonId;
                    echo 'individual : '.$_id.'<br>';

                    // If not we insert it and then get the returned Id
                } else {
                    // Bulkwrite allows to do write operations
                    $bulk = new MongoDB\Driver\BulkWrite;

                    $doc = ['headline' => $headline, 'bio' => $bio];
                    $bsonId = $bulk->insert($doc);

                    $mng->executeBulkWrite('demo.individuals', $bulk);

                    $_id = (string)$bsonId;
                    echo 'individual : '.$_id.'<br>';
                }
            }

        } catch (MongoDB\Driver\Exception\Exception $e) {

            $filename = basename(__FILE__);

            echo "The $filename script has experienced an error.\n";
            echo "It failed with the following exception:\n";

            echo "Exception:", $e->getMessage(), "\n";
            echo "In file:", $e->getFile(), "\n";
            echo "On line:", $e->getLine(), "\n";
        }
    }

    function insertJob($title, $description) {
        // Connection to the local MongoDB
        $mng = new MongoDB\Driver\Manager(/*No need to specify anything if it's local and default port*/);

        try {

            // Query to check if this CV is already in the db
            $filter = ['title' => $title, 'description' => $description];
            $query = new MongoDB\Driver\Query($filter);
            $res = $mng->executeQuery('demo.jobs', $query);
            $jobExists = current($res->toArray());

            // If it is already in the db we get its Id
            if (!empty($jobExists)) {
                $bsonId = $jobExists->_id;
                $_id = (string)$bsonId;
                echo 'job : '.$_id.'<br>';

                // If not we insert it and then get the returned Id
            } else {
                // Bulkwrite allows to do write operations
                $bulk = new MongoDB\Driver\BulkWrite;

                $doc = ['title' => $title, 'description' => $description];
                $bsonId = $bulk->insert($doc);

                $mng->executeBulkWrite('demo.jobs', $bulk);

                $_id = (string)$bsonId;
                echo 'job : '.$_id.'<br>';
            }

        } catch (MongoDB\Driver\Exception\Exception $e) {

            $filename = basename(__FILE__);

            echo "The $filename script has experienced an error.\n";
            echo "It failed with the following exception:\n";

            echo "Exception:", $e->getMessage(), "\n";
            echo "In file:", $e->getFile(), "\n";
            echo "On line:", $e->getLine(), "\n";
        }
    }