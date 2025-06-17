
//show mobile menu
function displayMenu(){
     let main_menu = document.getElementById("mobile_log");
     if(window.innerWidth <= "800"){
          $("#menu_icon").click(function(){
               if(main_menu.style.display == "block"){
                    $(".main_menu").hide();
                    $("#menu_icon").html("<a href='javascript:void(0)'><i class='fas fa-bars'></i></a>");
               }else{
                    $(".main_menu").show();
                    $("#menu_icon").html("<a href='javascript:void(0)'><i class='fas fa-close'></i></a>");
               }
          })
               
          
     }
     // else{
          /* $("#menu_icon").click(function(){
               if(main_menu.style.display == "block"){
               alert (window.innerWidth);

                    main_menu.style.display == "none"
                    $("#menu_icon").html("<a href='javascript:void(0)'><i class='fas fa-close'></i></a>");
                    document.getElementById("contents").style.width = "100vw";
                    document.getElementById("contents").style.marginLeft = "0";
               }
          })
     } */
}
displayMenu();
//checck the screen width 
function checkMobile(){
     let screen_width = window.innerWidth;
     if(screen_width <= "800"){
          // alert(screen_width);
          $("#contents").click(function(){
               $(".main_menu").hide();
               $("#menu_icon").html("<a href='javascript:void(0)'><i class='fas fa-bars'></i></a>");
          
          })
     }
}
checkMobile();

// toggle password
function togglePassword(){
    let pw = document.querySelectorAll(".password");
    pw.forEach(ps => {
       if(ps.type === "password"){
            ps.type = "text";
            document.querySelector(".icon").innerHTML = "<i class='fas fa-eye-slash'></i>";
            document.querySelector(".icon_txt").innerHTML = "Hide password";
       }else{
            ps.type = "password";
            document.querySelector(".icon").innerHTML = "<i class='fas fa-eye'></i>";
            document.querySelector(".icon_txt").innerHTML = "Show password";
       } 
    });
}

//toggle logout
$(document).ready(function(){
     $("#loginDiv").click(function(){
          $(".login_option").toggle();
     })
})

//toggle menu with more options
$(document).ready(function(){
     $(".addMenu").click(function(){
          $(".nav1Menu").toggle();
          //change icon from plus to miinus and vice versa
          let option_icon = document.querySelector(".options");
          if(document.querySelector(".nav1Menu").style.display == "block"){
               option_icon.innerHTML = "<i style='background:none; color:#fff!important; box-shadow:none!important;' class='fas fa-minus'></i>";
          }else{
               option_icon.innerHTML = "<i style='background:none; color:#fff!important; box-shadow:none!important;' class='fas fa-plus'></i>";
          }

     })
})
//toggle all submenu
/* show frequenty asked questions */
function toggleMenu(subMenu){
     let menus = document.querySelectorAll(".subMenu");
     menu_id = document.getElementById(subMenu);
     if(menu_id.style.display == "block"){
          menu_id.style.display = "none";
     }else{
          menus.forEach(function(menu){
               menu.style.display = "none";
          })
          menu_id.style.display = "block";
     }
}

//show payment mode forms
function showCash(){
     document.querySelectorAll(".payment_form").forEach(function(forms){
          forms.style.display = "none";
     })
     $("#cash").show();
}
function showPos(){
     document.querySelectorAll(".payment_form").forEach(function(forms){
          forms.style.display = "none";
     })
     $("#pos").show();
}
function showTransfer(){
     document.querySelectorAll(".payment_form").forEach(function(forms){
          forms.style.display = "none";
     })
     $("#transfer").show();
}
//show pages dynamically with xhttp request
function showPage(page){
     let xhr = false;
     if(window.XMLHttpRequest){
          xhr = new XMLHttpRequest();
     }else{
          xhr = new ActiveXObject("Microsoft.XMLHTTP");
     }
     if(xhr){
          xhr.onreadystatechange = function(){
               if(xhr.readyState == 4 && xhr.status == 200){
                    document.querySelector(".contents").innerHTML = xhr.responseText;
               }
          }
          xhr.open("GET", page, true );
          xhr.send(null);
     }
}

//add users
function addUser(){
     let username = document.getElementById("username").value;
     let full_name = document.getElementById("full_name").value;
     let user_role = document.getElementById("user_role").value;
     let store_id = document.getElementById("store_id").value;
     let phone = document.getElementById("phone").value;
     let email_address = document.getElementById("email_address").value;
     let home_address = document.getElementById("home_address").value;
     // alert(store);
     if(full_name.length == 0 || full_name.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please enter user full name!");
          $("#full_name").focus();
          return;
     }else if(username.length == 0 || username.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please enter a username!");
          $("#username").focus();
          return;
     }else if(user_role.length == 0 || user_role.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please select user role!");
          $("#user_role").focus();
          return;
     }else if(store_id.length == 0 || store_id.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please select store!");
          $("#store").focus();
          return;
     }else{
          $.ajax({
               type : "POST",
               url : "../controller/add_users.php",
               data : {username:username, full_name:full_name, user_role:user_role, store_id:store_id, phone:phone, email_address:email_address, home_address:home_address},
               success : function(response){
               $(".info").html(response);
               }
          })
     }
     $("#username").val('');
     $("#full_name").val('');
     $("#item").val('');
     $("#user_role").val('');
     $("#store_id").val('');
     $("#phone").val('');
     $("#home_address").val('');
     $("#email_address").val('');
     $("#full_name").focus();
     return false;
}

//add departments
function addDepartment(){
     let department = document.getElementById("department").value;
     if(department.length == 0 || department.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please input department!");
          $("#department").focus();
          return;
     }else{
          $.ajax({
               type : "POST",
               url : "../controller/add_department.php",
               data : {department:department},
               success : function(response){
               $(".info").html(response);
               }
          })
     }
     $("#department").val('');
     $("#department").focus();
     return false;
}
//add expense head
function addExpHead(){
     let exp_head = document.getElementById("exp_head").value;
     if(exp_head.length == 0 || exp_head.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please input expense head!");
          $("#exp_head").focus();
          return;
     }else{
          $.ajax({
               type : "POST",
               url : "../controller/add_exp_head.php",
               data : {exp_head:exp_head},
               success : function(response){
               $(".info").html(response);
               }
          })
     }
     $("#exp_head").val('');
     $("#exp_head").focus();
     return false;
}
//add categories
function addCategory(){
     let category = document.getElementById("category").value;
     let department = document.getElementById("department").value;
     if(category.length == 0 || category.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please enter category!");
          $("#category").focus();
          return;
     }else if(department.length == 0 || department.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please select a department!");
          $("#department").focus();
          return;
     }else{
          $.ajax({
               type : "POST",
               url : "../controller/add_category.php",
               data : {category:category, department:department},
               success : function(response){
               $(".info").html(response);
               }
          })
     }
     $("#category").val('');
     $("#category").focus();
     return false;
}
//add bank
function addBank(){
     let bank = document.getElementById("bank").value;
     let account_num = document.getElementById("account_num").value;
     if(bank.length == 0 || bank.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please input bank name!");
          $("#bank").focus();
          return;
     }else if(account_num.length == 0 || account_num.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please input account number!");
          $("#account_num").focus();
          return;
     }else{
          $.ajax({
               type : "POST",
               url : "../controller/add_bank.php",
               data : {bank:bank, account_num:account_num},
               success : function(response){
               $(".info").html(response);
               }
          })
     }
     $("#bank").val('');
     $("#account_num").val('');
     $("#bank").focus();
     return false;
}
//add monthly target
function addTarget(){
     let sales_rep = document.getElementById("sales_rep").value;
     let month = document.getElementById("month").value;
     let target = document.getElementById("target").value;
     let todayDate = new Date();
     let today = todayDate.toLocaleDateString();
     if(sales_rep.length == 0 || sales_rep.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please select sales rep!");
          $("#sales_rep").focus();
          return;
     }else if(month.length == 0 || month.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please select date!");
          $("#month").focus();
          return;
     }else if(target.length == 0 || target.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please input target amount!");
          $("#target").focus();
          return;
     /* }else if(new Date(today).getTime() > new Date(month).getTime()){
          alert("You can not set target for a later date!");
          $("#month").focus();
          return; */
     }else{
          $.ajax({
               type : "POST",
               url : "../controller/add_target.php",
               data : {month:month, target:target, sales_rep:sales_rep},
               success : function(response){
               $("#monthly_target").html(response);
               }
          })
     }
     setTimeout(function(){
          $('#monthly_target').load("monthly_target.php #monthly_target");
     }, 1500);
     return false;
}
//update monthly target
function updateTarget(){
     let amount = document.getElementById("amount").value;
     let target = document.getElementById("target").value;
    
     if(amount.length == 0 || amount.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please enter amount!");
          $("#amount").focus();
          return;
    
     }else{
          $.ajax({
               type : "POST",
               url : "../controller/update_target.php",
               data : {amount:amount, target:target},
               success : function(response){
               $("#monthly_target").html(response);
               }
          })
     }
     setTimeout(function(){
          $('#monthly_target').load("monthly_target.php #monthly_target");
     }, 1500);
     return false;
}
//filter patients by sponsors on patient list
function filterItems(item){
     let filter = item;
     if(filter){
          $.ajax({
               type : "POST",
               url : "../controller/filter_sponsor.php",
               data :{filter:filter},
               success : function(response){
                    $("#bar_items").html(response);
               }
          })
          return false;
     }
}
//search for data within table
function searchData(data){
     let $row = $(".searchTable tbody tr");
     let val = $.trim(data).replace(/ +/g, ' ').toLowerCase();
     $row.show().filter(function(){
          var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
          return !~text.indexOf(val);
     }).hide();
}

// disale user
function disableUser(user_id){
     let disable = confirm("Do you want to disable this user?", "");
     if(disable){
          // alert(user_id);
          $.ajax({
               type: "GET",
               url : "../controller/disable_user.php?id="+user_id,
               success : function(response){
                    $("#disable_user").html(response);
               }
          })
          setTimeout(function(){
               $('#disable_user').load("disable_user.php #disable_user");
          }, 3000);
          return false;
     }
}

// activate disabled user
function activateUser(user_id){
     let activate = confirm("Do you want to activate this user account?", "");
     if(activate){
          $.ajax({
               type : "GET",
               url : "../controller/activate_user.php?user_id="+user_id,
               success : function(response){
                    $("#activate_user").html(response);
               }
          })
          setTimeout(function(){
               $("#activate_user").load("activate_user.php #activate_user");
          }, 3000);
          return false;
     }
}
// Reset user password
function resetPassword(user_id){
     let reset = confirm("Do you want to reset this user password?", "");
     if(reset){
          $.ajax({
               type : "GET",
               url : "../controller/reset_user_password.php?user_id="+user_id,
               success : function(response){
                    $("#reset_password").html(response);
               }
          })
          setTimeout(function(){
               $("#reset_password").load("reset_password.php #reset_password");
          }, 3000);
          return false;
     }
}

// add items 
// add items 
function addItem(){
     let group = document.getElementById("group").value;
     let department = document.getElementById("department").value;
     let item_category = document.getElementById("item_category").value;
     let item_class = document.getElementById("item_class").value;
     let item = document.getElementById("item").value;
     // let barcode = document.getElementById("barcode").value;
     if(group == "Pharmacy"){
          if(item_class.length == 0 || item_class.replace(/^\s+|\s+$/g, "").length == 0){
               alert("Please select Pharmacy class!");
               $("#item_class").focus();
               return;
          }
     }
     if(item_category.length == 0 || item_category.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please select item category!");
          $("#item_category").focus();
          return;
     }else if(item.length == 0 || item.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please enter item name");
          $("#item").focus();
          return;
     }else if(group.length == 0 || group.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please select item group");
          $("#group").focus();
          return;
     }else if(department.length == 0 || department.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please select department");
          $("#department").focus();
          return;
     /* }else if(barcode.length == 0 || barcode.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please enter item barcode");
          $("#barcode").focus();
          return; */
     }else{
          $.ajax({
               type : "POST",
               url : "../controller/add_item.php",
               data : {department:department, item_category:item_category, item:item, /* barcode:barcode,  */group:group, item_class:item_class},
               success : function(response){
               $(".info").html(response);
               }
          })
     }
     // $("#room_category").val('');
     $("#item").val('');
     $("#barcode").val('');
     $("#item").focus();
     return false;    
}
// update item foto 
function updatePhoto(){
     
     let item = document.getElementById("item").value;
     let photo = document.getElementById("photo").value;
     let pics = document.getElementById("pics").value;
     if(photo.length == 0 || photo.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please upload image");
          $("#photo").focus();
          return;
     }else if(pics.length == 0 || pics.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please select photo type");
          $("#foto").focus();
          return;
     }else{
          var fd = new FormData();
          var files = $('#photo')[0].files[0];
          fd.append('photo',files);
          fd.append('item',item);
          fd.append('pics',pics);
         
          $.ajax({
               url: '../controller/update_photo.php',
               type: 'post',
               data: fd,
               contentType: false,
               processData: false,
               success: function(response){
                    if(response != 0){
                    $("#item_list").html(response); 
                    
                    }else{
                         alert('file not uploaded');
                         return
                    }
               },
          });
          
     }    
     setTimeout(function(){
          $('#item_list').load("item_list.php #item_list");
     }, 1500);;
     return false;    
}
// add stores
function addStore(){
     let store_name = document.getElementById("store_name").value;
     let store_address = document.getElementById("store_address").value;
     let phone = document.getElementById("phone").value;
     if(store_name.length == 0 || store_name.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please enter store name!");
          $("#store_name").focus();
          return;
     }else if(store_address.length == 0 || store_address.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please enter store address");
          $("#store_address").focus();
          return;
     }else if(phone.length == 0 || phone.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please enter store phone numbers");
          $("#phone").focus();
          return;
     }else{
          $.ajax({
               type : "POST",
               url : "../controller/add_store.php",
               data : {store_name:store_name, store_address:store_address, phone:phone},
               success : function(response){
               $(".info").html(response);
               }
          })
     }
     // $("#room_category").val('');
     $("#store_name").val('');
     $("#store_address").val('');
     $("#phone").val('');
     $("#store").focus();
     return false;    
}
// Add new staff
function addStaff(){
     let last_name = document.getElementById("last_name").value;
     let other_names = document.getElementById("other_names").value;
     let phone_number = document.getElementById("phone_number").value;
     let dob = document.getElementById("dob").value;
     let staff_id = document.getElementById("staff_id").value;
     let title = document.getElementById("title").value;
     let gender = document.getElementById("gender").value;
     let marital_status = document.getElementById("marital_status").value;
     let religion = document.getElementById("religion").value;
     let employed = document.getElementById("employed").value;
     let address = document.getElementById("address").value;
     let email = document.getElementById("email").value;
     let nok = document.getElementById("nok").value;
     let nok_relation = document.getElementById("nok_relation").value;
     let nok_phone = document.getElementById("nok_phone").value;
     let staff_category = document.getElementById("staff_category").value;
     let staff_group = document.getElementById("staff_group").value;
     let department = document.getElementById("department").value;
     let designation = document.getElementById("designation").value;
     let discipline = document.getElementById("discipline").value;
     let bank = document.getElementById("bank").value;
     let account_num = document.getElementById("account_num").value;
     let pension = document.getElementById("pension").value;
     let pension_num = document.getElementById("pension_num").value;
     let todayDate = new Date();
     if(last_name.length == 0 || last_name.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please enter last name!");
          $("#last_name").focus();
          return;
     }else if(other_names.length == 0 || other_names.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please enter other names!");
          $("#other_names").focus();
          return;
     }else if(department.length == 0 || department.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please select department!");
          $("#department").focus();
          return;
     }else if(gender.length == 0 || gender.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please select Gender!");
          $("#gender").focus();
          return;
     }else if(title.length == 0 || title.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please select title!");
          $("#title").focus();
          return;
     }else if(email.length == 0 || email.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please input staff's email address");
          $("#email").focus();
          return;
     }else if(phone_number.length == 0 || phone_number.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please enter staff's phone number");
          $("#phone_number").focus();
          return;
     }else if(phone_number.length != 11){
          alert("Phone number is not correct");
          $("#phone_number").focus();
          return;
    
     }else if(dob.length == 0 || dob.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please enter date of birth");
          $("#dob").focus();
          return;
     }else if(address.length == 0 || address.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please input staff's residential address");
          $("#address").focus();
          return;
     }else if(employed.length == 0 || employed.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please input employment date");
          $("#employed").focus();
          return;
     }else if(marital_status.length == 0 || marital_status.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please input staff's marital status");
          $("#marital_status").focus();
          return;
     }else if(religion.length == 0 || religion.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please select staff's Religion");
          $("#religion").focus();
          return;
     }else if(discipline.length == 0 || discipline.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please seelct staff's discipline");
          $("#discipline").focus();
          return;
     }else if(staff_category.length == 0 || staff_category.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please seelct staff's category");
          $("#staff_category").focus();
          return;
     }else if(staff_group.length == 0 || staff_group.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please seelct staff group");
          $("#staff_group").focus();
          return;
     }else if(nok.length == 0 || nok.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please input staff's Next of Kin");
          $("#nok").focus();
          return;
     }else if(nok_phone.length == 0 || nok_phone.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please input staff's Next of Kin phone number");
          $("#nok_phone").focus();
          return;
     }else if(nok_phone.length != 11){
          alert("Phone number is not correct");
          $("#nok_phone").focus();
          return;
     }else if(nok_relation.length == 0 || nok_relation.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please input Next of Kin relationship");
          $("#nok_relation").focus();
          return;
     }else if(designation.length == 0 || designation.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please select staff designation");
          $("#designtation").focus();
          return;
     }else if(todayDate <= new Date(dob)){
          alert("You can not enter a futuristic date !");
          $("#dob").focus();
          return;
     }else if(todayDate < new Date(employed)){
          alert("You can not enter a futuristic date !");
          $("#employed").focus();
          return;
     }else{
          $.ajax({
               type : "POST",
               url : "../controller/add_staff.php",
               data : {other_names:other_names, last_name:last_name, phone_number:phone_number, email:email, address:address, dob:dob, staff_id:staff_id, title:title, gender:gender, marital_status:marital_status, religion:religion, nok:nok, staff_group:staff_group,nok_phone:nok_phone, nok_relation:nok_relation, staff_category:staff_category, discipline:discipline, designation:designation, bank:bank, account_num:account_num, pension:pension, pension_num:pension_num, employed:employed, department:department},
               success : function(response){
                    $("#add_staff").html(response);
               }
          })
          /* $("#last_name").val('');
          $("#other_names").val('');
          $("#email").val('');
          $("#address").val('');
          $("#dob").val('');
          $("#phone_number").val('');
          $("#last_name").focus(); */
          setTimeout(function(){
               $("#add_staff").load("add_staff.php");
          }, 1500);
          return false;   
     }
      
}

//update staff details
function updateStaff(){
     let last_name = document.getElementById("last_name").value;
     let other_names = document.getElementById("other_names").value;
     let phone_number = document.getElementById("phone_number").value;
     let dob = document.getElementById("dob").value;
     let staff_id = document.getElementById("staff_id").value;
     let staff_num = document.getElementById("staff_num").value;
     let title = document.getElementById("title").value;
     let gender = document.getElementById("gender").value;
     let marital_status = document.getElementById("marital_status").value;
     let religion = document.getElementById("religion").value;
     let employed = document.getElementById("employed").value;
     let address = document.getElementById("address").value;
     let email = document.getElementById("email").value;
     let nok = document.getElementById("nok").value;
     let nok_relation = document.getElementById("nok_relation").value;
     let nok_phone = document.getElementById("nok_phone").value;
     let staff_category = document.getElementById("staff_category").value;
     let staff_group = document.getElementById("staff_group").value;
     let department = document.getElementById("department").value;
     let designation = document.getElementById("designation").value;
     let discipline = document.getElementById("discipline").value;
     let bank = document.getElementById("bank").value;
     let account_num = document.getElementById("account_num").value;
     let pension = document.getElementById("pension").value;
     let pension_num = document.getElementById("pension_num").value;
     let todayDate = new Date();
     if(last_name.length == 0 || last_name.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please enter last name!");
          $("#last_name").focus();
          return;
     }else if(other_names.length == 0 || other_names.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please enter other names!");
          $("#other_names").focus();
          return;
     }else if(department.length == 0 || department.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please select department!");
          $("#department").focus();
          return;
     }else if(gender.length == 0 || gender.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please select Gender!");
          $("#gender").focus();
          return;
     }else if(title.length == 0 || title.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please select title!");
          $("#title").focus();
          return;
     }else if(email.length == 0 || email.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please input staff's email address");
          $("#email").focus();
          return;
     }else if(phone_number.length == 0 || phone_number.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please enter staff's phone number");
          $("#phone_number").focus();
          return;
     }else if(phone_number.length != 11){
          alert("Phone number is not correct");
          $("#phone_number").focus();
          return;
    
     }else if(dob.length == 0 || dob.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please enter date of birth");
          $("#dob").focus();
          return;
     }else if(address.length == 0 || address.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please input staff's residential address");
          $("#address").focus();
          return;
     }else if(employed.length == 0 || employed.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please input employment date");
          $("#employed").focus();
          return;
     }else if(marital_status.length == 0 || marital_status.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please input staff's marital status");
          $("#marital_status").focus();
          return;
     }else if(religion.length == 0 || religion.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please select staff's Religion");
          $("#religion").focus();
          return;
     }else if(discipline.length == 0 || discipline.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please seelct staff's discipline");
          $("#discipline").focus();
          return;
     }else if(staff_category.length == 0 || staff_category.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please seelct staff's category");
          $("#staff_category").focus();
          return;
     }else if(staff_group.length == 0 || staff_group.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please seelct staff group");
          $("#staff_group").focus();
          return;
     }else if(nok.length == 0 || nok.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please input staff's Next of Kin");
          $("#nok").focus();
          return;
     }else if(nok_phone.length == 0 || nok_phone.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please input staff's Next of Kin phone number");
          $("#nok_phone").focus();
          return;
     }else if(nok_phone.length != 11){
          alert("Phone number is not correct");
          $("#nok_phone").focus();
          return;
     }else if(nok_relation.length == 0 || nok_relation.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please input Next of Kin relationship");
          $("#nok_relation").focus();
          return;
     }else if(designation.length == 0 || designation.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please select staff designation");
          $("#designtation").focus();
          return;
     }else if(todayDate <= new Date(dob)){
          alert("You can not enter a futuristic date !");
          $("#dob").focus();
          return;
     }else if(todayDate < new Date(employed)){
          alert("You can not enter a futuristic date !");
          $("#employed").focus();
          return;
     }else{
          $.ajax({
               type : "POST",
               url : "../controller/update_staff.php",
               data : {other_names:other_names, last_name:last_name, phone_number:phone_number, email:email, address:address, dob:dob, staff_id:staff_id, staff_num:staff_num, title:title, gender:gender, marital_status:marital_status, religion:religion, nok:nok, staff_group:staff_group,nok_phone:nok_phone, nok_relation:nok_relation, staff_category:staff_category, discipline:discipline, designation:designation, bank:bank, account_num:account_num, pension:pension, pension_num:pension_num, employed:employed, department:department},
               success : function(response){
                    $("#edit_customer").html(response);
               }
          })
          /* $("#last_name").val('');
          $("#other_names").val('');
          $("#email").val('');
          $("#address").val('');
          $("#dob").val('');
          $("#phone_number").val('');
          $("#last_name").focus(); */
          setTimeout(function(){
               $("#edit_customer").load("edit_staff_details.php?customer="+staff_id);
          }, 1500);
          return false;   
     }
      
}
// add suppliers 
function addSupplier(){
     let supplier = document.getElementById("supplier").value;
     let contact_person = document.getElementById("contact_person").value;
     let phone = document.getElementById("phone").value;
     let email = document.getElementById("email").value;
     if(supplier.length == 0 || supplier.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please input supplier name!");
          $("#supplier").focus();
          return;
    /*  }else if(contact_person.length == 0 || contact_person.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please input contact person name");
          $("#contact_person").focus();
          return;
     }else if(phone.length == 0 || phone.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please input phone number");
          $("#phone").focus();
          return;
     }else if(email.length == 0 || email.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please input email address");
          $("#email").focus();
          return; */
     }else{
          $.ajax({
               type : "POST",
               url : "../controller/add_vendor.php",
               data : {supplier:supplier, contact_person:contact_person, phone:phone, email:email},
               success : function(response){
               $(".info").html(response);
               }
          })
     }
     $("#supplier").val('');
     $("#contact_person").val('');
     $("#phone").val('');
     $("#email").val('');
     $("#supplier").focus();
     return false;    
}
// add sponsors 
function addSponsor(){
     let sponsor_type = document.getElementById("sponsor_type").value;
     let sponsor = document.getElementById("sponsor").value;
     let contact_person = document.getElementById("contact_person").value;
     let phone = document.getElementById("phone").value;
     let email = document.getElementById("email").value;
     let address = document.getElementById("address").value;
     if(sponsor_type.length == 0 || sponsor_type.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please select sponsor type!");
          $("#sponsor_type").focus();
          return;
     }else if(sponsor.length == 0 || sponsor.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please input sponsor name!");
          $("#sponsor").focus();
          return;
     }else if(contact_person.length == 0 || contact_person.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please input contact person name");
          $("#contact_person").focus();
          return;
     }else if(phone.length == 0 || phone.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please input phone number");
          $("#phone").focus();
          return;
     }else if(email.length == 0 || email.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please input email address");
          $("#email").focus();
          return;
     }else if(address.length == 0 || address.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please input sponsor address");
          $("#address").focus();
          return;
     }else{
          $.ajax({
               type : "POST",
               url : "../controller/add_sponsor.php",
               data : {sponsor_type:sponsor_type, sponsor:sponsor,contact_person:contact_person, phone:phone, email:email, address:address},
               success : function(response){
               $(".info").html(response);
               }
          })
     }
     $("#sponsor").val('');
     $("#sponsor_type").val('');
     $("#contact_person").val('');
     $("#phone").val('');
     $("#email").val('');
     $("#address").val('');
     $("#sponsor_type").focus();
     return false;    
}

