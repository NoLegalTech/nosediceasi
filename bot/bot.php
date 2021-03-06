<?php
require_once('TwitterAPIExchange.php');
require __DIR__.'/vendor/autoload.php';

function do_query($config, $query, $callback_row = null) {
    $mysqli = new mysqli(
        $config['database']['host'],
        $config['database']['user'],
        $config['database']['pass'],
        $config['database']['db']
    );
    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }

    $res = $mysqli->query($query);

    if (!$res) {
        echo "Query failed: (";
    }

    if (!is_null($callback_row)) {
        while ($row = $res->fetch_assoc()) {
            $callback_row($row);
        }
    }
}

function show_db($config) {
    do_query(
        $config,
        "SELECT * FROM tweets;",
        function($row) {
            echo "https://twitter.com/${row['nick']}/status/${row['tid']}\n";
        }
    );
}

function show_last_killed_cats($config) {
    $url = 'https://api.twitter.com/1.1/search/tweets.json';
    $getfield = '?q="querella%20criminal"';
    $requestMethod = 'GET';

    $twitter = new TwitterAPIExchange(array(
        'oauth_access_token' => $config['twitter']['access_token'],
        'oauth_access_token_secret' => $config['twitter']['access_token_secret'],
        'consumer_key' => $config['twitter']['consumer_key'],
        'consumer_secret' => $config['twitter']['consumer_secret']
    ));
    $results = json_decode($twitter->setGetfield($getfield)
        ->buildOauth($url, $requestMethod)
        ->performRequest());

    foreach($results->statuses as $tweet) {
        $nick = $tweet->user->screen_name;
        $status = $tweet->text;
        if (stripos($status, "querella criminal") !== false) {
            $coloured_status = preg_replace(
                "/(querella)/i",
                "\033[01;31m".'${1}'."\033[0m",
                $coloured_status = preg_replace(
                    "/(criminal)/i",
                    "\033[01;31m".'${1}'."\033[0m",
                    $status
                )
            );
            $tid = $tweet->id_str;
            echo " \033[01;37m@${nick}\033[0m said: \033[01;32m\"${coloured_status}\033[0m\"\n     (\033[38;5;14m\033[4mhttps://twitter.com/${nick}/status/${tid}\033[0m)\n\n";
        }
    }
}

function show_commands($script) {
    echo "    php ".$script." db                 \033[01;33m  - shows database contents\033[0m\n";
    echo "    php ".$script." cats               \033[01;33m  - shows last killed cats\033[0m\n";
    echo "    php ".$script." reply {nick} {tid} \033[01;33m  - replies tweet {tid} of user {nick}\033[0m\n";
}

function reply($config, $nick, $tid) {
    $alreadyProcessed = false;

    do_query(
        $config,
        "SELECT * FROM tweets WHERE tid = ${tid};",
        function($row) use (&$alreadyProcessed) {
            $alreadyProcessed = true;
        }
    );

    if ($alreadyProcessed) {
        echo "Won't reply. Already replied.";
        return;
    }

    $url = 'https://api.twitter.com/1.1/statuses/update.json';
    $requestMethod = 'POST';

    $postfields = array(
        'status' => "@${nick} ¿en serio? Acabas de matar un gatito. http://www.nosedicequerellacriminal.com",
        'in_reply_to_status_id' => $tid
    );

    $twitter = new TwitterAPIExchange(array(
        'oauth_access_token' => $config['twitter']['access_token'],
        'oauth_access_token_secret' => $config['twitter']['access_token_secret'],
        'consumer_key' => $config['twitter']['consumer_key'],
        'consumer_secret' => $config['twitter']['consumer_secret']
    ));

    echo $twitter->buildOauth($url, $requestMethod)
        ->setPostfields($postfields)
        ->performRequest();

    do_query(
        $config,
        "INSERT INTO tweets(tid, nick) VALUES('${tid}', '${nick}');"
    );
}

$script = $argv[0];
$config = require __DIR__ . '/config.php';

if (count($argv) <= 1) {
    echo "\033[01;31mMissing command, try one of the following:\033[0m\n";
    show_commands($script);
    exit;
}

$command = $argv[1];
switch($command) {
    case "db":
        show_db($config);
        break;
    case "cats":
        show_last_killed_cats($config);
        break;
    case "reply":
        if (count($argv) <= 3) {
            echo "\033[01;31mMissing parameters for command 'reply', try one of the following:\033[0m\n";
            show_commands($script);
            exit;
        }
        reply($config, $argv[2], $argv[3]);
        break;
    default:
        echo "\033[01;31mCommand '${command}' not known, try one of the following:\033[0m\n";
        show_commands($script);
        exit;
}
