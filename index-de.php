<?php 	
		require_once "Mail.php";

        $from = "info@afateam.ch";
        $to = "j.lognoul@afateam.ch";
        $subject = "Frohes Weihnachtsfest";
		$message_html  = '
<html xmlns:o="urn:schemas-microsoft-com:office:office"
            xmlns:w="urn:schemas-microsoft-com:office:word"
            xmlns="http://www.w3.org/TR/REC-html40">

            <head>
            <meta http-equiv="Content-Type" content="text/html; charset="utf-8" />
            <meta name=ProgId content=Word.Document>
            <meta name=Generator content="Microsoft Word 11">
            <meta name=Originator content="Microsoft Word 11">
            <link rel=File-List href="signature_fichiers/filelist.xml">
            <title>Jody Lognoul</title>
            <style>
            p{
                margin: 0;
                padding: 0;
                font-family:Calibri;
            }
            p#name {
                font-size:11pt;    
                color:#999999;
                mso-ansi-language:FR-CH;
            }
            p#titre{
                font-size:9pt;
                font-style: italic;
                color:#999999;
                mso-ansi-language:FR-CH;
            }
            p#separation {
                font-family: Verdana;
                font-size:6pt;
                color:red;
                font-weight: bold;
                mso-ansi-language:FR-CH;
                margin-bottom:12px;
            }
            p#organisation_name{
                font-family: Verdana;
                font-size: 10.0pt;    
                font-weight: bold;
                color: red;
                mso-ansi-language: FR-CH;
            }
            p#address_name{
                font-size: 10.9pt;
                color:#999999;
                mso-ansi-language:FR-CH;
                margin-bottom: 15px;
            }
            p#tel{
                font-size:10.0pt;
                color:#999999;
            }
            a#website{
                font-family: Verdana;
                font-size: 9.0pt;    
                font-weight: bold;
                color: red;
                mso-ansi-language: FR-CH;
                font-style: italic;
                text-decoration: none;
                border-bottom:1px solid blue;     
            }
            p#website_p{
                margin-bottom: 15px;
            }
            p#footer1{
                font-size: 10.0pt;
                font-weight: bold;
                color: black;
                margin-bottom: 15px;    
            }
            p#footer2{
            }
            </style>
            </head>
            <body>
            <p>
                Sehr geehrter Geschäftspartner,<br /><br />
                                        
                Der ganzen afateam wünscht Ihnen und Ihrer Familie ein <a href="http://www.afateam.ch/afa/templates/documents/noel/de/NOELR.htm">frohes Weihnachtsfest</a> und einen guten Start ins neue Jahr 2012.<br /><br />
                Wir freuen uns über das in uns gesetzte Vertrauen und bedanken uns herzlich für die angenehme und vertrauensvolle Zusammenarbeit. <br />
                Auch im Jahr 2012 werden wir Sie wieder gerne bei allen geschäftlichen Anliegen als starker Partner unterstützen. <br /><br />
                                        
                Wir freuen uns gemeinsam mit Ihnen auf ein erfolgreiches Jahr!<br /><br />
                                                             
                Freundliche Weinachtsgrüsse    <br /><br />
            </p>
            <p id="name">Ihr afateam</p>
            <p id="separation">_______________________________________________</p>
            <p id="organisation_name">afa organisation SA</p>
            <p id="address_name">CH - Biel - Neuchâtel - Genf</p>
            <p id="website_p"><a href="http://www.afateam.ch" id="website">www.afateam.ch</a></p>
            <p id="footer1">> Ihr Partner für alle Bedürfnisse am Arbeitsplatz</p>
            <p id="footer2" style="color:#999999;font-family: Tahoma;font-size: 7.5pt;"><span style="font-weight: bolder;"><span style="font-size:22pt;font-family:webdings;">P</span> Before printing</span> think about your responsibility & commitment with the <span style="font-weight: bolder;">Environment!</span></p>

            </body>

            </html>
			';

        $host = "ssl://smtp.gmail.com";
        $port = "465";
        $username = "info@afateam.ch";
        $password = "afateam";		

        $headers = array (
		  'From' => $from,
          'To' => $to,		  
		  'MIME-Version'=> '1.0\r\n',
		  'Content-Type' => 'text/html; charset="utf-8"\r\n',
          'Subject' => $subject);
        $smtp = Mail::factory('smtp',
          array ('host' => $host,
            'port' => $port,
            'auth' => true,
            'username' => $username,
            'password' => $password));

        

		 
		 
		$fichier = "emails.csv";
		$fic = fopen($fichier, 'rb');
		for ($ligne = fgetcsv($fic, 1024); !feof($fic); $ligne = fgetcsv($fic, 1024)) {
			$j = sizeof($ligne);
			for ($i = 0; $i < $j; $i++) {
				$mail = $smtp->send($ligne[$i], $headers, $message_html);				
				if (PEAR::isError($mail)) {
					echo("<p style=\"color: red\">" . $mail->getMessage() . "</p>");
				} else {
					echo("<p style=\"color: green\">Message successfully sent! $ligne[$i]</p>");
				}				
			}
		}
  ?>
