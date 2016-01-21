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

	if($allFeedback){
		$row=$allFeedback->fetch();
		$counterViewFeedback = count($row);
		for($i=0;$i<=$counterViewFeedback;$i++){
			foreach ($row[$i] as $key => $value) {
				$key = $value;
			}
			echo '</pre>
			<div class="wrap">';
			echo "Автор обращения: $name<br>
				Дата обращения: $dateFeedaback<br>".
				if(isset($phone)){."Контактный телефон: $phone<br>".}
				if(isset($email)){."Электронная почта: $email<br>".}
				."Тема: $thema<br><br>
				$message";
			echo '</div>
			<pre>';
		}
	}
}
/*НАПИШИ КНОПКИ ВИБОРУ ТА ВИДАЛЕННЯ*/

//add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );


?>