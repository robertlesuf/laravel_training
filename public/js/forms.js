//form for checkout
$('#checkout').submit(function (e) {
    e.preventDefault();
    formData = new FormData(this);
    $.ajax('/orders', {
        type: 'POST',
        dataType: 'json',
        contentType: false,
        processData: false,
        data: formData,
        success: function (data) {
            window.location.hash = '#index';
        },
        error: function (data) {
            let errors = data.responseJSON.errors;
            if ('name' in errors) {
                $('#nameError').html(trans(errors.name[0]));
            } else {
                $('#nameError').html('');
            }
            if ('contact' in errors) {
                $('#contactError').html(trans(errors.contact[0]));
            } else {
                $('#contactError').html('');
            }
            if ('comments' in errors) {
                $('#commentsError').html(trans(errors.comments[0]));
            } else {
                $('#commentsError').html('');
            }
            if ('products' in errors) {
                $('#productsError').html(trans(errors.products[0]));
            } else {
                $('#productsError').html('');
            }
        }

    });
});


//form for products.store
$('#create').submit(function (e) {
    e.preventDefault();
    formData = new FormData(this);
    $.ajax('/products', {
        type: 'POST',
        dataType: 'json',
        contentType: false,
        processData: false,
        data: formData,
        success: function (data) {
            window.location.hash = '#products';
        },
        error: function (data) {
            let errors = data.responseJSON.errors;
            if ('title' in errors) {
                $('#titleErrorCreate').html(trans(errors.title[0]));
            } else {
                $('#titleErrorCreate').html('');
            }
            if ('description' in errors) {
                $('#descriptionErrorCreate').html(trans(errors.description[0]));
            } else {
                $('#descriptionErrorCreate').html('');
            }
            if ('price' in errors) {
                $('#priceErrorCreate').html(trans(errors.price[0]));
            } else {
                $('#priceErrorCreate').html('');
            }
            if ('image' in errors) {
                $('#imageErrorCreate').html(trans(errors.image[0]));
            } else {
                $('#imageErrorCreate').html('');
            }
        }
    });
});

//form for products.update
$('#update').submit(function (e) {
    e.preventDefault();
    formData = new FormData(this);
    formData.append('_method', 'PUT');
    $.ajax('/products/' + formData.get('id'), {
        type: 'POST',
        dataType: 'json',
        contentType: false,
        processData: false,
        data: formData,
        success: function (data) {
            window.location.hash = '#products';
        },
        error: function (data) {
            let errors = data.responseJSON.errors;
            if ('title' in errors) {
                $('#titleError').html(trans(errors.title[0]));
            } else {
                $('#titleError').html('');
            }
            if ('description' in errors) {
                $('#descriptionError').html(trans(errors.description[0]));
            } else {
                $('#descriptionError').html('');
            }
            if ('price' in errors) {
                $('#priceError').html(trans(errors.price[0]));
            } else {
                $('#priceError').html('');
            }
            if ('image' in errors) {
                $('#imageError').html(trans(errors.image[0]));
            } else {
                $('#imageError').html('');
            }
        }
    });
});

//form for AuthAjax.login
$('#login').submit(function (e) {
    e.preventDefault();
    formData = new FormData(this);
    $.ajax('/login', {
        type: 'POST',
        contentType: false,
        processData: false,
        dataType: 'json',
        data: formData,
        success: function (data) {
            $.ajax('/regenerate', {
                type: 'get', dataType: 'json', success: function (result) {
                    $('meta[name="csrf-token"]').attr('content', result.csrfToken);
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                },
            });
            window.location.hash = '#products';
        },
        error: function (data) {
            errors = data.responseJSON.errors;
            if ('email' in errors) {
                $('#usernameError').html(trans(errors.email[0]));
            } else {
                $('#usernameError').html('');
            }
            if ('password' in errors) {
                $('#passwordError').html(trans(errors.password[0]));
            } else {
                $('#passwordError').html('');
            }
        }
    });
});
