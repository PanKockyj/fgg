<?php

/*
Plugin Name: save-feedback-in-bd
Plugin URI: 
Description: Плагин сохраняет фидбек в базе данных
Version: 1.0
Author: Пан Коцький
Author URI: 
License: GPL2
*/

/*  Copyright YEAR  PLUGIN_AUTHOR_NAME  (email : pan_kockyj@ukr.net)
 
    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.
 
    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.
 
    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

global $wpdb;
foreach ($_POST as $key => $value) {
	$$key = $value;
}

$dateFeedback = the_date('j-F-Y', '', '', false);
//$table_name = $wpdb->prefix . 'feedback';


/*$accessToDB = $wpdb->query("SHOW TABLES FROM 'db_name' LIKE '$tableName';")
$result = mysql_fetch_array($query);*/

function saveFeedback($name, $address, $phone, $email, $thema, $dateFeedback){
global $wpdb;
$table_name = $wpdb->prefix . 'feedback';


if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") == $table_name){

	$saveFeedback = $wpdb->query($wpdb->prepare
		("INSERT INTO $table_name set (name, address, phone, email, thema, message) values (%s, %s, %s, %s, %s, %s, %s)", $name, $address, $phone, $email, $thema, $message, $dateFeedaback));
}

elseif($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name){
	
	$sql = "CREATE TEBLE {$tableName} (
		feedbackId INT(11) NOT NULL AUTO_INCREMENT, 
		name varchar(255) NOT NULL,
        address varchar(255) NOT NULL, 
		phone varchar(13) NOT NULL,
        email varchar(80),
        thema text,
        message text NOT NULL,
        dateFeedaback date NOT NULL,
         
		PRIMARY KEY (feedbackId)");
		
		dbDelta($sql);
}
}


saveFeedback($name, $address, $phone, $email, $thema, $dateFeedback);

?>