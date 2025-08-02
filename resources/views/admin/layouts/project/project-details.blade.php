@extends('admin.master')
@section('extra-style')
    <link rel="stylesheet" href="{{asset('stdev/css/badge-status.css')}}">


@endsection

@section('page-content')
   
    <div class="content">
        <div class="container-fluid">
           <div class="row">
               <h4 class="page-title col-9" >Stage : {{$request["id"]}}</h4>

               <div class="col-3">
                   <div class="d-grid d-md-none gap-2 d-flex justify-content-end ">
                       @if (strtolower($request->status)==="pending")
                           <a class="btn btn-success text-white btn-sm btn-floating accepter" data-mdb-ripple-init style="background-color:  #2eca7f;" href="#!" role="button" id="accepterBtn1">
                            <i class="fa-solid fa-share" style="transform: rotateY(180deg)"></i>
                            </a>
                            <a class="btn btn-danger text-white btn-sm btn-floating reject" data-mdb-ripple-init style="background-color: #55acee;" href="#!" role="button" id="rejectBtn1">
                                <i class="fa-solid fa-share" style="transform: rotateY(180deg)"></i>
                            </a>
                       @endif
                       <a class="btn text-white btn-sm btn-floating" data-mdb-ripple-init style="background-color: #55acee;" href="#!" role="button">
                           <i class="fa-solid fa-print"></i>
                       </a>
                   </div>

                   <div class="d-grid d-none d-md-block gap-2 d-md-flex justify-content-end">
                    @if (strtolower($request->status)==="pending")
                        <a class="btn btn-success text-white accepter" data-mdb-ripple-init style="background-color:   #2eca7f;" role="button" id="accepterBtn2">
                            <i class="fa-solid fa-share" style="transform: rotateY(180deg)"></i>
                            Accepter
                        </a>
                        <a class="btn btn-danger text-white reject" data-mdb-ripple-init style="background-color: #55acee;" role="button" id="rejectBtn2">
                            <i class="fa-solid fa-share" style="transform: rotateY(180deg)"></i>
                            Rejeter
                        </a>
                       @endif
                   
                       <a class="btn text-white" data-mdb-ripple-init style="background-color: #55acee;" href="#!" role="button">
                           <i class="fa-solid fa-print"></i>
                           Imprimer
                       </a>
                   </div>
               </div>
           </div>

            <div class="row">
                <div class="col-sm-12 col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="row"><h5 class="col-7 card-title text-start">Detail</h5><div class="col-5 text-end" id="cmdStatus"></div>
                            </div>
                            <p class="card-text"><span class="fw-bold">ID : </span><span>{{$request["id"]}}</span> </p>
                       
                            <p class="card-text"><span class="fw-bold">Statut : </span> @if($request->status==="pending") <span class="badge bg-warning">En attente</span> @elseif ($request->status==="approved")<span class="badge bg-success"> Accepté </span> @elseif ($request->status==="rejected") <span class="badge bg-danger">Rejeté </span> @elseif($request->status==="under_review") <span class="badge bg-info">En cours de traitement @endif</p>
                            <p class="card-text"><span class="fw-bold">Date : </span><span>{{$request["created_at"]}}</span> </p>
                       
                        <p class="card-text"><span class="fw-bold">Fichier joint : </span>
                            @if(!empty($request["document_path"]))
                                <a class="btn-sm text-white mx-1 download-btn" 
                                style="background-color: #2eca7f;" 
                                href="{{ route('admin.project-document.download', $request->id) }}"
                                onclick="handleDownload(event, this)">
                                    <i class="fa-solid fa-download"></i>
                                    <span class="download-status"></span>
                                </a>
                            @else
                                <span class="text-danger">Non fournie</span>
                            @endif
                        </p>
                          
                            
                        </div>
                    </div>
                </div>
                </div>
                <div class="col-sm-6">
                    <div class="card">
                       {{--
                        Ajouter les demandes de redactions du clients après   --}}
                    </div>

                    
                    </div>

                   
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Fichier Final
                               
                             
                            </h5>
                            <div class="form-group">
                            <form id="authorizationForm" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="project_id" value="{{ $request->id }}">
                                
                                <div class="mb-3">
                                    <label for="final_file" class="form-label"> Fichier <span class="required-star">*</span></label>
                                    <input type="file" class="form-control" id="final_file" 
                                        name="final_file" accept=".pdf,.docx,.xlsx" required>
                                    <small class="form-text text-muted">Format PDF uniquement, max 2MB</small>
                                </div>
                                
                                <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-3">
                                    <button type="submit" class="btn btn-primary" id="submitBtn">
                                        <span class="spinner-border spinner-border-sm" id="spinner" role="status" hidden></span>
                                       Soumettre
                                    </button>
                                </div>
                            </form>

                            </div>
                        </div>
                    </div>
                   
                </div>
            </div>
        </div>
    </div>
@endsection

@section('extra-scripts')
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   
        <script>
       
        $(document).ready(function() {
    $('#authorizationForm').submit(function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        const submitBtn = $('#submitBtn');
        const spinner = $('#spinner');
        
        // Afficher le spinner
        submitBtn.prop('disabled', true);
        spinner.removeAttr('hidden');

        $.ajax({
            url: "{{ route('final-file.upload') }}",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Succès',
                        text: response.message,
                        confirmButtonText: 'OK'
                    });
                    
                    // Fermer le modal après succès
                    submitBtn.prop('disabled', false);

                    $('#spinner').attr('hidden', true);
                    
                    // Rafraîchir la table DataTables
                    $('#internshipsTable').DataTable().ajax.reload();
                     
                }
            },
            error: function(xhr) {
                let errorMessage = "Erreur lors de l'envoi";
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMessage = xhr.responseJSON.message;
                }
                Swal.fire('Erreur', errorMessage, 'error');
            },
            complete: function() {
                submitBtn.prop('disabled', false);
                spinner.attr('hidden', true);
                
            }
        });
    });
});

       
    </script>


@endsection
