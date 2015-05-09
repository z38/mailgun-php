<?php
require 'vendor/autoload.php';
use Mailgun\Mailgun;

# First, instantiate the SDK with your API credentials and define your domain. 
$mg = new Mailgun("key-60f24d250f600c393c688d8d2b26ffce");
$domain = "mg.jessespears.com";
#
# # Now, compose and send your message.
#$result = $mg->sendMessage($domain, array('from'    => 'jesse3@jessespears.com', 
#                                'to'      => 'jesse@mailgunhq.com', 
#                                'subject' => 'The PHP SDK is awesome!', 
#                                'text'    => 'It is so simple to send a message.'));
$filename = "./test.mime";
$mime_file = fopen($filename, 'r');
$mime = fread($mime_file, filesize($filename));
fclose($mime_file);
$result = $mg->sendMessage($domain,
                           array('from' => 'jesse@jessespears.com',
                                 'to'   => ['jesse@mailgunhq.com'],
                                 'text' => 'hi there bud, this is just a test.'),
                           ['attachment' => $filename]);

Print $result->http_response_code;
Print json_encode($result->http_response_body, JSON_PRETTY_PRINT);
?>
