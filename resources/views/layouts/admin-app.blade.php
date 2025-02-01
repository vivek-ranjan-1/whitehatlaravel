<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'White Hat Realty')</title>

  <link rel="icon" href="{{url('assets/images/icon2.ico')}}">
  <link rel="stylesheet" href="{{url('assets/libraries/css/bootstrap.min.css')}}">

  <!-- DataTables -->
  <link rel="stylesheet" href="{{url('assets/libraries/css/dataTable.min.css')}}">
  <link rel="stylesheet" href="{{url('assets/libraries/css/dataTableResponsive.min.css')}}">
  <link rel="stylesheet" href="{{url('assets/libraries/css/buttons.css')}}">

  <link rel="stylesheet" href="{{url('assets/libraries/css/select2.css')}}">
  <link rel="stylesheet" href="{{url('assets/libraries/css/summernote.css')}}">






  <link rel="stylesheet" href="{{url('assets/customs/css/admin.css')}}">
  <link rel="stylesheet" href="{{url('assets/customs/css/breadcrumb.css')}}">

  @yield('customCss')

  <script src="{{url('assets/libraries/js/jquery.js')}}"></script>
  <script src="{{url('assets/libraries/js/popper.js')}}"></script>
  <script src="{{url('assets/libraries/js/password-strength.js')}}"></script>
  <script src="{{url('assets/libraries/js/print.min.js')}}"
    integrity="sha512-t3XNbzH2GEXeT9juLjifw/5ejswnjWWMMDxsdCg4+MmvrM+MwqGhxlWeFJ53xN/SBHPDnW0gXYvBx/afZZfGMQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <style media="print">
    .hiddens {
      display: none !important
    }

    .table th,
    .table td {
      font-size: 22px !important;
    }

    .table-bordered,
    .table-bordered td,
    .table-bordered th {
      border: 1px solid #000 !important;
    }
  </style>
  <style>
    .badge {
      font-size: 12px !important;
    }

    .btn-secondary {
      background-color: #3f6791 !important;
      border-color: #3f6791 !important;
    }
  </style>
</head>


