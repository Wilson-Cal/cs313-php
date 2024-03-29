// Computer Components
let computerComponents = [{
    name: 'All Items'
},
{
    name: 'Cases',
    url: 'dbquery.php',
    type: 'computer_case',
    data: []
},
{
    name: 'Coolers',
    url: 'dbquery.php',
    type: 'cooler',
    data: []
},
{
    name: 'Graphics Cards',
    url: 'dbquery.php',
    type: 'graphics_card',
    data: []
},
{
    name: 'Memory',
    url: 'dbquery.php',
    type: 'memory',
    data: []
},
{
    name: 'Motherboards',
    url: 'dbquery.php',
    type: 'motherboard',
    data: []
},
{
    name: 'Power Supply Units',
    url: 'dbquery.php',
    type: 'power_supply_unit',
    data: []
},
{
    name: 'Processors',
    url: 'dbquery.php',
    type: 'processor',
    data: []
},
{
    name: 'Storage',
    url: 'dbquery.php',
    type: 'storage',
    data: []
}
];

let rowCount = 0;
let modal = document.getElementById('myModal');
let signInModal = document.querySelector("#log_in_modal");
let signUpModal = document.querySelector('#sign_up_modal');
let favorites = [];

// This function is responsible for making any HTTP calls to APIs or PHP files
function Get(url, request = "") {
    return new Promise((resolve) => {
        let xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                resolve(this.responseText);
            }
        };
        xhttp.open('POST', url, true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send(request);
    });
}

// Creates the dropdown in the nav bar
function setCategoriesDropdown() {
    let categories = document.querySelector('[id=categories]');
    computerComponents.forEach(component => {
        let option = document.createElement('option');
        option.setAttribute('value', component.name);
        option.appendChild(document.createTextNode(component.name));
        categories.appendChild(option);
    });
}

// Sets the categories title
function setCategoryTitle(category = document.querySelector('select').value) {
    document.querySelector('h2').textContent = category;
}

// Filters components if a search or category was provided
function getFilteredComponents(category, q) {
    let loader = document.getElementById('loader');
    let filteredComponents = [];
    let i, j;
    let partValues;


    // Set category to undefined if 'All Items' is selected
    if (category === 'All Items') {
        category = undefined;
    }

    // Set q to undefined if it is a blank string
    if (q === '') {
        q = undefined;
    }

    // Check to see if the data is there
    if (computerComponents[8].data.length === 0 || computerComponents[4].data.length === 0) {
        loader.style.display = 'block';
        window.setTimeout(() => {
            createTable(getFilteredComponents(category, q));
        }, 150);
    } else {
        // Get the correct items to put into the table
        loader.style.display = 'none';
        if (q !== undefined && category !== undefined) {
            // The user has defined a category and a search parameter
            i = computerComponents.findIndex(component => {
                return component.name === category;
            });
            filteredComponents = computerComponents[i].data.filter((part, index) => {
                partValues = Object.values(part);
                for (j = 0; j < partValues.length; j++) {
                    if (partValues[j] !== null) {
                        if (partValues[j].toString().toLowerCase().includes(q)) {
                            computerComponents[i].data[index].category = computerComponents[i].name;
                            return true;
                        }
                    }
                }
            });
        } else if (category !== undefined) {
            // A category other than 'All Items' has been selected
            i = computerComponents.findIndex(component => {
                return component.name === category;
            });
            computerComponents[i].data.forEach((part, index) => {
                computerComponents[i].data[index].category = computerComponents[i].name;
            });
            filteredComponents = computerComponents[i].data;
        } else if (q !== undefined) {
            // Only a query is given, run it against all items
            computerComponents.forEach((component, index) => {
                if (component.name !== 'All Items') {
                    component.data.forEach((item, iIndex) => {
                        partValues = Object.values(item);
                        for (j = 0; j < partValues.length; j++) {
                            if (partValues[j] !== null) {
                                if (partValues[j].toString().toLowerCase().includes(q)) {
                                    computerComponents[index].data[iIndex].category = component.name;
                                    filteredComponents.push(item);
                                    break;
                                }
                            }
                        }
                    });
                }
            });
        } else {
            // Get all items
            computerComponents.forEach((component, index) => {
                if (component.name !== 'All Items') {
                    component.data.forEach((item, iIndex) => {
                        computerComponents[index].data[iIndex].category = component.name;
                        filteredComponents.push(item);
                    });
                }
            });
        }

        return filteredComponents;
    }
}

