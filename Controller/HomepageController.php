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



        if (isset($_POST['customers'])){
            $groupID = $_POST['customers'];
        }else {
            $groupID = "";

        }

        if (isset($_POST['product'])){
            $originalPrice = $_POST['product'];
        } else {
            $originalPrice = "";
        }

        $groupArray = [];


        // groupId in this case refers to the group ID, which we know from user input (group id is linked).
        // groupsArray refers to the associative array which we converted from groups.json (we named it $groupData some previous lines)
        function findGroup ($groupId, $groupsArray)
        {
            foreach ($groupsArray as $group) {
                if ($group['id'] == $groupId) {
                    return $group;
                }
            }
        }



        // Using the findGroup function which returns a single group, which the user belongs to
        // we find other groups, which are linked together.
        while ($groupID !== null)
        {
            $groupsChain = findGroup($groupID, $groupData);

            array_push($groupArray,$groupsChain);
            if (isset($groupsChain['group_id']))
            {
                // If the current group over which we are looping has a group ID
                // we override the groupID variable with the new groupID of the former group.
                $groupID = $groupsChain['group_id'];
            }
            else
            {
                $groupID = null;
            }
        }


        for ($i = 0; count($CustomerData) > $i; $i++) {
            $User[$i] = new User($CustomerData[$i]['name'], strval($CustomerData[$i]['id']), strval($CustomerData[$i]['group_id']));
        }

        for ($i = 0; count($ProductData) > $i; $i++) {
            $Product[$i] = new Products($ProductData[$i]['name'], strval($ProductData[$i]['id']), strval($ProductData[$i]['description']), strval($ProductData[$i]['price']));
        }
        var_dump($groupArray);




        require 'View/homepage.php';
    }
}

