<?php
	
	class HTMLView {

		function echoHTML ($body) {

			if ($body === null) {
				
				throw new \Exception("HTMLView->HTMLView does not allow body to be null");
			}

			echo 
				"<!DOCTYPE HTML>
					<html>
						<head>
							<meta content=\"text/html; charset=utf-8\" http-equiv=\"content-type\">
						</head>
						<body>
							<h1>PHP Laboration 1</h1>
							$body
						</body>
					</html>";
		}
	}