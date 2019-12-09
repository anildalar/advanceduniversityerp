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
					<i class="fa fa-ioxhost"></i> <span>Front Office</span> <i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">

					<li class=""><a href="/admin/enquiry"><i class="fa fa-angle-double-right"></i> Admission Enquiry </a></li>

					<li class=""><a href="/admin/visitors"><i class="fa fa-angle-double-right"></i> Visitor Book</a></li>

					<li class=""><a href="/admin/generalcall"><i class="fa fa-angle-double-right"></i> Phone Call Log</a></li>

					<li class=""><a href="/admin/dispatch"><i class="fa fa-angle-double-right"></i> Postal Dispatch</a></li>

					<li class=""><a href="/admin/receive"><i class="fa fa-angle-double-right"></i> Postal Receive</a></li>

					<li class=""><a href="/admin/complaint"><i class="fa fa-angle-double-right"></i> Complain</a></li>

					<li class=""><a href="/admin/visitorspurpose"><i class="fa fa-angle-double-right"></i> Setup Front Office</a></li>

				</ul>
			</li>

			<li class="treeview ">
				<a href="#">
					<i class="fa fa-user-plus"></i> <span>Student Information</span> <i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">

					<li class=""><a href="/student/search"><i class="fa fa-angle-double-right"></i> Student Details</a></li>

					<li class=""><a href="/student/create"><i class="fa fa-angle-double-right"></i> Student Admission</a></li>

					<li class=""><a href="/student/studentreport"><i class="fa fa-angle-double-right"></i>
										Student Report</a></li>

					<li class=""><a href="/student/guardianreport"><i class="fa fa-angle-double-right"></i> Guardian Report</a></li>

					<li class=""><a href="/admin/users/admissionreport"><i class="fa fa-angle-double-right"></i> Student History</a></li>

					<li class="">
						<a href="/admin/users/logindetailreport"><i class="fa fa-angle-double-right"></i> Student Login Credential</a></li>

					<li class=""><a href="/category"><i class="fa fa-angle-double-right"></i> Student Categories</a></li>

					<li class=""><a href="/admin/schoolhouse"><i class="fa fa-angle-double-right"></i> Student House</a></li>
					<li class=""><a href="/student/disablestudentslist"><i class="fa fa-angle-double-right"></i> Disabled Students</a></li>

				</ul>
			</li>
			<li class="treeview ">
				<a href="#">
					<i class="fa fa-money"></i> <span> Fees Collection</span> <i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<li class=""><a href="/studentfee"><i class="fa fa-angle-double-right"></i> Collect Fees</a></li>
					<li class=""><a href="/studentfee/searchpayment"><i class="fa fa-angle-double-right"></i> Search Fees Payment</a></li>
					<li class=""><a href="/studentfee/feesearch"><i class="fa fa-angle-double-right"></i> Search Due Fees </a></li>
					<li class=""><a href="/studentfee/reportbyname"><i class="fa fa-angle-double-right"></i> Fees Statement</a></li>

					<li class=""><a href="/admin/transaction/studentacademicreport"><i class="fa fa-angle-double-right"></i>
											Balance Fees Report</a></li>
					<li class=""><a href="/admin/feemaster"><i class="fa fa-angle-double-right"></i> Fees Master</a></li>
					<li class=""><a href="/admin/feegroup"><i class="fa fa-angle-double-right"></i> Fees Group</a></li>
					<li class=""><a href="/admin/feetype"><i class="fa fa-angle-double-right"></i> Fees Type</a></li>
					<li class=""><a href="/admin/feediscount"><i class="fa fa-angle-double-right"></i> Fees Discount</a></li>
					<li class=""><a href="/admin/feesforward"><i class="fa fa-angle-double-right"></i> Fees Carry Forward</a></li>
				</ul>
			</li>

			<li class="treeview ">
				<a href="#">
					<i class="fa fa-usd"></i> <span>Income</span> <i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<li class=""><a href="/admin/income"><i class="fa fa-angle-double-right"></i>Add Income</a></li>
					<li class=""><a href="/admin/income/incomesearch"><i class="fa fa-angle-double-right"></i>Search Income</a></li>
					<li class=""><a href="/admin/incomehead"><i class="fa fa-angle-double-right"></i>Income Head</a></li>
				</ul>
			</li>
			<li class="treeview ">
				<a href="#">
					<i class="fa fa-credit-card"></i> <span>Expenses</span> <i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<li class=""><a href="/admin/expense"><i class="fa fa-angle-double-right"></i> Add Expense</a></li>
					<li class=""><a href="/admin/expense/expensesearch"><i class="fa fa-angle-double-right"></i> Search Expense</a></li>
					<li class=""><a href="/admin/expensehead"><i class="fa fa-angle-double-right"></i> Expense Head</a></li>
				</ul>
			</li>
			<li class="treeview ">
				<a href="#">
					<i class="fa fa-calendar-check-o"></i> <span>Attendance</span> <i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<li class=""><a href="/admin/stuattendence"><i class="fa fa-angle-double-right"></i> Student Attendance</a></li>
					<li class=""><a href="/admin/stuattendence/attendencereport"><i class="fa fa-angle-double-right"></i> Attendance By Date</a></li>
					<li class=""><a href="/admin/stuattendence/classattendencereport"><i class="fa fa-angle-double-right"></i> Attendance Report</a></li>
				</ul>
			</li>
			<li class="treeview ">
				<a href="#">
					<i class="fa fa-map-o"></i> <span>Examinations</span> <i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<li class=""><a href="/admin/exam"><i class="fa fa-angle-double-right"></i> Exam List</a></li>
					<li class=""><a href="/admin/examschedule"><i class="fa fa-angle-double-right"></i> Exam Schedule</a></li>
					<li class=""><a href="/admin/mark"><i class="fa fa-angle-double-right"></i> Marks Register</a></li>
					<li class=""><a href="/admin/grade"><i class="fa fa-angle-double-right"></i> Marks Grade</a></li>
				</ul>
			</li>
			<li class="treeview ">
				<a href="#">
					<i class="fa fa-mortar-board"></i> <span>Academics</span> <i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<li class=""><a href="/admin/timetable"><i class="fa fa-angle-double-right"></i> Class Timetable</a></li>
					<li class=""><a href="/admin/teacher/assign_class_teacher"><i class="fa fa-angle-double-right"></i> Assign Class Teacher</a></li>

					<li class=""><a href="/admin/teacher/viewassignteacher"><i class="fa fa-angle-double-right"></i> Assign Subjects</a></li>

					<li class=""><a href="/admin/stdtransfer"><i class="fa fa-angle-double-right"></i> Promote Students</a></li>
					<li class=""><a href="/admin/subject"><i class="fa fa-angle-double-right"></i> Subjects</a></li>
					<li class=""><a href="/classes"><i class="fa fa-angle-double-right"></i> Class</a></li>
					<li class=""><a href="/sections"><i class="fa fa-angle-double-right"></i> Sections</a></li>
				</ul>
			</li>
			<li class="treeview ">
				<a href="#">
					<i class="fa fa-sitemap"></i> <span>Human Resource</span> <i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<li class=""><a href="/admin/staff"><i class="fa fa-angle-double-right"></i> Staff Directory</a></li>

					<li class=""><a href="/admin/staffattendance"><i class="fa fa-angle-double-right"></i> Staff Attendance</a></li>

					<li class=""><a href="/admin/staffattendance/attendancereport"><i class="fa fa-angle-double-right"></i> Staff Attendance Report</a></li>

					<li class=""><a href="/admin/payroll"><i class="fa fa-angle-double-right"></i> Payroll</a></li>
					<li class=""><a href="/admin/payroll/payrollreport"><i class="fa fa-angle-double-right"></i> Payroll Report</a></li>
					<li class=""><a href="/admin/leaverequest/leaverequest"><i class="fa fa-angle-double-right"></i> Approve Leave Request</a></li>

					<li class=""><a href="/admin/staff/leaverequest"><i class="fa fa-angle-double-right"></i> Apply Leave</a></li>

					<li class=""><a href="/admin/leavetypes"><i class="fa fa-angle-double-right"></i> Leave Type</a></li>

					<li class=""><a href="/admin/department/department"><i class="fa fa-angle-double-right"></i> Department</a></li>

					<li class=""><a href="/admin/designation/designation"><i class="fa fa-angle-double-right"></i> Designation</a></li>

					<li class=""><a href="/admin/staff/disablestafflist"><i class="fa fa-angle-double-right"></i> Disabled Staff</a></li>
				</ul>
			</li>
			<li class="treeview ">
				<a href="#">
					<i class="fa fa-bullhorn"></i> <span>Communicate</span> <i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<li class=""><a href="/admin/notification"><i class="fa fa-angle-double-right"></i> Notice Board</a></li>
					<li class=""><a href="/admin/notification/add"><i class="fa fa-angle-double-right"></i> Send Message</a></li>
					<li class=""><a href="/admin/mailsms/compose"><i class="fa fa-angle-double-right"></i> Send Email / SMS</a></li>
					<li class=""><a href="/admin/mailsms/index"><i class="fa fa-angle-double-right"></i> Email / SMS Log</a></li>
				</ul>
			</li>
			<li class="treeview ">
				<a href="#">
					<i class="fa fa-download"></i> <span>Download Center</span> <i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<li class=""><a href="/admin/content"><i class="fa fa-angle-double-right"></i> Upload Content</a></li>
					<li class=""><a href="/admin/content/assignment"><i class="fa fa-angle-double-right"></i> Assignments</a></li>
					<li class=""><a href="/admin/content/studymaterial"><i class="fa fa-angle-double-right"></i> Study Material</a></li>
					<li class=""><a href="/admin/content/syllabus"><i class="fa fa-angle-double-right"></i> Syllabus</a></li>
					<li class=""><a href="/admin/content/other"><i class="fa fa-angle-double-right"></i> Other Downloads</a></li>
				</ul>
			</li>
			<li class="treeview ">
				<a href="#">
					<i class="fa fa-flask"></i> <span>Homework</span> <i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<li class=""><a href="/homework"><i class="fa fa-angle-double-right"></i> Add Homework</a></li>
					<li class=""><a href="/homework/evaluation_report"><i class="fa fa-angle-double-right"></i> Evaluation Report</a></li>
				</ul>
			</li>
			<li class="treeview ">
				<a href="#">
					<i class="fa fa-book"></i> <span>Library</span> <i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<li class=""><a href="/admin/book"><i class="fa fa-angle-double-right"></i>Add Book</a></li>
					<li class="">
						<a href="/admin/book/getall"><i class="fa fa-angle-double-right"></i>Book List</a></li>
					<li class=""><a href="/admin/member"><i class="fa fa-angle-double-right"></i>Issue Return</a></li>
					<li class=""><a href="/admin/member/student"><i class="fa fa-angle-double-right"></i>Add Student</a></li>
					<li class=""><a href="/admin/member/teacher"><i class="fa fa-angle-double-right"></i>Add Staff Member</a></li>

				</ul>
			</li>
			<li class="treeview ">
				<a href="#">
					<i class="fa fa-object-group"></i> <span>Inventory</span> <i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<li class=""><a href="/admin/issueitem"><i class="fa fa-angle-double-right"></i>Issue Item</a></li>
					<li class=""><a href="/admin/itemstock"><i class="fa fa-angle-double-right"></i>Add Item Stock</a></li>
					<li class=""><a href="/admin/item"><i class="fa fa-angle-double-right"></i>Add Item</a></li>
					<li class=""><a href="/admin/itemcategory"><i class="fa fa-angle-double-right"></i>Item Category</a></li>
					<li class=""><a href="/admin/itemstore"><i class="fa fa-angle-double-right"></i>Item Store</a></li>
					<li class=""><a href="/admin/itemsupplier"><i class="fa fa-angle-double-right"></i>Item Supplier</a></li>
				</ul>
			</li>
			<li class="treeview ">
				<a href="#">
					<i class="fa fa-bus"></i> <span>Transport</span> <i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<li class=""><a href="/admin/route"><i class="fa fa-angle-double-right"></i> Routes</a></li>
					<li class=""><a href="/admin/vehicle"><i class="fa fa-angle-double-right"></i> Vehicles</a></li>
					<li class=""><a href="/admin/vehroute"><i class="fa fa-angle-double-right"></i> Assign Vehicle</a></li>
					<li class=""><a href="/admin/route/studenttransportdetails"><i class="fa fa-angle-double-right"></i> Student Transport Report</a></li>

				</ul>
			</li>

			<li class="treeview ">
				<a href="#">
					<i class="fa fa-building-o"></i> <span>Hostel</span> <i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<li class=""><a href="/admin/hostelroom"><i class="fa fa-angle-double-right"></i> Hostel Rooms</a></li>
					<li class=""><a href="/admin/roomtype"><i class="fa fa-angle-double-right"></i> Room Type</a></li>
					<li class=""><a href="/admin/hostel"><i class="fa fa-angle-double-right"></i> Hostel</a></li>
					<li class=""><a href="/admin/hostelroom/studenthosteldetails"><i class="fa fa-angle-double-right"></i> Student Hostel Report</a></li>
				</ul>
			</li>

			<li class="treeview ">
				<a href="#">
					<i class="fa fa-newspaper-o"></i> <span>Certificate</span> <i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<li class=""><a href="/admin/certificate/"><i class="fa fa-angle-double-right"></i>Student Certificate</a></li>

					<li class=""><a href="/admin/generatecertificate/"><i class="fa fa-angle-double-right"></i>Generate Certificate</a></li>

					<li class=""><a href="/admin/studentidcard/"><i class="fa fa-angle-double-right"></i>Student ID Card</a></li>

					<li class=""><a href="/admin/generateidcard/"><i class="fa fa-angle-double-right"></i>Generate ID Card</a></li>
				</ul>
			</li>
			<li class="treeview ">
				<a href="#">
					<i class="fa fa-empire"></i> <span>Front CMS</span> <i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<li class=""><a href="/admin/front/events"><i class="fa fa-angle-double-right"></i> Event</a></li>
					<li class=""><a href="/admin/front/gallery"><i class="fa fa-angle-double-right"></i> Gallery</a></li>
					<li class=""><a href="/admin/front/notice"><i class="fa fa-angle-double-right"></i> News</a></li>
					<li class=""><a href="/admin/front/media"><i class="fa fa-angle-double-right"></i> Media Manager</a></li>
					<li class=""><a href="/admin/front/page"><i class="fa fa-angle-double-right"></i> Pages</a></li>
					<li class=""><a href="/admin/front/menus"><i class="fa fa-angle-double-right"></i> Menus</a></li>
					<li class=""><a href="/admin/front/banner"><i class="fa fa-angle-double-right"></i> Banner Images</a></li>
				</ul>
			</li>
			<li class="treeview ">
				<a href="#">
					<i class="fa fa-line-chart"></i> <span>Reports</span> <i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<li class=""><a href="/student/studentreport"><i class="fa fa-angle-double-right"></i>
										Student Report</a></li>

					<li class=""><a href="/student/guardianreport"><i class="fa fa-angle-double-right"></i> Guardian Report</a></li>
					<li class=""><a href="/admin/users/admissionreport"><i class="fa fa-angle-double-right"></i> Student History</a></li>

					<li class=""><a href="/admin/users/logindetailreport"><i class="fa fa-angle-double-right"></i> Student Login Credential</a></li>

					<li class=""><a href="/studentfee/reportbyname"><i class="fa fa-angle-double-right"></i> Fees Statement</a></li>

					<li class=""><a href="/admin/transaction/studentacademicreport"><i class="fa fa-angle-double-right"></i>
										Balance Fees Report</a></li>

					<li class=""> <a href="/admin/transaction/searchtransaction"><i class="fa fa-angle-double-right"></i> Transaction Report</a></li>

					<li class=""><a href="/admin/stuattendence/classattendencereport"><i class="fa fa-angle-double-right"></i> Attendance Report</a></li>

					<li class=""><a href="/admin/mark"><i class="fa fa-angle-double-right"></i> Exam Marks Report</a></li>

					<li class=""><a href="/admin/payroll/payrollreport"><i class="fa fa-angle-double-right"></i> Payroll Report</a></li>

					<li class=""><a href="/admin/staffattendance/attendancereport"><i class="fa fa-angle-double-right"></i> Staff Attendance Report</a></li>
					<li class=""><a href="/homework/evaluation_report"><i class="fa fa-angle-double-right"></i> Evaluation Report</a></li>
					<li class=""><a href="/admin/route/studenttransportdetails"><i class="fa fa-angle-double-right"></i> Student Transport Report</a></li>
					<li class=""><a href="/admin/hostelroom/studenthosteldetails"><i class="fa fa-angle-double-right"></i> Student Hostel Report</a></li>

					<li class=""><a href="/admin/userlog"><i class="fa fa-angle-double-right"></i> User Log</a></li>
				</ul>
			</li>

			<li class="treeview ">
				<a href="#">
					<i class="fa fa-gears"></i> <span>System Settings</span> <i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<li class=""><a href="/schsettings"><i class="fa fa-angle-double-right"></i> General Setting</a></li>
					<li class=""><a href="/sessions"><i class="fa fa-angle-double-right"></i> Session Setting</a></li>
					<li class=""><a href="/admin/notification/setting"><i class="fa fa-angle-double-right"></i> Notification Setting</a></li>
					<li class=""><a href="/smsconfig"><i class="fa fa-angle-double-right"></i> SMS Setting</a></li>
					<li class=""><a href="/emailconfig"><i class="fa fa-angle-double-right"></i> Email Setting</a></li>
					<li class=""><a href="/admin/paymentsettings"><i class="fa fa-angle-double-right"></i> Payment Methods</a></li>
					<li class=""><a href="/admin/frontcms"><i class="fa fa-angle-double-right"></i> Front CMS Setting</a></li>
					<li class=""><a href="/admin/roles"><i class="fa fa-angle-double-right"></i> Roles Permissions</a></li>
					<li class=""><a href="/admin/admin/backup"><i class="fa fa-angle-double-right"></i> Backup / Restore</a></li>
					<li class=""><a href="/admin/language"><i class="fa fa-angle-double-right"></i> Languages</a></li>
					<li class=""><a href="/admin/users"><i class="fa fa-angle-double-right"></i> Users</a></li>
					<li class=""><a href="/admin/module"><i class="fa fa-angle-double-right"></i> Modules</a></li>

				</ul>
			</li>

		</ul>
	</section>
</aside>