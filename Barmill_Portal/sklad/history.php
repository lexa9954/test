<div class="WareHouseHistory">
        <form method="post" class="history_bar">
            <ul class="history_container">
                <li><input type="submit" class="history_but"  name="HistoryEnterExit" value="История посещений"/></li>
                <li><input type="submit" class="history_but" name="HistoryVsklad" value="История поступления материала"/></li>
                <li><input type="submit" class="history_but" name="HistoryIzSklada" value="История получения со склада"/></li>
            </ul>
        </form>
    
    <div class="historyContainer">
        <table class="historyTable">
            <thead>
            <tr>
                <th>
                    Дата прихода
                </th>
                <th>
                    Дата ухода
                </th>
                <th>
                    Кто посещал
                </th>
            </tr>
            </thead>
            <tbody>
                <?php
                    if(isset($_POST['HistoryEnterExit'])){ //Имя элемента
                        echo SelectTypeHistory(0);
                    }
                    if(isset($_POST['HistoryVsklad'])){ //Имя элемента
                        echo SelectTypeHistory(1);
                    }
                    if(isset($_POST['HistoryIzSklada'])){ //Имя элемента
                        echo SelectTypeHistory(2);
                    }

                    function SelectTypeHistory($typeHistory){
                        require "sql_connect.php";
                        $query_type_enter_exit = "select convert(varchar,door_controll.date_enter,106) 'enterDate',
                        convert(varchar,door_controll.date_enter,8) 'enterTime',
                        convert(varchar,door_controll.date_exit,106) 'exitDate',
                        convert(varchar,door_controll.date_exit,8) 'exitTime',
                        First_name,second_name,last_name,TabNumberSap from peoples right join door_controll on peoples.id=door_controll.people";
                        CreateMatRow(sqlsrv_query($conn,$query_type_enter_exit));
                    }
                    function CreateMatRow($queryArray){
                        while($row = sqlsrv_fetch_array($queryArray)){
                            if($row['second_name']==null){
                                echo "<tr class=\"historyItemTR\" style=\"background-color:hotpink\">";
                            }else{
                                echo "<tr class=\"historyItemTR\">";
                            } 
                            
                            echo 
                            "<td>",$row['enterDate'],"<br>",
                            $row['enterTime'],"</td>
                            <td>",$row['exitDate'],"<br>",
                            $row['exitTime'],"</td>
                            <td>",$row['second_name'],"</td>";
                            
                            echo "</tr>";

                        }
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>
  

<script> 
    
    function GenerateTable(){

    }
</script>
