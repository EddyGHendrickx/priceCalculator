<?php

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
