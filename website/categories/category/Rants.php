<!DOCTYPE html>
<head>
		<meta charset="utf-8">
		<title>CSUN Connect Home</title>
		<link rel="stylesheet" type="text/css" href="../../main.css">
		<link rel="icon" href="../../img/favicon.ico" type="image/x-icon"> 
		<script src="pace.js" type="text/javascript"></script><script src="./pace/pace.js" type="text/javascript"></script>
		<link href="./pace/themes/theme.css" rel="stylesheet" />
	</head>
	
	<body>
		<ul class="for_ul" style="margin-bottom: 0;">
			<li><img class="forimage" src="../../img/logo.png"></li>
			<li><a href="../../contact_page.php">Contact</a></li>
			<li><a href="../../about_page.php">About</a></li>
			<li><a href="../../home.php">Home</a></li>
					<?php
						session_start();
							echo "<li style='float:right; margin:25px 20px 0 0;'><font color='white'>Welcome, ";
							echo $_SESSION['user'];
								if ( $_SESSION['user'] == NULL){
									header('Location: index.php');
										}
										echo "</font></li>";
										?>
		</ul>
	
		<div class="content-outer">
			<meta name="viewport" content="initial-scale=1.0; maximum-scale=1.0; width=device-width;">
			<div class="table-title">
				<h3 class="title"><strong>Rants</strong></h3><br><br>
			</div>
<?php
$localhost="localhost";
$username="root";
$password="Connect_root123!";
$database="post";


  $con=mysqli_connect("localhost","root","Connect_root123!","post");
    // Check connection
    if (mysqli_connect_errno())
      {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
      }

    $result = mysqli_query($con,"SELECT * FROM login_comment ORDER BY date DESC");
	while($row = mysqli_fetch_array($result)) {
		
	if ($row['category'] == 'Rants'){ //change to catarogy	
		
		
		echo "<div class ='other' id= '";
		echo $row['postid'];
		echo "'>";
		echo "<table class='table-fill'>";
		echo "<thead>";
		echo"<tr>";
		echo"<th class='red_th' colspan='2' id='";
		//echo $row['postid'];
		echo "'><center>";
		echo $row['header'];  
		echo "</center></th>";
		echo "</tr>";
		echo"</thead>";
		echo "<tbody class='table-hover text_align'>";
		echo "<tr class='table-fill2'>";
		echo "<td class='text-left' colspan= '2'><p>Description: ";
		echo $row['comment'];
		echo "</p></td>";
		echo"</tr>";


			 if( $row['dir'] != '0'){
				echo "<tr class='table-fill2'>";
				echo "<td class='text-left' colspan= '2'>";
				echo  "<center><img src='../../project/";
				echo $row['dir'];
				echo "'alt='' height='75%' width='70%'></center>"; 
				echo "</td>";
				echo"</tr>";
				}


		echo"<tr class='table-fill3'>";
		echo "<td class='text-left td_cat'><p>Category:"; 
		echo $row['category']; 
		//echo $row['category'];
		echo "</p></td>";
			$test=$row['uid'];
		echo "<td class='text-left td_cat'>User: ";
		echo '<a href="../../profile.php?test='. urlencode($test) . '">' . $test . '</a>';
		echo "</a></td></tr>";
		echo "<tfoot>";
		echo "<tr>";
		echo "<th class='' colspan='2'>";
		echo "<details>";
		echo "<summary style='float:left; padding:5px;'>RATE NOW </summary>";
			echo "<form action='rate/rate22.php' method='post'>";
				echo "<label>";
				echo " <input type='radio' name='postrating' value='0' /required>";
				echo "<img src='../../userrating/down.png' height='22' width='22'>";
				echo "</label>";
				echo "<label>";
				echo " <input type='radio' name='postrating' value='1' /required>";
				echo "<img src='../../userrating/up.png' height='22' width='22'>";
				echo "</label>";
				echo  "<input style='float:right;' type='image' src= '../../userrating/submit.png' alt='Submit' width='82' height='22'>";
			        echo '<input type="hidden" name="header" value="'.$row['header'].'"></input>';
				echo '<input type="hidden" name="oldcomment" value="'.$row['comment'].'"></input>';
				echo '<input type="hidden" name="postid" value="'.$row['postid'].'"></input>';

			echo "</form>";
		echo "</details>";




echo "<details style='text-align: left;'>";
echo "<summary style='float:right; padding:5px;'>COMMENTS </summary>";
echo "<br><br>";
  $connection=mysqli_connect("localhost","root","Connect_root123!","post");
    $resulttwo = mysqli_query($connection,"SELECT * FROM comments ORDER BY date DESC");

    while($info = mysqli_fetch_array($resulttwo)) {
       
    if ( $row['comment'] == $info['oldcomment']){ 

       echo "@ ";
       echo $info['date'];
       echo " from ";
       echo $info['uid'];
       echo ":  ";
       echo $info['comment'];
       echo "<br>";
}

}


echo "</details>";
echo "</th></tr>";
echo "<tr>";
echo "<th class='' colspan='2'>";
echo "<form action='comment/post22.php#"; 
echo "' method='post' id='";
echo "'>";
$temp = $row['comment'];
/*echo $row['postid'];*/
echo "<input type='hidden' name='uid' value="; echo  $_SESSION['user']; echo ">";
echo '<input type="hidden" name="header" value="'.$row['header'].'"></input>';
echo '<input type="hidden" name="oldcomment" value="'.$temp.'"></input>';
echo '<input type="hidden" name="postid" value="'.$row['postid'].'"></input>';
echo "<textarea rows='2' cols='63' placeholder='Enter Comment Here...' name='comment'></textarea>";
echo "<center><input type='submit' value='Submit' id=''></center>";
echo "</form>";
echo "</th></tr>";
echo "</tfoot>";

echo "<tr>";
echo "<th class='red_tfoot' colspan='1'>";
echo "Date:  ";
echo $row['date'];
echo "</th>";
echo "<th class='red_tfoot'>Post Rating: ";
				$localhost="localhost";
				$username="root";
				$password="lakers3224";
				$database="post";

            $csun=mysqli_connect("localhost","root","Connect_root123!","post");
            $re = mysqli_query($csun,"SELECT * FROM rating");


    while($rating = mysqli_fetch_array($re)) {
      if ( $rating['header'] == $row['header'] && $rating['comment'] == $row['comment'] ){
             $temp = $temp + $rating['total'];
             $total = $total + $rating['totalrating'];

}
}

$peg = ($temp/$total);
$peg = $peg * 100;
echo round($peg), "%";
echo "</th>";
echo "</tr>";
echo"</tbody>";
echo "</table>";
echo "<br><br>";
echo "</div>";
echo "</body>";
echo "</div>";

}
	}

    mysqli_close($con);
