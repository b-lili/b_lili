<?php 
if(!array_key_exists('P', $_GET) || empty($_GET['P']))
	$_GET['P'] = 'home';

switch ($_GET['P']) {
	case 'home': require_once PROTECTED_DIR.'normal/home.php'; break;
	case 'test': require_once PROTECTED_DIR.'normal/permission_test.php'; break;


	case 'add_reciept': IsUserLoggedIn() ? require_once PROTECTED_DIR.'reciept/add.php' : header('Location: index.php'); break;

	case 'list_reciept': IsUserLoggedIn() ? require_once PROTECTED_DIR.'reciept/list.php' : header('Location: index.php'); break;

	case 'modify_reciept': IsUserLoggedIn() ? require_once PROTECTED_DIR.'reciept/modifyReciept.php' : header('Location: index.php'); break;

	case 'login': !IsUserLoggedIn() ? require_once PROTECTED_DIR.'user/login.php' : header('Location: index.php'); break;

	case 'register': !IsUserLoggedIn() ? require_once PROTECTED_DIR.'user/register.php' : header('Location: index.php'); break;

	case 'logout': IsUserLoggedIn() ? UserLogout() : header('Location: index.php'); break;

	case 'users': IsUserLoggedIn() ? require_once PROTECTED_DIR.'user/user_list.php' : header('Location: index.php'); break;

	//case 'modify_user': IsUserLoggedIn() ? require_once PROTECTED_DIR.'user/modifyUser.php' : header('Location: index.php'); break;

	default: require_once PROTECTED_DIR.'normal/404.php'; break;
}

?>