<div class="content-wrapper" style="min-height: 946px;">
	<section class="content">
		<div class="row">
			<div class="col-md-12">

			</div>

			<div class="col-md-9">
				<div class="row">

					<div class="col-md-4 col-sm-6">
						<div class="info-box">
							<a href="https://demo1.smart-school.in/studentfee">
								<span class="info-box-icon bg-green"><i class="fa fa-money"></i></span>
								<div class="info-box-content">
									<span class="info-box-text">Monthly Fees Collection</span>
									<span class="info-box-number">$0</span>
								</div>
							</a>
						</div>
					</div>

					<div class="col-md-4 col-sm-6">
						<div class="info-box">
							<a href="https://demo1.smart-school.in/admin/expense">
								<span class="info-box-icon bg-red"><i class="fa fa-credit-card"></i></span>
								<div class="info-box-content">
									<span class="info-box-text">Monthly Expenses</span>
									<span class="info-box-number">$0</span>
								</div>
							</a>
						</div>
					</div>

					<div class="col-md-4 col-sm-6">
						<div class="info-box">
							<a href="https://demo1.smart-school.in/student/search">
								<span class="info-box-icon bg-aqua"><i class="fa fa-user"></i></span>
								<div class="info-box-content">
									<span class="info-box-text">Student</span>
									<span class="info-box-number">12</span>
								</div>
							</a>
						</div>
					</div>
					<div class="col-md-12 col-sm-12">

						<div class="box box-primary">
							<div class="box-header with-border">
								<h3 class="box-title">Fees Collection & Expenses For December 2019</h3>
								<div class="box-tools pull-right">
									<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
									<button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
								</div>
							</div>
							<div class="box-body">
								<div class="chart">
									<canvas id="barChart" style="height:250px"></canvas>
								</div>
							</div>
						</div>

						<div class="box box-info">
							<div class="box-header with-border">
								<h3 class="box-title">Fees Collection & Expenses For Session 2018-19</h3>
								<div class="box-tools pull-right">
									<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
									<button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
								</div>
							</div>
							<div class="box-body">
								<div class="chart">
									<canvas id="lineChart" style="height:250px"></canvas>
								</div>
							</div>
						</div>
						<div class="box box-primary">
							<div class="box-body">
								<!-- THE CALENDAR -->
								<div id="calendar"></div>
							</div>
							<!-- /.box-body -->
						</div>
						<!-- /. box -->

					</div>
				</div>
			</div>

			<div class="col-md-3">

				<div class="info-box">
					<a href="#">
						<span class="info-box-icon bg-yellow"><i class="fa fa-user-secret"></i></span>
						<div class="info-box-content">
							<span class="info-box-text">Teacher</span>
							<span class="info-box-number">3</span>
						</div>
					</a>
				</div>

				<div class="info-box">
					<a href="#">
						<span class="info-box-icon bg-yellow"><i class="fa fa-user-secret"></i></span>
						<div class="info-box-content">
							<span class="info-box-text">Accountant</span>
							<span class="info-box-number">1</span>
						</div>
					</a>
				</div>

				<div class="info-box">
					<a href="#">
						<span class="info-box-icon bg-yellow"><i class="fa fa-user-secret"></i></span>
						<div class="info-box-content">
							<span class="info-box-text">Librarian</span>
							<span class="info-box-number">1</span>
						</div>
					</a>
				</div>

				<div class="info-box">
					<a href="#">
						<span class="info-box-icon bg-yellow"><i class="fa fa-user-secret"></i></span>
						<div class="info-box-content">
							<span class="info-box-text">Receptionist</span>
							<span class="info-box-number">1</span>
						</div>
					</a>
				</div>

				<div class="info-box">
					<a href="#">
						<span class="info-box-icon bg-yellow"><i class="fa fa-user-secret"></i></span>
						<div class="info-box-content">
							<span class="info-box-text">Super Admin</span>
							<span class="info-box-number">1</span>
						</div>
					</a>
				</div>

			</div>

		</div>

