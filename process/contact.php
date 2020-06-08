<?php 
	include $_SERVER['DOCUMENT_ROOT'].'config/init.php';
	$Contact = new contact();
	//debugger($_POST);
	if ($_POST) {
		$act='Add';
		$data = array(
				'email'=>filter_var($_POST['email'],FILTER_VALIDATE_EMAIL),
				'subject'=>sanitizer(htmlentities($_POST['subject'])),
				'message' => sanitizer(htmlentities($_POST['message'])),
				'status' => 'Active',
			);
		 //debugger($data);

		if (isset($_POST['id']) && !empty($_POST['id'])) {
			//update
			$act = 'updat';
			$contact_id = (int)$_POST['id'];
		}else{
			//add
			$act = 'add';
			$contact_id= false;
		}

		if ($contact_id) {
			$contact_info = $Contact->getContactbyId($contact_id);
			if ($contact_info) {
				$success = $Contact->addContact($data);
			}else{
				redirect('../contact','error','Contact not Found');
			}
		}else{
			$success = $Contact->addContact($data);
		}
		if ($success) {
			redirect('../contact','success','Contact '.$act.'ed Successfully');
		}else{
			redirect('../contact','error','Problem while '.$act.'ing Contact');
		}
	}