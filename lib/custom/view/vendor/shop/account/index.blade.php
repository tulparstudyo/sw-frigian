@extends('shop::base')

@section('aimeos_header')
    <?= $aiheader['locale/select'] ?? '' ?>
        <?= $aiheader['account/profile'] ?? '' ?>
        <?= $aiheader['account/review'] ?? '' ?>
        <?= $aiheader['account/subscription'] ?? '' ?>
        <?= $aiheader['account/history'] ?? '' ?>
        <?= $aiheader['account/favorite'] ?? '' ?>
        <?= $aiheader['account/watch'] ?? '' ?>
        <?= $aiheader['catalog/session'] ?? '' ?>

@stop

@section('aimeos_head')
        <?= $aibody['locale/select'] ?? '' ?>
    
@stop


@section('aimeos_aside')
        <?= $aibody['catalog/session'] ?? '' ?>
@stop


@section('aimeos_body')
<?= $aibody['basket/mini'] ?? '' ?>
     <main class="page-content">

        <div class="account-page-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3">
                    <div class="my-account-menu">
                    @php  $locale = \Request::input('locale','ru'); \App::setLocale($locale)  @endphp 
                                  
                                        <ul class="nav  nav-tabs account-menu-list flex-column nav-pills myaccount-tab-trigger" id="account-page-tab" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active link--icon-left" id="account-dashboard-tab" data-toggle="tab" href="#account-dashboard"
                                                    role="tab" aria-controls="account-dashboard" aria-selected="true"><i
                                                        class="fas fa-tachometer-alt"></i> 
                                                        {{ __('pagination.Dashboard') }}</a>
                                            </li>
                                            <li class="nav-item">
                                                <a id="account-orders-tab" class="nav-link link--icon-left" data-toggle="tab" href="#account-orders" role="tab"
                                                    aria-controls="account-order" aria-selected="false"><i
                                                        class="fas fa-shopping-cart"></i> {{ __('pagination.Orders') }}</a>
                                            </li>
                                            <li class="nav-item">
                                                <a id="account-review-tab" class="nav-link link--icon-left" data-toggle="tab" href="#account-review" role="tab"
                                                    aria-controls="account-review" aria-selected="false"><i
                                                        class="fas fa-star"></i> {{ __('Reviews') }}</a>
                                            </li>
                                            <li class="nav-item">
                                                <a id="account-address-tab" class="nav-link link--icon-left" data-toggle="tab" href="#account-address" role="tab"
                                                    aria-controls="account-address" aria-selected="false"><i
                                                        class="fas fa-address-book"></i> {{ __('pagination.Address') }}</a>
                                            </li>
                                            <li class="nav-item">
                                                <a id="account-favourite-tab" class="nav-link link--icon-left" data-toggle="tab" href="#account-favourite" role="tab"
                                                    aria-controls="account-favourite" aria-selected="false"><i
                                                        class="fas fa-heart"></i> {{ __('pagination.Favourite Products') }}</a>
                                            </li>
                                            <li class="nav-item">
                                                <a id="account-pin-tab" class="nav-link link--icon-left" data-toggle="tab" href="#account-pin" role="tab"
                                                    aria-controls="account-pin" aria-selected="false"><i
                                                        class="fas fa-heart"></i> {{ __('Pin Products') }}</a>
                                            </li>
                                            <li class="nav-item">
                                                <a id="account-watchlist-tab" class="nav-link link--icon-left" data-toggle="tab" href="#account-watchlist" role="tab"
                                                    aria-controls="account-watchlist" aria-selected="false"><i
                                                        class="fas fa-eye"></i> {{ __('pagination.Watch List') }}</a>
                                            </li>
                                            <li class="nav-item">
                                                <a id="account-details-tab" class="nav-link link--icon-left" data-toggle="tab" href="#account-details" role="tab"
                                                    aria-controls="account-details" aria-selected="false"><i class="fas fa-user"></i>
                                                    {{ __('pagination.Account Details') }}</a>
                                            </li>
                                            <li class="nav-item">
                                            <form id="logout" action="/logout" method="POST">{{ csrf_field() }}</form>
                                            <a class="nav-link link--icon-left" id="account-logout-tab" href="javascript: document.getElementById('logout').submit();" role="tab" aria-selected="false"><i class="fas fa-sign-out-alt"></i> {{ __('pagination.Logout') }} </a>
                                            </li>
                                        </ul>
                                    </div>
                                
                    </div> 
                    <div class="col-lg-9">
                
                        <div class="tab-content myaccount-tab-content" id="account-page-tab-content">
                            <div class="tab-pane fade show active" id="account-dashboard" role="tabpanel" aria-labelledby="account-dashboard-tab">
                                       
                                            <div class="my-account-dashboard account-wrapper">
                                                <h4 class="account-title">Dashboard</h4>
                                                <div class="welcome-dashboard m-t-30">
                                                    <p>{{ __('pagination.Hello, ') }}<b>{{ Auth::user()->firstname }}</b> (If Not <b>{{ Auth::user()->email }}? </b> <a
                                                    href="javascript: document.getElementById('logout').submit();">{{ __('pagination.Logout') }}</a> )</p>
                                                </div>
                                                <p class="m-t-25">{{ __('pagination.From your account dashboard you can view your recent orders, manage your shipping and billing addresses and edit your password and account details.') }}
                                                </p>
                                            </div>
                                     
                                
                                
                            </div>

                            <div class="tab-pane fade" id="account-orders" role="tabpanel" aria-labelledby="account-orders-tab">
                                <?= $aibody['account/history'] ?>
                            </div>

                            <div class="tab-pane fade" id="account-review" role="tabpanel" aria-labelledby="account-review-tab">
                                <?= $aibody['account/review'] ?>
                            </div>

                            <div class="tab-pane fade" id="account-address" role="tabpanel" aria-labelledby="account-address-tab">

                                <?= $aibody['account/profile'] ?>

                            </div>

                            <?php
    /*<div class="tab-pane fade" id="account-subscription" role="tabpanel" aria-labelledby="account-subscription-tab">

                                 <?= $aibody['account/subscription'] ?>

                            </div>*/
    ?>

                            <div class="tab-pane fade" id="account-favourite" role="tabpanel" aria-labelledby="account-favourite-tab">

                                 <?= $aibody['account/favorite'] ?>

                            </div>

                            <div class="tab-pane fade" id="account-pin" role="tabpanel" aria-labelledby="account-pin-tab">
                        


                                <?= $aibody['catalog/session'] ?? '' ?>

                            </div>

                            <div class="tab-pane fade" id="account-watchlist" role="tabpanel" aria-labelledby="account-watchlist-tab">

                                 <?= $aibody['account/watch'] ?>

                            </div>

                            <div class="tab-pane fade" id="account-details" role="tabpanel" aria-labelledby="account-details-tab">
                            
                                       <div class="myaccount-details account-wrapper">
                                       <h4 class="account-title">Account Details</h4>
                                            <form action="#account-details" class="kenne-form" method="post" enctype="multipart/form-data">
                                                {{ csrf_field() }}
                                                <div class="account-details">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-box__single-group">
                                                            <label for="account-details-firstname">{{ __('auth.Name') }}*</label>
                                                            <input type="text"  placeholder="First Name" id="account-details-firstname" name="address[payment][customer.firstname]" value="{{ Auth::user()->firstname }}" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-box__single-group">
                                                            <label for="account-details-lastname">{{ __('auth.Surname') }}*</label>
                                                            <input type="text"  placeholder="Last Name" id="account-details-lastname"  name="address[payment][customer.lastname]" value="{{ Auth::user()->lastname }}" required>
                                                            
                                                        </div>
                                                    </div>
                                                    <?php /* <div class="col-md-12">
                                                            <div class="form-box__single-group">
                                                                <label for="account-details-email">{{ __('Email') }}*</label>
                                                                <input type="email"  placeholder="Email address" id="account-details-email" value="{{ Auth::user()->email }}" required>
                                                           </div>
                                                    </div> */?>
                                                   

                                                    <div class="col-md-3">
                                                            <div class="form-box__single-group">
                                                                <button class="kenne-btn kenne-btn_dark btn btn--box btn--radius btn--small btn--black btn--black-hover-green btn--uppercase font--bold" value="1" name="address[save]">{{ __('auth.Save Change') }}</button>
                                                            </div>
                                                    </div>

                                                    
                                                </div>
                                            </form>
                                        </div>


                                        <div class="panel-body">

                                        <div class="col-md-12">
                                                            <div class="form-box__single-group">
                                                                <h5 class="title">{{ __('auth.Change Password') }}</h5>
                                                            </div>
                                                    </div> 
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                        <form class="form-horizontal" method="POST" id ="form1" name="formdeneme" action="/profile">
                            {{ csrf_field() }}

                            <div class="row">
   
                                                    <div class="col-md-12">
                            <div class="form-box__single-group form-group{{ $errors->has('current-password') ? ' has-error' : '' }}">
                                <label for="account-details-oldpass" class="col-md-4 control-label">{{ __('auth.Current Password') }}</label>

                    
                                    <input placeholder="{{ __('auth.Current Password') }}" id="account-details-oldpass" type="password" class="form-control" name="current-password" required>

                                    @if ($errors->has('current-password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('current-password') }}</strong>
                                        </span>
                                    @endif
                                
                            </div>
                            </div>

                                                    <div class="col-md-6">
                            <div class="form-box__single-group form-group{{ $errors->has('new-password') ? ' has-error' : '' }}">
                                <label for="new-password" class="col-md-4 control-label">{{ __('auth.New Password') }}</label>

                              
                                    <input placeholder="{{ __('auth.New Password') }}" id="new-password" type="password" class="form-control" name="new-password" required>

                                    @if ($errors->has('new-password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('new-password') }}</strong>
                                        </span>
                                    @endif
                               
                            </div>
                            </div>

                            <div class="col-md-6">
                            <div class="form-box__single-group form-group">
                                <label for="new-password-confirm" class=" control-label">{{ __('auth.Confirm New Password') }}</label>

                          
                                    <input placeholder="{{ __('auth.Confirm New Password') }}" id="new-password-confirm" type="password" class="form-control" name="new-password_confirmation" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="kenne-btn kenne-btn_dark btn btn--box btn--radius btn--small btn--black btn--black-hover-green btn--uppercase font--bold ">
                                    {{ __('auth.Change Password') }}
                                    </button>
                                </div>
                                </div>
                                </div>
                        </form>
                    </div>




                    <div class="panel-body">

<div class="col-md-12">
                    <div class="form-box__single-group">
                        <h5 class="title">{{ __('auth.Change Email') }}</h5>
                    </div>
            </div> 

<form class="form-horizontal" method="POST" id ="form2" name="formemail" action="/profile">
{{ csrf_field() }}
@if (session('message'))
<div class="alert alert-danger">
{{ session('message') }}
</div>
@endif
@if (session('messagesuccess'))
<div class="alert alert-success">
{{ session('messagesuccess') }}
</div>
@endif
<div class="row">


<div class="col-md-12">
                            <div class="form-box__single-group form-group{{ $errors->has('new-email') ? ' has-error' : '' }}">
                                <label for="new-email" class="col-md-4 control-label">{{ __('auth.Your Email') }}</label>

                              
                                    <input readonly value="{{ Auth::user()->email }}" placeholder="{{ __('auth.Your Email') }}" type="email" class="form-control" >

                            </div>
                            </div>


                            <div class="col-md-12">
                            <div class="form-box__single-group form-group{{ $errors->has('new-email') ? ' has-error' : '' }}">
                                <label for="new-email" class="col-md-4 control-label">{{ __('auth.New Email') }}</label>

                              
                                    <input placeholder="{{ __('auth.New Email') }}" id="new-email" type="email" class="form-control" name="new-email" required>

                                    @if ($errors->has('new-email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('new-email') }}</strong>
                                        </span>
                                    @endif
                               
                            </div>
                            </div>




                            <div class="col-md-12">
<div class="form-box__single-group form-group{{ $errors->has('current-pass') ? ' has-error' : '' }}">
<label for="account-details-oldpassword" class="col-md-4 control-label">{{ __('auth.Current Password') }}</label>


<input placeholder="{{ __('auth.Current Password') }}" id="account-details-oldpassword" type="password" class="form-control" name="current-pass" required>

@if ($errors->has('current-pass'))
<span class="help-block">
    <strong>{{ $errors->first('current-pass') }}</strong>
</span>
@endif

</div>
</div>
                            
           
<div class="form-group">
<div class="col-md-6 col-md-offset-4">
<button type="submit" class="kenne-btn kenne-btn_dark btn btn--box btn--radius btn--small btn--black btn--black-hover-green btn--uppercase font--bold ">
{{ __('auth.Change Email') }}
</button>
</div>
</div>
</div>
</form>
</div>


                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

     </main>

@stop
