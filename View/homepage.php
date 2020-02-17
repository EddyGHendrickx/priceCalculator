<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Becode - Boiler plate MVC</title>
</head>
<body>

<?php require 'includes/header.php'; ?>

<section>
    <h4>Hello <?php echo $User[6]->getGroupId() ?>,</h4>
    <form action="" method="post">
        <label for="customers">Choose a customer</label>

        <select id="customers">
            <?php echo $CustomerData ?>
            <?php for ($i = 0; count($CustomerData) > $i; $i++) : ?>
                <option value="<?php $CustomerData[$i]['name'] ?>"><?php echo $CustomerData[$i]['name'] ?></option>
            <?php endfor ?>
        </select>
        <button id="run" name="run">SEARCH</button>
    </form>
    <p>Put your content here.</p>
</section>
<?php require 'includes/footer.php' ?>
</body>
</html>