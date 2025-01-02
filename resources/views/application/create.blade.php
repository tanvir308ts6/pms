<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <style>
    /* all */
    @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap");

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: "Poppins", sans-serif;
    }

    :root {
        --main-blue: #71b7e6;
        --main-purple: #9b59b6;
        --main-grey: #ccc;
        --sub-grey: #d9d9d9;
    }

    body {
        display: flex;
        height: 100vh;
        justify-content: center;
        /*center vertically */
        align-items: center;
        /* center horizontally */
        background: linear-gradient(135deg, var(--main-blue), var(--main-purple));
        padding: 10px;
    }

    /* container and form */
    .container {
        max-width: 700px;
        width: 100%;
        background: #fff;
        padding: 25px 30px;
        border-radius: 5px;
    }

    .container .title {
        font-size: 25px;
        font-weight: 500;
        position: relative;
    }

    .container .title::before {
        content: "";
        position: absolute;
        height: 3.5px;
        width: 30px;
        background: linear-gradient(135deg, var(--main-blue), var(--main-purple));
        left: 0;
        bottom: 0;
    }

    .container form .user__details {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        margin: 20px 0 12px 0;
    }

    /* inside the form user details */
    form .user__details .input__box {
        width: calc(100% / 2 - 20px);
        margin-bottom: 15px;
    }

    .user__details .input__box .details {
        font-weight: 500;
        margin-bottom: 5px;
        display: block;
    }

    .user__details .input__box input {
        height: 45px;
        width: 100%;
        outline: none;
        border-radius: 5px;
        border: 1px solid var(--main-grey);
        padding-left: 15px;
        font-size: 16px;
        border-bottom-width: 2px;
        transition: all 0.3s ease;
    }

    .user__details .input__box input:focus,
    .user__details .input__box input:valid {
        border-color: var(--main-purple);
    }

    /* inside the form gender details */

    form .gender__details .gender__title {
        font-size: 20px;
        font-weight: 500;
    }

    form .gender__details .category {
        display: flex;
        width: 80%;
        margin: 15px 0;
        justify-content: space-between;
    }

    .gender__details .category label {
        display: flex;
        align-items: center;
    }

    .gender__details .category .dot {
        height: 18px;
        width: 18px;
        background: var(--sub-grey);
        border-radius: 50%;
        margin: 10px;
        border: 5px solid transparent;
        transition: all 0.3s ease;
    }

    #dot-1:checked~.category .one,
    #dot-2:checked~.category .two,
    #dot-3:checked~.category .three {
        border-color: var(--sub-grey);
        background: var(--main-purple);
    }

    form input[type="radio"] {
        display: none;
    }

    /* submit button */
    form .button {
        height: 45px;
        margin: 45px 0;
    }

    form .button input {
        height: 100%;
        width: 100%;
        outline: none;
        color: #fff;
        border: none;
        font-size: 18px;
        font-weight: 500;
        border-radius: 5px;
        background: linear-gradient(135deg, var(--main-blue), var(--main-purple));
        transition: all 0.3s ease;
    }

    form .button input:hover {
        background: linear-gradient(-135deg, var(--main-blue), var(--main-purple));
    }

    @media only screen and (max-width: 584px) {
        .container {
            max-width: 100%;
        }

        form .user__details .input__box {
            margin-bottom: 15px;
            width: 100%;
        }

        form .gender__details .category {
            width: 100%;
        }

        .container form .user__details {
            max-height: 300px;
            overflow-y: scroll;
        }

        .user__details::-webkit-scrollbar {
            width: 0;
        }
    }
    </style>
</head>

<body>
    <div class="container" style=" margin-bottom:-100px;">
        <div class="title">Visit Application</div>
        <form action="{{ route('application.store') }}" method="POST">
            @csrf
            <div class="user__details">
                <div class="input__box" style="width:100%;">
                    <span class="details">Full Name</span>
                    <input type="text" name="full_name" placeholder="E.g: Rafiqul Islam" required>
                </div>
                <div class="input__box">
                    <span class="details">Age</span>
                    <input type="number" name="age" placeholder="" required>
                </div>
                <div class="input__box">
                    <span class="details">Email</span>
                    <input type="email" name="email" placeholder="johnsmith@hotmail.com" required>
                </div>
                <div class="input__box">
                    <span class="details">Phone Number</span>
                    <input type="tel" name="phone_number" pattern="01[3-9][0-9]{8}" placeholder="01712345678"
                        title="Please enter a valid (Bangladeshi) phone number (e.g., 01712345678)" required>
                </div>
                <div class="input__box">
                    <span class="details">PIN No</span>
                    <input type="number" name="pin_no" placeholder="" required>
                </div>
                <div class="input__box">
                    <span class="details">Relation</span>
                    <input type="text" name="relation" placeholder="E.g: Rafiqul Islam" required>
                </div>
                <div class="input__box">
                    <span class="details">NID/Birth Certificate No</span>
                    <input type="text" name="nid_or_birth_certificate_no" placeholder="E.g: Rafiqul Islam" required>
                </div>
                <input type="hidden" name="role_id" value="5" required>
                <input type="hidden" name="status" value="" required>
            </div>
            <div class="gender__details">
                <input type="radio" name="gender" value="Male" id="dot-1">
                <input type="radio" name="gender" value="Female" id="dot-2">
                <span class="gender__title">Gender</span>
                <div class="category">
                    <label for="dot-1">
                        <span class="dot one"></span>
                        <span>Male</span>
                    </label>
                    <label for="dot-2">
                        <span class="dot two"></span>
                        <span>Female</span>
                    </label>
                </div>
            </div>
            <div class="button">
                <input type="submit" value="Register">
            </div>

        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    @if(Session::has('success'))
    <script>
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-top-right", // Set the position to top-right
        "timeOut": "13000", // Notification timeout in milliseconds
    }
    toastr.success("{{ Session('success') }}", 'Success!');
    </script>
    @endif

    @if($errors->any())
    <script>
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-top-right", // Set the position to top-right
        "timeOut": "13000",
    }
    toastr.error("{{implode('', $errors->all(':message'))}}", 'Warning!');
    </script>
    @endif
</body>

</html>