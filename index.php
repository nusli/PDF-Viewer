<!DOCTYPE html>
<html>
<head>
<meta charset="utf8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Book Club</title>
<script src="jquery-3.2.1.js"></script>
<link rel="stylesheet" type="text/css" href="style.css">
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css"/>
<link href="https://fonts.googleapis.com/css?family=Lora&text=BokkClub" rel="stylesheet">
</head>
<body>
  <div class="wrapper">
    <!-- Header -->
    <div class="header">
      <h1><i class="fa fa-book"></i>Book Club</h1>
    </div>
    <!-- Only shown in portrait view -->
    <div class="list" id="open">
      <p id="openText"><i class="fa fa-bars"></i> AbookApart</p>
    </div>
    <!-- navbar -->
    <div class="navbar">
    <ul class="white">
      <?php
      // Scans all directories and add them as navbar elements
			$dir = scandir(__DIR__);
      $dir = array_filter($dir, function($x){
        return is_dir($x) && $x !== "." && $x !== "..";
      });

			foreach ($dir as $value){ ?>

				<li class="list"><?php echo $value ?></li>

			<?php
			}
		?>
    </ul>
  </div>
  <!-- The list of the books (filled with javascript)-->
  <div class="content">
  </div>
</div>
<script src="script.js"></script>
</body>
</html>
