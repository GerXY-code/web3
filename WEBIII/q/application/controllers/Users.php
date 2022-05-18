<?php


class Users extends CI_Controller{
   public function __construct() {
        parent::__construct();
        
        $this->load->model('User_model','u_model');
        
        //$this->load->database();
       // $this->load->library('session');
        
   }
public function login(){
    $this->load->view('users/login');
if(isset($_POST['login'])){
        $username = $this->input->post('username');  
        $password = $this->input->post('password');  
        
        
        $query = $this->u_model->logging_in_user($username,$password);
       
        
        
        if ($query>0)   
        {  
       
            $auth = $this->u_model->getAuth($username);
            
            //declaring session  
            $this->session->set_userdata(array('username'=>$username, 'auth' => $auth));  
            redirect('Posts/index');  
        }  
        else{  
             
            redirect('users/login');
        }  
}
       
    }  
    public function logout()  
    
    {  
        //removing session  
       
        $username = $_SESSION['username']; 
        $auth = $_SESSION['auth'];
        
        $userdatas = array('username' => $username, 'auth' => $auth);
        $this->session->unset_userdata($userdatas);
        //$this->session->unset_userdata('username','auth');  
        $this->session->sess_destroy();
        redirect("Posts/index");  
    }  
 
   
   public function register(){
       

      
        
       
       $this->load->view('users/regform');
     
                
                       
                         $this->u_model->insert(
                        $this->input->post('username'),
                        $this->input->post('password'),
                        $this->input->post('email')
                      );
                        
                        
                  
   
   }
   public function addUserInformations(){
       $this->load->view('users/userinfos');
       $config['upload_path']          = './public/Ppictures/';
       $config['allowed_types']        = 'gif|jpg|png';
            
            // betöltöm a fájl feltöltéséhez szükséges komponenst 
            $this->load->library('upload',$config);
            $ppicture = 'default.jpg'; 
            // do_upload: igaz/hamis ... sikerült a feltöltés vagy nem?
            if($this->upload->do_upload('ppicture') == TRUE){
                //redirect('fajlfeltoltes');
                //$view_params['uploaded_data'] = $this->upload->data();
         $ppicture = $this->upload->data()["file_name"];
         
                
                
            }
            $this->u_model->insert2(
                        $this->input->post('firstname'),
                        $this->input->post('surename'),
                        $ppicture
                        );
       
       
       
   }
   
  
   
public function listAllUser(){
    
    $users = $this->u_model->get_all_users();
       $view_params = [
            'users'   =>  $users
       ];

      
    
    $this->load->view('Users/listUsers',$view_params);
}
public function selfProfile(){
    
    $loggedUser = $_SESSION['username'];
    
    if(!empty($_SESSION['username'])){
         $user = $this->u_model->get_self_profile($loggedUser);
         $view_params = [
        'user' => $user
    ];
    
    $this->load->view('users/selfProfile',$view_params);
    }else{
        redirect('Posts/getErrorMsg');
    }
   
}
public function deleteProfile(){
    
    $user_id = $this->uri->segment(3);
    
    $loggedUser = $_SESSION['username'];
    
    
    if(!empty($_SESSION['username'])){
        if($_SESSION['auth'] == 1 || $_SESSION['username'] = $loggedUser){
            $this->u_model->delete_profile($user_id);
            $this->u_model->delete_profile_infos($user_id);
            
            redirect('Users/listAllUser');
        }
        else{
            redirect('Posts/getErrorMsg');
        }
    }else{
        redirect('Posts/getErrorMsg');
    }
    
    
    
}

public function getProfileForModify(){
      $user_id = $this->uri->segment(3);
       
      $profile = $this->u_model->get_profile_for_modify($user_id);
      
      $view_params = [
          'profile' => $profile
      ];
      
      $this->load->view('users/editProfile',$view_params);
      
      if(isset($_POST['btn_edit_profile'])){
          $this->modifyProfile($user_id);
      }
      
}



public function modifyProfile($user_id){
    
  
    $loggedUser = $this->u_model->get_logged_user($user_id);
    $params = [
        'username' => $loggedUser
    ];
    $actualUser = '';
    foreach($loggedUser as $l){
        $actualUser = $l->username;
    }
    
    
    if(!empty($_SESSION['username'])){
        if($_SESSION['username'] == $actualUser){
             $currentUser = $_SESSION['username'];
              $newppicture = null;
                //$this->load->view('posts/addQuora');
                $config['upload_path']          = './public/Ppictures/';
               $config['allowed_types']        = 'gif|jpg|png';
            
                 // betöltöm a fájl feltöltéséhez szükséges komponenst 
                 $this->load->library('upload',$config);
            
                  // do_upload: igaz/hamis ... sikerült a feltöltés vagy nem?
            if($this->upload->do_upload('newppicture') == TRUE){
                //redirect('fajlfeltoltes');
                //$view_params['uploaded_data'] = $this->upload->data();
               $newppicture = $this->upload->data()["file_name"];
            }
            $this->u_model->modify_profile(
                    $this->input->post('user_newusername'),
                    $this->input->post('new_email'),
                    $this->input->post('user_newfirstname'),
                    $this->input->post('user_newsurename'),
                    $user_id,
                    $newppicture,
                    $currentUser
            );
            
            
            
            redirect('Users/logout'); //Ahhoz hogy minden funkció megfelelően múködjünk ismét
                                      //Ki kell hogy jelentkeztessem a usert miután módosította az adatait!
        }else{
            
            redirect('Posts/getErrorMsg');
        }
       
    }else{
          redirect('Posts/getErrorMsg');
    }
  
    
    
}

   
   
   
   
}
