
<form id="rulesetForm" method="POST" action=""  enctype="multipart/form-data">
    <input type="hidden" name="do" value="createMap">

    <?php
      aform([
         'ruleset' => ['Ruleset', 'select', getRulesetSelectOptions()],
         'name' => [ 'Map name'],
         'title' => [ 'Map title'],
         'description' => ['Map description', 'textarea'],
         'terrain' => [ 'Terrain', 'file'],
         'rivers' =>  [ 'Rivers', 'file']
      ], [], 'map');
    ?>
    <input type="submit">
</form>