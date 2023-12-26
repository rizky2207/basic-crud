@extends('layouts.app')
@section('content')

<div class="content-overlay"></div>
        
            <div class="content-body">
                <!-- Description -->
                <section id="description" class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <form action="{{ route('contact.store') }}" method="POST"
                            enctype="multipart/form-data" class="col s12">
                            @csrf
                                <div class="row">
        
                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label>First Name</label>
                                            <div class="controls">
                                                <input placeholder="first name" name="first_name" id="first_name" type="text"class="form-control @error('first_name') is-invalid @enderror" value="{{ old('first_name') }}">
                                                @error('first_name')
                                                <span class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label>Last Name</label>
                                            <div class="controls">
                                                <input placeholder="last name" name="last_name" id="last_name" type="text"class="form-control @error('last_name') is-invalid @enderror" value="{{ old('last_name') }}">
                                                @error('last_name')
                                                <span class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <div class="controls">
                                                <input placeholder="Email" name="email" id="email" type="text"class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}">
                                                @error('email')
                                                <span class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label>Phone</label>
                                            <div class="controls">
                                                <input placeholder="phone" name="phone" id="phone" type="text"class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}">
                                                @error('phone')
                                                <span class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    
                                           
                                </div>
                                
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <a href="{{route('contact.index')}}" class="btn btn-danger"><i class="feather icon-corner-up-left"></i> Kembali</a>
                                </div>
                            </form>

                        </div>
                    </div>
                </section>

            </div>
</div>


@endsection
