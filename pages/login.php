<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        
        <title>Login</title>
        <link href="../css/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>
        <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="../css/estilo.css" rel="stylesheet" type="text/css"/>
        <link href="../css/login.css" rel="stylesheet" type="text/css"/>
        <link rel="shortcut icon" href="../img/icono_1.png" type="image/png"/>
    </head>
    <body>

        <header>
            <div>
                <nav class="navbar navbar-blue navbar-fixed-top" role="navigation" style="background: #428bca">
                    <div class="navbar-header">
                        <a class="navbar-brand" style="color: white;" href="principal.php">DEPARTAMENTO DE TECNOLOGIAS DE LA INFORMACION</a>
                    </div>
                </nav>
            </div>
        </header>

        <section>
            <div class="container">
                <div class="card card-container">
                    <form class="form-signin" id="frmLogin">
                        <h3>CREDENCIALES DE ACCESO</h3>
                        <label id="_iderror"></label>

                        <fieldset>
                            <label>Usuario</label>
                            <input type="text" id="usuario" name="usuario" class="form-control" placeholder="Usuario" required="true" autofocus>
                            <label>Clave</label>
                            <input type="password" id="contrasena" name="contrasena" class="form-control" placeholder="Clave" required="true">               
                        </fieldset>

                        <button id="btnLogin" class="btn btn-lg btn-primary btn-block btn-signin" type="submit">
                            <span id="loading" class="glyphicon glyphicon-log-in"></span>
                            <span id="caption">Iniciar Session</span>
                        </button>
                    </form>                 
                </div>
            </div>
        </section>
        <?php include "./principalfooter.php" ?>
        
        <script src="../lib/jquery-2.2.4.min.js" type="text/javascript"></script>
        <script src="../js/bootstrap.min.js" type="text/javascript"></script>

        <script>
            $(function () {
                $('#frmLogin').on({
                    submit: function () {
                        $.ajax({
                            url: "loginopc.php",
                            data: $(this).serialize(),
                            type: 'POST',
                            dataType: 'json',
                            success: function (data, textStatus, jqXHR) {
                                if (data.ok == true) {
                                    window.location = data.url;
                                } else {
                                    $('#_iderror').html('credenciales incorrectas');
                                }
                            },
                            error: function (jqXHR, textStatus, errorThrown) {
                                console.log(textStatus);
                                console.log(jqXHR);
                                alert(errorThrown);
                            }
                        });
                        return false;
                    }
                });
            });
        </script>
    </body>
</html>
