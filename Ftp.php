<?php
class Ftp
{
	public function connect($uri) 
	{
		// Split FTP URI into: 
		// $match[0] = ftp://username:password@sld.domain.tld/path1/path2/ 
		// $match[1] = ftp:// 
		// $match[2] = username 
		// $match[3] = password 
		// $match[4] = sld.domain.tld 
		// $match[5] = /path1/path2/ 
		preg_match("/ftp:\/\/(.*?):(.*?)@(.*?)(\/.*)/i", $uri, $match); 

		// Set up a connection 
		$conn = ftp_connect($match[1] . $match[4] . $match[5]); 

		// Login 
		if (ftp_login($conn, $match[2], $match[3])) 
		{ 
			// Change the dir 
			ftp_chdir($conn, $match[5]); 

			// Return the resource 
			return $conn; 
		} 

		// Or retun null 
		return null; 
	}
}
?>
