<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        /* Base styles for the sidebar */
        .sidebar {
            height: 100%;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #333;
            overflow-x: hidden;
            transition: 0.3s;
            padding-top: 60px;
        }

        /* Style for the sidebar links */
        .sidebar a {
            padding: 15px 20px;
            text-decoration: none;
            font-size: 18px;
            color: #f2f2f2;
            display: block;
            transition: 0.3s;
        }

        /* Hover effect for sidebar links */
        .sidebar a:hover {
            background-color: #555;
        }

        /* Close button for small screens */
        .closebtn {
            position: absolute;
            top: 0;
            right: 25px;
            font-size: 36px;
            margin-left: 50px;
        }

        /* Responsive design for small screens */
        @media screen and (max-height: 450px) {
            .sidebar {padding-top: 15px;}
            .sidebar a {font-size: 16px;}
        }
        .fa-solid{
            margin-right:1rem;
        }
        .fa-regular{
            margin-right:1rem;
        }
        a{
            margin-top:1rem;
        }
        img, video {
    max-width: 100%;
    height: auto;
    margin-top: -4rem;
}
    </style>
</head>
<body>

<div class="sidebar">
<img src="{{asset('image/landing-page.jpg')}}" alt="">
    <a href="home"><i class="fa-solid fa-table-columns"></i>Dashboard</a> 
    <a href="/profile"> <i class="fa-regular fa-pen-to-square"></i>Update Info</a>
    <!-- <a href="/apply-leave"> <i class="fa-regular fa-pen-to-square"></i>Apply Leave</a> -->

    <form method="POST" action="{{ route('logout') }}">
        @csrf

        <x-dropdown-link :href="route('logout')"
                onclick="event.preventDefault();
                            this.closest('form').submit(); "> <i class="fa-solid fa-right-from-bracket"></i>
            {{ __('Log Out') }}
        </x-dropdown-link>
    </form>
</div>



</body>
</html>