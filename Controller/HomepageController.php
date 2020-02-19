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


        if (isset($_POST['customers'])) {
            $groupID = $_POST['customers'];
        } else {
            $groupID = "";
        }

        if (isset($_POST['product'])) {
            $originalPrice = $_POST['product'];
        } else {
            $originalPrice = "";
        }

        for ($i = 0; count($ProductData) > $i; $i++) {
            $Product[$i] = new Products($ProductData[$i]['name'], strval($ProductData[$i]['id']), strval($ProductData[$i]['description']), strval($ProductData[$i]['price']));
        }

        for ($i = 0; count($groupData) > $i; $i++) {
            $Group[$i] = new Group(strval($groupData[$i]['id']), $groupData[$i]['name']);
        }
        for ($i = 0; count($CustomerData) > $i; $i++) {
            $User[$i] = new User($CustomerData[$i]['name'], strval($CustomerData[$i]['id']), strval($CustomerData[$i]['group_id']));
        }


        for ($i = 0; count($groupData) > $i; $i++) {
            if (isset($groupData[$i]['group_id'])) {
                $Group[$i]->setGroupId($groupData[$i]['group_id']);
            }
            if (isset($groupData[$i]['fixed_discount'])){
                $Group[$i]->setDiscountType("fixed_discount");
            } else {
                $Group[$i]->setDiscountType("variable_discount");
            }
            if (isset($groupData[$i]['fixed_discount'])){
                $Group[$i]->setDiscountAmount($groupData[$i]['fixed_discount']);
            } else {
                $Group[$i]->setDiscountAmount($groupData[$i]['variable_discount']);

            }
        }

//        var_dump($groupID);
        $userGroupChain = [];
        for ($i = 0; count($User) > $i; $i++) {

            $Group[$i]->getChain($i, $groupData);
            array_push($userGroupChain, $Group[$i]->groupChain);
            $User[$i]->setGroupChain($userGroupChain[$i]);
        }
        var_dump($User[1]);

        var_dump($User[1]->calculatePrice($originalPrice));



        require 'View/homepage.php';
    }
}

