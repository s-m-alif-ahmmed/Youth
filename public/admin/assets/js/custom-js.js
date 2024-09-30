// Sweet Alert Ban
function BanAction(event, message, btnClass) {
    Swal.fire({
        title: 'Confirmation',
        text: message,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = event.target.getAttribute('href');
        }
    });

    return false;
}
// Sweet Alert Status
function StatusAction(event, message, btnClass) {
    Swal.fire({
        title: 'Confirmation',
        text: message,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = event.target.getAttribute('href');
        }
    });

    return false;
}
// Sweet Alert Delete
function deleteAction(userId, message, btnClass) {
    Swal.fire({
        title: 'Confirmation',
        text: message,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            // Trigger the form submission
            document.getElementById('deleteForm' + userId).submit();
        }
    });

    return false;
}

// jquery select checksm
$(function(){
    $('form').checkem();
});


// Product Category & Sub Category Dropdown
$(document).ready(function() {
    $('#menu').change(function() {
        var menuId = $(this).val();
        $.ajax({
            url: '/getCategoriesByMenu',
            type: 'GET',
            dataType: 'json',
            data: {
                menu_id: menuId
            },
            success: function(response) {
                var options = '';
                for (var i = 0; i < response.length; i++) {
                    options += '<option value="' + response[i].id + '">' + response[i].name + '</option>';
                }
                $('#product-category').html(options);

                // Trigger the change event to update prefix_id when a new designation is loaded
                $('#product-category').trigger('change');
            }
        });
    });

    $('#product-category').change(function() {
        var productCategoryId = $(this).val();
        $.ajax({
            url: '/getSubCategoriesByCategory',
            type: 'GET',
            dataType: 'json',
            data: {
                product_category_id: productCategoryId
            },
            success: function(response) {
                var options = '';
                for (var i = 0; i < response.length; i++) {
                    options += '<option value="' + response[i].id + '">' + response[i].name + '</option>';
                }
                $('#product-sub-category').html(options);
            }
        });
    });

});


// Password Show
$(document).ready(function() {
    $('#togglePassword').click(function() {
        var x = document.getElementById("current_password");

        if (x.type === "password") {
            x.type = "text";
            $('#togglePassword').removeClass("fa-eye").addClass("fa-eye-slash");
        } else {
            x.type = "password";
            $('#togglePassword').removeClass("fa-eye-slash").addClass("fa-eye");
        }
    });

    $('#toggleNewPassword').click(function() {
        var x = document.getElementById("password");

        if (x.type === "password") {
            x.type = "text";
            $('#toggleNewPassword').removeClass("fa-eye").addClass("fa-eye-slash");
        } else {
            x.type = "password";
            $('#toggleNewPassword').removeClass("fa-eye-slash").addClass("fa-eye");
        }
    });

    $('#toggleConfirmPassword').click(function() {
        var x = document.getElementById("password_confirmation");

        if (x.type === "password") {
            x.type = "text";
            $('#toggleConfirmPassword').removeClass("fa-eye").addClass("fa-eye-slash");
        } else {
            x.type = "password";
            $('#toggleConfirmPassword').removeClass("fa-eye-slash").addClass("fa-eye");
        }
    });
});

