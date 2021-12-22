<script>
    window.addEventListener("load", function () {
        fetch('http://127.0.0.1:5000/stock/{{$info[0]['symbol'] }}/dividends')
            .then(response => response.json())
            .then(data => {
                let dividends = JSON.parse(data);
                console.log(dividends);

                if (dividends['Dividends'][0]){
                    document.getElementById("dividends").innerText = "Last payed out dividends (" + dividends['Date'][0].replace("T00:00:00.000Z", "") + "): $" + dividends['Dividends'][0];
                } else {
                    document.getElementById("dividends").innerText = "No information available"
                }
            })
            .catch(console.error);
    });


</script>
<div id="dividends" style="margin: 15px; font-size: large;">
</div>

