<?php include "header.php"; ?>

  <div class="w-full max-w-md bg-white rounded-xl shadow-lg p-6 sm:p-8 relative">
    
     <!-- Spinner -->
     <div class="spinner" id="spinner" style="display:none;">
                <div class="absolute inset-0 bg-white bg-opacity-75 flex items-center justify-center">
                    <div class="w-10 h-10 border-4 border-indigo-500 border-t-transparent rounded-full animate-spin"></div>
                </div>
            </div>

    <!-- Logo -->
    
    <h2 class="text-2xl sm:text-3xl font-extrabold text-center text-gray-800 mb-5">MIS</h2>

    <form id="frmLogin" class="space-y-4 sm:space-y-5">
      <div>
        <label for="username" class="block text-sm font-semibold text-gray-700">username</label>
        <input type="text" id="username" name="username" 
               class="mt-1 w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
      </div>

      <div>
        <label for="password" class="block text-sm font-semibold text-gray-700">Password</label>
        <input type="password" id="password" name="password" 
               class="mt-1 w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
      </div>

     

      <div>
        <button type="submit" id="btnLogin" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-md text-sm font-semibold text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-200">
          Sign in
        </button>
      </div>
    </form>
  </div>

  
<?php include "footer.php"; ?>
<script src="assets/js/app.js"></script>