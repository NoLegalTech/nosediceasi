<?php

    $config = require __DIR__ . '/../bot/config.php';

    $mysqli = new mysqli(
        $config['database']['host'],
        $config['database']['user'],
        $config['database']['pass'],
        $config['database']['db']
    );
    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }

    $res = $mysqli->query("SELECT * FROM tweets ORDER BY id DESC;");

    if (!$res) {
        echo "Query failed: (";
    }

    $dead_cats = array();

    while ($row = $res->fetch_assoc()) {
        $dead_cats []= [
            "nick" => $row['nick'],
            "url"  => "https://twitter.com/${row['nick']}/status/${row['tid']}"
        ];
    }

?>
<html>
    <head>
        <link href="https://fonts.googleapis.com/css?family=Amatic+SC|Freckle+Face|Fredericka+the+Great|Zilla+Slab+Highlight" rel="stylesheet">
        <style>
            html {
                background-color: black;
                width: 100%;
                text-align: center;
                font-size: 0.8em;
                color: gray;
            }
            header {
                background-color: black;
                width: 100%;
                height: 250px;
            }
            #hill {
                background-image: url(images/bg.png);
                background-color: gray;
                background-size: 1000px;
                background-repeat: no-repeat;
                width: 1000px;
                height: 340px;
            }
            body {
                margin: 0;
            }
            h1 {
                font-family: 'Fredericka the Great', cursive;
            }
            h2 {
                font-family: 'Amatic SC', cursive;
            }
            a {
                color: gray;
                text-decoration: none;
            }
            a:hover {
                color: white;
                text-decoration: underline;
            }
            p {
                margin-top: 100px;
            }
            h1 {
                font-size: 36pt;
                margin-bottom: 0px;
            }
            h2 {
                font-size: 30pt;
                margin-bottom: 100px;
            }
            #spiderweb {
                position: absolute;
                right: 0;
                top: 0;
                width: 271px;
            }
            #sheet {
                width: 1200px;
                margin: 0 auto 111px auto;
            }
            .nickname {
                margin-top: 30px;
                font-weight: bolder;
                color: #444;
                transform: perspective( 200px ) rotateY( -5deg ) rotateZ(1deg);
                text-align: center;
                padding-right: 25px;
            }
            a.grave:hover {
                text-decoration: none;
            }
            a.grave {
                width: 140px;
                height: 126px;
                float: left;
                background-image: url(images/cat_grave.png);
                padding: 25px 0px 0px 0px;
                background-position-x: -16px;
                margin: 0px 0px 40px 40px;
                background-size: 145px;
            }
            div.counter {
                font-size: 40px;
                color: gray;
                font-family: 'Amatic SC', cursive;
                margin-bottom: 90px;
            }
            span#count {
                color: #b70000;
                font-weight: bold;
                font-size: 60px;
            }
        </style>
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    </head>
    <body>
        <header>
            <div id="hill"> </div>
        </header>
        <div id="sheet">
            <h1> Bienvenido al cementerio de gatitos </h1>
            <div class="counter">(En este momento tenemos <span id="count"> <? echo count($dead_cats); ?> </span> residentes)</div>
            <h2> Has llegado aqu&iacute; porque no has aprendido a&uacute;n que no se dice querella criminal. Querella criminal no existe. Es como pedo del culo. Ya se sabe que es del culo, ya se sabe que es criminal. Fin de la historia. </h2>

            <img id= "spiderweb" src="images/tela.png"/>

            <div id="graves">
                <?php
                    foreach ($dead_cats as $cat) {
                        echo "<a class='grave' target='_blank' href='${cat['url']}'>";
                        echo "   <div class='nickname'>@${cat['nick']}</div>";
                        echo "</a>";
                    }
                ?>
            </div>
        </div>
    </body>
</html>

