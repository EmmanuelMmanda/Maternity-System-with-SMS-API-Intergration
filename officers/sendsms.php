<!--API Configuration for Sending text messages-->
$api_key='0e202e87941163b0';
$secret_key = 'ODY5NTQyMjczM2E1NmYxYmM1NTdmNDE5MTg4YjJlZDk5N2I0ZmM0OWMzODI3MjUzZTg4OTZiOTkyYmQzMWIxOA==';

$postData = array(
    'source_addr' => 'INFO',
    'encoding'=>0,
    'schedule_time' => '',
    'message' => $message,
    'recipients' => [array('recipient_id' => '1','dest_addr'=> $phone)]
);

$Url ='https://apisms.beem.africa/v1/send';

$ch = curl_init($Url);
error_reporting(E_ALL);
ini_set('display_errors', 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt_array($ch, array(
    CURLOPT_POST => TRUE,
    CURLOPT_RETURNTRANSFER => TRUE,
    CURLOPT_HTTPHEADER => array(
        'Authorization:Basic ' . base64_encode("$api_key:$secret_key"),
        'Content-Type: application/json'
    ),
    CURLOPT_POSTFIELDS => json_encode($postData)
));

$response = curl_exec($ch);

if($response === FALSE){
        echo $response;

    die(curl_error($ch));
}
if($response == TRUE){
    echo "<script>
    alert('Message was sent Succesfully');
    window.location.href='notifications.php';
    </script>";
}else{
    echo "<script>
    alert('Failed to send Message !! Probably check your internet connection');
    window.location.href='notifications.php';
    </script>";
}
?>