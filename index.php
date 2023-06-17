

<?php
require_once 'classRecursive.php';

$parent = $recordLister->listOfParents();

?>
<html>

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <style>
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

        .lightbox-content a#closeButton {
            position: absolute;
            top: -12.5px;
            right: -12.5px;
            display: block;
            width: 30px;
            height: 30px;
            text-indent: -9999px;
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center center;
            background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADwAAAA8CAYAAAA6/NlyAAAAAXNSR0IArs4c6QAAA3hJREFUaAXlm8+K00Acx7MiCIJH/yw+gA9g25O49SL4AO3Bp1jw5NvktC+wF88qevK4BU97EmzxUBCEolK/n5gp3W6TTJPfpNPNF37MNsl85/vN/DaTmU6PknC4K+pniqeKJ3k8UnkvDxXJzzy+q/yaxxeVHxW/FNHjgRSeKt4rFoplzaAuHHDBGR2eS9G54reirsmienDCTRt7xwsp+KAoEmt9nLaGitZxrBbPFNaGfPloGw2t4JVamSt8xYW6Dg1oCYo3Yv+rCGViV160oMkcd8SYKnYV1Nb1aEOjCe6L5ZOiLfF120EjWhuBu3YIZt1NQmujnk5F4MgOpURzLfAwOBSTmzp3fpDxuI/pabxpqOoz2r2HLAb0GMbZKlNV5/Hg9XJypguryA7lPF5KMdTZQzHjqxNPhWhzIuAruOl1eNqKEx1tSh5rfbxdw7mOxCq4qS68ZTjKS1YVvilu559vWvFHhh4rZrdyZ69Vmpgdj8fJbDZLJpNJ0uv1cnr/gjrUhQMuI+ANjyuwftQ0bbL6Erp0mM/ny8Fg4M3LtdRxgMtKl3jwmIHVxYXChFy94/Rmpa/pTbNUhstKV+4Rr8lLQ9KlUvJKLyG8yvQ2s9SBy1Jb7jV5a0yapfF6apaZLjLLcWtd4sNrmJUMHyM+1xibTjH82Zh01TNlhsrOhdKTe00uAzZQmN6+KW+sDa/JD2PSVQ873m29yf+1Q9VDzfEYlHi1G5LKBBWZbtEsHbFwb1oYDwr1ZiF/2bnCSg1OBE/pfr9/bWx26UxJL3ONPISOLKUvQza0LZUxSKyjpdTGa/vDEr25rddbMM0Q3O6Lx3rqFvU+x6UrRKQY7tyrZecmD9FODy8uLizTmilwNj0kraNcAJhOp5aGVwsAGD5VmJBrWWbJSgWT9zrzWepQF47RaGSiKfeGx6Szi3gzmX/HHbihwBser4B9UJYpFBNX4R6vTn3VQnez0SymnrHQMsRYGTr1dSk34ljRqS/EMd2pLQ8YBp3a1PLfcqCpo8gtHkZFHKkTX6fs3MY0blKnth66rKCnU0VRGu37ONrQaA4eZDFtWAu2fXj9zjFkxTBOo8F7t926gTp/83Kyzzcy2kZD6xiqxTYnHLRFm3vHiRSwNSjkz3hoIzo8lCKWUlg/YtGs7tObunDAZfpDLbfEI15zsEIY3U/x/gHHc/G1zltnAgAAAABJRU5ErkJggg==);
        }
    </style>
</head>

<body>

    <h1>Member Listing</h1>
    <?php
    echo '<ul>';
    echo $recordLister->index();
    echo '</ul>';
    ?>

    <button id="addButton"  class="btn btn-primary">Add Member</button>

    <div class="lightbox" id="lightbox">
        <div class="lightbox-content">
            <a href="#" id="closeButton">times;</a>
            <h2>Add Member</h2>
            <form id="addmemfrom" method="post">
                <label for="parent">Parent:</label>
                <select name="parent" class=" form-select" required id="parent">
                    <option value="">Select One</option>
                    <?php
                    if (sizeof($parent) > 0) {
                        foreach ($parent as $value) {
                            echo '<option value="' . $value['id'] . '">' . $value['name'] . '</option>';
                        }
                    }
                    ?>
                </select>
                <label for="mem_name">Name :</label>
                <input type="text" class="form-control" required name="mem_name" id="mem_name" placeholder="Name"  >

                <input type="submit" class="btn btn-primary" value="Submit">
            </form>
          
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
        integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V"
        crossorigin="anonymous"></script>
    <script>
        $(document).ready(function () {

            $("#addButton").click(function () {
                $("#lightbox").fadeIn();
            });


            $("#closeButton").click(function () {
                $("#lightbox").fadeOut();
                $("#addmemfrom")[0].reset();
            });


            $("#addmemfrom").submit(function (event) {
                event.preventDefault();

                var parent   = $('#parent').find(":selected").val();
                var mem_name = $('#mem_name').val();

                if(parent.length === 0  || parent  === 'undefined'  ){
                    $('#parent').focus();
                    return false;
                }
                if( /^[a-zA-Z ]+$/.test(mem_name) == false  ){
                    
                    alert("only Char i allowed ")
                    return false;
                }
                

                var formData = $(this).serialize();

                formData += '&action=add_men';

                $.ajax({
                    url: "classRecursive.php",
                    method: "POST",
                    data: formData,
                    success: function (response) {
                        console.log(response);
                        //    ("#mem_"+parent);
                        if( $('#mem_'+parent).children().length > 0 ) {
                            // alert("under hai");
                            $('#mem_'+parent+' ul:last-child').append(response)
                        }else{
                            // alert("bahar hai");
                            $('#mem_'+parent).append('<ul>'+response+'</ul>');
                        }
                    
                        $("#lightbox").fadeOut();
                        $("#addmemfrom")[0].reset();
                    }
                });
            });
        });
    </script>
</body>

</html>