// Makes the modal for a componenet to show its information
function makeModal(itemName, item) {
    let amazonLink = document.getElementById('amazon-link');
    let neweggLink = document.getElementById('newegg-link');
    let table = document.getElementById('modal-table-body');
    let favoriteStar = document.getElementsByClassName('favorite')[0];
    let tr = document.createElement('tr');
    let keys = Object.keys(item);
    let th;
    let td;

    // First make the modal header
    document.getElementById('item-name').innerHTML = itemName;

    // Second, make the column headers
    while (table.firstChild) {
        table.removeChild(table.firstChild);
    }

    keys.forEach(key => {
        th = document.createElement('th');
        th.textContent = key;
        tr.appendChild(th);
    });
    table.appendChild(tr);

    // Third, add the data.
    tr = document.createElement('tr');
    keys.forEach(key => {
        td = document.createElement('td');
        if (key === 'price') {
            td.textContent = '$' + item[key];
        } else {
            td.textContent = item[key];
        }
        tr.appendChild(td);
    });
    table.appendChild(tr);

    amazonLink.setAttribute('href', `https://www.amazon.com/s/ref=nb_sb_noss?url=search-alias%3Dcomputers&field-keywords=${itemName}`);
    amazonLink.textContent = itemName;

    neweggLink.setAttribute('href', `https://www.newegg.com/Product/ProductList.aspx?Submit=ENE&DEPA=0&Order=BESTMATCH&Description=${itemName}`);
    neweggLink.textContent = itemName;

    if (favorites === null) {
        favoriteStar.innerHTML = '&#9734;';
        favoriteStar.setAttribute('data-star', 'off');
    } else if (favorites.length > 0) {
        // Search to see if the selected item is a favorite
        let i = favorites.findIndex(favorite => {
            return favorite.part_name.toLowerCase() === itemName.toLowerCase();
        });
        if (i !== -1) {
            // The item is a favorite
            favoriteStar.innerHTML = '&#9733;';
            favoriteStar.setAttribute('data-star', 'on');
        } else {
            // The item is not a favorite
            favoriteStar.innerHTML = '&#9734;';
            favoriteStar.setAttribute('data-star', 'off');
        }
    } else {
        // The user has no favorites
        favoriteStar.innerHTML = '&#9734;';
        favoriteStar.setAttribute('data-star', 'off');
    }


    // Finally, display the modal to the user.
    modal.style.display = 'block';
}