</div>
<div id="newEventModal" class="modal fade " role="dialog">
	<div class="modal-dialog modal-dialog2 modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Add New Event</h4>
			</div>
			<div class="modal-body">

				<div class="row">
					<form role="form" id="addevent_form" method="post" enctype="multipart/form-data" action="">
						<div class="form-group col-md-12">
							<label for="exampleInputEmail1">Event Title</label>
							<input class="form-control" name="title" id="input-field">
							<span class="text-danger"></span>

						</div>

						<div class="form-group col-md-12">
							<label for="exampleInputEmail1">Description</label>
							<textarea name="description" class="form-control" id="desc-field"></textarea>
						</div>
						<div class="form-group col-md-12">
							<label for="exampleInputEmail1">Event Date</label>
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</div>
								<input type="text" autocomplete="off" name="event_dates" class="form-control pull-right" id="date-field">
							</div>
							<!-- <input class="form-control" type="text" autocomplete="off"  name="event_dates" id="date-field"> -->
						</div>
						<div class="form-group col-md-12">
							<label for="exampleInputEmail1">Event Color</label>
							<input type="hidden" name="eventcolor" autocomplete="off" id="eventcolor" class="form-control">
						</div>
						<div class="form-group col-md-12">

							<div class="cpicker-wrapper">
								<div class='calendar-cpicker cpicker cpicker-big' data-color='#03a9f4' style='background:#03a9f4;border:1px solid #03a9f4; border-radius:100px'></div>
								<div class='calendar-cpicker cpicker cpicker-small' data-color='#c53da9' style='background:#c53da9;border:1px solid #c53da9; border-radius:100px'></div>
								<div class='calendar-cpicker cpicker cpicker-small' data-color='#757575' style='background:#757575;border:1px solid #757575; border-radius:100px'></div>
								<div class='calendar-cpicker cpicker cpicker-small' data-color='#8e24aa' style='background:#8e24aa;border:1px solid #8e24aa; border-radius:100px'></div>
								<div class='calendar-cpicker cpicker cpicker-small' data-color='#d81b60' style='background:#d81b60;border:1px solid #d81b60; border-radius:100px'></div>
								<div class='calendar-cpicker cpicker cpicker-small' data-color='#7cb342' style='background:#7cb342;border:1px solid #7cb342; border-radius:100px'></div>
								<div class='calendar-cpicker cpicker cpicker-small' data-color='#fb8c00' style='background:#fb8c00;border:1px solid #fb8c00; border-radius:100px'></div>
								<div class='calendar-cpicker cpicker cpicker-small' data-color='#fb3b3b' style='background:#fb3b3b;border:1px solid #fb3b3b; border-radius:100px'></div>
							</div>
						</div>

						<div class="form-group col-md-12">
							<label for="exampleInputEmail1">Event Type</label>
							<br/>
							<label class="radio-inline">

								<input type="radio" name="event_type" value="public" id="public">Public </label>
							<label class="radio-inline">

								<input type="radio" name="event_type" value="private" checked id="private">Private </label>
							<label class="radio-inline">

								<input type="radio" name="event_type" value="sameforall" id="public">All Super Admin </label>
							<label class="radio-inline">

								<input type="radio" name="event_type" value="protected" id="public">Protected </label>
						</div>

						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<input type="submit" class="btn btn-primary submit_addevent pull-right" value="Save">
						</div>
					</form>
				</div>

			</div>
		</div>
	</div>
