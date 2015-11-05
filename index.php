<!DOCTYPE html>
<html lang="pt-br" ng-app="myApp">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Aniversários</title>

        <!-- Bootstrap -->
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <link href="css/bootstrap-datepicker.css" rel="stylesheet">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <style type="text/css">
            .row-centered {
                text-align:center;
            }    
        </style>
    </head>
    <body>

        <div class="container">

            <div class="panel panel-default">

                <div class="panel-heading">

                    <h2 class="panel-title">Lista de Mailing</h2>

                </div>

                <div class="panel-body" ng-controller="Mailing as mailingCtrl">

                    <div class="row">
                        
                        <div class="col-sm-6 col-md-offset-2">
                                  <!--
                                  action="controller.php"
                                  method="post"
                                  -->
                            <form class="form-horizontal"
                                  id="frmAniversarios"
                                  name="frmAniversarios"
                                  ng-submit="mailingCtrl.listar()">

                                <div class="form-group">

                                    <label class="col-sm-4 text-right" for="site">Site</label>

                                        <div class="col-sm-8">

                                            <select ng-model="mailingCtrl.cliente.site" class="form-control" id="site" name="site" required>

                                                <option value="">Selecione um site</option>

                                                <option value="1">Alltrends</option>

                                                <option value="2">EshopSobral</option>                                                

                                                <option value="3">Lenny</option>

                                                <option value="4">Nidas</option>

                                                <option value="5">QueridoPetShop</option>

                                            </select>

                                        </div>

                                </div>

                                <div class="form-group">

                                    <label class="col-sm-4 text-right" for="">Tipo</label>

                                    <div class="col-sm-8">                                

                                        <select ng-model="mailingCtrl.cliente.tipoData" class="form-control" id="tipo" name="tipo" required>

                                            <option value="">Selecione o tipo de periodo</option>

                                            <option value="1">Data de Cadastro</option>

                                            <option value="2">Data de Aniversario</option>

                                        </select>

                                    </div>                      

                                </div>

                                <div class="form-group">

                                    <label class="col-sm-4 text-right" for="">Período</label>

                                    <div class="col-sm-8">

                                        <div class="input-group">

                                            <input ng-model="mailingCtrl.cliente.data_inicio" class="form-control" id="data_inicio" type="text" name="data_inicio" required>

                                            <span class="input-group-addon"> até </span>

                                            <input ng-model="mailingCtrl.cliente.data_fim" class="form-control" id="data_fim" type="text" name="data_fim" required>

                                        </div>

                                    </div>

                                </div>

                                <div class="form-group">
                                    
                                    <div class="col-sm-12 text-right">

                                        <button class="btn btn-primary" type="submit">Listar Clientes</button>
                                        
                                    </div>                                    

                                </div>

                            </form>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-sm-12">

                            <div class="table-responsive">

                                <table class="table table-striped">
                                    <tr>
                                        <th>Id</th>
                                        <th>Nome</th>
                                        <th>Sobrenome</th>
                                        <th>Email</th>
                                        <th>Data de Nascimento</th>
                                    </tr>
                                    <tr ng-repeat="cliente in mailingCtrl.clientes | orderBy:'-cliente.data_nascimento' ">
                                        <td>{{ cliente.customer_id }}</td>
                                        <td>{{ cliente.firstname }}</td>
                                        <td>{{ cliente.lastname }}</td>
                                        <td>{{ cliente.email }}</td>
                                        <td>
                                            <span ng-show="cliente.data_nascimento != '0000-00-00'">{{ cliente.data_nascimento | date: 'dd/MM/yyyy' }}</span>
                                            <span ng-show="cliente.data_nascimento == '0000-00-00'">-</span>
                                        </td>
                                    </tr>
                                </table>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/bootstrap.min.js"></script>
        <script src="js/angular.min.js"></script>
        <script src="js/app.js"></script>
        <script src="js/bootstrap-datepicker.js"></script>
        <script src="js/locales/bootstrap-datepicker.pt-BR.js"></script>

        <script type="text/javascript">

            $(document).ready(function(){

                $('#data_inicio, #data_fim').datepicker({
                    format: 'dd/mm/yyyy',
                    autoclose:true,
                    todayBtn: 'linked',
                    language: 'pt-BR',
                    orientation: 'bottom left',
                });

            });

        </script>

    </body>
</html>