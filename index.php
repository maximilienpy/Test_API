<?php

// COMPATIBILITY
if(isset($_POST) && !empty($_POST)){
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://love-calculator.p.rapidapi.com/getPercentage?fname=".$_POST['name1']."&sname=".$_POST['name2'],
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "x-rapidapi-host: love-calculator.p.rapidapi.com",
            "x-rapidapi-key: 3038c2322amshbd28049ff1cb4b3p14dc77jsn0dd7720e19e9"
        ),
    ));
    $response = json_decode(curl_exec($curl));
    $err = curl_error($curl);
    curl_close($curl);
    if ($err) {
        echo "cURL Error #:" . $err;
    }
}

// WANTED PEOPLE
$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.fbi.gov/wanted/v1/list",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET"
));
$results = json_decode(curl_exec($curl));
$err = curl_error($curl);
curl_close($curl);
if ($err) {
    echo "cURL Error #:" . $err;
}
$wanted = $results;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CRUSH COMPATIBILITY</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <div class="container my-5">
        <div class="jumbotron">
            <h1>Most Wanted</h1>
                <?php
                if (isset($wanted) && !empty($wanted)) {
                    foreach($wanted as $values) {
                        foreach($values as $value) {
                            ?>
                            <div class="row">
                                <div class="col-12">
                                    <h4><?= $value->title?></h4>
                                </div>
                                <div class="col-12">
                                    <?php foreach($value->images as $image){ ?>
                                        <img src="<?= $image->original ?>" alt="" style="width: 200px; height: 150px;">
                                    <?php } ?>
                                </div>
                                <div class="col-12">
                                    <?=$value->details ?>
                                </div>
                            </div>
                            <hr class="my-5">
                            <?php
                        }
                    }
                }
                    ?>
        </div>
        <div class="jumbotron">
            <?php
            if(isset($response) && !empty($response)){
                echo $response->result ."<br>";
                echo "<a href='index.php'>Retry</a>";
            } else {
            ?>
            <h1>Crush compatibility</h1>
            <hr class="my-5">
            <form method="POST">
                <div class="form-group">
                    <label for="name1">Your name</label>
                    <input type="text" class="form-control" id="name1" name="name1">
                </div>
                <div class="form-group">
                    <label for="name2">Your crush's name</label>
                    <input type="text" class="form-control" id="name2" name="name2">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            <?php } ?>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>


    