// password validation
$(document).ready(function () {
    // Function to validate the password format
    function validatePasswordFormat(password) {
        var lowercaseRegex = /^(?=.*[a-z])/;
        var uppercaseRegex = /^(?=.*[A-Z])/;
        var digitRegex = /^(?=.*\d)/;
        var specialCharRegex = /^(?=.*[@$!%*?&])/;
        var lengthRegex = /^.{8,25}$/;

        return {
            lowercase: lowercaseRegex.test(password),
            uppercase: uppercaseRegex.test(password),
            digit: digitRegex.test(password),
            specialChar: specialCharRegex.test(password),
            length: lengthRegex.test(password),
        };
    }

    // Function to update the password validation messages
    function updatePasswordValidationMessages(validationResults) {
        $('#lowercase-message').text(validationResults.lowercase ? '' : 'Password must contain at least one lowercase letter.');
        $('#uppercase-message').text(validationResults.uppercase ? '' : 'Password must contain at least one uppercase letter.');
        $('#digit-message').text(validationResults.digit ? '' : 'Password must contain at least one digit.');
        $('#special-char-message').text(validationResults.specialChar ? '' : 'Password must contain at least one special character.');
        $('#length-message').text(validationResults.length ? '' : 'Password must be between 8 and 25 characters.');
    }

    // Function to check if all validations are true
    function areAllValidationsTrue(validationResults) {
        return validationResults.lowercase &&
            validationResults.uppercase &&
            validationResults.digit &&
            validationResults.specialChar &&
            validationResults.length;
    }

    // Event handler for password input
    $('#password').on('input', function () {
        var password = $(this).val();
        var validationResults = validatePasswordFormat(password);
        updatePasswordValidationMessages(validationResults);

        // Enable or disable the submit button based on validation results
        var isSubmitButtonDisabled = !areAllValidationsTrue(validationResults);
        $('#submit-button').prop('disabled', isSubmitButtonDisabled);
    });

});

// confirm password validation
$(document).ready(function () {

    // Function to update the password match message
    function updatePasswordMatchMessage(isMatch) {
        if (isMatch) {
            $('#match-message').removeClass('text-danger').addClass('text-success').text('Passwords match.');
        } else {
            $('#match-message').removeClass('text-success').addClass('text-danger').text('Passwords do not match.');
        }
    }

    // Function to check if the input fields are not empty
    function isNotEmpty(value) {
        return value.trim() !== '';
    }

    // Event handler for password confirmation input
    $('#password_confirmation').on('input', function () {
        var password = $('#password').val();
        var confirmPassword = $(this).val();
        var isNotEmptyFields = isNotEmpty(password) && isNotEmpty(confirmPassword);
        var isMatch = isNotEmptyFields && validatePasswordMatch(password, confirmPassword);
        updatePasswordMatchMessage(isMatch);
    });

    // Event handler for password input
    $('#password').on('input', function () {
        var password = $(this).val();
        var validationResults = validatePasswordFormat(password);
        updatePasswordValidationMessages(validationResults);

        // Also check for password match when the password changes
        var confirmPassword = $('#password_confirmation').val();
        var isNotEmptyFields = isNotEmpty(password) && isNotEmpty(confirmPassword);
        var isMatch = isNotEmptyFields && validatePasswordMatch(password, confirmPassword);
        updatePasswordMatchMessage(isMatch);
    });

    // Initialize the match message only if both fields are not empty
    var initialPassword = $('#password').val();
    var initialConfirmPassword = $('#password_confirmation').val();
    if (isNotEmpty(initialPassword) && isNotEmpty(initialConfirmPassword)) {
        updatePasswordMatchMessage(initialPassword === initialConfirmPassword);
    }

});

// Function to validate password match
function validatePasswordMatch(password, confirmPassword) {
    return password === confirmPassword;
}

// Summernote one to many
$(document).ready(function() {
    $('#note1').summernote({
        height: 200
    });
    $('#note2').summernote({
        height: 150
    });

});


