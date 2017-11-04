<?php
	session_start();
?>
<html>
	<head>
		<link rel="stylesheet" href="styles.css">

		<meta charset="utf-8">
		<title></title>
	</head>
	<body>
		<div class="header">
			<a href="index.php"><button class="title" name="button">CAMAGRU</button><a/>
			<div class="box1">
			<?php
			if (isset($_SESSION[LOGGED_ON]))
			{
				echo '<a href="profile.php"><button class="signed" style="padding-left: 0px;type="button" name="profile">' . $_SESSION[LOGGED_ON] ."</button></a>";
				echo '<a href="logout.php"><button class="button" type="button" name="Logout">Log out</button></a>';
			}
			else
			{
				echo '<a href="sign_in.php"><button class="button" type="button" name="Login">Sign in</button></a>';
				echo '<a href="sign_up.php"><button class="button" type="button" name="Sign up"> Register</button></a>';
			}
			?>
			</div>
		</div>
		<div class="main">
		<?php
		if (isset($_SESSION[LOGGED_ON]))
		{
			echo '<center>
			<video id="video"></video>
			<button class="cambutton" id="startbutton">Prendre une photo</button>
			<canvas id="canvas"></canvas></center>';
		}
		?>
		</div>
		<div class="footer">
		</div>
		</div>
		<div class="footer">
		</div>
	</body>
</html>


<?php
if ($_SESSION[LOGGED_ON])
{
?>
<script type="text/javascript">
(function() {

  var streaming = false,
      video        = document.querySelector('#video'),
      cover        = document.querySelector('#cover'),
      canvas       = document.querySelector('#canvas'),
	  context	   = canvas.getContext('2d'),
      photo        = document.querySelector('#photo'),
      startbutton  = document.querySelector('#startbutton'),
      width = 320,
      height = 320;

  navigator.getMedia = ( navigator.getUserMedia ||
                         navigator.webkitGetUserMedia ||
                         navigator.mozGetUserMedia ||
                         navigator.msGetUserMedia);

  navigator.getMedia(
    {
      video: true,
      audio: false
    },
    function(stream) {
      if (navigator.mozGetUserMedia) {
        video.mozSrcObject = stream;
      } else {
        var vendorURL = window.URL || window.webkitURL;
        video.src = vendorURL.createObjectURL(stream);
      }
      video.play();
    },
    function(err) {
      console.log("An error occured! " + err);
    }
  );

  video.addEventListener('canplay', function(ev){
    if (!streaming) {
      height = video.videoHeight / (video.videoWidth/width);
      video.setAttribute('width', width);
      video.setAttribute('height', height);
      canvas.setAttribute('width', width);
      canvas.setAttribute('height', height);
      streaming = true;
    }
  }, false);

	function takepicture()
	{
		context.drawImage(video, 0, 0, width, height);
		var data = canvas.toDataURL("image/png");
		var xml = new XMLHttpRequest();
		var tmp = new Image();
		tmp.onload = function(){
			context.drawImage(tmp, width, height);
		}
		tmp.src = data;

		canvas.width = width;
		canvas.height = height;

		xml.onreadystatechange = function()
		{
			if (xml.readyState == 4 && (xml.status == 200 || xml.status == 0))
			{
				console.log(xml.response);
				// if (xml.response)
				// {
				// 	context.drawImage("", width, height);
				// }
			}
		}

		console.log(data);
		xml.open('POST', 'datastorage.php', true);
		xml.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		xml.send("data=" + data);

		//console.log(data);
	    //photo.setAttribute('src', data);
  }

  startbutton.addEventListener('click', function(ev){
	//ev.preventDefault();
	takepicture();
  }, false);

})();

</script>
<?php
}
?>
