<?php
// Check existence of id parameter before processing further
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    // Include config file
    require_once "config.php";
    
    // Prepare a select statement
    $sql = "SELECT * FROM MBA_ALOC WHERE id = :id";
    
    if($stmt = $pdo->prepare($sql)){
        // Bind variables to the prepared statement as parameters
        $stmt->bindParam(":id", $param_id);
        
        // Set parameters
        $param_id = trim($_GET["id"]);
        
        // Attempt to execute the prepared statement
        if($stmt->execute()){
            if($stmt->rowCount() == 1){
                /* Fetch result row as an associative array. Since the result set
                contains only one row, we don't need to use while loop */
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                
                // Retrieve individual field value
                $cliente = $row["cliente"];
                $cliente = $row["telefone_cliente"];
                $solicitacao = $row["solicitacao"];
                $endereco_cliente = $row["endereco_cliente"];
                $cpf_cnpj = $row["cpf_cnpj"];
            } else{
                // URL doesn't contain valid id parameter. Redirect to error page
                header("location: error.php");
                exit();
            }
            
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
     
    // Close statement
    unset($stmt);
    
    // Close connection
    unset($pdo);
} else{
    // URL doesn't contain id parameter. Redirect to error page
    header("location: error.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="ptbr">
<head>
    <meta charset="UTF-8">
    <title>View Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
        table tr td:last-child{
            width: 120px;
        }
    </style>
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
</head>
<body>
<div class="col-md-12">
                    <h1 class="mt-5 mb-3">Ver dados</h1>
                    <div class="form-group">
<?php
// Include config file
             require_once "config.php";
             $pdo = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
             // Attempt select query execution
             $sql = "SELECT * FROM MBA_ALOC";
            if($result = $pdo->query($sql)){
                if($result->rowCount() > 0){
                    echo '<table class="table table-bordered table-striped">';
                        echo "<thead>";
                             echo "<tr>";
                                     echo "<th>#</th>";
                                     echo "<th>Cliente</th>";
                                     echo "<th>Telefone cliente</th>";
                                     echo "<th>Solicitação</th>";
                                     echo "<th>Endereço cliente</th>";
                                     echo "<th>cpf/cnpj</th>";
                                 echo "</tr>";
                             echo "</thead>";
                             echo "<tbody>";
                             while($row = $result->fetch()){
                                 echo "<tr>";
                                     echo "<td>" . $row['id'] . "</td>";
                                     echo "<td>" . $row['cliente'] . "</td>";
                                     echo "<td>" . $row['telefone_cliente'] . "</td>";
                                     echo "<td>" . $row['solicitacao'] . "</td>";
                                     echo "<td>" . $row['endereco_cliente'] . "</td>";
                                     echo "<td>" . $row['cpf_cnpj'] . "</td>";
                                         echo '<a href="read.php?id='. $row['id'] .'" class="mr-3" title="View Record" data-toggle="tooltip"><span class="fa fa-eye"></span></a>';
                                         echo '<a href="update.php?id='. $row['id'] .'" class="mr-3" title="Atualizar dados" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                                         echo '<a href="delete.php?id='. $row['id'] .'" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
                                     echo "</td>";
                                 echo "</tr>";
                             }
                             echo "</tbody>";                            
                         echo "</table>";
                         // Free result set
                         unset($result);
                         
                     } else{
                         echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                     }
                 } else{
                     echo "Oops! Something went wrong. Please try again later.";
                 }
                 
                 // Close connection
                 unset($pdo);
                ?> 
                <a href="index.php" class="btn btn-primary m-3">Voltar</a>    
        </div>   
    </body>
</html>