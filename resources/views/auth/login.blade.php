<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Repeat Inspired</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Inter:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        .vertical-line {
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            width: 2px;
            background-color: rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body class="bg-repeatblack font-body antialiased text-gray-300">
    <div class="min-h-screen flex p-4 sm:p-6 lg:p-8"> <!-- Added padding to the main flex container -->
        <div class="w-1/2 bg-repeatyellow p-20 flex flex-col justify-center relative rounded-xlarge"> <!-- Rounded corners here -->
            <div class="vertical-line"></div>
            <div class="mb-12">
                <h1 class="font-display text-6xl font-bold text-repeatblack leading-tight mb-8">
                    Welcome back to <span class="text-repeatblack">Repeat</span>.
                </h1>
                <ul class="font-body text-lg text-repeatblack leading-relaxed list-none space-y-3"> <!-- Using a list for points -->
                    <li class="flex items-center">
                        <svg class="h-5 w-5 mr-2 text-repeatblack flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path></svg>
                        Fresh Content Updates
                    </li>
                    <li class="flex items-center">
                        <svg class="h-5 w-5 mr-2 text-repeatblack flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path></svg>
                        Product Restock Alerts
                    </li>
                    <li class="flex items-center">
                        <svg class="h-5 w-5 mr-2 text-repeatblack flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path></svg>
                        Manage Subscriptions Easily
                    </li>
                </ul>
            </div>
            <div class="text-sm text-repeatblack mt-auto">
                © 2023 Repeat Inc. All rights reserved.
            </div>
        </div>
        <div class="w-1/2 bg-repeatblack flex items-center justify-center p-16">
            <div class="max-w-md w-full space-y-12">
                <div class="text-center">
                    <h2 class="text-4xl font-bold text-repeatyellow font-display">
                        Sign in
                    </h2>
                    <p class="mt-4 text-gray-400">
                        Stay updated with your favorite brands.
                    </p>
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li class="text-red-500">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form class="space-y-8" action="{{ route('login') }}" method="POST">
                    @csrf
                    <input type="hidden" name="remember" value="true">
                    <div class="space-y-6">
                        <div>
                            <label for="email-address" class="block text-sm font-medium text-gray-300">Email address</label>
                            <div class="mt-1">
                                <input id="email-address" name="email" type="email" autocomplete="email" required class="appearance-none block w-full px-3 py-2 border border-gray-700 rounded-md shadow-sm placeholder-gray-500 focus:outline-none focus:ring-repeatyellow focus:border-repeatyellow sm:text-sm bg-repeatblack text-gray-300">
                            </div>
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-300">Password</label>
                            <div class="mt-1">
                                <input id="password" name="password" type="password" autocomplete="current-password" required class="appearance-none block w-full px-3 py-2 border border-gray-700 rounded-md shadow-sm placeholder-gray-500 focus:outline-none focus:ring-repeatyellow focus:border-repeatyellow sm:text-sm bg-repeatblack text-gray-300">
                            </div>
                        </div>
                    </div>


                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input id="remember-me" name="remember-me" type="checkbox" class="h-4 w-4 text-repeatyellow focus:ring-repeatyellow border-gray-700 rounded">
                            <label for="remember-me" class="ml-2 block text-sm text-gray-400">
                                Remember me
                            </label>
                        </div>

                        <div class="text-sm">
                            <a href="#" class="font-medium text-repeatyellow hover:underline">
                                Forgot password?
                            </a>
                        </div>
                    </div>

                    <div>
                        <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-base font-medium text-repeatblack bg-repeatyellow hover:bg-yellow-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
                            Sign in
                        </button>
                    </div>
                </form>
                <div class="text-sm text-gray-400 text-center">
                    Don't have an account? <a href="/register" class="font-medium text-repeatyellow hover:underline">Sign up</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>