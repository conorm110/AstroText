<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css"/>
    <title>AstroTalk</title>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">AstroTalk</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
        <li class="nav-item">
            <a class="nav-link" href="index.php">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="about.php">About</a>
        </li>
        <li class="nav-item active">
            <a class="nav-link" href="queue.php">Queue <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="tracking.php">Track </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="https://github.com/conorm110/AstroTalk">GitHub</a>
        </li>
    </div>
    </nav>

    <div class="container-fluid">

    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1 class="display-4">Queue Your Audio</h1>
            <p class="lead">
                <h3>Next AstroTalk Broadcast</h3>
                <?php
                    $json = file_get_contents('data/tracking.json');
                    $decoded_json = json_decode($json, true);
                    $next = $decoded_json['next'];
                    $nextid = $next['id'];
                    $nextloc = $next['loc'];
                    $nextdist = $next['dist'];
                    $nextdate = $next['date'];

                    echo "Tracking ID: " . $nextid;
                    echo "<br>Destination: " . $nextloc . " (" . $nextdist . " ly away)";
                    echo "<br>Broadcast (GMT): " . $nextdate;
                ?>
            </p>
        <p class="lead">
            <form action="upload.php" method="post" enctype="multipart/form-data">
            <input type="file" name="fileToUpload" id="fileToUpload">
            <input  type="submit" value="Upload Image" name="submit">
            </p>
        </form>
        </div>
    </div>
        
        <hr/>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Download</th>
                </tr>
            </thead>
            <tbody>
                    <?php
                    $fileList = glob('data/audiofiles/*.mp3');
                    $loc = 0;
                    foreach($fileList as $filename){
                        if(is_file($filename)){
                            $loc = $loc + 1;
                            $path = $filename;
                            $filename = str_replace("data/audiofiles/", "", $filename);

                            echo "<tr><th scope=\"row\">", $loc, "</th>";
                            echo "<td>", $filename, "</td>";
                            echo "<td><a href=", $path, ">Download MP3</a></td></tr>";
                        }   
                    }
                    ?>
                
            </tbody>
        </table>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>