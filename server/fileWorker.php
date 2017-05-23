<?php
    /**
     * Created by PhpStorm.
     * User: Damien
     * Date: 18/05/2017
     * Time: 11:23
     */

    function fileUploader() {
        if(count($_FILES['file-6']['name']) > 0) {
            //Loop through each file
            for($i=0; $i<count($_FILES['file-6']['name']); $i++) {
                //Get the temp file path
                $tmpFilePath = $_FILES['file-6']['tmp_name'][$i];

                //Make sure we have a filepath
                if($tmpFilePath != ""){
                    //save the filename
                    $shortname = $_FILES['file-6']['name'][$i];

                    //save the url and the file
                    $filePath = "upload/" . $_FILES['file-6']['name'][$i];

                    //Upload the file into the temp dir
                    if(move_uploaded_file($tmpFilePath, $filePath)) {
                        $files[] = $shortname;
                        //insert into db
                        //use $shortname for the filename
                        //use $filePath for the relative url to the file
                    }
                }
            }
        }

        //show success message
        if(is_array($files)) {
            echo "<script>alert('Uploaded:";
            $i = 0;
            foreach($files as $file) {
                $i++;
            }
            echo " $i file(s)');</script>";
        }

        return $files;
    }

    function fileReader($files) {
            $individuals = [];
            foreach($files as $file){
                $individuals[] = array('headline' => $file, 'bio' => file_get_contents("upload/$file"));
            }
            return $individuals;
    }