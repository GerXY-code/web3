<head>
    <link rel="stylesheet" href="../public/userauth.css">
</head>
<body>
    <h1 class="msg">Q fiók regisztrálása</h1>
    <?php echo form_open();?>
<div class="wrapper">
    <div class="registerInput">
    <?php 
   
        echo form_input(
              /*data p*/['type' => 'text', 'name' => 'username', 'required' => 'required', 'class' => 'registerInput'],  
              /*value p*/ set_value('username','',false),
              /*extra p*/ ['placeholder' => 'Felhasználói neved']  
            );
    ?>
    </div>
        <br/>
        <div class="registerInput">
    <?php 
       
        echo form_input(
                ['type' => 'password', 'name' => 'password', 'required' => 'required', 'class' => 'registerInput'],
                set_value('password',''),
                ['placeholder' => '*********']
        );
        ?>
        </div>
            </br>
        <div class="registerInput">
    <?php 
       
        echo form_input(
                ['type' => 'text', 'name' => 'email', 'required' => 'required', 'class' => 'registerInput'],
                set_value('email',''),
                ['placeholder' => 'email@címed']
        );
    ?>
        </div>
    
    </br>
    <div class="wrappersubmit">
    <?php
        echo form_button(
                         ['type' => 'submit', 'name' => 'btn_submit','class' => 'button'],
                         set_value('save','Regisztráció')
            );
    ?>
    </div>
<?php echo form_close();?>
</div>
     <br>
       <a href="<?php echo site_url('Posts/index')?>">Vissza a főoldalra</a>

</body>
