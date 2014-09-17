<?php 
	
	Class MemberView {

		public function GetMemberStartHTML ($message) {

			$successMessage = isset($_GET['login']) ? '<p>' . $message . '</p>' : "";

			$memberHTML = '<div>
							<h2>Admin är inloggad</h2>' .
							$successMessage .
						'</div>
						<a href="?logout">Logga ut<a/>';

			return $memberHTML;
		}

		public function UserPressLogoutButton () {

			if (isset($_GET['logout'])) {

				return true;
			}
		}
	}