<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HTU POS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
    <style>
        body {
            background-color: #f8ba43;
        }
    </style>
</head>

<body class="container">
<h1 class="text-center mt-5">Transactions Info</h1>

    </div>
    <div class="d-flex justify-content-center">
        
        <ul id="listItems">
        </ul>
        <table id="" class="table table-striped text-center mt-5 ">
            <thead>
                <tr>
                    <th scope="col">Item ID</th>
                    <th scope="col">Item Quantity</th>
                    <th scope="col">Created At</th>
                    <th scope="col">Updated at</th>
                </tr>
            </thead>
            <tbody id="listItem">

            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
    <script src="../js/app.js"></script>

    <!-- Script      ***       Scritp        ***         Script       ***        Script     ***        Script       ***      Script-->
    <!-- Script      ***       Scritp        ***         Script       ***        Script     ***        Script       ***      Script-->
    <!-- Script      ***       Scritp        ***         Script       ***        Script     ***        Script       ***      Script-->
    <!-- Script      ***       Scritp        ***         Script       ***        Script     ***        Script       ***      Script-->

<script>
  $(function() {
    let api_url = "http://posapi.local/api/items";
       $.ajax({
        type: "GET",
        url: api_url,
        success: function(response) {
        let res = JSON.parse(response);
        res.body.items.forEach(item => {
        $('#listItem').prepend(`itemId=${item.id}
<tr>
      <td>${item.item_id}</td>
      <td>${item.quantity}</td>
      <td>${item.created_at}</td>
      <td>${item.updated_at}</td>
              
              `);
           });
         }
       });
    });
    </script>
</html>