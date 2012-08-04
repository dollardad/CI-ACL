<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Simple_User_Login {

    private $_CI;

    function __construct()
    {
        $this->_CI =& get_instance();
        $this->_CI->load->library('form_validation');
        $this->_CI->load->helper(array('security', 'url'));
        $this->_CI->config->load('login');
    }

    function validate($redirect = NULL) 
    {
        $username = $this->_CI->input->post('username');
        $password = $this->_CI->input->post('password');
        $this->_CI->form_validation->set_rules('username', 'Username', 'required|strip_tags');
        $this->_CI->form_validation->set_rules('password', 'Password', 'required|strip_tags');
        if ($this->_CI->form_validation->run() === FALSE)
        {
            $msg = validation_errors('<p>', '</p>');
            $this->_CI->session->set_flashdata('message', array('class' => 'error', 'msg' => $msg));
            redirect(base_url($this->_CI->config->item('login_controller')));
        }
        else
        {
            $users = $this->_CI->config->item('users');
            if ($users)
            {
                $msg = $this->_CI->config->item('failed_login_message');   
                if(array_key_exists($username, $users))
                {
                    $user = $users[$username];
                    $user_hash_password = $this->_CI->config->item('hash_password');
                    if ($user_hash_password)
                    {
                        $password = $this->hash_password($password);
                    }
                    if ($user['password'] == $password)
                    {
                        // User has been authenticated lets log them in
                        $msg = $this->_CI->config->item('login_message'); 
                        $this->_CI->session->set_flashdata('message', array('class' => 'success', 'msg' => $msg));
                        $data = array(
                            'uid' => $user['uid'],
                            'roles' => $user['roles'],
                            'username' => $username,
                        );
                        $this->_CI->session->set_userdata($data);
                        $page = isset($redirect) ? $redirect : $this->_CI->config->item('login_landing_page');
                        redirect(base_url($page));
                    }
                    else
                    {
                        $this->_CI->session->set_flashdata('message', array('class' => 'error', 'msg' => $msg));
                        redirect(base_url($this->_CI->config->item('login_controller')));
                    }
                }
                
                $this->_CI->session->set_flashdata('message', array('class' => 'error', 'msg' => $msg));
                redirect(base_url($this->_CI->config->item('login_controller')));
            }   
            else
            {
                // Users have not been set in the config form
                die('Whoops! - You must set your users in the application/config/login.php file');
            }
        }

    }
    
    /**
     * Function to log user out and redirect them to
     * logged out landing page
     *
     * @param string $redirect Optional
     */
    public function logout($redirect = NULL)
    {
        $page = isset($redirect) ? $redirect : $this->_CI->config->item('logout_landing_page');
        
        $logout_message = $this->_CI->config->item('logout_message');
        if($logout_message)
        {
            $this->_CI->session->set_flashdata('message', array('class' => 'success', 'msg' => $logout_message));
        }
        redirect(base_url($page));
    }
    
    /**
     * Function that returns a password hashed
     *
     * @param string $password
     * @param string $salt
     * @return string $hashed_password
     */
    public function hash_password($password = NULL)
    {
        if ($password)
        {
            // Do we need to get the salt ?
            $salt = $this->_CI->config->item('salt');
            if ($salt)
            {
                $password = $salt.$password;
            }
            $hashed_password = do_hash($password);
            
            return $hashed_password;
        }
    }
}