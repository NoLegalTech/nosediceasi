# nosediceasi

## Quick start

0) Clone this repo (you should know how :grimacing:)

1) Set up your config files by copying them from bot/config.php.ini and db/config.ini:

```bash
    cp bot/config.php.ini bot/config.php
    cp db/config.ini bot/config
```

2) Install MySQL if you don't have it, and create a user with permission to create databases

3) Edit the bot/config.php and the db/config files and replace all `FILL_ME` values with the appropriate values.

4) Run database migrations:

```bash
    db/up
```

4) Update project dependencies:

```bash
    composer install
```

5) See last killed cats:

```bash
    php bot.php cats
```

6) Reply to one of those killers:

```bash
    php bot.php reply <nick> <tweet_id>
```

## Screenshots

![No command](/screenshots/no_command.png)
![Command cats](/screenshots/command_cats.png)
