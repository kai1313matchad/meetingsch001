	<div class="content-wrapper">
		<div class="container">
			<div class="row">
                <div class="col-sm-12 col-xs-12">
                    <h4 class="page-head-line">Kelola User</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3 col-xs-3">
                    <a href="javascript:void(0)" onclick="addusg_open()" class="btn btn-block btn-primary"><span class="glyphicon glyphicon-floppy-disk"></span> Tambah Team</a>
                </div>                
                <div class="col-sm-3 col-xs-3">
                    <a href="javascript:void(0)" onclick="addusr_open()" class="btn btn-block btn-primary"><span class="glyphicon glyphicon-floppy-disk"></span> Tambah User</a>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3 col-xs-3">
                    <a href="javascript:void(0)" onclick="delusg_open()" class="btn btn-block btn-danger"><span class="glyphicon glyphicon-trash"></span> Hapus Team</a>
                </div>
            </div>
            <br>
            <div class="row" id="tambah_usg">
                <div class="col-sm-6 col-xs-6 col-sm-offset-3 col-xs-offset-3">
                    <div class="panel panel-default">
                        <div class="panel-heading text-center">
                            <h4>Tambah Team</h4>
                        </div>
                        <div class="panel-body">
                            <div class="col-sm-12 col-xs-12">
                                <form class="form-horizontal" id="form_usergroup">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Nama Team</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="nama_group">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-2 col-sm-offset-3">
                                            <a href="javascript:void(0)" onclick="save_usg()" class="btn btn-sm btn-primary" id="btnSave">Simpan</a>
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
            <div class="row" id="hapus_usg">
                <div class="col-sm-6 col-xs-6 col-sm-offset-3 col-xs-offset-3">
                    <div class="panel panel-default">
                        <div class="panel-heading text-center">
                            <h4>Hapus Team</h4>
                        </div>
                        <div class="panel-body">
                            <div class="col-sm-12 col-xs-12">
                                <form class="form-horizontal" id="form_hapususg">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Nama Team</label>
                                        <div class="col-sm-8">
                                            <select class="form-control" name="hapus_divisi" id="delusg">
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-2 col-sm-offset-3">
                                            <a href="javascript:void(0)" onclick="del_usg()" class="btn btn-sm btn-danger" id="btnDel">Hapus</a>
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
            <div class="row" id="tambah_usr">
            	<div class="col-sm-6 col-xs-6 col-sm-offset-3 col-xs-offset-3">
                    <div class="panel panel-default">
                        <div class="panel-heading text-center">
                            <h4 name="panel-title">Tambah User</h4>
                        </div>
                        <div class="panel-body">
                            <div class="col-sm-12 col-xs-12">
                                <form class="form-horizontal" id="form_user">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Team</label>
                                        <div class="col-sm-8">
                                            <select class="form-control" name="divisi" id="usergroup">
                                            </select>
                                        </div>                                        
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Nama</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" name="nama_kry" readonly>
                                            <input type="hidden" name="id_karyawan">
                                            <input type="hidden" name="id_user">
                                            <input type="hidden" name="formstatus">
                                        </div>
                                        <div class="col-sm-2">
                                            <a href="javascript:void(0)" onclick="search_user()" class="btn btn-sm btn-info"><span class="glyphicon glyphicon-search"></span> Cari</a>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Hak Akses</label>
                                        <div class="col-sm-8">
                                            <select class="form-control" name="akses" id="userakses">
                                                <option value="">Pilih</option>
                                                <option value="0">Administrator</option>
                                                <option value="1">Head</option>
                                                <option value="2">Secretary</option>               
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-2 col-sm-offset-3">
                                            <a href="javascript:void(0)" onclick="save_usr()" class="btn btn-sm btn-primary" id="btnSave">Simpan</a>
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
            <div class="row">
                <div class="col-sm-12 col-xs-12 table-responsive">
                    <table id="dtb_user" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th class="text-center">Nama Team</th>
                                <th class="text-center">Nama</th>
                                <th class="text-center">Jabatan</th>
                                <th class="text-center">Hak Akses</th>
                                <th>Pilih</th>
                            </tr>
                        </thead>
                    </table>
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
    <div class="modal fade" id="modal_user" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="myModalLabel">Create Item</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12 col-xs-12 table-responsive">
                            <table id="dtb_karyawan" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th class="text-center">Nama</th>     
                                        <th class="text-center">Jabatan</th>
                                        <th class="text-center">Pangkat</th>
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
    <!-- JM SPINNER -->
    <script src="<?php echo base_url('assets/js/jm.spinner.js')?>"></script>
    <!-- EXTRA JS -->
    <script src="<?php echo base_url('assets/js/extra.js')?>"></script>
    <script>
        $(document).ready(function() 
        {            
            dt_user("<?php echo site_url('Showdata/show_user')?>");
            dt_karyawan("<?php echo site_url('Searchdata/search_user')?>");
            $('#tambah_usg').css({'display':'none'});
            $('#tambah_usr').css({'display':'none'});
            $('#hapus_usg').css({'display':'none'});
        });

        function addusg_open()
        {
            if(!$('#tambah_usg').is(':visible'))
            {
                $('#tambah_usg').css({'display':'block'});
            }
            else
            {
                $('#tambah_usg').css({'display':'none'});
            }
        }

        function addusr_open()
        {
            dropdown("<?php echo site_url('Crud/drop_usergroup')?>","usergroup","USG_ID","USG_NAME");
            if(!$('#tambah_usr').is(':visible'))
            {
                $('#tambah_usr').css({'display':'block'});
            }
            else
            {
                $('#tambah_usr').css({'display':'none'});
            }
        }

        function delusg_open()
        {
            dropdown("<?php echo site_url('Crud/drop_usergroup')?>","delusg","USG_ID","USG_NAME");
            if(!$('#hapus_usg').is(':visible'))
            {
                $('#hapus_usg').css({'display':'block'});
            }
            else
            {
                $('#hapus_usg').css({'display':'none'});
            }
        } 

        function search_user()
        {
            $('#modal_user').modal('show');
            $('.modal-title').text('Pilih Karyawan');
        }

        function pick_kry(id)
        {
            $.ajax({
                url : "<?php echo site_url('Crud/get_kry/')?>" + id,
                type: "GET",
                dataType: "JSON",
                success: function(data)
                {   
                    $('[name="id_karyawan"]').val(data.id_karyawan);
                    $('[name="nama_kry"]').val(data.nama_karyawan);
                    $('#modal_user').modal('hide');
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
        }

        function pick_user(id)
        {
            dropdown("<?php echo site_url('Crud/drop_usergroup')?>","usergroup","USG_ID","USG_NAME");
            $.ajax({
                url : "<?php echo site_url('Crud/get_user/')?>" + id,
                type: "GET",
                dataType: "JSON",
                success: function(data)
                {   
                    $('[name="id_user"]').val(data.USR_ID);
                    $('[name="id_karyawan"]').val(data.KAR_ID);
                    $('#usergroup option[value="' + data.USG_ID + '"]').prop('selected',true);
                    $('#userakses option[value="' + data.USR_ACCESS + '"]').prop('selected',true);
                    $('[name="nama_kry"]').val(data.nama_karyawan);
                    $('[name="formstatus"]').val('update');
                    $('#tambah_usr').css({'display':'block'});
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
        }

        function del_usg()
        {            
            delete_data('<?php echo site_url('Crud/del_usergroup/')?>','#form_hapususg');
            dropdown("<?php echo site_url('Crud/drop_usergroup')?>","usergroup","USG_ID","USG_NAME");
            dropdown("<?php echo site_url('Crud/drop_usergroup')?>","delusg","USG_ID","USG_NAME");
        }

        function save_usg()
        {
            save_data("<?php echo site_url('Crud/add_usergroup')?>","#form_usergroup");
            dropdown("<?php echo site_url('Crud/drop_usergroup')?>","usergroup","USG_ID","USG_NAME");
            dropdown("<?php echo site_url('Crud/drop_usergroup')?>","delusg","USG_ID","USG_NAME");
        }

        function save_usr()
        {
            var sts = $('[name="formstatus"]').val();
            if (sts == 'update') 
            {
                update_data("<?php echo site_url('Crud/update_user')?>","#form_user");
                $('[name="formstatus"]').val('');
                $('#form_user')[0].reset();
                addusr_open();
                addusg_open();
                delusg_open();
            }
            else
            {
                save_data("<?php echo site_url('Crud/add_user')?>","#form_user");
            }            
            dt_user("<?php echo site_url('Showdata/show_user')?>");
        }

        function del_user(id)
        {
            var url = '<?php echo site_url('Crud/del_user/')?>'+id;
            delete_data2(url);
            dt_user("<?php echo site_url('Showdata/show_user')?>");
        }
    </script>
</body>
</html>