<body class="dashboard dashboard_1">
  <div class="full_container">
    <div class="inner_container">
      @include('layouts.sidebar')

      <!-- right content -->
      <div id="content">
        @include('layouts.header')
        <!-- dashboard inner -->
        <section class="content">
          <div class="container-fluid">
            <div class="row justify-content-center">
            </div>
          </div>
        </section>

        <div class="middle_cont">
          <div class="container-fluid">
            @if (session('success'))
            <div class="mt-5 alert alert-success alert-dismissible fade show" role="alert">
              {{ session('success') }}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            @endif
          </div>
          @yield('content')
        </div>
        <!-- end dashboard inner -->
      </div>
    </div>
    <!-- jQuery -->
    <script src="{{url('assets/libraries/js/bootstrap.min.js')}}"></script>
    <script src="{{url('assets/libraries/js/fontsawesome.js')}}"></script>

    <!-- DataTables  & Plugins -->
    <script src="{{url('assets/libraries/js/jquery.dataTable.min.js')}}"></script>
    <script src="{{url('assets/libraries/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{url('assets/libraries/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{url('assets/libraries/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{url('assets/libraries/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{url('assets/libraries/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{url('assets/libraries/js/jszip.min.js')}}"></script>
    <script src="{{url('assets/libraries/js/pdfmake.min.js')}}"></script>
    <script src="{{url('assets/libraries/js/vfs_fonts.js')}}"></script>
    <script src="{{url('assets/libraries/js/buttons.html5.min.js')}}"></script>
    <script src="{{url('assets/libraries/js/buttons.print.min.js')}}"></script>
    <script src="{{url('assets/libraries/js/buttons.colVis.min.js')}}"></script>
    <script src="{{url('assets/libraries/js/sweetalert.min.js')}}"></script>
    <script src="{{url('assets/libraries/js/select2.js')}}"></script>
    <script src="{{url('assets/libraries/js/summernote.js')}}"></script>

    <script>
      $('.select2').select2();
		$('.summernote').summernote({
		  height: 250,
		  callbacks: {
			onPaste: function(e) {
			  var clipboardData = (e.originalEvent || e).clipboardData.getData('text/html');
			  var cleanedHtml = clipboardData
			  .replace(/ style="[^"]*"/g, '') // Remove inline styles
			  .replace(/<\/?(b|strong)[^>]*>/gi, '') // Remove <b> and <strong> tags
			  .replace(/<\/?h[1-6][^>]*>/gi, '<p>');
			  setTimeout(function() {
				$('.summernote').summernote('code', cleanedHtml);
			  }, 10); 
			  e.preventDefault(); 
			}
		  }
		});
		
		$('.blogSummernote').summernote({
                minHeight: 100, // Adjust the minimum height as needed
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ],
                callbacks: {
                    onPaste: function(e) {
                        var clipboardData = (e.originalEvent || e).clipboardData.getData('text/html');
                        var cleanedHtml = clipboardData
                            .replace(/ style="[^"]*"/g, '') // Remove inline styles
							.replace(/<\/?(b|strong)[^>]*>/gi, '')
                            .replace(/<\/?h[1-6][^>]*>/gi, '<p>');
                        setTimeout(function() {
                            $('.blogSummernote').summernote('code', cleanedHtml);
                        }, 10);
                        e.preventDefault();
                    }, 
					onImageUpload: function(files) {
						uploadImage(files[0]);
					}
                }
		    });
			
		$(document).ready(function () {
			$('#sidebarCollapse').on('click', function () {
			  $('#sidebar').toggleClass('active');
			});
		});
			
			
		

		function uploadImage(file) {
			var data = new FormData();
			data.append("image", file);
			$.ajax({
				headers: {
				'X-CSRF-TOKEN': '{{csrf_token()}}'
				},
				url: "{{url('7439/frontend-pages/blogs/upload-image')}}", // Adjust the URL accordingly
				method: "POST",
				data: data,
				contentType: false,
				processData: false,
				success: function(url) {
					// alert('uploaded')
					// $('.blogSummernote').summernote('insertImage', url);
					const altText = prompt('Enter alt text for the image:', 'Image description'); // Prompt for alt text
					const imageHtml = `<img src="${url}" alt="${altText || 'Default Alt Text'}">`; // Add alt attribute
					$('.blogSummernote').summernote('insertNode', $(imageHtml)[0]);
				},
				error: function(data) {
					console.log("Image upload failed");
				}
			});
		}	
		



      // softDelete function
      function myConfirm(action) {
        var siteLink = "{{url('/7439/')}}";
        var actions = action.split('/');
		
        if (actions.length == 3) {
          var module = actions[0];
          var operation = actions[1];
          var id = actions[2];
        } else {
          var module = actions[0] + '/' + actions[1];
          var operation = actions[2];
          var id = actions[3];
        }

        switch (operation) {
          case 'delete':
            var actionTitle = 'Remove?';
            var actionText = 'Are you sure to delete this item?';
            var actionConfirmButtonColor = '#3085d6';
            var actionConfirmButtonText = 'Yes, delete it!';
            var actionUrl = siteLink + "/" + action;
            var postTitle = 'Deleted!';
            break;
          case 'status':
            var actionTitle = 'Change Status?';
            var actionText = 'Are you sure to change status?';
            var actionConfirmButtonColor = '#3085d6';
            var actionConfirmButtonText = 'Yes, change it!';
            var actionUrl = siteLink + "/" + action;
            var postTitle = 'Changed!';
            break;
          case 'trending':
            var actionTitle = 'Make trending?';
            var actionText = 'Are you sure to make trending this item?';
            var actionConfirmButtonColor = '#3085d6';
            var actionConfirmButtonText = 'Yes, make it!';
            var actionUrl = siteLink + "/" + action;
            var postTitle = 'Made!'
            break;
          default:
            alert('Bad method')
        }
        Swal.fire({
          icon: 'question',
          title: actionTitle,
          text: actionText,
          showCancelButton: true,
          confirmButtonColor: actionConfirmButtonColor,
          cancelButtonColor: '#d33',
          confirmButtonText: actionConfirmButtonText
        }).then((result) => {
          if (result.isConfirmed) {
            $.ajax({
              headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
              },
              url: actionUrl,
              type: "GET",
              success: function (data) {
                if (data.status) {
                  Swal.fire({
                    title: postTitle,
                    text: data.message,
                    icon: 'success'
                  }).then(() => {
                    loadAjaxList();
                  });
                } else {
                  Swal.fire(
                    postTitle,
                    data.msg,
                    'error'
                  )
                }
              }
            });
          } else {
            Swal.fire(
              'Cancelled!',
              'Your data is safe.',
              'error'
            )
          }
        });
      }

      // password strength
      /*
          var pass_options = {};
          pass_options.ui = {
            showVerdictsInsideProgressBar: true,
            viewports: {
              progress: ".pwstrength_viewport_progress"
            }
          };
          pass_options.common = {
            debug: false
          };
          $('.pass-strength').pwstrength(pass_options);
      */
	function createSlug(str) {
		return str
			.toLowerCase()                      // Convert to lowercase
			.replace(/[^\w\s-]/g, '')            // Remove non-word characters
			.replace(/[\s_-]+/g, '-')            // Replace spaces or underscores with a single hyphen
			.replace(/^-+|-+$/g, '');            // Remove leading and trailing hyphens
	}
    </script>

    @yield('customJs')
</body>

</html>