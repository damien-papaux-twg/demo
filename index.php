<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Demo</title>

        <!-- Bootstrap Core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="css/scrolling-nav.css" rel="stylesheet">

        <!-- Form CSS -->
        <link href="css/form.css" rel="stylesheet">

        <link rel="stylesheet" type="text/css" href="css/normalize.css" />
        <link rel="stylesheet" type="text/css" href="css/demo.css" />
        <link rel="stylesheet" type="text/css" href="css/component.css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>

    <!-- The #page-top ID is part of the scrolling feature - the data-spy and data-target are part of the built-in Bootstrap scrollspy function -->

    <body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
            <div class="container">
                <div class="navbar-header page-scroll">

                    <a class="navbar-brand page-scroll">ThisWay</a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->

                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container -->
        </nav>

        <!-- Data Section -->
        <section id="data" class="intro-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h1>Demo</h1>
                        <div class="container">
                            <div class="row">
                                <!-- CV Column -->
                                <form action="" method="post" id="files" enctype="multipart/form-data">
                                    <input type="hidden" name="formSent">
                                    <div class="col-sm-6">
                                        <h2>CV</h2>
                                        <p>Use .txt files only</p>
                                        <div style="height:20px;"></div>
                                        <div class="content">
                                            <input type="file" name="file-6[]" value="set" style="display: none;" id="file-6" class="inputfile inputfile-5" data-multiple-caption="{count} files selected" multiple />
                                            <label for="file-6"><figure><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg></figure> <span></span></label>
                                            <div style="height:5px;"></div>
                                            <!-- <input type="submit"> -->
                                        </div>
                                    </div>

                                    <!-- Job Column -->
                                    <div class="col-sm-6">
                                        <h2>Job</h2>
                                        <ul class="form-style-1">
                                            <li>
                                                <label>Title<span class="required">*</span></label>
                                                <input name="jobTitle" class="field-long" id="jobTitle"/>
                                            </li>
                                            <li>
                                                <label>Description<span class="required">*</span></label>
                                                <textarea name="jobDescription" id="jobDescription" class="field-long field-textarea"></textarea>
                                            </li>
                                        </ul>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- onclick="fileTreatment()" -->
                        <div style="height:80px;"></div>
                        <a onclick="document.getElementById('files').submit()" class="btn btn-default page-scroll" href="#result">Submit</a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Result Section -->
        <section id="result" class="about-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h1>Results</h1>
                        <a class="btn btn-default page-scroll" href="#data">Click to test again</a>
                    </div>
                </div>
            </div>
        </section>

        <!-- File Upload -->
        <script src="js/custom-file-input.js"></script>

        <!-- jQuery -->
        <script src="js/jquery.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="js/bootstrap.min.js"></script>

        <!-- Scrolling Nav JavaScript -->
        <script src="js/jquery.easing.min.js"></script>
        <script src="js/scrolling-nav.js"></script>
        
        <!-- <script src="js/worker.js"></script> -->
    </body>

</html>

<?php
    include_once('server/fileWorker.php');
    include_once('server/dbRequests.php');

    if(isset($_POST['formSent'])) {

        //echo $_FILES["file-6"]['name'][0];
        if ($_FILES["file-6"]['name'][0] !== '' && !empty($_POST['jobTitle']) && !empty($_POST['jobDescription'])) {
            $files = fileUploader();
            $jobTitle = $_POST['jobTitle'];
            $jobDescription = $_POST['jobDescription'];

            if (!empty($files)) {
                $individuals = fileReader($files);

                if (!empty($individuals)) {
                    insertIndividuals($individuals);
                    insertJob($jobTitle, $jobDescription);
                }
            }
        } else {
            //echo "<script>alert('Please upload CVs');</script>";
            if ($_FILES["file-6"]['name'][0] === '') {
                echo "<script>alert('Please upload CVs');</script>";
            }

            if (empty($_POST['jobTitle'])) {
                echo "<script>alert('Please fill Title field');</script>";
            }

            if (empty($_POST['jobDescription'])) {
                echo "<script>alert('Please fill Description field');</script>";
            }
        }
    }
?>
