<style >
	form span{color:red}
	tr:not(:first-of-type){cursor:pointer;}
	tr:not(:first-of-type):hover{background:lightcyan;}
</style>
<h1>Задачи</h1>
<p>
<table class="table table-bordered">
<tr><td>Id </td><td><a href="#byname"  id="sn" class="<?php if ($data['sortby']=="byname") echo $data['order'] ?>" >Имя пользователя <?php if ($data['sortby']=="byname"){if ($data['order']=="asc") echo '&#9660;';else echo '&#9650;';} ?></a></td><td><a href="#byemail" id="se" class="<?php if ($data['sortby']=="byemail") echo $data['order'] ?>" >Email <?php if ($data['sortby']=="byemail"){if ($data['order']=="asc") echo '&#9660;';else echo '&#9650;';} ?></a></td><td>Текст задачи</td><td><a id="sc" href="#bychecked" class="<?php if ($data['sortby']=="bychecked") echo $data['order'] ?>" >Статус <?php if ($data['sortby']=="bychecked"){if ($data['order']=="asc") echo '&#9660;';else echo '&#9650;';} ?></a></td></tr>
<?php
	while($row = $data['model']->fetch_assoc()) {
        echo "<tr><td>".$row["id"]."</td><td>".$row["name"]."</td><td>".$row["email"]."</td><td>".htmlspecialchars_decode($row["task"])."</td><td> ".(($row["checked"]=='0')? '': 'Выполнено')." ".(($row["viewed"]=='0')? '': 'Отредактировано администратором')."</td></tr>";
	}
?>

</table>
<div class="col-md-12" style="text-align:center;">
<ul class="pagination">
        <li><a href="#1" class="pl" >First</a></li>
        <li class="<?php if($data['pageno'] <= 1){ echo 'disabled'; } ?>">
            <a class="pl" href="<?php if($data['pageno'] <= 1){ echo '#'; } else { echo "#".($data['pageno'] - 1); } ?>">Prev</a>
        </li>
        <li class="<?php if($data['pageno'] >=$data['pages']){ echo 'disabled'; } ?>">
            <a class="pl" href="<?php if($data['pageno'] >= $data['pages']){ echo '#'; } else { echo "#".($data['pageno']+1 ); } ?>">Next</a>
        </li>
        <li><a  class="pl"href="#<?php echo $data['pages']; ?>">Last</a></li>
</ul>
</div>


<form name="tc" method="post" action="">
	<input type="hidden" name="pgnum" value="<?php echo $data['pageno'] ?>">
	<input type="hidden" name="sortby" value="<?php echo $data['sortby'] ?>">
	<input type="hidden" name="order" value="<?php echo $data['order'] ?>">
</form>

<form name="datachange" method="post" action="">
		Имя: <input class="input-group"  type="text" name="name" style="width:50%;" /><span id="en"></span><br/>
		Email: <input class="input-group" type="text" name="email" value="" style="width:50%;"/><span id="ie"></span><br/>
		Задача: <label class="input-group"  for="task"></label>
		<textarea name="task" rows="3" style="width:50%;"></textarea><span id="et"></span><br/>
		<?php if(isset($_SESSION['is_auth'])) echo "Выполнено: <input type=\"checkbox\" class=\"input-group\" name=\"checked\" checked /><br/>
		ID: <input class=\"input-group \"  type=\"text\" name=\"id\" readonly /><br/>"?>
		<input type="submit" class="btn btn-primary" name="insert" value="Добавить" />
		<?php if(isset($_SESSION['is_auth'])) echo " <input type=\"submit\" class=\"btn btn-primary\"name=\"update\" value=\"Сохранить\"/>
		<input type=\"submit\" class=\"btn btn-primary\" name=\"remove\" value=\"Удалить\"/>"?>
		
		
	</form>
<script>
$(document).ready(function(){
  $("tr:not(:first)").click(function(){
    $( "input[name='id']" ).val($(this).children().eq(0).html());
	$( "input[name='name']" ).val($(this).children().eq(1).html());
	$( "input[name='email']" ).val($(this).children().eq(2).html());
	$( "textarea[name='task']" ).val($(this).children().eq(3).text());
	$( "input[name='checked']" ).prop('checked',  $(this).children().eq(4).html().indexOf("Выполнено")>=0 ? true : false);//($(this).children().eq(4).html());
  });
  $(".pl").click(function(){
    a=parseInt($(this).attr("href").substring(1));
	if (a) $( "input[name='pgnum']" ).val(a);
	$("form[name='tc']").trigger('submit');
  });
  $("form[name='datachange']").submit(function(event){
	$fine=true;
	$("#en").html("");
	$("#ie").html("");
    if ($( "input[name='name']" ).val()=="") {$("#en").html("Имя не должно быть пустым");$fine=false;}
	var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
	if (!($( "input[name='email']" ).val()).match(mailformat)) {$("#ie").html("Не корректный адрес");$fine=false;}
	if(!$fine) event.preventDefault();
	else{
		s=($( "textarea[name='task']" ).val());
		s=s.replace(/</g,"&lt;");
		s=s.replace(/>/g,"&gt;");
		s=s.replace(/\//g,"&sol;");
		$( "textarea[name='task']" ).val(s);
	}
  });
  $("#se,#sn,#sc").click(function(){
	$( "input[name='sortby']" ).val($(this).attr("href").substring(1));
	a=$( "input[name='order']" ).val();
	if (a=="asc") b="desc";else b="asc";
	
	$(this).removeClass(a).addClass(b);
	$( "input[name='order']" ).val(b);
	$("form[name='tc']").trigger('submit');
  });
  
  
});
</script>

</p>