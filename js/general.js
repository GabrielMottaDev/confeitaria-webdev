rewriteYear();
listenProductClick();

function rewriteYear(){
    let yearDate = new Date().getFullYear();

    let years = document.getElementsByClassName("js-year");
    for(let i = 0; i < years.length; i++) {
        let year = years[i];
        year.innerText = yearDate;
    }
}

function listenProductClick(){
    let products = document.getElementsByClassName("product");

    let clickCallback = (ev) => {
        let product = ev.currentTarget;
        let productId = product.getAttribute("product-id");
        if(productId == null){
            return;
        }
        window.location.href = "fazer-pedido.php?id=" + productId;
    };

    for(let i = 0; i < products.length; i++){
        let product = products[i];
        product.onclick = clickCallback;
    }
}