$(document).ready(function () {

    $.ajax({
        headers: {
            'Authorization': 'Bearer ' + getCookie('access_token'),
        },
        url: '/api/appointment/',
        type: "GET",
        data: {
        },
        success: function (response) {
            response.forEach(element => {
                $('#appointment-lists').append('<tr>' +
                    '<td>' + element.id + '</td>' +
                    '<td>' + element.zipcode + '</td>' +
                    '<td>' + element.date + '</td>' +
                    '<td>' + (element.distance_from_realestate / 1000).toFixed(4) + ' (km) </td>' +
                    '<td>' + (element.arriving_estimated_time / 60).toFixed(2) + ' (min) </td>' +
                    '<td>' + (element.returning_estimated_time / 60).toFixed(2) + ' (min) </td>' +
                    '<td> <a href="/appointment/' + element.id + '"><button type="button" class="btn btn-info btn-lg">Update</button></a> </td>' +
                    '<td> <a href="/appointment/' + element.id + '"><button type="button" class="btn btn-danger btn-lg" >Delete</button></a> </td>' +
                    '</tr>');
            });

        },
        error: function (error) {
            console.log(error.status)
            if (error.status == 401) {
                window.location.href = '/login';
            }
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

    $("#store_appointment").on('click', function () {
        $.ajax({
            headers: {
                'Authorization': 'Bearer ' + getCookie('access_token'),
            },
            url: '/api/appointment/',
            type: "POST",
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
                $('#error_store_appointment').text('Saved successfully');
                $('#error_store_appointment').css("color", "green");
            },
            error: function (error) {
                console.log(error.responseJSON.message)
                messages = error.responseJSON.message;
                Object.keys(messages).forEach(key => {
                    console.log(messages[key][0]);
                    $('#error_store_appointment').append(
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



});