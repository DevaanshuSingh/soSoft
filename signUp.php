<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/signUp.css">
</head>

<body>
    <div class="logo">
        <img src="codernaccotax.png" alt="CNAT">
    </div>

    <div class="container">
        <div class="signup">

            <form action="register.php" method="POST" enctype="multipart/form-data">

                <div class="single col-12">
                    <div class="mb-3 col-6">
                        <label for="full-name" class="form-label">Enter Full Name</label>
                        <input type="text" class="form-control" id="full-name" name="full-name" placeholder="Name"
                            required>
                    </div>
                    <div class="mb-3 col-6">
                        <label for="user-name" class="form-label">Enter User Name/Short Name</label>
                        <input type="text" class="form-control" id="user-name" name="user-name" placeholder="Short Name"
                            required>
                    </div>
                </div>
                <div class="single col-12">
                    <div class="mb-3 col-6">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="user-password"
                            placeholder="Password" required>
                    </div>
                    <div class="mb-3 col-6">
                        <label for="location" class="form-label">Enter Location</label>
                        <input type="text" class="form-control" id="location" name="location" placeholder="Location"
                            required>
                    </div>
                </div>
                <div class="single col-12">
                    <div class="mb-3 col-6">
                        <label for="dob" class="form-label">Enter DOB</label>
                        <input type="text" class="form-control" id="dob" name="dob" placeholder="Date Of Birth"
                            required>
                    </div>
                    <div class="mb-3 col-6">
                        <label for="bio" class="form-label">Enter Bio</label>
                        <input type="text" class="form-control" id="bio" name="bio" placeholder="About" required>
                    </div>
                </div>
                <div class="single col-12">
                    <div class="mb-3 col-6">
                        <label for="intrests" class="form-label">Enter Intrests</label>
                        <input type="text" class="form-control" id="intrests" name="intrests"
                            placeholder="Your Intrests" required>
                    </div>
                    <div class="mb-3 col-6">
                        <label for="picture" class="form-label"><strong>Choose Profile
                                Picture</strong></label>
                        <input type="file" class="form-control" id="picture" name="image" accept="image/*"
                            capture="environment" placeholder="Profile Picture" required>
                    </div>
                </div>
                <div class="single">
                    <div class="mb-3 col-6">
                        <label for="email" class="form-label">Enter email</label>
                        <input type="text" class="form-control" id="email" name="email" placeholder="Your email"
                            required>
                    </div>

                    <div class="mb-3 col-6 button">
                        <button type="submit" class="btn">Register</button>
                    </div>
                </div>

            </form>

        </div>
    </div>

</body>

</html>