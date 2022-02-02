<?php


class User_model extends CI_Model {
   public function __construct() {
        parent::__construct();
        
        $this->load->database();
   }
  
   
public function get_all_users(){
        
    
        $this->db->select("users.user_id, username, firstname, surename, profilepic, auth"); 
        $this->db->from('users');
        $this->db->join('user_info', 'user_info.user_id = users.user_id'); 
       
        
        $records = $this->db->get()->result();
        return $records;
}
public function get_self_profile($user){
    //$user = $_SESSION['username'];
    
    
    $this->db->select('*');
    $this->db->from('users');
    $this->db->join('user_info','user_info.user_id = users.user_id');
    $this->db->where("users.username = '$user'");
    
    $record = $this->db->get()->result();
    return $record;
    
}


   
   public function insert($username,$password,$email){
       
       
       $record = [
           'user_id' => uniqid('', true),
           'username' => $username,
           'password' => password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]),
           'email' => $email,
           'auth' => 0
       ];
       
        if ($username!="" && $username!=null && $password!=null && $password!="" && $email != "" && $email != null) {
             $this->db->insert('users', $record);
             redirect('Users/addUserInformations');
        }
   }
   
   public function insert2($firstname,$surename,$ppicture){
       
       //Lekérdezem a most beszúrt uniqid-t és azt adom oda 
       //ennek az insert-nek
       
       /*$this->db->select('user_id');
       $this->db->from('users');
       $this->db->order_by('joined','asc');
       $this->db->limit(1);
            */
       $query  = $this->db->query("SELECT user_id from users ORDER BY joined DESC LIMIT 1");
       foreach($query->result() as $row){
           $tmpID = $row->user_id;
       }
       
       $record = [
           'user_id' => $tmpID,
           'firstname' => $firstname,
           'surename' => $surename,
           'profilepic' => $ppicture
       ];
         if ($firstname!="" && $firstname!=null && $surename!=null && $surename!="") {
             $this->db->insert('user_info', $record);
             redirect('Posts/index');
        }
       
   }
   
   public function logging_in_user($username,$password){
       $query = $this->db->query("SELECT * from users where username = '$username'");

       $row = $query->row();


    if (password_verify($password,$row->password)) {
        return $row;
    } 
   else{
       return 0;
   }
   }
  public function getAuth($username){
        $queryAuth = $this->db->query("SELECT auth FROM users WHERE username='$username'");

        $row = $queryAuth->row();

        $auth = $row->auth;
        
        return $auth;
 }
 
 public function delete_profile($user_id){
        $this->db->where('user_id',$user_id);
        $this->db->delete('users');
 }
 public function delete_profile_infos($user_id){
        $this->db->where('user_id',$user_id);
        $this->db->delete('user_info');
 }

   
 public function get_profile_for_modify($user_id){
        
       $this->db->select('username,email,firstname,surename,profilepic');
       $this->db->from('users');
       $this->db->join('user_info','user_info.user_id = users.user_id');
       $this->db->where("users.user_id = '$user_id'");
       
       $records = $this->db->get()->result();
       return $records;
   
 }
  public function modify_profile($newusername,$newemail,$newfirstname,$newsurename,$user_id,$newppicture,$oldusername){
       
       //Ha a newppicture változóm üres, akkor a kép módosítása nélkül fogom beszúrni az adatokat
       
        $UserProfile = array(
        'username' => $newusername,
        'email' => $newemail,
        
            
        
         );
       
        if($newppicture == null){
             $UserInfos = array(
               'firstname' => $newfirstname,
               'surename' => $newsurename,
               //'profilepic' => $newppicture Ha null az új picture mezőm akkor nyilván marad a régi kép
                
        );
             
             
        }else{
            $UserInfos = array(
               'firstname' => $newfirstname,
               'surename' => $newsurename,
               'profilepic' => $newppicture //Ha nem null akkor természetesen beszúrom az újat
                
        );
        }
         $newOwnerForQuora = array(
         'post_owner' => $newusername,
        
         );
         $newOwnerForReply = array(
         'reply_owner' => $newusername,
        
         );
       
       
       $this->db->where('user_id',$user_id);
       $this->db->update('users',$UserProfile);
       
       $this->db->where('user_id',$user_id);
       $this->db->update('user_info',$UserInfos);

       
        
        //Végül de legutolsó sorban frissítenem kell természetesen a post_owner mezőt is az újonnan kiadott
        //username-re hiszen másképpen nem fogunk rekordokat találni
       
       $this->db->where('post_owner',$oldusername);
       $this->db->update('posts',$newOwnerForQuora);
       
      //Illetve a válasz tulajdonosát szintén módosítanom kell!!
       $this->db->where('reply_owner',$oldusername);
       $this->db->update('replies',$newOwnerForReply);
       

   }
   
   public function get_logged_user($user_id){
       $this->db->select('username');
       $this->db->from('users');
       $this->db->where("users.user_id = '$user_id'");
       
       $record = $this->db->get()->result();
       return $record;
   }
   

   
}
