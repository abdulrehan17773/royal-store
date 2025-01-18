document.addEventListener("DOMContentLoaded", function() {

    const elements = document.querySelectorAll("[page]");
    elements.forEach((element) => {
        element.addEventListener("click", function() {
            const page = element.getAttribute("page");
            window.open(page, "_self");
        });
    });
})


function initializeTouchSlider(containerId) {
    const profileContainer = document.getElementById(containerId);
    let touchStartX, scrollLeft, isDragging = false;

    // Touch events
    profileContainer.addEventListener('touchstart', (event) => {
        const touch = event.touches[0];
        touchStartX = touch.clientX;
        scrollLeft = profileContainer.scrollLeft;
        // event.preventDefault();
    });

    profileContainer.addEventListener('touchmove', (event) => {
        if (touchStartX === undefined) return;
        const touchCurrentX = event.touches[0].clientX;
        const touchDeltaX = touchCurrentX - touchStartX;
        profileContainer.scrollLeft = scrollLeft - touchDeltaX;
        event.preventDefault();
    });

    profileContainer.addEventListener('touchend', () => {
        touchStartX = undefined;
    });

    // Mouse events
    profileContainer.addEventListener('mousedown', (event) => {
        isDragging = true;
        touchStartX = event.clientX;
        scrollLeft = profileContainer.scrollLeft;
        event.preventDefault();
    });

    profileContainer.addEventListener('mousemove', (event) => {
        if (!isDragging) return;
        const mouseCurrentX = event.clientX;
        const mouseDeltaX = mouseCurrentX - touchStartX;
        profileContainer.scrollLeft = scrollLeft - mouseDeltaX;
        event.preventDefault();
    });

    profileContainer.addEventListener('mouseup', () => {
        isDragging = false;
        touchStartX = undefined;
    });

    profileContainer.addEventListener('mouseleave', () => {
        if (isDragging) {
            isDragging = false;
            touchStartX = undefined;
        }
    });
}



// cookies section 

