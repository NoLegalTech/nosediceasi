# nosediceasi

## Quick start

0) Clone this repo (you should know how :grimacing:)

1) Set up your config file by copying it from bot/config.php.ini:

```bash
    cp bot/config.php.ini bot/config.php
```

2) Edit the bot/config.php file and replace all `FILL_ME` values with the appropriate values.

3) Update project dependencies:

```bash
    composer install
```

4) See last killed cats:

```bash
    php bot.php cats
```

5) Set up your firebase config file by copying it from firebase-credentials.json.ini:

```bash
    cp firebase-credentials.json.ini firebase-credentials.json
```

6) Edit the firebase-credentials.json file and replace all `FILL_ME` values with the appropriate values.

7) Reply to one of those killers:

```bash
    php bot.php reply <nick> <tweet_id>
```

## Screenshots

![No command](/screenshots/no_command.png)
![Command cats](/screenshots/command_cats.png)
