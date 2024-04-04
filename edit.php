<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <div class="d-flex justify-content-center align-items-center vh-100">
        <form class="shadow w-450 p-3" 
              action="php/edit.php" 
              method="post"
              enctype="multipart/form-data">

            <h4 class="display-4  fs-1">Edit Profile</h4><br>
            <!-- error -->
            <?php if(isset($_GET['error'])){ ?>
            <div class="alert alert-danger" role="alert">
              <?php echo $_GET['error']; ?>
            </div>
            <?php } ?>
            
            <!-- success -->
            <?php if(isset($_GET['success'])){ ?>
            <div class="alert alert-success" role="alert">
              <?php echo $_GET['success']; ?>
            </div>
            <?php } ?>
            <div class="mb-3">
                <label class="form-label">Full Name</label>
                <input type="text" 
                       class="form-control"
                       name="fname"
                       value="<?php echo $user['fname']?>">
            </div>

            <div class="mb-3">
                <label class="form-label">User name</label>
                <input type="text" 
                       class="form-control"
                       name="uname"
                       value="<?php echo $user['username']?>">
            </div>

            <div class="mb-3">
                <label class="form-label">Profile Picture</label>
                <input type="file" 
                       class="form-control"
                       name="pp">
                <img src="http://localhost/new/upload/<?=$user['pp']?>"
                     class="rounded-circle"
                     style="width: 70px">
                <input type="hidden"
                       name="old_pp"
                       value="<?=$user['pp']?>" >
            </div>

            <!-- Video element for capturing image -->
            <div class="mb-3">
                <label class="form-label">Capture Profile Picture</label>
                <video id="videoElement" width="100%" height="auto" autoplay></video>
                <button type="button" class="btn btn-primary" id="captureButton">Capture Image</button>
                <canvas id="canvasElement" style="display: none;"></canvas>
                <input type="hidden" name="pp_capture" id="imageInputCapture">
            </div>
            <!-- End of video element -->

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="home.php" class="link-secondary">Home</a>
        </form>
    </div>

    <script>
        const video = document.getElementById('videoElement');
        const captureButton = document.getElementById('captureButton');
        const canvas = document.getElementById('canvasElement');
        const imageInputCapture = document.getElementById('imageInputCapture');

        captureButton.addEventListener('click', () => {
            // Capture the image from webcam
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            canvas.getContext('2d').drawImage(video, 0, 0, canvas.width, canvas.height);
            imageInputCapture.value = canvas.toDataURL('image/png');
        });

        // Access webcam
        navigator.mediaDevices.getUserMedia({ video: true })
            .then((stream) => {
                video.srcObject = stream;
            })
            .catch((err) => {
                console.error('Error accessing camera:', err);
            });
    </script>
</body>
</html>




