<div class="card ">
    <div class="card-body p-3">
        <canvas id="borrowingChart"></canvas>

    </div>

      <script>
            document.addEventListener("DOMContentLoaded", function() {
                var ctx = document.getElementById("borrowingChart").getContext("2d");

                var borrowingChart = new Chart(ctx, {
                    type: "bar",
                    data: {
                        labels: @json($months),
                        datasets: [{
                                label: "Completed Borrowings",
                                backgroundColor: "rgba(75, 192, 192, 0.6)",
                                borderColor: "rgba(75, 192, 192, 1)",
                                borderWidth: 1,
                                data: @json($completed),
                            },
                            {
                                label: "Cancelled Borrowings",
                                backgroundColor: "rgba(255, 99, 132, 0.6)",
                                borderColor: "rgba(255, 99, 132, 1)",
                                borderWidth: 1,
                                data: @json($cancelled),
                            },
                            
                        ],
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true,
                            },
                        },
                    },
                });
            });
        </script>
</div>