?>
<style>


</style>



<table class="left_table">
					<thead>
						<tr>
							<th class="red_th" colspan="2"><center>Task Bar</center></th>
						</tr>
					</thead>
					<tbody class="table-hover text_align">
						<tr class="left_table-fill">
							<td class="text-left" colspan= "2">		    
<a href="../../project/create.php">Create post</a><br></td>
						</tr>
						<tr class="left_table-fill">
							<td class="text-left left_td_cat"> <a href="../../categories/cat.php">Categories</a></td>
						</tr>
						<tr class="left_table-fill">
							<td class="text-left" colspan= "2"><a href="../../logout.php">Logout</a></td>
						</tr>
						<tr class="left_table-fill">
							<td class="text-left left_td_cat"><a href="../../profile/profile.php">Your Profile</a></td>

						</tr>

						<tfoot>
							<tr>
								<th class="left_red_tfoot" colspan="2"></th>
							</tr>
						</tfoot>
					</tbody>
				</table>
				
			</div>
	</body>
		<script>
			/* When the user clicks on the button,
			toggle between hiding and showing the dropdown content */
			function myFunction() {
				document.getElementById("myDropdown").classList.toggle("show");
			}

			// Close the dropdown if the user clicks outside of it
			window.onclick = function(event) {
			  if (!event.target.matches('.dropbtn')) {

				var dropdowns = document.getElementsByClassName("dropdown-content");
				var i;
				for (i = 0; i < dropdowns.length; i++) {
				  var openDropdown = dropdowns[i];
				  if (openDropdown.classList.contains('show')) {
					openDropdown.classList.remove('show');
				  }
				}
			  }
			}


// The function actually applying the offset
function offsetAnchor() {
    if(location.hash.length !== 0) {
        window.scrollTo(window.scrollX, window.scrollY - 150);
    }
}


window.addEventListener("hashchange", offsetAnchor);

window.setTimeout(offsetAnchor, 1);

		</script>

<style>
label > input{ /* HIDE RADIO */
  visibility: hidden; /* Makes input not-clickable */
  position: absolute; /* Remove input from document flow */
}
label > input + img{ /* IMAGE STYLES */
  cursor:pointer;
  border:2px solid transparent;
}
label > input:checked + img{ /* (RADIO CHECKED) IMAGE STYLES */
  border:2px solid #f00;
}


</style>

</html>
