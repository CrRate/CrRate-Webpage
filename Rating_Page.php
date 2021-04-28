<html>
    <head>
        <script src="js/jquery-1.11.0.js"></script>
        <script>
            var imageAmount = 0;

            $.ajax({
                method: "POST",
                url: "getimageamount.php"
            }).done(function( response ) {
                    imageAmount = response;
            });

            function randomImageID() {
                return Math.ceil(Math.random()*imageAmount);
            }

            var imageID = randomImageID();

            function rateImage(rating) {
                console.log("rate: " + rating);
                console.log("image amount: " + imageAmount);
                $.ajax({
                    url: "rateimage.php",
                    type: "POST",
                    data:"rating="+rating+' &imageID='+imageID, 
                    success: function(response) {
                        console.log(response);
                    }
                });
                showRandomImage();
            }

            function showRandomImage() {
                if(imageAmount>0) {
                    imageID = randomImageID();
                    $.ajax({
                        type: "GET",
                        url: 'getimage.php',
                        data: "imageID="+imageID,
                        success: function(response) {
                            document.getElementById("randomImage").innerHTML=response;
                        }
                    });
                }
            }
            window.onload = showRandomImage;
        </script>
        <link rel="stylesheet" type="text/css" href="pagestyle.css">
        <title>Rating</title>
    </head>
    <body>
        <h1>
            Rating Page
        </h1>
        <?php include 'menu.php'; ?>
        <div id="content">
            <!-- Show random image -->
            <div id="randomImage">
            </div>
            <p>Rate the image:</p>
            <form>
                <div>
                    <input type="button" id="vote1" onclick="rateImage(1);" value=1></button>
                    <input type="button" id="vote2" onclick="rateImage(2);" value=2></input>
                    <input type="button" id="vote3" onclick="rateImage(3);" value=3></input>
                    <input type="button" id="vote4" onclick="rateImage(4);" value=4></input>
                    <input type="button" id="vote5" onclick="rateImage(5);" value=5></input>
                    <input type="button" id="skip" onclick="showRandomImage();" value="Skip Image"></input>
                </div>
            </form>
        </div>
        <script src="js/jquery-1.11.0.js"></script>
        <script src="js/animate.js"></script>
    </body>
</html>