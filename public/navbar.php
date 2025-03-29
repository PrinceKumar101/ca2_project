<?php
$nav_links = ["Home" => "home", "About" => "about", "Weather"=>"weather", "Contact" => "contact", "Sign In" => "login"];
$logged_in = true;
$nav_links_iflogged = ["Farming Advisory" => "farming_advisory","Dashboard" => "dashboard" ,"Logout" => "logout"];
$isLoggedIn = isset($_SESSION["loggedIn"])? $_SESSION["loggedIn"] : null;


?>
<nav class="bg-inhert text-inhert text-lg">
    <div class="flex items-center justify-between p-4">
        <a href="#" class="text-3xl font-bold ml-10">Brand</a>

        <button class="md:hidden burger text-white focus:outline-none">
            ☰
        </button>

        <ul class="hidden md:flex md:space-x-4 gap-3 menu">

            <?php

            foreach ($nav_links as $items => $items_link) {
                echo "
                <li class='hover:scale-105 rounded-lg'>
                    <div class='relative p-1 rounded bg-transparent backdrop:blur-2xl'>
                        <a href='?page=$items_link' class='hover:text-gray-400 capitalize hover:duration-300 " . (($page == $items_link) ? 'text-orange-500 p-1 hover:scale-105 hover:text-rose-500 underline underline-offset-6' : '') . "'>
                            <span class='absolute inset-0'></span>
                            $items
                            </a>
                        </div>
                    
                </li>
                ";

                
            }

            ?>
        </ul>

    </div>
</nav>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Burger Menu Toggle
        const burger = document.querySelector('.burger');
        const menu = document.querySelector('.menu');

        burger.addEventListener('click', function() {
            menu.classList.toggle('hidden');
        });


    });
</script>