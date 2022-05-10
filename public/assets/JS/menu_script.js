function addItem() {
    const selectors = document.getElementsByClassName("qte-selector ");
    for (i = 0; i < selectors.length; i++) {
        const addButton = selectors[i].getElementsByClassName("add_item");
        const quantityInput =
            selectors[i].getElementsByClassName("item_quantity");
        addButton[0].addEventListener("click", function () {
            quantityInput[0].value++;
        });
    }
}

function deleteItem() {
    const selectors = document.getElementsByClassName("qte-selector ");

    for (i = 0; i < selectors.length; i++) {
        const delButton = selectors[i].getElementsByClassName("del_item");
        const quantityInput =
            selectors[i].getElementsByClassName("item_quantity");
        delButton[0].addEventListener("click", function () {
            if (quantityInput[0].value > 1) {
                quantityInput[0].value--;
            }
        });
    }
}

addItem();
deleteItem();



let filters = document.querySelectorAll('input[type="radio"]');
filters.forEach(function(filter) {
    filter.addEventListener('click', function(e) {
        let product_type = e.target.id;
        let products = document.querySelectorAll('.col-xs');
        let productsFilter = document.querySelectorAll(`.${product_type}`);
        products.forEach(function(product) {
                if (product.classList.contains('col-xs')) {
                    if (document.querySelector('input[id="all"]').checked) {
                        product.style.display = 'flex';
                    } else if (filter.id==product.id && filter.checked) {
                        product.style.display = 'flex';
                    } else if (filter.id!=product.id && filter.checked) {
                        product.style.display = 'none';
                    }
                }
            
        });
    });
});