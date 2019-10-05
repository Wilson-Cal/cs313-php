let addToCartButtons = document.querySelectorAll(".halfway-fab");

let shoppingCart = {};

let shoppingCartMap = {
    chocolate_chip: {
        title: "Chocolate Chip Cookie",
        image: "chocolatechipcookie"
    },
    sugar: {
        title: "Sugar Cookie",
        image: "sugarcookie"
    },
    snickerdoodle: {
        title: "Snickerdoodle Cookie",
        image: "snickerdoodlecookie"
    },
    peanut_butter: {
        title: "Peanut Butter Cookie",
        image: "peanutbuttercookie"
    },
    m_m: {
        title: "M&M Cookie",
        image: "mmcookie"
    },
    chocolate: {
        title: "Chocolate Cookie",
        image: "chocolatecookie"
    },
}

const sendAjax = (request, type, callback = null) => {
    console.log(request);
    let xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            if (this.responseText) {
                shoppingCart = JSON.parse(this.responseText);
            }
            if (callback) {
                callback();
            }
        }
    };
    xhttp.open(type, "../week03/session.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(request);
}

const showToastMessage = (message) => {
    M.toast({ html: message, classes: 'orange' })
}

const addToCart = (context) => {
    let { id } = context.target;
    let requestObj = { name: id, quantity: 1 };
    sendAjax("x=" + JSON.stringify(requestObj), "POST", () => showToastMessage("Successfully Added to Cart"));
}

const removeFromCart = (context) => {
    let { id } = context.target;
    let requestObj = { name: id, remove: true };
    sendAjax("x=" + JSON.stringify(requestObj), "POST", () => {
        displayShoppingCart();
        showToastMessage("Successfully Removed from Cart")
    });
}

const updateQuantity = (context) => {
    let { dataset, value } = context.target;
    let requestObj = { name: dataset.id, quantity: parseInt(value), update: true };
    if (value > 0) {
        sendAjax("x=" + JSON.stringify(requestObj), "POST", () => {
            showToastMessage("Successfully Updated Quantity")
            displayShoppingCart();
        });
    } else {
        removeFromCart({ target: { id: dataset.id } });
    }
}

const displayShoppingCart = () => {
    const shoppingCartDiv = document.querySelector("#shopping_cart");
    const checkoutDiv = document.querySelector("#checkout");
    const { chocolate_chip, sugar, snickerdoodle, peanut_butter, m_m, chocolate } = shoppingCart;
    let notEmptyCheck = chocolate_chip || sugar || snickerdoodle || peanut_butter || m_m || chocolate;
    if (notEmptyCheck) {
        let htmlString = '<ul class="collection left-align">';
        let keys = Object.keys(shoppingCart);
        keys.forEach(key => {
            if (shoppingCart[key] > 0) {
                let template = `
                <li class="collection-item avatar">
                    <img src="../images/${shoppingCartMap[key].image}.jpg" alt="" class="circle">
                    <span class="title">${shoppingCartMap[key].title}</span>
                    <p>Price: $${(shoppingCart[key] * 1.50).toFixed(2)}</p>
                    <div class="input-field">
                        <p>Quantity</p>
                        <input id="quantity" data-id="${key}" type="number" class="validate" value="${shoppingCart[key]}">
                    </div>
                    <a href="#!" class="secondary-content"><i class="material-icons remove" id="${key}">remove_shopping_cart</i></a>
                </li>`;
                htmlString += template;
            }
        });
        htmlString += '</ul>';
        shoppingCartDiv.innerHTML = htmlString;
        checkoutDiv.innerHTML = '<nav><div class="orange nav-wrapper"><a href="../week03/checkout.php"><i class="material-icons">shopping_cart</i></a></div></nav>';
        let removeFromCartButtons = document.querySelectorAll(".remove");
        if (removeFromCartButtons.length > 0) {
            removeFromCartButtons.forEach(button => {
                button.addEventListener("click", removeFromCart);
            });
        }
        let quantityFields = document.querySelectorAll("#quantity");
        if (quantityFields.length > 0) {
            quantityFields.forEach(field => {
                field.addEventListener("change", updateQuantity);
            });
        }

    } else {
        checkoutDiv.innerHTML = "";
        shoppingCartDiv.innerHTML = "<p>Cart is empty!</p>";
    }

}

const loadShoppingCart = () => {
    sendAjax(null, "GET", displayShoppingCart);
}

if (addToCartButtons.length > 0) {
    addToCartButtons.forEach(button => {
        button.addEventListener("click", addToCart);
    });
} else {
    loadShoppingCart();
}
