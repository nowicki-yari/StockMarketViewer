<script>
    window.addEventListener("load", function () {
        $.getJSON('http://127.0.0.1:5000/stock/{{$info[0]['symbol'] }}/recommendations/2020-01-01', function (data) {
            let recommendations = JSON.parse(data);
            document.getElementById("recommendations").innerText = "The latest recommendation is from " +
                recommendations['Firm'][0] + ": \n\n" +
                recommendations['To Grade'][0];
        });
    });
</script>
<div id="recommendations">
</div>
