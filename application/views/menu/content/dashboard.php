	<div class="content-wrapper">
		<div class="container">
			<div class="row">
                <div class="col-sm-12 col-xs-12">
                    <h4 class="page-head-line">Schedule Meeting</h4>
                </div>
            </div>
            <div class="row">             
                <?php
                    if($this->session->flashdata('success'))
                    {
                        echo $this->session->flashdata('success');
                    }                    
                ?>
            </div>
			<div class="row">
				<div id="calendar" class="col-sm-8 col-sm-offset-2">
				</div>
			</div>
		</div>
	</div>
	<footer>
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    &copy; 2017 Match Advertising | By : IT Team | Theme : <a href="http://www.designbootstrap.com/" target="_blank">DesignBootstrap</a>
                </div>
            </div>
        </div>
    </footer>
    <!-- MODAL -->
    <div class="modal fade" id="calendarModal" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="myModalLabel">Create Item</h4>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-xs-3 control-label">Tema</label>
                                <div class="col-xs-9">
                                    <span name="sch_title"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-xs-3 control-label">Departemen</label>
                                <div class="col-xs-9">
                                    <span name="sch_dept"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-xs-3 control-label">Peserta</label>
                                <div class="col-xs-9">
                                    <span name="sch_member"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-xs-3 control-label">Tempat</label>
                                <div class="col-xs-9">
                                    <span name="sch_loc"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-xs-3 control-label">Tanggal</label>
                                <div class="col-xs-9">
                                    <span name="sch_date"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-xs-3 control-label">Jam</label>
                                <div class="col-xs-9">
                                    <span name="sch_time"></span>
                                </div>
                            </div> 
                        </div>
                    </form>
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
    <!-- FULLCALENDAR -->
    <script src="<?php echo base_url('assets/fullcalendar/lib/moment.min.js')?>"></script>
    <script src="<?php echo base_url('assets/fullcalendar/fullcalendar.js')?>"></script>
    <script src="<?php echo base_url('assets/fullcalendar/locale-all.js')?>"></script>
    <!-- EXTRA JS -->
    <script src="<?php echo base_url('assets/js/extra.js')?>"></script>
    <script>
    	$(document).ready(function() {
            // access_check();
    		$('#calendar').fullCalendar({    			
    			header: 
    			{
    				left: 'today,month,listMonth',
    				center: 'title',
    				right: 'prev,next'
    			},
    			views: 
    			{
    				// listWeek: { buttonText: 'Minggu'}
    			},
    			locale: 'id',
    			navLinks: true,
    			eventLimit: true,
    			// events:
    			// [    				
    			// 	{
    			// 		title: 'Meeting Marketing AAaaaaa',
    			// 		// url: 'http://www.google.com',
    			// 		start: '2017-10-23T10:30:00'
    			// 		// end: '2017-10-23T12:30:00'
    			// 	},
    			// 	{
    			// 		title: 'Meeting Marketing AAaaaaa',
    			// 		// url: 'http://www.google.com',
    			// 		start: '2017-10-23T10:30:00'
    			// 		// end: '2017-10-23T12:30:00'
    			// 	}
    			// ]
    			eventSources: 
    			[
    				{
    					events: function(start, end, timezone, callback)
    					{
    						$.ajax({
    							url: '<?php echo site_url('Dashboard/resources')?>',
	    						dataType: 'JSON',
	    						data: 
	    						{
	    							start: start.unix(),
	    							end: end.unix()
	    						},
	    						success: function(msg)
	    						{
	    							var events = msg.events;
	    							callback(events);
	    						}
    						});
    					}	    				
	    			}
    			],
                eventClick:  function(event, jsEvent, view) {
                    $('.modal-title').text('Jadwal Meeting');
                    $('#modalBody').html(event.description);
                    $('[name="sch_id"]').val(event.id);
                    $('[name="sch_title"]').text(event.title);
                    $('[name="sch_dept"]').text(event.dept);
                    $('[name="sch_member"]').text(event.anggota);
                    $('[name="sch_loc"]').text(event.lokasi);
                    $('[name="sch_date"]').text(event.tanggal);
                    $('[name="sch_time"]').text(event.jam);
                    // $('#eventUrl').attr('href',event.url);
                    $('#calendarModal').modal();
                },
    		});
    	});
    </script>
</body>
</html>