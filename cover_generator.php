
<?php

  #enable error messages if you want
  $debugMode = false;
  $folder = $_GET["folder"];
  #$folder = "Javascript";
//TODO:: Check for thumbnail with file_exists() and create image if none found

// scans requested directory and filters pdf-files
// !!! DOES NOT WORK WHEN THERE IS A DIRECTORY INSIDE SCANNED DIRECTORY
$dir = scandir($folder);
$pdfs = array_filter($dir, function($x){
  $path = pathinfo( $x );
  return $path["extension"] === "pdf";
});


 /* NOT WORKING */
 function createImg($name, $dir){
   global $debugMode;

 try{
   $im = new imagick(__DIR__. '\\' . $dir. '\\'. $name . '.pdf[0]');
   $im->setResolution(300,300);
   $im->setImageFormat('jpeg');
   $im->writeImage(__DIR__.'/'.$dir . '/'. $name. '.jpg');
   $im->clear();
   $im->destroy();

 } catch(Exception $e){
   if($debugMode){
     error_log("Failed to create image " . $name.'.jpg');
   }
   copy(__DIR__.'\\placeholder.jpg', __DIR__.'/'.$dir . '/'. $name. '.jpg');
 }

}


 $jpgs = array();

// go through pdf-files and look if there's a matching cover
 foreach ($pdfs as $value) {
   $file = pathinfo($value);
   $jpgFile = $file["filename"] . ".jpg";
   # check if jpg-file exists
   if (file_exists ( $folder."/".$jpgFile )) {
     array_push($jpgs, $jpgFile);
     #if not: create file
   } else {
      createImg($file["filename"], $folder);
      array_push($jpgs, $jpgFile);
   }
 }

// format the resonse
$resultArr = array();
 foreach($pdfs as $pdf) {
   array_push($resultArr, $pdf);
 };

 $result = array("pdf"=>$resultArr, "jpg"=>$jpgs);

echo json_encode($result);


?>
