<!-- <!DOCTYPE html>
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
      
        // require_once 'classRecursive.php';
        // $recordLister = new RecordLister();
        // echo '<ul>';
        // echo $recordLister->index();
        // echo '</ul>';
    ?>
</body>
</html> -->

<?php 
    require_once 'classRecursive.php';
    $recordLister = new RecordLister();
?>
<html>
<head>
    <title>Tree Structure</title>
    <style>
        ul {
            list-style-type: none;
        }

        ul ul {
            margin-left: 20px;
        }

        .lightbox {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .lightbox-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            padding: 20px;
        }
    </style>
</head>
<body>

    <h1>Tree Structure</h1>
    <?php 
        
        echo '<ul>';
        echo $recordLister->index();
        echo '</ul>'; 
        ?>

<button id="addButton">Add Entry</button>

<div class="lightbox" id="lightbox">
    <div class="lightbox-content">
        <h2>Add Entry</h2>
        <form id="entryForm">
            <label for="parent">Parent:</label>
            <select name="parent" id="parent">
                <option value="0">Root</option>
                <!-- Fetch and populate the options dynamically using PHP and PDO -->
            </select>

            <label for="label">Label:</label>
            <input type="text" name="label" id="label">

            <input type="submit" value="Submit">
        </form>
        <button id="closeButton">Close</button>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Show the lightbox when "Add Entry" button is clicked
        $("#addButton").click(function() {
            $("#lightbox").fadeIn();
        });

        // Hide the lightbox when "Close" button is clicked
        $("#closeButton").click(function() {
            $("#lightbox").fadeOut();
        });

        // Submit the form using AJAX when submitted
        $("#entryForm").submit(function(event) {
            event.preventDefault();

            var formData = $(this).serialize();

            $.ajax({
                url: "add_entry.php", // Replace with your PHP script to handle the form submission
                method: "POST",
                data: formData,
                success: function(response) {
                    // Append the new entry to the existing tree structure
                    $("#tree").append(response);

                    // Hide the lightbox
                    $("#lightbox").fadeOut();

                    // Clear the form fields
                    $("#entryForm")[0].reset();
                }
            });
        });
    });
</script>
</body>
</html>


