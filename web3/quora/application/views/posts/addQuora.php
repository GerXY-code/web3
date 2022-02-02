<head>
    <link rel="stylesheet" href="../public/quoramanager.css">
</head>
<body> 
     
       
        <a href="<?php echo site_url('Posts/index')?>">Vissza a főoldalra</a>
        <br>
    <h1 class="msg">Kérdés hozzáadása</h1>
    <div class="wrapper">
        <br>
        <br>
        <br>
        <div class="inputClass">
        
<?php echo form_open_multipart();?>
    <?php 
       
        echo form_input(
              /*data p*/['type' => 'text', 'name' => 'quora_name', 'required' => 'required', 'class' => 'quoraInput'],  
              /*value p*/ set_value('qoura_name','',false),
              /*extra p*/ ['placeholder' => 'Kérdésed']  
            );
    ?>
        </div>
            <br/>
    <?php 
       
        echo form_textarea(
                ['name' => 'quora_desc', 'required' => 'required', 'class' => 'quoraTextarea'],
                set_value('qoura_desc',''),
                ['placeholder' => 'Kérdés részletes leírása']
        );
    ?>
    
       <br>
       <div style="margin-top:5%; margin-left:30%;">
         <label class="button">Kép feltöltése
             <?php echo form_upload(['name' => 'qpicture']); ?>
        </label>
       </div>
       </br>
    <div class="wrappersubmit">
    <?php // submit típusú gomb, amivel az adatok beküldöm
        echo form_button(
              /*data p*/['type' => 'submit', 'name' => 'btn_submit', 'class' => 'button'],
              /*cont p*/ set_value('save','Kérdés közzététele')
            );
    ?>
        
         
          
<?php echo form_close();?>
   
</body>