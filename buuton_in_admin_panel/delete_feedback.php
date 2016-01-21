<?php

global $wpdb;
$table_name = $wpdb->prefix . 'feedback';

if(isset($_POST)){
	foreach ($_POST as $value) {
		$feedbackId = $value;

		$deleteFeedback = $wpdb->query($wpdb->prepare("DELETE * from $wpdb->table_name where feedbackId = $feedbackId"));

		if($deleteFeedback){
			/*можно  js контекстное окно запилить*/
			echo "<br>Удаление прошло успешно"; 
			header('location: proba.php');
		}
		else{
			echo "<br>Houston, We have a problem";
			header('location: proba.php');
		}
	}
}

?>