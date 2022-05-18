<head>
    <style>
        body{
    background-color:lightblue;
}
.inputClass{
    font-size: 30px;
    opacity: 0.8;
    border-radius:50px;
    
}
.quoraInput{
    font-size: 30px;
    opacity: 0.8;
    border-radius:50px;
}
.quoraTextarea{
    font-size: 20px;
    opacity: 0.8;
    border-radius:10px;
}
.wrapper{
    position: absolute;
  left: 50%;
  top: 50%;
  -webkit-transform: translate(-50%, -50%);
  transform: translate(-50%, -50%);
  
}

.button{
  position: relative;
  background-color: black;
  border-radius: 4em;
  font-size: 16px;
  color: white;
  padding: 0.8em 1.8em;
  cursor:pointer;
  text-align: center;
  text-decoration: none;
  cursor: pointer;
  transition-duration: 0.4s;
  -webkit-transition-duration: 0.4s; /* Safari */
}

.button:hover {
  transition-duration: 0.1s;
  background-color: #3A3A3A;
}

.button:after {
  content: "";
  display: block;
  position: absolute;
  border-radius: 4em;
  left: 0;
  top:0;
  width: 100%;
  height: 100%;
  opacity: 0;
  transition: all 0.5s;
  box-shadow: 0 0 10px 40px white;
}

.button:active:after {
  box-shadow: 0 0 0 0 white;
  position: absolute;
  border-radius: 4em;
  left: 0;
  top:0;
  opacity: 1;
  transition: 0s;
}

.button:active {
  top: 1px;
}
.wrappersubmit{
    padding-top:5%;
    padding-left: 30%;
}
.msg{
    font-style: italic;
    font-weight: bold;
    font-size: 50px;
    text-align: center;
}
input[type="file"] {
    display: none;
}
#fileUpload{
    color:red;
}
a{
  text-decoration: none;
  color:white;  
  border:10px solid blue;
  font-size:25px;
  background-color:blue;
  border-radius:50%;
}
img{
    width:50px;
    height:50px;
}
    </style>
</head>
<body> 
    <h1>Q módosítása</h1>
    <div class="wrapper">
        <div class="inputClass">
<?php echo form_open_multipart();?>
            <?php foreach($quora as $q):?>
    <?php 
       
        echo form_input(
              /*data p*/['type' => 'text', 'name' => 'quora_newname', 'value' => $q->post_title, 'required' => 'required', 'class' => 'quoraInput'],  
              /*value p*/ set_value('qoura_name','',false),
              /*extra p*/ ['placeholder' => 'Kérdésed']  
            );
    ?>
        </div>
            <br>
    <?php 
       
        echo form_textarea(
                ['name' => 'quora_newdesc', 'value' => $q->post_desc, 'required' => 'required', 'class' => 'quoraTextarea'],
                set_value('qoura_desc',''),
                ['placeholder' => 'Kérdés részletes leírása']
        );
    ?>
    </br>
    <div class="wrappersubmit">
    <?php // submit típusú gomb, amivel az adatok beküldöm
        echo form_button(
              /*data p*/['type' => 'submit', 'name' => 'btn_edit', 'class' => 'button'],
              /*cont p*/ set_value('save','Kérdés módosítása')
            );
    ?>
        <div>
            <br>
         <label>A kérdéshez kapcsolódó kép módosítása
            
             <?php if($q->post_pic!=null):?>
            <img src="<?=base_url('public/Qpictures/'.$q->post_pic)?>"/>
            <?php endif;?>
            <br>
           <?php echo form_upload(['name' => 'newqpicture']); ?>
        </label>
            <br>
   <?php endforeach;?>
<?php echo form_close();?>
    
        </div>
        <br>
        <a href="<?php echo site_url('Posts/index')?>">Vissza a főoldalra</a>
</body>
