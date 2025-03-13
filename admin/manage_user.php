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

<!-- Add User Button -->
<div class="flex justify-between items-center mb-4">
    <button id="openModalBtn"
        class="px-4 py-2 bg-green-500 text-white font-semibold rounded-md shadow-md hover:bg-green-600 transition">
        + Add User
    </button>
</div>

<!-- Modal Background -->
<div id="addUserModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 hidden flex justify-center items-center">
    <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
        <h2 class="text-lg font-semibold mb-4">Add New User</h2>
        
        <!-- Form for Adding User -->
        <form id="addUserForm">
            <div class="mb-3">
                <label class="block text-sm font-medium text-gray-700">Fullname</label>
                <input type="text" id="fullname" name="fullname" class="w-full p-2 border rounded-md" required>
            </div>
            <div class="mb-3">
                <label class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" id="email" name="email" class="w-full p-2 border rounded-md" required>
            </div>
            <div class="mb-3">
                <label class="block text-sm font-medium text-gray-700">password</label>
                <input type="password" id="password" name="password" class="w-full p-2 border rounded-md" required>
            </div>
            <div class="mb-3">
                <label class="block text-sm font-medium text-gray-700">User Type</label>
                <select id="userType" class="w-full p-2 border rounded-md" required>
                    <option value="admin">Admin</option>
                    <option value="super admin">Super admin</option>
                </select>
            </div>
            <div class="flex justify-end space-x-2">
                <button type="button" id="closeModalBtn" class="px-4 py-2 bg-gray-400 text-white rounded-md">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md">Save</button>
            </div>
        </form>
    </div>
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

<!-- jQuery for Modal Functionality -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Show modal
        $("#openModalBtn").click(function() {
            $("#addUserModal").removeClass("hidden");
        });

        // Close modal
        $("#closeModalBtn").click(function() {
            $("#addUserModal").addClass("hidden");
        });

        // Close modal when clicking outside the modal content
        $("#addUserModal").click(function(event) {
            if ($(event.target).is("#addUserModal")) {
                $("#addUserModal").addClass("hidden");
            }
        });

        // Submit form (for now, just console log the data)
        $("#addUserForm").submit(function(event) {
            event.preventDefault(); // Prevent actual form submission
            let fullname = $("#fullname").val();
            let email = $("#email").val();
            let userType = $("#userType").val();
            
            console.log("New User:", fullname, email, userType);
            
            // Here you can use AJAX to send the data to your backend PHP script
            // Example:
            // $.post("backend/end-points/add_user.php", { fullname, email, userType }, function(response) {
            //     alert("User added successfully!");
            //     location.reload(); // Refresh table after adding user
            // });

            $("#addUserModal").addClass("hidden"); // Close modal after submission
        });
    });
</script>