// get item categories
function getCategory(post_department){
     let department = post_department;
     if(department){
          $.ajax({
               type : "POST",
               url :"../controller/get_categories.php",
               data : {department:department},
               success : function(response){
                    $("#item_category").html(response);
               }
          })
          return false;
     }else{
          $("#item_category").html("<option value'' selected>Select department first</option>")
     }
     
}


//calculate days from check in and check out
function calculateDays(){
     let check_in_date = document.getElementById("check_in_date").value;
     let check_out_date = document.getElementById("check_out_date").value; 
     let amount = document.getElementById("amount");
     let room_fee = document.getElementById("room_fee").value;
     let num_days = document.getElementById("days");
     firstDay = new Date(check_in_date);
     secondDay = new Date(check_out_date);
     days = secondDay.getTime() - firstDay.getTime();
     totalDays = days / (1000 * 60 * 60 * 24);
     newAmount = totalDays * parseInt(room_fee);
     amount.innerHTML = "<input type='number' name='amount_due' id='amount_due' value='"+newAmount+"'>";
     num_days.innerHTML = "<p>(Checking in for "+totalDays+" days)</p>";
     // alert(totalDays);
}
//calculate age from date of birth
function getAge(dob){
     let age = document.getElementById("age");
     let new_age = Math.floor((new Date() - new Date(dob).getTime()) / 3.15576e+10)
     age.value = new_age+" Year(s)";
}
//post guest cash payment
function postCash(){
     let posted_by = document.getElementById("posted_by").value;
     let guest = document.getElementById("guest").value;
     let payment_mode = document.getElementById("payment_mode").value;
     let bank_paid = document.getElementById("bank_paid").value;
     let sender = document.getElementById("sender").value;
     let guest_amount = document.getElementById("guest_amount").value;
     let amount_paid = document.getElementById("amount_paid").value;
     
     if(amount_paid.length == 0 || amount_paid.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please input amount paid!");
          $("#amount_paid").focus();
          return;
     // }else if(parseInt(amount_paid) < parseInt(guest_amount)){
     //      alert("Insufficient funds!");
     //      $("#guest_amount").focus();
     //      return;
     }else{
     $.ajax({
          type : "POST",
          url : "../controller/post_payments.php",
          data : {posted_by:posted_by, guest:guest, payment_mode:payment_mode, bank_paid:bank_paid, sender:sender, guest_amount:guest_amount, amount_paid:amount_paid},
          success : function(response){
               $("#all_payments").html(response);
          }
     })
          setTimeout(function(){
               $('#all_payments').load("post_payment.php?guest_id=+"+guest + "#all_payments");
          }, 3000);
     }
     return false;    

}
//post guest POS payment
function postPos(){
     let posted_by = document.getElementById("posted_by").value;
     let guest = document.getElementById("guest").value;
     let payment_mode = document.getElementById("pos_mode").value;
     let bank_paid = document.getElementById("pos_bank_paid").value;
     let sender = document.getElementById("sender").value;
     let guest_amount = document.getElementById("guest_amount").value;
     let amount_paid = document.getElementById("pos_amount_paid").value;
     
     if(amount_paid.length == 0 || amount_paid.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please input amount paid!");
          $("#pos_amount_paid").focus();
          return;
     }else if(bank_paid.length == 0 || bank_paid.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please select POS Bank!");
          $("#pos_bank_paid").focus();
          return;
     }else{
     $.ajax({
          type : "POST",
          url : "../controller/post_payments.php",
          data : {posted_by:posted_by, guest:guest, payment_mode:payment_mode, bank_paid:bank_paid, sender:sender, guest_amount:guest_amount, amount_paid:amount_paid},
          success : function(response){
               $("#all_payments").html(response);
          }
     })
          setTimeout(function(){
               $('#all_payments').load("post_payment.php?guest_id=+"+guest + "#all_payments");
          }, 3000);
     }
     return false;    

}

//post other cash payments for guest
function postOtherCash(){
     let posted_by = document.getElementById("posted_by").value;
     let guest = document.getElementById("guest").value;
     let payment_mode = document.getElementById("payment_mode").value;
     let bank_paid = document.getElementById("bank_paid").value;
     let sender = document.getElementById("sender").value;
     let guest_amount = document.getElementById("guest_amount").value;
     let amount_paid = document.getElementById("amount_paid").value;
     
     if(amount_paid.length == 0 || amount_paid.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please input amount paid!");
          $("#amount_paid").focus();
          return;
     // }else if(parseInt(amount_paid) < parseInt(guest_amount)){
     //      alert("Insufficient funds!");
     //      $("#guest_amount").focus();
     //      return;
     }else{
     $.ajax({
          type : "POST",
          url : "../controller/post_other_payments.php",
          data : {posted_by:posted_by, guest:guest, payment_mode:payment_mode, bank_paid:bank_paid, sender:sender, guest_amount:guest_amount, amount_paid:amount_paid},
          success : function(response){
               $("#guest_details").html(response);
          }
     })
          setTimeout(function(){
               $('#guest_details').load("guest_details.php?guest_id=+"+guest + "#guest_details");
          }, 3000);
     }
     return false;    

}
//post other Pos payments for guest
function postOtherPos(){
     let posted_by = document.getElementById("posted_by").value;
     let guest = document.getElementById("guest").value;
     let payment_mode = document.getElementById("pos_mode").value;
     let bank_paid = document.getElementById("pos_bank_paid").value;
     let sender = document.getElementById("sender").value;
     let guest_amount = document.getElementById("guest_amount").value;
     let amount_paid = document.getElementById("pos_amount_paid").value;
     
     if(amount_paid.length == 0 || amount_paid.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please input amount paid!");
          $("#pos_amount_paid").focus();
          return;
     }else if(bank_paid.length == 0 || bank_paid.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please select POS Bank!");
          $("#pos_bank_paid").focus();
          return;
     }else{
     $.ajax({
          type : "POST",
          url : "../controller/post_other_payments.php",
          data : {posted_by:posted_by, guest:guest, payment_mode:payment_mode, bank_paid:bank_paid, sender:sender, guest_amount:guest_amount, amount_paid:amount_paid},
          success : function(response){
               $("#guest_details").html(response);
          }
     })
          setTimeout(function(){
               $('#guest_details').load("guest_details.php?guest_id=+"+guest + "#guest_details");
          }, 3000);
     }
     return false;    

}
//post other Transfer payments for guest
function postOtherTransfer(){
     let posted_by = document.getElementById("posted_by").value;
     let guest = document.getElementById("guest").value;
     let payment_mode = document.getElementById("transfer_mode").value;
     let bank_paid = document.getElementById("transfer_bank_paid").value;
     let sender = document.getElementById("transfer_sender").value;
     let guest_amount = document.getElementById("guest_amount").value;
     let amount_paid = document.getElementById("transfer_amount").value;
     
     if(amount_paid.length == 0 || amount_paid.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please input amount paid!");
          $("#transfer_amount").focus();
          return;
     }else if(bank_paid.length == 0 || bank_paid.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please select Bank Transferred to!");
          $("#transfer_bank_paid").focus();
          return;
     }else if(sender.length == 0 || sender.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please Input Name of sender!");
          $("#transfer_sender").focus();
          return;
     }else{
     $.ajax({
          type : "POST",
          url : "../controller/post_other_payments.php",
          data : {posted_by:posted_by, guest:guest, payment_mode:payment_mode, bank_paid:bank_paid, sender:sender, guest_amount:guest_amount, amount_paid:amount_paid},
          success : function(response){
               $("#guest_details").html(response);
          }
     })
          setTimeout(function(){
               $('#guest_details').load("guest_details.php?guest_id=+"+guest + "#guest_details");
          }, 3000);
     }
     return false;    

}

//check out guest
function checkOut(){
     let checkout = confirm("Do you want to check out this guest?", "");
     if(checkout){
          // alert(user_id);
          let user_id = document.getElementById("user_id").value;
          let guest_id = document.getElementById("guest_id").value;
          $.ajax({
               type : "POST",
               url : "../controller/check_out.php",
               data : {user_id:user_id, guest_id:guest_id},
               success : function(response){
                    $("#guest_details").html(response);
               }
          })
          setTimeout(function(){
               $("#guest_details").load("guest_details.php?guest_id="+guest_id+ "#guest_details");
          }, 3000);
     }
     return false;
}

//display any item form
function getForm(item, link){
     // alert(item_id);
     $.ajax({
          type : "GET",
          url : "../controller/"+link+"?item_id="+item,
          success : function(response){
               $(".info").html(response);
               window.scrollTo(0, 0);
          }
     })
     return false;
 
 }


//display stockin form
function displayStockinForm(item_id){
     // alert(item_id);
/*      let invoice = document.getElementById("invoice").value;
     let vendor = document.getElementById("vendor").value; */
     let item = item_id;
          
          $.ajax({
               type : "GET",
               url : "../controller/get_stockin_details.php?item="+item,
               success : function(response){
                    $(".info").html(response);
               }
          })
          $("#sales_item").html("");
          $("#item").val('');

          return false;
     // }
     
 }
//display stockin form for warehouse goods
function displayWarehouseForm(item_id){
     let item = item_id;
          
          $.ajax({
               type : "GET",
               url : "../controller/get_warehouse_details.php?item="+item,
               success : function(response){
                    $(".info").html(response);
               }
          })
          $("#sales_item").html("");
          $("#item").val('');

          return false;
     // }
     
 }
//display transfer item form
function addTransfer(item_id){
     let item = item_id;
          
          $.ajax({
               type : "GET",
               url : "../controller/get_transfer_details.php?item="+item,
               success : function(response){
                    $(".info").html(response);
               }
          })
          $("#sales_item").html("");
          return false;
     // }
     
 }
//display dispense item form
function addDispense(item_id, invoice_no){
     let item = item_id;
     let invoice = invoice_no;
          $.ajax({
               type : "GET",
               url : "../controller/get_dispense_details.php?item="+item+"&invoice="+invoice,
               success : function(response){
                    $(".info").html(response);
               }
          })
          $("#sales_item").html("");
          return false;
     // }
     
 }

 //display item purchase history
function checkStockinHistory(item_id){
     // alert(item_id);
/*      let invoice = document.getElementById("invoice").value;
     let vendor = document.getElementById("vendor").value; */
     let item = item_id;
          
          $.ajax({
               type : "GET",
               url : "../controller/stockin_history.php?item="+item,
               success : function(response){
                    $(".new_data").html(response);
               }
          })
          $("#sales_item").html("");
          return false;
     // }
     
 }
 //display customer statement/transaction history
function getCustomerStatement(customer_id){
     let customer = customer_id;
          
          $.ajax({
               type : "GET",
               url : "../controller/customer_statement.php?customer="+customer,
               success : function(response){
                    $(".new_data").html(response);
               }
          })
          $("#sales_item").html("");
          $("#customer").val("");
          return false;
     // }
     
     }
 //display items in each customer inivoice under statement/transaction history
function viewCustomerInvoice(invoice_id){
     let invoice = invoice_id;
          $.ajax({
               type : "GET",
               url : "../controller/customer_invoices.php?invoice="+invoice,
               success : function(response){
                    $("#customer_invoices").html(response);
                    // window.scrollTo(0, 0);
                    document.getElementById("customer_invoices").scrollIntoView();
               }
          })
          $("#sales_item").html("");
          return false;
     // }
     
 }
 //display payment form for credit payments
function addPayment(invoice_id){
     let invoice = invoice_id;          
          $.ajax({
               type : "GET",
               url : "../controller/get_payment.php?invoice="+invoice,
               success : function(response){
                    $("#customer_invoices").html(response);
                    // window.scrollTo(0, 0);
                    document.getElementById("customer_invoices").scrollIntoView();
               }
          })
          // $("#sales_item").html("");
          return false;
     // }
     
 }
 //stockin in items
function stockin(){
     let posted_by = document.getElementById("posted_by").value;
     let store = document.getElementById("store").value;
     let invoice_number = document.getElementById("invoice_number").value;
     let vendor = document.getElementById("vendor").value;
     let item_id = document.getElementById("item_id").value;
     let quantity = document.getElementById("quantity").value;
     let cost_price = document.getElementById("cost_price").value;
    /*  let sales_price = document.getElementById("sales_price").value;
     let pack_price = document.getElementById("pack_price").value;
     let pack_size = document.getElementById("pack_size").value; */
     // let commission = document.getElementById("commission").value;
    /*  let wholesale_price = document.getElementById("wholesale_price").value;
     let wholesale_pack = document.getElementById("wholesale_pack").value; */
     let expiration_date = document.getElementById("expiration_date").value;
     let todayDate = new Date();
     // let today = todayDate.toLocaleDateString();
     // alert(today);
     if(quantity.length == 0 || quantity.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please input quantity purchased!");
          $("#quantity").focus();
          return;
     }else if(quantity <= 0){
          alert("Please input quantity purchased!");
          $("#quantity").focus();
          return;
     }else if(cost_price.length == 0 || cost_price.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please input cost price");
          $("#cost_price").focus();
          return;
     /*}else if(sales_price.length == 0 || sales_price.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please input selling price");
          $("#sales_price").focus();
          return;
     }else if(commission.length == 0 || commission.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please input product commission");
          $("#commission").focus();
          return; */
     }else if(cost_price < 0){
          alert("You can not enter a value lesser than 0");
          $("#cost_price").focus();
          return;
     }else if(expiration_date.length == 0 || expiration_date.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please input item expiration date");
          $("#expiration_date").focus();
          return;
     }else if(todayDate > new Date(expiration_date)){
          alert("You can not stock in expired items!");
          $("#expiration_date").focus();
          return;
     /*}else if(parseInt(cost_price) >= parseInt(sales_price)){
          alert("Cost price cannot be greater than selling price!");
          $("#sales_price").focus();
          return;
    }else if(parseInt(cost_price) >= parseInt(wholesale_price)){
          alert("Cost price cannot be greater than wholesale price!");
          $("#wholesale_price").focus();
          return; */
     }else{
          $.ajax({
               type : "POST",
               url : "../controller/stock_in.php",
               data : {posted_by:posted_by, store:store, vendor:vendor, invoice_number:invoice_number, item_id:item_id, quantity:quantity, cost_price:cost_price, /*sales_price:sales_price, pack_price:pack_price, pack_size:pack_size,commission:commission, wholesale_price:wholesale_price, wholesale_pack:wholesale_pack, */ expiration_date:expiration_date},
               success : function(response){
               $(".stocked_in").html(response);
               }
          })
          /* $("#quantity").val('');
          $("#expiration_date").val('');
          $("#quantity").focus(); */
          $(".info").html('');
          $("#item").focus();
          return false; 
     }
}
 //stockin in items for warehouse
function stockinWarehouse(){
     let posted_by = document.getElementById("posted_by").value;
     let store = document.getElementById("store").value;
     let invoice_number = document.getElementById("invoice_number").value;
     let vendor = document.getElementById("vendor").value;
     let item_id = document.getElementById("item_id").value;
     let quantity = document.getElementById("quantity").value;
     let cost_price = document.getElementById("cost_price").value;
     let pack_size = document.getElementById("pack_size").value;
     let expiration_date = document.getElementById("expiration_date").value;
     let todayDate = new Date();
     let today = todayDate.toLocaleDateString();
     // alert(today);
     if(quantity.length == 0 || quantity.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please input quantity purchased!");
          $("#quantity").focus();
          return;
     }else if(quantity <= 0){
          alert("Please input quantity purchased!");
          $("#quantity").focus();
          return;
     }else if(cost_price.length == 0 || cost_price.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please input cost price");
          $("#cost_price").focus();
          return;
     }else if(expiration_date.length == 0 || expiration_date.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please input item expiration date");
          $("#expiration_date").focus();
          return;
     }else if(new Date(today).getTime() > new Date(expiration_date).getTime()){
          alert("You can not stock in expired items!");
          $("#expiration_date").focus();
          return;
     }else{
          $.ajax({
               type : "POST",
               url : "../controller/stock_inwarehouse.php",
               data : {posted_by:posted_by, store:store, vendor:vendor, invoice_number:invoice_number, item_id:item_id, quantity:quantity, cost_price:cost_price, pack_size:pack_size, expiration_date:expiration_date},
               success : function(response){
               $(".stocked_in").html(response);
               }
          })
          /* $("#quantity").val('');
          $("#expiration_date").val('');
          $("#quantity").focus(); */
          $(".info").html('');
          return false; 
     }
}
 //transfer in items
function transfer(){
     let posted_by = document.getElementById("posted_by").value;
     let store_from = document.getElementById("store_from").value;
     let store_to = document.getElementById("store_to").value;
     let invoice = document.getElementById("invoice").value;
     let item_id = document.getElementById("item_id").value;
     let quantity = document.getElementById("quantity").value;
     let expiration = document.getElementById("expiration").value;
     if(quantity.length == 0 || quantity.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please input quantity!");
          $("#quantity").focus();
          return;
     }else if(quantity <= 0){
          alert("Please input quantity!");
          $("#quantity").focus();
          return;
     }else{
          $.ajax({
               type : "POST",
               url : "../controller/transfer.php",
               data : {posted_by:posted_by, store_to:store_to, store_from:store_from, invoice:invoice, item_id:item_id, quantity:quantity, expiration:expiration},
               success : function(response){
               $(".stocked_in").html(response);
               }
          })
          /* $("#quantity").val('');
          $("#expiration_date").val('');
          $("#quantity").focus(); */
          $(".info").html('');
          return false; 
     }
}
 //dispense items
function dispense(){
     let posted_by = document.getElementById("posted_by").value;
     let store_from = document.getElementById("store_from").value;
     // let store_to = document.getElementById("store_to").value;
     let invoice = document.getElementById("invoice").value;
     let item_id = document.getElementById("item_id").value;
     let quantity = document.getElementById("quantity").value;
     let expiration = document.getElementById("expiration").value;
     if(quantity.length == 0 || quantity.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please input quantity!");
          $("#quantity").focus();
          return;
     }else if(quantity <= 0){
          alert("Please input quantity!");
          $("#quantity").focus();
          return;
     }else{
          $.ajax({
               type : "POST",
               url : "../controller/dispense.php",
               data : {posted_by:posted_by, /* store_to:store_to, */ store_from:store_from, invoice:invoice, item_id:item_id, quantity:quantity, expiration:expiration},
               success : function(response){
               $(".stocked_in").html(response);
               }
          })
          /* $("#quantity").val('');
          $("#expiration_date").val('');
          $("#quantity").focus(); */
          $(".info").html('');
          return false; 
     }
}

//delete individual purchases
function deletePurchase(purchase, item){
     let confirmDel = confirm("Are you sure you want to delete this purchase?", "");
     if(confirmDel){
          
          $.ajax({
               type : "GET",
               url : "../controller/delete_purchase.php?purchase_id="+purchase+"&item_id="+item,
               success : function(response){
                    $(".stocked_in").html(response);
               }
               
          })
          return false;
     }else{
          return;
     }
}
//close stock in form
function closeStockin(url){
     $("#stockin").load(url+" #stockin");
}


 //adjust item quantity
 function adjustQty(){
     let item_id = document.getElementById("item_id").value;
     let quantity = document.getElementById("quantity").value;
     let expiration = document.getElementById("expiration").value;
     let todayDate = new Date();
     // let today = todayDate.toLocaleDateString();
     if(quantity.length == 0 || quantity.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please input quantity!");
          $("#quantity").focus();
          return;
     }else if(expiration.length == 0 || expiration.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please input item expiration date!");
          $("#expiration").focus();
          return;
     }else if(todayDate >= new Date(expiration)){
          alert("You can not stock in expired items!");
          $("#expiration").focus();
          return;
     }else{
          $.ajax({
               type : "POST",
               url : "../controller/stock_adjustment.php",
               data: {item_id:item_id, quantity:quantity, expiration:expiration},
               success : function(response){
                    $("#adjust_quantity").html(response);
               }
          })
          setTimeout(function(){
               $("#adjust_quantity").load("stock_adjustment.php #adjust_quantity");
          }, 2000);
          return false
     }
 }
 
 //remove item quantity from store
 function removeQty(){
     let item_id = document.getElementById("item_id").value;
     let quantity = document.getElementById("quantity").value;
     let remove_reason = document.getElementById("remove_reason").value;
     if(quantity.length == 0 || quantity.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please input quantity!");
          $("#quantity").focus();
          return;
     }else if(quantity <= 0){
          alert("Please input quantity to remove!");
          $("#quantity").focus();
          return;
     }else if(remove_reason.length == 0 || remove_reason.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please select reason for removal!");
          $("#remove_reason").focus();
          return;
     }else{
          $.ajax({
               type : "POST",
               url : "../controller/remove_item.php",
               data: {item_id:item_id, quantity:quantity, remove_reason:remove_reason},
               success : function(response){
                    $("#remove_item").html(response);
               }
          })
          setTimeout(function(){
               $("#remove_item").load("remove_item.php #remove_item");
          }, 2000);
          return false
     }
 }
 //adjust item expiration
 function adjustExpiry(){
     let item_id = document.getElementById("item_id").value;
     let exp_date = document.getElementById("exp_date").value;
     let todayDate = new Date();
     let today = todayDate.toLocaleDateString();
     if(exp_date.length == 0 || exp_date.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please input date!");
          $("#item_name").focus();
          return;
     }else if(new Date(today).getTime() > new Date(exp_date).getTime()){
          alert("Expiration date is invalid!");
          $("#expiration_date").focus();
          return;
     }else{
          $.ajax({
               type : "POST",
               url : "../controller/adjust_expiration.php",
               data: {item_id:item_id, exp_date:exp_date},
               success : function(response){
                    $("#adjust_expiration").html(response);
               }
          })
          setTimeout(function(){
               $("#adjust_expiration").load("adjust_expiration.php #adjust_expiration");
          }, 2000);
          return false
     }
 }
