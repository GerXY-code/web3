<head>
 
     <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css' rel='stylesheet'
          integrity='sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6' crossorigin='anonymous'>
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css'>   
</head>
<body> 
  
<?php echo form_open();?>
       
            <?php 
       
        echo form_input(
              /*data p*/['type'=>'text','name' => 'quora_search', 'required' => 'required'],  
              /*value p*/ set_value('qoura_name','',false),
              /*extra p*/ ['placeholder' => 'Keresni kívánt Quora']  
            );
    ?>
        </div>
    <br/>
   
     <?php // submit típusú gomb, amivel az adatok beküldöm
        echo form_button(
              /*data p*/['type' => 'submit', 'name' => 'quora_search_submit', 'class' => 'btn btn-bi bi-search btn-lg'],
              /*cont p*/ set_value('save','Quora keresése')
            );
    ?>

  
   
<?php echo form_close();?>
    
    
</body>