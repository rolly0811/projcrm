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

function addconfig() {
    var inputs = $('#config-form').serialize();
    $.ajax({
        url: "/config",
        data: inputs,
        method: "POST",
    }).done(function (data) {
        $('#config-list').html(data);
    });
}

function editconfig(number, id){
    $.ajax({
        url: "/config/edit",
        data: {"number": number, "config_id": id, "action": 'edit'},
        method: "POST",
    }).done(function (data) {
        $('#conf-' + id).html(data);
    });
}
function updateconfig(number, id) {
   $.ajax({
        url: "/config/edit",
        data: {"company_id": $('#company_id-'+id).val(), "company_ip": $('#company_ip-'+id).val(), "number": number, "config_id": id, "action": 'update'},
        method: "POST",
    }).done(function (data) {
        $('#conf-' + id).html(data);
    });
}
function cancel_config(number, id) {
   $.ajax({
        url: "/config/edit",
        data: {"number": number, "config_id": id, "action": 'cancel'},
        method: "POST",
    }).done(function (data) {
        $('#conf-' + id).html(data);
    });
}

function deleteconfig(id){
    if(confirm("Are you sure?")){
        $.ajax({
            url: "/config/delete",
            data: {"id": id},
            method: "POST",
        }).done(function(data){
            alert('Successfully Deleted');
            $('#config-list').html(data);
        });
    }
}