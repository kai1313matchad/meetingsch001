//Global Config
$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
    $($.fn.dataTable.tables(true)).DataTable()
        .columns.adjust()
        .responsive.recalc();
 });

$("input").change(function(){
    $(this).parent().parent().removeClass('has-error');
    $(this).next().empty();
});
$("textarea").change(function(){
    $(this).parent().parent().removeClass('has-error');
    $(this).next().empty();
});
$("select").change(function(){
    $(this).parent().parent().removeClass('has-error');
    $(this).next().empty();
});
$('select').on('click',function(){                
    $(this).parent().parent().removeClass('has-error');
});
$('input').on('click',function(){                
    $(this).parent().parent().removeClass('has-error');
});
$('textarea').on('click',function(){                
    $(this).parent().parent().removeClass('has-error');
});

$('#dash_table').DataTable({ 
            "info": false,
            "responsive": true,
        });

//Datatables untuk cari data karyawan
function dt_karyawan(url)
{
    $('#dtb_karyawan').DataTable({ 
        "info": false,
        "destroy": true,
        "lengthMenu": [[5, 25, 50, -1], [5, 25, 50, "All"]],
        "responsive": true,
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
                "url": url,
                "type": "POST",                
            },
        "columnDefs": [
            { 
                "targets": [ 0,4 ],
                "orderable": false,
                "className": "dt-body-center"
            },
        ],
    });
}

//Datatables untuk menampilkan data user
function dt_user(url)
{
    $('#dtb_user').DataTable({ 
        "info": false,
        "destroy": true,
        "lengthMenu": [[5, 25, 50, -1], [5, 25, 50, "All"]],
        "responsive": true,
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
                "url": url,
                "type": "POST",                
            },
        "columnDefs": [
            { 
                "targets": [ 0,5 ],
                "orderable": false,
                "className": "dt-body-center"
            },
        ],
    });
}

//Datatables untuk menampilkan data schedule
function dt_schedule(url)
{
    $('#dtb_search_sch').DataTable({ 
        "info": false,
        "destroy": true,
        "lengthMenu": [[5, 25, 50, -1], [5, 25, 50, "All"]],
        "responsive": true,
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
                "url": url,
                "type": "POST",                
            },
        "columnDefs": [
            { 
                "targets": [ 0,5 ],
                "orderable": false,
                "className": "dt-body-center"
            },
        ],
    });
}

//Datatables untuk menampilkan schedule untuk reminder
function dt_schreminder(url)
{
    $('#dtb_schreminder').DataTable({ 
        "info": false,
        "destroy": true,
        "lengthMenu": [[10, 20, 50, -1], [10, 20, 50, "All"]],
        "responsive": true,
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
                "url": url,
                "type": "POST",                
            },
        "columnDefs": [
            { 
                "targets": [ 0,5 ],
                "orderable": false,
                "className": "dt-body-center"
            },
        ],
    });
}

//Datatables untuk menampilkan schedule untuk result
function dt_schresult(url)
{
    $('#dtb_schresult').DataTable({ 
        "info": false,
        "destroy": true,
        "lengthMenu": [[10, 20, 50, -1], [10, 20, 50, "All"]],
        "responsive": true,
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
                "url": url,
                "type": "POST",                
            },
        "columnDefs": [
            { 
                "targets": [ 0,5 ],
                "orderable": false,
                "className": "dt-body-center"
            },
        ],
    });
}

//CRUD
function save_data(url,form)
{
    $('#btnSave').text('Menyimpan...');
    $('#btnSave').attr('disabled',true);
    $('.box').jmspinner('large');
    $.ajax({
        url : url,
        type: "POST",
        data: $(form).serialize(),
        dataType: "JSON",
        success: function(data)
        {
            if(data.status)
            {
                alert('Data Berhasil Disimpan');
                $(form)[0].reset();
            }
            else
            {
                for (var i = 0; i < data.inputerror.length; i++)
                {
                    $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error');
                }
            }
            $('#btnSave').text('Simpan');
            $('#btnSave').attr('disabled',false);
            $('.box').jmspinner(false);
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
            $('#btnSave').text('Simpan');
            $('#btnSave').attr('disabled',false);
            $('.box').jmspinner(false);
        }
    });
}

function update_data(url,form)
{
    $('#btnSave').text('Menyimpan...');
    $('#btnSave').attr('disabled',true);
    $('.box').jmspinner('large');
    $.ajax({
        url : url,
        type: "POST",
        data: $(form).serialize(),
        dataType: "JSON",
        success: function(data)
        {
            if(data.status)
            {
                alert('Data Berhasil Diupdate');                
            }
            else
            {
                for (var i = 0; i < data.inputerror.length; i++)
                {
                    $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error');
                }
            }
            $('#btnSave').text('Simpan');
            $('#btnSave').attr('disabled',false);
            $('.box').jmspinner(false);
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
            $('#btnSave').text('Simpan');
            $('#btnSave').attr('disabled',false);
            $('.box').jmspinner(false);
        }
    });
}

//Dropdown
function dropdown(url,drop,value,text)
{
    $('#'+drop).empty()
    $.ajax({
    url : url,
    type: "GET",
    dataType: "JSON",
    success: function(data)
        {   
            var select = document.getElementById(drop);
            var option;
            option = document.createElement('option');
                option.value = ''
                option.text = 'Pilih';
                select.add(option);
            if(data.length != null)
            {
                for (var i = 0; i < data.length; i++) 
                {
                    option = document.createElement('option');
                    option.value = data[i][value];
                    option.text = data[i][text];
                    select.add(option);
                }
            }            
        },
    error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

//Multiple Select
function multiselect(url,drop,value,text)
{
    $('#'+drop).empty()
    $.ajax({
    url : url,
    type: "GET",
    dataType: "JSON",
    success: function(data)
        {   
            var select = document.getElementById(drop);
            var option;
            if(data.length != null)
            {
                for (var i = 0; i < data.length; i++) 
                {
                    option = document.createElement('option');
                    option.value = data[i][value];
                    option.text = data[i][text];
                    select.add(option);
                }
            }            
        },
    error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

//checkboxes
function checkboxes(url,drop,value,text)
{
    $('#'+drop).empty()
    $.ajax({
    url : url,
    type: "GET",
    dataType: "JSON",
    success: function(data)
        {   
            if(data.length != null)
            {
                for (var i = 0; i < data.length; i++) 
                {
                    var chkbox = $('<input type="checkbox" onclick="member_gen()" name="sch_dept[]" value="'+data[i][value]+'" /> '+data[i][text]+'<br>');
                    chkbox.appendTo('#'+drop);
                }
            }            
        },
    error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

//multiselect pick helper
function ms_pick(elem)
{
    $('#'+elem+' option').mousedown(function(e) 
    {
        e.preventDefault();
        var originalScrollTop = $(this).parent().scrollTop();
        console.log(originalScrollTop);
        $(this).prop('selected', $(this).prop('selected') ? false : true);
        var self = this;
        $(this).parent().focus();
        setTimeout(function() 
        {
            $(self).parent().scrollTop(originalScrollTop);
        }, 0);
        return false;
    });
}

//Access Check
function access_check()
{
    var aks_post = $('[name="ses_akspost"]').val();
    var aks_adm = $('[name="ses_aksadm"]').val();
    if(aks_post == '')
    {
        $('#nav_menu_post').css({'display':'none'});
    }
    if(aks_adm == '')
    {
        $('#nav_admin').css({'display':'none'});
    }    
}