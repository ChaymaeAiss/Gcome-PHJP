<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="includes/style.css">
    <title>GrocerEase-Dashboard</title>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <style>
        .highcharts-figure,
.highcharts-data-table table {
    min-width: 320px;
    max-width: 800px;
    margin: 1em auto;
}

.highcharts-data-table table {
    font-family: Verdana, sans-serif;
    border-collapse: collapse;
    border: 1px solid #ebebeb;
    margin: 10px auto;
    text-align: center;
    width: 100%;
    max-width: 500px;
}

.highcharts-data-table caption {
    padding: 1em 0;
    font-size: 1.2em;
    color: #555;
}

.highcharts-data-table th {
    font-weight: 600;
    padding: 0.5em;
}

.highcharts-data-table td,
.highcharts-data-table th,
.highcharts-data-table caption {
    padding: 0.5em;
}

.highcharts-data-table thead tr,
.highcharts-data-table tr:nth-child(even) {
    background: #f8f8f8;
}

.highcharts-data-table tr:hover {
    background: #f1f7ff;
}

    </style>
</head>

<body>
    <!-- Sidebar -->
    <?php
        require_once 'includes/db.php';
        include_once 'includes/nav.php';
    ?>
    <!-- End of Sidebar -->
    <!-- Main Content -->
    <div class="content">
        <main>
            <div class="header">
                <div class="left">
                    <h1>Dashboard</h1>
                    <ul class="breadcrumb">
                        <li><a href="#">
                                View
                            </a></li>
                        /
                        <li><a href="#" class="active">Analyses</a></li>
                    </ul>
                </div>
            </div>

            <!-- Insights -->
            <ul class="insights">
                <li>
                    <i class='bx bx-calendar-check'></i>
                    <span class="info">
                        <?php 
                            $sql = "SELECT COUNT(id) AS article_count FROM articles";
                            $stmt = $pdo->query($sql);
                            $result = $stmt->fetch(PDO::FETCH_ASSOC);
                            $articleCount = $result['article_count'];
                        ?>
                        <h3><?php echo $articleCount; ?></h3>
                        <p>Articles trouvés</p>
                    </span>
                </li>
                <li><i class='bx bx-note'></i>
                    <span class="info">
                    <?php 
                            $sql = "SELECT COUNT(id) AS famille_count FROM famille";
                            $stmt = $pdo->query($sql);
                            $result = $stmt->fetch(PDO::FETCH_ASSOC);
                            $familleCount = $result['famille_count'];
                    ?>
                        <h3><?php echo $familleCount; ?></h3>
                        <p>Familles trouvées</p>
                    </span>
                </li>
                <li><i class='bx bx-receipt'></i>
                    <span class="info">
                    <?php 
                        $sql = "SELECT COUNT(id) AS bl_count FROM bonlivraison";
                        $stmt = $pdo->query($sql);
                        $result = $stmt->fetch(PDO::FETCH_ASSOC);
                        $blCount = $result['bl_count'];
                    ?>
                        <h3><?php echo $blCount; ?></h3>
                        <p>Bons de livraison trouvés</p>
                    </span>
                </li>
                <li><i class='bx bx-dollar-circle'></i>
                    <span class="info">
                    <?php 
                            $sql = "SELECT COUNT(id) AS client_count FROM clients";
                            $stmt = $pdo->query($sql);
                            $result = $stmt->fetch(PDO::FETCH_ASSOC);
                            $clientCount = $result['client_count'];
                    ?>
                        <h3><?php echo $clientCount; ?></h3>
                        <p>Clients achètent chez nous !</p>
                    </span>
                </li>
            </ul>
            <!-- End of Insights -->

            <div class="bottom-data">
                <div class="orders ">
                    <figure class="highcharts-figure">
                    <div id="container"></div>
                    </figure>
                </div>
                <div class="reminders">
                <div class="header">
                    <i class='bx bx-note'></i>
                    <h3>Reminders</h3>
                    <i class='bx bx-plus' id="addReminderBtn"></i>
                </div>
                <ul class="task-list" id="taskList">
                    
                </ul>
                </div>

                <!-- End of Reminders-->

            </div>

        </main>

    </div>
    <script>
   (function (H) {
    H.seriesTypes.pie.prototype.animate = function (init) {
        const series = this,
            chart = series.chart,
            points = series.points,
            {
                animation
            } = series.options,
            {
                startAngleRad
            } = series;

        function fanAnimate(point, startAngleRad) {
            const graphic = point.graphic,
                args = point.shapeArgs;

            if (graphic && args) {

                graphic
                    // Set inital animation values
                    .attr({
                        start: startAngleRad,
                        end: startAngleRad,
                        opacity: 1
                    })
                    // Animate to the final position
                    .animate({
                        start: args.start,
                        end: args.end
                    }, {
                        duration: animation.duration / points.length
                    }, function () {
                        // On complete, start animating the next point
                        if (points[point.index + 1]) {
                            fanAnimate(points[point.index + 1], args.end);
                        }
                        // On the last point, fade in the data labels, then
                        // apply the inner size
                        if (point.index === series.points.length - 1) {
                            series.dataLabelsGroup.animate({
                                opacity: 1
                            },
                            void 0,
                            function () {
                                points.forEach(point => {
                                    point.opacity = 1;
                                });
                                series.update({
                                    enableMouseTracking: true
                                }, false);
                                chart.update({
                                    plotOptions: {
                                        pie: {
                                            innerSize: '40%',
                                            borderRadius: 8
                                        }
                                    }
                                });
                            });
                        }
                    });
            }
        }

        if (init) {
            // Hide points on init
            points.forEach(point => {
                point.opacity = 0;
            });
        } else {
            fanAnimate(points[0], startAngleRad);
        }
    };
}(Highcharts));

