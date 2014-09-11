<?php 
	
	Class MemberView {

		public function GetMemberStartHTML () {

			$memberHTML = '<div>
							<h1>Laboration 1</h1>
							<h2>Admin är inloggad</h2>
							<p>Inloggningen lyckades.<p/>
						</div>
						<a href="?logout">Logga ut<a/>';

			return $memberHTML;
		}

		public function UserPressLogoutButton () {

			if(isset($_GET['logout'])) {

				return true;
			} else {
				return false;
			}
		}
	}