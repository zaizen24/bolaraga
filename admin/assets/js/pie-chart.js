
if ($('#seolinechart8').length) {
    var ctx = document.getElementById("seolinechart8").getContext('2d');
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'doughnut',
        // The data for our dataset
        data: {
            labels: ["Desain Logo", "Desain Website", "Desain Kemasan"],
            datasets: [{
                backgroundColor: [
                    "#8919FE",
                    "#12C498",
                    "#F8CB3F",
                ],
                borderColor: '#fff',
                data: [810, 410, 260],
            }]
        },
        // Configuration options go here
        options: {
            legend: {
                display: true
            },
            animation: {
                easing: "easeInOutBack"
            }
        }
    });
}