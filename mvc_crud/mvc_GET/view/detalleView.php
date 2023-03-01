<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Example PHP+PDO+POO+MVC</title>
        <link href="view/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="view/bootstrap.bundle.js"></script>
        <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <style>
            input{
                margin-top:5px;
                margin-bottom:5px;
            }
            .right{
                float:right;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-lg-5 mx-auto">
                    <form action="index.php?controller=employees&action=actualizar" method="get">
                        <h3>User detail</h3>
                        <hr/>
                        <input type="hidden" name="id" value="<?php echo $datos["employee"]['id'] ?>"/>
                        Name: <input type="text" name="Name" value="<?php echo $datos["employee"]['Name'] ?>" class="form-control"/>
                        Surname: <input type="text" name="Surname" value="<?php echo $datos['employee']['Surname'] ?>" class="form-control"/>
                        Email: <input type="text" name="email" value="<?php echo $datos['employee']['email'] ?>" class="form-control"/>
                        phone: <input type="text" name="phone" value="<?php echo$datos['employee']['phone'] ?>" class="form-control"/>
                        <input type="text" class="d-none form-control" name="controller" value="employees">
                        <input type="text" class="d-none form-control" name="action" value="actualizar">
                        <input type="submit" value="Send" class="btn btn-success"/>
                    </form>
                    <a href="index.php" class="btn btn-info">Return</a>
                </div>
            </div>
        </div>
    </body>
</html>