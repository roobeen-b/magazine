<?php 
	include $_SERVER['DOCUMENT_ROOT'].'config/init.php';
	$Ad = new ad();
	 //debugger($_POST);
	//debugger($_FILES,true);

	if ($_POST) {
		$data = array(
				'url' => ($_POST['url']),
				'adType'=> ($_POST['adType']),
				'status' => 'Active',
				'added_by' => $_SESSION['user_id']
			);

		// debugger($data);

		if (isset($_FILES) && !empty($_FILES) && !empty($_FILES['image']) && $_FILES['image']['error'] == 0) {
			$success=uploadImage($_FILES['image'],'ad');
			if ($success) {
				$data['image'] = $success;
				if (isset($_POST['old_img']) && !empty($_POST['old_img']) && file_exists(UPLOAD_PATH.'ad/'.$_POST['old_img'])) {
					unlink(UPLOAD_PATH.'ad/'.$_POST['old_img']);
				}
			}else{
				redirect('../ad','error','Error while uploading Image');
			}
		}


		if (isset($_POST['id']) && !empty($_POST['id'])) {
			//update
			$act = 'Updat';
			$ad_id = (int)$_POST['id'];
		}else{
			//add
			$act = 'Add';
			$ad_id= false;
		}

		if ($ad_id) {
			$ad_info = $Ad->getAdbyId($ad_id);
			if ($ad_info) {
				if ($_SESSION['user_id'] == $ad_info[0]->added_by) {
					$success = $Ad->updateAdById($data,$ad_id);
				}else{
					redirect('../ad','error','You are not allowed to access this Ad');
				}
			}else{
				redirect('../ad','error','Ad not Found');
			}
		}else{
			$success = $Ad->addAd($data);
		}
		if ($success) {
			redirect('../ad','success','Ad '.$act.'ed Successfully');
		}else{
			redirect('../ad','error','Problem while '.$act.'ing Ad');
		}
	}else if ($_GET) {
		// debugger($_GET,true);
		if (isset($_GET['id']) && !empty($_GET['id'])) {
			$ad_id = (int)$_GET['id'];
			if ($ad_id) {
				$act = substr(md5("Delete-Ad-".$ad_id.$_SESSION['token']), 3,15);
				if ($act == $_GET['act']) {
					$ad_info = $Ad->getAdbyId($ad_id);
					if ($ad_info) {
						$data = array(
							'status'=>'Passive'
						);
						$success = $Ad->updateAdById($data,$ad_id);
						if ($success) {
							redirect('../ad','success','Ad Deleted Successfully');
						}else{
							redirect('../ad','error','Error while Deleting Ad');
						}
					}else{
						redirect('../ad','error','Ad not Found');
					}
				}else{
					redirect('../ad','error','Invalid Action');
				}
			}else{
				redirect('../ad','error','ID is invalid');
			}
		}else{
			redirect('../ad','error','ID is required');
		}
	}else{
		redirect('../ad','error','Unauthorized Access');
	}
?>