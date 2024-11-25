<?php
$file = 'emails.json';
/* Ce script permet aux utilisateurs de s'inscrire à une newsletter en enregistrant leur email, qui sera ensuite stocké dans le fichier emails.json. */
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        if (file_exists($file)) {
            $emails = json_decode(file_get_contents($file), true);
        } else {
            $emails = [];
        }

        $emails[] = $email;
        file_put_contents($file, json_encode($emails));

        $message = "Abonnement enregistré avec succès";
    } else {
        $message = "Veuillez entrer un email valide.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>S'abonner à la Newsletter</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 100%;
            max-width: 400px;
        }
        h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }
        input[type="email"] {
            padding: 10px;
            width: 80%;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }
        input[type="submit"] {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .message {
            margin-top: 20px;
            font-size: 18px;
            color: #4CAF50;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>S'abonner à la Newsletter</h1>
    <form method="post" action="">
        <input type="email" name="email" placeholder="Entrez votre email" required>
        <input type="submit" value="S'abonner">
    </form>

    <?php if (isset($message)): ?>
        <div class="message"><?php echo $message; ?></div>
    <?php endif; ?>
</div>

</body>
</html>
