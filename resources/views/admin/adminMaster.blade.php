<!DOCTYPE html>
<html lang="en">
    @include('admin.body.header')
    @include('admin.body.script')
    <body id="wholeBody" class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Include the navbar and the sidebar here -->
        @include('admin.body.navbar')
        @include('admin.body.sidebar')
        <!-- Content Wrapper. Contains page content -->
        @yield('content')
        <!-- Include the footer here -->
        @include('admin.body.footer')
    </div>
    <!-- <aside class="control-sidebar control-sidebar-dark"> -->
    <!-- </aside> -->
    </body>
    <script>
    window.addEventListener('load', () => loadDark());
</script>


<script>
    $("#my-toggle-button").ControlSidebar('toggle');
    function toggleDark() {
        var element = document.getElementById("wholeBody")
        var element2 = document.getElementById("navBarToggle")
        element2.classList.toggle("navbar-dark")
        element.classList.toggle("dark-mode")
    }
    function loadDark() {
        //default is light mode
        console.log("dark mode is ", JSON.parse(localStorage.getItem("jamesonDarkMode")))
        let dark = JSON.parse(localStorage.getItem("jamesonDarkMode"))
        if (dark === null) {
            localStorage.setItem("jamesonDarkMode", JSON.stringify(false))
        }
        else if (dark === true) {
            document.getElementById("wholeBody").classList.add("dark-mode")
            document.getElementById("navBarToggle").classList.add("navbar-dark")
            var buttonElement = document.getElementById("darkIcon")
            buttonElement.classList.replace("fa-moon", "fa-sun")
        }
    }

    function toggleDark() {
        var element = document.getElementById("wholeBody")
        var element2 = document.getElementById("navBarToggle")
        element2.classList.toggle("navbar-dark")
        element.classList.toggle("dark-mode")
        let dark = JSON.parse(localStorage.getItem("jamesonDarkMode"))
        if (dark) {
            localStorage.setItem("jamesonDarkMode", JSON.stringify(false))
            console.log("Dark mode off")
        }
        else {
            localStorage.setItem("jamesonDarkMode", JSON.stringify(true))
            console.log("Dark mode on")

        }
        //optional to change fontawesome icon on button
        var buttonElement = document.getElementById("darkIcon")
        buttonElement.classList.toggle("fa-moon")
        buttonElement.classList.toggle("fa-sun")
    }

    </script>


	<script src="{{asset('backend/assets/plugins/sweetalert2/sweetalert2.min.js')}}"></script>
	<script type="text/javascript">
		$(function(){
			$(document).on('click', '#delete', function(e){
				e.preventDefault();
				var link = $(this).attr("href");
				Swal.fire({
					title: 'Are you sure do you want to delete this?',
					text: "You won't be able to revert this!",
					icon: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Yes, delete it!'
					}).then((result) => {
					if (result.isConfirmed) {
						window.location.href = link
					}
					})
			});
		});
	</script>
	<script type="text/javascript">
		$(function(){
			$(document).on('click', '#terminate', function(e){
				e.preventDefault();
				var link = $(this).attr("href");
				Swal.fire({
					title: 'Are you sure do you want to terminate this saving?',
					text: "You won't be able to revert this!",
					icon: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Yes, terminate it!'
					}).then((result) => {
					if (result.isConfirmed) {
						window.location.href = link
					}
					})
			});
		});
	</script>
	<script type="text/javascript" src="{{asset('backend/js/toastr.js')}}"></script>
	<script>
	@if(Session::has('message'))
	var type = "{{ Session::get('alert-type','info') }}"
	switch(type){
		case 'info':
		toastr.info(" {{ Session::get('message') }} ");
		break;

		case 'success':
		toastr.success(" {{ Session::get('message') }} ");
		break;

		case 'warning':
		toastr.warning(" {{ Session::get('message') }} ");
		break;

		case 'error':
		toastr.error(" {{ Session::get('message') }} ");
		break;
	}
	@endif
	</script>


</html>