// blog next page
$(document).ready(function () {
    // Add an event listener to the English tab
    $('#englishTab').click(function () {
        // Show form-one and hide form-two
        $('#form-one').show();
        $('#form-two').hide();

        // Show the Next button and hide the Submit button
        $('#previous-disable-one').show();
        $('#next-one').show();
        $('#previous-button-one').hide();
        $('#submit-one').hide();
    });

    $('#next-button-english').click(function () {
        // Show form-one and hide form-two
        $('#form-one').hide();
        $('#form-two').show();

        // Show the Next button and hide the Submit button
        $('#previous-disable-one').hide();
        $('#previous-button-one').show();
        $('#next-one').hide();
        $('#submit-one').show();
    });

    $('#previous-button-one').click(function () {
        // Show form-one and hide form-two
        $('#form-one').show();
        $('#form-two').hide();

        // Show the Next button and hide the Submit button
        $('#previous-disable-one').show();
        $('#previous-button-one').hide();
        $('#next-one').show();
        $('#submit-one').hide();
    });

    // Add an event listener to the Bangla tab
    $('#banglaTab').click(function () {
        // Show form-one and hide form-two
        $('#form-three').show();
        $('#form-four').hide();

        // Show the Next button and hide the Submit button
        $('#previous-disable-two').show();
        $('#previous-button-two').hide();
        $('#next-two').show();
        $('#submit-two').hide();
    });

    $('#next-button-bangla').click(function () {
        // Show form-one and hide form-two
        $('#form-three').hide();
        $('#form-four').show();

        // Show the Next button and hide the Submit button
        $('#previous-disable-two').hide();
        $('#previous-button-two').show();
        $('#next-two').hide();
        $('#submit-two').show();
    });

    $('#previous-button-two').click(function () {
        // Show form-one and hide form-two
        $('#form-three').show();
        $('#form-four').hide();

        // Show the Next button and hide the Submit button
        $('#previous-disable-two').show();
        $('#previous-button-two').hide();
        $('#next-two').show();
        $('#submit-two').hide();
    });
});

// Blog validation

