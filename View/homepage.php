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

<?php require 'includes/header.php'; ?>

<section>
    <form action="" method="post">
        <label for="customers">Choose a customer</label>

        <select id="customers" name="customers">
            <?php for ($i = 0; count($User) > $i; $i++) : ?>
                <option value="<?php echo $User[$i]->getGroupId(); ?>"><?php echo $User[$i]->getName(); ?></option>
            <?php endfor ?>
        </select>
    </br></br></br></br>
        <label for="customers">Choose a product</label>

        <select id="products" name="product">
            <?php for ($i = 0; count($Product) > $i; $i++) : ?>
                <option value="<?php echo $Product[$i]->getPrice(); ?>" name="products"><?php echo $Product[$i]->getName(); ?></option>
            <?php endfor ?>
        </select>
        <button id="run" type="submit" name="submit">SEARCH</button>
    </form>

    <section>
        <img src="https://i.imgur.com/iX4XaUQ.png" height="130 px;">
    </section>

    <p>€<?php echo $originalPrice ?? "" ?></p>


    <p>Put your content here.</p>
</section>
<?php require 'includes/footer.php' ?>
</body>
</html>