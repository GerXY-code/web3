<head>
     
     <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css' rel='stylesheet'
          integrity='sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6' crossorigin='anonymous'>
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css'>
    <style>
        #wrapper{
            font-family:cursive;
            font-weight:bold;
            text-align:center;
        }
        #answer{
            padding:5%;
        }
        img{
            border-radius: 50%;
        }
    </style>
</head>

<body>
    <a href="<?php echo site_url('Posts/index'); ?>" class="btn btn-lg btn-info">Vissza a főoldalra</a>
    
<?php if($replies == null || empty($replies)):?>
<p>Sanjnos még nem érkezett egyetlen válasz sem erre a kérdésre</p>
<?php else: ?>
<?php foreach($replies as &$r):?>
       
            <div class="card-footer" id="wrapper">
                <img src="<?=base_url('public/Ppictures/'.$r->profilepic)?>" width="100" height="100" /><br>
                <span><?=$r->reply_owner?></span><br>
                <div class="col-15" id="answer"> 
                <span><?=$r->reply_text?></span><br>
                </div>
                <span><?=$r->reply_added?></span>
                <br> 
             <?php if(!empty($_SESSION['username']) && $_SESSION['auth'] == 1):?>
            <a href='<?= base_url("Posts/deleteQuoraReply/".$r->reply_id); ?>' class="btn btn-danger btn-bi bi-trash" style="background-color:red"></a>
            <?php endif;?>
             <?php if(!empty($_SESSION['username']) && $_SESSION['auth'] !=1 && $_SESSION['username'] == $r->reply_owner):?>        
            <a href='<?= base_url("Posts/deleteQuoraReply/".$r->reply_id); ?>' class="btn btn-danger btn-bi bi-trash"></a>
            
             <?php endif;?>
                
</div>
        <?php endforeach;?>
   
<?php endif; ?>

</body>
