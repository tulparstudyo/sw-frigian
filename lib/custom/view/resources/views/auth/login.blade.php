@extends('app')
 

@section('content')
    <main id="main-container" class="main-container">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-content m-b-40">
                        <h5 class="section-content__title text-center">
                @php  $locale = \Request::input('locale','ru'); \App::setLocale($locale)  @endphp {{ __('auth.My Account') }}</h5>
                    </div>
                </div>
                <!-- Start Login Area -->
                <div class="col-lg-6 col-12">
                    <div class="login-form-container">
                        <h5 class="sidebar__title">{{ __('auth.Login') }}</h5>

                        <div class="login-register-form">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf


                                <div class="form-box__single-group">
                                    <label for="email">{{ __('auth.E-Mail Address') }}</label>

                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                        name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>

                                <div class="form-box__single-group">
                                    <label for="password">{{ __('auth.Password') }}*</label>

                                    <div class="password__toggle">
                                        <input id="form-username-password" type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            required autocomplete="current-password">


                                        <span data-toggle="#form-username-password"
                                            class="password__toggle--btn fa fa-fw fa-eye"></span>
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                </div>



                                <div class="d-flex justify-content-between flex-wrap m-tb-20">
                                    <label for="account-remember">
                                        <input class="shipping-select" type="checkbox" name="remember" id="remember"
                                            {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('auth.Remember Me') }}
                                        </label>


                                    </label>
                                    @if (Route::has('password.request'))
                                        <a class="link--gray" href="{{ route('password.request') }}">
                                            {{ __('auth.Forgot Your Password?') }}
                                        </a>
                                    @endif
                                </div>

                                <button
                                    class="btn btn--box btn--medium btn--radius btn--black btn--black-hover-green btn--uppercase font--semi-bold"
                                    type="submit"> {{ __('auth.Loginbutton') }}</button>
                            </form>

                            <div class="col-md-12" >
                            @if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif    </div>

                            <div class="social-text">{{ __('auth.Or you can login with:')}}</div>

                            <div class=" row">
       
                            
                                <div class="col-md-4" >
                                    <div class="social-login-button " >
									<a href="{{ url('auth/google') }}">
									    <div class="flex items-center justify-end " style="float: left">
                                        
                 					        <img src="<?=frigian_url('assets/img/social/google.png')?>" style="max-width: 35px;margin-bottom: 2px;" >
              						  
            						    </div>
									    <div class="flex flex-column">
                                           Google
									    </div>
							   
													 
								    </a>
                                    </div>
				                </div>







                                <div class="col-md-4" >
                                    <div class="social-login-button " >
									<a  href="{{ url('/auth/vk') }}">
									    <div class="flex items-center justify-end " style="float: left">
                                      
                 						    <img src="  <?=frigian_url('assets/img/social/vk.png')?>" style="max-width: 35px;margin-bottom: 2px;" >
              						  
            						    </div>
									<div class="flex flex-column"> Vkontakte
                                    </div>
													 
								    </a>
			
                                    </div>

                                </div>


                                <div class="col-md-4" >
                                
                                    <div class="social-login-button " >
								    <a href="{{route('fb.auth')}}">
									    <div class="flex items-center justify-end " style="float: left">
              						 
                 						   <img src="<?=frigian_url('assets/img/social/fb.png')?>" style="max-width: 35px;margin-bottom: 2px;" >
              						  
            						    </div>
									    <div class="flex flex-column"> Facebook
									    </div>
							      												 
								    </a>
				                    </div>
			
                                </div>
		
			                        
                                                                                   
                            </div>  
                            
                        </div>
                      

                      
                    </div>
                </div>


                <div class="col-lg-6 col-12">
                    <div class="login-form-container">
                        <h5 class="sidebar__title"> {{ __('auth.Register') }}</h5>
                        <div class="login-register-form">
                            <form method="POST" action="{{ route('register') }}">
                                @csrf



                                <div class="form-box__single-group">
                                    <label for="name">  {{ __('auth.Name') }}*</label>
                                    <input id="register_name" type="text"
                                        class="form-control @error('register_name') is-invalid @enderror"
                                        name="register_name" value="{{ old('register_name') }}" required autocomplete="name"
                                        autofocus>
                                    @error('register_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>



                                <div class="form-box__single-group">

                                    <label for="email">{{ __('auth.E-Mail Address') }}*</label> <input id="register_email"
                                        type="email" class="form-control @error('register_email') is-invalid @enderror"
                                        name="register_email" value="{{ old('register_email') }}" required
                                        autocomplete="email">
                                    @error('register_email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span> 
                                    @enderror

                                </div>


                                <div class="form-box__single-group m-b-20">
                                    <label for="password">{{ __('auth.Password') }}*</label>

                                    <div class="password__toggle">
                                        <input id="register_password" type="password"
                                            class="form-control @error('register_password') is-invalid @enderror"
                                            name="register_password" required autocomplete="new-password">
                                        @error('register_password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                        <span data-toggle="#register_password"
                                            class="password__toggle--btn fa fa-fw fa-eye"></span>

                                    </div>
                                </div>

                                <div class="form-box__single-group m-b-20">
                                    <label for="password-confirm">{{ __('auth.Confirm Password') }}*</label>

                                    <div class="password__toggle">
                                        <input id="password-confirm" type="password" class="form-control"
                                            name="register_password_confirmation" required autocomplete="new-password">
                                        <span data-toggle="#password-confirm"
                                            class="password__toggle--btn fa fa-fw fa-eye"></span>
                                    </div>
                                </div>
                                <input type="hidden" name="siteid" value="1.">

                                <button type="submit"
                                    class="btn btn--box btn--medium btn--radius btn--black btn--black-hover-green btn--uppercase font--semi-bold">
                                    {{ __('auth.Registerbutton') }}
                                </button>



                            </form>
                        </div>
                    </div>
                </div> <!-- End Login Area -->
            </div>
        </div>
    </main>

@endsection
