<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title><?php echo $title;?></title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="<?php echo base_url('assets/css/bootstrap.css')?>" rel="stylesheet" />
    <!-- FONT AWESOME ICONS  -->
    <link href="<?php echo base_url('assets/css/font-awesome.css')?>" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="<?php echo base_url('assets/css/style.css')?>" rel="stylesheet" />
    <link href="<?php echo base_url('assets/css/extra.css')?>" rel="stylesheet" />
    <link href="<?php echo base_url('assets/css/datatables/dataTables.bootstrap.min.css')?>" rel="stylesheet" />
    <link href="<?php echo base_url('assets/css/datatables/dataTables.responsive.css')?>" rel="stylesheet" />
    <link href="<?php echo base_url('assets/css/dateTime/bootstrap-datetimepicker.min.css')?>" rel="stylesheet" />
    <link href="<?php echo base_url('assets/fullcalendar/fullcalendar.css')?>" rel="stylesheet" />
    <link href="<?php echo base_url('assets/css/jm.spinner.css')?>" rel="stylesheet" />
    <!-- <link href="<?php echo base_url('assets/css/wysihtml5/bootstrap3-wysihtml5.min.css')?>" rel="stylesheet" /> -->
</head>
<body>
    <input type="hidden" name="sch_id" value="<?php echo $id; ?>">
    <div class="container">
        <div class="row">
            <div class="col-xs-3">
                <br>                
                <a href="javascript:void(0)" type="button" class="btn btn-default" onclick="printDiv('print')" ><span class="glyphicon glyphicon-print"></span> Print</a>
                <br>
                <span><strong>Notulen</strong></span>                
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div id="print">
                </div>
            </div>
        </div>
    </div>
    <!-- Jquery -->
    <!-- CORE JQUERY SCRIPTS -->
    <script src="<?php echo base_url('assets/js/jquery-1.11.1.js')?>"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="<?php echo base_url('assets/js/bootstrap.js')?>"></script>
    <!-- DATATABLES -->
    <script src="<?php echo base_url('assets/js/datatables/jquery.dataTables.min.js')?>"></script>
    <script src="<?php echo base_url('assets/js/datatables/dataTables.bootstrap.min.js')?>"></script>
    <script src="<?php echo base_url('assets/js/datatables/dataTables.responsive.js')?>"></script>
    <!-- JM SPINNER -->
    <script src="<?php echo base_url('assets/js/jm.spinner.js')?>"></script>
    <!-- EXTRA JS -->
    <script src="<?php echo base_url('assets/js/extra.js')?>"></script>
    <script>
        $(document).ready(function()
        {
            var id = $('[name="sch_id"]').val();
            pick_data(id);
        });

        function pick_data(id)
        {
            $.ajax({
            url: '<?php echo base_url('Crud/get_printpre/')?>'+id,
            type: "POST",
            // data: $('#schres_form').serialize(),
            dataType: "JSON",
            success: function(data)
                {
                    var a = $('<div>').append(data.SCH_NOTULEN).appendTo('#print');
                },            
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error');
                }
            });
        }

        function printDiv(divName)
        {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
        }
    </script>
</body>
</html>