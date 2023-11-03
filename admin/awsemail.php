<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    var_dump($_POST);
    $newStatus = $_POST['orderStatus'];
    $orderId = $_POST['orderId'];

    // Now you can work with $newStatus and $orderId as needed.

    echo "$newStatus";
    echo "$orderId";
} else {
    // Handle the case when the form is not submitted via POST.
    // You may want to redirect or show an error message.
}
// If necessary, modify the path in the require statement below to refer to the 
// location of your Composer autoload.php file.

require '../vendor/autoload.php';

use Aws\Ses\SesClient;
use Aws\Exception\AwsException;

// Create an SesClient. Change the value of the region parameter if you're 
// using an AWS Region other than US West (Oregon). Change the value of the
// profile parameter if you want to use a profile in your credentials file
// other than the default.
$SesClient = new SesClient([
    'version' => '2010-12-01',
    'region'  => 'ap-southeast-1'
]);

// Replace sender@example.com with your "From" address.
// This address must be verified with Amazon SES.
$sender_email = 'clothes.io.sg@gmail.com';

// Replace these sample addresses with the addresses of your recipients. If
// your account is still in the sandbox, these addresses must be verified.
$recipient_emails = ['rhys.tan.2020@scis.smu.edu.sg'];

// see if can get from the php file
// $newStatus = 'packing';
$newStatus = $_POST['orderStatus'];
// $orderId = '2';
$orderId = $_POST['orderId'];

echo($newStatus);
echo($orderId);

$sql2 = "UPDATE `orders_info` SET `status` = '$newStatus' WHERE order_id = '$orderId'";
$run_query2 = mysqli_query($con,$sql2);
mysqli_close($con);
// Specify a configuration set. If you do not want to use a configuration
// set, comment the following variable, and the
// 'ConfigurationSetName' => $configuration_set argument below.
$configuration_set = 'ConfigSet';

$subject = 'Order status update';
$plaintext_body = 'This email was sent with Amazon SES using the AWS SDK for PHP.' ;
$html_body =  "Hello, the status for your order with order ID " . $orderId . " has been updated. <br> The new status is now " . $newStatus . "<br> Do reach out to us if you have any queries regarding your order, and we hope that you love your items. <br> <br> Best, <br> Clothes.io Team ";
$char_set = 'UTF-8';

try {
    $result = $SesClient->sendEmail([
        'Destination' => [
            'ToAddresses' => $recipient_emails,
        ],
        'ReplyToAddresses' => [$sender_email],
        'Source' => $sender_email,
        'Message' => [
          'Body' => [
              'Html' => [
                  'Charset' => $char_set,
                  'Data' => $html_body,
              ],
              'Text' => [
                  'Charset' => $char_set,
                  'Data' => $plaintext_body,
              ],
          ],
          'Subject' => [
              'Charset' => $char_set,
              'Data' => $subject,
          ],
        ],
        // If you aren't using a configuration set, comment or delete the
        // following line
        // 'ConfigurationSetName' => $configuration_set,
    ]);
    $messageId = $result['MessageId'];
    echo("Email sent! Message ID: $messageId"."\n");
    header('Location:salesofday.php');
} catch (AwsException $e) {
    // output error message if fails
    echo $e->getMessage();
    echo("The email was not sent. Error message: ".$e->getAwsErrorMessage()."\n");
    echo "\n";
}
