<?php

    if (!function_exists('globalImageURL')) 
    { 
         function globalImageURL()
        {
            
            return 'assets/img/';
        }
    }


    if (!function_exists('siteLogo')) 
    { 
        function siteLogo() 
        { 
            return 'assets/img/icons/logo.svg';
        } 
    }


    if (!function_exists('imageExtensions')) 
    { 
        function imageExtensions() 
        { 
            return ['jpg', 'jpeg', 'png', 'gif', 'bmp','svg'];
        } 
    }

    if (!function_exists('servicesShowLimit')) 
    { 
        function servicesShowLimit() 
        { 
            return 6;
        } 
    }

    if (!function_exists('featuredServicesShowLimit')) 
    { 
        function featuredServicesShowLimit() 
        { 
            return 4;
        } 
    }

    if (!function_exists('storeImage')) 
    {
        function storeImage($imageFile, $folderName, $imageName)
        {
            //$destinationPath = public_path('storage/'.$folderName);
            $destinationPath = base_path('../public_html/storage/'.$folderName);
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true); // recursive create
            }

             $imageFile->move($destinationPath, $imageName);
        }


    }