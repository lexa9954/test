	<div id="left_sidebar">
 		<!-- Кнопка бургер меню -->  
    	<div class="toggle-btn" onclick="move_left_sidebar()">
        	<span>Menu</span>
    	</div>		
		<ul>
			<li><a href="index.php?page=home" onclick="close_all_sidebar()">Главное меню</a></li>	
			<li><a href="#">Контейнер №1 &#9662;</a>
            <ul class="Sklad1">
                <li>
                    <a href="index.php?page=sklad" onclick="close_all_sidebar()">Обзор материалов</a>
                </li>
                <li>
                    <a href="index.php?page=history" onclick="close_all_sidebar()">История транзакций</a>
                </li>
                </ul>
            </li>	
            <li><a href="index.php?page=home" onclick="close_all_sidebar()">Кнопка</a></li>
		</ul> 	
	</div>	