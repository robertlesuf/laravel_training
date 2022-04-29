$(document).ajaxError(function (ajaxError, data) {
    if (data.status == '401') {
        window.location.hash = '#login';
    }
});

$(document).ready(function () {
    //setup for initial csrf token
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    window.onhashchange = function () {
        // First hide all the pages
        $('.page').hide();

        switch (window.location.hash) {
            //case for cart
            case '#cart':
                // Show the cart page
                $('.cart').show();
                // Load the cart products from the server
                $.ajax('/cart', {
                    dataType: 'json',
                    success: function (response) {
                        // Render the products in the cart list
                        $('.cart .list').html(renderList(response, 'remove'));
                        // Render the checkout form
                        $('.cart .form').html(renderCheckout(response.length ? 1 : ''));
                    }
                });
                break;

            //case for products
            case '#products':
                // Show the cart page
                $('.products').show();
                // Load the cart products from the server
                $.ajax('/products', {
                    type: 'GET',
                    dataType: 'json',
                    success: function (response) {
                        // Render the products in the product list
                        $('.products .list').html(renderList(response, 'edit'));
                    },
                });
                break;

            //case for orders
            case '#orders':
                // Show the cart page
                $('.orders').show();
                // Load the cart products from the server
                $.ajax('/orders', {
                    type: 'GET',
                    dataType: 'json',
                    success: function (response) {
                        // Render the products in the product list
                        $('.orders .list').html(renderOrders(response.orders));
                    },
                });
                break;

            //case for login form
            case '#login':
                // Show the login page
                $.ajax('/status', {
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        if (data.status === true) {
                            window.location.hash = '#products';
                        } else {
                            $('.login').show();
                            //Render the login form
                            $('.login .form').html(renderLogin());
                        }
                    },
                });
                break;

            //case for logout
            case '#logout':
                $.ajax('/logout', {
                    type: 'POST',
                    dataType: 'json',
                    success: function () {
                        //Refresh CSRF token after logout
                        $.ajax('/regenerate', {
                            type: 'get',
                            dataType: 'json',
                            success: function (result) {
                                $('meta[name="csrf-token"]').attr('content', result.csrfToken);
                                $.ajaxSetup({
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    }
                                });
                            },
                        });
                        window.location.hash = '#index';
                    },
                });
                break;

            //case for products.create
            case '#create':
                // Show the create page
                $('.create').show();
                $('.create .form').html(renderCreateProduct());
                break;

            //case for adding to cart
            case ((window.location.hash.match(/#add\d+/) || {}).input):
                $.ajax('/cart', {
                    type: 'POST',
                    dataType: 'json',
                    data: {'id': window.location.hash.match(/\d+/)[0],},
                    success: function () {
                        window.location.hash = '#index';
                    }
                });
                break;

            //case for products.edit
            case ((window.location.hash.match(/#edit\d+/) || {}).input):
                $('.product').show();
                $.ajax('/products/' + window.location.hash.match(/\d+/)[0] + '/edit', {
                    type: 'GET',
                    dataType: 'json',
                    success: function (response) {
                        $('.product .form').html(renderUpdateProduct(response));
                    },
                });
                break;

            //case for products.destroy
            case ((window.location.hash.match(/#delete\d+/) || {}).input):
                $.ajax('/products/' + window.location.hash.match(/\d+/)[0], {
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        '_method': 'DELETE',
                    },
                    success: function (response) {
                        window.location.hash = '#products';
                    },
                });
                break;

            //case for orders.show
            case ((window.location.hash.match(/#order\d+/) || {}).input):
                $('.order').show();
                $.ajax('/orders/' + window.location.hash.match(/\d+/)[0], {
                    type: 'GET',
                    dataType: 'json',
                    data: {'id': window.location.hash.match(/\d+/)[0],},
                    success: function (response) {
                        $('.order .content').html(renderOrder(response.order));
                        $('.order .list').html(renderProductsForOrder(response.order.products));
                    },
                });
                break;

            //case for cart.destroy
            case ((window.location.hash.match(/#remove\d+/) || {}).input):
                $.ajax(('/cart/' + window.location.hash.match(/\d+/)[0]), {
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        '_method': 'DELETE',
                    },
                    success: function () {
                        window.location.hash = '#cart';
                    }
                });
                break;

            default:
                // If all else fails, always default to index
                // Show the index page
                $('.index').show();
                // Load the index products from the server
                $.ajax('/', {
                    dataType: 'json',
                    success: function (response) {
                        // Render the products in the index list
                        $('.index .list').html(renderList(response, 'add'));
                    }
                });
                break;
        }
    }
    window.onhashchange();
});