$(document).ready(function() {
    // Function to update the state of next buttons based on input length
    function updateNextButtonState() {
        var title = $("#title").val();
        var shortDescription = $("#short_description").val();

        if (title.length < 10 || shortDescription.length < 10) {
            $('#next-button-english').hide();
            $('#next-disable-english').show();
        } else {
            $('#next-button-english').show();
            $('#next-disable-english').hide();
        }
    }

    function updateSubmitButtonState() {
        var metaTitle = $("#meta_title").val();
        var metaDescription = $("#meta_description").val();

        if (metaTitle.length < 10 || metaDescription.length < 10) {
            $('#submit-button-one').hide();
            $('#submit-disable-one').show();
        } else {
            $('#submit-button-one').show();
            $('#submit-disable-one').hide();
        }
    }

    function updateBanglaNextButtonState() {
        var banglaTitle = $("#bangla-title").val();
        var banglaShortDescription = $("#bangla_short_description").val();

        if (banglaTitle.length < 10 || banglaShortDescription.length < 10) {
            $('#next-button-bangla').hide();
            $('#next-disable-bangla').show();
        } else {
            $('#next-button-bangla').show();
            $('#next-disable-bangla').hide();
        }
    }

    function updateBanglaSubmitButtonState() {
        var banglaMetaTitle = $("#bangla-meta-title").val();
        var banglaMetaDescription = $("#bangla_meta_description").val();

        if (banglaMetaTitle.length < 10 || banglaMetaDescription.length < 10) {
            $('#submit-button-two').hide();
            $('#submit-disable-two').show();
        } else {
            $('#submit-button-two').show();
            $('#submit-disable-two').hide();
        }
    }

    // English Title
    $("#title").keyup(function() {
        var title = $("#title").val();
        var charCountTitle = title.length;
        $("#char-count-title").text(charCountTitle);
        var remainingChars = 60 - charCountTitle;

        $("#char-count-title").text(remainingChars);

        if (remainingChars >= 0 && remainingChars <= 60) {
            $("#char-count-title").css("color", "gray");
        } else if (remainingChars >= -40 && remainingChars < 0) {
            $("#char-count-title").css("color", "red");
        }

        var error = false;
        // Clear previous error and box_error class
        $("#error-title").text("");
        $("#title").removeClass("box_error");

        if (title.length < 50 || title.length > 60 || isNaN(title)) {
            $("#error-title").text("Title length must be between 50 and 60 Characters.").css("color", "red");
            $("#title").addClass("box_error");
        }
        if ((title.length >= 50) && (title.length <= 60)) {
            $("#error-title").text("Title is good now.").css("color", "green");
            $("#title").addClass("box_error");
            error = true;
        }

        // Update next button state
        updateNextButtonState();
    });

    // English Short Description
    $("#short_description").keyup(function() {
        var shortDescription = $("#short_description").val();
        var charCountShortDescription = shortDescription.length;
        $("#char-count-short-description").text(charCountShortDescription);
        var remainingCharCountShortDescription = 120 - charCountShortDescription;

        $("#char-count-short-description").text(remainingCharCountShortDescription);

        if (remainingCharCountShortDescription >= 0 && remainingCharCountShortDescription <= 120) {
            $("#char-count-short-description").css("color", "gray");
        } else if (remainingCharCountShortDescription >= -30 && remainingCharCountShortDescription < 0) {
            $("#char-count-short-description").css("color", "red");
        }

        var error = false;
        // Clear previous error and box_error class
        $("#error-short-description").text("");
        $("#short_description").removeClass("box_error");

        if (shortDescription.length < 100 || shortDescription.length > 120 || isNaN(shortDescription)) {
            $("#error-short-description").text("Short description length must be between 100 and 120 Characters.").css("color", "red");
            $("#short_description").addClass("box_error");
        }
        if ((shortDescription.length >= 100) && (shortDescription.length <= 120)) {
            $("#error-short-description").text("Short description is good now.").css("color", "green");
            $("#short_description").addClass("box_error");
            error = true;
        }

        // Update next button state
        updateNextButtonState();
    });

    // English Meta Title
    $("#meta_title").keyup(function() {
        var metaTitle = $("#meta_title").val();
        var charCountMetaTitle = metaTitle.length;
        $("#char-count-meta-title").text(charCountMetaTitle);
        var remainingCharCountMetaTitle = 60 - charCountMetaTitle;

        $("#char-count-meta-title").text(remainingCharCountMetaTitle);

        if (remainingCharCountMetaTitle >= 0 && remainingCharCountMetaTitle <= 60) {
            $("#char-count-meta-title").css("color", "gray");
        } else if (remainingCharCountMetaTitle >= -40 && remainingCharCountMetaTitle < 0) {
            $("#char-count-meta-title").css("color", "red");
        }

        var error = false;
        // Clear previous error and box_error class
        $("#error-meta-title").text("");
        $("#meta_title").removeClass("box_error");

        if (metaTitle.length < 50 || metaTitle.length > 60 || isNaN(metaTitle)) {
            $("#error-meta-title").text("Meta title length must be between 50 and 60 Characters.").css("color", "red");
            $("#meta_title").addClass("box_error");
        }
        if ((metaTitle.length >= 50) && (metaTitle.length <= 60)) {
            $("#error-meta-title").text("Meta title is good now.").css("color", "green");
            $("#meta_title").addClass("box_error");
            error = true;
        }

        // Update next button state
        updateSubmitButtonState();
    });

    // English Meta Description
    $("#meta_description").keyup(function() {
        var metaDescription = $("#meta_description").val();
        var charCountMetaDescription = metaDescription.length;
        $("#char-count-meta-description").text(charCountMetaDescription);
        var remainingCharCountMetaDescription = 160 - charCountMetaDescription;

        $("#char-count-meta-description").text(remainingCharCountMetaDescription);

        if (remainingCharCountMetaDescription >= 0 && remainingCharCountMetaDescription <= 160) {
            $("#char-count-meta-description").css("color", "gray");
        } else if (remainingCharCountMetaDescription >= -40 && remainingCharCountMetaDescription < 0) {
            $("#char-count-meta-description").css("color", "red");
        }

        var error = false;
        // Clear previous error and box_error class
        $("#error-meta-description").text("");
        $("#meta_description").removeClass("box_error");

        if (metaDescription.length < 150 || metaDescription.length > 160 || isNaN(metaDescription)) {
            $("#error-meta-description").text("Meta description length must be between 150 and 160 Characters.").css("color", "red");
            $("#meta_description").addClass("box_error");
        }
        if ((metaDescription.length >= 150) && (metaDescription.length <= 160)) {
            $("#error-meta-description").text("Meta description is good now.").css("color", "green");
            $("#meta_description").addClass("box_error");
            error = true;
        }

        // Update next button state
        updateSubmitButtonState();
    });

    // Bangla Title
    $("#bangla-title").keyup(function() {
        var banglaTitle = $("#bangla-title").val();
        var charCountBanglaTitle = banglaTitle.length;
        $("#char-count-bangla-title").text(charCountBanglaTitle);
        var remainingCharCountBanglaTitle = 60 - charCountBanglaTitle;

        $("#char-count-bangla-title").text(remainingCharCountBanglaTitle);

        if (remainingCharCountBanglaTitle >= 0 && remainingCharCountBanglaTitle <= 60) {
            $("#char-count-bangla-title").css("color", "gray");
        } else if (remainingCharCountBanglaTitle >= -40 && remainingCharCountBanglaTitle < 0) {
            $("#char-count-bangla-title").css("color", "red");
        }

        var error = false;
        // Clear previous error and box_error class
        $("#error-bangla-title").text("");
        $("#bangla-title").removeClass("box_error");

        if (banglaTitle.length < 50 || banglaTitle.length > 60 || isNaN(banglaTitle)) {
            $("#error-bangla-title").text("শিরোনামের দৈর্ঘ্য ৫০ থেকে ৬০ অক্ষরের মধ্যে সীমাবদ্ধ।").css("color", "red");
            $("#bangla-title").addClass("box_error");
        }
        if ((banglaTitle.length >= 50) && (banglaTitle.length <= 60)) {
            $("#error-bangla-title").text("শিরোনাম এখন ভালো।").css("color", "green");
            $("#bangla-title").addClass("box_error");
            error = true;
        }

        // Update next button state
        updateBanglaNextButtonState();
    });

    // Bangla Short Description
    $("#bangla_short_description").keyup(function() {
        var banglaShortDescription = $("#bangla_short_description").val();
        var charCountBanglaShortDescription = banglaShortDescription.length;
        $("#char-count-bangla-short-description").text(charCountBanglaShortDescription);
        var remainingCharCountBanglaShortDescription = 120 - charCountBanglaShortDescription;

        $("#char-count-bangla-short-description").text(remainingCharCountBanglaShortDescription);

        if (remainingCharCountBanglaShortDescription >= 0 && remainingCharCountBanglaShortDescription <= 120) {
            $("#char-count-bangla-short-description").css("color", "gray");
        } else if (remainingCharCountBanglaShortDescription >= -30 && remainingCharCountBanglaShortDescription < 0) {
            $("#char-count-bangla-short-description").css("color", "red");
        }

        var error = false;
        // Clear previous error and box_error class
        $("#error-bangla-short-description").text("");
        $("#bangla_short_description").removeClass("box_error");

        if (banglaShortDescription.length < 100 || banglaShortDescription.length > 120 || isNaN(banglaShortDescription)) {
            $("#error-bangla-short-description").text("সংক্ষিপ্ত বিবরণের দৈর্ঘ্য ১০০ থেকে ১২০ অক্ষরের মধ্যে সীমাবদ্ধ।").css("color", "red");
            $("#bangla_short_description").addClass("box_error");
        }
        if ((banglaShortDescription.length >= 100) && (banglaShortDescription.length <= 120)) {
            $("#error-bangla-short-description").text("সংক্ষিপ্ত বিবরণ এখন ভাল.").css("color", "green");
            $("#bangla_short_description").addClass("box_error");
            error = true;
        }

        // Update next button state
        updateBanglaNextButtonState();
    });

    // Bangla Title
    $("#bangla-meta-title").keyup(function() {
        var banglaMetaTitle = $("#bangla-meta-title").val();
        var charCountBanglaMetaTitle = banglaMetaTitle.length;
        $("#char-count-bangla-meta-title").text(charCountBanglaMetaTitle);
        var remainingCharCountBanglaMetaTitle = 60 - charCountBanglaMetaTitle;

        $("#char-count-bangla-meta-title").text(remainingCharCountBanglaMetaTitle);

        if (remainingCharCountBanglaMetaTitle >= 0 && remainingCharCountBanglaMetaTitle <= 60) {
            $("#char-count-bangla-meta-title").css("color", "gray");
        } else if (remainingCharCountBanglaMetaTitle >= -40 && remainingCharCountBanglaMetaTitle < 0) {
            $("#char-count-bangla-meta-title").css("color", "red");
        }

        var error = false;
        // Clear previous error and box_error class
        $("#error-bangla-meta-title").text("");
        $("#bangla-meta-title").removeClass("box_error");

        if (banglaMetaTitle.length < 50 || banglaMetaTitle.length > 60 || isNaN(banglaMetaTitle)) {
            $("#error-bangla-meta-title").text("মেটা শিরোনামের দৈর্ঘ্য ৫০ থেকে ৬০ অক্ষরের মধ্যে সীমাবদ্ধ।").css("color", "red");
            $("#bangla-meta-title").addClass("box_error");
        }
        if ((banglaMetaTitle.length >= 50) && (banglaMetaTitle.length <= 60)) {
            $("#error-bangla-meta-title").text("মেটা শিরোনাম এখন ভালো।").css("color", "green");
            $("#bangla-meta-title").addClass("box_error");
            error = true;
        }

        // Update next button state
        updateBanglaSubmitButtonState();
    });

    // Bangla Short Description
    $("#bangla_meta_description").keyup(function() {
        var banglaMetaDescription = $("#bangla_meta_description").val();
        var charCountBanglaMetaDescription = banglaMetaDescription.length;
        $("#char-count-bangla-meta-description").text(charCountBanglaMetaDescription);
        var remainingCharCountBanglaMetaDescription = 160 - charCountBanglaMetaDescription;

        $("#char-count-bangla-meta-description").text(remainingCharCountBanglaMetaDescription);

        if (remainingCharCountBanglaMetaDescription >= 0 && remainingCharCountBanglaMetaDescription <= 160) {
            $("#char-count-bangla-meta-description").css("color", "gray");
        } else if (remainingCharCountBanglaMetaDescription >= -40 && remainingCharCountBanglaMetaDescription < 0) {
            $("#char-count-bangla-meta-description").css("color", "red");
        }

        var error = false;
        // Clear previous error and box_error class
        $("#error-bangla-meta-description").text("");
        $("#bangla_meta_description").removeClass("box_error");

        if (banglaMetaDescription.length < 150 || banglaMetaDescription.length > 160 || isNaN(banglaMetaDescription)) {
            $("#error-bangla-meta-description").text("মেটা বিবরণের দৈর্ঘ্য ১৫০ থেকে ১৬০ অক্ষরের মধ্যে সীমাবদ্ধ।").css("color", "red");
            $("#bangla_meta_description").addClass("box_error");
        }
        if ((banglaMetaDescription.length >= 150) && (banglaMetaDescription.length <= 160)) {
            $("#error-bangla-meta-description").text("মেটা বিবরণ এখন ভাল.").css("color", "green");
            $("#bangla_meta_description").addClass("box_error");
            error = true;
        }

        // Update next button state
        updateBanglaSubmitButtonState();
    });

    // Initial state
    updateNextButtonState();
    updateSubmitButtonState();
    updateBanglaNextButtonState();
    updateBanglaSubmitButtonState();
});

// english blog image size validation
function validateImageSize() {
    var input = document.getElementById('image');
    var fileSize = input.files[0].size; // in bytes
    var maxSize = 100 * 1024; // 100 KB

    if (fileSize > maxSize) {
        document.getElementById('imageSizeError').innerText = 'Image size must be under 100 KB.';
        input.value = ''; // Clear the file input to allow selecting a new file
    } else {
        document.getElementById('imageSizeError').innerText = '';
    }
}

// bangla blog image size validation
function validateImageSizeBangla() {
    var input = document.getElementById('image-bangla');
    var fileSize = input.files[0].size; // in bytes
    var maxSize = 100 * 1024; // 100 KB

    if (fileSize > maxSize) {
        document.getElementById('imageSizeErrorBangla').innerText = 'ছবির সাইজ 100 KB এর নিচে হতে হবে।';
        input.value = ''; // Clear the file input to allow selecting a new file
    } else {
        document.getElementById('imageSizeErrorBangla').innerText = '';
    }
}
