<?php include 'db_connect.php' ?>
<style>
   span.float-right.summary_icon {
    font-size: 2rem;
    position: absolute;
    right: 1rem;
    color: #ffffff96;
}
.imgs{
		margin: .20em;
		max-width: calc(100%);
		max-height: calc(100%);
	}
	.imgs img{
		max-width: calc(100%);
		max-height: calc(100%);
		cursor: pointer;
	}
	#imagesCarousel,#imagesCarousel .carousel-inner,#imagesCarousel .carousel-item{
		height: 60vh !important;background: black;
	}
	#imagesCarousel .carousel-item.active{
		display: flex !important;
	}
	#imagesCarousel .carousel-item-next{
		display: flex !important;
	}
	#imagesCarousel .carousel-item img{
		margin: auto;
	}
	#imagesCarousel img{
		width: auto!important;
		height: auto!important;
		max-height: calc(100%)!important;
		max-width: calc(100%)!important;
	}
</style>

<div class="containe-fluid">
	<div class="row ml-3 mt-4 mr-3">
        <div class="col-lg-12">
        <div class="row mb-4 mt-4">
			<div class="col-md-12">
            <div class="card">
                <body style="background-color:aqua">
                <div class="card-body">
                    <style>.red{color:red;}</style>
                    <h1><p class="red"><?php echo "Welcome Back ". $_SESSION['login_name']."..."  ?></p></h1>

                    <hr>
                    <div class="row row-cols-3">

                        
                        <div class="col">
                        <a href="http://localhost/code/alumni/admin/index.php?page=gallery">
                            <div class="card">
                                <div class="card-body bg-primary">
                                    <div class="card-body text-white">
                                        <span class="float-right summary_icon"><i class="fa fa-image"></i></span>    
                                        <p><b><h3>Gallery</h3></b></p>
                                    </div>
                                </div>
                            </div></a>
                        </div>

                        
                        <div class="col">
                        <a href="http://localhost/code/alumni/admin/index.php?page=courses">
                            <div class="card">
                                <div class="card-body bg-danger">
                                    <div class="card-body text-white">
                                        <span class="float-right summary_icon"><i class="fa fa-graduation-cap"></i></span>    
                                        <p><b><h3>Courses</h3></b></p>
                                    </div>
                                </div>
                            </div></a>
                        </div>

                       
                        <div class="col">
                        <a href="http://localhost/code/alumni/admin/index.php?page=alumni">
                            <div class="card">
                                <div class="card-body bg-info">
                                    <div class="card-body text-white">
                                        <span class="float-right summary_icon"><i class="fa fa-users"></i></span>    
                                        <p><b><h3>Alumni</h3></b></p>
                                    </div>
                                </div>
                            </div></a>
                        </div>
                        

                        
                        <div class="col">
                        <a href="http://localhost/code/alumni/admin/index.php?page=forums">
                            <div class="card">
                                <div class="card-body bg-warning">
                                    <div class="card-body text-white">
                                        <span class="float-right summary_icon"><i class="fa fa-star"></i></span>    
                                        <p><b><h3>Forum Topics</h3></b></p>
                                    </div>
                                </div>
                            </div></a>
                        </div>

                        
                        <div class="col">
                        <a href="http://localhost/code/alumni/admin/index.php?page=jobs">
                            <div class="card">
                                <div class="card-body bg-secondary">
                                    <div class="card-body text-white">
                                        <span class="float-right summary_icon"><i class="fa fa-user-tie"></i></span>    
                                        <p><b><h3>Posted jobs</h3></b></p>
                                    </div>
                                </div>
                            </div></a>
                        </div>

                        
                        <div class="col">
                        <a href="http://localhost/code/alumni/admin/index.php?page=events">
                            <div class="card">
                                <div class="card-body bg-success">
                                    <div class="card-body text-white">
                                        <span class="float-right summary_icon"><i class="fa fa-calendar-day"></i></span>    
                                        <p><b><h3>Upcoming Events</h3></b></p>
                                    </div>
                                </div>
                            </div></a>
                        </div>
                    </div>	    
                </div>
            </div>      			
        </div>
    </div>
</div>
<script>
	$('#manage-records').submit(function(e){
        e.preventDefault()
        start_load()
        $.ajax({
            url:'ajax.php?action=save_track',
            data: new FormData($(this)[0]),
            cache: false,
            contentType: false,
            processData: false,
            method: 'POST',
            type: 'POST',
            success:function(resp){
                resp=JSON.parse(resp)
                if(resp.status==1){
                    alert_toast("Data successfully saved",'success')
                    setTimeout(function(){
                        location.reload()
                    },800)

                }
                
            }
        })
    })
    $('#tracking_id').on('keypress',function(e){
        if(e.which == 13){
            get_person()
        }
    })
    $('#check').on('click',function(e){
            get_person()
    })
    function get_person(){
            start_load()
        $.ajax({
                url:'ajax.php?action=get_pdetails',
                method:"POST",
                data:{tracking_id : $('#tracking_id').val()},
                success:function(resp){
                    if(resp){
                        resp = JSON.parse(resp)
                        if(resp.status == 1){
                            $('#name').html(resp.name)
                            $('#address').html(resp.address)
                            $('[name="person_id"]').val(resp.id)
                            $('#details').show()
                            end_load()

                        }else if(resp.status == 2){
                            alert_toast("Unknow tracking id.",'danger');
                            end_load();
                        }
                    }
                }
            })
    }
</script>
