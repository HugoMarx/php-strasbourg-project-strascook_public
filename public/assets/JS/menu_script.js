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

let filters = document.querySelector("#filtre-plat");

filters.addEventListener("change", function (event) {
    let product_type = event.target.value;
    let products = document.querySelectorAll(".col-xs");
    let starter = document.querySelectorAll(`.starter`);
    let main = document.querySelectorAll(`.main`);
    let dessert = document.querySelectorAll(`.dessert`);
    let drink = document.querySelectorAll(`.drink`);
    // console.log(main);

    if (product_type === "all") {
        for (i = 0; i < products.length; i++) {
            products[i].style.display = "flex";
        }
    } else {
        for (i = 0; i < products.length; i++) {
            products[i].style.display = "none";
        }

        if (product_type === "starter") {
            for (i = 0; i < starter.length; i++)
                starter[i].style.display = "flex";
        }

        if (product_type === "main") {
            for (i = 0; i < main.length; i++)
                main[i].style.display = "flex";
        }

        if (product_type === "dessert") {
            for (i = 0; i < starter.length; i++)
                dessert[i].style.display = "flex";
        }

        if (product_type === "drink") {
            for (i = 0; i < starter.length; i++)
                drink[i].style.display = "flex";
        }
    }
});
