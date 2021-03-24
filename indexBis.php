<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!--font google -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <!--link css-->
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <div id="content">

        <?php
        try
        {
          $bdd = new PDO('mysql:host=localhost;dbname=photos;charset=utf8', 'root', 'root');
    
            echo 'tout est carré !';
        }
        catch(Exception $e)
        {
                die('Erreur : '.$e->getMessage());
    
        }

        $result = $bdd ->query(" SELECT * FROM images ");

        while ($row = $result->fetch()){
            echo "<div id='img_div'>";
                echo "<img src='images/".$row['image']."'>";
                echo "<p>".$row['text']."</p>";
            echo "</div>";    
        }





        ?>
        <form action="indexBis.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="size" value="100000">
            <div>
                <input type="file" name="image">
            </div>
            <div>
                <textarea name="text" placeholder="Say something about this image ..." cols="40" rows="4"></textarea>
            </div>
            <div>
                <input type="submit" name="upload" value="Upload Image">
            </div>
        </form>
    </div>

    <?php
    try
    {
      $bdd = new PDO('mysql:host=localhost;dbname=photos;charset=utf8', 'root', 'root');

        echo 'tout est carré !';
    }
    catch(Exception $e)
    {
            die('Erreur : '.$e->getMessage());

    }
    
    
    ?>


    <?php

    //if upload button is pressed
    if(isset($_POST['upload'])){
        //the path to store the uploaded image
        $target ="images/".basename($_FILES['image']['name']);

        //connect to database

        try
        {
          $bdd = new PDO('mysql:host=localhost;dbname=photos;charset=utf8', 'root', 'root');
    
            echo 'tout est carré !';
        }
        catch(Exception $e)
        {
                die('Erreur : '.$e->getMessage());
    
        }
        // get all the submitted data from the form
        $image = $_FILES['image']['name'];
        $text = $_POST['text'];

        //store the submitted data into the database table: images
        $bdd ->query("INSERT INTO images (image,text) VALUES ('$image','$text')");
        
        //Now let's move the uploaded image into the forlder: images
        if(move_uploaded_file($_FILES['image']['tmp_name'],$target)){
            $msg ="Image uploaded successfully";
        }
        else{
            $msg = "there was a problem uploading image";
        }


        
    }
    


    
    ?>
</body>
</html>