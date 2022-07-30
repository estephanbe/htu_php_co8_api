$(function () {

    let api_url = "http://htuapi.local/htu_api/items";

    // Get items from API
    $.ajax({
        type: "GET",
        url: api_url,
        success: function (response) {
            let res = JSON.parse(response);
            res.body.items.forEach(item => {
                $('#htu-cItems').prepend(`
                    <li class="list-group-item ${item.completed ? "checkedItem" : ""}"
                        data-id="${item.id}"
                    >
                        <div class="row">
                            <div class="input-group-text col-1">
                                <input type="checkbox" aria-label="Checkbox for following text input" ${item.completed ? "checked" : ""}>
                            </div>
                            <div class="itemContent col-10 d-flex align-content-center">
                                <p class="m-0">${item.name}</p>
                            </div>
                            <button type="button" class="btn btn-danger col-1">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </div>
                    </li>
                `);
                $(`li[data-id="${item.id}"] button`).click(function () {
                    $.ajax({
                        type: "DELETE",
                        url: api_url,
                        data: JSON.stringify({
                            id: item.id
                        }),
                        dataType: "application/json",
                    });
                    $(this).parent().parent().slideUp('slow', function () {
                        $(this).remove();
                    });
                });

                $(`li[data-id="${item.id}"] input`).on('change', function () {
                    let inputVal = $(this).val();
                    $.ajax({
                        type: "PUT",
                        url: api_url,
                        data: JSON.stringify({
                            id: item.id,
                            completed: inputVal == "on" ? true : false
                        }),
                        dataType: "application/json",
                    });
                    $(this).parent().parent().parent().toggleClass('checkedItem');
                });
            });



        }
    });


    let input = $('#htu-newItem');
    let inputBtn = $('#htu-newItemBtn');
    inputBtn.on('click', function () {
        let inputValue = input.val();
        if (inputValue == '') {
            $('#emptyAlertModal').modal('show');
            return;
        }

        inputBtn.prop('disabled', true);
        console.log(1);
        $.ajax({
            type: "POST",
            url: api_url,
            data: JSON.stringify({
                name: inputValue
            }),
            dataType: "application/json",
            error: function (response) {
                console.log(response);
                response = JSON.parse(response.responseText);
                $('#htu-cItems').prepend(`
                    <li class="list-group-item"
                        data-id="${response.body.id}"
                    >
                        <div class="row">
                            <div class="input-group-text col-1">
                                <input type="checkbox" aria-label="Checkbox for following text input">
                            </div>
                            <div class="itemContent col-10 d-flex align-content-center">
                                <p class="m-0">${inputValue}</p>
                            </div>
                            <button type="button" class="btn btn-danger col-1">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </div>
                    </li>
                `);

                input.val('');

                $('body').prepend(`
                <div id="newItemAlert" class="alert alert-success" role="alert">
                    Your new checklist item was added successfuly. 
                </div>`);

                $('#newItemAlert').fadeOut(3000, function () {
                    $(this).remove();
                    inputBtn.prop('disabled', false);
                });

                $(`li[data-id="${response.body.id}"] button`).click(function () {
                    $.ajax({
                        type: "DELETE",
                        url: api_url,
                        data: JSON.stringify({
                            id: response.body.id
                        }),
                        dataType: "application/json",
                    });
                    $(this).parent().parent().slideUp('slow', function () {
                        $(this).remove();
                    });
                });

                $(`li[data-id="${response.body.id}"] input`).on('change', function () {
                    let inputVal = $(this).val();
                    $.ajax({
                        type: "PUT",
                        url: api_url,
                        data: JSON.stringify({
                            id: response.body.id,
                            completed: inputVal == "on" ? true : false
                        }),
                        dataType: "application/json",
                    });
                    $(this).parent().parent().parent().toggleClass('checkedItem');
                });
            }
        });



        // I will send AJAX request to the API so we can save the data

    });
});