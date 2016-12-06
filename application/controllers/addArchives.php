<?php
	class addArchives extends CI_Controller {
		public function addArc($title, $source, $redirectUrl = "", $littlePicture = "") {
			$sql = "INSERT INTO e0_archives (Title , Source, RedirectUrl, LitPic) VALUES (".$title.",".$source.",".$redirectUrl.",".$littlePicture.")";
		}
	}
?>