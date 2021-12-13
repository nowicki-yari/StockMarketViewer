<script>
    window.addEventListener("load", function () {
        fetch('http://127.0.0.1:5000/stock/{{$info[0]['symbol'] }}/financials')
        .then(response => response.json())
        .then(data => {
            let financials = JSON.parse(data);
            console.log(financials);
            document.getElementById("financials").innerText = "" +
                "Cost of revenue: " + financials["Cost Of Revenue"] + "\n" +
                "Net Income: " + financials["Net Income"];
        })
        .catch(console.error);
    });
</script>
<div id="financials">
</div>
