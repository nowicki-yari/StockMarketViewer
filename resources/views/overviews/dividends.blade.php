<script>
    window.addEventListener("load", function () {
        $.getJSON('http://127.0.0.1:5000/stock/{{$info[0]['symbol'] }}/dividends', function (data) {
            let dividends = JSON.parse(data);
            document.getElementById("dividends").innerText = "Dividends from the last year: $" + dividends['Dividends'][0];
        });;
    });
</script>
<div id="dividends">
</div>

