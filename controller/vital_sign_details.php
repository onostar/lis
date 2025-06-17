<h3>Vital Signs</h3>
            <div class="displays allResults new_data" style="width:100%!important;margin:0!important">
            <!-- <div class="search">
                <input type="search" id="searchCheckout" placeholder="Enter keyword" onkeyup="searchData(this.value)">
                <a class="download_excel" href="javascript:void(0)" onclick="convertToExcel('data_table', 'Sales report')"title="Download to excel"><i class="fas fa-file-excel"></i></a>
            </div> -->
            <table id="data_table" class="searchTable">
                <thead>
                    <tr style="background:var(--primaryColor)">
                        <td>S/N</td>
                        <td>Date</td>
                        <td>Complaints</td>
                        <td>Temp.</td>
                        <td>BP</td>
                        <td>Resp.</td>
                        <td>Pulse</td>
                        <td>Weight</td>
                        <td>Height</td>
                        <td>BMI</td>
                        <td>SpO2</td>
                        <td>Head Cir.</td>
                        <td>Remark</td>
                        <td>Posted by</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $n = 1;
                        $get_users = new selects();
                        $details = $get_users->fetch_details_cond('vital_signs', 'patient', $patient);
                        if(gettype($details) === 'array'){
                        foreach($details as $detail):
                    ?>
                    <tr>
                        <td style="text-align:center; color:red;"><?php echo $n?></td>
                        <td style="color:var(--moreColor)"><?php echo date("d-m-Y h:i:a", strtotime($detail->post_date));?></td>
                        <td><?php echo $detail->complaints ?></td>
                        <td><?php echo $detail->temperature."<sup>o</sup>C" ?></td>
                        <td><?php echo $detail->systolic."/".$detail->diastolic ?></td>
                        <td><?php echo $detail->respiration ?>bpm</td>
                        <td><?php echo $detail->pulse ?>bpm</td>
                        <td><?php echo $detail->weight."kg"?></td>
                        <td><?php echo $detail->height."cm"?></td>
                        <td><?php echo $detail->bmi?></td>
                        <td><?php echo $detail->oxygen_saturation?>%</td>
                        <td><?php echo $detail->head_circumference?>cm</td>
                        <td><?php echo $detail->remark?></td>
                        
                        
                        <td>
                            <?php
                                //get posted by
                                $get_posted_by = new selects();
                                $checks = $get_posted_by->fetch_details_cond('staffs',  'user_id', $detail->posted_by);
                                foreach($checks as $check){
                                    $full_name = $check->last_name." ".$check->other_names;
                                }
                                echo $full_name;
                            ?>
                        </td>
                        
                    </tr>
                    <?php $n++; endforeach;}?>
                </tbody>
            </table>
            </div>