<?php
$patten = '/([a-z0-9_]+|[a-z0-9_]+\.[a-z0-9_]+)@((liv.ac.uk)||(liverpool.ac.uk)||(student.liverpool.ac.uk))/i';

$email = "123@liverpool.ac.uk";

if(!preg_match($patten, $email)) { 
    echo "Invalid email address"; 
} 
else { 
    echo "email is valid"; 
} 



?>