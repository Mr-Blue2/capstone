
    function isEmail(email) {
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        return regex.test(email);
    }

    function isContactNum(test) { 
        var regex = /^(09|\+639)\d{9}$/;
        return regex.test(test);
    }

    function isCharacter(string) { 
        var regex = /^[A-Za-z]+$/;
        return regex.test(string);
     }

     function isDigit(string) { 
        var regex = /^[0-9]+$/;
        return regex.test(string);
     }

$(document).ready(function() {
    $('.spinner-grow').hide();


    



    $('#last_name, #first_name, #middle_name, #block').on('keydown', function(event) {
        if (this.selectionStart == 0 && event.keyCode >= 65 && event.keyCode <= 90 && !(event.shiftKey) && !(event.ctrlKey) && !(event.metaKey) && !(event.altKey)) {
           var $t = $(this);
           event.preventDefault();
           var char = String.fromCharCode(event.keyCode);
           $t.val(char + $t.val().slice(this.selectionEnd));
           this.setSelectionRange(1,1);
        }
    });

      // logging in part
      $('#btn-login').on('click', function(e) {
        var login_id= $('#login_id').val(),
            login_pass =$('#login_pass').val();
            if(login_id===""|| login_pass===""){
                $.alert({
                    title: 'Check',
                    content: 'Input your account credentials',
                });
              
            }else{
                $.ajax({
                    type: 'POST',
                  
                    url: './includes/action.inc.php',
                    data: {
                        'login_id': login_id,
                        'login_pass': login_pass,
                    },
                    success: function(data) {
        
                        if(data.trim()==''){
                            location.href="home.php";
                        }else{
                             $.alert({
                                title: 'Alert',
                                content:data,
                            });
                        }   
    
                    }
                });
            }
      });
  
    // registration

    // passsword
    $(".pr-password").passwordRequirements({
          numCharacters: 6,   
          useLowercase:true,
          useUppercase:true,
          useNumbers:true,
          useSpecial:true,
        });

    //password match
    // $('input').on('input',function() {
    //     var pass = $('input[name=password]'),
    //         reps = $('input[name=confirm_password]'),
    //         pass_cont = $('#password'),
    //         reps_cont = $('#confirm_password');
    //      !$(this).is( '[name=password]' ) || $(function() {
    //          pass_cont.addClass( pass.val().length === 0 ? 'has-error' : 'has-success' )
    //          .removeClass( pass.val().length === 0 ? 'has-success' : 'has-error' );
    //      })();
    //      !$(this).is( '[name=confirm_password]' ) || $(function() {
    //          reps_cont.addClass( reps.val() === pass.val() ? 'has-success' : 'has-error' )
    //          .removeClass( reps.val() === pass.val() ? 'has-error' : 'has-success' );
    //      })();
    // });

    // department course choices
    $("#department").on("change",function(){
        var departmentId = $(this).val();
        if (departmentId) {
         $.ajax({
       url :"./includes/action.inc.php",
       type:"POST",
       timeout: 1000,
       cache:false,
       data:{'departmentId':departmentId},
       success:function(data){
           $("#course").html(data);
           
         }
         });
        }else{
       $('#course').html('<option value="">Select Course</option>');
        }
     });
    
    // register
    $('#btn-register').on('click', function(e) {
        e.preventDefault(e);
        
        var bu_email = $('#bu_email').val(),
            bu_number = $('#bu_number').val(),
            last_name = $('#last_name').val(),
            first_name = $('#first_name').val(),
            middle_name = $('#middle_name').val(),
            gender = $('input[name="gender"]:checked').val(),
            department = $("#department option:selected").val(),
            course = $("#course option:selected").val(),
            year = $("#year").val(),
            block = $("#block").val(),
            contact_num = $("#contact_num").val(),
            password = $('input[name=password]').val(),
            confirm_password = $('input[name=confirm_password]').val(),
            agree =$('input[name="agree"]:checked').val();

            //test

            var fd = new FormData();
            var files = $('#file')[0].files;


            bu_email.trim();
            password.trim();
            confirm_password.trim();
            
            // Check file selected or not
           
            fd.append('file',files[0]);
            fd.append('bu_email',bu_email);
            fd.append('bu_number',bu_number);
            fd.append('last_name',last_name);
            fd.append('first_name',first_name);
            fd.append('middle_name',middle_name);
            fd.append('gender',gender);
            fd.append('department',department);
            fd.append('course',course);
            fd.append('year',year);
            fd.append('block',block);
            fd.append('contact_num',contact_num);
            fd.append('password',password);
            
            $('#myform').validate({
                rules: {
                    file: {
                        required: true,
                        extension: "jpg,jpeg,pdf,png",
                        filesize: 1000
                    }
                },
            });
        

       //error handling
        if (bu_email === "" || bu_number === "" || last_name === "" || first_name === "" ||
            middle_name === "" || gender === "" || department === "" || course === "" ||
            year === "" || block === "" || contact_num === "" || password === "" || confirm_password==="") {
                $.alert({
                    title: 'Check',
                    content: 'Input All Fields',
                });
        } else if(files.length == 0 ){
                $.alert({
                    title: 'Check',
                    content: 'No file uploaded',
                });
            
        }else if(isEmail(bu_email)==false){
                $.alert({
                    title: 'Check Your Email',
                    content: 'Email not accepted',
                });
        }
        // }  else if(isCharacter(first_name)==false|| isCharacter(last_name)==false|| isCharacter(middle_name)==false|| isCharacter(block)==false ){
        //     $.alert({
        //         title: 'Invalid',
        //         content: 'Special Characters are not allowed',
        //     });
        // }
        else if(isDigit(year)==false){
            $.alert({
                title: 'Invalid Input',
                content: 'Allows Digit Only" ',
            });

        }
        else if(isContactNum(contact_num)==false){
            $.alert({
                title: 'Check Your Number',
                content: 'Your number must start with "09" or "+639" ',
            });

        }
        else if (password !== confirm_password) {
            $.alert({
                title: 'Check Your Password',
                content: 'Password not the Same ',
            });
        }
        // else if(agree!==""){
        //     $("#agree_text").css('color', 'red');
        // }else if(agree==""){
        //     $("#agree_text").css('color', '');
        // }
        else{
            $.ajax({
                type: 'POST',
                url: './includes/action.inc.php',
                data:fd,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('.spinner-grow').show();
                },
                success: function(data) { 
                    $('.spinner-grow').hide();

                    if(data.trim()==='1'){
                         function pageRedirect() {
                            window.location.replace("login.php?status=ok&email="+bu_email);
                        }      
                        setTimeout(pageRedirect(), 3000);
                    }else{
                        $.alert({
                            content: data,
                        });
                    }
                 
                },
                complete: function(data) {
                 
                }
            });

       }

    });

  


});