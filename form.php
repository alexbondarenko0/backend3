<?php $konechno = ["Ноль", "Одна", "Две", "Три", "Четыре"]; 
header('Content-Type: text/html; charset=UTF-8');?>
<?php $silaname = ["immort", "invis", "fly", "telep", "fireb"];?>
<?php $sila = ["Бессмертие", "Прохождение сквозь стены", "Полет", "Телепортация", "Файрбол"];?>

<head>
	<title>Form</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
    <form action="" method="POST">
      <p>ФИО: <input name="fio"></p>
      <p>Электронная адрес: <input name="mail"></p>
      <p>Год рождения:  
      	<select name = "birth">
      		<?php for($i = 1900; $i < 2020; $i++){?>
      		<option value = "<?php echo $i ?>" > <?php echo $i ?> </option>
      		<?php } ?>
      
      		<option selected value="2000">2000</option>
      	</select>
      </p>
      <p>Пол: 
      	<label><input type="radio" name = "gender" value = "m" checked>Мужской</label>
      	<label><input type="radio" name = "gender" value = "f" >Женский</label>
      </p>
      <p>Кол-во конечностей:
          <?php for($k = 0; $k < 5; $k++){?>
         	<label><input type="radio" name = "hands" value = "<?php echo $k ?>"> <?php echo $konechno[$k] ?> </label>
          <?php } ?>
      	<label><input type="radio" name = "hands" value = "5" checked>Пять</label>
      </p>
      <p>Суперсилы: <br>
      	<select size="5" multiple name = "superpowers[]">
      		<?php for($i = 0; $i < 5; $i++) {?>
      		<option value = "<?php echo $silaname[$i] ?>"> <?php echo $sila[$i] ?></option>
      		<?php }?>
      	</select>
      </p>
      <p>Биография:<br>
      	<textarea name = "biogr" rows="20" cols="80" placeholder = "..."></textarea>
      </p>
      <p>С контрактом ознакомлен
      	<input type = "checkbox" name = "contract">
      </p>
      <p>
    	<input type="submit" value="Отправить" />
      </p>
    </form>
</body>

