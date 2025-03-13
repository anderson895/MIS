$("#updateUserForm").submit(function (e) {
    e.preventDefault();
    
    $('.spinner').show();
    $('#btnAddStudent').prop('disabled', true);
    
    var formData = new FormData(this);
    formData.append('requestType', 'updateUser');
    
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














    $(document).on("click", ".TogglerDeleteUser", function () {
        var adminId = $(this).data("id");
        
        alertify.confirm("Delete Admin", "Are you sure you want to delete this ?", function () {
            $.ajax({
                type: "POST",
                url: "backend/end-points/controller.php",
                data: {
                    requestType: "DeleteAdmin",
                    admin_id: adminId
                },
                dataType: "json",
                success: function (response) {
                    if (response.status === "success") {
                        alertify.success(response.message);
                        setTimeout(function () {
                            location.reload(); // Refresh page after deletion
                        }, 1000);
                    } else {
                        alertify.error(response.message);
                    }
                },
            });
        }, function () {
            alertify.error("Deletion canceled.");
        });
        });