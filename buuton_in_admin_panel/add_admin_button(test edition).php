<?php

/*регистрируем функцию, использующую хук "действие" (add action) с параметром admin_menu, 
 *при этом данных хук должен располагаться выше функции
 */

add_action( 'admin_menu', 'view_feedback_menu' );

/* Создать функцию, которая содержит код для создания меню*/

function view_feedback_menu(){
	add_menu_page('View all feedback', 'View Feedback', 'manage_options', 'my-unique-identifier', 'view_feeadback_options');
}

/*Создаем HTML для этой страницы, которая отображается при нажатии на новый пункт меню.*/

function view_feeadback_options($table_name){
	if(!current_user_can('manage_options')){
		wp_die(__('You do not have sufficient permissions to access this page'));
	}
	
	global $wpdb;
	//$table_name = $wpdb->prefix . 'feedback';
	$allFeedback = $wpdb->query($wpdb->prepare("SELECT * from $wpdb->table_name ORDER BY dateFeedaback DESC"));

/*Вывод на экран фидбеков*/

	if($allFeedback){
		$row=$allFeedback->fetch();

/*есть иной вариант, без каунтеров*/


		$counterViewFeedback = count($row);
		for($i=0;$i<=$counterViewFeedback;$i++){
			foreach ($row[$i] as $key => $value) {
				$$key = $value;
			}

/*Собственно форма вывода*/

			echo "<form method='post' action='delete_feedback.php'>";
			echo '<pre>
			<div class="wrap">';
			echo "<input name='$feedbackId' type='checkbox' value='$feedbackId'>";
			echo "Автор обращения:    $name<br>Дата обращения:     $dateFeedback<br>";
				//Дата обращения: $dateFeedaback<br>";
				if(isset($phone)){echo "Контактный телефон: $phone<br>";}
				if(isset($email)){echo "Электронная почта:  $email<br>";}
			echo "Тема обращения:     $thema<br><br>$message";
			echo '</div>
			</pre><hr>';
		}
		echo "<input type='submit' name='delete' value='Удалить'>";
	}
}


//add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );

?>