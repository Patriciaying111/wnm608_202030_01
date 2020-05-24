window.addEventListener('load', function () {
    if(document.getElementById('addProduct')) {
        document.getElementById("addProduct").onsubmit = function(e) {
            e.preventDefault();
            const form = document.forms.addProduct;
            const values = new FormData(form);
            
            adminAPI('add', values).then(res => {    
                //console.log(res);
                window.location.href = "admin.php";
            }).catch(err => {
                console.log(err);
            });
        }
    }

    if(document.getElementById('updateProduct')) {
        document.getElementById('updateProduct').onsubmit = function(e) {
            e.preventDefault();
            
            const form = document.forms.updateProduct;
            const values = new FormData(form);

            const url = new URL(window.location.href);
            const id = url.searchParams.get("id");
            values.append('id', id);

            adminAPI('update', values).then(res => {
                // console.log(res);
                window.location.href = "admin.php";
            }).catch(err => {
                console.log(err);
            });
        }
    }
});

function backToAll() {
    window.location.href = "admin.php";
}

function deleteProduct(id) {
    const values = new FormData();
    values.append('id', id);

    adminAPI('delete', values).then(res => {
        // console.log(res);
        window.location.href = "admin.php";
    }).catch(err => {
        console.log(err);
    });
}