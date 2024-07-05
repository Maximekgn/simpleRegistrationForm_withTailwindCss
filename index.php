<?php
    include("database.php") ;
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>register</title>
</head>
<body>
    <form action="<?php htmlspecialchars($_SESSION['PHP_SELF']) ?>" method="post" class="flex flex-col">

        <h2>Bienvenue Chez MXMKGN</h2>
        <div>
            <label for="username">Username</label>
            <input type="text" name="username" id="username" required>
        </div>
        <div>
            <label for="password">Password</label>
            <input type="password" name="password" id="password" required>
        </div>
        <div>
            <input type="submit" value="register" name="register">
        </div>
        
    </form>
</body>
</html>

<?php 

    if (isset($_POST["register"])){

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = filter_input(INPUT_POST , "username" , FILTER_SANITIZE_SPECIAL_CHARS) ;
            $password = filter_input(INPUT_POST , "password" , FILTER_SANITIZE_SPECIAL_CHARS) ;

            if (empty($username)) echo "Please enter a username ";
            elseif (empty($password)) echo "Please enter a Password" ;
            else {
                $hash = password_hash($password , PASSWORD_DEFAULT) ;
                $sql = "INSERT INTO users (user,password)
                        VALUES 
                        ('$username' , '$hash')" ;
                mysqli_query($conn , $sql) ;

                echo "You are now registred !" ;
            }

        }
    }

    mysqli_close($conn) ;
?>