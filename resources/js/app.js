import './bootstrap';


$(document).ready(function(){

    $('#kensaku').on('click',function(event){
        console.log('kensaku');
        event.preventDefault();
        $.ajax({
            url: "product",
            type: 'GET',
            data: $('#search').serialize(),
            dataType: 'html',
            success: function(data){
                console.log('成功');
                var extractedElement = $(data).find("#product-table");
                $("#product-table").html(extractedElement);
                $('.loading').addClass('display-none');
            },
            error: function(xhr){
                console.log(xhr);
            }
        });
    });
})

$(document).ready(function(){

    $('#sakujo').on('click',function(event){
        var productid = $(this).data("product-id");
        console.log('sakujo');
        event.preventDefault();
        var clickEle = $(this).parents("tr").remove();
        $.ajax({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            url: "delete" + productid,
            type: 'POST',
            data: {"_method":"delete",},
            dataType: 'html',
            success: function(){
                console.log('削除します');
                console.log(clickEle);
            },
            error: function(xhr){
                console.log(xhr);
            }
        });
    });
})

// function deleteItem(event) {
// event.preventDefault();
// var form = $(event.target);
// var id = form.find('button').data('id');
// var url = "delete" + id; 

// $.ajax({
//     url: url,
//     type: 'POST',
//     data: form.serialize(),
//     success: function(data) {
//         handleSubmit(event); 
//     },
//     error: function(xhr) {
//         console.log(xhr);
//     }
// });
// }

// $(document).ready(function() {
    
// $('.search').submit(handleSubmit);
// $(document).on('submit', 'form[id^="deleteForm-"]', function(event) {
//     if(confirm("削除しますか？")) {
//         deleteItem(event);
//     } else {
//         event.preventDefault();
//     }
// });

// $(document).on('submit', 'search', function(event) {
//     if(any) {
//         searchItem(event);
//     } else {
//         event.preventDefault();
//     }
// });
// });
