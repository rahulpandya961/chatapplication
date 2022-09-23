<?php 
	
class ChatRooms
{
	private $chat_id;
	private $user_id;
	private $message;
	private $image;
	private $created_on;
	protected $connect;

	public function setChatId($chat_id)
	{
		
		$this->chat_id = $chat_id;
	}

	function getChatId()
	{
		return $this->chat_id;
	}

	function setUserId($user_id)
	{
		$this->user_id = $user_id;
	}

	function getUserId()
	{
		return $this->user_id;
	}

	function setMessage($message)
	{
		$this->message = $message;
	}

	function getMessage()
	{
		return $this->message;
	}

	function setImage($image)
	{
		$this->image = $image;
	}

	function getImage()
	{
		return $this->image;
	}

	function setCreatedOn($created_on)
	{
		$this->created_on = $created_on;
	}

	function getCreatedOn()
	{
		return $this->created_on;
	}
	

	public function __construct()
	{
		require_once("Database_connection.php");

		$database_object = new Database_connection;

		$this->connect = $database_object->connect();

	}

	function save_chat()
	{
		
		$query = "
		INSERT INTO chatrooms 
			(userid, msg, image ,created_on) 
			VALUES (:userid, :msg, :image, :created_on)
		";

		$statement = $this->connect->prepare($query);

		$statement->bindParam(':userid', $this->user_id);

		$statement->bindParam(':msg', $this->message);
		
		$statement->bindParam(':image', $this->image);

		$statement->bindParam(':created_on', $this->created_on);

		$statement->execute();
	}

	function get_all_chat_data()
	{
		
		$query = "
		SELECT * FROM chatrooms 
			INNER JOIN chat_user_table 
			ON chat_user_table.user_id = chatrooms.userid 
			ORDER BY chatrooms.id ASC
		";

		$statement = $this->connect->prepare($query);

		$statement->execute();

		return $statement->fetchAll(PDO::FETCH_ASSOC);
	}
	// function upload_image_user($image)
	// {
	// 	$extension = explode('.', $image['name']);
	// 	$new_name = rand() . '.' . $extension[1];
	// 	$destinationImage = 'images/' . $new_name;
	// 	move_uploaded_file($image['tmp_name'], $destinationImage);
	// 	return $destinationImage;
	// }
}

	
?>