//  display change rom price
function roomPriceForm(item_id){
     // alert(item_id);
     $.ajax({
          type : "GET",
          url : "../controller/get_room_details.php?item_id="+item_id,
          success : function(response){
               $(".info").html(response);
          }
     })
     return false;
 
 }
 
 //close price form
 function closeForm(){
     
         $(".priceForm").hide();
     
 }

 //change room price
 function changeRoomPrice(){
     let item_id = document.getElementById("item_id").value;
     let price = document.getElementById("price").value;

     $.ajax({
          type : "POST",
          url : "../controller/edit_room_price.php",
          data: {item_id:item_id, price:price},
          success : function(response){
               $("#edit_price").html(response);
          }
     })
     setTimeout(function(){
          $("#edit_price").load("room_price.php #edit_price");
     }, 1500);
     return false;
 }
 //add item to tariff
 function addTariff(url){
     let item_id = document.getElementById("item_id").value;
     let sponsor = document.getElementById("sponsor").value;
     let cost_price = document.getElementById("cost_price").value;
     let sales_price = document.getElementById("sales_price").value;
     let item_group = document.getElementById("item_group").value;
     let category = document.getElementById("category").value;
     
     if(parseInt(cost_price) >= parseInt(sales_price)){
          alert("Agreed amount can not be lesser than cost price!");
          $("#sales_price").focus();
          return;
     
     }else if(cost_price.length == 0 || cost_price.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please enter cost price!");
          $("#cost_price").focus();
          return;
     }else if(sales_price.length == 0 || sales_price.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please enter agreed amount!");
          $("#sales_price").focus();
          return;
    
     }else if(sales_price <= 0 || cost_price < 0){
          alert("Values cannot be less than 0!");
          $("#sales_price").focus();
          return;
     }else{
          $.ajax({
               type : "POST",
               url : "../controller/add_tariff.php",
               data: {item_id:item_id, cost_price:cost_price, sales_price:sales_price, item_group:item_group, category:category, sponsor:sponsor},
               success : function(response){
                    $("#edit_item_price").html(response);
               }
          })
          setTimeout(function(){
               $("#edit_item_price").load(url+ " #edit_item_price");
          }, 1000);
          return false
     }
 }
 //change item tariff
 function changeItemPrice(url){
     let item_id = document.getElementById("item_id").value;
     let cost_price = document.getElementById("cost_price").value;
     let sales_price = document.getElementById("sales_price").value;
    
     if(parseInt(cost_price) >= parseInt(sales_price)){
          alert("Selling price can not be lesser than cost price!");
          $("#sales_price").focus();
          return;
     /* }else if(parseInt(cost_price) >= parseInt(wholesale_price)){
          alert("Wholesale price can not be lesser than cost price!");
          $("#wholesale_price").focus();
          return; */
     }else if(cost_price.length == 0 || cost_price.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please enter cost price!");
          $("#cost_price").focus();
          return;
     }else if(sales_price.length == 0 || sales_price.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please enter agreed amount!");
          $("#sales_price").focus();
          return;
    
     }else if(sales_price <= 0 || cost_price < 0){
          alert("Values cannot be less than 0!");
          $("#sales_price").focus();
          return;
     }else{
          $.ajax({
               type : "POST",
               url : "../controller/edit_price.php",
               data: {item_id:item_id, cost_price:cost_price, sales_price:sales_price},
               success : function(response){
                    $("#edit_item_price").html(response);
               }
          })
          setTimeout(function(){
               $("#edit_item_price").load(url+ " #edit_item_price");
          }, 1000);
          return false
     }
 }
 //change percentage markup
 function changeMarkup(){
     let item_id = document.getElementById("item_id").value;
     let cost_price = document.getElementById("cost_price").value;
     let markup = document.getElementById("markup").value;
    /*  let pack_price = document.getElementById("pack_price").value;
     let pack_size = document.getElementById("pack_size").value;
     let wholesale_price = document.getElementById("wholesale_price").value;
     let wholesale_pack = document.getElementById("wholesale_pack").value;*/
     let carton_role = document.getElementById("carton_role").value;
     let carton_size = document.getElementById("carton_size").value;
    /*  if(parseInt(cost_price) >= parseInt(sales_price)){
          alert("Selling price can not be lesser than cost price!");
          $("#sales_price").focus();
          return; */
     /* }else if(parseInt(cost_price) >= parseInt(wholesale_price)){
          alert("Wholesale price can not be lesser than cost price!");
          $("#wholesale_price").focus();
          return; */
     if(cost_price.length == 0 || cost_price.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please enter cost price!");
          $("#cost_price").focus();
          return;
     }else if(markup.length == 0 || markup.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please enter percentage markup!");
          $("#markup").focus();
          return;
     /* }else if(sales_price.length == 0 || sales_price.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please enter selling price!");
          $("#sales_price").focus();
          return; */
     /* }else if(wholesale_price.length == 0 || wholesale_price.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please enter wholesale price!");
          $("#wholesale_price").focus();
          return; */
     /* }else if(pack_price.length == 0 || pack_price.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please enter pack price!");
          $("#pack_price").focus();
          return;
     }else if(pack_price <= cost_price){
          alert("Error! Pack price cannot be lesser than cost price!");
          $("#pack_price").focus();
          return;*/
     }else if(carton_role.length == 0 || carton_role.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please input carton markup!");
          $("#carton_role").focus();
          return;
     }else if(carton_size.length == 0 || carton_size.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please input carton size!");
          $("#carton_size").focus();
          return;
     }else if(markup <= 0 || cost_price < 0 || carton_size < 0 || carton_role < 0){
          alert("Values cannot be less than 0!");
          $("#cost_price").focus();
          return;
     }else{
          $.ajax({
               type : "POST",
               url : "../controller/edit_markup.php",
               data: {item_id:item_id, cost_price:cost_price, /* sales_price:sales_price, pack_price:pack_price, wholesale_price:wholesale_price, wholesale_pack:wholesale_pack, pack_size:pack_size,*/ carton_role:carton_role,carton_size:carton_size, markup:markup},
               success : function(response){
                    $("#edit_item_price").html(response);
               }
          })
          setTimeout(function(){
               $("#edit_item_price").load("manage_markup.php #edit_item_price");
          }, 1000);
          return false
     }
 }
 //modify item name
 function modifyItem(){
     let item_id = document.getElementById("item_id").value;
     let item_name = document.getElementById("item_name").value;
     /* let details = document.getElementById("details").value;
     let dosage = document.getElementById("dosage").value; */
     if(item_name.length == 0 || item_name.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please input item name!");
          $("#item_name").focus();
          return;
     }else{
          $.ajax({
               type : "POST",
               url : "../controller/modify_item.php",
               data: {item_id:item_id, item_name:item_name/* , details:details, dosage:dosage */},
               success : function(response){
                    $("#edit_item_name").html(response);
               }
          })
          setTimeout(function(){
               $("#edit_item_name").load("modify_item.php #edit_item_name");
          }, 1500);
          return false
     }
 }
 //update item barcode
 function updateBarcode(){
     let item_id = document.getElementById("item_id").value;
     let barcode = document.getElementById("barcode").value;
     if(barcode.length == 0 || barcode.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please input item barcode!");
          $("#barcode").focus();
          return;
     }else{
          $.ajax({
               type : "POST",
               url : "../controller/update_barcode.php",
               data: {item_id:item_id, barcode:barcode},
               success : function(response){
                    $("#update_barcode").html(response);
               }
          })
          setTimeout(function(){
               $("#update_barcode").load("update_barcode.php #update_barcode");
          }, 1500);
          return false
     }
 }
 //change item category
 function changeCategory(){
     let item_id = document.getElementById("item_id").value;
     let department = document.getElementById("department").value;
     let item_category = document.getElementById("item_category").value;
     if(department.length == 0 || department.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please select item category!");
          $("#department").focus();
          return;
     }else if(item_category.length == 0 || item_category.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please select item subcategory!");
          $("#item_category").focus();
          return;
     }else{
          $.ajax({
               type : "POST",
               url : "../controller/change_category.php",
               data: {item_id:item_id, department:department, item_category:item_category},
               success : function(response){
                    $("#change_category").html(response);
               }
          })
          setTimeout(function(){
               $("#change_category").load("change_category.php #change_category");
          }, 1500);
          return false
     }
 }





// update password
function updatePassword(){
     let username = document.getElementById('username').value;
     let current_password = document.getElementById('current_password').value;
     let new_password = document.getElementById('new_password').value;
     let retype_password = document.getElementById('retype_password').value;
     /* authentication */
     if(current_password == 0 || current_password.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please enter current password");
          $("#current_password").focus();
          return;
     }else if(new_password == 0 || new_password.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please enter new password");
          $("#new_password").focus();
          return;
     }else if(new_password.length < 6){
          alert("New password must be greater or equal to 6 characters");
          $("#new_password").focus();
          return;
     }else if(retype_password == 0 || retype_password.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please retype new password");
          $("#retype_password").focus();
          return;
     }else if(new_password !== retype_password){
          alert("Passwords does not match!");
          $("#retype_password").focus();
          return;
     }else{
          $.ajax({
               type: "POST",
               url: "../controller/update_password.php",
               data: {username:username, current_password:current_password, new_password:new_password, retype_password:retype_password},
               success: function(response){
               $(".info").html(response);
               }
          });
     }
     return false;
}
//  Get room reports 
function getRoomReports(room){
     let room_id = room;
     /* authentication */
     if(room_id){
          $.ajax({
               type: "POST",
               url: "../controller/room_reports.php",
               data: {room_id:room_id},
               success: function(response){
                    $(".new_data").html(response);
               }
          });
     }else{
          alert("select a room!");
          return;
     }
     return false;
}

//get vendors
function getVendors(vendor){
     let ven_input = vendor;
     if(ven_input){
          $.ajax({
               type : "POST",
               url :"../controller/get_vendors.php",
               data : {ven_input:ven_input},
               success : function(response){
                    $("#vendors").html(response);
               }
          })
          return false;
     }else{
          $("#vendors").html("<option value='' selected>No result</option>")
     }
     
}

//show bill types forms
/* function showRetail(){
     $("#retail_customers").show();
     $("#wholesale_customers").hide();
}
function showWholesale(){
     $("#retail_customers").hide();
     $("#wholesale_customers").show();
} */
//show sales form categories (bar and restuarant)
function showBar(){
     $("#bar_items").show();
     $("#restaurant_items").hide();
}
function showRestaurant(){
     $("#bar_items").hide();
     $("#restaurant_items").show();
}

//get item during registration
function getItems(item_name){
     let item = item_name;
     let sponsor = document.getElementById("sponsor").value;
     let category = document.getElementById("category").value;
     if(category != "Private"){
          if(!sponsor){
               alert("Please select sponsor");
               $("#sponsor").focus();
               $("#item").val("");
               return;
          }
     }
     if(!category){
          alert("Please select patient category");
          $("#category").focus();
          $("#item").val("");
          return;
     }else{
          if(item.length >= 3){
               if(item){
                    $.ajax({
                         type : "POST",
                         url :"../controller/get_items.php",
                         data : {item:item, sponsor:sponsor, category:category},
                         success : function(response){
                              $("#sales_item").html(response);
                         }
                    })
                    return false;
               }else{
                    $("#sales_item").html("<p>Please enter atleast 3 letters</p>");
               }
          }
     }
     
}
//get item for existing patient
function getExistingItems(item_name){
     let item = item_name;
     let sponsor = document.getElementById("sponsor").value;
     let category = document.getElementById("category").value;
     if(category != "Private"){
          if(!sponsor){
               alert("Please select sponsor");
               $("#sponsor").focus();
               $("#item").val("");
               return;
          }
     }
     if(!category){
          alert("Please select patient category");
          $("#category").focus();
          $("#item").val("");
          return;
     }else{
          if(item.length >= 3){
               if(item){
                    $.ajax({
                         type : "POST",
                         url :"../controller/get_existing_items.php",
                         data : {item:item, sponsor:sponsor, category:category},
                         success : function(response){
                              $("#sales_item").html(response);
                         }
                    })
                    return false;
               }else{
                    $("#sales_item").html("<p>Please enter atleast 3 letters</p>");
               }
          }
     }
     
}
//get item for sales order
function getItemsOrder(item_name){
     let item = item_name;
     let customer = document.getElementById("customer").value;
     // alert(check_room);
     // return;
     if(item.length >= 3){
          if(item){
               $.ajax({
                    type : "POST",
                    url :"../controller/get_sales_order_items.php",
                    data : {item:item, customer:customer},
                    success : function(response){
                         $("#sales_item").html(response);
                    }
               })
               return false;
          }else{
               $("#sales_item").html("<p>Please enter atleast 3 letters</p>");
          }
     }
     
}
//get item for wholesale direct sales
function getWholesaleItems(item_name){
     let item = item_name;
     let customer = document.getElementById("customer").value;
     // alert(check_room);
     // return;
     if(item.length >= 3){
          if(item){
               $.ajax({
                    type : "POST",
                    url :"../controller/get_wholesale_items.php",
                    data : {item:item, customer:customer},
                    success : function(response){
                         $("#sales_item").html(response);
                    }
               })
               return false;
          }else{
               $("#sales_item").html("<p>Please enter atleast 3 letters</p>");
          }
     }
     
}
//get supplier for stockin
function getSupplier(sup){
     let supplier = sup;
     let invoice = document.getElementById("invoice").value;
     if(invoice.length == 0 || invoice.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please input invoice number!");
          $("#invoice").focus();
          return;
     }else{
          if(supplier.length >= 3){
               if(supplier){
                    $.ajax({
                         type : "POST",
                         url :"../controller/get_supplier.php",
                         data : {supplier:supplier},
                         success : function(response){
                              $("#transfer_item").html(response);
                         }
                    })
                    $("#invoice").attr("readonly", true);
                    return false;
               }else{
                    $("#transfer_item").html("<p>Please enter atleast 3 letters</p>");
               }
          }
     }
}
//get item for stockin
function getItemStockin(item_name, url){
     let item = item_name;
     // alert(check_room);
     // return;
     let invoice = document.getElementById("invoice").value;
     let vendor = document.getElementById("vendor").value;
     if(invoice.length == 0 || invoice.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please input invoice number!");
          $("#invoice").focus();
          return;
     }else if(vendor.length == 0 || vendor.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please select supplier!");
          $("#vendor").focus();
          return;
     }else{
          if(item.length >= 3){
               // alert(vendor);
               if(item){
                    $.ajax({
                         type : "POST",
                         url :"../controller/"+url,
                         data : {item:item, invoice:invoice, vendor:vendor},
                         success : function(response){
                              $("#sales_item").html(response);
                         }
                    })
                    $("#invoice").attr("readonly", true);
                    $("#supplier").attr("readonly", true);
                    $("#vendor").attr("readonly", true);
                    return false;
               }else{
                    $("#sales_item").html("<p>Please enter atleast 3 letters</p>");
               }
          }
     }
     
}

//get item for transfer
function getItemTransfer(item_name){
     let item = item_name;
     // alert(check_room);
     // return;
     let invoice = document.getElementById("invoice").value;
     let store_to = document.getElementById("store_to").value;
     if(store_to.length == 0 || store_to.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please select a store!");
          $("#store_to").focus();
          return;
     }else{
          if(item.length >= 3){
               if(item){
                    $.ajax({
                         type : "POST",
                         url :"../controller/get_item_transfer.php",
                         data : {item:item,  store_to:store_to, invoice:invoice},
                         success : function(response){
                              $("#sales_item").html(response);
                         }
                    })
                    $("#store_to").attr("readonly", true);
                    return false;
               }else{
                    $("#sales_item").html("<p>Please enter atleast 3 letters</p>");
               }
          }
     }
     
}
//get customer statement
function getCustomer(customer_id){
     let customer = customer_id;
     // alert(check_room);
     // return;
     let fromDate = document.getElementById("fromDate").value;
     let toDate = document.getElementById("toDate").value;
     if(fromDate.length == 0 || fromDate.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please select a date range!");
          $("#fromDate").focus();
          return;
     }else if(toDate.length == 0 || toDate.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please select a date range!");
          $("#toDate").focus();
          return;
     }else{
     if(customer.length >= 3){
          if(customer){
               $.ajax({
                    type : "POST",
                    url :"../controller/get_customer.php",
                    data : {customer:customer, fromDate:fromDate, toDate:toDate},
                    success : function(response){
                         $("#sales_item").html(response);
                    }
               })
               /* $("#fromDate").attr("readonly", true);
               $("#toDate").attr("readonly", true); */
               return false;
          }else{
               $("#sales_item").html("<p>Please enter atleast 3 letters</p>");
          }
     }
}
     
}
//get item for stockin history
function getStockinItem(item_name){
     let item = item_name;
     // alert(check_room);
     // return;
     let fromDate = document.getElementById("fromDate").value;
     let toDate = document.getElementById("toDate").value;
     if(fromDate.length == 0 || fromDate.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please select a date range!");
          $("#fromDate").focus();
          return;
     }else if(toDate.length == 0 || toDate.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please select a date range!");
          $("#toDate").focus();
          return;
     }else{
     if(item.length >= 3){
          if(item){
               $.ajax({
                    type : "POST",
                    url :"../controller/get_item_purchase.php",
                    data : {item:item, fromDate:fromDate, toDate:toDate},
                    success : function(response){
                         $("#sales_item").html(response);
                    }
               })
               /* $("#fromDate").attr("readonly", true);
               $("#toDate").attr("readonly", true); */
               return false;
          }else{
               $("#sales_item").html("<p>Please enter atleast 3 letters</p>");
          }
     }
}
     
}
//search vendor history
function vendorHistory(){
     let vendor = document.getElementById("vendor").value;
     // alert(check_room);
     // return;
     let fromDate = document.getElementById("fromDate").value;
     let toDate = document.getElementById("toDate").value;
     if(fromDate.length == 0 || fromDate.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please select a date range!");
          $("#fromDate").focus();
          return;
     }else if(toDate.length == 0 || toDate.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please select a date range!");
          $("#toDate").focus();
          return;
     }else if(vendor.length == 0 || vendor.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please select a vendor!");
          $("#toDate").focus();
          return;
     }else{
          $.ajax({
               type : "POST",
               url :"../controller/vendor_history.php",
               data : {vendor:vendor, fromDate:fromDate, toDate:toDate},
               success : function(response){
                    $(".new_data").html(response);
               }
          })
         
     }
}
     

//select vendor during stocking
function addvendor(id, vendor_name){
     let supplier = document.getElementById("supplier");
     let vendor = document.getElementById("vendor");
     supplier.value = vendor_name;
     vendor.value = id;
     $("#vendor").attr("readonly", true);
     $("#supplier").attr("readonly", true);
     $("#transfer_item").html('');
}
//add direct sales 
function addSales(item_id){
     let item = item_id;
     let invoice = document.getElementById("invoice").value;
     $.ajax({
          type : "GET",
          url : "../controller/add_sales.php?sales_item="+item+"&invoice="+invoice,
          success : function(response){
               $(".sales_order").html(response);
          }
     })
     $("#sales_item").html("");
     $("#item").val('');

     return false;
}

