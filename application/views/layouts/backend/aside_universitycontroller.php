<aside class="main-sidebar" id="alert2">
	<form class="navbar-form navbar-left search-form2" role="search" action="/admin/admin/search" method="POST">
		<input type='hidden' name='ci_csrf_token' value='' />
		<div class="input-group ">

			<input type="text" name="search_text" class="form-control search-form" placeholder="Search By Student Name, Roll Number, Enroll Number, National Id, Local Id Etc.">
			<span class="input-group-btn">
							<button type="submit" name="search" id="search-btn" style="padding: 3px 12px !important;border-radius: 0px 30px 30px 0px; background: #fff;" class="btn btn-flat"><i class="fa fa-search"></i></button>
						</span>
		</div>
	</form>

	<section class="sidebar" id="sibe-box">
		<ul class="sessionul fixedmenu">
			<li class="removehover">
				<a data-toggle="modal" data-target="#sessionModal">Current Session: 2018-19<i class="fa fa-pencil pull-right"></i></a>

			</li>
			<li class="dropdown">
				<a class="dropdown-toggle drop5" data-toggle="dropdown" href="#" aria-expanded="false">
					Quick Links <span class="glyphicon glyphicon-th pull-right"></span>
				</a>
				<ul class="dropdown-menu verticalmenu" style="min-width:194px;font-size:10pt;left:3px;">

					<li role="presentation"><a style="color:#282828; font-family: 'Roboto-Bold';padding:6px 20px;" role="menuitem" tabindex="-1" href="/student/search"><i class="fa fa-user-plus"></i>Student Details</a></li>

					<li role="presentation"><a style="color:#282828; font-family: 'Roboto-Bold';padding:6px 20px;" role="menuitem" tabindex="-1" href="/studentfee"><i class="fa fa-money"></i>Collect Fees</a></li>

					<li role="presentation"><a style="color:#282828; font-family: 'Roboto-Bold';padding:6px 20px;" role="menuitem" tabindex="-1" href="/admin/income"> &nbsp;<i class="fa fa-usd"></i> Add Income</a></li>

					<li role="presentation"><a style="color:#282828; font-family: 'Roboto-Bold';padding:6px 20px;" role="menuitem" tabindex="-1" href="/admin/expense"><i class="fa fa-credit-card"></i>Add Expense</a></li>

					<li role="presentation"><a style="color:#282828; font-family: 'Roboto-Bold';padding:6px 20px;" role="menuitem" tabindex="-1" href="/admin/stuattendence"><i class="fa fa-calendar-check-o"></i>Student Attendance</a></li>

					<li role="presentation"><a style="color:#282828; font-family: 'Roboto-Bold';padding:6px 20px;" role="menuitem" tabindex="-1" href="/admin/staffattendance"><i class="fa fa-calendar-check-o"></i>Staff Attendance</a></li>

					<li role="presentation"><a style="color:#282828; font-family: 'Roboto-Bold';padding:6px 20px;" role="menuitem" tabindex="-1" href="/admin/staff"><i class="fa fa-calendar-check-o"></i>Staff Directory</a></li>

					<li role="presentation"><a style="color:#282828; font-family: 'Roboto-Bold';padding:6px 20px;" role="menuitem" tabindex="-1" href="/admin/exam"><i class="fa fa-map-o"></i>Exam List</a></li>

					<li role="presentation"><a style="color:#282828; font-family: 'Roboto-Bold';padding:6px 20px;" role="menuitem" tabindex="-1" href="/admin/examschedule"><i class="fa fa-columns"></i>Exam Schedule</a></li>

					<li role="presentation"><a style="color:#282828; font-family: 'Roboto-Bold';padding:6px 20px;" role="menuitem" tabindex="-1" href="/admin/timetable"><i class="fa fa-calendar-times-o"></i>Class Timetable</a></li>

					<li role="presentation"><a style="color:#282828; font-family: 'Roboto-Bold';padding:6px 20px;" role="menuitem" tabindex="-1" href="/admin/enquiry"><i class="fa fa-calendar-check-o"></i>Admission Enquiry</a></li>

					<li role="presentation"><a style="color:#282828; font-family: 'Roboto-Bold';padding:6px 20px;" role="menuitem" tabindex="-1" href="/admin/complaint"><i class="fa fa-calendar-check-o"></i>Complain</a></li>

					<li role="presentation"><a style="color:#282828; font-family: 'Roboto-Bold';padding:6px 20px;" role="menuitem" tabindex="-1" href="/admin/content"><i class="fa fa-download"></i>Upload Content</a></li>

					<li role="presentation"><a style="color:#282828; font-family: 'Roboto-Bold';padding:6px 20px;" role="menuitem" tabindex="-1" href="/admin/itemstock"><i class="fa fa-object-group"></i>Add Item Stock</a></li>

					<li role="presentation"><a style="color:#282828; font-family: 'Roboto-Bold';padding:6px 20px;" role="menuitem" tabindex="-1" href="/admin/notification"><i class="fa fa-bullhorn"></i>Notice Board</a></li>

					<li role="presentation"><a style="color:#282828; font-family: 'Roboto-Bold';padding:6px 20px;" role="menuitem" tabindex="-1" href="/admin/mailsms/compose"><i class="fa fa-envelope-o"></i>Send Email / SMS</a></li>
				</ul>
			</li>
		</ul>
		<ul class="sidebar-menu verttop">

			<li class="treeview ">
				<a href="#">
					<i class="fa fa-ioxhost"></i> <span>Administration</span> <i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">

					<li class=""><a href="/admin/enquiry"><i class="fa fa-angle-double-right"></i> University </a></li>

					<li class=""><a href="/admin/visitors"><i class="fa fa-angle-double-right"></i> Colleges</a></li>

					<li class=""><a href="/admin/generalcall"><i class="fa fa-angle-double-right"></i> Phone Call Log</a></li>

					<li class=""><a href="/admin/dispatch"><i class="fa fa-angle-double-right"></i> Postal Dispatch</a></li>

					<li class=""><a href="/admin/receive"><i class="fa fa-angle-double-right"></i> Postal Receive</a></li>

					<li class=""><a href="/admin/complaint"><i class="fa fa-angle-double-right"></i> Complain</a></li>

					<li class=""><a href="/admin/visitorspurpose"><i class="fa fa-angle-double-right"></i> Setup Front Office</a></li>

				</ul>
			</li>
			<li class="treeview ">
				<a href="#">
					<i class="fa fa-ioxhost"></i> <span>Reports</span> <i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<li class=""><a href="/admin/enquiry"><i class="fa fa-angle-double-right"></i> Accrediation Reports</a></li>
					<li class=""><a href="/admin/enquiry"><i class="fa fa-angle-double-right"></i> University Report</a></li>
					<li class=""><a href="/admin/visitors"><i class="fa fa-angle-double-right"></i> Colleges Report</a></li>
					<li class=""><a href="/admin/generalcall"><i class="fa fa-angle-double-right"></i> Students Report</a></li>
				</ul>
			</li>
		</ul>
	</section>
</aside>