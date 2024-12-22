// Modal Image Preview
function openModal(imageSrc, imageAlt) {
    const modal = document.getElementById('imageModal');
    const modalImg = document.getElementById('modalImage');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    modalImg.src = imageSrc;
    modalImg.alt = imageAlt;
}

function closeModal() {
    const modal = document.getElementById('imageModal');
    modal.classList.remove('flex');
    modal.classList.add('hidden');
}

// Weekly Statistics Chart
document.addEventListener('DOMContentLoaded', function () {
    if (document.querySelector("#weeklyChart")) {
        var options = {
            series: [{
                name: 'Jumlah Postingan',
                data: counts
            }],
            chart: {
                type: 'area',
                height: 250,
                toolbar: {
                    show: false
                },
                animations: {
                    enabled: true,
                    easing: 'easeinout',
                    speed: 800,
                    animateGradually: {
                        enabled: true,
                        delay: 150
                    },
                    dynamicAnimation: {
                        enabled: true,
                        speed: 350
                    }
                }
            },
            colors: ['#6366f1'],
            fill: {
                type: 'gradient',
                gradient: {
                    shadeIntensity: 1,
                    opacityFrom: 0.7,
                    opacityTo: 0.3
                }
            },
            stroke: {
                curve: 'smooth',
                width: 2
            },
            xaxis: {
                categories: dates,
                labels: {
                    style: {
                        colors: '#64748b'
                    }
                }
            },
            yaxis: {
                labels: {
                    style: {
                        colors: '#64748b'
                    }
                }
            },
            grid: {
                borderColor: '#f1f1f1',
                strokeDashArray: 4
            }
        };

        var chart = new ApexCharts(document.querySelector("#weeklyChart"), options);
        chart.render();
    }
});