// Function that creates the various tables found in the application
function createTable(filteredComponents) {
    let content = document.querySelector('[class=content]');
    let footer = document.getElementsByTagName('footer')[0];
    let table = document.querySelector('tbody');
    let tr = document.createElement('tr');
    let name = document.createElement('th');
    let category = document.createElement('th');
    let price = document.createElement('th');
    let btn = document.createElement('button');
    let span = document.createElement('span');
    let resultsMsg = document.createElement('p');
    let categoryTitle = document.getElementById('categoryTitle');
    let i;

    if (document.querySelector('button') !== null) {
        content.removeChild(document.querySelector('button'));
    }

    if (document.getElementById('resultsMsg') !== null) {
        categoryTitle.removeChild(document.getElementById('resultsMsg'));
    }

    // Reset the table
    while (table.firstChild) {
        table.removeChild(table.firstChild);
    }
    if (filteredComponents === undefined) {
        return;
    }
    if (filteredComponents.length === 0) {
        content.style.display = "block";
        footer.style.display = "block";
        resultsMsg.textContent = `${filteredComponents.length} results found`;
        resultsMsg.setAttribute('id', 'resultsMsg');
        categoryTitle.appendChild(resultsMsg);
        return;
    }

    name.textContent = 'Name';
    category.textContent = 'Category';
    price.textContent = 'Price';

    name.addEventListener('click', () => {
        sortTable(0);
    });

    category.addEventListener('click', () => {
        sortTable(1);
    });

    price.addEventListener('click', () => {
        sortTable(2);
    });

    name.setAttribute('class', 'sort-by');
    category.setAttribute('class', 'sort-by');
    price.setAttribute('class', 'sort-by');

    tr.appendChild(name);
    tr.appendChild(category);
    tr.appendChild(price);
    table.appendChild(tr);
    if (filteredComponents.length < rowCount + 20) {
        rowCount = filteredComponents.length;
    } else {
        rowCount += 20;
        span.textContent = 'Show More ';
        btn.setAttribute('class', 'showMore');
        btn.appendChild(span);
        btn.addEventListener('click', () => {
            createTable(filteredComponents);
        });
        content.appendChild(btn);
    }
    // Now generate the Table 20 rows at a time
    for (i = 0; i < rowCount; i++) {
        tr = document.createElement('tr');
        name = document.createElement('td');
        category = document.createElement('td');
        price = document.createElement('td');
        computerComponents.forEach(computerComponent => {
            if (computerComponent.type == filteredComponents[i].category) {
                filteredComponents[i].category = computerComponent.name;
            }
        })
        name.textContent = filteredComponents[i].part_name;
        category.textContent = filteredComponents[i].category;
        if (filteredComponents[i].price !== 'N/A') {
            price.textContent = '$' + filteredComponents[i].price;
        } else {
            price.textContent = filteredComponents[i].price;
        }
        tr.appendChild(name);
        tr.appendChild(category);
        tr.appendChild(price);
        tr.addEventListener('click', (item) => {
            let itemName = item.target.parentNode.children[0].textContent;
            let itemIndex = filteredComponents.findIndex(component => {
                return component.part_name.toLowerCase() === itemName.toLowerCase();
            });
            if (itemIndex !== -1) {
                makeModal(itemName, filteredComponents[itemIndex]);
            }

        });
        table.appendChild(tr);
    }
    resultsMsg.textContent = `${filteredComponents.length} results found`;
    resultsMsg.setAttribute('id', 'resultsMsg');
    categoryTitle.appendChild(resultsMsg);
    content.style.display = "block";
    footer.style.display = 'block';
}

// Sorts the table when the user clicks a table header
function sortTable(n) {
    let table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0,
        xNum, yNum;
    table = document.getElementById('components');
    switching = true;
    dir = 'asc';
    while (switching) {
        switching = false;
        rows = table.getElementsByTagName('TR');
        for (i = 1; i < rows.length - 1; i++) {
            shouldSwitch = false;
            x = rows[i].getElementsByTagName('TD')[n];
            y = rows[i + 1].getElementsByTagName('TD')[n];
            if (dir === 'asc') {
                if (n !== 2) {
                    if (x.textContent.toLowerCase() > y.textContent.toLowerCase()) {
                        shouldSwitch = true;
                        break;
                    }
                } else {
                    xNum = Number(x.textContent.substr(1));
                    yNum = Number(y.textContent.substr(1));
                    if (isNaN(xNum))
                        xNum = 0;
                    if (isNaN(yNum))
                        yNum = 0;
                    if (xNum > yNum) {
                        shouldSwitch = true;
                        break;
                    }
                }
            } else if (dir === 'desc') {
                if (n !== 2) {
                    if (x.textContent.toLowerCase() < y.textContent.toLowerCase()) {
                        shouldSwitch = true;
                        break;
                    }
                } else {
                    xNum = Number(x.textContent.substr(1));
                    yNum = Number(y.textContent.substr(1));
                    if (isNaN(xNum))
                        xNum = 0;
                    if (isNaN(yNum))
                        yNum = 0;
                    if (xNum < yNum) {
                        shouldSwitch = true;
                        break;
                    }
                }
            }
        }
        if (shouldSwitch) {
            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            switching = true;
            switchcount++;
        } else {
            if (switchcount === 0 && dir === 'asc') {
                dir = 'desc';
                switching = true;
            }
        }
    }
}

// Gets the users favorites from the database
async function getFavorites() {
    let requestObj = { type: 'favorite' };
    let response = await Get("dbquery.php", `x=${JSON.stringify(requestObj)}`);
    favorites = JSON.parse(response);
}

// Checks if the user is currently logged in
async function checkLoggedIn() {
    let loginButton = document.querySelector('#user_account');
    let logoutButton = document.querySelector('#user_account_log_out');
    let check = await Get("loggedInCheck.php");
    if (check) {
        loginButton.style.display = "none";
        logoutButton.style.display = "block";
        return true;
    } else {
        loginButton.style.display = "block";
        logoutButton.style.display = "none";
        return false;
    }
}

