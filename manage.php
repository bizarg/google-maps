<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require ('db.php');

    $stmt = $conn->prepare("
      INSERT INTO markers (name, address, lat, lng)
      VALUES (:name, :address, :lat, :lng)
    ");

    $stmt->bindParam(':name', $_POST['name']);
    $stmt->bindParam(':address', $_POST['address']);
    $stmt->bindParam(':lat', $_POST['lat']);
    $stmt->bindParam(':lng', $_POST['lng']);


    if ($stmt->execute()) {
        $res = '<div class="card-panel teal lighten-2">Пользователь добавлен</div>';
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">

</head>
<body>
    <div class="row">

        <?php
            if(isset($res)) {
                echo $res;
            }
        ?>

        <h1 style="text-align: center">Добавить пользователя</h1>
        <form class="col s12" action="" method="post">
            <div class="row">
                <div class="input-field col s12">
                    <input placeholder="Placeholder" id="name" type="text" name="name" class="validate">
                    <label for="name">Name</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input placeholder="Placeholder" id="address" type="text" name="address" class="validate">
                    <label for="address">Address</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input placeholder="Placeholder" id="lat" type="text" name="lat" class="validate">
                    <label for="lat">Lat</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input placeholder="Placeholder" id="lng" type="text" name="lng" class="validate">
                    <label for="lng">Lng</label>
                </div>
            </div>
            <button class="btn waves-effect waves-light" type="submit" name="action">Submit
                <i class="material-icons right">send</i>
            </button>
        </form>
    </div>
    <!-- Compiled and minified JavaScript -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
    <script>
        $(document).ready(function() {
            $('select').material_select();
        });
    </script>
</body>
</html>



<!--INSERT INTO `markers` (`name`, `address`, `lat`, `lng`, `type`) VALUES ('Love.Fish', '580 Darling Street, Rozelle, NSW', '-33.861034', '151.171936', 'restaurant');-->