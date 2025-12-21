@extends('admin.layouts.template')

@include('admin.layouts.partials.crud.import')

{{-- NOTE: Pertinente à importação e seus modelos --}}
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.5/xlsx.min.js"></script> 

<script>
    $(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                "Content-Type": "application/x-www-form-urlencoded"
            }
        }); 
    });

    $(document).ready(function(){
        renderImportationModelToDownload();
    });

    $('#file_upload').on('change', upload);

    function renderImportationModelToDownload() {
        var button = "<a href='/files/templates/usuarios.xlsx' id='import_model' class='btn btn-secondary download mr-2' download>Baixar modelo</a>";
        $('#import-area').append(button);
    }

    // NOTE: Não utilizado, vai ficar aqui caso precise usar o botão
    function renderButtonImport() {
        var button = "<button type='button' class='btn btn-primary' id='button_upload_import' onclick='upload()'>Importar</button>";
        $('#import-area').append(button);
    }

    function upload() {
        var files = document.getElementById('file_upload').files;

        if(files.length==0){
          alert("Selecione um arquivo...");
          return;
        }

        var filename = files[0].name;
        var extension = filename.substring(filename.lastIndexOf(".")).toUpperCase();
        if (extension == '.XLS' || extension == '.XLSX') {
          excelFileToJSON(files[0]);
        } else{
          alert("Selecione um arquivo .XLS ou .XLSX válido.");
        }
    }

    //Method to read excel file and convert it into JSON 
    function excelFileToJSON(file){
        try {
            var reader = new FileReader();
                reader.readAsBinaryString(file);
                reader.onload = function(e) {
            var data = e.target.result;
            var workbook = XLSX.read(data, { type : 'binary' });
            var result = {};

            workbook.SheetNames.forEach(function(sheetName) {
                var roa = XLSX.utils.sheet_to_row_object_array(workbook.Sheets[sheetName]);

                if (roa.length > 0) {
                    result[sheetName] = roa;
                }
            });

            //displaying the json result
            var resultEle=document.getElementById("json-result");
            // let jsonObject = result; // NOTE: JSON.stringify(result) - pode dar B.O. com a versão do JQuery
            let jsonObject = result;
                dt = {'knowledge':jsonObject};
        
            $.ajax({
                type: "POST",
                url: "{{ route('web.admin.users.send-import') }}",
                data:dt,
                success: function(data) {
                    //toastr.success('Validado com Sucesso.');
                    location.href = "{{ route('web.admin.users.index') }}";
                }
            });
            //resultEle.style.display='block';
        }
        } catch(e){
            console.error(e);
        }
    }
</script>
@endpush

