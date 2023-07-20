function setGraph(occupied, unoccupied, callName) {
    var ctxD = document.getElementById(callName).getContext('2d');
    var myLineChart = new Chart(ctxD, {
        type: 'doughnut',
        data: {
            labels: ["Occupied", "Unoccupied"],
            datasets: [{
                data: [occupied, unoccupied],
                backgroundColor: ["#F7464A", "#46BFBD"],
                hoverBackgroundColor: ["#FF5A5E", "#5AD3D1"]
            }]
        },
        options: {
            responsive: true
        }
    })
};

function resizeGraphs() {
    var allCanvases = document.querySelectorAll('canvas');
    allCanvases.forEach(canvas => {
        canvas.style.width = '300px';
        canvas.style.height = '270px';
    })
};
