<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Citati</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header>
        <div id="slike" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <?php
                $imagesPath = "images/";
                $images = array_diff(scandir($imagesPath), [".", ".."]);
                $randomIdx = array_rand($images, 3);
                foreach ($randomIdx as $key => $i) {
                    $path = $imagesPath . $images[$i];
                ?>
                    <div class="carousel-item<?php if ($key === 0) echo " active" ?>">
                        <img src="<?php echo $path ?>" class="d-block w-100" />
                    </div>
                <?php } ?>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#slike" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#slike" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </header>
    <section>
        <?php
        $id = $_GET["id"];
        $quotesPath = "quotes/";
        $quotesFiles = array_diff(scandir($quotesPath), [".", ".."]);
        $quotesOptions = [];
        foreach ($quotesFiles as $option) {
            $quotesOptions[] = pathinfo($option, PATHINFO_FILENAME);
        }
        ?>
        <nav class="nav nav-justified nav-pills">
            <?php
            foreach ($quotesOptions as $name) {
            ?>
                <a class="nav-link justify-content-center<?php if ($id == $name) echo " active" ?>" href="?id=<?php echo $name ?>"><?php echo ucfirst($name) ?></a>
            <?php } ?>
        </nav>
        <?php

        if (!in_array($id, $quotesOptions)) {
            $id = $quotesOptions[array_rand($quotesOptions)];
        }
        $path = $quotesPath . $id . ".txt";
        $quotes = file($path);
        $nLines = count($quotes);
        $chosenIdx = rand(0, $nLines);
        if ($chosenIdx  % 2 !== 0 && $chosenIdx !== 0) {
            $chosenIdx -= 1;
        }
        $authorIdx = $chosenIdx + 1;
        $quote =  $quotes[$chosenIdx];
        $author = $quotes[$authorIdx];
        ?>
        <p>
            <em>
                “<?php echo $quote ?>”<br />
                <strong><?php echo $author ?></strong>
            </em>
        </p>
    </section>
    <footer>
        <?php echo date("d.m.Y H:i:s") ?>
    </footer>
</body>

</html>