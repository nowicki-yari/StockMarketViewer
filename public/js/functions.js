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

function showInfo() {
    document.getElementById("sub_info").style.display = "block"
    document.getElementById("sub_dividends").style.display = "none"
    document.getElementById("sub_financials").style.display = "none"
    document.getElementById("sub_institutional_holders").style.display = "none"
    document.getElementById("sub_recommendations").style.display = "none"
}
function showDividends() {
    document.getElementById("sub_info").style.display = "none"
    document.getElementById("sub_dividends").style.display = "block"
    document.getElementById("sub_financials").style.display = "none"
    document.getElementById("sub_institutional_holders").style.display = "none"
    document.getElementById("sub_recommendations").style.display = "none"
}
function showFinancials() {
    document.getElementById("sub_info").style.display = "none"
    document.getElementById("sub_dividends").style.display = "none"
    document.getElementById("sub_financials").style.display = "block"
    document.getElementById("sub_institutional_holders").style.display = "none"
    document.getElementById("sub_recommendations").style.display = "none"
}
function showHolders() {
    document.getElementById("sub_info").style.display = "none"
    document.getElementById("sub_dividends").style.display = "none"
    document.getElementById("sub_financials").style.display = "none"
    document.getElementById("sub_institutional_holders").style.display = "block"
    document.getElementById("sub_recommendations").style.display = "none"
}
function showRecommendations() {
    document.getElementById("sub_info").style.display = "none"
    document.getElementById("sub_dividends").style.display = "none"
    document.getElementById("sub_financials").style.display = "none"
    document.getElementById("sub_institutional_holders").style.display = "none"
    document.getElementById("sub_recommendations").style.display = "block"
}

function loadTweets() {
    fetch('http://127.0.0.1:3000/')
        .then(response => response.json())
        .then(data => {
            let tweets = JSON.parse(JSON.stringify(data));
            console.log(tweets)
            let date = new Date();
            let id;
            for(var i = 0; i < tweets.length; i++) {
                id = "tweetp" + i;
                date = new Date(tweets[i].created_at)
                console.log(date)
                let text = tweets[i].text.replace(/(?:https?|ftp):\/\/[\n\S]+/g, '');
                document.getElementById(id).innerText = date.toLocaleTimeString("en-US") + "\n\n" + text;

            }
        })
        .catch(console.error);
}
