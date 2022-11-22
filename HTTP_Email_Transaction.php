<?php
if (isset($_POST["emailAddress"])) {
    $email = $_POST["emailAddress"];

    $lowerCaseEmail = filter_var(strtolower($email), FILTER_SANITIZE_EMAIL);

    require_once('./vendor/autoload.php');

    $mailchimp = new MailchimpMarketing\ApiClient();

    $mailchimp->setConfig([
        'apiKey' => 'api-prefix',
        'server' => 'prefix'
    ]);

    $list_id = "33d6b3a4d2";

    try {
        $response = $mailchimp->lists->addListMember($list_id, [
            "email_address" => $lowerCaseEmail,
            "status" => "subscribed",
            // "merge_fields" => [
            //   "FNAME" => "Prudence",
            //   "LNAME" => "McVankab"
            // ]

        ]);
        // print_r($response);
    } catch (MailchimpMarketing\ApiException $e) {
        echo $e->getMessage();
    }
}

?>