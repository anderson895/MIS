<?php 
include "components/header.php";
?>
<div class="flex justify-between items-center bg-white p-4 mb-6 rounded-md shadow-md">
    <h2 class="text-lg font-semibold text-gray-700">Dashboard</h2>
    <a href="profile.php" class="flex items-center space-x-3 cursor-pointer hover:bg-gray-100 p-2 rounded-lg">
        <?php
        $userImage = !empty($account[0]['profile_picture']) ? $account[0]['profile_picture'] : null;
        ?>
        <div class="w-10 h-10 rounded-full overflow-hidden flex items-center justify-center bg-gray-200 text-gray-600">
            <?php if ($userImage): ?>
                <img src="../assets/upload_files/<?php echo $userImage; ?>" alt="User Avatar" class="w-full h-full object-cover">
            <?php else: ?>
                <span class="material-icons text-3xl">account_circle</span>
            <?php endif; ?>
        </div>
        <span class="text-gray-700 font-medium">
            <?php echo ucfirst($account[0]['name']); ?>
        </span>
    </a>

</div>

<?php 
include "components/footer.php";
?>
