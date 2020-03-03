<?php
function tpl($_TPL, $vars=array()){

    $_url = 'www/tpl/' . $_TPL . '.tpl.php';

    /**
    Parsing template variables and returning parsed template
     **/
    if($_url){
        foreach ($vars as $k =>$v){
            if(!is_array($v) && !is_object($v))
                $$k=html_entity_decode(stripslashes($v));
            else
                $$k=$v;
        }

        ob_start();
        include($_url);
        $tpl = ob_get_contents();
        ob_end_clean();
    }

    return $tpl;
}

function slug($string) {
    $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens. 
    return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
 }


function flagdd($name = 'flagdd', $value = '') {
    return tpl('flagdd', ['name' => $name, 'value' => $value]);
}


function fjson($filename) {
    return json_decode(file_get_contents($filename . '.json'), true);
}

function jsonf($filename, $data) {
    file_put_contents($filename . '.json', json_encode($data));
}


function getRuleset($ruleset) {
    return json_decode(file_get_contents('rulesets/' . $ruleset . '/ruleset.json'), true);
}


function redirect($to, $time=0){
	$to = str_replace('#','',$to);
	echo "<html><body><script>setTimeout(\"location.href='$to'\", {$time}000);</script></body></html>"; die();
}


function dir_list($directory) {
    $files = array_diff(scandir($directory), array('..', '.'));
    return $files;
}

function isImage($src) {
    return @is_array(getimagesize($src));
}

/**
 * @param $fields - key
 * @param $values - [ Display name, type, options]
 */
function aform($fields, $values = [], $prefix = '') {
    foreach($fields as $key => $params) {
        ainput($key,
            $values[$key] ?? '',
            $params[0] ?? $key,
            $params[1] ?? 'text',
            $params[2] ?? [],
            $prefix);
    }
}

/**
 * @param $fields - key
 * @param $values - [ Display name, type, options]
 */
function form($fields, $values = [], $prefix = '') {
    foreach($fields as $key => $params) {
        rinput($key,
            $values[$key] ?? '',
            $params[0] ?? $key,
            $params[1] ?? 'text',
            $params[2] ?? [],
            $prefix);
    }
}

function getRulesetSelectOptions() {
    $rulesets = dir_list('rulesets');

    $options = [ '' => '-- none--'];
    foreach($rulesets as $ruleset) {
        $options[$ruleset] = $ruleset;
    }
    return $options;
}


function isDark($value) {
    $val = array_sum(explode(',',$value)) / 3;
    return $val < 128;
}


function rinput($key, $value, $name, $type = 'text', $options = [], $prefix = '') {
    $key = "ruleset{$prefix}[$key]";
    input($key, $value, $name, $type, $options);
}

function ainput($key, $value, $name, $type = 'text', $options = [], $prefix = '') {
    $key = "{$prefix}[$key]";
    input($key, $value, $name, $type, $options);
}


function input($key, $value, $name, $type = 'text', $options = []) {
 ?>
    <div class="input <?php echo $type;?>">
        <label for="<?php echo $key;?>"><?php echo $name;?>:</label>
    <?php switch($type) {

        case 'color': ?>
            <input type="text" style="background-color: rgb(<?php echo $value;?>);<?php if(isDark($value)) echo 'color: white;';?>" value="<?php echo $value;?>"  name="<?php echo $key;?>">

        <?php break;

        case 'hidden': ?>
            <?php echo $value;?>
            <input type="hidden" value="<?php echo $value;?>"  name="<?php echo $key;?>">
        <?php break;

        case 'text': ?>
            <input type="text" value="<?php echo $value;?>"  name="<?php echo $key;?>">
        <?php break;

        case 'textarea': ?>
            <textarea name="<?php echo $key;?>"><?php echo $value;?></textarea>
        <?php break;

        case 'select': ?>
            <select name="<?php echo $key;?>">
                <?php foreach($options as $k => $v) { ?>
                    <option value="<?php echo $k;?>"<?php if($k == $value) echo ' selected=true';?>>
                        <?php echo $v;?>
                    </option>
                <?php }?>
            </select>
        <?php break;

        case 'flag': echo flagdd($key, $value); break;

        case 'file':?>
            <?php if(isImage($value)) { ?>
                <img src="<?php echo $value;?>">
            <?php } ?>
            <input type="file" name="<?php echo $key;?>">
            <?php break;

    } ?>
    </div>
<?php }


function drawTile($bg, $width, $height, $offsetx, $offsety) {
    $offsetx *= -$width;
    $offsety *= -$height;
    $style = "width:{$width}px;height:{$height}px;background:url('{$bg}') {$offsetx}px {$offsety}px"


    ?>
    <div class="tile" style="<?php echo $style;?>">&nbsp;</div>
    <?php
}

function div($class) {
    echo "<div class='$class'>";
}

function e($tag) {
    echo "</$tag>";
}

function av2k($array) {
    return array_combine($array, $array);
}


function getGovernments() {
    return [
        'tribalism',
        'monarchy',
        'democracy',
        'feudalism',
        'theocracy',
        'absolutism',
        'republic',
        'socialism',
        'communism',
        'fascism',
        'totalitarism',
    ];
}