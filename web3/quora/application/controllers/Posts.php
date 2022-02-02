<?php


class Posts extends CI_Controller {
   public function __construct() {
         parent::__construct();
         
         
         $this->load->model('Post_model','p_model');
         //$this->load->database();
         
   }
   
   //Ez publikus lesz a nem regisztrált felhasználók számára is
   public function index(){
       $posts = $this->p_model->get_all_post();
       $view_params = [
            'posts'   =>  $posts
       ];

        $this->load->view('posts/postlist',$view_params);
       
       
   }
   public function deleteQ(){
	     
           $q_id = $this->uri->segment(3);
           $loggedUser = $_SESSION['username'];
	   $owner = $this->p_model->get_q_owner($q_id,$loggedUser);
	   
           
           
	   if(!empty($_SESSION['username'])){
               if($_SESSION['auth'] == 1 || $_SESSION['username'] == $owner){
                      
                      $this->p_model->delete_qoura($quora_id);
                      $this->p_model->delete_replies($quora_id);
       
                      redirect('Posts/index');
               }else{
                    redirect('Posts/getErrorMsg');
               }
            
               
           }else{
                  redirect('Posts/getErrorMsg');
           }
 
   }
   
   

   
   
   public function deleteQuoraReply(){
       
        $reply_id = $this->uri->segment(3);
        $loggedUser = $_SESSION['username'];
        $reply_owner = $this->p_model->get_qoura_reply_owner($reply_id,$loggedUser);
       
       if(!empty($_SESSION['username'])){
           if($_SESSION['auth'] == 1 ||  $_SESSION['username'] = $reply_owner){
               $this->p_model->delete_reply($reply_id);
               redirect('Posts/index');
           }else{
                redirect('Posts/getErrorMsg');
           }
       }else{
           redirect('Posts/getErrorMsg');
       }
       
       
       
      
       
      
       
       
       
       
       
   }
   
   

   
   
   public function getQuoraForModify(){
       $quora_id = $this->uri->segment(3);
       
      $quora = $this->p_model->get_quora_for_modify($quora_id);
      
      $view_params = [
          'quora' => $quora
      ];
      
      $this->load->view('posts/editQuora',$view_params);
      
      if(isset($_POST['btn_edit'])){
          $this->modifyQuora($quora_id);
      }
      
       
   }
   
   
   
   
   
   
public function modifyQuora($quora_id){
    
        $loggedUser = $_SESSION['username'];
        //$quora_id = $this->uri->segment(3); --Paraméterben ugyan ezt kapom meg
        
        $owner = $this->p_model->get_qoura_owner($quora_id,$loggedUser);
    
        if(!empty($_SESSION['username'])){
            if($_SESSION['username'] == $owner){
                  
               $newqpicture = null;
                //$this->load->view('posts/addQuora');
                $config['upload_path']          = './public/Qpictures/';
               $config['allowed_types']        = 'gif|jpg|png';
            
                 // betöltöm a fájl feltöltéséhez szükséges komponenst 
                 $this->load->library('upload',$config);
            
                  // do_upload: igaz/hamis ... sikerült a feltöltés vagy nem?
            if($this->upload->do_upload('newqpicture') == TRUE){
                //redirect('fajlfeltoltes');
                //$view_params['uploaded_data'] = $this->upload->data();
               $newqpicture = $this->upload->data()["file_name"];
            }
            $this->p_model->modify_quora(
                    $this->input->post('quora_newname'),
                    $this->input->post('quora_newdesc'),
                    $quora_id,
                    $newqpicture
            );
            
          }else{
              redirect('Posts/getErrorMsg');
          }
      }else{
             redirect('Posts/getErrorMsg');

      }
    
    
     
            
          
            
}
  















   public function getReply(){
        $quora_id = $this->uri->segment(3);
       $replies = $this->p_model->get_quora_replies($quora_id);
        
        $view_params = [
            'replies' => $replies
        ];
        
        $this->load->view('posts/replies',$view_params);
        
       
   }
   
   
   public function add(){
      
       if(!empty($_SESSION['username'])){
       $this->load->library('form_validation'); //Ezt megtehetnénk az autoload.php fileban is

       $this->form_validation->set_rules(
                'quora_name',
                'Quora title',
                'required|max_length[1000]'
        );
       
       $qpicture = "";
       $config['upload_path']          = './public/Qpictures/';
       $config['allowed_types']        = 'gif|jpg|png';
            
            // betöltöm a fájl feltöltéséhez szükséges komponenst 
            $this->load->library('upload',$config);
            // do_upload: igaz/hamis ... sikerült a feltöltés vagy nem?
            if($this->upload->do_upload('qpicture') == TRUE){
                //redirect('fajlfeltoltes');
                //$view_params['uploaded_data'] = $this->upload->data();
               $qpicture = $this->upload->data()["file_name"];
            }     
            
                    if($this->form_validation->run() == TRUE){
                        $row =   $this->p_model->insert(
                        $this->input->post('quora_name'),
                        $this->input->post('quora_desc'),
                        $qpicture
                               
            );
            if($row!=null){
                redirect('Posts/index');
            }else{
                //Hiba betöltése
            }

       }
       $this->load->view('posts/addQuora');

       }
       else{
           redirect('Posts/getErrorMsg');
       }
   }
public function exportCSV(){
    //$this->p_model->writePostToCSV();
   
    if(!empty($_SESSION['username']) && $_SESSION['auth'] == 1){
        $filename = 'users_'.date('Ymd').'.csv';
                header('Content-Encoding: UTF-8');
                header('Content-type: text/csv; charset=UTF-8');
		header("Content-Description: File Transfer");
		header("Content-Disposition: attachment; filename=$filename");
		header("Content-Type: application/csv; ");
                echo "\xEF\xBB\xBF";

		// get data
		$Quoras = $this->p_model->get_posts_for_csv();

		// file creation
		$file = fopen('php://output', 'w');

		$header = array("Kérdés azonosítója","Kérdező","Kérdés","Kérdés leírása","Kérdés hozzáadva ekkor");
		fputcsv($file, $header);

		foreach ($Quoras as $key=>$line){
		 fputcsv($file,$line);
        
                }
            fclose($file);
        exit;
     
    }else{
        redirect('Posts/getErrorMsg'); //ZÁROJELES MEGJEGYZÉS AZ, HOGY AZ ERROR 404-ES HIBAOLDALT HASNZÁLOM FEL DE CÉLSZERŰ SAJÁTOT LÉTREHOZNI
    }
   
   
  }
  public function addReply(){
      
      if(!empty($_SESSION['username'])){
      $post_id = $this->uri->segment(3);
      $params = [
          'post_id' => $post_id
      ];
      
      $this->load->view('posts/addReply',$params);
            

      
      $this->p_model->insertReply(
                        $this->input->post('reply_text'),
                        $post_id,
                        $_SESSION['username'],
                        
                        
         );
      }else{
          
          redirect('Posts/getErrorMsg');
      
    
      }
        
      
     
  }
  public function getErrorMsg(){
      
      
      
      $this->load->view('errors/cli/error_404');
  }
  
  
  
public function search(){
   
    $this->load->view('posts/search');
    
    $Quoras = $this->p_model->get_quoras_from_search(
            $this->input->post('quora_search'),
    );
    $view_params = [
        'Quoras' => $Quoras
    ];
    
   
         $this->load->view('posts/searchedQuoras',$view_params);
    
   
    
    
    
    
}
  
  
  

   
   
}
