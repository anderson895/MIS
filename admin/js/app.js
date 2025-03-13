$("#addUserForm").submit(function (e) {
    e.preventDefault();
    
    $('.spinner').show();
    $('#btnAddStudent').prop('disabled', true);
    
    var formData = new FormData(this);
    formData.append('requestType', 'AddUser');
    
    $.ajax({
        type: "POST",
        url: "backend/end-points/controller.php",
        data: formData,
        processData: false,
        contentType: false,
        dataType: "json", // Expect JSON response
        success: function (response) {
            console.log(response);
    
            if (response.status === "success") {
                alertify.success(response.message); // Show success message
                setTimeout(function () {
                    location.reload();
                }, 2000);
            } else if (response.status === "error" && response.message === "Email already exists!") {
                alertify.error("Email already exists. Try another email.");
                $('.spinner').hide();
                $('#btnAddStudent').prop('disabled', false);
            } else {
                alertify.error(response.message || 'Registration failed, please try again.');
                $('.spinner').hide();
                $('#btnAddStudent').prop('disabled', false);
            }
        },
        error: function (xhr, status, error) {
            console.log(xhr.responseText);
            alertify.error("An error occurred. Please try again.");
            $('.spinner').hide();
            $('#btnAddStudent').prop('disabled', false);
        }
    });
    });