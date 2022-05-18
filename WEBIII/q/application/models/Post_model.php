<?php


class Post_model extends CI_Model{
    public function __construct() {
           parent::__construct();
           
           $this->load->database();
    }
    
    
    public function get_all_post(){
        
        $this->db->select("post_id, post_title, post_desc, post_owner, post_added,post_pic,profilepic,auth,username"); 
        $this->db->from('posts'); 
        $this->db->join('users','users.username = posts.post_owner');
        $this->db->join('user_info','user_info.user_id = users.user_id');
       
        
        $records = $this->db->get()->result();
        return $records;
        
        
        
    }
  
    
    
    public function get_posts_for_csv(){
        // $response = array();
           
        // Select record
        $this->db->select('*');
        $q = $this->db->get('posts');
        $response = $q->result_array();
        
        return $response;
    }
    
    
    public function insert($name,$description,$qpicture){
        $record = [
            'post_id' => uniqid('', true),
            'post_owner' => $_SESSION['username'],
            'post_title' => $name,
            'post_desc' => $description,
            'post_pic' => $qpicture
        ];
        
        if ($name!="" && $name!=null && $description!=null && $description!="") {
             $this->db->insert('posts', $record);
             
        }
        if($this->db->affected_rows()>0){
            return 1;
        }
        else{
            return null;
        }
        
        
    }
    public function insertReply($reply_text,$quora_id,$loggedUser){
        
       // $quora_id = $this->uri->segment(3);
     
        $record = [
          'reply_id' => uniqid('',true),
          'quora_id' => $quora_id,
          'reply_owner' => $loggedUser,
          'reply_text' => $reply_text,
         
            
        ];
         if ($reply_text!="" && $reply_text!=null) {
             $this->db->insert('replies', $record);
             redirect('Posts/index');
        }
    }
    
    public function writePostToCSV(){
       $result = $this->get_all_post();
  
       
       
    }
    public function get_quora_replies($quora_id){
        // $quora_id = $this->uri->segment(3);
       /*
        $this->db->select("reply_text,reply_id,reply_owner,reply_added,profilepic"); 
        $this->db->from('replies');
        $this->db->join('posts','posts.post_id = replies.quora_id');
        $this->db->join('users','users.username = posts.post_owner');
        $this->db->join('user_info','user_info.user_id = users.user_id');
        $this->db->where("quora_id = '$quora_id'");
        */
         $this->db->select("reply_text,reply_id,reply_owner,reply_added,profilepic"); 
        $this->db->from('replies');
        $this->db->join('users','users.username = replies.reply_owner');
        $this->db->join('user_info','user_info.user_id = users.user_id');
        $this->db->where("quora_id = '$quora_id'");
         
        
        $replies = $this->db->get()->result();
        return $replies;
    }
    
    public function delete_qoura($quora_id){
        //$quora_id = $this->uri->segment(3);
        $this->db->where('post_id',$quora_id);
        $this->db->delete('posts');
        $this->db->join('replies','replies.reply.reply_id = posts.post_id');
       
    }
    public function delete_replies($quora_id){
         //$quora_id = $this->uri->segment(3);
         $this->db->where('quora_id',$quora_id);
         $this->db->delete('replies');
    }
    public function delete_reply($reply_id){
        $this->db->where('reply_id',$reply_id);
        $this->db->delete('replies');
    }
   public function get_quora_for_modify($quora_id){
       $this->db->select('post_title,post_desc,post_pic');
       $this->db->from('posts');
       $this->db->where("post_id = '$quora_id'");
       
       $records = $this->db->get()->result();
       return $records;
   }    
   public function modify_quora($newtitle,$newdesc,$quora_id,$newqpic){
       
       //Ha a newqpic változóm üres, akkor a kép módosítása nélkül fogom beszúrni az adatokat
       if($newqpic == null){      
        $quora = array(
        'post_title' => $newtitle,
        'post_desc' => $newdesc,
        
    );
       }else{
           $quora = array(
        'post_title' => $newtitle,
        'post_desc' => $newdesc,
        'post_pic' => $newqpic
    );
       }
       
       
       
      

       $this->db->where('post_id', $quora_id);
       $this->db->update('posts', $quora);
       
       redirect('Posts/index');

   }
   
public function get_qoura_owner($quora_id,$loggedUser){
       
       $query  = $this->db->query("SELECT post_owner FROM posts WHERE post_owner = '$loggedUser' AND post_id = '$quora_id'");
       foreach($query->result() as $row){
           $tmpOwner = $row->post_owner;
       }
       
       
       return $tmpOwner;
        
}
public function get_qoura_reply_owner($quora_reply_id,$loggedUser){
       
       $query  = $this->db->query("SELECT reply_owner FROM replies WHERE reply_owner = '$loggedUser' AND quora_id = '$quora_reply_id'");
       foreach($query->result() as $row){
           $tmpOwner = $row->post_owner;
       }
       
       
       return $tmpOwner;
        
}

public function get_quoras_from_search($post_name){
    $this->db->select('*');
    $this->db->from('posts');
    $this->db->join('users','users.username = posts.post_owner');
    $this->db->join('user_info','user_info.user_id = users.user_id');
    $this->db->where("posts.post_title LIKE '%$post_name%'");
    
    $records = $this->db->get()->result();
    return $records;
}
   
   
   
   
    

}
