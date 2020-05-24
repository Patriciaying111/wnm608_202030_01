const templater = f => a =>
	(Array.isArray(a)?a:[a])
    .reduce((r,o,i,a)=>r+f(o,i,a),'')

const adminAPI = (type,body) => {
    // Fetch is a Promise
    console.log(type, body);
    return fetch(
        `services/admin.php?type=${type}`,
        {
            method:'POST',
            body:body
        }
    ).then(d => {
        console.log(d);
        return d.json();
    }).catch(err => {
        console.log('error', err);
    });
}

const cartAPI = (type,body) => {
	// Fetch is a Promise
	console.log(type, body);
	return fetch(
		`services/cart.php?type=${type}`,
		{
			method:'POST',
			body:body
		}
    ).then(d => {
		// console.log(d);
		return d.json();
    }).catch(err => {
        console.log('error', err);
    });
}

const productsAPI = (type,body) => {
	// Fetch is a Promise
    const url = body['field']? `services/products.php?type=${type}&field=${body['field']}`: `services/products.php?type=${type}`;
    // console.log(url);
    return fetch(
		url,
		{
			method:'POST',
			body:body
		}
    ).then(d => {
        res = d.json();
        // console.log('test res', res);
		return res;
    }).catch(err => {
        console.log('error', err);
    });
}