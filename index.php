<?php
    include("database.php") ;
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Inscription</title>
</head>
<body class="flex justify-center items-center h-screen flex-col">

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="border border-gray-300 rounded-lg p-8 shadow-xl block ">

        <h2 class="text-4xl font-bold mb-6 text-center">Inscription</h2>
        <div class="mb-4">
            <label for="username" class="block text-gray-700 text-lg font-bold mb-2">Nom d'utilisateur</label>
            <input type="text" name="username" id="username" placeholder="nom d'utilisateur" class="border border-gray-300 rounded-lg px-4 py-2 w-full">
        </div>
        <div class="mb-6">
            <label for="password" class="text-gray-700 text-lg font-bold mb-2">Mot de Passe</label>
            <input type="password" name="password" id="password" placeholder="mot de passe" class="border border-gray-300 rounded-lg px-4 py-2 w-full">
        </div>
        <div class="flex items-center justify-center">
            <button type="submit" name="register" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline " id="btn">S'inscrire</button>
        </div>
    </form>
</body>

</html>

<?php 

    if (isset($_POST["register"])){
        $username = filter_input(INPUT_POST , "username" , FILTER_SANITIZE_SPECIAL_CHARS) ;
        $password = filter_input(INPUT_POST , "password" , FILTER_SANITIZE_SPECIAL_CHARS) ;

        $username = trim($username) ; 
        $password = trim($password) ;

        try {
            if (empty($username) || empty($password) || ctype_space($username) || ctype_space($password)) echo "<p class='mt-12 text-red-500 text-xl font-bold'>Champs vides ou juste composé d'espaces</p>" ;
            else {
                $hash = password_hash($password , PASSWORD_DEFAULT) ;
                $sql = "INSERT INTO users (user,password)
                        VALUES 
                        ('$username' , '$hash') ;" ; //the sql query that will be executed on the database
                mysqli_query($conn , $sql) ;

                echo "<p class='mt-12 text-green-500 text-3xl font-bold'>Inscrition réussie</p>" ;
            }
        }
        //check if there is another user with the same name
        catch (mysqli_sql_exception){
            echo "<p class='mt-12 text-red-500 text-xl font-bold'>Nom d'utilisateur deja pris</p>" ;
        }

    mysqli_close($conn) ; 
    }
?>