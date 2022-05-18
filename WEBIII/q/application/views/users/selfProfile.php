<head>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css' rel='stylesheet'
          integrity='sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6' crossorigin='anonymous'>
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css'>
    <link rel="stylesheet" href="../public/style.css">
    <style>
        #wrapper{
            font-weight:bold;
            font-size:20px;
            text-align:center;
       }
    </style>
</head>
<body>
    <a href="<?php echo site_url('Posts/index'); ?>" class="btn btn-lg btn-info">Vissza a főoldalra</a>
<?php if($user == null || empty($user)):?>
<p>Még nincs regisztrált felhasználó!</p>
<?php else: ?>
    <?php foreach($user as &$r):?>
        <div class="card-footer" id="wrapper">
            <div>
            <img src="<?=base_url('public/Ppictures/'.$r->profilepic)?>" class="PPimg"/>
            </div>
            <div>
            <span id="valami">Felhasználó név: <?=$r->username?></span>
            </div>
            <div>
            <span>Keresztnév: <?=$r->firstname?></span>
            </div>
            <div>
            <span>Vezetéknév: <?=$r->surename?></span>
            </div>
            
            
            <a href="<?php echo base_url('Users/getProfileForModify/'.$r->user_id)?>"class="btn btn-lg btn-primary bi-pen"></a>
            <a href='<?= base_url("Users/deleteProfile/".$r->user_id); ?>' class="btn btn-lg btn-danger bi-trash"></a>
        <?php endforeach;?>
       </div>
<?php endif; ?>