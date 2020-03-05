@extends('layouts.app')

@push('css')
<!-- <link rel="stylesheet" href="{{asset('css/barfiller_progressbar.css')}}">

<script src="http://code.jquery.com/jquery-1.9.1.min.js" type="text/javascript"></script> -->
@endpush

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Photo Gallery</div>

                <div class="card-body" id="card_body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    
                </div>
            </div>
        </div>
    </div>
</div>





<div class="modal" tabindex="-1" role="dialog" id="photo_modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" method="post" enctype="multipart/form-data" id="target">
        {{csrf_field()}}
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Title" required>
            </div>       
            <div class="form-group">
                <label for="photo">Photo</label>
                <input type="file" name="photo" id="photo" class="form-control" required onchange="get_image_data()">
            </div>
                <button disabled type="submit" id="save_button" class="btn btn-primary">Save</button>
            </form>

            <!-- <a class="nav-link" href="javascript:void(0)" onclick="closePhotoModal()">Close</a> -->
      </div>
      <div class="modal-footer">
        <!-- <button type="submit" id="save_button"  class="btn btn-primary">Save changes</button> -->
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>
@endsection

@push('js')
<!-- <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script>    
    function openPhotoModal(){
        $('#target').trigger('reset');
        $('#photo_modal').modal('show');
    }

    function get_image_data(){
        var property = document.getElementById('photo').files[0];
        console.log(property);
        var image_name = property.name;
        var extension = image_name.split('.').pop().toLowerCase();
        if(extension === 'png'){
            var image_size = property.size;
            console.log(image_size);
            if(image_size > 5000000){
                Swal.fire({
                icon: 'error',
                title: 'Oops...',
                timer:3000,
                text: `File size is too large.<br>Please upload below 5mb size image.`
                })
                $('#save_button').prop('disabled',true);
            }else{
                $('#save_button').prop('disabled',false);
            }
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Please select PNG file to upload',
                timer:3000,
                })
                $('#save_button').prop('disabled',true);
        }
        
    }

    function get_all_photos(){
        $.ajax({
            type : 'get',
            url : "{{route('get_all_photos')}}",
            dataType : 'json',
            success : function(data){
                var html = `<div class="row">`;
                data.forEach(function(value,key){
                    var stln = value.title.length;
                    console.log(stln);
                    html += `<div class="col-md-3">
                        <h4 class="text-center" id="photo_title${value.id}">`;
                        if(stln > 20){
                            html+= `<span id="jamal${value.id}">${value.title}</span>`
                            
                            $("#jamal"+value.id).animate({height: "300px"});
                            
                        }else{
                            html+=value.title
                        }
                        
                    html += `</h4>
                        <img width="100%" src="{{asset('images')}}/${value.photo}" />
                    </div>`;
                });
                html+=`</div>`;
                $('#card_body').html(html);
            }
        });
    }

   
    $(document).ready(function(){
        get_all_photos();
        // $('input[type="file"]').change(function(e){
        //     var fileName = e.target.files[0].name;
        // });

        $('#target').on('submit',function(e){
            e.preventDefault();    

            $('#bar1').css('display','block');
            var count = 100;
            // count++;
            $('.fill').attr('data-percentage',`${count}`);
            $('#bar1').barfiller({ barColor: '#900' });
            
            var formData = new FormData(this);
            $.ajax({
                type : 'post',
                url : "{{route('save_photo')}}",
                data : formData,
                dataType : 'json',
                processData: false,
                contentType: false,
                cache : false,
                success : function(data){
                    console.log(data.message);
                    get_all_photos();
                    if(data){
                        var count = 100;
                        $('.fill').attr('data-percentage',`${count}`);
                        $('#bar1').css('display','none');
                        $('#photo_modal').modal('hide');
                        Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: data.message,
                        showConfirmButton: false,
                        timer: 1500
                        })
                    }
                    
                    
                }
            });
        });
    });

</script>
@endpush
