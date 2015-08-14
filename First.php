<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Abacuz</title>
    <meta name="author" content="Gary Carter">
    <meta name="description" content="Abacuz - It is coming">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>


</head>

<?php if ($_SERVER[ "REQUEST_URI"]="/second.php" ) { $test='<li><a href="fred.html">' ; $home='<li class="active"><a href="#">' ; $people=' class="active"' ; } else {$test='<li class="active"><a href="#">' ; $home='<li><a href="index.html">' ; $people=' ' ; } ?>

<body>
    <div class="container">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Abacuz</a>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav">
                        <?php echo $home ; ?> Home</a>
                        </li>
                        <li <?php echo $people ; ?> class="dropdown" >
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">People 4 <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <?php echo $test ; ?>Testing Page</a>
                        </li>
                        </ul>

                    </ul>

                </div>
            </div>
        </nav>
        My first PHP script!
        <?php echo __FILE__ ; ?>
        <?php echo basename(__FILE__, '.php'); ?>
        <?php echo $_SERVER[ "SCRIPT_NAME"] ; ?>
        <?php echo $_SERVER[ "REQUEST_URI"] ; ?>

    </div>
</body>