<style>
    .sales_receipt{
    padding:10px;
}
.sales_receipt h2{
    font-size:.9rem;
}
.sales_receipt h2, .sales_receipt p{
    text-align:center;
    font-size:.8rem;
    padding:0;
    margin:0;
}
.receipt_head{
    margin: 0 5px;
}
.sales_receipt .receipt_head{
    display:flex;
    justify-content: center;
    gap:.5rem;
    margin:2px 0;
}
.sales_receipt .total_amount{
    text-align: right;
    font-size:.8rem;
    margin:5px 0;
}

.sales_receipt .sold_by{
    text-align: left;
    font-size:.8rem;

}
.sales_receipt table{
    width:100%!important;
    margin:10px auto!important;
    box-shadow:none;
    border:1px solid #222;
    border-collapse: collapse;
}
.sales_receipt table thead tr td{
    font-size:.8rem;
    padding:2px;

}
.sales_receipt table td{
    border:1px solid #222;
    padding:2px;
}
.item_categories{
    padding:20px;
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
    border-bottom:1px solid #e7e6e6;
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
}
.single_test{
    margin-top:10px;
    max-height:100vh;
}
</style>