// Function to add or update a cookie
function setCookie(name, value, daysToExpire) {
    var expires = "";
    if (daysToExpire) {
        var date = new Date();
        date.setTime(date.getTime() + (daysToExpire * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toUTCString();
    }
    var old_cookie = getCookie(name);
    if (old_cookie != null && old_cookie != 0) {
        document.cookie = name + "=" + value + "," + old_cookie + expires + "; path=/";
    } else {
        document.cookie = name + "=" + value + expires + "; path=/";
    }
}

// make new cookie without update
function setOpenCookie(name, value, daysToExpire) {
    var expires = "";
    if (daysToExpire) {
        var date = new Date();
        date.setTime(date.getTime() + (daysToExpire * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + value + expires + "; path=/";
}



// Function to get the value of a cookie by name
function getCookie(name) {
    var nameEQ = name + "=";
    var cookies = document.cookie.split(';');
    for (var i = 0; i < cookies.length; i++) {
        var cookie = cookies[i];
        while (cookie.charAt(0) === ' ') {
            cookie = cookie.substring(1, cookie.length);
        }
        if (cookie.indexOf(nameEQ) === 0) {
            return cookie.substring(nameEQ.length, cookie.length);
        }
    }
    return null;
}


// remove id from array
function removeId(id) {
    var productids = getCookie("cartProduct");
    var productarray = productids.split(",");

    // Filter out the matched element
    var newArray = productarray.filter(element => {
        var productarr = element.split("**");
        return productarr[0] != id;
    });

    updateCookie("cartProduct", newArray.join(","), 7);
    setCookie("alert_msg", "Item has been remove from cart!",1)

}


//  update quantity by id
function updateProductQuantity(id, quantity) {
    var productids = getCookie("cartProduct");
    var productarray = productids ? productids.split(",") : [];
    var productExists = false;

    // Update the quantity for the matched element or add a new product if not found
    var newArray = productarray.map(element => {
        var productarr = element.split("**");
        if (productarr[0] == id) {
            productExists = true;
            return id + "**" + quantity;
        }
        return element;
    });

    if (!productExists) {
        newArray.push(id + "**" + quantity);
    }

    updateCookie("cartProduct", newArray.join(","), 7);
}


// update cookies
function updateCookie(name, value, daysToExpire) {
    var expires = "";
    if (daysToExpire) {
        var date = new Date();
        date.setTime(date.getTime() + (daysToExpire * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + value + expires + "; path=/";
}



// Function to remove a cookie by name
function removeCookie(name) {
    document.cookie = name + "=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
}







function onContentLoad() {

    // quantity input add value
    function increment(e) {
        var elem = e.target.closest("[increment]");
        if (elem) {
            updateQuantity(1);
        }
    }

    // quantity input minus value
    function decrement(e) {
        var elem = e.target.closest("[decrement]");
        if (elem) {
            updateQuantity(-1);
        }
    }

    // update quantity input by buttons
    function updateQuantity(delta) {
        let value = parseInt(quantityInput.value) || 0;
        value += delta;
        value = Math.min(Math.max(value, 1), 50);
        quantityInput.value = value;
    }

    // check input null values
    function CheckNullValue(e) {
        var elem = e.target.closest("[not-null]");
        if (elem) {
            elem.value = elem.value.replace(/\D+/g, '');
            if (elem.value === '' || parseInt(elem.value) < 1) {
                elem.value = '1';
            } else if (parseInt(elem.value) > 50) {
                elem.value = '50';
            }
        }
    }


    function showImage(e) {
        var elem = e.target.closest("[showImage]");
        if (elem) {
            var mainImage = document.getElementById("mainImage");
            mainImage.src = elem.src;
        }
    }


    // accept cookies from user
    function acceptCookies(e) {
        var elem = e.target.closest("[cookiesAccept]");
        if (elem) {
            var maindiv = document.getElementById("accept-cookies");
            maindiv.style.display = "none";
        }
    }

    // open product page 
    function openProduct(e) {
        var elem = e.target.closest("[openProductCookie]");
        if (elem) {
            var productId = elem.id;
            setOpenCookie("openProductWithId", productId, 1)

        }
    }

    // open product in shop by category 
    function filterCategory(e) {
        var elem = e.target.closest("[openCategoryCookie]");
        if (elem) {
            var productId = elem.id;
            removeCookie("filterShop")
            removeCookie("searchProduct");
            setOpenCookie("openCategoryWithId", productId, 1)
        }
    }

    // order details on place order
    function orderDetails(e) {
        var elem = e.target.closest("[place-order-with-cookies]");
        if (elem) {
            var name = document.getElementById("cookie_name").value;
            var email = document.getElementById("cookie_email").value;
            var number = document.getElementById("cookie_number").value;
            var address = document.getElementById("cookie_address").value;
            var city = document.getElementById("cookie_city").value;
            var notes = document.getElementById("cookie_notes").value;
            var cookieDetails = name + "**" + email + "**" + number + "**" + address + "**" + city + "**" + notes;
            setOpenCookie("cookiesOrderDetails", cookieDetails, 1)
        }
    }

    // remove item from cart
    function removeItemFromCookie(e) {
        var elem = e.target.closest("[remove-cart-item-cookies]");
        if (elem) {
            var productId = elem.id;
            removeId(productId)
        }
    }

    // add to cart system
    function addToCart(e) {
        var elem = e.target.closest("[buy-product-button-with-cookies]");
        if (elem) {
            var quantity = document.getElementById("quantityInput").value;
            var proId = document.getElementById("product-id-for-cookies");
            if (quantity == "") {
                quantity = 1
            }
            var cart = proId.value + "**" + quantity;
            setCookie("cartProduct", cart, 7)
            proId.style.display = "none";
            elem.removeAttribute("buy-product-button-with-cookies");
            elem.classList.remove("addTo-card");
            elem.classList.add("inCart-btn");
            elem.setAttribute('page', 'cart.php');
            elem.innerHTML = "Product in cart";
            setCookie("alert_msg", "Item has been added to your cart!",1)
            window.location.reload();
        }
    }

    
    

    // cart product quantity and price calculations
    function cartCalculation(e) {
        var elem = e.target.closest("[cart-calculation-cookies]");
        if (elem) {
            var proid = elem.id;
            var priceElem = document.getElementById("pro-price-" + proid);
            var totalElem = document.getElementById("pro-total-" + proid);
            var totalPriceElems = document.querySelectorAll(".total-price-class");
            var totalPriceElem = document.getElementById("total-price");
            var grandPriceElem = document.getElementById("grand-price");

            var totalPrice = 0;

            totalElem.innerHTML = " " + (elem.value * parseFloat(priceElem.innerHTML));
            totalPriceElems.forEach(element => {
                totalPrice += parseFloat(element.innerHTML) || 0;
            });

            totalPriceElem.innerHTML = totalPrice;
            grandPriceElem.innerHTML = totalPriceElem.innerHTML;
            updateProductQuantity(proid, elem.value)
        }
    }

    // place order and show alert
    function orderPlace(e) {
        var elem = e.target.closest("[cart-order-place]");
        if (elem) {
            removeCookie("cartProduct");
            //   let data = `alert message`;
            //   setOpenCookie("alert-message", data, 1);
        }
    }



    // filter shop page
    function filterShop(e) {
        var elem = e.target.closest("[filter-shop-cookies]");
        if (elem) {
            removeCookie("openCategoryWithId");
            removeCookie("searchProduct");
            let id = elem.id;
            let category = document.getElementById(`${id}-category-value`).value;
            let minVal = document.getElementById(`${id}-min-value`).value;
            let maxVal = document.getElementById(`${id}-max-value`).value;
            let data = `${category},${minVal},${maxVal}`
            setOpenCookie("filterShop", data, 1)
        }
    }

    // remove shop page
    function removeFilterShop(e) {
        var elem = e.target.closest("[open-shop-remove-cook]");
        if (elem) {
            removeCookie("openCategoryWithId");
            removeCookie("filterShop");
            removeCookie("searchProduct");
        }
    }


    // search product by cookie
    function searchProduct(e) {
        var elem = e.target.closest("[search-product-with-cookie]");
        if (elem) {
            removeCookie("openCategoryWithId");
            removeCookie("filterShop");
            let data = document.getElementById("search-product").value;
            setOpenCookie("searchProduct", data, 1)
        }
    }

    function checkAlert() {

        if (getCookie("alert-message") != null) {
            let a = document.getElementById("order-alert");
            a.style.display = "block";
            let b = document.getElementById("alert-text");
            b.innerHTML = getCookie("alert-message");
        }
    }
    checkAlert();

    if (window.addEventListener) {
        document.addEventListener("click", decrement);
        document.addEventListener("click", increment);
        document.addEventListener("click", showImage);
        document.addEventListener("click", acceptCookies);
        document.addEventListener("click", openProduct);
        document.addEventListener("click", addToCart);
        document.addEventListener("click", removeItemFromCookie);
        document.addEventListener("click", filterCategory);
        document.addEventListener("click", orderDetails);
        document.addEventListener("click", orderPlace);
        document.addEventListener("click", filterShop);
        document.addEventListener("click", removeFilterShop);
        document.addEventListener("click", searchProduct);

        document.addEventListener("input", CheckNullValue);
        document.addEventListener("input", cartCalculation);


    }
}
window.addEventListener &&
    document.addEventListener("DOMContentLoaded", onContentLoad);






document.addEventListener('keydown', function(event) {
    if (event.key === 'Enter' && event.target.id === 'search-product') {
        event.preventDefault();
        document.getElementById('click-search-btn').click();
    }
});


function removeAlert(data) {
    removeCookie("alert_msg");
    data.parentNode.style.display = 'none';
}

    setTimeout(function() {
        removeCookie("alert_msg");
        removeCookie("searchOrder");
        removeCookie("searchProduct");
    }, 1000);

function searchOrder(e) {
    var elem = e.target.closest("[search-order-with-cookie]");
    if (elem) {
        let data = document.getElementById("order-id").value;
        console.log(data);

        setOpenCookie("searchOrder", data, 1)
    }
}

document.addEventListener("click", searchOrder);

function acceptCookie(data) {
    setCookie('cookie_status', 'cookie accepted', 30);
    data.parentNode.style.display = "none";
}

function updateCookiesFromURL() {
    var refferCookie = getCookieValue('reffer');
    var urlParams = new URLSearchParams(window.location.search);
    var cookies = getCookiesAsObject();

    if (refferCookie && urlParams.toString()) {
        urlParams.forEach((value, key) => {
            if (refferCookie !== value) {
                setCookieValue(key, value, 60);
            }
        });
    }else{
        urlParams.forEach((value, key) => {
                setCookieValue(key, value, 60);
        });
    }
    
}
updateCookiesFromURL();


function updateURLFromCookies() {
    var refferCookie = getCookieValue('reffer');
    var urlParams = new URLSearchParams(window.location.search);

    if (refferCookie && !urlParams.has('reffer')) {
        var newUrlParams = new URLSearchParams(window.location.search);
        newUrlParams.set('reffer', refferCookie); 
        var newUrl = window.location.protocol + "//" + window.location.host + window.location.pathname + "?" + newUrlParams.toString();
        window.history.replaceState({}, '', newUrl);
    }
}

// Execute the function
updateURLFromCookies();



function setCookieValue(name, value, days) {
    var expires = "";
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "") + expires + "; path=/";
}

function getCookieValue(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) === ' ') c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) === 0) return c.substring(nameEQ.length, c.length);
    }
    return null;
}

function getCookiesAsObject() {
    var cookies = {};
    document.cookie.split(';').forEach(function(cookie) {
        var parts = cookie.split('=');
        cookies[parts[0].trim()] = parts[1];
    });
    return cookies;
}

function getProductId() {
    // Example: Assume the product ID is stored in a data attribute on a container element
    return document.querySelector('.product-page-container').getAttribute('data-product-id');
}

// Check if we are on the product page and if the reffer cookie exists
if (window.location.pathname.includes('/product-page-path') && getCookie('reffer')) {
    
    // Get the product ID
    var productId = getProductId();
    
    // Create the WhatsApp share button
    var whatsappButton = document.createElement('a');
    whatsappButton.href = "https://api.whatsapp.com/send?text=Check%20out%20this%20product:%20" + encodeURIComponent(window.location.href + "?product_id=" + productId);
    whatsappButton.className = "whatsapp-share-btn"; // Add your class for styling
    whatsappButton.innerHTML = "Share on WhatsApp";
    
    // Append the button to a specific element on the product page
    document.querySelector('.product-page-container').appendChild(whatsappButton);

    // Optionally, you can set a cookie when the button is clicked
    whatsappButton.addEventListener('click', function() {
        setCookie('whatsapp_shared', 'true', 30); // Set cookie to remember the share
    });
}