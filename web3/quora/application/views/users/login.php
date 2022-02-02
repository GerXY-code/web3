<head>
    <link rel="stylesheet" href="../public/userauth.css">
</head>
<body>
    <h1 class="msg">Bejelentkezés a Q fiókodba</h1>
<?php echo form_open();?>
   
    <div class="wrapper">
        <div class="loginInput">
        <?php 
       
        echo form_input(
              /*data p*/['type' => 'text', 'name' => 'username', 'required' => 'required', 'class'=>'loginInput'],  
              /*value p*/ set_value('username','',false),
              /*extra p*/ ['placeholder' => 'Felhasználói neved']  
            );
    ?>
        </div>
    <br/>
    <div class="loginInput">
    <?php 
       
        echo form_input(
                ['type' => 'password', 'name' => 'password', 'required' => 'required','class'=>'loginInput'],
                set_value('password',''),
                ['placeholder' => 'Jelszavad']
        );
        ?></br>
    </div>
    <div class="wrappersubmit">
    <?php // submit típusú gomb, amivel az adatok beküldöm
        echo form_button(
              /*data p*/['type' => 'submit', 'name' => 'login', 'class'=>'button'],
              /*cont p*/ set_value('save','Bejelentkezés')
            );
    ?>
    </div>

<?php echo form_close();?>
    </div>
       <br>
       <a href="<?php echo site_url('Posts/index')?>">Vissza a főoldalra</a>
</body>
    
