<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cricket extends CI_Controller {

	public function __construct() 
	{
		parent::__construct();
		$this->load->library( array('session', 'acl'));

		// For this example I'm going to manually add user session data
		$data = array('uid' => 1, 'roles' => array( 'blogger', 'umpire'));
		$this->session->set_userdata($data);
	}

	public function index()
	{

		/*
		 * The has_permission() accepts 3 params
		 *
		 * The controllor or action: String, Required, here I'm being flash and calling the classname.
		 *
		 * The second param is an array or string, Optional,  which are the permission action
		 * that will trigger a return true. In this case we have called 'add' which applies to
		 * two roles 'umpire' and 'admin'.  This is optional and will default to 'delete all'
		 * which should be reserved for the highest permission in the controller, normally admin.
		 *
		 * The third param is an Integer, Optional, which is the user id of the object, like author id on a post.
		 * This allows the user who has 'edit own' to be able to access only their own objects.
		 * Optional.
		 *
		 */

		/*
		 * For this example, which is the default index method, we only want the users with the action
		 * 'add' to view this page.
		 * I'm being a smart arse and classing the contoller name dynamically, otherwise you could just
		 * enter 'cricket' or in fact any other controller listed in your acl array.
		 */

		if ($this->acl->has_permission(strtolower( __CLASS__), 'add'))
		{
			echo '<h1>we have permission</h1>';
		}
		else
		{
			echo '<h2>No way Hosay!</h2>';
		}
	}

	public function listAll()
	{
		/* We only want admin to access this function
		 * only need to use the first param as the default is for admin only
		 */
		if ($this->acl->has_permission( 'cricket'))
		{
			echo '<h1>The admin dude has permission</h1>';
		}
		else
		{
			echo '<h2>No way Hosay!</h2>';
		}
	}

	public function bounceBall()
	{
		/* a completely different function but we want bloggers, which is a different
		 * controller, not umpires to view this function
		 * so note the different use of the first param
		 *
		 * we also have to simulate an author id
		 */
		$bounce_ball_author = 1;

		if ($this->acl->has_permission( 'users', array('edit own'), $bounce_ball_author))
		{
			echo '<h1>The blogger has permission</h1>';
		}
		else
		{
			echo '<h2>No way Hosay!</h2>';
		}
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/cricket.php */