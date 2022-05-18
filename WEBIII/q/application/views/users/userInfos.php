<head>
    <link rel="stylesheet" href="../public/userauth.css">
</head>
<body>
    <h1 class="msg">Nemsokára elkészülünk...</h1>
    <?php echo form_open_multipart();?>
    <div class="wrapper">
        <div class="registerInput">
            <?php 
       
        echo form_input(
              /*data p*/['type' => 'text', 'name' => 'firstname', 'required' => 'required','class'=>'registerInput'],  
              /*value p*/ set_value('firstname','',false),
              /*extra p*/ ['placeholder' => 'Keresztneved']  
            );
    ?>
        </div>
        <br/>
        <div class="registerInput">
            <?php 
       
        echo form_input(
                ['type' => 'text', 'name' => 'surename', 'required' => 'required','class'=>'registerInput'],
                set_value('',''),
                ['placeholder' => 'Vezetékneved']
        );
        ?>
        </div>
    
    <br/>
    <div class="wrappersubmit">
        
        <label class="button">Profilkép
        <?php echo form_upload(['name' => 'ppicture']); ?>
        </label>
    </div>
    </br>
    <div class="wrappersubmit">
          <?php // submit típusú gomb, amivel az adatok beküldöm
        echo form_button(
              /*data p*/['type' => 'submit', 'name' => 'btn_submit' ,'class' => 'button'],
              /*cont p*/ set_value('save','Regisztráció')
            );
    ?>
    </div>
  
    </br>
 

<?php echo form_close();?>



    </div>
</body>    