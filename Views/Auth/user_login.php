<?php 
    include_once("../Layouts/header.php");

    function getIPAddress() {
        // Get IP address from REMOTE_ADDR server variable
        if (!empty($_SERVER['REMOTE_ADDR'])) {
            return $_SERVER['REMOTE_ADDR'];
        } else {
            return 'UNKNOWN';
        }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>login</title>


    <!-- favicon -->
    <link href="assets/images/favicon.ico" rel="shortcut icon">

    <!-- Main Css -->
    <link href="assets/css/style.css" rel="stylesheet" type="text/css">
</head>

<body>
    <!-- =========== Main Section Start =========== -->
    <section class="h-screen w-full">
        <div class="grid xl:grid-cols-2 grid-cols-1 h-full">
            <div class="max-w-lg mx-auto w-full flex flex-col justify-center md:items-start items-center p-6">
                <div class="md:text-start text-center mb-7">
                    <a href="index.html" class="grow block mb-8">
                        <!--    <img class="h-8 md:mx-0 mx-auto" src="assets/images/light-logo.png" alt="images"> -->
                    </a>

                    <div class="md:text-start text-center">
                        <h3 class="text-2xl font-semibold text-dark mb-3">Welcome to LMS</h3>
                        <!-- <p class="text-base font-medium text-light">Welcome back! Select method to sign up</p> -->
                    </div>
                </div>

                <form class="text-start w-full" action="login_validation.php" method="post">
                    <!-- <div class="flex md:justify-between justify-center items-center mb-8 md:gap-9 gap-2">
                        <button type="submit" class="w-full inline-flex items-center justify-center px-6 gap-4 py-2.5 font-medium backdrop-blur-2xl border border-gray-300 bg-white text-dark rounded-md transition-all duration-500">
                            <img src="assets/images/google.png" alt="" class="max-w-5 h-5 text-dark ">Google
                        </button>
                        <button type="submit" class="w-full inline-flex items-center justify-center px-6 gap-4 py-2.5 font-medium backdrop-blur-2xl border border-gray-300 bg-white text-dark rounded-md transition-all duration-500 group"><img src="assets/images/facebook.png" alt="" class="max-w-5 h-5 text-dark">Facebook</button>
                    </div>    -->

                    <div class="mb-4">
                        <label for="email" class="block text-base font-semibold text-dark mb-2">Email address</label>
                        <input id="email" class="block w-full rounded-md py-2.5 px-4 text-dark text-base font-medium border-gray-300 focus:gray-300 focus:border-primary focus:outline-0 focus:ring-0 placeholder:text-light placeholder:text-base" type="email" placeholder="Enter your email" name="email" required>
                    </div>

                    <div class="mb-4">
                        <label for="password" class="block text-base font-semibold text-dark mb-2">Password</label>
                        <div class="flex">
                            <input type="password" id="password" class="form-password text-dark text-base font-medium block w-full rounded-s-md py-2.5 px-4 border border-gray-300 focus:gray-300 focus:border-primary focus:outline-0 focus:ring-0 placeholder:text-light placeholder:text-base" placeholder="Enter your password" name="password" required>
                            <button type="button" data-hs-toggle-password='{"target": "#password-addon"}' class="inline-flex items-center justify-center py-2.5 px-4 border rounded-e-md -ms-px border-gray-300">
                                <i class="hs-password-active:hidden h-5 w-5 text-dark" data-lucide="eye"></i>
                                <i data-lucide="eye-off" class="hidden hs-password-active:block h-5 w-5 text-dark"></i>
                            </button>
                        </div>
                    </div>

                    <div class="flex justify-between items-center flex-wrap gap-x-1 gap-y-2 mb-6 mt-3">
                        <div class="inline-flex items-center">
                            <input type="checkbox" id="checkbox-signin" class="h-4 w-4 text-base rounded border-gray-300 text-dark focus:ring focus:ring-default-950/30 focus:ring-offset-0">
                            <label class="text-base ms-2 text-light font-medium align-middle select-none" for="checkbox-signin">Remember me</label>
                        </div>
                        <!-- <a href="auth-recoverpw.html" class="text-base text-dark"><small>Forgot your password?</small></a> -->
                    </div>

                    <div class="text-center mb-7">
                    <input type="hidden" name="type" value="user">
                        <button type="submit" class="w-full inline-flex items-center justify-center px-6 py-2.5 bg-primary font-bold text-base text-white rounded-md transition-all duration-500" type="submit" name="submit">Log In</button>
                    </div>

                    <p class="shrink text-light text-center">Don't have an account ?<a href="../registration/register.php" class="text-dark font-semibold ms-1"><b>Register</b></a>/<a href="../guest/all_books.php" class="text-dark font-semibold ms-1"><b>Guest</b></a></p>
                    <p class="shrink text-light text-center"></p>
                                   </form>
            </div>

            <div class="hidden xl:block">
                <div class="relative w-full h-screen bg-[url(../images/01.jpg)] bg-center bg-cover"></div>
            </div>
        </div>

    </section>
    <!-- =========== Main Section End =========== -->
    
    <!-- Preline Js -->
    <script src="assets/libs/preline/preline.js" ></script>

    <!-- Lucide Js -->
    <script src="assets/libs/lucide/umd/lucide.min.js" ></script>

    <!-- Main App Js -->
    <script src="assets/js/app.js" ></script>

    </body>
</html>
