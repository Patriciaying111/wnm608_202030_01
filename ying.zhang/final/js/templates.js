const listTemplate = templater(p => {
    const price = p['price'];
	const name = p['name'];
	const src = p['image'];
    const id = p['id'].toString();
    
    return `
    <div style='text-align:center;padding:16px 0 16px 0;' class='col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4'>
        <a class='product-wrapper' href='product_item.php?id=${id}'>
            <div style='text-align:left'><img src='${src}' alt='' class='product-image'></div>

            <div class='product-description'>
                <div class='product-name'>${name}</div>
                <div class='product-price'>$ ${price}</div>
            </div>
        </a>
    </div>
    `;
})