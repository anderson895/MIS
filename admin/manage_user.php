<?php 
include "components/header.php";

?>

<div class="flex justify-between items-center bg-white p-4 mb-6 rounded-md shadow-md">
    <h2 class="text-lg font-semibold text-gray-700">Manage User</h2>
    <div class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center text-lg font-bold text-white">
        <?php
        echo substr(ucfirst($_SESSION['name']), 0, 1);
        ?>
    </div>
</div>


<div class="flex justify-between items-center mb-4">
    <button onclick="window.location.href='add_user.php'"
        class="px-4 py-2 bg-blue-500 text-white font-semibold rounded-md shadow-md hover:bg-green-600 transition">
        + Add User
    </button>
</div>

<!-- Card for Table -->
<div class="bg-white rounded-lg shadow-lg p-6">

    <!-- Search Input -->
    <div class="mb-4">
        <input type="text" id="searchInput" class="p-2 border rounded-md" placeholder="Search user...">
    </div>

    <!-- Table Wrapper for Responsiveness -->
    <div class="overflow-x-auto">
        <table id="userTable" class="display table-auto w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="bg-gray-100 text-gray-700">
                <tr>
                   
                    <th class="p-2">Fullname</th>
                    <th class="p-2">Email</th>
                    <th class="p-2">User Type</th>
                    <th class="p-2">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php include "backend/end-points/user_list.php"; ?>
            </tbody>
        </table>
    </div>
</div>
<?php 
include "components/footer.php";
?>