//add sales order
function addSalesOrder(item_id){
     let item = item_id;
     let invoice = document.getElementById("invoice").value;
     let customer = document.getElementById("customer").value;
     $.ajax({
          type : "GET",
          url : "../controller/add_sales_order.php?sales_item="+item+"&customer="+customer+"&invoice="+invoice,
          success : function(response){
               $(".sales_order").html(response);
          }
     })
     $("#sales_item").html("");
     $("#item").val('');

     return false;
}
//add direct wholesales 
function addWholeSales(item_id){
     let item = item_id;
     let customer = document.getElementById("customer").value;
     let invoice = document.getElementById("invoice").value;
     $.ajax({
          type : "GET",
          url : "../controller/add_wholesale.php?sales_item="+item+"&customer="+customer+"&invoice="+invoice,
          success : function(response){
               $(".sales_order").html(response);
          }
     })
     $("#sales_item").html("");
     $("#item").val('');

     return false;
}
//add rep sales
function addRepSales(item_id){
     let item = item_id;
     let customer = document.getElementById("customer").value;
     let invoice = document.getElementById("invoice").value;
     $.ajax({
          type : "GET",
          url : "../controller/add_repsale.php?sales_item="+item+"&customer="+customer+"&invoice="+invoice,
          success : function(response){
               $(".sales_order").html(response);
          }
     })
     $("#sales_item").html("");
     $("#item").val('');

     return false;
}
//delete individual items from direct sales
function deleteSales(sales, item){
     let confirmDel = confirm("Are you sure you want to remove this item?", "");
     if(confirmDel){
          
          $.ajax({
               type : "GET",
               url : "../controller/delete_sales.php?sales_id="+sales+"&item_id="+item,
               success : function(response){
                    $(".sales_order").html(response);
               }
               
          })
          return false;
     }else{
          return;
     }
}
//delete item
function deleteItem(item){
     let confirmDel = confirm("Are you sure you want to delete this item?", "");
     if(confirmDel){
          $.ajax({
               type : "GET",
               url : "../controller/delete_item.php?item="+item,
               success : function(response){
                    $("#delete_item").html(response);
               }
          })
          setTimeout(function(){
               $("#delete_item").load("delete_item.php #delete_item");
          }, 1500);
          return false;
          
     }else{
          return;
     }
}
//delete individual items from sales order
function deleteSalesOrder(sales, item){
     let confirmDel = confirm("Are you sure you want to remove this item?", "");
     if(confirmDel){
          
          $.ajax({
               type : "GET",
               url : "../controller/delete_sales_order.php?sales_id="+sales+"&item_id="+item,
               success : function(response){
                    $(".sales_order").html(response);
               }
               
          })
          return false;
     }else{
          return;
     }
}
//delete individual items from direct wholesale
function deleteWholesale(sales, item){
     let confirmDel = confirm("Are you sure you want to remove this item?", "");
     if(confirmDel){
          
          $.ajax({
               type : "GET",
               url : "../controller/delete_wholesale.php?sales_id="+sales+"&item_id="+item,
               success : function(response){
                    $(".sales_order").html(response);
               }
               
          })
          return false;
     }else{
          return;
     }
}
//delete individual items from direct repsale
function deleteRepsale(sales, item){
     let confirmDel = confirm("Are you sure you want to remove this item?", "");
     if(confirmDel){
          
          $.ajax({
               type : "GET",
               url : "../controller/delete_repsale.php?sales_id="+sales+"&item_id="+item,
               success : function(response){
                    $(".sales_order").html(response);
               }
               
          })
          return false;
     }else{
          return;
     }
}
//increase quantity for direct sales item
function increaseQty(sales, item){
     // alert(sales);
     $.ajax({
          type : "GET",
          url : "../controller/increase_qty.php?sales_id="+sales+"&item_id="+item,
          success : function(response){
               $(".sales_order").html(response);
          }
          
     })
     return false;
}
//increase quantity for sales order item
function increaseQtyOrder(sales, item){
     // alert(sales);
     $.ajax({
          type : "GET",
          url : "../controller/increase_qty_order.php?sales_id="+sales+"&item_id="+item,
          success : function(response){
               $(".sales_order").html(response);
          }
          
     })
     return false;
}
//increase quantity for direct wholesalesales item
function increaseQtyWholesale(sales, item){
     // alert(sales);
     $.ajax({
          type : "GET",
          url : "../controller/increase_qty_wholesale.php?sales_id="+sales+"&item_id="+item,
          success : function(response){
               $(".sales_order").html(response);
          }
          
     })
     return false;
}
//increase quantity for direct repsales item
function increaseQtyRepsale(sales, item){
     // alert(sales);
     $.ajax({
          type : "GET",
          url : "../controller/increase_qty_repsales.php?sales_id="+sales+"&item_id="+item,
          success : function(response){
               $(".sales_order").html(response);
          }
          
     })
     return false;
}
//decrease quantity for direct sales item
function reduceQty(sales){
     $.ajax({
          type : "GET",
          url : "../controller/decrease_qty.php?item="+sales,
          success : function(response){
               $(".sales_order").html(response);
          }
          
     })
     return false;
}
//decrease quantity for sales order item
function reduceQtyOrder(sales){
     $.ajax({
          type : "GET",
          url : "../controller/decrease_qty_order.php?item="+sales,
          success : function(response){
               $(".sales_order").html(response);
          }
          
     })
     return false;
}
//decrease quantity for direct wholesalesales item
function reduceQtyWholesale(sales){
     $.ajax({
          type : "GET",
          url : "../controller/decrease_qty_wholesale.php?item="+sales,
          success : function(response){
               $(".sales_order").html(response);
          }
          
     })
     return false;
}
//decrease quantity for direct repsales item
function reduceQtyRepsale(sales){
     $.ajax({
          type : "GET",
          url : "../controller/decrease_qty_repsale.php?item="+sales,
          success : function(response){
               $(".sales_order").html(response);
          }
          
     })
     return false;
}
//show more options for sales item to edit price and quantity
function showMore(sales){
     $.ajax({
          type : "GET",
          url : "../controller/edit_price_qty.php?item="+sales,
          success : function(response){
               $(".show_more").html(response);
               window.scrollTo(0, 0);
          }
          
     })
     return false;
}
//show more options for sales order item to edit price and quantity
function showMoreOrder(sales){
     $.ajax({
          type : "GET",
          url : "../controller/edit_price_qty_order.php?item="+sales,
          success : function(response){
               $(".show_more").html(response);
               window.scrollTo(0, 0);

          }
          
     })
     return false;
}
//show more options for sales item to edit price and quantity
function showMoreWholesale(sales){
     $.ajax({
          type : "GET",
          url : "../controller/edit_price_qty_wholesale.php?item="+sales,
          success : function(response){
               $(".show_more").html(response);
               window.scrollTo(0, 0);

          }
          
     })
     return false;
}
//show more options for rep sales item to edit price and quantity
function showMoreRepsale(sales){
     $.ajax({
          type : "GET",
          url : "../controller/edit_price_qty_repsale.php?item="+sales,
          success : function(response){
               $(".show_more").html(response);
               window.scrollTo(0, 0);

          }
          
     })
     return false;
}
//update sales quantity and price for direct sales
function updatePriceQty(){
     let sales_id = document.getElementById("sales_id").value;
     let qty = document.getElementById("qty").value;
     let price = document.getElementById("price").value;
     // let inv_qty = document.getElementById("inv_qty").value;
     /* authentication */
     if(qty.length == 0 || qty.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please input quantity!");
          $("#qty").focus();
          return;
     }else if(price.length == 0 || price.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please input unit price!");
          $("#price").focus();
          return;
     }else if(qty < 1){
          alert("Qauntity cannot be zero or negative!");
          $("#qty").focus();
          return;
     }else if(price < 1){
          alert("Price cannot be zero or negative!");
          $("#price").focus();
          return;
     /* }else if(qty > inv_qty){
          alert("Available quantity is less than required!");
          $("#qty").focus();
          return; */
     }else{
          $.ajax({
               type: "POST",
               url: "../controller/update_price_qty.php",
               data: {sales_id:sales_id, qty:qty, price:price},
               success: function(response){
               $(".sales_order").html(response);
               }
          });

     }
     $(".show_more").html('');
     return false;
}
//update sales quantity and price for sales order
function updatePriceQtyOrder(){
     let sales_id = document.getElementById("sales_id").value;
     let qty = document.getElementById("qty").value;
     let price = document.getElementById("price").value;
     // let inv_qty = document.getElementById("inv_qty").value;
     /* authentication */
     if(qty.length == 0 || qty.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please input quantity!");
          $("#qty").focus();
          return;
     }else if(price.length == 0 || price.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please input unit price!");
          $("#price").focus();
          return;
     }else if(qty < 1){
          alert("Qauntity cannot be zero or negative!");
          $("#qty").focus();
          return;
     }else if(price < 1){
          alert("Price cannot be zero or negative!");
          $("#price").focus();
          return;
     /* }else if(qty > inv_qty){
          alert("Available quantity is less than required!");
          $("#qty").focus();
          return; */
     }else{
          $.ajax({
               type: "POST",
               url: "../controller/update_price_qty_order.php",
               data: {sales_id:sales_id, qty:qty, price:price},
               success: function(response){
               $(".sales_order").html(response);
               }
          });

     }
     $(".show_more").html('');
     return false;
}
//update sales quantity and price for wholesale
function updatePriceQtyWh(){
     let sales_id = document.getElementById("sales_id").value;
     let qty = document.getElementById("qty").value;
     let price = document.getElementById("price").value;
     // let inv_qty = document.getElementById("inv_qty").value;
     /* authentication */
     if(qty.length == 0 || qty.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please input quantity!");
          $("#qty").focus();
          return;
     }else if(price.length == 0 || price.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please input unit price!");
          $("#price").focus();
          return;
     }else if(qty < 1){
          alert("Qauntity cannot be zero or negative!");
          $("#qty").focus();
          return;
     }else if(price < 1){
          alert("Price cannot be zero or negative!");
          $("#price").focus();
          return;
     /* }else if(qty > inv_qty){
          alert("Available quantity is less than required!");
          $("#qty").focus();
          return; */
     }else{
          $.ajax({
               type: "POST",
               url: "../controller/update_price_qty_who.php",
               data: {sales_id:sales_id, qty:qty, price:price},
               success: function(response){
               $(".sales_order").html(response);
               }
          });

     }
     $(".show_more").html('');
     return false;
}
//update sales quantity and markup for repsales
function updatePriceQtyRep(){
     let sales_id = document.getElementById("sales_id").value;
     let qty = document.getElementById("qty").value;
     let markup = document.getElementById("markup").value;
     // let inv_qty = document.getElementById("inv_qty").value;
     /* authentication */
     if(qty.length == 0 || qty.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please input quantity!");
          $("#qty").focus();
          return;
     }else if(markup.length == 0 || markup.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please input % markup!");
          $("#markup").focus();
          return;
     }else if(qty < 1){
          alert("Qauntity cannot be zero or negative!");
          $("#qty").focus();
          return;
0   }else if(markup < 0){
          alert("markup cannot be zero or negative!");
          $("markup ").focus();
          return;
     /* }else if(qty > inv_qty){
          alert("Available quantity is less than required!");
          $("#qty").focus();
          return; */
     }else{
          $.ajax({
               type: "POST",
               url: "../controller/update_price_qty_rep.php",
               data: {sales_id:sales_id, qty:qty, markup:markup},
               success: function(response){
               $(".sales_order").html(response);
               }
          });

     }
     $(".show_more").html('');
     return false;
}
//get item pack price and size for direct sales
function getPack(sales){
     $.ajax({
          type : "GET",
          url : "../controller/get_pack.php?sales_id="+sales,
          success : function(response){
               $(".show_more").html(response);
          }
          
     })
     return false;
}
//get item pack price and size for sales order
function getPackSo(sales){
     $.ajax({
          type : "GET",
          url : "../controller/get_pack_so.php?sales_id="+sales,
          success : function(response){
               $(".show_more").html(response);
          }
          
     })
     return false;
}
//get item pack price and size for wholesale
function getWholesalePack(sales){
     $.ajax({
          type : "GET",
          url : "../controller/get_pack_wholesale.php?sales_id="+sales,
          success : function(response){
               $(".show_more").html(response);
          }
          
     })
     return false;
}
//get item carton/role price and size for wholesale
function getCartonRole(sales){
     $.ajax({
          type : "GET",
          url : "../controller/get_carton_role.php?sales_id="+sales,
          success : function(response){
               $(".show_more").html(response);
          }
          
     })
     return false;
}
//sell item in pack or carton for either wholesale or retail
function sellPack(url){
     let sales_id = document.getElementById("sales_id").value;
     let pack_qty = document.getElementById("pack_qty").value;
     let pack_price = document.getElementById("pack_price").value;
     let pack_size = document.getElementById("pack_size").value;
     // let inv_qty = document.getElementById("inv_qty").value;
     /* authentication */
     if(pack_qty.length == 0 || pack_qty.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please input quantity!");
          $("#pack_qty").focus();
          return;
     }else if(pack_price.length == 0 || pack_price.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please input unit price!");
          $("#pack_price").focus();
          return;
     }else if(pack_qty <= 0 ){
          alert("Qauntity cannot be zero or negative!");
          $("#pack_qty").focus();
          return;
     }else if(pack_price <= 0){
          alert("Price cannot be zero or negative!");
          $("#pack_price").focus();
          return;
     /* }else if(qty > inv_qty){
          alert("Available quantity is less than required!");
          $("#qty").focus();
          return; */
     }else{
          $.ajax({
               type: "POST",
               url: "../controller/"+url,
               data: {sales_id:sales_id, pack_qty:pack_qty, pack_price:pack_price, pack_size:pack_size},
               success: function(response){
               $(".sales_order").html(response);
               }
          });

     }
     $(".show_more").html('');
     return false;
}
//sell item in pack for sales order
function sellPackSo(){
     let sales_id = document.getElementById("sales_id").value;
     let pack_qty = document.getElementById("pack_qty").value;
     let pack_price = document.getElementById("pack_price").value;
     let pack_size = document.getElementById("pack_size").value;
     // let inv_qty = document.getElementById("inv_qty").value;
     /* authentication */
     if(pack_qty.length == 0 || pack_qty.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please input quantity!");
          $("#pack_qty").focus();
          return;
     }else if(pack_price.length == 0 || pack_price.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please input unit price!");
          $("#pack_price").focus();
          return;
     }else if(pack_qty <= 0 ){
          alert("Qauntity cannot be zero or negative!");
          $("#pack_qty").focus();
          return;
     }else if(pack_price <= 0){
          alert("Price cannot be zero or negative!");
          $("#pack_price").focus();
          return;
     /* }else if(qty > inv_qty){
          alert("Available quantity is less than required!");
          $("#qty").focus();
          return; */
     }else{
          $.ajax({
               type: "POST",
               url: "../controller/sell_pack_so.php",
               data: {sales_id:sales_id, pack_qty:pack_qty, pack_price:pack_price, pack_size:pack_size},
               success: function(response){
               $(".sales_order").html(response);
               }
          });

     }
     $(".show_more").html('');
     return false;
}
//sell item in pack for wholesale
function sellPackWholesale(){
     let sales_id = document.getElementById("sales_id").value;
     let pack_qty = document.getElementById("pack_qty").value;
     let pack_price = document.getElementById("pack_price").value;
     let pack_size = document.getElementById("pack_size").value;
     // let inv_qty = document.getElementById("inv_qty").value;
     /* authentication */
     if(pack_qty.length == 0 || pack_qty.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please input quantity!");
          $("#pack_qty").focus();
          return;
     }else if(pack_price.length == 0 || pack_price.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please input unit price!");
          $("#pack_price").focus();
          return;
     }else if(pack_qty <= 0 ){
          alert("Qauntity cannot be zero or negative!");
          $("#pack_qty").focus();
          return;
     }else if(pack_price <= 0){
          alert("Price cannot be zero or negative!");
          $("#pack_price").focus();
          return;
     /* }else if(qty > inv_qty){
          alert("Available quantity is less than required!");
          $("#qty").focus();
          return; */
     }else{
          $.ajax({
               type: "POST",
               url: "../controller/sell_pack_wholesale.php",
               data: {sales_id:sales_id, pack_qty:pack_qty, pack_price:pack_price, pack_size:pack_size},
               success: function(response){
               $(".sales_order").html(response);
               }
          });

     }
     $(".show_more").html('');
     return false;
}
//check payment mode
function checkMode(mode){
     let pay_mode = mode;
     let bank_input = document.getElementById("selectBank");
     let multiples = document.getElementById("multiples");
     let paid_amount = document.getElementById("paid_amount");
     let wallet = document.getElementById("account_balance");
     if(pay_mode == "POS" || pay_mode == "Transfer"){
          bank_input.style.display = "block";
          paid_amount.style.display = "block";
          multiples.style.display = "none";
          wallet.style.display = "none";
     }else if(pay_mode == "Multiple"){
          multiples.style.display = "block";
          bank_input.style.display = "block";
          paid_amount.style.display = "none";
          wallet.style.display = "none";
     }else if(pay_mode == "Wallet"){
          wallet.style.display = "block";
          multiples.style.display = "none";
          paid_amount.style.display = "none";
          bank_input.style.display = "none";
     }else{
          bank_input.style.display = "none";
          multiples.style.display = "none";
          paid_amount.style.display = "block";
          wallet.style.display = "none";

     }
}
//check payment mode for rep sales
function checkRepMode(mode){
     let pay_mode = mode;
     let bank_input = document.getElementById("selectBank");
     let multiples = document.getElementById("multiples");
     let deposited = document.getElementById("deposited");
     let wallet = document.getElementById("account_balance");
     if(pay_mode == "POS" || pay_mode == "Transfer"){
          bank_input.style.display = "block";
          multiples.style.display = "none";
          wallet.style.display = "none";
          deposited.style.display = "none";
     }else if(pay_mode == "Multiple"){
          multiples.style.display = "block";
          bank_input.style.display = "block";
          wallet.style.display = "none";
          deposited.style.display = "none";
     }else if(pay_mode == "Wallet"){
          wallet.style.display = "block";
          multiples.style.display = "none";
          bank_input.style.display = "none";
          deposited.style.display = "none";
     }else if(pay_mode == "Deposit"){
          wallet.style.display = "none";
          multiples.style.display = "none";
          bank_input.style.display = "none";
          deposited.style.display = "block";

     }else{
          bank_input.style.display = "none";
          multiples.style.display = "none";
          wallet.style.display = "none";

     }
}
//post direct sales payment
function postSales(){
     let confirmPost = confirm("Are you sure you want to post this sales?", "");
     if(confirmPost){
          let total_amount = document.getElementById("total_amount").value;
          let sales_invoice = document.getElementById("sales_invoice").value;
          let discount = document.getElementById("discount").value;
          let store = document.getElementById("store").value;
          let payment_type = document.getElementById("payment_type").value;
          let bank = document.getElementById("bank").value;
          let multi_cash = document.getElementById("multi_cash").value;
          let multi_pos = document.getElementById("multi_pos").value;
          let multi_transfer = document.getElementById("multi_transfer").value;
          let sum_amount = parseInt(multi_cash) + parseInt(multi_pos) + parseInt(multi_transfer);
          if(document.getElementById("multiples").style.display == "block"){
               if(sum_amount != (parseInt(total_amount) - parseInt(discount))){
                    alert("Amount entered is not equal to total amount");
                    $("#multi_cash").focus();
                    return;
               }
          }
          if(payment_type.length == 0 || payment_type.replace(/^\s+|\s+$/g, "").length == 0){
               alert("Please select a payment option!");
               $("#payment_type").focus();
               return;
          }else if(discount.length == 0 || discount.replace(/^\s+|\s+$/g, "").length == 0){
               alert("Please enter discount value or 0!");
               $("#discount").focus();
               return;
          }else{
               $.ajax({
                    type : "POST",
                    url : "../controller/post_sales.php",
                    data : {sales_invoice:sales_invoice, payment_type:payment_type, bank:bank, multi_cash:multi_cash, multi_pos:multi_pos, multi_transfer:multi_transfer, discount:discount, store:store},
                    success : function(response){
                         $("#direct_sales").html(response);
                    }
               })
               $(".sales_order").html('');
               /* setTimeout(function(){
                    $("#direct_sales").load("direct_sales.php #direct_sales");
               }, 200);
               return false; */
          }
     // }
     }else{
          return;
     }
}
//post sales order payment
function postSalesOrder(){
     let confirmPost = confirm("Are you sure you want to post this sales?", "");
     if(confirmPost){
          let total_amount = document.getElementById("total_amount").value;
          let discount = document.getElementById("discount").value;
          // alert(total_amount);
          let sales_invoice = document.getElementById("sales_invoice").value;
          let payment_type = document.getElementById("payment_type").value;
          let bank = document.getElementById("bank").value;
          let store = document.getElementById("store").value;
          let customer_id = document.getElementById("customer_id").value;
          let multi_cash = document.getElementById("multi_cash").value;
          let multi_pos = document.getElementById("multi_pos").value;
          let multi_transfer = document.getElementById("multi_transfer").value;
          let sum_amount = parseInt(multi_cash) + parseInt(multi_pos) + parseInt(multi_transfer);
          if(document.getElementById("multiples").style.display == "block"){
               //check if total amount is greater than sum
               if(sum_amount != (total_amount - discount)){
                    alert("Amount entered is not equal to total amount");
                    $("#multi_cash").focus();
                    return;
               }
          }
          if(payment_type.length == 0 || payment_type.replace(/^\s+|\s+$/g, "").length == 0){
               alert("Please select a payment option!");
               $("#payment_type").focus();
               return;
          }else if(discount.length == 0 || discount.replace(/^\s+|\s+$/g, "").length == 0){
               alert("Please enter discount value or 0!");
               $("#discount").focus();
               return;
          }else{
               $.ajax({
                    type : "POST",
                    url : "../controller/post_sales_order.php",
                    data : {sales_invoice:sales_invoice, payment_type:payment_type, bank:bank, multi_cash:multi_cash, multi_pos:multi_pos, multi_transfer:multi_transfer, discount:discount, store:store, customer_id:customer_id},
                    success : function(response){
                         $("#sales_details").html(response);
                    }
               })
               // $(".sales_order").html('');
               /* setTimeout(function(){
                    $("#direct_sales").load("direct_sales.php #direct_sales");
               }, 200);
               return false; */
          }
     }else{
          return;
     }
}
//post sales order ticket
function printSalesOrder(){
     let confirmPost = confirm("Are you sure you want to post this sales?", "");
     if(confirmPost){
          let sales_invoice = document.getElementById("sales_invoice").value;
          
          
          $.ajax({
               type : "POST",
               url : "../controller/post_ticket.php",
               data : {sales_invoice:sales_invoice},
               success : function(response){
                    $("#sales_order").html(response);
               }
          })
          $(".sales_order").html('');
          /* setTimeout(function(){
               $("#direct_sales").load("direct_sales.php #direct_sales");
          }, 200);
          return false; */
     }
}
// prinit transfer receipt
function printTransferReceipt(invoice){
     window.open("../controller/transfer_receipt.php?receipt="+invoice);
     // alert(item_id);
     /* $.ajax({
          type : "GET",
          url : "../controller/sales_receipt.php?receipt="+invoice,
          success : function(response){
               $("#direct_sales").html(response);
          }
     }) */
     setTimeout(function(){
          $("#direct_sales").load("direct_sales.php #direct_sales");
     }, 100);
     return false;
 
 }
//post direct wholesale payment
function postWholesale(){
     let confirmPost = confirm("Are you sure you want to post this sales?", "");
     if(confirmPost){
          let total_amount = document.getElementById("total_amount").value;
          let sales_invoice = document.getElementById("sales_invoice").value;
          let discount = document.getElementById("discount").value;
          let store = document.getElementById("store").value;
          let customer_id = document.getElementById("customer_id").value;
          let payment_type = document.getElementById("payment_type").value;
          let bank = document.getElementById("bank").value;
          let multi_cash = document.getElementById("multi_cash").value;
          let multi_pos = document.getElementById("multi_pos").value;
          let multi_transfer = document.getElementById("multi_transfer").value;
          let wallet = document.getElementById("wallet").value;
          let deposit = document.getElementById("deposit").value;
          let sum_amount = parseInt(multi_cash) + parseInt(multi_pos) + parseInt(multi_transfer);
          if(document.getElementById("multiples").style.display == "block"){
               if(sum_amount != (parseInt(total_amount) - parseInt(discount))){
                    alert("Amount entered is not equal to total amount");
                    $("#multi_cash").focus();
                    return;
               }
          }
          if(document.getElementById("account_balance").style.display == "block"){
               if(parseInt(total_amount - discount) > parseInt(wallet)){
                    alert("Insufficient balance! Kindly fund wallet");
                    $("#payment_type").focus();
                    return;
               }
          }
          if(document.getElementById("deposited").style.display == "block"){
               if(parseInt(deposit) <= 0){
                    alert("Input deposit amount");
                    $("#deposit").focus();
                    return;
               }
               if(deposit.length == 0 || deposit.replace(/^\s+|\s+$/g, "").length == 0){
                    alert("Please input deposited amount!");
                    $("#deposit").focus();
                    return;
               }
          }
          if(payment_type.length == 0 || payment_type.replace(/^\s+|\s+$/g, "").length == 0){
               alert("Please select a payment option!");
               $("#payment_type").focus();
               return;
          }else if(discount.length == 0 || discount.replace(/^\s+|\s+$/g, "").length == 0){
               alert("Please enter discount value or 0!");
               $("#discount").focus();
               return;
          }else{
               $.ajax({
                    type : "POST",
                    url : "../controller/post_wholesale.php",
                    data : {sales_invoice:sales_invoice, payment_type:payment_type, bank:bank, multi_cash:multi_cash, multi_pos:multi_pos, multi_transfer:multi_transfer, discount:discount, wallet:wallet, store:store, deposit:deposit, customer_id:customer_id},
                    success : function(response){
                         $("#direct_sales").html(response);
                    }
               })
               $(".sales_order").html('');
               /* setTimeout(function(){
                    $("#direct_sales").load("direct_sales.php #direct_sales");
               }, 200);
               return false; */
          }
     // }
     }else{
          return;
     }
}
//post direct repsale payment
function postRepsale(){
     let confirmPost = confirm("Are you sure you want to post this sales?", "");
     if(confirmPost){
          let total_amount = document.getElementById("total_amount").value;
          let sales_invoice = document.getElementById("sales_invoice").value;
          let discount = document.getElementById("discount").value;
          let store = document.getElementById("store").value;
          let customer_id = document.getElementById("customer_id").value;
          let payment_type = document.getElementById("payment_type").value;
          let bank = document.getElementById("bank").value;
          let multi_cash = document.getElementById("multi_cash").value;
          let multi_pos = document.getElementById("multi_pos").value;
          let multi_transfer = document.getElementById("multi_transfer").value;
          let wallet = document.getElementById("wallet").value;
          let deposit = document.getElementById("deposit").value;
          let sum_amount = parseInt(multi_cash) + parseInt(multi_pos) + parseInt(multi_transfer);
          if(document.getElementById("multiples").style.display == "block"){
               if(sum_amount != (parseInt(total_amount) - parseInt(discount))){
                    alert("Amount entered is not equal to total amount");
                    $("#multi_cash").focus();
                    return;
               }
          }
          if(document.getElementById("account_balance").style.display == "block"){
               if(parseInt(total_amount - discount) > parseInt(wallet)){
                    alert("Insufficient balance! Kindly fund wallet");
                    $("#payment_type").focus();
                    return;
               }
          }
          if(document.getElementById("deposited").style.display == "block"){
               if(parseInt(deposit) <= 0){
                    alert("Input deposit amount");
                    $("#deposit").focus();
                    return;
               }
               if(deposit.length == 0 || deposit.replace(/^\s+|\s+$/g, "").length == 0){
                    alert("Please input deposited amount!");
                    $("#deposit").focus();
                    return;
               }
          }
          if(payment_type.length == 0 || payment_type.replace(/^\s+|\s+$/g, "").length == 0){
               alert("Please select a payment option!");
               $("#payment_type").focus();
               return;
          }else if(discount.length == 0 || discount.replace(/^\s+|\s+$/g, "").length == 0){
               alert("Please enter discount value or 0!");
               $("#discount").focus();
               return;
          }else{
               $.ajax({
                    type : "POST",
                    url : "../controller/post_repsale.php",
                    data : {sales_invoice:sales_invoice, payment_type:payment_type, bank:bank, multi_cash:multi_cash, multi_pos:multi_pos, multi_transfer:multi_transfer, discount:discount, wallet:wallet, store:store, deposit:deposit,  customer_id:customer_id},
                    success : function(response){
                         $("#direct_sales").html(response);
                    }
               })
               $(".sales_order").html('');
               /* setTimeout(function(){
                    $("#direct_sales").load("direct_sales.php #direct_sales");
               }, 200);
               return false; */
          }
     // }
     }else{
          return;
     }
}
 //adjust item quantity
 function adjustReorderLevel(){
     let item_id = document.getElementById("item_id").value;
     let rol = document.getElementById("rol").value;
     if(rol.length == 0 || rol.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please input reorder level!");
          $("#rol").focus();
          return;
     }else{
          $.ajax({
               type : "POST",
               url : "../controller/reorder_level.php",
               data: {item_id:item_id, rol:rol},
               success : function(response){
                    $("#reorder_levels").html(response);
               }
          })
          setTimeout(function(){
               $("#reorder_levels").load("reorder_level.php #reorder_levels");
          }, 2000);
          return false
     }
 }

 //display sales return form
