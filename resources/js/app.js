$(function () {
    let input = $('#htu-newItem');
    let inputBtn = $('#htu-newItemBtn');

    let idCounter = 0;
    inputBtn.on('click', function(){
        let inputValue = input.val();
        if (inputValue == ''){
            $('#emptyAlertModal').modal('show');
            return;
        }

        idCounter++;

        inputBtn.prop('disabled', true);

        $('#htu-cItems').prepend(`
            <li class="list-group-item"
                data-id="${idCounter}"
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
            </div>`
        );

        $('#newItemAlert').fadeOut(3000, function(){
            $(this).remove();
            inputBtn.prop('disabled', false);
        });

        $(`li[data-id="${idCounter}"] button`).click(function(){
            $(this).parent().parent().slideUp('slow', function(){
                $(this).remove()
            });
        });

        $(`li[data-id="${idCounter}"] input`).on('change', function(){
            $(this).parent().parent().parent().toggleClass('checkedItem');
        });

        // I will send AJAX request to the API so we can save the data

    });
});