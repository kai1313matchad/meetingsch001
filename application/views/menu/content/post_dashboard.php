	<div class="content-wrapper">
		<div class="container">
			<div class="row">
                <div class="col-sm-12 col-xs-12">
                    <h4 class="page-head-line">Beranda</h4>
                </div>
            </div>
            <div class="row" id="nav_menu_post">
            	<div class="col-md-3 col-sm-3 col-xs-6">
                    <div class="dashboard-div-wrapper bk-clr-five">
                        <a href="<?php echo base_url('Post/create')?>">
                            <i  class="fa fa-calendar-plus-o dashboard-div-icon" ></i>
                        </a>                        
                        <div class="progress progress-striped active">
						</div>
                        <h5>Buat Jadwal</h5>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-6">
                    <div class="dashboard-div-wrapper bk-clr-five">
                        <a href="<?php echo base_url('Post/edit')?>">
                            <i  class="fa fa-edit dashboard-div-icon" ></i>
                        </a>                        
                        <div class="progress progress-striped active">
						</div>
                        <h5>Reschedule Jadwal</h5>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-6">
                    <div class="dashboard-div-wrapper bk-clr-five">
                        <a href="<?php echo base_url('Post/notulen')?>">
                            <i  class="fa fa-pencil dashboard-div-icon" ></i>
                        </a>                        
                        <div class="progress progress-striped active">
						</div>
                        <h5>Tulis Notulensi</h5>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-6">
                    <div class="dashboard-div-wrapper bk-clr-five">
                        <a href="<?php echo base_url('Post/reminder')?>">
                            <i  class="fa fa-envelope-o dashboard-div-icon" ></i>
                        </a>                        
                        <div class="progress progress-striped active">
                        </div>
                        <h5>Reminder</h5>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 col-sm-3 col-xs-6">
                    <div class="dashboard-div-wrapper bk-clr-five">
                        <a href="<?php echo base_url('Post/result')?>">
                            <i  class="fa fa-print dashboard-div-icon" ></i>
                        </a>                        
                        <div class="progress progress-striped active">
                        </div>
                        <h5>Laporan</h5>
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
    <!-- Jquery -->
    <!-- CORE JQUERY SCRIPTS -->
    <script src="<?php echo base_url('assets/js/jquery-1.11.1.js')?>"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="<?php echo base_url('assets/js/bootstrap.js')?>"></script>
    <!-- DATATABLES -->
    <script src="<?php echo base_url('assets/js/datatables/jquery.dataTables.min.js')?>"></script>
    <script src="<?php echo base_url('assets/js/datatables/dataTables.bootstrap.min.js')?>"></script>
    <script src="<?php echo base_url('assets/js/datatables/dataTables.responsive.js')?>"></script>
    <!-- EXTRA JS -->
    <script src="<?php echo base_url('assets/js/extra.js')?>"></script>
    <script>
        $(document).ready(function() {
            access_check();
        });
    </script>
</body>
</html>