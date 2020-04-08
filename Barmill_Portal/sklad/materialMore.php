<div class="MaterialPage">
    <div class="barMaterial">
        <Label class="preview">Материал</Label>
        <img class="img_mat" src="sklad/img",$row['ozm'],".jpg" onerror="this.onerror=null;this.src='img/error_pictures/noImg.jpg';">
        <div class="chartWrapper">
            <div class="chartAreaWrapper">
                <canvas id="myChart"></canvas>
            </div>
            <canvas id="myChartAxis" height="200" width="0"></canvas>
        </div>
    </div>
<?php 
    
    SelectMatVariables($_GET["nameMaterial"]);
function SelectMatVariables($name){
    include   "sql_connect.php";
    
    $query_ = "select mat_date,spisanie_or_dobavlenie,mat_qty,min,max from history join materials on materials.id=history.mat_id where name_mat ='$name'";
    $stmt = sqlsrv_query($conn,$query_);
    while($row = sqlsrv_fetch_array($stmt)){
        $mat_date = $row['mat_date']->format('d.m.Y');
        $spisanie_or_dobavlenie = $row['spisanie_or_dobavlenie'];
        $mat_qty = $row['mat_qty'];
        $min = $row['min'];
        $max = $row['max'];
        
        $matDateArr = $mat_date;
        $spisanieDobavlenieArr = $spisanie_or_dobavlenie;
        $matQtyArr = $mat_qty;
        $minArr = $min;
        $maxArr = $max;
        echo "$spisanieDobavlenieArr $matDateArr $matQtyArr $minArr $maxArr;";
    }
    sqlsrv_close($conn);
}
?>
</div>

<script>	
    
function createGrafik(){
        var infoMat = document.querySelector('#matInfo').innerHTML;
        var ctx = document.querySelector('#myChart');
        
        var res = infoMat.split(";");
        
        var _sod =new Array();
        var _date = new Array();
        var _qty =  new Array();
        var qtyNow = 0;
        var _qtyS = new Array();
        var _qtyV = new Array();
        var _min= new Array();
        var _max= new Array();
        
        
        for(var i=0;i<res.length-1;i++){
            _sod.push(res[i].split(" ")[0]);
            _date.push(res[i].split(" ")[1]);
            if(_sod[i]==0){
               _qtyS.push(res[i].split(" ")[2]);
                _qtyV.push(0);
                qtyNow -=Number(res[i].split(" ")[2]);
            }else{
                _qtyS.push(0);
               _qtyV.push(res[i].split(" ")[2]);
                qtyNow +=Number(res[i].split(" ")[2]);
            }
            _qty.push(qtyNow);
            _min.push(res[i].split(" ")[3]);
            _max.push(res[i].split(" ")[4]);
        }
        
        Chart.defaults.global.defaultFontFamily = "Lato";
        Chart.defaults.global.defaultFontSize = 14;

        var dataSpisanie = {
            label: "Списание",
            data: _qtyS,
            lineTension: 0.3,
            fill: false,
            borderColor: '#FF7373'
          };
        var dataVnesenie = {
            label: "Внесение",
            data: _qtyV,
            lineTension: 0.3,
            fill: false,
          borderColor: '#5CCCCC'
          };
        var dataQty = {
            label: "Остаток",
            data: _qty,
            lineTension: 0.3,
            fill: false,
          borderColor: '#C9F76F'
          };

        var allData = {
          labels: _date,
          datasets: [dataSpisanie, dataVnesenie,dataQty]
        };

        var chartOptions = {
            responsive: true,
            maintainAspectRatio: false,
          legend: {
            //display: true,
            position: 'top',
            labels: {
              boxWidth: 15,
              fontColor: 'black'
            }
          },
          scales: {
            yAxes: [{
                ticks: {
                    suggestedMin: _min[0],
                    suggestedMax: _max[0],
                    display: false
                },
                gridLines: {
                    color: "rgba(0, 0, 0, 0)",
                },
                scaleLabel: {
                    display: true,
                    labelString: "Количество",
                  }
            }],
            xAxes: [{
                gridLines: {
                color: "rgba(0, 0, 0, 0)",
            }
            }]
        }
        };
        
        var lineChart = new Chart(ctx, {
          type: 'line',
          data: allData,
          options: chartOptions
        });
    }
    /*Скрипт для открытия/скрытия окон меню по нажатию на вкладку*/
		var profile = document.getElementById("profile"),
  		btnChangeImg = document.getElementById("btnChangeImg"),
		btnChangePass = document.getElementById("btnChangePass"),
        btnChangeNotification = document.getElementById("btnChangeNotific"),
		profile_img_lbl = document.getElementById("profile_img_lbl"),
		profile_pass_lbl = document.getElementById("profile_pass_lbl");
	    profile_notific_lbl = document.getElementById("profile_notific_lbl");
    
        var classSelectedNow,lblSelectedNow;
    
		/* При нажатии на вкладку "фотография профиля" */
		btnChangeImg.addEventListener('click', function() {
            changeDisplayViewBtn(profile_img_lbl,'change_img');
		})
		/* При нажатии на вкладку "Пароль" */
		btnChangePass.addEventListener('click', function() {
            changeDisplayViewBtn(profile_pass_lbl,'change_pass');
		})
        /* При нажатии на вкладку "Уведомления" */
        btnChangeNotification.addEventListener('click', function() {
            changeDisplayViewBtn(profile_notific_lbl,'change_notific');
		})
    
    function changeDisplayViewBtn(Lbl_elem,Toggle_elem){
            /* удалить у блока с id 'profile' класс 'change_img' для скрытия вкладки "Пароль" */
            if(classSelectedNow !=null && classSelectedNow !=Toggle_elem ){
                profile.classList.remove(classSelectedNow);
                lblSelectedNow.innerHTML = 'Изменить';
            }
                
			/* добавить блоку с id 'profile' класс 'change_pass' для раскрытия вкладки "Фотография профиля" */
			profile.classList.toggle(Toggle_elem);
			/* Далее тернарник для изменения текста "изменить/отменить" вкладки "Пароль" в зависимости состояния вкладки "скрыта/раскрыта"*/
			Lbl_elem.innerHTML == 'Изменить' ?
			Lbl_elem.innerHTML = 'Отмена' :
			Lbl_elem.innerHTML = 'Изменить';
        
            classSelectedNow = Toggle_elem;
            lblSelectedNow = Lbl_elem;
    }
</script>