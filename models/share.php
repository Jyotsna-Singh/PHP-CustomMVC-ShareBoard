<?php
class ShareModel extends Model{
	public function Index(){
		$this->query('SELECT * FROM shares ORDER BY create_date DESC');
		$rows = $this->resultSet();
		
		// MODIFIED to update the results Array to display Name instead of User_ID
        foreach ($rows as &$row)
        {
            $row['user_id'] = $this->convertUserIDtoName($row['user_id']);
        }
        return $rows;
	}
	
	public function add(){
		//Sanitize POST array
		$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
		
		
			
		
		if($post['submit']){
			
			
			if($post['title'] == '' || $post['body'] == '' || $post['link'] == ''){
			Messages::setMsg('Please fill in all the fields', 'error');
				return;
			}
			
			//INSERT into Mysq
			$this->query('INSERT INTO shares (title, body, link, user_id) VALUES(:title, :body, :link, :user_id)');
			$this->bind(':title', $post['title']);
			$this->bind(':body', $post['body']);
			$this->bind(':link', $post['link']);
			$this->bind(':user_id', $_SESSION['user_data']['id'] );
			$this->execute();
			//Verify
			if($this->lastInsertId()){
				//Redirect
				header('Location: '.ROOT_URL.'shares');
			}

			return;
		}
	}
	// MODIFIED - Display poster's author
    public function convertUserIDtoName($userID)
    {
        $name = "";
        $this->query('SELECT name FROM users WHERE id = :user_id LIMIT 1');
        $this->bind(':user_id', $userID );
        $row = $this->single();
        if($row)
        {
            $name = $row['name'];
        }
        return $name;
    }
}