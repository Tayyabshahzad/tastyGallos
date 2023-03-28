

<!DOCTYPE html>

<html lang="en">
	<!--begin::Head-->
	<head>

		<meta charset="utf-8" />
		<title> Forget Password | Tasty Gallos </title>


		<!--begin::Fonts-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
		<!--end::Fonts-->
		<!--begin::Page Custom Styles(used by this page)-->
		<link href="{{ asset('design/assets/css/pages/login/login-1.css') }}" rel="stylesheet" type="text/css" />
		<!--end::Page Custom Styles-->
		<!--begin::Global Theme Styles(used by all pages)-->
		<link href="{{ asset('design/assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('design/assets/plugins/custom/prismjs/prismjs.bundle.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('design/assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
		<!--end::Global Theme Styles-->
		<!--begin::Layout Themes(used by all pages)-->
		<link href="{{ asset('design/assets/css/themes/layout/header/base/light.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('design/assets/css/themes/layout/header/menu/light.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('design/assets/css/themes/layout/brand/dark.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('design/assets/css/themes/layout/aside/dark.css') }}" rel="stylesheet" type="text/css" />
		<!--end::Layout Themes-->
        <link rel="shortcut icon" href="{{ asset('design/assets/media/banners/favicon.ico')}}" />

	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
		<!--begin::Main-->
		<div class="d-flex flex-column flex-root">
			<!--begin::Login-->
			<div class="login login-1 login-signin-on d-flex flex-column flex-lg-row flex-column-fluid bg-white" id="kt_login">
				<!--begin::Aside-->
                <div class="login-aside d-flex flex-column flex-row-auto"
                style="background-image: url('https://getmeds.ph/blog/wp-content/uploads/2021/03/tp_81_1_(4).png');
                       background-size:cover;">
					<!--begin::Aside Top-->
					<div class="d-flex flex-column-auto flex-column pt-lg-40 pt-15">
						<!--begin::Aside header-->

						<!--end::Aside header-->
						<!--begin::Aside title-->
						{{-- <h3 class="font-weight-bolder text-center font-size-h4 font-size-h1-lg" style="color: #986923;">Discover Amazing Metronic
						<br>with great build tools</h3> --}}
						<!--end::Aside title-->
					</div>
					<!--end::Aside Top-->
					<!--begin::Aside Bottom-->
					<div class="aside-img d-flex flex-row-fluid bgi-no-repeat bgi-position-y-bottom bgi-position-x-center" style="background-image: url(assets/media/svg/illustrations/login-visual-1.svg)"></div>
					<!--end::Aside Bottom-->
				</div>
				<!--begin::Aside-->
				<!--begin::Content-->
				<div class="login-content flex-row-fluid d-flex flex-column justify-content-center position-relative overflow-hidden p-7 mx-auto">
					<!--begin::Content body-->
					<div class="d-flex flex-column-fluid flex-center">
						<div class="login-form login-signin">

							<!--begin::Form-->
							<form class="form" method="POST"   action="{{ route('password.update') }}"  >
                                @csrf
                                <input type="hidden" name="token" value="{{ $request->route('token') }}">
								<!--begin::Title-->
								<div class="pb-13 pt-lg-0 pt-5">
                                    <span  class="login-logo pb-xl-20 pb-15">
                                    </span>
								</div>
                                <div class="form-group">
									<label class="font-size-h6 font-weight-bolder text-dark mylabels">Email</label>
									<input class="form-control form-control-solid h-auto py-6 px-6 rounded-lg"
                                    type="email"
                                    name="email"
                                    value="{{old('email', $request->email)}}"
                                    required autofocus/>
								</div>

                                <div class="form-group">
									<label class="font-size-h6 font-weight-bolder text-dark mylabels">Password</label>
									<input class="form-control form-control-solid h-auto py-6 px-6 rounded-lg"  type="password" name="password"   required />
								</div>

                                <div class="form-group">
									<label class="font-size-h6 font-weight-bolder text-dark mylabels">Confirm Password</label>
									<input class="form-control form-control-solid h-auto py-6 px-6 rounded-lg"  type="password" name="password_confirmation"   required />
								</div>

								<!--end::Form group-->
								<!--begin::Form group-->

								<!--end::Form group-->
								<!--begin::Action-->
								<div class="pb-lg-0 pb-5">
									<button type="submit"     class="btn btn-danger btn-square font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-3">
                                        {{ __('Reset') }}
                                    </button>

                                    <a href="{{ route('login')}}" type="button" id=" " class="btn  btn-square btn btn-light-primary font-weight-bolder font-size-h6 px-8 py-4 my-3">Cancel</a>



								</div>
								<!--end::Action-->
							</form>
							<!--end::Form-->
						</div>
						<!--end::Signin-->
						<!--begin::Signup-->

						<!--end::Signup-->
						<!--begin::Forgot-->

						<!--end::Forgot-->
					</div>
					<!--end::Content body-->
					<!--begin::Content footer-->
					<div class="d-flex justify-content-lg-start justify-content-center align-items-end py-7 py-lg-0">
                        <div class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-between">
                            <!--begin::Copyright-->

                            <!--end::Copyright-->
                            <!--begin::Nav-->

                            </div>

					</div>
					<!--end::Content footer-->
				</div>
				<!--end::Content-->
			</div>
			<!--end::Login-->
		</div>
		<!--end::Main-->

		<!--begin::Global Config(global config for global JS scripts)-->
		<script>var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1400 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#3699FF", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#8950FC", "warning": "#FFA800", "danger": "#F64E60", "light": "#E4E6EF", "dark": "#181C32" }, "light": { "white": "#ffffff", "primary": "#E1F0FF", "secondary": "#EBEDF3", "success": "#C9F7F5", "info": "#EEE5FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#3F4254", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#EBEDF3", "gray-300": "#E4E6EF", "gray-400": "#D1D3E0", "gray-500": "#B5B5C3", "gray-600": "#7E8299", "gray-700": "#5E6278", "gray-800": "#3F4254", "gray-900": "#181C32" } }, "font-family": "Poppins" };</script>
		<!--end::Global Config-->
		<!--begin::Global Theme Bundle(used by all pages)-->
		<script src="{{ asset('design/assets/plugins/global/plugins.bundle.js') }}"></script>
		<script src="{{ asset('design/assets/plugins/custom/prismjs/prismjs.bundle.js') }}"></script>
		<script src="{{ asset('design/assets/js/scripts.bundle.js') }}"></script>
		<!--end::Global Theme Bundle-->
		<!--begin::Page Scripts(used by this page)-->

        <script src="{{asset( 'design/assets/js/pages/features/miscellaneous/sweetalert2.js') }}"></script>


        @if($errors->any())
            @foreach ($errors->all() as $error)
                <script>
                    toastr.error('{{$error}}', "Error");
                </script>
            @endforeach
        @endif






		<!--end::Page Scripts-->
	</body>
	<!--end::Body-->
</html>
