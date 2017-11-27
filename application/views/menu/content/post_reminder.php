	<div class="content-wrapper">
		<div class="container">
			<div class="row">
                <div class="col-sm-12 col-xs-12">
                    <h4 class="page-head-line">Reminder Jadwal</h4>
                </div>
            </div>
            <div class="row">
            	<form>
                    <input type="hidden" name="user_id" value="4">
                    <input type="hidden" name="user_group" value="1">
                    <input type="hidden" name="kar_id" value="71">
                    <input type="hidden" name="sch_id">
                </form>
            </div>
            <div class="row">
                <div class="box col-sm-12"></div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-xs-12 table-responsive">
                    <table id="dtb_schreminder" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th class="text-center">Tema Meeting</th>
                                <th class="text-center">Tanggal</th>
                                <th class="text-center">Creator</th>
                                <th class="text-center">Info</th>
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
                    &copy; 2015 YourCompany | By : <a href="http://www.designbootstrap.com/" target="_blank">DesignBootstrap</a>
                </div>
            </div>
        </div>
    </footer>
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
        $(document).ready(function() {
            var id = $('[name="kar_id"]').val();
            var url = '<?php echo base_url('Showdata/show_schreminder/')?>'+id;            
            dt_schreminder(url);
        });

        function pick_schreminder(id)
        {
            $('#loading')
            $('.box').jmspinner('large');
            $.ajax({
            url: '<?php echo base_url('Crud/schedule_reminder/')?>'+id,
            type: "POST",
            // data: $('#schedit_form').serialize(),
            dataType: "JSON",
            success: function(data)
                {
                    alert('Email Reminder Sudah Terkirim');
                    $('.box').jmspinner(false);
                },            
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error');                    
                    $('.box').jmspinner(false);
                }
            });
        }
    </script>
</body>
</html>