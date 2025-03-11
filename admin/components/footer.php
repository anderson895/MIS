 <!-- Main Content goes here -->
 </main>
</div>



<!-- Floating Chat Button -->
<div id="chat-button" class="fixed bottom-5 right-5 bg-blue-500 text-white p-4 rounded-full shadow-lg cursor-pointer hover:bg-blue-600 transition">
    💬
</div>

<!-- Chat Modal -->
<div id="chat-modal" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center" style="display:none;">
    <div class="bg-white p-6 rounded-lg shadow-lg w-full sm:max-w-3xl max-h-[90vh] overflow-y-auto flex flex-col justify-between">

        <!-- Spinner -->
        <div class="spinner" style="display:none;">
            <div class=" absolute inset-0 bg-white bg-opacity-75 flex items-center justify-center">
                <div class="w-10 h-10 border-4 border-indigo-500 border-t-transparent rounded-full animate-spin"></div>
            </div>
        </div>

        <h2 class="text-xl font-semibold text-gray-700 mb-4">Create Report</h2>
        <!-- Modal Form for Adding Product -->
        <form id="frmSendChat">

        <input type="hidden" name="IDsentFrom" value="<?=$session_account[0]['id']?>">
            <!-- Spinner -->
        <div class="spinner" id="spinner" style="display:none;">
            <div class="absolute inset-0 bg-white bg-opacity-75 flex items-center justify-center">
            <div class="w-10 h-10 border-4 border-indigo-500 border-t-transparent rounded-full animate-spin"></div>
            </div>
        </div>
        <div class="relative w-full">
            <!-- Search Input Field -->
            <input type="text" id="search_sentTo" placeholder="To"
                class="w-full border-b-2 border-gray-300 p-2 text-gray-700 focus:ring-2 focus:ring-blue-500 focus:outline-none transition-all rounded-md" required>
            <!-- Suggestion List -->
            <ul id="searchResults" class="absolute w-full mt-1 bg-white border border-gray-300 shadow-md rounded-md max-h-60 overflow-auto hidden z-10 cursor-pointer"></ul>
            <input type="hidden" id="selectedAdminId" name="IDsentTo">
        </div>

         
            <textarea placeholder="Write Messages..." class="w-full h-40 border p-2 mt-2 text-gray-700 focus:outline-none rounded-md" name="messages" required></textarea>
           
            <div class="flex items-center mt-4 space-x-2">
                <button type="submit" id="btnSendReport" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">Send</button>
                <input type="file" accept="image/*" class="p-2 border rounded-md text-gray-700" name="imagesProof">
            </div>
        </form>
    </div>
</div>

<script>
  $("#chat-button").click(function() {
        $("#chat-modal").fadeIn();
    });

    // Close Modal
    $("#Hide_create_report_modal").click(function() {
        $("#chat-modal").fadeOut();
    });

    // Close Modal when clicking outside the modal content
    $("#chat-modal").click(function(event) {
        if ($(event.target).is("#chat-modal")) {
            $("#chat-modal").fadeOut();
        }
    });
</script>







<!-- Optional: Material Icons CDN for icons -->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>

<script src="js/app.js"></script>




<script>
  
  
  const overlay = document.getElementById('overlay');


  menuButton.addEventListener('click', () => {
    sidebar.classList.toggle('-translate-x-full');
    overlay.classList.toggle('hidden');
  });



  overlay.addEventListener('click', () => {
    sidebar.classList.add('-translate-x-full');
    overlay.classList.add('hidden');
  });
</script>
</body>
</html>