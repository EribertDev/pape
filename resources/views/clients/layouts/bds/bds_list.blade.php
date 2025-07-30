<div class="row">
@foreach($bds as $db)
    <div class="col-lg-3 col-md-4 col-sm-6 mix" style="display: inline-block;" data-bound="" >
        <div class="product-grid border border-0 rounded-3 shadow-lg" >
            <div class="product-image">
                <a href="#">
                    <img class="pic-1" src="{{asset('clients/assets/images/shop/9.jpg')}}"
                            alt="product image">
                    <img class="pic-2" src="{{asset('clients/assets/images/shop/10.jpg')}}"
                            alt="product image">
                </a>

                <ul class="social">
                    <li>
                        <a  href="{{route('bd.detail',["uuid"=>$db->uuid,"fakeUuid"=>Str::uuid()])}}"  {{--onclick="event.preventDefault();this.closest('form').submit();"--}} data-tip="Voir">
                            <i class="ti-eye"></i>
                        </a>
                        {{--<form action="{{route('bd.detail')}}" method="POST">
                            @csrf
                            <!-- Remplacez '123' par l'ID de produit approprié -->
                            <input type="hidden" name="bd_uuid" value="{{$db->uuid}}">

                        </form>--}}
                    </li>
                </ul>
                <span class="product-new-label">Nouveau</span>
            </div>
            {{-- <ul class="rating">
                    <li class="fa fa-star"></li>
                    <li class="fa fa-star"></li>
                    <li class="fa fa-star"></li>
                    <li class="fa fa-star"></li>
                    <li class="fa fa-star disable"></li>
                </ul>--}}
            <div class="product-content">
                <h3 class="title"><a href="#">{{$db->name}}</a></h3>
                <div class="price">{{ number_format($db->amount, 0, ',', '.') . ' F CFA (XOF)' }}
                </div>
                <div >
                    <a href="{{route('bd.detail',["uuid"=>$db->uuid,"fakeUuid"=>Str::uuid()])}}" 
                        class="btn btn-primary fw-bold mb-4 px-4 py-2 d-flex align-items-center justify-content-center payer-link fw-bold commande-bd"
                        style="border-radius: 25px; background: linear-gradient(to right, #6a11cb, #2575fc); color: #fff; transition: all 0.3s ease; text-decoration: none; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);">
                        <i class="bi bi-cart-plus me-2"></i>
                        Commander
                        </a>
                        
                    
                </div>
            </div>
        </div>
    </div>
@endforeach
<div class="pagination-container">
    {{ $bds->links('pagination::bootstrap-5') }}
</div>
</div>