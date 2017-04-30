@extends('layouts.app')

@section('content')
    <div class="container">
        <flash></flash>
        <div class="row">
            <div class="col-sm-4">
                <notes></notes>
            </div>
            <div class="col-sm-8">
                <note></note>
            </div>
        </div>
    </div>
@endsection
