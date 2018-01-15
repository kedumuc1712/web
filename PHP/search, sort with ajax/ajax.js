function delete_row(ID) {
    $.ajax({
        url: 'edit_delete.php',
        type: 'post',
        data: {
            delete_row: "delete_row",
            row_id: ID,
        },
        success: function (response) {
            if (response == "success") {
                var question = confirm("Do you want to delete this record ?");
                if (question) {
                    var row = document.getElementById("row" + ID);
                    row.parentNode.removeChild(row);
                }

            }
        }
    });
}

function edit_row(ID) {
    if (document.getElementById("fname" + ID) != null) {
        var firstName = document.getElementById("fname" + ID).innerHTML;
        document.getElementById("fname" + ID).innerHTML
            = "<input type='text' id='fname_text" + ID + "' value='" + firstName + "'>";
    }
    if (document.getElementById("lname" + ID) != null){
        var lastName = document.getElementById("lname" + ID).innerHTML;
        document.getElementById("lname" + ID).innerHTML
            = "<input type='text' id='lname_text" + ID + "' value='" + lastName + "'>";
    }
    if (document.getElementById("mail" + ID) != null) {
        var email = document.getElementById("mail" + ID).innerHTML;
        document.getElementById("mail" + ID).innerHTML
            = "<input type='email' id='mail_text" + ID + "' value='" + email + "'>";
    }
    if (document.getElementById("edit_button" + ID) != null) {
        document.getElementById("edit_button" + ID).style.display = "none";
    }
    if (document.getElementById("save_button" + ID) != null){
        document.getElementById("save_button" + ID).style.display = "inline-block";
    }
    if (document.getElementById("cancel_button" + ID) != null) {
        document.getElementById("cancel_button" + ID).style.display = "inline-block";
    }
}

function save_row(ID) {
    if (document.getElementById("fname_text" + ID) != null){
        var newFirstName = document.getElementById("fname_text" + ID).value;
    }
    if (document.getElementById("lname_text" + ID) != null) {
        var newLastName = document.getElementById("lname_text" + ID).value;
    }
    if (document.getElementById("mail_text" + ID) != null) {
        var newEmail = document.getElementById("mail_text" + ID).value;
    }

    $.ajax({
        url: 'edit_delete.php',
        type: 'post',
        data: {
            edit_row: "edit_row",
            row_id: ID,
            newFirstName: newFirstName,
            newLastName: newLastName,
            newEmail: newEmail
        },
        success: function (response) {
            if (response == "success") {

                document.getElementById("fname" + ID).innerHTML = newFirstName;
                document.getElementById("lname" + ID).innerHTML = newLastName;
                document.getElementById("mail" + ID).innerHTML = newEmail;

                if (document.getElementById("edit_button" + ID) != null){
                    document.getElementById("edit_button" + ID).style.display = "block";
                }
                if (document.getElementById("cancel_button" + ID) != null) {
                    document.getElementById("cancel_button" + ID).style.display = "none";
                }

                if (document.getElementById("save_button" + ID) != null) {
                    document.getElementById("save_button" + ID).style.display = "none";
                }
                alert("Edited this record");
            }
            else if (response == "email type is incorrect") {
                alert("email type is incorrect");
            }
            else {
                alert("Please Fill All The Details");
            }
        }
    });
}

function cancel_row(ID) {
    if (document.getElementById("fname_text" + ID) != null){
        var firstName = document.getElementById("fname_text" + ID).value;
    }
    if (document.getElementById("lname_text" + ID) != null) {
        var lastName = document.getElementById("lname_text" + ID).value;
    }
    if (document.getElementById("mail_text" + ID) != null) {
        var email = document.getElementById("mail_text" + ID).value;
    }

    document.getElementById("fname" + ID).innerHTML = firstName;
    document.getElementById("lname" + ID).innerHTML = lastName;
    document.getElementById("mail" + ID).innerHTML = email;

    if (document.getElementById("edit_button" + ID) != null){
        document.getElementById("edit_button" + ID).style.display = "block";
    }
    if (document.getElementById("cancel_button" + ID) != null) {
        document.getElementById("cancel_button" + ID).style.display = "none";
    }

    if (document.getElementById("save_button" + ID) != null) {
        document.getElementById("save_button" + ID).style.display = "none";
    }
}