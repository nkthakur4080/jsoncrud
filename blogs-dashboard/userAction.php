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
    $blog_title = trim(strip_tags($_POST['blog_title'])); 
    $blog_url = trim(strip_tags($_POST['blog_url'])); 
    $category = trim(strip_tags($_POST['category']));
    $blog_description = trim(strip_tags($_POST['blog_description'])); 
    $publish_date = trim(strip_tags($_POST['publish_date']));
    $id_str = ''; 
    if(!empty($id)){ 
        $id_str = '?id='.$id; 
    } 
     
    // Fields validation 
    $errorMsg = ''; 
    if(empty($image_url)){ 
        $errorMsg .= '<p>Please enter your image full path form blog page.</p>'; 
    } 
    if(empty($blog_title)){ 
        $errorMsg .= '<p>Please enter a blog Title.</p>'; 
    } 
    if(empty($blog_url)){ 
        $errorMsg .= '<p>Please enter blog page url</p>'; 
    } 
    if(empty($category)){ 
        $errorMsg .= '<p>Please enter Category</p>'; 
    } 
    if(empty($blog_description)){ 
        $errorMsg .= '<p>Please enter blog small description.</p>'; 
    } 
    if(empty($publish_date)){ 
        $errorMsg .= '<p>Please enter blog publish date.</p>'; 
    }
     
    // Submitted form data 
    $userData = array( 
        'image_url' => $image_url, 
        'blog_title' => $blog_title, 
        'blog_url' => $blog_url, 
        'category' => $category,
        'blog_description' => $blog_description,
        'publish_date' => $publish_date 
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
                $sessData['status']['msg'] = 'Blog data has been updated successfully.'; 
                 
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
                $sessData['status']['msg'] = 'Blog data has been added successfully.'; 
                 
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
        $sessData['status']['msg'] = 'Blog data has been deleted successfully.'; 
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