  

<?php
if(isset($_REQUEST['search']))
{
 $song=$_REQUEST['search'];
 $curl = curl_init();
 curl_setopt_array($curl, [
  CURLOPT_URL => "https://spotify23.p.rapidapi.com/search/?q=$song&type=multi&offset=0&limit=10&numberOfTopResults=5",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => [
    "X-RapidAPI-Host: spotify23.p.rapidapi.com",
    "X-RapidAPI-Key: ebdc970169mshe34e44c7ff2ac7dp108700jsn1564b1541f69"
  ],
]);
 $response = curl_exec($curl);
 $err = curl_error($curl);
 curl_close($curl);
 $response=json_decode($response,true);
 // echo $response['albums']['items']['0']['data']['uri'];
 $count=$response;
  if ($count==0)
  { 
    echo "No Records Found";

  }
  else 
  {
     $count=count($response);
  }
  // echo $count;
   // echo "<pre>";
   // print_r($response);
   // echo "</pre>";

}
?>
<!DOCTYPE html>
<html>
<head>
  <style>
    p {
       font-weight: bold;
      color: lavender;
      font-size: 20px;
    }
  </style>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Search Bar</title>
  <link rel="icon" type="image/png" href="img/spotify.png">
  <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body style="background-image: url('black.jpg');color: white">
  <nav>
    <div class="logo-area">
      <div class="tooltip">
      </div>

      <img src="img/spotify.png" style="height: 30px;" />
    </div>
    <form method="post" action="spotify.php">
      <div class="search-area">
        <div class="tooltip">
          <span class="material-icons-outlined hover">search</span>
          <span class="tooltip-text">search</span>
        </div>
        <input type="text" placeholder="What do you want to listen to" style="color:black"  name="search" />
        <input type="submit" name="save" value="Search" class="hovers" style="width: 100px;">
      </div>
    </form>
    <div class="profile-actions-area">
      <div class="tooltip">
        <span class="material-icons-outlined hover">settings</span>
        <span class="tooltip-text">Settings</span>
      </div>
      <div class="tooltip">
        <span class="material-icons-outlined hover">apps</span>
        <span class="tooltip-text">Apps</span>
      </div>
      <div class="tooltip">
        <span class="material-icons-outlined hover">account_circle</span>
        <span class="tooltip-text">Account</span>
      </div>
    </div>
  </nav>
  <div style="margin-left:40px;">
    <?php
  $counter = 0;
    ?>

    <?php
    for($i=0;$i<$count;$i++)
    {
      if(isset($response['albums']['items'][$i]['data']['artists']['items']))
  {
      $count1=count($response['albums']['items'][$i]['data']['artists']['items']);
      for($j=0;$j<$count1;$j++)
      {
        ?>

      <h1 style="color:white"><span style="color:lavender;"><?php echo ++$counter; ?></span>  Topic</h1>
        <p><?php if(isset($response['albums']['items'][$i]['data']['name']))
        {
          echo $response['albums']['items'][$i]['data']['name'];
        }  
      ?></p>
      <br>
      <br>
      <br>
      <h2 style="color: white;">Singer</h5>

      <p><?php echo $response['albums']['items'][$i]['data']['artists']['items'][$j]['profile']['name'] ?></p>
      <br>
      <br>
      <br>
      <img src="<?php echo $response['albums']['items'][$i]['data']['coverArt']['sources'][$j]['url'] ?>" width="300" height="300"></p>
      <a href="<?php echo $response['albums']['items'][$i]['data']['uri'] ?>" ><img src="play.png" height="100" width="100" style="filter: invert(100%);">`</a>
      <br/>
      <br/>
      <hr>
      <br/>
      <br/>
      <br/>
      
      <?php
    } 
  }
  }
  ?>
</div>
</body>
</html>
</body>

</html>