// Event listener that is run after the page loads
window.addEventListener('load', async () => {
    // Get the data for each component
    computerComponents.forEach(component => {
        if (component.name !== 'All Items') {
            Get(component.url, "x=" + JSON.stringify({ type: component.type })).then(rawData => {
                component.data = JSON.parse(rawData);
            }).catch(console.error);
        }
    });
    checkLoggedIn()
    setCategoriesDropdown();
    setCategoryTitle();
    let check = await Get("loggedInCheck.php");
    if (check) {
        getFavorites();
    }
    createTable(getFilteredComponents(this.value, document.querySelector('input').value.toLowerCase()));
});

// Allows the user to click outside the various modals to close them
window.onclick = event => {
    if (event.target == modal) {
        modal.style.display = 'none';
    } else if (event.target == signInModal) {
        signInModal.style.display = 'none';
    } else if (event.target == signUpModal) {
        signUpModal.style.display = 'none';
    }
};

// Event Listeners to close the various modals
document.getElementsByClassName('close')[0].onclick = () => {
    modal.style.display = 'none';
};

document.getElementsByClassName('close')[1].onclick = () => {
    signInModal.style.display = 'none';
};

document.getElementsByClassName('close')[2].onclick = () => {
    signUpModal.style.display = 'none';
};

// Event listener for when the user changes the value in the category dropdown
document.querySelector('select').addEventListener('change', () => {
    rowCount = 0;
    document.getElementsByClassName('content')[0].setAttribute('id', 'animate');
    window.setTimeout(() => {
        document.querySelector('input').value = '';
        setCategoryTitle(this.value);
        document.getElementsByClassName('content')[0].setAttribute('id', 'animate-bottom');
        createTable(getFilteredComponents(document.querySelector('select').value, document.querySelector('input').value.toLowerCase()));
    }, 75);

});

// Event listener for when the user clicks the log in button
document.querySelector('#user_account').addEventListener('click', () => {
    signInModal.style.display = "block";
});

// Event listener for when the user clicks the log out button
document.querySelector('#user_account_log_out').addEventListener('click', async () => {
    let loader = document.getElementById('loader');
    let content = document.querySelector('.content');
    let footer = document.querySelector('footer');
    content.style.display = "none";
    footer.style.display = "none";
    loader.style.display = "block";
    await Get("logout.php");
    let check = await checkLoggedIn();
    if (!check) {
        favorites = [];
    }
    loader.style.display = "none";
    content.style.display = "block";
    footer.style.display = "block";
});

// Event listener for when the user wants to create an account
document.querySelector('#sign_up_button').addEventListener('click', () => {
    signInModal.style.display = "none";
    signUpModal.style.display = "block";
});

// Event listener for when the user clicks the log in button after inputing their log in information
document.querySelector('#log_in_button').addEventListener('click', async () => {
    let email = document.querySelector("#email_input");
    let password = document.querySelector("#password_input");
    let errorMessage = document.querySelector("#loginError");
    let loader = document.getElementById('loader');
    let content = document.querySelector('.content');
    let footer = document.querySelector('footer');

    if (email.value && password.value) {
        errorMessage.innerHTML = "";
        content.style.display = "none";
        footer.style.display = "none";
        loader.style.display = "block";
        signInModal.style.display = "none";
        let requestObj = { type: "login", email: email.value, password: password.value };
        let check = await Get("dbquery.php", `x=${JSON.stringify(requestObj)}`);
        if (check) {
            check = await checkLoggedIn();
            if (check) {
                email.value = "";
                password.value = "";
            }
            else {
                signInModal.style.display = "block";
                errorMessage.innerHTML = "Error Logging In. Please try again later...";
            }
        } else {
            signInModal.style.display = "block";
            errorMessage.innerHTML = "Invalid username or password";
        }
    }
    else {
        errorMessage.innerHTML = "Please Fill Out All Fields";
    }
    content.style.display = "block";
    footer.style.display = "block";
    loader.style.display = "none";
});

