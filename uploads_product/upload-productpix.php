<?php
$page_title = 'Deyssbling International';
?>
<?php  include ('./inc/header.inc.php');

include('./func/blogthumb.func.php');
$code = urldecode($_GET['code']);

if(!isset($_SESSION["user_admin"] )){

  header('Location: index.php');
  exit();
}

 ?>

<div class="breadcrumb-area section-padding-1 bg-gray breadcrumb-ptb-1">
            <div class="container-fluid">
                <div class="breadcrumb-content text-center">
                    <div class="breadcrumb-title">
                        <h2>Upload Product 2</h2>
                    </div>
                    <ul>
                        <li>
                            <a href="admin2">Admin Page</a>
                        </li>
                        <li><span> > </span></li>
                        <li class="active"> Upload Product 2 </li>
                    </ul>
                </div>
            </div>
 </div>




<?php

function correctImageOrientation($filename) {
  if (function_exists('exif_read_data')) {
    $exif = @exif_read_data($filename);
    if($exif && isset($exif['Orientation'])) {
      $orientation = $exif['Orientation'];
      if($orientation != 1){
        $img = imagecreatefromjpeg($filename);
        $deg = 0;
        switch ($orientation) {
          case 3:
            $deg = 180;
            break;
          case 6:
            $deg = 270;
            break;
          case 8:
            $deg = 90;
            break;
        }
        if ($deg) {
          $img = imagerotate($img, $deg, 0);       
        }
        // then rewrite the rotated image back to the disk as $filename
        imagejpeg($img, $filename, 95);
      } // if there is some rotation necessary
    } // if have the exif orientation info
  } // if function exists     
}


  //to update profile pix
  //to process the form starts here
if(isset($_POST['submit'])){



$allowed_ext = array('jpg', 'jpeg', 'png', 'gif');



  $image_name1 = $_FILES['file1']['name'];
  $image_size1 = $_FILES['file1']['size'];
  $image_temp1 = $_FILES['file1']['tmp_name'];
 $image_ext1 = @strtolower(end(explode('.', $image_name1)));


  $image_name2 = $_FILES['file2']['name'];
  $image_size2 = $_FILES['file2']['size'];
  $image_temp2 = $_FILES['file2']['tmp_name'];
  $image_ext2 = @strtolower(end(explode('.', $image_name2)));

   $image_name4 = $_FILES['file4']['name'];
  $image_size4 = $_FILES['file4']['size'];
  $image_temp4 = $_FILES['file4']['tmp_name'];
  $image_ext4 = @strtolower(end(explode('.', $image_name4)));

   $image_name3 = $_FILES['file3']['name'];
  $image_size3 = $_FILES['file3']['size'];
  $image_temp3 = $_FILES['file3']['tmp_name'];
  $image_ext3 = @strtolower(end(explode('.', $image_name3)));




  //strtolower becasue file ext names can be capitalized
  // explode function will separate the values from the dot, and the end function will select the last value e.g photo . jpeg
  $errors = array();
  
  if(empty($image_name1 || $image_name2 || $image_name3 || $image_name4)){
    $errors[] = 'Please choose atleast one file';
      }
  else{


    if($image_name1 && in_array($image_ext1 , $allowed_ext) === false){
      $errors[] = 'File 1 type not allowed';
      }
    

    
       if($image_name2 && in_array($image_ext2 , $allowed_ext) === false){
      $errors[] = 'File 2 type not allowed';
      }
    

 
      if($image_name3 && in_array($image_ext3 , $allowed_ext) === false){
      $errors[] = 'File 3 type not allowed';
      }
    

  
      if($image_name4 && in_array($image_ext4 , $allowed_ext) === false){
      $errors[] = 'File 4 type not allowed';
      }
    

    // if($image_size1 > 900000 || $image_size2 > 900000 || $image_size3 > 900000 || $image_size4 > 900000){
    //   $errors[] = 'None of the file must exceed 9MB';  
    // }
    
  }
  if(!empty($errors)){
    foreach($errors as $errormsg){
      //echo '<div class="error1">'.$errormsg.'</div><br>';
      
      }
    }
    else{
    

   $image_file1 = $image_name1;
   $image_file2 = $image_name2;
   $image_file3 = $image_name3;
   $image_file4 = $image_name4;



    //to rename...........
$filename1   = uniqid() . "-" . time(); // 5dab1961e93a7-1571494241
$extension1  = pathinfo( $image_name1, PATHINFO_EXTENSION ); // jpg
$image_file1   = $filename1 . "." . $extension1; // 5dab1961e93a7_1571494241.jpg


$filename2   = uniqid() . "-" . time(); // 5dab1961e93a7-1571494241
$extension2  = pathinfo( $image_name2, PATHINFO_EXTENSION ); // jpg
$image_file2   = $filename2 . "." . $extension2; // 5dab1961e93a7_1571494241.jpg


$filename3   = uniqid() . "-" . time(); // 5dab1961e93a7-1571494241
$extension3  = pathinfo( $image_name3, PATHINFO_EXTENSION ); // jpg
$image_file3   = $filename3 . "." . $extension3; // 5dab1961e93a7_1571494241.jpg

$filename4   = uniqid() . "-" . time(); // 5dab1961e93a7-1571494241
$extension4  = pathinfo( $image_name4, PATHINFO_EXTENSION ); // jpg
$image_file4   = $filename4 . "." . $extension4; // 5dab1961e93a7_1571494241.jpg
//to rename...........

  move_uploaded_file($image_temp1, 'uploads_product/album/'.$image_file1);
  move_uploaded_file($image_temp2, 'uploads_product/album/'.$image_file2);
  move_uploaded_file($image_temp3, 'uploads_product/album/'.$image_file3);
  move_uploaded_file($image_temp4, 'uploads_product/album/'.$image_file4);

  correctImageOrientation('uploads_product/album/'.$image_file1);
correctImageOrientation('uploads_product/album/'.$image_file2);
correctImageOrientation('uploads_product/album/'.$image_file3);
correctImageOrientation('uploads_product/album/'.$image_file4);

 
 
 if($image_file1){
  $profilepix1 = "uploads_product/thumbs/$image_file1";
  create_thumb('uploads_product/album/', $image_file1, $profilepix1);
}
else{
  $profilepix1 = '';
}

if($image_file2){
  $profilepix2 = "uploads_product/thumbs/$image_file2";
  create_thumb('uploads_product/album/', $image_file2, $profilepix2);
}
else{
  $profilepix2 = '';
}

 if($image_file3){ 
  $profilepix3 = "uploads_product/thumbs/$image_file3";
  create_thumb('uploads_product/album/', $image_file3, $profilepix3);
}
else{
  $profilepix3 = '';
}

if($image_file4){
  $profilepix4 = "uploads_product/thumbs/$image_file4";
  create_thumb('uploads_product/album/', $image_file4, $profilepix4);
}
else{
  $profilepix4 = '';
}

 //unlink('uploads/album/'.$image_file);




mysqli_query($con,"UPDATE products SET pix1='$image_file1', pix2='$image_file2', pix3='$image_file3', pix4='$image_file4'  WHERE code = '$code'  ") or die(mysqli_error());
  
   $successmsg = 'Congratulations, you have successfully uploaded the product';
  
   '<br>';
  
      }
  }