</div>
<div id="viewEventModal" class="modal fade " role="dialog">
	<div class="modal-dialog modal-dialog2 modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">View Event</h4>
			</div>
			<div class="modal-body">

				<div class="row">
					<form role="form" method="post" id="updateevent_form" enctype="multipart/form-data" action="">
						<div class="form-group col-md-12">
							<label for="exampleInputEmail1">EventTitle</label>
							<input class="form-control" name="title" placeholder="Event Title" id="event_title">
						</div>
						<div class="form-group col-md-12">
							<label for="exampleInputEmail1">Description</label>
							<textarea name="description" class="form-control" placeholder="Event Description" id="event_desc"></textarea>
						</div>
						<div class="form-group col-md-12">
							<label for="exampleInputEmail1">EventDate</label>
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</div>
								<input type="text" autocomplete="off" name="eventdates" class="form-control pull-right" id="eventdates">
							</div>
							<!-- <input class="form-control" type="text" autocomplete="off" name="eventdates" placeholder="Event Dates" id="eventdates"> -->
						</div>
						<input type="hidden" name="eventid" id="eventid">
						<div class="form-group col-md-12">
							<label for="exampleInputEmail1">EventColor</label>
							<input type="hidden" name="eventcolor" autocomplete="off" placeholder="Event Color" id="event_color" class="form-control">
						</div>
						<div class="form-group col-md-12">

							<div class="cpicker-wrapper selectevent">
								<div id=03a9f4 class='calendar-cpicker cpicker cpicker-big' data-color='#03a9f4' style='background:#03a9f4;border:1px solid #03a9f4; border-radius:100px'></div>
								<div id=c53da9 class='calendar-cpicker cpicker cpicker-small' data-color='#c53da9' style='background:#c53da9;border:1px solid #c53da9; border-radius:100px'></div>
								<div id=757575 class='calendar-cpicker cpicker cpicker-small' data-color='#757575' style='background:#757575;border:1px solid #757575; border-radius:100px'></div>
								<div id=8e24aa class='calendar-cpicker cpicker cpicker-small' data-color='#8e24aa' style='background:#8e24aa;border:1px solid #8e24aa; border-radius:100px'></div>
								<div id=d81b60 class='calendar-cpicker cpicker cpicker-small' data-color='#d81b60' style='background:#d81b60;border:1px solid #d81b60; border-radius:100px'></div>
								<div id=7cb342 class='calendar-cpicker cpicker cpicker-small' data-color='#7cb342' style='background:#7cb342;border:1px solid #7cb342; border-radius:100px'></div>
								<div id=fb8c00 class='calendar-cpicker cpicker cpicker-small' data-color='#fb8c00' style='background:#fb8c00;border:1px solid #fb8c00; border-radius:100px'></div>
								<div id=fb3b3b class='calendar-cpicker cpicker cpicker-small' data-color='#fb3b3b' style='background:#fb3b3b;border:1px solid #fb3b3b; border-radius:100px'></div>
							</div>
						</div>
						<div class="form-group col-md-12">
							<label for="exampleInputEmail1">EventType</label>
							<label class="radio-inline">

								<input type="radio" name="eventtype" value="public" id="public">Public </label>
							<label class="radio-inline">

								<input type="radio" name="eventtype" value="private" id="private">Private
							</label>
							<label class="radio-inline">

								<input type="radio" name="eventtype" value="sameforall" id="public">All Super Admin </label>
							<label class="radio-inline">

								<input type="radio" name="eventtype" value="protected" id="public">Protected
							</label>
						</div>

						<div class="col-xs-11 col-sm-11 col-md-11 col-lg-11">

							<input type="submit" class="btn btn-primary submit_update pull-right" value="Save">
						</div>
						<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
							<input type="button" id="delete_event" class="btn btn-primary submit_delete pull-right" value="Delete">
						</div>
					</form>
				</div>

			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(function() {
		var areaChartOptions = {
			showScale: true,
			scaleShowGridLines: false,
			scaleGridLineColor: "rgba(0,0,0,.05)",
			scaleGridLineWidth: 1,
			scaleShowHorizontalLines: true,
			scaleShowVerticalLines: true,
			bezierCurve: true,
			bezierCurveTension: 0.3,
			pointDot: false,
			pointDotRadius: 4,
			pointDotStrokeWidth: 1,
			pointHitDetectionRadius: 20,
			datasetStroke: true,
			datasetStrokeWidth: 2,
			datasetFill: true,

			maintainAspectRatio: true,
			responsive: true
		};
		var bar_chart = "1";
		var line_chart = "1";
		if (line_chart) {

			var lineChartCanvas = $("#lineChart").get(0).getContext("2d");
			var lineChart = new Chart(lineChartCanvas);
			var lineChartOptions = areaChartOptions;
			lineChartOptions.datasetFill = false;
			var yearly_collection_array = [6500, 2600, 1000, 2400, 700, "0.00", 1500, 2000, 3500, 1650, 3300, 6300];
			var yearly_expense_array = [2800, 1200, 1278, 700, 1200, 0, 1210, 560, 1450, 1500, 1800, 1509];
			var total_month = ["Dec", "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov"];
			var areaChartData_expense_Income = {
				labels: total_month,
				datasets: [{
					label: "Expense",
					fillColor: "rgba(215, 44, 44, 0.7)",
					strokeColor: "rgba(215, 44, 44, 0.7)",
					pointColor: "rgba(233, 30, 99, 0.9)",
					pointStrokeColor: "#c1c7d1",
					pointHighlightFill: "#fff",
					pointHighlightStroke: "rgba(220,220,220,1)",
					data: yearly_expense_array
				}, {
					label: "Collection",
					fillColor: "rgba(102, 170, 24, 0.6)",
					strokeColor: "rgba(102, 170, 24, 0.6)",
					pointColor: "rgba(102, 170, 24, 0.9)",
					pointStrokeColor: "rgba(102, 170, 24, 0.6)",
					pointHighlightFill: "#fff",
					pointHighlightStroke: "rgba(60,141,188,1)",
					data: yearly_collection_array
				}]
			};

			lineChart.Line(areaChartData_expense_Income, lineChartOptions);
		}

		var current_month_days = ["01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "24", "25", "26", "27", "28", "29", "30", "31"];
		var days_collection = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
		var days_expense = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];

		var areaChartData_classAttendence = {
			labels: current_month_days,
			datasets: [{
				label: "Electronics",
				fillColor: "rgba(102, 170, 24, 0.6)",
				strokeColor: "rgba(102, 170, 24, 0.6)",
				pointColor: "rgba(102, 170, 24, 0.6)",
				pointStrokeColor: "#c1c7d1",
				pointHighlightFill: "#fff",
				pointHighlightStroke: "rgba(220,220,220,1)",
				data: days_collection
			}, {
				label: "Digital Goods",
				fillColor: "rgba(233, 30, 99, 0.9)",
				strokeColor: "rgba(233, 30, 99, 0.9)",
				pointColor: "rgba(233, 30, 99, 0.9)",
				pointStrokeColor: "rgba(233, 30, 99, 0.9)",
				pointHighlightFill: "rgba(233, 30, 99, 0.9)",
				pointHighlightStroke: "rgba(60,141,188,1)",
				data: days_expense
			}]
		};
		if (bar_chart) {
			var barChartCanvas = $("#barChart").get(0).getContext("2d");
			var barChart = new Chart(barChartCanvas);

			var barChartData = areaChartData_classAttendence;
			barChartData.datasets[1].fillColor = "rgba(233, 30, 99, 0.9)";
			barChartData.datasets[1].strokeColor = "rgba(233, 30, 99, 0.9)";
			barChartData.datasets[1].pointColor = "rgba(233, 30, 99, 0.9)";
			var barChartOptions = {
				scaleBeginAtZero: true,
				scaleShowGridLines: true,
				scaleGridLineColor: "rgba(0,0,0,.05)",
				scaleGridLineWidth: 1,
				scaleShowHorizontalLines: true,
				scaleShowVerticalLines: true,
				barShowStroke: true,
				barStrokeWidth: 2,
				barValueSpacing: 5,
				barDatasetSpacing: 1,

				responsive: true,
				maintainAspectRatio: true
			};

			barChartOptions.datasetFill = false;
			barChart.Bar(barChartData, barChartOptions);
		}
	});

	$(document).ready(function() {

		$(document).on('click', '.close_notice', function() {
			var data = $(this).data();

			$.ajax({
				type: "POST",
				url: base_url + "admin/notification/read",
				data: {
					'notice': data.noticeid
				},
				dataType: "json",
				success: function(data) {
					if (data.status == "fail") {

						errorMsg(data.msg);
					} else {
						successMsg(data.msg);
					}

				}
			});

		});
	});
</script>

<script src="<?php echo base_url('assets/backend/'); ?>dist/js/moment.min.js"></script>
