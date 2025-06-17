<style>
    h2, p{
        padding:0;
        margin:0;
    }
    .patient_details p{
    text-transform: uppercase;
    font-size:.9rem;
    margin:5px 0;
    text-align: left;
}
/* .patient_details span{
    text-decoration: underline;
} */
 .lab_header, .patient_details{
    border-bottom:1px solid rgb(176, 176, 176);
 }
 .lab_header h2{
    text-align:left;
    font-size:1.5rem;
    text-transform:uppercase;
    margin:0;
 }
 .lab_header p{
    padding:2px;
    margin:0;
 }
.label_img{
    width:90%;
    height:70px;
    margin:0 auto;
}
.label_img img{
    width:100%;
    height:100%;
}
.lab_header{
    display:flex;
    align-items:center;
    gap:.5rem;
}
.receipt_logo{
    width:100px;
    height:100px;
    border-radius:50%;
}
.receipt_logo img{
    width:100%;
    height:100%;
}
#lab_template {
    border: 1px solid #ddd;
    padding: 10px;
    min-height: 300px!important;
    background-color: #fafafa;
    overflow-y: auto;
  }
  .toolbar {
    display: flex;
    flex-wrap: wrap;
    background-color: #f5f5f5;
    padding: 5px;
    border: 1px solid #ddd;
  }
  .toolbar button {
    background: white;
    border: 1px solid #ddd;
    cursor: pointer;
    padding: 5px 8px;
    margin: 2px;
    color:#fff!important;
  }
  .toolbar select {
    margin: 2px;
  }
  .template_content{
    margin:10px;
    /* padding:10px; */
    /* color:#e7e6e6; */
    border:1px solid #e7e6e6;
    text-align:left;
    height:auto;
}
.single_test{
    margin-top:15px;
    max-height:100vh;
}
.signature{
    width:150px;
    height:80px;

}
.signature img{
    width:100%;
    height:100%;
}
.valid{
    margin-left:20px;
    padding:5px 0;
    text-transform: uppercase;
    border: 1px solid #efefef;
}
.autorized{
    margin:20px;
}
.allResults{
    width:100%!important;
}
.allResults table{
    width:100%!important;
    border-collapse: collapse!important;
}
.allResults table td{
    border:1px solid #222!important;
    padding:3px!important;
}
table td{
    border:1px solid #222!important;
    padding:3px!important;

}
#test_name{
    background:linear-gradient(45deg, #e27f55, #008000)!important;
}
</style>