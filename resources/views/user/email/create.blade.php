@section('title','Tạo Email')
@extends('layouts.template')

@section('breadcrumb')

   <h1>GỬI EMAIL</h1>

   {{ Breadcrumbs::render('email.create') }}

@endsection


@section('content')

<section class="section">
    <div class="container">
        <div class="content-wrapper">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">THƯ MỚI</h5>
                    <form action="" method="post" enctype="multipart/form-data">
                    @csrf <!-- {{ csrf_field() }} -->
                        <div class="col-12">
                            <label for="inputNanme4" class="form-label">Người nhận:</label>
                            <select name="auth[]" class="title form-select mb-2" aria-label="Tiêu đề"></select>
                            @include('_partials.alert', ['field' => 'auth'])
                        </div>
                        
                        <div class="col-12 mt-3">
                            <label for="inputNanme5" class="form-label">Tiêu đề:</label>
                            <input type="text" name="title" class="form-control" id="floatingName" placeholder="" value="{{old('title')}}">
                            @include('_partials.alert', ['field' => 'title'])
                        </div>
                        <div class="col-3 mt-3">
                            <input class="form-control my-3" id="attachment" accept=".rar, application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint, text/plain, application/pdf, image/*" type="file" name="file[]" id="formFile" multiple>
                            <p id="files-area">
	<span id="filesList">
		<span id="files-names"></span>
	</span>
</p>
                            @include('_partials.alert', ['field' => 'file'])
                        </div>
                        
                        <div class="col-12 mt-3">
                            <label for="inputNanme5" class="form-label">Nội dung:</label>
                            <textarea class="form-control" name="content" style="height: 100px">{!! old('content', '') !!}</textarea>
                            @include('_partials.alert', ['field' => 'content'])
                        </div>
                        
                        <div class="text-center mt-2">
                            <button type="submit" class="btn btn-primary text-center">Đăng tin <i class="bi bi-chevron-double-right"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        const dt = new DataTransfer(); // Permet de manipuler les fichiers de l'input file
        $("#attachment").on('change', function(e){
            for(var i = 0; i < this.files.length; i++){
                let fileBloc = $('<span/>', {class: 'file-block'}),
                    fileName = $('<span/>', {class: 'name', text: this.files.item(i).name});
                fileBloc.append('<span class="file-delete"><span>+</span></span>')
                    .append(fileName);
                $("#filesList > #files-names").append(fileBloc);
            };
            // Ajout des fichiers dans l'objet DataTransfer
            for (let file of this.files) {
                dt.items.add(file);
            }
            // Mise à jour des fichiers de l'input file après ajout
            this.files = dt.files;

            // EventListener pour le bouton de suppression créé
            $('span.file-delete').click(function(){
                let name = $(this).next('span.name').text();
                // Supprimer l'affichage du nom de fichier
                $(this).parent().remove();
                for(let i = 0; i < dt.items.length; i++){
                    // Correspondance du fichier et du nom
                    if(name === dt.items[i].getAsFile().name){
                        // Suppression du fichier dans l'objet DataTransfer
                        dt.items.remove(i);
                        continue;
                    }
                }
                // Mise à jour des fichiers de l'input file après suppression
                document.getElementById('attachment').files = dt.files;
            });
        });

        $(".title").select2({
            tags: true,
            multiple:true,
            data: <?php echo json_encode($datas); ?>,
            maximumSelectionLength: 20,
            language: {
                maximumSelected: function (e) {
                    return "Bạn chỉ chọn tối đa được " + e.maximum + " thẻ";
                }
            },
        });
    });
</script>
@endpush


@push('styles')

<style>
#files-area{
	margin: 0 auto;
}
.file-block{
	border-radius: 10px;
	background-color: rgba(144, 163, 203, 0.2);
	margin: 5px;
	color: initial;
	display: inline-flex;
	& > span.name{
		padding-right: 10px;
		width: max-content;
		display: inline-flex;
	}
}
.file-delete{
	display: flex;
	width: 24px;
	color: initial;
	background-color: #6eb4ff00;
	font-size: large;
	justify-content: center;
	margin-right: 3px;
	cursor: pointer;
	&:hover{
		background-color: rgba(144, 163, 203, 0.2);
		border-radius: 10px;
	}
	& > span{
		transform: rotate(45deg);
	}
}
</style>