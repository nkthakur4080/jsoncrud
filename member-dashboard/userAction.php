<?php 
// Start session 
session_start(); 
 // Include and initialize DB class 
require_once 'Json.class.php'; 
$db = new Json(); 
 // Set default redirect url 
$redirectURL = 'index.php'; 
 if(isset($_POST['userSubmit'])){ 
    // Get form fields value 
    $id = $_POST['id']; 
    $image_url = trim(strip_tags($_POST['image_url'])); 
    $mem_name = trim(strip_tags($_POST['mem_name'])); 
    $link_url = trim(strip_tags($_POST['link_url'])); 
    $profile = trim(strip_tags($_POST['profile']));
    $mem_des = trim(strip_tags($_POST['mem_des'])); 
    //$publish_date = trim(strip_tags($_POST['publish_date']));
    $id_str = ''; 
    if(!empty($id)){ 
        $id_str = '?id='.$id; 
    } 
    // Fields validation 
    $errorMsg = ''; 
    if(empty($image_url)){ 
        $errorMsg .= '<p>Please enter your image name with .jpg or .png version only</p>'; 
    } 
    if(empty($mem_name)){ 
        $errorMsg .= '<p>Please enter a Member Name.</p>'; 
    } 
    if(empty($link_url)){ 
        $errorMsg .= '<p>Please enter Linkedin Profile Url</p>'; 
    } 
    if(empty($profile)){ 
        $errorMsg .= '<p>Please enter Designation of member</p>'; 
    } 
    if(empty($mem_des)){ 
        $errorMsg .= '<p>Please enter About member work experience</p>'; 
    } 
    // File upload directory 
    $targetDir = "../img/uploads/"; 
    $filenames = array_filter($_FILES['mem_img']['name']);
    if(!empty($filenames)){ 
        $img_urls = explode(',',$image_url);
        // Allow certain file formats 
        $allowTypes = array('jpg','png','jpeg');
        foreach($_FILES['mem_img']['name'] as $key=>$val){
            $targetFilePath = $targetDir . $img_urls[$key];
            // Check whether file type is valid 
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
            if(in_array($fileType, $allowTypes)){ 
                // Upload file to server 
                move_uploaded_file($_FILES["mem_img"]["tmp_name"][$key], $targetFilePath);
            }else{ 
                $errorMsg .= 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.'; 
            }
        }
        //$fileName = basename($_FILES["mem_img"]["name"]); 
        //$targetFilePath = $targetDir . $image_url; 
        //$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
    }
     
    // Submitted form data 
    $userData = array( 
        'image_url' => $image_url, 
        'mem_name' => $mem_name, 
        'link_url' => $link_url, 
        'profile' => $profile,
        'mem_des' => $mem_des,
        'fileName' => $img_urls 
    ); 
     
    // Store the submitted field value in the session 
    $sessData['userData'] = $userData; 
     
    // Submit the form data 
    if(empty($errorMsg)){ 
        if(!empty($_POST['id'])){ 
            // Update user data 
            $update = $db->update($userData, $_POST['id']); 
             
            if($update){ 
                $sessData['status']['type'] = 'success'; 
                $sessData['status']['msg'] = 'Member data has been updated successfully.'; 
                 
                // Remove submitted fields value from session 
                unset($sessData['userData']); 
            }else{ 
                $sessData['status']['type'] = 'error'; 
                $sessData['status']['msg'] = 'Some problem occurred, please try again.'; 
                 
                // Set redirect url 
                $redirectURL = 'addEdit.php'.$id_str; 
            } 
        }else{ 
            // Insert user data 
            $insert = $db->insert($userData); 
             
            if($insert){ 
                $sessData['status']['type'] = 'success'; 
                $sessData['status']['msg'] = 'Member data has been added successfully.'; 
                 
                // Remove submitted fields value from session 
                unset($sessData['userData']); 
            }else{ 
                $sessData['status']['type'] = 'error'; 
                $sessData['status']['msg'] = 'Some problem occurred, please try again.'; 
                 
                // Set redirect url 
                $redirectURL = 'addEdit.php'.$id_str; 
            } 
        } 
    }else{ 
        $sessData['status']['type'] = 'error'; 
        $sessData['status']['msg'] = '<p>Please fill all the mandatory fields.</p>'.$errorMsg; 
         
        // Set redirect url 
        $redirectURL = 'addEdit.php'.$id_str; 
    } 
     
    // Store status into the session 
    $_SESSION['sessData'] = $sessData; 
}elseif(($_REQUEST['action_type'] == 'delete') && !empty($_GET['id'])){ 
    // Delete data 
    $delete = $db->delete($_GET['id']); 
     
    if($delete){ 
        $sessData['status']['type'] = 'success'; 
        $sessData['status']['msg'] = 'Member data has been deleted successfully.'; 
    }else{ 
        $sessData['status']['type'] = 'error'; 
        $sessData['status']['msg'] = 'Some problem occurred, please try again.'; 
    } 
     
    // Store status into the session 
    $_SESSION['sessData'] = $sessData; 
} 
 
// Redirect to the respective page 
header("Location:".$redirectURL); 
exit(); 
?>