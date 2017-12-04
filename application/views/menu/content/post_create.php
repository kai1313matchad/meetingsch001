	<div class="content-wrapper">
		<div class="container">
			<div class="row">
                <div class="col-sm-12 col-xs-12">
                    <h4 class="page-head-line">Buat Jadwal</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 col-xs-6 col-sm-offset-3 col-xs-offset-3">
                    <div class="panel panel-default">
                        <div class="panel-heading text-center">
                            <h4>Jadwal Meeting</h4>
                        </div>
                        <div class="panel-body">
                            <div class="col-sm-12 col-xs-12">
                                <form class="form-horizontal" id="sch_form">
                                    <input type="hidden" name="kar_id" value="<?php echo $this->session->userdata('kar_id')?>">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Team</label>
                                        <div class="col-sm-8">
                                            <select class="form-control" name="user_id" id="team">
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Tema Meeting</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="sch_title">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Dept. Terkait</label>
                                        <div class="col-sm-8" id="cbox">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Anggota</label>
                                        <div class="col-sm-8">
                                            <select multiple="multiple" class="form-control" id="select_kry" name="sch_member[]">
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Tanggal</label>
                                        <div class="col-sm-8">
                                            <div class="input-group date dtp">
                                                <input type="text" name="sch_date" class="form-control input-group-addon" />
                                                <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Jam</label>
                                        <div class="col-sm-8">
                                            <div class="input-group date dtm">
                                                <input type="text" name="sch_time" class="form-control" />
                                                <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-time"></span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Tempat</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="sch_loc">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Informasi</label>
                                        <div class="col-sm-8">
                                            <textarea name="sch_info" class="form-control inputtxtarea" rows="5"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-offset-3 col-sm-2">
                                            <a href="javascript:void(0)" onclick="save()" id="btnSave" class="btn btn-sm btn-primary">Simpan</a>
                                        </div>
                                        <div class="box col-sm-7">
                                        </div>
                                    </div>                                    
                                </form>
                            </div>                            
                        </div>
                    </div>                    
                </div>
            </div>
		</div>
	</div>
	<footer>
        <div class="container">
            <div class="row">
                <div class="col-am-12">
                    &copy; 2017 Match Advertising | By : IT Team
                </div>
            </div>
        </div>
    </footer>
    <!-- MODAL -->
    <div class="modal fade" id="modal_loading" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">                
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
    <!-- DATETIME -->
    <script src="<?php echo base_url('assets/js/dateTime/moment.js')?>"></script>
    <script src="<?php echo base_url('assets/js/dateTime/bootstrap-datetimepicker.min.js')?>"></script>
    <!-- JM SPINNER -->
    <script src="<?php echo base_url('assets/js/jm.spinner.js')?>"></script>
    <!-- EXTRA JS -->
    <script src="<?php echo base_url('assets/js/extra.js')?>"></script>
    <script>
        $(document).ready(function() 
        {
            access_check();
            var url = '<?php echo site_url('Crud/drop_team/')?>' + $('[name="kar_id"]').val();
            dropdown( url,"team","USR_ID","USG_NAME");
            checkboxes("<?php echo site_url('Crud/drop_dept')?>","cbox","id_d","nama_dept");
            $('.dtp').datetimepicker({
                  format: 'YYYY-MM-DD'
             });
            $('.dtm').datetimepicker({                
                  format: 'HH:mm'
             });
        });

        function member_gen()
        {
            $('#select_kry').empty();
            $('#cbox').parent().removeClass('has-error');
            $.ajax({
            url : '<?php echo base_url('Crud/drop_krybydept')?>',
            type: "POST",
            data: $('#sch_form').serialize(),
            dataType: "JSON",
            success: function(data)
                {                   
                    var select = document.getElementById('select_kry');
                    var option;                    
                    if(data.length != null)
                    {
                        for (var i = 0; i < data.length; i++) 
                        {
                            option = document.createElement('option');
                            option.value = data[i]["id_karyawan"];
                            option.text = data[i]["nama_karyawan"];
                            select.add(option);                            
                        }
                        ms_pick('select_kry');
                    }                    
                },
            error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Tidak Ada Data Yang Dipilih');
                    $('#select_kry').empty();
                }
            });
        }

        function save()
        {
            save_data('<?php echo base_url('Crud/add_schedule')?>','#sch_form');
            // $('.box').jmspinner('large');
            // $.ajax({
            // url: '<?php echo base_url('Crud/tes')?>',
            // type: "POST",
            // data: $('#sch_form').serialize(),
            // dataType: "JSON",
            // success: function(data)
            //     {
            //         alert(data.tes1);
            //         // alert(data.tes2);
            //         alert('selesai');                    
            //         $('.box').jmspinner(false);
            //     },            
            //     error: function (jqXHR, textStatus, errorThrown)
            //     {
            //         alert('Error');                    
            //         $('.box').jmspinner(false);
            //     }
            // });
        }        
    </script>
</body>
</html>