<?
# @Author: William Kroes <haj420>
# @Date:   Wednesday, January 16th 2019, 14:34:44 -05:00
# @Email:  wm@charwebs.com
# @Filename: functions.php
/*
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
*/
//added to gitignore??
include('fx/conn.php');
$base_url = 'http://autoformsandsupplies.com/haj420'; 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
//verify the form was submitted
if ($_POST['submit'] == 'Submit Order') {
$track_code = md5(rand());

  // Remove hidden $_POST variables that are used for tracking the form from the array
  unset($_POST['finalsubmit']);
  unset($_POST['submit']);
  unset($_POST['regexp']);
  unset($_POST['myselect']);

  // Start our message
  $message = '<!DOCTYPE html><html><head>
                        <style>
                        * {
                            font-size: 14px!important;
                            font-family: Arial;
                        }   
                        </style>
                        <!– [if gte mso 9]>
                        <style>
                        li {list-style-type:none;}
                        </style>
                        <![endif]–>

                    </head>
                <body>
                <p style="">Hello '.$_POST["buyerna"].',
    <br>
    <br> 
    Thank you for your order, we really appreciate your business.</p>
    <table style="width:100%;max-width:720px;margin:0px;">
        <tbody>
            <tr>
                <td style="text-align:left;vertical-align:top;width:60%;">
                    <h4 style="margin:0px;">Account Information</h4>
                        Name: '.$_POST['buyerna'] .'<br>
                        Company Name: '. $_POST['accountno'].'<br>
                        Address: '. $_POST['add'] .'<br>
                        City: '.$_POST['city'].'<br>
                        State: '.$_POST['state'].'<br>
                        Zip: '.$_POST['zip'].'<br>
                        PO: '.$_POST['customerpo'].'<br>
                        Phone: '.$_POST['phonenumber'].'<br>
                        Email: '.$_POST['emailadd'].'<br>
                    </ul>
                </td>
                <td style="text-align:left;vertical-align:top;width:40%;">
                    <h4 style="margin:0px;">Shipping Information</h4>
                        Preferred Shipping: '.$_POST['shipmethod'].'<br>				
    ';

                //  Find out if shipping to same address
                if($_POST['shipto'] == 'same') {
                    $message .= '
                        Company Name: '.$_POST['accountno'].'<br>
                        Attn: '.$_POST['buyerna'].'<br>
                        Address: '.$_POST['add'].'<br>
                        City: '.$_POST['city'].'<br>
                        State: '.$_POST['state'].'<br>
                        Zip: '.$_POST['zip'].'<br>
                    ';
                }else {
                    $message .= '
                        Company Name: '.$_POST['shipaccountno'].'<br>
                        Attn: '.$_POST['shipattn'].'<br>
                        Address: '.$_POST['shipadd'].'<br>
                        City: '.$_POST['shipcity'].'<br>
                        State: '.$_POST['shipstate'].'<br>
                        Zip: '.$_POST['shipzip'].'<br>
                    ';
                } 
    //  Continue message
    $message .= '
                </td>
            </tr>
        </tbody>
    </table>
    <table style="width:100%;max-width:720px;margin:0px;">
        <tbody>
            <tr>
                <td colspan="3">
		            <h4 style="text-align:center;margin:0px;">Requested Items</h4>
                </td>
            </tr>
            <tr>
                <td style="width:200px;">
                    <h4 style="margin:0px;">Item Number</h4>
                </td>
                <td style="width:400px;">
                    <h4 style="margin:0px;">Description</h4>
                </td>
                <td style="width:200px;">
                    <h4 style="margin:0px;">Quantity</h4>
                </td>
            </tr>
    ';
    // Extract $_POST values for each item added to cart
    $i = 0;
    foreach($_POST as $key => $value) {
        if(preg_match('@^itemnum@', $key)) {
        $message .= '
            <tr>
                <td>
                    <input required type="text" name="itemnum'.$i.'" id="itemnum'.$i.'" style="border:0px; -size:10pt; font-weight: normal" size="15" tabindex="19" maxlength="30" autocomplete="on" value="'. $value.'">
                </td>
        ';
        $items++;
        }

        if(preg_match('@^itemdes@', $key)) {
        $message .= '
                <td>
                    <input required type="text" name="itemdesc'.$i.'" id="itemdesc'.$i.'" style="border:0px; font-size:10pt; font-weight: normal;" size="56" tabindex="20" maxlength="250" autocomplete="on" value="'.$value.'">
                </td>
        ';
        }

        if(preg_match('@^itemquan@', $key)) {
        $message .= '
                <td>
                    <input required type="text" name="itemquan'.$i.'" id="itemquan'.$i.'" style="border:0px; font-size:10pt; font-weight: normal" size="7" tabindex="21" maxlength="10" autocomplete="on" value="'.$value.'">
                </td>
        ';
        }
        /*  Only for use when using with prices 
        if(preg_match('@^itemprice@', $key)) {
        $message .= '
                <td>
                    <input required type="text" name="itemprice'.$i.'" id="itemprice'.$i.'" style="font-size:10pt; font-weight: normal" size="7" tabindex="21" maxlength="10" autocomplete="on" value="'.$value.'">
                </td>
        ';
        }
        */
        $i++;
    }
    $message .= '
            </tr>
            <tr>
                <td colspan="3">
                    <h4 style="text-align:center;margin:0px;">Additional Comments</h4>
                    <p style="text=align:left;margin:0px;">'.$_POST['addcomments'].'</p>
                </td>
            </tr>
        </tbody>
    </table>
    ';
   $message .= '    <br>
                    <p style="margin:0px;">Please keep this for your records.
                    <br>
    ';
   $message .= '
                    Thank you,<br>McKeon Distributors<br>
                    <a href="tel:800-525-1861">800-525-1861</a><p>
                    <img 
                    </body>
                    </html>
    ';
    //Tracking Code
    $message .= '
    <img src="http://autoformsandsupplies.com/haj420/fx/email_track.php?code='.$track_code.'"/>';


    // Import PHPMailer classes into the global namespace
    require 'include/PHPMailer/src/Exception.php';
    require 'include/PHPMailer/src/PHPMailer.php';
    require 'include/PHPMailer/src/SMTP.php';

    $mail = new PHPMailer;
    $mail->isMail();
    $mail->SMTPDebug = 0; // 0 = off (for production use) - 1 = client messages - 2 = client and server messages
    $mail->Host = "localhost";
    $mail->Port = 587; 
    $mail->SMTPSecure = 'STARTTLS'; 
    $mail->SMTPAuth = true;
    $mail->Username = 'username';
    $mail->Password = 'password';
    $mail->setFrom('from@email.address', 'from');
    $mail->AddAddress('to@email.address');
    $mail->AddCC($_POST['emailadd']);
    $mail->Subject = 'Order Form Submission from '.$_POST['accountno'];
    $mail->msgHTML($message);
    // Send the email or display an error
    if($mail->send())
    {
        
            $email_subject        =  'Order Form Submission from '.$_POST["accountno"];
            $email_body           =  $message;
            $email_address        =  $_POST['emailadd'];
            $email_track_code     =  $track_code;
        
        $query =  "
        INSERT INTO email_data
        (email_subject, email_body, email_address, email_track_code) VALUES
        ('$email_subject', '$email_body', '$email_address', '$email_track_code')
        ";
        
        $stmt = $db->prepare($query);
        $stmt->execute();
    }
    else 
    {
        $error_message = '<label class="text-danger">Email Sent Successfully</label>';
    }

}
function fetch_email_track_data($db)
{
 $query = "SELECT * FROM email_data ORDER BY email_id DESC";
 $result = mysqli_query($db, $query);
     $total_row = mysqli_num_rows($result);
 
 $output = '
 <div class="table-responsive">
  <table class="table table-bordered table-striped">
   <tr>
    <th width="25%">Email</th>
    <th width="45%">Subject</th>
    <th width="10%">Status</th>
    <th width="20%">Open Datetime</th>
   </tr>
 ';
 if($total_row > 0)
 {
  foreach($result as $row)
  {
   $status = '';
   if($row['email_status'] == 'yes')
   {
    $status = '<span class="label label-success">Open</span>';
   }
   else
   {
    $status = '<span class="label label-danger">Not Open</span>';
   }
   $output .= '
    <tr>
     <td>'.$row["email_address"].'</td>
     <td>'.$row["email_subject"].'</td>
     <td>'.$status.'</td>
     <td>'.$row["email_open_datetime"].'</td>
    </tr>
   ';
  }
 }
 else
 {
  $output .= '
  <tr>
   <td colspan="4" align="center">No Email Send Data Found</td>
  </tr>
  ';
 }
 $output .= '</table>';
 return $output;
}
?>
