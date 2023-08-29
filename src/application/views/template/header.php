<html>
        <head>
                <title>Online Learning Platform</title>
                <link rel="stylesheet" type="text/css" href="../../../assets/css/bootstrap.css">
                <script src="../../../assets/js/bootstrap.min.js"></script>
                <script src="../../../assets/js/bootstrap.js"></script>
                <!-- google map show current location -->

                <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>


                <!-- google retcha reference from https://developers.google.com/recaptcha/docs/v3 -->
                <script src="https://www.google.com/recaptcha/api.js" async defer></script>
                
        </head>

        <body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Online Learning Platform</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
        <li class="nav-item">
            <a href="/login"> Home </a>
        </li>
    </ul>
    <ul class="navbar-nav my-lg-0">
    <?php if(!$this->session->userdata('logged_in')) : ?>
          <li class="nav-item">
            <a href="/login"> Login </a>
            <a href="/signup"> Sign Up </a>
            
          </li>
          <?php endif; ?>
          <?php if($this->session->userdata('logged_in')) : ?>
            <li class="nav-item">
            <a href="/login/logout"> Logout </a>
           </li>
           <?php endif; ?>
    </ul>

    </div>
    <!-- <form class="form-inline my-2 my-lg-0"> -->
      <!-- <?php echo form_open('ajax'); ?> -->
      <!-- <input class="form-control mr-sm-2" type="search" id="search_text" placeholder="Search" name="search" aria-label="Search"> -->
      <!-- <button class="btn btn-outline-success my-2 my-sm-0" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">Search </button> -->
      <!-- <?php echo form_close(); ?> -->
</nav>
<div class="container">
<div class="collapse" id="collapseExample">
  <div class="card card-body" id="result">

  </div>
</div>
<!-- <script>
    $(document).ready(function(){
    load_data();
        function load_data(query){
            $.ajax({
            url:"ajax/fatch",
            method:"GET",
            data:{query:query},
            success:function(response){
                $('#result').html("");
                if (response == "" ) {
                    $('#result').html(response);
                }else{
                    var obj = JSON.parse(response);
                    if(obj.length>0){
                        var items=[];
                        $.each(obj, function(i,val){
                            let course = '<a href="<?php echo base_url()?>/course/index/';
                            course = course + val.course_name + '">Go To Course</a>';
                            items.push($("<h1>").text(val.course_name));
                            items.push($("<h5>").text('designed by ' + val.course_creator));
                            console.log(course);
                            items.push(course);
                            
                            
                            
                    });
                    $('#result').append.apply($('#result'), items); 

                    }else{
                    $('#result').html("Not Found!");
                    }; 
                };
            }
        });
        }
        $('#search_text').keyup(function(){
            var search = $(this).val();
            if(search != ''){
                load_data(search);
            }else{
                load_data();
            }
        });
    });
</script> -->

