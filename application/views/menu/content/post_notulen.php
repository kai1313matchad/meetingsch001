	<div class="content-wrapper">
		<div class="container">
			<div class="row">
                <div class="col-sm-12 col-xs-12">
                    <h4 class="page-head-line">Tambah Notulen</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 col-xs-6 col-sm-offset-3 col-xs-offset-3">
                    <div class="panel panel-default">
                        <div class="panel-heading text-center">
                            <h4>Jadwal Meeting</h4>
                        </div>
                        <div class="panel-body">                            
                            <form class="form-horizontal" id="schnotulen_form">
                                <!-- <input type="hidden" name="user_group" value="1"> -->
                                <input type="hidden" name="kar_id" value="<?php echo $this->session->userdata('kar_id')?>">
                                <input type="hidden" name="sch_id">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Tema Meeting</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" name="sch_title" readonly>
                                    </div>
                                    <div class="col-sm-2">
                                        <a href="javascript:void(0)" onclick="srch_sch()" class="btn btn-sm btn-info"><span class="glyphicon glyphicon-search"></span> Cari</a>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Team</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="user_id" readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Dept. Terkait</label>
                                    <div class="col-sm-8" id="cbox">
                                        <input type="text" class="form-control" name="sch_dept" readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Anggota</label>
                                    <div class="col-sm-8">
                                        <textarea name="sch_member" class="form-control inputtxtarea" rows="1" readonly></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Tanggal</label>
                                    <div class="col-sm-8">
                                        <div class="input-group date dtp">
                                            <input type="text" name="sch_date" class="form-control input-group-addon" readonly />
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
                                            <input type="text" name="sch_time" class="form-control" readonly />
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-time"></span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Informasi</label>
                                    <div class="col-sm-8">
                                        <textarea name="sch_info" class="form-control inputtxtarea" rows="2" readonly></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                        <label class="col-sm-3 control-label">Tempat</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="sch_loc" readonly>
                                        </div>
                                    </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Notulen</label>
                                    <div class="col-sm-8">
                                        <label class="radio-inline"><input type="radio" onclick="show()" name="edit_notulen" value="0">Tampilkan</label>
                                        <label class="radio-inline"><input type="radio" onclick="hide()" name="edit_notulen" value="1">Sembunyikan</label> 
                                    </div>
                                </div>
                                <div id="ntln">
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <textarea id="notulen" name="sch_notulen" class="form-control" rows="30"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-2">
                                        <a href="javascript:void(0)" onclick="save()" id="btnSave" class="btn btn-sm btn-primary">Simpan</a>
                                    </div>
                                    <div class="col-sm-offset-1 col-sm-2">
                                        <a href="javascript:void(0)" onclick="save2()" id="btnSave2" class="btn btn-sm btn-primary">Simpan Sebagai Daft</a>
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
    <div class="modal fade" id="modal_edit_sch" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="myModalLabel">Create Item</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12 col-xs-12 table-responsive">
                            <table id="dtb_search_sch" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Judul</th>                                        
                                        <th>Tanggal</th>
                                        <th>Jam</th>
                                        <th>Creator</th>
                                        <th>Pilih</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>                  
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove-circle"></span> Cancel</button>
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
    <!-- DATETIME -->
    <script src="<?php echo base_url('assets/js/dateTime/moment.js')?>"></script>
    <script src="<?php echo base_url('assets/js/dateTime/bootstrap-datetimepicker.min.js')?>"></script>
    <!-- JM SPINNER -->
    <script src="<?php echo base_url('assets/js/jm.spinner.js')?>"></script>
    <!-- CKEDITOR -->
    <script src="<?php echo base_url('assets/js/ckeditor/ckeditor.js')?>"></script>
    <!-- WYSIWIG -->
    <!-- <script src="<?php echo base_url('assets/js/wysihtml5/bootstrap3-wysihtml5.all.min.js')?>"></script> -->
    <!-- EXTRA JS -->
    <script src="<?php echo base_url('assets/js/extra.js')?>"></script>
    <script>
        $(document).ready(function() 
        {
            CKEDITOR.replace('notulen',{
                customConfig: 'config.js'
            });            
            $('#ntln').css({'display':'none'});
            $('#btnSave').attr('disabled',true);
            $('.dtp').datetimepicker({
                  format: 'YYYY-MM-DD'
             });
            $('.dtm').datetimepicker({                
                  format: 'HH:mm'
             }); 
        });

        function srch_sch()
        {
            $('#modal_edit_sch').modal('show');
            $('.modal-title').text('Cari Jadwal');
            var id = $('[name="kar_id"]').val();
            var url = '<?php echo base_url('Searchdata/search_schedule/')?>'+id;
            dt_schedule(url);         
        }

        function show()
        {
            $('#ntln').css({'display':'block'});            
            purpose = 'edit';
            $('#btnSave').attr('disabled',false);
        }

        function hide()
        {
            $('#ntln').css({'display':'none'});
            purpose='hapus';
            $('#btnSave').attr('disabled',false);
        }

        function pick_sch(id)
        {            
            $.ajax({
            url : "<?php echo site_url('Crud/get_schtoedit/')?>" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
                {                  
                    $('[name="sch_id"]').val(data.SCH_ID);
                    $('[name="sch_title"]').val(data.SCH_TITLE);                    
                    $('[name="sch_date"]').val(data.SCH_DATE);
                    var a = moment(data.SCH_DATE+' '+data.SCH_TIME).format('HH:mm');
                    $('[name="sch_time"]').val(a);
                    $('[name="sch_info"]').val(data.SCH_INFO);
                    $('[name="sch_loc"]').val(data.SCH_LOC);
                    CKEDITOR.instances['notulen'].setData(data.SCH_NOTULEN);
                    pick_deptlist(id);
                    pick_memlist(id);
                    pick_team(data.USR_ID);
                    $('#modal_edit_sch').modal('hide');                  
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
        }

        function pick_deptlist(id)
        {
            $.ajax({
            url : "<?php echo site_url('Crud/get_deptforinl/')?>" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
                {
                    for (var i = 0; i < data.length; i++)
                    {
                        $('[name="sch_dept"]').val(data[i]["departemen"]);
                    }                    
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
        }

        function pick_memlist(id)
        {
            $.ajax({
            url : "<?php echo site_url('Crud/get_memforinl/')?>" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
                {
                    for (var i = 0; i < data.length; i++)
                    {
                        $('[name="sch_member"]').val(data[i]["anggota"]);
                    }                    
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
        }

        function pick_team(id)
        {
            $.ajax({
            url : "<?php echo site_url('Crud/get_usgname/')?>" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
                {                    
                    $('[name="user_id"]').val(data.USG_NAME);
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
        }

        function save()
        {            
            for (instance in CKEDITOR.instances) 
            {
                CKEDITOR.instances[instance].updateElement();
            }
            update_data('<?php echo base_url('Crud/add_notulen')?>','#schnotulen_form');
        }

        function save2()
        {   
            for (instance in CKEDITOR.instances) 
            {
                CKEDITOR.instances[instance].updateElement();
            }
            update_data('<?php echo base_url('Crud/add_notulen2')?>','#schnotulen_form');
        }        
    </script>
</body>
</html>