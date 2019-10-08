<?php 
    session_start();

    if(isset($_POST['submit'])){
        $file = $_FILES['file'];

        $fileName = $_FILES['file']['name'];
        $fileTMPName = $_FILES['file']['tmp_name'];
        $fileSize = $_FILES['file']['size'];
        $fileError = $_FILES['file']['error'];
        $fileType = $_FILES['file']['type'];

        //Get and make lowercase the file's extension
        $fileExt = explode('.', $fileName);
        $fileActualExt =strtolower(end($fileExt));

        $allowed = array('jpg', 'jpeg', 'png');

        //check if file's lowercase extension is one that is allowed
        if(in_array($fileActualExt, $allowed)){
            //Confirm no error in file
            if($fileError === 0){
                //Limit file size to 500 kb
                if($fileSize < 500000){
                    //$fileNameNew = uniqid('', true).".".$fileActualExt;
                    
                    //Set Destination to the server's img folder
                    $fileDestination = 'img/'.$fileNameNew;
                    move_uploaded_file($fileTMPName, $fileDestination);
                    header("Location: index.php?uploadsuccess");
                }
                else{
                    echo "File is too large";
                }
                
            }
            else
            {
                echo "Error Uploading File";
            }
        }
        else{
            echo "Ineligible File Type";
        }
    }

?>


<!DOCTYPE HTML>

<html>

    <body>
        <form method ="post" action = "#" enctype="multipart/form-data">
            <input type= "file" name="file">
            <button type="submit" name="submit">Upload</button>
        </form>
    </body>

</html>