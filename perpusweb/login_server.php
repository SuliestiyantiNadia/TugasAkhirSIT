<?php
    require_once( "nusoap-0.9.5/lib/nusoap.php");

    $server = new soap_server();
    $server->configureWSDL('Login', 'urn:Login');

    $server->register('loginService',
        array('username' => 'xsd:string', 'password' => 'xsd:string'),
        array('username' => 'xsd:string'),
        'urn:Login','urn:LoginAction');

    function dbConnect($query){
        try{
            $connect = mysql_connect("localhost","root","");
            $db = mysql_select_db("perpusweb");
            return mysql_query($query);
        } catch(Exception $e){
            echo $e->getMessage();
        }
    }

    function loginService($username,$password){
        if(empty($username) or empty($password) )
            return 'Please fill all the required fields';

        $username = strip_tags(mysql_real_escape_string($username));
        $password = strip_tags(mysql_real_escape_string($password));

        $result = dbConnect("SELECT * FROM admin where username='$username' AND password='$password'");

        if(mysql_num_rows($result) < 1)
            return 'Sorry but no data with the given username';

        while(list($username) = mysql_fetch_row($result)){
			return 'Welcome, '.$username;;
        }
    }
	
    $HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA)
        ? $HTTP_RAW_POST_DATA : '';
    $server->service($HTTP_RAW_POST_DATA);
