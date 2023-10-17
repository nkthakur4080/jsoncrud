<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member Data </title>
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

// Include and initialize JSON class 
require_once 'Json.class.php'; 
$db = new Json(); 
 
// Fetch the blog's data 
$blogs = $db->getRows(); 
 
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
        <div class="row align-items-center pb-5">
            <div class="col-md-6 head py-4">
                <h1>Members</h1>
            </div>
            <!-- Add link -->
            <div class="col-md-6 text-right py-4">
                <a href="addEdit.php" class="btn btn-success"><i class="plus"></i>Add New Member</a>
            </div>
            
            <!-- List the users -->
            <table class="table table-striped table-bordered w-100">
                <thead class="thead-dark">
                    <tr>
                        <th style="width:50px;">S. No.</th>
                        <th style="width:150px;">Image Name</th>
                        <th style="width:150px;">Member Name</th>
                        <th style="width:150px;">linkedin Url</th>
                        <th style="width:150px;">Member Profile</th>
                        <th style="width:400px;">Member Detail</th>
                        <th style="width:100px;" colspan="2">Member Photo</th>
                        <th style="width:50px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($blogs)){ $count = 0; foreach($blogs as $row){ $count++; ?>
                    <tr>
                        <td><?php echo $count; ?></td>
                        <td><?php echo $row['image_url']; ?></td>
                        <td><?php echo $row['mem_name']; ?></td>
                        <td><?php echo $row['link_url']; ?></td>
                        <td><?php echo $row['profile']; ?></td>
                        <td><?php echo $row['mem_des']; ?></td>
                        <?php 
                        
                        $image_url = $row['image_url'];
                        $img_urls = explode(',',$image_url);
                        foreach($img_urls as $key=>$val){
                        ?>
                        <td class="data-col"><img src="../img/uploads/<?php echo $img_urls[$key]; ?>" class="mem-photo" width="50" height="70"/></td>
                        <?php } ?>
                        <td>
                            <a href="addEdit.php?id=<?php echo $row['id']; ?>" class="btn btn-warning">Edit</a>
                            <a href="userAction.php?action_type=delete&id=<?php echo $row['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure to delete?');">Delete</a>
                        </td>
                    </tr>
                    <?php } }else{ ?>
                    <tr><td colspan="6">No Member(s) found...</td></tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>