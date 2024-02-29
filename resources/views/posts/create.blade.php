<head>
<style>
        body{
            background-color: #121212;
        }
        .card{
            background-color: #232222;
        }
        .modal-content{
            background-color: #262626;
        }
        #filebtn {
        /* position: absolute;
        bottom: 0;
        left: 15px;
        width: 100%;
        height: 100%;
        opacity: 0; 
        cursor: pointer;  */
    }
    #addIcon{
    position: absolute;
    top: 65%;
    left: 0;
    transform: translate(-50%, -50%);
    z-index: 1;
        
    }
    
    /* .carousel-item{
        position: relative;
        width: 100%;
        height: 100%;
          
    } */
    .modal-header {
        border-bottom: 2px solid #363636;
        
    }

    .carousel-item img{
        width: auto;
        height: 400px;
        object-fit: cover;
    }
    .modal-title{
  width: 100%;
  text-align: center;
}
     
    </style>

</head>
<body>
 
<div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1" >
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5 text-light" id="exampleModalToggleLabel">Create new post</h1>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="form-group row justify-content-center position-relative" id="ImagePrev">
                
                     {{-- images preview --}}
                    <div class="col-7" >
                        <div id="carouselExampleIndicators" class="carousel slide d-none">  
                            <div class="carousel-inner" id="carousel-inner">
                                <div class="carousel-item">
                            {{-- images uploaded dynamicaly saved here :) --}}                                    
                                </div>
                             </div>
                             <button class="carousel-control-prev" id="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev" style="display: none">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                              </button>
                              <button class="carousel-control-next" id="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next" style="display: none">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                              </button>
                            </div>

                    </div>

                    {{-- Upload btn for first time --}}
                    <div class="col-md-6 text-center m-5" id="addFiles">
                        <i  id="icon" class="far fa-images fa-5x mt-3" style="color: white;"></i>
                        <div class="custom-file mt-5">
                            <label class="btn btn-primary">
                                Select from your device
                                <input type="file" id="filebtn" class="custom-file-input m-3 ms-5 text-light images" name="files[]" multiple onchange="previewImages()" style="display: none">   
                            </label>
                        </div>
                    </div>
                        {{-- upload icon for add more images --}}
                    <div class="col-md-6 text-center m-5" id="addIcon" style="display: none" >
                        <div class="custom-file mt-5">
                            <label class="fa-regular fa-clone fa-2x">
                                <input type="file" class="custom-file-input m-3 ms-5 text-light images" name="files[]" multiple onchange="previewImages()" style="display: none">   
                            </label>
                        </div>
                    </div>
                    
                    <div class="col-md-5 position-absolute top-0 end-0"  id="caption" style="display: none;">   
                    {{-- profile caption's details --}}
                        {{-- <div class="row"> --}} 
                            <div class="d-flex align-items-center">
                                <div class="rounded-circle border d-flex justify-content-center align-items-center" style="width:50px;height:50px" alt="Avatar">
                                    <img height="50" class="rounded-circle" src="{{Storage::url($user->profile->avatar)}}" alt="userName Avatar">
                                </div>
                                <p class="fw-bold text-light ms-3 mt-1">{{$user->userName}}</p>
                            </div>
                            
                        {{-- </div> --}}
                     {{-- Caption --}}
                        <div class="form-floating">
                        <textarea  name="caption" class="form-control text-light" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px; background-color:#262626;border: none; "></textarea>
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
        {{-- <div class="modal-footer">
          <button class="btn btn-primary" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal">Open second modal</button>
        </div> --}}
      </div>
    </div>
  </div>
  {{-- <div class="modal fade" id="exampleModalToggle2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalToggleLabel2">Modal 2</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Hide this modal and show the first with the button below.
        </div>
        <div class="modal-footer">
          <button class="btn btn-primary" data-bs-target="#exampleModalToggle" data-bs-toggle="modal">Back to first</button>
        </div>
      </div>
    </div>
  </div> --}}
 

<script>
    function previewImages() {
    
       var previewContainer = document.getElementById('carousel-inner');
        imgIcon = document.getElementById('icon');
        caption = document.getElementById('caption');
        submitBtn = document.getElementById('submitBtn');
        imgSlider = document.getElementById('carouselExampleIndicators');
        carouselControlPrev = document.getElementById("carousel-control-prev");
        carouselControlsNext = document.getElementById("carousel-control-next");

        ImagesUplaodedView = document.getElementById('ImagePrev');
        ImagesUplaodedView.classList.remove('justify-content-center');


        previewContainer.innerHTML = ''; // Clear previous previews
        
        // var files = document.getElementById('filebtn').files;
        var fileInputs = document.querySelectorAll('.images');
        var files = [];
        fileInputs.forEach(function(input) {
            if (input.files.length > 0) {
                for (var i = 0; i < input.files.length; i++) {
                    files.push(input.files[i]);
                }
            }
        });
        // console.log(files);
        for (let i = 0; i < files.length; i++) {
            let file = files[i];
            let reader = new FileReader();
            
            reader.onload = function(e) {
            let sliderElement = document.createElement('div');    
            let imgElement = document.createElement('img');
            imgElement.classList.add('d-block');
            sliderElement.appendChild(imgElement);
            sliderElement.classList.add('carousel-item');
           
            imgElement.src = e.target.result;
            previewContainer.appendChild(sliderElement);

            if (i === 0) {
            sliderElement.classList.add('active');
        } else {
            sliderElement.classList.remove('active'); // Ensure only one image is active
        }
            if(files.length > 1){

                carouselControlPrev.style.display = "block";
                carouselControlsNext.style.display = "block";
            
            }
            console.log(i);
            }
            
            reader.readAsDataURL(file);
        }
            imgIcon.remove();
            caption.style.display = 'block';
            submitBtn.style.display = 'block';
            imgSlider.classList.remove('d-none');
            imgSlider.classList.add('d-block');
            // console.log(document.getElementById('filebtn').files);
        
        // chanage add files button to icons on image
        document.getElementById('addFiles').style.display = 'none';
        document.getElementById('addIcon').style.display = 'block';

        
    }
 
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  
</body>
</html>