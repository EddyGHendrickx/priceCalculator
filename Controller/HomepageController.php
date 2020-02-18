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

        $jsonCustomer = file_get_contents('JSON/customers.json');
        $CustomerData = json_decode($jsonCustomer, true);
        $jsonGroup = file_get_contents('JSON/groups.json');
        $groupData = json_decode($jsonGroup, true);
        $jsonProduct = file_get_contents('JSON/products.json');
        $ProductData = json_decode($jsonProduct, true);

        for ($i = 0; count($CustomerData) > $i; $i++) {
            $User[$i] = new User($CustomerData[$i]['name'], strval($CustomerData[$i]['id']), strval( $CustomerData[$i]['group_id']));
        }

        for ($i = 0; count($ProductData) > $i; $i++) {
            $Product[$i] = new Products($ProductData[$i]['name'], strval($ProductData[$i]['id']), strval($ProductData[$i]['description']), strval($ProductData[$i]['price']));
        }

//        for ($i = 0; count($groupData) > $i; $i++) {
//            $Group[$i] = new Group(strval($groupData[$i]['id']), strval($groupData[$i]['name']), strval($groupData[$i]['discount']), strval($groupData[$i]['group_id']));
//        }



        $groupID = $_POST['customers'] ;
        $originalPrice = $_POST['product'];



        require 'View/homepage.php';
    }
}

