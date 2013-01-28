<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @file
 *
 * Configuration for registered users
 * 
 * Designed to be uses with CI-ACL
 * https://github.com/dollardad/CI-ACL
 *
 * This is a very simple ACL no database required login system.
 * The use case for this is small websites with one or two
 * users that require access to update blogs/news etc.
 * It is not designed for fully blown multiple users that can register etc.
 * 
 * This has been designed to work with 
 * No register function or lost password or remember me.
 *
 * Do you really need to hash the password ! If a hacker has got this far
 * they also have access to your database.php config file, your encryption key
 * in fact everything. You're basically screwed!!!
 *
 * IT IS IMPORTANT THAT THE APPLICATION DIRECTORY IS OUTSIDE OF THE WWW_ROOT or PUBLIC
 * DIRECTORY
 *
 * The password does not need to be hashed if the user has a unique password for this
 * site ie this password is not the same as their bank account password !
 */

$config['hash_password'] = TRUE; // TRUE or FALSE

// If you are going to hash the password do you want to salt it ?
$config['salt'] = 'hytuhyg&65'; // Enter a random string or NULL;

// You can change the login controller name here if you wish
$config['login_controller'] = 'login';

// Set the default landing page for users that successfully login.
// controller/method as a string or NULL, null will be the site main page 
$config['login_landing_page'] = 'admin'; 

// Set the flash message for logging a user out, NULL for no flashdata message
$config['login_message'] = 'Success! You have been logged in.';

// Set the flash message for logging a user out, NULL for no flashdata message
$config['failed_login_message'] = 'Warning! Incorrect username or password.';

// Set the default landing page for users that logout
// string or NULL, null will be the site main page
$config['logout_landing_page'] = 'login'; 

// Set the flash message for logging a user out, NULL for no flashdata message
$config['logout_message'] = 'Success! You have been logged out.';

// You must reset this admin user 
// The second element in the array is the username  $config['users']['username'];
// Don't use admin as the username - please reset   
$config['users']['admin'] = array(
    // Unique Integer for uid
    'uid' => 1,
    'email' => 'admin@example.com', 
    // Roles comes from the roles you set in the acl.php config file.
    // $config[ 'roles' ] = array( 'user', 'blogger', 'editor', 'umpire', 'admin' ).
    // Apply the roles you want this user to have.
    'roles' => array('user','cricket', 'umpire', 'admin'),
    // Remember to make it strong, if you are using hashed password then use the login controller
    // To create a hashed password
    // http://domain.com/login/display_hashed_password/thepassword
    // Copy and paste the result here as a string
    'password' => 'mypassword',
);

// A Second User - change it or delete it.
$config['users']['bob'] = array(
    // Unique Integer for uid
    'uid' => 2,
    'email' => 'bob@example.com',
    'roles' => array('user'),
    'password' => 'd7d5dfdbf69fd107accb7e7a0d842058635d85af',  // bobthebuilder
);

/* Template for more users

$config['users'][] = array(
    'username' => '',
    'email' => '',
    'roles' => array(),
    'password' => '',
);

*/
/* End of login.php */
/* application/config/login.php */
