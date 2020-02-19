<?php
declare(strict_types=1);


class User
{
    private $name;
    private $id;
    private $group_id;
    private $groupChain;
    private $fixedDiscount;
    private $variableDiscount;


    public function __construct(string $name, string $id, string $group_id)
    {
        $this->name = $name;
        $this->id = $id;
        $this->group_id = $group_id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getGroupId(): string
    {
        return $this->group_id;
    }

    public function setGroupChain($groupChain)
    {
        $this->groupChain = $groupChain;
    }

    public function calculatePrice($price)
    {
        $totalVariableDisc = [];
        foreach ($this->groupChain as $group){
            if (isset($group['fixed_discount'])){
                $this->fixedDiscount += $group['fixed_discount'];
            } else {
                array_push($totalVariableDisc, $group['variable_discount']);
                $this->variableDiscount = max($totalVariableDisc);
            }
        }
        $newPrice = ($price - $this->fixedDiscount)*(1-(($this->variableDiscount/100)));
        if ($newPrice < 0){
            $newPrice = 0;
        }
        return $newPrice;
    }
}

class Products
{
    private $id;
    private $name;
    private $description;
    private $price;

    public function __construct(string $name, string $id, string $description, string $price)
    {
        $this->name = $name;
        $this->id = $id;
        $this->description = $description;
        $this->price = $price;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getPrice()
    {
        return $this->price;
    }


}

class Group
{

    private $id;
    private $name;
    private $discount;
    private $discountType;
    private $group_id;
    public $groupChain = [];

    public function __construct(string $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getDiscount()
    {
        return $this->discount;
    }

    public function getGroupId()
    {
        return $this->group_id;
    }

    public function setGroupId($inputGroupID)
    {
        $this->group_id = $inputGroupID;
    }

    public function setDiscountType($typeOfDiscount)
    {
        $this->discountType = $typeOfDiscount;
    }

    public function setDiscountAmount($discountAmount)
    {
        $this->discount = $discountAmount;
    }

    public function getGroup($inputID, $groupsArray)
    {
        if (isset($this->group_id)){
            foreach ($groupsArray as $group){
                if ($group['id'] == $inputID){
                    array_push($this->groupChain, $group);
                    return $group;
                }
            }
        }
    }

    public function getChain($inputGroupId, $groupDataArray)
    {
        while ($inputGroupId !== null) {
            $groupsChain = $this->getGroup($inputGroupId, $groupDataArray);

            if (isset($groupsChain['group_id'])) {
                // If the current group over which we are looping has a group ID
                // we override the groupID variable with the new groupID of the former group.
                $inputGroupId = $groupsChain['group_id'];
            } else {
                $inputGroupId = null;
            }
        }
    }
}

