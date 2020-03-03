<html>
<head>
    <LINK REL="StyleSheet" HREF="www/style.css" TYPE="text/css" MEDIA="screen">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,600,700,800,900" rel="stylesheet" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />

    
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script src="www/script.js" type="text/javascript"></script>
</head>
<body>
<div class="wrap">
    <h1>JCiv</h1>
    <nav>
        <?php $m = $_GET['m'] ?? 'rulesets';
        $links = ['rulesets', 'maps', 'flags'];
        foreach($links as $link) {
        ?>
            <a href="?m=<?php echo $link;?>"<?php if($link == $m) echo ' class="active"';?>><?php echo $link;?></a>
        <?php } ?>
    </nav>

    <div class="content">
        <?php echo tpl($m); ?>
    </div>

    <?php 
//echo flagdd();
?>
</div>
</body>
</html>