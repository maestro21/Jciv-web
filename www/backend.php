<?php


if($_POST) {
    $do = $_POST['do'];


    switch($do) {

        case 'saveNation':
            $nation = $_POST['nation'];
            $name = slug($nation['name']);
            $ruleset = $_GET['ruleset'];
            file_put_contents("rulesets/{$ruleset}/nations/{$name}.json", 
                json_encode($nation, JSON_PRETTY_PRINT));

            if(empty($_GET['id'])) {
                redirect("?m=rulesets&ruleset=$ruleset&tab=nations&id=$name");
            }
        break;


        case 'newRuleset':
            $name = $_POST['name'];
            if(!file_exists('rulesets/' . $name)) {
                mkdir('rulesets/' . $name);
                echo $name;
            }
            die();
         break;



        case 'saveRuleset':
            $name = $_POST['name'];
            $ruleset = $_POST['ruleset'];
            file_put_contents("rulesets/{$name}/ruleset.json", 
                json_encode($_POST['ruleset'], JSON_PRETTY_PRINT));


            foreach($_FILES['ruleset']['error'] as $k => $e) {
                if($e > 0) continue;
                $fn = str_replace('_', '', $k);
                $dst = "rulesets/{$name}/{$fn}.png";
                @move_uploaded_file($_FILES['ruleset']['tmp_name'][$k], $dst);
            }
        break;


        case 'createMap':
            $map = $_POST['map'];
            $name = $map['name'];
            $ruleset = getRuleset($map['ruleset']);
            include('backend/generatemap.php');
            $map['terrain'] = createTerrainFromImage($_FILES['map']['tmp_name']['terrain']);
            jsonf("maps/$name/$name",$map);

            break;

    }
}