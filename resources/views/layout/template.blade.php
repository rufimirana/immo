<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="">
  <!--<![endif]-->
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>@yield('title')</title>
    <meta name="description" content="ZaraoProject" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@500&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">

    <link rel="apple-touch-icon" type="image/png" href="images/favicon.png" />
    <link rel="shortcut icon" type="image/png" href="images/favicon.png" />

    <link
      rel="stylesheet"
      href="{{ asset('css/normalize.min.css') }}"
    />
    <link
      rel="stylesheet"
      href="{{ asset('css/bootstrap.min.css') }}"
    />
    <link
      rel="stylesheet"
      href="{{ asset('css/font-awesome.min.css') }}"
    />
    <link
      rel="stylesheet"
      href="{{ asset('css/themify-icons.css') }}"
    />
    <link
      rel="stylesheet"
      href="{{ asset('css/pe-icon-7-stroke.min.css') }}"
    />
    <link
      rel="stylesheet"
      href="{{ asset('css/flag-icon.min.css') }}"
    />
    <link rel="stylesheet" href="{{ asset('css/cs-skin-elastic.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->
    <link
      href="{{ asset('css/chartist.min.css') }}"
      rel="stylesheet"
    />
    <link
      href="{{ asset('css/jqvmap.min.css') }}"
      rel="stylesheet"
    />

    <link
      href="{{ asset('css/weather-icons.css') }}"
      rel="stylesheet"
    />
    <link
      href="{{ asset('css/fullcalendar.min.css') }}"
      rel="stylesheet"
    />

    <style>
        .menu-title{
            font-family: 'Kanit', sans-serif;
        }
        .left-panel{
            font-family: 'Roboto Slab', serif;
        }
        .content{
            background-color: #ffffff;
        }
      #weatherWidget .currentDesc {
        color: #ffffff !important;
      }
      .traffic-chart {
        min-height: 335px;
      }
      #flotPie1 {
        height: 150px;
      }
      #flotPie1 td {
        padding: 3px;
      }
      #flotPie1 table {
        top: 20px !important;
        right: -10px !important;
      }
      .chart-container {
        display: table;
        min-width: 270px;
        text-align: left;
        padding-top: 10px;
        padding-bottom: 10px;
      }
      #flotLine5 {
        height: 105px;
      }

      #flotBarChart {
        height: 150px;
      }
      #cellPaiChart {
        height: 160px;
      }
    </style>
  </head>

  <body>
    <!-- Left Panel -->
    <aside id="left-panel" class="left-panel">
      <nav class="navbar navbar-expand-sm navbar-default">
        <div id="main-menu" class="main-menu collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active">
              <a href="index.html">
              </a>
            </li>
              <li class="menu-title">Dashboard</li>
            <!-- /.menu-title -->
            <li class="menu-item-has-children dropdown">
              <a
                href="#"
                class="dropdown-toggle"
                data-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false"
              >
                <i></i>Dashboard</a
              >
              <ul class="sub-menu children dropdown-menu">
                <li>
                  <i></i
                  ><a href="{{ route('dashboard') }}">Dashboard </a>
                </li>

              </ul>
            </li>

            <li class="menu-title">Article</li>
            <!-- /.menu-title -->
            <li class="menu-item-has-children dropdown">
              <a
                href="#"
                class="dropdown-toggle"
                data-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false"
              >
                <i></i>Gestion des articles</a
              >
              <ul class="sub-menu children dropdown-menu">
                <li>
                  <i></i
                  ><a href="{{ route('create') }}">Création article </a>
                </li>

                <li>
                  <i></i 32
                  ><a href="{{ route('liste') }}">Liste article</a>
                </li>
              </ul>
            </li>
            <li class="menu-item-has-children dropdown">
              <a
                href=""
                class="dropdown-toggle"
                data-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false"
              >
                <i></i>Gestion des factures</a
              >
              <ul class="sub-menu children dropdown-menu">
                <li>
                  <i></i
                  ><a href="{{ route('create_facture') }}">Saisie facture</a>
                </li>
                <li>
                  <i></i
                  ><a href="{{ route('liste_facture') }}">Liste des factures</a>
                </li>
              </ul>
            </li>

               <li class="menu-title">Immobilisation</li>
            <!-- /.menu-title -->
            <li class="menu-item-has-children dropdown">
              <a
                href="#"
                class="dropdown-toggle"
                data-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false"
              >
                <i></i>Gestion des immobilisations</a
              >
              <ul class="sub-menu children dropdown-menu">
                <li>
                  <i></i
                  ><a href="{{ route('liste_reception') }}">Liste des articles reçues</a>
                </li>
 <li>
                  <i></i
                  ><a href="{{route('liste_immo')}}">Liste immo</a>
                </li>
                <li>
                  <i></i
                  ><a href="{{route('liste_transfert_immo')}}">Liste de transfert immo</a>
                </li>

                 <li>
                  <i></i
                  ><a href="{{route('liste_stock_all')}}">Stock immo</a>
                </li>
                 <li>
                  <i></i><a href="{{route('all_emplacement')}}">Emplacement immo</a>
                </li>
              </ul>
            </li>
            <li class="menu-item-has-children dropdown">
              <a
                href="#"
                class="dropdown-toggle"
                data-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false"
              >
                <i></i>Taux d'amortissement</a
              >
              <ul class="sub-menu children dropdown-menu">
                <li>
                  <i></i
                  ><a href="{{route('taux_categorie')}}">Taux d'amortissement par catégorie</a>
                </li>
                <li>
                  <i></i
                  ><a href="{{route('immo_amortie')}}">Immobilisations amorties</a>
                </li>
              </ul>
            </li>
                        <li class="menu-item-has-children dropdown">
              <a
                href="#"
                class="dropdown-toggle"
                data-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false"
              >
             <i></i>Inventaire</a
              >
              <ul class="sub-menu children dropdown-menu">
                <li>
                  <i></i
                  ><a href="{{route('formulaire_inventaire')}}">Etablissement inventaire</a>
                </li>
                <li>
                  <i></i
                  ><a href="{{route('liste_des_inventaires')}}">Liste des inventaires</a>
                </li>
                <li>
                  <i></i
                  ><a href="{{route('liste_des_immos_disparues')}}">Liste des immos disparues/perdues</a>
                </li>
              </ul>
            </li>
                        <li class="menu-item-has-children dropdown">
              <a
                href="#"
                class="dropdown-toggle"
                data-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false"
              >
             <i></i>Cession des immobilisations</a
              >
              <ul class="sub-menu children dropdown-menu ">
                <li>
                  <i></i
                  ><a href="{{route('liste_immos_vendues')}}">Immobilisations vendues</a>
                </li>
              </ul>
            </li>
              <li class="menu-title">Utilisateur</li>
            <!-- /.menu-title -->
            <li class="menu-item-has-children dropdown">
              <a
                href="#"
                class="dropdown-toggle"
                data-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false"
              >
                <i></i>Gestion utilisateur</a
              >
              <ul class="sub-menu children dropdown-menu">
                <li>
                  <i></i
                  ><a href="{{route('register-user')}}">Ajout d'un utilisateur </a>
                </li>
                <li>
                  <i></i
                  ><a href="#">Modifier profil </a>
                </li>
                <li>
                  <i></i
                  ><a href="{{route('logout')}}">Déconnexion</a>
                </li>
              </ul>
            </li>
        </div>
        <!-- /.navbar-collapse -->
      </nav>
    </aside>
    <!-- /#left-panel -->
    <!-- Right Panel -->
    <div id="right-panel" class="right-panel">
      <!-- Header-->
       <header id="header" class="header">
            <div class="top-left">
                <div>
                    <p class="navbar-brand" href="./"><img src="{{asset('/images/logo.png')}}" alt="Logo"></p>
                </div>
            </div>
      </header>
      <!-- /#header -->
      <!-- Content -->
 @yield('content')
      <!-- /.content -->

    <!-- /#right-panel -->

    <!-- Scripts -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/jquery.matchHeight.min.js') }}"></script>
    <script src="assets/js/main.js"></script>

    <!--  Chart js -->
    <script src="{{ asset('js/Chart.bundle.min.js') }}"></script>

    <!--Chartist Chart-->
    <script src="{{ asset('js/chartist.min.js') }}"></script>
    <script src="{{ asset('js/chartist-plugin-legend.min.js')}}"></script>

    <script src="{{ asset('js/jquery.flot.min.js')}}"></script>
    <script src="{{ asset('js/jquery.flot.pie.min.js')}}"></script>
    <script src="{{ asset('js/jquery.flot.spline.min.js')}}"></script>

    <script src="{{ asset('js/jquery.simpleWeather.min.js')}}"></script>
    <script src="{{ asset('js/weather-init.js')}}"></script>

    <script src="{{ asset('js/moment.min.js')}}"></script>
    <script src="{{ asset('js/fullcalendar.min.js')}}"></script>
    <script src="{{ asset('js/fullcalendar-init.js')}}"></script>

    <!--Local Stuff-->
    <script>
      jQuery(document).ready(function ($) {
        "use strict";

        // Pie chart flotPie1
        var piedata = [
          { label: "Desktop visits", data: [[1, 32]], color: "#5c6bc0" },
          { label: "Tab visits", data: [[1, 33]], color: "#ef5350" },
          { label: "Mobile visits", data: [[1, 35]], color: "#66bb6a" },
        ];

        $.plot("#flotPie1", piedata, {
          series: {
            pie: {
              show: true,
              radius: 1,
              innerRadius: 0.65,
              label: {
                show: true,
                radius: 2 / 3,
                threshold: 1,
              },
              stroke: {
                width: 0,
              },
            },
          },
          grid: {
            hoverable: true,
            clickable: true,
          },
        });
        // Pie chart flotPie1  End
        // cellPaiChart
        var cellPaiChart = [
          { label: "Direct Sell", data: [[1, 65]], color: "#5b83de" },
          { label: "Channel Sell", data: [[1, 35]], color: "#00bfa5" },
        ];
        $.plot("#cellPaiChart", cellPaiChart, {
          series: {
            pie: {
              show: true,
              stroke: {
                width: 0,
              },
            },
          },
          legend: {
            show: false,
          },
          grid: {
            hoverable: true,
            clickable: true,
          },
        });
        // cellPaiChart End
        // Line Chart  #flotLine5
        var newCust = [
          [0, 3],
          [1, 5],
          [2, 4],
          [3, 7],
          [4, 9],
          [5, 3],
          [6, 6],
          [7, 4],
          [8, 10],
        ];

        var plot = $.plot(
          $("#flotLine5"),
          [
            {
              data: newCust,
              label: "New Data Flow",
              color: "#fff",
            },
          ],
          {
            series: {
              lines: {
                show: true,
                lineColor: "#fff",
                lineWidth: 2,
              },
              points: {
                show: true,
                fill: true,
                fillColor: "#ffffff",
                symbol: "circle",
                radius: 3,
              },
              shadowSize: 0,
            },
            points: {
              show: true,
            },
            legend: {
              show: false,
            },
            grid: {
              show: false,
            },
          }
        );
        // Line Chart  #flotLine5 End
        // Traffic Chart using chartist
        if ($("#traffic-chart").length) {
          var chart = new Chartist.Line(
            "#traffic-chart",
            {
              labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun"],
              series: [
                [0, 18000, 35000, 25000, 22000, 0],
                [0, 33000, 15000, 20000, 15000, 300],
                [0, 15000, 28000, 15000, 30000, 5000],
              ],
            },
            {
              low: 0,
              showArea: true,
              showLine: false,
              showPoint: false,
              fullWidth: true,
              axisX: {
                showGrid: true,
              },
            }
          );

          chart.on("draw", function (data) {
            if (data.type === "line" || data.type === "area") {
              data.element.animate({
                d: {
                  begin: 2000 * data.index,
                  dur: 2000,
                  from: data.path
                    .clone()
                    .scale(1, 0)
                    .translate(0, data.chartRect.height())
                    .stringify(),
                  to: data.path.clone().stringify(),
                  easing: Chartist.Svg.Easing.easeOutQuint,
                },
              });
            }
          });
        }
        // Traffic Chart using chartist End
        //Traffic chart chart-js
        if ($("#TrafficChart").length) {
          var ctx = document.getElementById("TrafficChart");
          ctx.height = 150;
          var myChart = new Chart(ctx, {
            type: "line",
            data: {
              labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul"],
              datasets: [
                {
                  label: "Visit",
                  borderColor: "rgba(4, 73, 203,.09)",
                  borderWidth: "1",
                  backgroundColor: "rgba(4, 73, 203,.5)",
                  data: [0, 2900, 5000, 3300, 6000, 3250, 0],
                },
                {
                  label: "Bounce",
                  borderColor: "rgba(245, 23, 66, 0.9)",
                  borderWidth: "1",
                  backgroundColor: "rgba(245, 23, 66,.5)",
                  pointHighlightStroke: "rgba(245, 23, 66,.5)",
                  data: [0, 4200, 4500, 1600, 4200, 1500, 4000],
                },
                {
                  label: "Targeted",
                  borderColor: "rgba(40, 169, 46, 0.9)",
                  borderWidth: "1",
                  backgroundColor: "rgba(40, 169, 46, .5)",
                  pointHighlightStroke: "rgba(40, 169, 46,.5)",
                  data: [1000, 5200, 3600, 2600, 4200, 5300, 0],
                },
              ],
            },
            options: {
              responsive: true,
              tooltips: {
                mode: "index",
                intersect: false,
              },
              hover: {
                mode: "nearest",
                intersect: true,
              },
            },
          });
        }
        //Traffic chart chart-js  End
        // Bar Chart #flotBarChart
        $.plot(
          "#flotBarChart",
          [
            {
              data: [
                [0, 18],
                [2, 8],
                [4, 5],
                [6, 13],
                [8, 5],
                [10, 7],
                [12, 4],
                [14, 6],
                [16, 15],
                [18, 9],
                [20, 17],
                [22, 7],
                [24, 4],
                [26, 9],
                [28, 11],
              ],
              bars: {
                show: true,
                lineWidth: 0,
                fillColor: "#ffffff8a",
              },
            },
          ],
          {
            grid: {
              show: false,
            },
          }
        );
        // Bar Chart #flotBarChart End
      });
    </script>
  </body>
</html>