//to process the form ends here
?>



        <div class="login-register-area pt-95 pb-100">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        
                    </div>
                    <div class="col-lg-6 col-md-6">
                      <?php if (isset($errorpost)) : ?>
                           <div class="error1"><?php echo $errorpost; ?></div>  
                     <?php endif; ?>
                     <?php if (isset($success)) : ?>
                           <div class="success1"><?php echo $success; ?></div>  
                    <?php endif; ?>
                        
            <div class="login-register-wrap mr-70">
                            <h3> Upload products here</h3>
                            <div class="login-register-form">
                                <form action="" method="post" enctype="multipart/form-data">
                                   
                                  <?php if(isset($successmsg)) : ?>   
    <?php if (isset($successmsg)) : ?>
           <div class="success1"><?php echo $successmsg; ?></div> 
           <a class="btn btn-13 btn-submit" href="upload-product"> Go back To Upload Product</a>
    <?php endif; ?>
<?php else : ?>

               <?php if (isset($errormsg)) : ?>
           <div class="error1"><?php echo $errormsg; ?></div> 
     <?php endif; ?>
     <?php if (isset($successmsg)) : ?>
           <div class="success1"><?php echo $successmsg; ?></div> 
    <?php endif; ?>
      <div class="sin-login-register">
      <input name="file1" type="file">
      </div>
      <div class="sin-login-register">
      <input name="file2" type="file">
      </div>
      <div class="sin-login-register">
      <input name="file3" type="file">
      </div>
      <div class="sin-login-register">
      <input name="file4" type="file">
      </div>
       




                                     <div class="login-register-btn-remember">
                                        <div class="login-register-btn btn-block">
                                            <button type="submit" name="submit">Upload Picture</button>
                                        </div>
                                        
                                    </div>

                                     <?php endif; ?> 




<!--                                     <a href="#">Lost your password?</a> -->
                                </form>
                            </div>


                         </div>
                    </div>
                </div>
            </div>
        </div>
        

<?php  include ('./inc/footer.inc.php'); ?>