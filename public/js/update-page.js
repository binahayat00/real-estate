$(document).ready(function () {

    $.ajax({
        headers: {
            'Authorization': 'Bearer ' + getCookie('access_token'),
        },
        url: '/api/appointment/' + $("#appointment-id").text(),
        type: "GET",
        data: {
        },
        success: function (response) {
            console.log()

            $('#zipcode').val(response.zipcode);
            $('#date').val(response.date);
            $('#name').val(response.appointment_attendee[0].name);
            $('#surname').val(response.appointment_attendee[0].surname);
            $('#email').val(response.appointment_attendee[0].email);
            $('#phonenumber').val(response.appointment_attendee[0].phone_number);

        },
        error: function (error) {
            console.log(error.status)
            if (error.status == 401) {
                window.location.href = '/login';
            }

        }
    });

    $("#edit_appointment").on('click', function () {
        $.ajax({
            headers: {
                'Authorization': 'Bearer ' + getCookie('access_token'),
            },
            url: '/api/appointment/' + $("#appointment-id").text(),
            type: "PUT",
            data: {
                zipcode: $('#zipcode').val(),
                date: $('#date').val(),
                name: $('#name').val(),
                surname: $('#surname').val(),
                email: $('#email').val(),
                phonenumber: $('#phonenumber').val(),
            },
            success: function (response) {
                console.log(response)
                $('#error_edit_appointment').text('Edited successfully');
                $('#error_edit_appointment').css("color", "green");
            },
            error: function (error) {
                console.log(error.responseJSON.message)
                messages = error.responseJSON.message;
                Object.keys(messages).forEach(key => {
                    console.log(messages[key][0]);
                    $('#error_edit_appointment').append(
                        messages[key][0] + '\n'
                    );
                });
                console.log(error.status)
                if (error.status == 401) {
                    window.location.href = '/login';
                }
            }
        });
    })

    $("#delete_appointment").on('click', function () {
        if (confirm("Do you want delete?") == true) {
            $.ajax({
                headers: {
                    'Authorization': 'Bearer ' + getCookie('access_token'),
                },
                url: '/api/appointment/' + $("#appointment-id").text(),
                type: "DELETE",
                data: {
                },
                success: function (response) {
                    console.log(response)
                    $('#error_delete_appointment').text('Deleted successfully');
                    $('#error_delete_appointment').css("color", "green");
                    window.history.back();
                },
                error: function (error) {
                    console.log(error.responseJSON.message)
                    messages = error.responseJSON.message;
                    Object.keys(messages).forEach(key => {
                        console.log(messages[key][0]);
                        $('#error_delete_appointment').append(
                            messages[key][0] + '\n'
                        );
                    });
                    console.log(error.status)
                    if (error.status == 401) {
                        window.location.href = '/login';
                    }
                }
            });
            alert("Deleted successfully!");
        } else {
            alert("You canceled!");
        }
    });

    function getCookie(cname) {
        let name = cname + "=";
        let ca = document.cookie.split(';');
        for (let i = 0; i < ca.length; i++) {
            let c = ca[i];
            while (c.charAt(0) == ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
            }
        }
        return "";
    }

});