<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
        integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

    <!-- Include Google fonts -->

    <link rel="stylesheet" href="./resources/css/style.css">
    <title>HTU ToDo</title>
</head>

<body>


    <main class="container">
        <div class="d-flex flex-column justify-content-center align-content-center">
            <h1 class="text-center mb-5">HTU ToDo List</h1>
            <div id="htu-checklist" class="d-flex flex-column align-items-center">
                <div id="htu-cInputWrapper" class="w-50">
                    <!-- <div id="htu-cInput">
                        <input type="text" id="htu-newItem" class="w-100">
                        <i id="htu-newItemBtn" class="fa-solid fa-square-plus"></i>
                    </div> -->
                    <div class="input-group mb-3">
                        <input type="text" id="htu-newItem" class="form-control" placeholder="todo item..."
                            aria-label="todo item..." aria-describedby="htu-newItemBtn">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button" id="htu-newItemBtn">
                                <i class="fa-solid fa-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <ul id="htu-cItems" class="list-group list-group-flush w-50">
                </ul>
            </div>
        </div>
    </main>


    <div class="modal fade" id="emptyAlertModal" tabindex="-1" aria-labelledby="emptyAlertModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="emptyAlertModalLabel">Alert!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger" role="alert">
                        You need to add a checklist item!
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>



    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous">
    </script>
    <script src="./resources/js/app.js"></script>

</body>

</html>