<?php
declare(strict_types=1);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);


class HomepageController
{
    //render function with both $_GET and $_POST vars available if it would be needed.
    public function render(array $GET, array $POST)
    {
        //this is just example code, you can remove the line below

        //you should not echo anything inside your controller - only assign vars here
        // then the view will actually display them.

        //load the view

        $json = file_get_contents('JSON/customers.json');
        $CustomerData = json_decode($json, true);

        $json = file_get_contents('JSON/products.json');
        $ProductData = json_decode($json, true);

        for ($i = 0; count($CustomerData) > $i; $i++) {
            $User[$i] = new User($CustomerData[$i]['name'], strval($CustomerData[$i]['id']), strval( $CustomerData[$i]['group_id']));
        }

        for ($i = 0; count($ProductData) > $i; $i++) {
            $Product[$i] = new Products($ProductData[$i]['name'], strval($ProductData[$i]['id']), strval($ProductData[$i]['description']), strval($ProductData[$i]['price']));
        }

        if (!isset($_POST['products'])){
           $_POST['products'] = "test";
        } else {
            var_dump($_POST['products']);

        }
        if (!isset($_POST['customers'])){
            $_POST['customers'] = "test";
        } else {
            var_dump($_POST['customers']);
        }
        if (!isset($_POST['submit'])){
            $_POST['submit'] = "test";
        } else {
            var_dump($_POST['submit']);
        }


        require 'View/homepage.php';
    }
}