function displaySales(sales_id){
     // alert(item_id);
     $.ajax({
          type : "GET",
          url : "../controller/get_sales.php?sales_id="+sales_id,
          success : function(response){
               $(".select_date").html(response);
               window.scrollTo(0, 0);

          }
     })
     return false;
 
 }
 //sales return
 function returnSales(){
     let return_sales = confirm("Are you sure you want to return this sales?", "");
     if(return_sales){
          let item = document.getElementById("item").value;
          let sold_qty = document.getElementById("sold_qty").value;
          let sales_id = document.getElementById("sales_id").value;
          let user_id = document.getElementById("user_id").value;
          let store = document.getElementById("store").value;
          let quantity = document.getElementById("quantity").value;
          let reason = document.getElementById("reason").value;
          let expiration = document.getElementById("expiration").value;
          let todayDate = new Date();
          let today = todayDate.toLocaleDateString();
          if(quantity.length == 0 || quantity.replace(/^\s+|\s+$/g, "").length == 0){
               alert("Please input quantity!");
               $("#quantity").focus();
               return;
          }else if(parseInt(quantity) > parseInt(sold_qty)){
               alert("You cannot return more than what was sold!");
               $("#quantity").focus();
               return;
          }else if(reason.length == 0 || reason.replace(/^\s+|\s+$/g, "").length == 0){
               alert("Please input reason for return!");
               $("#reason").focus();
               return;
          }else if(expiration.length == 0 || expiration.replace(/^\s+|\s+$/g, "").length == 0){
               alert("Please input item expiration date!");
               $("#expiration").focus();
               return;
          }else if(new Date(today).getTime() > new Date(expiration).getTime()){
               alert("You can not stock in expired items!");
               $("#expiration").focus();
               return;
          }else{
               $.ajax({
                    type : "POST",
                    url : "../controller/return_sales.php",
                    data: {item:item, sales_id:sales_id, user_id:user_id, quantity:quantity, reason:reason, store:store, expiration:expiration},
                    success : function(response){
                         $("#sales_return").html(response);
                    }
               })
               setTimeout(function(){
                    $("#sales_return").load("sales_return.php #sales_return");
               }, 3000);
               return false
          }
     }else{
          return;
     }
}


// reprint receipt
function printReceipt(invoice){
     // alert(item_id);
     window.open("../controller/print_receipt.php?receipt="+invoice);
     /* $.ajax({
          type : "GET",
          url : "../controller/print_receipt.php?receipt="+invoice,
          success : function(response){
               $("#printReceipt").html(response);
          }
     })
     setTimeout(function(){
          $("#printReceipt").load("print_receipt.php #printReceipt");
     }, 100);
     return false; */
 
 }

// prinit sales receipt for direct sales
function printSalesReceipt(invoice){
     window.open("../controller/sales_receipt.php?receipt="+invoice);
     // alert(item_id);
     /* $.ajax({
          type : "GET",
          url : "../controller/sales_receipt.php?receipt="+invoice,
          success : function(response){
               $("#direct_sales").html(response);
          }
     }) */
     /* setTimeout(function(){
          $("#direct_sales").load("direct_sales.php #direct_sales");
     }, 100); */
     return false;
 
 }
// prinit sales receipt for sales order
function printSalesOrderReceipt(invoice){
     window.open("../controller/sales_order_receipt.php?receipt="+invoice);
     showPage('post_sales_order.php');
     // alert(item_id);
     /* $.ajax({
          type : "GET",
          url : "../controller/sales_order_receipt.php?receipt="+invoice,
          success : function(response){
               $("#sales_details").html(response);
          }
     }) */
     /* setTimeout(function(){
          $("#direct_sales").load("direct_sales.php #direct_sales");
     }, 100);
     return false; */
 
 }
// prinit sales order ticket
function printSalesTicket(invoice){
     window.open("../controller/sales_order_ticket.php?receipt="+invoice);
     
     setTimeout(function(){
          $("#sales_order").load("sales_order.php #sales_order");
     }, 100);
     return false;
 
 }
 //perform any type of search with just two date
 function search(url){
     let from_date = document.getElementById('from_date').value;
     let to_date = document.getElementById('to_date').value;
     /* authentication */
     if(from_date.length == 0 || from_date.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please select a date!");
          $("#from_date").focus();
          return;
     }else if(to_date.length == 0 || to_date.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please select a date range!");
          $("#to_date").focus();
          return;
     }else{
          $.ajax({
               type: "POST",
               url: "../controller/"+url,
               data: {from_date:from_date, to_date:to_date},
               success: function(response){
               $(".new_data").html(response);
               }
          });
     }
     return false;
}
 //search dashboard reports
 function searchDashboard(board){
     let store = board;
     /* authentication */
     if(store.length == 0 || store.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please select a store!");
          $("#store").focus();
          return;
    /*  }else if(from_date.length == 0 || from_date.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please select a date!");
          $("#from_date").focus();
          return;
     }else if(to_date.length == 0 || to_date.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please select a date range!");
          $("#to_date").focus();
          return; */
     }else{
          $.ajax({
               type: "POST",
               url: "../controller/search_dashboard.php",
               data: {store:store},
               success: function(response){
               $("#general_dashboard").html(response);
               }
          });
     }
     return false;
}
//change store
function changeStore(store, user){
     window.open("../controller/change_store.php?store="+store+"&user="+user, "_self");
}
// Post daily expense 
function postExpense(){
     let posted = document.getElementById("posted").value;
     let store = document.getElementById("store").value;
     let exp_date = document.getElementById("exp_date").value;
     let exp_head = document.getElementById("exp_head").value;
     let amount = document.getElementById("amount").value;
     let details = document.getElementById("details").value;
     if(exp_date.length == 0 || exp_date.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please enter transaction date!");
          $("#exp_date").focus();
          return;
     }else if(exp_head.length == 0 || exp_head.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please select an expense head").focus();
          $("#exp_head").focus();
          return;
     }else if(amount.length == 0 || amount.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please input transaction amount");
          $("#amount").focus();
          return;
     }else if(details.length == 0 || details.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please enter description of transaction");
          $("#details").focus();
          return;
     }else{
          $.ajax({
               type : "POST",
               url : "../controller/post_expense.php",
               data : {posted:posted, exp_date:exp_date, exp_head:exp_head, amount:amount, details:details, store:store},
               success : function(response){
               $(".info").html(response);
               }
          })
     }
     $("#exp_date").val('');
     $("#exp_head").val('');
     $("#amount").val('');
     $("#details").val('');
     $("#exp_date").focus();
     return false;    
}


//add reasons for removal
function addReason(){
     let reason = document.getElementById("reason").value;
     if(reason.length == 0 || reason.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please input reason!");
          $("#reason").focus();
          return;
     }else{
          $.ajax({
               type : "POST",
               url : "../controller/add_reason.php",
               data : {reason:reason},
               success : function(response){
               $(".info").html(response);
               }
          })
     }
     $("#reason").val('');
     $("#reason").focus();
     return false;
}
//  get item history
function getItemHistory(item){
     let from_date = document.getElementById('from_date').value;
     let to_date = document.getElementById('to_date').value;
     let history_item = item;
     /* authentication */
     if(from_date.length == 0 || from_date.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please select a date!");
          $("#from_date").focus();
          return;
     }else if(to_date.length == 0 || to_date.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please select a date range!");
          $("#to_date").focus();
          return;
     }else if(history_item.length == 0 || history_item.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please select an item!");
          $("#history_item").focus();
          return;
     }else{
          $.ajax({
               type: "POST",
               url: "../controller/get_history.php",
               data: {from_date:from_date, to_date:to_date, history_item:history_item},
               success: function(response){
               $(".new_data").html(response);
               }
          });
          $("#sales_item").html('');
          $("#history_item").val('');
     }
     return false;
}

// get sub menus to add to rights
function getSubmenu(menu_id){
     let menu = menu_id;
     // alert(menu_id);
     // return;
     if(menu_id){
          $.ajax({
               type : "POST",
               url :"../controller/get_submenu.php",
               data : {menu:menu},
               success : function(response){
                    $("#sub_menu").html(response);
               }
          })
          return false;
     }else{
          $("#sub_menu").html("<option value'' selected>Select a menu first</option>")
     }
     
}
// get user rights
function getRights(user_id){
     let user = user_id;;
     if(user){
          $.ajax({
               type : "POST",
               url :"../controller/get_rights.php",
               data : {user:user},
               success : function(response){
                    $(".rights").html(response);
               }
          })
          return false;
     }else{
          $(".rights").html("<h3>Select a user</h3>")
     }
     
}
//add user rights
function addRights(right){
     let sub_menu = right;
     let menu = document.getElementById("menu").value;
     let user = document.getElementById("user").value;
     if(user.length == 0 || user.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please select user!");
          $("#user").focus();
          return;
     }else if(menu.length == 0 || menu.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please select a menu!");
          $("#menu").focus();
          return;
     }else{
          $.ajax({
               type : "POST",
               url : "../controller/add_right.php",
               data : {user:user, menu:menu, sub_menu:sub_menu},
               success : function(response){
                    $(".info").html(response);
                    getRights(user);
               }              
          })
          return false;
     }

}
//delete right from user
function removeRight(right, user){
     let remove = confirm("Do you want to remove this right from the user?", "");
     if(remove){
          $.ajax({
               type : "GET",
               url : "../controller/delete_right.php?right="+right,
               success : function(response){
                    $(".info").html(response);
                    getRights(user);

               }
          })
     }else{
          return;
     }
}

/* download any table data to excel */
function convertToExcel(table, title){
     $(`#${table}`).table2excel({
          filename: title
     });
}

//show help
/* show frequenty asked questions */
function showFaq(answer){
     let all_answers = document.querySelectorAll(".faq_notes");
     all_answers.forEach(function(notes){
          notes.style.display = "none";
     })
     document.getElementById(answer).style.display = "block";
}

//display items in revenue by category for current date
function viewItems(department_id){
     let department = department_id;
     $.ajax({
          type : "Get",
          url : "../controller/view_revenue_cat_items.php?department="+department,
          success : function(response){
               $(".category_info").html(response);
          }
     })
     return false;
}
//display items in revenue by category for current date
function viewItemsDate(from, to, department_id){
     let department = department_id;
     $.ajax({
          type : "Get",
          url : "../controller/view_revenue_cat_items_date.php?department="+department+"&from="+from+"&to="+to,
          success : function(response){
               $(".category_info").html(response);
          }
     })
     return false;
}

//give discount
function giveDiscount(){
     discount = document.getElementById("discount").value;
     discount_invoice = document.getElementById("discount_invoice").value;
     discount_total = document.getElementById("discount_total").value;
     if(discount.replace(/^\s+|\s+$/g, "").length == 0){
          alert("please enter a discount value!");
          return;
     }else{
          $.ajax({
               type : "POST",
               url : "../controller/give_discount.php",
               data : {discount_invoice:discount_invoice, discount_total:discount_total, discount},
               success : function(response){
                    $(".sales_order").html(response);
               }
          })
          return false;
     }

}
//display transfer item batch
function viewBatch(item_id){
     let item = item_id;
          
          $.ajax({
               type : "GET",
               url : "../controller/get_batch_details.php?item="+item,
               success : function(response){
                    $(".info").html(response);
               }
          })
          $("#sales_item").html("");
          $("#item").val('');
          return false;
     // }
     
 }
//display dispense item batch
function viewDispenseBatch(item_id, invoice_no){
     let item = item_id;
     let invoice = invoice_no;
          $.ajax({
               type : "GET",
               url : "../controller/get_dispense_batch.php?item="+item+"&invoice="+invoice,
               success : function(response){
                    $(".info").html(response);
               }
          })
          $("#sales_item").html("");
          $("#item").val('');
          return false;
     // }
     
 }
 //delete individual transfered items from transfer
 function deleteTransfer(transfer, item){
      let confirmDel = confirm("Are you sure you want to remove this item?", "");
      if(confirmDel){
           
           $.ajax({
                type : "GET",
                url : "../controller/delete_transfer.php?transfer_id="+transfer+"&item_id="+item,
                success : function(response){
                     $(".stocked_in").html(response);
                }
                
           })
           return false;
      }else{
           return;
      }
 }
 //delete individual dispensed items from transfer
 function deleteDispense(dispense, item){
      let confirmDel = confirm("Are you sure you want to remove this item?", "");
      if(confirmDel){
           
           $.ajax({
                type : "GET",
                url : "../controller/delete_dispense.php?dispense_id="+dispense+"&item_id="+item,
                success : function(response){
                     $(".stocked_in").html(response);
                }
                
           })
           return false;
      }else{
           return;
      }
 }

//post transfer
function postTransfer(invoice_number){
     invoice = invoice_number;
     confirmPost = confirm("Are you sure to post this transfer?", "");
     if(confirmPost){
          $.ajax({
               method : "GET",
               url : "../controller/post_transfer.php?invoice="+invoice,
               success : function(response){
                    $("#stockin").html(response);
               }
          })
          return false;
     }else{
          return;
     }
}
//post transfer
function postDispense(invoice_number){
     invoice = invoice_number;
     confirmPost = confirm("Are you sure to post this dispense?", "");
     if(confirmPost){
          $.ajax({
               method : "GET",
               url : "../controller/post_dispense.php?invoice="+invoice,
               success : function(response){
                    $("#stockin").html(response);
               }
          })
          return false;
     }else{
          return;
     }
}
//Accept items transferred
function acceptItem(invoice_number){
     invoice = invoice_number;
     confirmPost = confirm("Are you sure to accept this item?", "");
     if(confirmPost){
          $.ajax({
               method : "GET",
               url : "../controller/accept_item.php?transfer_id="+invoice,
               success : function(response){
                    $("#accept_item").html(response);
               }
          })
          setTimeout(function(){
               $("#accept_item").load("accept_items.php #accept_item");
          }, 2000);
          return false
     }else{
          return;
     }
}
//Reject items transferred
function rejectItem(invoice_number){
     invoice = invoice_number;
     confirmPost = confirm("Are you sure to reject this item?", "");
     if(confirmPost){
          $.ajax({
               method : "GET",
               url : "../controller/reject_item.php?transfer_id="+invoice,
               success : function(response){
                    $("#accept_item").html(response);
               }
          })
          setTimeout(function(){
               $("#accept_item").load("accept_items.php #accept_item");
          }, 2000);
          return false
     }else{
          return;
     }
}
//Get stock balance by store
function getStockBalance(store_id){
     store = store_id;
     $.ajax({
          method : "POST",
          url : "../controller/get_stock_balance.php",
          data : {store:store},
          success : function(response){
               $(".store_balance").html(response);
          }
     })
     return false
     
}
//toggle service access
function toggleService(){
     // $("#services").toggle();
     if(document.getElementById("services").style.display == "flex"){
          document.getElementById("services").style.display = "none";
          $("#sales_item").html("");
          $(".sales_order").html("");
          $("#item").val("");
     }else{ 
          document.getElementById("services").style.display = "flex";
          document.getElementById("add_inv").scrollIntoView();

     }
}
// Register new patient
function NewRegistration(){
     let last_name = document.getElementById("last_name").value;
     let other_names = document.getElementById("other_names").value;
     let phone_number = document.getElementById("phone_number").value;
     let dob = document.getElementById("dob").value;
     let invoice = document.getElementById("invoice").value;
     // let suffix = document.getElementById("suffix").value;
     let title = document.getElementById("title").value;
     let gender = document.getElementById("gender").value;
     let marital_status = document.getElementById("marital_status").value;
     let religion = document.getElementById("religion").value;
     let occupation = document.getElementById("occupation").value;
     let address = document.getElementById("address").value;
     let email = document.getElementById("email").value;
     let nok = document.getElementById("nok").value;
     let nok_relation = document.getElementById("nok_relation").value;
     let nok_address = document.getElementById("nok_address").value;
     let nok_phone = document.getElementById("nok_phone").value;
     let category = document.getElementById("category").value;
     /* let services = document.getElementById("services");
     let amount_due = document.getElementById("amount_due").value; */
     let sponsor = document.getElementById("sponsor").value;
     /* let registration = document.getElementById("registration").value;
     let service_amount = document.getElementById("service_amount").value;
     let service = document.getElementById("service").value;
     let main_service = document.getElementById("main_service").value;
     let doctor = document.getElementById("doctor").value; */
     if(category != "Private"){
          if(sponsor.length == 0 || sponsor.replace(/^\s+|\s+$/g, "").length == 0){
               alert("Please select patient sponsor!");
               $("#sponsor").focus();
               return;
          }
     }
     /* if(services.style.display == "flex"){
          if(item.length == 0 || item.replace(/^\s+|\s+$/g, "").length == 0){
               alert("Please select investigation!");
               $("#item").focus();
               return;
          }
          
     } */
     let todayDate = new Date();
     let today = todayDate.toLocaleDateString();
     if(last_name.length == 0 || last_name.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please enter last name!");
          $("#last_name").focus();
          return;
     }else if(other_names.length == 0 || other_names.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please enter other names!");
          $("#other_names").focus();
          return;
     }else if(title.length == 0 || title.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please select title!");
          $("#title").focus();
          return;
     }else if(gender.length == 0 || gender.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please select Gender!");
          $("#gender").focus();
          return;
     }else if(email.length == 0 || email.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please input patient's email address");
          $("#email").focus();
          return;
     }else if(phone_number.length == 0 || phone_number.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please enter patient phone number");
          $("#phone_number").focus();
          return;
     }else if(phone_number.length != 11){
          alert("Phone number is not correct");
          $("#phone_number").focus();
          return;
    
     }else if(dob.length == 0 || dob.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please enter date of birth");
          $("#dob").focus();
          return;
     }else if(address.length == 0 || address.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please input customer address");
          $("#address").focus();
          return;
    /*  }else if(occupation.length == 0 || occupation.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please input occupation");
          $("#occupation").focus();
          return; */
     }else if(marital_status.length == 0 || marital_status.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please input patient's marital status");
          $("#marital_status").focus();
          return;
     /* }else if(religion.length == 0 || religion.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please select patient's Religion");
          $("#religion").focus();
          return; */
     }else if(nok_address.length == 0 || nok_address.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please input patient's Next of Kin address");
          $("#nok_address").focus();
          return;
     }else if(nok.length == 0 || nok.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please input patient's Next of Kin");
          $("#nok").focus();
          return;
     }else if(nok_phone.length == 0 || nok_phone.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please input patient's Next of Kin phone number");
          $("#nok_phone").focus();
          return;
     }else if(nok_relation.length == 0 || nok_relation.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please input Next of Kin relationship");
          $("#nok_relation").focus();
          return;
     /* }else if(amount_due.length == 0 || amount_due.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please select patient category to get price");
          $("#category").focus();
          return; */
     }else if(new Date(today).getTime() <= new Date(dob).getTime()){
          alert("You can not enter a futuristic date !");
          $("#dob").focus();
          return;
     }else{
          $.ajax({
               type : "POST",
               url : "../controller/new_registration.php",
               data : {other_names:other_names, last_name:last_name, phone_number:phone_number, email:email, address:address, dob:dob, /* suffix:suffix,  */title:title, gender:gender, marital_status:marital_status, religion:religion, occupation:occupation, nok:nok, nok_address:nok_address,nok_phone:nok_phone, nok_relation:nok_relation, category:category, sponsor:sponsor, invoice:invoice/*  service:service, registration:registration, service_amount:service_amount, main_service:main_service, amount_due:amount_due, doctor:doctor */},
               success : function(response){
                    $("#new_reg").html(response);
               }
          })
          /* $("#last_name").val('');
          $("#other_names").val('');
          $("#email").val('');
          $("#address").val('');
          $("#dob").val('');
          $("#phone_number").val('');
          $("#last_name").focus(); */
          setTimeout(function(){
               $("#change_sub_menu").load("edit_sub_menu.php #change_sub_menu");
          }, 1000);
          return false;   
     }
      
}

//post other payments
//post other Transfer payments for guest
function postOtherPayment(){
     let mode = document.getElementById("mode").value;
     let posted = document.getElementById("posted").value;
     let customer = document.getElementById("customer").value;
     let invoice = document.getElementById("invoice").value;
     let amount = document.getElementById("amount").value;
     
     $.ajax({
          type : "POST",
          url : "../controller/post_other_payments.php",
          data : {posted:posted, customer:customer, mode:mode, amount:amount, invoice:invoice},
          success : function(response){
               $("#debt_payment").html(response);
          }
     })
     
     return false;    

}

//add menu
function addMenu(){
     let menu = document.getElementById("menu").value;
     if(menu.length == 0 || menu.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please input menu!");
          $("#menu").focus();
          return;
     }else{
          $.ajax({
               type : "POST",
               url : "../controller/add_menu.php",
               data : {menu:menu},
               success : function(response){
               $(".info").html(response);
               }
          })
     }
     $("#menu").val('');
     $("#menu").focus();
     return false;
}
//add staff designation
function addDesignation(){
     let designation = document.getElementById("designation").value;
     if(designation.length == 0 || designation.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please input designation!");
          $("#designation").focus();
          return;
     }else{
          $.ajax({
               type : "POST",
               url : "../controller/add_designation.php",
               data : {designation:designation},
               success : function(response){
               $(".info").html(response);
               }
          })
     }
     $("#designation").val('');
     $("#designation").focus();
     return false;
}
//add staff discipline
function addDiscipline(){
     let discipline = document.getElementById("discipline").value;
     if(discipline.length == 0 || discipline.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please input discipline!");
          $("#discipline").focus();
          return;
     }else{
          $.ajax({
               type : "POST",
               url : "../controller/add_discipline.php",
               data : {discipline:discipline},
               success : function(response){
               $(".info").html(response);
               }
          })
     }
     $("#discipline").val('');
     $("#discipline").focus();
     return false;
}
//add user role
function addRole(){
     let role = document.getElementById("role").value;
     if(role.length == 0 || role.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please input user role!");
          $("#role").focus();
          return;
     }else{
          $.ajax({
               type : "POST",
               url : "../controller/add_role.php",
               data : {role:role},
               success : function(response){
               $(".info").html(response);
               }
          })
     }
     $("#role").val('');
     $("#role").focus();
     return false;
}
//add sub-menu
function addSubMenu(){
     let menus = document.getElementById("menus").value;
     let sub_menu = document.getElementById("sub_menu").value;
     let sub_menu_url = document.getElementById("sub_menu_url").value;
     if(menus.length == 0 || menus.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please select menu!");
          $("#menus").focus();
          return;
     }else if(sub_menu.length == 0 || sub_menu.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please input sub-menu!");
          $("#sub_menu").focus();
          return;
     }else if(sub_menu_url.length == 0 || sub_menu_url.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please input sub-menu url!");
          $("#sub_menu_url").focus();
          return;
     }else{
          $.ajax({
               type : "POST",
               url : "../controller/add_sub_menu.php",
               data : {menus:menus, sub_menu:sub_menu, sub_menu_url:sub_menu_url},
               success : function(response){
               $(".info").html(response);
               }
          })
     }
     // $("#menus").val('');
     $("#sub_menu").val('');
     $("#sub_menu_url").val('');
     $("#sub_menu").focus();
     return false;
}
//update submenu details
function updateSubMenu(){
     let sub_menu_id = document.getElementById("sub_menu_id").value;
     let menu = document.getElementById("menu").value;
     let sub_menu = document.getElementById("sub_menu").value;
     let url = document.getElementById("url").value;
     let status = document.getElementById("status").value;
     if(menu.length == 0 || menu.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please select menuy!");
          $("#menu").focus();
          return;
     }else if(sub_menu.length == 0 || sub_menu.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please input sub-menu!");
          $("#sub_menu").focus();
          return;
     }else if(url.length == 0 || url.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please input sub-menu url!");
          $("#url").focus();
          return;
     }else if(status.length == 0 || status.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please input sub-menu status!");
          $("#status").focus();
          return;
     }else{
          $.ajax({
               type : "POST",
               url : "../controller/update_submenu.php",
               data: {sub_menu_id:sub_menu_id, menu:menu, sub_menu:sub_menu, url:url, status:status},
               success : function(response){
                    $("#change_sub_menu").html(response);
               }
          })
          setTimeout(function(){
               $("#change_sub_menu").load("edit_sub_menu.php #change_sub_menu");
          }, 1000);
          return false
     }
 }
 //get customer on key press
