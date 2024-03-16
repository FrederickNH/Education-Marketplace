@extends('layouts.ekka')

@section('content')

<section class="ec-page-content ec-vendor-uploads ec-user-account section-space-p">
    <div class="container">
        <div class="row">
            <div class="ec-shop-rightside col-lg-12 col-md-12">
                <div class="ec-vendor-dashboard-card ec-vendor-setting-card">
                    <div class="ec-vendor-card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="ec-vendor-block-profile">
                                    <div class="row">
                                        <div>
                                            <h5>List of Tutors Offer</h5>    
                                        </div>
                                    </div>
                                    <section class="ec-page-content section-space-p">
                                        <div class="container">
                                            <div class="row">
                                                <div class="ec-tab-wrapper ec-tab-wrapper-1">
                                                    <div class="ec-single-pro-tab-wrapper">
                                                        <div class="ec-vendor-card-body">
                                                            <table class="table ec-table">
                                                                <thead>
                                                                    <tr>
                                                                        <th scope="col">Tutor Name</th>
                                                                        <th scope="col">Price</th>
                                                                        <th scope="col"></th>
                                                                        <th></th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach($offers as $o)
                                                                        <tr>
                                                                            <td scope="row"><span>{{$o->tutorFName}}&nbsp;{{$o->tutorLName}}</span></td>
                                                                            <td scope="row"><span>{{$o->price}}</span></td>
                                                                            <td scope="row"><span class="">{{$o->status}}</span></td>
                                                                            @if($o->status != "Rejected" && $o->status != "Accepted")
                                                                            <td>
                                                                                <a href="/offerAccepted/{{$o->id}}" class="ec-header-btn">
                                                                                    <img src="{{ asset('ekka') }}/images/icons/checked.png"
                                                                                            class="svg_img header_svg" alt="" />
                                                                                </a>
                                                                                <a href="/offerDeclined/{{$o->id}}" class="ec-header-btn">
                                                                                    <img src="{{ asset('ekka') }}/images/icons/multiply.png"
                                                                                            class="svg_img header_svg" alt="" />
                                                                                </a>
                                                                            </td>
                                                                            @endif
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                
                                            </div>
                                        </div>
                                    </section>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
<style>
</style>