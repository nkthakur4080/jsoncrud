<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADD Edit</title>
    <!-- Favicon -->
    <link href="../img/home-img/rmhcm-fav.png" rel="icon">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php 
// Start session 
session_start(); 
 
// Retrieve session data 
$sessData = !empty($_SESSION['sessData'])?$_SESSION['sessData']:''; 
 
// Get member data 
$memberData = $userData = array(); 
if(!empty($_GET['id'])){ 
    // Include and initialize JSON class 
    include 'Json.class.php'; 
    $db = new Json(); 
     
    // Fetch the member data 
    $memberData = $db->getSingle($_GET['id']); 
} 
$userData = !empty($sessData['userData'])?$sessData['userData']:$memberData; 
unset($_SESSION['sessData']['userData']); 
 
$actionLabel = !empty($_GET['id'])?'Edit':'Add'; 
 
// Get status message from session 
if(!empty($sessData['status']['msg'])){ 
    $statusMsg = $sessData['status']['msg']; 
    $statusMsgType = $sessData['status']['type']; 
    unset($_SESSION['sessData']['status']); 
} 
?>

<!-- Display status message -->
<?php if(!empty($statusMsg) && ($statusMsgType == 'success')){ ?>
<div class="col-xs-12">
    <div class="alert alert-success"><?php echo $statusMsg; ?></div>
</div>
<?php }elseif(!empty($statusMsg) && ($statusMsgType == 'error')){ ?>
<div class="col-xs-12">
    <div class="alert alert-danger"><?php echo $statusMsg; ?></div>
</div>
<?php } ?>

<div class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col-md-12 py-4 text-center">
                <h1><?php echo $actionLabel; ?> Member</h1>
            </div>
            <div class="col-md-12 pb-5">
                <form method="post" action="userAction.php" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Image Name</label>
                        <input type="text" class="form-control" name="image_url" placeholder="Enter blog's image url" value="<?php echo !empty($userData['image_url'])?$userData['image_url']:''; ?>" required="">
                    </div>
                    <div class="form-group">
                        <label>Member Name</label>
                        <input type="text" class="form-control" name="mem_name" placeholder="Enter Member Name" value="<?php echo !empty($userData['mem_name'])?$userData['mem_name']:''; ?>" required="">
                    </div>
                    <div class="form-group">
                        <label>Linkedin Url</label>
                        <input type="text" class="form-control" name="link_url" placeholder="Enter Linkedin url" value="<?php echo !empty($userData['link_url'])?$userData['link_url']:''; ?>" required="">
                    </div>
                    <div class="form-group">
                        <label>Profile</label>
                        <input type="text" class="form-control" name="profile" placeholder="Enter Profile" value="<?php echo !empty($userData['profile'])?$userData['profile']:''; ?>" required="">
                    </div>
                    <div class="form-group">
                        <label>Member Detail</label>
                        <input type="text" class="form-control" name="mem_des" placeholder="Enter Member Detail" value="<?php echo !empty($userData['mem_des'])?$userData['mem_des']:''; ?>" required="">
                    </div>
                    <div class="form-group">
                        <label>Upload Member Photo</label>
                        <input type="file" class="form-control" name="mem_img[]" multiple placeholder="Please Upload Member Image" value="<?php echo !empty($userData['mem_img'])?$userData['mem_img']:''; ?>" required="" multiple>
                    </div>
                    
                    <a href="index.php" class="btn btn-secondary">Back</a>
                    <input type="hidden" name="id" value="<?php echo !empty($memberData['id'])?$memberData['id']:''; ?>">
                    <input type="submit" name="userSubmit" class="btn btn-success" value="Submit">
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>