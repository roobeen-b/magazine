<?php
	include $_SERVER['DOCUMENT_ROOT'].'config/init.php';
	debugger($_POST);
	$data = array();
	if ($_POST) {
		if (isset($_POST['email']) && !empty($_POST['email'])) {
				$data['email'] = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
				if ($data['email']) {				
					if (isset($_POST['password']) && !empty($_POST['password'])) {
						$data['password'] = sha1($_POST['email'].$_POST['password']);
						$user = new user();
						$user_info = $user->getUserbyEmail($data['email']);
						debugger($user_info);
						if (isset($user_info[0]->email) && !empty($user_info[0]->email)) {
							if ($user_info[0]->password == $data['password']) {
								if ($user_info[0]->role =='Admin') {
									if ($user_info[0]->status == 'Active') {
										$_SESSION['user_id'] = $user_info[0]->id;
										$_SESSION['user_name'] = $user_info[0]->username;
										$_SESSION['user_email'] = $user_info[0]->email;
										$_SESSION['user_role'] = $user_info[0]->role;
										$_SESSION['user_status'] = $user_info[0]->status;
										$token = tokenizer();
										$_SESSION['token'] = $token;

										$datas = array(
											'session_token' => $token
										);
										$user->updateUserByEmail($datas, $_SESSION['user_email']);
										if (isset($_POST['rememberme']) && !empty($_POST['rememberme'] && $_POST['rememberme']=='on')) {
											setcookie('_auth_user',$token,time()+(60*60*24*7),'/');
										}
										
											redirect('../index', 'success', 'Welcome to dashboard.');

									}else{
										redirect('../login', 'error', 'Your account is not active!');
									}
								}else{
									redirect('../login', 'error', 'You are not authorized to log in here!');
								}
							}else{
								redirect('../login', 'error', 'Incorrect password!');
							}
						}else{
							redirect('../login', 'error', 'Email not found! Please sign up your email first!');
						}
					}else{
						redirect('../login', 'error', 'Please give your password!');
					}
				}	else{
					redirect('../login', 'error', 'Email type not correct!');
				}
			}	else{
					redirect('../login', 'error', 'Please insert your email first!');
				}
			}else{
			redirect('../login/', 'error', 'Unauthorized Access!');
		}
	?>