<head>
    
     <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css' rel='stylesheet'
          integrity='sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6' crossorigin='anonymous'>
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css'>
    <link rel="stylesheet" href="../public/style.css">
</head>
<body> 
<div class="card-footer">
<?php if(!empty($_SESSION['username'])):?>
<a href="<?php echo site_url('Posts/add'); ?> " class="btn btn-danger btn-bi btn-lg"> Új kérdés hozzáadása</a>
<?php endif;?>

<?php if(empty($_SESSION['username'])):?>
    <a href="<?php echo site_url('Users/register'); ?>" class="btn btn-warning btn-bi bi-person-plus btn-lg"> Regisztráció</a>
<?php endif;?>
<a href="<?php echo site_url('Users/listAllUser'); ?>" class="btn btn-primary btn-bi bi-people btn-lg"> Az összes felhasználó</a>

<?php if(!empty($_SESSION['auth'])):?>
<?php if($_SESSION['auth'] == 1):?>
    <a href="<?php echo site_url('Posts/exportCSV'); ?> "class="btn btn-success btn-bi bi-arrow-bar-down btn-lg"> Kérdések importálása Excelbe</a>
<?php endif;?>
<?php endif;?>
   
<?php if(empty($_SESSION['username'])) :?>
<a href="<?php echo site_url('Users/login'); ?>" class="btn btn-success btn-bi bi-house-door-fill btn-lg"> Bejelentkezés</a>
<?php endif;?>
<?php if(!empty($_SESSION['username'])) :?>
<a href="<?php echo site_url('Users/selfProfile'); ?>" class="btn btn-info btn-bi bi-person-circle btn-lg"> Saját profilom</a>
<?php endif;?>
<?php if(!empty($_SESSION['username'])):?>
<a href="<?php echo site_url('Users/logout'); ?>" class="btn btn-dark btn-bi bi-arrow-bar-right btn-lg"> Kijelentkezés</a>
<?php endif;?>
<a href="<?php echo site_url('Posts/search'); ?>" class="btn btn-optional btn-bi bi-search btn-lg">Quora keresése</a>
</div>

    
    
    
    <br>
    

        <?php foreach($Quoras as &$p): ?>
  
            <div id="QHome" class="card-footer">
            <img src="<?=base_url('public/Ppictures/'.$p->profilepic)?>" width="50" height="50" class="PPimg"/>
            <h2><?=$p->post_owner?></h2>
            <h3><?=$p->post_title?></h3>
            <?=$p->post_desc?>
            <br>
            <?php if($p->post_pic != null):?>
            <img src="<?=base_url('public/Qpictures/'.$p->post_pic)?>" width="800" height="500" class="QPimg"/>
            <?php endif;?>
            <br>
            <?=$p->post_added?>
            <br>
            <div class="card-footer">
               <a href='<?= base_url("Posts/getReply/".$p->post_id); ?>' class="btn btn-optional btn-bi bi-chat"></a>
            <?php if(!empty($_SESSION['username'])):?>        
            <a href='<?= base_url("Posts/addReply/".$p->post_id); ?>' class="btn btn-primary btn-bi bi-reply"></a>
             <?php endif;?>
            <?php if(!empty($_SESSION['username'])):?>
            <?php if($_SESSION['username'] == $p->post_owner):?>
            <a href='<?= base_url("Posts/getQuoraForModify/".$p->post_id); ?>' class="btn btn-warning btn-bi bi-pen-fill"></a>
            <?php endif;?>
            <?php endif;?>
            <?php if(!empty($_SESSION['username']) && $_SESSION['auth'] == 1):?>
            <a href='<?= base_url("Posts/deleteQuora/".$p->post_id); ?>' class="btn btn-danger btn-bi bi-trash"></a>
            <?php endif;?>
             <?php if(!empty($_SESSION['username']) && $_SESSION['auth'] !=1 && $_SESSION['username'] == $p->post_owner):?>        
            <a href='<?= base_url("Posts/deleteQuora/".$p->post_id); ?>' class="btn btn-danger btn-bi bi-trash"></a>
             <?php endif;?>

            </div>
             
            
            
             
             
            
           
            
            </div>
<br>
        <?php endforeach;?>
       
   

</body>


