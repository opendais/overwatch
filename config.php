<?php
      	# Class Autoloader
        function class_autoloader($class_name) {

                $path = BASE.'classes/' . VERSION . '/src/' . strtolower($class_name) . '.php';
                if(file_exists($path)) {
                        require_once $path;
                }
                else {
                        header("HTTP/1.0 404 API Object Not Found");die();
                }
        }
        spl_autoload_register('class_autoloader', true);

	# Constants, by environment
	define('DOMAIN', 'dev.local');
	define('BASE', '/var/www/'.DOMAIN.'/htdocs/');

        # Load forward compatability password_* functions via https://github.com/ircmaxell/password_compat
        require BASE."lib/password.php";


        # Database Connection
        $username = 'root';
        $password = 'vagrant';
        $hostname = 'localhost';
        $DAL = new DAL($username, $password, $hostname);
	unset($password); # destroy password, username variables since they are commonly used words and related to authentication.
	unset($username);

	# Summarize Rate
	$Today = 0; /* 2880 data points [24*120] */
	$SevenDays = 10; /* takes 10 results and averages them, so 10*30=300s [5 minutes] = 1728 data points */
	$Annual = 6; /* takes 6 results and averages them, so 6*5min=30min = 17,184 data points */
	/* Total: 21,792 data points @ 255.375kb data + meta ~.534kb = ~256kb/metric storage */
	/* Performance Goal: 10,000 metrics on a $5 VPS from DO */


?>
