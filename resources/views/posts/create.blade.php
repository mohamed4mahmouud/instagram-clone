<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create new post</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body{
            background-color: #121212;
        }
        .card{
            background-color: #232222;
        }
        .carousel-item {
            width: 100%;
            height: 100%;
          
           
        }
        .carousel-item img{
            object-fit: cover;
        }
        #files {
        position: absolute;
        bottom: 0;
        left: 15px;
        width: 100%;
        height: 100%;
        /* opacity: 0; Hide the input element */
        cursor: pointer; /* Change cursor to pointer when hovering over the input */
    }
     
    </style>

</head>
<body>
   
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-light text-center fw-bold fs-4">Create a new post</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row justify-content-center position-relative" id="ImagePrev">
                        
                             {{-- images preview --}}
                            <div class="col-6" >
                                <div id="carouselExampleIndicators" class="carousel slide d-none">  
                                    <div class="carousel-inner">
                                        <div class="carousel-item">
                                    {{-- images uploaded dynamicaly saved here :) --}}                                    
                                        </div>
                                     </div>
                                     <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                      </button>
                                      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                      </button>
                                    </div>

                            </div>
{{-- 
                                <div class="col-md-auto" id="verticalline" style="display: none">
                                <div class="vr bg-secondary"></div>
                                </div> --}}

                            <i class="fa-regular fa-clone fa-2x text-light files" style="display: none"><label for=""></label></i>    
                            <input type="file" class="custom-file-input text-light files" name="files[]" multiple onchange="previewImages()" style="visibility: hidden">   
                            

                            {{-- Upload icon and btn --}}
                            <div id="icon" class="col-md-6 text-center m-5">
                                <i class="far fa-images fa-5x mt-3" style="color: white;"></i>
                                    <div class="custom-file mt-5">
                                        <button  type="button" id="addFiles" class="btn btn-primary"><label class="custom-file-label text-light fw-semibold" for="files">Select from your device</label></button>
                                        <input type="file" id="files" class="custom-file-input m-3 ms-5 text-light files" name="files[]" multiple onchange="previewImages()" style="visibility: hidden">   
                                    </div>
                            </div>

                            
                            <div class="col-md-6 position-absolute top-0 end-0"  id="caption" style="display: none;">  
                              
                            {{-- profile caption's details --}}
                                {{-- <div class="row"> --}}

                                    <div class="d-flex align-items-center">
                                        <div class="rounded-circle border d-flex justify-content-center align-items-center" style="width:40px;height:40px" alt="Avatar">
                                            <i class="fas fa-user-alt text-info"></i>
                                        </div>
                                        <p class="fw-bold text-light ms-2 mt-3">UserName</p>
                                    </div>
                                    
                                {{-- </div> --}}
                             {{-- Caption --}}
                                <div class="form-floating">
                                <textarea  name="caption" class="form-control text-light" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px; background-color:#232222;border: none; "></textarea>
                                <label for="floatingTextarea2" style="color:#9d9d9d">Write a caption here...</label>
                              </div>
                            </div>

                        <div class="form-group row mb-0" id="submitBtn" style="display: none;">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary float-md-end">
                                    Create Post
                                </button>
                            </div>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    function previewImages() {
    
        var previewContainer = document.querySelector('.carousel-inner');
        imgIcon = document.getElementById('icon');
        caption = document.getElementById('caption');
        submitBtn = document.getElementById('submitBtn');
        imgSlider = document.getElementById('carouselExampleIndicators');
        carouselControlPrev = document.querySelector(".carousel-control-prev");
        carouselControlsNext = document.querySelector(".carousel-control-next");

        ImagesUplaodedView = document.getElementById('ImagePrev');
        ImagesUplaodedView.classList.remove('justify-content-center');

        // vertical line appear when images uploaded
        vr = document.getElementById('verticalline');
        // vr.style.display = 'block';

        previewContainer.innerHTML = ''; // Clear previous previews
        
        var files = document.getElementById('files').files;

        multipleImgIcon = document.querySelector('.files');
        multipleImgIcon.style.display = 'block';
        
        for (let i = 0; i < files.length; i++) {
            let file = files[i];
            let reader = new FileReader();
            
            reader.onload = function(e) {
               
            let sliderElement = document.createElement('div');    
            let imgElement = document.createElement('img');
            imgElement.classList.add('d-block', 'w-100');
            sliderElement.appendChild(imgElement);
            sliderElement.classList.add('carousel-item')
           
            imgElement.src = e.target.result;
            previewContainer.appendChild(sliderElement);

            if (i === 0) {
                sliderElement.classList.add('active');
                console.log('here');
            }
            if(files.length == 1){
                
                carouselControlPrev.style.display = "none";
                carouselControlsNext.style.display = "none";
            
            }
            console.log(files.length);
            }
           
            
            
            reader.readAsDataURL(file);

            imgIcon.remove();
            caption.style.display = 'block';
            submitBtn.style.display = 'block';
            imgSlider.classList.remove('d-none');
            imgSlider.classList.add('d-block');
        }

        
    }
 
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  
</body>
</html>