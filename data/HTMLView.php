<?php
	
	class HTMLView {

		function echoHTML ($body) {

			if ($body === null) {
				
				throw new \Exception("HTMLView->HTMLView does not allow body to be null");
			}

			echo 
				"<!DOCTYPE HTML>
					<html>
						<head></head>
						<body>
							$body
						</body>
					</html>";
		}
	}