<script>
    window.addEventListener("load", function () {
        fetch('http://127.0.0.1:5000/stock/{{$info[0]['symbol'] }}/dividends')
            .then(response => response.json())
            .then(data => {
                let dividends = JSON.parse(data);
                document.getElementById("dividends").innerText = "Dividends from the last year: $" + dividends['Dividends'][0];
            })
            .catch(console.error);
    });
</script>
<div id="dividends">
</div>

