<?php
// fix_composer.php
set_time_limit(300);
chdir(__DIR__);

echo "<pre>";
if (file_exists('composer.phar')) {
    echo shell_exec('php composer.phar dump-autoload --no-interaction 2>&1');
} else {
    echo "composer.phar not found. Download from https://getcomposer.org/composer.phar";
}
echo "</pre>";