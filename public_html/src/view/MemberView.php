<?php 
	
	Class MemberView {

		public function ShowMemberView () {

			$memberHTML = '<div>
							<h1>Laboration 1</h1>
							<h2>Admin är inloggad</h2>
							<p>Inloggningen lyckades.<p/>
						</div>
						<a href="?l=logout">Logga ut<a/>';

			return $memberHTML;
		}

		public function UserPressLogoutButton () {

			if($_GET['l'] === "logout") {

				return true;
			} else {
				return false;
			}
		}
	}