function add_ring_group(){
    var dataval = $('#newringgroup').serialize();
    $.post('/ringgroup/add', dataval, function(data){
        var fields = $.parseJSON(data);
        location.reload();
    });
    
}

function edit(id, number) {
       $.post('/ringgroup/edit/' + id,{"number": number}, function(data){
           $('#rg-'+id).html(data);
       });
}
function cancel(id, number) {
    $.get('/ringgroup/cancel/' + id, {"number": number}, function(data){
           $('#rg-'+id).html(data);
       });
}
function update(id, number) {
    var cid = $('#company_id-' + id).val();
    var rg = $('#ring-group-' + id).val();
    var rgn = $('#ring-group-name-' + id).val();
    $.post('/ringgroup/update/' + id, {"company_id": cid, "ring_group" : rg, "ring_group_name" : rgn, "number": number}, function(data){
        $('#rg-'+id).html(data);
       });
}
function delete_ring_group(id) {
    if(confirm("Are you sure you want to delete this ring group?")) {
        $.post('/ringgroup/delete/' + id, function(data){
            alert(data);
            location.reload();
        });
    }
}