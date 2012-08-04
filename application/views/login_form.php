<?php
echo '<section>';
    echo heading('Login', 2);
    echo form_open('Login/validate');
        echo '<p>';
            echo form_label('Username', 'username');
            $input = array(
                'name' => 'username',
                'id' => 'username',
                'placeholder' => 'Enter your Username',
            );
            echo form_input($input);
        echo '</p>'; 
        echo '<p>';
            echo form_label('Password', 'password');
            $input = array(
                'name' => 'password',
                'id' => 'password',
                'placeholder' => 'Enter your Password',
            );
            echo form_password($input);
        echo '</p>';
        echo '<p>';
            echo form_submit('submit', 'Login', 'class="btn"');
        echo '</p>';               
    echo form_close();
echo '</section>';