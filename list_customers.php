<?php
    include "includes/bootstrap.php";
    include "includes/connexio.php";
?>
<!DOCTYPE html>
<html lang="en">
    <?php bsHead("Llistat"); ?>
    <body>

    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">Web BPSIX</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
          	<li><a href="llistat_incidencies.php">Incidències</a></li>
            <li class="active"><a href="list_customers.php">Customers <span class="sr-only">(current)</span></a></li>
            <li><a href="llistat_taula1.php">Taula 1</a></li>
            <li><a href="llistat_taula2.php">Taula 2</a></li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>

    <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Delete Customer</h4>
                </div>
            
                <div class="modal-body">
                    <p>Sure you want to destroy this customer?</p>
                </div>   
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                    <a class="btn btn-danger btn-ok">Sí</a>
                </div>
            </div>
        </div>
    </div>
	<div class="container">
		<h3><center>Customers List</center></h3>
        <br>
<?php
        obrirConnexioBD();
        $sql = "SELECT * FROM customers c INNER JOIN parroquies p ON c.parroquia=p.id_parroquia ORDER BY id_customer;";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) { ?>
    <table class="table table-hover table-bordered">
        <thead>
          <tr class="success">
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>Number</th>
            <th>Surname</th>
            <th>Name</th>
            <th>Phonenumber</th>
            <th>Mail</th>
            <th>Address</th>
            <th>Parroquia</th>
          </tr>
        </thead>
        <tbody>
        <?php  // output data of each row
            while($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><center><a href="form_customer.php?operacio=edit&id_customer=<?=$row["id_customer"]?>" data-toggle="modal"><span class="glyphicon glyphicon-edit "></span></a></center></td>
                    <td><center><a data-href="delete_customer.php?id_customer=<?=$row["id_customer"]?>" data-toggle="modal" data-target="#confirm-delete"><span class="glyphicon glyphicon-remove "></span></a></center></td>
                    <td><?=$row["id_customer"]?></td>
                    <td><?=$row["surname"]?></td>
                    <td><?=$row["name"]?></td>
                    <td><?=$row["phonenumber"]?></td>
                    <td><?=$row["mail"]?></td>
                    <td><?=$row["address"]?></td>
                    <td><?=$row["parroquia"]?></td>
                </tr>
    <?php   } ?>
        </tbody>
    </table>        
<?php
    } else {
        echo "All the customers have been destroyed";
    }
    tancarConnexioBD();
?>
<a type="button" href="form_customers.php?operacio=new" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span> new customer </a>
<button type="button" onClick="window.print();" class="btn btn-success"><span class="glyphicon glyphicon-print"></span> print </button>
      </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script>
        $('#confirm-delete').on('show.bs.modal', function(e) {
            $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
        });
    </script>
    </body>
</html>
