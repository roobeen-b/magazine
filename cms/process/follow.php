<?php
	include $_SERVER['DOCUMENT_ROOT'].'config/init.php';
	
	$FollowIcons = new follow();
	   //debugger($_POST);
	   //debugger($_FILES);
	if($_POST){
		$data = array(
			'iconname'=>sanitizer($_POST['iconname']),
			'url' => filter_var($_POST['url'],FILTER_VALIDATE_URL),
			'status' =>	'Active',
			'added_by' => $_SESSION['user_id']
		);
				

	if (isset($_POST['id']) && !empty($_POST['id'])) {
		$act = 'Updat';
		$followicons_id = (int)$_POST['id'];
	}else{
		$act = 'Add';
		$followicons_id = false;
	}

	if ($followicons_id) {
		$followicons_info = $FollowIcons->getFollowIconsbyId($followicons_id);
		if ($followicons_info) {
			if ($_SESSION['user_id'] == $followicons_info[0]->added_by) {
				// $FollowIcons>addFollowIcons($data);
				$success = $FollowIcons->updateFollowIconsbyId($data,$followicons_id);
			}else{
				redirect('../follow','error','You are not allowed to edit.');
			}
		}else{
			redirect('../follow','error','FollowIcons Not Found');
		}
	}else{		//Add	
	$success = $FollowIcons->addFollowIcons($data);
	}
	if ($success) {
		redirect('../follow','success','FollowIcons '.$act.'ed Succesfully');
	}else{
		redirect('../follow','error','Problem While '.$act.'ing FollowIcons');
	}

}else if ($_GET) {	
	//Delete
	if (isset($_GET['id']) && !empty($_GET['id'])) {
		$followicons_id = (int)$_GET['id'];

		if ($followicons_id) {
			$act = substr(md5("Delete-FollowIcons-".$followicons_id.$_SESSION['token']), 3,15);
			
			if ($act) {
				if ($act == $_GET['act']){
					$followicons_info = $FollowIcons->getFollowIconsbyId($followicons_id);
					
					if ($followicons_info) {
						$data =  array(
							'status'=>'Passive'
							);
						$success = $FollowIcons->updateFollowIconsbyId($data,$followicons_id);
						
						if ($success) {
							redirect('../follow','success','FollowIcons Deleted Succesfully.');
						}else{
							redirect('../follow','error','Error while Deleting.');
						}
					} else {
						redirect('../follow','error','FollowIcons Not Found.');
					}
				}else{
					redirect('../follow','error',"Invalid Action");
				}
			}else{
				redirect('../follow','error','action is required');
			}
		}else{
			redirect('../follow','error','Id is Invalid');
		}
	}else{
		redirect('../follow','error','Id is required.');
	}
}
else{
	redirect('../follow','error','Error Occurs during submitting');
}
?>