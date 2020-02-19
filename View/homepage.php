<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel='stylesheet' type='text/css' href='/View/style.css' />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Becode - Boiler plate MVC</title>

</head>
<body>

<?php require 'includes/header.php'; ?><section>
    
</section>
<section>
    <form action="" method="post">
        <br><br>
        <img id="people" src="https://i.imgur.com/je9MiHp.png" height="170px" alt="customer">
        <br><br>
        <label for="customers">Choose a customer</label>
        <select id="customers" name="customers">
            <?php for ($i = 0; count($User) > $i; $i++) : ?>
                <option value="<?php echo $User[$i]->getId(); ?>"><?php echo $User[$i]->getName(); ?></option>
            <?php endfor ?>
        </select>

    <br><br><br>
        <img src="https://i.imgur.com/SP6iPPN.png" height="130px" alt="">
        <br><br>
        <label for="customers">Choose a product</label>

        <select id="products" name="product">
            <?php for ($i = 0; count($Product) > $i; $i++) : ?>
                <option value="<?php echo $Product[$i]->getPrice(); ?>" name="products"><?php echo $Product[$i]->getName(); ?></option>
            <?php endfor ?>
        </select>
        <br><br><br>
        <button id="run" type="submit" name="submit">SEARCH</button>
    </form>


    <p>The original price is: €<?php echo $originalPrice ?? "" ?></p>
    <p> You pay (discounted price): €<?php echo $priceAfterDiscount ?? "" ?></p>

<!--    --><?php
//     echo $originalPrice ?? ""  AKA:


//    if (isset($originalPrice)){
//        echo $originalPrice;
//    } else {
//        echo "";
//    }

    ?>


    <p>Thank you for shopping with us!</p>
</section>
<br>
<br>

<?php require 'includes/footer.php' ?>
</body>
</html>