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
							<h1>html start</h1>
							$body
						</body>
					</html>";
		}
	}