CI-ACL
======

Simple Codeigniter ACL and Login System

PHP 5.3 (Should be OK for php 5.2)
Codeigniter 2.1.2 (Should be OK for any version 2 branch)

This is a very simple Role Based Access Control List RBACL and Login system which does not require
a database.

The use case for this is where you have a website with one or a couple of people requiring access to say update
the blog or news.

These set of classes allows you to have an authentication system without the heavy load.

It does not have register user, lost password or remember me. IT IS A SIMPLE BUT SECURE auth system that does not require
a database backend.

It allows you to generate roles for users on a per controller/object bases.
I have taken the idea from the Drupal ACL but much simpler method.

You added users and their roles in the application/config/login.php file.

You add permissions in the application/config/acl.php file.

I've added an example controller for ACL and a login controller for mmmmm... the login.

Read through the config files which I have documented.

## public functions available ##

-- libraries/acl.php
has_permission($controller, $required_permissions = array(), $author_id = NULL)

is_logged_in()

-- libraries/simple_user_login.php
validate($redirect) // Validate login form. Set login landing page in application/config/login.php

logout($redirect) // Set logout landing page in application/config/login.php

hash_password($password) // Set salt in the config file application/config/login.php
