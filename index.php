<!DOCTYPE html>
<html>
<head>
    <title>practice</title>
    <style>
        ul {
            list-style-type: none;
        }

        ul ul {
            margin-left: 15px;
        }
    </style>
</head>
<body>
    <h1> Listing </h1>
    <?php
      
        require_once 'classRecursive.php';
        $recordLister = new RecordLister();
        echo '<ul>';
        echo $recordLister->index();
        echo '</ul>';
    ?>
</body>
</html>




