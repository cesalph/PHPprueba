<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">

<meta name="viewport" content="initial-scale=1.0, maximum-scale=2.0">

<link rel="stylesheet" type="text/css" href="css/jquery.dataTables.css">
<script type="text/javascript" language="javascript" src="js/jquery-3.1.0.js"></script>
<script type="text/javascript" language="javascript" src="js/jquery-3.1.0.min.js"></script>
<script type="text/javascript" language="javascript" src="js/jquery.dataTables.js"></script>
<script type="text/javascript" language="javascript" src="js/lista_usuarios.js"></script>
<!-- Latest compiled and minified CSS --> 
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"> 
<!-- Latest compiled and minified JavaScript --> 
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script> 
<script type="text/javascript" src="js/moment.min.js"></script>
<script type="text/javascript" src="js/moment.js"></script>
<script type="text/javascript" src="js/daterangepicker.js"></script>
<link rel="stylesheet" href="css/daterangepicker.css"> 

</head>

<body class="dt-example">
<div id="contenido" >
            
           
            <div class="page-header">
                    <h1 >Read Products</h1>
             </div>
            <div class="panel panel-primary">
                 <div  class="col-sm-2">
                    <label>Seach by date to date:</label>
                 </div>
                 <div class="col-sm-3" >
                    <div class="controls">
                        <div class="input-prepend input-group" >
                            <span class="add-on input-group-addon">
                                 <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                            </span><input type="text" style="width: 200px" name="reportrange" id="reportrange" class="form-control" value="18/03/2008 – 18/02/2018" />
                        </div>
                    </div>
                 </div>
                <div  class="col-sm-2"></div>
                <div  class="col-sm-5">
                    <button type="button" class="btn btn-danger " href="PHP/csv.php" target="_blank">
                       <img src="images/x-mark-xxl.png" width="13" /> Delete selected Rows
                     </button> 
                    
                
                    
                     <button type="button" class="btn btn-info " >
                         <img src="images/white-download-icon-png-32.png" width="30" />
                        <a href="PHP/csv.php" target="_blank" style="color:white">Export to csv</a>
                     </button> 
                     
                     
                     
                      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#newp-modal" >
                        <img src="images/add-button-white-hi.png" width="13" /> New Product
                     </button> 
                     
                     
                     
                 </div>
                <br/><br/>
                <div class="panel-body">
                    <table id="example" class="table table-striped table-bordered" cellspacing="0" >
                        <thead>
                        <th><input name="select_all" value="1" type="checkbox"></th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Description</th>
                        <th>Category</th>
                        <th>Created</th>  
                        <th>Actions</th> 
                        </thead>
                        <tbody>
                            <?php
                            require 'PHP/Database.php';
                            $pdo = Database::connect();
                            $sql = 'SELECT * FROM products';
                            foreach ($pdo->query($sql) as $row) {
                                echo "<tr>";
                                echo '<td><input type="checkbox" value="' . $row['id'] . '" name="checksel[]" /></td>';
                                echo '<td>' . $row['name'] . '</td>';
                                echo '<td>$' . $row['price'] . '.00</td>';
                                echo '<td>' . $row['description'] . '</td>';
                                echo '<td>' . $row['category_id'] . '</td>';
                                echo '<td>' . $row['created'] . '</td>';
                                echo '<td><button class="btn btn-info" data-toggle="modal" data-target="#edit-modal" onClick="editForm(' . $row['id'] . ', \'' . $row['name'] . '\', ' . $row['price'] . ',\'' . $row['description'] . '\', ' . $row['category_id'] . ' )">'
                                        . '<img src="images/edit-property-xxl.png" width="13" /> Edit'
                                        . '</button>'
                                        . ' <button class="btn btn-danger" onclick="eliminar(' . $row['id'] . ', this)">'
                                        . '<img src="images/x-mark-xxl.png" width="13" /> Delete'        
                                        . '</button></td>';
                                //echo '<td><button class="btn btn-primary" onclick="editar(' . $row['id'] . ')">Editar</button></td>';
                                echo '</tr>';
                            }
                            Database::disconnect();
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="edit-modal-label"> 
        <div class="modal-dialog" role="document"> 
            <div class="modal-content"> 
                <form class="form-horizontal" id="edit-form"> 
                    <div class="modal-header"> 
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button> 
                        <h4 class="modal-title" id="edit-modal-label">Edit product</h4> 
                    </div> <div class="modal-body"> 
                        <input type="hidden" id="edit-id" value="" class="hidden"> 
                        <div class="form-group"> 
                            <label for="namee" class="col-sm-2 control-label">Name</label> 
                                <div class="col-sm-10"> 
                                    <input type="text" class="form-control" id="namee" name="name"  required> 
                                </div> 
                        </div> 
                        <div class="form-group"> 
                            <label for="pricee" class="col-sm-2 control-label">Price</label> 
                            <div class="col-sm-10"> 
                                <input type="text" class="form-control" id="pricee" name="pricee"  required> 
                            </div> 
                        </div> 
                        <div class="form-group"> 
                            <label for="descee" class="col-sm-2 control-label">Description</label> 
                            <div class="col-sm-10"> 
                                <input type="text" class="form-control" id="descee" name="descee"  required> 
                            </div> 
                        </div> 
                        <div class="form-group"> 
                            <label for="catege" class="col-sm-2 control-label">Category</label> 
                            <div class="col-sm-10"> 
                                <input type="text" class="form-control" id="catege" name="catege"  required> 
                            </div> 
                        </div> 
                    </div> 
                    <div class="modal-footer"> 
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> 
                        <button type="submit" class="btn btn-primary" onClick="guardaEdit();">Save changes</button> 
                    </div> 
                </form> 
            </div> 
        </div> 
    </div>
    <div class="modal fade" id="newp-modal" tabindex="-1" role="dialog" aria-labelledby="edit-modal-label"> 
        <div class="modal-dialog" role="document"> 
            <div class="modal-content"> 
                <form class="form-horizontal" id="newp-form"> 
                    <div class="modal-header"> 
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button> 
                        <h4 class="modal-title" id="edit-modal-label">New product</h4> 
                    </div> <div class="modal-body"> 
                        <div class="form-group"> 
                            <label for="namen" class="col-sm-2 control-label">Name</label> 
                                <div class="col-sm-10"> 
                                    <input type="text" class="form-control" id="namen" name="namen"  required> 
                                </div> 
                        </div> 
                        <div class="form-group"> 
                            <label for="pricen" class="col-sm-2 control-label">Price</label> 
                            <div class="col-sm-10"> 
                                <input type="text" class="form-control" id="pricen" name="pricen"  required> 
                            </div> 
                        </div> 
                        <div class="form-group"> 
                            <label for="descen" class="col-sm-2 control-label">Description</label> 
                            <div class="col-sm-10"> 
                                <input type="text" class="form-control" id="descen" name="descen"  required> 
                            </div> 
                        </div> 
                        <div class="form-group"> 
                            <label for="categn" class="col-sm-2 control-label">Category</label> 
                            <div class="col-sm-10"> 
                                <input type="text" class="form-control" id="categn" name="categn"  required> 
                            </div> 
                        </div> 
                    </div> 
                    <div class="modal-footer"> 
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> 
                        <button type="submit" class="btn btn-primary" onClick="guardaNew()" >Save</button> 
                    </div> 
                </form> 
            </div> 
        </div> 
    </div>
</body>
</html>