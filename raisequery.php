<?php
include_once 'includes/header.php';
include_once 'includes/dbcon.php';
if($_SESSION['type']!=="citizen")
{
    exit("You must login as citizen to view this page");
}
if(isset($_POST["submit"]))
{
    $image=mysqli_real_escape_string($con,"images/citizenuploads/".uniqid('',true).$_FILES["image"]["name"]);
    $description=mysqli_real_escape_string($con,$_POST["description"]);
    $location=mysqli_real_escape_string($con,$_POST["location"]);
    $uid=$_SESSION["id"];
    
    if(copy($_FILES["image"]["tmp_name"],$image))
      {

        $sql="INSERT INTO query(citizenid,image,description,location) VALUES('$uid','$image','$description','$location')";
        $result=mysqli_query($con,$sql);
        if($result)
        { 
            $_SESSION["message"]="Query raised successfully!";
        
        }
        else{$_SESSION["message"]="Server error please try after some time";}
     }
      else
     {
      $_SESSION['message']='File upload failed';
     }
}




?>
<link rel="stylesheet" href="css/signuplogin.css" type="text/css">
<section>
  
  <h3 style="position:fixed; left:15%; top:170px; font-family: Verdana, Geneva, Tahoma, sans-serif;color:white;font-weight: 500;">Select Location</h3>
  <div id="map" style="height:400px; width:400px; left:5%; top:200px"></div>
  <script async
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDslrStOct7ey62gWE754DTCm7lc8nUXOY&callback=initMap&libraries=&v=weekly"
    defer
  ></script>

  <script>
    function initMap() 
    {
      var location = { lat: 19.9615, lng: 79.2961 };
      const map = new google.maps.Map(document.getElementById("map"), {
        zoom: 15,
        center: location,
      });
      const marker = new google.maps.Marker({
        position:location,
        map: map,
        });
        
      map.addListener("click", (mapsMouseEvent) => {
        
        document.getElementById("location").value=mapsMouseEvent.latLng;
        marker.setPosition(mapsMouseEvent.latLng);

      });


    }
  </script>
</section>
<section class="cbody">
    <h2> Raise Query</h2>
    <form action="raisequery.php" method="post" enctype="multipart/form-data">
    <div class="inf"><?= $_SESSION['message'] ?></div>
        <label>Select image of the query: </label><input type="file" name="image" accept="image/*"  required><br><br>
        <input type="text" name="description" placeholder=" Add Description" required >
        <input type="text" name="location" id="location" placeholder="Select location from Map" required >
        <input type="submit" name="submit" value="Raise Query" class="btn btn-block btn-primary">
    </form>
</section>


<?php
    include_once 'includes/footer.php';
?>