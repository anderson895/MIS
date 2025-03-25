<?php 
include "components/header.php";

$userImage = !empty($account[0]['profile_picture']) ? $account[0]['profile_picture'] : null;
?>

<div class="max-w-4xl mx-auto p-6 bg-white shadow-lg rounded-lg">
    <div class="flex items-center space-x-6">
        <!-- Profile Picture -->
        <div class="w-32 h-32 rounded-full border-4 border-gray-800 overflow-hidden flex items-center justify-center bg-gray-100">
            <?php if ($userImage): ?>
                <img src="../assets/upload_files/<?php echo $userImage; ?>" alt="User Avatar" class="w-full h-full object-cover">
            <?php else: ?>
                <span class="material-icons text-gray-500 text-6xl">account_circle</span>
            <?php endif; ?>
        </div>

        <!-- User Details -->
        <div>
            <h1 class="text-3xl font-bold text-gray-800"><?= ucfirst($account[0]['name']) ?></h1>
            <p class="text-sm text-gray-500 mt-1">@<?= $account[0]['username'] ?></p>

        </div>
    </div>

    <!-- Additional Information -->
    <div class="mt-6">
        <h2 class="text-xl font-semibold text-gray-700">Information</h2>
        <p class="text-sm text-gray-500 mt-2"><strong>Email:</strong> <?= $account[0]['email'] ?? 'Not provided' ?></p>
        <p class="text-sm text-gray-500"><strong>Phone:</strong> <?= $account[0]['phone'] ?? 'Not provided' ?></p>
    </div>
</div>

<?php include "components/footer.php"; ?>