function getCustomers(input){
     $("#search_results").show();
     if(input.length >= 3){
          $.ajax({
               type : "POST",
               url : "../controller/get_customer_name.php?input="+input,
               success : function(response){
                    $("#search_results").html(response);
               }
          })
     }
     
}
 //get customer on key press for editing
function getCustomerEdit(input){
     $("#search_results").show();
     if(input.length >= 3){
          $.ajax({
               type : "POST",
               url : "../controller/get_customer_edit.php?input="+input,
               success : function(response){
                    $("#search_results").html(response);
               }
          })
     }
     
}
// update customer details
function updateCustomer(){
     let patient_id = document.getElementById("patient_id").value;
     let last_name = document.getElementById("last_name").value;
     let other_names = document.getElementById("other_names").value;
     let phone_number = document.getElementById("phone_number").value;
     let address = document.getElementById("address").value;
     let email = document.getElementById("email").value;
     let dob = document.getElementById("dob").value;
     let suffix = document.getElementById("suffix").value;
     let title = document.getElementById("title").value;
     let gender = document.getElementById("gender").value;
     let marital_status = document.getElementById("marital_status").value;
     let religion = document.getElementById("religion").value;
     let occupation = document.getElementById("occupation").value;
     let nok = document.getElementById("nok").value;
     let nok_relation = document.getElementById("nok_relation").value;
     let nok_address = document.getElementById("nok_address").value;
     let nok_phone = document.getElementById("nok_phone").value;
     let todayDate = new Date();
     let today = todayDate.toLocaleDateString();
     if(last_name.length == 0 || last_name.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please enter last name!");
          $("#last_name").focus();
          return;
     }else if(other_names.length == 0 || other_names.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please enter Other names!");
          $("#other_names").focus();
          return;
     }else if(gender.length == 0 || gender.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please select gender");
          $("#other_names").focus();
          return;
     }else if(marital_status.length == 0 || marital_status.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please select marital status");
          $("#marital_status").focus();
          return;
     }else if(nok.length == 0 || nok.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please enter next of kin name");
          $("#nok").focus();
          return;
     }else if(nok_phone.length == 0 || nok_phone.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please enter next of kin phone number");
          $("#nok_phone").focus();
          return;
     }else if(phone_number.length == 0 || phone_number.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please enter patient phone number").focus();
          $("#phone_number").focus();
          return;
     }else if(phone_number.length != 11){
          alert("Phone NUmber is not correct").focus();
          $("#phone_number").focus();
          return;
     }else if(nok_phone.length != 11){
          alert("Next of kin Phone Number is not correct").focus();
          $("#nok_phone").focus();
          return;
     }else if(dob.length == 0 || dob.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please senter date of birth").focus();
          $("#dob").focus();
          return;
    /*  }else if(address.length == 0 || address.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please input customer address");
          $("#address").focus();
          return;
     }else if(email.length == 0 || email.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please enter customer email address");
          $("#email").focus();
          return; */
     }else if(new Date(today).getTime() <= new Date(dob).getTime()){
          alert("You can not enter a futuristic date !");
          $("#dob").focus();
          return;
     }else{
          $.ajax({
               type : "POST",
               url : "../controller/update_customer.php",
               data : {patient_id:patient_id, last_name:last_name, other_names:other_names, phone_number:phone_number, email:email, address:address, dob:dob, gender:gender, title:title, suffix:suffix, marital_status:marital_status, religion:religion, occupation:occupation, nok:nok, nok_address:nok_address, nok_phone:nok_phone, nok_relation:nok_relation},
               success : function(response){
               $("#edit_customer").html(response);
               }
          })
     }
     setTimeout(function(){
          $("#edit_customer").load("edit_customer.php?customer="+patient_id+ "#edit_customer");
     }, 1000);

     return false;    
}
 //get vendor on key press for editing
function getVendorEdit(input){
     $("#search_results").show();
     if(input.length >= 3){
          $.ajax({
               type : "POST",
               url : "../controller/get_vendor_edit.php?input="+input,
               success : function(response){
                    $("#search_results").html(response);
               }
          })
     }
     
}
// update vendor details
function updateVendor(){
     let vendor_id = document.getElementById("vendor_id").value;
     let vendor = document.getElementById("vendor").value;
     let phone_number = document.getElementById("phone_number").value;
     let contact = document.getElementById("contact").value;
     let email = document.getElementById("email").value;
     if(vendor.length == 0 || vendor.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please enter vendor name!");
          $("#vendor").focus();
          return;
     }else if(phone_number.length == 0 || phone_number.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please enter customer phone number").focus();
          $("#phone_number").focus();
          return;
     
     }else{
          $.ajax({
               type : "POST",
               url : "../controller/update_vendor.php",
               data : {vendor_id:vendor_id, vendor:vendor, phone_number:phone_number, email:email, contact:contact},
               success : function(response){
               $("#edit_customer").html(response);
               }
          })
     }
     setTimeout(function(){
          $("#edit_customer").load("edit_supplier_info.php #edit_customer");
     }, 1000);

     return false;    
}

 //pay debt
 function payDebt(invoice, customer, balance, amount_owed){
     if(parseFloat(amount_owed) > parseFloat(balance)){
          alert("Insufficient balance! Kindly fund customer wallet to continue");
          return;
     }else{
          let confirm_pay = confirm("Are you sure to complete this transaction?", "");
          if(confirm_pay){
               $.ajax({
                    type : "GET",
                    url : "../controller/pay_debt.php?receipt="+invoice+"&customer="+customer+"&amount_owed="+amount_owed,
                    success : function(response){
                         $("#pay_debts").html(response);
                    }
               })
               setTimeout(() => {
                    $("#pay_debts").load("debt_payment.php?customer="+customer + "#pay_debts");
               }, 1500);
               return false;
          }else{
               return;
          }
     }
}

//reverse deposits
function reverseDeposit(deposit, customer){
     let confirm_reverse = confirm("Are you sure you want to reverse this transaction?", "");
     if(confirm_reverse){
          $.ajax({
               type : "GET",
               url : "../controller/reverse_deposit.php?deposit_id="+deposit+"&customer="+customer,
               success : function(response){
                    $("#reverse_dep").html(response);
               }
          })
          setTimeout(() => {
               $("#reverse_dep").load("reverse_deposit.php #reverse_dep");
          }, 1500);
          return false;
          
     }else{
          return;
     }
}
// Fund customer wallet via deposit 
function deposit(){
     let invoice = document.getElementById("invoice").value;
     let posted = document.getElementById("posted").value;
     let customer = document.getElementById("customer").value;
     let store = document.getElementById("store").value;
     let amount = document.getElementById("amount").value;
     let payment_mode = document.getElementById("payment_mode").value;
     let details = document.getElementById("details").value;
     if(payment_mode.length == 0 || payment_mode.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please select payment_mode!");
          $("#exp_date").focus();
          return;
     }else if(amount.length == 0 || amount.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please input transaction amount");
          $("#amount").focus();
          return;
     }else if(details.length == 0 || details.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please enter description of transaction");
          $("#details").focus();
          return;
     }else{
          $.ajax({
               type : "POST",
               url : "../controller/deposit.php",
               data : {posted:posted, customer:customer, payment_mode:payment_mode, amount:amount, details:details, store:store, invoice:invoice},
               success : function(response){
               $("#fund_account").html(response);
               }
          })
     }
     return false;    
}

// prinit deposit receipt for fund wallet
function printDepositReceipt(invoice){
     window.open("../controller/deposit_receipt.php?receipt="+invoice);
     // alert(item_id);
     /* $.ajax({
          type : "GET",
          url : "../controller/sales_receipt.php?receipt="+invoice,
          success : function(response){
               $("#direct_sales").html(response);
          }
     }) */
     /* setTimeout(function(){
          $("#direct_sales").load("direct_sales.php #direct_sales");
     }, 100); */
     return false;
 
 }
 //get item to check history
function getHistoryItems(item_name){
     let item = item_name;
     if(item.length >= 3){
          if(item){
               $.ajax({
                    type : "POST",
                    url :"../controller/get_history_items.php",
                    data : {item:item},
                    success : function(response){
                         $("#sales_item").html(response);
                    }
               })
               return false;
          }else{
               $("#sales_item").html("<p>Please enter atleast 3 letters</p>");
          }
     }
     
}

//get item to change details
function getItemDetails(item_name, url){
     let item = item_name;
     if(item.length >= 2){
          if(item){
               $.ajax({
                    type : "POST",
                    url :"../controller/"+url,
                    data : {item:item},
                    success : function(response){
                         $("#sales_item").html(response);
                    }
               })
               return false;
          }else{
               $("#sales_item").html("<p>Please enter atleast 3 letters</p>");
          }
     }
     
}
//get order to change details
function getOrderDetails(item_name, url){
     let order = item_name;
     if(order.length >= 3){
          if(order){
               $.ajax({
                    type : "POST",
                    url :"../controller/"+url,
                    data : {order:order},
                    success : function(response){
                         $("#transfer_item").html(response);
                    }
               })
               return false;
          }else{
               $("#transfer_item").html("<p>Please enter atleast 3 letters</p>");
          }
     }
     
}
//get sales rep
function getSalesRep(customer_id){
     let customer = customer_id;
     let fromDate = document.getElementById("fromDate").value;
     let toDate = document.getElementById("toDate").value;
     if(fromDate.length == 0 || fromDate.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please select a date range!");
          $("#fromDate").focus();
          return;
     }else if(toDate.length == 0 || toDate.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please select a date range!");
          $("#toDate").focus();
          return;
     }else{
     if(customer.length >= 3){
          if(customer){
               $.ajax({
                    type : "POST",
                    url :"../controller/get_sales_rep.php",
                    data : {customer:customer, fromDate:fromDate, toDate:toDate},
                    success : function(response){
                         $("#sales_item").html(response);
                    }
               })
               /* $("#fromDate").attr("readonly", true);
               $("#toDate").attr("readonly", true); */
               return false;
          }else{
               $("#sales_item").html("<p>Please enter atleast 3 letters</p>");
          }
     }
}
     
}

//display customer sales rep/transaction history
function getrepStatement(customer_id){
     let customer = customer_id;
          
          $.ajax({
               type : "GET",
               url : "../controller/sales_rep_statement.php?sales_rep="+customer,
               success : function(response){
                    $("#customer_statement").html(response);
               }
          })
          $("#sales_item").html("");
          $("#customer").val("")
          return false;
     // }
     
 }

 //delete target
function deleteTarget(item){
     let confirmDel = confirm("Are you sure you want to remove this target?", "");
     if(confirmDel){
          
          $.ajax({
               type : "GET",
               url : "../controller/delete_target.php?target="+item,
               success : function(response){
                    $("$monthly_target").html(response);
               }
               
          })
          setTimeout(function(){
               $("#monthly_target").load("monthly_target.php #monthly_target");
          }, 1500);
          return false;
     }else{
          return;
     }
}
// Add new prescription
function addPrescription(){
     let customer = document.getElementById("customer").value;
     let drug_class = document.getElementById("drug_class").value;
     let visit_no = document.getElementById("visit_no").value;
     let details = document.getElementById("details").value;
     let invoice = document.getElementById("invoice").value;
     let drug = document.getElementById("drug").value;
     let dosage = document.getElementById("dosage").value;
     let frequency = document.getElementById("frequency").value;
     let duration = document.getElementById("duration").value;
     let quantity = document.getElementById("quantity").value;
     let route = document.getElementById("route").value;
     
     if(details.length == 0 || details.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please enter prescription details!");
          $("#details").focus();
          return;
     }else if(drug.length == 0 || drug.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please input drug name!");
          $("#drug").focus();
          return;
     }else if(duration.length == 0 || duration.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please input duration");
          $("#duration").focus();
          return;
     }else if(frequency.length == 0 || frequency.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please input frequency");
          $("#frequency").focus();
          return;
     }else if(dosage.length == 0 || dosage.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please input dosage!");
          $("#dosage").focus();
          return;
     }else if(quantity.length == 0 || quantity.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please input quantity!");
          $("#dosage").focus();
          return;
     }else if(route.length == 0 || quantity.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please select route!");
          $("#route").focus();
          return;
     
     }else{
          $.ajax({
               type : "POST",
               url : "../controller/add_prescription.php",
               data : {customer:customer, drug_class:drug_class, invoice:invoice, details:details, drug:drug, visit_no:visit_no, dosage:dosage, frequency:frequency, duration:duration, quantity:quantity, route:route},
               success : function(response){
               $(".sales_order").html(response);
               }
          })
     }
//     alert(customer);
     $("#order").val('');
     $("#drug").val('');
     $("#drug").focus();
     $("#details").val('');
     $("#dosage").val('');
     $("#duration").val('');
     $("#quantity").val('');
     $("#frequency").val('');
     $("#route").val('');
     return false;    
}

//get form to update prescription for a single invoice
function updatePrescrip(id){
     $.ajax({
          type : "GET",
          url : "../controller/edit_prescription.php?item="+id,
          success : function(response){
               $(".show_more").html(response);
               // window.scrollTo(0, 0);
               document.getElementById("showMore").scrollIntoView();
          }
          
     })
     return false;
}
//update prescription
function editPrescrip(){
     let prescription_id = document.getElementById("prescription_id").value;
     let invoice = document.getElementById("invoice").value;
     let drug_update = document.getElementById("drug_update").value;
     let details_update = document.getElementById("details_update").value;
     /* authentication */
     if(drug_update.length == 0 || drug_update.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please enter drug name!");
          $("#drug_update").focus();
          return;
     }else if(details_update.length == 0 || details_update.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please enter prescription details!");
          $("#details_update").focus();
          return;
     
     }else{
          $.ajax({
               type: "POST",
               url: "../controller/update_prescription.php",
               data: {prescription_id:prescription_id, drug_update:drug_update, details_update:details_update, invoice:invoice},
               success: function(response){
               $(".sales_order").html(response);
               }
          });

     }
     $(".show_more").html('');
     return false;
}

//delete prescription
function deletePrescrip(id, invoice){
     let confirmDel = confirm("Are you sure you want to remove this drug?", "");
     if(confirmDel){
          
          $.ajax({
               type : "GET",
               url : "../controller/delete_prescription.php?invoice="+invoice+"&item_id="+id,
               success : function(response){
                    $(".sales_order").html(response);
               }
               
          })
          return false;
     }else{
          return;
     }
}

//post prescription
function postPrescription(invoice){
     let confirmPost = confirm("Are you sure you want to post this prescription?", "");
     if(confirmPost){
          
          $.ajax({
               type : "GET",
               url : "../controller/post_prescription.php?invoice="+invoice,
               success : function(response){
                    $("#sales_order").html(response);
               }
          })
          $(".sales_order").html('');
              
     // }
     }else{
          return;
     }
}

//print prescription
function printPrescription(invoice){
     window.open("../controller/prescription_receipt.php?receipt="+invoice);
     
     return false;
 
 }
//send prescription via mail
function sendMail(invoice){
     window.open("../controller/send_prescription.php?receipt="+invoice);
     
     return false;
 
 }

 //get patient
function getPatient(customer_id){
     let customer = customer_id;
     let fromDate = document.getElementById("fromDate").value;
     let toDate = document.getElementById("toDate").value;
     if(fromDate.length == 0 || fromDate.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please select a date range!");
          $("#fromDate").focus();
          return;
     }else if(toDate.length == 0 || toDate.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please select a date range!");
          $("#toDate").focus();
          return;
     }else{
     if(customer.length >= 3){
          if(customer){
               $.ajax({
                    type : "POST",
                    url :"../controller/get_patient.php",
                    data : {customer:customer, fromDate:fromDate, toDate:toDate},
                    success : function(response){
                         $("#sales_item").html(response);
                    }
               })
               /* $("#fromDate").attr("readonly", true);
               $("#toDate").attr("readonly", true); */
               return false;
          }else{
               $("#sales_item").html("<p>Please enter atleast 3 letters</p>");
          }
     }
}
     
}


//display patient prescription history
function getPatientRecord(customer_id){
     let customer = customer_id;
          
          $.ajax({
               type : "GET",
               url : "../controller/patient_record.php?patient="+customer,
               success : function(response){
                    $("#customer_statement").html(response);
               }
          })
          $("#sales_item").html("");
          $("#customer").val("")
          return false;
     // }
     
 }
//display patient prescriptions from statement
 function viewPatientInvoice(invoice_id){
     let invoice = invoice_id;
          
          $.ajax({
               type : "GET",
               url : "../controller/patient_invoices.php?invoice="+invoice,
               success : function(response){
                    $("#customer_invoices").html(response);
                    // window.scrollTo(0, 0);
                    document.getElementById("customer_invoices").scrollIntoView();
               }
          })
          $("#sales_item").html("");
          return false;
     // }
     
 }
//display patient messages from statement
function viewPatientMessage(message_id){
     let message = message_id;
          
          $.ajax({
               type : "GET",
               url : "../controller/patient_messages.php?message="+message,
               success : function(response){
                    $("#customer_invoices").html(response);
                    // window.scrollTo(0, 0);
                    document.getElementById("customer_invoices").scrollIntoView();
               }
          })
          $("#sales_item").html("");
          return false;
     // }
     
 }
 //add message template
 //add bank
function addTemplate(){
     let title = document.getElementById("title").value;
     let message = document.getElementById("message").value;
     if(title.length == 0 || title.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please input message subject!");
          $("#title").focus();
          return;
     }else if(message.length == 0 || message.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please input message body!");
          $("#message").focus();
          return;
     }else{
          $.ajax({
               type : "POST",
               url : "../controller/add_template.php",
               data : {title:title, message:message},
               success : function(response){
               $("#template").html(response);
               }
          })
     }
     
     setTimeout(() => {
          $("#template").load("create_template.php #template");
     }, 1500);
     return false;
}

//update message template
function updateTemplate(){
     let title = document.getElementById("title").value;
     let message = document.getElementById("message").value;
     let template_id = document.getElementById("template_id").value;
    
     if(title.length == 0 || title.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please input message subject!");
          $("#title").focus();
          return;
     }else if(message.length == 0 || message.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please input message body!");
          $("#message").focus();
          return;
    
     }else{
          $.ajax({
               type : "POST",
               url : "../controller/update_template.php",
               data : {title:title, message:message, template_id:template_id},
               success : function(response){
               $("#template").html(response);
               }
          })
     }
     setTimeout(function(){
          $('#template').load("create_template.php #template");
     }, 1500);
     return false;
}

//delete template
function deleteTemplate(item){
     let confirmDel = confirm("Are you sure you want to remove this template?", "");
     if(confirmDel){
          
          $.ajax({
               type : "GET",
               url : "../controller/delete_template.php?template="+item,
               success : function(response){
                    $("#template").html(response);
               }
               
          })
          setTimeout(function(){
               $("#template").load("create_template.php #template");
          }, 1500);
          return false;
     }else{
          return;
     }
}

//get patient name to send message
function getPatientName(sup){
     let patient = sup;
     
     if(patient.length >= 3){
          if(patient){
               $.ajax({
                    type : "POST",
                    url :"../controller/get_patient_name.php",
                    data : {patient:patient},
                    success : function(response){
                         $("#transfer_item").html(response);
                    }
               })
               return false;
          }else{
               $("#transfer_item").html("<p>Please enter atleast 3 letters</p>");
          }
     }
     
}

//select patient name during message
function addPatient(id, vendor_name){
     let patient = document.getElementById("patient");
     let customer = document.getElementById("customer");
     patient.value = vendor_name;
     customer.value = id;
     $("#customer").attr("readonly", true);
     $("#patient").attr("readonly", true);
     $("#transfer_item").html('');
}

//send message
function sendMessage(){
     let title = document.getElementById("title").value;
     let message = document.getElementById("message").value;
     let customer = document.getElementById("customer").value;
     let patient = document.getElementById("patient").value;
    
     if(title.length == 0 || title.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please input message subject!");
          $("#title").focus();
          return;
     }else if(message.length == 0 || message.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please input message body!");
          $("#message").focus();
          return;
     }else if(customer.length == 0 || customer.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please select patient!");
          $("#patient").focus();
          return;
     }else if(patient.length == 0 || patient.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please enter patient name!");
          $("#patient").focus();
          return;
    
     }else{
          $.ajax({
               type : "POST",
               url : "../controller/send_message.php",
               data : {title:title, message:message, customer:customer},
               success : function(response){
               $("#template").html(response);
               }
          })
     }
     /* setTimeout(function(){
          $('#template').load("send_message.php #template");
     }, 2000); */
     return false;
}

//get patient sponsor
//checkgroup toget items
function getSponsor(item){
     let category = item;
     if(category){
          $("#service").val('');
          $("#main_service").val('');
          $("#item").val('');
          $("#sales_item").html('');
          if(category != "Private"){
               document.getElementById("patient_sponsor").style.display = "block";
               /* let amount_due = document.getElementById("amount_due");
               if(amount_due){
                    amount_due.value = 0;
                    document.getElementById("reg_fee").textContent = "₦0.00";
                    document.getElementById("registration").value = 0;
               } */
               $.ajax({
                    type : "POST",
                    url : "../controller/get_patient_sponsor.php",
                    data : {category:category},
                    success : function(response){
                         $("#sponsor").html(response);
                    }
               })
               
               return false;
          }else{
               document.getElementById("patient_sponsor").style.display = "none";
               /* $.ajax({
                    type : "POST",
                    url : "../controller/get_registration_price.php",
                    data : {category:category},
                    success : function(response){
                         $("#service_price").html(response);
                    }
               }) */
          }
     }
     
     
}

