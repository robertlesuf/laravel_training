function renderLogin() {
    return [
        '<label>' + trans('username') + '</label>',
        '<input type="text" name="email" id="username">',
        '<span class="error" id="usernameError"></span>',
        '<label>' + trans('password') + '</label>',
        '<input type="password" name="password" id="password">',
        '<span class="error" id="passwordError"></span>',
        '<span class="error" id="loginError"></span>',
        '<input type="hidden" name="device_name" value="' + makeTokenName(10) + '">',
        '<input type="submit" value="' + trans('Login') + '" />',
        '<br>'
    ];
}

function renderList(products, page) {
    html = [
        '<tr>',
        '<th>' + trans('Title') + '</th>',
        '<th>' + trans('Description') + '</th>',
        '<th>' + trans('Price') + '</th>',
        '<th>' + trans('Image') + '</th>',
        '</tr>'
    ].join('');

    $.each(products, function (key, product) {
        html += [
            '<tr>',
            '<td>' + product.title + '</td>',
            '<td>' + product.description + '</td>',
            '<td>' + product.price + '</td>',
            '<td><img src="images/' + product.image_path + '"</td>',
            '<td>' + '<a href="#' + page + product.id + '" class="button">' + trans(page) + '</a>' + '</td>',

        ].join('');
        if (page === 'edit') {
            html += [
                '<td>' + '<a href="#' + 'delete' + product.id + '" class="button">' + trans('Delete') + '</a>' + '</td>',
            ].join('');
        }
        html += ['</tr>'].join('');

    });
    return html;
}

function renderProductsForOrder(products) {
    html = [
        '<tr>',
        '<th>' + trans('Title') + '</th>',
        '<th>' + trans('Description') + '</th>',
        '<th>' + trans('Price') + '</th>',
        '<th>' + trans('Image') + '</th>',
        '</tr>'
    ].join('');

    $.each(products, function (key, product) {
        html += [
            '<tr>',
            '<td>' + product.title + '</td>',
            '<td>' + product.description + '</td>',
            '<td>' + product.pivot.price + '</td>',
            '<td><img src="images/' + product.image_path + '"</td>',
            '</tr>'
        ].join('');
    });
    return html;
}

function renderCheckout(productsCheck) {
    return [
        '<label>' + trans('name') + '</label>',
        '<input type="text" name="name" id="name">',
        '<span class="error" id="nameError"></span>',
        '<label>' + trans('contact') + '</label>',
        '<input type="text" name="contact" id="contact">',
        '<span class="error" id="contactError"></span>',
        '<label>' + trans('comments') + '</label>',
        '<input type="text" name="comments" id="comments">',
        '<input type="hidden" name="products" id="products" value="' + productsCheck + '">',
        '<span class="error" id="commentsError"></span>',
        '<span class="error" id="productsError"></span>',
        '<input type="submit" class="checkout" value="' + trans('Checkout') + '"/>',
        '<br>'
    ];
}

function renderUpdateProduct(data) {
    return [
        '<input type="hidden" name="id" id="id" value="' + data.id + '"/>',
        '<label>' + trans('title') + '</label>',
        '<input type="text" name="title" id="title" value="' + data.title + '">',
        '<span class="error" id="titleError"></span>',
        '<label>' + trans('description') + '</label>',
        '<input type="text" name="description" id="description" value="' + data.description + '">',
        '<span class="error" id="descriptionError"></span>',
        '<label>' + trans('price') + '</label>',
        '<input type="text" name="price" id="price" value="' + data.price + '">',
        '<span class="error" id="priceError"></span>',
        '<label>' + trans('Upload image') + '</label>',
        '<input type="file" name="image" id="image"/>',
        '<span class="error" id="imageError"></span>',
        '<input type="submit" value="' + trans('Update') + '" </input>',
    ]
}

function renderCreateProduct() {
    return [
        '<label>' + trans('title') + '</label>',
        '<input type="text" name="title" id="title">',
        '<span class="error" id="titleErrorCreate"></span>',
        '<label>' + trans('description') + '</label>',
        '<input type="text" name="description" id="description">',
        '<span class="error" id="descriptionErrorCreate"></span>',
        '<label>' + trans('Price') + '</label>',
        '<input type="text" name="price" id="price">',
        '<span class="error" id="priceErrorCreate"></span>',
        '<label>' + trans('Upload image') + '</label>',
        '<input type="file" name="image" id="image"/>',
        '<span class="error" id="imageErrorCreate"></span>',
        '<input type="submit" value=" ' + trans('Submit') + ' " />',
    ]
}


function renderOrders(orders) {
    html = [
        '<tr>',
        '<th>' + trans('Name') + '</th>',
        '<th>' + trans('Contact') + '</th>',
        '<th>' + trans('Comments') + '</th>',
        '<th>' + trans('Total') + '</th>',
        '<th>' + trans('Created at') + '</th>',
        '</tr>'
    ].join('');

    $.each(orders, function (key, order) {
        html += [
            '<tr>',
            '<td>' + order.name + '</td>',
            '<td>' + order.contact + '</td>',
            '<td>' + order.comments + '</td>',
            '<td>' + order.total + '</td>',
            '<td>' + order.created_at + '</td>',
            '<td>' + '<a href="#' + 'order' + order.id + '" class="button">' + trans('View more') + '</a>' + '</td>',
            '</tr>'
        ].join('');
    });
    return html;
}

function renderOrder(order) {
    html = [
        '<tr>',
        '<th>' + trans('Name') + '</th>',
        '<th>' + trans('Contact') + '</th>',
        '<th>' + trans('Comments') + '</th>',
        '<th>' + trans('Created at') + '</th>',
        '</tr>'
    ].join('');

    html += [
        '<tr>',
        '<td>' + order.name + '</td>',
        '<td>' + order.contact + '</td>',
        '<td>' + order.comments + '</td>',
        '<td>' + order.created_at + '</td>',
        '</tr>'
    ].join('');
    return html;
}

//used for device_name when generation tokens
function makeTokenName(length) {
    var result = '';
    var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    var charactersLength = characters.length;
    for (var i = 0; i < length; i++) {
        result += characters.charAt(Math.floor(Math.random() *
            charactersLength));
    }
    return result;
}