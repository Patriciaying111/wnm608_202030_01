function search(type) {
    productsAPI(type, {}).then(res => {
        console.log(res);
        const result = res['result'];
        document.getElementById('all-result').style.display = 'none';
        document.getElementById('search-result').innerHTML = listTemplate(result);
    }).catch(err => {
        console.log(err);
    });
}

function changeSort(value) {
    productsAPI('sort', {'field': value}).then(res => {
        const result = res['result'];
        document.getElementById('all-result').style.display = 'none';
        document.getElementById('search-result').innerHTML = listTemplate(result);
    }).catch(err => {
        console.log(err);
    })
}

function addCart() {
    const url = new URL(window.location.href);
    const id = url.searchParams.get("id");
    const form_data = new FormData();
    form_data.append('id', id);

    cartAPI('search', form_data).then(res => {
        const result = res['result'];
        if(result.length > 0) {
            form_data.append('count', result[0]['count']+1);
            cartAPI('update', form_data).then(res => {
                window.location.reload();
            }).catch(err => {
                console.warn(err);
            });
        } else {
            form_data.append('count', 1);
            cartAPI('add', form_data).then(res => {
                window.location.reload();
            }).catch(err => {
                console.warn(err);
            });
        }
    }).catch(err => {
        console.log(err);
    });
}

function deleteCart(cartId) {
    const form_data = new FormData();
    form_data.append('cartId', cartId);

    cartAPI('delete', form_data).then(res => {
        window.location.reload();
    }).catch(err => {
        console.warn(err);
    });
}

function switchImage(id) {
    if(id === 1) {
        document.getElementById('image-1').style.display = 'block';
        document.getElementById('image-2').style.display = 'none';
    } else {
        document.getElementById('image-1').style.display = 'none';
        document.getElementById('image-2').style.display = 'block';
    }
}

window.addEventListener('load', function () {
    if(document.getElementById('makePayment')) {
        document.getElementById("makePayment").onsubmit = function(e) {
            e.preventDefault();
            const form = document.forms.addProduct;
            const values = new FormData(form);
            
            const url = new URL(window.location.href);
            const cartid = url.searchParams.get("cartid");
            values.append('cartid', cartid);
            
            cartAPI('make-payment', values).then(res => {
                console.log(res);
                window.location.href = "confirmation.php";
            }).catch(err => {
                console.log(err);
            });
        }
    }
});