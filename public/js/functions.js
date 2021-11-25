

function div_stock_click(stock, exchange) {
    var url = 'https://python-stock-api.herokuapp.com/stock/' + stock.symbol + '/info'
    fetch(url)
        .then(response => {
            if (response.status === 500) {
                return response.json() // return the result of the inner promise, which is an error
                    .then((json) => {
                        const { message, stackTrace } = json;
                        throw new ServerException(message, stackTrace);
                    });
            } else {
                location.href = '/exchanges/' + exchange + '/stocks/' + stock.symbol + '/info';
            }
        });
}

function history_graph() {

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
