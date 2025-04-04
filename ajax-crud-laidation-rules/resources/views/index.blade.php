<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AJAX CRUD with Bootstrap Modals</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/additional-methods.min.js"></script>

    <style>
        label.error {
            color: red;
        }
    </style>
</head>

<body>

    <div class="container mt-5">
        {{-- alert --}}
        <div class="alert alert-success d-none" role="alert" id="successAlert"></div>

        <h2>Student List</h2>

        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createStudentModal">
            Create Student
        </button>

        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Gender</th>
                    <th>Mobile</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="studentList"></tbody>
        </table>

        <!-- Create Student Modal -->
        <div class="modal fade" id="createStudentModal" tabindex="-1" aria-labelledby="createStudentModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createStudentModalLabel">Create Student</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="studentForm" class="form-validate" enctype="multipart/form-data">
                            <div class="mb-3" id="createFailAlertContainer">
                                <!-- Error messages will be dynamically appended here -->
                            </div>
                            <div class="mb-3">
                                <input type="text" name="name" class="form-control" placeholder="Name">
                            </div>
                            <div class="mb-3">
                                <input type="email" name="email" class="form-control" placeholder="Email">
                            </div>
                            <div class="mb-3">
                                <select name="gender" class="form-control">
                                    <option value="">Select Gender</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <input type="text" name="mobile" class="form-control" placeholder="Mobile">
                            </div>
                            <div class="mb-3">
                                <input type="file" name="image" class="form-control">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" id="addStudentBtn" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Student Modal -->
        <div class="modal fade" id="editStudentModal" tabindex="-1" aria-labelledby="editStudentModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editStudentModalLabel">Edit Student</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="editstudentForm" class="form-validate" enctype="multipart/form-data">
                            <div class="mb-3" id="editFailAlertContainer">
                                <!-- Error messages will be dynamically appended here -->
                            </div>
                            <input type="hidden" id="editStudentId" name="id">
                            <div class="mb-3">
                                <input type="text" id="editName" name="name" class="form-control"
                                    placeholder="Name">
                            </div>
                            <div class="mb-3">
                                <input type="email" id="editEmail" name="email" class="form-control"
                                    placeholder="Email">
                            </div>
                            <div class="mb-3">
                                <select id="editGender" name="gender" class="form-control">
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <input type="text" id="editMobile" name="mobile" class="form-control"
                                    placeholder="Mobile">
                            </div>
                            <div class="mb-3">
                                <input type="file" name="image" class="form-control" id="image">
                            </div>
                            <!-- Image Preview Section -->
                            <div class="mb-3">
                                <label for="imagePreview">Current Image:</label>
                                <img id="imagePreview" src="" alt="Image Preview"
                                    style="max-width: 100%; margin-top: 10px; display: none;">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" id="editStudentBtn" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Delete Student Confirmation Modal -->
        <div class="modal fade" id="deleteStudentModal" tabindex="-1" aria-labelledby="deleteStudentModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteStudentModalLabel">Delete Student</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete this student?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" id="deleteStudentBtn" class="btn btn-danger">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function fetchStudents() {
            $.get("/students", function(data) {
                let studentList = $("#studentList").empty();
                data.forEach(student => {
                    let imageTag = student.image ?
                        `<img src="/storage/${student.image}" width="50">` :
                        "No Image";

                    studentList.append(`
                    <tr>
                        <td>${student.name}</td>
                        <td>${student.email}</td>
                        <td>${student.gender}</td>
                        <td>${student.mobile}</td>
                        <td>${imageTag}</td>
                        <td>
                            <button class="btn btn-warning btn-sm" onclick="editStudent(${student.id})">Edit</button>
                            <button class="btn btn-danger btn-sm" onclick="deleteStudent(${student.id})">Delete</button>
                        </td>
                    </tr>
                `);
                });
            });
        }

        $(document).ready(function() {
            fetchStudents();
            var csrfToken = "{{ csrf_token() }}"; // Pass the CSRF token to a JavaScript variable
            // Set CSRF token in AJAX request headers
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': csrfToken // The variable csrfToken contains the CSRF token from Blade
                }
            });

            // preview image on file select
            $("#image").change(function(e) {
                let reader = new FileReader();
                reader.onload = function(event) {
                    $("#imagePreview").attr("src", event.target.result).show();
                };
                reader.readAsDataURL(this.files[0]);
            });

            // validation rules
            $("#studentForm, #editstudentForm").validate({
                rules: {
                    name: {
                        required: true,
                        minlength: 3
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    gender: {
                        required: true
                    },
                    mobile: {
                        required: true,
                        digits: true,
                        minlength: 10,
                        maxlength: 10
                    },
                    image: {
                        extension: "jpg|jpeg|png|gif"
                    }
                },
                messages: {
                    name: {
                        required: "Enter name",
                        minlength: "Min 3 chars"
                    },
                    email: {
                        required: "Enter email",
                        email: "Invalid email"
                    },
                    gender: {
                        required: "Select gender"
                    },
                    mobile: {
                        required: "Enter mobile",
                        digits: "Only digits",
                        minlength: "Exactly 10 digits",
                        maxlength: "Exactly 10 digits"
                    },
                    image: {
                        extension: "Only jpg, jpeg, png, gif allowed"
                    }
                }
            });

            // Create Student
            $("#addStudentBtn").click(function() {
                if (!$("#studentForm").valid()) return;

                let formData = new FormData($("#studentForm")[0]);

                $.ajax({
                    url: "/students",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.status == 1) {
                            // Show success message and clear form
                            const successAlert = $("#successAlert");

                            // Clear any previous messages before appending the new one
                            successAlert.empty();

                            // Append the success message to the alert
                            successAlert.append(response.message);

                            // Show the alert
                            successAlert.removeClass('d-none'); // Ensure the alert is visible

                            // Fade out the alert after 5 seconds
                            successAlert.fadeOut(5000, function() {
                                successAlert.addClass(
                                    'd-none'); // Hide it after fading out
                            });
                        }
                        fetchStudents();
                        $("#studentForm")[0].reset();
                        $('#createStudentModal').modal('hide');
                    },
                    error: function(xhr) {
                        // Error handling logic
                        const errorContainer = $(
                            "#createFailAlertContainer"
                        ); // Select the container where errors will be shown
                        let errors = xhr.responseJSON
                            .errors; // Get errors from the AJAX response

                        // Clear previous error messages
                        errorContainer.empty();

                        // Loop through each error and create a new div for each
                        for (let key in errors) {
                            let errorDiv =
                                `<div class="alert alert-danger">${errors[key]}</div>`;
                            errorContainer.append(
                                errorDiv); // Append each error to the container
                        }

                        // Optionally, hide the error messages after 5 seconds
                        setTimeout(function() {
                            errorContainer
                                .empty(); // Clear all error messages after 5 seconds
                        }, 5000);
                    }
                });
            });

            // Edit Student
            window.editStudent = function(id) {
                $.get(`/students/${id}/edit`, function(data) {
                    $("#editStudentId").val(data.id);
                    $("#editName").val(data.name);
                    $("#editEmail").val(data.email);
                    $("#editGender").val(data.gender);
                    $("#editMobile").val(data.mobile);
                    // If the student has an image, show the preview
                    if (data.image) {
                        // Use a proper path to display the image preview
                        let imagePath = `/storage/${data.image}`; // Correct image path

                        // Show the image preview in the modal
                        $("#imagePreview").attr("src", imagePath)
                            .show(); // Set the 'src' to the correct image path
                    } else {
                        // Hide the image preview if no image is available
                        $("#imagePreview").hide();
                    }
                    $('#editStudentModal').modal('show');
                });
            };

            // Update Student
            $("#editStudentBtn").click(function() {
                if (!$("#editstudentForm").valid()) return;

                // jQuery("#createEditForm").serializeArray();
                let formData = new FormData($("#editstudentForm")[0]);
                console.log(formData);

                // Log FormData to console to check if it contains the expected data
                for (let pair of formData.entries()) {
                    console.log(pair[0] + ": " + pair[1]);
                }
                let id = $("#editStudentId").val();

                $.ajax({
                    url: `/students/${id}`,
                    type: "PUT",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function() {
                        alert("Student updated!");
                        fetchStudents();
                        $('#editStudentModal').modal('hide');
                    },
                    error: function(xhr) {
                        // Error handling logic
                        const errorContainer = $(
                            "#editFailAlertContainer"
                        ); // Select the container where errors will be shown
                        let errors = xhr.responseJSON
                            .errors; // Get errors from the AJAX response

                        // Clear previous error messages
                        errorContainer.empty();

                        // Loop through each error and create a new div for each
                        for (let key in errors) {
                            let errorDiv =
                                `<div class="alert alert-danger">${errors[key]}</div>`;
                            errorContainer.append(
                                errorDiv); // Append each error to the container
                        }

                        // Optionally, hide the error messages after 5 seconds
                        setTimeout(function() {
                            errorContainer
                                .empty(); // Clear all error messages after 5 seconds
                        }, 5000);
                    }
                });
            });

            // Delete Student
            window.deleteStudent = function(id) {
                $("#deleteStudentBtn").click(function() {
                    $.ajax({
                        url: `/students/${id}`,
                        type: "DELETE",
                        success: function() {
                            alert("Student deleted!");
                            fetchStudents();
                            $('#deleteStudentModal').modal('hide');
                        }
                    });
                });

                $('#deleteStudentModal').modal('show');
            };
        });
    </script>

</body>

</html>