//checkgroup toget items
function checkGroup(item){
     let service = item;
     let category = document.getElementById("category").value;
    
     if(category.length == 0 || category.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please select patient category!");
          $("#category").focus();
          return;
     }else{
          if(service == "Clinical Services"){
               document.getElementById("doctors").style.display = "block";
          }else{
               document.getElementById("doctors").style.display = "none";
     
          }
          $.ajax({
               type : "POST",
               url : "../controller/get_groups.php",
               data : {service:service, category:category},
               success : function(response){
                    $("#service_item").html(response);
               }
          })
          
          return false;
     }
}
//get service item price for private
function get_item_price(id, cat, group){
     let service = document.getElementById("service").value;
     let main_service = document.getElementById("main_service");
     let category = document.getElementById("category").value;
     let sponsor = document.getElementById("sponsor").value;
     // alert(sponsor);
     let item = document.getElementById("item");
     if(group == "Clinical Services"){
          $.ajax({
               type : "GET",
               url : "../controller/get_consulting_doctors.php?item="+id,
          
               success : function(response){
                    $("#doctor").html(response);
               }
          })
     }
     if(category != "Private"){
          if(sponsor.length == 0 || sponsor.replace(/^\s+|\s+$/g, "").length == 0){
               alert("Please select patient sponsor!");
               $("#service").focus();
               return;
          }
     }
     if(category.length == 0 || category.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please select patient category!");
          $("#category").focus();
          return;
     /* }else if(sponsor.length == 0 || sponsor.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please select patient sponsor!");
          $("#service").focus();
          return; */
     }else if(service.length == 0 || service.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please select service category!");
          $("#service").focus();
          return;
     }else{
          main_service.value = id;
          item.value = cat;
          $("#sales_item").html('');
          $.ajax({
               type : "GET",
               url : "../controller/get_service_item_price.php?item="+id+"&category="+category+"&sponsor="+sponsor,
          
               success : function(response){
                    $("#service_price").html(response);
               }
          })
          return false;
     }

}
//update foto
function updatePhoto(id){
     window.open("../view/update_photo.php?patient="+id);
     setTimeout(function(){
          $("#new_reg").load("new_registration.php #new_reg");
     }, 1000);
     return false;
 
 }
// Configure a few settings and attach camera 250x187
Webcam.set({
     width: 350,
     height: 287,
     image_format: 'jpeg',
     jpeg_quality: 90
    });	 
    Webcam.attach( '#my_camera' );
   
   function take_snapshot() {
    // play sound effect
    //shutter.play();
    // take snapshot and get image data
    Webcam.snap( function(data_uri) {
    // display results in page
    document.getElementById('results').innerHTML = 
     '<img class="after_capture_frame" src="'+data_uri+'"/>';
    $("#captured_image_data").val(data_uri);
    });	 
   }

   function saveSnap(){
   var base64data = $("#captured_image_data").val();
   let patient = document.getElementById("patient").value;
    $.ajax({
             type: "POST",
             dataType: "json",
             url: "../controller/capture_image_upload.php",
             data: {image: base64data, patient:patient},
             success: function(data) { 
                  alert(data);
             }
        });
   }

   

   //search any table on key press
function searchItems(item_name, url){
     let item = item_name;
     if(item.length >= 3){
          if(item){
               $.ajax({
                    type : "POST",
                    url :"../controller/"+url,
                    data : {item:item},
                    success : function(response){
                         $("#result").html(response);
                    }
               })
               return false;
          }else{
               $("#result").html("<p>Please enter atleast 3 letters</p>");
          }
     }
     
}

//update patient photo
//get patient on key press for editing
function getPatientDetails(input, url){
     $("#search_results").show();
     if(input.length >= 3){
          $.ajax({
               type : "POST",
               url : "../controller/"+url+"?input="+input,
               success : function(response){
                    $("#search_results").html(response);
               }
          })
     }
     
}
//get patient sponsor to update
function getPatientSponsor(item){
     let category = item;
     if(category){
          $.ajax({
               type : "POST",
               url : "../controller/get_patient_sponsor_edit.php",
               data : {category:category},
               success : function(response){
                    $("#sponsor").html(response);
               }
          })
          return false;
     }
     
     
}

// update patient sponsor
function updateSponsor(){
     let patient = document.getElementById("patient").value;
     let category = document.getElementById("category").value;
     let sponsor = document.getElementById("sponsor").value;
     if(category != 'Private'){
          if(sponsor.length == 0 || sponsor.replace(/^\s+|\s+$/g, "").length == 0){
               alert("Please select sponsor");
               $("#sponsor").focus();
               return;
          }
     }
     if(category.length == 0 || category.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please select patient category!");
          $("#category").focus();
          return;
     
     }else{
          $.ajax({
               type : "POST",
               url : "../controller/update_patient_sponsor.php",
               data : {patient:patient, category:category, sponsor:sponsor},
               success : function(response){
               $("#edit_customer").html(response);
               }
          })
     
     setTimeout(function(){
          $("#edit_customer").load("edit_patient_sponsor.php?patient="+patient+ "#edit_customer");
     }, 1000);

     return false;    
}
}

//post payments
//post direct sales payment
function postPayment(url){
     let confirmPost = confirm("Are you sure you want to post this payment?", "");
     if(confirmPost){
          let amount = document.getElementById("amount").value;
          let invoice = document.getElementById("invoice").value;
          let patient = document.getElementById("patient").value;
          let deposit_amount = document.getElementById("deposit_amount").value;
          let store = document.getElementById("store").value;
          let payment_type = document.getElementById("payment_type").value;
          let bank = document.getElementById("bank").value;
          let visit = document.getElementById("visit").value;
          let multi_cash = document.getElementById("multi_cash").value;
          let multi_pos = document.getElementById("multi_pos").value;
          let multi_transfer = document.getElementById("multi_transfer").value;
          let sum_amount = parseInt(multi_cash) + parseInt(multi_pos) + parseInt(multi_transfer);
          if(payment_type != "Cash"){
               if(bank.length == 0 || bank.replace(/^\s+|\s+$/g, "").length == 0){
                    alert("Please select Bank!");
                    $("#bank").focus();
                    return;
               }
          }
          if(document.getElementById("multiples").style.display == "block"){
               if(sum_amount != (parseInt(amount))){
                    alert("Amount entered is not equal to total amount");
                    $("#multi_cash").focus();
                    return;
               }
               
          }
          if(payment_type != "Multiple"){
               if(deposit_amount.length == 0 || deposit_amount.replace(/^\s+|\s+$/g, "").length == 0){
                    alert("Please enter amount paid!");
                    $("#deposit_amount").focus();
                    return;
               }
          }
          if(payment_type.length == 0 || payment_type.replace(/^\s+|\s+$/g, "").length == 0){
               alert("Please select a payment option!");
               $("#payment_type").focus();
               return;
          }else{
               $.ajax({
                    type : "POST",
                    url : "../controller/"+url,
                    data : {invoice:invoice, patient:patient, payment_type:payment_type, bank:bank, multi_cash:multi_cash, multi_pos:multi_pos, multi_transfer:multi_transfer, store:store,amount:amount, visit:visit, deposit_amount:deposit_amount},
                    success : function(response){
                         $("#fund_account").html(response);
                    }
               })
               $(".sales_order").html('');
               /* setTimeout(function(){
                    $("#direct_sales").load("direct_sales.php #direct_sales");
               }, 200);
               return false; */
          }
     // }
     }else{
          return;
     }
}

// prinit sales receipt for direct sales
function printBillReceipt(invoice){
     window.open("../controller/bill_receipt.php?receipt="+invoice);
     /* setTimeout(function(){
          $("#direct_sales").load("direct_sales.php #direct_sales");
     }, 100); */
     return false;
 
 }

 //get correct customer to merge files
function getCorCustomer(customer){
     let item = customer;
     // alert(check_room);
     // return;
     if(item.length >= 3){
          if(item){
               $.ajax({
                    type : "POST",
                    url :"../controller/get_cor_customer.php",
                    data : {item:item},
                    success : function(response){
                         $("#sales_item").html(response);
                    }
               })
               return false;
          }else{
               $("#sales_item").html("<p>Please enter atleast 3 letters</p>");
          }
     }
     
}

//add correct customer  for merging files
function addCorCustomer(id, name){
     let correct_customer = document.getElementById("correct_customer");
     let item = document.getElementById("item");
     correct_customer.value = id;
     item.value = name;
     // correct_customer.setAttribute('readonly', true);
     // item.setAttribute('readonly', true);
     $("#sales_item").html('');
}
//get wrong customer to merge files
function getWrongCustomer(customer){
     let item_raw = customer;
     // alert(check_room);
     // return;
     if(item_raw.length >= 3){
          if(item_raw){
               $.ajax({
                    type : "POST",
                    url :"../controller/get_wrong_customer.php",
                    data : {item_raw:item_raw},
                    success : function(response){
                         $("#transfer_item").html(response);
                    }
               })
               return false;
          }else{
               $("#transfer_item").html("<p>Please enter atleast 3 letters</p>");
          }
     }
     
}

//add wrong customer  for merging files
function addWrongCustomer(id, name){
     let wrong_customer = document.getElementById("wrong_customer");
     let item_raw = document.getElementById("item_raw");
     wrong_customer.value = id;
     item_raw.value = name;
     // correct_customer.setAttribute('readonly', true);
     // item.setAttribute('readonly', true);
     $("#transfer_item").html('');
}

//merge files
function mergeFiles(){
     let correct_customer = document.getElementById("correct_customer").value;
     let wrong_customer = document.getElementById("wrong_customer").value;
     if(correct_customer == wrong_customer){
          alert("You can not merge same customer");
          $("#item").focus();
          return;
     }else if(correct_customer.length == 0 || correct_customer.replace(/^\s+|\s+$/g, "").length == 0){
          alert("please select the correct customer");
          $("#correct_customer").focus();
          return;
     }else if(wrong_customer.length == 0 || wrong_customer.replace(/^\s+|\s+$/g, "").length == 0){
          alert("please select the wrong  customer name");
          $("#wrong_customer").focus();
          return;
     }else{
          let confirmMerge = confirm("Are you sure you want to merge these files?", "");
          if(confirmMerge){
               $.ajax({
                    type : "POST",
                    url : "../controller/merge_files.php",
                    data : {correct_customer:correct_customer, wrong_customer:wrong_customer},
                    success : function(response){
                        $("#merge_files").html(response); 
                    }
               })
               setTimeout(function(){
                    $("#merge_files").load("merge_files.php #merge_files");
               }, 1000);
               return false;
          }else{
               return;
          }
     }
}



//add specialty to tariff
 function addSpecialtyTariff(url){
     let item_id = document.getElementById("item_id").value;
     let sponsor = document.getElementById("sponsor").value;
     let first_visit = document.getElementById("first_visit").value;
     let re_visit = document.getElementById("re_visit").value;
     let item_group = document.getElementById("item_group").value;
     
     let category = document.getElementById("category").value;
     
    if(first_visit.length == 0 || first_visit.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please enter first visit amount!");
          $("#first_visit").focus();
          return;
     }else if(re_visit.length == 0 || re_visit.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please enter revisit amount!");
          $("#re_visit").focus();
          return;
    
     }else if(first_visit <= 0 || re_visit <= 0){
          alert("Values cannot be less than 0!");
          $("#first_visit").focus();
          return;
     }else{
          $.ajax({
               type : "POST",
               url : "../controller/add_specialty_tariff.php",
               data: {item_id:item_id, first_visit:first_visit, re_visit:re_visit, item_group:item_group, category:category, sponsor:sponsor},
               success : function(response){
                    $("#edit_item_price").html(response);
               }
          })
          setTimeout(function(){
               $("#edit_item_price").load(url+ " #edit_item_price");
          }, 1000);
          return false
     }
 }

 //change specialty tariff
 function changeSpecialtyPrice(url){
     let item_id = document.getElementById("item_id").value;
     let first_visit = document.getElementById("first_visit").value;
     let re_visit = document.getElementById("re_visit").value;
    
    if(first_visit.length == 0 || first_visit.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please enter first visit amount!");
          $("#first_visit").focus();
          return;
     }else if(re_visit.length == 0 || re_visit.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please enter revisit amount!");
          $("#re_visit").focus();
          return;
    
     }else if(first_visit <= 0 || re_visit <= 0){
          alert("Values cannot be less than 0!");
          $("#first_visit").focus();
          return;
     }else{
          $.ajax({
               type : "POST",
               url : "../controller/edit_specialty_tariff.php",
               data: {item_id:item_id, first_visit:first_visit, re_visit:re_visit},
               success : function(response){
                    $("#edit_item_price").html(response);
               }
          })
          setTimeout(function(){
               $("#edit_item_price").load(url+ " #edit_item_price");
          }, 1000);
          return false
     }
 }

 //fetch single hmo service tariff
function showHmoService(item){
     let sponsor = item;
     if(sponsor){
          $.ajax({
               type : "GET",
               url : "../controller/get_hmo_services.php?sponsor="+sponsor,
               success : function(response){
                    $(".new_data").html(response);
               }
          })
          
          return false;
     }
}
//filter select with search
/* function filterOptions() {
     var input, filter, select, options, i;
     input = document.getElementById("searchInput");
     filter = input.value.toUpperCase();
     select = document.getElementById("full_name");
     options = select.getElementsByTagName("option");
 
     for (i = 0; i < options.length; i++) {
         txtValue = options[i].textContent || options[i].innerText;
         if (txtValue.toUpperCase().indexOf(filter) > -1) {
             options[i].style.display = "";
         } else {
             options[i].style.display = "none";
         }
     }
 } */

function takeStaff(id, name){
     let item = document.getElementById("item");
     let full_name = document.getElementById("full_name");

     item.value = name;
     full_name.value = id;
     $("#sales_item").html('');
}

//add doctor to specialty
function addSpecialty(){
     let doctor = document.getElementById("doctor").value;
     let specialty = document.getElementById("specialty").value;
     if(doctor.length == 0 || doctor.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please select doctor!");
          $("#doctor").focus();
          return;
     }else if(specialty.length == 0 || specialty.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please select a specialty!");
          $("#specialty").focus();
          return;
     }else{
          $.ajax({
               type : "POST",
               url : "../controller/add_doctor_specialty.php",
               data : {doctor:doctor, specialty:specialty},
               success : function(response){
               $(".info").html(response);
               }
          })
     }
     $("#doctor").val('');
     $("#specialty").val('');
     $("#doctor").focus();
     return false;
}

//delete individual bills for outpatients
function removeOpBill(bill, bill_id){
     let confirmDel = confirm("Are you sure you want to remove this item?", "");
     if(confirmDel){
          // alert(bill, bill_id);
          $.ajax({
               type : "GET",
               url : "../controller/remove_op_bill.php?bill_id="+bill_id+"&bill="+bill,
               success : function(response){
                    $("#fund_account").html(response);
               }
               
          })
          setTimeout(function(){
               $("#fund_account").load("op_bill.php?bill="+bill+" #fund_account");
          }, 1500);
          return false;
     }else{
          return;
     }
}

//show all forms
function showForm(url){
     $.ajax({
          type : "GET",
          url : "../controller/"+url,
          success : function(response){
               $("#all_forms").html(response)
          }
     })
     return false;
}

//select drug allergy
function selectDrugAllergy(id, name){
     let item = document.getElementById("item");
     let drug = document.getElementById("drug");
     item.value = name;
     drug.value = id;
     $("#sales_item").html('');
}

//add allergy
function addAllergy(){
     let patient = document.getElementById("patient").value;
     let drug = document.getElementById("drug").value;
     let description = document.getElementById("description").value;
     if(drug.length == 0 || drug.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please select drug!");
          $("#drug").focus();
          return;
     }else if(description.length == 0 || description.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please enter allergy description!");
          $("#description").focus();
          return;
     }else{
          $.ajax({
               type : "POST",
               url : "../controller/add_allergy.php",
               data : {patient:patient, drug:drug, description:description},
               success : function(response){
               $("#allergy").html(response);
               }
          })
     }
     $("#drug").val('');
     $("#item").val('');
     $("#description").val('');
     $("#drug").focus();
     setTimeout(function(){
          $(".success_msg").hide();
     },2000);
     
     return false;
}

//close all forms
function closeAllForms(){
     $("#all_forms").html("");
     $("#all_order_forms").html("");
}
//calculate bmi
function calcBmi(value){
     let weight = document.getElementById("weight").value;
     let height = value;
     let bmi = document.getElementById("bmi");
     let bmi_val = document.getElementById("bmi_val");
     if(weight.length == 0 || weight.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please enter weight!");
          $("#weight").focus();
          return;
     }else if(weight <= 0 || height <= 0){
          alert("Values must be greater than 0!");
          $("#weight").focus();
          return; 
     }else{
          let heightInM = (parseFloat(height)/100);
          let AreaInM2 = heightInM * heightInM;
          let bmi_data = Math.round((parseFloat(weight) / parseFloat(AreaInM2)) * 100) / 100;
          bmi.value = bmi_data;
          if(bmi_data < 18.5){
               bmi_val.value = "Underweight";
          }else if(bmi_data <=  24.9){
               bmi_val.value = "Normal weight";

          }else if(bmi_data <=  29.9){
               bmi_val.value = "Overweight";
          }else if(bmi_data <=  34.9){
               bmi_val.value = "Moderate Obesity";
          }else if(bmi_data <=  39.9){
               bmi_val.value = "Severe Obesity";

          }else{
               bmi_val.value = "Morbid Obesity";

          };
     }
}
//add vital signs
function addVitals(){
     let patient = document.getElementById("patient").value;
     let visit_number = document.getElementById("visit_number").value;
     let complaint = document.getElementById("complaint").value;
     let temperature = document.getElementById("temperature").value;
     let weight = document.getElementById("weight").value;
     let height = document.getElementById("height").value;
     let systolic = document.getElementById("systolic").value;
     let diastolic = document.getElementById("diastolic").value;
     let bmi = document.getElementById("bmi").value;
     let respiration = document.getElementById("respiration").value;
     let oxygen_sat = document.getElementById("oxygen_sat").value;
     let pulse = document.getElementById("pulse").value;
     let head_circ = document.getElementById("head_circ").value;
     let remark = document.getElementById("remark").value;
     let triage = document.getElementById("triage").value;
     if(weight.length == 0 || weight.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please enter weight!");
          $("#weight").focus();
          return;
     }else if(weight <= 0 || height <= 0 || temperature < 0 || systolic < 0 || diastolic < 0 || pulse < 0 || bmi <= 0){
          alert("Values must be greater than 0!");
          $("#weight").focus();
          return;
     }else if(remark.length == 0 || remark.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please enter remark!");
          $("#remark").focus();
          return;
     }else if(triage.length == 0 || triage.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please select triage category!");
          $("#triage").focus();
          return;
     }else{
          $.ajax({
               type : "POST",
               url : "../controller/add_vitals.php",
               data : {patient:patient, complaint:complaint, temperature:temperature, weight:weight, height:height, diastolic:diastolic, systolic:systolic, bmi:bmi, respiration:respiration, oxygen_sat:oxygen_sat, pulse:pulse, head_circ:head_circ, remark:remark, triage:triage,visit_number:visit_number}, 
               success : function(response){
                    $("#last_consult").html(response);
                    document.getElementById("last_consult").scrollIntoView();
               }
          })
          $("#complaint").val('');
          $("#bmi").val('');
          $("#height").val('');
          $("#weight").val('');
          $("#temperature").val('');
          $("#oxygen_sat").val('');
          $("#pulse").val('');
          $("#respiration").val('');
          $("#systolic").val('');
          $("#diastolic").val('');
          $("#head_circ").val('');
          $("#triage").val('');
          $("#remark").val('');
          $("#visit_number").val('');
          setTimeout(function(){
               $(".success_msg").hide();
          },2000);
     }
}
//edit vital signs
function editVitals(){
     let patient = document.getElementById("patient").value;
     let vitals_id = document.getElementById("vitals_id").value;
     let visit_number = document.getElementById("visit_number").value;
     let complaint = document.getElementById("complaint").value;
     let temperature = document.getElementById("temperature").value;
     let weight = document.getElementById("weight").value;
     let height = document.getElementById("height").value;
     let systolic = document.getElementById("systolic").value;
     let diastolic = document.getElementById("diastolic").value;
     let bmi = document.getElementById("bmi").value;
     let respiration = document.getElementById("respiration").value;
     let oxygen_sat = document.getElementById("oxygen_sat").value;
     let pulse = document.getElementById("pulse").value;
     let head_circ = document.getElementById("head_circ").value;
     let remark = document.getElementById("remark").value;
     let triage = document.getElementById("triage").value;
     if(weight.length == 0 || weight.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please enter weight!");
          $("#weight").focus();
          return;
     }else if(weight <= 0 || height <= 0 || temperature < 0 || systolic < 0 || diastolic < 0 || pulse < 0 || bmi <= 0){
          alert("Values must be greater than 0!");
          $("#weight").focus();
          return;
     }else if(remark.length == 0 || remark.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please enter remark!");
          $("#remark").focus();
          return;
     }else if(triage.length == 0 || triage.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please select triage category!");
          $("#triage").focus();
          return;
     }else{
          $.ajax({
               type : "POST",
               url : "../controller/update_vitals.php",
               data : {vitals_id:vitals_id, patient:patient, complaint:complaint, temperature:temperature, weight:weight, height:height, diastolic:diastolic, systolic:systolic, bmi:bmi, respiration:respiration, oxygen_sat:oxygen_sat, pulse:pulse, head_circ:head_circ, remark:remark, triage:triage,visit_number:visit_number}, 
               success : function(response){
                    $("#patient_consult").html(response);
                    
               }
          })
          
          setTimeout(function(){
               $("#patient_consult").load("edit_vital_sign.php #patient_consult");
          },2000);
     }
}

//select diagnosis during consultaion
function selectDiagnosis(id, name){
     let item = document.getElementById("item");
     let diagnosis = document.getElementById("diagnosis");
     item.value = name;
     diagnosis.value = id;
     $("#sales_item").html('');
}
function checkOtherItems(input, usefunction, url){
     let typingTimeout;
     // Clear any existing timeout to debounce
     clearTimeout(typingTimeout);
 
     // Set a timeout to trigger fetchItems after 300ms of inactivity
     typingTimeout = setTimeout(function() {
         if (input.length >= 3) { // Adjust this as needed for item names
             usefunction(input, url);
         }
     }, 300); // Adjust delay time based on scanning speed
};
//check item group while adding item
function checkItemGroup(item){
     let group = item;
     
     if(group == "Pharmacy"){
         $("#class").show();
     //     $(".other_groups").hide();
     }else{
          $("#class").hide();
     //     $(".other_groups").show();

     }
}

//show all forms
function showOrderForm(url){
     $.ajax({
          type : "GET",
          url : "../controller/"+url,
          success : function(response){
               $("#all_order_forms").html(response)
          }
     })
     return false;
}

//reclassify drugs
function classifyDrug(url, item, item_class){
     $.ajax({
          type : "GET",
          url : "../controller/"+url+"?item="+item+"&class="+item_class,
          success : function(response){
               $("#item_list").html(response);
          }
     })
     setTimeout(function(){
          $("#item_list").load("reclassify_drug.php #item_list");
     }, 1000)
}

//select drug order 
function selectDrugOrder(id, name){
     let order = document.getElementById("order");
     let drug = document.getElementById("drug");
     order.value = name;
     drug.value = id;
     $("#transfer_item").html('');
}
//get drug quantity from ddosage and frequency during presciption
function getDrugQty(days){
     let duration = days;
     let dosage = document.getElementById("dosage").value;
     let frequency = document.getElementById("frequency").value;
     let quantity = document.getElementById("quantity");
    if(dosage.length == 0 || dosage.replace(/^\s+|\s+$/g, "").length == 0 || dosage <= 0){
          alert("Please enter dosage!");
          $("#dosage").focus();
          return;
     }else if(frequency.length == 0 || frequency.replace(/^\s+|\s+$/g, "").length == 0 || frequency <= 0){
          alert("Please enter frequency!");
          $("#frequency").focus();
          return;
     }else{
          let total_freq = 24/frequency;
          let total_qty = (total_freq * dosage) * duration;
          quantity.value = total_qty;
     }
}

