
<?php

  $folder = $_GET["folder"];
  #$folder = "Algorithmen";
//TODO:: Check for thumbnail with file_exists() and create image if none found

// scans requested directory and filters pdf-files
// !!! DOES NOT WORK WHEN THERE IS A DIRECTORY INSIDE SCANNED DIRECTORY
$dir = scandir($folder);
$pdfs = array_filter($dir, function($x){
  $path = pathinfo( $x );
  return $path["extension"] === "pdf";
});


 $jpgs = array();

// go through pdf-files and look if there's a matching cover
 foreach ($pdfs as $value) {
   $file = pathinfo($value);
   $jpgFile = $file["filename"] . ".jpg";
   if (file_exists ( $folder."/".$jpgFile )) {
     array_push($jpgs, $jpgFile);
   } else {
     array_push($jpgs, "ERROR");
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
