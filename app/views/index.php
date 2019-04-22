<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Weather App</title>
</head>
<body>
    <div class="container card card-body bg-light mt-5 text-center">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <h1>Weather App</h1>           
                <form action="<?php echo URLROOT; ?>/pages/index">
                    <div class="form-group">
                        <label for="city">Enter city name: </label>
                        <div class="row">
                            <input class="col-lg-10 form-control form-control-lg 
                            <?php echo(!empty($data['error']) ? 'is-invalid' : '');?>"
                            name="city" pattern="[A-Za-z]{1,}" type="text" value="<?php echo(isset($_POST['city'])) ? $_POST['city'] : $data['city']; ?>" >
                            <button class="btn btn-success" type="submit">Go</button> 
                            <span class="invalid-feedback"><?php echo $data['error']; ?></span>

                        </div>                      
                    </div>
                </form>
                <!-- Show temperature and save button, if data is present -->
                <?php if(!empty($data['city']) && !empty($data['temp']) && empty($data['error'])) : ?>
                    <?php echo "<p>Current temperature in " . $data['city']. ": ".$data['temp']."&degC </p>"; ?>
                    <?php if(isset($_GET['city'])) : ?>
                    <form action="<?php echo URLROOT; ?>/pages/index" method="post">
                        <input type="" name="city" value="<?php echo $data['city']; ?>" hidden="true">
                        <input type="submit" class="btn btn-success" value="save as preferred city">
                    </form>
                    <?php endif ?>
                <?php endif ?>
            </div>
        </div>
    </div>
</body>
</html>