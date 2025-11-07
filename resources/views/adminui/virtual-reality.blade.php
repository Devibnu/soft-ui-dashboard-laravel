@extends('adminui.layouts.auth')

@section('title', 'Virtual Reality - Admin UI')

@section('content')
<div class="border-radius-xl mt-3 mx-3 position-relative" style="background-image: url('{{ asset('assets/img/vr-bg.jpg') }}'); background-size: cover;">
    <span class="mask bg-gradient-dark opacity-4"></span>
    <div class="container border-radius-xl">
        <div class="row justify-space-between py-2">
            <div class="col-lg-4 me-auto">
                <p class="lead text-white opacity-8 mb-0 text-start">Virtual Reality</p>
                <h1 class="text-white mb-0">Feel the music</h1>
                <p class="lead text-white opacity-8 text-start">
                    Internet technology has opened up a realm of possibilities, including the ability to create entirely virtual spaces.
                </p>
                <button type="button" class="btn bg-gradient-primary btn-lg mt-4">
                    <i class="fas fa-play me-1"></i>
                    Feel it
                </button>
            </div>
            <div class="col-lg-6 ms-auto">
                <div class="position-relative">
                    <img class="max-width-50 w-25 position-relative z-index-2" src="{{ asset('assets/img/illustrations/boy.png') }}" alt="image">
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-3 col-md-6 mt-4 mb-4">
            <div class="card z-index-2">
                <div class="card-body p-3">
                    <div class="d-flex">
                        <div>
                            <p class="text-sm mb-0 text-capitalize font-weight-bold">Today's Money</p>
                            <h4 class="font-weight-bolder mb-0">
                                $53,000
                                <span class="text-success text-sm font-weight-bolder">+55%</span>
                            </h4>
                        </div>
                        <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl ms-auto">
                            <i class="fas fa-coins opacity-10" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mt-4 mb-4">
            <div class="card z-index-2">
                <div class="card-body p-3">
                    <div class="d-flex">
                        <div>
                            <p class="text-sm mb-0 text-capitalize font-weight-bold">Today's Users</p>
                            <h4 class="font-weight-bolder mb-0">
                                2,300
                                <span class="text-success text-sm font-weight-bolder">+3%</span>
                            </h4>
                        </div>
                        <div class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl ms-auto">
                            <i class="fas fa-globe-americas opacity-10" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mt-4 mb-4">
            <div class="card z-index-2">
                <div class="card-body p-3">
                    <div class="d-flex">
                        <div>
                            <p class="text-sm mb-0 text-capitalize font-weight-bold">New Clients</p>
                            <h4 class="font-weight-bolder mb-0">
                                +3,462
                                <span class="text-danger text-sm font-weight-bolder">-2%</span>
                            </h4>
                        </div>
                        <div class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl ms-auto">
                            <i class="fas fa-paper-plane opacity-10" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mt-4 mb-4">
            <div class="card z-index-2">
                <div class="card-body p-3">
                    <div class="d-flex">
                        <div>
                            <p class="text-sm mb-0 text-capitalize font-weight-bold">Sales</p>
                            <h4 class="font-weight-bolder mb-0">
                                $103,430
                                <span class="text-success text-sm font-weight-bolder">+5%</span>
                            </h4>
                        </div>
                        <div class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl ms-auto">
                            <i class="fas fa-chart-bar opacity-10" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-lg-7 mb-lg-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="d-flex flex-column h-100">
                                <p class="mb-1 pt-2 text-bold">Built by developers</p>
                                <h5 class="font-weight-bolder">Soft UI Dashboard</h5>
                                <p class="mb-5">From colors, cards, typography to complex elements, you will find the full documentation.</p>
                                <a class="text-body text-sm font-weight-bold mb-0 icon-move-right mt-auto" href="javascript:;">
                                    Read More
                                    <i class="fas fa-arrow-right text-sm ms-1" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-5 ms-auto text-center mt-5 mt-lg-0">
                            <div class="bg-gradient-primary border-radius-lg h-100">
                                <img src="{{ asset('assets/img/shapes/waves-white.svg') }}" class="position-absolute h-100 w-50 top-0 d-lg-block d-none" alt="waves">
                                <div class="position-relative d-flex align-items-center justify-content-center h-100">
                                    <img class="w-100 position-relative z-index-2 pt-4" src="{{ asset('assets/img/illustrations/rocket-white.png') }}" alt="rocket">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="card h-100 p-3">
                <div class="overflow-hidden position-relative border-radius-lg bg-cover h-100" style="background-image: url('{{ asset('assets/img/ivancik.jpg') }}');">
                    <span class="mask bg-gradient-dark"></span>
                    <div class="card-body position-relative z-index-1 d-flex flex-column h-100 p-3">
                        <h5 class="text-white font-weight-bolder mb-4 pt-2">Work with the rockets</h5>
                        <p class="text-white">Wealth creation is an evolutionarily recent positive-sum game. It is all about who take the opportunity first.</p>
                        <a class="text-white text-sm font-weight-bold mb-0 icon-move-right mt-auto" href="javascript:;">
                            Read More
                            <i class="fas fa-arrow-right text-sm ms-1" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-lg-12">
            <div class="card z-index-2">
                <div class="card-header pb-0">
                    <h6>VR Experience</h6>
                    <p class="text-sm">
                        <i class="fa fa-arrow-up text-success"></i>
                        <span class="font-weight-bold">4% more</span> in 2021
                    </p>
                </div>
                <div class="card-body p-3">
                    <div class="chart">
                        <canvas id="chart-line-vr" class="chart-canvas" height="300"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('js')
<script src="{{ asset('assets/js/plugins/chartjs.min.js') }}"></script>
<script>
    var ctx = document.getElementById("chart-line-vr").getContext("2d");

    var gradientStroke1 = ctx.createLinearGradient(0, 230, 0, 50);

    gradientStroke1.addColorStop(1, 'rgba(203,12,159,0.2)');
    gradientStroke1.addColorStop(0.2, 'rgba(72,72,176,0.0)');
    gradientStroke1.addColorStop(0, 'rgba(203,12,159,0)'); //purple colors

    new Chart(ctx, {
      type: "line",
      data: {
        labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        datasets: [{
            label: "VR Usage",
            tension: 0.4,
            borderWidth: 0,
            pointRadius: 0,
            borderColor: "#cb0c9f",
            borderWidth: 3,
            backgroundColor: gradientStroke1,
            fill: true,
            data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
            maxBarThickness: 6
        }],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: false,
          }
        },
        interaction: {
          intersect: false,
          mode: 'index',
        },
        scales: {
          y: {
            grid: {
              drawBorder: false,
              display: true,
              drawOnChartArea: true,
              drawTicks: false,
              borderDash: [5, 5]
            },
            ticks: {
              display: true,
              padding: 10,
              color: '#b2b9bf',
              font: {
                size: 11,
                family: "Open Sans",
                style: 'normal',
                lineHeight: 2
              },
            }
          },
          x: {
            grid: {
              drawBorder: false,
              display: false,
              drawOnChartArea: false,
              drawTicks: false,
              borderDash: [5, 5]
            },
            ticks: {
              display: true,
              color: '#b2b9bf',
              padding: 20,
              font: {
                size: 11,
                family: "Open Sans",
                style: 'normal',
                lineHeight: 2
              },
            }
          },
        },
      },
    });
</script>
@endpush
@endsection