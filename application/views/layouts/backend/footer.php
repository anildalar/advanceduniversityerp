<footer class="main-footer">
				&copy; <?php echo date('Y'); ?> UMS 1.0.0</footer>
			<div class="control-sidebar-bg"></div>
		</div>
		<script>
			$.widget.bridge('uibutton', $.ui.button);
		</script>

		<link href="<?php echo base_url('assets/backend/'); ?>toast-alert/toastr.css" rel="stylesheet" />
		<script src="<?php echo base_url('assets/backend/'); ?>toast-alert/toastr.js"></script>
		<script src="<?php echo base_url('assets/backend/'); ?>bootstrap/js/bootstrap.min.js"></script>
		<script src="<?php echo base_url('assets/backend/'); ?>plugins/select2/select2.full.min.js"></script>
		<script src="<?php echo base_url('assets/backend/'); ?>plugins/input-mask/jquery.inputmask.js"></script>
		<script src="<?php echo base_url('assets/backend/'); ?>plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
		<script src="<?php echo base_url('assets/backend/'); ?>plugins/input-mask/jquery.inputmask.extensions.js"></script>
		<script src="<?php echo base_url('assets/backend/'); ?>dist/js/moment.min.js"></script>
		<script src="<?php echo base_url('assets/backend/'); ?>plugins/daterangepicker/daterangepicker.js"></script>
		<script src="<?php echo base_url('assets/backend/'); ?>plugins/colorpicker/bootstrap-colorpicker.min.js"></script>
		<script src="<?php echo base_url('assets/backend/'); ?>plugins/timepicker/bootstrap-timepicker.min.js"></script>
		<script src="<?php echo base_url('assets/backend/'); ?>plugins/slimScroll/jquery.slimscroll.min.js"></script>
		<script src="<?php echo base_url('assets/backend/'); ?>dist/js/jquery.mCustomScrollbar.concat.min.js"></script>

		<script type="text/javascript">
			$(document).ready(function() {
				$(".studentsidebar").mCustomScrollbar({
					theme: "minimal"
				});

				$('.studentsideclose, .overlay').on('click', function() {
					$('.studentsidebar').removeClass('active');
					$('.overlay').fadeOut();
				});

				$('#sidebarCollapse').on('click', function() {
					$('.studentsidebar').addClass('active');
					$('.overlay').fadeIn();
					$('.collapse.in').toggleClass('in');
					$('a[aria-expanded=true]').attr('aria-expanded', 'false');
				});
			});
		</script>

		<script src="<?php echo base_url('assets/backend/'); ?>plugins/iCheck/icheck.min.js"></script>
		<script src="<?php echo base_url('assets/backend/'); ?>plugins/datepicker/bootstrap-datepicker.js"></script>
		<script src="<?php echo base_url('assets/backend/'); ?>plugins/chartjs/Chart.min.js"></script>
		<script src="<?php echo base_url('assets/backend/'); ?>plugins/fastclick/fastclick.min.js"></script>
		<!-- <script type="text/javascript" src="backend/dist/js/bootstrap-filestyle.min.js"></script> -->
		<script src="<?php echo base_url('assets/backend/'); ?>dist/js/app.min.js"></script>

		<!--nprogress-->
		<script src="<?php echo base_url('assets/backend/'); ?>dist/js/nprogress.js"></script>
		<!--file dropify-->
		<script src="<?php echo base_url('assets/backend/'); ?>dist/js/dropify.min.js"></script>

		<script type="text/javascript" src="<?php echo base_url('assets/backend/'); ?>dist/datatables/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url('assets/backend/'); ?>dist/datatables/js/dataTables.buttons.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url('assets/backend/'); ?>dist/datatables/js/jszip.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url('assets/backend/'); ?>dist/datatables/js/pdfmake.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url('assets/backend/'); ?>dist/datatables/js/vfs_fonts.js"></script>
		<script type="text/javascript" src="<?php echo base_url('assets/backend/'); ?>dist/datatables/js/buttons.html5.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url('assets/backend/'); ?>dist/datatables/js/buttons.print.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url('assets/backend/'); ?>dist/datatables/js/buttons.colVis.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url('assets/backend/'); ?>dist/datatables/js/dataTables.responsive.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url('assets/backend/'); ?>dist/datatables/js/ss.custom.js"></script>
		<!-- jQuery 3 -->
		<!--script src="<?php echo base_url('assets/backend/'); ?>dist/js/pages/dashboard2.js"></script-->
		<script src="<?php echo base_url('assets/backend/'); ?>fullcalendar/dist/fullcalendar.min.js"></script>

		<script type="text/javascript">
			$(document).ready(function() {

			});

			function complete_event(id, status) {

				$.ajax({
					url: "https://demo1.smart-school.in/admin/calendar/markcomplete/" + id,
					type: "POST",
					data: {
						id: id,
						active: status
					},
					dataType: 'json',

					success: function(res) {

						if (res.status == "fail") {

							var message = "";
							$.each(res.error, function(index, value) {

								message += value;
							});
							errorMsg(message);

						} else {

							successMsg(res.message);

							window.location.reload(true);
						}

					}

				});
			}

			function markc(id) {

				$('#newcheck' + id).change(function() {

					if (this.checked) {

						complete_event(id, 'yes');
					} else {

						complete_event(id, 'no');
					}

				});
			}
		</script>

		<!-- Button trigger modal -->
		<!-- Modal -->
		<div class="row">
			<div class="modal fade" id="sessionModal" tabindex="-1" role="dialog" aria-labelledby="sessionModalLabel">
				<form action="https://demo1.smart-school.in/admin/admin/activeSession" id="form_modal_session" class="form-horizontal">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h4 class="modal-title" id="sessionModalLabel">Session</h4>
							</div>
							<div class="modal-body sessionmodal_body pb0">

							</div>
							<div class="modal-footer">

								<button type="button" class="btn btn-primary submit_session" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Please wait..">Save</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
		<script type="text/javascript">
			function savedata(eventData) {
				var base_url = 'https://demo1.smart-school.in/';
				$.ajax({
					url: base_url + 'admin/calendar/saveevent',
					type: 'POST',
					data: eventData,
					dataType: "json",
					success: function(msg) {
						alert(msg);

					}
				});
			}

			$calendar = $('#calendar');
			var base_url = 'https://demo1.smart-school.in/';
			today = new Date();
			y = today.getFullYear();
			m = today.getMonth();
			d = today.getDate();
			var viewtitle = 'month';
			var pagetitle = "Dashboard";

			if (pagetitle == "Dashboard") {

				viewtitle = 'agendaWeek';
			}

			$calendar.fullCalendar({
				viewRender: function(view, element) {
					// We make sure that we activate the perfect scrollbar when the view isn't on Month
					//if (view.name != 'month'){
					//  $(element).find('.fc-scroller').perfectScrollbar();
					//}
				},

				header: {
					center: 'title',
					right: 'month,agendaWeek,agendaDay',
					left: 'prev,next,today'
				},
				defaultDate: today,
				defaultView: viewtitle,
				selectable: true,
				selectHelper: true,
				views: {
					month: { // name of view
						titleFormat: 'MMMM YYYY'
							// other view-specific options here
					},
					week: {
						titleFormat: " MMMM D YYYY"
					},
					day: {
						titleFormat: 'D MMM, YYYY'
					}
				},
				timezone: "Asia/Kolkata",
				draggable: false,

				editable: false,
				eventLimit: false, // allow "more" link when too many events

				// color classes: [ event-blue | event-azure | event-green | event-orange | event-red ]
				events: {
					url: base_url + 'admin/calendar/getevents'

				},

				eventRender: function(event, element) {
					element.attr('title', event.title);
					element.attr('onclick', event.onclick);
					element.attr('data-toggle', 'tooltip');
					if ((!event.url) && (event.event_type != 'task')) {
						element.attr('title', event.title + '-' + event.description);
						element.click(function() {
							view_event(event.id);
						});
					}
				},
				dayClick: function(date, jsEvent, view) {
					var d = date.format();
					if (!$.fullCalendar.moment(d).hasTime()) {
						d += ' 05:30';
					}
					//var vformat = (app_time_format == 24 ? app_date_format + ' H:i' : app_date_format + ' g:i A');

					$("#input-field").val('');
					$("#desc-field").text('');
					$("#date-field").daterangepicker({
						startDate: date,
						endDate: date,
						timePicker: true,
						timePickerIncrement: 5,
						locale: {
							format: 'MM/DD/YYYY hh:mm a'
						}
					});
					$('#newEventModal').modal('show');

					return false;
				}

			});

			$(document).ready(function() {
				$("#date-field").daterangepicker({
					timePicker: true,
					timePickerIncrement: 5,
					locale: {
						format: 'MM/DD/YYYY hh:mm A'
					}
				});

			});

			function datepic() {
				$("#date-field").daterangepicker();
			}

			function view_event(id) {
				//$("#28B8DA").removeClass('cpicker-small').addClass('cpicker-big');
				$('.selectevent').find('.cpicker-big').removeClass('cpicker-big').addClass('cpicker-small');
				var base_url = 'https://demo1.smart-school.in/';
				if (typeof(id) == 'undefined') {
					return;
				}
				$.ajax({
					url: base_url + 'admin/calendar/view_event/' + id,
					type: 'POST',
					//data: '',
					dataType: "json",
					success: function(msg) {

						$("#event_title").val(msg.event_title);
						$("#event_desc").text(msg.event_description);
						$('#eventdates').val(msg.start_date + '-' + msg.end_date);
						$('#eventid').val(id);
						if (msg.event_type == 'public') {

							$('input:radio[name=eventtype]')[0].checked = true;

						} else if (msg.event_type == 'private') {
							$('input:radio[name=eventtype]')[1].checked = true;

						} else if (msg.event_type == 'sameforall') {
							$('input:radio[name=eventtype]')[2].checked = true;

						} else if (msg.event_type == 'protected') {
							$('input:radio[name=eventtype]')[3].checked = true;

						}
						// $("#red#28B8DA").removeClass('cpicker-big').addClass('cpicker-small');

						//$(this).removeClass('cpicker-small', 'fast').addClass('cpicker-big', 'fast');
						$("#eventdates").daterangepicker({
							startDate: msg.startdate,
							endDate: msg.enddate,
							timePicker: true,
							timePickerIncrement: 5,
							locale: {
								format: 'MM/DD/YYYY hh:mm A'
							}
						});
						$("#event_color").val(msg.event_color);
						$("#delete_event").attr("onclick", "deleteevent(" + id + ",'Event')")

						// $("#28B8DA").removeClass('cpicker-big').addClass('cpicker-small');
						$("#" + msg.colorid).removeClass('cpicker-small').addClass('cpicker-big');
						$('#viewEventModal').modal('show');
					}
				});

			}

			$(document).ready(function(e) {
				$("#addevent_form").on('submit', (function(e) {

					e.preventDefault();
					$.ajax({
						url: "https://demo1.smart-school.in/admin/calendar/saveevent",
						type: "POST",
						data: new FormData(this),
						dataType: 'json',
						contentType: false,
						cache: false,
						processData: false,
						success: function(res) {

							if (res.status == "fail") {

								var message = "";
								$.each(res.error, function(index, value) {

									message += value;
								});
								errorMsg(message);

							} else {

								successMsg(res.message);

								window.location.reload(true);
							}
						}
					});
				}));

			});

			$(document).ready(function(e) {
				$("#updateevent_form").on('submit', (function(e) {

					e.preventDefault();
					$.ajax({
						url: "https://demo1.smart-school.in/admin/calendar/updateevent",
						type: "POST",
						data: new FormData(this),
						dataType: 'json',
						contentType: false,
						cache: false,
						processData: false,
						success: function(res) {

							if (res.status == "fail") {

								var message = "";
								$.each(res.error, function(index, value) {

									message += value;
								});
								errorMsg(message);

							} else {

								successMsg(res.message);

								window.location.reload(true);
							}
						}
					});
				}));

			});

			function deleteevent(id, msg) {
				if (typeof(id) == 'undefined') {
					return;
				}
				if (confirm("Are you sure to delete this " + msg + " !")) {
					$.ajax({
						url: base_url + 'admin/calendar/delete_event/' + id,
						type: 'POST',
						//data: '',
						dataType: "json",
						success: function(res) {
							if (res.status == "fail") {

								errorMsg(res.message);

							} else {

								successMsg(msg + " Deleted Succssfully.");

								window.location.reload(true);
							}
						}

					})
				}

			}

			$("body").on('click', '.cpicker', function() {
				var color = $(this).data('color');
				// Clicked on the same selected color
				if ($(this).hasClass('cpicker-big')) {
					return false;
				}

				$(this).parents('.cpicker-wrapper').find('.cpicker-big').removeClass('cpicker-big').addClass('cpicker-small');
				$(this).removeClass('cpicker-small', 'fast').addClass('cpicker-big', 'fast');
				if ($(this).hasClass('kanban-cpicker')) {
					$(this).parents('.panel-heading-bg').css('background', color);
					$(this).parents('.panel-heading-bg').css('border', '1px solid ' + color);
				} else if ($(this).hasClass('calendar-cpicker')) {
					$("body").find('input[name="eventcolor"]').val(color);
				}
			});
		</script>
	</body>

</html>