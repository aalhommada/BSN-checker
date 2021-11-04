<!-- Om deze code te controleren moet je xampp hebben,
maak het commando in de terminal
``` php -S localhost 1234 ```
Ga naar http://localhost:1234/checkbsn.php -->

<?php

// krijg het ingevoerde nummer .
$bsn = filter_input(INPUT_POST, 'bsn', FILTER_SANITIZE_STRING);

if (!empty($bsn)) {
    // verander het getal naar een array
    $chars = str_split($bsn);
    $results = 0;

// controleer of het getal kleiner is dan 9.
    if (count($chars) < 9) {
        echo '<h3>Deze bsn is ongeldig, het is minder dan 9 cijfers</h3>';

    } else {
        // loop door de array en vermenigvuldig het eerste getal met 9 , en het tweede met 8 enzovoorten tel de resultaten op, en controleer of het 11-proof.
        for ($i = 0; $i < count($chars); $i++) {
            $res = [];
            $n = count($chars) - $i; // of $n = 9

            if ($n == 1) {
                $s = $chars[$i] * -1;
            } else {
                $s = $chars[$i] * $n;
            }
            $res[] = $s;
            $results += array_sum($res);
        }

        if ($results > 0) {
            if ($results % 11 == 0) {
                echo '<h3>Deze bsn is geldig</h3>';
            } else {
                echo '<h3>Helaas ,Deze bsn is ongeldig</h3>';
            }
        } else {
            echo "<h3>Deze bsn is ongeldig</h3>";
        }
    }
} else {
    echo '<h3>Vul een bsn in</h3>';
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <title>BSN checker</title>
</head>

<body>
    <div class="container m-5 w-25 mx-auto">
        <div class="row">
            <div class="col-md-12">
                <h1>Check BSN</h1>
                <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="POST">
                    <div class="form-group mt-5 mb-2">
                        <label class="text-info" for="bsn">Enter BSN nummer :</label>
                        <input type="number" name="bsn" id="bsn" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">Check</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
