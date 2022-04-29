<html>
<head>
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <!-- Load the jQuery JS library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- CSRF -->
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
</head>
<body>

<!-- The index page -->
<div class="page index">
    <!-- Links in the index page -->
    <a href="#cart" class="button">{{ __('Cart') }}</a>
    <a href="#login">{{ __('Login') }}</a>
    <a href="#orders" class="button">{{ __('Orders') }}</a>
    <a href="#products" class="button">{{ __('Products') }}</a>
    <!-- The index element where the products list is rendered -->
    <table class="list"></table>
</div>

<!-- The cart page -->
<div class="page cart">
    <a href="#" class="button">{{ __('Index') }}</a>
    <!-- The cart element where the products list is rendered -->
    <table class="list"></table>
    <form id="checkout" class="form"></form>
    <!-- A link to go to the index by changing the hash -->
</div>

<!-- The login page -->
<div class="page login">
    <a href="#" class="button">{{ __('Index') }}</a>
    <form class="form" id="login"></form>
</div>

<!-- The products page -->
<div class="page products">
    <a href="#" class="button">{{ __('Index') }}</a>
    <a href="#create" class="button">{{ __('Create') }}</a>
    <a href="#orders" class="button">{{ __('Orders') }}</a>
    <a href="#logout" class="button">{{ __('Logout') }}</a>
    <table class="list"></table>
</div>

<!-- The edit product page -->
<div class="page product">
    <a href="#products" class="button">{{ __('Products') }}</a>
    <a href="#logout" class="button">{{ __('Logout') }}</a>
    <form class="form" enctype="multipart/form-data" id="update"></form>
</div>

<!-- The create page -->
<div class="page create">
    <a href="#products" class="button">{{ __('Products') }}</a>
    <a href="#logout" class="button">{{ __('Logout') }}</a>
    <form class="form" enctype="multipart/form-data" id="create"></form>
</div>

<!-- The orders page -->
<div class="page orders">
    <a href="#products" class="button">{{ __('Products') }}</a>
    <a href="#logout" class="button">{{ __('Logout') }}</a>
    <table class="list"></table>
</div>

<!-- The order page -->
<div class="page order">
    <a href="#orders" class="button">{{ __('Orders') }}</a>
    <a href="#logout" class="button">{{ __('Logout') }}</a>
    <table class="content"></table>
    <table class="list"></table>
</div>

</body>

<script type="text/javascript" rel="javascript" src="{{ asset('js/forms.js') }}"></script>
<script type="text/javascript" rel="javascript" src="{{ asset('js/translation.js') }}"></script>
<script type="text/javascript" rel="javascript" src="{{ asset('js/render.js') }}"></script>
<script type="text/javascript" rel="javascript" src="{{ asset('js/routing.js') }}"></script>

</html>
