<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Who are you?</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <div class="container">
        <a href="ui.php" class="close-button">×</a>
        <form class="registrationForm" action="#" method="post">
            <div class="title">Are you Renter or Owner?</div>
            <div class="form">
                <div class="input_field">
                    <button type="button" class="btn" onclick="location.href='renterForm.php'">Renter</button>
                </div>   
                <div class="input_field">
                    <button type="button" class="btn" onclick="location.href='ownerForm.php'">Owner</button>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
