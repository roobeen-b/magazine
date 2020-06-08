<?php 
	include $_SERVER['DOCUMENT_ROOT'].'config/init.php';
	$Contact = new contact();
	debugger($_GET);
	

	if ($_GET) {
		if (isset($_GET['id']) && !empty($_GET['id'])) {
			$contact_id = (int)$_GET['id'];
			if ($contact_id) {
				$act = substr(md5("Delete-Message-".$contact_id.$_SESSION['token']), 3,15);
					if($act == $_GET['act']){
					
					$contact_info = $Contact->getContactbyId($contact_id);
					
					if ($contact_info) {
						$data = array(
							'status'=>'Passive'
						);
						
						$success = $Contact->updateContactById($data,$contact_id);
						
						if ($success) {
							redirect('../contact','success','Contact deleted Successfully');
						}else{
							redirect('../contact','error','Error while deleting Contact');
						}
					}else{
						redirect('../contact','error','Contact not Found');
					}
				}else{
					redirect('../contact','error','Invalid Action');
				}
			}else{
				redirect('../contact','error','ID is invalid');
			}
		}else{
			redirect('../contact','error','ID is required');
		}
	}else{
		redirect('../contact','error','Unauthorized Access');
	}
?>