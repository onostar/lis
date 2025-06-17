<?php
    include "../classes/dbh.php";
    include "../classes/select.php";
    if(isset($_GET['patient'])){
        $patient = $_GET['patient'];
        //get patient name
        $get_name = new selects();
        $rows = $get_name->fetch_details_cond('patients', 'patient_id', $patient);
        foreach($rows as $row){
            $name = $row->last_name." ".$row->other_names;
        }
        //get all values
        $get_data = new selects();
        $datas = $get_data->fetch_details_cond('vital_signs', 'patient', $patient);
        if(gettype($datas) == "array"){
            foreach($datas as $data){
                $temperature[] = $data->temperature;
                $pulse[] = $data->pulse;
                $respiration[] = $data->respiration;
                $bmi[] = $data->bmi;
                $systolic[] = $data->systolic;
                $diastolic[] = $data->diastolic;
                $dates[] = $data->post_date;
            }
        }
?>
<div class="vital_trends_data">
    <div class="vital_trends">
        <!-- chart for temperature group -->
        <h3>Temperature Chart for <?php echo $name?></h3>
        <canvas id="temp"></canvas>
    </div>
    <div class="vital_trends">
        <!-- chart for temperature group -->
        <h3>Blood Pressure Chart for <?php echo $name?></h3>
        <canvas id="blood_pressure"></canvas>
    </div>
    <div class="vital_trends">
        <!-- chart for temperature group -->
        <h3>Pulse Chart for <?php echo $name?></h3>
        <canvas id="pulse"></canvas>
    </div>
    <div class="vital_trends">
        <!-- chart for temperature group -->
        <h3>BMI Chart for <?php echo $name?></h3>
        <canvas id="bmi"></canvas>
    </div>
</div>
<?php
    }
?>
<script src="../Chart.min.js"></script>
<script>
   /* temperature */
   var ctx2 = document.getElementById("temp").getContext('2d');
var myChart = new Chart(ctx2, {
    type: 'line',
    data: {
        labels: <?php echo json_encode($dates); ?>,
        datasets: [{
            label: 'Temperature',
            backgroundColor: "rgba(15, 140, 161, 0.2)", // Transparent fill under line
            borderColor: "#0f8ca1", // Line color
            data: <?php echo json_encode($temperature); ?>,
            fill: true, // Fill under the line
        }]
    },
    options: {
        plugins: {
            legend: {
                display: true,
                position: 'bottom',
                labels: {
                    color: 'white', // Font color
                    font: {
                        family: 'Circular Std Book',
                        size: 14,
                    }
                }
            }
        },
        scales: {
            x: {
                ticks: {
                    color: 'white' // X-axis label color
                }
            },
            y: {
                ticks: {
                    color: 'white' // Y-axis label color
                }
            }
        }
    }
});
   /* pule */
   var pulse = document.getElementById("pulse").getContext('2d');
var myPulse = new Chart(pulse, {
    type: 'line',
    data: {
        labels: <?php echo json_encode($dates); ?>,
        datasets: [{
            label: 'Pulse',
            backgroundColor: "rgba(15, 140, 161, 0.2)", // Transparent fill under line
            borderColor: "#0f8ca1", // Line color
            data: <?php echo json_encode($pulse); ?>,
            fill: true, // Fill under the line
        }]
    },
    options: {
        plugins: {
            legend: {
                display: true,
                position: 'bottom',
                labels: {
                    color: 'white', // Font color
                    font: {
                        family: 'Circular Std Book',
                        size: 14,
                    }
                }
            }
        },
        scales: {
            x: {
                ticks: {
                    color: 'white' // X-axis label color
                }
            },
            y: {
                ticks: {
                    color: 'white' // Y-axis label color
                }
            }
        }
    }
});
   /* bmi */
   var bmi = document.getElementById("bmi").getContext('2d');
var mybmi = new Chart(bmi, {
    type: 'line',
    data: {
        labels: <?php echo json_encode($dates); ?>,
        datasets: [{
            label: 'BMI',
            backgroundColor: "rgba(255, 99, 132, 0.2)", // Transparent fill under line
            borderColor: "rgba(255, 99, 132, 1)", // Line color
            data: <?php echo json_encode($bmi); ?>,
            fill: true, // Fill under the line
        }]
    },
    options: {
        plugins: {
            legend: {
                display: true,
                position: 'bottom',
                labels: {
                    color: 'white', // Font color
                    font: {
                        family: 'Circular Std Book',
                        size: 14,
                    }
                }
            }
        },
        scales: {
            x: {
                ticks: {
                    color: 'white' // X-axis label color
                }
            },
            y: {
                ticks: {
                    color: 'white' // Y-axis label color
                }
            }
        }
    }
});

/* Blood Pressure */
var bpx = document.getElementById("blood_pressure").getContext('2d');
var myChart2 = new Chart(bpx, {
    type: 'line',
    data: {
        labels: <?php echo json_encode($dates); ?>,
        datasets: [
            {
                label: 'Systolic',
                backgroundColor: "rgba(15, 140, 161, 0.2)", // Transparent fill under line
                borderColor: "#0f8ca1", // Line color
                data: <?php echo json_encode($systolic); ?>,
                fill: true, // Fill under the line
            },
            {
                label: 'Diastolic',
                backgroundColor: "rgba(255, 99, 132, 0.2)", // Different fill color
                borderColor: "rgba(255, 99, 132, 1)", // Different line color
                data: <?php echo json_encode($diastolic); ?>,
                fill: true, // Fill under the line
            }
        ]
    },
    options: {
        plugins: {
            legend: {
                display: true,
                position: 'bottom',
                labels: {
                    color: 'white', // Font color
                    font: {
                        family: 'Circular Std Book',
                        size: 14,
                    }
                }
            }
        },
        scales: {
            x: {
                ticks: {
                    color: 'white' // X-axis label color
                }
            },
            y: {
                ticks: {
                    color: 'white' // Y-axis label color
                }
            }
        }
    }
});

</script>