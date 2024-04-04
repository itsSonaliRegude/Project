<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign Up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <style>
        /* Additional styling for Capture Image and Upload Image buttons */
        #captureImageButton, #uploadImageButton {
            background-color: #007bff;
            border-color: #007bff;
            color: #fff;
        }

        #captureImageButton:hover, #uploadImageButton:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="d-flex justify-content-center align-items-center vh-100">
        
        <form class="shadow w-450 p-3" 
              action="php/signup.php" 
              method="post"
              enctype="multipart/form-data">

            <h4 class="display-4  fs-1">Create Account</h4><br>
            <?php if(isset($_GET['error'])){ ?>
            <div class="alert alert-danger" role="alert">
              <?php echo $_GET['error']; ?>
            </div>
            <?php } ?>

            <?php if(isset($_GET['success'])){ ?>
            <div class="alert alert-success" role="alert">
              <?php echo $_GET['success']; ?>
            </div>
            <?php } ?>
            
            <!-- Buttons for Capture Image and Upload Image -->
            <div class="mb-3 d-flex justify-content-between">
                <button type="button" class="btn btn-primary" id="captureImageButton">Capture Image</button>
                <button type="button" class="btn btn-primary" id="uploadImageButton">Upload Image</button>
            </div>

            <!-- Capture Image Section -->
            <div id="cameraContainer" style="display: none;">
                <label class="form-label">Capture Profile Picture</label>
                <video id="videoElement" width="100%" height="auto" autoplay="true"></video>
                <button id="captureButton" class="btn btn-primary">Capture Image</button>
                <canvas id="canvasElement" style="display: none;"></canvas>
                <img id="capturedImage" style="display: none; width: 100%; height: auto;">
                <input type="hidden" name="pp_capture" id="imageInputCapture">
            </div>

            <!-- Upload Image Section -->
            <div id="uploadImageSection" style="display: none;">
                <label class="form-label">Upload Profile Picture</label>
                <input type="file" 
                    class="form-control"
                    name="pp"
                    id="uploadInput">
            </div>
            <!-- End of Upload Image Section -->

            <!-- Form fields for Full Name, User Name, and Password -->
            <div class="mb-3">
                <label class="form-label">Full Name</label>
                <input type="text" 
                    class="form-control"
                    name="fname"
                    value="<?php echo (isset($_GET['fname']))?$_GET['fname']:"" ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">User name</label>
                <input type="text" 
                    class="form-control"
                    name="uname"
                    value="<?php echo (isset($_GET['uname']))?$_GET['uname']:"" ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" 
                    class="form-control"
                    name="pass">
            </div>

            <!-- Submit and Login buttons -->
            <button type="submit" class="btn btn-primary" id="signUpButton">Sign Up</button>
            <a href="login.php" class="link-secondary">Login</a>
        </form>
    </div>

    <script>
        // Button elements
        const captureImageButton = document.getElementById('captureImageButton');
        const uploadImageButton = document.getElementById('uploadImageButton');
        const signUpButton = document.getElementById('signUpButton');

        // Sections
        const cameraContainer = document.getElementById('cameraContainer');
        const uploadImageSection = document.getElementById('uploadImageSection');

        // Button event listeners
        captureImageButton.addEventListener('click', () => {
            cameraContainer.style.display = 'block';
            uploadImageSection.style.display = 'none';
        });

        uploadImageButton.addEventListener('click', () => {
            cameraContainer.style.display = 'none';
            uploadImageSection.style.display = 'block';
        });

        // Capture image functionality
        const video = document.getElementById('videoElement');
        const canvas = document.getElementById('canvasElement');
        const captureButton = document.getElementById('captureButton');
        const capturedImage = document.getElementById('capturedImage');
        const imageInputCapture = document.getElementById('imageInputCapture');

        captureButton.addEventListener('click', () => {
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            canvas.getContext('2d').drawImage(video, 0, 0);
            capturedImage.src = canvas.toDataURL('image/png');
            capturedImage.style.display = 'block'; // Display the captured image
            imageInputCapture.value = capturedImage.src;
        });

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


