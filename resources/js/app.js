import './bootstrap';

function handleSubmit(event) {
    event.preventDefault(); 

    function searchItem(event) {
    var values = getValues();

    $.ajax({
       url: "product",
       type: 'GET',
       data: values,
       dataType: 'html',
       success: function(data) {
        var extractedElement = $(data).find("#search");
        $("#search").html(extractedElement);
        $('.loading').addClass('display-none');
    },
    error: function(xhr) {
        console.log(xhr);
    }
});

function getValues() {
var keyword = $('#keyword').val();
var company_id = $('#search').val();
var jougenprice = $('#jougenprice').val();
var kagenprice = $('#kagenprice').val();
var jougenstock = $('#jougenstock').val();
var kagenstock = $('#kagenstock').val();
return {
    keyword: keyword,
    company_id: company_id,
    jougenprice: jougenprice,
    kagenprice: kagenprice,
    jougenstock: jougenstock,
    kagenstock: kagenstock,
};
}
    }

function deleteItem(event) {
event.preventDefault();
var form = $(event.target);
var id = form.find('button').data('id');
var url = "delete" + id; 

$.ajax({
    url: url,
    type: 'POST',
    data: form.serialize(),
    success: function(data) {
        handleSubmit(event); 
    },
    error: function(xhr) {
        console.log(xhr);
    }
});
}

$(document).ready(function() {
    
$('.search').submit(handleSubmit);
$(document).on('submit', 'form[id^="deleteForm-"]', function(event) {
    if(confirm("削除しますか？")) {
        deleteItem(event);
    } else {
        event.preventDefault();
    }
});

$(document).on('submit', 'search', function(event) {
    if(any) {
        searchItem(event);
    } else {
        event.preventDefault();
    }
});
});

}
