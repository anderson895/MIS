<?php 

$fetch_all_user = $db->fetch_all_user();

if ($fetch_all_user): ?>
    <?php foreach ($fetch_all_user as $user):
        ?>
       <tr>
            <td class="p-2"><?php echo htmlspecialchars($user['name']); ?></td>
            <td class="p-2"><?php echo htmlspecialchars($user['email']); ?></td>
            <td class="p-2"><?php echo htmlspecialchars($user['type']); ?></td>
            <td class="p-2 flex space-x-2">
                <a href="update.php?id=<?php echo $user['id']; ?>" 
                class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600">
                Update
                </a>
                <a href="delete.php?id=<?php echo $user['id']; ?>" 
                class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600"
                onclick="return confirm('Are you sure you want to delete this user?');">
                Delete
                </a>
            </td>
        </tr>

    <?php endforeach; ?>
<?php else: ?>
    <tr>
        <td colspan="5" class="p-2">No record found.</td>
    </tr>
<?php endif; ?>