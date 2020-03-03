<?php

$flags = dir_list('flags/src/sml/');

?>

<select class="dd" name="<?php echo $name;?>">
  <?php foreach($flags as $flag) { $flag = str_replace('.png', '', $flag) ?>
     <option value="<?php echo $flag;?>"<?php if($flag == $value) echo ' selected=selected';?>><?php echo $flag;?></option>
  <?php } ?>
</select>