// Event listener for when the user clicks the sign up button
document.querySelector('#sign_up').addEventListener('click', async () => {
    let email = document.querySelector("#email_sign_up");
    let username = document.querySelector("#username_sign_up");
    let password = document.querySelector("#password_sign_up");
    let errorMessage = document.querySelector('#signupError');
    let loginButton = document.querySelector('#user_account');
    let logoutButton = document.querySelector('#user_account_log_out');
    let requestObj = { type: "user", email: email.value, username: username.value, password: password.value };
    if (email.value && username.value && password.value) {
        errorMessage.innerHTML = "";
        let result = await Get('dbinsert.php', `x=${JSON.stringify(requestObj)}`);
        email.value = "";
        username.value = "";
        password.value = "";
        signUpModal.style.display = "none";
        loginButton.style.display = "none";
        logoutButton.style.display = "block";
        logoutButton.addEventListener("click", () => {
            // Call logout function
        })
    } else {
        errorMessage.innerHTML = "Please Fill Out All Fields";
    }
});

// Event listener for when the user inputs text into the search bar
document.querySelector('input').addEventListener('keyup', () => {
    rowCount = 0;
    createTable(getFilteredComponents(document.querySelector('select').value, document.querySelector('input').value.toLowerCase()));
});

// Event listener for when the user is searching for components using the search bar and changes the category in the dropdown found in the navbar
document.querySelector('input').addEventListener('change', () => {
    rowCount = 0;
    createTable(getFilteredComponents(document.querySelector('select').value, document.querySelector('input').value.toLowerCase()));
});

// Event listener for when a user clicks the favorites tab in the nav bar
document.getElementById('favorites').addEventListener('click', async () => {
    let loader = document.getElementById('loader');
    let content = document.querySelector('.content');
    let footer = document.querySelector('footer');
    let check = await Get("loggedInCheck.php");
    if (check) {
        content.style.display = "none";
        footer.style.display = "none";
        loader.style.display = "block";
        await getFavorites();
        loader.style.display = "none";
        rowCount = 0;
        document.getElementById('categoryTitle').textContent = 'Favorites';
        document.getElementsByClassName('content')[0].setAttribute('id', 'animate');
        window.setTimeout(() => {
            document.getElementsByClassName('content')[0].setAttribute('id', 'animate-bottom');
            createTable(favorites);
            document.querySelector('footer').style.display = 'none';
        }, 75);
    } else {
        content.style.display = "block";
        footer.style.display = "block";
    }
});

// Event Listener for when a User adds/removes a favorite
document.getElementsByClassName('favorite')[0].addEventListener('click', async () => {
    let modalTable = document.getElementById('modal-table-body');
    let itemKeys = modalTable.getElementsByTagName('th');
    let itemValues = modalTable.getElementsByTagName('td');
    let favoriteStar = document.getElementsByClassName('favorite')[0];
    let favoriteObj = {};
    let check = await Get("loggedInCheck.php");
    if (check) {
        if (favorites === null) {
            favorites = [];
        }
        if (favoriteStar.getAttribute('data-star') === 'off') {
            // User wants to add a favorite
            for (let i = 0; i < itemKeys.length; i++) {
                if (itemKeys[i].textContent === 'price') {
                    favoriteObj[itemKeys[i].textContent] = itemValues[i].textContent.slice(1);

                } else {
                    favoriteObj[itemKeys[i].textContent] = itemValues[i].textContent;
                }
            }
            computerComponents.forEach(computerComponent => {
                if (computerComponent.name === favoriteObj.category) {
                    favoriteObj.category = computerComponent.type;
                }
            });
            // Hardcoded 1 for test user. Next week this will be dynamic
            let requestObj = { type: "favorite", part_id: favoriteObj.id, category: favoriteObj.category };
            favoriteStar.setAttribute('data-star', 'on');
            favoriteStar.innerHTML = '&#9733;';
            await Get("dbinsert.php", `x=${JSON.stringify(requestObj)}`);
        } else if (favoriteStar.getAttribute('data-star') === 'on') {
            // User wants to remove a favorite
            await getFavorites();
            let favorite_id = "";
            favorites.forEach(favorite => {
                if (favorite.part_name.toLowerCase() == document.getElementById('item-name').textContent.toLowerCase()) {
                    favorite_id = favorite.favorite_id;
                }
            });
            let requestObj = { type: "favorite", favorite_id };
            await Get('dbdelete.php', `x=${JSON.stringify(requestObj)}`)
            favoriteStar.setAttribute('data-star', 'off');
            favoriteStar.innerHTML = '&#9734;';
            await getFavorites();
        }
    }
});