//add investigation during ew registration 
function addTest(item_id){
     let item = item_id;
     let sponsor = document.getElementById("sponsor").value;
     let category = document.getElementById("category").value;
     let invoice = document.getElementById("invoice").value;
     if(category != "Private"){
          if(!sponsor){
               alert("Please select sponsor");
               $("#item").focus();
               $("#sales_item").html("");
               $("#item").val("");
               return;
          }
     }
     if(!category){
          alert("Please select patient category");
          $("#item").focus();
          $("#sales_item").html("");
          $("#item").val("");
          return;
     }else{
          $.ajax({
               type : "GET",
               url : "../controller/add_investigation.php?test="+item+"&category="+category+"&sponsor="+sponsor+"&invoice="+invoice,
               success : function(response){
                    $(".sales_order").html(response);
               }
          })
          $("#sales_item").html("");
          $("#item").val('');
          $("#item").focus();

          return false;
     }
}

//delete investigation from investigation order
function deleteTest(sales, item){
     let confirmDel = confirm("Are you sure you want to remove this item?", "");
     if(confirmDel){
          
          $.ajax({
               type : "GET",
               url : "../controller/delete_test.php?sales_id="+sales+"&item_id="+item,
               success : function(response){
                    $(".sales_order").html(response);
               }
               
          })
          return false;
     }else{
          return;
     }
}
//delete investigation from investigation order for existing patient
function deleteExistTest(sales, item){
     let confirmDel = confirm("Are you sure you want to remove this item?", "");
     if(confirmDel){
          
          $.ajax({
               type : "GET",
               url : "../controller/delete_existing_test.php?sales_id="+sales+"&item_id="+item,
               success : function(response){
                    $(".sales_order").html(response);
               }
               
          })
          return false;
     }else{
          return;
     }
}

//add investigation for existing client 
function addExistingTest(item_id){
     let item = item_id;
     let sponsor = document.getElementById("sponsor").value;
     let category = document.getElementById("category").value;
     let invoice = document.getElementById("invoice").value;
     let patient = document.getElementById("patient").value;
     if(category != "Private"){
          if(!sponsor){
               alert("Please select sponsor");
               $("#item").focus();
               $("#sales_item").html("");
               $("#item").val("");
               return;
          }
     }
     if(!category){
          alert("Please select patient category");
          $("#item").focus();
          $("#sales_item").html("");
          $("#item").val("");
          return;
     }else{
          $.ajax({
               type : "GET",
               url : "../controller/add_existing_investigation.php?test="+item+"&category="+category+"&sponsor="+sponsor+"&invoice="+invoice+"&patient="+patient,
               success : function(response){
                    $(".sales_order").html(response);
               }
          })
          $("#sales_item").html("");
          $("#item").val('');
          $("#item").focus();

          return false;
     }
}

//post existing patient investigation
function postInvestigations(invoice){
     let confirm_post = confirm("Are you sure you want to post the investigation(s)?", "");
     if(confirm_post){
          $.ajax({
               type : "GET",
               url : "../controller/post_investigation.php?invoice="+invoice,
               success : function(response){
                    $("#edit_customer").html(response);
               }
          })
          return false;
     }
}
//add departments
function addSampleType(){
     let sample = document.getElementById("sample").value;
     if(sample.length == 0 || sample.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please sample type!");
          $("#sample").focus();
          return;
     }else{
          $.ajax({
               type : "POST",
               url : "../controller/add_sample_type.php",
               data : {sample:sample},
               success : function(response){
               $("#sample_type").html(response);
               }
          })
     }
     $("#sample").val('');
     $("#sample").focus();
     return false;
}

//collect sample
function collectSample(sample_type){
     let patient = document.getElementById("patient").value;
     let visit_no = document.getElementById("visit_no").value;
     let investigation = document.getElementById("investigation").value;
     let sample = sample_type;
     if(!sample){
          alert("Please select sample type");
          $("#sample").focus();
          return;
     }else{
          let confirm_post = confirm("Are you sure you want to   collect this sample?", "");
          if(confirm_post){
               $.ajax({
                    type : "POST",
                    url : "../controller/collect_samples.php",
                    data : {patient:patient, visit_no:visit_no, investigation:investigation, sample:sample},
                    success : function(response){
                         $("#samples").html(response);
                    }
               })
               setTimeout(function(){
                    $("#samples").load("collect_samples.php?bill="+visit_no+ " #samples");
               }, 1500)
               return false
          }else{
               return;
          }
     }
}

// reprint receipt
function printLabel(invoice){
     // alert(item_id);
     window.open("../controller/print_label.php?label="+invoice);
 
 }

 //toggle gender constraint
 function toggleGender(){
     let gender = document.getElementById("gender");
     if(gender.disabled){
          gender.disabled = false;
     }else{
          gender.disabled = true;
     }
 }
 //toggle age constraint
 function toggleAge(){
     let age_from = document.getElementById("age_from");
     let age_to = document.getElementById("age_to");
     if(age_from.disabled){
          age_from.disabled = false;
          age_to.disabled = false;
     }else{
          age_from.disabled = true;
          age_to.disabled = true;
     }
 }

 //show templates dynamically with xhttp request
function showTemplate(page){
     let xhr = false;
     if(window.XMLHttpRequest){
          xhr = new XMLHttpRequest();
     }else{
          xhr = new ActiveXObject("Microsoft.XMLHTTP");
     }
     if(xhr){
          xhr.onreadystatechange = function(){
               if(xhr.readyState == 4 && xhr.status == 200){
                    document.querySelector(".template_content").innerHTML = xhr.responseText;
               }
          }
          xhr.open("GET", page, true );
          xhr.send(null);
     }
}

/* // Execute formatting commands
function execCommand(command, value = null) {
     document.execCommand(command, false, value);
   } */
  // Execute formatting commands
  function execCommand(command, value = null) {
     document.execCommand(command, false, value);
   }
 
   // Set Paragraph or Heading style
   function setParagraphStyle() {
     const formatValue = document.getElementById('block-format').value;
     execCommand('formatBlock', `<${formatValue}>`);
   }
   // Insert a table
   function insertTable() {
     const rows = prompt("Number of rows?");
     const cols = prompt("Number of columns?");
     if (rows && cols) {
       let table = '<table border="1" style="width: 100%; border-collapse: collapse; border-color:#e7e6e6;">';
       for (let i = 0; i < rows; i++) {
         table += '<tr>';
         for (let j = 0; j < cols; j++) {
           table += '<td style="padding: 10px; text-align: left; border-color:#e7e6e6;"></td>';
         }
         table += '</tr>';
       }
       table += '</table>';
       execCommand('insertHTML', table);
     }
   }
 
   // Insert a hyperlink
   /* function insertLink() {
     const url = prompt("Enter the URL:");
     if (url) {
       execCommand('createLink', url);
     }
   } */

function insertLink() {
     const url = prompt("Enter the URL:");
     if (url) {
          // Wrap selected text with an anchor tag
          const selection = window.getSelection();
          if (selection.rangeCount > 0) {
          const range = selection.getRangeAt(0);
          const anchor = document.createElement('a');
          anchor.href = url;
          anchor.target = "_blank";
          anchor.textContent = selection.toString() || url; // If no text is selected, display the URL
          range.deleteContents();
          range.insertNode(anchor);
          }
     }
}

//save template for result template
function saveLabTemplate() {
     let labTemplate = document.getElementById("lab_template").cloneNode(true);

     // Get all input and select fields inside the table
     let inputs = labTemplate.querySelectorAll("input, select");

     inputs.forEach(input => {
          let textValue = "";

          if (input.tagName === "INPUT") {
               textValue = input.value.trim();
          } else if (input.tagName === "SELECT") {
               textValue = input.options[input.selectedIndex]?.text.trim();
          }

          // Create a text node to replace the input/select element
          let textNode = document.createTextNode(textValue);
          input.parentNode.replaceChild(textNode, input);
     });

     // Save updated HTML to hidden input
     document.getElementById("lab_content").value = labTemplate.innerHTML;
}
//save template for result posting
/* function saveResultTemplate() {
     let labTemplate = document.getElementById("lab_template").cloneNode(true);
     // Get the table inside the lab template
     let table = labTemplate.querySelector("table");
     if (!table) return;

     // Find the index of the "Operator" column in the header
     let headerCells = table.querySelectorAll("thead tr td");
     let operatorIndex = -1;

     headerCells.forEach((cell, index) => {
     if (cell.textContent.trim().toLowerCase() === "operator") {
          operatorIndex = index;
     }
     });

     // If "Operator" column is found, remove it
     if (operatorIndex !== -1) {
     // Remove from header
     headerCells[operatorIndex].remove();

     // Remove from all rows in tbody
     let rows = table.querySelectorAll("tbody tr");
     rows.forEach(row => {
          let cells = row.querySelectorAll("td");
          if (cells.length > operatorIndex) {
               cells[operatorIndex].remove();
          }
     });
     }
     // Get all input and select fields inside the table
     let inputs = labTemplate.querySelectorAll("input, select");

     inputs.forEach(input => {
          let textValue = "";

          if (input.tagName === "INPUT") {
               textValue = input.value.trim();
          } else if (input.tagName === "SELECT") {
               textValue = input.options[input.selectedIndex]?.text.trim();
          }

          // Create a text node to replace the input/select element
          let textNode = document.createTextNode(textValue);
          input.parentNode.replaceChild(textNode, input);
     });

     // Save updated HTML to hidden input
     document.getElementById("lab_content").value = labTemplate.innerHTML;
} */
     function saveResultTemplate() {
          let labTemplate = document.getElementById("lab_template").cloneNode(true);
          
          // Check if a table exists inside the lab template
          let table = labTemplate.querySelector("table");
      
          if (table) {
              // Find the index of the "Operator" column in the header
              let headerCells = table.querySelectorAll("thead tr td");
              let operatorIndex = -1;
      
              headerCells.forEach((cell, index) => {
                  if (cell.textContent.trim().toLowerCase() === "operator") {
                      operatorIndex = index;
                  }
              });
      
              // If "Operator" column is found, remove it
              if (operatorIndex !== -1) {
                  headerCells[operatorIndex].remove();
      
                  // Remove from all rows in tbody
                  let rows = table.querySelectorAll("tbody tr");
                  rows.forEach(row => {
                      let cells = row.querySelectorAll("td");
                      if (cells.length > operatorIndex) {
                          cells[operatorIndex].remove();
                      }
                  });
              }
      
              // Get all input and select fields inside the table
              let inputs = table.querySelectorAll("input, select");
              inputs.forEach(input => {
                  let textValue = input.tagName === "INPUT" ? input.value.trim() :
                                  input.tagName === "SELECT" ? input.options[input.selectedIndex]?.text.trim() : "";
      
                  let textNode = document.createTextNode(textValue);
                  input.parentNode.replaceChild(textNode, input);
              });
          }
      
          // Ensure the entire lab template is saved, whether or not a table exists
          document.getElementById("lab_content").value = labTemplate.innerHTML;
      }
// Add Lab Template Function
function addLabTemplate() {
//     saveLabTemplate(); // ✅ Convert inputs into editable text before saving

    let templates = document.querySelector('input[name="templates"]:checked')?.value || "";
    let investigation = document.getElementById("investigation").value;
    let gender = document.getElementById("gender").value;
    let age_from = document.getElementById("age_from").value;
    let age_to = document.getElementById("age_to").value;
    let value_no = templates === "values" ? document.getElementById("value_no")?.value || "" : "";
//     let lab_content = document.getElementById("lab_content").value; // ✅ Now contains both input values and static text
    let lab_template = document.getElementById("lab_template").innerHTML;
     document.getElementById("lab_content").value = lab_template;
     let lab_content = document.getElementById("lab_content").value;

    // Validate Gender
    if (!document.getElementById("gender").disabled && (!gender || gender.trim() === "")) {
        alert("Please select gender");
        $("#gender").focus();
        return;
    }

    // Validate Age
    if (!document.getElementById("age_from").disabled) {
        if (!age_from || age_from <= 0) {
            alert("Please input a valid age range");
            $("#age_from").focus();
            return;
        }
        if (!age_to || age_to <= 0) {
            alert("Please input a valid age range");
            $("#age_to").focus();
            return;
        }
        if (parseInt(age_from) > parseInt(age_to)) {
            alert("Age From must not be greater than Age To");
            $("#age_to").focus();
            return;
        }
    }

    // Send Data via AJAX
    $.ajax({
        type: "POST",
        url: "../controller/add_lab_template.php",
        data: {
            investigation: investigation,
            gender: gender,
            age_from: age_from,
            age_to: age_to,
            lab_content: lab_content, 
            templates: templates, value_no:value_no
        },
        success: function(response) {
            $("#add_template").html(response);
        }
    });

    // Reload Templates after Submission
    setTimeout(function() {
        $("#add_template").load("get_templates.php?item=" + investigation + " #add_template");
    }, 2000);
    
    return false;
}
//delete lab template
function deleteLabTemplate(template_no, investigation){
     let confirm_del = confirm("Are you sure you want to delete this template?", "");
     if(confirm_del){
          $.ajax({
               type : "GET",
               url : "../controller/delete_lab_template.php?template="+template_no,
               success: function(response){
                    $("#add_template").html(response);
               }
          })
          setTimeout(function(){
               $("#add_template").load("get_templates.php?item="+investigation+" #add_template");
          }, 2000);
          return false;
     }else{
          return;
     }
}

//update lab template
function updateLabTemplate(){
     // saveLabTemplate();
     let investigation = document.getElementById("investigation").value;
     let template = document.getElementById("template").value;
     let gender = document.getElementById("gender").value;
     let age_from = document.getElementById("age_from").value;
     let age_to = document.getElementById("age_to").value;
     let lab_template = document.getElementById("lab_template").innerHTML;
     document.getElementById("lab_content").value = lab_template;
     let lab_content = document.getElementById("lab_content").value;
     
     if(document.getElementById("gender").disabled == false){
          if(!gender || gender == ""){
               alert("Please select gender");
               $("#gender").focus();
               return;
          }
     }
     if(document.getElementById("age_from").disabled == false){
          if(!age_from || age_from <= 0){
               alert("Please input age range");
               $("#age_from").focus();
               return;
          }
          if(!age_to || age_to <= 0){
               alert("Please input age range");
               $("#age_to").focus();
               return;
          }
          if(age_from > age_to){
               alert("age from must not be greater than age to");
               $("#age_to").focus();
               return;
          }
     }else{
          
          $.ajax({
               type : "POST",
               url : "../controller/update_lab_template.php",
               data : {template:template, investigation:investigation, gender:gender, age_from:age_from, age_to:age_to, lab_content:lab_content},
               success : function(response){
                    $("#add_template").html(response);
               }
          })
          setTimeout(function(){
               $("#add_template").load("get_templates.php?item="+investigation+" #add_template");
          }, 2000);
          return false
     }
}

//post lab result
function postLabResult(){
     saveResultTemplate();
     let investigation = document.getElementById("investigation").value;
     let patient = document.getElementById("patient").value;
     let visit = document.getElementById("visit").value;
     /* let lab_template = document.getElementById("lab_template").innerHTML;
     document.getElementById("lab_content").value = lab_template; */
     let lab_content = document.getElementById("lab_content").value;
     
     if(!lab_content || lab_content == ""){
          alert("Please input result values");
          $("#lab_template").focus();
          return;
     }else{
          let confirm_post = confirm("Are you sure you want to post this result?", "");
          if(confirm_post){
               $.ajax({
                    type : "POST",
                    url : "../controller/post_lab_result.php",
                    data : {investigation:investigation, patient:patient, visit:visit, lab_content:lab_content},
                    success : function(response){
                         $("#add_template").html(response);
                    }
               })
               
          }else{
               return;
          }
     }
}
//view lab result
function viewLabResult(result){
     window.open("../controller/lab_result.php?result="+result, "_blank");
}
//print lab result
function printLabResult(result){
     window.open("../controller/print_lab_result.php?result="+result, "_blank");
}

//send result via email
function sendMailResult(result){
     alert("Message Sending......");
     $.ajax({
          type : "GET",
          url : "../controller/send_mail_result.php?result="+result,
          success : function(){
               alert("Message Sent Successfully");
               return;
          }
     })
     

}
//recall result
function recallResult(result, url){
     let confirm_recall = confirm("Are you sure you want to recall this result?", "");
     if(confirm_recall){
          $.ajax({
               type : "GET",
               url : "../controller/recall_result.php?result="+result,
               success : function(response){
                    $("#add_template").html(response);
               }
          })
          setTimeout(function(){
               $("#add_template").load(url+" #add_template");
          },1500);
     }
}

//validate lab result
function validateLabResult(){
     let result = document.getElementById("result").value;
     let investigation = document.getElementById("investigation").value;
     let visit = document.getElementById("visit").value;
     /* let lab_template = document.getElementById("lab_template").innerHTML;
     document.getElementById("lab_content").value = lab_template;
     let lab_content = document.getElementById("lab_content").value; */
     
     /* if(!lab_content || lab_content == ""){
          alert("Please input result values");
          $("#lab_template").focus();
          return;
     }else{ */
          let confirm_post = confirm("Are you sure you want to validate this result?", "");
          if(confirm_post){
               $.ajax({
                    type : "POST",
                    url : "../controller/validate_lab_result.php",
                    data : {result:result,/* lab_content:lab_content, */ visit:visit, investigation:investigation},
                    success : function(response){
                         $("#add_template").html(response);
                    }
               })
               setTimeout(function(){
                    $("#add_template").load("validate_result.php #add_template");
               }, 1500);
          }else{
               return;
          }
     // }
}

// update username
function updateUsername(){
     let username = document.getElementById('username').value;
     let user_id = document.getElementById('user_id').value;
     let password = document.getElementById('password').value;
    
     /* authentication */
     if(password == 0 || password.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please enter password");
          $("#password").focus();
          return;
     }else if(username == 0 || username.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please enter username");
          $("#username").focus();
          return;
     }else if(password.length < 6){
          alert("Password must be greater or equal to 6 characters");
          $("#password").focus();
          return;
     
     }else{
          $.ajax({
               type: "POST",
               url: "../controller/update_username.php",
               data: {username:username, password:password, user_id:user_id},
               success: function(response){
               $(".info").html(response);
               }
          });
     }
     return false;
}
//add table row
/* function addRow(){
     let table = document.getElementById("lab_table").getElementsByTagName('tbody')[0];
     let row = table.insertRow();
     let rowIndex = table.rows.length - 1;
     let rowCount = table.rows.length;
     row.innerHTML = `
     <td class="sn">${rowCount + 1}</td>
     <td><input type="text" name="parameter[]" required></input></td>
     <td><input type="text" name="unit[]" required></input></td>
     <td>
          <select name="operator[]" onchange="updateInput(this, ${rowIndex})" required>
               <option value="">Select operator</option>
               <option value="range">Range</option>
               <option value="=">=</option>
               <option value="<"><</option>
               <option value=">">></option>
               <option value=">=">>=</option>
               <option value="<="><=</option>
          </select>
          </td>
          <td id="valueCell${rowIndex}">
          <input type="text" name="normal_value[]" required style="border:1px solid #cdcdcd">
          </td>
          <td style="cursor:pointer"><a style="color:red; cursor:pointer" href="javascript:void(0)" onclick="removeRow(this)"><i class="fas fa-trash"></i></a></td>
     `;
     updateSerialNumbers();
} */
function addRow(){
     let investigation = document.getElementById("investigation").value;
     let value_no = document.getElementById("value_no").value;
     let temp_num = document.getElementById("temp_num").value;
     let parameter = document.getElementById("parameter").value;
     let unit = document.getElementById("unit").value;
     let operator = document.getElementById("operator").value;
     let normal_value = document.getElementById("normal_value").value;
     let lower = document.getElementById("lower").value;
     let upper = document.getElementById("upper").value;
     if(operator == "range"){
          if(!lower || !upper){
               alert("Please input values");
               $("#lower").focus();
               return;
          }
          if(parseFloat(lower) >= parseFloat(upper)){
               alert("Lower limit cannot be greater than upper limit");
               $("#upper").focus();
               return;
          }
     }
     if(!parameter){
          alert("Please input parameter");
          $("#parameter").focus();
          return;
     }else if(!unit){
          alert("Please input unit");
          $("#unit").focus();
          return;
     }else if(!operator){
          alert("Please select operator");
          $("#operator").focus();
          return;
     }else if(!normal_value){
          alert("Please input normal value");
          $("#lower").focus();
          return;
     }else{
          $.ajax({
               type : "POST",
               url : "../controller/add_template_values.php",
               data : {value_no:value_no, parameter:parameter, unit:unit, operator:operator, normal_value:normal_value, lower:lower, upper:upper, temp_num:temp_num, investigation:investigation},
               success : function(response){
                    $("#body_result").html(response);
                    $("#parameter").focus();
               }
          })
          // $("#parameter").val("");
          /* $("#unit").val("");
          $("#operator").val("");
          $("#normal_value").val("");
          $("#lower_limit").val("");
          $("#upper_limit").val(""); */
     }
//     alert(normal_value+" lower:"+lower+" upper:"+upper);
}
//remove parameter button
/* function removeRow(button){
     let row = button.parentNode.parentNode;
     row.parentNode.removeChild(row);
     updateSerialNumbers();
} */
function removeRow(button, value_num){
     let row = button;
     $.ajax({
          type : "GET",
          url : "../controller/remove_row.php?parameter="+row+"&number="+value_num,
          success : function(response){
               $("#body_result").html(response);
          }
     })
     
}
/* function updateSerialNumbers() {
     let rows = document.querySelectorAll("#lab_table tbody tr");
     rows.forEach((row, index) => {
         row.querySelector(".sn").innerText = index + 1; // Ensures numbering starts from 1
     });
 }
//check operator while entering values for template
function updateInput(select, rowIndex) {
     let valueCell = document.getElementById("valueCell" + rowIndex);
     if (select.value === "range") {
         valueCell.innerHTML = `
             <input type="text" name="lower_limit[]" placeholder="Lower Limit" required style="border:1px solid #cdcdcd; width:auto!important"><input type="text" name="upper_limit[]" placeholder="Upper Limit" required style="border:1px solid #cdcdcd; width:auto!important">
             <input type="hidden" name="normal_value[]" value="">
         `;
     } else {
         valueCell.innerHTML = `<input type="number" name="normal_value[]" required>
             <input type="hidden" name="lower_limit[]" value="">
             <input type="hidden" name="upper_limit[]" value="">`;
     }
 } */
function checkOperator(operator){
     let norm_values = document.getElementById("norm_values");
     if(operator == "range"){
          norm_values.innerHTML = "<input type='text' name='lower' id='lower' placeholder='Lower Limit' style='border:1px solid #dcdcdc'> <input type='text' name='upper' id='upper' style='border:1px solid #dcdcdc' placeholder='Upper Limit'><input type='hidden' name='normal_value' id='normal_value' value='0'>";
     }else{
          norm_values.innerHTML = "<input type='text' name='normal_value' id='normal_value' style='border:1px solid #dcdcdc'><input type='hidden' name='lower' id='lower' value='0'><input type='hidden' name='upper' id='upper' value='0'>";
     }
}

//update status while entering result
function updateStatus(id, entry){
     $.ajax({
          type : "GET",
          url : "../controller/update_test_status.php?entry="+entry+"&value_id="+id,
          success :function(response){
               $("#"+id).html(response);
          }
     })
}

//delete sub menu
function deleteMenu(menu){
     let confirm_del = confirm("Are you sureyou want to delete this menu?", "");
     if(confirm_del){
          $.ajax({
               type : "GET",
               url : "../controller/delete_menu.php?menu="+menu,
               success : function(response){
                    $("#change_sub_menu").html(response);
               }
          })
          setTimeout(function(){
               $("#change_sub_menu").load("edit_sub_menu.php #change_sub_menu");
          })
     }
}