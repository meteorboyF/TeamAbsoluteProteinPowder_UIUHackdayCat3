<div>
    <h3 class="text-lg font-bold text-secondary-900 mb-4">Mood Timeline (Last 30 Days)</h3>

    <div class="bg-white p-6 rounded-lg border border-secondary-200">
        <canvas id="moodChart" height="100"></canvas>
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            // Ensure Chart.js is loaded
            document.addEventListener('livewire:navigated', () => {
                initChart();
            });

            // For initial load
            document.addEventListener('DOMContentLoaded', () => {
                initChart();
            });

            function initChart() {
                const ctx = document.getElementById('moodChart');
                if (!ctx) return;

                // Destroy existing chart if it exists to prevent overlap
                if (window.myMoodChart) {
                    window.myMoodChart.destroy();
                }

                const timeline = @json($timeline);

                window.myMoodChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: timeline.map(t => t.date),
                        datasets: [{
                            label: 'Mood',
                            data: timeline.map(t => t.value),
                            borderColor: '#9333ea',
                            backgroundColor: 'rgba(147, 51, 234, 0.1)',
                            tension: 0.4,
                            fill: true
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false
                            }
                        },
                        scales: {
                            y: {
                                min: 0,
                                max: 4,
                                ticks: {
                                    stepSize: 1,
                                    callback: function (value) {
                                        return ['', 'Sad', 'Neutral', 'Happy'][value] || '';
                                    }
                                }
                            }
                        }
                    }
                });
            }
        </script>
    @endpush
</div>