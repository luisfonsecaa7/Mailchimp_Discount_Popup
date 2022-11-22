<?php
/**
* Plugin Name: Hero's Journey Interactive - Discount Popup
* Description: Enables a valid discount code advertisement on select pages, and integrates with the MailChimp API for extended functionality.
* Version: 1.0
* Author: Luis Fonseca
*/

function generate_email_capture_popup(){

    // JavaScript
    $script = "<script defer>
                const popupElement = document.querySelector(\".emailCapturePopup\");
                const popupExitElement = document.querySelector(\".emailCaptureExit\");
                const formElement = document.querySelector(\".emailCapturePopup__form\");
                const discountCodeElement = document.querySelector(\"#discountCode\");
                const popupTextElement = document.querySelector(\".emailCapturePopup__text\");

                if (!document.cookie.includes(\"submittedEmailOnPopup\")){
                    popupElement.onload = showPopup();
                }

                function showPopup(){
                    setTimeout(() => {
                        popupElement.style.display='flex';
                    }, 3000);;
                };

                function displayCode(e){
                    const emailAddressValue = document.querySelector(\"#emailAddress\").value;

                    discountCodeElement.innerText = \"HEROIC33\";
                    discountCodeElement.style.display=\"block\";
                    formElement.style.display=\"none\";
                    popupTextElement.innerText = \"Your code has been sent to \" + emailAddressValue + \"\";

                    const now = new Date();
                    now.setDate(now.getDate() + 365);

                    document.cookie = \"submittedEmailOnPopup=1; expires=\" + now.toUTCString() + \";\";
                };

                formElement.addEventListener(\"submit\", (e) => {
                    e.preventDefault();
                    displayCode(e);

                    let formData = new FormData(e.target);

                    console.log(formData.get('emailAddress'))

                    let fetchData = {
                        method: 'POST',
                        body: formData
                    };

                    sendToHTTPEmailTransaction(fetchData);
                });

                async function sendToHTTPEmailTransaction(data){
                    await fetch(\"" . plugins_url('/HJI_Discount_Popup/HTTP_Email_Transaction.php') . "\", data);
                };

                popupExitElement.addEventListener(\"click\", (event) => {
                    popupElement.style.opacity='0';
                    setTimeout(() => {
                        popupElement.style.display='none';
                    }, 2100)
                });
                </script>";

    // CSS
    $cssStyleHome = "<style>
                :root {
                    --siteBlue: #4DA9D0;
                    --siteWhite: white;
                    --siteGrey: #696969; 

                    --spaceSmall: 5px;
                    --spaceStandard: 10px;
                    --spaceLarge: 20px;
                }

                .emailCapturePopup {
                    z-index: 999;
                    display: none;
                    flex-direction: column;
                    justify-content: center;
                    align-items: center;
                    position: fixed;
                    bottom: 10vw;
                    // left: 0;
                    right: 10vw;
                    width: 250px;

                    // margin: 0 auto;
                    padding: var(--spaceStandard) var(--spaceLarge);

                    background: white;
                    border: solid 2px var(--siteBlue);
                    font-family: \"Poppins\", Sans-serif;
                    
                    transition: opacity 2s;
                }

                .emailCaptureExit {
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    width: 10px;
                    height: 10px;
                    background-color: var(--siteBlue);
                    border: solid 2px var(--siteBlue);
                    margin-right: auto;
                    padding: var(--spaceSmall);
                    border-radius: 5px;
                    font-size: small;
                    color: var(--siteWhite);
                    user-select: none;
                    opacity: 1;
                }

                @media screen and (max-width: 900px){
                    .emailCapturePopup {
                        bottom: 50px;
                        left: 0;
                        right: 0;
                        margin: 0 auto;
                    }

                    .emailCaptureExit {
                        margin-right: unset;
                        margin-left: auto;
                    }
                }

                .emailCaptureExit:hover {
                    background-color: var(--siteBlue);
                    opacity: 0.75;
                }

                .emailCaptureExit:active {
                    background-color: var(--siteWhite);
                    color: var(--siteBlue);
                    opacity: 1;
                }
                
                .emailCapturePopup__title {
                    all: unset;
                    font-size: x-large;
                    text-align: center;
                    margin-bottom: var(--spaceSmall);
                }
                
                .emailCapturePopup__text {
                    all: unset;
                    font-size: large;
                    text-align: center;
                    margin-bottom: var(--spaceSmall);
                }
                
                .emailCapturePopup__form {
                    all: unset;
                    width: 100%;
                    display: grid;
                    grid-gap: 20px;
                    justify-content: center;
                    align-items: center;
                }
                
                .emailCapturePopup__form > input:nth-child(1) {
                    all: unset;
                    width: 75%;
                    margin: 0 auto;
                    border-bottom: solid grey 1.5px;
                    text-align: center;
                }
                
                .emailCapturePopup__form > input:nth-child(2) {
                    all: unset;

                    padding: var(--spaceStandard) var(--spaceSmall);

                    background-color: var(--siteBlue);
                    color: var(--siteWhite);
                    text-align: center;
                    text-transform: uppercase !important;
                    font-weight: bold !important;
                    letter-spacing: 1.4px;
                    font-size: 18px;
                    border-radius: 5px !important;
                }

                .emailCapturePopup__form > input:nth-child(2):hover {
                    background-color: var(--siteBlue);
                    opacity: 0.75;
                }

                .emailCapturePopup__form > input:nth-child(2):active {
                    background-color: var(--siteWhite);
                    color: var(--siteBlue);
                    opacity: 1;
                    outline: solid 2px var(--siteBlue);
                }

                .utility-hide {
                    display: none;
                }

                .utility-bold {
                    font-weight: bold;
                }

                </style>";

    $cssStyle = "<style>
                :root {
                    --siteBlue: #4DA9D0;
                    --siteWhite: white;
                    --siteGrey: #696969; 

                    --spaceSmall: 5px;
                    --spaceStandard: 10px;
                    --spaceLarge: 20px;
                }

                .emailCapturePopup {
                    z-index: 1000;
                    display: none;
                    flex-direction: column;
                    justify-content: center;
                    align-items: center;
                    position: fixed;
                    top: 50px;
                    left: 0;
                    right: 0;
                    width: 250px;

                    margin: 0 auto;
                    padding: var(--spaceStandard) var(--spaceLarge);

                    background: white;
                    border: solid 2px var(--siteBlue);
                    font-family: \"Poppins\", Sans-serif;
                    
                    transition: opacity 2s;
                }

                .emailCaptureExit {
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    width: 10px;
                    height: 10px;
                    background-color: var(--siteBlue);
                    border: solid 2px var(--siteBlue);
                    margin-left: auto;
                    padding: var(--spaceSmall);
                    border-radius: 5px;
                    font-size: small;
                    color: var(--siteWhite);
                    user-select: none;
                    opacity: 1;
                }

                @media screen and (max-width: 900px){
                    .emailCapturePopup {
                        top: unset;
                        bottom: 50px;
                        left: 0;
                        right: 0;
                        margin: 0 auto;
                    }

                    .emailCaptureExit {
                        margin-right: unset;
                        margin-left: auto;
                    }
                }

                .emailCaptureExit:hover {
                    background-color: var(--siteBlue);
                    opacity: 0.75;
                }

                .emailCaptureExit:active {
                    background-color: var(--siteWhite);
                    color: var(--siteBlue);
                    opacity: 1;
                }
                
                .emailCapturePopup__title {
                    all: unset;
                    font-size: x-large;
                    text-align: center;
                    margin-bottom: var(--spaceSmall);
                }
                
                .emailCapturePopup__text {
                    all: unset;
                    font-size: large;
                    text-align: center;
                    margin-bottom: var(--spaceSmall);
                }
                
                .emailCapturePopup__form {
                    all: unset;
                    width: 100%;
                    display: grid;
                    grid-gap: 20px;
                    justify-content: center;
                    align-items: center;
                }
                
                .emailCapturePopup__form > input:nth-child(1) {
                    all: unset;
                    width: 75%;
                    margin: 0 auto;
                    border-bottom: solid grey 1.5px;
                    text-align: center;
                }
                
                .emailCapturePopup__form > input:nth-child(2) {
                    all: unset;

                    padding: var(--spaceStandard) var(--spaceSmall);

                    background-color: var(--siteBlue);
                    color: var(--siteWhite);
                    text-align: center;
                    text-transform: uppercase !important;
                    font-weight: bold !important;
                    letter-spacing: 1.4px;
                    font-size: 18px;
                    border-radius: 5px !important;
                }

                .emailCapturePopup__form > input:nth-child(2):hover {
                    background-color: var(--siteBlue);
                    opacity: 0.75;
                }

                .emailCapturePopup__form > input:nth-child(2):active {
                    background-color: var(--siteWhite);
                    color: var(--siteBlue);
                    opacity: 1;
                    outline: solid 2px var(--siteBlue);
                }

                .utility-hide {
                    display: none;
                }

                .utility-bold {
                    font-weight: bold;
                }

                </style>";
        
    // HTML
    $popUpTitle = "Join the community and save!";
    $popUpText = "Enter your email below to get 33% off.";
    $popUpActionText = "Get Code";

    $HTMLString =   "<section class=\"emailCapturePopup\">
                        <div class=\"emailCaptureExit\">X</div>
                        <h5 class=\"emailCapturePopup__title\">" . $popUpTitle ."</h5>
                        <p class=\"emailCapturePopup__text\">" . $popUpText . "</p>
                        <form class=\"emailCapturePopup__form\">
                            <input method='POST' required id=\"emailAddress\" type=\"email\" name=\"emailAddress\" placeholder=\"Enter your email\">
                            <input type=\"submit\" value=\"" . $popUpActionText . "\">
                        </form>
                        <p id=\"discountCode\" class=\"emailCapturePopup__text utility-hide utility-bold\">" . "" . "</p>
                    </section>";
    
    // Combined output
    if ($_SERVER["REQUEST_URI"] == "/"){
        echo $HTMLString . $cssStyleHome . $script;
    } else {
        echo $HTMLString . $cssStyle . $script;
    }
}

function page_check() {

    $URI = $_SERVER["REQUEST_URI"];

    $acceptedPages = array("/sign-up/", "/");

    for ($i = 0; $i < count($acceptedPages); $i++){
        if ($URI == $acceptedPages[$i]){
            generate_email_capture_popup();
            break;
        }
    }

}

add_action('wp_footer', 'page_check');

?>