Highcharts.chart('container', {
    chart: {
        type: 'pie'
    },
    title: {
        text: 'Section distribution',
        align: 'left'
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    accessibility: {
        point: {
            valueSuffix: '%'
        }
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            borderWidth: 2,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                distance: 20
            }
        }
    },
    series: [{
        // Disable mouse tracking on load, enable after custom animation
        enableMouseTracking: false,
        animation: {
            duration: 2000
        },
        colorByPoint: true,
        data: [{
            name: 'Clients',
            y: <?php
                $sqlState = $pdo->query('SELECT COUNT(id) as county FROM clients');
                $data = $sqlState->fetchAll(PDO::FETCH_OBJ);
                foreach($data as $value){
                    echo $value->county;
                }
            ?>
        }, {
            name: 'Cassiers',
            y: <?php
                $sqlState = $pdo->query('SELECT COUNT(id) as county FROM caissier');
                $data = $sqlState->fetchAll(PDO::FETCH_OBJ);
                foreach($data as $value){
                    echo $value->county;
                }
            ?>
        }, {
            name: 'Articles',
            y: <?php
                $sqlState = $pdo->query('SELECT COUNT(id) as countyy FROM articles');
                $data = $sqlState->fetchAll(PDO::FETCH_OBJ);
                foreach($data as $value){
                    echo $value->countyy;
                }
            ?>
        }, {
            name: 'Famille',
            y: <?php
                $sqlState = $pdo->query('SELECT COUNT(id) as countyz FROM famille');
                $data = $sqlState->fetchAll(PDO::FETCH_OBJ);
                foreach($data as $value){
                    echo $value->countyz;
                }
            ?>
        }, {
            name: 'Bons',
            y: <?php
                $sqlState = $pdo->query('SELECT COUNT(id) as countyi FROM bonlivraison');
                $data = $sqlState->fetchAll(PDO::FETCH_OBJ);
                foreach($data as $value){
                    echo $value->countyi;
                }
            ?>
        }]
    }]
});

</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const addReminderBtn = document.getElementById('addReminderBtn');
        const taskList = document.getElementById('taskList');

        addReminderBtn.addEventListener('click', function () {
            const newReminder = prompt('Enter your new reminder:');
            if (newReminder !== null && newReminder.trim() !== '') {
                // Create a new list item
                const li = document.createElement('li');
                li.innerHTML = `
                    <div class="task-title">
                        <i class='bx bx-dots-circle'></i>
                        <p>${newReminder}</p>
                    </div>
                `;

                // Append the new list item to the task list
                taskList.appendChild(li);
            }
        });
    });
</script>
    <script src="includes/index.js"></script>
</body>

</html>