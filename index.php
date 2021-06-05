<?php

require_once('includes/header.php');
?>

<div class="derniers">
    <h4>
        Derniers T-Shirt </h4>
    <?php

    $select = $db->prepare("SELECT * FROM products ORDER BY id DESC LIMIT 0,3");
    $select->execute();

    while($s=$select->fetch(PDO::FETCH_OBJ)){

        $lenght=50;

        $description = $s->description;
        $new_description=substr($description,0,$lenght)."...";
        $description_finale=wordwrap($new_description,50,'<br/>',false);

        ?>
    <div style="text-align:center;">
        <img src="admin/imgs/<?php echo $s->title; ?>.jpg"/>
        <h2 style="color:black;"><?php echo $s->title;?></h2>
        <h5><?php echo $s->$description_finaleption; ?></h5>
        <h4><?php echo $s->price; ?> €</h4>
    </div>
        <br/><br/>

        <?php
    }

    ?>

</div>
<?php
require_once('includes/footer.php');
?>
