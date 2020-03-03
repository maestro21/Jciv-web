<?php $rs = $ruleset['name']; ?>

&rarr; <a href="?m=rulesets&ruleset=<?php echo $rs;?>&tab=nations">All</a> / <a href="?m=rulesets&ruleset=<?php echo $rs;?>&tab=nations&id=">+add new</a>

<?php

$showForm = (isset($_GET['id'])); 

if($showForm){ 
    $id = $_GET['id'] ?? '';
    $isNew = (empty($id));
    ?>
    <h2 class="nations">&rarr; <?php if($isNew) echo 'new nation'; else echo $id;?></h2>
</form>
<form method=POST action="">
<input type=hidden name=do value=saveNation>
<?php
    $fields = [
        'name' => [ 'Nation Name' ],
        'flag' => ['National flag', 'flag'],
        'countryName' => ['Country name'],
        'cityStyle' => [ 'City style', 'select', av2k($ruleset['cities']) ],
        'description' => ['Description', 'textarea'],
        'cities' => ['Cities', 'textarea'],
    ];      
    $nation = $isNew ? [] : fjson("rulesets/$rs/nations/$id"); print_r($nation);
      
    aform($fields, $nation, 'nation'); ?>

    <?php if(!$isNew) { ?>
        <h2>Governmetns</h2>
        <div class="govts">
        <?php            
        $governments = getGovernments();             
        foreach($governments as $gov) { 
            $gfields = [
            'gov' => [ $gov, 'info'],
            'flag' => ['Flag', 'flag'],
            'country' => ['Country name'],
            'title' => ['Title'],
            'ruler' => [ 'Ruler']     
            ];
            aform($gfields,$nation['govs'][$gov] ?? ['flag' => $nation['flag']], "nation[govs][$gov]");                 
        }    
        echo e('div>');
    }
} else {?>
    <div class="nationList">
        <?php $nations = dir_list("rulesets/$rs/nations"); 
        foreach($nations as $nation) { $nation = explode('.', $nation)[0];
            echo "<a href='?m=rulesets&ruleset=$rs&tab=nations&id=$nation'>$nation</a>";
        } ?>
    </div>    
<?php } ?>