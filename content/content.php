<div class="content">
<?php
		$page = $_SERVER['REQUEST_URI'];
	switch($page){
    	case "/Barmill_Portal/index.php?page=profile":
			require "profile/profile.php";
			break;
    	case "/Barmill_Portal/index.php":
			echo "<div class=\"text\">1 октября 1942 г. распоряжением Совета народных комиссаров СССР Наркомчермету предложено разработать проектное задание на строительство Карагандинского металлургического завода на базе железных руд Атасуйского месторождения;
			2012 г. – выполнен запуск нового блока разделения воздуха, построенного ТОО «Линде Газ Казахстан»</div>";
			echo "<div class=\"text\">1 октября 1942 г. распоряжением Совета народных комиссаров СССР Наркомчермету предложено разработать проектное задание на строительство Карагандинского металлургического завода на базе железных руд Атасуйского месторождения;
			2012 г. – выполнен запуск нового блока разделения воздуха, построенного ТОО «Линде Газ Казахстан»</div>";
            echo "<div class=\"text\">1 октября 1942 г. распоряжением Совета народных комиссаров СССР Наркомчермету предложено разработать проектное задание на строительство Карагандинского металлургического завода на базе железных руд Атасуйского месторождения;
			2012 г. – выполнен запуск нового блока разделения воздуха, построенного ТОО «Линде Газ Казахстан»</div>";
			break;
		case "/Barmill_Portal/index.php?page=sklad":
			require "sklad/sklad.php";
			break;
        case "/Barmill_Portal/index.php?page=history":
			require "sklad/history.php";
			break;
        case "/Barmill_Portal/index.php?page=materialMore":
			require "sklad/materialMore.php";
			break;
    	default: 
			echo "<div class=\"text\">1 октября 1942 г. распоряжением Совета народных комиссаров СССР Наркомчермету предложено разработать проектное задание на строительство Карагандинского металлургического завода на базе железных руд Атасуйского месторождения;
			2012 г. – выполнен запуск нового блока разделения воздуха, построенного ТОО «Линде Газ Казахстан»</div>";
			break;
	}
?>
</div>