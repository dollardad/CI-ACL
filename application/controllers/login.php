<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends My_Controller {

    function __construct()
    {
        parent::__construct();
        // Load the user_login Class
        $this->load->library('simple_user_login');
        $this->load->helper(array('form', 'html','url'));
    }

    public function index() 
    {   
        $this->load->view('login_form',$this->data);
    }
    
    public function validate()
    {
        // If validation successful then the user will be redirected to
        // the login landing page that you set in the login config file
        // or you can set it as a string param ie
        // $this->simple_user_login->validate('dashboard/profile')
        
        $this->simple_user_login->validate();
    }
    
    /**
     * Function to log user out
     *
     * @return void
     */
    public function logout()
    {
        // We are going to use the simple_user_login class function logout
        // You could create you own but the class logout
        // will also set the flash message and redirect the user.
        // 
        // You can set the logout landing page in the login config file
        // application/config/login.php or you can set the page here
        // ie $this->simple_user_login->logout('blog/list').
        //
        // Do not forget to set the logout message in the login config file
        $this->simple_user_login->logout();
    }
    
    /**
     * Function to created a hashed password
     *
     * In the browser http://domain.com/login/thepassword
     * Where "thepassword" is the password that you want hashed.
     * Copy and paste it into your login config file against the appropriate user
     *
     * I would recommend keeping this function disabled on a production site
     *
     * @param string $password
     * @return string $hashed_password
     */     
     public function display_hashed_password($password = NULL)
     {
         // Delete or comment out this "if (statement)" if you don't want it
         if (ENVIRONMENT == 'production')
         {
             die();
         }
         if($password)
         {
             echo $this->simple_user_login->hash_password($password);
         }
     }
}