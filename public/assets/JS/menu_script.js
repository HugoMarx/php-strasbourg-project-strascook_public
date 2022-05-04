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
