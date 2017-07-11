<?php



/*Email Parser Class*/
class Email_parser {
	// imap server connection
	public $conn;
	// inbox storage and inbox message count
	private $inbox;
	private $msg_cnt;
	// email login credentials
	private $server = 'imap.us.exg7.exghost.com:993/imap/ssl';
	private $user   = 'homeadvisor@cdwindows.com';
	private $pass   = '55homeadv66!';
	#private $port   = 143; // adjust according to server settings
	private $from_email = "nilesh.r.dave@gmail.com";
	// connect to the server and get the inbox emails
	function __construct() {
		$this->connect();
		$this->inbox();
	}
	// close the server connection
	function close() {
		$this->inbox = array();
		$this->msg_cnt = 0;
		imap_close($this->conn);
	}
	// open the server connection
	// the imap_open function parameters will need to be changed for the particular server
	// these are laid out to connect to a Dreamhost IMAP server
	function connect() {
		#$this->conn = imap_open('{imap.gmail.com:993/imap/ssl}', $this->user, $this->pass);
		$this->conn = imap_open('{'.$this->server.'}', $this->user, $this->pass);
	}
	// move the message to a new folder
	function move($msg_index, $folder='INBOX.Processed') {
		// move on server
		imap_mail_move($this->conn, $msg_index, $folder);
		imap_expunge($this->conn);
		// re-read the inbox
		$this->inbox();
	}
	// get a specific message (1 = first email, 2 = second email, etc.)
	function get($msg_index=NULL) {
		
		if (count($this->inbox) <= 0) {
			return array();
		}
		elseif ( ! is_null($msg_index) && isset($this->inbox[$msg_index])) {
			
			return $this->inbox[$msg_index];
		}
		
		
		echo "<pre>"; print_r($this->inbox[2]);exit;	
		return $this->inbox[0];
	}
	// read the inbox
	function inbox() {
		
		
		$mailboxes = imap_list($this->conn, '{'.$this->server.'}', 'INBOX');
		echo "<pre>";print_r($mailboxes);
		
		$this->msg_cnt = imap_num_msg($this->conn);
		$inx = imap_num_msg($this->conn);
		$in = array();
		echo $fromaddress = $in[0]['header']->from[0]->mailbox . "@" . $in[0]['header']->from[0]->host; exit;
		for($i = 1; $i <= 2; $i++) {
			$in[] = array(
				'index'     => $inx,
				'header'    => imap_headerinfo($this->conn, $inx),
				'body'      => imap_body($this->conn, $inx),
				'structure' => imap_fetchstructure($this->conn, $inx)
			);
	
			
		
			#echo "fa:-".$in[$inx]->header->senderaddress;exit;
			$inx--;
			
		}
		$this->inbox = $in;
	}
	// get INBOX message count
	function getTotalCount()	{
		return $this->msg_cnt;
	}
	/*Send SMTP email*/
	function smtpmailer($to, $from, $from_name, $subject, $body) { 
	define('GMLUSER', 'devsttl2012@gmail.com'); // GMail username
	define('GMLPWD', 'saturdayon'); // GMail password
	global $error;
	$mail = new PHPMailer();  // create a new object
	$mail->IsSMTP(); //PHPMailer enable SMTP
	$mail->SMTPDebug = 0;  // debugging: 1 = errors and messages, 2 = messages only
	$mail->SMTPAuth = true;  // authentication enabled
	$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
	$mail->Host = 'smtp.gmail.com';
	$mail->Port = 465; 
	$mail->Username = GMLUSER;  
	$mail->Password = GMLPWD;           
	$mail->SetFrom($from, $from_name);
	$mail->Subject = $subject;
	$mail->Body = $body;
	$mail->AddAddress($to);
	if(!$mail->Send()) {
		$error = 'Mail error: '.$mail->ErrorInfo; 
		return false;
	} else {
		$error = 'Message sent!';
		return true;
	}
	
}
	
}
$emlClnt  = new Email_parser;
$msgs = $emlClnt->get($emlClnt->getTotalCount());

/**
Compose the email Address
*/
#$emlClnt->smtpmailer('e.nileshdave@gmail.com', 'devsttl2012@gmail.com', 'Nilesh Dave', 'New Lead', 'Hello World!');
#print_r($msgs);
?>
