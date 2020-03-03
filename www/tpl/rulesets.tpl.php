<h1 class="inline">Rulesets &rarr;</h1>
Select ruleset:

<?php $rulesets = dir_list('rulesets');
    $ruleset = $_GET['ruleset'] ?? 'default';
    $rulesetData = json_decode(file_get_contents('rulesets/' . $ruleset  . '/ruleset.json'), true);
?>

<select id="rulesetSelector" onchange="selectRuleset(this.value)">
    <option value="-">--</option>
    <?php
    foreach($rulesets as $_ruleset) {
        echo "<option value='$_ruleset'>$_ruleset</option>";
    }
    ?>
    <option value="new">+ New ruleset</option>
</select>

<?php if(!$ruleset) die();?>



<script>
    document.getElementById('rulesetSelector').value = '<?php echo $ruleset;?>';
</script>



<?php $tabs = [
  'general', 'terrain', 'units', 'cities', 'nations'
]; 
?>

<h1 class="inline">&rarr; <?php echo $ruleset;?> ruleset</h2><br>

<div class="rulesetTabs">
  <?php foreach($tabs as $tab) { ?>
    <a href="#<?php echo $tab;?>" onclick="showTab('<?php echo  $tab;?>')"><?php echo $tab;?></a>
  <?php } ?>
</div>

<form id="rulesetForm" method="POST" action=""  enctype="multipart/form-data">
    <input type="hidden" name="do" value="saveRuleset">
    <input type="hidden" name="name" value="<?php echo $ruleset;?>";

    <div class="tabs">
        <?php foreach($tabs as $tab) { ?>
            <div class="tab" id="<?php echo $tab;?>">
            <h2 class="<?php echo $tab;?>"><?php echo $tab;?></h2>
            <?php echo tpl('ruleset/' . $tab, ['ruleset' => $rulesetData]);?></div>
        <?php } ?>
    </div>

    <input type="submit">
</form>


<script>
    showTab('<?php echo  $_GET['tab'] ?? $tab[0];?>');
</script>














</form>