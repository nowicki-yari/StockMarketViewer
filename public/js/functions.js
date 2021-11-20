function div_exchange_click(exchange) {
    console.log(exchange);
    var url = 'api/exchanges/' + exchange.short_name + '/' + 'stocks'
    fetch(url)
        .then(response => {
            if (response.status === 500) {
                return response.json() // return the result of the inner promise, which is an error
                    .then((json) => {
                        const { message, stackTrace } = json;
                        throw new ServerException(message, stackTrace);
                    });
            } else {
                return response.json();
                //window.location.replace(url);
            }
        });
}

function filter_stocks() {
    var input, filter, ul, li, a, i, txtValue;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    ul = document.getElementById("stock_list");
    li = ul.getElementsByTagName("div");
    for (i = 0; i < li.length; i++) {
        a = li[i].getElementsByTagName("b")[0];
        txtValue = a.textContent || a.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
        } else {
            li[i].style.display = "none";
        }
    }
}

function to_home_page() {
    window.location.replace('/');
}
