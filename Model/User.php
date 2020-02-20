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


