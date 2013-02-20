<?php
require 'panel/bootstrap.php';
if ((!isset($_SESSION['user']) || (isset($_SESSION['user']) && time() > $_SESSION['user'])) && isset($_GET['host'])) {
	if (!isset($_SERVER['HTTP_USER_AGENT'],
			   $_SERVER['HTTP_ACCEPT'],
			   $_SERVER['HTTP_ACCEPT_LANGUAGE'],
			   $_SERVER['HTTP_ACCEPT_ENCODING'],
			   $_SERVER['HTTP_CONNECTION'],
			   $_SERVER['HTTP_COOKIE'])
	) {
		if (isset($_SERVER['REMOTE_ADDR'])
			&& $_SERVER['REMOTE_ADDR'] !== '127.0.0.1'
		) {
			$site = clear($_GET['host']);
			
			if (preg_match('/^([a-zA-Z0-9]([a-zA-Z0-9\-]{0,61}[a-zA-Z0-9])?\.)+[a-zA-Z]{2,6}$/', $site)) {
				if (strlen($site) > 3) {
					$time = time();
					/*mysql_query("INSERT INTO `cp_sites` (
					`sid` ,
					`host` ,
					`time`
					)
					VALUES (
					NULL , '" . $site . "', " . time() . "
					);
					");*///invalid query, critical error!
					mysql_query("INSERT INTO `cp_sites` (`sid`, `host`, `pages`, `content`, `content_links`, `footer`, `comment`, `time_reload`, `code_is_set`, `time`) VALUES ('', '{$site}', '', '', '', '', '', '', '', '{$time}')");
				}
			}
		}
	}
}
?>
