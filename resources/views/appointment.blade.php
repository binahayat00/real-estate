<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>discussdesk.com - Login form in PHP mysql</title>
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css">
    {{--  <script type="text/javascript" src="{{ asset('js/jquery-cookie.js') }}"></script>  --}}
    <script type="text/javascript" src="{{ asset('js/jquery-3.6.3.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/update-page.js') }}"></script>

</head>

<body>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body p-0 row">
                {{--  <div class="col-12 col-lg-5 ad p-0"> <img src="https://i.imgur.com/UCqKKB4.jpg" width="100%"
                        height="100%" /> </div>  --}}
                <div class="details col-12 col-lg-7">
                    <form action="" method="POST">
                        <h4>Appointment</h4>
                        <p id="appointment-id" style="display: none">{{ $id }}</p>
                        <label for="zipcode">Address(Zipcode):</label><br>
                        <input class="form-control" type="text" id="zipcode" name="zipcode" value=""><br>
                        <label for="date">Date(2022-12-12 13:00:00)</label><br>
                        <input class="form-control" type="text" id="date" name="date" value=""><br>
                        <h4>Participle</h4>
                        <label for="name">Name</label><br>
                        <input class="form-control" type="text" id="name" name="name" value=""><br>
                        <label for="surname">Surname</label><br>
                        <input class="form-control" type="text" id="surname" name="surname" value=""><br>
                        <label for="email">Email</label><br>
                        <input class="form-control" type="text" id="email" name="email" value=""><br>
                        <label for="phonenumber">Phone Number</label><br>
                        <input class="form-control" type="text" id="phonenumber" name="phonenumber" value=""><br>
                        <p id="error_edit_appointment"></p>
                        <p id="error_delete_appointment"></p>
                        <input class="btn btn-primary" id="edit_appointment" type="button" value="Edit">
                        <input class="btn btn-danger" id="delete_appointment" type="button" value="Delete">
                    </form>
                </div>
            </div>
        </div>
</div>
</body>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js">
</script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

</html>
