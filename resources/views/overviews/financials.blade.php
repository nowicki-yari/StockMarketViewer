<script>
    window.addEventListener("load", function () {
        $.getJSON('http://127.0.0.1:5000/stock/{{$info[0]['symbol'] }}/financials', function (data) {
            let financials = JSON.parse(data);
            document.getElementById("financials").innerText = "" +
                "Cost of revenue: " + financials["Cost Of Revenue"] + "\n" +
                "Net Income: " + financials["Net Income"];
        });
    });
</script>
<div id="financials">
</div>
